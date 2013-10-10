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
session_set_cookie_params(500);
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
    global $UpdatetdroleFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetdroleadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetdroleFormAction@",$UpdatetdroleFormAction);    
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

    global $tdroleCountryID;
    $TemplateText = Replace($TemplateText,"@tdroleCountryID@",$tdroleCountryID);            
    global $tdroleBranchID;
    $TemplateText = Replace($TemplateText,"@tdroleBranchID@",$tdroleBranchID);            
    global $tdroleRoleID;
    $TemplateText = Replace($TemplateText,"@tdroleRoleID@",$tdroleRoleID);            
    global $tdrolePageName;
    $TemplateText = Replace($TemplateText,"@tdrolePageName@",$tdrolePageName);            
    global $tdroleInsertPrev;
    $TemplateText = Replace($TemplateText,"@tdroleInsertPrev@",$tdroleInsertPrev);            
        if($tdroleInsertPrev == "Y"):
            $SELECTEDtdroleInsertPrevY = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevY@", $SELECTEDtdroleInsertPrevY);
        if($tdroleInsertPrev == "N"):
            $SELECTEDtdroleInsertPrevN = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevN@", $SELECTEDtdroleInsertPrevN);
    global $tdroleEditPrev;
    $TemplateText = Replace($TemplateText,"@tdroleEditPrev@",$tdroleEditPrev);            
        if($tdroleEditPrev == "Y"):
            $SELECTEDtdroleEditPrevY = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevY@", $SELECTEDtdroleEditPrevY);
        if($tdroleEditPrev == "N"):
            $SELECTEDtdroleEditPrevN = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevN@", $SELECTEDtdroleEditPrevN);
    global $tdroleDeletePrev;
    $TemplateText = Replace($TemplateText,"@tdroleDeletePrev@",$tdroleDeletePrev);            
        if($tdroleDeletePrev == "Y"):
            $SELECTEDtdroleDeletePrevY = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevY@", $SELECTEDtdroleDeletePrevY);
        if($tdroleDeletePrev == "N"):
            $SELECTEDtdroleDeletePrevN = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevN@", $SELECTEDtdroleDeletePrevN);
    global $tdroleViewPrev;
    $TemplateText = Replace($TemplateText,"@tdroleViewPrev@",$tdroleViewPrev);            
        if($tdroleViewPrev == "Y"):
            $SELECTEDtdroleViewPrevY = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevY@", $SELECTEDtdroleViewPrevY);
        if($tdroleViewPrev == "N"):
            $SELECTEDtdroleViewPrevN = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevN@", $SELECTEDtdroleViewPrevN);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdatetdroleFormAction = "Updatetdroleaddx.php";
$tdroleCountryID  = getRequest("txttdroleCountryID");
$tdroleBranchID  = getRequest("txttdroleBranchID");
$tdroleRoleID  = getRequest("txttdroleRoleID");
$tdrolePageName  = getRequest("txttdrolePageName");
$tdroleInsertPrev  = getRequest("txttdroleInsertPrev");
$tdroleEditPrev  = getRequest("txttdroleEditPrev");
$tdroleDeletePrev  = getRequest("txttdroleDeletePrev");
$tdroleViewPrev  = getRequest("txttdroleViewPrev");

if ($_SESSION["Updatetdrole_InsertFailed"] == 1) {
   $tdroleCountryID = $_SESSION["SavedtdroleCountryID"];
   $tdroleBranchID = $_SESSION["SavedtdroleBranchID"];
   $tdroleRoleID = $_SESSION["SavedtdroleRoleID"];
   $tdrolePageName = $_SESSION["SavedtdrolePageName"];
   $tdroleInsertPrev = $_SESSION["SavedtdroleInsertPrev"];
   $tdroleEditPrev = $_SESSION["SavedtdroleEditPrev"];
   $tdroleDeletePrev = $_SESSION["SavedtdroleDeletePrev"];
   $tdroleViewPrev = $_SESSION["SavedtdroleViewPrev"];
}

MergeAddTemplate($HTML_Template);
unset($oRStdrole);
$objConn1->Close();
unset($objConn1);
?>
