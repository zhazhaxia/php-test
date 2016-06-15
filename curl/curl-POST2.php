<?php
	header("content-type:text/html;charset=utf-8");
	/**
	 * 
	 * @authors 云知梦-军哥
	 * @email zhanglijun@lampym.com
	 * @date    2014-08-23 15:46:36
	 * @link    http://www.lampym.com
	 * @version 1.0
	 * @course 《军哥带你玩转微信开发》系列教程之初级篇
	 */

	//模拟POST上传文件

	$post = array("file"=>"@D:\AppServ\www\curl\lisheng.jpg");
	$url = "http://localhost:8080/curl/upload.php";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,1);//模拟POST
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post);//POST内容
	curl_exec($ch);
	curl_close($ch);
	
