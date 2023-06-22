<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../admin/kuttab.png',9.5,1,2,2);
$pdf->Image('../admin/kop.png',13.1,0.8,6.78,2);
$pdf->SetFont('Times','B',13);		
$pdf->Cell(16.8,0.5,'KUTTAB NURUSSALAM',0 ,1 ,'L');
$pdf->ln(0.2);
$pdf->Cell(25.5,0.5,'Sekolah Dasar Islam Berbasis Alquran',0,1,'L');   
$pdf->SetFont('Arial','B',10);
$pdf->ln(0.2);
$pdf->Cell(25.5,0.5,'www.kuttabnurussalam.wordpress.com',0,1,'L');
$pdf->Line(1,3.1,20,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,20,3.2);   
$pdf->SetLineWidth(0);

//$per=$_GET['period'];
$awl=$_GET['tgl_awal'];
$ahr=$_GET['tgl_ahir'];
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'REKAP SALDO TABUNGAN SANTRI',0,1,'C');
$pdf->ln(0.5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0.7, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(1.8, 0.7, 'NIS', 1, 0, 'C');
$pdf->Cell(5.5, 0.7, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(4, 0.7, 'Nama Wali', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Debit', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Kredit', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Saldo', 1, 1, 'C');

$no=1;
$query=mysql_query("select * from santri");
while($lihat=mysql_fetch_assoc($query)){
	$pdf->SetFont('Arial','',8);
	$ni=$lihat['nis'];
	$pdf->Cell(0.7, 0.7, $no, 1, 0, 'C');
	$pdf->Cell(1.8, 0.7, $ni,1, 0, 'C');
	$pdf->Cell(5.5, 0.7, substr($lihat['nama'], 0, 30), 1, 0,'L');
	$pdf->Cell(4, 0.7, substr($lihat['ket_wali'], 0, 20), 1, 0,'L');
	
$jml=mysql_query("select sum(if(nis=". $ni .", debit, 0)) as dbt, sum(if(nis=". $ni .", kredit, 0)) as kdt from tabungan where tgl between '$awl' and '$ahr'");
while($see=mysql_fetch_assoc($jml)){
	$jum=$see['dbt']-$see['kdt'];
	$pdf->Cell(2, 0.7, number_format($see['dbt'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.7, number_format($see['kdt'],0,'',','), 1, 0,'R');
	$pdf->Cell(3, 0.7, number_format($jum,0,'',','), 1, 1,'R');
	$no++;
}
}

$tjml=mysql_query("select sum(debit) as tdbt, sum(kredit) as tkdt from tabungan where tgl between '$awl' and '$ahr'");
while($tsee=mysql_fetch_assoc($tjml)){
	$tot=$tsee['tdbt']-$tsee['tkdt'];
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(12, 0.8, '', 0, 0, 'C');
	$pdf->Cell(2, 0.8, number_format($tsee['tdbt'],0,'',','), 0, 0, 'R');
	$pdf->Cell(2, 0.8, number_format($tsee['tkdt'],0,'',','), 0, 0, 'R');
	$pdf->Cell(3, 0.8, number_format($tot, 0,'',', '), 0, 0, 'R');
	
}

$pdf->Output("laporan_buku.pdf","I");
?>
