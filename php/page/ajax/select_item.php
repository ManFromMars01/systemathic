<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable
$discounta = 0;
$discountb = 0;
$discountc = 0;
$total = 0;
$quantitys = 0;
$groupa = 0;
$groupb = 0;
$groupc = 0;
$z = 0; 

$discount_country= $model->select_where('tcountry',array('ID' => $_SESSION['UserValue1']));
if($discount_country->fields['DiscountType'] == 1){
	$groupa = $discount_country->fields['ItemDiscRateA'];
	$groupb = $discount_country->fields['ItemDiscRateB'];
	$groupc = $discount_country->fields['ItemDiscRateC'];
}


if(isset($_POST['itemcode'])):
	$itemcode = trim($_POST['itemcode']);
	$countfirst =  $model->count_where('thitems', array('ItemNo' => $itemcode, 'BranchID' => $_SESSION['OrderHQ'])); 
	$desc = $model->select_where('titems',array('ItemNo' => $itemcode));
	$items = $model->select_where('thitems', array('ItemNo' => $itemcode)); // for Franchisee
	$description =   $desc->fields['Description'];
	$itemno      =   $items->fields['ItemNo'];
	$itemcost    =   $items->fields['IssuUntCost'];
	$itemdiscount =  $desc->fields['GroupDisc'];
	$quantity    = 1;

	if($countfirst != 0 && $items->fields['QtyOnHand'] >= 1){
$status    = 1;
$appendthis  =<<<EOT
<tr>
	    <td><input type="text" name="item_code[]" style="width:30px;"  value=$itemno readonly /></td>
	   	<td>$description</td>
	    <td><input style="width:30px;" type="text" alt="$itemno" class="qty" name="qty[]" value="1"></td>
	    <td><input style="width:80px;" type="text" class="price" name="price[]" value=$itemcost></td>
	   	<td><input style="width:40px;" type="text" name="discount[]" value=$itemdiscount></td>
    </tr>
EOT;
	} elseif($countfirst != 0 && $items->fields['QtyOnHand'] <= 0){
		$status = 2;
	} else{
		$status = 0;
	}	

	if(isset($_SESSION['cart'])){
		foreach($_SESSION['cart']  as $key => $item):if($itemcode == $item['id']){$z = 1; $status=3;} endforeach; //check if already in cart
	} 
	
	if($z != 1){$_SESSION['cart'][] = array("id" => $itemno,"quantity" => $quantity, "price" => $itemcost, "discountg" => $itemdiscount );} // add items to cart

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

	$success = array('appendthis' => $appendthis, 'status' => $status, 'total' => number_format($total,2), 'quantity' => $quantitys, 'fora' => number_format($discounta,2),'forb' => number_format($discountb,2), 'forc' => number_format($discountc,2), 'pricea' => number_format($totalga,2), 'priceb' => number_format($totalgb,2), 'pricec' => number_format($totalgc,2), 'supertotal' => number_format($supertotal,2));	
	echo json_encode($success);
endif;











?>