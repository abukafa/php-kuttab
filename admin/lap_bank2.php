<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A5");

$pdf->SetMargins(0.75,0.75,0.75);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../admin/kuttab.png',6.75,0.6,1.5,1.5);
$pdf->Image('../admin/kop.png',9.6,0.7,4.068,1.2);
$pdf->SetFont('Times','B',8);		
$pdf->Cell(13.5,0.4,'KUTTAB NURUSSALAM',0 ,1 ,'L');
$pdf->SetFont('Arial','B',7);
$pdf->Cell(10,0.4,'Sekolah Dasar Islam Berbasis Alquran',0,1,'L');   
$pdf->Cell(10,0.4,'www.kuttabnurussalam.wordpress.com',0,1,'L');
$pdf->Line(1,2.1,13.5,2.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.2,13.5,2.2);   
$pdf->SetLineWidth(0);

$nis=$_GET['nis'];
$pdf->ln(0.75);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(13,0.5,'MUTASI TABUNGAN SANTRI',0,1,'R');
$pdf->SetFont('Arial','B',8);
$query=mysql_query("select * from santri where nis =" . $nis );
while($lih=mysql_fetch_assoc($query)){
$pdf->Cell(13,0.5,'Nomor Induk : ' . $nis,0,1,'R');
$pdf->Cell(13,0.5,'Nama : ' . $lih['nama'],0,1,'R');
$pdf->Cell(13,0.5,'Wali : ' . $lih['ket_wali'],0,1,'R');
}

$pdf->ln(0.5);
$pdf->Cell(1, 0.7, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'TGL', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Debit', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Kredit', 1, 0, 'C');
$pdf->Cell(2, 0.7, 'Ket', 1, 0, 'C');
$pdf->Cell(4, 0.7, 'Admin', 1, 1, 'C');

$no=1;
$query=mysql_query("select * from tabungan where nis =" . $nis . "order by tgl asc");
while($lihat=mysql_fetch_assoc($query)){
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(1, 0.5, $no,1,0, 'C');
	$pdf->Cell(2, 0.5, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(2, 0.5, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.5, number_format($lihat['kredit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.5, $lihat['ket'],1, 0, 'C');
	$pdf->Cell(4, 0.5, $lihat['admin'],1, 1, 'L');
	$no++;
}
$pdf->ln(0.25);
$pdf->SetFont('Arial','B',8);
$tot=mysql_query("select sum(if(nis=". $nis .", debit, 0)) as dbt, sum(if(nis=". $nis .", kredit, 0)) as kdt from tabungan");
while($see=mysql_fetch_assoc($tot)){
	$pdf->Cell(3, 0.8, '', 0, 0,'C');
	$pdf->Cell(2, 0.8, number_format($see['dbt'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['kdt'],0,'',','), 1, 0,'R');
	$jml = $see['dbt'] - $see['kdt'];
	$pdf->Cell(6, 0.8, number_format($jml,0,'',','), 1, 1,'R');
}

$pdf->Output("laporan_buku.pdf","I");

?>
