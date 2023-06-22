<?php
include 'config.php';
require('../assets/pdf/fpdf.php');

$pdf = new FPDF("P","cm","A4");

$pdf->SetMargins(1,0,0);
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

$nis=$_GET['nis'];
$query=mysql_query("select * from santri where nis =" . $nis );
while($lih=mysql_fetch_assoc($query)){

$pdf->ln(1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(3,0.6,'Nomor',0,0,'L');
$pdf->Cell(4,0.6,': 03/D.4/KN-YNC/2.6/' . date("Y"),0,1,'L');
$pdf->Cell(3,0.6,'Lampiran',0,0,'L');
$pdf->Cell(4,0.6,': 1 Lembar',0,1,'L');
$pdf->Cell(3,0.6,'Perihal',0,0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(4,0.6,': Surat Pemberitahuan',0,0,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(5,0.6,'',0,0,'L');
$pdf->Cell(4,0.6,'Kepada YKH;',0,1,'L');
$pdf->Cell(12,0.6,'',0,0,'L');
$pdf->Cell(4,0.6,'Ibu/ Bpk. '. $lih['ket_wali'],0,1,'L');
$pdf->Cell(12,0.6,'',0,0,'L');
$pdf->MultiCell(7,0.6,'Wali dari ananda '. $lih['nama'],0,'L');
$pdf->Cell(12,0.6,'',0,0,'L');
$pdf->Cell(4,0.6,'Di tempat',0,1,'L');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(3,0.6,'Assalaamu\'alaikum warohmatullaahi wabarokaatuh',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(19, 0.6, '', 0, 1, 'C');
$pdf->multiCell(19,0.7,'Puji syukur senantiasa kita panjatkan kehadirat Allah SWT atas segala limpahan rahmat, karunia dan rizki-Nya yang berlimpah ruah. Sholawat serta salam semoga selalu tercurah kepada Rasulullah saw, beserta keluarganya, sahabat dan orang-orang yang senantiasa mengikuti jejak langkah beliau hingga akhir zaman. Selanjutnya kami atas nama bendahara Kuttab Nurussalam memberitahukan bahwa;',0,'J');
$pdf->Cell(3,0.6,'Nama',0,0,'L');
$pdf->Cell(4,0.6,': '. $lih['nama'],0,1,'L');
$pdf->Cell(3,0.6,'Kelas',0,0,'L');
$pdf->Cell(4,0.6,': '. $lih['kelas'],0,1,'L');
$pdf->Cell(3,0.6,'Wali',0,0,'L');
$pdf->Cell(4,0.6,': '. $lih['ket_wali'],0,1,'L');
$pdf->Cell(3,0.6,'Alamat',0,0,'L');
$pdf->MultiCell(16,0.6,': '. $lih['alamat'] . ' ' . $lih['dusun'] . ', Desa. ' . $lih['desa'] . ', Kec. ' . $lih['kec'] . ', Kab. ' . $lih['kab'],0,'L');
$pdf->Cell(19, 0.6, '', 0, 1, 'C');
$pdf->multiCell(19,0.6,'Menurut database kami masih mempunyai tunggakan sebagai berikut;',0,'J');


function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
}  

$date = date("Y-m-d");	//tgl sekarang
$y = $_GET['yer'];		//tgl yang diipilih
$yr = substr($y,1,4);
$taun = substr($y,1,4) . '-07-01';
$tahr = substr($y,1,4)+1 . '-06-30';
$timeStart = strtotime("$taun");
if ($yr == date("Y")){
	$timeEnd = strtotime("$date");
	}else{
	$timeEnd = strtotime("$tahr");
	}
// Menambah bulan ini + semua bulan pada tahun sebelumnya
$numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
// menghitung selisih bulan
$numBulan += date("m",$timeEnd)-date("m",$timeStart);

	

$query=mysql_query("select * from beban where nis =" . $nis ."and thn=" . $y );
while($leh=mysql_fetch_assoc($query)){

$query=mysql_query("select * from exception where nis =" . $nis ."and thn=" . $y );
while($exc=mysql_fetch_assoc($query)){

$tot=mysql_query("select sum(if(nis=". $nis .", daftar, 0)) as dft, sum(if(nis=". $nis .", bangunan, 0)) as bgn, sum(if(nis=". $nis .", pendidikan, 0)) as pdd, sum(if(nis=". $nis .", seragam, 0)) as srg, sum(if(nis=". $nis .", spp, 0)) as sp, sum(if(nis=". $nis .", makan, 0)) as mkn, sum(if(nis=". $nis .", lain, 0)) as lin, sum(if(nis=". $nis .", jumlah, 0)) as jml from bayaran where nis =" . $nis . "and thn=" . $y );
while($see=mysql_fetch_assoc($tot)){
	$tdft=$leh['daftar']-($see['dft']+$exc['daftar']);
	$tbgn=$leh['bangunan']-($see['bgn']+$exc['bangunan']);
	$tpdd=$leh['pendidikan']-($see['pdd']+$exc['pendidikan']);
	$tsrg=$leh['seragam']-($see['srg']+$exc['seragam']);
	$tspp=($numBulan*$leh['spp'])-($see['sp']+$exc['spp']);
	$tmkn=($numBulan*$leh['makan'])-($see['mkn']+$exc['makan']);
	$tlin=($numBulan*$leh['asrama'])-($see['lin']+$exc['asrama']);
	$tjml=$tdft+$tbgn+$tpdd+$tsrg+$tspp+$tmkn+$tlin;
	
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'1. Infaq Pendaftaran',0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tdft,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'2. Infaq Bangunan',0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tbgn,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'3. Infaq Pendidikan',0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tpdd,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'4. Seragam',0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tsrg,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$timestamp= time();
$pdf->Cell(6,0.6,'5. SPP s.d. ' . indonesian_date($timestamp, 'F Y','') ,0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tspp,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'6. Katering s.d. ' . indonesian_date($timestamp, 'F Y','') ,0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tmkn,0,'',','),0,1,'R');
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'7. Asrama',0,0,'L');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tlin,0,'',','),0,1,'R');
$pdf->SetFont('Arial','B',10);
$pdf->Cell(3,0.6,'',0,0,'L');
$pdf->Cell(6,0.6,'JUMLAH',0,0,'R');
$pdf->Cell(2,0.6,'Rp. ',0,0,'R');
$pdf->Cell(3,0.6,number_format($tjml,0,'',','),0,1,'R');
$pdf->SetFont('Arial','',10);
$dateline= date('Y-m-d', strtotime('+1 month',$timestamp));
$pdf->Cell(19, 0.6, '', 0, 1, 'C');
$pdf->multiCell(19,0.6,'Demi kelancaran dan berjalannya kegiatan belajar di Kuttab Nurussalam, besar harapan kami agar Ibu/ Bapak bisa segera melunasi tunggakan tersebut sebelum tanggal ' . indonesian_date($dateline, 'j F Y','') . '. Demikian surat keterangan ini kami sampaikan, mohon maklum adanya. Atas perhatiannya kami ucapkan Jazakumullah khoiron katsiron.' ,0,'J');
$pdf->Cell(19, 0.6, '', 0, 1, 'C');
$pdf->SetFont('Arial','I',10);
$pdf->Cell(3,0.6,'Wassalaamu\'alaikum warohmatullaahi wabarokaatuh',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->ln(0.5);
$pdf->Cell(19, 0.6, '', 0, 1, 'C');
$pdf->Cell(9.5, 0.6, '', 0, 0, 'C');
$pdf->Cell(9.5, 0.6,"Ciamis, ". indonesian_date($timestamp, 'd F Y', ''), 0, 1, 'C');
$pdf->Cell(9.5, 0.6,'Kepala Kuttab', 0, 0, 'C');
$pdf->Cell(9.5, 0.6,'Bag. Bendahara', 0, 1, 'C');

$pdf->ln(1.25);
$pdf->Cell(9.5, 0.6, '___________________', 0, 0, 'C');
$pdf->Cell(9.5, 0.6, '___________________' , 0, 0, 'C');








$pdf->ln(5);
$pdf->SetFont('Arial','B',13);
$pdf->Cell(19,0.7,'',0,1,'R');
$ts=strtotime('d M Y', $timeStart);
$te=strtotime('d M Y', $timeEnd);
$pdf->Cell(19,0.7,'REKAP INFAQ SANTRI TAHUN AJARAN '. date("Y",$timeStart) .'-'. (date("Y",$timeStart)+1) ,0,1,'R');
$pdf->SetFont('Arial','',10);
$pdf->Cell(19,0.6,'Nomor Induk : ' . $nis,0,1,'R');
$pdf->Cell(19,0.6,'Nama : ' . $lih['nama'],0,1,'R');
$pdf->Cell(19,0.6,'Wali : ' . $lih['ket_wali'],0,1,'R');

$pdf->ln(1);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(2, 0.8, 'TGL', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'Daftar', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Bangunan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Pendidikan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Seragam', 1, 0, 'C');
$pdf->Cell(1.5, 0.8, 'BLN', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'SPP', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Makan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Lain', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 1, 'C');

$no=1;
$pdf->SetFont('Arial','',8);
$query=mysql_query("select * from bayaran where nis =" . $nis ."and thn=" . $y . "order by tgl asc");
while($lihat=mysql_fetch_assoc($query)){
	$pdf->Cell(2, 0.8, $lihat['tgl'],1, 0, 'C');
	$pdf->Cell(1.5, 0.8, number_format($lihat['daftar'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['bangunan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['pendidikan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['seragam'],0,'',','), 1, 0,'R');
	$pdf->Cell(1.5, 0.8, $lihat['bln'], 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($lihat['spp'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['makan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['lain'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($lihat['jumlah'],0,'',','), 1, 1,'R');
	$no++;
}

$pdf->SetFont('Arial','B',8);
	$pdf->Cell(2, 0.8, '', 0, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($see['dft'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['bgn'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['pdd'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['srg'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, '', 0, 0,'C');
	$pdf->Cell(1.5, 0.8, number_format($see['sp'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['mkn'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['lin'],0,'',','), 0, 0,'R');
	$pdf->Cell(2, 0.8, number_format($see['jml'],0,'',','), 0, 1,'R');
	$pdf->Cell(2, 0.8, 'Beban : ', 0, 0,'R');		
	$pdf->Cell(1.5, 0.8, number_format($leh['daftar']-$exc['daftar'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($leh['bangunan']-$exc['bangunan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($leh['pendidikan']-$exc['pendidikan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($leh['seragam']-$exc['seragam'],0,'',','), 1, 0,'R');
	$pdf->Cell(1.5, 0.8, $numBulan, 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format(($numBulan*$leh['spp'])-$exc['spp'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format(($numBulan*$leh['makan'])-$exc['makan'],0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format(($numBulan*$leh['asrama'])-$exc['asrama'],0,'',','), 1, 0,'R');
	$jexc = $exc['daftar']+$exc['bangunan']+$exc['pendidikan']+$exc['seragam']+$exc['spp']+$exc['makan']+$exc['asrama'];
	$jbbn = $leh['daftar']+$leh['bangunan']+$leh['pendidikan']+$leh['seragam']+($numBulan*$leh['spp'])+($numBulan*$leh['makan'])+($numBulan*$leh['asrama'])-$jexc;
	$pdf->Cell(2, 0.8, number_format($jbbn,0,'',','), 1, 1,'R');
	$pdf->Cell(2, 0.8, 'Tunggakan : ', 0, 0,'R');	
	$pdf->Cell(1.5, 0.8, number_format($tdft,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tbgn,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tpdd,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tsrg,0,'',','), 1, 0,'R');
	$pdf->Cell(1.5, 0.8, $tspp/$leh['spp'], 1, 0,'C');
	$pdf->Cell(2, 0.8, number_format($tspp,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tmkn,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tlin,0,'',','), 1, 0,'R');
	$pdf->Cell(2, 0.8, number_format($tjml,0,'',','), 1, 1,'R');
}	
}
}
}
$pdf->Output("laporan_buku.pdf","I");

?>

