<?php

namespace App\Console\Commands;

use App\Domain\MessageProcess\IgnoreNotAllowedSenders;
use App\Domain\MessageProcess\IgnoreTextMessages;
use Illuminate\Console\Command;
use Telegram\Bot\Api;
use Telegram\Bot\BotsManager;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\Update;

class TelegramBotUpdatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get updates from Telegram Bot.';

    /**
     * @var Api
     */
    private $telegramApi;
    /**
     * @var BotsManager
     */
    private $botsManager;

    public function __construct(Api $telegramApi, BotsManager $botsManager)
    {
        parent::__construct();

        $this->telegramApi = $telegramApi;
        $this->botsManager = $botsManager;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $updates = $this->telegramApi->getUpdates([
            'offset'  => 0,
            'limit'   => 10,
            'timeout' => 5,
        ]);

        $config           = $this->botsManager->getBotConfig();
        $allowedSenderIds = explode(',', $config['allowed_sender_ids']);

        $this->getOutput()->writeln("=======================");
        $this->getOutput()->writeln("<info>Fetch successful. Got " . count($updates) . " updates.</info>");
        $this->getOutput()->writeln("=======================");
        $this->getOutput()->writeln("Allowed Sender IDs: " . $config['allowed_sender_ids']);

        $skippedUpdates = [];

        /** @var Update $update */
        foreach ($updates as $update) {
            /** @var Message $message */
            $message = $update->getMessage();


            try {
                IgnoreNotAllowedSenders::handle($message, $allowedSenderIds);
                IgnoreTextMessages::handle($message);
            } catch (\Exception $e) {
                $this->getOutput()->writeln('<error>' . $e->getMessage() . '</error>');
                $skippedUpdates [] = $update;
                continue;
            }

            // we care about text that is longer than 50 chars (so assuming some kind
            // of better insight/message

            // now process the message
            $this->getOutput()->writeln('Processing msg: ' . $message->getMessageId());
        }

//        dd($updates);

//        dd($skippedUpdates);

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }
}
