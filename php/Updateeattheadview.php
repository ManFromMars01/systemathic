<?php
session_set_cookie_params(500);
session_start();
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

$HTML_Template = getRequest("HTMLT");

$ID1 = "";
$ID2 = "";
$ID3 = "";
$ID4 = "";
$UpdateeattheadFormAction = "Updateeatthead" . "edit.php";
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
function  MergeUpdateeattheadTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeatthead" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;

    global $UpdateeattheadFormAction;
    global $eattheadCountryID;
    global $eattheadBranchID;
    global $eattheadAdmitDate;
    global $eattheadCustNo;
    global $eattheadLevelID;
    global $eattheadTierID;
    global $eattheadModCount;
    global $eattheadStartDate;
    global $eattheadEndDate;
    global $eattheadStatus;
    global $eattheadClassStatus;
    global $eattheadDay1;
    global $eattheadDay2;
    global $eattheadDay3;
    global $eattheadDay4;
    global $eattheadDay5;
    global $eattheadDay6;
    global $eattheadDay7;
    global $eattheadHrFr1;
    global $eattheadHrFr2;
    global $eattheadHrFr3;
    global $eattheadHrFr4;
    global $eattheadHrFr5;
    global $eattheadHrFr6;
    global $eattheadHrFr7;
    global $eattheadHrTo1;
    global $eattheadHrTo2;
    global $eattheadHrTo3;
    global $eattheadHrTo4;
    global $eattheadHrTo5;
    global $eattheadHrTo6;
    global $eattheadHrTo7;
    global $eattheadRm1;
    global $eattheadRm2;
    global $eattheadRm3;
    global $eattheadRm4;
    global $eattheadRm5;
    global $eattheadRm6;
    global $eattheadRm7;
    global $eattheadTeaID1;
    global $eattheadTeaID2;
    global $eattheadTeaID3;
    global $eattheadTeaID4;
    global $eattheadTeaID5;
    global $eattheadTeaID6;
    global $eattheadTeaID7;
    global $eattheadDayNo1;
    global $eattheadDayNo2;
    global $eattheadDayNo3;
    global $eattheadDayNo4;
    global $eattheadDayNo5;
    global $eattheadDayNo6;
    global $eattheadDayNo7;
    global $eattheadSessionPrDay1;
    global $eattheadSessionPrDay2;
    global $eattheadSessionPrDay3;
    global $eattheadSessionPrDay4;
    global $eattheadSessionPrDay5;
    global $eattheadSessionPrDay6;
    global $eattheadSessionPrDay7;
    global $EditOptions;    
    global $dbNavBar;
    
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

    $TemplateText = Replace($TemplateText,"@UpdateeattheadFormAction@",$UpdateeattheadFormAction);    
    $TemplateText = Replace($TemplateText,"@eattheadCountryID@",$eattheadCountryID);    
    $TemplateText = Replace($TemplateText,"@eattheadBranchID@",$eattheadBranchID);    
    $TemplateText = Replace($TemplateText,"@eattheadAdmitDate@",$eattheadAdmitDate);    
    $TemplateText = Replace($TemplateText,"@eattheadCustNo@",$eattheadCustNo);    
    $TemplateText = Replace($TemplateText,"@eattheadLevelID@",$eattheadLevelID);    
    $TemplateText = Replace($TemplateText,"@eattheadTierID@",$eattheadTierID);    
    $TemplateText = Replace($TemplateText,"@eattheadModCount@",$eattheadModCount);    
    $TemplateText = Replace($TemplateText,"@eattheadStartDate@",$eattheadStartDate);    
    $TemplateText = Replace($TemplateText,"@eattheadEndDate@",$eattheadEndDate);    
    $TemplateText = Replace($TemplateText,"@eattheadStatus@",$eattheadStatus);    
    $TemplateText = Replace($TemplateText,"@eattheadClassStatus@",$eattheadClassStatus);    
    $TemplateText = Replace($TemplateText,"@eattheadDay1@",$eattheadDay1);    
    $TemplateText = Replace($TemplateText,"@eattheadDay2@",$eattheadDay2);    
    $TemplateText = Replace($TemplateText,"@eattheadDay3@",$eattheadDay3);    
    $TemplateText = Replace($TemplateText,"@eattheadDay4@",$eattheadDay4);    
    $TemplateText = Replace($TemplateText,"@eattheadDay5@",$eattheadDay5);    
    $TemplateText = Replace($TemplateText,"@eattheadDay6@",$eattheadDay6);    
    $TemplateText = Replace($TemplateText,"@eattheadDay7@",$eattheadDay7);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr1@",$eattheadHrFr1);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr2@",$eattheadHrFr2);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr3@",$eattheadHrFr3);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr4@",$eattheadHrFr4);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr5@",$eattheadHrFr5);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr6@",$eattheadHrFr6);    
    $TemplateText = Replace($TemplateText,"@eattheadHrFr7@",$eattheadHrFr7);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo1@",$eattheadHrTo1);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo2@",$eattheadHrTo2);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo3@",$eattheadHrTo3);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo4@",$eattheadHrTo4);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo5@",$eattheadHrTo5);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo6@",$eattheadHrTo6);    
    $TemplateText = Replace($TemplateText,"@eattheadHrTo7@",$eattheadHrTo7);    
    $TemplateText = Replace($TemplateText,"@eattheadRm1@",$eattheadRm1);    
    $TemplateText = Replace($TemplateText,"@eattheadRm2@",$eattheadRm2);    
    $TemplateText = Replace($TemplateText,"@eattheadRm3@",$eattheadRm3);    
    $TemplateText = Replace($TemplateText,"@eattheadRm4@",$eattheadRm4);    
    $TemplateText = Replace($TemplateText,"@eattheadRm5@",$eattheadRm5);    
    $TemplateText = Replace($TemplateText,"@eattheadRm6@",$eattheadRm6);    
    $TemplateText = Replace($TemplateText,"@eattheadRm7@",$eattheadRm7);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID1@",$eattheadTeaID1);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID2@",$eattheadTeaID2);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID3@",$eattheadTeaID3);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID4@",$eattheadTeaID4);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID5@",$eattheadTeaID5);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID6@",$eattheadTeaID6);    
    $TemplateText = Replace($TemplateText,"@eattheadTeaID7@",$eattheadTeaID7);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo1@",$eattheadDayNo1);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo2@",$eattheadDayNo2);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo3@",$eattheadDayNo3);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo4@",$eattheadDayNo4);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo5@",$eattheadDayNo5);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo6@",$eattheadDayNo6);    
    $TemplateText = Replace($TemplateText,"@eattheadDayNo7@",$eattheadDayNo7);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay1@",$eattheadSessionPrDay1);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay2@",$eattheadSessionPrDay2);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay3@",$eattheadSessionPrDay3);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay4@",$eattheadSessionPrDay4);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay5@",$eattheadSessionPrDay5);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay6@",$eattheadSessionPrDay6);    
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay7@",$eattheadSessionPrDay7);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@ID4@",$ID4);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    $TemplateText = Replace($TemplateText,"@userdata1@", $userdata1);    
    print($TemplateText);
}
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
     $ID1 = trim(htmlDecode(getRequest("ID1")),"'");
     $ID2 = trim(htmlDecode(getRequest("ID2")),"'");
     $ID3 = trim(htmlDecode(getRequest("ID3")),"'");
     $ID4 = trim(htmlDecode(getRequest("ID4")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeViewTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeViewTemplate($Template,$ClarionData) {
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != FALSE):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;
    print($TemplateText);
    exit();
}
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$NoRecords = FALSE;
$myQuoteID1 = getQuote($objConn1,"eatthead","CountryID");
$myQuoteID2 = getQuote($objConn1,"eatthead","BranchID");
$myQuoteID3 = getQuote($objConn1,"eatthead","CustNo");
$myQuoteID4 = getQuote($objConn1,"eatthead","TierID");
$strSQLBase  = "SELECT eatthead.CountryID, eatthead.BranchID, eatthead.AdmitDate, eatthead.CustNo, eatthead.LevelID, eatthead.TierID, eatthead.ModCount, eatthead.StartDate, eatthead.EndDate, eatthead.Status, eatthead.ClassStatus, eatthead.Day1, eatthead.Day2, eatthead.Day3, eatthead.Day4, eatthead.Day5, eatthead.Day6, eatthead.Day7, eatthead.HrFr1, eatthead.HrFr2, eatthead.HrFr3, eatthead.HrFr4, eatthead.HrFr5, eatthead.HrFr6, eatthead.HrFr7, eatthead.HrTo1, eatthead.HrTo2, eatthead.HrTo3, eatthead.HrTo4, eatthead.HrTo5, eatthead.HrTo6, eatthead.HrTo7, eatthead.Rm1, eatthead.Rm2, eatthead.Rm3, eatthead.Rm4, eatthead.Rm5, eatthead.Rm6, eatthead.Rm7, eatthead.TeaID1, eatthead.TeaID2, eatthead.TeaID3, eatthead.TeaID4, eatthead.TeaID5, eatthead.TeaID6, eatthead.TeaID7, eatthead.DayNo1, eatthead.DayNo2, eatthead.DayNo3, eatthead.DayNo4, eatthead.DayNo5, eatthead.DayNo6, eatthead.DayNo7, eatthead.SessionPrDay1, eatthead.SessionPrDay2, eatthead.SessionPrDay3, eatthead.SessionPrDay4, eatthead.SessionPrDay5, eatthead.SessionPrDay6, eatthead.SessionPrDay7  FROM  eatthead  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "eatthead.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND eatthead.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND eatthead.CustNo=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND eatthead.TierID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY eatthead.TierID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY eatthead.TierID ASC";
else:
    $strSQL .= " = " . $myQuoteID4 . $ID4 . $myQuoteID4;
endif;

$oRSeatthead = $objConn1->SelectLimit($strSQL,1);
if (($oRSeatthead->EOF == TRUE) || ($oRSeatthead->CurrentRow() == -1)):
    $oRSeatthead->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRSeatthead->MoveFirst() == FALSE):
    $oRSeatthead->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRSeatthead->Fields("CountryID");
$ID2 = $oRSeatthead->Fields("BranchID");
$ID3 = $oRSeatthead->Fields("CustNo");
$ID4 = $oRSeatthead->Fields("TierID");
if (is_null($oRSeatthead->Fields("CountryID"))):
    $eattheadCountryID  = "";
else:
    if (is_numeric($oRSeatthead->Fields("CountryID"))):
        $eattheadCountryID  = getValue($oRSeatthead->Fields("CountryID"));
    else:
        $eattheadCountryID  = htmlentities(getValue($oRSeatthead->Fields("CountryID")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("BranchID"))):
    $eattheadBranchID  = "";
else:
    if (is_numeric($oRSeatthead->Fields("BranchID"))):
        $eattheadBranchID  = getValue($oRSeatthead->Fields("BranchID"));
    else:
        $eattheadBranchID  = htmlentities(getValue($oRSeatthead->Fields("BranchID")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("AdmitDate"))):
    $eattheadAdmitDate  = "";
else:
    if (is_numeric($oRSeatthead->Fields("AdmitDate"))):
        $eattheadAdmitDate  = getValue($oRSeatthead->Fields("AdmitDate"));
    else:
        $eattheadAdmitDate  = htmlentities(getValue($oRSeatthead->Fields("AdmitDate")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("CustNo"))):
    $eattheadCustNo  = "";
else:
    if (is_numeric($oRSeatthead->Fields("CustNo"))):
        $eattheadCustNo  = getValue($oRSeatthead->Fields("CustNo"));
    else:
        $eattheadCustNo  = htmlentities(getValue($oRSeatthead->Fields("CustNo")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("LevelID"))):
    $eattheadLevelID  = "";
else:
    if (is_numeric($oRSeatthead->Fields("LevelID"))):
        $eattheadLevelID  = getValue($oRSeatthead->Fields("LevelID"));
    else:
        $eattheadLevelID  = htmlentities(getValue($oRSeatthead->Fields("LevelID")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TierID"))):
    $eattheadTierID  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TierID"))):
        $eattheadTierID  = getValue($oRSeatthead->Fields("TierID"));
    else:
        $eattheadTierID  = htmlentities(getValue($oRSeatthead->Fields("TierID")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("ModCount"))):
    $eattheadModCount  = "";
else:
    if (is_numeric($oRSeatthead->Fields("ModCount"))):
        $eattheadModCount  = getValue($oRSeatthead->Fields("ModCount"));
    else:
        $eattheadModCount  = htmlentities(getValue($oRSeatthead->Fields("ModCount")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("StartDate"))):
    $eattheadStartDate  = "";
else:
    if (is_numeric($oRSeatthead->Fields("StartDate"))):
        $eattheadStartDate  = getValue($oRSeatthead->Fields("StartDate"));
    else:
        $eattheadStartDate  = htmlentities(getValue($oRSeatthead->Fields("StartDate")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("EndDate"))):
    $eattheadEndDate  = "";
else:
    if (is_numeric($oRSeatthead->Fields("EndDate"))):
        $eattheadEndDate  = getValue($oRSeatthead->Fields("EndDate"));
    else:
        $eattheadEndDate  = htmlentities(getValue($oRSeatthead->Fields("EndDate")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Status"))):
    $eattheadStatus    =    "";
else:
    $eattheadStatus  = htmlentities($oRSeatthead->Fields("Status"));
endif;
if (is_null($oRSeatthead->Fields("ClassStatus"))):
    $eattheadClassStatus    =    "";
else:
    $eattheadClassStatus  = htmlentities($oRSeatthead->Fields("ClassStatus"));
endif;
if (is_null($oRSeatthead->Fields("Day1"))):
    $eattheadDay1    =    "";
else:
    $eattheadDay1  = htmlentities($oRSeatthead->Fields("Day1"));
endif;
if (is_null($oRSeatthead->Fields("Day2"))):
    $eattheadDay2    =    "";
else:
    $eattheadDay2  = htmlentities($oRSeatthead->Fields("Day2"));
endif;
if (is_null($oRSeatthead->Fields("Day3"))):
    $eattheadDay3    =    "";
else:
    $eattheadDay3  = htmlentities($oRSeatthead->Fields("Day3"));
endif;
if (is_null($oRSeatthead->Fields("Day4"))):
    $eattheadDay4    =    "";
else:
    $eattheadDay4  = htmlentities($oRSeatthead->Fields("Day4"));
endif;
if (is_null($oRSeatthead->Fields("Day5"))):
    $eattheadDay5    =    "";
else:
    $eattheadDay5  = htmlentities($oRSeatthead->Fields("Day5"));
endif;
if (is_null($oRSeatthead->Fields("Day6"))):
    $eattheadDay6    =    "";
else:
    $eattheadDay6  = htmlentities($oRSeatthead->Fields("Day6"));
endif;
if (is_null($oRSeatthead->Fields("Day7"))):
    $eattheadDay7    =    "";
else:
    $eattheadDay7  = htmlentities($oRSeatthead->Fields("Day7"));
endif;
if (is_null($oRSeatthead->Fields("HrFr1"))):
    $eattheadHrFr1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr1"))):
        $eattheadHrFr1  = getValue($oRSeatthead->Fields("HrFr1"));
    else:
        $eattheadHrFr1  = htmlentities(getValue($oRSeatthead->Fields("HrFr1")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr2"))):
    $eattheadHrFr2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr2"))):
        $eattheadHrFr2  = getValue($oRSeatthead->Fields("HrFr2"));
    else:
        $eattheadHrFr2  = htmlentities(getValue($oRSeatthead->Fields("HrFr2")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr3"))):
    $eattheadHrFr3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr3"))):
        $eattheadHrFr3  = getValue($oRSeatthead->Fields("HrFr3"));
    else:
        $eattheadHrFr3  = htmlentities(getValue($oRSeatthead->Fields("HrFr3")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr4"))):
    $eattheadHrFr4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr4"))):
        $eattheadHrFr4  = getValue($oRSeatthead->Fields("HrFr4"));
    else:
        $eattheadHrFr4  = htmlentities(getValue($oRSeatthead->Fields("HrFr4")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr5"))):
    $eattheadHrFr5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr5"))):
        $eattheadHrFr5  = getValue($oRSeatthead->Fields("HrFr5"));
    else:
        $eattheadHrFr5  = htmlentities(getValue($oRSeatthead->Fields("HrFr5")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr6"))):
    $eattheadHrFr6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr6"))):
        $eattheadHrFr6  = getValue($oRSeatthead->Fields("HrFr6"));
    else:
        $eattheadHrFr6  = htmlentities(getValue($oRSeatthead->Fields("HrFr6")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrFr7"))):
    $eattheadHrFr7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrFr7"))):
        $eattheadHrFr7  = getValue($oRSeatthead->Fields("HrFr7"));
    else:
        $eattheadHrFr7  = htmlentities(getValue($oRSeatthead->Fields("HrFr7")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo1"))):
    $eattheadHrTo1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo1"))):
        $eattheadHrTo1  = getValue($oRSeatthead->Fields("HrTo1"));
    else:
        $eattheadHrTo1  = htmlentities(getValue($oRSeatthead->Fields("HrTo1")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo2"))):
    $eattheadHrTo2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo2"))):
        $eattheadHrTo2  = getValue($oRSeatthead->Fields("HrTo2"));
    else:
        $eattheadHrTo2  = htmlentities(getValue($oRSeatthead->Fields("HrTo2")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo3"))):
    $eattheadHrTo3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo3"))):
        $eattheadHrTo3  = getValue($oRSeatthead->Fields("HrTo3"));
    else:
        $eattheadHrTo3  = htmlentities(getValue($oRSeatthead->Fields("HrTo3")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo4"))):
    $eattheadHrTo4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo4"))):
        $eattheadHrTo4  = getValue($oRSeatthead->Fields("HrTo4"));
    else:
        $eattheadHrTo4  = htmlentities(getValue($oRSeatthead->Fields("HrTo4")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo5"))):
    $eattheadHrTo5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo5"))):
        $eattheadHrTo5  = getValue($oRSeatthead->Fields("HrTo5"));
    else:
        $eattheadHrTo5  = htmlentities(getValue($oRSeatthead->Fields("HrTo5")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo6"))):
    $eattheadHrTo6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo6"))):
        $eattheadHrTo6  = getValue($oRSeatthead->Fields("HrTo6"));
    else:
        $eattheadHrTo6  = htmlentities(getValue($oRSeatthead->Fields("HrTo6")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("HrTo7"))):
    $eattheadHrTo7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("HrTo7"))):
        $eattheadHrTo7  = getValue($oRSeatthead->Fields("HrTo7"));
    else:
        $eattheadHrTo7  = htmlentities(getValue($oRSeatthead->Fields("HrTo7")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm1"))):
    $eattheadRm1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm1"))):
        $eattheadRm1  = getValue($oRSeatthead->Fields("Rm1"));
    else:
        $eattheadRm1  = htmlentities(getValue($oRSeatthead->Fields("Rm1")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm2"))):
    $eattheadRm2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm2"))):
        $eattheadRm2  = getValue($oRSeatthead->Fields("Rm2"));
    else:
        $eattheadRm2  = htmlentities(getValue($oRSeatthead->Fields("Rm2")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm3"))):
    $eattheadRm3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm3"))):
        $eattheadRm3  = getValue($oRSeatthead->Fields("Rm3"));
    else:
        $eattheadRm3  = htmlentities(getValue($oRSeatthead->Fields("Rm3")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm4"))):
    $eattheadRm4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm4"))):
        $eattheadRm4  = getValue($oRSeatthead->Fields("Rm4"));
    else:
        $eattheadRm4  = htmlentities(getValue($oRSeatthead->Fields("Rm4")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm5"))):
    $eattheadRm5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm5"))):
        $eattheadRm5  = getValue($oRSeatthead->Fields("Rm5"));
    else:
        $eattheadRm5  = htmlentities(getValue($oRSeatthead->Fields("Rm5")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm6"))):
    $eattheadRm6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm6"))):
        $eattheadRm6  = getValue($oRSeatthead->Fields("Rm6"));
    else:
        $eattheadRm6  = htmlentities(getValue($oRSeatthead->Fields("Rm6")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("Rm7"))):
    $eattheadRm7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("Rm7"))):
        $eattheadRm7  = getValue($oRSeatthead->Fields("Rm7"));
    else:
        $eattheadRm7  = htmlentities(getValue($oRSeatthead->Fields("Rm7")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID1"))):
    $eattheadTeaID1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID1"))):
        $eattheadTeaID1  = getValue($oRSeatthead->Fields("TeaID1"));
    else:
        $eattheadTeaID1  = htmlentities(getValue($oRSeatthead->Fields("TeaID1")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID2"))):
    $eattheadTeaID2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID2"))):
        $eattheadTeaID2  = getValue($oRSeatthead->Fields("TeaID2"));
    else:
        $eattheadTeaID2  = htmlentities(getValue($oRSeatthead->Fields("TeaID2")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID3"))):
    $eattheadTeaID3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID3"))):
        $eattheadTeaID3  = getValue($oRSeatthead->Fields("TeaID3"));
    else:
        $eattheadTeaID3  = htmlentities(getValue($oRSeatthead->Fields("TeaID3")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID4"))):
    $eattheadTeaID4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID4"))):
        $eattheadTeaID4  = getValue($oRSeatthead->Fields("TeaID4"));
    else:
        $eattheadTeaID4  = htmlentities(getValue($oRSeatthead->Fields("TeaID4")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID5"))):
    $eattheadTeaID5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID5"))):
        $eattheadTeaID5  = getValue($oRSeatthead->Fields("TeaID5"));
    else:
        $eattheadTeaID5  = htmlentities(getValue($oRSeatthead->Fields("TeaID5")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID6"))):
    $eattheadTeaID6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID6"))):
        $eattheadTeaID6  = getValue($oRSeatthead->Fields("TeaID6"));
    else:
        $eattheadTeaID6  = htmlentities(getValue($oRSeatthead->Fields("TeaID6")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("TeaID7"))):
    $eattheadTeaID7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("TeaID7"))):
        $eattheadTeaID7  = getValue($oRSeatthead->Fields("TeaID7"));
    else:
        $eattheadTeaID7  = htmlentities(getValue($oRSeatthead->Fields("TeaID7")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo1"))):
    $eattheadDayNo1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo1"))):        
        $eattheadDayNo1  = $oRSeatthead->Fields("DayNo1");
    else:
        $eattheadDayNo1  = htmlentities($oRSeatthead->Fields("DayNo1"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo2"))):
    $eattheadDayNo2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo2"))):        
        $eattheadDayNo2  = $oRSeatthead->Fields("DayNo2");
    else:
        $eattheadDayNo2  = htmlentities($oRSeatthead->Fields("DayNo2"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo3"))):
    $eattheadDayNo3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo3"))):        
        $eattheadDayNo3  = $oRSeatthead->Fields("DayNo3");
    else:
        $eattheadDayNo3  = htmlentities($oRSeatthead->Fields("DayNo3"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo4"))):
    $eattheadDayNo4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo4"))):        
        $eattheadDayNo4  = $oRSeatthead->Fields("DayNo4");
    else:
        $eattheadDayNo4  = htmlentities($oRSeatthead->Fields("DayNo4"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo5"))):
    $eattheadDayNo5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo5"))):        
        $eattheadDayNo5  = $oRSeatthead->Fields("DayNo5");
    else:
        $eattheadDayNo5  = htmlentities($oRSeatthead->Fields("DayNo5"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo6"))):
    $eattheadDayNo6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo6"))):        
        $eattheadDayNo6  = $oRSeatthead->Fields("DayNo6");
    else:
        $eattheadDayNo6  = htmlentities($oRSeatthead->Fields("DayNo6"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("DayNo7"))):
    $eattheadDayNo7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("DayNo7"))):        
        $eattheadDayNo7  = $oRSeatthead->Fields("DayNo7");
    else:
        $eattheadDayNo7  = htmlentities($oRSeatthead->Fields("DayNo7"));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay1"))):
    $eattheadSessionPrDay1  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay1"))):
        $eattheadSessionPrDay1  = getValue($oRSeatthead->Fields("SessionPrDay1"));
    else:
        $eattheadSessionPrDay1  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay1")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay2"))):
    $eattheadSessionPrDay2  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay2"))):
        $eattheadSessionPrDay2  = getValue($oRSeatthead->Fields("SessionPrDay2"));
    else:
        $eattheadSessionPrDay2  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay2")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay3"))):
    $eattheadSessionPrDay3  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay3"))):
        $eattheadSessionPrDay3  = getValue($oRSeatthead->Fields("SessionPrDay3"));
    else:
        $eattheadSessionPrDay3  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay3")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay4"))):
    $eattheadSessionPrDay4  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay4"))):
        $eattheadSessionPrDay4  = getValue($oRSeatthead->Fields("SessionPrDay4"));
    else:
        $eattheadSessionPrDay4  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay4")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay5"))):
    $eattheadSessionPrDay5  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay5"))):
        $eattheadSessionPrDay5  = getValue($oRSeatthead->Fields("SessionPrDay5"));
    else:
        $eattheadSessionPrDay5  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay5")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay6"))):
    $eattheadSessionPrDay6  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay6"))):
        $eattheadSessionPrDay6  = getValue($oRSeatthead->Fields("SessionPrDay6"));
    else:
        $eattheadSessionPrDay6  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay6")));
    endif;
endif;
if (is_null($oRSeatthead->Fields("SessionPrDay7"))):
    $eattheadSessionPrDay7  = "";
else:
    if (is_numeric($oRSeatthead->Fields("SessionPrDay7"))):
        $eattheadSessionPrDay7  = getValue($oRSeatthead->Fields("SessionPrDay7"));
    else:
        $eattheadSessionPrDay7  = htmlentities(getValue($oRSeatthead->Fields("SessionPrDay7")));
    endif;
endif;
$EditLevel = 1;

$myLevel = getSession("UserLevel") == "" ? 0 : getSession("UserLevel");          

if(!isset($EditLevel)):
    $EditLevel = 0;
endif;
if ($myLevel >= $EditLevel):
    $EditOptions = "<input type='IMAGE' src='" . $IconEdit . "' alt='Edit' height=20 width=20 title='Edit this record' id='submit1' name='submit1' >";
else:
    $EditOptions = "";
endif;

$dbNavBarPrev = "";
$dbNavBarNext = "";
$dbNavBarPrev = "<a href=Updateeatthead" . "view.php?";
$dbNavBarNext = "<a href=Updateeatthead" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRSeatthead->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRSeatthead->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRSeatthead->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRSeatthead->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRSeatthead->Fields("CustNo");
$dbNavBarNext  .= "&ID3=" . $oRSeatthead->Fields("CustNo");
$dbNavBarPrev  .= "&ID4=" . $oRSeatthead->Fields("TierID");
$dbNavBarNext  .= "&ID4=" . $oRSeatthead->Fields("TierID");
if ($NoRecords == TRUE):
    if ($myDirection = "p"):
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPriorDisabled . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
    else:
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNextDisabled . " alt='Next record' border=0 height=20 width=20></a>";    
    endif;
else:
    $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
    $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
endif;
$dbNavBar = $dbNavBarPrev . $dbNavBarNext;
$oRSeatthead->Close();
MergeUpdateeattheadTemplate($HTML_Template);
unset($oRSeatthead);
    $objConn1->Close();
    unset($objConn1);
?>
