<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");
$kls=$_GET['kls'];
$query=mysql_query("select * from santri where kelas=" . $kls . "order by nama");

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
$pdf->Cell(27.6,0.7,"A B S E N S I   S A N T R I",0,10,'C');
$pdf->Cell(27.6,0.7,'Kelas : ' . $kls,0,10,'C');
$pdf->ln(-0.5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(2,0.7,"Pekan ke :",0,0,'L');
$pdf->Cell(0.6,0.6,"",1,0,'L');
$pdf->Cell(1.5,0.7," Bulan : ",0,0,'L');
$pdf->Cell(3.5,0.6,"",1,0,'C');

$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0.8, 1.4, 'NO', 1, 0, 'C');
$pdf->Cell(2, 1.4, 'NIS', 1, 0, 'C');
$pdf->Cell(6, 1.4, 'NAMA', 1, 0, 'C');
$pdf->Cell(0.05, 0.7, '', 0, 0, 'C');
$pdf->Cell(2.4, 0.7, 'Senin', 1, 0, 'C');
$pdf->Cell(2.4, 0.7, 'Selasa', 1, 0, 'C');
$pdf->Cell(2.4, 0.7, 'Rabu', 1, 0, 'C');
$pdf->Cell(2.4, 0.7, 'Kamis', 1, 0, 'C');
$pdf->Cell(2.4, 0.7, 'Jumat', 1, 0, 'C'); 	
$pdf->Cell(0.05, 0.7, '', 0, 0, 'C');
$pdf->Cell(4, 0.7, 'KEHADIRAN', 1, 0, 'C');
$pdf->Cell(2.7, 1.4, 'KET', 1, 1, 'C');

$pdf->ln(-0.7);
$pdf->Cell(2.8, 0.7, '', 0, 0, 'C');
$pdf->Cell(6, 0.7, '', 0, 0, 'C');
$pdf->Cell(0.05, 0.7, '', 0, 0, 'C');
$pdf->Cell(0.8, 0.7, '1', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '2', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '3', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '1', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '2', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '3', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '1', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '2', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '3', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '1', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '2', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '3', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '1', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '2', 1, 0, 'C');
$pdf->Cell(0.8, 0.7, '3', 1, 0, 'C');
$pdf->Cell(0.05, 0.7, '', 0, 0, 'C');
$pdf->Cell(1, 0.7, 'h', 1, 0, 'C');
$pdf->Cell(1, 0.7, 'i', 1, 0, 'C');
$pdf->Cell(1, 0.7, 's', 1, 0, 'C');
$pdf->Cell(1, 0.7, 'a', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$pdf->ln(0.05);

$no=1;

while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(0.8, 0.7, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.7, $lihat['nis'],1, 0, 'C');
	$pdf->Cell(6, 0.7, ucwords(strtolower($lihat['nama'])),1, 0, 'L');
	$pdf->Cell(0.05, 0.7, '', 0, 0, 'C'); 	
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.8, 0.7, '', 1, 0, 'C');
	$pdf->Cell(0.05, 0.7, '', 0, 0, 'C');
	$pdf->Cell(1, 0.7, '', 1, 0, 'C');
	$pdf->Cell(1, 0.7, '', 1, 0, 'C');
	$pdf->Cell(1, 0.7, '', 1, 0, 'C');
	$pdf->Cell(1, 0.7, '', 1, 0, 'C');
	$pdf->Cell(2.7, 0.7, '', 1, 1, 'C');
	$no++;
}

$pdf->ln(0.25);
$pdf->SetFont('Arial','',10);
$pdf->Cell(22.6, 0.8, '', 0, 0, 'C');
$pdf->Cell(5, 0.8,'Ciamis, ______________', 0, 1, 'C');
$pdf->Cell(5, 0.8,'Wali Kelas', 0, 0, 'C');
$pdf->Cell(17.6, 0.8,'', 0, 0, 'C');
$pdf->Cell(5, 0.8,'Ketua Kelas', 0, 1, 'C');
$pdf->ln(1);
$pdf->Cell(5, 0.8,'____________________', 0, 0, 'C');
$pdf->Cell(17.6, 0.8,'', 0, 0, 'C');
$pdf->Cell(5, 0.8,'____________________', 0, 1, 'C');

$pdf->Output("laporan_buku.pdf","I");

?>

