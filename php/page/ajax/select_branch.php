<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['countryid'])):
	$cid = $_POST['countryid'];
	$branch = $model->select_where('tbranch',array('CountryID' => $cid));
	foreach($branch as $branches):
		$option .=  "<option value='".$branches['BranchID']."'>".$branches['Description']."</option>";
	endforeach;
	$option .= "<option value='Overall'>Overall</option>";
	$success = array('success' => $option );
	echo json_encode($success);
endif;



?>