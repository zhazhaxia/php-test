<?php
		//微缩图，图片大小容积改变
		
		
		
	//加载已有的图形
	header('Content-Type:image/png');
	
	list($width,$height)=getimagesize('1.png');//获取图片大小宽高
	//将原图缩放40%
	$_width=$width;
	$_height=$height;
	
	$im=imagecreatetruecolor($_width,$_height);
	$im2=imagecreatetruecolor($_width,$_height);
	$p=0;
	
	$_im=imagecreatefrompng('1.png');
	//将原图重新采样，拷贝到新图上，最后按比例输出
	imagecopyresampled($im,$_im,$p,$p,$p,$p,$_width-$p,$_height-$p,$width,$height);

	
	
	imagepng($im);
	imagedestroy($im);
	imagedestroy($_im);
	
?>