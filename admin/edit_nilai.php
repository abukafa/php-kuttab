<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Entri Nilai</h3>
<a class="btn" href="nilai.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>
<?php
$id_brg=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from perijinan where no='$id_brg'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<form action="update_nilai.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="no" value="<?php echo $d['no'] ?>"></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td><input type="text" class="form-control" name="id" value="<?php echo $d['id'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td><input type="text" class="form-control" name="kelas" value="<?php echo $d['kelas'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Asal</td>
				<td><input type="text" class="form-control" name="asal" value="<?php echo $d['asal'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Keterangan Ijin</td>
				<td><input type="text" class="form-control" name="ijin" value="<?php echo $d['ijin'] ?>"></td>
			</tr>
			<tr>
				<td>Alasan</td>
				<td><input type="text" class="form-control" name="alasan" value="<?php echo $d['alasan'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal Ijin</td>
				<td><input name="tgl_awal" type="text" class="form-control" id="tgl_awal" autocomplete="off" value="<?php echo $d['tgl_awal'] ?>"></td>
			</tr>
			<tr>
				<td>Batas Ijin</td>
				<td><input name="tgl_ahir" type="text" class="form-control" id="tgl_ahir" autocomplete="off" value="<?php echo $d['tgl_ahir'] ?>"></td>
			</tr>
			<tr>
				<td>Check In</td>
				<td><input name="tgl_cek" type="text" class="form-control" id="tgl_cek" autocomplete="off" value="<?php echo $d['tgl_cek'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_awal").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	
		$(document).ready(function(){
			$("#tgl_ahir").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	
		$(document).ready(function(){
			$("#tgl_cek").datepicker({dateFormat : 'dd/mm/yy'});							
		});
	</script>
<?php 
include 'footer.php';

?>