<?php 
include 'config.php';
$no=$_POST['no'];
$nis=$_POST['nis'];
$nama=$_POST['nama'];
$thn=$_POST['thn'];
$ket=$_POST['ket'];
$spp=$_POST['spp'];
$makan=$_POST['makan'];
$asrama=$_POST['asrama'];
$daftar=$_POST['daftar'];
$bangunan=$_POST['bangunan'];
$pendidikan=$_POST['pendidikan'];
$seragam=$_POST['seragam'];

mysql_query("UPDATE `beban` SET `nis`='$nis', `nama`='$nama', `thn`='$thn', ket='$ket', spp='$spp', makan='$makan', asrama='$asrama', daftar='$daftar', bangunan='$bangunan', pendidikan='$pendidikan', seragam='$seragam' where no='$no'");
header("location:beban.php");
?>
