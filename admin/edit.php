<?php 
include 'header.php';
?>
<?php
$nis=mysql_real_escape_string($_GET['id']);
$det=mysql_query("select * from santri where nis='$nis'")or die(mysql_error());
while($d=mysql_fetch_array($det)){

if(file_exists("foto/" . $d['panggilan'] . ".JPG")){?>
<img class="img-responsive" src="foto/<?php echo $d['panggilan'] ?>.JPG" width="150" height="200" align="right"/>
<?php }else{ ?>
<img class="img-responsive" src="foto/no.png" width="150" height="200" align="right"/>
<?php
}
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Data Santri</h3>
<a class="btn" href="santri.php"><span class="glyphicon glyphicon-arrow-left"></span>  Go Back</a>

<br/>
<br/>
					
	<form action="update.php" method="post">
		<table class="table">

				<td>Nomor Induk</td>
				<td><input type="text" class="form-control" name="id" value="<?php echo $d['nis'] ?>" readonly=yes></td>		
			
				<!-- <td>Foto</td>
				<td><input type="file" class="form-control" name="foto" value="<?php echo $d['foto'] ?>"></td> -->
			
			<tr>
				<td>Nama Panggilan</td>
				<td><input type="text" class="form-control" name="panggilan" value="<?php echo $d['panggilan'] ?>"></td>
			
				<td style="font-weight: bold;">NAMA LENGKAP</td>
				<td><input type="text" class="form-control" name="nama" value="<?php echo $d['nama'] ?>"></td>
			
				<td>Jenis Kelamin</td>
				<td><?php if($d['kelamin']=='Laki-laki'){
							?><input type="radio" name="kelamin" value="Laki-laki" checked> Laki-laki<br/>
							  <input type="radio" name="kelamin" value="Perempuan"> Perempuan<br/>
					<?php }else{
							?><input type="radio" name="kelamin" value="Laki-laki" > Laki-laki<br/>
							  <input type="radio" name="kelamin" value="Perempuan" checked> Perempuan<br/>
					<?php
					} 
					?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td><select name="kelas" type="text" class="form-control">
					<option><?php echo $d['kelas'] ?></option>
					<option>Kuttab Awal 1A</option>	
					<option>Kuttab Awal 1B</option>	
					<option>Kuttab Awal 2A</option>		
					<option>Kuttab Awal 2B</option>		
					<option>Kuttab Awal 3A</option>		
					<option>Kuttab Awal 3B</option>		
					<option>Qonuni 1</option>
					<option>Qonuni 2</option>
					<option>Qonuni 3</option>
					<option>Kelas Khusus</option>
					<option>XXX</option>
				</select></td>
			
				<td>Tempat Lahir</td>
				<td><input type="text" class="form-control" name="tmp_lahir" value="<?php echo $d['tmp_lahir'] ?>"></td>
			
				<td>Tanggal Lahir</td>
				<td><input type="text" class="form-control" name="tgl_lahir" value="<?php echo $d['tgl_lahir'] ?>" id="tgl_lahir" autocomplete="off"></td>
			</tr>
			<tr>
				<td>Anak ke</td>
				<td><input type="text" class="form-control" name="anak_ke" value="<?php echo $d['anak_ke'] ?>"></td>
				
				<td>Dari (Jumlah saudara)</td>
				<td><input type="text" class="form-control" name="jml_sdr" value="<?php echo $d['jml_sdr'] ?>"></td>
			
				<td>Status_Keluarga</td>
				<td><select name="status_kel" type="text" class="form-control">
					<option><?php echo $d['status_kel'] ?></option>
					<option>Saudara Kandung</option>		
					<option>Saudara Tiri</option>		
					<option>Saudara Angkat</option>		
				</select></td>
			</tr>
			<tr>
				<td style="font-weight: bold;">ALAMAT</td>
				<td><input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>"></td>
			
				<td>Dusun</td>
				<td><input type="text" class="form-control" name="dusun" value="<?php echo $d['dusun'] ?>"></td>
			
				<td>Desa</td>
				<td><input type="text" class="form-control" name="desa" value="<?php echo $d['desa'] ?>"></td>
			</tr>
			<tr>
				<td>Kecamatan</td>
				<td><input type="text" class="form-control" name="kec" value="<?php echo $d['kec'] ?>"></td>
			
				<td>Kabupaten</td>
				<td><input type="text" class="form-control" name="kab" value="<?php echo $d['kab'] ?>"></td>
			
				<td>Kode Pos</td>
				<td><input type="text" class="form-control" name="kpos" value="<?php echo $d['kpos'] ?>"></td>
			</tr>
			<tr>	
				<td style="font-weight: bold;">HOBI ANAK</td>
				<td><input type="text" class="form-control" name="hobi" value="<?php echo $d['hobi'] ?>"></td>
				
				<td>Olah raga yg disukai</td>
				<td><input type="text" class="form-control" name="olah_raga" value="<?php echo $d['olah_raga'] ?>"></td>
				
				<td>Cita-cita</td>
				<td><input type="text" class="form-control" name="cita" value="<?php echo $d['cita'] ?>"></td>
			</tr>	
			<tr>	
				<td>Tinggi (cm)</td>
				<td><input type="text" class="form-control" name="tinggi" value="<?php echo $d['tinggi'] ?>"></td>
				
				<td>Berat Badan (kg)</td>
				<td><input type="text" class="form-control" name="berat" value="<?php echo $d['berat'] ?>"></td>
				
				<td>Jarak (km)</td>
				<td><input type="text" class="form-control" name="jarak" value="<?php echo $d['jarak'] ?>"></td>
			</tr>	
			<tr>	
				<td>Waktu tempuh</td>
				<td><input type="text" class="form-control" name="waktu" value="<?php echo $d['waktu'] ?>"></td>
			</tr>	
			<tr>	
				<td style="font-weight: bold;">NAMA AYAH</td>
				<td><input type="text" class="form-control" name="ayah" value="<?php echo $d['ayah'] ?>"></td>
				
				<td>Tempat Lahir </td>
				<td><input type="text" class="form-control" name="tmp_ayah" value="<?php echo $d['tmp_ayah'] ?>"></td>
				
				<td>Tanggal Lahir</td>
				<td><input type="text" class="form-control" name="tgl_ayah" value="<?php echo $d['tgl_ayah'] ?>" id="tgl_ayah" autocomplete="off"></td>
			</tr>	
			<tr>	
				<td>Pendidikan akhir</td>
				<td><input type="text" class="form-control" name="pend_ayah" value="<?php echo $d['pend_ayah'] ?>"></td>
				
				<td>Keterangan</td>
				<td><input type="text" class="form-control" name="ket_ayah" value="<?php echo $d['ket_ayah'] ?>"></td>
			</tr>	
			<tr>	
				<td style="font-weight: bold;">NAMA IBU</td>
				<td><input type="text" class="form-control" name="ibu" value="<?php echo $d['ibu'] ?>"></td>
				
				<td>Tempat Lahir </td>
				<td><input type="text" class="form-control" name="tmp_ibu" value="<?php echo $d['tmp_ibu'] ?>"></td>
				
				<td>Tanggal Lahir</td>
				<td><input type="text" class="form-control" name="tgl_ibu" value="<?php echo $d['tgl_ibu'] ?>" id="tgl_ibu" autocomplete="off"></td>
			</tr>	
			<tr>	
				<td>Pendidikan akhir</td>
				<td><input type="text" class="form-control" name="pend_ibu" value="<?php echo $d['pend_ibu'] ?>"></td>
				
				<td>Keterangan</td>
				<td><input type="text" class="form-control" name="ket_ibu" value="<?php echo $d['ket_ibu'] ?>"></td>
			</tr>	
			<tr>	
				<td>Pekerjaan</td>
				<td><input type="text" class="form-control" name="kerja" value="<?php echo $d['kerja'] ?>"></td>
				
				<td>Penghasilah perbulan</td>
			 	<td><select name="salary" type="text" class="form-control">
					<option><?php echo $d['salary'] ?></option>
					<option>Tidak ada</option>		
					<option>< 1.000.000</option>		
					<option>> 1.000.000</option>		
					<option>> 3.000.000</option>
					<option>> 5.000.000</option>
				</select></td>
				
				<td>No. Telepon</td>
				<td><input type="text" class="form-control" name="tlp" value="<?php echo $d['tlp'] ?>"></td>
			</tr>	
			<tr>	
				<td>Keterangan Wali</td>
				<td><input type="text" class="form-control" name="ket_wali" value="<?php echo $d['ket_wali'] ?>"></td>
			
				<td>Prestasi anak</td>
				<td><input type="text" class="form-control" name="prestasi" value="<?php echo $d['prestasi'] ?>"></td>
			</tr>	
			<tr>	
				<td>Penyakit_khusus</td>
				<td><input type="text" class="form-control" name="penyakit" value="<?php echo $d['penyakit'] ?>"></td>
				
				<td>Berkebutuhan_khusus</td>
				<td><input type="text" class="form-control" name="special" value="<?php echo $d['special'] ?>"></td>
				
				<td>Catatan</td>
				<td><input type="text" class="form-control" name="ket_santri" value="<?php echo $d['ket_santri'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_lahir").datepicker({dateFormat : 'd/m/yy'});							
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_ayah").datepicker({dateFormat : 'd/m/yy'});							
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl_ibu").datepicker({dateFormat : 'd/m/yy'});							
		});
	</script>
	<?php 
}
?>
<?php include 'footer.php'; ?>
