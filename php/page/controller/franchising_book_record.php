<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$country = $model->select_table('tcountry');

$breadcrumbs = "";

if(isset($_GET['country']) && isset($_GET['branch']) ){
	$items = $model->select_where('titems',array('IsBook' => 'Yes'));	
	$country = $model->select_where('tcountry',array('ID' => $_GET['country']));
	$branch = $model->select_where('tbranch',array('BranchID' => $_GET['branch']));
	if($_GET['branch'] !="Overall"):
		$breadcrumbs  =" - ".$country->fields['Description']."(".$branch->fields['Description'].")";
	else:
		$breadcrumbs  =" - ".$country->fields['Description']."(Overall)";
	endif;
}


include($default->template('header_view'));
include($default->main_view('franchasing_book_record_view'));
include($default->template('footer_view'));
?>