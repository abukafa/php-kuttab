<?php
include 'header.php';
?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Exception</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-danger col-md-2"><span class="glyphicon glyphicon-plus"></span>Add Data</button></h3>
<a class="btn" href="pay.php"><span class="glyphicon glyphicon-arrow-left"></span>  Back To Payment</a>
<a class="btn" href="beban.php"><span class="glyphicon glyphicon-arrow-right"></span>  Lihat data Beban</a>

<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-question-sign"></span></span>
		<select type="submit" name="thn" class="form-control" onchange="this.form.submit()">
			<option>.. Tahun ..</option>
			<?php 
			$pil=mysql_query("select distinct thn from exception order by thn desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['thn'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>
</form>

<br/>
<?php 
if(isset($_GET['thn'])){
	echo "<h4> Data Tahun  <a style='color:blue'> ". $_GET['thn']."</a></h4>";
}
?>
<table class="table table-hover">
	<tr>
		<th class="col-md-0.5">No</th>
		<th class="col-md-1">NIS</th>
		<th class="col-md-3">Nama Santri</th>
		<th class="col-md-0.5">Tahun</th>
		<th class="col-md-3">Keterangan</th>
		<td align="right">SPP</td>
		<td align="right">Makan</td>
		<td align="right">Asrama</td>
		<td align="right">Daftar Ulang</td>
	</tr>
	<?php 
	if(isset($_GET['thn'])){
		$tah=mysql_real_escape_string($_GET['thn']);
		$brg=mysql_query("select * from exception where thn = '$tah' order by thn desc");
	}else{
		$brg=mysql_query("select * from exception order by thn desc");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){
			$jml=$b['daftar']+$b['bangunan']+$b['pendidikan']+$b['seragam'];
		?>
		<tr>
			<td><a href="exc_edit.php?no=<?php echo $b['no']; ?>"><?php echo $b['no'] ?></a></td>
			<td><?php echo $b['nis'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['thn'] ?></td>
			<td><?php echo $b['ket'] ?></td>
			<td align="right"><?php echo number_format($b['spp'],0,'',',') ?></td>
			<td align="right"><?php echo number_format($b['makan'],0,'',',') ?></td>
			<td align="right"><?php echo number_format($b['asrama'],0,'',',') ?></td>
			<td align="right"><?php echo number_format($jml,0,'',',') ?></td>
		</tr>		
		<?php 
	}
	?>
</table>

<?php 
$per_hal=30;
$jumlah_record=mysql_query("SELECT COUNT(*) from santri");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<br/>
<td> <a style='color:blue'> <?php echo $jum; ?> Records in <?php echo $halaman; ?> pages </a></td>
<br/>
			
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
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
				<form action="exc_act.php" method="post">
					<div class="form-group">
							<label>Nomor Induk Santri</label>								
							<select name="nis" id="nis" class="form-control" onchange="changeValue(this.value)">
							<option value=0>-Pilih-</option>
								<?php 
								$brg=mysql_query("select * from santri");
								$jsArray = "var sant = new Array();\n";        
								while($b=mysql_fetch_array($brg)){
								echo '<option value="' . $b['nis'] . '">' . $b['nis'] . '</option>';
								$jsArray .= "sant['" . $b['nis'] . "'] = {nama:'" . addslashes($b['nama']) . "',kelas:'".addslashes($b['kelas']) . "',ket_wali:'".addslashes($b['ket_wali']) . "',ayah:'".addslashes($b['ayah']) . "'};\n";
								}
								?>
							</select>
					</div>
					<div class="form-group">
						<label>Nama Santri</label>
						<input name="nama" id="nama" type="text" class="form-control" readonly="yes">
					</div>
					<div class="form-group">
						<label>Kelas</label>
						<input name="kls" id="kls" type="text" class="form-control" readonly="yes">
					</div>
					<div class="form-group">
						<label>Tahun</label>
							<select name="thn" class="form-control" value="-">
							<option value="-">.. Tahun ..</option>
							<?php
								for($i=2017; $i<=date('Y')+2; $i++){
								echo"<option value='$i'> $i </option>";
								}
								?>
							</select>
						<div class="form-group">
							<label>Keterangan</label>
							<input name="ket" type="text" class="form-control" autocomplete="off" value="-" >
						</div>
					</div>
					
						<script type="text/javascript">    
						<?php echo $jsArray; ?>  
						function changeValue(nis){  
						document.getElementById('nama').value = sant[nis].nama;
						document.getElementById('kls').value = sant[nis].kelas;
						};  
						</script>
								
						<div class="form-group">
							<label>SPP</label>
							<input name="spp" type="text" class="form-control" autocomplete="off" value="0" >
						</div>
						<div class="form-group">
							<label>Uang Makan</label>
							<input name="makan" type="text" class="form-control" autocomplete="off" value="0" >
						</div>	
						<div class="form-group">
							<label>Asrama</label>
							<input name="asrama" type="text" class="form-control" autocomplete="off" value="0" >
						</div>		
						<div class="form-group">
							<label>Pendaftaran</label>
							<input name="daftar" type="text" class="form-control" autocomplete="off" value="0" >
						</div>		
					<div class="form-group">
						<label>Bangunan</label>
						<input name="bangunan" type="text" class="form-control" value="0" >
					</div>	
					<div class="form-group">
							<label>Pendidikan</label>
							<input name="pendidikan" type="text" class="form-control" value="0" > <!--onkeyup="this.value=numbe(this.value);"-->
						</div>
						<div class="form-group">
							<label>Seragam</label>
							<input name="seragam" type="text" class="form-control" value="0" autocomplete="off">
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
