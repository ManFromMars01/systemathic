<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable
  

$curver = $model->count_where('titems',array('CountryID' => $_POST["txttitemsCountryID"], 'LastPurVdrID' => $_POST["txttitemsLastPurVdrID"], 'CatID'=> $_POST["txttitemsCatID"],'Color' => $_POST["txttitemscolors"] ,'Sizes' => $_POST["txttitemssize"]));
$newver = $curver + 1;
$newver = str_pad($newver, 2, '0', STR_PAD_LEFT);

$sku = $_POST["txttitemsCountryID"].$_POST["txttitemsLastPurVdrID"].$_POST["txttitemsCatID"].$_POST["txttitemscolors"].$_POST["txttitemssize"].$newver;


$toinsert = array(
"CountryID" => $_POST["txttitemsCountryID"],
"BranchID" => $_POST["txttitemsBranchID"],
"Description" => $_POST["txttitemsDescription"],
"IsBook" => "No",
"CatID" => $_POST["txttitemsCatID"],
"IssuUntCost" => $_POST["txttitemsIssuUntCost"],
"LastPurVdrID" => $_POST["txttitemsLastPurVdrID"],
"Color"          => $_POST['txttitemscolors'],
"Sizes"           => $_POST['txttitemssize'],
"Sku"            => $sku,
"ItemNo"  => $sku,
);

$toinsert2 = array(
  "CountryID" => $_POST["txttitemsCountryID"],
  "BranchID" => $_POST["txttitemsBranchID"],
  "Sku"     =>  $sku,
  "ItemNo"  => $sku,
  'IssuUntCost' =>  $_POST['txttitemsIssuUntCost'],// magkakano  nagastos 
  'PurUntCost'  =>  $_POST['txttitemsPurUntCost'],  // price for branch
  'StdCost'     =>  $_POST['txttitemsStdCost'],   // price for customer
  "QtyOnHand" => $_POST["txttitemsQtyOnHand"],
);


$model->insert_tbl('titems',$toinsert);
$model->insert_tbl('thitems',$toinsert2);

//$success = "Save Successfully";

$myStatus  = array("mystatus" => "Transaction Complete. New Item Sku : ". $sku);
echo json_encode($myStatus);   
?>