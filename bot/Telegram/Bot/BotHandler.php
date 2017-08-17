<?php

namespace Telegram\Bot;

use PDO;
use Models\BBN2;
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
        /*$input = json_decode('{
        "update_id": 931545248,
        "message": {
        "message_id": 204,
        "from": {
            "id": 243692601,
            "first_name": "Ammar",
            "last_name": "F",
            "username": "ammarfaizi2",
            "language_code": "en-US"
        },
        "chat": {
            "id": 243692601,
            "first_name": "Ammar",
            "last_name": "F",
            "username": "ammarfaizi2",
            "type": "private"
        },
        "date": 1502930952,
        "text": "jadwalsamsat anann"
        }
        }', true);*/ file_put_contents("telegram_debug.txt", json_encode($input, 128));
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
        $indoday = array(
                    "Minggu",
                    "Senin",
                    "Selasa",
                    "Rabu",
                    "Kamis",
                    "Jum'at",
                    "Sabtu"
                    );
        $toindo = function ($time) use ($indoday) {
            $time = strtotime($time);
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
            case 'bbn2':
                if (count($text)==2) {
                    $rj="<b>INFORMASI DATA BBN2</b>\n\n";
                    $a = BBN2::getBBN2(strtoupper(trim($text[1])));
                    if ($a) {
                        foreach ($a as $k => $v) {
                            $rj.="<b>".ucwords(str_replace('_', ' ', $k))."</b> : ".$v."\n";
                        }
                        $rj.="\n\nPengambilan diruang BPKB Satlantas Polres Tegal";
                    } else {
                        $rj = "Pencarian tidak ditemukan!";
                    }
                } else {
                    $rj = "Mohon maaf format penulisan BBN2 salah.\n\nBerikut ini adalah penulisan yang benar :\n<b>BBN2 [NOPOL]</b>\n\nContoh :\n<b>BBN2 AD3718BEC</b>";
                }
                B::sendMessage(
                    array(
                    "reply_to_message_id" => $input['message']['message_id'],
                    "chat_id" => $input['message']['chat']['id'],
                    "text" => $rj,
                    "parse_mode" => "HTML"
                    )
                );
                break;
            case 'jadwalsim':
                if (count($text) == 2) {
                    $a = explode("/", $text[1]);
                    if (count($a) == 1) {
                        $mhari = ucfirst(strtolower($a[0]));
                        if (in_array($mhari, $indoday)||$mhari == "Jumat") {
                            $jadwalsim = Jadwal::getJadwal();
                            if ($jadwalsim) {
                                $rj = "<b>JADWAL SIM KELILING</b>\n\n";
                                $flag = false;
                                foreach ($jadwalsim as $val) {
                                    if (($indoday[date("w", strtotime($val['tanggal']))] == $mhari) || ($indoday[date("w", strtotime($val['tanggal']))] == "Jum'at" && $mhari == "Jumat")) {
                                        $flag = true;
                                        $rj .= "<b>".$toindo($val['tanggal'])."</b>\n<b>Lokasi</b> : ".$val['lokasi']."\n<b>Pukul awal</b> : ".$val['pukul_awal']."\n<b>Pukul akhir</b> :".$val['pukul_akhir']."\n\n";
                                    }
                                }
                                (!$flag) and $rj = "Tidak ada jadwal hari ".$mhari;
                            } else {
                                $rj = "Tidak ada jadwal hari ".$mhari;
                            }
                        } else {
                            $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar <b>JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]</b>\n\nContoh :\n<b>JADWALSIM 28/05/2017</b>\n<b>JADWALSIM SENIN</b>";
                        }
                    }
                } else {
                    if (count($text) == 1) {
                        $a = Jadwal::getJadwal();
                        if ($a) {
                            $rj = "<b>JADWAL SIM KELILING</b>\n\n";
                            foreach ($a as $val) {
                                $rj .= "<b>".$toindo($val['tanggal'])."</b>\n<b>Lokasi</b> : ".$val['lokasi']."\n<b>Pukul awal</b> : ".$val['pukul_awal']."\n<b>Pukul akhir</b> : ".$val['pukul_akhir']."\n\n";
                            }
                        } else {
                            $rj = "Tidak ada jadwal!";
                        }
                    } else {
                        $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar <b>JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]</b>\n\nContoh :\n<b>JADWALSIM 28/05/2017</b>\n<b>JADWALSIM SENIN</b>";
                    }
                }
                isset($rj) and B::sendMessage(
                    array(
                                "reply_to_message_id" => $input['message']['message_id'],
                                "chat_id" => $input['message']['chat']['id'],
                                "text" => $rj,
                                "parse_mode" => "HTML"
                             )
                );
                break;
            case 'jadwalsamsat':
                if (count($text) == 2) {
                    $a = explode("/", $text[1]);
                    if (count($a) == 1) {
                        $mhari = ucfirst(strtolower($a[0]));
                        if (in_array($mhari, $indoday) || $mhari == "Jumat") {
                            $jadwalsim = Jadwal::getJadwal(1);
                            if ($jadwalsim) {
                                $rj = "<b>JADWAL SAMSAT KELILING</b>\n\n";
                                $flag = false;
                                foreach ($jadwalsim as $val) {
                                    if (($indoday[date("w", strtotime($val['tanggal']))] == $mhari) || ($indoday[date("w", strtotime($val['tanggal']))] == "Jum'at" && $mhari == "Jumat")) {
                                        $flag = true;
                                        $rj .= "<b>".$toindo($val['tanggal'])."</b>\n<b>Lokasi</b> : ".$val['lokasi']."\n<b>Pukul awal</b> : ".$val['pukul_awal']."\n<b>Pukul akhir</b> : ".$val['pukul_akhir']."\n\n";
                                    }
                                }
                                ($flag===false) and $rj = "Tidak ada jadwal hari ".$mhari.".";
                                file_put_contents("debug_tg.txt", $rj);
                            } else {
                                $rj = "Tidak ada jadwal hari ".$mhari.".";
                            }
                        } else {
                            $rj = "Mohon maaf, format penulisan jadwalsamsat salah.\n\nPenulisan yang benar <b>JADWALSAMSAT [HARI atau TANGGAL(dd/mm/yyyy)]</b>\n\nContoh :\n<b>JADWALSAMSAT 28/05/2017</b>\n<b>JADWALSAMSAT SENIN</b>";
                        }
                    }
                } else {
                    if (count($text) == 1) {
                        $a = Jadwal::getJadwal(1);
                        if ($a) {
                            $rj = "<b>JADWAL SAMSAT KELILING</b>\n\n";
                            foreach ($a as $val) {
                                $rj .= "<b>".$toindo($val['tanggal'])."</b>\n<b>Lokasi</b> : ".$val['lokasi']."\n<b>Pukul awal</b> : ".$val['pukul_awal']."\n<b>Pukul akhir</b> : ".$val['pukul_akhir']."\n\n";
                            }
                        } else {
                            $rj = "Tidak ada jadwal sim keliling!";
                        }
                    } else {
                        $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar <b>JADWALSAMSAT [HARI atau TANGGAL(dd/mm/yyyy)]</b>\n\nContoh :\n<b>JADWALSAMSAT 28/05/2017</b>\n<b>JADWALSAMSAT SENIN</b>";
                    }
                }
                isset($rj) and B::sendMessage(
                    array(
                                "reply_to_message_id" => $input['message']['message_id'],
                                "chat_id" => $input['message']['chat']['id'],
                                "text" => $rj,
                                "parse_mode" => "HTML"
                             )
                );
                break;
            case '?':
            case 'help':
            case '/help':
            case '/start':
                        B::sendMessage(
                            array(
                            "reply_to_message_id" => $input['message']['message_id'],
                            "chat_id" => $input['message']['chat']['id'],
                            "text" => "<b>SELAMAT DATANG DI APLIKASI AUTOBOT SATLANTAS POLRES TEGAL</b>

Untuk mengecek informasi tilang :
TILANG [NO_REG_TILANG/NOPOL]
Contoh :
TILANG C6545663

Untuk menampilkan jadwal sim keliling ketik :
JADWALSIM

Untuk menampilkan jadwal samsat keliling ketik :
JADWALSAMSAT

Untuk menampilkan data BBN2 ketik :
BBN2 [NOPOL]
Contoh :
BBN2 G1234GG",
                            "parse_mode" => "HTML"
                            )
                        );
                break;
            default:
                B::sendMessage(
                    array(
                    "text"=>"PERINTAH TIDAK DIKENALI.\n\nKETIK \"<b>HELP</b>\" ATAU \"<b>?</b>\" UNTUK MENAMPILKAN DAFTAR PERINTAH.",
                    "reply_to_message_id" => $input['message']['message_id'],
                            "chat_id" => $input['message']['chat']['id'],
                    "parse_mode"=>"HTML"
                    )
                );
                break;
            }
        }
    }
}
