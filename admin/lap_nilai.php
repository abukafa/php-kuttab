<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',11);
$pdf->Image('../logo/nurussalamcikoneng.png',1,1,2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'BAGIAN KESANTRIAN PONPES NURUSSALAM',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Cintaharja Kujang Cikoneng Ciamis',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0265 773360',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.nurussalamcikoneng.com | email : nurussalam.cikoneng@gmail.com',0,'L');
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'Laporan Perijinan Santri',0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(0.5);
$pdf->Cell(6,0.7,"Laporan Perijinan pada : ".$_GET['tanggal'],0,0,'C');
$pdf->ln(1);


$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'Nama Santri', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Kelas', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Ijin', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'Batas Waktu', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Check In', 1, 1, 'C');

$no=1;
$tanggal=$_GET['tanggal'];
$query=mysql_query("select * from perijinan where tgl_awal=" . $tanggal);
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['id'],1, 0, 'C');
	$pdf->Cell(5, 0.8, $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['kelas'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['ijin'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['tgl_awal'], 1, 0,'C');
	$pdf->Cell(4.5, 0.8, $lihat['tgl_ahir'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['tgl_cek'], 1, 1,'C');
	
	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

