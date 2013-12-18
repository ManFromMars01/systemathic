<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$designs =   $model->select_table('tdesign');

function select_collection($designcode){
	$model = new Model;
	$new_coll= $model->select_where('tcollection',array('Code' => $designcode));
	echo $new_coll->fields['Description'];
}

include($default->template('header_view'));
include($default->main_view('browse_design_view'));
include($default->template('footer_view'));
?>