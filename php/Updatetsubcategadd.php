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
    global $UpdatetsubcategFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetsubcategadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetsubcategFormAction@",$UpdatetsubcategFormAction);    
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

    global $tsubcategCountryID;
    $TemplateText = Replace($TemplateText,"@tsubcategCountryID@",$tsubcategCountryID);            
    global $tsubcategBranchID;
    $TemplateText = Replace($TemplateText,"@tsubcategBranchID@",$tsubcategBranchID);            
    global $tsubcategCatID;
    $TemplateText = Replace($TemplateText,"@tsubcategCatID@",$tsubcategCatID);            
    global $tsubcategSubCatID;
    $TemplateText = Replace($TemplateText,"@tsubcategSubCatID@",$tsubcategSubCatID);            
    global $tsubcategDescription;
    $TemplateText = Replace($TemplateText,"@tsubcategDescription@",$tsubcategDescription);            
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

$UpdatetsubcategFormAction = "Updatetsubcategaddx.php";
$tsubcategCountryID  = getRequest("txttsubcategCountryID");
$tsubcategBranchID  = getRequest("txttsubcategBranchID");
$tsubcategCatID  = getRequest("txttsubcategCatID");
$tsubcategSubCatID  = getRequest("txttsubcategSubCatID");
$tsubcategDescription  = getRequest("txttsubcategDescription");

if ($_SESSION["Updatetsubcateg_InsertFailed"] == 1) {
   $tsubcategCountryID = $_SESSION["SavedtsubcategCountryID"];
   $tsubcategBranchID = $_SESSION["SavedtsubcategBranchID"];
   $tsubcategCatID = $_SESSION["SavedtsubcategCatID"];
   $tsubcategSubCatID = $_SESSION["SavedtsubcategSubCatID"];
   $tsubcategDescription = $_SESSION["SavedtsubcategDescription"];
}

MergeAddTemplate($HTML_Template);
unset($oRStsubcateg);
$objConn1->Close();
unset($objConn1);
?>
