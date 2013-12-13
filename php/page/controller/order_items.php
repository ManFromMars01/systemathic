<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$branch = $_GET['branchid'];
$ponumber = $_GET['ponumber'];

$order_items = $model->select_where('epodetail',array('BranchID' => $branch, 'PONumber' => $ponumber));
$po_head = $model->select_where('epoheader',array('BranchID' => $branch, 'PONumber' => $ponumber));
$mycurrency = $model->currencys($_SESSION['UserValue1']);
function vendor_name($vendorid){
	$model  = new Model;
	$vendor = $model->select_where('tvendor', array('ID' => $vendorid));
	echo $vendor->fields['Name'];
}



include($default->template('header_view'));
include($default->main_view('order_items_view'));
include($default->template('footer_view'));
?>