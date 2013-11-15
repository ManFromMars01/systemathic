<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$student =   $model->select_where('eattdtl',array('SchedCode' => $_GET['SchedCode'], 'Date' => date('Y-m-d') ));


include($default->template('header_view'));
include($default->main_view('attendance_student_view'));
include($default->template('footer_view'));
?>