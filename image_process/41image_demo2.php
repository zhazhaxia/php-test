<?php
		//裁剪图片，图片大小容积改变
		
		
		
	//加载已有的图形
	header('Content-Type:image/png');
	
	list($width,$height)=getimagesize('1.png');//获取图片大小宽高
	$x=100;//xy开始在原图裁剪的点
	$y=100;
	$_width=250;//目标图像高宽
	$_height=300;
	$im=imagecreatetruecolor($_width,$_height);

	$_im=imagecreatefrompng('1.png');
	//裁剪
	imagecopy($im, $_im, 0, 0, $x, $y, $_width, $_height);
	
	imagepng($im);//将图片输出到浏览器
	imagepng($im,'./p/2.png');//将图片保存
	imagedestroy($im);
	imagedestroy($_im);
	
?>