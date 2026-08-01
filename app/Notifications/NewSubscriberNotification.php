<?php

namespace App\Notifications;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

/**
 * Sent when a subscriber confirms (double opt-in), so a real, verified signup
 * reaches Slack, not the unconfirmed submit. Queued so the confirm click returns
 * without waiting on the Slack API; a failed send retries and, if it exhausts
 * retries, surfaces via the error->Slack listener.
 */
class NewSubscriberNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Subscriber $subscriber) {}

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        $email = self::escapeMrkdwn($this->subscriber->email);
        $source = self::escapeMrkdwn($this->subscriber->source ?? 'unknown');
        $when = ($this->subscriber->confirmed_at ?? now())->format('Y-m-d H:i T');

        return (new SlackMessage)
            ->text("New newsletter subscriber: {$email}")
            ->headerBlock('New newsletter subscriber')
            ->contextBlock(function (ContextBlock $block) use ($when, $source) {
                $block->text("Confirmed {$when} · source {$source}");
            })
            ->sectionBlock(function (SectionBlock $block) use ($email, $source) {
                $block->field("*Email:*\n<mailto:{$email}|{$email}>")->markdown();
                $block->field("*Source:*\n{$source}")->markdown();
            });
    }

    /**
     * Escape the three mrkdwn-significant characters so an address can't trigger
     * Slack mentions or broadcasts. Per
     * https://api.slack.com/reference/surfaces/formatting#escaping
     */
    private static function escapeMrkdwn(string $value): string
    {
        return strtr($value, ['&' => '&amp;', '<' => '&lt;', '>' => '&gt;']);
    }
}
