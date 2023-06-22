<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Payment</h3>
<a class="btn" href="pay.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>
<?php
$id=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from bayaran where no='$id'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<form action="update_pay.php" method="post">
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
				<td><input type="text" class="form-control" name="ayah" value="<?php echo $d['wali'] ?>" readonly="yes"></td>
			</tr>
			<tr>
				<td>Keterangan Tahun (unt Pembayaran Daftar Ulang)</td>
				<td><select name="thn" class="form-control" value="-">
					<option selected="selected"><?php echo $d['thn'] ?></option>
						<?php
							for($i=2017; $i<=date('Y')+2; $i++){
							echo"<option value='$i'> $i </option>";
							}
							?>
						</select></td>
			</tr>
			<tr>
				<td>Pendaftaran</td>
				<td><input type="text" class="form-control" name="daftar" value="<?php echo $d['daftar'] ?>"></td>
			</tr>
			<tr>
				<td>Infaq Bangunan</td>
				<td><input type="text" class="form-control" name="bangunan" value="<?php echo $d['bangunan'] ?>"></td>
			</tr>
			<tr>
				<td>Infaq Pendidikan</td>
				<td><input name="pendidikan" type="text" class="form-control" value="<?php echo $d['pendidikan'] ?>"></td>
			</tr>
			<tr>
				<td>Seragam</td>
				<td><input name="seragam" type="text" class="form-control" value="<?php echo $d['seragam'] ?>"></td>
			</tr>
			<tr>
				<td>Keterangan Bulan (unt Pembayaran SPP Bulanan)</td>
				<td><select name="bln" type="text" class="form-control">
							<option selected="selected"><?php echo $d['bln'] ?></option>
							<?php
							$bulan=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
							$jlh_bln=count($bulan);
								for($i=2017; $i<=date('Y')+2; $i++){
							for($c=0; $c<$jlh_bln; $c+=1){
								    echo"<option value=$bulan[$c]-$i> $bulan[$c]-$i </option>";
								    }
								}
								    ?>
								    </select></td>
				
			</tr>
			<tr>
				<td>SPP</td>
				<td><input name="spp" type="text" class="form-control" value="<?php echo $d['spp'] ?>"></td>
			</tr>
			<tr>
				<td>Uang Makan</td>
				<td><input name="makan" type="text" class="form-control" value="<?php echo $d['makan'] ?>"></td>
			</tr>
			<tr>
				<td>Lain-Lain</td>
				<td><input name="lain" type="text" class="form-control" value="<?php echo $d['lain'] ?>"></td>
			</tr>
			<tr>
				<td>Keterangan</td>
				<td><input name="ket" type="text" class="form-control" value="<?php echo $d['ket'] ?>"></td>
			</tr>
			<tr>
				<td>Admin</td>
				<td><input name="admin" type="text" class="form-control" value="<?php echo $d['admin'] ?>" readonly="yes"></td>
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
			$("#tgl").datepicker({dateFormat : 'yy-mm-dd'});							
		});

	</script>
<?php 
include 'footer.php';

?>
