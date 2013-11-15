<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable





include($default->template('header_view'));
include($default->main_view('contact_view'));
include($default->template('footer_view'));
?>