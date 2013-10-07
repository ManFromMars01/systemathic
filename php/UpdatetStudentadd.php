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
    $TemplateText = Replace($TemplateText,"@tcustomerGender@",$tcustomerGender);            
        if($tcustomerGender == "Male"):
            $SELECTEDtcustomerGenderMale = "CHECKED";
        else:
            $SELECTEDtcustomerGenderMale = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerGenderMale@", $SELECTEDtcustomerGenderMale);
        if($tcustomerGender == "Female"):
            $SELECTEDtcustomerGenderFemale = "CHECKED";
        else:
            $SELECTEDtcustomerGenderFemale = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerGenderFemale@", $SELECTEDtcustomerGenderFemale);
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
    $TemplateText = Replace($TemplateText,"@tcustomerCustType@",$tcustomerCustType);            
        if($tcustomerCustType == "Assessment"):
            $SELECTEDtcustomerCustTypeAssessment = "CHECKED";
        else:
            $SELECTEDtcustomerCustTypeAssessment = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerCustTypeAssessment@", $SELECTEDtcustomerCustTypeAssessment);
        if($tcustomerCustType == "Trial Class"):
            $SELECTEDtcustomerCustTypeTrial_Class = "CHECKED";
        else:
            $SELECTEDtcustomerCustTypeTrial_Class = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerCustTypeTrial_Class@", $SELECTEDtcustomerCustTypeTrial_Class);
        if($tcustomerCustType == "For Admission"):
            $SELECTEDtcustomerCustTypeFor_Admission = "CHECKED";
        else:
            $SELECTEDtcustomerCustTypeFor_Admission = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerCustTypeFor_Admission@", $SELECTEDtcustomerCustTypeFor_Admission);
        if($tcustomerCustType == "ReEnrollee"):
            $SELECTEDtcustomerCustTypeReEnrollee = "CHECKED";
        else:
            $SELECTEDtcustomerCustTypeReEnrollee = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerCustTypeReEnrollee@", $SELECTEDtcustomerCustTypeReEnrollee);
        if($tcustomerCustType == "Continuing"):
            $SELECTEDtcustomerCustTypeContinuing = "CHECKED";
        else:
            $SELECTEDtcustomerCustTypeContinuing = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerCustTypeContinuing@", $SELECTEDtcustomerCustTypeContinuing);
    global $tcustomerRegType;
    $TemplateText = Replace($TemplateText,"@tcustomerRegType@",$tcustomerRegType);            
        if($tcustomerRegType == "Waiting"):
            $SELECTEDtcustomerRegTypeWaiting = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeWaiting = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeWaiting@", $SELECTEDtcustomerRegTypeWaiting);
        if($tcustomerRegType == "For Schedule"):
            $SELECTEDtcustomerRegTypeFor_Schedule = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeFor_Schedule = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeFor_Schedule@", $SELECTEDtcustomerRegTypeFor_Schedule);
        if($tcustomerRegType == "For Payment"):
            $SELECTEDtcustomerRegTypeFor_Payment = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeFor_Payment = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeFor_Payment@", $SELECTEDtcustomerRegTypeFor_Payment);
        if($tcustomerRegType == "For Kit Issuance"):
            $SELECTEDtcustomerRegTypeFor_Kit_Issuance = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeFor_Kit_Issuance = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeFor_Kit_Issuance@", $SELECTEDtcustomerRegTypeFor_Kit_Issuance);
        if($tcustomerRegType == "Admitted"):
            $SELECTEDtcustomerRegTypeAdmitted = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeAdmitted = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeAdmitted@", $SELECTEDtcustomerRegTypeAdmitted);
        if($tcustomerRegType == "Stopped"):
            $SELECTEDtcustomerRegTypeStopped = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeStopped = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeStopped@", $SELECTEDtcustomerRegTypeStopped);
        if($tcustomerRegType == "Graduate"):
            $SELECTEDtcustomerRegTypeGraduate = "CHECKED";
        else:
            $SELECTEDtcustomerRegTypeGraduate = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtcustomerRegTypeGraduate@", $SELECTEDtcustomerRegTypeGraduate);
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
$tcustomerGender  = getRequest("txttcustomerGender");
$tcustomerBirthday  = getRequest("txttcustomerBirthday");
$tcustomerCity  = getRequest("txttcustomerCity");
$tcustomerZip  = getRequest("txttcustomerZip");
$tcustomerPhone  = getRequest("txttcustomerPhone");
$tcustomerMobile  = getRequest("txttcustomerMobile");
$tcustomerEmail  = getRequest("txttcustomerEmail");
$tcustomerLevelID  = getRequest("txttcustomerLevelID");
$tcustomerTierID  = getRequest("txttcustomerTierID");
$tcustomerCustType  = getRequest("txttcustomerCustType");
$tcustomerRegType  = getRequest("txttcustomerRegType");
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
