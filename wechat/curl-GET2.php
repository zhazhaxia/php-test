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

	//curl处理GET数据
	$ch = curl_init();
	$url ="http://api100.duapp.com/joke/?appkey=0020130430&appsecert=fa6095e113cd28fd";
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$outopt = curl_exec($ch);
	curl_close($ch);
	echo $outopt;
