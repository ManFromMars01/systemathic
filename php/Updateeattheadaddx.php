<?PHP
/*
===================================================================
------------------ Notice to Web Page Designers! ------------------
===================================================================
 Data enabled web pages often require a particular sequence of
 events to occur for successful execution.  Therefore we ask
 that you not reorder the WEB program logic.  Also there should
 be no changes in the naming of any HTML elements or WEB variables.

 Every effort was made to allow "look and feel" changes to
 occur by modifying the Cascading Style Sheets supplied with this
 application along with the HTML template
===================================================================
*/
session_set_cookie_params(500);
session_start();
$PageLevel = 0;
$PageLevel = 1;
include_once('systemathicappdata.php');
/*
DebugMode is defined in appdata.WEB as FALSE by default
debug of this page only by uncommenting the next line
*/
// $DebugMode = [FALSE, TRUE];

/*
ShowQuery is defined in appdata.WEB from the Application level
query of this page can be overridden by uncommenting the next line
*/
// $ShowQuery = [FALSE, TRUE];
/*
ShowDBNav is defined in appdata.WEB from the Application level
display of the nav bar can be overridden by uncommenting the next line
*/
// $ShowDBNav = [FALSE, TRUE];
include_once('utils.php');
include('login.php');
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$myAction = "";
$strSQL = "";
$myStatus = "";
$flgMissing = 0;
$myError = "";

$HTML_Template = getRequest("HTMLT");


$dbColumns = "";
$dbValues = "";
            if (getForm("txteattheadCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"eatthead","CountryID","txteattheadCountryID");
            if (getForm("txteattheadBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"eatthead","BranchID","txteattheadBranchID");
    $rst["AdmitDate"] = getFormSQLQuoted($objConn1,"eatthead","AdmitDate","txteattheadAdmitDate");
            if (getForm("txteattheadCustNo") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Cust No:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CustNo"] = getFormSQLQuoted($objConn1,"eatthead","CustNo","txteattheadCustNo");
            if (getForm("txteattheadLevelID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Level ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["LevelID"] = getFormSQLQuoted($objConn1,"eatthead","LevelID","txteattheadLevelID");
            if (getForm("txteattheadTierID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Tier ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TierID"] = getFormSQLQuoted($objConn1,"eatthead","TierID","txteattheadTierID");
    $rst["ModCount"] = getFormSQLQuoted($objConn1,"eatthead","ModCount","txteattheadModCount");
    $rst["StartDate"] = getFormSQLQuoted($objConn1,"eatthead","StartDate","txteattheadStartDate");
    $rst["EndDate"] = getFormSQLQuoted($objConn1,"eatthead","EndDate","txteattheadEndDate");
            if (getForm("txteattheadStatus") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Status:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Temporary;Wait List;Final; <HR>\n";
            endif;
    $rst["Status"] = getFormSQLQuoted($objConn1,"eatthead","Status","txteattheadStatus");
            if (getForm("txteattheadClassStatus") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Class Status:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Closed;Open; <HR>\n";
            endif;
    $rst["ClassStatus"] = getFormSQLQuoted($objConn1,"eatthead","ClassStatus","txteattheadClassStatus");
            if (getForm("txteattheadDay1") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 1:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day1"] = getFormSQLQuoted($objConn1,"eatthead","Day1","txteattheadDay1");
            if (getForm("txteattheadDay2") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 2:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day2"] = getFormSQLQuoted($objConn1,"eatthead","Day2","txteattheadDay2");
            if (getForm("txteattheadDay3") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 3:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day3"] = getFormSQLQuoted($objConn1,"eatthead","Day3","txteattheadDay3");
            if (getForm("txteattheadDay4") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 4:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day4"] = getFormSQLQuoted($objConn1,"eatthead","Day4","txteattheadDay4");
            if (getForm("txteattheadDay5") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 5:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day5"] = getFormSQLQuoted($objConn1,"eatthead","Day5","txteattheadDay5");
            if (getForm("txteattheadDay6") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 6:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day6"] = getFormSQLQuoted($objConn1,"eatthead","Day6","txteattheadDay6");
            if (getForm("txteattheadDay7") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day 7:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <HR>\n";
            endif;
    $rst["Day7"] = getFormSQLQuoted($objConn1,"eatthead","Day7","txteattheadDay7");
    $rst["HrFr1"] = getFormSQLQuoted($objConn1,"eatthead","HrFr1","txteattheadHrFr1");
    $rst["HrFr2"] = getFormSQLQuoted($objConn1,"eatthead","HrFr2","txteattheadHrFr2");
    $rst["HrFr3"] = getFormSQLQuoted($objConn1,"eatthead","HrFr3","txteattheadHrFr3");
    $rst["HrFr4"] = getFormSQLQuoted($objConn1,"eatthead","HrFr4","txteattheadHrFr4");
    $rst["HrFr5"] = getFormSQLQuoted($objConn1,"eatthead","HrFr5","txteattheadHrFr5");
    $rst["HrFr6"] = getFormSQLQuoted($objConn1,"eatthead","HrFr6","txteattheadHrFr6");
    $rst["HrFr7"] = getFormSQLQuoted($objConn1,"eatthead","HrFr7","txteattheadHrFr7");
    $rst["HrTo1"] = getFormSQLQuoted($objConn1,"eatthead","HrTo1","txteattheadHrTo1");
    $rst["HrTo2"] = getFormSQLQuoted($objConn1,"eatthead","HrTo2","txteattheadHrTo2");
    $rst["HrTo3"] = getFormSQLQuoted($objConn1,"eatthead","HrTo3","txteattheadHrTo3");
    $rst["HrTo4"] = getFormSQLQuoted($objConn1,"eatthead","HrTo4","txteattheadHrTo4");
    $rst["HrTo5"] = getFormSQLQuoted($objConn1,"eatthead","HrTo5","txteattheadHrTo5");
    $rst["HrTo6"] = getFormSQLQuoted($objConn1,"eatthead","HrTo6","txteattheadHrTo6");
    $rst["HrTo7"] = getFormSQLQuoted($objConn1,"eatthead","HrTo7","txteattheadHrTo7");
    $rst["Rm1"] = getFormSQLQuoted($objConn1,"eatthead","Rm1","txteattheadRm1");
    $rst["Rm2"] = getFormSQLQuoted($objConn1,"eatthead","Rm2","txteattheadRm2");
    $rst["Rm3"] = getFormSQLQuoted($objConn1,"eatthead","Rm3","txteattheadRm3");
    $rst["Rm4"] = getFormSQLQuoted($objConn1,"eatthead","Rm4","txteattheadRm4");
    $rst["Rm5"] = getFormSQLQuoted($objConn1,"eatthead","Rm5","txteattheadRm5");
    $rst["Rm6"] = getFormSQLQuoted($objConn1,"eatthead","Rm6","txteattheadRm6");
    $rst["Rm7"] = getFormSQLQuoted($objConn1,"eatthead","Rm7","txteattheadRm7");
    $rst["TeaID1"] = getFormSQLQuoted($objConn1,"eatthead","TeaID1","txteattheadTeaID1");
    $rst["TeaID2"] = getFormSQLQuoted($objConn1,"eatthead","TeaID2","txteattheadTeaID2");
    $rst["TeaID3"] = getFormSQLQuoted($objConn1,"eatthead","TeaID3","txteattheadTeaID3");
    $rst["TeaID4"] = getFormSQLQuoted($objConn1,"eatthead","TeaID4","txteattheadTeaID4");
    $rst["TeaID5"] = getFormSQLQuoted($objConn1,"eatthead","TeaID5","txteattheadTeaID5");
    $rst["TeaID6"] = getFormSQLQuoted($objConn1,"eatthead","TeaID6","txteattheadTeaID6");
    $rst["TeaID7"] = getFormSQLQuoted($objConn1,"eatthead","TeaID7","txteattheadTeaID7");
        if (getForm("txteattheadDayNo1") == "on" || getForm("txteattheadDayNo1") == "ON"):
          $rst["DayNo1"] = 1;      
        else:
          $rst["DayNo1"] = 0;
        endif;
        if (getForm("txteattheadDayNo2") == "on" || getForm("txteattheadDayNo2") == "ON"):
          $rst["DayNo2"] = 1;      
        else:
          $rst["DayNo2"] = 0;
        endif;
        if (getForm("txteattheadDayNo3") == "on" || getForm("txteattheadDayNo3") == "ON"):
          $rst["DayNo3"] = 1;      
        else:
          $rst["DayNo3"] = 0;
        endif;
        if (getForm("txteattheadDayNo4") == "on" || getForm("txteattheadDayNo4") == "ON"):
          $rst["DayNo4"] = 1;      
        else:
          $rst["DayNo4"] = 0;
        endif;
        if (getForm("txteattheadDayNo5") == "on" || getForm("txteattheadDayNo5") == "ON"):
          $rst["DayNo5"] = 1;      
        else:
          $rst["DayNo5"] = 0;
        endif;
        if (getForm("txteattheadDayNo6") == "on" || getForm("txteattheadDayNo6") == "ON"):
          $rst["DayNo6"] = 1;      
        else:
          $rst["DayNo6"] = 0;
        endif;
        if (getForm("txteattheadDayNo7") == "on" || getForm("txteattheadDayNo7") == "ON"):
          $rst["DayNo7"] = 1;      
        else:
          $rst["DayNo7"] = 0;
        endif;
            if (getForm("txteattheadSessionPrDay1") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay1"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay1","txteattheadSessionPrDay1");
            if (getForm("txteattheadSessionPrDay2") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay2"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay2","txteattheadSessionPrDay2");
            if (getForm("txteattheadSessionPrDay3") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay3"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay3","txteattheadSessionPrDay3");
            if (getForm("txteattheadSessionPrDay4") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay4"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay4","txteattheadSessionPrDay4");
            if (getForm("txteattheadSessionPrDay5") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay5"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay5","txteattheadSessionPrDay5");
            if (getForm("txteattheadSessionPrDay6") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay6"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay6","txteattheadSessionPrDay6");
            if (getForm("txteattheadSessionPrDay7") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
            endif;
    $rst["SessionPrDay7"] = getFormSQLQuoted($objConn1,"eatthead","SessionPrDay7","txteattheadSessionPrDay7");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into eatthead (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRSeatthead = $objConn1->Execute($sql);

  if (!isset($oRSeatthead) || $oRSeatthead == false || $oRSeatthead == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
  endif;
  if(getSession("BrowseAssessment#WHR")<>""):
      $myStatus .= "<a href='BrowseAssessmentlist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
  else:
      if($_SESSION["ChildReturnTo"] <> ""):
        $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
      else:
        $myStatus .= "<a href='BrowseAssessmentlist.php'>Return to list</a>.";
      endif;
  endif;
endif;


function MergeAddTemplate($Template) {
    if (!isset($Template) || ($Template == "")) {
        $Template = "./html/blank.htm";
    }       
    global $ClarionData;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    $TemplateText = Replace($TemplateText,"<!--@HTML_AFTER_OPEN@-->",loadInclude(""));          
    $TemplateText = Replace($TemplateText,"<!--@HTML_AFTER_OPEN@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@HEAD_AFTER_OPEN@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@HEAD_BEFORE_CLOSE@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@BODY_AFTER_OPEN@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@BG_BEFORE_OPEN@-->",loadInclude(""));        
    $TemplateText = Replace($TemplateText,"<!--@BG_AFTER_OPEN@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@BG_BEFORE_CLOSE@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@BG_AFTER_CLOSE@-->",loadInclude(""));        
    $TemplateText = Replace($TemplateText,"<!--@BODY_BEFORE_CLOSE@-->",loadInclude(""));      
    $TemplateText = Replace($TemplateText,"<!--@HTML_BEFORE_CLOSE@-->",loadInclude(""));          

    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;      
    print($TemplateText);
}

if($flgMissing == true) {
  $_SESSION["Updateeatthead_InsertFailed"] = 1;
  $_SESSION["SavedeattheadCountryID"] = $_POST["txteattheadCountryID"];
  $_SESSION["SavedeattheadBranchID"] = $_POST["txteattheadBranchID"];
  $_SESSION["SavedeattheadAdmitDate"] = $_POST["txteattheadAdmitDate"];
  $_SESSION["SavedeattheadCustNo"] = $_POST["txteattheadCustNo"];
  $_SESSION["SavedeattheadLevelID"] = $_POST["txteattheadLevelID"];
  $_SESSION["SavedeattheadTierID"] = $_POST["txteattheadTierID"];
  $_SESSION["SavedeattheadModCount"] = $_POST["txteattheadModCount"];
  $_SESSION["SavedeattheadStartDate"] = $_POST["txteattheadStartDate"];
  $_SESSION["SavedeattheadEndDate"] = $_POST["txteattheadEndDate"];
  $_SESSION["SavedeattheadStatus"] = $_POST["txteattheadStatus"];
  $_SESSION["SavedeattheadClassStatus"] = $_POST["txteattheadClassStatus"];
  $_SESSION["SavedeattheadDay1"] = $_POST["txteattheadDay1"];
  $_SESSION["SavedeattheadDay2"] = $_POST["txteattheadDay2"];
  $_SESSION["SavedeattheadDay3"] = $_POST["txteattheadDay3"];
  $_SESSION["SavedeattheadDay4"] = $_POST["txteattheadDay4"];
  $_SESSION["SavedeattheadDay5"] = $_POST["txteattheadDay5"];
  $_SESSION["SavedeattheadDay6"] = $_POST["txteattheadDay6"];
  $_SESSION["SavedeattheadDay7"] = $_POST["txteattheadDay7"];
  $_SESSION["SavedeattheadHrFr1"] = $_POST["txteattheadHrFr1"];
  $_SESSION["SavedeattheadHrFr2"] = $_POST["txteattheadHrFr2"];
  $_SESSION["SavedeattheadHrFr3"] = $_POST["txteattheadHrFr3"];
  $_SESSION["SavedeattheadHrFr4"] = $_POST["txteattheadHrFr4"];
  $_SESSION["SavedeattheadHrFr5"] = $_POST["txteattheadHrFr5"];
  $_SESSION["SavedeattheadHrFr6"] = $_POST["txteattheadHrFr6"];
  $_SESSION["SavedeattheadHrFr7"] = $_POST["txteattheadHrFr7"];
  $_SESSION["SavedeattheadHrTo1"] = $_POST["txteattheadHrTo1"];
  $_SESSION["SavedeattheadHrTo2"] = $_POST["txteattheadHrTo2"];
  $_SESSION["SavedeattheadHrTo3"] = $_POST["txteattheadHrTo3"];
  $_SESSION["SavedeattheadHrTo4"] = $_POST["txteattheadHrTo4"];
  $_SESSION["SavedeattheadHrTo5"] = $_POST["txteattheadHrTo5"];
  $_SESSION["SavedeattheadHrTo6"] = $_POST["txteattheadHrTo6"];
  $_SESSION["SavedeattheadHrTo7"] = $_POST["txteattheadHrTo7"];
  $_SESSION["SavedeattheadRm1"] = $_POST["txteattheadRm1"];
  $_SESSION["SavedeattheadRm2"] = $_POST["txteattheadRm2"];
  $_SESSION["SavedeattheadRm3"] = $_POST["txteattheadRm3"];
  $_SESSION["SavedeattheadRm4"] = $_POST["txteattheadRm4"];
  $_SESSION["SavedeattheadRm5"] = $_POST["txteattheadRm5"];
  $_SESSION["SavedeattheadRm6"] = $_POST["txteattheadRm6"];
  $_SESSION["SavedeattheadRm7"] = $_POST["txteattheadRm7"];
  $_SESSION["SavedeattheadTeaID1"] = $_POST["txteattheadTeaID1"];
  $_SESSION["SavedeattheadTeaID2"] = $_POST["txteattheadTeaID2"];
  $_SESSION["SavedeattheadTeaID3"] = $_POST["txteattheadTeaID3"];
  $_SESSION["SavedeattheadTeaID4"] = $_POST["txteattheadTeaID4"];
  $_SESSION["SavedeattheadTeaID5"] = $_POST["txteattheadTeaID5"];
  $_SESSION["SavedeattheadTeaID6"] = $_POST["txteattheadTeaID6"];
  $_SESSION["SavedeattheadTeaID7"] = $_POST["txteattheadTeaID7"];
  $_SESSION["SavedeattheadDayNo1"] = strtoupper($_POST["txteattheadDayNo1"]);
  $_SESSION["SavedeattheadDayNo2"] = strtoupper($_POST["txteattheadDayNo2"]);
  $_SESSION["SavedeattheadDayNo3"] = strtoupper($_POST["txteattheadDayNo3"]);
  $_SESSION["SavedeattheadDayNo4"] = strtoupper($_POST["txteattheadDayNo4"]);
  $_SESSION["SavedeattheadDayNo5"] = strtoupper($_POST["txteattheadDayNo5"]);
  $_SESSION["SavedeattheadDayNo6"] = strtoupper($_POST["txteattheadDayNo6"]);
  $_SESSION["SavedeattheadDayNo7"] = strtoupper($_POST["txteattheadDayNo7"]);
  $_SESSION["SavedeattheadSessionPrDay1"] = $_POST["txteattheadSessionPrDay1"];
  $_SESSION["SavedeattheadSessionPrDay2"] = $_POST["txteattheadSessionPrDay2"];
  $_SESSION["SavedeattheadSessionPrDay3"] = $_POST["txteattheadSessionPrDay3"];
  $_SESSION["SavedeattheadSessionPrDay4"] = $_POST["txteattheadSessionPrDay4"];
  $_SESSION["SavedeattheadSessionPrDay5"] = $_POST["txteattheadSessionPrDay5"];
  $_SESSION["SavedeattheadSessionPrDay6"] = $_POST["txteattheadSessionPrDay6"];
  $_SESSION["SavedeattheadSessionPrDay7"] = $_POST["txteattheadSessionPrDay7"];
}
else {
  $_SESSION["Updateeatthead_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";


echo json_encode(array('statusme' =>$myStatus));

// MergeAddTemplate($HTML_Template);
unset($oRSeatthead) ;
$objConn1->Close();
unset($objConn1);
?> 
