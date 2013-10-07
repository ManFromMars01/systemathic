<?PHP
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
session_start();
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
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdatetStudentFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/UpdatetStudentadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetStudentFormAction@",$UpdatetStudentFormAction);    
    $TemplateText = Replace($TemplateText,"<!--@HTML_AFTER_OPEN@-->",loadInclude(""));          
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

    global $tcustomerCountryID;
    $TemplateText = Replace($TemplateText,"@tcustomerCountryID@",$tcustomerCountryID);            
    global $tcustomerBranchID;
    $TemplateText = Replace($TemplateText,"@tcustomerBranchID@",$tcustomerBranchID);            
    global $tcustomerCustNo;
    $TemplateText = Replace($TemplateText,"@tcustomerCustNo@",$tcustomerCustNo);            
    global $tcustomerStudentID;
    $TemplateText = Replace($TemplateText,"@tcustomerStudentID@",$tcustomerStudentID);            
    global $tcustomerSurName;
    $TemplateText = Replace($TemplateText,"@tcustomerSurName@",$tcustomerSurName);            
    global $tcustomerFirstName;
    $TemplateText = Replace($TemplateText,"@tcustomerFirstName@",$tcustomerFirstName);            
    global $tcustomerMiddleName;
    $TemplateText = Replace($TemplateText,"@tcustomerMiddleName@",$tcustomerMiddleName);            
    global $tcustomerLSurname;
    $TemplateText = Replace($TemplateText,"@tcustomerLSurname@",$tcustomerLSurname);            
    global $tcustomerLFirstName;
    $TemplateText = Replace($TemplateText,"@tcustomerLFirstName@",$tcustomerLFirstName);            
    global $tcustomerLMiddleName;
    $TemplateText = Replace($TemplateText,"@tcustomerLMiddleName@",$tcustomerLMiddleName);            
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
    $TemplateText = Replace($TemplateText,"@tcustomerBirthday@",$tcustomerBirthday);            
    global $tcustomerCity;
    $TemplateText = Replace($TemplateText,"@tcustomerCity@",$tcustomerCity);            
    global $tcustomerZip;
    $TemplateText = Replace($TemplateText,"@tcustomerZip@",$tcustomerZip);            
    global $tcustomerPhone;
    $TemplateText = Replace($TemplateText,"@tcustomerPhone@",$tcustomerPhone);            
    global $tcustomerMobile;
    $TemplateText = Replace($TemplateText,"@tcustomerMobile@",$tcustomerMobile);            
    global $tcustomerEmail;
    $TemplateText = Replace($TemplateText,"@tcustomerEmail@",$tcustomerEmail);            
    global $tcustomerLevelID;
    $TemplateText = Replace($TemplateText,"@tcustomerLevelID@",$tcustomerLevelID);            
    global $tcustomerTierID;
    $TemplateText = Replace($TemplateText,"@tcustomerTierID@",$tcustomerTierID);            
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
    $TemplateText = Replace($TemplateText,"@tcustomerSchool@",$tcustomerSchool);            
    global $tcustomerMother;
    $TemplateText = Replace($TemplateText,"@tcustomerMother@",$tcustomerMother);            
    global $tcustomerMOccupation;
    $TemplateText = Replace($TemplateText,"@tcustomerMOccupation@",$tcustomerMOccupation);            
    global $tcustomerMMobile;
    $TemplateText = Replace($TemplateText,"@tcustomerMMobile@",$tcustomerMMobile);            
    global $tcustomerMEmail;
    $TemplateText = Replace($TemplateText,"@tcustomerMEmail@",$tcustomerMEmail);            
    global $tcustomerFather;
    $TemplateText = Replace($TemplateText,"@tcustomerFather@",$tcustomerFather);            
    global $tcustomerFOccupation;
    $TemplateText = Replace($TemplateText,"@tcustomerFOccupation@",$tcustomerFOccupation);            
    global $tcustomerFMobile;
    $TemplateText = Replace($TemplateText,"@tcustomerFMobile@",$tcustomerFMobile);            
    global $tcustomerFEmail;
    $TemplateText = Replace($TemplateText,"@tcustomerFEmail@",$tcustomerFEmail);            
    global $tcustomerStatus;
    $TemplateText = Replace($TemplateText,"@tcustomerStatus@",$tcustomerStatus);            
    global $tcustomerReferralID;
    $TemplateText = Replace($TemplateText,"@tcustomerReferralID@",$tcustomerReferralID);            
    global $tcustomerStoppedDate;
    $TemplateText = Replace($TemplateText,"@tcustomerStoppedDate@",$tcustomerStoppedDate);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdatetStudentFormAction = "UpdatetStudentaddx.php";
$tcustomerCountryID  = getRequest("txttcustomerCountryID");
$tcustomerBranchID  = getRequest("txttcustomerBranchID");
$tcustomerCustNo  = getRequest("txttcustomerCustNo");
$tcustomerStudentID  = getRequest("txttcustomerStudentID");
$tcustomerSurName  = getRequest("txttcustomerSurName");
$tcustomerFirstName  = getRequest("txttcustomerFirstName");
$tcustomerMiddleName  = getRequest("txttcustomerMiddleName");
$tcustomerLSurname  = getRequest("txttcustomerLSurname");
$tcustomerLFirstName  = getRequest("txttcustomerLFirstName");
$tcustomerLMiddleName  = getRequest("txttcustomerLMiddleName");
$tcustomerBirthday  = getRequest("txttcustomerBirthday");
$tcustomerCity  = getRequest("txttcustomerCity");
$tcustomerZip  = getRequest("txttcustomerZip");
$tcustomerPhone  = getRequest("txttcustomerPhone");
$tcustomerMobile  = getRequest("txttcustomerMobile");
$tcustomerEmail  = getRequest("txttcustomerEmail");
$tcustomerLevelID  = getRequest("txttcustomerLevelID");
$tcustomerTierID  = getRequest("txttcustomerTierID");
$tcustomerSchool  = getRequest("txttcustomerSchool");
$tcustomerMother  = getRequest("txttcustomerMother");
$tcustomerMOccupation  = getRequest("txttcustomerMOccupation");
$tcustomerMMobile  = getRequest("txttcustomerMMobile");
$tcustomerMEmail  = getRequest("txttcustomerMEmail");
$tcustomerFather  = getRequest("txttcustomerFather");
$tcustomerFOccupation  = getRequest("txttcustomerFOccupation");
$tcustomerFMobile  = getRequest("txttcustomerFMobile");
$tcustomerFEmail  = getRequest("txttcustomerFEmail");
$tcustomerStatus  = getRequest("txttcustomerStatus");
$tcustomerReferralID  = getRequest("txttcustomerReferralID");
$tcustomerStoppedDate  = getRequest("txttcustomerStoppedDate");

if ($_SESSION["UpdatetStudent_InsertFailed"] == 1) {
   $tcustomerCountryID = $_SESSION["SavedtcustomerCountryID"];
   $tcustomerBranchID = $_SESSION["SavedtcustomerBranchID"];
   $tcustomerCustNo = $_SESSION["SavedtcustomerCustNo"];
   $tcustomerStudentID = $_SESSION["SavedtcustomerStudentID"];
   $tcustomerSurName = $_SESSION["SavedtcustomerSurName"];
   $tcustomerFirstName = $_SESSION["SavedtcustomerFirstName"];
   $tcustomerMiddleName = $_SESSION["SavedtcustomerMiddleName"];
   $tcustomerLSurname = $_SESSION["SavedtcustomerLSurname"];
   $tcustomerLFirstName = $_SESSION["SavedtcustomerLFirstName"];
   $tcustomerLMiddleName = $_SESSION["SavedtcustomerLMiddleName"];
   $tcustomerGender = $_SESSION["SavedtcustomerGender"];
   $tcustomerBirthday = $_SESSION["SavedtcustomerBirthday"];
   $tcustomerCity = $_SESSION["SavedtcustomerCity"];
   $tcustomerZip = $_SESSION["SavedtcustomerZip"];
   $tcustomerPhone = $_SESSION["SavedtcustomerPhone"];
   $tcustomerMobile = $_SESSION["SavedtcustomerMobile"];
   $tcustomerEmail = $_SESSION["SavedtcustomerEmail"];
   $tcustomerLevelID = $_SESSION["SavedtcustomerLevelID"];
   $tcustomerTierID = $_SESSION["SavedtcustomerTierID"];
   $tcustomerCustType = $_SESSION["SavedtcustomerCustType"];
   $tcustomerRegType = $_SESSION["SavedtcustomerRegType"];
   $tcustomerSchool = $_SESSION["SavedtcustomerSchool"];
   $tcustomerMother = $_SESSION["SavedtcustomerMother"];
   $tcustomerMOccupation = $_SESSION["SavedtcustomerMOccupation"];
   $tcustomerMMobile = $_SESSION["SavedtcustomerMMobile"];
   $tcustomerMEmail = $_SESSION["SavedtcustomerMEmail"];
   $tcustomerFather = $_SESSION["SavedtcustomerFather"];
   $tcustomerFOccupation = $_SESSION["SavedtcustomerFOccupation"];
   $tcustomerFMobile = $_SESSION["SavedtcustomerFMobile"];
   $tcustomerFEmail = $_SESSION["SavedtcustomerFEmail"];
   $tcustomerStatus = $_SESSION["SavedtcustomerStatus"];
   $tcustomerReferralID = $_SESSION["SavedtcustomerReferralID"];
   $tcustomerStoppedDate = $_SESSION["SavedtcustomerStoppedDate"];
}

MergeAddTemplate($HTML_Template);
unset($oRStcustomer);
$objConn1->Close();
unset($objConn1);
?>
