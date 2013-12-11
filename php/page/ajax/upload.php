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
$path = 'upload_photo/'; // upload directory

if ( $_SERVER['REQUEST_METHOD'] === 'POST' )

{
	if( @is_uploaded_file($_FILES['image']['tmp_name']) )
	{
		// get uploaded file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		// looking for format and size validity
		if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size)
		{
			$unique = 'userid-'.$_SESSION["UserID"];
			// unique file path
			$path = $path . $unique . '.' .$ext;

			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['image']['tmp_name'], $path))
			{
				
				$image->load($path); 
				$image->resizeToWidth(200); 
				$image->save('upload_photo/userid-'.$_SESSION["UserID"].'.'.$ext); 
				$save_image = 'upload_photo/userid-'.$_SESSION["UserID"].'.'.$ext;
				$model->update_tbl('tteacher',array('photo' => $save_image ),array('ID' => $_SESSION['UserID'] ));
				$status = array('status' => 'Image successfully uploaded!', 'image_name' =>  $save_image."?".date('Ymdhis'));
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