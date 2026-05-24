<?php

namespace Tests\Unit;

use App\Models\Site\Contact;
use App\Notifications\NewContactSubmissionNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Slack\BlockKit\Blocks\HeaderBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;
use Tests\TestCase;

class NewContactSubmissionNotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_via_returns_slack_only(): void
    {
        $contact = $this->makeContact();
        $notification = new NewContactSubmissionNotification($contact, '127.0.0.1');

        $this->assertEquals(['slack'], $notification->via(new \stdClass));
    }

    public function test_to_slack_returns_a_slack_message_with_expected_fallback_text(): void
    {
        $contact = $this->makeContact(['name' => 'Real User', 'email' => 'real@gmail.com']);
        $notification = new NewContactSubmissionNotification($contact, '203.0.113.42');

        $message = $notification->toSlack(new \stdClass);

        $this->assertInstanceOf(SlackMessage::class, $message);

        $payload = $message->toArray();
        $this->assertStringContainsString('Real User', $payload['text']);
        $this->assertStringContainsString('real@gmail.com', $payload['text']);
    }

    public function test_to_slack_payload_contains_header_context_and_message_blocks(): void
    {
        $contact = $this->makeContact([
            'name' => 'Alice',
            'email' => 'alice@gmail.com',
            'message' => 'Looking for an AI consult.',
        ]);
        $notification = new NewContactSubmissionNotification($contact, '203.0.113.42');

        $payload = $notification->toSlack(new \stdClass)->toArray();
        $blocks = $payload['blocks'];

        // Header
        $this->assertEquals('header', $blocks[0]['type']);
        $this->assertEquals('New contact form submission', $blocks[0]['text']['text']);

        // Context (timestamp + IP)
        $this->assertEquals('context', $blocks[1]['type']);
        $this->assertStringContainsString('203.0.113.42', $blocks[1]['elements'][0]['text']);

        // Section with name + email fields
        $this->assertEquals('section', $blocks[2]['type']);
        $fieldsText = collect($blocks[2]['fields'])->pluck('text')->implode(' ');
        $this->assertStringContainsString('Alice', $fieldsText);
        $this->assertStringContainsString('alice@gmail.com', $fieldsText);

        // Divider
        $this->assertEquals('divider', $blocks[3]['type']);

        // Message section
        $this->assertEquals('section', $blocks[4]['type']);
        $this->assertStringContainsString('Looking for an AI consult.', $blocks[4]['text']['text']);
    }

    public function test_special_chars_in_name_are_escaped_so_slack_does_not_broadcast(): void
    {
        $contact = $this->makeContact([
            'name' => '<!channel>',
            'email' => 'attacker@example.com',
            'message' => 'A message that should not ping everyone.',
        ]);
        $notification = new NewContactSubmissionNotification($contact, '203.0.113.42');

        $payload = $notification->toSlack(new \stdClass)->toArray();
        $serialized = json_encode($payload);

        // Raw `<!channel>` would broadcast to the entire channel. Escaped form is safe.
        $this->assertStringNotContainsString('<!channel>', $serialized);
        $this->assertStringContainsString('&lt;!channel&gt;', $serialized);
    }

    public function test_special_chars_in_message_are_escaped(): void
    {
        $contact = $this->makeContact([
            'message' => 'Try this: <@U12345> & <!here>',
        ]);
        $notification = new NewContactSubmissionNotification($contact, '127.0.0.1');

        $payload = $notification->toSlack(new \stdClass)->toArray();
        $messageBlock = $payload['blocks'][4]['text']['text'];

        $this->assertStringNotContainsString('<@U12345>', $messageBlock);
        $this->assertStringNotContainsString('<!here>', $messageBlock);
        $this->assertStringContainsString('&lt;@U12345&gt;', $messageBlock);
        $this->assertStringContainsString('&amp;', $messageBlock);
    }

    public function test_long_messages_are_truncated_to_stay_under_slack_block_limit(): void
    {
        $longBody = str_repeat('A', 4000);
        $contact = $this->makeContact(['message' => $longBody]);
        $notification = new NewContactSubmissionNotification($contact, '127.0.0.1');

        $payload = $notification->toSlack(new \stdClass)->toArray();
        $messageBlock = $payload['blocks'][4]['text']['text'];

        // Slack BlockKit text blocks hard-cap at 3000 chars
        $this->assertLessThanOrEqual(3000, strlen($messageBlock));
        $this->assertStringContainsString('truncated', $messageBlock);
    }

    public function test_short_messages_are_not_truncated(): void
    {
        $contact = $this->makeContact(['message' => 'Brief but valid message.']);
        $notification = new NewContactSubmissionNotification($contact, '127.0.0.1');

        $payload = $notification->toSlack(new \stdClass)->toArray();
        $messageBlock = $payload['blocks'][4]['text']['text'];

        $this->assertStringNotContainsString('truncated', $messageBlock);
        $this->assertStringContainsString('Brief but valid message.', $messageBlock);
    }

    public function test_falls_back_to_now_when_created_at_is_null(): void
    {
        $contact = $this->makeContact();
        $contact->created_at = null;

        $notification = new NewContactSubmissionNotification($contact, '127.0.0.1');

        $payload = $notification->toSlack(new \stdClass)->toArray();

        // Context block should still render a valid timestamp string
        $this->assertNotEmpty($payload['blocks'][1]['elements'][0]['text']);
    }

    public function test_falls_back_to_unknown_when_ip_is_null(): void
    {
        $contact = $this->makeContact();
        $notification = new NewContactSubmissionNotification($contact, null);

        $payload = $notification->toSlack(new \stdClass)->toArray();

        $this->assertStringContainsString('IP unknown', $payload['blocks'][1]['elements'][0]['text']);
    }

    private function makeContact(array $overrides = []): Contact
    {
        return Contact::create(array_merge([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Default message body.',
        ], $overrides));
    }
}
