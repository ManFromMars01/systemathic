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
    global $UpdatetroyaltyFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetroyaltyadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetroyaltyFormAction@",$UpdatetroyaltyFormAction);    
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

    global $troyaltyCountryID;
    $TemplateText = Replace($TemplateText,"@troyaltyCountryID@",$troyaltyCountryID);            
    global $troyaltyBranchID;
    $TemplateText = Replace($TemplateText,"@troyaltyBranchID@",$troyaltyBranchID);            
    global $troyaltyID;
    $TemplateText = Replace($TemplateText,"@troyaltyID@",$troyaltyID);            
    global $troyaltyDescription;
    $TemplateText = Replace($TemplateText,"@troyaltyDescription@",$troyaltyDescription);            
    global $troyaltyPercent;
    $TemplateText = Replace($TemplateText,"@troyaltyPercent@",$troyaltyPercent);            
    global $troyaltyPctToMaster;
    $TemplateText = Replace($TemplateText,"@troyaltyPctToMaster@",$troyaltyPctToMaster);            
    global $troyaltySource;
    if($troyaltySource == "Tuition_Fee"):
        $SELECTEDF48_7_1 = "SELECTED";
    else:
        $SELECTEDF48_7_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_1@", $SELECTEDF48_7_1);
    if($troyaltySource == "Examination"):
        $SELECTEDF48_7_2 = "SELECTED";
    else:
        $SELECTEDF48_7_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_2@", $SELECTEDF48_7_2);
    if($troyaltySource == "Competition"):
        $SELECTEDF48_7_3 = "SELECTED";
    else:
        $SELECTEDF48_7_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_3@", $SELECTEDF48_7_3);
    global $troyaltyRecipient;
    $TemplateText = Replace($TemplateText,"@troyaltyRecipient@",$troyaltyRecipient);            
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

$UpdatetroyaltyFormAction = "Updatetroyaltyaddx.php";
$troyaltyCountryID  = getRequest("txttroyaltyCountryID");
$troyaltyBranchID  = getRequest("txttroyaltyBranchID");
$troyaltyID  = getRequest("txttroyaltyID");
$troyaltyDescription  = getRequest("txttroyaltyDescription");
$troyaltyPercent  = getRequest("txttroyaltyPercent");
$troyaltyPctToMaster  = getRequest("txttroyaltyPctToMaster");
$troyaltyRecipient  = getRequest("txttroyaltyRecipient");

if ($_SESSION["Updatetroyalty_InsertFailed"] == 1) {
   $troyaltyCountryID = $_SESSION["SavedtroyaltyCountryID"];
   $troyaltyBranchID = $_SESSION["SavedtroyaltyBranchID"];
   $troyaltyID = $_SESSION["SavedtroyaltyID"];
   $troyaltyDescription = $_SESSION["SavedtroyaltyDescription"];
   $troyaltyPercent = $_SESSION["SavedtroyaltyPercent"];
   $troyaltyPctToMaster = $_SESSION["SavedtroyaltyPctToMaster"];
   $troyaltySource = $_SESSION["SavedtroyaltySource"];
   $troyaltyRecipient = $_SESSION["SavedtroyaltyRecipient"];
}

MergeAddTemplate($HTML_Template);
unset($oRStroyalty);
$objConn1->Close();
unset($objConn1);
?>
