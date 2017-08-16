<?php

namespace LINE\Bot;

use LINE\Bot\BotHandler;

class Run
{
    public static function run()
    {
        $app = new BotHandler();
        $app->run();
    }
}
