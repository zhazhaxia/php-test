<?php

	//简单的验证码
	
	//随机数echo mt_rand(0,100);
	//实现0-9a-z十六进制
	//echo dechex(mt_rand(0,15));//dechex数字转为十六进制
	for($i=0;$i<4;$i++){
		$nmsg.=dechex(mt_rand(0,15));
	}
	//echo $nmsg;
	//验证码制成图片
	header('Content-Type:image/png');
	$im=imagecreatetruecolor(74,25);
	$blue=imagecolorallocate($im,0,102,255);
	$white=imagecolorallocate($im,255,255,255);
	imagefill($im,0,0,$blue);
	imagestring($im,5,20,5,$nmsg,$white);
	imagepng($im);
	imagedestroy($im);
	
?>