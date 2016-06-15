<?php
	header("content-type:text/html;charset=utf-8");
	//多米
	// $ch = curl_init();
	// //$url="http://ting.hotchanson.com/detail.do?callback=jsonp_detail&a=gqxq&from=ss&neid=&singerid=&channelid=-3&channelname=&musiclabelid=undefined&searchid=&songname=退后&singername=周杰伦&order=1&downListenSwitch=true&extraid=163&size=2&version=20140728164225";
	// $url="http://v5.pc.duomi.com/search-ajaxsearch-searchall?kw=退后周杰伦&pi=1&pz=1";
	// curl_setopt($ch,CURLOPT_URL,$url);
	// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// $outopt = curl_exec($ch);
	// curl_close($ch);
	// //echo $outopt;
	// // var_dump($outopt);
	// $outopt=json_decode($outopt,true);
	// echo "<pre>";
	// print_r($outopt);
	// echo "</pre>";


	//搜搜
	// $ch = curl_init();
	// //$url="http://ting.hotchanson.com/detail.do?callback=jsonp_detail&a=gqxq&from=ss&neid=&singerid=&channelid=-3&channelname=&musiclabelid=undefined&searchid=&songname=退后&singername=周杰伦&order=1&downListenSwitch=true&extraid=163&size=2&version=20140728164225";
	// $url="http://cgi.music.soso.com/fcgi-bin/fcg_search_xmldata.q?source=10&w=银魂&perpage=3&ie=utf-8";
	// curl_setopt($ch,CURLOPT_URL,$url);
	// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// $outopt = curl_exec($ch);
	// curl_close($ch);
	
	// echo strlen($outopt);
	// $outopt=substr($outopt,20);
	// $outopt=substr($outopt,0,-4);

	// $str=explode(',', $outopt);
	// echo "<br><pre>";
	// print_r($str);
	// echo "</pre>";
	
	// echo substr(substr($str[13],10),0,-1).'<br>'.substr(substr($str[19],9),0,-1).
	// '<br>'.substr(substr($str[59],9),0,-1);





	// $ch = curl_init();
	// //$url="http://ting.hotchanson.com/detail.do?callback=jsonp_detail&a=gqxq&from=ss&neid=&singerid=&channelid=-3&channelname=&musiclabelid=undefined&searchid=&songname=退后&singername=周杰伦&order=1&downListenSwitch=true&extraid=163&size=2&version=20140728164225";
	// $url="http://v5.pc.duomi.com/search-ajaxsearch-searchall?kw=退后&pi=1&pz=1";
	// curl_setopt($ch,CURLOPT_URL,$url);
	// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// $outopt = curl_exec($ch);
	// curl_close($ch);
	// //echo $outopt;
	// // var_dump($outopt);
	// $outopt=json_decode($outopt,true);
	// echo "<pre>";
	// print_r($outopt);
	// echo "</pre>";

	// $name="周杰伦";
	// $ch = curl_init();
	// $url="http://cgi.music.soso.com/fcgi-bin/fcg_search_xmldata.q?source=10&w={$name}&perpage=1&ie=utf-8";
	// curl_setopt($ch,CURLOPT_URL,$url);
	// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// $outopt = curl_exec($ch);
	// curl_close($ch);
	// $outopt=substr($outopt,20);
	// $outopt=substr($outopt,0,-4);
	// $str=explode(',', $outopt);

	// echo substr(substr($str[13],10),0,-1).'<br>'.substr(substr($str[19],9),0,-1).
	// '<br>'.substr(substr($str[59],9),0,-1);

	// echo "<br><pre>";
	// print_r($str);
	// echo "</pre>";

	// $muiscurl = array();
	// $muiscurl=array("Title"=>substr(substr($str[13],10),0,-1),
	// 				"Description"=>substr(substr($str[13],10),0,-1).' '.substr(substr($str[15],12),0,-1),
	// 				"MusicUrl"=>substr(substr($str[19],9),0,-1),
	// 				"HQMusicUrl"=>substr(substr($str[19],9),0,-1),
	// 				"ThumbMediaId"=>0);
	// echo "<pre>";
	// print_r($muiscurl);
	// echo "</pre>";

	
	//酷狗
	// $ch = curl_init();
	// //$url="http://ting.hotchanson.com/detail.do?callback=jsonp_detail&a=gqxq&from=ss&neid=&singerid=&channelid=-3&channelname=&musiclabelid=undefined&searchid=&songname=退后&singername=周杰伦&order=1&downListenSwitch=true&extraid=163&size=2&version=20140728164225";
	// $url="http://cloud.kugou.com/app/getSearchResult.php?key=黑色幽默&pageNo=0&pageSize=1";
	// curl_setopt($ch,CURLOPT_URL,$url);
	// curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	// $outopt = curl_exec($ch);
	// curl_close($ch);
	
	// // echo strlen($outopt);
	// // $outopt=substr($outopt,20);
	// // $outopt=substr($outopt,0,-4);
	// $outopt=json_decode($outopt,true);
	// // $str=explode(',', $outopt);
	// echo "<br><pre>";
	// print_r($outopt);
	// echo "</pre>";	
	// // echo substr(substr($str[13],10),0,-1).'<br>'.substr(substr($str[19],9),0,-1).
	// // '<br>'.substr(substr($str[59],9),0,-1);


	/*require_once "simple_html_dom.php";   
    function find($value)  
    {  
        $qurl='http://music.baidu.com/search?key='.$value; 
        $html1=file_get_html($qurl);  
        $div=$html1->find('span[class=song-title]',0);  
        $link1=$div->first_child ()->href; 
        $link2='http://music.baidu.com/'.$link1.'/download'; 
        $html2=file_get_html($link2);
        $download=$html2->getElementById('download');  
        $url=$download->href;
        $title=$html2->find('span[class=fwb]',0)->plaintext;
        $author=$html2->find('span[class=author_list]',0)->plaintext;  
        return array('title'=>$title,'author'=>$author,'url'=>substr($url,22));  
    } 
     $result = find("银魂");
    echo "<br><pre>";
	print_r($result);
	echo "</pre>";
*/



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
	$songName="黑色幽默";
	$songName=explode(" ",$songName);
	echo "<br><pre>";
	print_r(baiduMusic($songName[0],$songName[1]));
	echo "</pre>";
?>