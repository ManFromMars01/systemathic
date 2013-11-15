<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['type_att'])):

	$schedcode = $_POST['schedcode'];
	$datetoday = $_POST['date_today'];
	$custno    =  $_POST['custno'];

	if($_POST['type_att'] == "Present"):	
		$model->update_tbl('eattdtl',array('StatusID'=>'2'),array('SchedCode'=>$schedcode,'Date'=>$datetoday,'CustNo'=>$custno));
		$success = array('status'=>$_POST['type_att']);
		echo json_encode($success);
	endif;
	if($_POST['type_att'] == "Absent"):	
		$model->update_tbl('eattdtl',array('StatusID'=>'3'),array('SchedCode'=>$schedcode,'Date'=>$datetoday,'CustNo'=>$custno));
		$success = array('status'=>$_POST['type_att']);
		echo json_encode($success);
	endif;
endif;


?>