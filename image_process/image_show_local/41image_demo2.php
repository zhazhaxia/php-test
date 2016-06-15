<?php
	header('Content-Type:image/jpeg');
	echo $_REQUEST['l'];
	var_dump($_FILES); 
	if (($_FILES['img']['tmp_name'] == "") || ($_FILES['img']['tmp_name'] == "none")){
		echo "没有选文件或文件太大";
	}else{
		$UploadPath = "./upload/"; 
			$rs=substr(strrchr($_FILES['img']['name'], '.'), 1);//获取文件后缀名
			if($rs!='jpg'&&$rs!='jpeg'){echo "<script>alert('只允许上传jpg格式图片')</script>";echo '<script>alert("上传失败");location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
			 return false;
			}
			date_default_timezone_set('Asia/Shanghai');
			$new_filename=date('Y').date('m').date('d').date('g').date('i').date('s').$i.'.'.$rs;
			$dest_filename=$UploadPath.$new_filename;
	if (file_exists($dest_filename)){
		echo "<script>alert('文件", $_FILES["img"]["name"], "已经存在')</script>";
	}else{
		if (copy($_FILES['img']['tmp_name'], $dest_filename)){
			
			//list($width,$height)=getimagesize($dest_filename);//获取图片大小宽高
			$x=$_REQUEST['x'];//xy开始在原图裁剪的点
			$y=$_REQUEST['y'];
			$_width=$_REQUEST['l'];//目标图像高宽
			$_height=$_REQUEST['l'];
			echo $x.'*'.$y.'*'.$l.'*';
			$im=imagecreatetruecolor($_width,$_height);
		
			$_im=imagecreatefromjpeg($dest_filename);
			//裁剪
			imagecopy($im, $_im, 0, 0, $x, $y, $_width, $_height);
			//imagejpeg($im);//将图片输出到浏览器
			imagejpeg($im,$dest_filename);//将图片保存
			imagedestroy($im);
			imagedestroy($_im);
			echo '<script>alert("上传成功");location.href="'.$_SERVER['HTTP_REFERER'].'";</script>';
			
		}
		else
			echo "<script>alert('上传文件", $_FILES["img"]["name"], "失败')</script>";
		}
	} 
	
?>