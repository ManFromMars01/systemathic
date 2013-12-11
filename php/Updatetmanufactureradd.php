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
include('template/myclass.php');
not_login();
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
    global $UpdatetmanufacturerFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetmanufactureradd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetmanufacturerFormAction@",$UpdatetmanufacturerFormAction);    
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

    global $tmanufacturerCountryID;
    $TemplateText = Replace($TemplateText,"@tmanufacturerCountryID@",$tmanufacturerCountryID);            
    global $tmanufacturerBranchID;
    $TemplateText = Replace($TemplateText,"@tmanufacturerBranchID@",$tmanufacturerBranchID);            
    global $tmanufacturerID;
    $TemplateText = Replace($TemplateText,"@tmanufacturerID@",$tmanufacturerID);            
    global $tmanufacturerDescription;
    $TemplateText = Replace($TemplateText,"@tmanufacturerDescription@",$tmanufacturerDescription);            
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

$UpdatetmanufacturerFormAction = "Updatetmanufactureraddx.php";
$tmanufacturerCountryID  = getRequest("txttmanufacturerCountryID");
$tmanufacturerBranchID  = getRequest("txttmanufacturerBranchID");
$tmanufacturerID  = getRequest("txttmanufacturerID");
$tmanufacturerDescription  = getRequest("txttmanufacturerDescription");

if ($_SESSION["Updatetmanufacturer_InsertFailed"] == 1) {
   $tmanufacturerCountryID = $_SESSION["SavedtmanufacturerCountryID"];
   $tmanufacturerBranchID = $_SESSION["SavedtmanufacturerBranchID"];
   $tmanufacturerID = $_SESSION["SavedtmanufacturerID"];
   $tmanufacturerDescription = $_SESSION["SavedtmanufacturerDescription"];
}

MergeAddTemplate($HTML_Template);
unset($oRStmanufacturer);
$objConn1->Close();
unset($objConn1);
?>
