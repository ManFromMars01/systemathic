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
    global $UpdatetchartFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetchartadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetchartFormAction@",$UpdatetchartFormAction);    
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

    global $tchartCountryID;
    $TemplateText = Replace($TemplateText,"@tchartCountryID@",$tchartCountryID);            
    global $tchartBranchID;
    $TemplateText = Replace($TemplateText,"@tchartBranchID@",$tchartBranchID);            
    global $tchartAccountNo;
    $TemplateText = Replace($TemplateText,"@tchartAccountNo@",$tchartAccountNo);            
    global $tchartDeptNo;
    $TemplateText = Replace($TemplateText,"@tchartDeptNo@",$tchartDeptNo);            
    global $tchartDescription;
    $TemplateText = Replace($TemplateText,"@tchartDescription@",$tchartDescription);            
    global $tchartType;
    if($tchartType == "Asset"):
        $SELECTEDF51_6_1 = "SELECTED";
    else:
        $SELECTEDF51_6_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_1@", $SELECTEDF51_6_1);
    if($tchartType == "Liability"):
        $SELECTEDF51_6_2 = "SELECTED";
    else:
        $SELECTEDF51_6_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_2@", $SELECTEDF51_6_2);
    if($tchartType == "Capital"):
        $SELECTEDF51_6_3 = "SELECTED";
    else:
        $SELECTEDF51_6_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_3@", $SELECTEDF51_6_3);
    if($tchartType == "Revenue"):
        $SELECTEDF51_6_4 = "SELECTED";
    else:
        $SELECTEDF51_6_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_4@", $SELECTEDF51_6_4);
    if($tchartType == "Expense"):
        $SELECTEDF51_6_5 = "SELECTED";
    else:
        $SELECTEDF51_6_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_5@", $SELECTEDF51_6_5);
    global $tchartSubType;
    $TemplateText = Replace($TemplateText,"@tchartSubType@",$tchartSubType);            
    global $tchartStatus;
    if($tchartStatus == "Active"):
        $SELECTEDF51_8_1 = "SELECTED";
    else:
        $SELECTEDF51_8_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_8_1@", $SELECTEDF51_8_1);
    if($tchartStatus == "InActive"):
        $SELECTEDF51_8_2 = "SELECTED";
    else:
        $SELECTEDF51_8_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_8_2@", $SELECTEDF51_8_2);
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

$UpdatetchartFormAction = "Updatetchartaddx.php";
$tchartCountryID  = getRequest("txttchartCountryID");
$tchartBranchID  = getRequest("txttchartBranchID");
$tchartAccountNo  = getRequest("txttchartAccountNo");
$tchartDeptNo  = getRequest("txttchartDeptNo");
$tchartDescription  = getRequest("txttchartDescription");
$tchartSubType  = getRequest("txttchartSubType");

if ($_SESSION["Updatetchart_InsertFailed"] == 1) {
   $tchartCountryID = $_SESSION["SavedtchartCountryID"];
   $tchartBranchID = $_SESSION["SavedtchartBranchID"];
   $tchartAccountNo = $_SESSION["SavedtchartAccountNo"];
   $tchartDeptNo = $_SESSION["SavedtchartDeptNo"];
   $tchartDescription = $_SESSION["SavedtchartDescription"];
   $tchartType = $_SESSION["SavedtchartType"];
   $tchartSubType = $_SESSION["SavedtchartSubType"];
   $tchartStatus = $_SESSION["SavedtchartStatus"];
}

MergeAddTemplate($HTML_Template);
unset($oRStchart);
$objConn1->Close();
unset($objConn1);
?>
