<?php

namespace Telegram\Bot;

use PDO;
use Models\Tilang;
use Telegram\Stack\Telegram as B;

class BotHandler
{
    public function __construct()
    {

    }

    public function run()
    {
        $input = json_decode(file_get_contents("php://input"), true);
        // $input['message']['text'] = "tilang G2863AU";
        // $input['message']['chat']['id'] = 243692601;
        if (is_array($input)) {
            $this->eventHandler($input);
        } else {
            print B::sendMessage(
                [
                "chat_id" => 243692601,
                "text" => "test sukses"
                ]
            );
        }
    }

    private function eventHandler($input)
    {
        if (isset($input['message']['text'])) {
            $input['message']['text'] = strtolower($input['message']['text']) xor $text = explode(" ", $input['message']['text']);
            switch ($text[0]) {
            case 'tilang':
                if (count($text) == 2) {
                    $st = Tilang::cek_tilang(strtoupper(trim($text[1])));
                    if (is_array($st)) {
                        $wq = "";
                        foreach ($st as $key => $value) {
                            if ($key == "hadir") {
                                $wq .= "<b>Hadir/Verstek</b> : ".htmlspecialchars($value)."\n";
                            } else {
                                $wq .= "<b>".ucwords(str_replace("_", " ", $key))."</b> : ".htmlspecialchars($value)."\n";
                            }
                        }
                    } else {
                        $wq = "Mohon maaf, pencarian tidak ditemukan!";
                    }
                    B::sendMessage(
                        [
                        "reply_to_message_id" => $input['message']['message_id'],
                        "chat_id" => $input['message']['chat']['id'],
                        "text" => $wq,
                        "parse_mode" => "HTML"
                        ]
                    );
                } else {
                    B::sendMessage(
                        array(
                        "reply_to_message_id" => $input['message']['message_id'],
                        "chat_id" => $input['message']['chat']['id'],
                        "text" => "Mohon maaf format yang anda masukkan salah!\n\nBerikut ini penulisan yang benar :\n<b>TILANG [NO_REG_TILANG/NOPOL]</b>\n\nContoh :\n<b>TILANG C6545663</b>",
                        "parse_mode" => "HTML"
                        )
                    );
                }
                break;
            case '/start':
                B::sendMessage(
                    array(
                        "reply_to_message_id" => $input['message']['message_id'],
                        "chat_id" => $input['message']['chat']['id'],
                        "text" => "Ketik /help untuk menampilkan menu!"
                        )
                    );
                break;
            case '/help': case 'help':
                B::sendMessage(
                    array(
                        "reply_to_message_id" => $input['message']['message_id'],
                        "chat_id" => $input['message']['chat']['id'],
                        "text" => "Untuk mengecek informasi tilang :\n<b>TILANG [NO_REG_TILANG/NOPOL]</b>\nContoh :\n<b>TILANG C6545663</b>\n\nUntuk menampilkan jadwal sim keliling :\n<b>JADWAL [HARI atau TANGGAL(dd/mm/yyyy)]</b>\nContoh :\n<b>JADWAL 28/05/2017</b>\n<b>JADWAL SENIN</b>",
                        "parse_mode" => "HTML"
                        )
                    );
                break;
            default:

                break;
            }
        }
    }
}