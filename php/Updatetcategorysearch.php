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
    $_SESSION["BrowseCategory#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttcategoryCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcategory.CountryID LIKE " . chr(39) . getRequest("txttcategoryCountryID") . "%" . chr(39);
endif;

if (getRequest("txttcategoryBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcategory.BranchID LIKE " . chr(39) . getRequest("txttcategoryBranchID") . "%" . chr(39);
endif;

if (getRequest("txttcategoryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcategory.ID LIKE " . chr(39) . getRequest("txttcategoryID") . "%" . chr(39);
endif;

if (getRequest("txttcategoryDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcategory.Description LIKE " . chr(39) . getRequest("txttcategoryDescription") . "%" . chr(39);
endif;
$_SESSION["BrowseCategory#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseCategorylist.php");
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
$oRStcategory = "";


$TemplateText = "";

$tcategoryCountryID = "";
$tcategoryBranchID = "";
$tcategoryID = "";
$tcategoryDescription = "";

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
        $Template = "./html/Updatetcategory" . "search.htm";
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
    global $tcategoryCountryID;
    $TemplateText = Replace($TemplateText, "@tcategoryCountryID@", $tcategoryCountryID);
    global $tcategoryBranchID;
    $TemplateText = Replace($TemplateText, "@tcategoryBranchID@", $tcategoryBranchID);
    global $tcategoryID;
    $TemplateText = Replace($TemplateText, "@tcategoryID@", $tcategoryID);
    global $tcategoryDescription;
    $TemplateText = Replace($TemplateText, "@tcategoryDescription@", $tcategoryDescription);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseCategorylist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetcategory" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStcategory);
ob_flush();
?>
