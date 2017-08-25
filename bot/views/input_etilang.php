<?php
$flag = date("Y-m-d") xor $js = false;
$indoday = array(
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jum".($js ? "\\'" : "'")."at",
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
$now = strtotime(date("Y-m-d"))-(3600*24*200);
$od  = 3600 * 24 xor $rt = "";
$month = array();
for ($i=0; $i < 320; $i++) {
    $wq = $now + ($od * $i);
    if ($flag and $flag == date("Y-m-d", $wq)) {
        $rt .= "<option value=\"".($wq)."\" selected>".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";
    } else {
        $rt .= "<option value=\"".($wq)."\">".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";
    }
}
$opt = $rt;
$flag = date("Y-m-d") xor $js = false;
$indoday = array(
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jum".($js ? "\\'" : "'")."at",
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
$now = strtotime(date("Y-m-d"));
$od  = 3600 * 24 xor $rt = "";
$month = array();
for ($i=0; $i < 320; $i++) {
    $wq = $now + ($od * $i);
    if ($flag and $flag == date("Y-m-d", $wq)) {
        $rt .= "<option value=\"".($wq)."\" selected>".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";
    } else {
        $rt .= "<option value=\"".($wq)."\">".$indoday[date("w", $wq)].",&nbsp;".date("d", $wq)." ".$indomonth[date("M", $wq)]." ".date("Y", $wq)."</option>";
    }
}
$opt2 = $rt;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Input ETilang</title>
	<style type="text/css">
		.wd{
			margin-bottom: 5%;
		}
		h2 {
			font-family: Helvetica;
		}
		.bk {
			margin-top: 1%;
		}
	</style>
</head>
<body>
<center>
	<div class="bk">
		<a href="?pg=etilang_fr&rf=input"><button style="cursor:pointer;">Kembali</button></a>
	</div>
	<div class="wd">
		<form method="post" action="">
			<table>
				<thead>
					<tr><th colspan="3"><h2>Input ETilang</h2></th></tr>
				</thead>
				<tbody>
					<tr><td> Nomor Register Tilang</td><td>:</td><td><input required type="text" name="nomor_register_tilang"></td></tr>
					<tr><td> Tanggal Perkara</td><td>:</td><td><select name="tanggal_perkara"><?php print $opt; ?></select></td></tr>
					<tr><td> Form</td><td>:</td><td><input type="text" name="form"></td></tr>
					<tr><td> Nomor Pembayaran</td><td>:</td><td><input type="text" name="nomor_pembayaran"></td></tr>
					<tr><td> Nrp Petugas</td><td>:</td><td><input type="text" name="nrp_petugas"></td></tr>
					<tr><td> Nama Petugas</td><td>:</td><td><input type="text" name="nama_petugas"></td></tr>
					<tr><td> Nama</td><td>:</td><td><input type="text" name="nama"></td></tr>
					<tr><td> Alamat</td><td>:</td><td><input type="text" name="alamat"></td></tr>
					<tr><td> Pasal</td><td>:</td><td><input type="text" name="pasal"></td></tr>
					<tr><td> Barang Bukti</td><td>:</td><td><input type="text" name="barang_bukti"></td></tr>
					<tr><td> Jenis Kendaraan</td><td>:</td><td><input type="text" name="jenis_kendaraan"></td></tr>
					<tr><td> Nomor Polisi</td><td>:</td><td><input type="text" name="nomor_polisi"></td></tr>
					<tr><td> Uang Titipan</td><td>:</td><td><input type="text" name="uang_titipan"></td></tr>
					<tr><td> Kode Satker Pn</td><td>:</td><td><input type="text" name="kode_satker_pn"></td></tr>
					<tr><td> Nomor Perkara</td><td>:</td><td><input type="text" name="nomor_perkara"></td></tr>
					<tr><td> Nama Hakim</td><td>:</td><td><input type="text" name="nama_hakim"></td></tr>
					<tr><td> Nama Panitera</td><td>:</td><td><input type="text" name="nama_panitera"></td></tr>
					<tr><td> Kode Satker Kejaksaan</td><td>:</td><td><input type="text" name="kode_satker_kejaksaan"></td></tr>
					<tr><td> Tanggal Sidang</td><td>:</td><td><select name="tanggal_bayar"><?php print $opt2; ?></select></td></tr>
					<tr><td> Hadir Atau Verstek</td><td>:</td><td><input type="text" name="hadir_atau_verstek"></td></tr>
					<tr><td> Denda</td><td>:</td><td><input type="text" name="denda"></td></tr>
					<tr><td> Ongkos Perkara</td><td>:</td><td><input type="text" name="ongkos_perkara"></td></tr>
					<tr><td> Subsidair</td><td>:</td><td><input type="text" name="subsidair"></td></tr>
					<tr><td> Tanggal Bayar</td><td>:</td><td><select name="tanggal_bayar"><?php print $opt2; ?></select></td></tr>
					<tr><td> Sisa Titipan</td><td>:</td><td><input type="text" name="sisa_titipan"></td></tr>
				</tbody>
				<tfoot>
					<tr><th colspan="3">
						<div style="margin-top:5%;">
							<input type="submit" name="simpan" value="Simpan">
						</div>
					</th></tr>
				</tfoot>
			</table>
		</form>
	</div>
</center>
</body>
</html>
