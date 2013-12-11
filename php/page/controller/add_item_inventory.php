<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$itemlist = $model->select_table('titems');
 	




include($default->template('header_view'));
include($default->main_view('add_item_inventory_view'));
include($default->template('footer_view'));
?>