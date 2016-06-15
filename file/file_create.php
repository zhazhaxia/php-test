<?php
	header("Cntent-Type: text/html; charset=utf-8");//设置编码格式
	
	//打开一个文件(与关闭文件一起操作)
	//第一个参数表明打开哪个文件，第二个是指模式。w只写。w，如果test.txt已经有了，且有数据了，那么就删除这个文件，重新创建。如果没有test.txt这个文件，那么就自行创建
	//fopen是资源类型resource句柄
	/*$file=fopen('test.txt','w');	
	$content='this is jerry';
	
//文件写方法一	fwrite($file,$content,strlen($content));//将新内容写入文件
	fclose($file);
	
	//文件写入方法二
	//file_put_contents('test.txt','this is jerry and joy face');//这种写法是未来趋势
	*/
	
	/*--------------------------------------------------------*/
	$file=fopen('test1.txt','w');
	$content="this is\r\n test 2";
	fwrite($file,$content,strlen($content));
	fclose($file);
	
	
	
	
	
	
?>