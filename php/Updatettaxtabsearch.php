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
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txtttaxtabCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.CountryID LIKE " . chr(39) . getRequest("txtttaxtabCountryID") . "%" . chr(39);
endif;

if (getRequest("txtttaxtabBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.BranchID LIKE " . chr(39) . getRequest("txtttaxtabBranchID") . "%" . chr(39);
endif;

if (getRequest("txtttaxtabTaxID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.TaxID LIKE " . chr(39) . getRequest("txtttaxtabTaxID") . "%" . chr(39);
endif;

if (getRequest("txtttaxtabDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.Description LIKE " . chr(39) . getRequest("txtttaxtabDescription") . "%" . chr(39);
endif;

if (getRequest("txtttaxtabRate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.Rate = " . getRequest("txtttaxtabRate");
endif;

if (getRequest("txtttaxtabDept") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.Dept = " . getRequest("txtttaxtabDept");
endif;

if (getRequest("txtttaxtabAccount") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.Account = " . getRequest("txtttaxtabAccount");
endif;

if (getRequest("txtttaxtabCurrTaxAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.CurrTaxAmt = " . getRequest("txtttaxtabCurrTaxAmt");
endif;

if (getRequest("txtttaxtabMTDTaxAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.MTDTaxAmt = " . getRequest("txtttaxtabMTDTaxAmt");
endif;

if (getRequest("txtttaxtabYTDTaxAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.YTDTaxAmt = " . getRequest("txtttaxtabYTDTaxAmt");
endif;

if (getRequest("txtttaxtabStatus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " ttaxtab.Status LIKE " . chr(39) . getRequest("txtttaxtabStatus") . "%" . chr(39);
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
$oRSttaxtab = "";


$TemplateText = "";

$ttaxtabCountryID = "";
$ttaxtabBranchID = "";
$ttaxtabTaxID = "";
$ttaxtabDescription = "";
$ttaxtabRate = "";
$ttaxtabDept = "";
$ttaxtabAccount = "";
$ttaxtabCurrTaxAmt = "";
$ttaxtabMTDTaxAmt = "";
$ttaxtabYTDTaxAmt = "";
$ttaxtabStatus = "";

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
        $Template = "./html/Updatettaxtab" . "search.htm";
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
    global $ttaxtabCountryID;
    $TemplateText = Replace($TemplateText, "@ttaxtabCountryID@", $ttaxtabCountryID);
    global $ttaxtabBranchID;
    $TemplateText = Replace($TemplateText, "@ttaxtabBranchID@", $ttaxtabBranchID);
    global $ttaxtabTaxID;
    $TemplateText = Replace($TemplateText, "@ttaxtabTaxID@", $ttaxtabTaxID);
    global $ttaxtabDescription;
    $TemplateText = Replace($TemplateText, "@ttaxtabDescription@", $ttaxtabDescription);
    global $ttaxtabRate;
    $TemplateText = Replace($TemplateText, "@ttaxtabRate@", $ttaxtabRate);
    global $ttaxtabDept;
    $TemplateText = Replace($TemplateText, "@ttaxtabDept@", $ttaxtabDept);
    global $ttaxtabAccount;
    $TemplateText = Replace($TemplateText, "@ttaxtabAccount@", $ttaxtabAccount);
    global $ttaxtabCurrTaxAmt;
    $TemplateText = Replace($TemplateText, "@ttaxtabCurrTaxAmt@", $ttaxtabCurrTaxAmt);
    global $ttaxtabMTDTaxAmt;
    $TemplateText = Replace($TemplateText, "@ttaxtabMTDTaxAmt@", $ttaxtabMTDTaxAmt);
    global $ttaxtabYTDTaxAmt;
    $TemplateText = Replace($TemplateText, "@ttaxtabYTDTaxAmt@", $ttaxtabYTDTaxAmt);
    global $ttaxtabStatus;
    $TemplateText = Replace($TemplateText, "@ttaxtabStatus@", $ttaxtabStatus);
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
$FormDeclaration .=  "Updatettaxtab" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRSttaxtab);
ob_flush();
?>
