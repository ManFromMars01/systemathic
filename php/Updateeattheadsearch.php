<?PHP
ob_start();
session_start();
$PageLevel = 0;
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
$HTML_Template = getRequest("HTMLT");
if (getRequest("SEARCH") == "TRUE"):
    $_SESSION["BrowseAssessment#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txteattheadCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.CountryID LIKE " . chr(39) . getRequest("txteattheadCountryID") . "%" . chr(39);
endif;

if (getRequest("txteattheadBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.BranchID LIKE " . chr(39) . getRequest("txteattheadBranchID") . "%" . chr(39);
endif;

if (getRequest("txteattheadAdmitDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.AdmitDate = " . chr(39) . getRequest("txteattheadAdmitDate") . chr(39);
endif;

if (getRequest("txteattheadCustNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.CustNo = " . getRequest("txteattheadCustNo");
endif;

if (getRequest("txteattheadLevelID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.LevelID = " . getRequest("txteattheadLevelID");
endif;

if (getRequest("txteattheadTierID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TierID = " . getRequest("txteattheadTierID");
endif;

if (getRequest("txteattheadModCount") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.ModCount = " . getRequest("txteattheadModCount");
endif;

if (getRequest("txteattheadStartDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.StartDate = " . chr(39) . getRequest("txteattheadStartDate") . chr(39);
endif;

if (getRequest("txteattheadEndDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.EndDate = " . chr(39) . getRequest("txteattheadEndDate") . chr(39);
endif;

if (getRequest("txteattheadStatus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Status LIKE " . chr(39) . getRequest("txteattheadStatus") . "%" . chr(39);
endif;

if (getRequest("txteattheadClassStatus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.ClassStatus LIKE " . chr(39) . getRequest("txteattheadClassStatus") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day1 LIKE " . chr(39) . getRequest("txteattheadDay1") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day2 LIKE " . chr(39) . getRequest("txteattheadDay2") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day3 LIKE " . chr(39) . getRequest("txteattheadDay3") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day4 LIKE " . chr(39) . getRequest("txteattheadDay4") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day5 LIKE " . chr(39) . getRequest("txteattheadDay5") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day6 LIKE " . chr(39) . getRequest("txteattheadDay6") . "%" . chr(39);
endif;

if (getRequest("txteattheadDay7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Day7 LIKE " . chr(39) . getRequest("txteattheadDay7") . "%" . chr(39);
endif;

if (getRequest("txteattheadHrFr1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr1 = " . getRequest("txteattheadHrFr1");
endif;

if (getRequest("txteattheadHrFr2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr2 = " . getRequest("txteattheadHrFr2");
endif;

if (getRequest("txteattheadHrFr3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr3 = " . getRequest("txteattheadHrFr3");
endif;

if (getRequest("txteattheadHrFr4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr4 = " . getRequest("txteattheadHrFr4");
endif;

if (getRequest("txteattheadHrFr5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr5 = " . getRequest("txteattheadHrFr5");
endif;

if (getRequest("txteattheadHrFr6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr6 = " . getRequest("txteattheadHrFr6");
endif;

if (getRequest("txteattheadHrFr7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrFr7 = " . getRequest("txteattheadHrFr7");
endif;

if (getRequest("txteattheadHrTo1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo1 = " . getRequest("txteattheadHrTo1");
endif;

if (getRequest("txteattheadHrTo2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo2 = " . getRequest("txteattheadHrTo2");
endif;

if (getRequest("txteattheadHrTo3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo3 = " . getRequest("txteattheadHrTo3");
endif;

if (getRequest("txteattheadHrTo4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo4 = " . getRequest("txteattheadHrTo4");
endif;

if (getRequest("txteattheadHrTo5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo5 = " . getRequest("txteattheadHrTo5");
endif;

if (getRequest("txteattheadHrTo6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo6 = " . getRequest("txteattheadHrTo6");
endif;

if (getRequest("txteattheadHrTo7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.HrTo7 = " . getRequest("txteattheadHrTo7");
endif;

if (getRequest("txteattheadRm1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm1 = " . getRequest("txteattheadRm1");
endif;

if (getRequest("txteattheadRm2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm2 = " . getRequest("txteattheadRm2");
endif;

if (getRequest("txteattheadRm3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm3 = " . getRequest("txteattheadRm3");
endif;

if (getRequest("txteattheadRm4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm4 = " . getRequest("txteattheadRm4");
endif;

if (getRequest("txteattheadRm5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm5 = " . getRequest("txteattheadRm5");
endif;

if (getRequest("txteattheadRm6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm6 = " . getRequest("txteattheadRm6");
endif;

if (getRequest("txteattheadRm7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.Rm7 = " . getRequest("txteattheadRm7");
endif;

if (getRequest("txteattheadTeaID1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID1 = " . getRequest("txteattheadTeaID1");
endif;

if (getRequest("txteattheadTeaID2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID2 = " . getRequest("txteattheadTeaID2");
endif;

if (getRequest("txteattheadTeaID3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID3 = " . getRequest("txteattheadTeaID3");
endif;

if (getRequest("txteattheadTeaID4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID4 = " . getRequest("txteattheadTeaID4");
endif;

if (getRequest("txteattheadTeaID5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID5 = " . getRequest("txteattheadTeaID5");
endif;

if (getRequest("txteattheadTeaID6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID6 = " . getRequest("txteattheadTeaID6");
endif;

if (getRequest("txteattheadTeaID7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.TeaID7 = " . getRequest("txteattheadTeaID7");
endif;

if (getRequest("txteattheadDayNo1") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo1 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo1 = 1";
endif;

if (getRequest("txteattheadDayNo2") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo2 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo2 = 1";
endif;

if (getRequest("txteattheadDayNo3") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo3 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo3 = 1";
endif;

if (getRequest("txteattheadDayNo4") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo4 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo4 = 1";
endif;

if (getRequest("txteattheadDayNo5") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo5 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo5 = 1";
endif;

if (getRequest("txteattheadDayNo6") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo6 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo6 = 1";
endif;

if (getRequest("txteattheadDayNo7") == ""):
    if ($myWhere == ""):
    else:
        $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.DayNo7 = 0";
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eatthead.DayNo7 = 1";
endif;

if (getRequest("txteattheadSessionPrDay1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay1 = " . getRequest("txteattheadSessionPrDay1");
endif;

if (getRequest("txteattheadSessionPrDay2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay2 = " . getRequest("txteattheadSessionPrDay2");
endif;

if (getRequest("txteattheadSessionPrDay3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay3 = " . getRequest("txteattheadSessionPrDay3");
endif;

if (getRequest("txteattheadSessionPrDay4") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay4 = " . getRequest("txteattheadSessionPrDay4");
endif;

if (getRequest("txteattheadSessionPrDay5") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay5 = " . getRequest("txteattheadSessionPrDay5");
endif;

if (getRequest("txteattheadSessionPrDay6") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay6 = " . getRequest("txteattheadSessionPrDay6");
endif;

if (getRequest("txteattheadSessionPrDay7") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eatthead.SessionPrDay7 = " . getRequest("txteattheadSessionPrDay7");
endif;
$_SESSION["BrowseAssessment#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseAssessmentlist.php");
endif;
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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRSeatthead = "";


$TemplateText = "";

$eattheadCountryID = "";
$eattheadBranchID = "";
$eattheadAdmitDate = "";
$eattheadCustNo = "";
$eattheadLevelID = "";
$eattheadTierID = "";
$eattheadModCount = "";
$eattheadStartDate = "";
$eattheadEndDate = "";
$eattheadStatus = "";
$eattheadClassStatus = "";
$eattheadDay1 = "";
$eattheadDay2 = "";
$eattheadDay3 = "";
$eattheadDay4 = "";
$eattheadDay5 = "";
$eattheadDay6 = "";
$eattheadDay7 = "";
$eattheadHrFr1 = "";
$eattheadHrFr2 = "";
$eattheadHrFr3 = "";
$eattheadHrFr4 = "";
$eattheadHrFr5 = "";
$eattheadHrFr6 = "";
$eattheadHrFr7 = "";
$eattheadHrTo1 = "";
$eattheadHrTo2 = "";
$eattheadHrTo3 = "";
$eattheadHrTo4 = "";
$eattheadHrTo5 = "";
$eattheadHrTo6 = "";
$eattheadHrTo7 = "";
$eattheadRm1 = "";
$eattheadRm2 = "";
$eattheadRm3 = "";
$eattheadRm4 = "";
$eattheadRm5 = "";
$eattheadRm6 = "";
$eattheadRm7 = "";
$eattheadTeaID1 = "";
$eattheadTeaID2 = "";
$eattheadTeaID3 = "";
$eattheadTeaID4 = "";
$eattheadTeaID5 = "";
$eattheadTeaID6 = "";
$eattheadTeaID7 = "";
$eattheadDayNo1 = "";
$eattheadDayNo2 = "";
$eattheadDayNo3 = "";
$eattheadDayNo4 = "";
$eattheadDayNo5 = "";
$eattheadDayNo6 = "";
$eattheadDayNo7 = "";
$eattheadSessionPrDay1 = "";
$eattheadSessionPrDay2 = "";
$eattheadSessionPrDay3 = "";
$eattheadSessionPrDay4 = "";
$eattheadSessionPrDay5 = "";
$eattheadSessionPrDay6 = "";
$eattheadSessionPrDay7 = "";

/*
============================================================================
 MergeTemplate 
============================================================================
*/
function MergeSearchTemplate($Template) {
    global $TemplateText;
    global $FormDeclaration;    
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeatthead" . "search.htm";
    endif;
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

    $TemplateText = Replace($TemplateText,"@FormDeclaration@",$FormDeclaration);
    global $eattheadCountryID;
    $TemplateText = Replace($TemplateText, "@eattheadCountryID@", $eattheadCountryID);
    global $eattheadBranchID;
    $TemplateText = Replace($TemplateText, "@eattheadBranchID@", $eattheadBranchID);
    global $eattheadAdmitDate;
    $TemplateText = Replace($TemplateText, "@eattheadAdmitDate@", $eattheadAdmitDate);
    global $eattheadCustNo;
    $TemplateText = Replace($TemplateText, "@eattheadCustNo@", $eattheadCustNo);
    global $eattheadLevelID;
    $TemplateText = Replace($TemplateText, "@eattheadLevelID@", $eattheadLevelID);
    global $eattheadTierID;
    $TemplateText = Replace($TemplateText, "@eattheadTierID@", $eattheadTierID);
    global $eattheadModCount;
    $TemplateText = Replace($TemplateText, "@eattheadModCount@", $eattheadModCount);
    global $eattheadStartDate;
    $TemplateText = Replace($TemplateText, "@eattheadStartDate@", $eattheadStartDate);
    global $eattheadEndDate;
    $TemplateText = Replace($TemplateText, "@eattheadEndDate@", $eattheadEndDate);
    global $eattheadStatus;
    if($eattheadStatus == "Temporary"):
        $SELECTEDF5_20_1 = "SELECTED";
    else:
        $SELECTEDF5_20_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_1@", $SELECTEDF5_20_1);
    if($eattheadStatus == "Wait_List"):
        $SELECTEDF5_20_2 = "SELECTED";
    else:
        $SELECTEDF5_20_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_2@", $SELECTEDF5_20_2);
    if($eattheadStatus == "Final"):
        $SELECTEDF5_20_3 = "SELECTED";
    else:
        $SELECTEDF5_20_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_3@", $SELECTEDF5_20_3);
    global $eattheadClassStatus;
    if($eattheadClassStatus == "Closed"):
        $SELECTEDF5_21_1 = "SELECTED";
    else:
        $SELECTEDF5_21_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_21_1@", $SELECTEDF5_21_1);
    if($eattheadClassStatus == "Open"):
        $SELECTEDF5_21_2 = "SELECTED";
    else:
        $SELECTEDF5_21_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_21_2@", $SELECTEDF5_21_2);
    global $eattheadDay1;
    if($eattheadDay1 == "Monday"):
        $SELECTEDF5_22_1 = "SELECTED";
    else:
        $SELECTEDF5_22_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_1@", $SELECTEDF5_22_1);
    if($eattheadDay1 == "Tuesday"):
        $SELECTEDF5_22_2 = "SELECTED";
    else:
        $SELECTEDF5_22_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_2@", $SELECTEDF5_22_2);
    if($eattheadDay1 == "Wednesday"):
        $SELECTEDF5_22_3 = "SELECTED";
    else:
        $SELECTEDF5_22_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_3@", $SELECTEDF5_22_3);
    if($eattheadDay1 == "Thursday"):
        $SELECTEDF5_22_4 = "SELECTED";
    else:
        $SELECTEDF5_22_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_4@", $SELECTEDF5_22_4);
    if($eattheadDay1 == "Friday"):
        $SELECTEDF5_22_5 = "SELECTED";
    else:
        $SELECTEDF5_22_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_5@", $SELECTEDF5_22_5);
    if($eattheadDay1 == "Saturday"):
        $SELECTEDF5_22_6 = "SELECTED";
    else:
        $SELECTEDF5_22_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_6@", $SELECTEDF5_22_6);
    if($eattheadDay1 == "Sunday"):
        $SELECTEDF5_22_7 = "SELECTED";
    else:
        $SELECTEDF5_22_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_7@", $SELECTEDF5_22_7);
    global $eattheadDay2;
    if($eattheadDay2 == "Monday"):
        $SELECTEDF5_23_1 = "SELECTED";
    else:
        $SELECTEDF5_23_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_1@", $SELECTEDF5_23_1);
    if($eattheadDay2 == "Tuesday"):
        $SELECTEDF5_23_2 = "SELECTED";
    else:
        $SELECTEDF5_23_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_2@", $SELECTEDF5_23_2);
    if($eattheadDay2 == "Wednesday"):
        $SELECTEDF5_23_3 = "SELECTED";
    else:
        $SELECTEDF5_23_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_3@", $SELECTEDF5_23_3);
    if($eattheadDay2 == "Thursday"):
        $SELECTEDF5_23_4 = "SELECTED";
    else:
        $SELECTEDF5_23_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_4@", $SELECTEDF5_23_4);
    if($eattheadDay2 == "Friday"):
        $SELECTEDF5_23_5 = "SELECTED";
    else:
        $SELECTEDF5_23_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_5@", $SELECTEDF5_23_5);
    if($eattheadDay2 == "Saturday"):
        $SELECTEDF5_23_6 = "SELECTED";
    else:
        $SELECTEDF5_23_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_6@", $SELECTEDF5_23_6);
    if($eattheadDay2 == "Sunday"):
        $SELECTEDF5_23_7 = "SELECTED";
    else:
        $SELECTEDF5_23_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_7@", $SELECTEDF5_23_7);
    global $eattheadDay3;
    if($eattheadDay3 == "Monday"):
        $SELECTEDF5_24_1 = "SELECTED";
    else:
        $SELECTEDF5_24_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_1@", $SELECTEDF5_24_1);
    if($eattheadDay3 == "Tuesday"):
        $SELECTEDF5_24_2 = "SELECTED";
    else:
        $SELECTEDF5_24_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_2@", $SELECTEDF5_24_2);
    if($eattheadDay3 == "Wednesday"):
        $SELECTEDF5_24_3 = "SELECTED";
    else:
        $SELECTEDF5_24_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_3@", $SELECTEDF5_24_3);
    if($eattheadDay3 == "Thursday"):
        $SELECTEDF5_24_4 = "SELECTED";
    else:
        $SELECTEDF5_24_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_4@", $SELECTEDF5_24_4);
    if($eattheadDay3 == "Friday"):
        $SELECTEDF5_24_5 = "SELECTED";
    else:
        $SELECTEDF5_24_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_5@", $SELECTEDF5_24_5);
    if($eattheadDay3 == "Saturday"):
        $SELECTEDF5_24_6 = "SELECTED";
    else:
        $SELECTEDF5_24_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_6@", $SELECTEDF5_24_6);
    if($eattheadDay3 == "Sunday"):
        $SELECTEDF5_24_7 = "SELECTED";
    else:
        $SELECTEDF5_24_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_7@", $SELECTEDF5_24_7);
    global $eattheadDay4;
    if($eattheadDay4 == "Monday"):
        $SELECTEDF5_25_1 = "SELECTED";
    else:
        $SELECTEDF5_25_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_1@", $SELECTEDF5_25_1);
    if($eattheadDay4 == "Tuesday"):
        $SELECTEDF5_25_2 = "SELECTED";
    else:
        $SELECTEDF5_25_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_2@", $SELECTEDF5_25_2);
    if($eattheadDay4 == "Wednesday"):
        $SELECTEDF5_25_3 = "SELECTED";
    else:
        $SELECTEDF5_25_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_3@", $SELECTEDF5_25_3);
    if($eattheadDay4 == "Thursday"):
        $SELECTEDF5_25_4 = "SELECTED";
    else:
        $SELECTEDF5_25_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_4@", $SELECTEDF5_25_4);
    if($eattheadDay4 == "Friday"):
        $SELECTEDF5_25_5 = "SELECTED";
    else:
        $SELECTEDF5_25_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_5@", $SELECTEDF5_25_5);
    if($eattheadDay4 == "Saturday"):
        $SELECTEDF5_25_6 = "SELECTED";
    else:
        $SELECTEDF5_25_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_6@", $SELECTEDF5_25_6);
    if($eattheadDay4 == "Sunday"):
        $SELECTEDF5_25_7 = "SELECTED";
    else:
        $SELECTEDF5_25_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_7@", $SELECTEDF5_25_7);
    global $eattheadDay5;
    if($eattheadDay5 == "Monday"):
        $SELECTEDF5_26_1 = "SELECTED";
    else:
        $SELECTEDF5_26_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_1@", $SELECTEDF5_26_1);
    if($eattheadDay5 == "Tuesday"):
        $SELECTEDF5_26_2 = "SELECTED";
    else:
        $SELECTEDF5_26_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_2@", $SELECTEDF5_26_2);
    if($eattheadDay5 == "Wednesday"):
        $SELECTEDF5_26_3 = "SELECTED";
    else:
        $SELECTEDF5_26_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_3@", $SELECTEDF5_26_3);
    if($eattheadDay5 == "Thursday"):
        $SELECTEDF5_26_4 = "SELECTED";
    else:
        $SELECTEDF5_26_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_4@", $SELECTEDF5_26_4);
    if($eattheadDay5 == "Friday"):
        $SELECTEDF5_26_5 = "SELECTED";
    else:
        $SELECTEDF5_26_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_5@", $SELECTEDF5_26_5);
    if($eattheadDay5 == "Saturday"):
        $SELECTEDF5_26_6 = "SELECTED";
    else:
        $SELECTEDF5_26_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_6@", $SELECTEDF5_26_6);
    if($eattheadDay5 == "Sunday"):
        $SELECTEDF5_26_7 = "SELECTED";
    else:
        $SELECTEDF5_26_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_7@", $SELECTEDF5_26_7);
    global $eattheadDay6;
    if($eattheadDay6 == "Monday"):
        $SELECTEDF5_27_1 = "SELECTED";
    else:
        $SELECTEDF5_27_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_1@", $SELECTEDF5_27_1);
    if($eattheadDay6 == "Tuesday"):
        $SELECTEDF5_27_2 = "SELECTED";
    else:
        $SELECTEDF5_27_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_2@", $SELECTEDF5_27_2);
    if($eattheadDay6 == "Wednesday"):
        $SELECTEDF5_27_3 = "SELECTED";
    else:
        $SELECTEDF5_27_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_3@", $SELECTEDF5_27_3);
    if($eattheadDay6 == "Thursday"):
        $SELECTEDF5_27_4 = "SELECTED";
    else:
        $SELECTEDF5_27_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_4@", $SELECTEDF5_27_4);
    if($eattheadDay6 == "Friday"):
        $SELECTEDF5_27_5 = "SELECTED";
    else:
        $SELECTEDF5_27_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_5@", $SELECTEDF5_27_5);
    if($eattheadDay6 == "Saturday"):
        $SELECTEDF5_27_6 = "SELECTED";
    else:
        $SELECTEDF5_27_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_6@", $SELECTEDF5_27_6);
    if($eattheadDay6 == "Sunday"):
        $SELECTEDF5_27_7 = "SELECTED";
    else:
        $SELECTEDF5_27_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_7@", $SELECTEDF5_27_7);
    global $eattheadDay7;
    if($eattheadDay7 == "Monday"):
        $SELECTEDF5_28_1 = "SELECTED";
    else:
        $SELECTEDF5_28_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_1@", $SELECTEDF5_28_1);
    if($eattheadDay7 == "Tuesday"):
        $SELECTEDF5_28_2 = "SELECTED";
    else:
        $SELECTEDF5_28_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_2@", $SELECTEDF5_28_2);
    if($eattheadDay7 == "Wednesday"):
        $SELECTEDF5_28_3 = "SELECTED";
    else:
        $SELECTEDF5_28_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_3@", $SELECTEDF5_28_3);
    if($eattheadDay7 == "Thursday"):
        $SELECTEDF5_28_4 = "SELECTED";
    else:
        $SELECTEDF5_28_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_4@", $SELECTEDF5_28_4);
    if($eattheadDay7 == "Friday"):
        $SELECTEDF5_28_5 = "SELECTED";
    else:
        $SELECTEDF5_28_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_5@", $SELECTEDF5_28_5);
    if($eattheadDay7 == "Saturday"):
        $SELECTEDF5_28_6 = "SELECTED";
    else:
        $SELECTEDF5_28_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_6@", $SELECTEDF5_28_6);
    if($eattheadDay7 == "Sunday"):
        $SELECTEDF5_28_7 = "SELECTED";
    else:
        $SELECTEDF5_28_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_7@", $SELECTEDF5_28_7);
    global $eattheadHrFr1;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr1@", $eattheadHrFr1);
    global $eattheadHrFr2;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr2@", $eattheadHrFr2);
    global $eattheadHrFr3;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr3@", $eattheadHrFr3);
    global $eattheadHrFr4;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr4@", $eattheadHrFr4);
    global $eattheadHrFr5;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr5@", $eattheadHrFr5);
    global $eattheadHrFr6;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr6@", $eattheadHrFr6);
    global $eattheadHrFr7;
    $TemplateText = Replace($TemplateText, "@eattheadHrFr7@", $eattheadHrFr7);
    global $eattheadHrTo1;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo1@", $eattheadHrTo1);
    global $eattheadHrTo2;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo2@", $eattheadHrTo2);
    global $eattheadHrTo3;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo3@", $eattheadHrTo3);
    global $eattheadHrTo4;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo4@", $eattheadHrTo4);
    global $eattheadHrTo5;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo5@", $eattheadHrTo5);
    global $eattheadHrTo6;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo6@", $eattheadHrTo6);
    global $eattheadHrTo7;
    $TemplateText = Replace($TemplateText, "@eattheadHrTo7@", $eattheadHrTo7);
    global $eattheadRm1;
    $TemplateText = Replace($TemplateText, "@eattheadRm1@", $eattheadRm1);
    global $eattheadRm2;
    $TemplateText = Replace($TemplateText, "@eattheadRm2@", $eattheadRm2);
    global $eattheadRm3;
    $TemplateText = Replace($TemplateText, "@eattheadRm3@", $eattheadRm3);
    global $eattheadRm4;
    $TemplateText = Replace($TemplateText, "@eattheadRm4@", $eattheadRm4);
    global $eattheadRm5;
    $TemplateText = Replace($TemplateText, "@eattheadRm5@", $eattheadRm5);
    global $eattheadRm6;
    $TemplateText = Replace($TemplateText, "@eattheadRm6@", $eattheadRm6);
    global $eattheadRm7;
    $TemplateText = Replace($TemplateText, "@eattheadRm7@", $eattheadRm7);
    global $eattheadTeaID1;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID1@", $eattheadTeaID1);
    global $eattheadTeaID2;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID2@", $eattheadTeaID2);
    global $eattheadTeaID3;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID3@", $eattheadTeaID3);
    global $eattheadTeaID4;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID4@", $eattheadTeaID4);
    global $eattheadTeaID5;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID5@", $eattheadTeaID5);
    global $eattheadTeaID6;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID6@", $eattheadTeaID6);
    global $eattheadTeaID7;
    $TemplateText = Replace($TemplateText, "@eattheadTeaID7@", $eattheadTeaID7);
    global $eattheadDayNo1;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo1@", $eattheadDayNo1);
    global $eattheadDayNo2;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo2@", $eattheadDayNo2);
    global $eattheadDayNo3;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo3@", $eattheadDayNo3);
    global $eattheadDayNo4;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo4@", $eattheadDayNo4);
    global $eattheadDayNo5;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo5@", $eattheadDayNo5);
    global $eattheadDayNo6;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo6@", $eattheadDayNo6);
    global $eattheadDayNo7;
    $TemplateText = Replace($TemplateText, "@eattheadDayNo7@", $eattheadDayNo7);
    global $eattheadSessionPrDay1;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay1@", $eattheadSessionPrDay1);
    global $eattheadSessionPrDay2;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay2@", $eattheadSessionPrDay2);
    global $eattheadSessionPrDay3;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay3@", $eattheadSessionPrDay3);
    global $eattheadSessionPrDay4;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay4@", $eattheadSessionPrDay4);
    global $eattheadSessionPrDay5;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay5@", $eattheadSessionPrDay5);
    global $eattheadSessionPrDay6;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay6@", $eattheadSessionPrDay6);
    global $eattheadSessionPrDay7;
    $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay7@", $eattheadSessionPrDay7);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAssessmentlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updateeatthead" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRSeatthead);
ob_flush();
?>
