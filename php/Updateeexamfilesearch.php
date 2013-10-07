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
    $_SESSION["BrowseAssessment#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txteexamfileCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.CountryID LIKE " . chr(39) . getRequest("txteexamfileCountryID") . "%" . chr(39);
endif;

if (getRequest("txteexamfileBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.BranchID LIKE " . chr(39) . getRequest("txteexamfileBranchID") . "%" . chr(39);
endif;

if (getRequest("txteexamfileDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eexamfile.Date = " . chr(39) . getRequest("txteexamfileDate") . chr(39);
endif;

if (getRequest("txteexamfileTimeFrom") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.TimeFrom = " . getRequest("txteexamfileTimeFrom");
endif;

if (getRequest("txteexamfileTimeTo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.TimeTo = " . getRequest("txteexamfileTimeTo");
endif;

if (getRequest("txteexamfileVenue") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.Venue LIKE " . chr(39) . getRequest("txteexamfileVenue") . "%" . chr(39);
endif;

if (getRequest("txteexamfileOpenDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eexamfile.OpenDate = " . chr(39) . getRequest("txteexamfileOpenDate") . chr(39);
endif;

if (getRequest("txteexamfileCloseDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eexamfile.CloseDate = " . chr(39) . getRequest("txteexamfileCloseDate") . chr(39);
endif;

if (getRequest("txteexamfileSubmitDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eexamfile.SubmitDate = " . chr(39) . getRequest("txteexamfileSubmitDate") . chr(39);
endif;

if (getRequest("txteexamfileMenFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.MenFee = " . getRequest("txteexamfileMenFee");
endif;

if (getRequest("txteexamfileAbaFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.AbaFee = " . getRequest("txteexamfileAbaFee");
endif;

if (getRequest("txteexamfileAurFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.AurFee = " . getRequest("txteexamfileAurFee");
endif;

if (getRequest("txteexamfileTotal") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.Total = " . getRequest("txteexamfileTotal");
endif;

if (getRequest("txteexamfileRemarks") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamfile.Remarks LIKE " . chr(39) . getRequest("txteexamfileRemarks") . "%" . chr(39);
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
$oRSeexamfile = "";


$TemplateText = "";

$eexamfileCountryID = "";
$eexamfileBranchID = "";
$eexamfileDate = "";
$eexamfileTimeFrom = "";
$eexamfileTimeTo = "";
$eexamfileVenue = "";
$eexamfileOpenDate = "";
$eexamfileCloseDate = "";
$eexamfileSubmitDate = "";
$eexamfileMenFee = "";
$eexamfileAbaFee = "";
$eexamfileAurFee = "";
$eexamfileTotal = "";
$eexamfileRemarks = "";

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
        $Template = "./html/Updateeexamfile" . "search.htm";
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
    global $eexamfileCountryID;
    $TemplateText = Replace($TemplateText, "@eexamfileCountryID@", $eexamfileCountryID);
    global $eexamfileBranchID;
    $TemplateText = Replace($TemplateText, "@eexamfileBranchID@", $eexamfileBranchID);
    global $eexamfileDate;
    $TemplateText = Replace($TemplateText, "@eexamfileDate@", $eexamfileDate);
    global $eexamfileTimeFrom;
    $TemplateText = Replace($TemplateText, "@eexamfileTimeFrom@", $eexamfileTimeFrom);
    global $eexamfileTimeTo;
    $TemplateText = Replace($TemplateText, "@eexamfileTimeTo@", $eexamfileTimeTo);
    global $eexamfileVenue;
    $TemplateText = Replace($TemplateText, "@eexamfileVenue@", $eexamfileVenue);
    global $eexamfileOpenDate;
    $TemplateText = Replace($TemplateText, "@eexamfileOpenDate@", $eexamfileOpenDate);
    global $eexamfileCloseDate;
    $TemplateText = Replace($TemplateText, "@eexamfileCloseDate@", $eexamfileCloseDate);
    global $eexamfileSubmitDate;
    $TemplateText = Replace($TemplateText, "@eexamfileSubmitDate@", $eexamfileSubmitDate);
    global $eexamfileMenFee;
    $TemplateText = Replace($TemplateText, "@eexamfileMenFee@", $eexamfileMenFee);
    global $eexamfileAbaFee;
    $TemplateText = Replace($TemplateText, "@eexamfileAbaFee@", $eexamfileAbaFee);
    global $eexamfileAurFee;
    $TemplateText = Replace($TemplateText, "@eexamfileAurFee@", $eexamfileAurFee);
    global $eexamfileTotal;
    $TemplateText = Replace($TemplateText, "@eexamfileTotal@", $eexamfileTotal);
    global $eexamfileRemarks;
    $TemplateText = Replace($TemplateText, "@eexamfileRemarks@", $eexamfileRemarks);
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
$FormDeclaration .=  "Updateeexamfile" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRSeexamfile);
ob_flush();
?>
