<?php
session_start();
/**
* @author Resalat Haque
* @link http://www.w3bees.com
*/
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 
include('../class/resize.php');

$image = new SimpleImage(); 
header('Content-type: application/json');

$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$max_size = 200 * 1024; // max file size (200kb)
$path = 'upload_req/'; // upload directory

if ( $_SERVER['REQUEST_METHOD'] === 'POST' )

{
	if( @is_uploaded_file($_FILES['columnname']['tmp_name']) )
	{
		// get uploaded file extension
		$ext = strtolower(pathinfo($_FILES['columnname']['name'], PATHINFO_EXTENSION));
		// looking for format and size validity
		if (in_array($ext, $valid_exts) AND $_FILES['columnname']['size'] < $max_size)
		{
			$unique = 'userid-'.$_POST['reqid'].$_POST['branchid'];
			// unique file path
			$path = $path . $unique . '.' .$ext;

			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['columnname']['tmp_name'], $path))
			{
				$save_image = 'upload_req/userid-'.$_POST['reqid'].$_POST['branchid'].'.'.$ext;
				$model->update_tbl('echecklist',array('DocPath' => $save_image ),array('ReqID' => $_POST['reqid'], 'BranchID' => $_POST['branchid']));
				$status = array('status' => 'Successfully uploaded!', 'image_name' =>  $save_image."?".date('Ymdhis'));
			}
			else {
		
				$status = array('status' => 'Upload Fail: Unknown error occurred!');

			}
		}
		else {
			$status = array('status' => 'Upload Fail: Unsupported file format or It is too large to upload!');
		}
	}
	else {
		$status = array('status' => 'Upload Fail: File not uploaded!');
	}
}
else {
	$status = array('status' => 'Bad request');
}

// echo out json encoded status
echo json_encode($status);
?>