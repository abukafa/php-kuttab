<?php include 'header.php';	?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Data Pembayaran Santri</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  New Payment</button></h3>
<a class="btn" href="beban.php"><span class="glyphicon glyphicon-arrow-right"></span>  Lihat data Beban</a>

<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tgl_awal" class="form-control">
			<option>.. Tgl Awal ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl from bayaran order by tgl desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tgl'] ?></option>
				<?php
			}
			?>			
		</select>
		<select type="submit" name="tgl_ahir" class="form-control" onchange="this.form.submit()">
			<option>.. Tgl Ahir ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl from bayaran order by tgl desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tgl'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>
</form>
<br/>

<?php 
if(isset($_GET['tgl_ahir'])){
	$awl=mysql_real_escape_string($_GET['tgl_awal']);
	$ahr=mysql_real_escape_string($_GET['tgl_ahir']);
	$dte=date_create($ahr);
	$bl=date_format($dte,"m")+0;
	if( $bl < 7 ){
		$yr=date_format($dte,"Y")-1;
	}else{
		$yr=date_format($dte,"Y");
	}
	$tg="lap_pay.php?tgl_awal=$awl&tgl_ahir=$ahr";
	$tg3="lap_pay3.php";
	$tg4="lap_pay5.php?thn='$yr'";
	?><a style="margin-bottom:10px" href="<?php echo $tg4 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Outstanding</a>
	<a style="margin-bottom:10px" href="<?php echo $tg3 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Summary</a>
	<th><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Report</a></th><?php
}else{
	$tg="lap_pay.php";
	$tg3="lap_pay3.php";
	$tg4="lap_pay5.php";
}
?>

<br/>
<?php 
if(isset($_GET['tgl_ahir'])){
	echo "<h4> Data Pembayaran Tanggal <a style='color:blue'>". $_GET['tgl_awal']." s.d. ". $_GET['tgl_ahir'].$bl."</a></h4>";
}else{ ?>
	<a class="btn" href="paysearch.php"><span class="glyphicon glyphicon-arrow-right"></span>  Pencarian</a>
<?php 
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>NIS</th>
		<th>Nama</th>
		<th>Wali</th>
		<th>Pemb. Tahun</th>			
		<th>Pemb. Bulan</th>			
		<th>jumlah</th>
		<th>Keterangan</th>
		<th>Opsi</th>
	</tr>
	<?php 
	
$per_hal=30;
$jumlah_record=mysql_query("SELECT COUNT(*) from bayaran");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	
	if(isset($_GET['tgl_ahir'])){
		$awl=mysql_real_escape_string($_GET['tgl_awal']);
		$ahr=mysql_real_escape_string($_GET['tgl_ahir']);
		$brg=mysql_query("select * from bayaran where tgl between '$awl' and '$ahr' order by tgl");
	}else{
		$brg=mysql_query("select * from bayaran order by no desc limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){
		?>
		<tr>
			<td><?php echo $b['no'] ?></td>
			<td><?php echo $b['tgl'] ?></td>
			<?php	
			$nis=$b['nis'];
			$y=$b['thn'];
			$tang=getdate();
			$yer=$tang['year'];
			$tgg="lap_pay4.php?nis='$nis'&yer='$y'"; ?>
			<td><a href="<?php echo $tgg ?>"   target="_blank" ><?php echo $b['nis'] ?></a></td>
			<td><?php echo substr($b['nama'], 0, 20) ?></td>
			<td><?php echo substr($b['wali'], 0, 10) ?></td>
			<td><?php echo $b['thn'] ?></td>
			<td><?php echo $b['bln'] ?></td>			
			<td align="right"><?php echo number_format($b['jumlah'],0,'',','); ?></td>		
			<td><?php echo $b['ket'] ?></td>
			<td>		
				<a href="edit_pay.php?no=<?php echo $b['no']; ?>" class="btn btn-warning">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_pay.php?no=<?php echo $b['no']; ?>' }" class="btn btn-danger">Delete</a>
				<a href="lap_struk.php?no=<?php echo $b['no']; ?>"  target="_blank"  class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span> Struk</a>
			</td>
		</tr>
		<?php 
	}
	$tg="lap_pay4.php";
	?>
	
</table>

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
				<h4 class="modal-title">Add New Payment
				</div>
				<div class="modal-body">				
					<form action="pay_act.php" method="post">	
					
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>			
						<div class="form-group">
							<label>Nomor Induk Santri</label>								
							<select name="nis" id="nis" class="form-control" onchange="changeValue(this.value)">
							 <option value=0>-Pilih-</option>
							
								<?php 
								
								$brg=mysql_query("select * from santri order by panggilan");
								$jsArray = "var sant = new Array();\n";        
								while($b=mysql_fetch_array($brg)){
								echo '<option value="' . $b['nis'] . '">' . $b['nis'] ." ". $b['panggilan'] .  '</option>';
								$jsArray .= "sant['" . $b['nis'] . "'] = {nama:'" . addslashes($b['nama']) . "',ket_wali:'".addslashes($b['ket_wali']) . "'};\n";
								}
								?>
							</select>
						</div>				
						<div class="form-group">
							<label>Nama</label>
							<input name="nama" type="text" class="form-control" id="nama" readonly="yes">
						</div>	
						<div class="form-group">
							<label>Nama Wali</label>
							<input name="ayah" type="text" class="form-control" id="ayah" readonly="yes">
						</div>	

						<script type="text/javascript">    
						<?php echo $jsArray; ?>  
						function changeValue(nis){  
						document.getElementById('nama').value = sant[nis].nama;
						document.getElementById('ayah').value = sant[nis].ket_wali;
						};  
						</script>
										
						<?php $mynum = 1234.56; ?>
						
						<div class="form-group">
							<label>Keterangan Tahun -- HARUS DIISI! --</label>
							<!--input name="tahun" type="text" class="form-control" value="-"-->
							
							<select name="tahun" class="form-control" value="-">
							<option value="-">Tahun</option>
							<?php
								for($i=2017; $i<=date('Y')+2; $i++){
								echo"<option value='$i'> $i </option>";
								}
								?>
							</select>
							
						</div>	
						<div class="form-group">
							<label>Pendaftaran</label>
							<input name="daftar" id="daftar" type="text" class="form-control" value="0" > <!--onkeyup="this.value=numbe(this.value);"-->
						</div>
						<div class="form-group">
							<label>Infaq Bangunan</label>
							<input name="bangunan" id="bangunan" type="text" class="form-control" value="0" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Infaq Pendidikan</label>
							<input name="pendidikan" id="pendidikan" type="text" class="form-control" value="0" autocomplete="off">
						</div>			
						<div class="form-group">
							<label>Seragam</label>
							<input name="seragam" id="seragam" type="text" class="form-control" value="0" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Keterangan Bulan (unt Pembayaran SPP Bulanan)</label>
							<select name="bln" type="text" class="form-control" value="-" >
							<option value="-">Bulan</option>
							<?php
							$bulan=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
							$jlh_bln=count($bulan);
								for($i=2017; $i<=date('Y')+2; $i++){
							for($c=0; $c<$jlh_bln; $c+=1){
								    echo"<option value=$bulan[$c]-$i> $bulan[$c]-$i </option>";
								    }
								}
								    ?>
								    </select>
														
						</div>	
						<div class="form-group">
							<label>SPP</label>
							<input name="spp" type="text" class="form-control" autocomplete="off" value="0" >
						</div>
						<div class="form-group">
							<label>Uang Makan</label>
							<input name="makan" type="text" class="form-control" autocomplete="off" value="0" >
						</div>	
						<div class="form-group">
							<label>Lain-Lain</label>
							<input name="lain" type="text" class="form-control" autocomplete="off" value="0" >
						</div>			
						<div class="form-group">
							<label>Keterangan</label>
							<input name="ket" type="text" class="form-control" autocomplete="off" value="-" >
						</div>			
						<div class="form-group">
							<label></label>
							<input name="jumlah" id="jumlah" type="hidden" class="form-control" readonly="yes">
						</div>
						
						<script>
						function numbe(nStr){
						nStr += '';
						x = nStr.split('.');
						x1 = x[000];
						x2 = x.length > 1 ? '.' + x[1] : '';
						var rgx = /(\d+)(\d{3})/;
						while (rgx.test(x1)) {
							x1 = x1.replace(rgx, '$1' + ',' + '$2');
						}
						return x1 + x2;
						}
						</script>
						
						<script type="text/javascript">    
						document.getElementById("jumlah").addeventlistener("clickValue", show_sum);
						function show_sum(){
						var df = document.getElementById("daftar").value
						var bg = document.getElementById("bangunan").value
						var pd = document.getElementById("pendidikan").value
						var sr = document.getElementById("seragam").value
						document.getElementById("jumlah").value = df + bg + pd + sr ;
						};  
						</script>
						
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
			$("#tgl").datepicker({dateFormat : 'yy-mm-dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>
