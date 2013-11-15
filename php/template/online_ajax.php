<?php 
session_start();
include('myclass.php');

if(isset($_POST['custno'])){
	$yourcustomer = $model->select_where2('tcustomer', array('StudentID' => $_POST['custno']));

 	$fullname = array('fname' => $yourcustomer->fields['FirstName'].' '.$yourcustomer->fields['MiddleName'].' '.$yourcustomer->fields['SurName']);
 	echo json_encode($fullname);

}




?>