<?php
	header("Cntent-Type: text/html; charset=utf-8");//设置编码格式
	
	//文件追加写
	/*$file=fopen('test.txt','a');	
	$content="jerry comes here again\r\n";
	fwrite($file,$content,strlen($content));
	fclose($file);*/
	/*--------------------------------------------*/
	//读出文件
	$file=fopen('test3.txt','r');	
	//echo fgetc($file);//读出一个字符并将指针移到下一个字符
	//echo fgetc($file);
	
	//echo fgets($file);//读出文件一行
	//echo fgets($file,4);//返回length-1个字节的字符串
	
	//echo fgetss($file);//可以过滤HTML
	
	//echo fread($file,2);//从文件最多读出length个字符，与上面-1的区别
	
	//输出文件指针处所有剩余字符
	/*echo fgetc($file);
	echo fgetc($file);
	echo fgetc($file);
	echo '<br />';
	echo fpassthru($file);//输出了剩余的字符*/
	
	
	
	//file是按照每行来分组放在一个数组
	//$file_arr=file('test3.txt');
	//echo $file_arr[2];
	
	//readfile是将整个文件读出来，readfile本身能够输入浏览器，所以不需要echo
	//readfile('test3.txt');
	
	
	//feof是否到达文件的结尾处
	while(!feof($file)){
		echo fgetc($file);
	}
	
	fclose($file);
	
	
	
	
?>