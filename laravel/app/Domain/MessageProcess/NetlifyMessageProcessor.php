<?php

namespace App\Domain\MessageProcess;

use Telegram\Bot\Objects\Message;

class NetlifyMessageProcessor
{
    public function handle(Message $message): void
    {
        // save text message
        if (is_string($message->text) && $message->text !== '') {
            $this->handleTextMessage($message);
            return;
        }
    }

    private function handleTextMessage(Message $message)
    {

    }
}
