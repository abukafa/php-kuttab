<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Transaction</h3>
<a class="btn" href="finance.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>
<?php
$id=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from finance where no='$id'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<form action="update_finance.php" method="post">
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="no" value="<?php echo $d['no'] ?>"></td>
			</tr>
			<tr>
				<td>Date</td>
				<td><input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo $d['tgl'] ?>"></td>
			</tr>
			<tr>
				<td>Account</td>
				<td><select name="akun" class="form-control">
					<option selected="selected"><?php echo $d['akun'] ?></option>
							<option value="-">--Akun--</option>
							<option value="000221">000221 - Biaya Administrasi</option>
							<option value="000222">000222 - Biaya Pembangunan</option>
							<option value="000223">000223 - Biaya Pendidikan</option>
							<option value="000224">000224 - Biaya Seragam</option>
							<option value="000225">000225 - Biaya Pembinaan</option>
							<option value="000226">000226 - Biaya Dapur</option>
							<option value="000227">000227 - Biaya Operasional</option>
							<option value="000228">000228 - Biaya Asrama</option>
							<option value="777199">777199 - Pemasukan</option>
					</select></td>
			</tr>
			<tr>
				<td>Vendor</td>
				<td><input type="text" class="form-control" name="vendor" value="<?php echo $d['vendor'] ?>" ></td>
			</tr>
			<tr>
				<td>Description</td>
				<td><input type="text" class="form-control" name="uraian" value="<?php echo $d['uraian'] ?>" ></td>
			</tr>
			<tr>
				<td>Remark</td>
				<td><input type="text" class="form-control" name="ket" value="<?php echo $d['ket'] ?>"></td>
			</tr>
			
			<?php
			if (substr($d['akun'], 0, 3) == 777){
				?>
				<tr>
					<td>Amount</td>
					<td><input type="text" class="form-control" name="amon" value="<?php echo $d['debit'] ?>"></td>
				</tr>
			<?php
			}else{
				?>
				<tr>
					<td>Amount</td>
					<td><input type="text" class="form-control" name="amon" value="<?php echo $d['kredit'] ?>"></td>
				</tr>
	
			<?php
			}
			?>
				<tr>
					<td>Admin</td>
					<td><input type="admin" class="form-control" name="admin" value="<?php echo $d['admin'] ?>" readonly="yes"></td>
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
