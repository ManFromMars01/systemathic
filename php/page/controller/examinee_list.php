<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

if(isset($_GET['cust_no'])){
	$model-> delete_where('eexamreg', array('EventID' => $_GET['event_id'], 'CustNo' => $_GET['cust_no']));
	$success = '<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>Well done!</strong> You successfully remove this student.
						</div>';
}


$success = "";
$examinee = $model->select_where('eexamreg',array('EventID' => $_GET['event_id']));



include($default->template('header_view'));
include($default->main_view('examinee_list_view'));
include($default->template('footer_view'));
?>