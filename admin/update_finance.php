<?php 
session_start();
include 'config.php';
$no=$_POST['no'];
$tgl=$_POST['tgl'];
$date=date_create($tgl);
$period=date_format($date, 'M Y');
$akun=$_POST['akun'];
$vend=$_POST['vendor'];
$urai=$_POST['uraian'];
$ket=$_POST['ket'];

if (substr($akun, 0, 3) == 777){
	$dbt=$_POST['amon'];
	$kdt=0;
} 
else {
	$dbt=0;
	$kdt=$_POST['amon'];
}

$use=$_SESSION['uname'];
$nm=mysql_query("select name from admin where uname='$use'");
while($name=mysql_fetch_array($nm)){
$admin=$name['name'];

mysql_query("update finance set tgl='$tgl', period='$period', akun='$akun', vendor='$vend', uraian='$urai', ket='$ket', debit='$dbt', kredit='$kdt', admin='$admin' where no='$no' ");
header("location:finance.php");
}
?>
