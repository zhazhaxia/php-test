<?php
header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试
?>
<?php
	
	//fnName();
	//fnArea1(10);
	//echo fnArea2(1);
	//echo fnArea3();
	//print_r(fnInfo('jerry',20,'学生'));
	/*$arr=fnInfo('jerry',20,'学生');
	echo $arr[0];*/
	/*list($name,$age,$job)=fnInfo('jerry',20,'学生');
	echo $name;*/
	/*list($name,$age,$job)=fnInfo2('jerry',20,'学生');
	echo $job;*/
	
	
	function fnArea1($radius){
		$area=$radius*$radius*pi();
		echo $area;
	}
	
	function fnName(){
		echo '我是一个无返回的函数';
	}
	
	//有返回值的函数
	function fnArea2($radius){
		$area=$radius*$radius*pi();
		return $area;
	}
	//有默认值的函数
	function fnArea3($radius=10){
		$area=$radius*$radius*pi();
		return $area;
	}
	
	//多个参数
	function fnInfo($name,$age,$job){
		$userinfo=array($name,$age,$job);
		return $userinfo;
	}
	//数组写法二
	function fnInfo2($name,$age,$job){
		$userinfo[]=$name;
		$userinfo[]=$age;
		$userinfo[]=$job;
		return $userinfo;
	}
	
?>