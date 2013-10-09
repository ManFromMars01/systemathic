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
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttclassschedCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.CountryID LIKE " . chr(39) . getRequest("txttclassschedCountryID") . "%" . chr(39);
endif;

if (getRequest("txttclassschedBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.BranchID LIKE " . chr(39) . getRequest("txttclassschedBranchID") . "%" . chr(39);
endif;

if (getRequest("txttclassschedDay") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.Day LIKE " . chr(39) . getRequest("txttclassschedDay") . "%" . chr(39);
endif;

if (getRequest("txttclassschedTimeFrom") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TimeFrom = " . getRequest("txttclassschedTimeFrom");
endif;

if (getRequest("txttclassschedTimeTo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TimeTo = " . getRequest("txttclassschedTimeTo");
endif;

if (getRequest("txttclassschedLevelID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.LevelID = " . getRequest("txttclassschedLevelID");
endif;

if (getRequest("txttclassschedTeacherCnt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherCnt = " . getRequest("txttclassschedTeacherCnt");
endif;

if (getRequest("txttclassschedTeacherID1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherID1 = " . getRequest("txttclassschedTeacherID1");
endif;

if (getRequest("txttclassschedTeacherID2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherID2 = " . getRequest("txttclassschedTeacherID2");
endif;

if (getRequest("txttclassschedTeacherID3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherID3 = " . getRequest("txttclassschedTeacherID3");
endif;

if (getRequest("txttclassschedTeacherName1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherName1 LIKE " . chr(39) . getRequest("txttclassschedTeacherName1") . "%" . chr(39);
endif;

if (getRequest("txttclassschedTeacherName2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherName2 LIKE " . chr(39) . getRequest("txttclassschedTeacherName2") . "%" . chr(39);
endif;

if (getRequest("txttclassschedTeacherName3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.TeacherName3 LIKE " . chr(39) . getRequest("txttclassschedTeacherName3") . "%" . chr(39);
endif;

if (getRequest("txttclassschedRoomID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.RoomID = " . getRequest("txttclassschedRoomID");
endif;

if (getRequest("txttclassschedEnrollee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.Enrollee = " . getRequest("txttclassschedEnrollee");
endif;

if (getRequest("txttclassschedAvailable") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tclasssched.Available = " . getRequest("txttclassschedAvailable");
endif;
$_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseAttendanceStatuslist.php");
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
$oRStclasssched = "";


$TemplateText = "";

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
        $Template = "./html/Updatetclasssched" . "search.htm";
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
    global $tclassschedCountryID;
    $TemplateText = Replace($TemplateText, "@tclassschedCountryID@", $tclassschedCountryID);
    global $tclassschedBranchID;
    $TemplateText = Replace($TemplateText, "@tclassschedBranchID@", $tclassschedBranchID);
    global $tclassschedDay;
    $TemplateText = Replace($TemplateText, "@tclassschedDay@", $tclassschedDay);
    global $tclassschedTimeFrom;
    $TemplateText = Replace($TemplateText, "@tclassschedTimeFrom@", $tclassschedTimeFrom);
    global $tclassschedTimeTo;
    $TemplateText = Replace($TemplateText, "@tclassschedTimeTo@", $tclassschedTimeTo);
    global $tclassschedLevelID;
    $TemplateText = Replace($TemplateText, "@tclassschedLevelID@", $tclassschedLevelID);
    global $tclassschedTeacherCnt;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherCnt@", $tclassschedTeacherCnt);
    global $tclassschedTeacherID1;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherID1@", $tclassschedTeacherID1);
    global $tclassschedTeacherID2;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherID2@", $tclassschedTeacherID2);
    global $tclassschedTeacherID3;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherID3@", $tclassschedTeacherID3);
    global $tclassschedTeacherName1;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherName1@", $tclassschedTeacherName1);
    global $tclassschedTeacherName2;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherName2@", $tclassschedTeacherName2);
    global $tclassschedTeacherName3;
    $TemplateText = Replace($TemplateText, "@tclassschedTeacherName3@", $tclassschedTeacherName3);
    global $tclassschedRoomID;
    $TemplateText = Replace($TemplateText, "@tclassschedRoomID@", $tclassschedRoomID);
    global $tclassschedEnrollee;
    $TemplateText = Replace($TemplateText, "@tclassschedEnrollee@", $tclassschedEnrollee);
    global $tclassschedAvailable;
    $TemplateText = Replace($TemplateText, "@tclassschedAvailable@", $tclassschedAvailable);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAttendanceStatuslist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetclasssched" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStclasssched);
ob_flush();
?>
