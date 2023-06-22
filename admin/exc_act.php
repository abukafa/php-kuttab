<?php 
include 'config.php';
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

mysql_query("insert into exception values(NULL, '$nis', '$nama', '$thn', '$ket', '$daftar', '$bangunan', '$pendidikan', '$seragam','$spp', '$makan', '$asrama')")or die(mysql_error());


header("location:exc.php");
?>
