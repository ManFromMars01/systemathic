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
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetclassscheddel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

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
