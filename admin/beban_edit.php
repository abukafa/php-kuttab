<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Beban</h3>
<a class="btn" href="beban.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>

<?php
$no=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from beban where no='$no'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>	
					
	<form action="beban_update.php" method="post">
		<table class="table">
				<input type="hidden" class="form-control" name="no" value="<?php echo $d['no'] ?>" readonly=yes>
		
				<td>Nomor Induk Santri</td>
				<td><select name="nis" id="nis" class="form-control" onchange="changeValue(this.value)">
							<option value="<?php echo $d['nis'] ?>"><?php echo $d['nis'] ?></option>
								<?php 
								$brg=mysql_query("select * from santri");
								$jsArray = "var sant = new Array();\n";        
								while($b=mysql_fetch_array($brg)){
								echo '<option value="' . $b['nis'] . '">' . $b['nis'] . '</option>';
								$jsArray .= "sant['" . $b['nis'] . "'] = {nama:'" . addslashes($b['nama']) . "'};\n";
								}
								?>
							</select>

				<td>Nama Santri</td>
				<td><input type="text" class="form-control" name="nama" id="nama" value="<?php echo $d['nama'] ?>" readonly=yes></td>		
					

                        <script type="text/javascript">    
						<?php echo $jsArray; ?>  
						function changeValue(nis){  
						document.getElementById('nama').value = sant[nis].nama;
						};  
						</script>


			</tr>
			<tr>	
				<td>Tahun</td>
				<td><select name="thn" class="form-control" value="-">
					<option><?php echo $d['thn'] ?></option>
					<?php
						for($i=2017; $i<=date('Y')+2; $i++){
						echo"<option value='$i'> $i </option>";
						}
						?>
				</select></td>
				
				<td>Keterangan</td>
				<td><input type="text" class="form-control" name="ket" value="<?php echo $d['ket'] ?>"></td>
			</tr>
			<tr>
				<td>SPP</td>
				<td><input type="text" class="form-control" name="spp" value="<?php echo $d['spp'] ?>"></td>
				
				<td>Uang Makan</td>
				<td><input type="text" class="form-control" name="makan" value="<?php echo $d['makan'] ?>"></td>
			</tr>
			<tr>	
				<td>Asrama</td>
				<td><input type="text" class="form-control" name="asrama" value="<?php echo $d['asrama'] ?>"></td>
			</tr>
			<tr>		
				<td>Bangunan</td>
				<td><input type="text" class="form-control" name="bangunan" value="<?php echo $d['bangunan'] ?>"></td>
				
				<td>Pendidikan</td>
				<td><input type="text" class="form-control" name="pendidikan" value="<?php echo $d['pendidikan'] ?>"></td>
				
			</tr>
			<tr>		
				<td>Pendaftaran</td>
				<td><input type="text" class="form-control" name="daftar" value="<?php echo $d['daftar'] ?>"></td>
				
				<td>Seragam</td>
				<td><input type="text" class="form-control" name="seragam" value="<?php echo $d['seragam'] ?>"></td>
				
			</tr>
				
				<td></td><td></td><td></td>
				<td><input type="submit" class="btn btn-info pull-right" value="Simpan"></td>
			</tr>
		</table>
	</form>
<?php
}
?>
