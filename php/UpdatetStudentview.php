<?php
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

$ID1 = "";
$ID2 = "";
$ID3 = "";
$UpdatetStudentFormAction = "UpdatetStudent" . "edit.php";
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
function  MergeUpdatetStudentTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/UpdatetStudent" . "view.htm";
    endif;
    
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

    $TemplateText = Replace($TemplateText,"@UpdatetStudentFormAction@",$UpdatetStudentFormAction);    
    $TemplateText = Replace($TemplateText,"@tcustomerCountryID@",$tcustomerCountryID);    
    $TemplateText = Replace($TemplateText,"@tcustomerBranchID@",$tcustomerBranchID);    
    $TemplateText = Replace($TemplateText,"@tcustomerCustNo@",$tcustomerCustNo);    
    $TemplateText = Replace($TemplateText,"@tcustomerStudentID@",$tcustomerStudentID);    
    $TemplateText = Replace($TemplateText,"@tcustomerSurName@",$tcustomerSurName);    
    $TemplateText = Replace($TemplateText,"@tcustomerFirstName@",$tcustomerFirstName);    
    $TemplateText = Replace($TemplateText,"@tcustomerMiddleName@",$tcustomerMiddleName);    
    $TemplateText = Replace($TemplateText,"@tcustomerLSurname@",$tcustomerLSurname);    
    $TemplateText = Replace($TemplateText,"@tcustomerLFirstName@",$tcustomerLFirstName);    
    $TemplateText = Replace($TemplateText,"@tcustomerLMiddleName@",$tcustomerLMiddleName);    
    $TemplateText = Replace($TemplateText,"@tcustomerGender@",$tcustomerGender);    
    $TemplateText = Replace($TemplateText,"@tcustomerBirthday@",$tcustomerBirthday);    
    $TemplateText = Replace($TemplateText,"@tcustomerCity@",$tcustomerCity);    
    $TemplateText = Replace($TemplateText,"@tcustomerZip@",$tcustomerZip);    
    $TemplateText = Replace($TemplateText,"@tcustomerPhone@",$tcustomerPhone);    
    $TemplateText = Replace($TemplateText,"@tcustomerMobile@",$tcustomerMobile);    
    $TemplateText = Replace($TemplateText,"@tcustomerEmail@",$tcustomerEmail);    
    $TemplateText = Replace($TemplateText,"@tcustomerLevelID@",$tcustomerLevelID);    
    $TemplateText = Replace($TemplateText,"@tcustomerTierID@",$tcustomerTierID);    
    $TemplateText = Replace($TemplateText,"@tcustomerCustType@",$tcustomerCustType);    
    $TemplateText = Replace($TemplateText,"@tcustomerRegType@",$tcustomerRegType);    
    $TemplateText = Replace($TemplateText,"@tcustomerSchool@",$tcustomerSchool);    
    $TemplateText = Replace($TemplateText,"@tcustomerMother@",$tcustomerMother);    
    $TemplateText = Replace($TemplateText,"@tcustomerMOccupation@",$tcustomerMOccupation);    
    $TemplateText = Replace($TemplateText,"@tcustomerMMobile@",$tcustomerMMobile);    
    $TemplateText = Replace($TemplateText,"@tcustomerMEmail@",$tcustomerMEmail);    
    $TemplateText = Replace($TemplateText,"@tcustomerFather@",$tcustomerFather);    
    $TemplateText = Replace($TemplateText,"@tcustomerFOccupation@",$tcustomerFOccupation);    
    $TemplateText = Replace($TemplateText,"@tcustomerFMobile@",$tcustomerFMobile);    
    $TemplateText = Replace($TemplateText,"@tcustomerFEmail@",$tcustomerFEmail);    
    $TemplateText = Replace($TemplateText,"@tcustomerStatus@",$tcustomerStatus);    
    $TemplateText = Replace($TemplateText,"@tcustomerReferralID@",$tcustomerReferralID);    
    $TemplateText = Replace($TemplateText,"@tcustomerStoppedDate@",$tcustomerStoppedDate);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    print($TemplateText);
}
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
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
    MergeViewTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeViewTemplate($Template,$ClarionData) {
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != FALSE):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;
    print($TemplateText);
    exit();
}
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$NoRecords = FALSE;
$myQuoteID1 = getQuote($objConn1,"tcustomer","CountryID");
$myQuoteID2 = getQuote($objConn1,"tcustomer","BranchID");
$myQuoteID3 = getQuote($objConn1,"tcustomer","CustNo");
$strSQLBase  = "SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName, tcustomer.LMiddleName, tcustomer.Gender, tcustomer.Birthday, tcustomer.City, tcustomer.Zip, tcustomer.Phone, tcustomer.Mobile, tcustomer.Email, tcustomer.LevelID, tcustomer.TierID, tcustomer.CustType, tcustomer.RegType, tcustomer.School, tcustomer.Mother, tcustomer.MOccupation, tcustomer.MMobile, tcustomer.MEmail, tcustomer.Father, tcustomer.FOccupation, tcustomer.FMobile, tcustomer.FEmail, tcustomer.Status, tcustomer.ReferralID, tcustomer.StoppedDate  FROM  tcustomer  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tcustomer.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tcustomer.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tcustomer.CustNo ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tcustomer.CustNo DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tcustomer.CustNo ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStcustomer = $objConn1->SelectLimit($strSQL,1);
if (($oRStcustomer->EOF == TRUE) || ($oRStcustomer->CurrentRow() == -1)):
    $oRStcustomer->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStcustomer->MoveFirst() == FALSE):
    $oRStcustomer->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStcustomer->Fields("CountryID");
$ID2 = $oRStcustomer->Fields("BranchID");
$ID3 = $oRStcustomer->Fields("CustNo");
if (is_null($oRStcustomer->Fields("CountryID"))):
    $tcustomerCountryID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("CountryID"))):
        $tcustomerCountryID  = getValue($oRStcustomer->Fields("CountryID"));
    else:
        $tcustomerCountryID  = htmlentities(getValue($oRStcustomer->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("BranchID"))):
    $tcustomerBranchID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("BranchID"))):
        $tcustomerBranchID  = getValue($oRStcustomer->Fields("BranchID"));
    else:
        $tcustomerBranchID  = htmlentities(getValue($oRStcustomer->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("CustNo"))):
    $tcustomerCustNo  = "";
else:
    if (is_numeric($oRStcustomer->Fields("CustNo"))):
        $tcustomerCustNo  = getValue($oRStcustomer->Fields("CustNo"));
    else:
        $tcustomerCustNo  = htmlentities(getValue($oRStcustomer->Fields("CustNo")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("StudentID"))):
    $tcustomerStudentID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("StudentID"))):
        $tcustomerStudentID  = getValue($oRStcustomer->Fields("StudentID"));
    else:
        $tcustomerStudentID  = htmlentities(getValue($oRStcustomer->Fields("StudentID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("SurName"))):
    $tcustomerSurName  = "";
else:
    if (is_numeric($oRStcustomer->Fields("SurName"))):
        $tcustomerSurName  = getValue($oRStcustomer->Fields("SurName"));
    else:
        $tcustomerSurName  = htmlentities(getValue($oRStcustomer->Fields("SurName")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("FirstName"))):
    $tcustomerFirstName  = "";
else:
    if (is_numeric($oRStcustomer->Fields("FirstName"))):
        $tcustomerFirstName  = getValue($oRStcustomer->Fields("FirstName"));
    else:
        $tcustomerFirstName  = htmlentities(getValue($oRStcustomer->Fields("FirstName")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("MiddleName"))):
    $tcustomerMiddleName  = "";
else:
    if (is_numeric($oRStcustomer->Fields("MiddleName"))):
        $tcustomerMiddleName  = getValue($oRStcustomer->Fields("MiddleName"));
    else:
        $tcustomerMiddleName  = htmlentities(getValue($oRStcustomer->Fields("MiddleName")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("LSurname"))):
    $tcustomerLSurname  = "";
else:
    if (is_numeric($oRStcustomer->Fields("LSurname"))):
        $tcustomerLSurname  = getValue($oRStcustomer->Fields("LSurname"));
    else:
        $tcustomerLSurname  = htmlentities(getValue($oRStcustomer->Fields("LSurname")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("LFirstName"))):
    $tcustomerLFirstName  = "";
else:
    if (is_numeric($oRStcustomer->Fields("LFirstName"))):
        $tcustomerLFirstName  = getValue($oRStcustomer->Fields("LFirstName"));
    else:
        $tcustomerLFirstName  = htmlentities(getValue($oRStcustomer->Fields("LFirstName")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("LMiddleName"))):
    $tcustomerLMiddleName  = "";
else:
    if (is_numeric($oRStcustomer->Fields("LMiddleName"))):
        $tcustomerLMiddleName  = getValue($oRStcustomer->Fields("LMiddleName"));
    else:
        $tcustomerLMiddleName  = htmlentities(getValue($oRStcustomer->Fields("LMiddleName")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Gender"))):
    $tcustomerGender  = "";
else:
    if ("Male" == $oRStcustomer->Fields("Gender")):
        $tcustomerGender  = htmlentities("Male");
    endif;
    if ("Female" == $oRStcustomer->Fields("Gender")):
        $tcustomerGender  = htmlentities("Female");
    endif;
endif;
if (is_null($oRStcustomer->Fields("Birthday"))):
    $tcustomerBirthday  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Birthday"))):
        $tcustomerBirthday  = getValue($oRStcustomer->Fields("Birthday"));
    else:
        $tcustomerBirthday  = htmlentities(getValue($oRStcustomer->Fields("Birthday")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("City"))):
    $tcustomerCity  = "";
else:
    if (is_numeric($oRStcustomer->Fields("City"))):
        $tcustomerCity  = getValue($oRStcustomer->Fields("City"));
    else:
        $tcustomerCity  = htmlentities(getValue($oRStcustomer->Fields("City")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Zip"))):
    $tcustomerZip  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Zip"))):
        $tcustomerZip  = getValue($oRStcustomer->Fields("Zip"));
    else:
        $tcustomerZip  = htmlentities(getValue($oRStcustomer->Fields("Zip")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Phone"))):
    $tcustomerPhone  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Phone"))):
        $tcustomerPhone  = getValue($oRStcustomer->Fields("Phone"));
    else:
        $tcustomerPhone  = htmlentities(getValue($oRStcustomer->Fields("Phone")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Mobile"))):
    $tcustomerMobile  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Mobile"))):
        $tcustomerMobile  = getValue($oRStcustomer->Fields("Mobile"));
    else:
        $tcustomerMobile  = htmlentities(getValue($oRStcustomer->Fields("Mobile")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Email"))):
    $tcustomerEmail  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Email"))):
        $tcustomerEmail  = getValue($oRStcustomer->Fields("Email"));
    else:
        $tcustomerEmail  = htmlentities(getValue($oRStcustomer->Fields("Email")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("LevelID"))):
    $tcustomerLevelID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("LevelID"))):
        $tcustomerLevelID  = getValue($oRStcustomer->Fields("LevelID"));
    else:
        $tcustomerLevelID  = htmlentities(getValue($oRStcustomer->Fields("LevelID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("TierID"))):
    $tcustomerTierID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("TierID"))):
        $tcustomerTierID  = getValue($oRStcustomer->Fields("TierID"));
    else:
        $tcustomerTierID  = htmlentities(getValue($oRStcustomer->Fields("TierID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("CustType"))):
    $tcustomerCustType  = "";
else:
    if ("Assessment" == $oRStcustomer->Fields("CustType")):
        $tcustomerCustType  = htmlentities("Assessment");
    endif;
    if ("Trial Class" == $oRStcustomer->Fields("CustType")):
        $tcustomerCustType  = htmlentities("Trial Class");
    endif;
    if ("For Admission" == $oRStcustomer->Fields("CustType")):
        $tcustomerCustType  = htmlentities("For Admission");
    endif;
    if ("ReEnrollee" == $oRStcustomer->Fields("CustType")):
        $tcustomerCustType  = htmlentities("ReEnrollee");
    endif;
    if ("Continuing" == $oRStcustomer->Fields("CustType")):
        $tcustomerCustType  = htmlentities("Continuing");
    endif;
endif;
if (is_null($oRStcustomer->Fields("RegType"))):
    $tcustomerRegType  = "";
else:
    if ("Waiting" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("Waiting");
    endif;
    if ("For Schedule" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("For Schedule");
    endif;
    if ("For Payment" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("For Payment");
    endif;
    if ("For Kit Issuance" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("For Kit Issuance");
    endif;
    if ("Admitted" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("Admitted");
    endif;
    if ("Stopped" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("Stopped");
    endif;
    if ("Graduate" == $oRStcustomer->Fields("RegType")):
        $tcustomerRegType  = htmlentities("Graduate");
    endif;
endif;
if (is_null($oRStcustomer->Fields("School"))):
    $tcustomerSchool  = "";
else:
    if (is_numeric($oRStcustomer->Fields("School"))):
        $tcustomerSchool  = getValue($oRStcustomer->Fields("School"));
    else:
        $tcustomerSchool  = htmlentities(getValue($oRStcustomer->Fields("School")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Mother"))):
    $tcustomerMother  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Mother"))):
        $tcustomerMother  = getValue($oRStcustomer->Fields("Mother"));
    else:
        $tcustomerMother  = htmlentities(getValue($oRStcustomer->Fields("Mother")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("MOccupation"))):
    $tcustomerMOccupation  = "";
else:
    if (is_numeric($oRStcustomer->Fields("MOccupation"))):
        $tcustomerMOccupation  = getValue($oRStcustomer->Fields("MOccupation"));
    else:
        $tcustomerMOccupation  = htmlentities(getValue($oRStcustomer->Fields("MOccupation")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("MMobile"))):
    $tcustomerMMobile  = "";
else:
    if (is_numeric($oRStcustomer->Fields("MMobile"))):
        $tcustomerMMobile  = getValue($oRStcustomer->Fields("MMobile"));
    else:
        $tcustomerMMobile  = htmlentities(getValue($oRStcustomer->Fields("MMobile")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("MEmail"))):
    $tcustomerMEmail  = "";
else:
    if (is_numeric($oRStcustomer->Fields("MEmail"))):
        $tcustomerMEmail  = getValue($oRStcustomer->Fields("MEmail"));
    else:
        $tcustomerMEmail  = htmlentities(getValue($oRStcustomer->Fields("MEmail")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Father"))):
    $tcustomerFather  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Father"))):
        $tcustomerFather  = getValue($oRStcustomer->Fields("Father"));
    else:
        $tcustomerFather  = htmlentities(getValue($oRStcustomer->Fields("Father")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("FOccupation"))):
    $tcustomerFOccupation  = "";
else:
    if (is_numeric($oRStcustomer->Fields("FOccupation"))):
        $tcustomerFOccupation  = getValue($oRStcustomer->Fields("FOccupation"));
    else:
        $tcustomerFOccupation  = htmlentities(getValue($oRStcustomer->Fields("FOccupation")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("FMobile"))):
    $tcustomerFMobile  = "";
else:
    if (is_numeric($oRStcustomer->Fields("FMobile"))):
        $tcustomerFMobile  = getValue($oRStcustomer->Fields("FMobile"));
    else:
        $tcustomerFMobile  = htmlentities(getValue($oRStcustomer->Fields("FMobile")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("FEmail"))):
    $tcustomerFEmail  = "";
else:
    if (is_numeric($oRStcustomer->Fields("FEmail"))):
        $tcustomerFEmail  = getValue($oRStcustomer->Fields("FEmail"));
    else:
        $tcustomerFEmail  = htmlentities(getValue($oRStcustomer->Fields("FEmail")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("Status"))):
    $tcustomerStatus  = "";
else:
    if (is_numeric($oRStcustomer->Fields("Status"))):
        $tcustomerStatus  = getValue($oRStcustomer->Fields("Status"));
    else:
        $tcustomerStatus  = htmlentities(getValue($oRStcustomer->Fields("Status")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("ReferralID"))):
    $tcustomerReferralID  = "";
else:
    if (is_numeric($oRStcustomer->Fields("ReferralID"))):
        $tcustomerReferralID  = getValue($oRStcustomer->Fields("ReferralID"));
    else:
        $tcustomerReferralID  = htmlentities(getValue($oRStcustomer->Fields("ReferralID")));
    endif;
endif;
if (is_null($oRStcustomer->Fields("StoppedDate"))):
    $tcustomerStoppedDate  = "";
else:
    if (is_numeric($oRStcustomer->Fields("StoppedDate"))):
        $tcustomerStoppedDate  = getValue($oRStcustomer->Fields("StoppedDate"));
    else:
        $tcustomerStoppedDate  = htmlentities(getValue($oRStcustomer->Fields("StoppedDate")));
    endif;
endif;

$myLevel = getSession("UserLevel") == "" ? 0 : getSession("UserLevel");          

if(!isset($EditLevel)):
    $EditLevel = 0;
endif;
if ($myLevel >= $EditLevel):
    $EditOptions = "<input type='IMAGE' src='" . $IconEdit . "' alt='Edit' height=20 width=20 title='Edit this record' id='submit1' name='submit1' >";
else:
    $EditOptions = "";
endif;

$dbNavBarPrev = "";
$dbNavBarNext = "";
$dbNavBarPrev = "<a href=UpdatetStudent" . "view.php?";
$dbNavBarNext = "<a href=UpdatetStudent" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStcustomer->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStcustomer->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStcustomer->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStcustomer->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStcustomer->Fields("CustNo");
$dbNavBarNext  .= "&ID3=" . $oRStcustomer->Fields("CustNo");
if ($NoRecords == TRUE):
    if ($myDirection = "p"):
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPriorDisabled . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
    else:
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNextDisabled . " alt='Next record' border=0 height=20 width=20></a>";    
    endif;
else:
    $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
    $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
endif;
$dbNavBar = $dbNavBarPrev . $dbNavBarNext;
$oRStcustomer->Close();
MergeUpdatetStudentTemplate($HTML_Template);
unset($oRStcustomer);
    $objConn1->Close();
    unset($objConn1);
?>
