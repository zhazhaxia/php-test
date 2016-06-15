var xmlHttp

function check(str){
	//获取所需数据
	if (str.length==0){ 
		  document.getElementById("check").innerHTML=""
		  return
	}
	alert(str);
	xmlHttp=GetXmlHttpObject()//获取ajax连接服务器句柄
	if (xmlHttp==null){
		  alert ("Browser does not support HTTP Request")
		  return
	} 
	
	var url="check_name.php"//异步传输地址
	url=url+"?q="+str
	url=url+"&sid="+Math.random();//sid=Math.random()每次数据不同避免缓存的影响
	xmlHttp.open("GET",url,true);
	xmlHttp.onreadystatechange=stateChanged ;
	xmlHttp.send(null)
} 
//获取数据返回的内容
function stateChanged() { 
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
		 document.getElementById("check").innerHTML=xmlHttp.responseText 
		 //var re=document.getElementById("check").innerText
		// alert(re=='right')
	 } 
}

function GetXmlHttpObject(){
	var xmlHttp=null;
	try{
		 // Firefox, Opera 8.0+, Safari
		 xmlHttp=new XMLHttpRequest();
	}
	catch (e){
	 // Internet Explorer
		 try{
		 	 xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		 }
		 catch (e){
		  	xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		 }
	}
	return xmlHttp;
}