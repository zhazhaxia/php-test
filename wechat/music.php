<?php
		header("content-type:text/html;charset=utf-8");



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
					"ThumbMediaId"=>"15");
		
		break;
		}
		return $muiscurl;
	}
}
$music = new music(" 周杰伦 退后 ");
//$data = $music->getmusic();
//var_dump($data);
//echo "http://stream1{$data[1]['localtion']}.qqmusic.qq.com/3{$data[1]['song_id']}.mp3";
$ARR=$music->getmusicurl();
print_r($ARR);
//echo $ARR['Title'];

//echo substr("我是明媚的人！！",0,6);;
// $str="音乐我是明媚的人！！";
// echo '********'.substr($str,6,strlen($str));

?>