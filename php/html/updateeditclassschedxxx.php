<?PHP
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
$DeleteButton = "";
$UpdatetclassschedFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetclasssched" . "edit.htm";
    endif;
    global $DeleteButton;   
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdatetclassschedFormAction@",$UpdatetclassschedFormAction);    

     $TemplateText = Replace($TemplateText, "@tclassschedCountryID@", $tclassschedCountryID);
     $TemplateText = Replace($TemplateText, "@tclassschedBranchID@", $tclassschedBranchID);
     $TemplateText = Replace($TemplateText, "@tclassschedDay@", $tclassschedDay);
     $TemplateText = Replace($TemplateText, "@tclassschedTimeFrom@", $tclassschedTimeFrom);
     $TemplateText = Replace($TemplateText, "@tclassschedTimeTo@", $tclassschedTimeTo);
     $TemplateText = Replace($TemplateText, "@tclassschedLevelID@", $tclassschedLevelID);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherCnt@", $tclassschedTeacherCnt);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherID1@", $tclassschedTeacherID1);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherID2@", $tclassschedTeacherID2);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherID3@", $tclassschedTeacherID3);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherName1@", $tclassschedTeacherName1);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherName2@", $tclassschedTeacherName2);
     $TemplateText = Replace($TemplateText, "@tclassschedTeacherName3@", $tclassschedTeacherName3);
     $TemplateText = Replace($TemplateText, "@tclassschedRoomID@", $tclassschedRoomID);
     $TemplateText = Replace($TemplateText, "@tclassschedEnrollee@", $tclassschedEnrollee);
     $TemplateText = Replace($TemplateText, "@tclassschedAvailable@", $tclassschedAvailable);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@Header@", $Header);
     $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
     $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
     $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStclasssched = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
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
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetclasssched" . "edit.htm";
    endif;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
        print($TemplateText);
        exit();        
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
        print($TemplateText);
        exit();
    endif;  
}

$sql = "SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2, tclasssched.TeacherID3, tclasssched.TeacherName1, tclasssched.TeacherName2, tclasssched.TeacherName3, tclasssched.RoomID, tclasssched.Enrollee, tclasssched.Available  FROM  tclasssched WHERE  tclasssched.CountryID = '" . $ID1 . "'" . " AND tclasssched.BranchID = '" . $ID2 . "'" . " AND tclasssched.Day = '" . $ID3 . "'" . " AND tclasssched.TimeFrom = '" . $ID4 . "'";
$oRStclasssched = $objConn1->SelectLimit($sql,1);
if ($oRStclasssched->MoveFirst() == false):
    $oRStclasssched->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetclassschedFormAction = "Updatetclassschededitx.php";
$oRStclassschedCountryID = $oRStclasssched->fields["CountryID"];
$oRStclassschedBranchID = $oRStclasssched->fields["BranchID"];
$oRStclassschedDay = $oRStclasssched->fields["Day"];
$oRStclassschedTimeFrom = $oRStclasssched->fields["TimeFrom"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$tclassschedCountryID = "";
if (is_null($oRStclasssched->fields["CountryID"])):
$tclassschedCountryID = "";
else:
$tclassschedCountryID = trim(getValue($oRStclasssched->fields["CountryID"]));
endif;
$tclassschedBranchID = "";
if (is_null($oRStclasssched->fields["BranchID"])):
$tclassschedBranchID = "";
else:
$tclassschedBranchID = trim(getValue($oRStclasssched->fields["BranchID"]));
endif;
$tclassschedDay = "";
if (is_null($oRStclasssched->fields["Day"])):
$tclassschedDay = "";
else:
$tclassschedDay = trim(getValue($oRStclasssched->fields["Day"]));
endif;
$tclassschedTimeFrom = "";
if (is_null($oRStclasssched->fields["TimeFrom"])):
$tclassschedTimeFrom = "";
else:
$tclassschedTimeFrom = getValue($oRStclasssched->fields["TimeFrom"]);
endif;
$tclassschedTimeTo = "";
if (is_null($oRStclasssched->fields["TimeTo"])):
$tclassschedTimeTo = "";
else:
$tclassschedTimeTo = getValue($oRStclasssched->fields["TimeTo"]);
endif;
$tclassschedLevelID = "";
if (is_null($oRStclasssched->fields["LevelID"])):
$tclassschedLevelID = "";
else:
$tclassschedLevelID = getValue($oRStclasssched->fields["LevelID"]);
endif;
$tclassschedTeacherCnt = "";
if (is_null($oRStclasssched->fields["TeacherCnt"])):
$tclassschedTeacherCnt = "";
else:
$tclassschedTeacherCnt = getValue($oRStclasssched->fields["TeacherCnt"]);
endif;
$tclassschedTeacherID1 = "";
if (is_null($oRStclasssched->fields["TeacherID1"])):
$tclassschedTeacherID1 = "";
else:
$tclassschedTeacherID1 = getValue($oRStclasssched->fields["TeacherID1"]);
endif;
$tclassschedTeacherID2 = "";
if (is_null($oRStclasssched->fields["TeacherID2"])):
$tclassschedTeacherID2 = "";
else:
$tclassschedTeacherID2 = getValue($oRStclasssched->fields["TeacherID2"]);
endif;
$tclassschedTeacherID3 = "";
if (is_null($oRStclasssched->fields["TeacherID3"])):
$tclassschedTeacherID3 = "";
else:
$tclassschedTeacherID3 = getValue($oRStclasssched->fields["TeacherID3"]);
endif;
$tclassschedTeacherName1 = "";
if (is_null($oRStclasssched->fields["TeacherName1"])):
$tclassschedTeacherName1 = "";
else:
$tclassschedTeacherName1 = trim(getValue($oRStclasssched->fields["TeacherName1"]));
endif;
$tclassschedTeacherName2 = "";
if (is_null($oRStclasssched->fields["TeacherName2"])):
$tclassschedTeacherName2 = "";
else:
$tclassschedTeacherName2 = trim(getValue($oRStclasssched->fields["TeacherName2"]));
endif;
$tclassschedTeacherName3 = "";
if (is_null($oRStclasssched->fields["TeacherName3"])):
$tclassschedTeacherName3 = "";
else:
$tclassschedTeacherName3 = trim(getValue($oRStclasssched->fields["TeacherName3"]));
endif;
$tclassschedRoomID = "";
if (is_null($oRStclasssched->fields["RoomID"])):
$tclassschedRoomID = "";
else:
$tclassschedRoomID = getValue($oRStclasssched->fields["RoomID"]);
endif;
$tclassschedEnrollee = "";
if (is_null($oRStclasssched->fields["Enrollee"])):
$tclassschedEnrollee = "";
else:
$tclassschedEnrollee = getValue($oRStclasssched->fields["Enrollee"]);
endif;
$tclassschedAvailable = "";
if (is_null($oRStclasssched->fields["Available"])):
$tclassschedAvailable = "";
else:
$tclassschedAvailable = getValue($oRStclasssched->fields["Available"]);
endif;
$DeleteButton = "<form method='post' action='Updatetclassscheddel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatetclasssched_EditFailed"] == 1) {
  $tclassschedCountryID = $_SESSION["SavedEdittclassschedCountryID"];
  $tclassschedBranchID = $_SESSION["SavedEdittclassschedBranchID"];
  $tclassschedDay = $_SESSION["SavedEdittclassschedDay"];
  $tclassschedTimeFrom = $_SESSION["SavedEdittclassschedTimeFrom"];
  $tclassschedTimeTo = $_SESSION["SavedEdittclassschedTimeTo"];
  $tclassschedLevelID = $_SESSION["SavedEdittclassschedLevelID"];
  $tclassschedTeacherCnt = $_SESSION["SavedEdittclassschedTeacherCnt"];
  $tclassschedTeacherID1 = $_SESSION["SavedEdittclassschedTeacherID1"];
  $tclassschedTeacherID2 = $_SESSION["SavedEdittclassschedTeacherID2"];
  $tclassschedTeacherID3 = $_SESSION["SavedEdittclassschedTeacherID3"];
  $tclassschedTeacherName1 = $_SESSION["SavedEdittclassschedTeacherName1"];
  $tclassschedTeacherName2 = $_SESSION["SavedEdittclassschedTeacherName2"];
  $tclassschedTeacherName3 = $_SESSION["SavedEdittclassschedTeacherName3"];
  $tclassschedRoomID = $_SESSION["SavedEdittclassschedRoomID"];
  $tclassschedEnrollee = $_SESSION["SavedEdittclassschedEnrollee"];
  $tclassschedAvailable = $_SESSION["SavedEdittclassschedAvailable"];
}
else {
  $_SESSION["Updatetclasssched_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStclasssched);
$objConn1->Close();
unset($objConn1);
?>
<!------------------------------------------------------------------->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<!--@HTML_AFTER_OPEN@-->
<!--@HTML_AFTER_OPEN@-->
<head>
<!--@HEAD_AFTER_OPEN@-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="ROBOTS" Content="NONE">
<meta name="GENERATOR" Content="Clarion/WEB Templates by SoftVelocity, Inc. www.softvelocity.com">
<meta http-equiv="PRAGMA" content="NO-CACHE">
<meta http-equiv="CACHE-CONTROL" content="NO-CACHE">
<!-- -------------------------------------------------------------------------
** IMPORTANT NOTICE! **
Please do not rename any forms or form fields
Please do not re-order, move or rename any comment tags that delimit code sections
-------------------------------------------------------------------------  -->
<link rel="stylesheet" href="styles/MyStyles.css" type="text/css">
<script src="phpvalidate.js" LANGUAGE="JavaScript" type="text/javascript">
</script>
<script language="JavaScript" type="text/javascript">
<!--
var adjWidth  = 480;
var adjHeight = 120;
    if (navigator.appName == 'Netscape') {
        adjWidth = adjWidth + 16;
    }
    else {
        adjWidth = adjWidth + 46;
    }
var posL = (screen.width - adjWidth) / 2;
var posT = (screen.height - adjHeight) / 2;
function ShowHelp(myURL) {
    myURL = "help/" + myURL;
    var HelpStyle  = 'height='+adjHeight+',width='+adjWidth+',top='+posT+',left='+posL+',alwaysLowered=0,alwaysRaised=0,channelmode=0,dependent=0,directories=0,fullscreen=0,hotkeys=0,location=0,menubar=0,resizable=1,scrollbars=1,status=0,titlebar=1,toolbar=0,z-lock=0';
    var remote = open(myURL, "Help", HelpStyle);                  
    if (remote.opener == null) remote.opener = window;
}
var thispointer;
var selectWhere = "";
var data;
var proc;
var col;
var posL = (screen.width - 480) / 2;
var posT = (screen.height - 400) / 2;
var dataStyle  = 'height='+400+',width='+480+',top='+posT+',left='+posL+',alwaysLowered=0,alwaysRaised=0,channelmode=0,dependent=0,directories=0,fullscreen=0,hotkeys=0,location=0,menubar=0,resizable=1,scrollbars=0,status=0,titlebar=1,toolbar=0,z-lock=0';

function CleanWhere() {
  selectWhere = "";
}

function BuildWhere(pValue, pCol) {
  if (pValue.value) {
    if (selectWhere != "") {
      selectWhere = selectWhere + ' AND ' + pCol + ' = ' + pValue.value;
    }
    else {
      selectWhere = selectWhere + pCol + ' = ' + pValue.value;
    }
  }
}


// dataLookup(document.forms[0].txtWEBFieldName, procedure, datacol)
function dataLookup(caller,proc,col) {
    thispointer = caller;
    proc = proc + '';
    if (selectWhere != "") {
      proc = proc + "?WHR=" + selectWhere;
    }
    col = col + '';
    datawin=open(proc,'select',dataStyle);
    datawin.location.href = proc;
    if (datawin.opener == null) datawin.opener = self;
}

function dataRefresh(data) {
    thispointer.value = data;
    datawin.close();
}

function initAttributes() { 
    document.forms[0].txttclassschedCountryID.Label = "Country ID:";
    document.forms[0].txttclassschedCountryID.DataType = "STRING";
    document.forms[0].txttclassschedCountryID.SavedValue = document.forms[0].txttclassschedCountryID.value;
    document.forms[0].txttclassschedCountryID.Message = "";
    
    
    document.forms[0].txttclassschedBranchID.Label = "Branch ID:";
    document.forms[0].txttclassschedBranchID.DataType = "STRING";
    document.forms[0].txttclassschedBranchID.SavedValue = document.forms[0].txttclassschedBranchID.value;
    document.forms[0].txttclassschedBranchID.Message = "";
    
    
    document.forms[0].txttclassschedDay.Label = "Day:";
    document.forms[0].txttclassschedDay.DataType = "STRING";
    document.forms[0].txttclassschedDay.SavedValue = document.forms[0].txttclassschedDay.value;
    document.forms[0].txttclassschedDay.Message = "";
    
    
    document.forms[0].txttclassschedTimeFrom.Label = "Time From:";
    document.forms[0].txttclassschedTimeFrom.DataType = "TIME";
    document.forms[0].txttclassschedTimeFrom.SavedValue = document.forms[0].txttclassschedTimeFrom.value;
    document.forms[0].txttclassschedTimeFrom.Message = "";
    
    
    document.forms[0].txttclassschedTimeTo.Label = "Time To:";
    document.forms[0].txttclassschedTimeTo.DataType = "TIME";
    document.forms[0].txttclassschedTimeTo.SavedValue = document.forms[0].txttclassschedTimeTo.value;
    document.forms[0].txttclassschedTimeTo.Message = "";
    
    
    document.forms[0].txttclassschedLevelID.Label = "Level ID:";
    document.forms[0].txttclassschedLevelID.DataType = "NUMERIC";
    document.forms[0].txttclassschedLevelID.SavedValue = document.forms[0].txttclassschedLevelID.value;
    document.forms[0].txttclassschedLevelID.Places = 0;
    document.forms[0].txttclassschedLevelID.Message = "";
    
    
    document.forms[0].txttclassschedTeacherCnt.Label = "Teacher Cnt:";
    document.forms[0].txttclassschedTeacherCnt.DataType = "NUMERIC";
    document.forms[0].txttclassschedTeacherCnt.SavedValue = document.forms[0].txttclassschedTeacherCnt.value;
    document.forms[0].txttclassschedTeacherCnt.Places = 0;
    document.forms[0].txttclassschedTeacherCnt.Message = "";
    
    
    document.forms[0].txttclassschedTeacherID1.Label = "Teacher ID 1:";
    document.forms[0].txttclassschedTeacherID1.DataType = "NUMERIC";
    document.forms[0].txttclassschedTeacherID1.SavedValue = document.forms[0].txttclassschedTeacherID1.value;
    document.forms[0].txttclassschedTeacherID1.Places = 0;
    document.forms[0].txttclassschedTeacherID1.Message = "";
    
    
    document.forms[0].txttclassschedTeacherID2.Label = "Teacher ID 2:";
    document.forms[0].txttclassschedTeacherID2.DataType = "NUMERIC";
    document.forms[0].txttclassschedTeacherID2.SavedValue = document.forms[0].txttclassschedTeacherID2.value;
    document.forms[0].txttclassschedTeacherID2.Places = 0;
    document.forms[0].txttclassschedTeacherID2.Message = "";
    
    
    document.forms[0].txttclassschedTeacherID3.Label = "Teacher ID 3:";
    document.forms[0].txttclassschedTeacherID3.DataType = "NUMERIC";
    document.forms[0].txttclassschedTeacherID3.SavedValue = document.forms[0].txttclassschedTeacherID3.value;
    document.forms[0].txttclassschedTeacherID3.Places = 0;
    document.forms[0].txttclassschedTeacherID3.Message = "";
    
    
    document.forms[0].txttclassschedTeacherName1.Label = "Teacher Name 1:";
    document.forms[0].txttclassschedTeacherName1.DataType = "STRING";
    document.forms[0].txttclassschedTeacherName1.SavedValue = document.forms[0].txttclassschedTeacherName1.value;
    document.forms[0].txttclassschedTeacherName1.Message = "";
    
    
    document.forms[0].txttclassschedTeacherName2.Label = "Teacher Name 2:";
    document.forms[0].txttclassschedTeacherName2.DataType = "STRING";
    document.forms[0].txttclassschedTeacherName2.SavedValue = document.forms[0].txttclassschedTeacherName2.value;
    document.forms[0].txttclassschedTeacherName2.Message = "";
    
    
    document.forms[0].txttclassschedTeacherName3.Label = "Teacher Name 3:";
    document.forms[0].txttclassschedTeacherName3.DataType = "STRING";
    document.forms[0].txttclassschedTeacherName3.SavedValue = document.forms[0].txttclassschedTeacherName3.value;
    document.forms[0].txttclassschedTeacherName3.Message = "";
    
    
    document.forms[0].txttclassschedRoomID.Label = "Room ID:";
    document.forms[0].txttclassschedRoomID.DataType = "NUMERIC";
    document.forms[0].txttclassschedRoomID.SavedValue = document.forms[0].txttclassschedRoomID.value;
    document.forms[0].txttclassschedRoomID.Places = 0;
    document.forms[0].txttclassschedRoomID.Message = "";
    
    
    document.forms[0].txttclassschedEnrollee.Label = "Enrollee:";
    document.forms[0].txttclassschedEnrollee.DataType = "NUMERIC";
    document.forms[0].txttclassschedEnrollee.SavedValue = document.forms[0].txttclassschedEnrollee.value;
    document.forms[0].txttclassschedEnrollee.Places = 0;
    document.forms[0].txttclassschedEnrollee.Message = "";
    
    
    document.forms[0].txttclassschedAvailable.Label = "Available:";
    document.forms[0].txttclassschedAvailable.DataType = "NUMERIC";
    document.forms[0].txttclassschedAvailable.SavedValue = document.forms[0].txttclassschedAvailable.value;
    document.forms[0].txttclassschedAvailable.Places = 0;
    document.forms[0].txttclassschedAvailable.Message = "";
    
    
}

//-->
</script>
<!--@HEAD_AFTER_OPEN@-->
<title>Edit Record</title>
<!--@HEAD_BEFORE_CLOSE@-->
</head>
    <body onload="JAVASCRIPT:initAttributes();return false;"  onhelp="JAVASCRIPT:ShowHelp('UpdatetclassschedEditHelp.htm');return false;">
<!--@BODY_AFTER_OPEN@-->
<!--@BG_BEFORE_OPEN@-->
<form method="post" action="@UpdatetclassschedFormAction@"  id="form1" name="form1">
<input type="hidden" id="ID1" name="ID1" value="@ID1@">
<input type="hidden" id="ID2" name="ID2" value="@ID2@">
<input type="hidden" id="ID3" name="ID3" value="@ID3@">
<input type="hidden" id="ID4" name="ID4" value="@ID4@">
    <div class="BG">
    <!--@BG_AFTER_OPEN@-->
      <table class="Data" cellspacing="0" width="100%">
        <tr>   
          <td ALIGN="left"  VALIGN="top" WIDTH="40%" class="Header">Edit Record</td>
          <td ALIGN="right" VALIGN="top" class="Header">&nbsp;
          <a href="JAVASCRIPT:ShowHelp('UpdatetclassschedEditHelp.htm');"><img alt="Help" src="/images/help.gif" border=0 height=20 width=20></A><A href="JAVASCRIPT:history.back();"><IMG alt="Back" src="/images/back.gif" border=0 height=20 width=20></a>
          </td>          
        </tr>
                    <tr>
                        <td class="Label">Country ID: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedCountryID" name="txttclassschedCountryID" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedCountryID); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedCountryID); fieldExit(this);" title="" SIZE=30 value="@tclassschedCountryID@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedCountryID,'Browsetcountrylist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Branch ID: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedBranchID" name="txttclassschedBranchID" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedBranchID); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedBranchID); fieldExit(this);" title="" SIZE=30 value="@tclassschedBranchID@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedBranchID,'Browsetbranchlist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Day: 
                      *
                      </td>
                      <td class="Input"><input id="txttclassschedDay" name="txttclassschedDay" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedDay); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedDay); fieldExit(this);" title="" SIZE=30 value="@tclassschedDay@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Time From: 
                      *
                      </td>
                      <td class="Input"><input id="txttclassschedTimeFrom" name="txttclassschedTimeFrom" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTimeFrom); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTimeFrom); fieldExit(this);" title="" SIZE=30 value="@tclassschedTimeFrom@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Time To: 
                      *
                      </td>
                      <td class="Input"><input id="txttclassschedTimeTo" name="txttclassschedTimeTo" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTimeTo); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTimeTo); fieldExit(this);" title="" SIZE=30 value="@tclassschedTimeTo@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Level ID: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedLevelID" name="txttclassschedLevelID" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedLevelID); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedLevelID); fieldExit(this);" title="" SIZE=30 value="@tclassschedLevelID@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedLevelID,'BrowseLevellist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher Cnt: 
                      </td>
                      <td class="Input"><input id="txttclassschedTeacherCnt" name="txttclassschedTeacherCnt" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherCnt); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherCnt); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherCnt@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher ID 1: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedTeacherID1" name="txttclassschedTeacherID1" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherID1); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherID1); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherID1@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedTeacherID1,'BrowseTeacherlist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher ID 2: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedTeacherID2" name="txttclassschedTeacherID2" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherID2); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherID2); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherID2@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedTeacherID2,'BrowseTeacherlist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher ID 3: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedTeacherID3" name="txttclassschedTeacherID3" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherID3); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherID3); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherID3@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedTeacherID3,'BrowseTeacherlist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher Name 1: 
                      </td>
                      <td class="Input"><input id="txttclassschedTeacherName1" name="txttclassschedTeacherName1" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherName1); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherName1); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherName1@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher Name 2: 
                      </td>
                      <td class="Input"><input id="txttclassschedTeacherName2" name="txttclassschedTeacherName2" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherName2); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherName2); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherName2@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Teacher Name 3: 
                      </td>
                      <td class="Input"><input id="txttclassschedTeacherName3" name="txttclassschedTeacherName3" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedTeacherName3); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedTeacherName3); fieldExit(this);" title="" SIZE=30 value="@tclassschedTeacherName3@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Room ID: 
                      *
                      </td>
            
                      <td class="Input"><input id="txttclassschedRoomID" name="txttclassschedRoomID" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedRoomID); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedRoomID); fieldExit(this);" title="" SIZE=30 value="@tclassschedRoomID@"><a href="JAVASCRIPT:CleanWhere();;dataLookup(document.forms[0].txttclassschedRoomID,'BrowseRoomlist.php','');"><img src="/images/ellipsis.gif" border="0" height="20" width="20" alt="Lookup"></a>&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Enrollee: 
                      </td>
                      <td class="Input"><input id="txttclassschedEnrollee" name="txttclassschedEnrollee" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedEnrollee); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedEnrollee); fieldExit(this);" title="" SIZE=30 value="@tclassschedEnrollee@">&nbsp;
                      </td>
                    </tr>
                    <tr>
                        <td class="Label">Available: 
                      </td>
                      <td class="Input"><input id="txttclassschedAvailable" name="txttclassschedAvailable" onfocus="JAVASCRIPT:setMessage(document.forms[0].txttclassschedAvailable); fieldEnter(this);" onblur="JAVASCRIPT:validate(document.forms[0].txttclassschedAvailable); fieldExit(this);" title="" SIZE=30 value="@tclassschedAvailable@">&nbsp;
                      </td>
                    </tr>
    <tr>
      <td colspan="2" align="center" class='Footer'>
      <input type='submit' value='Submit' title='Submit this form' ><input type='reset' value='Reset' title='Reset changes'>
      </td>                
    </tr>
    </table>
    <!--@BG_BEFORE_CLOSE@-->    
    </div>
</form>
    @DeleteButton@
<!--@BG_AFTER_CLOSE@-->
<!--@BODY_BEFORE_CLOSE@-->
</body>
<!--@HTML_BEFORE_CLOSE@-->
</html>
