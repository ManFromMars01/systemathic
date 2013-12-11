<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$discounta = 0;
$discountb = 0;
$discountc = 0;
$total = 0;
$quantitys = 0;
$groupa = 0;
$groupb = 0;
$groupc = 0;
//variable and functions here
$discount_country = $model->select_where('tcountry',array('ID' => $_SESSION['UserValue1']));
if($discount_country->fields['DiscountType'] == 1){
	$groupa = $discount_country->fields['ItemDiscRateA'];
	$groupb = $discount_country->fields['ItemDiscRateB'];
	$groupc = $discount_country->fields['ItemDiscRateC'];
}



if(isset($_SESSION["cart"])){
	$count = $model->count_where('epoheader',array('BranchID' => $_SESSION['UserValue2']));
	$poid =  $count + 1 ;

	foreach($_SESSION["cart"] as $key => $item):
		if($item['discountg'] == "A" ){ $discounta =  $discounta  + ($item["price"] * $item["quantity"]);}
	 	if($item['discountg'] == "B" ){ $discountb =  $discountb  + ($item["price"] * $item["quantity"]);}	
	 	if($item['discountg'] == "C" ){ $discountc =  $discountc  + ($item["price"] * $item["quantity"]);}	
		$total = $total  + ($item['quantity'] * $item["price"]);
	 	$quantitys = $quantitys + $item['quantity']; 
	endforeach;	

	$totalga = $discounta - ($discounta * ($groupa / 100));
	$totalgb = $discountb  -  ($discountb * ($groupb / 100));
	$totalgc = $discountc -  ($discountc * ($groupc / 100));
	if($groupa == 0){ $totalga = $discounta ;}
    if($groupb == 0){ $totalgb = $discountb ;}
    if($groupc == 0){ $totalgc = $discountc ;}
    $supertotal =  $totalga + $totalgb + $totalgc;

	$insert = array(
			'CountryID' => $_SESSION['UserValue1'],
			'BranchID'  => $_SESSION['UserValue2'],
			'PONumber'  => $poid,
			'VendorNo'  => 2,
			'DateOrder' => date('Y-m-d'), 
			'TotAmount' => $supertotal,
			'Status'    => '0'
			);
	$model->insert_tbl('epoheader',$insert);
	$y = 1;
	
	foreach($_SESSION["cart"] as $key => $items):
		//$titemss = $model->select_where('titems',array('ItemNo' => $items['id']));
		$test = $y++;


		$insert2 = array(
			'CountryID' => $_SESSION['UserValue1'],
			'BranchID'  => $_SESSION['UserValue2'],
			'LineNo'	=> $test,
			'PONumber'  => $poid,
			'ItemNo'    => $items['id'],
			'QtyOrdered' => $items['quantity'],
			'CostOrdered' => $items['quantity'] * $items['price'], 
			'RetailAmt'   =>  $items['price']
			);
		$model->insert_tbl('epodetail',$insert2);
	endforeach;	

	$count2 = $model->count_where('epoheader',array('BranchID' => $_SESSION['UserValue2']));
	$newpo = $count2;
	unset($_SESSION["cart"]);

	$neworder = $model->select_where('epodetail',array('BranchID' => $_SESSION['UserValue2']));


}

include($default->template('header_view'));
include($default->main_view('process_order_view'));
include($default->template('footer_view'));

?>