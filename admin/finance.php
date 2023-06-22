<?php include 'header.php';	?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Buku Kas Bendahara</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  Add Transaction</button></h3>

<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tgl_awal" class="form-control">
			<option>.. Tgl Awal ..</option>
			<?php 
			$pil=mysql_query("select distinct tgl from finance order by tgl desc");
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
			$pil=mysql_query("select distinct tgl from finance order by tgl desc");
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
	$date=date_create($ahr);
	$period=date_format($date, 'M Y');
    $year=date_format($date, 'Y');
	$tg="lap_finance3.php?period='$period'";
	$tg1="lap_finance1.php?year='$year'";
	$tg2="lap_finance5.php?tgl_awal=$awl&tgl_ahir=$ahr";
		
	?><a style="margin-bottom:10px" href="<?php echo $tg2 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Allocation</a>
	<a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  <?php echo $period ?></a>
	<a style="margin-bottom:10px" href="<?php echo $tg1 ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  <?php echo $year ?></a><?php
}else{
	$tg="lap_finance3.php";
	$tg1="lap_finance1.php";
	$tg2="lap_finance5.php";
}
?>

<br/>
<?php 
if(isset($_GET['tgl_ahir'])){
	echo "<h4> Data Keuangan Periode <a style='color:blue'>". $_GET['tgl_awal']." s.d. ". $_GET['tgl_ahir']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th class="col-md-0.5">No</th>
		<th class="col-md-1">Tanggal</th>
		<th class="col-md-0.5">Akun</th>
		<th class="col-md-1">Vendor</th>
		<th class="col-md-5">Uraian</th>			
		<th class="col-md-1.5">Keterangan</th>			
		<th class="col-md-1">Debit</th>
		<th class="col-md-1">Kredit</th>
		<th class="col-md-1">Opsi</th>
	</tr>
	<?php 
$per_hal=30;
$jumlah_record=mysql_query("SELECT COUNT(*) from finance");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
	if(isset($_GET['tgl_ahir'])){
		$awl=mysql_real_escape_string($_GET['tgl_awal']);
		$ahr=mysql_real_escape_string($_GET['tgl_ahir']);
		$brg=mysql_query("select * from finance where tgl between '$awl' and '$ahr' order by tgl desc");
	}else{
		$brg=mysql_query("select * from finance order by no desc limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $b['no'] ?></td>
			<td><?php echo $b['tgl'] ?></td>
			<td><?php echo $b['akun'] ?></td>
			<td><?php echo $b['vendor'] ?></td>
			<td><?php echo $b['uraian'] ?></td>
			<td><?php echo $b['ket'] ?></td>			
			<td align="right"><?php echo number_format($b['debit'],0,'',','); ?></td>		
			<td align="right"><?php echo number_format($b['kredit'],0,'',','); ?></td>
			<td>		
				<a href="edit_finance.php?no=<?php echo $b['no']; ?>" class="btn btn-warning">Edit</a>
				<!-- <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_ijin.php?no=<?php echo $b['no']; ?>' }" class="btn btn-danger">Hapus</a> -->
				<a href="lap_bukti.php?no=<?php echo $b['no']; ?>"  target="_blank"  class="btn btn-default"><span class='glyphicon glyphicon-print'></span></a>
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
					<form action="finance_act.php" method="post">	
					
						<div class="form-group">
							<label>Date</label>
							<input name="tgl" id="tgl" type="text" class="form-control" >
						</div>	
						<div class="form-group">
							<label>Account</label>
							<select name="akun" class="form-control">
							<option value="-">--Akun--</option>
							<option value="000221">000221 - Biaya Administrasi</option>
							<option value="000222">000222 - Biaya Pembangunan</option>
							<option value="000223">000223 - Biaya Pendidikan</option>
							<option value="000224">000224 - Biaya Seragam</option>
							<option value="000225">000225 - Biaya Pembinaan</option>
							<option value="000226">000226 - Biaya Dapur</option>
							<option value="000227">000227 - Biaya Operasional</option>
							<option value="000228">000228 - Biaya Lain-lain</option>
							<option value="777199">777199 - Pemasukan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Vendor</label>
							<input name="vendor" type="text" class="form-control" value="-" >
						</div>	
						<div class="form-group">
							<label>Description</label>
							<input name="uraian" type="text" class="form-control" value="-">
						</div>			
						<div class="form-group">
							<label>Remark</label>
							<input name="ket" type="text" class="form-control" value="-" >
						</div>	
						<div class="form-group">
							<label>Amount</label>
							<input name="amon" type="text" class="form-control" value=0 >
						</div>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Save">
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
