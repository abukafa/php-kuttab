<?php include 'header.php';	?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Data Nilai Santri</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Add New Entry</button></h3>
<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-question-sign"></span></span>
		<select type="submit" name="kls" class="form-control" onchange="this.form.submit()">
			<option>Pilih Kelas ..</option>
			<?php 
			$pil=mysql_query("select distinct kelas from nilai order by kelas desc");
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
	$tg="lap_nilai_leger.php?kls='$kls'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Print Leger</a><?php
}else{
	$tg="lap_nilai_leger.php";
}
?>
<br/>
<?php 
if(isset($_GET['kls'])){
	echo "<h4> Data Nilai Santri Kelas  <a style='color:blue'> ". $_GET['kls']." Tahun ".date("Y")."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>NIS</th>
		<th>Nama</th>
		<th>Keterangan</th>
		<th>Tgl. Ijin</th>			
		<th>Batas Waktu</th>			
		<th>Check In</th>
		<th>Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['kls'])){
		$kls=mysql_real_escape_string($_GET['kls']);
		$brg=mysql_query("select * from perijinan where kelas = '$kls' order by kelas desc");
	}else{
		$brg=mysql_query("select * from perijinan order by kelas desc");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $b['no'] ?></td>
			<td><?php echo $b['id'] ?></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['ijin'] ?></td>
			<td><?php echo $b['tgl_awal'] ?></td>
			<td><?php echo $b['tgl_ahir'] ?></td>			
			<td><?php echo $b['tgl_cek'] ?></td>		
			<td>		
				<a href="edit_nilai.php?no=<?php echo $b['no']; ?>" class="btn btn-warning">Edit</a>
				<!-- <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_ijin.php?no=<?php echo $b['no']; ?>' }" class="btn btn-danger">Hapus</a> -->
				<a href="lap_nilai.php?no=<?php echo $b['no']; ?>"  target="_blank"  class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Print Nilai</a>
			</td>
		</tr>
		<?php 
	}
	?>
	
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Add New Entry Nilai
				</div>
				<div class="modal-body">				
					<form action="nilai_act.php" method="post">	
									
						<div class="form-group">
							<label>Nomor Induk Santri</label>								
							<select name="id" id="id" class="form-control" onchange="changeValue(this.value)">
							 <option value=0>-Pilih-</option>
							
								<?php 
								
								$brg=mysql_query("select * from santri");
								$jsArray = "var sant = new Array();\n";        
								while($b=mysql_fetch_array($brg)){
								echo '<option value="' . $b['id'] . '">' . $b['id'] . '</option>';
								$jsArray .= "sant['" . $b['id'] . "'] = {nama:'" . addslashes($b['nama']) . "',kelas:'".addslashes($b['kelas']) . "',asal:'".addslashes($b['asal'])."'};\n";
								}
								?>
							</select>
						</div>				
						<div class="form-group">
							<label>Nama</label>
							<input name="nama" type="text" class="form-control" id="nama" readonly="yes">
						</div>	
						<div class="form-group">
							<label>Kelas</label>
							<input name="kelas" type="text" class="form-control" id="kelas" autocomplete="off" readonly="yes">
						</div>									
						<div class="form-group">
							<label>Asal</label>
							<input name="asal" type="text" class="form-control" id="asal" autocomplete="off" readonly="yes" >
						</div>	

						<script type="text/javascript">    
						<?php echo $jsArray; ?>  
						function changeValue(id){  
						document.getElementById('nama').value = sant[id].nama;
						document.getElementById('kelas').value = sant[id].kelas;
						document.getElementById('asal').value = sant[id].asal;  
						};  
						</script>
										
						
						
						<div class="form-group">
							<label>Keterangan Ijin</label>
							<input name="ijin" type="text" class="form-control" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Alasan</label>
							<input name="alasan" type="text" class="form-control" autocomplete="off">
						</div>
						<div class="form-group">
							<label>Tanggal Ijin</label>
							<input name="tgl_awal" type="text" class="form-control" id="tgl_awal" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Batas Ijin</label>
							<input name="tgl_ahir" type="text" class="form-control" id="tgl_ahir" autocomplete="off">
						</div>			
						<div class="form-group">
							<label>Tanggal Check In</label>
							<input name="tgl_cek" type="text" class="form-control" id="tgl_cek" autocomplete="off">
						</div>													

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_awal").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_ahir").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_cek").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	</script>
	<?php include 'footer.php'; ?>