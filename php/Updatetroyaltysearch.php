<?PHP
ob_start();
session_start();
$PageLevel = 0;
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
if (getRequest("SEARCH") == "TRUE"):
    $_SESSION["BrowseAssessment#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttroyaltyCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.CountryID LIKE " . chr(39) . getRequest("txttroyaltyCountryID") . "%" . chr(39);
endif;

if (getRequest("txttroyaltyBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.BranchID LIKE " . chr(39) . getRequest("txttroyaltyBranchID") . "%" . chr(39);
endif;

if (getRequest("txttroyaltyID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.ID LIKE " . chr(39) . getRequest("txttroyaltyID") . "%" . chr(39);
endif;

if (getRequest("txttroyaltyDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.Description LIKE " . chr(39) . getRequest("txttroyaltyDescription") . "%" . chr(39);
endif;

if (getRequest("txttroyaltyPercent") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.Percent = " . getRequest("txttroyaltyPercent");
endif;

if (getRequest("txttroyaltyPctToMaster") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.PctToMaster = " . getRequest("txttroyaltyPctToMaster");
endif;

if (getRequest("txttroyaltySource") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.Source LIKE " . chr(39) . getRequest("txttroyaltySource") . "%" . chr(39);
endif;

if (getRequest("txttroyaltyRecipient") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " troyalty.Recipient LIKE " . chr(39) . getRequest("txttroyaltyRecipient") . "%" . chr(39);
endif;
$_SESSION["BrowseAssessment#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseAssessmentlist.php");
endif;
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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStroyalty = "";


$TemplateText = "";

$troyaltyCountryID = "";
$troyaltyBranchID = "";
$troyaltyID = "";
$troyaltyDescription = "";
$troyaltyPercent = "";
$troyaltyPctToMaster = "";
$troyaltySource = "";
$troyaltyRecipient = "";

/*
============================================================================
 MergeTemplate 
============================================================================
*/
function MergeSearchTemplate($Template) {
    global $TemplateText;
    global $FormDeclaration;    
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetroyalty" . "search.htm";
    endif;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

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

    $TemplateText = Replace($TemplateText,"@FormDeclaration@",$FormDeclaration);
    global $troyaltyCountryID;
    $TemplateText = Replace($TemplateText, "@troyaltyCountryID@", $troyaltyCountryID);
    global $troyaltyBranchID;
    $TemplateText = Replace($TemplateText, "@troyaltyBranchID@", $troyaltyBranchID);
    global $troyaltyID;
    $TemplateText = Replace($TemplateText, "@troyaltyID@", $troyaltyID);
    global $troyaltyDescription;
    $TemplateText = Replace($TemplateText, "@troyaltyDescription@", $troyaltyDescription);
    global $troyaltyPercent;
    $TemplateText = Replace($TemplateText, "@troyaltyPercent@", $troyaltyPercent);
    global $troyaltyPctToMaster;
    $TemplateText = Replace($TemplateText, "@troyaltyPctToMaster@", $troyaltyPctToMaster);
    global $troyaltySource;
    if($troyaltySource == "Tuition_Fee"):
        $SELECTEDF43_7_1 = "SELECTED";
    else:
        $SELECTEDF43_7_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF43_7_1@", $SELECTEDF43_7_1);
    if($troyaltySource == "Examination"):
        $SELECTEDF43_7_2 = "SELECTED";
    else:
        $SELECTEDF43_7_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF43_7_2@", $SELECTEDF43_7_2);
    if($troyaltySource == "Competition"):
        $SELECTEDF43_7_3 = "SELECTED";
    else:
        $SELECTEDF43_7_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF43_7_3@", $SELECTEDF43_7_3);
    global $troyaltyRecipient;
    $TemplateText = Replace($TemplateText, "@troyaltyRecipient@", $troyaltyRecipient);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAssessmentlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetroyalty" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStroyalty);
ob_flush();
?>
