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

$discount_country= $model->select_where('tcountry',array('ID' => $_SESSION['UserValue1']));
if($discount_country->fields['DiscountType'] == 1){
	$groupa = $discount_country->fields['ItemDiscRateA'];
	$groupb = $discount_country->fields['ItemDiscRateB'];
	$groupc = $discount_country->fields['ItemDiscRateC'];
}

if(isset($_POST['item_id'])):
	foreach($_SESSION['cart'] as $key => $item):
		if($item['id'] == $_POST['item_id']){
			unset($_SESSION['cart'][$key]);
			$items = $model->select_where('thitems', array('ItemNo' => $_POST['item_id'], 'BranchID' => $_SESSION['OrderHQ'] ));
			$desc  = $model->select_where('titems',array('ItemNo' => $_POST['item_id']));
			$_SESSION['cart'][] = array("id" => $_POST['item_id'],"quantity" => $_POST['qty'],"price"=>$items->fields['IssuUntCost'],"discountg"=>$desc->fields['GroupDisc']);
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
	
	if($groupa == 0){ $totalga = $discounta ;}
    if($groupb == 0){ $totalgb = $discountb ;}
    if($groupc == 0){ $totalgc = $discountc ;}
    $supertotal =  $totalga + $totalgb + $totalgc;

	$success = array('total' => number_format($total,2), 'quantity' => $quantitys, 'fora' => number_format($discounta,2),'forb' => number_format($discountb,2), 'forc' => number_format($discountc,2), 'pricea' => number_format($totalga,2), 'priceb' => number_format($totalgb,2), 'pricec' => number_format($totalgc,2),'supertotal' => number_format($supertotal,2));
	echo json_encode($success);
endif;





 





?>