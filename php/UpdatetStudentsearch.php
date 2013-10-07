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
    $_SESSION["BrowseStudent#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttcustomerCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.CountryID LIKE " . chr(39) . getRequest("txttcustomerCountryID") . "%" . chr(39);
endif;

if (getRequest("txttcustomerBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.BranchID LIKE " . chr(39) . getRequest("txttcustomerBranchID") . "%" . chr(39);
endif;

if (getRequest("txttcustomerCustNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.CustNo = " . getRequest("txttcustomerCustNo");
endif;

if (getRequest("txttcustomerStudentID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.StudentID LIKE " . chr(39) . getRequest("txttcustomerStudentID") . "%" . chr(39);
endif;

if (getRequest("txttcustomerSurName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.SurName LIKE " . chr(39) . getRequest("txttcustomerSurName") . "%" . chr(39);
endif;

if (getRequest("txttcustomerFirstName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.FirstName LIKE " . chr(39) . getRequest("txttcustomerFirstName") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMiddleName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.MiddleName LIKE " . chr(39) . getRequest("txttcustomerMiddleName") . "%" . chr(39);
endif;

if (getRequest("txttcustomerLSurname") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.LSurname LIKE " . chr(39) . getRequest("txttcustomerLSurname") . "%" . chr(39);
endif;

if (getRequest("txttcustomerLFirstName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.LFirstName LIKE " . chr(39) . getRequest("txttcustomerLFirstName") . "%" . chr(39);
endif;

if (getRequest("txttcustomerLMiddleName") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.LMiddleName LIKE " . chr(39) . getRequest("txttcustomerLMiddleName") . "%" . chr(39);
endif;

if (getRequest("txttcustomerGender") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Gender LIKE " . chr(39) . getRequest("txttcustomerGender") . "%" . chr(39);
endif;

if (getRequest("txttcustomerBirthday") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " tcustomer.Birthday = " . chr(39) . getRequest("txttcustomerBirthday") . chr(39);
endif;

if (getRequest("txttcustomerCity") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.City LIKE " . chr(39) . getRequest("txttcustomerCity") . "%" . chr(39);
endif;

if (getRequest("txttcustomerZip") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Zip LIKE " . chr(39) . getRequest("txttcustomerZip") . "%" . chr(39);
endif;

if (getRequest("txttcustomerPhone") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Phone LIKE " . chr(39) . getRequest("txttcustomerPhone") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMobile") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Mobile LIKE " . chr(39) . getRequest("txttcustomerMobile") . "%" . chr(39);
endif;

if (getRequest("txttcustomerEmail") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Email LIKE " . chr(39) . getRequest("txttcustomerEmail") . "%" . chr(39);
endif;

if (getRequest("txttcustomerLevelID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.LevelID = " . getRequest("txttcustomerLevelID");
endif;

if (getRequest("txttcustomerTierID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.TierID = " . getRequest("txttcustomerTierID");
endif;

if (getRequest("txttcustomerCustType") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.CustType LIKE " . chr(39) . getRequest("txttcustomerCustType") . "%" . chr(39);
endif;

if (getRequest("txttcustomerRegType") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.RegType LIKE " . chr(39) . getRequest("txttcustomerRegType") . "%" . chr(39);
endif;

if (getRequest("txttcustomerSchool") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.School LIKE " . chr(39) . getRequest("txttcustomerSchool") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMother") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Mother LIKE " . chr(39) . getRequest("txttcustomerMother") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMOccupation") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.MOccupation LIKE " . chr(39) . getRequest("txttcustomerMOccupation") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMMobile") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.MMobile LIKE " . chr(39) . getRequest("txttcustomerMMobile") . "%" . chr(39);
endif;

if (getRequest("txttcustomerMEmail") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.MEmail LIKE " . chr(39) . getRequest("txttcustomerMEmail") . "%" . chr(39);
endif;

if (getRequest("txttcustomerFather") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Father LIKE " . chr(39) . getRequest("txttcustomerFather") . "%" . chr(39);
endif;

if (getRequest("txttcustomerFOccupation") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.FOccupation LIKE " . chr(39) . getRequest("txttcustomerFOccupation") . "%" . chr(39);
endif;

if (getRequest("txttcustomerFMobile") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.FMobile LIKE " . chr(39) . getRequest("txttcustomerFMobile") . "%" . chr(39);
endif;

if (getRequest("txttcustomerFEmail") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.FEmail LIKE " . chr(39) . getRequest("txttcustomerFEmail") . "%" . chr(39);
endif;

if (getRequest("txttcustomerStatus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.Status LIKE " . chr(39) . getRequest("txttcustomerStatus") . "%" . chr(39);
endif;

if (getRequest("txttcustomerReferralID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " tcustomer.ReferralID = " . getRequest("txttcustomerReferralID");
endif;

if (getRequest("txttcustomerStoppedDate") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
        $myWhere .= " tcustomer.StoppedDate = " . chr(39) . getRequest("txttcustomerStoppedDate") . chr(39);
endif;
$_SESSION["BrowseStudent#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseStudentlist.php");
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
$oRStcustomer = "";


$TemplateText = "";

$tcustomerCountryID = "";
$tcustomerBranchID = "";
$tcustomerCustNo = "";
$tcustomerStudentID = "";
$tcustomerSurName = "";
$tcustomerFirstName = "";
$tcustomerMiddleName = "";
$tcustomerLSurname = "";
$tcustomerLFirstName = "";
$tcustomerLMiddleName = "";
$tcustomerGender = "";
$tcustomerBirthday = "";
$tcustomerCity = "";
$tcustomerZip = "";
$tcustomerPhone = "";
$tcustomerMobile = "";
$tcustomerEmail = "";
$tcustomerLevelID = "";
$tcustomerTierID = "";
$tcustomerCustType = "";
$tcustomerRegType = "";
$tcustomerSchool = "";
$tcustomerMother = "";
$tcustomerMOccupation = "";
$tcustomerMMobile = "";
$tcustomerMEmail = "";
$tcustomerFather = "";
$tcustomerFOccupation = "";
$tcustomerFMobile = "";
$tcustomerFEmail = "";
$tcustomerStatus = "";
$tcustomerReferralID = "";
$tcustomerStoppedDate = "";

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
        $Template = "./html/UpdatetStudent" . "search.htm";
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
    global $tcustomerCountryID;
    $TemplateText = Replace($TemplateText, "@tcustomerCountryID@", $tcustomerCountryID);
    global $tcustomerBranchID;
    $TemplateText = Replace($TemplateText, "@tcustomerBranchID@", $tcustomerBranchID);
    global $tcustomerCustNo;
    $TemplateText = Replace($TemplateText, "@tcustomerCustNo@", $tcustomerCustNo);
    global $tcustomerStudentID;
    $TemplateText = Replace($TemplateText, "@tcustomerStudentID@", $tcustomerStudentID);
    global $tcustomerSurName;
    $TemplateText = Replace($TemplateText, "@tcustomerSurName@", $tcustomerSurName);
    global $tcustomerFirstName;
    $TemplateText = Replace($TemplateText, "@tcustomerFirstName@", $tcustomerFirstName);
    global $tcustomerMiddleName;
    $TemplateText = Replace($TemplateText, "@tcustomerMiddleName@", $tcustomerMiddleName);
    global $tcustomerLSurname;
    $TemplateText = Replace($TemplateText, "@tcustomerLSurname@", $tcustomerLSurname);
    global $tcustomerLFirstName;
    $TemplateText = Replace($TemplateText, "@tcustomerLFirstName@", $tcustomerLFirstName);
    global $tcustomerLMiddleName;
    $TemplateText = Replace($TemplateText, "@tcustomerLMiddleName@", $tcustomerLMiddleName);
    global $tcustomerGender;
    if($tcustomerGender == "Male"):
        $SELECTEDF28_11_1 = "SELECTED";
    else:
        $SELECTEDF28_11_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_11_1@", $SELECTEDF28_11_1);
    if($tcustomerGender == "Female"):
        $SELECTEDF28_11_2 = "SELECTED";
    else:
        $SELECTEDF28_11_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_11_2@", $SELECTEDF28_11_2);
    global $tcustomerBirthday;
    $TemplateText = Replace($TemplateText, "@tcustomerBirthday@", $tcustomerBirthday);
    global $tcustomerCity;
    $TemplateText = Replace($TemplateText, "@tcustomerCity@", $tcustomerCity);
    global $tcustomerZip;
    $TemplateText = Replace($TemplateText, "@tcustomerZip@", $tcustomerZip);
    global $tcustomerPhone;
    $TemplateText = Replace($TemplateText, "@tcustomerPhone@", $tcustomerPhone);
    global $tcustomerMobile;
    $TemplateText = Replace($TemplateText, "@tcustomerMobile@", $tcustomerMobile);
    global $tcustomerEmail;
    $TemplateText = Replace($TemplateText, "@tcustomerEmail@", $tcustomerEmail);
    global $tcustomerLevelID;
    $TemplateText = Replace($TemplateText, "@tcustomerLevelID@", $tcustomerLevelID);
    global $tcustomerTierID;
    $TemplateText = Replace($TemplateText, "@tcustomerTierID@", $tcustomerTierID);
    global $tcustomerCustType;
    if($tcustomerCustType == "Assessment"):
        $SELECTEDF28_20_1 = "SELECTED";
    else:
        $SELECTEDF28_20_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_20_1@", $SELECTEDF28_20_1);
    if($tcustomerCustType == "Trial_Class"):
        $SELECTEDF28_20_2 = "SELECTED";
    else:
        $SELECTEDF28_20_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_20_2@", $SELECTEDF28_20_2);
    if($tcustomerCustType == "For_Admission"):
        $SELECTEDF28_20_3 = "SELECTED";
    else:
        $SELECTEDF28_20_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_20_3@", $SELECTEDF28_20_3);
    if($tcustomerCustType == "ReEnrollee"):
        $SELECTEDF28_20_4 = "SELECTED";
    else:
        $SELECTEDF28_20_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_20_4@", $SELECTEDF28_20_4);
    if($tcustomerCustType == "Continuing"):
        $SELECTEDF28_20_5 = "SELECTED";
    else:
        $SELECTEDF28_20_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_20_5@", $SELECTEDF28_20_5);
    global $tcustomerRegType;
    if($tcustomerRegType == "Waiting"):
        $SELECTEDF28_21_1 = "SELECTED";
    else:
        $SELECTEDF28_21_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_1@", $SELECTEDF28_21_1);
    if($tcustomerRegType == "For_Schedule"):
        $SELECTEDF28_21_2 = "SELECTED";
    else:
        $SELECTEDF28_21_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_2@", $SELECTEDF28_21_2);
    if($tcustomerRegType == "For_Payment"):
        $SELECTEDF28_21_3 = "SELECTED";
    else:
        $SELECTEDF28_21_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_3@", $SELECTEDF28_21_3);
    if($tcustomerRegType == "For_Kit_Issuance"):
        $SELECTEDF28_21_4 = "SELECTED";
    else:
        $SELECTEDF28_21_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_4@", $SELECTEDF28_21_4);
    if($tcustomerRegType == "Admitted"):
        $SELECTEDF28_21_5 = "SELECTED";
    else:
        $SELECTEDF28_21_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_5@", $SELECTEDF28_21_5);
    if($tcustomerRegType == "Stopped"):
        $SELECTEDF28_21_6 = "SELECTED";
    else:
        $SELECTEDF28_21_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_6@", $SELECTEDF28_21_6);
    if($tcustomerRegType == "Graduate"):
        $SELECTEDF28_21_7 = "SELECTED";
    else:
        $SELECTEDF28_21_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF28_21_7@", $SELECTEDF28_21_7);
    global $tcustomerSchool;
    $TemplateText = Replace($TemplateText, "@tcustomerSchool@", $tcustomerSchool);
    global $tcustomerMother;
    $TemplateText = Replace($TemplateText, "@tcustomerMother@", $tcustomerMother);
    global $tcustomerMOccupation;
    $TemplateText = Replace($TemplateText, "@tcustomerMOccupation@", $tcustomerMOccupation);
    global $tcustomerMMobile;
    $TemplateText = Replace($TemplateText, "@tcustomerMMobile@", $tcustomerMMobile);
    global $tcustomerMEmail;
    $TemplateText = Replace($TemplateText, "@tcustomerMEmail@", $tcustomerMEmail);
    global $tcustomerFather;
    $TemplateText = Replace($TemplateText, "@tcustomerFather@", $tcustomerFather);
    global $tcustomerFOccupation;
    $TemplateText = Replace($TemplateText, "@tcustomerFOccupation@", $tcustomerFOccupation);
    global $tcustomerFMobile;
    $TemplateText = Replace($TemplateText, "@tcustomerFMobile@", $tcustomerFMobile);
    global $tcustomerFEmail;
    $TemplateText = Replace($TemplateText, "@tcustomerFEmail@", $tcustomerFEmail);
    global $tcustomerStatus;
    $TemplateText = Replace($TemplateText, "@tcustomerStatus@", $tcustomerStatus);
    global $tcustomerReferralID;
    $TemplateText = Replace($TemplateText, "@tcustomerReferralID@", $tcustomerReferralID);
    global $tcustomerStoppedDate;
    $TemplateText = Replace($TemplateText, "@tcustomerStoppedDate@", $tcustomerStoppedDate);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseStudentlist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "UpdatetStudent" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStcustomer);
ob_flush();
?>
