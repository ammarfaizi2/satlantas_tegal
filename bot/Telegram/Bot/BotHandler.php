<?php

namespace Telegram\Bot;

use PDO;
use Models\Tilang;
use Models\Jadwal;
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
            case 'jadwalsim':
                $toindo = function ($time) {
                    $time = strtotime($time);
                    $indoday = array(
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jum'at",
                    "Sabtu"
                    );
                    $indomonth = array(
                    "Jan" => "Januari",
                    "Feb" => "Februari",
                    "Mar" => "Maret",
                    "Apr" => "April",
                    "May" => "Mei",
                    "Jun" => "Juni",
                    "Jul" => "Juli",
                    "Aug" => "Agustus",
                    "Sep" => "September",
                    "Oct" => "Oktober",
                    "Nov" => "November",
                    "Dec" => "Desember");
                    return $indoday[date("w", $time)].", ".date("d", $time)." ".$indomonth[date("M", $time)]." ".date("Y", $time);
                };
                if (count($text) == 2) {
                } else {
                    $jadwalsim = Jadwal::getJadwal();
                    if ($jadwalsim) {
                        $rj = "";
                        foreach ($jadwalsim as $val) {
                            $rj .= "<b>".$toindo($val['tanggal'])."</b>\n<b>Lokasi</b> : ".$val['lokasi']."\n<b>Pukul awal</b> : ".$val['pukul_awal']."\n<b>Pukul akhir</b> :".$val['pukul_akhir']."\n\n";
                        }
                    } else {
                        $rj = "Belum ada jadwal!";
                    }
                    B::sendMessage(
                        array(
                                "reply_to_message_id" => $input['message']['message_id'],
                                "chat_id" => $input['message']['chat']['id'],
                                "text" => $rj,
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
            case '/help': case 'help': case '?':
                        B::sendMessage(
                            array(
                            "reply_to_message_id" => $input['message']['message_id'],
                            "chat_id" => $input['message']['chat']['id'],
                            "text" => "Untuk mengecek informasi tilang :\n<b>TILANG [NO_REG_TILANG/NOPOL]</b>\nContoh :\n<b>TILANG C6545663</b>\n\nUntuk menampilkan jadwal sim keliling :\n<b>JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]</b>\nContoh :\n<b>JADWALSIM 28/05/2017</b>\n<b>JADWALSIM SENIN</b>",
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
