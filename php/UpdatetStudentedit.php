<?PHP
session_start();
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
//$DebugMode =  TRUE;

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
$DeleteButton = "";
$UpdatetStudentFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/UpdatetStudent" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetStudentFormAction;
    global $tcustomerCountryID;
    global $tcustomerBranchID;
    global $tcustomerCustNo;
    global $tcustomerStudentID;
    global $tcustomerSurName;
    global $tcustomerFirstName;
    global $tcustomerMiddleName;
    global $tcustomerLSurname;
    global $tcustomerLFirstName;
    global $tcustomerLMiddleName;
    global $tcustomerGender;
    global $tcustomerBirthday;
    global $tcustomerCity;
    global $tcustomerZip;
    global $tcustomerPhone;
    global $tcustomerMobile;
    global $tcustomerEmail;
    global $tcustomerLevelID;
    global $tcustomerTierID;
    global $tcustomerCustType;
    global $tcustomerRegType;
    global $tcustomerSchool;
    global $tcustomerMother;
    global $tcustomerMOccupation;
    global $tcustomerMMobile;
    global $tcustomerMEmail;
    global $tcustomerFather;
    global $tcustomerFOccupation;
    global $tcustomerFMobile;
    global $tcustomerFEmail;
    global $tcustomerStatus;
    global $tcustomerReferralID;
    global $tcustomerStoppedDate;
    global $EditOptions;    
    global $dbNavBar;    
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdatetStudentFormAction@",$UpdatetStudentFormAction);    

     $TemplateText = Replace($TemplateText, "@tcustomerCountryID@", $tcustomerCountryID);
     $TemplateText = Replace($TemplateText, "@tcustomerBranchID@", $tcustomerBranchID);
     $TemplateText = Replace($TemplateText, "@tcustomerCustNo@", $tcustomerCustNo);
     $TemplateText = Replace($TemplateText, "@tcustomerStudentID@", $tcustomerStudentID);
     $TemplateText = Replace($TemplateText, "@tcustomerSurName@", $tcustomerSurName);
     $TemplateText = Replace($TemplateText, "@tcustomerFirstName@", $tcustomerFirstName);
     $TemplateText = Replace($TemplateText, "@tcustomerMiddleName@", $tcustomerMiddleName);
     $TemplateText = Replace($TemplateText, "@tcustomerLSurname@", $tcustomerLSurname);
     $TemplateText = Replace($TemplateText, "@tcustomerLFirstName@", $tcustomerLFirstName);
     $TemplateText = Replace($TemplateText, "@tcustomerLMiddleName@", $tcustomerLMiddleName);
     $TemplateText = Replace($TemplateText, "@tcustomerGender@", $tcustomerGender);
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
     $TemplateText = Replace($TemplateText, "@tcustomerBirthday@", $tcustomerBirthday);
     $TemplateText = Replace($TemplateText, "@tcustomerCity@", $tcustomerCity);
     $TemplateText = Replace($TemplateText, "@tcustomerZip@", $tcustomerZip);
     $TemplateText = Replace($TemplateText, "@tcustomerPhone@", $tcustomerPhone);
     $TemplateText = Replace($TemplateText, "@tcustomerMobile@", $tcustomerMobile);
     $TemplateText = Replace($TemplateText, "@tcustomerEmail@", $tcustomerEmail);
     $TemplateText = Replace($TemplateText, "@tcustomerLevelID@", $tcustomerLevelID);
     $TemplateText = Replace($TemplateText, "@tcustomerTierID@", $tcustomerTierID);
     $TemplateText = Replace($TemplateText, "@tcustomerCustType@", $tcustomerCustType);
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
     $TemplateText = Replace($TemplateText, "@tcustomerRegType@", $tcustomerRegType);
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
     $TemplateText = Replace($TemplateText, "@tcustomerSchool@", $tcustomerSchool);
     $TemplateText = Replace($TemplateText, "@tcustomerMother@", $tcustomerMother);
     $TemplateText = Replace($TemplateText, "@tcustomerMOccupation@", $tcustomerMOccupation);
     $TemplateText = Replace($TemplateText, "@tcustomerMMobile@", $tcustomerMMobile);
     $TemplateText = Replace($TemplateText, "@tcustomerMEmail@", $tcustomerMEmail);
     $TemplateText = Replace($TemplateText, "@tcustomerFather@", $tcustomerFather);
     $TemplateText = Replace($TemplateText, "@tcustomerFOccupation@", $tcustomerFOccupation);
     $TemplateText = Replace($TemplateText, "@tcustomerFMobile@", $tcustomerFMobile);
     $TemplateText = Replace($TemplateText, "@tcustomerFEmail@", $tcustomerFEmail);
     $TemplateText = Replace($TemplateText, "@tcustomerStatus@", $tcustomerStatus);
     $TemplateText = Replace($TemplateText, "@tcustomerReferralID@", $tcustomerReferralID);
     $TemplateText = Replace($TemplateText, "@tcustomerStoppedDate@", $tcustomerStoppedDate);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
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
$oRStcustomer = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseStudent" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/UpdatetStudent" . "edit.htm";
    endif;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
        print($TemplateText);
        exit();        
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
        print($TemplateText);
        exit();
    endif;  
}

$sql = "SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName, tcustomer.LMiddleName, tcustomer.Gender, tcustomer.Birthday, tcustomer.City, tcustomer.Zip, tcustomer.Phone, tcustomer.Mobile, tcustomer.Email, tcustomer.LevelID, tcustomer.TierID, tcustomer.CustType, tcustomer.RegType, tcustomer.School, tcustomer.Mother, tcustomer.MOccupation, tcustomer.MMobile, tcustomer.MEmail, tcustomer.Father, tcustomer.FOccupation, tcustomer.FMobile, tcustomer.FEmail, tcustomer.Status, tcustomer.ReferralID, tcustomer.StoppedDate  FROM  tcustomer WHERE  tcustomer.CountryID = '" . $ID1 . "'" . " AND tcustomer.BranchID = '" . $ID2 . "'" . " AND tcustomer.CustNo = " . $ID3;
$oRStcustomer = $objConn1->SelectLimit($sql,1);
if ($oRStcustomer->MoveFirst() == false):
    $oRStcustomer->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetStudentFormAction = "UpdatetStudenteditx.php";
$oRStcustomerCountryID = $oRStcustomer->fields["CountryID"];
$oRStcustomerBranchID = $oRStcustomer->fields["BranchID"];
$oRStcustomerCustNo = $oRStcustomer->fields["CustNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tcustomerCountryID = "";
if (is_null($oRStcustomer->fields["CountryID"])):
$tcustomerCountryID = "";
else:
$tcustomerCountryID = trim(getValue($oRStcustomer->fields["CountryID"]));
endif;
$tcustomerBranchID = "";
if (is_null($oRStcustomer->fields["BranchID"])):
$tcustomerBranchID = "";
else:
$tcustomerBranchID = trim(getValue($oRStcustomer->fields["BranchID"]));
endif;
$tcustomerCustNo = "";
if (is_null($oRStcustomer->fields["CustNo"])):
$tcustomerCustNo = "";
else:
$tcustomerCustNo = getValue($oRStcustomer->fields["CustNo"]);
endif;
$tcustomerStudentID = "";
if (is_null($oRStcustomer->fields["StudentID"])):
$tcustomerStudentID = "";
else:
$tcustomerStudentID = trim(getValue($oRStcustomer->fields["StudentID"]));
endif;
$tcustomerSurName = "";
if (is_null($oRStcustomer->fields["SurName"])):
$tcustomerSurName = "";
else:
$tcustomerSurName = trim(getValue($oRStcustomer->fields["SurName"]));
endif;
$tcustomerFirstName = "";
if (is_null($oRStcustomer->fields["FirstName"])):
$tcustomerFirstName = "";
else:
$tcustomerFirstName = trim(getValue($oRStcustomer->fields["FirstName"]));
endif;
$tcustomerMiddleName = "";
if (is_null($oRStcustomer->fields["MiddleName"])):
$tcustomerMiddleName = "";
else:
$tcustomerMiddleName = trim(getValue($oRStcustomer->fields["MiddleName"]));
endif;
$tcustomerLSurname = "";
if (is_null($oRStcustomer->fields["LSurname"])):
$tcustomerLSurname = "";
else:
$tcustomerLSurname = trim(getValue($oRStcustomer->fields["LSurname"]));
endif;
$tcustomerLFirstName = "";
if (is_null($oRStcustomer->fields["LFirstName"])):
$tcustomerLFirstName = "";
else:
$tcustomerLFirstName = trim(getValue($oRStcustomer->fields["LFirstName"]));
endif;
$tcustomerLMiddleName = "";
if (is_null($oRStcustomer->fields["LMiddleName"])):
$tcustomerLMiddleName = "";
else:
$tcustomerLMiddleName = trim(getValue($oRStcustomer->fields["LMiddleName"]));
endif;
$tcustomerGender = "";
if (is_null($oRStcustomer->fields["Gender"])):
else:
$tcustomerGender = trim(getValue($oRStcustomer->fields["Gender"]));
endif;
$tcustomerBirthday = "";
if (is_null($oRStcustomer->fields["Birthday"])):
$tcustomerBirthday = "";
else:
$tcustomerBirthday = getValue($oRStcustomer->fields["Birthday"]);
endif;
$tcustomerCity = "";
if (is_null($oRStcustomer->fields["City"])):
$tcustomerCity = "";
else:
$tcustomerCity = trim(getValue($oRStcustomer->fields["City"]));
endif;
$tcustomerZip = "";
if (is_null($oRStcustomer->fields["Zip"])):
$tcustomerZip = "";
else:
$tcustomerZip = trim(getValue($oRStcustomer->fields["Zip"]));
endif;
$tcustomerPhone = "";
if (is_null($oRStcustomer->fields["Phone"])):
$tcustomerPhone = "";
else:
$tcustomerPhone = trim(getValue($oRStcustomer->fields["Phone"]));
endif;
$tcustomerMobile = "";
if (is_null($oRStcustomer->fields["Mobile"])):
$tcustomerMobile = "";
else:
$tcustomerMobile = trim(getValue($oRStcustomer->fields["Mobile"]));
endif;
$tcustomerEmail = "";
if (is_null($oRStcustomer->fields["Email"])):
$tcustomerEmail = "";
else:
$tcustomerEmail = trim(getValue($oRStcustomer->fields["Email"]));
endif;
$tcustomerLevelID = "";
if (is_null($oRStcustomer->fields["LevelID"])):
$tcustomerLevelID = "";
else:
$tcustomerLevelID = getValue($oRStcustomer->fields["LevelID"]);
endif;
$tcustomerTierID = "";
if (is_null($oRStcustomer->fields["TierID"])):
$tcustomerTierID = "";
else:
$tcustomerTierID = getValue($oRStcustomer->fields["TierID"]);
endif;
$tcustomerCustType = "";
if (is_null($oRStcustomer->fields["CustType"])):
else:
$tcustomerCustType = trim(getValue($oRStcustomer->fields["CustType"]));
endif;
$tcustomerRegType = "";
if (is_null($oRStcustomer->fields["RegType"])):
else:
$tcustomerRegType = trim(getValue($oRStcustomer->fields["RegType"]));
endif;
$tcustomerSchool = "";
if (is_null($oRStcustomer->fields["School"])):
$tcustomerSchool = "";
else:
$tcustomerSchool = trim(getValue($oRStcustomer->fields["School"]));
endif;
$tcustomerMother = "";
if (is_null($oRStcustomer->fields["Mother"])):
$tcustomerMother = "";
else:
$tcustomerMother = trim(getValue($oRStcustomer->fields["Mother"]));
endif;
$tcustomerMOccupation = "";
if (is_null($oRStcustomer->fields["MOccupation"])):
$tcustomerMOccupation = "";
else:
$tcustomerMOccupation = trim(getValue($oRStcustomer->fields["MOccupation"]));
endif;
$tcustomerMMobile = "";
if (is_null($oRStcustomer->fields["MMobile"])):
$tcustomerMMobile = "";
else:
$tcustomerMMobile = trim(getValue($oRStcustomer->fields["MMobile"]));
endif;
$tcustomerMEmail = "";
if (is_null($oRStcustomer->fields["MEmail"])):
$tcustomerMEmail = "";
else:
$tcustomerMEmail = trim(getValue($oRStcustomer->fields["MEmail"]));
endif;
$tcustomerFather = "";
if (is_null($oRStcustomer->fields["Father"])):
$tcustomerFather = "";
else:
$tcustomerFather = trim(getValue($oRStcustomer->fields["Father"]));
endif;
$tcustomerFOccupation = "";
if (is_null($oRStcustomer->fields["FOccupation"])):
$tcustomerFOccupation = "";
else:
$tcustomerFOccupation = trim(getValue($oRStcustomer->fields["FOccupation"]));
endif;
$tcustomerFMobile = "";
if (is_null($oRStcustomer->fields["FMobile"])):
$tcustomerFMobile = "";
else:
$tcustomerFMobile = trim(getValue($oRStcustomer->fields["FMobile"]));
endif;
$tcustomerFEmail = "";
if (is_null($oRStcustomer->fields["FEmail"])):
$tcustomerFEmail = "";
else:
$tcustomerFEmail = trim(getValue($oRStcustomer->fields["FEmail"]));
endif;
$tcustomerStatus = "";
if (is_null($oRStcustomer->fields["Status"])):
$tcustomerStatus = "";
else:
$tcustomerStatus = trim(getValue($oRStcustomer->fields["Status"]));
endif;
$tcustomerReferralID = "";
if (is_null($oRStcustomer->fields["ReferralID"])):
$tcustomerReferralID = "";
else:
$tcustomerReferralID = getValue($oRStcustomer->fields["ReferralID"]);
endif;
$tcustomerStoppedDate = "";
if (is_null($oRStcustomer->fields["StoppedDate"])):
$tcustomerStoppedDate = "";
else:
$tcustomerStoppedDate = getValue($oRStcustomer->fields["StoppedDate"]);
endif;
$DeleteButton = "<form method='post' action='UpdatetStudentdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["UpdatetStudent_EditFailed"] == 1) {
  $tcustomerCountryID = $_SESSION["SavedEdittcustomerCountryID"];
  $tcustomerBranchID = $_SESSION["SavedEdittcustomerBranchID"];
  $tcustomerCustNo = $_SESSION["SavedEdittcustomerCustNo"];
  $tcustomerStudentID = $_SESSION["SavedEdittcustomerStudentID"];
  $tcustomerSurName = $_SESSION["SavedEdittcustomerSurName"];
  $tcustomerFirstName = $_SESSION["SavedEdittcustomerFirstName"];
  $tcustomerMiddleName = $_SESSION["SavedEdittcustomerMiddleName"];
  $tcustomerLSurname = $_SESSION["SavedEdittcustomerLSurname"];
  $tcustomerLFirstName = $_SESSION["SavedEdittcustomerLFirstName"];
  $tcustomerLMiddleName = $_SESSION["SavedEdittcustomerLMiddleName"];
  $tcustomerGender = $_SESSION["SavedEdittcustomerGender"];
  $tcustomerBirthday = $_SESSION["SavedEdittcustomerBirthday"];
  $tcustomerCity = $_SESSION["SavedEdittcustomerCity"];
  $tcustomerZip = $_SESSION["SavedEdittcustomerZip"];
  $tcustomerPhone = $_SESSION["SavedEdittcustomerPhone"];
  $tcustomerMobile = $_SESSION["SavedEdittcustomerMobile"];
  $tcustomerEmail = $_SESSION["SavedEdittcustomerEmail"];
  $tcustomerLevelID = $_SESSION["SavedEdittcustomerLevelID"];
  $tcustomerTierID = $_SESSION["SavedEdittcustomerTierID"];
  $tcustomerCustType = $_SESSION["SavedEdittcustomerCustType"];
  $tcustomerRegType = $_SESSION["SavedEdittcustomerRegType"];
  $tcustomerSchool = $_SESSION["SavedEdittcustomerSchool"];
  $tcustomerMother = $_SESSION["SavedEdittcustomerMother"];
  $tcustomerMOccupation = $_SESSION["SavedEdittcustomerMOccupation"];
  $tcustomerMMobile = $_SESSION["SavedEdittcustomerMMobile"];
  $tcustomerMEmail = $_SESSION["SavedEdittcustomerMEmail"];
  $tcustomerFather = $_SESSION["SavedEdittcustomerFather"];
  $tcustomerFOccupation = $_SESSION["SavedEdittcustomerFOccupation"];
  $tcustomerFMobile = $_SESSION["SavedEdittcustomerFMobile"];
  $tcustomerFEmail = $_SESSION["SavedEdittcustomerFEmail"];
  $tcustomerStatus = $_SESSION["SavedEdittcustomerStatus"];
  $tcustomerReferralID = $_SESSION["SavedEdittcustomerReferralID"];
  $tcustomerStoppedDate = $_SESSION["SavedEdittcustomerStoppedDate"];
}
else {
  $_SESSION["UpdatetStudent_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStcustomer);
$objConn1->Close();
unset($objConn1);
?>
