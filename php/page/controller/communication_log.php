<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$success = "";
if(isset($_GET['ref_id'])){
	$model->delete_where('eactivity',array('ReferenceID' => $_GET['ref_id']));
	$success = success('<strong>Remove Successfully!!</strong>');	
}


$activity = $model->select_where('eactivity', array('BranchID' => $_SESSION['UserValue2']));



include($default->template('header_view'));
include($default->main_view('communication_log_view'));
include($default->template('footer_view'));
?>