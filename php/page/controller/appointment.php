<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$success = "";
if(isset($_GET['app_id'])){
	$apid = $_GET['app_id'];
	$model->delete_where('etimesched',array('BranchID' => $_SESSION['UserValue2'], 'AppointmentID' => $apid ));
	$success = success('<strong>Remove Successfully!!</strong>');	
}


$appointment= $model->select_where('etimesched', array('BranchID' => $_SESSION['UserValue2']));



include($default->template('header_view'));
include($default->main_view('appointment_view'));
include($default->template('footer_view'));
?>