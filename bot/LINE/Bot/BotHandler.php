<?php

namespace LINE\Bot;

use Models\BBN2;
use Models\Tilang;
use Models\Jadwal;
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
                L::reply(
                    array(
                        array(
                            "type" => "text",
                            "text" => $wq
                            )
                        ), $this->replyToken
                );
            } else {
                L::reply(
                    array(
                        array(
                            "type" => "text",
                            "text" => "Mohon maaf format yang anda masukkan salah!\n\nBerikut ini penulisan yang benar :\nTILANG [NO_REG_TILANG/NOPOL]\n\nContoh :\nTILANG C6545663"
                            )
                        ), $this->replyToken
                );
            }
            break;
case 'bbn2':
if (count($tgg)==2) {
    $rj="INFORMASI DATA BBN2\n\n";
    $a = BBN2::getBBN2(strtoupper(trim($tgg[1])));
    if ($a) {
        foreach ($a as $k => $v) {
            $rj.= ucwords(str_replace('_', ' ', $k)).": ".$v."\n";
        }
        $rj.="\n\nPengambilan diruang BPKB Satlantas Polres Tegal";
    } else {
        $rj = "Pencarian tidak ditemukan!";
    }
} else {
    $rj = "Mohon maaf format penulisan BBN2 salah.\n\nBerikut ini adalah penulisan yang benar :\nBBN2 [NOPOL]\n\nContoh :\nBBN2 AD3718BEC";
}
L::reply(array(array(
"type"=>"text",
"text"=>$rj
)), $this->replyToken);
break;

case 'jadwalsim':
if (count($tgg) == 2) {
    $a = explode("/", $tgg[1]);
    if (count($a) == 1) {
        $mhari = ucfirst(strtolower($a[0]));
        if (in_array($mhari, $indoday)||$mhari == "Jumat") {
            $jadwalsim = Jadwal::getJadwal();
            if ($jadwalsim) {
                $rj = "JADWAL SIM KELILING\n\n";
                foreach ($jadwalsim as $val) {
                    if (($indoday[date("w", strtotime($val['tanggal']))] == $mhari) || ($indoday[date("w", strtotime($val['tanggal']))] == "Jum'at" && $mhari == "Jumat")) {
                        $rj .=$toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal : ".$val['pukul_awal']."\nPukul akhir :".$val['pukul_akhir']."\n\n";
                    }
                }
                empty($rj) and $rj = "Tidak ada jadwal hari ".$mhari;
            } else {
                $rj = "Tidak ada jadwal hari ".$mhari;
            }
        } else {
            $rj = "Mohon maaf, format penulisan jadwalsim salah.\n\nPenulisan yang benar JADWALSIM [HARI atau TANGGAL(dd/mm/yyyy)]\n\nContoh :\nJADWALSIM 28/05/2017\nJADWALSIM SENIN";
        }
    }
} else {
    if (count($tgg) == 1) {
        $a = Jadwal::getJadwal();
        if ($a) {
            $rj = "JADWAL SIM KELILING\n\n";
            foreach ($a as $val) {
                $rj .= $toindo($val['tanggal'])."\nLokasi : ".$val['lokasi']."\nPukul awal</b> : ".$val['pukul_awal']."\nPukul akhir : ".$val['pukul_akhir']."\n\n";
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
                
        default:

            break;
        }
    }


    public function run()
    {
        $this->parseEvent();
    }
}
