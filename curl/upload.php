<?php
	function upload($field = 'userfile',$upload_path = "uploads")
	{
		if ( ! isset($_FILES[$field]))
		{
			return array("result"=>FALSE,"error"=>"没有文件被上传。");
		}
		
		////判断是否是一个上传的文件
		if ( ! is_uploaded_file($_FILES[$field]['tmp_name']))
		{
			//获取文件上传错误号，过滤文件上传错误信息
			$error = ( ! isset($_FILES[$field]['error'])) ? 4 : $_FILES[$field]['error'];

			switch($error)
			{
				case 1:	
					return array("result"=>FALSE,"error"=>"上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。");
					break;
				case 2: 
					return array("result"=>FALSE,"error"=>"上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。");
					break;
				case 3: 
					return array("result"=>FALSE,"error"=>"文件只有部分被上传。");
					break;
				case 4: 
					return array("result"=>FALSE,"error"=>"没有文件被上传。");
					break;
				case 6:
					return array("result"=>FALSE,"error"=>"找不到临时文件夹。");
					break;
				case 7:
					return array("result"=>FALSE,"error"=>"文件写入失败。");
					break;
				default :   
					return array("result"=>FALSE,"error"=>"没有文件被上传。");
					break;
			}

			return array("result"=>FALSE,"error"=>"非法的上传文件！");
		}

		//类型过滤
 		$typelist = array("image/jpeg","image/jpg","image/png","image/gif"); //定义允许的类型
		if(!in_array($_FILES[$field]["type"],$typelist))
		{
			return array("result"=>FALSE,"error"=>"上传文件类型非法！");
		}

		//设置上传文件的新文件名
		$fileinfo = pathinfo($_FILES[$field]["name"]);//解析上传文件名字
		do
		{
			$filename= md5(uniqid(mt_rand())).".".$fileinfo['extension'];
		}while(file_exists($upload_path.$filename));

		//执行文件上传
		if ( ! @move_uploaded_file($_FILES[$field]['tmp_name'], $upload_path.'/'.$filename))
		{
			return array("result"=>FALSE,"error"=>"上传文件失败！");
		}
		else 
		{
			return array("result"=>TRUE,"filename"=>$filename);		
		}	
	}
	upload("file","uploads");
	//print_r($_FILES);
?>