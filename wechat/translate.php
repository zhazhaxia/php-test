<?php
header("content-type:text/html;charset=utf-8");
	function youdaoDic($word){

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
    echo youdaoDic('你好');

?>