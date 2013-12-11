<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 

$update = array(
	'LocalName'  => $_POST['name'],
	'Address1'   => $_POST['address'],
	'Address2'   => $_POST['address2'],
	'PhoneNo'    => $_POST['phone'],
	'MobileNo'   => $_POST['mobile'],
	'Email'      => $_POST['email'],
	'Gender'     => $_POST['gender'],
	'CivilStatus'=> $_POST['civil']
);

$status = $model->update_tbl('tteacher', $update, array('ID' => $_SESSION['UserID']));

$mystatus = array('status' => 'Success');
echo json_encode($mystatus);

?>