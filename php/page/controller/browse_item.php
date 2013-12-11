<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$titems =   $model->select_where('thitems', array('BranchID' => $_SESSION['UserValue2']));

include($default->template('header_view'));
include($default->main_view('browse_item_view'));
include($default->template('footer_view'));
?>