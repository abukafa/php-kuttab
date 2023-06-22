<?php include 'header.php';	?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  TABUNGAN SANTRI</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  New Transaction</button></h3>

<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tgl_awal" class="form-control">
			<option>.. Tgl Awal ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl from tabungan order by tgl desc");
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
			$pil=mysql_query("select distinct tgl from tabungan order by tgl desc");
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
	$tg="lap_bank.php?tgl_awal=$awl&tgl_ahir=$ahr";
	$tg3="lap_bank3.php?tgl_awal=$awl&tgl_ahir=$ahr";
	$tg4="lap_bank4.php?period='$ahr'";
	?><a style="margin-bottom:10px" href="<?php echo $tg3 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Summary</a>
	<a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Report</a>
	<th><a style="margin-bottom:10px" href="<?php echo $tg4 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Daily</a></th><?php
}else{
	$tg="lap_bank.php";
	$tg3="lap_bank3.php";
	$tg4="lap_bank4.php";
}
?>

<br/>
<?php 
if(isset($_GET['tgl_ahir'])){
	echo "<h4> Data Tabungan Santri Tanggal <a style='color:blue'>". $_GET['tgl_awal']." s.d. ". $_GET['tgl_ahir']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>NIS</th>
		<th>Nama</th>
		<th>Wali</th>
		<td align="right" style="font-weight:bold">Debit</td>			
		<td align="right" style="font-weight:bold">Kredit</td>
		<td align="right" style="font-weight:bold">Saldo</td>		
		<td align="center" style="font-weight:bold">Opsi</td>
	</tr>
	<?php 
$per_hal=30;
$jumlah_record=mysql_query("SELECT COUNT(*) from tabungan");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	if(isset($_GET['tgl_ahir'])){
		$awl=mysql_real_escape_string($_GET['tgl_awal']);
		$ahr=mysql_real_escape_string($_GET['tgl_ahir']);
		$brg=mysql_query("select * from tabungan where tgl between '$awl' and '$ahr' order by tgl");
	}else{
		$brg=mysql_query("select * from tabungan order by no desc limit $start, $per_hal");
	}
	while($b=mysql_fetch_array($brg)){
		?>
		<tr>
			<td><?php echo $b['no'] ?></td>
			<td><?php echo $b['tgl'] ?></td>
			<td><a href="lap_bank2.php?nis='<?php echo $b['nis']; ?>'"   target="_blank" ><?php echo $b['nis'] ?></a></td>
			
			<td><?php echo substr($b['nama'], 0, 20) ?></td>
			<td><?php echo $b['wali'] ?></td>
			<td align="right"><?php echo number_format($b['debit'],0,'',','); ?></td>		
			<td align="right"><?php echo number_format($b['kredit'],0,'',','); ?></td>
			
			<?php
			$nis=$b['nis'];
			$tot=mysql_query("select sum(if(nis=". $nis .", debit, 0)) as dbt, sum(if(nis=". $nis .", kredit, 0)) as kdt from tabungan");
			while($see=mysql_fetch_assoc($tot)){
				$jml = $see['dbt'] - $see['kdt'];
				?>
				<td align="right" ><?php echo number_format($jml,0,'',','); ?></td>
			
			<?php
			}
			?>
			<td>		
				<a href="edit_bank.php?no=<?php echo $b['no']; ?>" class="btn btn-warning">Edit</a>
				<a href="lap_btr.php?no=<?php echo $b['no']; ?>"  target="_blank"  class="btn btn-default"><span class='glyphicon glyphicon-print'></span> Cetak Struk</a>
			</td>
		</tr>
		<?php 
	}
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
				<h4 class="modal-title">Add New Transaction
				</div>
				<div class="modal-body">				
					<form action="bank_act.php" method="post">	
					
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tgl" id="tgl" type="text" class="form-control" >
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
								
								$jml=mysql_query("select sum(if(nis=". $b['nis'] .", debit, 0)) as dbt, sum(if(nis=". $b['nis'] .", kredit, 0)) as kdt from tabungan");
								while($s=mysql_fetch_assoc($jml)){
	
								$jsArray .= "sant['" . $b['nis'] . "'] = {nama:'" . addslashes($b['nama']) . "',ket_wali:'".addslashes($b['ket_wali']) . "',dbt:'".addslashes($s['dbt']) . "',kdt:'".addslashes($s['kdt']) . "'};\n";
								}
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
							<input name="wali" type="text" class="form-control" id="wali" readonly="yes">
						</div>				
						<div class="form-group">
							<label>Saldo</label>
							<input name="saldo" id="saldo" type="text" class="form-control" autocomplete="off" readonly="yes" >
						</div>	
						<div class="form-group">
							<label>Debit</label>
							<input name="debit" id="debit" type="text" class="form-control" value="0" autocomplete="off">
						</div>			
						<div class="form-group">
							<label>Kredit</label>
							<input name="kredit" id="kredit" type="text" class="form-control" value="0" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Keterangan</label>
							<input name="ket" type="text" class="form-control" autocomplete="off" value="-" >
						</div>		

						<script type="text/javascript">    
						<?php echo $jsArray; ?>  
						function changeValue(nis){  
						document.getElementById('nama').value = sant[nis].nama;
						document.getElementById('wali').value = sant[nis].ket_wali;
						document.getElementById('saldo').value = sant[nis].dbt-sant[nis].kdt;
						};  
						</script>
										

					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
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
