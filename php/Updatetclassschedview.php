<?php
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

$HTML_Template = getRequest("HTMLT");

$ID1 = "";
$ID2 = "";
$ID3 = "";
$ID4 = "";
$UpdatetclassschedFormAction = "Updatetclasssched" . "edit.php";
$tclassschedCountryID = "";
$tclassschedBranchID = "";
$tclassschedDay = "";
$tclassschedTimeFrom = "";
$tclassschedTimeTo = "";
$tclassschedLevelID = "";
$tclassschedTeacherCnt = "";
$tclassschedTeacherID1 = "";
$tclassschedTeacherID2 = "";
$tclassschedTeacherID3 = "";
$tclassschedTeacherName1 = "";
$tclassschedTeacherName2 = "";
$tclassschedTeacherName3 = "";
$tclassschedRoomID = "";
$tclassschedEnrollee = "";
$tclassschedAvailable = "";
function  MergeUpdatetclassschedTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetclasssched" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;

    global $UpdatetclassschedFormAction;
    global $tclassschedCountryID;
    global $tclassschedBranchID;
    global $tclassschedDay;
    global $tclassschedTimeFrom;
    global $tclassschedTimeTo;
    global $tclassschedLevelID;
    global $tclassschedTeacherCnt;
    global $tclassschedTeacherID1;
    global $tclassschedTeacherID2;
    global $tclassschedTeacherID3;
    global $tclassschedTeacherName1;
    global $tclassschedTeacherName2;
    global $tclassschedTeacherName3;
    global $tclassschedRoomID;
    global $tclassschedEnrollee;
    global $tclassschedAvailable;
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

    $TemplateText = Replace($TemplateText,"@UpdatetclassschedFormAction@",$UpdatetclassschedFormAction);    
    $TemplateText = Replace($TemplateText,"@tclassschedCountryID@",$tclassschedCountryID);    
    $TemplateText = Replace($TemplateText,"@tclassschedBranchID@",$tclassschedBranchID);    
    $TemplateText = Replace($TemplateText,"@tclassschedDay@",$tclassschedDay);    
    $TemplateText = Replace($TemplateText,"@tclassschedTimeFrom@",$tclassschedTimeFrom);    
    $TemplateText = Replace($TemplateText,"@tclassschedTimeTo@",$tclassschedTimeTo);    
    $TemplateText = Replace($TemplateText,"@tclassschedLevelID@",$tclassschedLevelID);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherCnt@",$tclassschedTeacherCnt);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID1@",$tclassschedTeacherID1);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID2@",$tclassschedTeacherID2);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID3@",$tclassschedTeacherID3);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName1@",$tclassschedTeacherName1);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName2@",$tclassschedTeacherName2);    
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName3@",$tclassschedTeacherName3);    
    $TemplateText = Replace($TemplateText,"@tclassschedRoomID@",$tclassschedRoomID);    
    $TemplateText = Replace($TemplateText,"@tclassschedEnrollee@",$tclassschedEnrollee);    
    $TemplateText = Replace($TemplateText,"@tclassschedAvailable@",$tclassschedAvailable);    
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
    $ClarionData .= "<a href=BrowseAttendanceStatus" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tclasssched","CountryID");
$myQuoteID2 = getQuote($objConn1,"tclasssched","BranchID");
$myQuoteID3 = getQuote($objConn1,"tclasssched","Day");
$myQuoteID4 = getQuote($objConn1,"tclasssched","TimeFrom");
$strSQLBase  = "SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2, tclasssched.TeacherID3, tclasssched.TeacherName1, tclasssched.TeacherName2, tclasssched.TeacherName3, tclasssched.RoomID, tclasssched.Enrollee, tclasssched.Available  FROM  tclasssched  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tclasssched.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tclasssched.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tclasssched.Day=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND tclasssched.TimeFrom ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tclasssched.TimeFrom DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tclasssched.TimeFrom ASC";
else:
    $strSQL .= " = " . $myQuoteID4 . $ID4 . $myQuoteID4;
endif;

$oRStclasssched = $objConn1->SelectLimit($strSQL,1);
if (($oRStclasssched->EOF == TRUE) || ($oRStclasssched->CurrentRow() == -1)):
    $oRStclasssched->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStclasssched->MoveFirst() == FALSE):
    $oRStclasssched->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStclasssched->Fields("CountryID");
$ID2 = $oRStclasssched->Fields("BranchID");
$ID3 = $oRStclasssched->Fields("Day");
$ID4 = $oRStclasssched->Fields("TimeFrom");
if (is_null($oRStclasssched->Fields("CountryID"))):
    $tclassschedCountryID  = "";
else:
    if (is_numeric($oRStclasssched->Fields("CountryID"))):
        $tclassschedCountryID  = getValue($oRStclasssched->Fields("CountryID"));
    else:
        $tclassschedCountryID  = htmlentities(getValue($oRStclasssched->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("BranchID"))):
    $tclassschedBranchID  = "";
else:
    if (is_numeric($oRStclasssched->Fields("BranchID"))):
        $tclassschedBranchID  = getValue($oRStclasssched->Fields("BranchID"));
    else:
        $tclassschedBranchID  = htmlentities(getValue($oRStclasssched->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("Day"))):
    $tclassschedDay  = "";
else:
    if (is_numeric($oRStclasssched->Fields("Day"))):
        $tclassschedDay  = getValue($oRStclasssched->Fields("Day"));
    else:
        $tclassschedDay  = htmlentities(getValue($oRStclasssched->Fields("Day")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TimeFrom"))):
    $tclassschedTimeFrom  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TimeFrom"))):
        $tclassschedTimeFrom  = getValue($oRStclasssched->Fields("TimeFrom"));
    else:
        $tclassschedTimeFrom  = htmlentities(getValue($oRStclasssched->Fields("TimeFrom")));
    endif;
                $tclassschedTimeFrom = formatDateTime('H:i',$tclassschedTimeFrom);
endif;
if (is_null($oRStclasssched->Fields("TimeTo"))):
    $tclassschedTimeTo  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TimeTo"))):
        $tclassschedTimeTo  = getValue($oRStclasssched->Fields("TimeTo"));
    else:
        $tclassschedTimeTo  = htmlentities(getValue($oRStclasssched->Fields("TimeTo")));
    endif;
                $tclassschedTimeTo = formatDateTime('H:i',$tclassschedTimeTo);
endif;
if (is_null($oRStclasssched->Fields("LevelID"))):
    $tclassschedLevelID  = "";
else:
    if (is_numeric($oRStclasssched->Fields("LevelID"))):
        $tclassschedLevelID  = getValue($oRStclasssched->Fields("LevelID"));
    else:
        $tclassschedLevelID  = htmlentities(getValue($oRStclasssched->Fields("LevelID")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherCnt"))):
    $tclassschedTeacherCnt  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherCnt"))):
        $tclassschedTeacherCnt  = getValue($oRStclasssched->Fields("TeacherCnt"));
    else:
        $tclassschedTeacherCnt  = htmlentities(getValue($oRStclasssched->Fields("TeacherCnt")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherID1"))):
    $tclassschedTeacherID1  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherID1"))):
        $tclassschedTeacherID1  = getValue($oRStclasssched->Fields("TeacherID1"));
    else:
        $tclassschedTeacherID1  = htmlentities(getValue($oRStclasssched->Fields("TeacherID1")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherID2"))):
    $tclassschedTeacherID2  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherID2"))):
        $tclassschedTeacherID2  = getValue($oRStclasssched->Fields("TeacherID2"));
    else:
        $tclassschedTeacherID2  = htmlentities(getValue($oRStclasssched->Fields("TeacherID2")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherID3"))):
    $tclassschedTeacherID3  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherID3"))):
        $tclassschedTeacherID3  = getValue($oRStclasssched->Fields("TeacherID3"));
    else:
        $tclassschedTeacherID3  = htmlentities(getValue($oRStclasssched->Fields("TeacherID3")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherName1"))):
    $tclassschedTeacherName1  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherName1"))):
        $tclassschedTeacherName1  = getValue($oRStclasssched->Fields("TeacherName1"));
    else:
        $tclassschedTeacherName1  = htmlentities(getValue($oRStclasssched->Fields("TeacherName1")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherName2"))):
    $tclassschedTeacherName2  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherName2"))):
        $tclassschedTeacherName2  = getValue($oRStclasssched->Fields("TeacherName2"));
    else:
        $tclassschedTeacherName2  = htmlentities(getValue($oRStclasssched->Fields("TeacherName2")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("TeacherName3"))):
    $tclassschedTeacherName3  = "";
else:
    if (is_numeric($oRStclasssched->Fields("TeacherName3"))):
        $tclassschedTeacherName3  = getValue($oRStclasssched->Fields("TeacherName3"));
    else:
        $tclassschedTeacherName3  = htmlentities(getValue($oRStclasssched->Fields("TeacherName3")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("RoomID"))):
    $tclassschedRoomID  = "";
else:
    if (is_numeric($oRStclasssched->Fields("RoomID"))):
        $tclassschedRoomID  = getValue($oRStclasssched->Fields("RoomID"));
    else:
        $tclassschedRoomID  = htmlentities(getValue($oRStclasssched->Fields("RoomID")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("Enrollee"))):
    $tclassschedEnrollee  = "";
else:
    if (is_numeric($oRStclasssched->Fields("Enrollee"))):
        $tclassschedEnrollee  = getValue($oRStclasssched->Fields("Enrollee"));
    else:
        $tclassschedEnrollee  = htmlentities(getValue($oRStclasssched->Fields("Enrollee")));
    endif;
endif;
if (is_null($oRStclasssched->Fields("Available"))):
    $tclassschedAvailable  = "";
else:
    if (is_numeric($oRStclasssched->Fields("Available"))):
        $tclassschedAvailable  = getValue($oRStclasssched->Fields("Available"));
    else:
        $tclassschedAvailable  = htmlentities(getValue($oRStclasssched->Fields("Available")));
    endif;
endif;

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
$dbNavBarPrev = "<a href=Updatetclasssched" . "view.php?";
$dbNavBarNext = "<a href=Updatetclasssched" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStclasssched->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStclasssched->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStclasssched->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStclasssched->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStclasssched->Fields("Day");
$dbNavBarNext  .= "&ID3=" . $oRStclasssched->Fields("Day");
$dbNavBarPrev  .= "&ID4=" . $oRStclasssched->Fields("TimeFrom");
$dbNavBarNext  .= "&ID4=" . $oRStclasssched->Fields("TimeFrom");
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
$oRStclasssched->Close();
MergeUpdatetclassschedTemplate($HTML_Template);
unset($oRStclasssched);
    $objConn1->Close();
    unset($objConn1);
?>
