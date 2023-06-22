<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm",array(13.75,21));

$pdf->SetMargins(1,0,0,0);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Image('../admin/kuttab.png',9.5,0.3,2,2);
$pdf->Image('../admin/kop.png',14.8,0.5,5.085,1.5);
$pdf->SetFont('Times','B',10);		
$pdf->ln(0.5);
$pdf->Cell(10,0.5,'KUTTAB NURUSSALAM',0 ,1 ,'L');
$pdf->Cell(10,0.5,'Sekolah Dasar Islam Berbasis Alquran',0,1,'L');   
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,0.5,'www.kuttabnurussalam.wordpress.com',0,1,'L');
$pdf->Line(1,2.2,20,2.2);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,2.3,20,2.3);   
$pdf->SetLineWidth(0);

$pdf->ln(0.75);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(19,0.7,"BUKTI TRANSAKSI",0,1,'C');

$no=1;
$no=mysql_real_escape_string($_GET['no']);
$det=mysql_query("select * from finance where no='$no'")or die(mysql_error());
while($lihat=mysql_fetch_array($det)){

$pdf->SetFont('Arial','',10);
$pdf->Cell(3, 0.8, 'Akun : ' . $lihat['akun'],1,0, 'C');
$pdf->Cell(13, 0.8, '',0,0, 'L');
$pdf->Cell(3, 0.8, 'Tgl : ' . $lihat['tgl'], 1, 1, 'C');
$pdf->SetFont('Arial','B',10);

if (substr($lihat['akun'], 0, 3) == 777){
$vdr= $lihat['vendor'];
$jml=number_format($lihat['debit']);
$tbg=ucwords(Terbilang($lihat['debit']));
} 
else {
$vdr='Kuttab Nurussalam';
$jml=number_format($lihat['kredit']);
$tbg=ucwords(Terbilang($lihat['kredit']));
}

$pdf->ln(0.5);
$pdf->SetFont('Arial','',11);
$pdf->Cell(4, 0.8, 'Sudah Terima Dari',0,0, 'L');
$pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
$pdf->Cell(14.5, 0.8, $vdr,0,1, 'L');

$pdf->Cell(4, 0.8, 'Uang Sebanyak',0,0, 'l');
$pdf->Cell(0.4, 0.8, ':', 0, 0, 'L');
$pdf->MultiCell(14.6, 0.8, $tbg,0, 'L');

$pdf->Cell(4, 0.8, 'Untuk Pembayaran',0,0, 'l');
$pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
$pdf->MultiCell(14.5, 0.8, $lihat['uraian'],0, 'L');

$pdf->Cell(4, 0.8, 'Keterangan',0,0, 'l');
$pdf->Cell(0.5, 0.8, ':', 0, 0, 'L');
$pdf->MultiCell(14.5, 0.8, $lihat['ket'],0, 'L');

$no++;
}


$pdf->Image('../admin/jaza.png',9.5,9,2.25,1);

$pdf->Cell(9.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,"Ciamis, ".date("d M Y"), 0, 1, 'R');
$pdf->Cell(9.5, 0.5,'', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'Penerima', 0, 1, 'R');
$pdf->Cell(3, 0.5,'', 0, 0, 'C');
$pdf->Cell(4, 0.1,'', 1, 1, 'C');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(3, 1,'Rp. ', 0, 0, 'R');
$pdf->Cell(4, 1,$jml, 1, 1, 'C');
$pdf->Cell(3, 0.4,'', 0, 0, 'C');
$pdf->Cell(4, 0.1,'', 1, 1, 'C');
$pdf->Cell(9.5, 0.5,'', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'________________', 0, 1, 'R');


$pdf->Output("kwitansi.pdf","I");

function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}
?>

