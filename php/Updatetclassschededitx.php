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
$sql = "SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2, tclasssched.TeacherID3, tclasssched.TeacherName1, tclasssched.TeacherName2, tclasssched.TeacherName3, tclasssched.RoomID, tclasssched.Enrollee, tclasssched.Available  FROM  tclasssched WHERE  tclasssched.CountryID = '" . $ID1 . "'" . " AND tclasssched.BranchID = '" . $ID2 . "'" . " AND tclasssched.Day = '" . $ID3 . "'" . " AND tclasssched.TimeFrom = '" . $ID4 . "'";
$oRStclasssched = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStclasssched = array();
if (!$oRStclasssched):
    $oRStclasssched->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttclassschedCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStclasssched["CountryID"] = getFormSQLQuoted($objConn1, "tclasssched", "CountryID", "txttclassschedCountryID");
        if (getRequest("txttclassschedBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStclasssched["BranchID"] = getFormSQLQuoted($objConn1, "tclasssched", "BranchID", "txttclassschedBranchID");
        if (getRequest("txttclassschedDay") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Day:</strong> : Must be in list ";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday <hr>\n";
        endif;
$arrayoRStclasssched["Day"] = getFormSQLQuoted($objConn1, "tclasssched", "Day", "txttclassschedDay");
        if (getRequest("txttclassschedTimeFrom") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Time From:</strong> : Required field <hr>\n";
        endif;
$arrayoRStclasssched["TimeFrom"] = getFormSQLQuoted($objConn1, "tclasssched", "TimeFrom", "txttclassschedTimeFrom");
        if (getRequest("txttclassschedTimeTo") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Time To:</strong> : Required field <hr>\n";
        endif;
$arrayoRStclasssched["TimeTo"] = getFormSQLQuoted($objConn1, "tclasssched", "TimeTo", "txttclassschedTimeTo");
        if (getRequest("txttclassschedLevelID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Level ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStclasssched["LevelID"] = getFormSQLQuoted($objConn1, "tclasssched", "LevelID", "txttclassschedLevelID");
$arrayoRStclasssched["TeacherCnt"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherCnt", "txttclassschedTeacherCnt");
        
$arrayoRStclasssched["TeacherID1"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherID1", "txttclassschedTeacherID1");
        
$arrayoRStclasssched["TeacherID2"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherID2", "txttclassschedTeacherID2");
        
$arrayoRStclasssched["TeacherID3"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherID3", "txttclassschedTeacherID3");
$arrayoRStclasssched["TeacherName1"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherName1", "txttclassschedTeacherName1");
$arrayoRStclasssched["TeacherName2"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherName2", "txttclassschedTeacherName2");
$arrayoRStclasssched["TeacherName3"] = getFormSQLQuoted($objConn1, "tclasssched", "TeacherName3", "txttclassschedTeacherName3");
        
$arrayoRStclasssched["RoomID"] = getFormSQLQuoted($objConn1, "tclasssched", "RoomID", "txttclassschedRoomID");
$arrayoRStclasssched["Enrollee"] = getFormSQLQuoted($objConn1, "tclasssched", "Enrollee", "txttclassschedEnrollee");
$arrayoRStclasssched["Available"] = getFormSQLQuoted($objConn1, "tclasssched", "Available", "txttclassschedAvailable");
$tsql = $objConn1->GetUpdateSQL($oRStclasssched, $arrayoRStclasssched, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tclasssched" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStclasssched as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tclasssched" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStclasssched->Close();
unset($oRStclasssched);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseAttendanceStatus#WHR")<>""):
        $myStatus .= "<a href='BrowseAttendanceStatuslist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseAttendanceStatuslist.php'>Return to list</a>.";
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
  $_SESSION["Updatetclasssched_EditFailed"] = 1;
  $_SESSION["SavedEdittclassschedCountryID"] = $_POST["txttclassschedCountryID"];
  $_SESSION["SavedEdittclassschedBranchID"] = $_POST["txttclassschedBranchID"];
  $_SESSION["SavedEdittclassschedDay"] = $_POST["txttclassschedDay"];
  $_SESSION["SavedEdittclassschedTimeFrom"] = $_POST["txttclassschedTimeFrom"];
  $_SESSION["SavedEdittclassschedTimeTo"] = $_POST["txttclassschedTimeTo"];
  $_SESSION["SavedEdittclassschedLevelID"] = $_POST["txttclassschedLevelID"];
  $_SESSION["SavedEdittclassschedTeacherCnt"] = $_POST["txttclassschedTeacherCnt"];
  $_SESSION["SavedEdittclassschedTeacherID1"] = $_POST["txttclassschedTeacherID1"];
  $_SESSION["SavedEdittclassschedTeacherID2"] = $_POST["txttclassschedTeacherID2"];
  $_SESSION["SavedEdittclassschedTeacherID3"] = $_POST["txttclassschedTeacherID3"];
  $_SESSION["SavedEdittclassschedTeacherName1"] = $_POST["txttclassschedTeacherName1"];
  $_SESSION["SavedEdittclassschedTeacherName2"] = $_POST["txttclassschedTeacherName2"];
  $_SESSION["SavedEdittclassschedTeacherName3"] = $_POST["txttclassschedTeacherName3"];
  $_SESSION["SavedEdittclassschedRoomID"] = $_POST["txttclassschedRoomID"];
  $_SESSION["SavedEdittclassschedEnrollee"] = $_POST["txttclassschedEnrollee"];
  $_SESSION["SavedEdittclassschedAvailable"] = $_POST["txttclassschedAvailable"];
}
else {
  $_SESSION["Updatetclasssched_EditFailed"] = 0;
}

$success = array('success' => $myStatus );
echo json_encode($success);
//MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
