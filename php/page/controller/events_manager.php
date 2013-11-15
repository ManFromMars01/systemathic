<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$events = $model->select_where('eexamfile',array('CountryID' => $_SESSION['UserValue1']));


include($default->template('header_view'));
include($default->main_view('events_manager_view'));
include($default->template('footer_view'));
?>