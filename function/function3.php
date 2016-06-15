<?php
header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试
?>
<?php
	
	/*include "function1.php";
	echo fnArea3();*/
	
	/*include_once "function1.php";
	echo fnArea3();*/
	
	/*require "function1.php";
	echo fnArea3(1);*/
	
	/*require_once "function1.php";
	echo fnArea3();*/
	//include如果文件不存在就会出错警告，然后继续执行
	//require文件不存在会警告并且出错，然后停止执行，这个推荐使用
	
	/*---------魔法常量------------------------------*/

	$file=__FILE__;
	echo $file;	//返回当前文件绝对路径D:\APMServ5.2.6\www\htdocs\PHP\function\function3.php
	echo dirname($file);
	
	//其他魔法常量不是很常用
?>