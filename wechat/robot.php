<?php
	header("content-type:text/html;charset=utf-8");
	
	// $ans=simsimi("你是谁");
	// echo $ans;
	// function simsimi($keyword) {
	// 	 $keyword = urlencode(urlencode($keyword));
	// 	 //----------- 获取COOKIE ----------//
	// 	 $url = "http://www.simsimi.com/";
	// 	 $ch = curl_init($url);
	// 	 curl_setopt($ch, CURLOPT_HEADER,1);
	// 	 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	// 	 $content = curl_exec($ch);
	// 	 list($header, $body) = explode("\r\n\r\n", $content);
	// 	 preg_match("/set\-cookie:([^\r\n]*);/iU", $header, $matches);
	// 	 $cookie = $matches[1];
	// 	 curl_close($ch);
	// 	 //----------- 抓 取 回 复 ----------//
	// 	 $url = "http://www.simsimi.com/func/req?lc=ch&msg=$keyword&ft=0.0";
	// 	 $ch = curl_init($url);
	// 	 curl_setopt($ch, CURLOPT_REFERER, "http://www.simsimi.com/talk.htm?lc=ch");
	// 	 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	// 	 curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	// 	 $content = json_decode(curl_exec($ch),1);
	// 	 curl_close($ch);
	// 	 if($content['result']=='100') {
	// 	  $content['response'];
	// 	  return $content['response'];
	// 	 } else {
	// 	  return '我还不会回答这个问题...';
	// 	}
	// }





	// $msg = '你是谁？';
 //    //URL中的参数：
 //    // sandbox.api.simsimi.com/request.p 是试用账号的API
 //    // key : 用户秘钥，这里是试用秘钥100次请求/天
 //    // ft : 是否过滤骂人的词汇
 //    // lc : 语言设置
 //    // text : 发送信息
 //    $url = 'http://sandbox.api.simsimi.com/request.p?key=b376670e-6f2d-437a-8b0f-33678b97a320&ft=0.0&lc=ch&text='.$msg;
 //    $ch = curl_init();
 //    curl_setopt($ch, CURLOPT_URL, $url); 
 //    curl_setopt($ch,CURLOPT_HEADER,0);
 //    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 5.1; rv:12.0) Gecko/20120101 Firefox/17.0');
 //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
 //    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true) ;
 //    $res = curl_exec($ch);
 //    curl_close($ch);
 //    echo $res;



	$msg="你好";//这里是传递到小i机器人的语句
    $app_key="wx4988795d86800d40";//这里填入你的小i机器人key
    $app_secret="4faeed9fa087c5f0a52396cb61e78762";//这里填入你的小i机器人secret
    $realm = "xiaoi.com";
    $method = "POST";
    $uri = "/robot/ask.do";
    $nonce="";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
    for ( $i = 0; $i < 40; $i++) 
    $nonce .= $chars[ mt_rand(0, strlen($chars) - 1) ]; 
    $HA1 = sha1($app_key . ":" . $realm . ":" . $app_secret);
    $HA2 = sha1($method . ":" . $uri);
    $sign = sha1($HA1 . ":" . $nonce . ":" . $HA2);
    $msg=urlencode($msg);
    $openid=urlencode($openid);
    $url="http://nlp.xiaoi.com/robot/ask.do";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth:    app_key="'.$app_key.'", nonce="'.$nonce.'", signature="'.$sign.'"'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "question=".$msg."&userId=".$openid."&type=0");
    $data = curl_exec($ch);
    echo  $data;



?>