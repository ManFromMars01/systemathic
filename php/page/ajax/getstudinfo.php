<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['studid'])):
	$studid = $_POST['studid'];
	$student = $model->select_where('tcustomer', array('StudentID' => $studid));
	$countstud = $model->count_where('tcustomer', array('StudentID' => $studid));

	if($countstud == 0){
		$success = array('status' => 'Invalid');
	}else{
		$success = array('fname' =>$student->fields['FirstName'],'mname' =>$student->fields['MiddleName'],'sname' =>$student->fields['SurName'], 'status' => 'Valid');
	}
	

	echo json_encode($success);
endif;


?>