<?php

namespace LINE\Bot;

use Models\Tilang;
use LINE\Stack\LINE as L;

class BotHandler
{
	public function __construct()
	{

	}

	private function parseEvent()
	{
		$input = json_decode('{
    "events": [
        {
            "replyToken": "00000000000000000000000000000000",
            "type": "message",
            "timestamp": 1451617200000,
            "source": {
                "type": "user",
                "userId": "Udeadbeefdeadbeefdeadbeefdeadbeef"
            },
            "message": {
                "id": "100001",
                "type": "text",
                "text": "Hello,world"
            }
        },
        {
            "replyToken": "ffffffffffffffffffffffffffffffff",
            "type": "message",
            "timestamp": 1451617210000,
            "source": {
                "type": "user",
                "userId": "Udeadbeefdeadbeefdeadbeefdeadbeef"
            },
            "message": {
                "id": "100002",
                "type": "sticker",
                "packageId": "1",
                "stickerId": "1"
            }
        }
    ]
}', 128);
		foreach ($input['events'] as $val) {
			if (isset($val['message']['text'])) {
				$this->replyToken = $val['replyToken'];
				$this->action($val['message']['text']);
			}
		}
	}

	private function action($text)
	{
		$tgg = explode(" ", strtolower($text));
		switch ($tgg[0]) {
			case 'tilang':
				if (count($text) == 2) {
					$st = Tilang::cek_tilang(strtoupper(trim($text[1])));
					if (is_array($st)) {
						$wq = "";
						foreach ($st as $key => $value) {
							if ($key == "hadir") {
								$wq .= "Hadir/Verstek : ".htmlspecialchars($value)."\n";
							} else {
								$wq .= ucwords(str_replace("_", " ", $key))." : ".htmlspecialchars($value)."\n";
							}
						}
					} else {
						$wq = "Mohon maaf, pencarian tidak ditemukan!";
					}
					B::sendMessage([
						"reply_to_message_id" => $input['message']['message_id'],
						"chat_id" => $input['message']['chat']['id'],
						"text" => $wq,
						"parse_mode" => "HTML"
					]);
					L::reply(array(
							array(
								"type" => "text",
								"text" => $wq
								)
						), $this->replyToken);
				} else {
					L::reply(array(
							array(
								"type" => "text",
								"text" => "Mohon maaf format yang anda masukkan salah!\n\nBerikut ini penulisan yang benar :\nTILANG [NO_REG_TILANG/NOPOL]\n\nContoh :\nTILANG C6545663"
								)
						), $this->replyToken);
				}
			break;
				
			default:

			break;
		}
	}


	public function run()
	{

	}
}