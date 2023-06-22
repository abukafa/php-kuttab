<?php 
session_start();
include 'config.php';
$tgl=$_POST['tgl'];
$date=date_create($tgl);
$period=date_format($date, 'M Y');
$nis=$_POST['nis'];
$nama=$_POST['nama'];
$wali=$_POST['wali'];
$dbt=$_POST['debit'];
$kdt=$_POST['kredit'];
$ket=$_POST['ket'];

$use=$_SESSION['uname'];
$nm=mysql_query("select name from admin where uname='$use'");
while($name=mysql_fetch_array($nm)){
$admin=$name['name'];

mysql_query("insert into tabungan values(NULL, '$tgl', '$period', '$nis', '$nama','$wali','$dbt','$kdt','$ket', '$admin')")or die(mysql_error());
header("location:bank.php");
}
?>
