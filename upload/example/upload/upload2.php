  <LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
<?php

if (($_FILES['uploadfile']['tmp_name'] == "") || ($_FILES['uploadfile']['tmp_name'] == "none"))
{
	echo "û��ѡ�ļ����ļ�̫��";
}
else
{
	$UploadPath = "./uploadtemp/"; 
	// echo $UploadPath ;
	$dest_filename = $UploadPath . $_FILES["uploadfile"]["name"];
	if (file_exists($dest_filename))
	{
		echo "<script>alert('�ļ�", $_FILES["uploadfile"]["name"], "�Ѿ�����')</script>";
	}
	else
	{
		if (copy($_FILES['uploadfile']['tmp_name'], $dest_filename))
			echo "<script>alert('�ϴ��ļ�", $_FILES["uploadfile"]["name"], "�ɹ���')</script>";
		else
			echo "<script>alert('�ϴ��ļ�", $_FILES["uploadfile"]["name"], "ʧ��')</script>";
	}
} 
// print_r($_SERVER['ORIG_PATH_TRANSLATED']);
?>


