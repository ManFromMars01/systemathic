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

$branchdet = $model->select_where('tbranch',array('BranchID' => $branch));





include($default->template('header_view'));
include($default->main_view('franchisee_royalty_det_view'));
include($default->template('footer_view'));
?>