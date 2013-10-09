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


if (getRequest("txteexamregCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.CountryID LIKE " . chr(39) . getRequest("txteexamregCountryID") . "%" . chr(39);
endif;

if (getRequest("txteexamregBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.BranchID LIKE " . chr(39) . getRequest("txteexamregBranchID") . "%" . chr(39);
endif;

if (getRequest("txteexamregDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " eexamreg.Date = " . chr(39) . getRequest("txteexamregDate") . chr(39);
endif;

if (getRequest("txteexamregCustNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.CustNo = " . getRequest("txteexamregCustNo");
endif;

if (getRequest("txteexamregCateg") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Categ LIKE " . chr(39) . getRequest("txteexamregCateg") . "%" . chr(39);
endif;

if (getRequest("txteexamregCateg2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Categ2 LIKE " . chr(39) . getRequest("txteexamregCateg2") . "%" . chr(39);
endif;

if (getRequest("txteexamregCateg3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Categ3 LIKE " . chr(39) . getRequest("txteexamregCateg3") . "%" . chr(39);
endif;

if (getRequest("txteexamregGrade") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Grade = " . getRequest("txteexamregGrade");
endif;

if (getRequest("txteexamregGrade2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Grade2 = " . getRequest("txteexamregGrade2");
endif;

if (getRequest("txteexamregDigit") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Digit = " . getRequest("txteexamregDigit");
endif;

if (getRequest("txteexamregNumber") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Number = " . getRequest("txteexamregNumber");
endif;

if (getRequest("txteexamregMenFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.MenFee = " . getRequest("txteexamregMenFee");
endif;

if (getRequest("txteexamregAbaFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.AbaFee = " . getRequest("txteexamregAbaFee");
endif;

if (getRequest("txteexamregAurFee") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.AurFee = " . getRequest("txteexamregAurFee");
endif;

if (getRequest("txteexamregTeacID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.TeacID = " . getRequest("txteexamregTeacID");
endif;

if (getRequest("txteexamregTeacID2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.TeacID2 = " . getRequest("txteexamregTeacID2");
endif;

if (getRequest("txteexamregTeacID3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.TeacID3 = " . getRequest("txteexamregTeacID3");
endif;

if (getRequest("txteexamregRmID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.RmID = " . getRequest("txteexamregRmID");
endif;

if (getRequest("txteexamregRmID2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.RmID2 = " . getRequest("txteexamregRmID2");
endif;

if (getRequest("txteexamregRmID3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.RmID3 = " . getRequest("txteexamregRmID3");
endif;

if (getRequest("txteexamregExamCode") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.ExamCode LIKE " . chr(39) . getRequest("txteexamregExamCode") . "%" . chr(39);
endif;

if (getRequest("txteexamregExamCode2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.ExamCode2 LIKE " . chr(39) . getRequest("txteexamregExamCode2") . "%" . chr(39);
endif;

if (getRequest("txteexamregExamCode3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.ExamCode3 LIKE " . chr(39) . getRequest("txteexamregExamCode3") . "%" . chr(39);
endif;

if (getRequest("txteexamregRemarks") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " eexamreg.Remarks LIKE " . chr(39) . getRequest("txteexamregRemarks") . "%" . chr(39);
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
$oRSeexamreg = "";


$TemplateText = "";

$eexamregCountryID = "";
$eexamregBranchID = "";
$eexamregDate = "";
$eexamregCustNo = "";
$eexamregCateg = "";
$eexamregCateg2 = "";
$eexamregCateg3 = "";
$eexamregGrade = "";
$eexamregGrade2 = "";
$eexamregDigit = "";
$eexamregNumber = "";
$eexamregMenFee = "";
$eexamregAbaFee = "";
$eexamregAurFee = "";
$eexamregTeacID = "";
$eexamregTeacID2 = "";
$eexamregTeacID3 = "";
$eexamregRmID = "";
$eexamregRmID2 = "";
$eexamregRmID3 = "";
$eexamregExamCode = "";
$eexamregExamCode2 = "";
$eexamregExamCode3 = "";
$eexamregRemarks = "";

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
        $Template = "./html/Updateeexamreg" . "search.htm";
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
    global $eexamregCountryID;
    $TemplateText = Replace($TemplateText, "@eexamregCountryID@", $eexamregCountryID);
    global $eexamregBranchID;
    $TemplateText = Replace($TemplateText, "@eexamregBranchID@", $eexamregBranchID);
    global $eexamregDate;
    $TemplateText = Replace($TemplateText, "@eexamregDate@", $eexamregDate);
    global $eexamregCustNo;
    $TemplateText = Replace($TemplateText, "@eexamregCustNo@", $eexamregCustNo);
    global $eexamregCateg;
    $TemplateText = Replace($TemplateText, "@eexamregCateg@", $eexamregCateg);
    global $eexamregCateg2;
    $TemplateText = Replace($TemplateText, "@eexamregCateg2@", $eexamregCateg2);
    global $eexamregCateg3;
    $TemplateText = Replace($TemplateText, "@eexamregCateg3@", $eexamregCateg3);
    global $eexamregGrade;
    $TemplateText = Replace($TemplateText, "@eexamregGrade@", $eexamregGrade);
    global $eexamregGrade2;
    $TemplateText = Replace($TemplateText, "@eexamregGrade2@", $eexamregGrade2);
    global $eexamregDigit;
    $TemplateText = Replace($TemplateText, "@eexamregDigit@", $eexamregDigit);
    global $eexamregNumber;
    $TemplateText = Replace($TemplateText, "@eexamregNumber@", $eexamregNumber);
    global $eexamregMenFee;
    $TemplateText = Replace($TemplateText, "@eexamregMenFee@", $eexamregMenFee);
    global $eexamregAbaFee;
    $TemplateText = Replace($TemplateText, "@eexamregAbaFee@", $eexamregAbaFee);
    global $eexamregAurFee;
    $TemplateText = Replace($TemplateText, "@eexamregAurFee@", $eexamregAurFee);
    global $eexamregTeacID;
    $TemplateText = Replace($TemplateText, "@eexamregTeacID@", $eexamregTeacID);
    global $eexamregTeacID2;
    $TemplateText = Replace($TemplateText, "@eexamregTeacID2@", $eexamregTeacID2);
    global $eexamregTeacID3;
    $TemplateText = Replace($TemplateText, "@eexamregTeacID3@", $eexamregTeacID3);
    global $eexamregRmID;
    $TemplateText = Replace($TemplateText, "@eexamregRmID@", $eexamregRmID);
    global $eexamregRmID2;
    $TemplateText = Replace($TemplateText, "@eexamregRmID2@", $eexamregRmID2);
    global $eexamregRmID3;
    $TemplateText = Replace($TemplateText, "@eexamregRmID3@", $eexamregRmID3);
    global $eexamregExamCode;
    $TemplateText = Replace($TemplateText, "@eexamregExamCode@", $eexamregExamCode);
    global $eexamregExamCode2;
    $TemplateText = Replace($TemplateText, "@eexamregExamCode2@", $eexamregExamCode2);
    global $eexamregExamCode3;
    $TemplateText = Replace($TemplateText, "@eexamregExamCode3@", $eexamregExamCode3);
    global $eexamregRemarks;
    $TemplateText = Replace($TemplateText, "@eexamregRemarks@", $eexamregRemarks);
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
$FormDeclaration .=  "Updateeexamreg" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRSeexamreg);
ob_flush();
?>
