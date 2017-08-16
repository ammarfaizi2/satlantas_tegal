<?php

namespace Telegram\Bot;

use Telegram\Bot\BotHandler;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

class Run
{
    public static function run()
    {
        $app = new BotHandler();
        $app->run();
    }
}
