<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$country = $model->select_table('tcountry');

if(isset($_POST['branch'])){
	$customers= $model->select_where('tcustomer',array('BranchID' => $_POST['branch'], 'RegType' => 'Admitted'));
	$customers_count= $model->count_where('tcustomer',array('BranchID' => $_POST['branch'], 'RegType' => 'Admitted'));

	$branch_name   = $model->select_where('tbranch', array('BranchID' => $_POST['branch']));
	$country_name   = $model->select_where('tcountry', array('ID' => $_POST['country']));
}




include($default->template('header_view'));
include($default->main_view('franchasing_student_record_view'));
include($default->template('footer_view'));
?>