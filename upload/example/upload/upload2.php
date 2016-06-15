  <LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
<?php

if (($_FILES['uploadfile']['tmp_name'] == "") || ($_FILES['uploadfile']['tmp_name'] == "none"))
{
	echo "没有选文件或文件太大";
}
else
{
	$UploadPath = "./uploadtemp/"; 
	// echo $UploadPath ;
	$dest_filename = $UploadPath . $_FILES["uploadfile"]["name"];
	if (file_exists($dest_filename))
	{
		echo "<script>alert('文件", $_FILES["uploadfile"]["name"], "已经存在')</script>";
	}
	else
	{
		if (copy($_FILES['uploadfile']['tmp_name'], $dest_filename))
			echo "<script>alert('上传文件", $_FILES["uploadfile"]["name"], "成功！')</script>";
		else
			echo "<script>alert('上传文件", $_FILES["uploadfile"]["name"], "失败')</script>";
	}
} 
// print_r($_SERVER['ORIG_PATH_TRANSLATED']);
?>


