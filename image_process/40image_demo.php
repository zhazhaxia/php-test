<?php

	//加载已有的图形
	header('Content-Type:image/png');
	
	//载入图像，编辑，加入水印
	$im=imagecreatefrompng('44.png');	
	$white=imagecolorallocate($im,255,255,255);
	imagestring($im,5,10,10,'jerry_yahui',$white);
	
	imagepng($im);
	imagedestroy($im);
	
?>