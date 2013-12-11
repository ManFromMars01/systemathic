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
$HTML_Template = getRequest("HTMLT");
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdatetclassschedFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetclassschedadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetclassschedFormAction@",$UpdatetclassschedFormAction);    
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

    global $tclassschedCountryID;
    $TemplateText = Replace($TemplateText,"@tclassschedCountryID@",$tclassschedCountryID);            
    global $tclassschedBranchID;
    $TemplateText = Replace($TemplateText,"@tclassschedBranchID@",$tclassschedBranchID);            
    global $tclassschedDay;
    $TemplateText = Replace($TemplateText,"@tclassschedDay@",$tclassschedDay);            
    global $tclassschedTimeFrom;
    $TemplateText = Replace($TemplateText,"@tclassschedTimeFrom@",$tclassschedTimeFrom);            
    global $tclassschedTimeTo;
    $TemplateText = Replace($TemplateText,"@tclassschedTimeTo@",$tclassschedTimeTo);            
    global $tclassschedLevelID;
    $TemplateText = Replace($TemplateText,"@tclassschedLevelID@",$tclassschedLevelID);            
    global $tclassschedTeacherCnt;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherCnt@",$tclassschedTeacherCnt);            
    global $tclassschedTeacherID1;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID1@",$tclassschedTeacherID1);            
    global $tclassschedTeacherID2;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID2@",$tclassschedTeacherID2);            
    global $tclassschedTeacherID3;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherID3@",$tclassschedTeacherID3);            
    global $tclassschedTeacherName1;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName1@",$tclassschedTeacherName1);            
    global $tclassschedTeacherName2;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName2@",$tclassschedTeacherName2);            
    global $tclassschedTeacherName3;
    $TemplateText = Replace($TemplateText,"@tclassschedTeacherName3@",$tclassschedTeacherName3);            
    global $tclassschedRoomID;
    $TemplateText = Replace($TemplateText,"@tclassschedRoomID@",$tclassschedRoomID);            
    global $tclassschedEnrollee;
    $TemplateText = Replace($TemplateText,"@tclassschedEnrollee@",$tclassschedEnrollee);            
    global $tclassschedAvailable;
    $TemplateText = Replace($TemplateText,"@tclassschedAvailable@",$tclassschedAvailable);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);

   include('template/variables3.php');

    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdatetclassschedFormAction = "Updatetclassschedaddx.php";
$tclassschedCountryID  = getRequest("txttclassschedCountryID");
$tclassschedBranchID  = getRequest("txttclassschedBranchID");
$tclassschedDay  = getRequest("txttclassschedDay");
$tclassschedTimeFrom  = getRequest("txttclassschedTimeFrom");
$tclassschedTimeTo  = getRequest("txttclassschedTimeTo");
$tclassschedLevelID  = getRequest("txttclassschedLevelID");
$tclassschedTeacherCnt  = getRequest("txttclassschedTeacherCnt");
$tclassschedTeacherID1  = getRequest("txttclassschedTeacherID1");
$tclassschedTeacherID2  = getRequest("txttclassschedTeacherID2");
$tclassschedTeacherID3  = getRequest("txttclassschedTeacherID3");
$tclassschedTeacherName1  = getRequest("txttclassschedTeacherName1");
$tclassschedTeacherName2  = getRequest("txttclassschedTeacherName2");
$tclassschedTeacherName3  = getRequest("txttclassschedTeacherName3");
$tclassschedRoomID  = getRequest("txttclassschedRoomID");
$tclassschedEnrollee  = getRequest("txttclassschedEnrollee");
$tclassschedAvailable  = getRequest("txttclassschedAvailable");

if ($_SESSION["Updatetclasssched_InsertFailed"] == 1) {
   $tclassschedCountryID = $_SESSION["SavedtclassschedCountryID"];
   $tclassschedBranchID = $_SESSION["SavedtclassschedBranchID"];
   $tclassschedDay = $_SESSION["SavedtclassschedDay"];
   $tclassschedTimeFrom = $_SESSION["SavedtclassschedTimeFrom"];
   $tclassschedTimeTo = $_SESSION["SavedtclassschedTimeTo"];
   $tclassschedLevelID = $_SESSION["SavedtclassschedLevelID"];
   $tclassschedTeacherCnt = $_SESSION["SavedtclassschedTeacherCnt"];
   $tclassschedTeacherID1 = $_SESSION["SavedtclassschedTeacherID1"];
   $tclassschedTeacherID2 = $_SESSION["SavedtclassschedTeacherID2"];
   $tclassschedTeacherID3 = $_SESSION["SavedtclassschedTeacherID3"];
   $tclassschedTeacherName1 = $_SESSION["SavedtclassschedTeacherName1"];
   $tclassschedTeacherName2 = $_SESSION["SavedtclassschedTeacherName2"];
   $tclassschedTeacherName3 = $_SESSION["SavedtclassschedTeacherName3"];
   $tclassschedRoomID = $_SESSION["SavedtclassschedRoomID"];
   $tclassschedEnrollee = $_SESSION["SavedtclassschedEnrollee"];
   $tclassschedAvailable = $_SESSION["SavedtclassschedAvailable"];
}

MergeAddTemplate($HTML_Template);
unset($oRStclasssched);
$objConn1->Close();
unset($objConn1);
?>
