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

$pdf->ln(0.75);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(27.6,0.7,"D A T A   S A N T R I",0,10,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0.8, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(8, 0.8, 'NAMA', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'KELAS', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'ASAL', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'WALI SANTRI', 1, 0, 'C'); 	
$pdf->Cell(5.7, 0.8, 'KET', 1, 1, 'C');

$no=1;
$pdf->SetFont('Arial','',10);
$query=mysql_query("select * from santri where kelas<>'XXX' order by kelas, nama");
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(0.8, 0.6, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.6, $lihat['nis'],1, 0, 'C');
	$pdf->Cell(8, 0.6, ucwords(strtolower($lihat['nama'])),1, 0, 'L');
	$pdf->Cell(3, 0.6, $lihat['kelas'], 1, 0, 'L');
	$pdf->Cell(3, 0.6, ucwords(strtolower($lihat['kab'])), 1, 0, 'L');
	$pdf->Cell(5, 0.6, ucwords(strtolower($lihat['ket_wali'])), 1, 0, 'L'); 	
	$pdf->Cell(5.7, 0.6, '', 1, 1, 'C');
	$no++;
}


$pdf->Output("laporan_buku.pdf","I");

?>

