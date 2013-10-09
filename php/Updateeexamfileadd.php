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
    global $UpdateeexamfileFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updateeexamfileadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdateeexamfileFormAction@",$UpdateeexamfileFormAction);    
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

    global $eexamfileCountryID;
    $TemplateText = Replace($TemplateText,"@eexamfileCountryID@",$eexamfileCountryID);            
    global $eexamfileBranchID;
    $TemplateText = Replace($TemplateText,"@eexamfileBranchID@",$eexamfileBranchID);            
    global $eexamfileDate;
    $TemplateText = Replace($TemplateText,"@eexamfileDate@",$eexamfileDate);            
    global $eexamfileTimeFrom;
    $TemplateText = Replace($TemplateText,"@eexamfileTimeFrom@",$eexamfileTimeFrom);            
    global $eexamfileTimeTo;
    $TemplateText = Replace($TemplateText,"@eexamfileTimeTo@",$eexamfileTimeTo);            
    global $eexamfileVenue;
    $TemplateText = Replace($TemplateText,"@eexamfileVenue@",$eexamfileVenue);            
    global $eexamfileOpenDate;
    $TemplateText = Replace($TemplateText,"@eexamfileOpenDate@",$eexamfileOpenDate);            
    global $eexamfileCloseDate;
    $TemplateText = Replace($TemplateText,"@eexamfileCloseDate@",$eexamfileCloseDate);            
    global $eexamfileSubmitDate;
    $TemplateText = Replace($TemplateText,"@eexamfileSubmitDate@",$eexamfileSubmitDate);            
    global $eexamfileMenFee;
    $TemplateText = Replace($TemplateText,"@eexamfileMenFee@",$eexamfileMenFee);            
    global $eexamfileAbaFee;
    $TemplateText = Replace($TemplateText,"@eexamfileAbaFee@",$eexamfileAbaFee);            
    global $eexamfileAurFee;
    $TemplateText = Replace($TemplateText,"@eexamfileAurFee@",$eexamfileAurFee);            
    global $eexamfileTotal;
    $TemplateText = Replace($TemplateText,"@eexamfileTotal@",$eexamfileTotal);            
    global $eexamfileRemarks;
    $TemplateText = Replace($TemplateText,"@eexamfileRemarks@",$eexamfileRemarks);            
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

$UpdateeexamfileFormAction = "Updateeexamfileaddx.php";
$eexamfileCountryID  = getRequest("txteexamfileCountryID");
$eexamfileBranchID  = getRequest("txteexamfileBranchID");
$eexamfileDate  = getRequest("txteexamfileDate");
$eexamfileTimeFrom  = getRequest("txteexamfileTimeFrom");
$eexamfileTimeTo  = getRequest("txteexamfileTimeTo");
$eexamfileVenue  = getRequest("txteexamfileVenue");
$eexamfileOpenDate  = getRequest("txteexamfileOpenDate");
$eexamfileCloseDate  = getRequest("txteexamfileCloseDate");
$eexamfileSubmitDate  = getRequest("txteexamfileSubmitDate");
$eexamfileMenFee  = getRequest("txteexamfileMenFee");
$eexamfileAbaFee  = getRequest("txteexamfileAbaFee");
$eexamfileAurFee  = getRequest("txteexamfileAurFee");
$eexamfileTotal  = getRequest("txteexamfileTotal");
$eexamfileRemarks  = getRequest("txteexamfileRemarks");

if ($_SESSION["Updateeexamfile_InsertFailed"] == 1) {
   $eexamfileCountryID = $_SESSION["SavedeexamfileCountryID"];
   $eexamfileBranchID = $_SESSION["SavedeexamfileBranchID"];
   $eexamfileDate = $_SESSION["SavedeexamfileDate"];
   $eexamfileTimeFrom = $_SESSION["SavedeexamfileTimeFrom"];
   $eexamfileTimeTo = $_SESSION["SavedeexamfileTimeTo"];
   $eexamfileVenue = $_SESSION["SavedeexamfileVenue"];
   $eexamfileOpenDate = $_SESSION["SavedeexamfileOpenDate"];
   $eexamfileCloseDate = $_SESSION["SavedeexamfileCloseDate"];
   $eexamfileSubmitDate = $_SESSION["SavedeexamfileSubmitDate"];
   $eexamfileMenFee = $_SESSION["SavedeexamfileMenFee"];
   $eexamfileAbaFee = $_SESSION["SavedeexamfileAbaFee"];
   $eexamfileAurFee = $_SESSION["SavedeexamfileAurFee"];
   $eexamfileTotal = $_SESSION["SavedeexamfileTotal"];
   $eexamfileRemarks = $_SESSION["SavedeexamfileRemarks"];
}

MergeAddTemplate($HTML_Template);
unset($oRSeexamfile);
$objConn1->Close();
unset($objConn1);
?>
