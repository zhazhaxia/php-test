<?php
	header("content-type:text/html;charset=utf-8");
	$url="http://dev.skjqr.com/api/weixin.php?email=2230720481@qq.com&appkey=e9963cee535915b744795623f2eb4f23&msg=hello";
	$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$outopt = curl_exec($ch);
		curl_close($ch);
		echo $outopt;