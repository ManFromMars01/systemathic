<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['currencyfrom'])):
	$from = $_POST['currencyfrom'];
	$to =   $_POST['currencyto'];

	$froms = $model->select_where('tcurrency', array('Symbol' => $from));
	$tos  = $model->select_where('tcurrency', array('Symbol' => $to));
	
	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
    $tocurr = array($tos->fields['Symbol'], $tos->fields['Description']);
	$result = currencyExchange('1',$fromcurr,$tocurr);

	$success = array('success' => $result);
	echo json_encode($success);
endif;


?>