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
    global $UpdatetdiscountFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetdiscountadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetdiscountFormAction@",$UpdatetdiscountFormAction);    
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

    global $tdiscountCountryID;
    $TemplateText = Replace($TemplateText,"@tdiscountCountryID@",$tdiscountCountryID);            
    global $tdiscountBranchID;
    $TemplateText = Replace($TemplateText,"@tdiscountBranchID@",$tdiscountBranchID);            
    global $tdiscountCode;
    $TemplateText = Replace($TemplateText,"@tdiscountCode@",$tdiscountCode);            
    global $tdiscountDescription;
    $TemplateText = Replace($TemplateText,"@tdiscountDescription@",$tdiscountDescription);            
    global $tdiscountDiscount;
    $TemplateText = Replace($TemplateText,"@tdiscountDiscount@",$tdiscountDiscount);            
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

$UpdatetdiscountFormAction = "Updatetdiscountaddx.php";
$tdiscountCountryID  = getRequest("txttdiscountCountryID");
$tdiscountBranchID  = getRequest("txttdiscountBranchID");
$tdiscountCode  = getRequest("txttdiscountCode");
$tdiscountDescription  = getRequest("txttdiscountDescription");
$tdiscountDiscount  = getRequest("txttdiscountDiscount");

if ($_SESSION["Updatetdiscount_InsertFailed"] == 1) {
   $tdiscountCountryID = $_SESSION["SavedtdiscountCountryID"];
   $tdiscountBranchID = $_SESSION["SavedtdiscountBranchID"];
   $tdiscountCode = $_SESSION["SavedtdiscountCode"];
   $tdiscountDescription = $_SESSION["SavedtdiscountDescription"];
   $tdiscountDiscount = $_SESSION["SavedtdiscountDiscount"];
}

MergeAddTemplate($HTML_Template);
unset($oRStdiscount);
$objConn1->Close();
unset($objConn1);
?>
