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
		$input = json_decode(file_get_contents("php://input"), 128);
		/*$input = json_decode('{
    "events": [
        {
            "type": "message",
            "replyToken": "dc423fc515934f1fb5c11bb957623d0c",
            "source": {
                "userId": "U4cc97d7da9d0b0cb161597db2eab4261",
                "type": "user"
            },
            "timestamp": 1502884511947,
            "message": {
                "type": "text",
                "id": "6552829288783",
                "text": "Tilang 46 141"
            }
        }
    ]
}', 128);*/
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
				if (count($tgg) == 2) {
					$st = Tilang::cek_tilang(strtoupper(trim($tgg[1])));
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
		$this->parseEvent();
	}
}