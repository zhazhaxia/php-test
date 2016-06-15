<LINK REL="stylesheet" TYPE="text/css" HREF="example.css">
<PRE>

<?php
	copy($_FILES['uploadfile']['tmp_name'],$_FILES["uploadfile"]["name"]);

	print_r($_REQUEST);
	print_r($_FILES);

?>

</PRE>
