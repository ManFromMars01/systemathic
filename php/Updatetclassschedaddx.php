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
            if (getForm("txttclassschedCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"tclasssched","CountryID","txttclassschedCountryID");
            if (getForm("txttclassschedBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"tclasssched","BranchID","txttclassschedBranchID");
            if (getForm("txttclassschedDay") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Day:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Monday;Tuesday;Wednesday;Thursday;Friday;Saturday;Sunday <HR>\n";
            endif;
    $rst["Day"] = getFormSQLQuoted($objConn1,"tclasssched","Day","txttclassschedDay");
            if (getForm("txttclassschedTimeFrom") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Time From:</STRONG> : Required field <HR>\n";
            endif;
    $rst["TimeFrom"] = getFormSQLQuoted($objConn1,"tclasssched","TimeFrom","txttclassschedTimeFrom");
            if (getForm("txttclassschedTimeTo") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Time To:</STRONG> : Required field <HR>\n";
            endif;
    $rst["TimeTo"] = getFormSQLQuoted($objConn1,"tclasssched","TimeTo","txttclassschedTimeTo");
            if (getForm("txttclassschedLevelID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Level ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["LevelID"] = getFormSQLQuoted($objConn1,"tclasssched","LevelID","txttclassschedLevelID");
    $rst["TeacherCnt"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherCnt","txttclassschedTeacherCnt");
            if (getForm("txttclassschedTeacherID1") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teacher ID 1:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacherID1"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherID1","txttclassschedTeacherID1");
            if (getForm("txttclassschedTeacherID2") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teacher ID 2:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacherID2"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherID2","txttclassschedTeacherID2");
            if (getForm("txttclassschedTeacherID3") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teacher ID 3:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacherID3"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherID3","txttclassschedTeacherID3");
    $rst["TeacherName1"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherName1","txttclassschedTeacherName1");
    $rst["TeacherName2"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherName2","txttclassschedTeacherName2");
    $rst["TeacherName3"] = getFormSQLQuoted($objConn1,"tclasssched","TeacherName3","txttclassschedTeacherName3");
            if (getForm("txttclassschedRoomID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Room ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["RoomID"] = getFormSQLQuoted($objConn1,"tclasssched","RoomID","txttclassschedRoomID");
    $rst["Enrollee"] = getFormSQLQuoted($objConn1,"tclasssched","Enrollee","txttclassschedEnrollee");
    $rst["Available"] = getFormSQLQuoted($objConn1,"tclasssched","Available","txttclassschedAvailable");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into tclasssched (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStclasssched = $objConn1->Execute($sql);

  if (!isset($oRStclasssched) || $oRStclasssched == false || $oRStclasssched == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
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
  $_SESSION["Updatetclasssched_InsertFailed"] = 1;
  $_SESSION["SavedtclassschedCountryID"] = $_POST["txttclassschedCountryID"];
  $_SESSION["SavedtclassschedBranchID"] = $_POST["txttclassschedBranchID"];
  $_SESSION["SavedtclassschedDay"] = $_POST["txttclassschedDay"];
  $_SESSION["SavedtclassschedTimeFrom"] = $_POST["txttclassschedTimeFrom"];
  $_SESSION["SavedtclassschedTimeTo"] = $_POST["txttclassschedTimeTo"];
  $_SESSION["SavedtclassschedLevelID"] = $_POST["txttclassschedLevelID"];
  $_SESSION["SavedtclassschedTeacherCnt"] = $_POST["txttclassschedTeacherCnt"];
  $_SESSION["SavedtclassschedTeacherID1"] = $_POST["txttclassschedTeacherID1"];
  $_SESSION["SavedtclassschedTeacherID2"] = $_POST["txttclassschedTeacherID2"];
  $_SESSION["SavedtclassschedTeacherID3"] = $_POST["txttclassschedTeacherID3"];
  $_SESSION["SavedtclassschedTeacherName1"] = $_POST["txttclassschedTeacherName1"];
  $_SESSION["SavedtclassschedTeacherName2"] = $_POST["txttclassschedTeacherName2"];
  $_SESSION["SavedtclassschedTeacherName3"] = $_POST["txttclassschedTeacherName3"];
  $_SESSION["SavedtclassschedRoomID"] = $_POST["txttclassschedRoomID"];
  $_SESSION["SavedtclassschedEnrollee"] = $_POST["txttclassschedEnrollee"];
  $_SESSION["SavedtclassschedAvailable"] = $_POST["txttclassschedAvailable"];
}
else {
  $_SESSION["Updatetclasssched_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";


MergeAddTemplate($HTML_Template);
unset($oRStclasssched) ;
$objConn1->Close();
unset($objConn1);
?> 
