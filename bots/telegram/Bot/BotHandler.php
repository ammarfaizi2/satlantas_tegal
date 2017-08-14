<?php

namespace Bot;

use PDO;
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
			$this->eventHandler($input);
		} else {
			print B::sendMessage([
					"chat_id" => 243692601,
					"text" => date("Y-m-d H:i:s")
				]);
		}
	}

	private function eventHandler($input)
	{
		if (isset($input['message']['text'])) {
			$input['message']['text'] = strtolower($input['message']['text']) xor $text = explode(" ", $input['message']['text']);
			if ($text[0] == "tilang") {
				if (count($text) == 2) {
					$data = $this->cek_tilang(strtoupper(trim($text[1])));
					return B::sendMessage([
						"chat_id" => $input['message']['chat']['id'],
						"text" => json_encode($data, 128)
					]);
				}
			}
			B::sendMessage([
						"chat_id" => $input['message']['chat']['id'],
						"text" => "Mohon maaf format yang anda masukkan salah!\n\nBerikut ini penulisan yang benar :\nTILANG [NO_REG_TILANG/NOPOL]"
					]);
		}
	}

	private function cek_tilang($no)
	{
		$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
		$st = $pdo->prepare("SELECT * FROM `table_a` AS `a` INNER JOIN `table_b` AS `b` ON `a`.`no_register_tilang`=`b`.`no_register_tilang` WHERE `a`.`no_register_tilang` = :noreg OR `b`.`nomor_polisi` = :nopol LIMIT 1;");
		$st->execute([
				":noreg" => $no,
				":nopol" => $no
			]);
		return $st->fetch(PDO::FETCH_ASSOC);
	}
}