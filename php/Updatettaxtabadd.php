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
    global $UpdatettaxtabFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatettaxtabadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatettaxtabFormAction@",$UpdatettaxtabFormAction);    
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

    global $ttaxtabCountryID;
    $TemplateText = Replace($TemplateText,"@ttaxtabCountryID@",$ttaxtabCountryID);            
    global $ttaxtabBranchID;
    $TemplateText = Replace($TemplateText,"@ttaxtabBranchID@",$ttaxtabBranchID);            
    global $ttaxtabTaxID;
    $TemplateText = Replace($TemplateText,"@ttaxtabTaxID@",$ttaxtabTaxID);            
    global $ttaxtabDescription;
    $TemplateText = Replace($TemplateText,"@ttaxtabDescription@",$ttaxtabDescription);            
    global $ttaxtabRate;
    $TemplateText = Replace($TemplateText,"@ttaxtabRate@",$ttaxtabRate);            
    global $ttaxtabDept;
    $TemplateText = Replace($TemplateText,"@ttaxtabDept@",$ttaxtabDept);            
    global $ttaxtabAccount;
    $TemplateText = Replace($TemplateText,"@ttaxtabAccount@",$ttaxtabAccount);            
    global $ttaxtabCurrTaxAmt;
    $TemplateText = Replace($TemplateText,"@ttaxtabCurrTaxAmt@",$ttaxtabCurrTaxAmt);            
    global $ttaxtabMTDTaxAmt;
    $TemplateText = Replace($TemplateText,"@ttaxtabMTDTaxAmt@",$ttaxtabMTDTaxAmt);            
    global $ttaxtabYTDTaxAmt;
    $TemplateText = Replace($TemplateText,"@ttaxtabYTDTaxAmt@",$ttaxtabYTDTaxAmt);            
    global $ttaxtabStatus;
    $TemplateText = Replace($TemplateText,"@ttaxtabStatus@",$ttaxtabStatus);            
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

$UpdatettaxtabFormAction = "Updatettaxtabaddx.php";
$ttaxtabCountryID  = getRequest("txtttaxtabCountryID");
$ttaxtabBranchID  = getRequest("txtttaxtabBranchID");
$ttaxtabTaxID  = getRequest("txtttaxtabTaxID");
$ttaxtabDescription  = getRequest("txtttaxtabDescription");
$ttaxtabRate  = getRequest("txtttaxtabRate");
$ttaxtabDept  = getRequest("txtttaxtabDept");
$ttaxtabAccount  = getRequest("txtttaxtabAccount");
$ttaxtabCurrTaxAmt  = getRequest("txtttaxtabCurrTaxAmt");
$ttaxtabMTDTaxAmt  = getRequest("txtttaxtabMTDTaxAmt");
$ttaxtabYTDTaxAmt  = getRequest("txtttaxtabYTDTaxAmt");
$ttaxtabStatus  = getRequest("txtttaxtabStatus");

if ($_SESSION["Updatettaxtab_InsertFailed"] == 1) {
   $ttaxtabCountryID = $_SESSION["SavedttaxtabCountryID"];
   $ttaxtabBranchID = $_SESSION["SavedttaxtabBranchID"];
   $ttaxtabTaxID = $_SESSION["SavedttaxtabTaxID"];
   $ttaxtabDescription = $_SESSION["SavedttaxtabDescription"];
   $ttaxtabRate = $_SESSION["SavedttaxtabRate"];
   $ttaxtabDept = $_SESSION["SavedttaxtabDept"];
   $ttaxtabAccount = $_SESSION["SavedttaxtabAccount"];
   $ttaxtabCurrTaxAmt = $_SESSION["SavedttaxtabCurrTaxAmt"];
   $ttaxtabMTDTaxAmt = $_SESSION["SavedttaxtabMTDTaxAmt"];
   $ttaxtabYTDTaxAmt = $_SESSION["SavedttaxtabYTDTaxAmt"];
   $ttaxtabStatus = $_SESSION["SavedttaxtabStatus"];
}

MergeAddTemplate($HTML_Template);
unset($oRSttaxtab);
$objConn1->Close();
unset($objConn1);
?>
