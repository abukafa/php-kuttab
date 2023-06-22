<?php include 'header.php';	?>

<h3 class="animated zoomInRight"><span class="glyphicon glyphicon-briefcase"></span>  Data Pembayaran Santri</h3>
<h3 class="animated zoomInDown"><button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-pencil"></span>  New Payment</button></h3>


<form action="" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-question-sign"></span></span>
		<select type="submit" name="kls" class="form-control" onchange="this.form.submit()">
			<option>Pilih Kelas ..</option>
			<?php 
			$pil=mysql_query("select distinct kelas from santri order by kelas desc");
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
<br/>

<a class="btn" href="pay.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali ke Payment</a>
<table class="table">
	<tr>
		<th>No</th>
		<th class="col-md-0.7">NIS</th>
		<th class="col-md-2.1">Nama Santri</th>
		<th class="col-md-2.1">Nama Santri</th>
		<th class="col-md-1.2">Tung. Dft</th>
		<th class="col-md-1.2">Tung. Bgn</th>
		<th class="col-md-1.2">Tung. Pdd</th>
		<th class="col-md-1.2">Tung. Srg</th>
		<th class="col-md-1.2">Tung. SPP</th>
		<th class="col-md-1.2">Jumlah</th>
	</tr>
	<?php 

	if(isset($_GET['kls'])){
		$kls=mysql_real_escape_string($_GET['kls']);
		$brg=mysql_query("select * from santri where kelas<>'XXX' order by kelas, nama");
	}else{
		$brg=mysql_query("select * from santri where kelas<>'XXX' order by kelas, nama");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

	?>
		<tr>	
			<td><?php echo $no ?></td>
			<?php
			$nis=$b['nis'];
			$bl=date("m")-0;
			if ( $bl < 7 ){
				$yer=date("Y")-1;
			}else{
				$yer=date("Y");
			}
			$tg="lap_pay4.php?nis='$nis'&yer='$yer'"; ?>
			<td><a href="<?php echo $tg ?>"   target="_blank" ><?php echo $b['nis'] ?></a></td>
			<td><?php echo $b['nama'] ?></td>
			<td><?php echo $b['ket_wali'] ?></td>
		
			<?php
			$query2=mysql_query("select sum(if(nis=". $nis .", daftar, 0)) as dft, sum(if(nis=". $nis .", bangunan, 0)) as bgn, sum(if(nis=". $nis .", pendidikan, 0)) as pdd, sum(if(nis=". $nis .", seragam, 0)) as srg, sum(if(nis=". $nis .", spp, 0)) as sp, sum(if(nis=". $nis .", makan, 0)) as mkn, sum(if(nis=". $nis .", lain, 0)) as lin, sum(if(nis=". $nis .", jumlah, 0)) as jm from bayaran where nis =" . $nis);
			while($see=mysql_fetch_array($query2)){

			$query3=mysql_query("select sum(if(nis=". $nis .", daftar, 0)) as dft, sum(if(nis=". $nis .", bangunan, 0)) as bgn, sum(if(nis=". $nis .", pendidikan, 0)) as pdd, sum(if(nis=". $nis .", seragam, 0)) as srg, sum(if(nis=". $nis .", spp, 0)) as sp, sum(if(nis=". $nis .", makan, 0)) as mkn, sum(if(nis=". $nis .", asrama, 0)) as asr from exception");
			while($exc=mysql_fetch_array($query3)){	
	
			$query=mysql_query("select sum(if(thn=".$yer." and nis=". $nis .", spp,0)) as spp, sum(if(nis=". $nis .", daftar, 0)) as dft, sum(if(nis=". $nis .", bangunan, 0)) as bgn, sum(if(nis=". $nis .", pendidikan, 0)) as pdd, sum(if(nis=". $nis .", seragam, 0)) as srg, sum(if(nis=". $nis .", spp, 0)) as sp, sum(if(nis=". $nis .", makan, 0)) as mkn, sum(if(nis=". $nis .", asrama, 0)) as asr from beban");
			while($leh=mysql_fetch_array($query)){


			$taun = $yer . '-07-01';
			$timeStart = strtotime("$taun");
			$numBulan = 1 + (date("Y")-date("Y",$timeStart))*12;
			$numBulan += date("m")-date("m",$timeStart);
			$sbln = 12 - $numBulan;

			$tdft=$leh['dft']-($see['dft']+$exc['dft']);
			$tbgn=$leh['bgn']-($see['bgn']+$exc['bgn']);
			$tpdd=$leh['pdd']-($see['pdd']+$exc['pdd']);
			$tsrg=$leh['srg']-($see['srg']+$exc['srg']);
			$tspp=(12*$leh['sp'])-($see['sp']+$exc['sp'])-($sbln*$leh['spp']);
			$tmkn=0;
			$tlin=0;
			$tjml=$tdft+$tbgn+$tpdd+$tsrg+$tspp+$tmkn+$tlin;	
			?>
			
			<td align="right"><?php echo number_format($tdft,0,'',',') ?></td>
			<td align="right"><?php echo number_format($tbgn,0,'',',') ?></td>
			<td align="right"><?php echo number_format($tpdd,0,'',',') ?></td>
			<td align="right"><?php echo number_format($tsrg,0,'',',') ?></td>
			<td align="right"><?php echo number_format($tspp,0,'',',') ?></td>
			<td align="right"><?php echo number_format($tjml,0,'',',') ?></td>
			</td>
		</tr>		
	<?php 
	$no++;
	}	
	}		
	}
	}
	?>
</table>

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
