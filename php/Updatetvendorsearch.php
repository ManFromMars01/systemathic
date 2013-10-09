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


if (getRequest("txttvendorCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.CountryID LIKE " . chr(39) . getRequest("txttvendorCountryID") . "%" . chr(39);
endif;

if (getRequest("txttvendorBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.BranchID LIKE " . chr(39) . getRequest("txttvendorBranchID") . "%" . chr(39);
endif;

if (getRequest("txttvendorID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.ID = " . getRequest("txttvendorID");
endif;

if (getRequest("txttvendorName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Name LIKE " . chr(39) . getRequest("txttvendorName") . "%" . chr(39);
endif;

if (getRequest("txttvendorAddress1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Address1 LIKE " . chr(39) . getRequest("txttvendorAddress1") . "%" . chr(39);
endif;

if (getRequest("txttvendorAddress2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Address2 LIKE " . chr(39) . getRequest("txttvendorAddress2") . "%" . chr(39);
endif;

if (getRequest("txttvendorCity") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.City LIKE " . chr(39) . getRequest("txttvendorCity") . "%" . chr(39);
endif;

if (getRequest("txttvendorZip") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Zip LIKE " . chr(39) . getRequest("txttvendorZip") . "%" . chr(39);
endif;

if (getRequest("txttvendorFax") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Fax LIKE " . chr(39) . getRequest("txttvendorFax") . "%" . chr(39);
endif;

if (getRequest("txttvendorPhone") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Phone LIKE " . chr(39) . getRequest("txttvendorPhone") . "%" . chr(39);
endif;

if (getRequest("txttvendorRmtAdd1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.RmtAdd1 LIKE " . chr(39) . getRequest("txttvendorRmtAdd1") . "%" . chr(39);
endif;

if (getRequest("txttvendorRmtAdd2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.RmtAdd2 LIKE " . chr(39) . getRequest("txttvendorRmtAdd2") . "%" . chr(39);
endif;

if (getRequest("txttvendorRmtZip") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.RmtZip LIKE " . chr(39) . getRequest("txttvendorRmtZip") . "%" . chr(39);
endif;

if (getRequest("txttvendorRmtCity") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.RmtCity LIKE " . chr(39) . getRequest("txttvendorRmtCity") . "%" . chr(39);
endif;

if (getRequest("txttvendorContact") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.Contact LIKE " . chr(39) . getRequest("txttvendorContact") . "%" . chr(39);
endif;

if (getRequest("txttvendorDiscountPct") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.DiscountPct = " . getRequest("txttvendorDiscountPct");
endif;

if (getRequest("txttvendorDiscountDays") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tvendor.DiscountDays = " . getRequest("txttvendorDiscountDays");
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
$oRStvendor = "";


$TemplateText = "";

$tvendorCountryID = "";
$tvendorBranchID = "";
$tvendorID = "";
$tvendorName = "";
$tvendorAddress1 = "";
$tvendorAddress2 = "";
$tvendorCity = "";
$tvendorZip = "";
$tvendorFax = "";
$tvendorPhone = "";
$tvendorRmtAdd1 = "";
$tvendorRmtAdd2 = "";
$tvendorRmtZip = "";
$tvendorRmtCity = "";
$tvendorContact = "";
$tvendorDiscountPct = "";
$tvendorDiscountDays = "";

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
        $Template = "./html/Updatetvendor" . "search.htm";
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
    global $tvendorCountryID;
    $TemplateText = Replace($TemplateText, "@tvendorCountryID@", $tvendorCountryID);
    global $tvendorBranchID;
    $TemplateText = Replace($TemplateText, "@tvendorBranchID@", $tvendorBranchID);
    global $tvendorID;
    $TemplateText = Replace($TemplateText, "@tvendorID@", $tvendorID);
    global $tvendorName;
    $TemplateText = Replace($TemplateText, "@tvendorName@", $tvendorName);
    global $tvendorAddress1;
    $TemplateText = Replace($TemplateText, "@tvendorAddress1@", $tvendorAddress1);
    global $tvendorAddress2;
    $TemplateText = Replace($TemplateText, "@tvendorAddress2@", $tvendorAddress2);
    global $tvendorCity;
    $TemplateText = Replace($TemplateText, "@tvendorCity@", $tvendorCity);
    global $tvendorZip;
    $TemplateText = Replace($TemplateText, "@tvendorZip@", $tvendorZip);
    global $tvendorFax;
    $TemplateText = Replace($TemplateText, "@tvendorFax@", $tvendorFax);
    global $tvendorPhone;
    $TemplateText = Replace($TemplateText, "@tvendorPhone@", $tvendorPhone);
    global $tvendorRmtAdd1;
    $TemplateText = Replace($TemplateText, "@tvendorRmtAdd1@", $tvendorRmtAdd1);
    global $tvendorRmtAdd2;
    $TemplateText = Replace($TemplateText, "@tvendorRmtAdd2@", $tvendorRmtAdd2);
    global $tvendorRmtZip;
    $TemplateText = Replace($TemplateText, "@tvendorRmtZip@", $tvendorRmtZip);
    global $tvendorRmtCity;
    $TemplateText = Replace($TemplateText, "@tvendorRmtCity@", $tvendorRmtCity);
    global $tvendorContact;
    $TemplateText = Replace($TemplateText, "@tvendorContact@", $tvendorContact);
    global $tvendorDiscountPct;
    $TemplateText = Replace($TemplateText, "@tvendorDiscountPct@", $tvendorDiscountPct);
    global $tvendorDiscountDays;
    $TemplateText = Replace($TemplateText, "@tvendorDiscountDays@", $tvendorDiscountDays);
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
$FormDeclaration .=  "Updatetvendor" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStvendor);
ob_flush();
?>
