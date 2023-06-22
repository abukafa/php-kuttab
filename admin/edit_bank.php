<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Payment</h3>
<a class="btn" href="bank.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>
<?php
$id=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from tabungan where no='$id'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<form action="update_bank.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="no" value="<?php echo $d['no'] ?>"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td><input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $d['tgl'] ?>"></td>
			</tr>
			<tr>
				<td>Nomor Induk Santri</td>
				<td><input type="text" class="form-control" name="nis" value="<?php echo $d['nis'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Nama Wali</td>
				<td><input type="text" class="form-control" name="wali" value="<?php echo $d['wali'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Debit</td>
				<td><input type="text" class="form-control" name="debit" value="<?php echo $d['debit'] ?>"></td>
			</tr>
			<tr>
				<td>Kredit</td>
				<td><input type="text" class="form-control" name="kredit" value="<?php echo $d['kredit'] ?>"></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><input name="ket" type="text" class="form-control" value="<?php echo $d['ket'] ?>"></td>
			</tr>
				<tr>
					<td>Admin</td>
					<td><input type="admin" class="form-control" name="amon" value="<?php echo $d['admin'] ?>" readonly="yes"></td>
				</tr>
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
			$("#tgl").datepicker({dateFormat : 'yy-mm-dd'});							
		});

	</script>
<?php 
include 'footer.php';

?>
