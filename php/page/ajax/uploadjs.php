<?php
/**
* @author Resalat Haque
* @link http://www.w3bees.com
*/
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 

header('Content-type: application/json');

$valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$max_size = 200 * 1024; // max file size (200kb)
$path = 'uploads/'; // upload directory

if ( $_SERVER['REQUEST_METHOD'] === 'POST' )

{
	if( @is_uploaded_file($_FILES['image']['tmp_name']) )
	{
		// get uploaded file extension
		$ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
		// looking for format and size validity
		if (in_array($ext, $valid_exts) AND $_FILES['image']['size'] < $max_size)
		{
			// unique file path
			$path = $path . uniqid(). '.' .$ext;

			// move uploaded file from temp to uploads directory
			if (move_uploaded_file($_FILES['image']['tmp_name'], $path))
			{
				$status = array('status' => 'Image successfully uploaded!', 'image_name' =>  $path);


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