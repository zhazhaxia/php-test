<?php
	
	//一般生成的图像可以是jpeg,png,gif,bmp
	//第一步设置文件MIME类型，输出类型（默认html文件header('Content-Type:text/html');）
	header('Content-type: image/png;');
	//第二步，创建一个图形区域，图像背景
	$im=imagecreatetruecolor(200,200);//真彩色，没有填充，默认黑色
	
	//第三步，在空白区域绘制颜色、文字、线条。。。
	$blue=imagecolorallocate($im,0,102,255);//填充颜色
	imagefill($im,0,0,$blue);//指定位置填充
	
	//在蓝色背景输出一条白色直线，文字等
	$white=imagecolorallocate($im,255,255,255);
	imageline($im,0,0,200,200,$white);
	imageline($im,200,0,0,200,$white);//画线
	imagestring($im,5,20,100,'jerry',$white);//文字，5是大小，20，100是坐标	
	
	//第五步,输出最终图形
	imagepng($im);
	
	//第六部，将所有资源清空
	imagedestroy($im);
	
?>