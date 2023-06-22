<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A5");

$pdf->SetMargins(1,0.5,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',11);
$pdf->Image('../logo/nurussalamcikoneng.png',1.3,0.5,2.2,2);
$pdf->SetX(4);            
$pdf->MultiCell(19.5,0.5,'B A G I A N   K E S A N T R I A N   P O N P E S   N U R U S S A L A M',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Cintaharja Kujang Cikoneng Ciamis',0,'L');    
$pdf->SetFont('Arial','',10);
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'Telpon : 0265 773360',0,'L');
$pdf->SetX(4);
$pdf->MultiCell(19.5,0.5,'website : www.nurussalamcikoneng.com | email : nurussalam.cikoneng@gmail.com',0,'L');
$pdf->Line(1,2.8,20,2.8);
$pdf->SetLineWidth(0.09);      
$pdf->Line(1,2.9,20,2.9);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'S U R A T   I Z I N   S A N T R I',0,0,'C');
$pdf->ln(1);


$no=1;
$no=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from perijinan where no='$no'")or die(mysql_error());
while($lihat=mysql_fetch_array($det)){
	
$pdf->SetFont('Arial','',10);
$pdf->Cell(3, 0.8, '', 0, 0, 'L');
$pdf->Cell(3, 0.8,'Nama Santri ', 0, 0, 'L');
$pdf->Cell(5, 0.8,":  " . $lihat['nama'], 0, 1, 'L');
$pdf->Cell(3, 0.8, '', 0, 0, 'L');
$pdf->Cell(3, 0.8, 'Kelas ', 0, 0, 'L');
$pdf->Cell(5, 0.8,":  " . $lihat['kelas'], 0, 1, 'L');
$pdf->Cell(3, 0.8, '', 0, 0, 'L');
$pdf->Cell(3, 0.8, 'Asal ', 0, 0, 'L');
$pdf->Cell(5, 0.8,":  " . $lihat['asal'], 0, 1, 'L');
$pdf->Cell(3, 0.8, '', 0, 0, 'L');
$pdf->Cell(3, 0.8, 'Keterangan ', 0, 0, 'L');
$pdf->Cell(5, 0.8,":  " . $lihat['alasan'], 0, 1, 'L');
$pdf->Cell(3, 0.8, '', 0, 0, 'L');
$pdf->Cell(3, 0.8, 'Masa Berlaku ', 0, 0, 'L');
$pdf->Cell(5, 0.8,":  " . $lihat['tgl_awal'] . " s.d. " . $lihat['tgl_ahir'], 0, 1, 'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(0, 0.8, 'Surat ini harus diserahkan ke bag. Kesantriaan setelah ditandatangani wali santri..!', 0, 1, 'C');
$no++;
}

$pdf->SetFont('Arial','',10);
$pdf->Cell(8, 0.8, '', 0, 0, 'C');
$pdf->Cell(13, 0.8,"Ciamis, ".date("d m Y"), 0, 1, 'C');
$pdf->Cell(8, 0.8,'Bag. Kesantrian', 0, 0, 'C');
$pdf->Cell(13, 0.8,'Wali Santri', 0, 1, 'C');
$pdf->ln(1);
$pdf->Cell(8, 0.8,'____________________', 0, 0, 'C');
$pdf->Cell(13, 0.8,'____________________', 0, 1, 'C');

$pdf->Output("laporan_buku.pdf","I");

?>

