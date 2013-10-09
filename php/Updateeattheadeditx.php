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
session_start();
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
// #include_once(dbcnfile);
include_once('utils.php');
include('login.php');
$HTML_Template = getRequest("HTMLT");
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
function MergeEditTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/blank.htm";
    endif;
    global $ClarionData;
    global $objConn1;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
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
    $objConn1->Close();
    exit();
}

$pFound = "";
$pFound .= trim(getRequest("ID1"));
$pFound .= trim(getRequest("ID2"));
$pFound .= trim(getRequest("ID3"));
$pFound .= trim(getRequest("ID4"));
if($pFound == ""):
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "<tr><td colspan='2' class='Input'>The requested record could not be found<br>\n";
$ClarionData .= "</td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";
MergeEditTemplate($HTML_Template);
endif;
$ID1 = trim(getRequest("ID1"), "'");
$ID2 = trim(getRequest("ID2"), "'");
$ID3 = trim(getRequest("ID3"), "'");
$ID4 = trim(getRequest("ID4"), "'");
$sql = "SELECT eatthead.CountryID, eatthead.BranchID, eatthead.AdmitDate, eatthead.CustNo, eatthead.LevelID, eatthead.TierID, eatthead.ModCount, eatthead.StartDate, eatthead.EndDate, eatthead.Status, eatthead.ClassStatus, eatthead.Day1, eatthead.Day2, eatthead.Day3, eatthead.Day4, eatthead.Day5, eatthead.Day6, eatthead.Day7, eatthead.HrFr1, eatthead.HrFr2, eatthead.HrFr3, eatthead.HrFr4, eatthead.HrFr5, eatthead.HrFr6, eatthead.HrFr7, eatthead.HrTo1, eatthead.HrTo2, eatthead.HrTo3, eatthead.HrTo4, eatthead.HrTo5, eatthead.HrTo6, eatthead.HrTo7, eatthead.Rm1, eatthead.Rm2, eatthead.Rm3, eatthead.Rm4, eatthead.Rm5, eatthead.Rm6, eatthead.Rm7, eatthead.TeaID1, eatthead.TeaID2, eatthead.TeaID3, eatthead.TeaID4, eatthead.TeaID5, eatthead.TeaID6, eatthead.TeaID7, eatthead.DayNo1, eatthead.DayNo2, eatthead.DayNo3, eatthead.DayNo4, eatthead.DayNo5, eatthead.DayNo6, eatthead.DayNo7, eatthead.SessionPrDay1, eatthead.SessionPrDay2, eatthead.SessionPrDay3, eatthead.SessionPrDay4, eatthead.SessionPrDay5, eatthead.SessionPrDay6, eatthead.SessionPrDay7  FROM  eatthead WHERE  eatthead.CountryID = '" . $ID1 . "'" . " AND eatthead.BranchID = '" . $ID2 . "'" . " AND eatthead.CustNo = " . $ID3 . " AND eatthead.TierID = " . $ID4;
$oRSeatthead = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRSeatthead = array();
if (!$oRSeatthead):
    $oRSeatthead->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txteattheadCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeatthead["CountryID"] = getFormSQLQuoted($objConn1, "eatthead", "CountryID", "txteattheadCountryID");
        if (getRequest("txteattheadBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeatthead["BranchID"] = getFormSQLQuoted($objConn1, "eatthead", "BranchID", "txteattheadBranchID");
$arrayoRSeatthead["AdmitDate"] = getFormSQLQuoted($objConn1, "eatthead", "AdmitDate", "txteattheadAdmitDate");
        if (getRequest("txteattheadCustNo") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Cust No:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeatthead["CustNo"] = getFormSQLQuoted($objConn1, "eatthead", "CustNo", "txteattheadCustNo");
        if (getRequest("txteattheadLevelID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Level ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeatthead["LevelID"] = getFormSQLQuoted($objConn1, "eatthead", "LevelID", "txteattheadLevelID");
        if (getRequest("txteattheadTierID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Tier ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeatthead["TierID"] = getFormSQLQuoted($objConn1, "eatthead", "TierID", "txteattheadTierID");
$arrayoRSeatthead["ModCount"] = getFormSQLQuoted($objConn1, "eatthead", "ModCount", "txteattheadModCount");
$arrayoRSeatthead["StartDate"] = getFormSQLQuoted($objConn1, "eatthead", "StartDate", "txteattheadStartDate");
$arrayoRSeatthead["EndDate"] = getFormSQLQuoted($objConn1, "eatthead", "EndDate", "txteattheadEndDate");
        if (getRequest("txteattheadStatus") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Status:</strong> : Must be in list ";
                    $myStatus .= "Temporary;Wait List;Final; <hr>\n";
        endif;
$arrayoRSeatthead["Status"] = getFormSQLQuoted($objConn1, "eatthead", "Status", "txteattheadStatus");
        if (getRequest("txteattheadClassStatus") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Class Status:</strong> : Must be in list ";
                    $myStatus .= "Closed;Open; <hr>\n";
        endif;
$arrayoRSeatthead["ClassStatus"] = getFormSQLQuoted($objConn1, "eatthead", "ClassStatus", "txteattheadClassStatus");
        if (getRequest("txteattheadDay1") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 1:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day1"] = getFormSQLQuoted($objConn1, "eatthead", "Day1", "txteattheadDay1");
        if (getRequest("txteattheadDay2") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 2:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day2"] = getFormSQLQuoted($objConn1, "eatthead", "Day2", "txteattheadDay2");
        if (getRequest("txteattheadDay3") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 3:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day3"] = getFormSQLQuoted($objConn1, "eatthead", "Day3", "txteattheadDay3");
        if (getRequest("txteattheadDay4") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 4:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day4"] = getFormSQLQuoted($objConn1, "eatthead", "Day4", "txteattheadDay4");
        if (getRequest("txteattheadDay5") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 5:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day5"] = getFormSQLQuoted($objConn1, "eatthead", "Day5", "txteattheadDay5");
        if (getRequest("txteattheadDay6") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 6:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day6"] = getFormSQLQuoted($objConn1, "eatthead", "Day6", "txteattheadDay6");
        if (getRequest("txteattheadDay7") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day 7:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday; <hr>\n";
        endif;
$arrayoRSeatthead["Day7"] = getFormSQLQuoted($objConn1, "eatthead", "Day7", "txteattheadDay7");
$arrayoRSeatthead["HrFr1"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr1", "txteattheadHrFr1");
$arrayoRSeatthead["HrFr2"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr2", "txteattheadHrFr2");
$arrayoRSeatthead["HrFr3"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr3", "txteattheadHrFr3");
$arrayoRSeatthead["HrFr4"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr4", "txteattheadHrFr4");
$arrayoRSeatthead["HrFr5"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr5", "txteattheadHrFr5");
$arrayoRSeatthead["HrFr6"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr6", "txteattheadHrFr6");
$arrayoRSeatthead["HrFr7"] = getFormSQLQuoted($objConn1, "eatthead", "HrFr7", "txteattheadHrFr7");
$arrayoRSeatthead["HrTo1"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo1", "txteattheadHrTo1");
$arrayoRSeatthead["HrTo2"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo2", "txteattheadHrTo2");
$arrayoRSeatthead["HrTo3"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo3", "txteattheadHrTo3");
$arrayoRSeatthead["HrTo4"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo4", "txteattheadHrTo4");
$arrayoRSeatthead["HrTo5"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo5", "txteattheadHrTo5");
$arrayoRSeatthead["HrTo6"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo6", "txteattheadHrTo6");
$arrayoRSeatthead["HrTo7"] = getFormSQLQuoted($objConn1, "eatthead", "HrTo7", "txteattheadHrTo7");
$arrayoRSeatthead["Rm1"] = getFormSQLQuoted($objConn1, "eatthead", "Rm1", "txteattheadRm1");
$arrayoRSeatthead["Rm2"] = getFormSQLQuoted($objConn1, "eatthead", "Rm2", "txteattheadRm2");
$arrayoRSeatthead["Rm3"] = getFormSQLQuoted($objConn1, "eatthead", "Rm3", "txteattheadRm3");
$arrayoRSeatthead["Rm4"] = getFormSQLQuoted($objConn1, "eatthead", "Rm4", "txteattheadRm4");
$arrayoRSeatthead["Rm5"] = getFormSQLQuoted($objConn1, "eatthead", "Rm5", "txteattheadRm5");
$arrayoRSeatthead["Rm6"] = getFormSQLQuoted($objConn1, "eatthead", "Rm6", "txteattheadRm6");
$arrayoRSeatthead["Rm7"] = getFormSQLQuoted($objConn1, "eatthead", "Rm7", "txteattheadRm7");
$arrayoRSeatthead["TeaID1"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID1", "txteattheadTeaID1");
$arrayoRSeatthead["TeaID2"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID2", "txteattheadTeaID2");
$arrayoRSeatthead["TeaID3"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID3", "txteattheadTeaID3");
$arrayoRSeatthead["TeaID4"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID4", "txteattheadTeaID4");
$arrayoRSeatthead["TeaID5"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID5", "txteattheadTeaID5");
$arrayoRSeatthead["TeaID6"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID6", "txteattheadTeaID6");
$arrayoRSeatthead["TeaID7"] = getFormSQLQuoted($objConn1, "eatthead", "TeaID7", "txteattheadTeaID7");
if (getForm("txteattheadDayNo1") == "on" || getForm("txteattheadDayNo1") == "ON"):
  $arrayoRSeatthead["DayNo1"] = 1;   
else:
  $arrayoRSeatthead["DayNo1"] = 0;
endif;
if (getForm("txteattheadDayNo2") == "on" || getForm("txteattheadDayNo2") == "ON"):
  $arrayoRSeatthead["DayNo2"] = 1;   
else:
  $arrayoRSeatthead["DayNo2"] = 0;
endif;
if (getForm("txteattheadDayNo3") == "on" || getForm("txteattheadDayNo3") == "ON"):
  $arrayoRSeatthead["DayNo3"] = 1;   
else:
  $arrayoRSeatthead["DayNo3"] = 0;
endif;
if (getForm("txteattheadDayNo4") == "on" || getForm("txteattheadDayNo4") == "ON"):
  $arrayoRSeatthead["DayNo4"] = 1;   
else:
  $arrayoRSeatthead["DayNo4"] = 0;
endif;
if (getForm("txteattheadDayNo5") == "on" || getForm("txteattheadDayNo5") == "ON"):
  $arrayoRSeatthead["DayNo5"] = 1;   
else:
  $arrayoRSeatthead["DayNo5"] = 0;
endif;
if (getForm("txteattheadDayNo6") == "on" || getForm("txteattheadDayNo6") == "ON"):
  $arrayoRSeatthead["DayNo6"] = 1;   
else:
  $arrayoRSeatthead["DayNo6"] = 0;
endif;
if (getForm("txteattheadDayNo7") == "on" || getForm("txteattheadDayNo7") == "ON"):
  $arrayoRSeatthead["DayNo7"] = 1;   
else:
  $arrayoRSeatthead["DayNo7"] = 0;
endif;
        if (getRequest("txteattheadSessionPrDay1") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay1"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay1", "txteattheadSessionPrDay1");
        if (getRequest("txteattheadSessionPrDay2") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay2"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay2", "txteattheadSessionPrDay2");
        if (getRequest("txteattheadSessionPrDay3") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay3"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay3", "txteattheadSessionPrDay3");
        if (getRequest("txteattheadSessionPrDay4") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay4"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay4", "txteattheadSessionPrDay4");
        if (getRequest("txteattheadSessionPrDay5") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay5"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay5", "txteattheadSessionPrDay5");
        if (getRequest("txteattheadSessionPrDay6") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay6"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay6", "txteattheadSessionPrDay6");
        if (getRequest("txteattheadSessionPrDay7") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
        endif;
$arrayoRSeatthead["SessionPrDay7"] = getFormSQLQuoted($objConn1, "eatthead", "SessionPrDay7", "txteattheadSessionPrDay7");
$tsql = $objConn1->GetUpdateSQL($oRSeatthead, $arrayoRSeatthead, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "eatthead" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRSeatthead as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "eatthead" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRSeatthead->Close();
unset($oRSeatthead);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
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
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

if($flgMissing == true) {
  $_SESSION["Updateeatthead_EditFailed"] = 1;
  $_SESSION["SavedEditeattheadCountryID"] = $_POST["txteattheadCountryID"];
  $_SESSION["SavedEditeattheadBranchID"] = $_POST["txteattheadBranchID"];
  $_SESSION["SavedEditeattheadAdmitDate"] = $_POST["txteattheadAdmitDate"];
  $_SESSION["SavedEditeattheadCustNo"] = $_POST["txteattheadCustNo"];
  $_SESSION["SavedEditeattheadLevelID"] = $_POST["txteattheadLevelID"];
  $_SESSION["SavedEditeattheadTierID"] = $_POST["txteattheadTierID"];
  $_SESSION["SavedEditeattheadModCount"] = $_POST["txteattheadModCount"];
  $_SESSION["SavedEditeattheadStartDate"] = $_POST["txteattheadStartDate"];
  $_SESSION["SavedEditeattheadEndDate"] = $_POST["txteattheadEndDate"];
  $_SESSION["SavedEditeattheadStatus"] = $_POST["txteattheadStatus"];
  $_SESSION["SavedEditeattheadClassStatus"] = $_POST["txteattheadClassStatus"];
  $_SESSION["SavedEditeattheadDay1"] = $_POST["txteattheadDay1"];
  $_SESSION["SavedEditeattheadDay2"] = $_POST["txteattheadDay2"];
  $_SESSION["SavedEditeattheadDay3"] = $_POST["txteattheadDay3"];
  $_SESSION["SavedEditeattheadDay4"] = $_POST["txteattheadDay4"];
  $_SESSION["SavedEditeattheadDay5"] = $_POST["txteattheadDay5"];
  $_SESSION["SavedEditeattheadDay6"] = $_POST["txteattheadDay6"];
  $_SESSION["SavedEditeattheadDay7"] = $_POST["txteattheadDay7"];
  $_SESSION["SavedEditeattheadHrFr1"] = $_POST["txteattheadHrFr1"];
  $_SESSION["SavedEditeattheadHrFr2"] = $_POST["txteattheadHrFr2"];
  $_SESSION["SavedEditeattheadHrFr3"] = $_POST["txteattheadHrFr3"];
  $_SESSION["SavedEditeattheadHrFr4"] = $_POST["txteattheadHrFr4"];
  $_SESSION["SavedEditeattheadHrFr5"] = $_POST["txteattheadHrFr5"];
  $_SESSION["SavedEditeattheadHrFr6"] = $_POST["txteattheadHrFr6"];
  $_SESSION["SavedEditeattheadHrFr7"] = $_POST["txteattheadHrFr7"];
  $_SESSION["SavedEditeattheadHrTo1"] = $_POST["txteattheadHrTo1"];
  $_SESSION["SavedEditeattheadHrTo2"] = $_POST["txteattheadHrTo2"];
  $_SESSION["SavedEditeattheadHrTo3"] = $_POST["txteattheadHrTo3"];
  $_SESSION["SavedEditeattheadHrTo4"] = $_POST["txteattheadHrTo4"];
  $_SESSION["SavedEditeattheadHrTo5"] = $_POST["txteattheadHrTo5"];
  $_SESSION["SavedEditeattheadHrTo6"] = $_POST["txteattheadHrTo6"];
  $_SESSION["SavedEditeattheadHrTo7"] = $_POST["txteattheadHrTo7"];
  $_SESSION["SavedEditeattheadRm1"] = $_POST["txteattheadRm1"];
  $_SESSION["SavedEditeattheadRm2"] = $_POST["txteattheadRm2"];
  $_SESSION["SavedEditeattheadRm3"] = $_POST["txteattheadRm3"];
  $_SESSION["SavedEditeattheadRm4"] = $_POST["txteattheadRm4"];
  $_SESSION["SavedEditeattheadRm5"] = $_POST["txteattheadRm5"];
  $_SESSION["SavedEditeattheadRm6"] = $_POST["txteattheadRm6"];
  $_SESSION["SavedEditeattheadRm7"] = $_POST["txteattheadRm7"];
  $_SESSION["SavedEditeattheadTeaID1"] = $_POST["txteattheadTeaID1"];
  $_SESSION["SavedEditeattheadTeaID2"] = $_POST["txteattheadTeaID2"];
  $_SESSION["SavedEditeattheadTeaID3"] = $_POST["txteattheadTeaID3"];
  $_SESSION["SavedEditeattheadTeaID4"] = $_POST["txteattheadTeaID4"];
  $_SESSION["SavedEditeattheadTeaID5"] = $_POST["txteattheadTeaID5"];
  $_SESSION["SavedEditeattheadTeaID6"] = $_POST["txteattheadTeaID6"];
  $_SESSION["SavedEditeattheadTeaID7"] = $_POST["txteattheadTeaID7"];
  $_SESSION["SavedEditeattheadDayNo1"] = strtoupper($_POST["txteattheadDayNo1"]);
  $_SESSION["SavedEditeattheadDayNo2"] = strtoupper($_POST["txteattheadDayNo2"]);
  $_SESSION["SavedEditeattheadDayNo3"] = strtoupper($_POST["txteattheadDayNo3"]);
  $_SESSION["SavedEditeattheadDayNo4"] = strtoupper($_POST["txteattheadDayNo4"]);
  $_SESSION["SavedEditeattheadDayNo5"] = strtoupper($_POST["txteattheadDayNo5"]);
  $_SESSION["SavedEditeattheadDayNo6"] = strtoupper($_POST["txteattheadDayNo6"]);
  $_SESSION["SavedEditeattheadDayNo7"] = strtoupper($_POST["txteattheadDayNo7"]);
  $_SESSION["SavedEditeattheadSessionPrDay1"] = $_POST["txteattheadSessionPrDay1"];
  $_SESSION["SavedEditeattheadSessionPrDay2"] = $_POST["txteattheadSessionPrDay2"];
  $_SESSION["SavedEditeattheadSessionPrDay3"] = $_POST["txteattheadSessionPrDay3"];
  $_SESSION["SavedEditeattheadSessionPrDay4"] = $_POST["txteattheadSessionPrDay4"];
  $_SESSION["SavedEditeattheadSessionPrDay5"] = $_POST["txteattheadSessionPrDay5"];
  $_SESSION["SavedEditeattheadSessionPrDay6"] = $_POST["txteattheadSessionPrDay6"];
  $_SESSION["SavedEditeattheadSessionPrDay7"] = $_POST["txteattheadSessionPrDay7"];
}
else {
  $_SESSION["Updateeatthead_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
