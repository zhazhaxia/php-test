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
	$url = "http://api.map.baidu.com/telematics/v3/weather?location=哈尔滨&output=json&ak=BF1c59ca536f947ca6614f4967ce061a";
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$outopt = curl_exec($ch);
	curl_close($ch);
	$weather_arr = json_decode($outopt,true);

	$dataArr = array();
	$dataArr[] = array(
					"Title" =>date('y-m-d h:i:s',time()),
					"Description" => "您现在看到的是您所在位置最近四天的天气情况",
					"PicUrl"=>"http://pic27.nipic.com/20130315/6608733_170434195000_2.jpg",
					"Url"=>''
				);
	$tempArr = $weather_arr['results'][0]['weather_data'];
	foreach($tempArr as $v){
		$dataArr[] = array(
				"Title" => $v['date'],
				"Description" => $v['weather'].' '.$v['wind'].' '.$v['temperature'],
				"PicUrl"=>$v['dayPictureUrl'],
				"Url"=>''
			);
	}

	echo "<pre>";
	print_r($dataArr);
	echo "</pre>";
	
	$st="  我我我  ";
	echo '*'.$st.'*';
	echo '*'.trim($st).'*';