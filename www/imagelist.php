<?php
$img_dir = "photos/";
$images = scandir($img_dir,0);
$count=0;
$arr = array();

foreach($images as $img) {
if($img === '.' || $img === '..') {continue;}
 
	if (  (preg_match('/.jpg/',$img))  || 
		  (preg_match('/.JPG/',$img))  || 
		  (preg_match('/.gif/',$img))  || 
		  (preg_match('/.GIF/',$img))  ||
		  (preg_match('/.tiff/',$img)) || 
		  (preg_match('/.png/',$img))  ||
		  (preg_match('/.PNG/',$img)) ) {		
		$arr[$count++] = $img_dir.$img;

	} else { continue; }	
}

header('Content-Type: application/json');
echo json_encode($arr); //requires openwrt package php5-mod-json

?>


