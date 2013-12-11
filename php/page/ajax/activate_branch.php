<?php 
include('../class/model.php');
include('../class/systemathic.php');

$branch = $_POST['branch'];
if($_POST['activate'] == '1'){
	$test=$model->update_tbl('tbranch',array('Activated' => 1 ), array('BranchID' => $branch));
	$success = array('status' => 'Branch Activated');
	echo json_encode($success);
}

if($_POST['activate'] == '2'){
	$test=$model->update_tbl('tbranch',array('Activated' => 2 ), array('BranchID' => $branch));
	$success = array('status' => 'Branch Deactivated');
	echo json_encode($success);
}

?>