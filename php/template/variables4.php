<?php 
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
 

if(isset($_POST['timecode'])){


    $selectlevel = "SELECT *  FROM ttime  WHERE ttime.TimeID ='".$_POST['timecode']."'";
    $selectlevel = $objConn1->Execute($selectlevel);
    foreach ($selectlevel as $levellist):     
        $from  = $levellist['FromTime'];
        $to    = $levellist['ToTime'];
    endforeach;      
    $myresult =array("from" => $from , "to" => $to );
     echo json_encode($myresult);	
}

if(isset($_POST['teacher_id'])){

    $selectlevel = "SELECT *  FROM tteacher  WHERE tteacher.ID ='".$_POST['teacher_id']."'";
    $selectlevel = $objConn1->Execute($selectlevel);
    foreach ($selectlevel as $levellist):     
        $teachername  = $levellist['LocalName'];
        //$to    = $levellist['ToTime'];
    endforeach;      
    $myresult =array("teacher" => $teachername);
     echo json_encode($myresult);	
}
     
?>