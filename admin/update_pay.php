<?php 
session_start();
include 'config.php';
$no=$_POST['no'];
$tgl=$_POST['tgl'];
$date=date_create($tgl);
$period=date_format($date, 'M Y');
$nis=$_POST['nis'];
$nama=$_POST['nama'];
$wali=$_POST['ayah'];
$thn=$_POST['thn'];
$daftar=$_POST['daftar'];
$bangunan=$_POST['bangunan'];
$pendidikan=$_POST['pendidikan'];
$seragam=$_POST['seragam'];
$bln=$_POST['bln'];
$spp=$_POST['spp'];
$makan=$_POST['makan'];
$lain=$_POST['lain'];
$ket=$_POST['ket'];
$jumlah=$daftar + $bangunan + $pendidikan + $seragam + $spp + $makan + $lain;

$use=$_SESSION['uname'];
$nm=mysql_query("select name from admin where uname='$use'");
while($name=mysql_fetch_array($nm)){
$admin=$name['name'];

mysql_query("update bayaran set tgl='$tgl', period='$period', nis='$nis', nama='$nama', wali='$wali', thn='$thn', daftar='$daftar', bangunan='$bangunan', pendidikan='$pendidikan', seragam='$seragam', bln='$bln', spp='$spp', makan='$makan', lain='$lain', ket='$ket', jumlah='$jumlah', admin='$admin' where no='$no' ");
header("location:pay.php");
}
?>
