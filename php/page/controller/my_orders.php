<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
//variable and functions here
$success = "";
$mycurrency = $model->currencys($_SESSION['UserValue1']);
if(isset($_GET['branchid']) && isset($_GET['ponumber'])){
	$model->update_tbl('epoheader',array('Status' => '1'),array('BranchID' => $_GET['branchid'],'PONumber' => $_GET['ponumber'] ));	
	$success = success();
}

$orders = $model->select_where_orderby('epoheader',array('BranchID' => $_SESSION['UserValue2']),'PONumber');

function vendor_name($vendorid){
	$model  = new Model;
	$vendor = $model->select_where('tvendor', array('ID' => $vendorid));
	echo $vendor->fields['Name'];
}

function order_status($statusid){
	if($statusid  == 1){
		echo '<span class="label label-success">Complete</span>';
	} 
	elseif($statusid  == 2){
		echo '<span class="label label-success">Complete</span>';
	}else{
		echo '<span class="label label-warning">On-Process</span>';
	}
}




include($default->template('header_view'));
include($default->main_view('my_orders_view'));
include($default->template('footer_view'));
?>