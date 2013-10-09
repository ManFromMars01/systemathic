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
    $_SESSION["BrowseSchoolCalendar#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttcalendarCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcalendar.CountryID LIKE " . chr(39) . getRequest("txttcalendarCountryID") . "%" . chr(39);
endif;

if (getRequest("txttcalendarBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcalendar.BranchID LIKE " . chr(39) . getRequest("txttcalendarBranchID") . "%" . chr(39);
endif;

if (getRequest("txttcalendarDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " tcalendar.Date = " . chr(39) . getRequest("txttcalendarDate") . chr(39);
endif;

if (getRequest("txttcalendarDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcalendar.Description LIKE " . chr(39) . getRequest("txttcalendarDescription") . "%" . chr(39);
endif;

if (getRequest("txttcalendarType") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcalendar.Type LIKE " . chr(39) . getRequest("txttcalendarType") . "%" . chr(39);
endif;
$_SESSION["BrowseSchoolCalendar#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseSchoolCalendarlist.php");
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
$oRStcalendar = "";


$TemplateText = "";

$tcalendarCountryID = "";
$tcalendarBranchID = "";
$tcalendarDate = "";
$tcalendarDescription = "";
$tcalendarType = "";

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
        $Template = "./html/Updatetcalendar" . "search.htm";
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
    global $tcalendarCountryID;
    $TemplateText = Replace($TemplateText, "@tcalendarCountryID@", $tcalendarCountryID);
    global $tcalendarBranchID;
    $TemplateText = Replace($TemplateText, "@tcalendarBranchID@", $tcalendarBranchID);
    global $tcalendarDate;
    $TemplateText = Replace($TemplateText, "@tcalendarDate@", $tcalendarDate);
    global $tcalendarDescription;
    $TemplateText = Replace($TemplateText, "@tcalendarDescription@", $tcalendarDescription);
    global $tcalendarType;
    if($tcalendarType == "Regular_Holiday"):
        $SELECTEDF21_5_1 = "SELECTED";
    else:
        $SELECTEDF21_5_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_1@", $SELECTEDF21_5_1);
    if($tcalendarType == "Regular_Holiday_on_Rest_Day"):
        $SELECTEDF21_5_2 = "SELECTED";
    else:
        $SELECTEDF21_5_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_2@", $SELECTEDF21_5_2);
    if($tcalendarType == "Special_Holiday"):
        $SELECTEDF21_5_3 = "SELECTED";
    else:
        $SELECTEDF21_5_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_3@", $SELECTEDF21_5_3);
    if($tcalendarType == "Special_Holiday_on_Rest_Day"):
        $SELECTEDF21_5_4 = "SELECTED";
    else:
        $SELECTEDF21_5_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_4@", $SELECTEDF21_5_4);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseSchoolCalendarlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetcalendar" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStcalendar);
ob_flush();
?>
