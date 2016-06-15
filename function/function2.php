<?php
header('Content-type: text/html; charset=UTF8'); // UTF8不行改成GBK试试
?>
<?php
	
	//上一节主要是按值传参，本节引用传参
	//函数名称不区分大小写，但是变量区分
	/*$prices=50;
	$tax=0.5;
	echo $prices.':'.$tax."<br/>";
	fnPrices($prices,$tax);
	echo $prices.':'.$tax;
	function fnPrices(&$prices,&$tax){		//参数前加&
		$prices+=$prices*$tax;
		$tax*=$tax;	
	}*/
	
	
	/*------------------------------*/
	//全局变量
/*	$a=5;
	function fn(){
		global $a;
		$a=2;
	}
	fn();
	echo $a;*/
	
	
	/*//超全局变量
	$GLOBALS['a']=5;
	function fa(){
		$GLOBALS['a']=6;
	}
	fa();
	echo $GLOBALS['a'];
	//print_r($GLOBALS);*/
	/*---------------------------*/
	
	
	//自身的函数库
	//创建自己文件函数库，然后用include包含进来就可以使用了
	
?>