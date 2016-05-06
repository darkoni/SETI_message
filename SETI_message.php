<?php

$url      = "http://www2.mps.mpg.de/homes/heller/downloads/files/SETI_message.txt";
$filename = "SETI_message_TEST.txt";
$gifname  = "SETI_message.gif";

// ========================
// === get SETI message ===

if(!file_exists($filename)){
$txt = file_get_contents($url);
       file_put_contents($filename,$txt);
} else
$txt = file_get_contents($filename);

// ==========================
// === findout image size ===

$l = strlen($txt);
$w = strpos($txt,'0'); //  359
$h = $l/$w;            // 5299

// ====================
// === create image ===

$testGD = get_extension_funcs("gd");
if(!$testGD)die("Error: GD is not installed.\ndnf install php-gd\n");
// echo"<pre>".print_r($testGD,true)."</pre>";

$im    = imagecreatetruecolor($w,$h);
$white = imagecolorallocate($im,255,255,255);

$a=0;for($y=0;$y<=$h;$y++){
$s=substr($txt,$a,$w);
for($x=0;$x<$w;$x++)
if('0'==substr($s,$x,1))
imagesetpixel($im,$x,$y,$white);
$a+=$w;
}

// ==========================
// === save image to file ===

imagegif($im,$gifname);

?>
