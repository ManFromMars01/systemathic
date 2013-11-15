<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$success = "";
if(isset($_GET['rem_id'])){
	$model->delete_where('ereminder',array('ID' => $_GET['rem_id']));
	$success = success('<strong>Remove Successfully!!</strong>');	
}


$reminder = $model->select_where('ereminder', array('BranchID' => $_SESSION['UserValue2']));



include($default->template('header_view'));
include($default->main_view('reminder_view'));
include($default->template('footer_view'));
?>