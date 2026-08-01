<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\SlackMessage;

/**
 * A Slack heads-up when something the owner cares about fails (a mail send, a lead
 * that couldn't be saved). Sent via SlackNotifier, so it no-ops without a token.
 */
class SystemFailureNotification extends Notification
{
    /**
     * @param  array<string, string>  $context
     */
    public function __construct(
        public string $title,
        public array $context = [],
    ) {}

    public function via(object $notifiable): array
    {
        return ['slack'];
    }

    public function toSlack(object $notifiable): SlackMessage
    {
        $lines = [];
        foreach ($this->context as $key => $value) {
            $lines[] = '*'.self::escapeMrkdwn((string) $key).':* '.self::escapeMrkdwn((string) $value);
        }
        $detail = $lines === [] ? '_no additional context_' : implode("\n", $lines);

        return (new SlackMessage)
            ->text('Something failed: '.$this->title)
            ->headerBlock($this->title)
            ->sectionBlock(function (SectionBlock $block) use ($detail) {
                $block->text($detail)->markdown();
            });
    }

    /**
     * Slack requires only these three characters HTML-escaped in user-supplied
     * text. Per https://api.slack.com/reference/surfaces/formatting#escaping
     */
    private static function escapeMrkdwn(string $value): string
    {
        return strtr($value, ['&' => '&amp;', '<' => '&lt;', '>' => '&gt;']);
    }
}
