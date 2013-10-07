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
    global $Updatetprogress4FormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetprogress4add.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@Updatetprogress4FormAction@",$Updatetprogress4FormAction);    
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

    global $tprogress4CountryID;
    $TemplateText = Replace($TemplateText,"@tprogress4CountryID@",$tprogress4CountryID);            
    global $tprogress4BranchID;
    $TemplateText = Replace($TemplateText,"@tprogress4BranchID@",$tprogress4BranchID);            
    global $tprogress4Level1ID;
    $TemplateText = Replace($TemplateText,"@tprogress4Level1ID@",$tprogress4Level1ID);            
    global $tprogress4Level2ID;
    $TemplateText = Replace($TemplateText,"@tprogress4Level2ID@",$tprogress4Level2ID);            
    global $tprogress4Level3ID;
    $TemplateText = Replace($TemplateText,"@tprogress4Level3ID@",$tprogress4Level3ID);            
    global $tprogress4Rating;
    $TemplateText = Replace($TemplateText,"@tprogress4Rating@",$tprogress4Rating);            
    global $tprogress4Description;
    $TemplateText = Replace($TemplateText,"@tprogress4Description@",$tprogress4Description);            
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

$Updatetprogress4FormAction = "Updatetprogress4addx.php";
$tprogress4CountryID  = getRequest("txttprogress4CountryID");
$tprogress4BranchID  = getRequest("txttprogress4BranchID");
$tprogress4Level1ID  = getRequest("txttprogress4Level1ID");
$tprogress4Level2ID  = getRequest("txttprogress4Level2ID");
$tprogress4Level3ID  = getRequest("txttprogress4Level3ID");
$tprogress4Rating  = getRequest("txttprogress4Rating");
$tprogress4Description  = getRequest("txttprogress4Description");

if ($_SESSION["Updatetprogress4_InsertFailed"] == 1) {
   $tprogress4CountryID = $_SESSION["Savedtprogress4CountryID"];
   $tprogress4BranchID = $_SESSION["Savedtprogress4BranchID"];
   $tprogress4Level1ID = $_SESSION["Savedtprogress4Level1ID"];
   $tprogress4Level2ID = $_SESSION["Savedtprogress4Level2ID"];
   $tprogress4Level3ID = $_SESSION["Savedtprogress4Level3ID"];
   $tprogress4Rating = $_SESSION["Savedtprogress4Rating"];
   $tprogress4Description = $_SESSION["Savedtprogress4Description"];
}

MergeAddTemplate($HTML_Template);
unset($oRStprogress4);
$objConn1->Close();
unset($objConn1);
?>
