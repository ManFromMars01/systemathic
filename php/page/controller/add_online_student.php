<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$admitted = $model->select_where('tcustomer', array('RegType' => 'Admitted'));


if(isset($_POST['saveme'])){
	$idno = $_POST['idno'];
	$mycustomer = $model->select_where('tcustomer', array('StudentID' => $idno));
	$toinsert = array('CountryID'=> $mycustomer->fields['CountryID'],'BranchID'=> $mycustomer->fields['BranchID'], 'CustNo'=> $mycustomer->fields['CustNo'], 'Date' =>date('Y-m-d'), 'Password'=>$_POST['pword_stud']);

	$model->insert_tbl('eonline',$toinsert);
	echo "<script>alert('Successfully Registered');
		window.location = '".base_url('page/controller/online_practices.php')."';
	</script>";
}

include($default->template('header_view'));
include($default->main_view('add_online_student_view'));
include($default->template('footer_view'));
?>