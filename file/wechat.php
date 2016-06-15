<?php
//微信公众平台基础接口PHP SDK （面向过程版）
	define("TOKEN","zhazhaxia");
	if(!isset($_GET['echostr'])){
		//调用响应消息函数
        responseMsg();
	}
	else{
		//实现网址接入，调用验证消息函数	
		valid();
	}
	//验证消息
	function valid(){
		if(checkSignature()){
			$echostr = $_GET["echostr"];
			echo $echostr;
			exit;
		}
		else{
			echo "error!";
			exit;
		}
	}
	//检查签名
	function checkSignature(){
		//获取微信服务器GET请求的4个参数
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];
		//定义一个数组，存储其中3个参数，分别是timestamp，nonce和token
		$tempArr = array($nonce,$timestamp,TOKEN);
		//进行排序
		sort($tempArr,SORT_STRING);
		//将数组转换成字符串
		$tmpStr = implode($tempArr);
		//进行sha1加密算法
		$tmpStr = sha1($tmpStr);
		//判断请求是否来自微信服务器，对比$tmpStr和$signature
		if($tmpStr == $signature){
			return true;
		}
		else{
			return false;
		}
	}
	/*------------------------------------------------------------------------------------------------------*/
	//响应消息
	function responseMsg(){//根据用户传过来的消息类型进行不同的响应		
		//1、接收微信服务器POST过来的数据，XML数据包
		$postData = $GLOBALS[HTTP_RAW_POST_DATA];
		if(!$postData){
			echo  "error";
			exit();
		}
		//2、解析XML数据包
	 	$object = simplexml_load_string($postData,"SimpleXMLElement",LIBXML_NOCDATA);
	 	$MsgType = $object->MsgType;//获取消息类型
        
        /*---------------------------------------------------------------------------------------------------*/
	 	switch ($MsgType) {
	 		case 'event'://接收事件	
	 			receiveEvent($object);	
	 			break;	
	 		case 'text'://接收文本消息				 
	 			echo receiveText($object);
	 			break;
	 		case 'image'://接收图片消息
	 		        echo receiveImage($object);	
	 			break;
	 		case 'location'://接收地理位置消息	
	 		        echo receiveLocation($object);	
	 			break;
            case 'voice'://接收语音消息	 				
	 				echo receiveVoice($object);
	 			break; 
	 		case 'video'://接收视频消息
				echo receiveVideo($object);
	 			break;
	 		case  'link'://接收链接消息
	 				echo receiveLink($object);
	 				break;	
	 		
	 		default:
	 			break;
	 	}
	}

//接收事件推送
	function receiveEvent($obj){
		switch ($obj->Event) {		
			case 'subscribe'://关注事件			
				if(!empty($obj->EventKey)){//扫描带参数的二维码，用户未关注时，进行关注后的事件
					//做相关处理
				}
				$dataArray = array(
	 							array(
	 								"Title"=>"hello,大家好！我是明媚的男子，俊辉渣渣夏！欢迎关注",
	 								"Description"=>"this is a test",
	 								"PicUrl"=>"http://img3.imgtn.bdimg.com/it/u=1347635537,2941304776&fm=23&gp=0.jpg",
	 								"Url"=>""
	 								),
	  							array(
	 								"Title"=>"帐号正在调试中哦，暂时没有自动智能回复功能呀！",
	 								"Description"=>"this is a test",
	 								"PicUrl"=>"http://img3.imgtn.bdimg.com/it/u=2273569335,1000956744&fm=23&gp=0.jpg",
	 								"Url"=>""
	 								),
	  							array(
	 								"Title"=>"发送您的地理位置(信息更精确)，或者输入“天气+城市名”如(天气广州)可以显示你当前的天气信息"		
	 								."                                                 发送“音乐+歌曲+歌手名”如(音乐 双截棍 周杰伦)可以点播歌曲"
	 								."                                                 发送“翻译+所需翻译文字”则可以得到你所需要的翻译"
	 								."                                                 发送“空气+城市名”可以查看当前城市空气情况"		
	 								."                                                 发送“四六级”则进入四六级查询页面"
	 								."                                                 发送“笑话”则可以看笑话"
	 								."                                                 渣渣夏还提供了智能聊天服务，欢迎搭讪"
	 								."                                                 我是渣渣夏，感谢您的支持。"
	 								."                                                 公众号：yi_chuang_yi",
	 								"Description"=>"this is a test",
	 								"PicUrl"=>"http://img3.imgtn.bdimg.com/it/u=2273569335,1000956744&fm=23&gp=0.jpg",
	 								"Url"=>""
	 								)
				 				);
				// echo replyText($obj,"欢迎你关注军哥带你玩转微信开发");
				echo replyNews($obj,$dataArray);
				break;		
			case 'unsubscribe'://取消关注事件
				break;		
			case 'SCAN'://扫描带参数的二维码，用户已关注时，进行关注后的事件
				//做相关的处理
				break;
			
			case 'CLICK'://自定义菜单事件
				switch ($obj->EventKey) {
					case 'FAQ':
						echo replyText($obj,"你的点击的是FAQ事件");
						break;
					default:
						echo replyText($obj,"你的点击的是其他事件");
						break;
				}
				break;
		}	
	}
	//接收文本消息
	function receiveText($obj){	
		$content = $obj->Content;//获取文本消息的内容	
		$content=trim($content);
		if($content=="笑话"){
			$url = "http://apix.sinaapp.com/joke/?appkey=trialuser";
	        $output = file_get_contents($url);
	        $contentStr = json_decode($output, true);
	        if (is_array($contentStr)){
	            $content=substr_replace($contentStr,'',-28);
	        }else{
	            $content=substr_replace($contentStr,'',-28);
	        }
	        $content=trim($content);
	        return replyText($obj,$content);
		}
		if(substr($content,0,6)=="天气"){
			$loc=substr($content,6,strlen($content));
			$loc=trim($loc);
			return replyWeather($obj,$loc);
		}

		if (substr($content,0,6)=="音乐") {
			$songName=substr($content,6,strlen($content));
			$songName=trim($songName);

			if($songName==""){
				return replyText($obj,"听音乐，发送“音乐 歌名 歌手”，注意歌名与歌手之间要留空格哦！(*^__^*) ");//发送文本消息
			}
			// $music = new music($songName);
			// $musicArr=$music->getmusicurl();

			// $musicArr=getSosoMusic($songName);

			$songName=explode(" ",$songName);
			$musicArr=baiduMusic($songName[0],$songName[1]);

			return replyMusic($obj,$musicArr);

			//$con=$songName.'*'.$musicArr['Title'].'*'.$musicArr['Description'].'*'.$musicArr['MusicUrl'].'*'.$musicArr['HQMusicUrl'];
			//return replyText($obj,$con);
		}
		if(substr($content,0,6)=="翻译"){
			$tran=substr($content,6,strlen($content));
			$tran=trim($tran);
			return replyText($obj,youdaoTranslate($tran));
		}
		if(substr($content,0,6)=="空气"){
			$tran=substr($content,6,strlen($content));
			$tran=trim($tran);
			$result=getAirQualityChina($tran);
			$str='';
			foreach($result as $k) {
				$str=$k['Title'].'                       '.
				$k['Description'].
				$k['PicUrl'].
				$k['url'];
			}
			return replyText($obj,$str);
		}
		if(substr($content,0,9)=="四六级"){
			$con[] = array("Title" =>"2014年6月全国大学英语四六级考试成绩查询","Description" =>"", "PicUrl" =>"http://365jia.cn/uploads/13/0301/5130c2ff93618.jpg", "Url" =>"http://apix.sinaapp.com/cet/index.php?openid=".$object->FromUserName);

			return replyNews($obj,$con);
		}


		// $content="
		// 发送您的地理位置(信息更精确)，或者输入“天气+城市名”如(天气广州)可以显示你当前的天气信息
		// 发送“笑话”则可以看笑话
		// 发送“音乐+歌曲+歌手名”如(音乐双截棍周杰伦)可以点播歌曲
		// 发送“空气+城市名”可以查看当前城市空气情况
		// 发送“翻译+所需翻译文字”则可以得到你所需要的翻译
		// 发送“四六级”则进入四六级查询页面

		// 我是渣渣夏，感谢您的支持。
		// 公众号：yi_chuang_yi
		// ";
		$content = getXiaoiInfo($obj->FromUserName, $content);//智能聊天机器人
		return replyText($obj,$content);//发送文本消息
	}

	//接收图片消息
	function receiveImage($obj){
        
        require "config.mysql.php";
        $sql='insert into image values("","'.$obj->FromUserName.'","'.$obj->PicUrl.'","'.$obj->MediaId.'",NOW())';
        @mysql_query($sql);
        @mysql_close();
		//获取图片消息的内容
		$imageArr = array(
			"PicUrl"=>$obj->PicUrl,
			"MediaId"=>$obj->MediaId
			);	
		return replyImage($obj,$imageArr);//发送图片消息
	}

	//接收地理位置消息
	function receiveLocation($obj){
		//获取地理位置消息的内容
		$locationArr = array(
				"Location_X"=>$obj->Location_X,
				"Location_Y"=>$obj->Location_Y,
				"Label"=>$obj->Label
			);
		$loc=$locationArr['Location_Y'].','.$locationArr['Location_X'];
		return replyWeather($obj,$loc);	
		//return replyText($obj,$locationArr['Location_Y']);//回复文本消息	
	}

	//接收语言消息
	function receiveVoice($obj){
		//获取语言消息内容
		$voiceArr = array(
				"MediaId"=>$obj->MediaId,
				"Format"=>$obj->Format
			);	
		return replyVoice($obj,$voiceArr);//回复语言消息
	}

	//接收视频消息
	function receiveVideo($obj){
		//获取视频消息的内容
		$videoArr = array(
				"MediaId"=>$obj->MediaId 
			);
		return replyVideo($obj,$videoArr);//回复视频消息			
	}

	//接收链接消息
	function receiveLink($obj)
	{
		//接收链接消息的内容
		$linkArr = array(
				"Title"=>$obj->Title,
				"Description"=>$obj->Description,
				"Url"=>$obj->Url
			);	
		return replyText($obj,"你发过来的链接地址是{$linkArr['Url']}");//回复文本消息
	}

	//发送文本消息
	function replyText($obj,$content){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[text]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					</xml>";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$content);
	    return $resultStr;		
	}

	//发送图片消息
	function replyImage($obj,$imageArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[image]]></MsgType>
					<Image>
					<MediaId><![CDATA[%s]]></MediaId>
					</Image>
					</xml>";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$imageArr['MediaId']);
	    return $resultStr;			
	}

	//回复语音消息
	function replyVoice($obj,$voiceArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[voice]]></MsgType>
					<Voice>
					<MediaId><![CDATA[%s]]></MediaId>
					</Voice>
					</xml>";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$voiceArr['MediaId']);
	    return $resultStr;		
	}

	//回复视频消息
	function replyVideo($obj,$videoArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[video]]></MsgType>
					<Video>
					<MediaId><![CDATA[%s]]></MediaId>
					</Video> 
					</xml>";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$videoArr['MediaId']);
	        return $resultStr;
	}

	//回复音乐消息
	function  replyMusic($obj,$musicArr){
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[music]]></MsgType>
					<Music>
					<Title><![CDATA[%s]]></Title>
					<Description><![CDATA[%s]]></Description>
					<MusicUrl><![CDATA[%s]]></MusicUrl>
					<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
					</Music>
					<FuncFlag>%s</FuncFlag>
					</xml>";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),$musicArr['Title'],$musicArr['Description'],$musicArr['MusicUrl'],$musicArr['HQMusicUrl'],$musicArr['ThumbMediaId']);
	    return $resultStr;		
	}

	//回复图文消息
	function replyNews($obj,$newsArr){
		$itemStr = "";
		if(is_array($newsArr)){
			foreach($newsArr as $item){
				$itemXml ="<item>
					<Title><![CDATA[%s]]></Title> 
					<Description><![CDATA[%s]]></Description>
					<PicUrl><![CDATA[%s]]></PicUrl>
					<Url><![CDATA[%s]]></Url>
					</item>";
				$itemStr .= sprintf($itemXml,$item['Title'],$item['Description'],$item['PicUrl'],$item['Url']);
			}

		}
		$replyXml = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[news]]></MsgType>
					<ArticleCount>%s</ArticleCount>
					<Articles>
						{$itemStr}
					</Articles>
					</xml> ";
	    //返回一个进行xml数据包
		$resultStr = sprintf($replyXml,$obj->FromUserName,$obj->ToUserName,time(),count($newsArr));
	    return $resultStr;			
	}

	//根据经纬度返回天气信息
	function replyWeather($obj,$loc){

		$url = "http://api.map.baidu.com/telematics/v3/weather?location={$loc}&output=json&ak=BF1c59ca536f947ca6614f4967ce061a";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$outopt = curl_exec($ch);
		curl_close($ch);
		$weather_arr = json_decode($outopt,true);

		$dataArr = array();
		$dataArr[] = array(
					"Title" =>"您所在位置最近四天的天气情况",
					"Description" => "当前时间".date('y-m-d h:i:s',time()),//.$url
					"PicUrl"=>"http://pic27.nipic.com/20130315/6608733_170434195000_2.jpg",
					"Url"=>''
				);

		$tempArr = $weather_arr['results'][0]['weather_data'];
		foreach($tempArr as $v){
			$dataArr[] = array(
					"Title" => $v['date'].$v['weather'].' '.$v['wind'].' '.$v['temperature'],
					"Description" => '',
					"PicUrl"=>$v['dayPictureUrl'],
					"Url"=>''
				);
		}
		return replyNews($obj,$dataArr);
	}











	/*--------------------------------------------music---------------------------------------------------------*/
	class music {
	private $musicname;
	
	public  function __construct($musicname){
		$this->musicname = $musicname;
	}
	private function map_url(){
		
		$url = "http://shopcgi.qqmusic.qq.com/fcgi-bin/shopsearch.fcg?value=".urlencode(iconv("utf-8","gb2312",$this->musicname));
		if(!function_exists("file_get_contents"))
		{
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}else{
			$file_contents = file_get_contents($url);
		}
		return $file_contents;
	}
	
	public function getmusic(){
		$data = $this-> map_url();
		$data = substr($data,15);
		$data = substr($data,0,-2);
		preg_match("/songlist\:\[(?P<music>.*)\]\}/i", $data,$musicdata);
		$musicdata = explode(",",$musicdata['music']);
		$music = array();
		foreach($musicdata as $v){
			if(preg_match("/\{idx\:(?P<id>.*)/i",$v,$a)){
				$id = trim($a[id],"\"");
			}
			if(preg_match("/song_id\:(?P<song_id>.*)/i", $v,$c)){
				$music[$id]['song_id'].=trim($c['song_id'],"\"");
			}
			if(preg_match("/song_name\:(?P<song_name>.*)/i",$v,$s)){
				$music[$id]['song_name'].=trim($s['song_name'],"\"");
			}
			if(preg_match("/album_name\:(?P<album_name>.*)/i",$v,$n)){
				$music[$id]['album_name'].=trim($n['album_name'],"\"");
			}
			if(preg_match("/singer_name\:(?P<singer_name>.*)/i",$v,$name)){
				$music[$id]['singer_name'].=trim($name['singer_name'],"\"");
			}
			if(preg_match("/location\:(?P<location>.*)/i",$v,$l)){
				$music[$id]['location'].=trim($l['location'],"\"");
			}
		}
		return $music;
	}
	public  function getmusicurl(){
		$muiscurl = array();
		$result = $this->getmusic();
		foreach ($result as $id =>$v){

		$muiscurl=array("Title"=>iconv("gb2312","utf-8",$v['song_name']),
					"Description"=>iconv('gb2312','utf-8',$v['singer_name']).'  '.iconv('gb2312','utf-8',$v['album_name']),
					"MusicUrl"=>"http://stream1".$v['location'].".qqmusic.qq.com/3".$v['song_id'].".mp3",
					"HQMusicUrl"=>"http://stream1".$v['location'].".qqmusic.qq.com/3".$v['song_id'].".mp3",
					"ThumbMediaId"=>0);
		
		break;
		}
		return $muiscurl;
	}
}


//搜搜音乐
function getSosoMusic($name){
	$ch = curl_init();
	$url="http://cgi.music.soso.com/fcgi-bin/fcg_search_xmldata.q?source=10&w={$name}&perpage=1&ie=utf-8";
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$outopt = curl_exec($ch);
	curl_close($ch);
	$outopt=substr($outopt,20);
	$outopt=substr($outopt,0,-4);
	$str=explode(',', $outopt);
	$muiscurl = array();
	$muiscurl=array("Title"=>iconv("gb2312","utf-8",substr(substr($str[4],9),0,-1)),
					"Description"=>iconv("gb2312","utf-8",substr(substr($str[13],10),0,-1).' '.substr(substr($str[15],12),0,-1)),
					"MusicUrl"=>substr(substr($str[19],9),0,-1),
					"HQMusicUrl"=>substr(substr($str[19],9),0,-1),
					"ThumbMediaId"=>0);
	return $muiscurl;
}
//百度music
	function baiduMusic($Song, $Singer)
	{	
		$song=getBaiduSong($Song,$Singer);
		$muiscurl=array();
		$muiscurl=array("Title"=>$Song.' '.$Singer,
					"Description"=>"渣渣夏",
					"MusicUrl"=>$song['url'],
					"HQMusicUrl"=>$song['durl'],
					"ThumbMediaId"=>0);	
		return $muiscurl;		
	}
	function getBaiduSong($Song, $Singer){
			if (!empty($Song))
			{
				//音乐链接有两中品质，普通品质和高品质
				$music = array (
					'url' => "",
					'durl' => "");

				//采用php函数file_get_contents来读取链接内容
				$file = file_get_contents("http://box.zhangmen.baidu"
					.".com/x?op=12&count=1&title=".$Song."$$".$Singer."$$$$");

				//simplexml_load_string() 函数把 XML 字符串载入对象中
				$xml = simplexml_load_string($file, 
					'SimpleXMLElement', LIBXML_NOCDATA);

				//如果count大于0,表示找到歌曲
				if ($xml->count > 0)
				{
					//普通品质音乐
					$encode_str = $xml->url->encode;

					//使用正则表达式，进行字符串匹配，处理网址
					preg_match("/http:\/\/([\w+\.]+)(\/(\w+\/)+)/", $encode_str, $matches);

					//第一个匹配的就是我们需要的字符串
					$url_parse = $matches[0];

					$decode_str = $xml->url->decode;

					//分离字符串，截去mid
					$decode_arr = explode('&', $decode_str);

					//拼接字符串,获得普通品质音乐
					$musicUrl = $url_parse.$decode_arr[0];


					//高品质音乐
					$encode_dstr = $xml->durl->encode;
					preg_match("/http:\/\/([\w+\.]+)(\/(\w+\/)+)/", $encode_dstr, $matches_d);

					//第一个匹配的就是我们需要的字符串
					$durl_parse = $matches_d[0];

					$decode_dstr = $xml->durl->decode;
					//分离字符串，截去mid
					$decode_darr = explode('&', $decode_dstr);

					//拼接字符串,获得高品质音乐
					$musicDurl = $durl_parse.$decode_darr[0];

					//将两个链接放入数组中
					$music = array(
						'url' => $musicUrl,
						'durl' => $musicDurl
					);
					return $music;

				}

				return $music;
			}
			else
			{
				$music = "";
				return $music;
			}
		}

/*--------------------------------------------music---------------------------------------------------------*/


/*--------------------------------------------翻译---------------------------------------------------------*/
function youdaoTranslate($word){

        $keyfrom = "zhazhaxia";    //申请APIKEY时所填表的网站名称的内容
        $apikey = "1117109136";  //从有道申请的APIKEY
        
        //有道翻译-json格式
        $url_youdao = 'http://fanyi.youdao.com/fanyiapi.do?keyfrom='.$keyfrom.'&key='.$apikey.'&type=data&doctype=json&version=1.1&q='.$word;
        
        $jsonStyle = file_get_contents($url_youdao);

        $result = json_decode($jsonStyle,true);
        
        $errorCode = $result['errorCode'];
        
        $trans = '';

        if(isset($errorCode)){

            switch ($errorCode){
                case 0:
                    $trans = $result['translation']['0'];
                    break;
                case 20:
                    $trans = '要翻译的文本过长';
                    break;
                case 30:
                    $trans = '无法进行有效的翻译';
                    break;
                case 40:
                    $trans = '不支持的语言类型';
                    break;
                case 50:
                    $trans = '无效的key';
                    break;
                default:
                    $trans = '出现异常';
                    break;
            }
        }
        return $trans;
        
    }
    /*--------------------------------------------翻译---------------------------------------------------------*/
    /*--------------------------------------------air quality---------------------------------------------------------*/

function getAirQualityChina($city){
		$url="http://www.pm25.in/api/querys/aqi_details.json?avg=true?stations=no&city=".urlencode($city)."&token=5j1znBVAsnSf5xQyNQyq";
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$outopt = curl_exec($ch);
		curl_close($ch);
		
		$cityAir=json_decode($outopt,true);
		if (isset($cityAir['error'])) {
			return $cityAir['error'];
		}else{
			$result="空气质量指数(AQI)：".$cityAir[0]['aqi']."\n".
					"空气质量等级：".$cityAir[0]['quality']."\n".
					"细颗粒物（PM2.5）：".$cityAir[0]['pm2_5']."\n".
					"可吸入颗粒物（PM10）：".$cityAir[0]['pm10']."\n".
					"一氧化碳（CO）：".$cityAir[0]['co']."\n".
					"二氧化氮（NO2）：".$cityAir[0]['no2']."\n".
					"二氧化硫（SO2）:".$cityAir[0]['so2']."\n".
					"臭氧（O3）：".$cityAir[0]['o3']."\n".
					"更新时间：".preg_replace("/([a-zA-Z])/i", " ", $cityAir[0]['time_point']);
				$aqiArray=array();
				$aqiArray[]=array("Title"=>$cityAir[0]['area']."空气质量","Description"=>$result,"PicUrl"=>"","Url"=>"");
				return $aqiArray;
		}

	}

/*--------------------------------------------air quality---------------------------------------------------------*/
/*-------------------------------------------智能聊天机器人---------------------------------------------------------*/


function getXiaoiInfo($openid, $content)
{
    //定义app
    $app_key="sVhgZU9grnfN";
    $app_secret="APjAYAI18aVaTCctchDQ";

    //签名算法
    $realm = "xiaoi.com";
    $method = "POST";
    $uri = "/robot/ask.do";
    $nonce = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
    for ($i = 0; $i < 40; $i++) {
        $nonce .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }
    $HA1 = sha1($app_key.":".$realm.":".$app_secret);
    $HA2 = sha1($method.":".$uri);
    $sign = sha1($HA1.":".$nonce.":".$HA2);

    //接口调用
    $url = "http://nlp.xiaoi.com/robot/ask.do";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Auth:    app_key="'.$app_key.'", nonce="'.$nonce.'", signature="'.$sign.'"'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "question=".urlencode($content)."&userId=".$openid."&platform=custom&type=0");
    $output = curl_exec($ch);
    if ($output === FALSE){
        return "cURL Error: ". curl_error($ch);
    }
    return trim($output);
}
/*--------------------------------------------智能聊天机器人---------------------------------------------------------*/
/*--------------------------------------------air quality---------------------------------------------------------*/




?>