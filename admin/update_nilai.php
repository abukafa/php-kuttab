<?php 
include 'config.php';
$no=$_POST['no'];
$id=$_POST['id'];
$nama=$_POST['nama'];
$kelas=$_POST['kelas'];
$asal=$_POST['asal'];
$ijin=$_POST['ijin'];
$alasan=$_POST['alasan'];
$tgl_awal=$_POST['tgl_awal'];
$tgl_ahir=$_POST['tgl_ahir'];
$tgl_cek=$_POST['tgl_cek'];

mysql_query("update perijinan set id='$id', nama='$nama', kelas='$kelas', asal='$asal', ijin='$ijin', alasan='$alasan', tgl_awal='$tgl_awal', tgl_ahir='$tgl_ahir', tgl_cek='$tgl_cek' where no='$no'");
header("location:nilai.php");

?>