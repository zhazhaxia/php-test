<?php 
$ifn = "002.jpg";   //-----------原图像----
$ofn = "test_thumb.jpg";  //---剪切后保存的图像名----
$ext = strtoupper(end(explode('.',$ifn))); 
if(is_file($ifn) && ($ext == "JPG" || $ext == "JPEG")){ 
$source = imagecreatefromjpeg($ifn); 
}elseif(is_file($ifn) && $ext == "PNG"){ 
$source = imagecreatefromPNG($ifn); 
}elseif(is_file($ifn) && $ext == "GIF"){ 
$source = imagecreatefromGIF($ifn); 
} 
$sourceWidth  = imagesx($source); 
$sourceHeight = imagesy($source); 
$thumbWidth = $_POST['w']; 
$thumbHeight = $_POST['h']; 
$thumb = imagecreatetruecolor($thumbWidth, $thumbHeight); 
$x1 = $_POST['x1']; 
$y1 = $_POST['y1']; 
$x2 = $_POST['x2']; 
$y2 = $_POST['y2']; 
imagecopyresampled($thumb, $source,0,0,$x1,$y1,$thumbWidth,$thumbHeight,$thumbWidth,$thumbHeight); 
imagejpeg($thumb, $ofn);
?>