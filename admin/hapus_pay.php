<?php 
include 'config.php';
$no=$_GET['no'];

mysql_query("delete from bayaran where no='$no'")or die(mysql_error());
header("location:pay.php");

 ?>
