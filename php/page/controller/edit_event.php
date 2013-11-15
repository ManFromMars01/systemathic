<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$success = "";
$where = array('EventID' => $_GET['event_id']);
$event = $model->select_where('eexamfile',$where);



include($default->template('header_view'));
include($default->main_view('edit_event_view'));
include($default->template('footer_view'));
?>