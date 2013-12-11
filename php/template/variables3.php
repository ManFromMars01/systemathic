 <?php
    include('ConnInfo.php');

    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
    
    /**Begin Teacher**/
    $selectteacher = "SELECT *  FROM tteacher  WHERE tteacher.CountryID ='".$_SESSION['UserValue1']."' AND tteacher.BranchID='".$_SESSION['UserValue2']."'";
    
    $selectteacher = $objConn1->Execute($selectteacher);
    foreach ($selectteacher as $selectteachers):
            
        $teacher  .= '<option value="'.$selectteachers['ID'].'"'.$selected.'>'.$selectteachers['LocalName'].'</option>';
    endforeach;
    /**End Teacher**/


    /**Begin LEvel**/
    $selectlevel = "SELECT *  FROM tlevel";
    $selectlevel = $objConn1->Execute($selectlevel);
    foreach ($selectlevel as $levellist):     
        $level  .= '<option value="'.$levellist['ID'].'"'.$selected.'>'.$levellist['Description'].'</option>';
    endforeach;
    /**End LEvel**/

    /**Begin rooms**/
    $selectrooms = "SELECT *  FROM troom  WHERE troom.CountryID ='".$_SESSION['UserValue1']."' AND troom.BranchID='".$_SESSION['UserValue2']."'";
    $selectrooms = $objConn1->Execute($selectrooms);
    foreach ($selectrooms as $selectroom):     
        $rooms  .= '<option value="'.$selectroom['ID'].'"'.$selected.'>'.$selectroom['Description'].' - '.$selectroom['TotalSeat'].' seats</option>';
    endforeach;
    /**End rooms**/

    /**Begin time**/
    $selecttime = "SELECT *  FROM ttime  WHERE ttime.CountryID ='".$_SESSION['UserValue1']."'";
    $selecttime = $objConn1->Execute($selecttime);
    $time .= "<option value=''>Please Select Available Time</option>";    
    foreach ($selecttime as $selecttimes):     
        $time .= '<option value="'.$selecttimes['TimeID'].'"'.$selected.'>'.$selecttimes['FromTime'].' - '.$selecttimes['ToTime'].'</option>';
    endforeach;

    /**End time**/



    $TemplateText = Replace($TemplateText, "@teacher@", $teacher); 
    $TemplateText = Replace($TemplateText, "@level@", $level); 
    $TemplateText = Replace($TemplateText, "@country@", $_SESSION['UserValue1']); 
    $TemplateText = Replace($TemplateText, "@branch@", $_SESSION['UserValue2']); 
    $TemplateText = Replace($TemplateText, "@rooms@", $rooms); 
    $TemplateText = Replace($TemplateText, "@time@", $time); 

 ?>   