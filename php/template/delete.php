<?php
session_start();
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

if(isset($_GET['Page'])){

	if($_GET['Page'] == 'kit'){
		$sql = "DELETE FROM tkitpack WHERE LevelID = '".$_GET['Level']."' AND ItemNo = '".$_GET['Itemno']."' ";  

		$test = $objConn1->Execute($sql);
		$newURL = "../BrowseKitPacklist.php?ID1='".$_SESSION['UserValue1']."'&ID2='".$_SESSION['UserValue2']."'&ID3=".$_GET['Level'];
		header('Location: '.$newURL);
	}

	if($_GET['Page'] == 'items'){
		$sql = "DELETE FROM titems WHERE BranchID = '".$_SESSION['UserValue2']."' AND ItemNo = '".$_GET['Itemno']."' ";  

		$test = $objConn1->Execute($sql);
		echo $sql;
		
		$newURL = "../BrowseItemslist.php";
		header('Location: '.$newURL);
	}

}



?>