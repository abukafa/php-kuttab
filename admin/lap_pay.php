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
$awl=$_GET['tgl_awal'];
$ahr=$_GET['tgl_ahir'];
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'LAPORAN INFAQ DAFTAR ULANG DAN BULANAN SANTRI',0,1,'C');
$pdf->Cell(0,0.7,$awl . ' s.d. ' . $ahr,0,0,'C');
$pdf->ln(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Nama Wali', 1, 0, 'C');
$pdf->Cell(1, 0.8, 'THN', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Daftar', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Bangunan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Pendidikan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Seragam', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'BLN', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'SPP', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Makan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Lain', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');

$no=1;
$query=mysql_query("select * from bayaran where tgl between '$awl' and '$ahr' order by nis asc");
while($lihat=mysql_fetch_assoc($query)){
	$fak=$lihat['no'];
	$fak=sprintf('%04d' , $fak);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1, 0.8, $fak,1,0, 'C');
	$pdf->Cell(2, 0.8, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.8, $lihat['nis'],1, 0, 'C');
	$pdf->Cell(3.5, 0.8, substr($lihat['nama'], 0, 20). "-", 1, 0,'L');
	$pdf->Cell(2, 0.8, substr($lihat['wali'], 0, 7). "-", 1, 0,'L');
	$pdf->Cell(1, 0.8, $lihat['thn'], 1, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($lihat['daftar'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['bangunan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['pendidikan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['seragam'],0,'',','), 1, 0,'R');
	$pdf->Cell(1.5, 0.8, $lihat['bln'], 1, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($lihat['spp'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['makan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['lain'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['jumlah'],0,'',','), 1, 1,'R');
	$no++;
}

$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(daftar) as dft, sum(bangunan) as bgn, sum(pendidikan) as pdd, sum(seragam) as srg, sum(spp) as sp, sum(makan) as mkn, sum(lain) as lin, sum(jumlah) as jml from bayaran where tgl between '$awl' and '$ahr'");
while($see=mysql_fetch_assoc($jml)){
	$pdf->Cell(11, 0.8, '', 0, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($see['dft'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['bgn'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['pdd'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['srg'],0,'',','), 0, 0,'R');
	$pdf->Cell(1.5, 0.8, '', 0, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($see['sp'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['mkn'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['lin'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['jml'],0,'',','), 0, 1,'R');
}

$pdf->Output("laporan_buku.pdf","I");

?>

