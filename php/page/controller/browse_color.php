<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$color =   $model->select_table('tcolor');

include($default->template('header_view'));
include($default->main_view('browse_color_view'));
include($default->template('footer_view'));
?>