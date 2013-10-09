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
    global $UpdatetvendorFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetvendoradd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetvendorFormAction@",$UpdatetvendorFormAction);    
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

    global $tvendorCountryID;
    $TemplateText = Replace($TemplateText,"@tvendorCountryID@",$tvendorCountryID);            
    global $tvendorBranchID;
    $TemplateText = Replace($TemplateText,"@tvendorBranchID@",$tvendorBranchID);            
    global $tvendorID;
    $TemplateText = Replace($TemplateText,"@tvendorID@",$tvendorID);            
    global $tvendorName;
    $TemplateText = Replace($TemplateText,"@tvendorName@",$tvendorName);            
    global $tvendorAddress1;
    $TemplateText = Replace($TemplateText,"@tvendorAddress1@",$tvendorAddress1);            
    global $tvendorAddress2;
    $TemplateText = Replace($TemplateText,"@tvendorAddress2@",$tvendorAddress2);            
    global $tvendorCity;
    $TemplateText = Replace($TemplateText,"@tvendorCity@",$tvendorCity);            
    global $tvendorZip;
    $TemplateText = Replace($TemplateText,"@tvendorZip@",$tvendorZip);            
    global $tvendorFax;
    $TemplateText = Replace($TemplateText,"@tvendorFax@",$tvendorFax);            
    global $tvendorPhone;
    $TemplateText = Replace($TemplateText,"@tvendorPhone@",$tvendorPhone);            
    global $tvendorRmtAdd1;
    $TemplateText = Replace($TemplateText,"@tvendorRmtAdd1@",$tvendorRmtAdd1);            
    global $tvendorRmtAdd2;
    $TemplateText = Replace($TemplateText,"@tvendorRmtAdd2@",$tvendorRmtAdd2);            
    global $tvendorRmtZip;
    $TemplateText = Replace($TemplateText,"@tvendorRmtZip@",$tvendorRmtZip);            
    global $tvendorRmtCity;
    $TemplateText = Replace($TemplateText,"@tvendorRmtCity@",$tvendorRmtCity);            
    global $tvendorContact;
    $TemplateText = Replace($TemplateText,"@tvendorContact@",$tvendorContact);            
    global $tvendorDiscountPct;
    $TemplateText = Replace($TemplateText,"@tvendorDiscountPct@",$tvendorDiscountPct);            
    global $tvendorDiscountDays;
    $TemplateText = Replace($TemplateText,"@tvendorDiscountDays@",$tvendorDiscountDays);            
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

$UpdatetvendorFormAction = "Updatetvendoraddx.php";
$tvendorCountryID  = getRequest("txttvendorCountryID");
$tvendorBranchID  = getRequest("txttvendorBranchID");
$tvendorID  = getRequest("txttvendorID");
$tvendorName  = getRequest("txttvendorName");
$tvendorAddress1  = getRequest("txttvendorAddress1");
$tvendorAddress2  = getRequest("txttvendorAddress2");
$tvendorCity  = getRequest("txttvendorCity");
$tvendorZip  = getRequest("txttvendorZip");
$tvendorFax  = getRequest("txttvendorFax");
$tvendorPhone  = getRequest("txttvendorPhone");
$tvendorRmtAdd1  = getRequest("txttvendorRmtAdd1");
$tvendorRmtAdd2  = getRequest("txttvendorRmtAdd2");
$tvendorRmtZip  = getRequest("txttvendorRmtZip");
$tvendorRmtCity  = getRequest("txttvendorRmtCity");
$tvendorContact  = getRequest("txttvendorContact");
$tvendorDiscountPct  = getRequest("txttvendorDiscountPct");
$tvendorDiscountDays  = getRequest("txttvendorDiscountDays");

if ($_SESSION["Updatetvendor_InsertFailed"] == 1) {
   $tvendorCountryID = $_SESSION["SavedtvendorCountryID"];
   $tvendorBranchID = $_SESSION["SavedtvendorBranchID"];
   $tvendorID = $_SESSION["SavedtvendorID"];
   $tvendorName = $_SESSION["SavedtvendorName"];
   $tvendorAddress1 = $_SESSION["SavedtvendorAddress1"];
   $tvendorAddress2 = $_SESSION["SavedtvendorAddress2"];
   $tvendorCity = $_SESSION["SavedtvendorCity"];
   $tvendorZip = $_SESSION["SavedtvendorZip"];
   $tvendorFax = $_SESSION["SavedtvendorFax"];
   $tvendorPhone = $_SESSION["SavedtvendorPhone"];
   $tvendorRmtAdd1 = $_SESSION["SavedtvendorRmtAdd1"];
   $tvendorRmtAdd2 = $_SESSION["SavedtvendorRmtAdd2"];
   $tvendorRmtZip = $_SESSION["SavedtvendorRmtZip"];
   $tvendorRmtCity = $_SESSION["SavedtvendorRmtCity"];
   $tvendorContact = $_SESSION["SavedtvendorContact"];
   $tvendorDiscountPct = $_SESSION["SavedtvendorDiscountPct"];
   $tvendorDiscountDays = $_SESSION["SavedtvendorDiscountDays"];
}

MergeAddTemplate($HTML_Template);
unset($oRStvendor);
$objConn1->Close();
unset($objConn1);
?>
