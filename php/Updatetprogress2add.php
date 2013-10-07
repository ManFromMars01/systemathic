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
    global $Updatetprogress2FormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetprogress2add.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@Updatetprogress2FormAction@",$Updatetprogress2FormAction);    
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

    global $tprogress2CountryID;
    $TemplateText = Replace($TemplateText,"@tprogress2CountryID@",$tprogress2CountryID);            
    global $tprogress2BranchID;
    $TemplateText = Replace($TemplateText,"@tprogress2BranchID@",$tprogress2BranchID);            
    global $tprogress2Level1ID;
    $TemplateText = Replace($TemplateText,"@tprogress2Level1ID@",$tprogress2Level1ID);            
    global $tprogress2Level2ID;
    $TemplateText = Replace($TemplateText,"@tprogress2Level2ID@",$tprogress2Level2ID);            
    global $tprogress2Description;
    $TemplateText = Replace($TemplateText,"@tprogress2Description@",$tprogress2Description);            
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

$Updatetprogress2FormAction = "Updatetprogress2addx.php";
$tprogress2CountryID  = getRequest("txttprogress2CountryID");
$tprogress2BranchID  = getRequest("txttprogress2BranchID");
$tprogress2Level1ID  = getRequest("txttprogress2Level1ID");
$tprogress2Level2ID  = getRequest("txttprogress2Level2ID");
$tprogress2Description  = getRequest("txttprogress2Description");

if ($_SESSION["Updatetprogress2_InsertFailed"] == 1) {
   $tprogress2CountryID = $_SESSION["Savedtprogress2CountryID"];
   $tprogress2BranchID = $_SESSION["Savedtprogress2BranchID"];
   $tprogress2Level1ID = $_SESSION["Savedtprogress2Level1ID"];
   $tprogress2Level2ID = $_SESSION["Savedtprogress2Level2ID"];
   $tprogress2Description = $_SESSION["Savedtprogress2Description"];
}

MergeAddTemplate($HTML_Template);
unset($oRStprogress2);
$objConn1->Close();
unset($objConn1);
?>
