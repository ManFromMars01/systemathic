<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$tcustomer = $model->select_where('tcustomer',array('CountryID'=>$_SESSION['UserValue1'], 'BranchID'=>$_SESSION['UserValue2']));
$vendor = $model->select_where('tvendor',array('CountryID'=>$_SESSION['UserValue1']));
$manufacturer = $model->select_where('tmanufacturer',array('CountryID'=>$_SESSION['UserValue1']));
$franchise    = $model->select_where('tbranch',array('CountryID' => $_SESSION['UserValue1']));


include($default->template('header_view'));
include($default->main_view('all_contacts_view'));
include($default->template('footer_view'));
?>