<?php 
include 'config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];
$panggil=$_POST['panggilan'];
$klamin=$_POST['kelamin'];
$kls=$_POST['kelas'];

mysql_query("insert into santri values('$id','$nama','$panggil','$klamin','$kls','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-')");
header("location:santri.php");
 ?>