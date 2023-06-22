<?php include 'header.php'; ?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Data Santri</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Santri</button></h3>

<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-question-sign"></span></span>
		<select type="submit" name="kls" class="form-control" onchange="this.form.submit()">
			<option>Pilih Kelas ..</option>
			<?php 
			$pil=mysql_query("select distinct kelas from santri order by kelas desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['kelas'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>
</form>
<br/>
<?php 
if(isset($_GET['kls'])){
	$kls=mysql_real_escape_string($_GET['kls']);
	$tg1="lap_santri.php?kls='$kls'";
	$tg2="data_santri.php";
	?><a style="margin-bottom:10px" href="<?php echo $tg1 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak Absen</a>
	<a style="margin-bottom:10px" href="<?php echo $tg2 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Data Santri</a><?php
}else{
	$tg1="lap_santri.php";
}
?>

<br/>
<?php 
if(isset($_GET['kls'])){
	echo "<h4> Data Santri Kelas  <a style='color:blue'> ". $_GET['kls']." Tahun ".date("Y")."</a></h4>";
}
?>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">NIS</th>
		<th class="col-md-3">Nama Santri</th>
		<th class="col-md-1">Panggilan</th>
		<th class="col-md-1.2">Kelas</th>
		<th class="col-md-1.5">Kota Asal</th>
		<th class="col-md-1.5">Nama Wali</th>
		<!-- <th class="col-md-1">Sisa</th>		 -->
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
	
$per_hal=30;
$jumlah_record=mysql_query("SELECT COUNT(*) from santri");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;

	if(isset($_GET['kls'])){
		$kls=mysql_real_escape_string($_GET['kls']);
		$brg=mysql_query("select * from santri where kelas = '$kls' order by nama");
	}else{
		$brg=mysql_query("select * from santri order by nis desc limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $b['nis'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['panggilan'] ?></td>
			<td><?php echo $b['kelas'] ?></td>
			<td><?php echo $b['kab'] ?></td>
			<td><?php echo $b['ket_wali'] ?></td>
			<td>
				<!-- <a href="det_Santri.php?id=<?php echo $b['nis']; ?>" class="btn btn-info">Detail</a> -->
				<a href="edit.php?id=<?php echo $b['nis']; ?>" class="btn btn-warning">Edit Data</a>
				<!-- <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['nis']; ?>' }" class="btn btn-danger">Hapus</a> -->
				<a href="lap_data_santri.php?id=<?php echo $b['nis']; ?>"  target="_blank"  class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Data Santri</a>
			</td>
		</tr>		
		<?php 
	}
	?>
</table>

<td><a href="http://localhost/phpmyadmin/db_structure.php?server=1&db=kuttab&token=053bcc65b5a44982d541a2ee3ffafa7b"  target="_blank" >Open Database</a></td>


<br/>
<td> <a style='color:blue'> <?php echo $jum; ?> Records in <?php echo $halaman; ?> pages </a></td>
<br/>
			
<ul class="pagination">			
	<li><a href="?page=1">First</a></li>					
	<li class="<?php if ($page <= 1) { echo 'disable'; } ?>">
		<a href="<?php if ($page <= 1 ){ echo '#'; } else { echo "?page=". ($page - 1); } ?>"><<</a>
	</li>
	<li class="disable"><a><?php echo $page; ?></a></li>					
	<li class="<?php if ($page >= $halaman) { echo 'disable'; } ?>">
		<a href="<?php if ($page >= $halaman ){ echo '#'; } else { echo "?page=". ($page + 1); } ?>">>></a>
	</li>
	<li><a href="?page=<?php echo $halaman ?>">Last</a></li>			
</ul>


<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Santri Baru</h4>
			</div>
			<div class="modal-body">
				<form action="santri_act.php" method="post">
					<div class="form-group">
						<label>Nomor Induk Santri</label>
						<input name="id" type="text" class="form-control" placeholder="NIS ..">
					</div>
					<div class="form-group">
						<label>Nama Santri</label>
						<input name="nama" type="text" class="form-control" placeholder="diisi dengan Nama Lengkap ..">
					</div>
					<div class="form-group">
						<label>Nama Panggilan</label>
						<input name="panggilan" type="text" class="form-control" placeholder="Nama Panggilan sehari-hari ..">
					</div>
					<div class="form-group">
						<label>Jenis Kelamin</label>
						<select name="kelamin" type="text" class="form-control">
							<option value="">.. Pilih ..</option>
							<option>Laki-laki</option>		
							<option>Perempuan</option>		
						</select>
					</div>
					<div class="form-group">
						<label>Masuk Kuttab di Kelas</label>
						<select name="kelas" type="text" class="form-control">
						<option value="">.. Pilih ..</option>
							<option>Kuttab Awal 1</option>		
							<option>Kuttab Awal 2</option>		
							<option>Kuttab Awal 3</option>		
							<option>Qonuni 1</option>
							<option>Qonuni 2</option>
							<option>Qonuni 3</option>
							<option>Kelas Khusus</option>
						</select>
					</div>	
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>
