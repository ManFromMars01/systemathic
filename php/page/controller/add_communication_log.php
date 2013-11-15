
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";
if(isset($_POST['save_event'])){
	$customers = $model->customer_det($_POST['cust_no']); 	



	$insert = array(
	 'CountryID' => $customers->fields['CountryID'],
	 'BranchID' => $customers->fields['BranchID'],
	 'CustNo'   => $customers->fields['CustNo'],		 			
	 'Type'   =>  $_POST['type_log'],
	 'Topics' =>  $_POST['topic'],
	 'Date'   =>  $_POST['date'],
	 'Time'   =>  $_POST['time'],
	 'ParentStep' => $_POST['step_parent'],
	 'TeaStep' =>  $_POST['step_teacher'],
	 'AttestID' => $_POST['attested_id'],
	 'TeacherID' =>   $_POST['teacher_id'],
	 'ExtDescription' => $_POST['add_notes'],
	 'ParentName'    =>  $_POST['parentname']
	);

	$model->insert_tbl('eactivity',$insert);
	$success = success('<strong>Well Done!!</strong> Save Successfully');

}

$customer = $model->select_where('tcustomer',array('CountryID' => $_SESSION['UserValue1']));


include($default->template('header_view'));
include($default->main_view('add_communication_log_view'));
include($default->template('footer_view'));
?>