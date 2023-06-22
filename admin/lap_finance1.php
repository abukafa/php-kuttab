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

if (date('m') >= 07 and date('m') <= 12) {
$y2=date('Y');
}else{
$y2=date('Y')-1;
}
$p1=$y2 . '-07-01';
$p2=$y2+1 . '-06-30';
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'LAPORAN KAS BENDAHARA',0,1,'C');
$pdf->Cell(0,0.7, date('Y') . '-' . $y2,0,1,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'1. Pengeluaran yang Dialokasikan dari Infaq Pendaftaran',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000221 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000221 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'2. Pengeluaran yang Dialokasikan dari Infaq Bangunan',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000222 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000222 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'3. Pengeluaran yang Dialokasikan dari Infaq Pendidikan',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000223 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000223 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'4. Pengeluaran yang Dialokasikan dari Uang Seragam',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000224 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000224 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'5. Pengeluaran yang Dialokasikan dari SPP',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000225 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000225 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'6. Pengeluaran yang Dialokasikan dari Uang Makan',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000226 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000226 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,0.7,'7. Pengeluaran Lain-lain',0,1,'L');
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Akun', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Vendor', 1, 0, 'C');
$pdf->Cell(11.5, 0.8, 'Uraian', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Keterangan', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Debit', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Kredt', 1, 1, 'C');
$no=1;
$query=mysql_query("select * from finance where akun = 000228 and tgl between '$p1' and '$p2' order by tgl asc");
while($lihat=mysql_fetch_array($query)){
	$fak=$lihat['no'];
	$pdf->SetFont('Arial','',8);
	$fak=sprintf('%04d' , $fak);
	$pdf->Cell(1, 0.7, $fak,1,0, 'C');
	$pdf->Cell(2.5, 0.7, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.7, $lihat['akun'],1, 0, 'C');
	$pdf->Cell(3, 0.7, substr($lihat['vendor'],0,19), 1, 0,'L');
	$pdf->Cell(11.5, 0.7, $lihat['uraian'], 1, 0,'L');
	$pdf->Cell(3, 0.7, $lihat['ket'], 1, 0,'C');
	$pdf->Cell(2.5, 0.7, number_format($lihat['debit'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.7, number_format($lihat['kredit'],0,'',','), 1, 1,'R');
	$no++;
}
$pdf->SetFont('Arial','B',8);
$jml=mysql_query("select sum(debit) as jd, sum(kredit) as jk from finance where akun = 000228 and tgl between '$p1' and '$p2' order by tgl asc");
while($see=mysql_fetch_array($jml)){
	$jum=$see['jk']-$see['jd'];
	$pdf->Cell(22.5, 0.8, 'Total', 1, 0,'C');
	$pdf->Cell(5, 0.8, number_format($jum,0,'',','), 1, 0,'R');
}


$pdf->ln(1.5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(9.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,"Ciamis, ".date("d M Y"), 0, 1, 'C');
$pdf->Cell(9.5, 0.5,'Kepala Kuttab', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'Bag. Bendahara', 0, 1, 'C');
$pdf->ln(2);
$pdf->Cell(9.5, 0.5,'____________________', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'____________________', 0, 1, 'C');


$pdf->Output("laporan_buku.pdf","I");

?>

