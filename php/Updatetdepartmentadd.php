<?PHP
session_start();
$PageLevel = 0;
$PageLevel = 1;
include('template/myclass.php');
not_logins();
include_once('systemathicappdata.php');
include_once('utils.php');
$HTML_Template = getRequest("HTMLT");
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdatetdepartmentFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetdepartmentadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetdepartmentFormAction@",$UpdatetdepartmentFormAction);    
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

    global $tdepartmentCountryID;
    $TemplateText = Replace($TemplateText,"@tdepartmentCountryID@",$tdepartmentCountryID);            
    global $tdepartmentBranchID;
    $TemplateText = Replace($TemplateText,"@tdepartmentBranchID@",$tdepartmentBranchID);            
    global $tdepartmentID;
    $TemplateText = Replace($TemplateText,"@tdepartmentID@",$tdepartmentID);            
    global $tdepartmentDescription;
    $TemplateText = Replace($TemplateText,"@tdepartmentDescription@",$tdepartmentDescription);            
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

$UpdatetdepartmentFormAction = "Updatetdepartmentaddx.php";
$tdepartmentCountryID  = getRequest("txttdepartmentCountryID");
$tdepartmentBranchID  = getRequest("txttdepartmentBranchID");
$tdepartmentID  = getRequest("txttdepartmentID");
$tdepartmentDescription  = getRequest("txttdepartmentDescription");

if ($_SESSION["Updatetdepartment_InsertFailed"] == 1) {
   $tdepartmentCountryID = $_SESSION["SavedtdepartmentCountryID"];
   $tdepartmentBranchID = $_SESSION["SavedtdepartmentBranchID"];
   $tdepartmentID = $_SESSION["SavedtdepartmentID"];
   $tdepartmentDescription = $_SESSION["SavedtdepartmentDescription"];
}

MergeAddTemplate($HTML_Template);
unset($oRStdepartment);
$objConn1->Close();
unset($objConn1);
?>
