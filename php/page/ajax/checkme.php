<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['branchid'])):
	$branchid = $_POST['branchid'];
	$reqid    = $_POST['reqid'];
	$model->update_tbl('echecklist', array('Status' => $_POST['st']), array('BranchID' => $branchid, 'ReqID' => $reqid));
	$success = array('status'=> 'Success');
	echo json_encode($success);
endif;


?>