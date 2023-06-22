<?php 
include 'config.php';
$user=$_POST['user'];
$lama=($_POST['lama']);
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];

$cek=mysql_query("select * from admin where uname='$user' and pass='$lama'");
if(mysql_num_rows($cek)==1){
	if($baru==$ulang){
		$b =($baru);
		mysql_query("update admin set pass='$b' where uname='$user'");
		header("location:ganti_pass.php?pesan=oke");
	}else{
		header("location:ganti_pass.php?pesan=tdksama");
	}
}else{
	header("location:ganti_pass.php?pesan=gagal");
}

 ?>