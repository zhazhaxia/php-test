  <LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
<?php	
echo "<pre>$_FILES���飺";
print_r($_FILES);
echo "</pre>";

$UploadPath = "./uploadtemp/";

for ($i=0;$i<3;$i++)
{ 
    echo $_FILES["uploadfile"]["name"][$i]."<p>";

    if (($_FILES['uploadfile']['tmp_name'][$i]=="")||($_FILES['uploadfile']['tmp_name'][$i]=="none"))
	{
	  echo "û��ѡ�ļ����ļ�̫��";
	}
	else
	{
		$dest_filename=$UploadPath.$_FILES["uploadfile"]["name"][$i];
		if (file_exists($dest_filename))
		{
		   echo "<script>alert('�ļ�",$_FILES["uploadfile"]["name"][$i],"�Ѿ�����')</script>";
		}
		else
		{
			if (copy($_FILES['uploadfile']['tmp_name'][$i],$dest_filename))
				echo "<script>alert('�ϴ��ļ�",$_FILES["uploadfile"]["name"][$i],"�ɹ���')</script>";
			else
				echo "<script>alert('�ϴ��ļ�",$_FILES["uploadfile"]["name"][$i],"ʧ��')</script>";	
		}
	}


}

?>


