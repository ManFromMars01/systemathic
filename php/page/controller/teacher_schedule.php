<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$tteacher = $model->select_where('tteacher',array('BranchID' => $_SESSION['UserValue2']));


include($default->template('header_view'));
include($default->main_view('teacher_schedule_view'));
include($default->template('footer_view'));
?>