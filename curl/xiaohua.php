<?php
		header("content-type:text/html;charset=utf-8");
		$url = "http://apix.sinaapp.com/joke/?appkey=trialuser";
        $output = file_get_contents($url);
        $contentStr = json_decode($output, true);
        
        if (is_array($contentStr)){
            print_r(substr_replace($contentStr,'',-28));
        }else{
            echo substr_replace($contentStr,'',-28);
        }
       




?>