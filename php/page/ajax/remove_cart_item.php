<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable
$total = 0;
$quantitys =0;
$discounta = 0;
$discountb = 0;
$discountc = 0;
$groupa = 0;
$groupb = 0;
$groupc = 0;
$currency_to ="";

if($_SESSION['OrderHQ'] =="TW001"){
	$discount_country= $model->select_where('tcountry',array('ID' => 'TW'));
	$currency = "TWD";
	if($discount_country->fields['DiscountType'] == 1){
		$groupa = $discount_country->fields['ItemDiscRateA'];
		$groupb = $discount_country->fields['ItemDiscRateB'];
		$groupc = $discount_country->fields['ItemDiscRateC'];
	}
	$currencyselect = $model->select_where('tcurrency',array('CountryID' => $_SESSION['UserValue1']));
	$currency_to = $currencyselect->fields['Symbol'];   	
	
}else{
	$discount_country= $model->select_where('tcountry',array('ID' => $_SESSION['UserValue1']));
	if($discount_country->fields['DiscountType'] == 1){
		$groupa = $discount_country->fields['ItemDiscRateA'];
		$groupb = $discount_country->fields['ItemDiscRateB'];
		$groupc = $discount_country->fields['ItemDiscRateC'];
	}
	$currencyselect = $model->select_where('tcurrency',array('CountryID' => $_SESSION['UserValue1']));
	$currency = $currencyselect->fields['Symbol'];   	
}


if(isset($_POST['item_id'])):
	foreach($_SESSION['cart'] as $key => $item):
		if($item['id'] == $_POST['item_id']){
			unset($_SESSION['cart'][$key]);
		}

	endforeach;	



	foreach($_SESSION['cart']  as $key => $item):	 
		 if($item['discountg'] == "A" ){ $discounta =  $discounta  + ($item["price"] * $item["quantity"]);}
		 if($item['discountg'] == "B" ){ $discountb =  $discountb  + ($item["price"] * $item["quantity"]);}	
		 if($item['discountg'] == "C" ){ $discountc =  $discountc  + ($item["price"] * $item["quantity"]);}

		 $total = $total  + ($item['quantity'] * $item["price"]);
	     $quantitys = $quantitys + $item['quantity'];  		
	endforeach; 
	$totalga = $discounta - ($discounta * ($groupa / 100));
	$totalgb = $discountb  -  ($discountb * ($groupb / 100));
	$totalgc = $discountc -  ($discountc * ($groupc / 100));
	
	$discamta = $discounta * ($groupa / 100);
	$discamtb = $discountb * ($groupb / 100);
	$discamtc = $discountc * ($groupc / 100); 	

	if($groupa == 0){ $totalga = $discounta ; $discamta = 0;}
    if($groupb == 0){ $totalgb = $discountb ; $discamtb = 0;}
    if($groupc == 0){ $totalgc = $discountc ; $discamtc = 0;}

    $supertotal =  $totalga + $totalgb + $totalgc;
	

	

	if($_SESSION['OrderHQ'] =="TW001"){

	$success = array(
			'total' => number_format($total,2), 
			'quantity' => $quantitys, 
			'fora' => number_format($discounta,2),
			'forb' => number_format($discountb,2), 
			'forc' => number_format($discountc,2), 
			'pricea' => number_format($discamta,2), 'priceb' => number_format($discamtb,2), 'pricec' => number_format($discamtc,2),
			'supertotalct' => currencyExchange($supertotal,array('TWD','TWD'),array($currency_to ,$currency_to )), 
			'supertotal' => $supertotal, 
			'currency' => $currency, 
			'currencyrate' => currencyExchange('1',array('TWD','TWD'),array($currency_to ,$currency_to)),
			'currencyto'   => $currency_to
	);	

	}else{
		$success = array(
			'total' => number_format($total,2), 
			'quantity' => $quantitys, 
			'fora' => number_format($discounta,2),
			'forb' => number_format($discountb,2), 
			'forc' => number_format($discountc,2), 
			'pricea' => number_format($discamta,2), 
			'priceb' => number_format($discamtb,2), 
			'pricec' => number_format($discamtc,2),
			'currency' => $currency, 
			//'supertotalct' => currencyExchange($supertotal,array('TWD','TWD'),array($currency_to ,$currency_to )), 
			'supertotal' => $supertotal
		);	

	}



	echo json_encode($success);
endif;

?>