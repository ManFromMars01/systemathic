<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$sizes  =   $model->select_table('tsize');

function category_desc($catid = ""){
	$model = new Model;
	$category =$model->select_where('tcategory',array('ID' => $catid));
	return $category->fields['Description'];
}



include($default->template('header_view'));
include($default->main_view('browse_size_view'));
include($default->template('footer_view'));
?>