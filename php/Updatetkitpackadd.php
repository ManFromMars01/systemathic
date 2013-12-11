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
    global $UpdatetkitpackFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetkitpackadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetkitpackFormAction@",$UpdatetkitpackFormAction);    
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

    global $tkitpackCountryID;
    $TemplateText = Replace($TemplateText,"@tkitpackCountryID@",$tkitpackCountryID);            
    global $tkitpackBranchID;
    $TemplateText = Replace($TemplateText,"@tkitpackBranchID@",$tkitpackBranchID);            
    global $tkitpackLevelID;
    $TemplateText = Replace($TemplateText,"@tkitpackLevelID@",$tkitpackLevelID);            
    global $tkitpackItemNo;
    $TemplateText = Replace($TemplateText,"@tkitpackItemNo@",$tkitpackItemNo);            
    global $tkitpackDescription;
    $TemplateText = Replace($TemplateText,"@tkitpackDescription@",$tkitpackDescription);            
    global $tkitpackQty;
    $TemplateText = Replace($TemplateText,"@tkitpackQty@",$tkitpackQty);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
    
    
    $Country      = $_SESSION['UserValue1'];
    $Branch       =  $_SESSION['UserValue2'];
    $TemplateText = Replace($TemplateText,"@levelid@", $_GET['Level']);

    $TemplateText = Replace($TemplateText, "@Country@", $Country);
    $TemplateText = Replace($TemplateText, "@Branch@", $Branch);
    include('template/kitpack_variables.php');  
    

    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdatetkitpackFormAction = "Updatetkitpackaddx.php";
$tkitpackCountryID  = getRequest("txttkitpackCountryID");
$tkitpackBranchID  = getRequest("txttkitpackBranchID");
$tkitpackLevelID  = getRequest("txttkitpackLevelID");
$tkitpackItemNo  = getRequest("txttkitpackItemNo");
$tkitpackDescription  = getRequest("txttkitpackDescription");
$tkitpackQty  = getRequest("txttkitpackQty");

if ($_SESSION["Updatetkitpack_InsertFailed"] == 1) {
   $tkitpackCountryID = $_SESSION["SavedtkitpackCountryID"];
   $tkitpackBranchID = $_SESSION["SavedtkitpackBranchID"];
   $tkitpackLevelID = $_SESSION["SavedtkitpackLevelID"];
   $tkitpackItemNo = $_SESSION["SavedtkitpackItemNo"];
   $tkitpackDescription = $_SESSION["SavedtkitpackDescription"];
   $tkitpackQty = $_SESSION["SavedtkitpackQty"];
}

MergeAddTemplate($HTML_Template);
unset($oRStkitpack);
$objConn1->Close();
unset($objConn1);
?>
