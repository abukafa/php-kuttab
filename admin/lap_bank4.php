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

$per=$_GET['period'];
$pdf->ln(0.75);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,0.7,'B U K U   T A B U N G A N   H A R I A N',0,1,'C');
$pdf->Cell(0,0.7,'Tanggal ' . $per,0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0.7, 0.7, 'No', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Tanggal', 1, 0, 'C');
$pdf->Cell(1.8, 0.7, 'NIS', 1, 0, 'C');
$pdf->Cell(5.5, 0.7, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Nama Wali', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Debit', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Kredit', 1, 0, 'C');
$pdf->Cell(3, 0.7, 'Ket', 1, 1, 'C');


$no=1;
$query=mysql_query("select * from tabungan where tgl =" . $per . "order by nama asc");
while($lihat=mysql_fetch_assoc($query)){
$pdf->SetFont('Arial','',8);
	$pdf->Cell(0.7, 0.7, $no,1, 0, 'C');
	$pdf->Cell(2, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.8, 0.7, $lihat['nis'],1, 0, 'C');
	$pdf->Cell(5.5, 0.7, substr($lihat['nama'], 0, 30), 1, 0,'L');
	$pdf->Cell(2, 0.7, substr($lihat['wali'], 0, 10), 1, 0,'L');
	$pdf->Cell(2, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.7, number_format($lihat['kredit'],0,'',','), 1, 0,'R');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 1,'R');
	$no++;
}

$pdf->ln(0.25);
$pdf->SetFont('Arial','B',8);
$tot=mysql_query("select sum(if(tgl=". $per .", debit, 0)) as dbt, sum(if(period=". $per .", kredit, 0)) as kdt from tabungan");
while($see=mysql_fetch_assoc($tot)){
	$pdf->Cell(12, 0.8, '', 0, 0,'C');
	$pdf->Cell(2, 0.8, number_format($see['dbt'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['kdt'],0,'',','), 1, 0,'R');
	$jml = $see['dbt'] - $see['kdt'];
	$pdf->Cell(3, 0.8, number_format($jml,0,'',','), 1, 1,'R');
}

$pdf->Output("daily_banking.pdf","I");

?>
