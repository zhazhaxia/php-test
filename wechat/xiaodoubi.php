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
	
	$data = "chat=晚上好";//POST提交内容
	$url = "http://www.xiaodoubi.com/bot/chat.php";//查询地址
	$ch = curl_init ();
// print_r($ch);
curl_setopt ( $ch, CURLOPT_URL, $url );
curl_setopt ( $ch, CURLOPT_POST, 1 );
curl_setopt ( $ch, CURLOPT_HEADER, 0 );
curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
$output = curl_exec ( $ch );
curl_close ( $ch );
	echo $output;
	//echo $out;