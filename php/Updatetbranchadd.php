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
    global $UpdatetbranchFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetbranchadd.htm";
    endif;
    include_once('ConnInfo.php');

    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
    $sql2 = "SELECT  tcountry.Description FROM  tcountry WHERE  tcountry.ID = '".$_GET['ID1']."'";
    $oRStbranch2 = $objConn1->SelectLimit($sql2,1);
        //$address1 = $oRStbranch2->fields["Description"];
    $Country = $oRStbranch2->fields["Description"];


    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetbranchFormAction@",$UpdatetbranchFormAction);    
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

    global $tbranchCountryID;
    $TemplateText = Replace($TemplateText,"@tbranchCountryID@",$tbranchCountryID);            
    global $tbranchBranchID;
    $TemplateText = Replace($TemplateText,"@tbranchBranchID@",$tbranchBranchID);            
    global $tbranchDescription;
    $TemplateText = Replace($TemplateText,"@tbranchDescription@",$tbranchDescription);            
    global $tbranchPhone;
    $TemplateText = Replace($TemplateText,"@tbranchPhone@",$tbranchPhone);            
    global $tbranchEmail;
    $TemplateText = Replace($TemplateText,"@tbranchEmail@",$tbranchEmail);            
    global $tbranchContact;
    $TemplateText = Replace($TemplateText,"@tbranchContact@",$tbranchContact);            
    global $tbranchHQOperation;
    $TemplateText = Replace($TemplateText,"@tbranchHQOperation@",$tbranchHQOperation);            
    global $tbranchHQCenterOperation;
    $TemplateText = Replace($TemplateText,"@tbranchHQCenterOperation@",$tbranchHQCenterOperation);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
   //$Country = "Hello";
    $TemplateText = Replace($TemplateText, "@Country@", $Country);


    print($TemplateText);
} // END Function


    //$TemplateText = Replace($TemplateText, "@Country@", $Country);


$UpdatetbranchFormAction = "Updatetbranchaddx.php";
$tbranchCountryID  = getRequest("txttbranchCountryID");
$tbranchBranchID  = getRequest("txttbranchBranchID");
$tbranchDescription  = getRequest("txttbranchDescription");
$tbranchPhone  = getRequest("txttbranchPhone");
$tbranchEmail  = getRequest("txttbranchEmail");
$tbranchContact  = getRequest("txttbranchContact");
$tbranchHQOperation  = getRequest("txttbranchHQOperation");
$tbranchHQCenterOperation  = getRequest("txttbranchHQCenterOperation");

if ($_SESSION["Updatetbranch_InsertFailed"] == 1) {
   $tbranchCountryID = $_SESSION["SavedtbranchCountryID"];
   $tbranchBranchID = $_SESSION["SavedtbranchBranchID"];
   $tbranchDescription = $_SESSION["SavedtbranchDescription"];
   $tbranchPhone = $_SESSION["SavedtbranchPhone"];
   $tbranchEmail = $_SESSION["SavedtbranchEmail"];
   $tbranchContact = $_SESSION["SavedtbranchContact"];
   $tbranchHQOperation = $_SESSION["SavedtbranchHQOperation"];
   $tbranchHQCenterOperation = $_SESSION["SavedtbranchHQCenterOperation"];
}





MergeAddTemplate($HTML_Template);
unset($oRStbranch);
$objConn1->Close();
unset($objConn1);
?>
