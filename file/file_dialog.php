<?php
header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试
?>
<?php
	/*-----------------查看文件是否存在-----------------------*/
	
	//读取一个文件的时候，要确保这个文件一定存在，以免出错。
	/*if(file_exists('test.txt')){
		echo '文本存在';
	}else{
		echo '文件不存在';
	}*/
	
	//文件大小、字节
	//echo filesize('test.txt');
	
	//删除文件
	//unlink('123.txt');
	
	//rewind倒回文件指针的位置
	/*$file=fopen('test.txt','r');
	echo fgetc($file);
	echo fgetc($file);
	rewind($file);
	echo fgetc($file);
	fclose($file);*/
	//ftell返回文件指针位置
	/*$file=fopen('test.txt','r');
	echo fgetc($file);
	echo fgetc($file);
	rewind($file);
	echo fgetc($file);
	echo ftell($file);
	fclose($file);*/
	//在文件指针中定位
	/*$file=fopen('test.txt','r');
	echo fgetc($file);
	echo fgetc($file);
	rewind($file);
	echo fgetc($file);
	echo ftell($file);
	fseek($file,20);
	echo fgetc($file);
	echo ftell($file);
	fclose($file);*/
	
	
	/*------------------------------------*/
	//文件锁定
	/*$file=fopen('test.txt','ab');//a表示追加,b表示二进制，这样可移植性好。
	flock($file,LOCK_EX);//锁定
	fwrite($file,'lock');
	flock($file,LOCK_UN);
	fclose($file);*/
	
	/*-----目录------------------------*/
	
	
	$path='D:\APMServ5.2.6\www\htdocs';
	/*//打开一个目录
	$dir=opendir($path);
	//读出目录
	while(!!$file=readdir($dir)){
		echo $file."<br/>";
	}
	//关闭目录
	closedir($dir);*/
	
	/*//打印出里面的目录和文件
	echo "<pre>";
	print_r(scandir($path));
	echo "</pre>";*/
	
	/*//删除一个目录
	$path2='D:\APMServ5.2.6\www\htdocs\php\file\me';
	rmdir($path2);*/
	
	
	/*------------------------*/
	//重命名，第一个参数是原文件（目录）名
	rename('123.txt','456.txt');//修改文件名
	rename('me','123');//修改目录名
	
	
	
	
	
	
	
	
?>