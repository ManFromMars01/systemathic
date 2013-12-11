<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$level =   $model->select_table('tlevel');

include($default->template('header_view'));
include($default->main_view('browse_class_sched_view'));
include($default->template('footer_view'));
?>