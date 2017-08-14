<?php

namespace Bot;

use Stack\Telegram as B;

class BotHandler
{
	public function __construct()
	{

	}

	public function run()
	{
		$input = json_decode(file_get_contents("php://input"), true);
		if (is_array($input)) {
			if (isset($input['message']['text'])) {
				B::sendMessage([
						"chat_id" => $input['message']['chat']['id'],
						"text" => $input['message']['text']
					]);
			}
		}
	}
}