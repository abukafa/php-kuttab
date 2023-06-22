<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../admin/kuttab.png',14,1,2,2);
$pdf->Image('../admin/kop.png',21.6,0.8,6.78,2);
$pdf->SetFont('Times','B',15);		
$pdf->Cell(16.8,0.5,'KUTTAB NURUSSALAM',0 ,1 ,'L');
$pdf->ln(0.2);
$pdf->Cell(25.5,0.5,'Sekolah Dasar Islam Berbasis Alquran',0,1,'L');   
$pdf->SetFont('Arial','B',10);
$pdf->ln(0.2);
$pdf->Cell(25.5,0.5,'www.kuttabnurussalam.wordpress.com',0,1,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);

$y=$_GET['thn'];
$yr = substr($y,1,4);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'PAYMENT OUTSTANDING PERIODE ' . $yr,0,1,'C');
$pdf->Cell(0,0.7,'Update '.date("d M Y"),0,1,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0.7, 0.8, 'No', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kelas', 1, 0, 'C');
$pdf->Cell(2.3, 0.8, 'No. Telp', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Daftar', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Bangunan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Pendidikan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Seragam', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'SPP', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Makan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Asrama', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');

$no=1;
$query1=mysql_query("select * from santri where kelas<>'XXX' order by kelas, nama");
while($lihat=mysql_fetch_array($query1)){
	$ni=$lihat['nis'];
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0.7, 0.8, $no, 1, 0, 'C');
	$pdf->Cell(1.5, 0.8, $ni,1, 0, 'C');
	$pdf->Cell(5, 0.8, ucwords(strtolower($lihat['nama'])), 1, 0,'L');
	$pdf->Cell(3, 0.8, substr($lihat['kelas'], 0, 20), 1, 0,'L');
	$pdf->Cell(2.3, 0.8, $lihat['tlp'], 1, 0,'C');
	
$query2=mysql_query("select sum(if(nis=". $ni .", daftar, 0)) as dft, sum(if(nis=". $ni .", bangunan, 0)) as bgn, sum(if(nis=". $ni .", pendidikan, 0)) as pdd, sum(if(nis=". $ni .", seragam, 0)) as srg, sum(if(nis=". $ni .", spp, 0)) as sp, sum(if(nis=". $ni .", makan, 0)) as mkn, sum(if(nis=". $ni .", lain, 0)) as lin, sum(if(nis=". $ni .", jumlah, 0)) as jm from bayaran where thn=" . $y ."and nis =" . $ni);
while($see=mysql_fetch_array($query2)){

$date = date("Y-m-d");
$taun = substr($y,1,4) . '-07-01';
$tahr = substr($y,1,4)+1 . '-06-30';
$timeStart = strtotime("$taun");
if ($yr == date("Y")){
	$timeEnd = strtotime("$date");
	}else{
	$timeEnd = strtotime("$tahr");
	}
// Menambah bulan ini + semua bulan pada tahun sebelumnya
$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
// menghitung selisih bulan
$numBulan += date("m",$timeEnd)-date("m",$timeStart);
	
$query3=mysql_query("select * from exception where thn=" . $y ."and nis =" . $ni);
while($exc=mysql_fetch_array($query3)){	

$query=mysql_query("select * from beban where thn=" . $y ."and nis =" . $ni);
while($leh=mysql_fetch_array($query)){

	$tdft=$leh['daftar']-($see['dft']+$exc['daftar']);
	$tbgn=$leh['bangunan']-($see['bgn']+$exc['bangunan']);
	$tpdd=$leh['pendidikan']-($see['pdd']+$exc['pendidikan']);
	$tsrg=$leh['seragam']-($see['srg']+$exc['seragam']);
	$tspp=($numBulan*$leh['spp'])-($see['sp']+$exc['spp']);
	$tmkn=($numBulan*$leh['makan'])-($see['mkn']+$exc['makan']);
	$tlin=($numBulan*$leh['asrama'])-($see['lin']+$exc['asrama']);
	$tjml=$tdft+$tbgn+$tpdd+$tsrg+$tspp+$tmkn+$tlin;	
	
	$pdf->Cell(1.5, 0.8, number_format($tdft,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tbgn,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tpdd,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tsrg,0,'',','), 1, 0,'R');
	$pdf->Cell(1.5, 0.8, number_format($tspp,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tmkn,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tlin,0,'',','), 1, 0,'R');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(2, 0.8, number_format($tjml,0,'',','), 1, 1,'R');
	$no++;
		
}	
}	
}	
}

$pdf->Output("outstanding.pdf","I");
?>
