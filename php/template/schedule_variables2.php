 <?php
session_start();
include_once('../systemathicappdata.php');
include_once('../ConnInfo.php');
include_once('../utils.php');
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
    
   if(isset($_POST['sched_codes'])){
      $txteattheadHrFr1 = $_POST['txteattheadHrFr1'];
      $txteattheadHrTo1 = $_POST['txteattheadHrTo1'];
      $txteattheadRm1   = $_POST['txteattheadRm1']; 
      $txteattheadTeaID1 = $_POST['txteattheadTeaID1'];
      $txteattheadCustNo =  $_POST['txteattheadCustNo'];
      $txteattheadLevelID =  $_POST['txteattheadLevelID'];
      $txteattheadTierID  = $_POST['txteattheadTierID'];
      $txteattheadModCount = $_POST['txteattheadModCount'];
      $txteattheadStartDate =  $_POST['txteattheadStartDate'];
      $txteattheadCountryID = $_POST['txteattheadCountryID'];
      $txteattheadBranchID = $_POST['txteattheadBranchID'];
      $session_number =  $_POST['session_number'];
      $dayname        =  $_POST['txteattheadDay1'];

      $totsession = $txteattheadModCount * 10;


      $sched_codes   =  $_POST['sched_codes'];
        $x = 0;
        for($i=0;$i<=6;$i++)
        {

            if($txteattheadHrFr1[$i] != ""){
                
                $x = $x + 1;
                $from[$x] = $txteattheadHrFr1[$i];
                $to[$x] = $txteattheadHrTo1[$i]; 
                $roomid[$x] = $txteattheadRm1[$i];
                $teacherid[$x] = $txteattheadTeaID1[$i];
                $schedid[$x]  = $sched_codes[$i];
                $dayno[$x]    = 1 ;
                $session_ar[$x]  = $session_number[$i]; 
                $daytext[$x]     =  $dayname[$i];

            }
             
        }
        //$my_result =  array('from1' =>$from[1], 'from2' =>$from[2], 'from3' =>$from[3], 'from4' =>$from[4], 'from5' =>$from[5], 'from6' =>$from[6], 'from7' =>$from[7]);
        //echo json_encode($my_result);
        $otherc = "CustNo,LevelID,TierID,ModCount,StartDate,CountryID,BranchID,TotSession";
        $otherv = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."',"."'".$txteattheadModCount."',"."'".$txteattheadStartDate."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$totsession."'"; 

        $schedc = "SchedCode1,SchedCode2,SchedCode3,SchedCode4,SchedCode5,SchedCode6,SchedCode7";
        $schedv  = "'".$schedid[1]."',"."'".$schedid[2]."',"."'".$schedid[3]."',"."'".$schedid[4]."',"."'".$schedid[5]."',"."'".$schedid[6]."',"."'".$schedid[7]."'";


        $daynoc = "DayNo1,DayNo2,DayNo3,DayNo4,DayNo5,DayNo6,DayNo7";
        $daynov  = "'".$dayno[1]."',"."'".$dayno[2]."',"."'".$dayno[3]."',"."'".$dayno[4]."',"."'".$dayno[5]."',"."'".$dayno[6]."',"."'".$dayno[7]."'";

        $fromc = "HrFr1,HrFr2,HrFr3,HrFr4,HrFr5,HrFr6,HrFr7";
        $fromv  = "'".$from[1]."',"."'".$from[2]."',"."'".$from[3]."',"."'".$from[4]."',"."'".$from[5]."',"."'".$from[6]."',"."'".$from[7]."'";
        
        $toc = "HrTo1,HrTo2,HrTo3,HrTo4,HrTo5,HrTo6,HrTo7";
        $tov  = "'".$to[1]."',"."'".$to[2]."',"."'".$to[3]."',"."'".$to[4]."',"."'".$to[5]."',"."'".$to[6]."',"."'".$to[7]."'"; 

        $teacherc = "TeaID1,TeaID2,TeaID3,TeaID4,TeaID5,TeaID6,TeaID7";
        $teacherv  = "'".$teacherid[1]."',"."'".$teacherid[2]."',"."'".$teacherid[3]."',"."'".$teacherid[4]."',"."'".$teacherid[5]."',"."'".$teacherid[6]."',"."'".$teacherid[7]."'"; 


        $roomc = "Rm1,Rm2,Rm3,Rm4,Rm5,Rm6,Rm7";
        $roomv  = "'".$roomid[1]."',"."'".$roomid[2]."',"."'".$roomid[3]."',"."'".$roomid[4]."',"."'".$roomid[5]."',"."'".$roomid[6]."',"."'".$roomid[7]."'"; 


        $session = "SessionPrDay1,SessionPrDay2,SessionPrDay3,SessionPrDay4,SessionPrDay5,SessionPrDay6,SessionPrDay7";

        
        $sql = "insert into eatthead (".$otherc."," .$fromc.",".$toc.",".$teacherc.",".$roomc.",".$schedc.") values (" .$otherv.",".$fromv.",".$tov.",".$teacherv.",".$roomv.",".$schedv.")";

        $oRStcountry = $objConn1->Execute($sql);
        $startdate = strtotime($txteattheadStartDate);
        
        $session_number1 = $session_ar[1];
        $session_number2 = $session_ar[2];
        $session_number3 = $session_ar[3];
        $session_number4 = $session_ar[4];
        $session_number5 = $session_ar[5];
        $session_number6 = $session_ar[6];
        $session_number7 = $session_ar[7];

        $daytext1 = $dayname[0];
        $daytext2 = $dayname[1];
        $daytext3 = $dayname[2];
        $daytext4 = $dayname[3];
        $daytext5 = $dayname[4];
        $daytext6 = $dayname[5];
        $daytext7 = $dayname[6];
 

       
        
        



        $total_session = $totsession - 1;
        //$total_session = ($totsession / $session_number1) - 1;

        //$dayno = 0; 

        $loopme = 10 *  $total_session * 7;
        $y = 0;
        for($x=0; $x <= $loopme ; $x++)
        {

                      
             $dates = strtotime("+".$x." day",$startdate);
             $test  = date('l', $dates);
             
             if( $test == $daytext1 || $test == $daytext2 || $test == $daytext3 || $test = $daytext4 || $test = $daytext5 || $test = $daytext6 || $test = $daytext7  ){
              
                 if($test == $daytext1 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[1]."','".$schedid[1]."','".$from[1]."','".$to[1]."','1','".$teacherid[1]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }

                 }

                 if($test == $daytext2 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[2]."','".$schedid[2]."','".$from[2]."','".$to[2]."','1','".$teacherid[2]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }

                 if($test == $daytext3 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[3]."','".$schedid[3]."','".$from[3]."','".$to[3]."','1','".$teacherid[3]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }

                 if($test == $daytext4 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[4]."','".$schedid[4]."','".$from[4]."','".$to[4]."','1','".$teacherid[4]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }

                 if($test == $daytext5 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[5]."','".$schedid[5]."','".$from[5]."','".$to[5]."','1','".$teacherid[5]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }

                 if($test == $daytext6 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[6]."','".$schedid[6]."','".$from[6]."','".$to[6]."','1','".$teacherid[6]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }

                 if($test == $daytext7 ){
                      for($b=1; $b <=  $session_number1; $b++){ 
                        
                        $test2  = date('Y-m-d', $dates);
                        $myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcalendar  WHERE tcalendar.CountryID ='".$_SESSION['UserValue1']."' AND tcalendar.Date = '".$test2."'";
                        $oRStcustomers = $objConn1->Execute($myRecordCount2);
                        $TotalRecords1 = $oRStcustomers->fields["MyCount"];
                        if($TotalRecords1 == 0){
                           $y = $y + 1;
                          //$testme  .= date('Y-m-d', $dates);
                          $values = "'".$txteattheadCustNo."',"."'".$txteattheadLevelID ."',"."'".$txteattheadTierID."','".$txteattheadCountryID."','".$txteattheadBranchID."','".$test2."','".$y."','".$roomid[7]."','".$schedid[7]."','".$from[7]."','".$to[7]."','1','".$teacherid[7]."'"; 
                          $columns = "CustNo,LevelID,TierID,CountryID,BranchID,Date,SessionNo,RmID,SchedCode,TimeFrom,TimeTo,StatusID,TeacherID";
                          $insertsql = "insert into eattdtl(".$columns.") values (" .$values.")";
                          $objConn1->Execute($insertsql);   

                        }

                      }
                 }
              
            }

            if($y >= $totsession){
              break;
            }
              
            
           
        }



        $my_result = array('mystatus' => $sql, 'test' => $insertsql );
        echo json_encode($my_result);
        

    
  }






 ?>  