<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$onlinelist =   $model->select_where('eonline',array('CountryID' => 'PH'));

include($default->template('header_view'));
include($default->main_view('scheduling_view'));
include($default->template('footer_view'));
?>