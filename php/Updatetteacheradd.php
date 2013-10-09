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
$HTML_Template = getRequest("HTMLT");
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdatetteacherFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetteacheradd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetteacherFormAction@",$UpdatetteacherFormAction);    
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

    global $tteacherCountryID;
    $TemplateText = Replace($TemplateText,"@tteacherCountryID@",$tteacherCountryID);            
    global $tteacherBranchID;
    $TemplateText = Replace($TemplateText,"@tteacherBranchID@",$tteacherBranchID);            
    global $tteacherID;
    $TemplateText = Replace($TemplateText,"@tteacherID@",$tteacherID);            
    global $tteacherPassword;
    $TemplateText = Replace($TemplateText,"@tteacherPassword@",$tteacherPassword);            
    global $tteacherName;
    $TemplateText = Replace($TemplateText,"@tteacherName@",$tteacherName);            
    global $tteacherLocalName;
    $TemplateText = Replace($TemplateText,"@tteacherLocalName@",$tteacherLocalName);            
    global $tteacherDateStart;
    $TemplateText = Replace($TemplateText,"@tteacherDateStart@",$tteacherDateStart);            
    global $tteacherPhoneNo;
    $TemplateText = Replace($TemplateText,"@tteacherPhoneNo@",$tteacherPhoneNo);            
    global $tteacherMobileNo;
    $TemplateText = Replace($TemplateText,"@tteacherMobileNo@",$tteacherMobileNo);            
    global $tteacherEmail;
    $TemplateText = Replace($TemplateText,"@tteacherEmail@",$tteacherEmail);            
    global $tteacherStatus;
    $TemplateText = Replace($TemplateText,"@tteacherStatus@",$tteacherStatus);            
    global $tteacherRoleID;
    $TemplateText = Replace($TemplateText,"@tteacherRoleID@",$tteacherRoleID);            
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

$UpdatetteacherFormAction = "Updatetteacheraddx.php";
$tteacherCountryID  = getRequest("txttteacherCountryID");
$tteacherBranchID  = getRequest("txttteacherBranchID");
$tteacherID  = getRequest("txttteacherID");
$tteacherPassword  = getRequest("txttteacherPassword");
$tteacherName  = getRequest("txttteacherName");
$tteacherLocalName  = getRequest("txttteacherLocalName");
$tteacherDateStart  = getRequest("txttteacherDateStart");
$tteacherPhoneNo  = getRequest("txttteacherPhoneNo");
$tteacherMobileNo  = getRequest("txttteacherMobileNo");
$tteacherEmail  = getRequest("txttteacherEmail");
$tteacherStatus  = getRequest("txttteacherStatus");
$tteacherRoleID  = getRequest("txttteacherRoleID");

if ($_SESSION["Updatetteacher_InsertFailed"] == 1) {
   $tteacherCountryID = $_SESSION["SavedtteacherCountryID"];
   $tteacherBranchID = $_SESSION["SavedtteacherBranchID"];
   $tteacherID = $_SESSION["SavedtteacherID"];
   $tteacherPassword = $_SESSION["SavedtteacherPassword"];
   $tteacherName = $_SESSION["SavedtteacherName"];
   $tteacherLocalName = $_SESSION["SavedtteacherLocalName"];
   $tteacherDateStart = $_SESSION["SavedtteacherDateStart"];
   $tteacherPhoneNo = $_SESSION["SavedtteacherPhoneNo"];
   $tteacherMobileNo = $_SESSION["SavedtteacherMobileNo"];
   $tteacherEmail = $_SESSION["SavedtteacherEmail"];
   $tteacherStatus = $_SESSION["SavedtteacherStatus"];
   $tteacherRoleID = $_SESSION["SavedtteacherRoleID"];
}

MergeAddTemplate($HTML_Template);
unset($oRStteacher);
$objConn1->Close();
unset($objConn1);
?>
