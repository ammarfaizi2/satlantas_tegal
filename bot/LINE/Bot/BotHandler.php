<?php

namespace LINE\Bot;

use PDO;
use Models\BBN2;
use SysHandler\DB;
use Models\Tilang;
use Models\Jadwal;
use LINE\Stack\LINE as L;
use Telegram\Stack\Telegram as B;

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

    private function action($igp)
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
        $text = explode(" ", strtolower($igp));
        switch ($text[0]) {
            case 'tilang':
            if (count($text) == 2) {
                $st = Tilang::cek_tilang(strtoupper(trim($text[1])));
                if (is_array($st)) {
                    $wq = "";
                    foreach ($st as $key => $value) {
                        if ($key != 'denda') {
                            if ($key == "hadir") {
                                $wq .= "Hadir/Verstek : ".htmlspecialchars($value)."\n";
                            } else {
                                $wq .= ucwords(str_replace("_", " ", $key))." : ".htmlspecialchars($value)."\n";
                            }
                        }
                    }
                } else {
                    $wq = "Mohon maaf, pencarian tidak ditemukan!";
                }
                isset($wq) and L::reply(array(array(
                    "type"=>"text",
                    "text"=>$wq
                )), $this->replyToken);
            } else {
                if (isset($text[1]) and $text[1] == "admin") {
                        if (isset($text[2]) and is_numeric($text[2])) {
                            if ($text[2] != 0) {
                                if ((int)$text[2] > 1) {
                                    $offset = (($text[2] * 100) - 100)+1;
                                } else {
                                    $offset = 1;
                                }
                                $st = DB::pdo()->prepare("SELECT `nomor_polisi`,`nomor_register_tilang` FROM `tilang` ORDER BY `nomor_polisi` LIMIT {$offset},100");
                                $exe = $st->execute();
                                if (!$exe) {
                                    $r = json_encode($st->errorInfo());
                                } else {
                                    $r1 = "" xor $r2 = "" xor $i = 1;
                                    foreach ($st->fetchAll(PDO::FETCH_ASSOC) as $val) {
                                        ${(function() use ($i) {
                                            return $i < 51 ? "r1" : "r2";
                                        })()}.= ($offset++).". ".strtoupper($val['nomor_polisi'])." ".strtoupper($val['nomor_register_tilang'])."\n";
                                        $i++;
                                    }
                                }
                            } else {
                                $r = "0 tidak valid ! (Minimal 1)";
                            }
                        }
                    isset($r1,$r2)  and  $wq = L::reply(array(array(
                    "type"=>"text",
                    "text"=>$r1
                    ),array(
                    "type"=>"text",
                    "text"=>$r2
                    )), $this->replyToken) or $wq = L::reply(array(array(
                    "type"=>"text",
                    "text"=>$r
                    )), $this->replyToken);
                    } else {
                        L::reply(array(array(
                    "type"=>"text",
                    "text"=>"Mohon maaf format yang anda masukkan salah!\n\nBerikut ini penulisan yang benar :\nTILANG [NO_REG_TILANG/NOPOL]\n\nContoh :\nTILANG C6545663"
                )), $this->replyToken);
                    }
            }
            break;

            case 'bbn2':
                if (count($text)==2) {
                    $rj="INFORMASI DATA BBN2\n\n";
                    $a = BBN2::getBBN2(strtoupper(trim($text[1])));
                    if ($a) {
                        foreach ($a as $k => $v) {
                            $rj.="".ucwords(str_replace('_', ' ', $k))." : ".$v."\n";
                        }
                        $rj.="\n\nPengambilan diruang BPKB Satlantas Polres Tegal";
                    } else {
                        $rj = "Pencarian tidak ditemukan!";
                    }
                } else {
                    $rj = "Mohon maaf format penulisan BBN2 salah.\n\nBerikut ini adalah penulisan yang benar :\nBBN2 [NOPOL]\n\nContoh :\nBBN2 AD3718BEC";
                }
                isset($rj) and L::reply(array(array(
                    "type"=>"text",
                    "text"=>$rj
                )), $this->replyToken);
            break;

            case 'jadwalsim':
                if (count($text) == 2) {
                    $a = explode("/", $text[1]);
                    if (count($a) == 1) {
                        $mhari = ucfirst(strtolower($a[0]));
                        if (in_array($mhari, $indoday)||$mhari == "Jumat") {
                            $jadwalsim = Jadwal::getJadwal();
                            if ($jadwalsim) {
                                $rj = "JADWAL SIM KELILING\n\n";
                                $flag = false;
                                foreach ($jadwalsim as $val) {
                                    if (($indoday[date("w", strtotime($val['tanggal']))] == $mhari) || ($indoday[date("w", strtotime($val['tanggal']))] == "Jum'at" && $mhari == "Jumat")) {
                                        $flag = true;
                                        $rj .= "".$toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal : ".$val['pukul_awal']."\nPukul akhir :".$val['pukul_akhir']."\n\n";
                                    }
                                }
                                (!$flag) and $rj = "Tidak ada jadwal hari ".$mhari;
                            } else {
                                $rj = "Tidak ada jadwal hari ".$mhari;
                            }
                        } else {
                            $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]\n\nContoh :\nJADWALSIM 28/05/2017\nJADWALSIM SENIN";
                        }
                    }
                } else {
                    if (count($text) == 1) {
                        $a = Jadwal::getJadwal();
                        if ($a) {
                            $rj = "JADWAL SIM KELILING\n\n";
                            foreach ($a as $val) {
                                $rj .= "".$toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal : ".$val['pukul_awal']."\nPukul akhir : ".$val['pukul_akhir']."\n\n";
                            }
                        } else {
                            $rj = "Tidak ada jadwal!";
                        }
                    } else {
                        $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]\n\nContoh :\nJADWALSIM 28/05/2017\nJADWALSIM SENIN";
                    }
                }
                isset($rj) and L::reply(array(array(
                    "type"=>"text",
                    "text"=>$rj
                )), $this->replyToken);
                break;

                case 'jadwalsamsat':
                if (count($text) == 2) {
                    $a = explode("/", $text[1]);
                    if (count($a) == 1) {
                        $mhari = ucfirst(strtolower($a[0]));
                        if (in_array($mhari, $indoday) || $mhari == "Jumat") {
                            $jadwalsim = Jadwal::getJadwal(1);
                            if ($jadwalsim) {
                                $rj = "JADWAL SAMSAT KELILING\n\n";
                                $flag = false;
                                foreach ($jadwalsim as $val) {
                                    if (($indoday[date("w", strtotime($val['tanggal']))] == $mhari) || ($indoday[date("w", strtotime($val['tanggal']))] == "Jum'at" && $mhari == "Jumat")) {
                                        $flag = true;
                                        $rj .= "".$toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal : ".$val['pukul_awal']."\nPukul akhir : ".$val['pukul_akhir']."\n\n";
                                    }
                                }
                                ($flag===false) and $rj = "Tidak ada jadwal hari ".$mhari.".";
                                file_put_contents("debug_tg.txt", $rj);
                            } else {
                                $rj = "Tidak ada jadwal hari ".$mhari.".";
                            }
                        } else {
                            $rj = "Mohon maaf, format penulisan jadwalsamsat salah.\n\nPenulisan yang benar JADWALSAMSAT [HARI atau TANGGAL(dd/mm/yyyy)]\n\nContoh :\nJADWALSAMSAT 28/05/2017\nJADWALSAMSAT SENIN";
                        }
                    }
                } else {
                    if (count($text) == 1) {
                        $a = Jadwal::getJadwal(1);
                        if ($a) {
                            $rj = "JADWAL SAMSAT KELILING\n\n";
                            foreach ($a as $val) {
                                $rj .= "".$toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal : ".$val['pukul_awal']."\nPukul akhir : ".$val['pukul_akhir']."\n\n";
                            }
                        } else {
                            $rj = "Tidak ada jadwal sim keliling!";
                        }
                    } else {
                        $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar JADWALSAMSAT [HARI atau TANGGAL(dd/mm/yyyy)]\n\nContoh :\nJADWALSAMSAT 28/05/2017\nJADWALSAMSAT SENIN";
                    }
                }
                isset($rj) and L::reply(array(array(
                    "type"=>"text",
                    "text"=>$rj
                )), $this->replyToken);
                break;

            case '?':
            case 'help':
            case '/help':
            case '/start':
                        L::reply(array(array(
                    "type"=>"text",
                    "text"=>"SELAMAT DATANG DI APLIKASI AUTOBOT SATLANTAS POLRES TEGAL

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
BBN2 G1234GG"
                )), $this->replyToken);
                break;

                default:
                L::reply(array(array(
                    "type"=>"text",
                    "text"=>"PERINTAH TIDAK DIKENALI.\n\nKETIK \"HELP\" ATAU \"?\" UNTUK MENAMPILKAN DAFTAR PERINTAH."
                )), $this->replyToken);
                break;
        }
    }


    public function run()
    {
        $this->parseEvent();
    }
}
