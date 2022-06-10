<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Telegram\Bot\Api;

class TelegramBotCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify that Telegram Bot works.';

    /**
     * @var Api
     */
    private $telegramApi;

    public function __construct(Api $telegramApi)
    {
        parent::__construct();

        $this->telegramApi = $telegramApi;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = $this->telegramApi->getMe();

        $botId     = $response->getId();
        $firstName = $response->getFirstName();
        $username  = $response->getUsername();

        $this->getOutput()->writeln("=======================");
        $this->getOutput()->writeln("<info>Check successful.</info>");
        $this->getOutput()->writeln("=======================");
        $this->getOutput()->writeln("Bot Id: <info>$botId</info>");
        $this->getOutput()->writeln("First Name: <info>$firstName</info>");
        $this->getOutput()->writeln("Username: <info>$username</info>");
        $this->getOutput()->writeln("=======================");

        // this method must return an integer number with the "exit status code"
        // of the command. You can also use these constants to make code more readable

        // return this if there was no problem running the command
        // (it's equivalent to returning int(0))
        return \Symfony\Component\Console\Command\Command::SUCCESS;
    }
}
