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
    global $UpdatetpaytypeFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetpaytypeadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetpaytypeFormAction@",$UpdatetpaytypeFormAction);    
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

    global $tpaytypeCountryID;
    $TemplateText = Replace($TemplateText,"@tpaytypeCountryID@",$tpaytypeCountryID);            
    global $tpaytypeBranchID;
    $TemplateText = Replace($TemplateText,"@tpaytypeBranchID@",$tpaytypeBranchID);            
    global $tpaytypePayType;
    $TemplateText = Replace($TemplateText,"@tpaytypePayType@",$tpaytypePayType);            
    global $tpaytypeDescription;
    $TemplateText = Replace($TemplateText,"@tpaytypeDescription@",$tpaytypeDescription);            
    global $tpaytypeAmount;
    $TemplateText = Replace($TemplateText,"@tpaytypeAmount@",$tpaytypeAmount);            
    global $tpaytypeCommAmt;
    $TemplateText = Replace($TemplateText,"@tpaytypeCommAmt@",$tpaytypeCommAmt);            
    global $tpaytypeSalesTax;
    $TemplateText = Replace($TemplateText,"@tpaytypeSalesTax@",$tpaytypeSalesTax);            
    global $tpaytypeAccount;
    $TemplateText = Replace($TemplateText,"@tpaytypeAccount@",$tpaytypeAccount);            
    global $tpaytypeMTDQty;
    $TemplateText = Replace($TemplateText,"@tpaytypeMTDQty@",$tpaytypeMTDQty);            
    global $tpaytypeMTDAmt;
    $TemplateText = Replace($TemplateText,"@tpaytypeMTDAmt@",$tpaytypeMTDAmt);            
    global $tpaytypeYTDQty;
    $TemplateText = Replace($TemplateText,"@tpaytypeYTDQty@",$tpaytypeYTDQty);            
    global $tpaytypeYTDAmt;
    $TemplateText = Replace($TemplateText,"@tpaytypeYTDAmt@",$tpaytypeYTDAmt);            
    global $tpaytypeType;
    if($tpaytypeType == "Cash"):
        $SELECTEDF50_13_1 = "SELECTED";
    else:
        $SELECTEDF50_13_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_1@", $SELECTEDF50_13_1);
    if($tpaytypeType == "Cheque"):
        $SELECTEDF50_13_2 = "SELECTED";
    else:
        $SELECTEDF50_13_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_2@", $SELECTEDF50_13_2);
    if($tpaytypeType == "Credit_Card"):
        $SELECTEDF50_13_3 = "SELECTED";
    else:
        $SELECTEDF50_13_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_3@", $SELECTEDF50_13_3);
    if($tpaytypeType == "Debit_Card"):
        $SELECTEDF50_13_4 = "SELECTED";
    else:
        $SELECTEDF50_13_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_4@", $SELECTEDF50_13_4);
    if($tpaytypeType == "Other"):
        $SELECTEDF50_13_5 = "SELECTED";
    else:
        $SELECTEDF50_13_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_5@", $SELECTEDF50_13_5);
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

$UpdatetpaytypeFormAction = "Updatetpaytypeaddx.php";
$tpaytypeCountryID  = getRequest("txttpaytypeCountryID");
$tpaytypeBranchID  = getRequest("txttpaytypeBranchID");
$tpaytypePayType  = getRequest("txttpaytypePayType");
$tpaytypeDescription  = getRequest("txttpaytypeDescription");
$tpaytypeAmount  = getRequest("txttpaytypeAmount");
$tpaytypeCommAmt  = getRequest("txttpaytypeCommAmt");
$tpaytypeSalesTax  = getRequest("txttpaytypeSalesTax");
$tpaytypeAccount  = getRequest("txttpaytypeAccount");
$tpaytypeMTDQty  = getRequest("txttpaytypeMTDQty");
$tpaytypeMTDAmt  = getRequest("txttpaytypeMTDAmt");
$tpaytypeYTDQty  = getRequest("txttpaytypeYTDQty");
$tpaytypeYTDAmt  = getRequest("txttpaytypeYTDAmt");

if ($_SESSION["Updatetpaytype_InsertFailed"] == 1) {
   $tpaytypeCountryID = $_SESSION["SavedtpaytypeCountryID"];
   $tpaytypeBranchID = $_SESSION["SavedtpaytypeBranchID"];
   $tpaytypePayType = $_SESSION["SavedtpaytypePayType"];
   $tpaytypeDescription = $_SESSION["SavedtpaytypeDescription"];
   $tpaytypeAmount = $_SESSION["SavedtpaytypeAmount"];
   $tpaytypeCommAmt = $_SESSION["SavedtpaytypeCommAmt"];
   $tpaytypeSalesTax = $_SESSION["SavedtpaytypeSalesTax"];
   $tpaytypeAccount = $_SESSION["SavedtpaytypeAccount"];
   $tpaytypeMTDQty = $_SESSION["SavedtpaytypeMTDQty"];
   $tpaytypeMTDAmt = $_SESSION["SavedtpaytypeMTDAmt"];
   $tpaytypeYTDQty = $_SESSION["SavedtpaytypeYTDQty"];
   $tpaytypeYTDAmt = $_SESSION["SavedtpaytypeYTDAmt"];
   $tpaytypeType = $_SESSION["SavedtpaytypeType"];
}

MergeAddTemplate($HTML_Template);
unset($oRStpaytype);
$objConn1->Close();
unset($objConn1);
?>
