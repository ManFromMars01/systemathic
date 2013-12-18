<?php
session_start(); 
echo "Please Wait... You will be Redirected in your Page.";

include('../class/model.php');
include('../class/systemathic.php');
$branchid = $_SESSION['UserValue2'];

$items = $model->select_where('titems', array('BranchID' =>'TW001'));
foreach($items as $item):
	$countfirst = $model->count_where('thitems', array('BranchID' => $branchid, 'Sku' => $item['Sku'] ));
	if($countfirst == 0){
		$insert = array(
			'CountryID' => $_SESSION['UserValue1'],
			'BranchID'  => $_SESSION['UserValue2'],
			'Sku' 		=> $item['Sku'],
			'ItemNo'    => $item['ItemNo']     
		);
		$model->insert_tbl('thitems',$insert); 
	}
	
endforeach;	
header('Location:'.base_url('page/controller/browse_item.php'));
?>