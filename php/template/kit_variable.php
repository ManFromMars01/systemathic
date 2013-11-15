<?php
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$itemno = $_POST['itemno'];

$sql = "SELECT * from titems WHERE titems.ItemNo ='".$itemno."'"; 



$test  = $objConn1->Execute($sql);
foreach($test as $tests ):
$itemdesc = $tests['Description'];
endforeach;


$myresult = array('test' => $itemdesc);
echo json_encode($myresult);


?>