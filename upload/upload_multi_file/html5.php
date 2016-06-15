<?php
	echo "<pre>$_FILES数组：";
	print_r($_FILES);
	echo "</pre>";
	$num=count($_FILES['file_html5']['name']);
	
	$UploadPath = "./upload_html5/";

	for ($i=0;$i<$num;$i++){ 
		if (($_FILES['file_html5']['tmp_name'][$i]=="")||($_FILES['file_html5']['tmp_name'][$i]=="none")){
		  echo "没有选文件或文件太大";continue;
		}else{
			
			$rs=substr(strrchr($_FILES['file_html5']['name'][$i], '.'), 1);//获取文件后缀名
			if($rs!='jpg')continue;
			date_default_timezone_set('Asia/Shanghai');
			$new_filename=date('Y').date('m').date('d').date('g').date('i').date('s').$i.'.'.$rs;
			//echo $new_filename.'<br/>';
			$dest_filename=$UploadPath.$new_filename;
			if (file_exists($dest_filename)){
			   echo "<script>alert('文件",$_FILES["file_html5"]["name"][$i],"已经存在')</script>";continue;
			}
			else{
				if (copy($_FILES['file_html5']['tmp_name'][$i],$dest_filename)){
				}else
					echo "<script>alert('上传文件",$_FILES["file_html5"]["name"][$i],"失败')</script>";	continue;
			}
		}

	}

?>