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

	//curl模拟GET请求
	$appid = "wx67f799db9921c2d8";
	$appsecret = "9172757aec2bf71abb471b35fafaa065";
	$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$outopt = curl_exec($ch);
	curl_close($ch);
	echo $outopt;
	
