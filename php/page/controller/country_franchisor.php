<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$country = $model->select_table('tcountry');




include($default->template('header_view'));
include($default->main_view('country_franchisor_view'));
include($default->template('footer_view'));
?>