<?php

				//设置字体



	define('__DIR__',dirname(__FILE__).'\\');//定义一个路径常量
	//加载已有的图形
	header('Content-Type:image/png');
	
	//载入图像，编辑，加入水印
	$im=imagecreatefrompng(__DIR__.'44.png');	
	$white=imagecolorallocate($im,255,255,255);
	
	$text=iconv('gbk','utf-8','渣渣夏');
	$font='C:\Windows\Fonts\STXINGKA.TTF';
	//第二个参数是大小，第三个参数是旋转角度，后两个是坐标
	imagettftext($im,30,20,15,120,$white,$font,$text);
	
	imagepng($im);
	imagedestroy($im);
	
?>