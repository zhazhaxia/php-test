<?php
header("content-type:text/html;charset=utf-8");
/***
*逆向最大匹配
*php中汉字占三个字符
**/
$pagestartime=microtime(); //开始计时



$fileStr=file_get_contents("chinesedic.txt");
$word=$_POST['word'];
$maxLen=12;
$curLen=$maxLen;
$length=strlen($word);
$pos=$length-$curLen;
$newWord="";
$flag=false;//是否找到子串
while ($pos>-$maxLen) {
	$sub=substr($word, $pos,$curLen);//取子串
	if(strpos($fileStr, $sub)){//判断子串是否在字典中
		$newWord=" ".$sub.$newWord;
		$flag=true;
	}
	if (!$flag) {
		$curLen=$curLen-3;//没找到步进长度减3
		$pos=$pos+3;//指针前移
		if ($curLen<=0) {//语句不合逻辑或者不存在此类别词语
			$newWord="语句不合逻辑或者不存在此类别词语";
			break;
		}
	}else{//false=true
		$pos=$pos-$maxLen;//指针往后移动
		$flag=false;
		if ($pos<0&&$pos>(-$maxLen)) {//到达句头
			$curLen=$maxLen+$pos;//小于0时的步进处理
			$pos=0;
		}else{
			$curLen=$maxLen;
		}
		
	}
}
$newWord=str_replace(" ", "/",trim($newWord));
echo $newWord;



$pageendtime = microtime();//计时结束
$starttime = explode(" ",$pagestartime); 
$endtime = explode(" ",$pageendtime); 
$totaltime = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1]; 
$timecost = sprintf("%s",$totaltime); 
echo "页面运行时间: $timecost 秒"; 
?>