<?php

namespace App\Notifications;

use App\Models\Site\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

class NewContactSubmissionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Slack BlockKit text blocks cap at 3000 chars. We leave headroom for the
     * label, formatting, and the truncation suffix.
     */
    private const SLACK_TEXT_MAX = 2900;

    public function __construct(
        public Contact $contact,
        public ?string $ip = null,
    ) {}

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        $name = self::escapeMrkdwn($this->contact->name);
        $email = self::escapeMrkdwn($this->contact->email);
        $message = self::truncate(
            self::escapeMrkdwn($this->contact->message),
            self::SLACK_TEXT_MAX,
        );
        $when = $this->contact->created_at?->format('Y-m-d H:i T')
            ?? now()->format('Y-m-d H:i T');
        $ip = $this->ip ?? 'unknown';

        return (new SlackMessage)
            ->text("New contact form submission from {$name} <{$email}>")
            ->headerBlock('New contact form submission')
            ->contextBlock(function (ContextBlock $block) use ($when, $ip) {
                $block->text("Received {$when} · IP {$ip}");
            })
            ->sectionBlock(function (SectionBlock $block) use ($name, $email) {
                $block->field("*Name:*\n{$name}")->markdown();
                $block->field("*Email:*\n<mailto:{$email}|{$email}>")->markdown();
            })
            ->dividerBlock()
            ->sectionBlock(function (SectionBlock $block) use ($message) {
                $block->text("*Message:*\n{$message}")->markdown();
            });
    }

    /**
     * Escape Slack mrkdwn-significant characters so a submission containing
     * `<!channel>`, `<@U123>`, `*…*`, etc. is rendered as literal text instead
     * of triggering broadcasts, user mentions, or unexpected formatting.
     *
     * Slack documents these three as the only chars that must be HTML-escaped
     * in user-supplied text: <, >, &. Per
     * https://api.slack.com/reference/surfaces/formatting#escaping
     */
    private static function escapeMrkdwn(string $value): string
    {
        return strtr($value, [
            '&' => '&amp;',
            '<' => '&lt;',
            '>' => '&gt;',
        ]);
    }

    /**
     * Truncate to Slack's per-block text limit while preserving the leading
     * portion of the user's message. The DB row is the source of truth; this
     * is only the notification preview.
     */
    private static function truncate(string $value, int $limit): string
    {
        if (mb_strlen($value) <= $limit) {
            return $value;
        }

        return mb_substr($value, 0, $limit) . "\n\n_(truncated — full message in DB)_";
    }
}
