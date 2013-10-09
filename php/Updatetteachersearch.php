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


if (getRequest("txttteacherCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.CountryID LIKE " . chr(39) . getRequest("txttteacherCountryID") . "%" . chr(39);
endif;

if (getRequest("txttteacherBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.BranchID LIKE " . chr(39) . getRequest("txttteacherBranchID") . "%" . chr(39);
endif;

if (getRequest("txttteacherID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.ID LIKE " . chr(39) . getRequest("txttteacherID") . "%" . chr(39);
endif;

if (getRequest("txttteacherPassword") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.Password LIKE " . chr(39) . getRequest("txttteacherPassword") . "%" . chr(39);
endif;

if (getRequest("txttteacherName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.Name LIKE " . chr(39) . getRequest("txttteacherName") . "%" . chr(39);
endif;

if (getRequest("txttteacherLocalName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.LocalName LIKE " . chr(39) . getRequest("txttteacherLocalName") . "%" . chr(39);
endif;

if (getRequest("txttteacherDateStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " tteacher.DateStart = " . chr(39) . getRequest("txttteacherDateStart") . chr(39);
endif;

if (getRequest("txttteacherPhoneNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.PhoneNo LIKE " . chr(39) . getRequest("txttteacherPhoneNo") . "%" . chr(39);
endif;

if (getRequest("txttteacherMobileNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.MobileNo LIKE " . chr(39) . getRequest("txttteacherMobileNo") . "%" . chr(39);
endif;

if (getRequest("txttteacherEmail") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.Email LIKE " . chr(39) . getRequest("txttteacherEmail") . "%" . chr(39);
endif;

if (getRequest("txttteacherStatus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.Status = " . getRequest("txttteacherStatus");
endif;

if (getRequest("txttteacherRoleID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tteacher.RoleID = " . getRequest("txttteacherRoleID");
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
$oRStteacher = "";


$TemplateText = "";

$tteacherCountryID = "";
$tteacherBranchID = "";
$tteacherID = "";
$tteacherPassword = "";
$tteacherName = "";
$tteacherLocalName = "";
$tteacherDateStart = "";
$tteacherPhoneNo = "";
$tteacherMobileNo = "";
$tteacherEmail = "";
$tteacherStatus = "";
$tteacherRoleID = "";

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
        $Template = "./html/Updatetteacher" . "search.htm";
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
    global $tteacherCountryID;
    $TemplateText = Replace($TemplateText, "@tteacherCountryID@", $tteacherCountryID);
    global $tteacherBranchID;
    $TemplateText = Replace($TemplateText, "@tteacherBranchID@", $tteacherBranchID);
    global $tteacherID;
    $TemplateText = Replace($TemplateText, "@tteacherID@", $tteacherID);
    global $tteacherPassword;
    $TemplateText = Replace($TemplateText, "@tteacherPassword@", $tteacherPassword);
    global $tteacherName;
    $TemplateText = Replace($TemplateText, "@tteacherName@", $tteacherName);
    global $tteacherLocalName;
    $TemplateText = Replace($TemplateText, "@tteacherLocalName@", $tteacherLocalName);
    global $tteacherDateStart;
    $TemplateText = Replace($TemplateText, "@tteacherDateStart@", $tteacherDateStart);
    global $tteacherPhoneNo;
    $TemplateText = Replace($TemplateText, "@tteacherPhoneNo@", $tteacherPhoneNo);
    global $tteacherMobileNo;
    $TemplateText = Replace($TemplateText, "@tteacherMobileNo@", $tteacherMobileNo);
    global $tteacherEmail;
    $TemplateText = Replace($TemplateText, "@tteacherEmail@", $tteacherEmail);
    global $tteacherStatus;
    $TemplateText = Replace($TemplateText, "@tteacherStatus@", $tteacherStatus);
    global $tteacherRoleID;
    $TemplateText = Replace($TemplateText, "@tteacherRoleID@", $tteacherRoleID);
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
$FormDeclaration .=  "Updatetteacher" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStteacher);
ob_flush();
?>
