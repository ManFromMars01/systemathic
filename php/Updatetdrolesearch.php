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
    $_SESSION["BrowseTDRole#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttdroleCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.CountryID LIKE " . chr(39) . getRequest("txttdroleCountryID") . "%" . chr(39);
endif;

if (getRequest("txttdroleBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.BranchID LIKE " . chr(39) . getRequest("txttdroleBranchID") . "%" . chr(39);
endif;

if (getRequest("txttdroleRoleID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.RoleID LIKE " . chr(39) . getRequest("txttdroleRoleID") . "%" . chr(39);
endif;

if (getRequest("txttdrolePageName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.PageName LIKE " . chr(39) . getRequest("txttdrolePageName") . "%" . chr(39);
endif;

if (getRequest("txttdroleInsertPrev") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.InsertPrev LIKE " . chr(39) . getRequest("txttdroleInsertPrev") . "%" . chr(39);
endif;

if (getRequest("txttdroleEditPrev") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.EditPrev LIKE " . chr(39) . getRequest("txttdroleEditPrev") . "%" . chr(39);
endif;

if (getRequest("txttdroleDeletePrev") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.DeletePrev LIKE " . chr(39) . getRequest("txttdroleDeletePrev") . "%" . chr(39);
endif;

if (getRequest("txttdroleViewPrev") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tdrole.ViewPrev LIKE " . chr(39) . getRequest("txttdroleViewPrev") . "%" . chr(39);
endif;
$_SESSION["BrowseTDRole#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseTDRolelist.php");
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
$oRStdrole = "";


$TemplateText = "";

$tdroleCountryID = "";
$tdroleBranchID = "";
$tdroleRoleID = "";
$tdrolePageName = "";
$tdroleInsertPrev = "";
$tdroleEditPrev = "";
$tdroleDeletePrev = "";
$tdroleViewPrev = "";

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
    global $userdata1;
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdrole" . "search.htm";
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
    global $tdroleCountryID;
    $TemplateText = Replace($TemplateText, "@tdroleCountryID@", $tdroleCountryID);
    global $tdroleBranchID;
    $TemplateText = Replace($TemplateText, "@tdroleBranchID@", $tdroleBranchID);
    global $tdroleRoleID;
    $TemplateText = Replace($TemplateText, "@tdroleRoleID@", $tdroleRoleID);
    global $tdrolePageName;
    $TemplateText = Replace($TemplateText, "@tdrolePageName@", $tdrolePageName);
    global $tdroleInsertPrev;
    $TemplateText = Replace($TemplateText, "@tdroleInsertPrev@", $tdroleInsertPrev);
        if($tdroleInsertPrev == "Y"):
            $SELECTEDtdroleInsertPrevY = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevY@", $SELECTEDtdroleInsertPrevY);
        if($tdroleInsertPrev == "N"):
            $SELECTEDtdroleInsertPrevN = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevN@", $SELECTEDtdroleInsertPrevN);
    global $tdroleEditPrev;
    $TemplateText = Replace($TemplateText, "@tdroleEditPrev@", $tdroleEditPrev);
        if($tdroleEditPrev == "Y"):
            $SELECTEDtdroleEditPrevY = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevY@", $SELECTEDtdroleEditPrevY);
        if($tdroleEditPrev == "N"):
            $SELECTEDtdroleEditPrevN = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevN@", $SELECTEDtdroleEditPrevN);
    global $tdroleDeletePrev;
    $TemplateText = Replace($TemplateText, "@tdroleDeletePrev@", $tdroleDeletePrev);
        if($tdroleDeletePrev == "Y"):
            $SELECTEDtdroleDeletePrevY = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevY@", $SELECTEDtdroleDeletePrevY);
        if($tdroleDeletePrev == "N"):
            $SELECTEDtdroleDeletePrevN = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevN@", $SELECTEDtdroleDeletePrevN);
    global $tdroleViewPrev;
    $TemplateText = Replace($TemplateText, "@tdroleViewPrev@", $tdroleViewPrev);
        if($tdroleViewPrev == "Y"):
            $SELECTEDtdroleViewPrevY = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevY@", $SELECTEDtdroleViewPrevY);
        if($tdroleViewPrev == "N"):
            $SELECTEDtdroleViewPrevN = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevN@", $SELECTEDtdroleViewPrevN);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseTDRolelist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetdrole" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStdrole);
ob_flush();
?>
