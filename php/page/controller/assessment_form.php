<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable


//variable and other functions


$customer_no = $_GET['CustomerNo'];
$assessment = $model->select_where('tassessment',array('CountryID' =>  $_SESSION['UserValue1']));
$customer  = $model->customer_det($customer_no = $_GET['CustomerNo']);

	

if(isset($_POST['submit_assess'])){
	foreach($assessment as $assessments):
		$id = $assessments['ID'];
		$toinsert = array(
			 'CountryID' => $_SESSION['UserValue1'],
			 'BranchID'  => $_SESSION['UserValue2'],
			 'CustNo'    => $_POST['custno'],
			 'Date'      => date('Y-m-d'),
			 'AssID'     => $id,
			 'LineStatus' =>$_POST['assessment'.$id],
			 'Status'     =>$_POST['assessment_ov'],   
			);
	$model->insert_tbl('eassessment',$toinsert);
	endforeach;	

	echo "<script> alert('Successfully Assess');
			window.location = '".base_url('BrowseStudentlist3.php?CustType=Assessment&RegType=Waiting')."';</script>";

	exit;
}



include($default->template('header_view'));
include($default->main_view('assessment_form_view'));
include($default->template('footer_view'));
?>