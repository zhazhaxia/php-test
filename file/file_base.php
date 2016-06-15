<?php
	header("Content-Type: text/html; charset=utf-8");//设置编码格式
	//绝对路径
	$path='D:\APMServ5.2.6\www\htdocs\PHP\file\file_base.php';
	
	//echo basename($path);//输出绝对路径的文件名
	
	//echo dirname($path);//返回文件的目录D:\APMServ5.2.6\www\htdocs\PHP\file
	
	//print_r(pathinfo($path));//获取路径文件的信息Array ( [dirname] => D:\APMServ5.2.6\www\htdocs\PHP\file [basename] => file_base.php [extension] => php [filename] => file_base )
	//pathinfo()返回一个数组
	/*$array_path=pathinfo($path);
	echo $array_path['dirname'];
	echo $array_path['basename'];*/
	
	//相对路径
	$path2='file_base.php';
	
	//echo realpath($path2);//获取文件的绝对路径D:\APMServ5.2.6\www\htdocs\PHP\file\file_base.php
	
	//相对路径2
	$path3='../test.php';
	
	//echo realpath($path3);//D:\APMServ5.2.6\www\htdocs\PHP\test.php
	
	/*---------文件大小，磁盘信息----------------------------------------*/
	//echo filesize($path);//返回字节915
	//echo round(filesize($path)/1024,2).'KB';//保留两位数计算文件大小
	
	//echo round(disk_free_space('c:')/1024/1024/1024,2).'GB';//查看磁盘可用空间
	
	//echo round(disk_total_space('c:')/1024/1024/1024,2).'GB';//总空间大小
	
	/*----------------时间---------------------*/
	//echo fileatime($path);//返回时间戳1408458629
	
	//格式化本地日期
	
	//echo date('Y-m-d H:i:s');//默认是伦敦时间
	
	//获取中国时间
	/*date_default_timezone_set('Asia/Shanghai');
	echo date('Y-m-d H:i:s');*/
	
	//文件相关时间
	date_default_timezone_set('Asia/Shanghai');
	echo '最后访问时间'.date('Y-m-d H:i:s',fileatime($path)).'<br />';
	echo '权限所有者等'.date('Y-m-d H:i:s',filectime($path)).'<br />';
	echo '内容修改时间'.date('Y-m-d H:i:s',filemtime($path)).'<br />';
	
	
?>