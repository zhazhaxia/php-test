  <LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
<?php	
echo "<pre>$_FILES数组：";
print_r($_FILES);
echo "</pre>";

$UploadPath = "./uploadtemp/";

for ($i=0;$i<3;$i++)
{ 
    echo $_FILES["uploadfile"]["name"][$i]."<p>";

    if (($_FILES['uploadfile']['tmp_name'][$i]=="")||($_FILES['uploadfile']['tmp_name'][$i]=="none"))
	{
	  echo "没有选文件或文件太大";
	}
	else
	{
		$dest_filename=$UploadPath.$_FILES["uploadfile"]["name"][$i];
		if (file_exists($dest_filename))
		{
		   echo "<script>alert('文件",$_FILES["uploadfile"]["name"][$i],"已经存在')</script>";
		}
		else
		{
			if (copy($_FILES['uploadfile']['tmp_name'][$i],$dest_filename))
				echo "<script>alert('上传文件",$_FILES["uploadfile"]["name"][$i],"成功！')</script>";
			else
				echo "<script>alert('上传文件",$_FILES["uploadfile"]["name"][$i],"失败')</script>";	
		}
	}


}

?>


