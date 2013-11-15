<?php
session_start();
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);



$students = "SELECT *  FROM tcustomer  WHERE  tcustomer.StudentID='".$_POST['studid']."'";
$students = $objConn1->Execute($students);
$fullname = $students->fields['LSurname']. ", ".$students->fields['FirstName']." ".$students->fields['MiddleName'];
 
$myname = array('fullname' => $fullname );
echo json_encode($myname);




?>