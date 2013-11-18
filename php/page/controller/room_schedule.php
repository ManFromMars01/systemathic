<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable



//variable and functions here
//$teachers =   $model->select_where('tteacher',array('CountryID' => 'PH'));
$rooms =   $model->select_where('troom',array('CountryID' => 'PH'));





include($default->template('header_view'));
include($default->main_view('room_schedule_view'));
include($default->template('footer_view'));
?>