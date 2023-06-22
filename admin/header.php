<!DOCTYPE html>
<html>
<head>
	<?php 
	session_start();
	include 'config.php';
	?>
	<title>KUTTAB NURUSSALAM</title>
	<link href='../logo/kuttab.png' rel='shortcut icon'>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="../assets/js/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/jquery.js"></script>
	<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="../assets/js/jquery-ui/jquery-ui.js"></script>	
</head>
<body>
	<div class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="http://www.kuttabnurussalam.com" class="navbar-brand">KUTTAB NURUSSALAM - QUR'AN BASED ISLAMIC ELEMENTARY SCHOOL</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse">				
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a id="pesan_sedia" href="#" data-toggle="modal" data-target="#modalpesan"><span class='glyphicon glyphicon-comment'></span>  Pesan</a></li> -->
					<?php 
			$use=$_SESSION['uname'];
			$nm=mysql_query("select * from admin where uname='$use'");
			while($name=mysql_fetch_array($nm)){
				?>
					<li><a class="dropdown-toggle" role="button" href="#" data-toggle="modal" data-target="#modaluser">Hello, <?php echo $name['name']  ?>&nbsp&nbsp<span class="glyphicon glyphicon-user"></span></a>
					</li>
				
				</ul>
			</div>
		</div>
	</div>
	
	
	<!-- modal input -->
	<div id="modaluser" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">User Information</h4>
				</div>
				<div class="modal-body" >
				
				<a class="thumbnail"><img class="img-responsive" src="foto/<?php echo $name['foto']; ?>" ></a>
								
				<div align="center">
					<h4><label>User ID : 017.00<?php echo $name['id']; ?></label></h4>
				</div>
				<div  align="center">
					<h4><label>User Name : <?php echo $name['uname']; ?></label></h4>
				</div>
				<div align="center">
					<h2><label><?php echo $name['name']; ?></label></h2>
				</div>	
					
				<?php 
				}
				?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>						
				</div>
				
			</div>
		</div>
	</div>
	
	

	<!-- modal input -->
	<div id="modalpesan" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Pesan Notifikasi</h4>
				</div>
				<div class="modal-body">
					<?php 
					$periksa=mysql_query("select * from santri where ijin >=7");
					while($q=mysql_fetch_array($periksa)){	
						if($q['ijin']>=7){			
							echo "<div style='padding:5px' class='alert alert-warning'><span class='glyphicon glyphicon-info-sign'></span> Perijinan untuk  <a style='color:red'>". $q['nama']."</a> sudah masuk limit. Tidak ada lagi ijin pulang !!</div>";	
						}
					}
					?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>						
				</div>
				
			</div>
		</div>
	</div>

	<div class="col-md-2">
		<div class="row">
				<h1 class="animated flipInX"><div class="col-xs-6 col-md-12">
					<a class="thumbnail">
						<img class="img-responsive" src="kuttab.png">
					</a>
				</div></h1>
		</div>

		<div class="row"></div>
		<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span>  Dashboard</a></li>			
			<li class=""><a href="santri.php"><span class="glyphicon glyphicon-briefcase"></span>  Data Santri</a></li>
			<li class=""><a href="pay.php"><span class="glyphicon glyphicon-briefcase"></span>  Payment</a></li>        												
			<li class=""><a href="finance.php"><span class="glyphicon glyphicon-briefcase"></span>  Finance</a></li>
			<li class=""><a href="bank.php"><span class="glyphicon glyphicon-briefcase"></span>  Banking</a></li>
			<li class=""><a href="ganti_pass.php"><span class="glyphicon glyphicon-lock"></span> Change Password</a></li>
			<li class=""><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>			
		</ul>
	</div>
	<div class="col-md-10">
