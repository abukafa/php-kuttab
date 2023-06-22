<?php 
include 'config.php';
$tgl=$_POST['tgl'];
$nis=$_POST['nis'];
$nama=$_POST['nama'];
$wali=$_POST['ayah'];
$thn=$_POST['tahun'];
$daftar=$_POST['daftar'];
$bangunan=$_POST['bangunan'];
$pendidikan=$_POST['pendidikan'];
$seragam=$_POST['seragam'];
$bln=$_POST['bln'];
$spp=$_POST['spp'];
$makan=$_POST['makan'];
$lain=$_POST['lain'];
$ket=$_POST['ket'];
$jumlah=$daftar + $bangunan + $pendidikan + $seragam;

mysql_query("insert into nilai values('','$tgl', '$nis', '$nama','$wali','$thn','$daftar','$bangunan', '$pendidikan', '$seragam', '$bln', '$spp', '$makan', '$lain', '$ket', '$jumlah')")or die(mysql_error());
header("location:nilai.php");

?>