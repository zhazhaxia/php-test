<?php
	/**
	 * 
	 * @authors 云知梦-军哥
	 * @email zhanglijun@lampym.com
	 * @date    2014-08-23 15:46:36
	 * @link    http://www.lampym.com
	 * @version 1.0
	 * @course 《军哥带你玩转微信开发》系列教程之初级篇
	 */

	//curl模拟GET请求
	$ch = curl_init();
	$url ="http://www.baidu.com";
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_exec($ch);
	curl_close($ch);
