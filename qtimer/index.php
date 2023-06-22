<!DOCTYPE html>
<html>
<head>
	<title>QTIMER</title>
	<link rel="stylesheet" type="text/css" href="animate.css">
	<!-- meta refresh yang merefresh halaman ini tiap 10 detik untuk periksa waktu -->
	<meta http-equiv='refresh' content='60;URL=index.php' />
</head>
<body>	
	<div class="container">  
		<center><br/><br/><br/><h2>
<?php
/* 
 * PHP-Digital Clock 
 * @author Angelos Staboulis 
 * @town Komotini 
 * @country Greece 
 */ 
class DigitalClock { 
    /**Print Digital Clock**/ 
    function jsDigitalClock($left,$top){ 
                    $div1='"div1"'; 
                    $proc='"printTime()"'; 
                    $style="margin-left:$left"."px;"."margin-top:$top"."px;"; 
                    echo "<div style=$style id=".$div1.">"; 
                    $retvalue="<script language=javascript>". 
                           "var int=self.setInterval(".$proc.",1000);". 
                           "function printTime(){". 
                           "var d=new Date();". 
                           "var t=d.toLocaleTimeString();". 
                           "document.getElementById(".$div1.").innerHTML=t;". 
                           "}". 
                           "</script>"; 
                    echo $retvalue; 
                    echo "</div>"; 
    } 
   
    /** Get Hours **/ 
    function getHours(){ 
      $hours=getdate(); 
      return $hours["hours"]; 
    } 
    /** Get Minutes **/ 
    function getMinutes(){ 
      $minutes=getdate(); 
      return $minutes["minutes"]; 
        
    } 
    /** Get Seconds **/ 
    function getSeconds(){ 
      $seconds=getdate(); 
      return $seconds["seconds"]; 
    } 
} 
$clock=new DigitalClock();
echo $clock->jsDigitalClock(0, 0);
?>
			</h2>
			<h1 class="animated bounce">. . t h i s . i s . t h e . a p l i c a t i o n . o f . .</h1>
			<img class="animated pulse" src="qtimer.png" width="1001" height="129">
			<br/><h1 class="animated infinite flash">D O . N O T . C L O S E . T H I S . W I N D O W !</h1><h2>
			
<?php
date_default_timezone_set('Asia/Jakarta');
$time=date('H:i');

//silahkan set/ganti WAKTU ALARM berbunyi: echo "$time<br/>";
$a1= "07:05";
$a2= "10:00";
$a3= "11:30";
$a4= "13:45";

$t=date('H');
$d=date('D');
$dd=date('D')+1;
switch ($t){
	case "05" :
	echo "The Next Verses will Play on $d, $a1";
	break;
	case "06" :
	echo "The Next Verses will Play on $d, $a1";
	break;
	case "07" :
	echo "The Next Verses will Play on $d, $a2";
	break;
	case "08" :
	echo "The Next Verses will Play on $d, $a2";
	break;
	case "09" :
	echo "The Next Verses will Play on $d, $a2";
	break;
	case "10" :
	echo "The Next Verses will Play on $d, $a3";
	break;
	case "11" :
	echo "The Next Verses will Play on $d, $a3";
	break;
	case "12" :
	echo "The Next Verses will Play on $d, $a4";
	break;
	case "13" :
	echo "The Next Verses will Play on $d, $a4";
	break;
	case "14" :
	echo "The Next Verses will Play Tomorrow on $a1";
	break;
	case "15" :
	echo "The Next Verses will Play Tomorrow on $a1";
	break;

}

//jika WAKTU AKTUAL = WAKTU ALARM , maka halaman redirect ke alarm.php
if ($time == "$a1" || $time == "$a2" || $time == "$a3" || $time == "$a4") {    
?>
<script>
window.onload = function () {
    window.open('pop.php','My Window','height= 480 px,width =640 px,');
};
</script>
<?php
}
?>
		</center>
	</div>
</body>
</html>
