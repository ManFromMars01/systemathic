<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$branch= $_GET['branchid'];
$year  = '2013';
$month = '11';


$royalty = $model->select_where('eroyalty', array('BranchID' => $branch, 'Year' => $year , 'Month' => $month));
$yourinv = $model->select_where('ehroyalty', array('BranchID' => $branch, 'Year' => $year , 'AppMonth' => $month));
$branchdet = $model->select_where('tbranch',array('BranchID' => $branch));
$payment  = $model->select_where('eroyaltypayment',array('BillingID' => $yourinv->fields['BillingID'] ));
$paytype  = $model->select_table('tpaytype');

$billing = $model->select_where('ehroyalty', array('CountryID' => $branchdet->fields['CountryID'], 'Year' => $year , 'AppMonth' => $month, 'PayTo' => 'HQ',  'Status' => '5'));


include($default->template('header_view'));
include($default->main_view('royalty_billing_country_view'));
include($default->template('footer_view'));
?>