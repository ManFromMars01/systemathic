<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['custno'])):
	$custno = $_POST['custno'];
	$customer = $model->select_where('tcustomer', array('CustNo' => $custno));
	$option = "	<option value='".$customer->fields['Mother']."'>".$customer->fields['Mother']."</option>
			  	<option value='".$customer->fields['Father']."'>".$customer->fields['Father']."</option>
			  ";	


	$success = array('status' => $option);
	echo json_encode($success);
endif;


?>