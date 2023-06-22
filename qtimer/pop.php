<html>
<head>
	<link rel="stylesheet" type="text/css" href="animate.css">
</head>
<body>
<center>
<br/><br/>
<img class="animated pulse" src="qtimer.png" width="400" height="52">
<h4 class="animated infinite flash">D O . N O T . C L O S E . T H I S . W I N D O W !</h1><h4>

<?php
date_default_timezone_set('Asia/Jakarta');
$time=date('D H:i');
echo "$time<br/>";

//silahkan set/ganti WAKTU ALARM berbunyi:
$a1= "Mon 07:05";
$a2= "Mon 10:00";
$a3= "Mon 11:30";
$a4= "Mon 13:45";
$b1= "Tue 07:05";
$b2= "Tue 10:00";
$b3= "Tue 11:30";
$b4= "Tue 13:45";
$c1= "Wed 07:05";
$c2= "Wed 10:00";
$c3= "Wed 11:30";
$c4= "Wed 13:45";
$d1= "Thu 07:05";
$d2= "Thu 10:00";
$d3= "Thu 11:30";
$d4= "Thu 13:45";
$e1= "Fri 07:05";
$e2= "Fri 10:00";
$e3= "Fri 11:30";
$e4= "Fri 13:45";

if ($time == "$a1") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30a.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$a2") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30b.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$a3") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30c.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$a4") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30d.mp3" type="audio/mpeg">
</audio><?php

} elseif ($time == "$b1") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29a.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$b2") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29b.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$b3") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29c.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$b4") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29d.mp3" type="audio/mpeg">
</audio><?php

} elseif ($time == "$c1") {    
?><audio controls autoplay="autoplay">
    <source src="audio/28a.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$c2") {    
?><audio controls autoplay="autoplay">
    <source src="audio/28b.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$c3") {    
?><audio controls autoplay="autoplay">
    <source src="audio/28c.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$c4") {    
?><audio controls autoplay="autoplay">
    <source src="audio/28d.mp3" type="audio/mpeg">
</audio><?php

} elseif ($time == "$d1") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30a.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$d2") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30b.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$d3") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30c.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$d4") {    
?><audio controls autoplay="autoplay">
    <source src="audio/30d.mp3" type="audio/mpeg">
</audio><?php

} elseif ($time == "$e1") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29a.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$e2") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29b.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$e3") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29c.mp3" type="audio/mpeg">
</audio><?php
} elseif ($time == "$e4") {    
?><audio controls autoplay="autoplay">
    <source src="audio/29d.mp3" type="audio/mpeg">
</audio><?php

}
?>

</center>
</body>
</html>
