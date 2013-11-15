<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$day = date('l');
$base = base_url();
$schedlist =   $model->select_where('tclasssched',array('CountryID' => $_SESSION['UserValue1'],'TeacherID1' => $_SESSION['UserID'], 'Day' => $day));

include($default->template('header_view'));
include($default->main_view('attendance_class_view'));
include($default->template('footer_view'));
?>