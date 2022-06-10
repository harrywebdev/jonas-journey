<?php


namespace App\Domain\MessageProcess;

use Telegram\Bot\Objects\Message;

class IgnoreNotAllowedSenders
{
    /**
     * @param Message $message
     * @param array   $allowedIds
     *
     * @return Message
     * @throws SenderNotAllowedException
     */
    public static function handle(Message $message, array $allowedIds = []): Message
    {
        if (!$message->getFrom() ||
            !in_array($message->getFrom()->getId(), $allowedIds)) {
            throw new SenderNotAllowedException(sprintf(
                    'Invalid message ID: %s. From ID: %s not allowed.',
                    $message->getMessageId(),
                    $message->getFrom() ? $message->getFrom()->getId() : 'unknown')
            );
        }

        return $message;
    }
}
