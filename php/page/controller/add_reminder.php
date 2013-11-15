
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";
if(isset($_POST['save_event'])){
	$teacher = $model->select_where('tteacher', array('ID' => $_POST['teacher_id'])); 	



	$insert = array(
	 'CountryID' => $teacher->fields['CountryID'],
	 'BranchID' => $teacher->fields['BranchID'],
	 'TeacherID'   => $teacher->fields['ID'],		 			
	 'Date'   =>  $_POST['date'],
	 'Reminder' => $_POST['reminder'], 
	);

	$model->insert_tbl('ereminder',$insert);
	$success = success('<strong>Well Done!!</strong> Save Successfully');

}



include($default->template('header_view'));
include($default->main_view('add_reminder_view'));
include($default->template('footer_view'));
?>