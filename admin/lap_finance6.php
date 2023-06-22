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

$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,0.7,'ALOKASI KAS BENDAHARA',0,1,'C');
$pdf->Cell(0,0.7,'2017 s.d. '.date("Y"),0,1,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','',8);
$pdf->Cell(11, 1.6, 'IURAN & INFAQ SANTRI', 1, 0,'C');
$pdf->Cell(2, 0.8, 'Daftar', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Bangunan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Pendidikan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Seragam', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'SPP', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Makan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Asrama', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Jumlah', 1, 1, 'C');
$pdf->SetFont('Arial','B',8);
$tot=mysql_query("select sum(daftar) as dft, sum(bangunan) as bgn, sum(pendidikan) as pdd, sum(seragam) as srg, sum(spp) as sp, sum(makan) as mkn, sum(lain) as lin, sum(jumlah) as jml from bayaran");
while($see=mysql_fetch_assoc($tot)){
	$pdf->Cell(11, 0.8, '', 0, 0,'C');
	$pdf->Cell(2, 0.8, number_format($see['dft'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['bgn'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['pdd'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['srg'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['sp'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['mkn'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['lin'],0,'',','), 1, 0,'R');
	$pdf->Cell(2.5, 0.8, number_format($see['jml'],0,'',','), 1, 1,'R');

$query=mysql_query("select vendor, sum(if(akun='777199', debit, 0)) as dbt, sum(if(akun='000221', kredit, 0)) as adm, sum(if(akun='000222', kredit, 0)) as pba, sum(if(akun='000223', kredit, 0)) as pdd, sum(if(akun='000224', kredit, 0)) as srg, sum(if(akun='000225', kredit, 0)) as pbi, sum(if(akun='000226', kredit, 0)) as dpr, sum(if(akun='000227', kredit, 0)) as ifq, sum(if(akun='000228', kredit, 0)) as lin from finance");
while($lih=mysql_fetch_array($query)){

	
$pdf->ln(0.5);
$pdf->SetFont('Arial','',8);

$pdf->Cell(11, 0.8, 'INFAQ DAN PEMASUKAN LAIN-LAIN ', 1, 0,'C');
$pdf->Cell(16.5, 0.8, number_format($lih['dbt'],0,'',','), 1, 1,'R');

$pdf->ln(0.5);
$pdf->Cell(11, 1.6, 'TOTAL PENGELUARAN', 1, 0,'C');
$pdf->Cell(2, 0.8, '000221', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000222', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000223', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000224', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000225', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000226', 1, 0, 'C');
$pdf->Cell(2, 0.8, '000228', 1, 0, 'C');
$pdf->Cell(2.5, 0.8, 'Jumlah', 1, 1, 'C');

	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(11, 0.8, '', 0, 0,'C');
	$pdf->Cell(2, 0.8, number_format($lih['adm'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['pba'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['pdd'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['srg'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['pbi'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['dpr'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lih['lin'],0,'',','), 1, 0,'R');
	$jum = $lih['adm'] + $lih['pba'] + $lih['pdd'] + $lih['srg'] + $lih['pbi'] + $lih['dpr'] + $lih['lin'];
	$pdf->Cell(2.5, 0.8, number_format($jum, 0, '', ','), 1, 1,'R');

	$pdf->ln(1);
	$pdf->Cell(11, 0.8, 'SALDO AKHIR', 1, 0,'C');
	$dft = $see['dft'] - $lih['adm'];
	$pdf->Cell(2, 0.8, number_format($dft,0,'',','), 1, 0,'R');
	$bgn = $see['bgn'] - $lih['pba'];
	$pdf->Cell(2, 0.8, number_format($bgn,0,'',','), 1, 0,'R');
	$pdd = $see['pdd'] - $lih['pdd'];
	$pdf->Cell(2, 0.8, number_format($pdd,0,'',','), 1, 0,'R');
	$srg = $see['srg'] - $lih['srg'];
	$pdf->Cell(2, 0.8, number_format($srg,0,'',','), 1, 0,'R');
	$sp = $see['sp'] - $lih['pbi'];
	$pdf->Cell(2, 0.8, number_format($sp,0,'',','), 1, 0,'R');
	$mkn = $see['mkn'] - $lih['dpr'];
	$pdf->Cell(2, 0.8, number_format($mkn,0,'',','), 1, 0,'R');
	$lin = $see['lin'] - $lih['lin'];
	$pdf->Cell(2, 0.8, number_format($lin,0,'',','), 1, 0,'R');
	$jml = $lih['dbt'] + $see['jml'] - $jum;
	$pdf->Cell(2.5, 0.8, number_format($jml,0,'',','), 1, 1,'R');

}
}

$pdf->ln(1.5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(9.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,"Ciamis, ".date("d M Y"), 0, 1, 'C');
$pdf->Cell(9.5, 0.5,'Kepala Kuttab', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'Bag. Bendahara', 0, 1, 'C');
$pdf->ln(1.5);
$pdf->Cell(9.5, 0.5,'____________________', 0, 0, 'C');
$pdf->Cell(8.5, 0.5, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.5,'____________________', 0, 1, 'C');

$pdf->Output("laporan_buku.pdf","I");

?>

