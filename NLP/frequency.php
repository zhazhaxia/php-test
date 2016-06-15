<?php
@header("content-type:text/html;charset=utf-8");
/***
*正向最大匹配
*php中汉字占三个字符
**/
$pagestartime=microtime(); //开始计时
set_time_limit(0);

// $str=file_get_contents('a.txt');
$file=fopen("WordFrequency.txt",'r');//WordFrequency
$arr=array();//字典
while (!feof($file)) {
	array_push($arr, fgets($file));
}
// echo "<pre>";
// print_r($arr);
// echo "</pre>";

$word=$_POST['word'];//"自然语言处理课好多作业啊！";做完作业才能看电视、他喜欢唱歌、水果好吃、你喜欢游泳吗？
$length=strlen($word);//字典长度

$pos=0;//当前位置
$curLen=3;//步长
$key=array();//候选词
while ($pos<$length) {
	$sub=substr($word, $pos,$curLen);
	while ($s=inArray($sub,$arr)) {
		array_push($key, $s);
		$curLen+=3;
		if (($pos+$curLen)>$length) {//如果句子读完就退出
			break;
		}
		$sub=substr($word, $pos,$curLen);//选取下一个候选词
	}
	$pos+=3;
	$curLen=3;
}
// echo "<pre>";
// print_r($key);
// echo "</pre>";
$first=firstLetter($word);
$newarr=array();//累积概率
$indexarr=array();//回溯的索引
for ($i=0; $i < count($key); $i++) { 
	if ($first==firstLetter($key[$i][0])) {
		array_push($newarr, (float)$key[$i][2]);//如果是前驱则直接加入
		array_push($indexarr,0);
	}else{
		$f=firstLetter($key[$i][0]);
		$l=substr($word, strpos($word, $f)-3,3);
		$tmparr1=array();//候选组词
		$tmparr2=array();
		for ($j=0; $j < $i; $j++) { 
			if ($l==lastLetter($key[$j][0])) {
				//echo '<br>'.$key[$j][0].$l;
				array_push($tmparr1, (float)$key[$j][2]);
				array_push($tmparr2, $j);
			}
		}
		@$max=max($tmparr1);
		//echo $max.':';
		for ($k=0; $k < count($tmparr1); $k++) { //求最大索引
			if ($tmparr1[$k]==$max) {
				$index=$k;
				break;
			}
		}
		array_push($newarr, $max*(float)$key[$i][2]);
		array_push($indexarr,$tmparr2[$index]);
		unset($tmparr2);
		unset($tmparr1);
	}
}
// echo "<pre>";
// print_r($indexarr);
// print_r($newarr);
// echo "</pre>";
// print_r(explode(",", "，,74921,6.6807%"));

$l=substr($word, -3,3);
$tmparr1=array();//候选组词
$tmparr2=array();
for ($j=0; $j <count($key); $j++) { 
	if ($l==lastLetter($key[$j][0])) {
		//echo '<br>'.$key[$j][0].$l;
		array_push($tmparr1, (float)$key[$j][2]);
		array_push($tmparr2, $j);
	}
}
@$max=max($tmparr1);
//echo $max.':';
for ($k=0; $k < count($tmparr1); $k++) { //求最大索引
	if ($tmparr1[$k]==$max) {
		$index=$k;
		break;
	}
}
$index=$tmparr2[$index];
unset($tmparr2);
unset($tmparr1);

$newword="";
while (true) {//回溯求匹配的字符串
	$newword=$key[$index][0].'/'.$newword;
	$index=$indexarr[$index];
	if (firstLetter($newword)==$first) {
		break;
	}
	if ($index==0) {
		$newword=$key[$index][0].'/'.$newword;
		break;
	}
}
echo $newword;


$pageendtime = microtime();//计时结束
$starttime = explode(" ",$pagestartime);
$endtime = explode(" ",$pageendtime);
$totaltime = $endtime[0]-$starttime[0]+$endtime[1]-$starttime[1];
$timecost = sprintf("%s",$totaltime);
echo "算法运行时间: $timecost 秒"; 
function inArray($word,$arr){//$word是否在$arr中
	$len=count($arr);
	for ($i=0; $i < $len; $i++) { 
		$a=explode(",", $arr[$i]);
		if ($a[0]==$word) {//strpos(a,b),a是否包含了b
			return $a;
		}
	}
	return false;
}
function firstLetter($str){
	return substr($str, 0,3);
}
function lastLetter($str){
	return substr($str,-3,3);
}
?>