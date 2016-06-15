<?php
#######################################
# Author:          David Asín Sánchez #
# Organization:    Xarelan Multimedia #
# e-mail:          david@xarelan.com  #
#######################################
include('./XUpload.inc.php');

// Create the upload objects
$myU1 = new Xupload("file1");
$myU2 = new Xupload("file2");
$myU3 = new Xupload("file3",1); //providing rename value

// form was submitted
if( isset( $HTTP_POST_VARS ) && is_array( $HTTP_POST_VARS) )
{

	$myU1->setDir( "./uploads" );
	$myU2->setDir( "./uploads" );
	$myU3->setDir( "./uploads" );

	// if you want to remove "oldfile.pdf" if exists in upload dir and perms are ok
	// you must use setDir() method previously
	//$myU1->removeFile("oldfile.pdf");


	$myU1->xCopy();
	$myU2->xCopy();
	$myU3->xCopy("newname.jpg");

	// if you want to rename the remote file
	// yo must set it in the object instance, set to 1 to rename file, default value is 0
	// $myU3->xCopy();  //random name keeping extension
	// $myU3->xCopy("thenewname.ext") // you must provide the complete file name
	// $myU3->xCopy($my_new_name_var) // providing a var that contains the new name

	$myU1->show_progressMessage();
	$myU2->show_progressMessage();
	$myU3->show_progressMessage();

}
?>