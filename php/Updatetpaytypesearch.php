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


if (getRequest("txttpaytypeCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.CountryID LIKE " . chr(39) . getRequest("txttpaytypeCountryID") . "%" . chr(39);
endif;

if (getRequest("txttpaytypeBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.BranchID LIKE " . chr(39) . getRequest("txttpaytypeBranchID") . "%" . chr(39);
endif;

if (getRequest("txttpaytypePayType") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.PayType LIKE " . chr(39) . getRequest("txttpaytypePayType") . "%" . chr(39);
endif;

if (getRequest("txttpaytypeDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.Description LIKE " . chr(39) . getRequest("txttpaytypeDescription") . "%" . chr(39);
endif;

if (getRequest("txttpaytypeAmount") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.Amount = " . getRequest("txttpaytypeAmount");
endif;

if (getRequest("txttpaytypeCommAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.CommAmt = " . getRequest("txttpaytypeCommAmt");
endif;

if (getRequest("txttpaytypeSalesTax") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.SalesTax = " . getRequest("txttpaytypeSalesTax");
endif;

if (getRequest("txttpaytypeAccount") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.Account = " . getRequest("txttpaytypeAccount");
endif;

if (getRequest("txttpaytypeMTDQty") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.MTDQty = " . getRequest("txttpaytypeMTDQty");
endif;

if (getRequest("txttpaytypeMTDAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.MTDAmt = " . getRequest("txttpaytypeMTDAmt");
endif;

if (getRequest("txttpaytypeYTDQty") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.YTDQty = " . getRequest("txttpaytypeYTDQty");
endif;

if (getRequest("txttpaytypeYTDAmt") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.YTDAmt = " . getRequest("txttpaytypeYTDAmt");
endif;

if (getRequest("txttpaytypeType") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tpaytype.Type LIKE " . chr(39) . getRequest("txttpaytypeType") . "%" . chr(39);
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
$oRStpaytype = "";


$TemplateText = "";

$tpaytypeCountryID = "";
$tpaytypeBranchID = "";
$tpaytypePayType = "";
$tpaytypeDescription = "";
$tpaytypeAmount = "";
$tpaytypeCommAmt = "";
$tpaytypeSalesTax = "";
$tpaytypeAccount = "";
$tpaytypeMTDQty = "";
$tpaytypeMTDAmt = "";
$tpaytypeYTDQty = "";
$tpaytypeYTDAmt = "";
$tpaytypeType = "";

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
        $Template = "./html/Updatetpaytype" . "search.htm";
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
    global $tpaytypeCountryID;
    $TemplateText = Replace($TemplateText, "@tpaytypeCountryID@", $tpaytypeCountryID);
    global $tpaytypeBranchID;
    $TemplateText = Replace($TemplateText, "@tpaytypeBranchID@", $tpaytypeBranchID);
    global $tpaytypePayType;
    $TemplateText = Replace($TemplateText, "@tpaytypePayType@", $tpaytypePayType);
    global $tpaytypeDescription;
    $TemplateText = Replace($TemplateText, "@tpaytypeDescription@", $tpaytypeDescription);
    global $tpaytypeAmount;
    $TemplateText = Replace($TemplateText, "@tpaytypeAmount@", $tpaytypeAmount);
    global $tpaytypeCommAmt;
    $TemplateText = Replace($TemplateText, "@tpaytypeCommAmt@", $tpaytypeCommAmt);
    global $tpaytypeSalesTax;
    $TemplateText = Replace($TemplateText, "@tpaytypeSalesTax@", $tpaytypeSalesTax);
    global $tpaytypeAccount;
    $TemplateText = Replace($TemplateText, "@tpaytypeAccount@", $tpaytypeAccount);
    global $tpaytypeMTDQty;
    $TemplateText = Replace($TemplateText, "@tpaytypeMTDQty@", $tpaytypeMTDQty);
    global $tpaytypeMTDAmt;
    $TemplateText = Replace($TemplateText, "@tpaytypeMTDAmt@", $tpaytypeMTDAmt);
    global $tpaytypeYTDQty;
    $TemplateText = Replace($TemplateText, "@tpaytypeYTDQty@", $tpaytypeYTDQty);
    global $tpaytypeYTDAmt;
    $TemplateText = Replace($TemplateText, "@tpaytypeYTDAmt@", $tpaytypeYTDAmt);
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
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAssessmentlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetpaytype" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStpaytype);
ob_flush();
?>
