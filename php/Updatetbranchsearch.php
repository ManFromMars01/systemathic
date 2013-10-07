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
    $_SESSION["Browsetbranch#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttbranchCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.CountryID LIKE " . chr(39) . getRequest("txttbranchCountryID") . "%" . chr(39);
endif;

if (getRequest("txttbranchBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.BranchID LIKE " . chr(39) . getRequest("txttbranchBranchID") . "%" . chr(39);
endif;

if (getRequest("txttbranchDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.Description LIKE " . chr(39) . getRequest("txttbranchDescription") . "%" . chr(39);
endif;

if (getRequest("txttbranchPhone") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.Phone LIKE " . chr(39) . getRequest("txttbranchPhone") . "%" . chr(39);
endif;

if (getRequest("txttbranchEmail") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.Email LIKE " . chr(39) . getRequest("txttbranchEmail") . "%" . chr(39);
endif;

if (getRequest("txttbranchContact") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.Contact LIKE " . chr(39) . getRequest("txttbranchContact") . "%" . chr(39);
endif;

if (getRequest("txttbranchHQOperation") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.HQOperation LIKE " . chr(39) . getRequest("txttbranchHQOperation") . "%" . chr(39);
endif;

if (getRequest("txttbranchHQCenterOperation") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tbranch.HQCenterOperation LIKE " . chr(39) . getRequest("txttbranchHQCenterOperation") . "%" . chr(39);
endif;
$_SESSION["Browsetbranch#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."Browsetbranchlist.php");
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
$oRStbranch = "";


$TemplateText = "";

$tbranchCountryID = "";
$tbranchBranchID = "";
$tbranchDescription = "";
$tbranchPhone = "";
$tbranchEmail = "";
$tbranchContact = "";
$tbranchHQOperation = "";
$tbranchHQCenterOperation = "";

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
        $Template = "./html/Updatetbranch" . "search.htm";
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
    global $tbranchCountryID;
    $TemplateText = Replace($TemplateText, "@tbranchCountryID@", $tbranchCountryID);
    global $tbranchBranchID;
    $TemplateText = Replace($TemplateText, "@tbranchBranchID@", $tbranchBranchID);
    global $tbranchDescription;
    $TemplateText = Replace($TemplateText, "@tbranchDescription@", $tbranchDescription);
    global $tbranchPhone;
    $TemplateText = Replace($TemplateText, "@tbranchPhone@", $tbranchPhone);
    global $tbranchEmail;
    $TemplateText = Replace($TemplateText, "@tbranchEmail@", $tbranchEmail);
    global $tbranchContact;
    $TemplateText = Replace($TemplateText, "@tbranchContact@", $tbranchContact);
    global $tbranchHQOperation;
    $TemplateText = Replace($TemplateText, "@tbranchHQOperation@", $tbranchHQOperation);
    global $tbranchHQCenterOperation;
    $TemplateText = Replace($TemplateText, "@tbranchHQCenterOperation@", $tbranchHQCenterOperation);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"Browsetbranchlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetbranch" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStbranch);
ob_flush();
?>
