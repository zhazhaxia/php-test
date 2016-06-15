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

	//模拟POST请求
	$flight = "CZ3109"; //查询航班号
	$post = "queryType=flightNum&flightNum={$flight}";//POST提交内容
	$url = "http://eb.csair.com/flightQuery/fltQueryETicketResultN.jsp";//查询地址
	//查询地址
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_REFERER,"http://www.csair.com/");//模拟来源
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,1);//模拟POST
	curl_setopt($ch,CURLOPT_POSTFIELDS,$post);//POST内容
	curl_exec($ch);
	curl_close($ch);
