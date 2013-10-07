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
if (getRequest("SEARCH") == "TRUE"):
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttcurrencyCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.CountryID LIKE " . chr(39) . getRequest("txttcurrencyCountryID") . "%" . chr(39);
endif;

if (getRequest("txttcurrencyBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.BranchID LIKE " . chr(39) . getRequest("txttcurrencyBranchID") . "%" . chr(39);
endif;

if (getRequest("txttcurrencyID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.ID LIKE " . chr(39) . getRequest("txttcurrencyID") . "%" . chr(39);
endif;

if (getRequest("txttcurrencyDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.Description LIKE " . chr(39) . getRequest("txttcurrencyDescription") . "%" . chr(39);
endif;

if (getRequest("txttcurrencyRate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.Rate = " . getRequest("txttcurrencyRate");
endif;

if (getRequest("txttcurrencySymbol") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcurrency.Symbol LIKE " . chr(39) . getRequest("txttcurrencySymbol") . "%" . chr(39);
endif;
$_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseAttendanceStatuslist.php");
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
$oRStcurrency = "";


$TemplateText = "";

$tcurrencyCountryID = "";
$tcurrencyBranchID = "";
$tcurrencyID = "";
$tcurrencyDescription = "";
$tcurrencyRate = "";
$tcurrencySymbol = "";

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
        $Template = "./html/Updatetcurrency" . "search.htm";
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
    global $tcurrencyCountryID;
    $TemplateText = Replace($TemplateText, "@tcurrencyCountryID@", $tcurrencyCountryID);
    global $tcurrencyBranchID;
    $TemplateText = Replace($TemplateText, "@tcurrencyBranchID@", $tcurrencyBranchID);
    global $tcurrencyID;
    $TemplateText = Replace($TemplateText, "@tcurrencyID@", $tcurrencyID);
    global $tcurrencyDescription;
    $TemplateText = Replace($TemplateText, "@tcurrencyDescription@", $tcurrencyDescription);
    global $tcurrencyRate;
    $TemplateText = Replace($TemplateText, "@tcurrencyRate@", $tcurrencyRate);
    global $tcurrencySymbol;
    $TemplateText = Replace($TemplateText, "@tcurrencySymbol@", $tcurrencySymbol);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAttendanceStatuslist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetcurrency" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStcurrency);
ob_flush();
?>
