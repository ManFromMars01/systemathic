<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['custno'])):
	$custno = $_POST['custno'];
	$model->delete_where('eonline', array('CustNo' => $custno));
	$success = array('status'=> 'Success');
	echo json_encode($success);
endif;


?>