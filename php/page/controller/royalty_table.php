<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$branches = $model->select_where('tbranch', array('HQOperation' => 'Yes'));


$year  = date('Y');
$month = date('m');






include($default->template('header_view'));
include($default->main_view('royalty_table_view'));
include($default->template('footer_view'));
?>