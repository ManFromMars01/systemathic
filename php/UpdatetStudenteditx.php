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
// #include_once(dbcnfile);
include_once('utils.php');
include('login.php');
$HTML_Template = getRequest("HTMLT");
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
function MergeEditTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/blank.htm";
    endif;
    global $ClarionData;
    global $objConn1;
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
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;


    print($TemplateText);
    $objConn1->Close();
    exit();
}

$pFound = "";
$pFound .= trim(getRequest("ID1"));
$pFound .= trim(getRequest("ID2"));
$pFound .= trim(getRequest("ID3"));
if($pFound == ""):
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "<tr><td colspan='2' class='Input'>The requested record could not be found<br>\n";
$ClarionData .= "</td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";
MergeEditTemplate($HTML_Template);
endif;
$ID1 = trim(getRequest("ID1"), "'");
$ID2 = trim(getRequest("ID2"), "'");
$ID3 = trim(getRequest("ID3"), "'");
$sql = "SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName, tcustomer.LMiddleName, tcustomer.Gender, tcustomer.Birthday, tcustomer.City, tcustomer.Zip, tcustomer.Phone, tcustomer.Mobile, tcustomer.Email, tcustomer.LevelID, tcustomer.TierID, tcustomer.CustType, tcustomer.RegType, tcustomer.School, tcustomer.Mother, tcustomer.MOccupation, tcustomer.MMobile, tcustomer.MEmail, tcustomer.Father, tcustomer.FOccupation, tcustomer.FMobile, tcustomer.FEmail, tcustomer.Status, tcustomer.ReferralID, tcustomer.StoppedDate  FROM  tcustomer WHERE  tcustomer.CountryID = '" . $ID1 . "'" . " AND tcustomer.BranchID = '" . $ID2 . "'" . " AND tcustomer.CustNo = " . $ID3;
$oRStcustomer = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStcustomer = array();
if (!$oRStcustomer):
    $oRStcustomer->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttcustomerCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStcustomer["CountryID"] = getFormSQLQuoted($objConn1, "tcustomer", "CountryID", "txttcustomerCountryID");
        if (getRequest("txttcustomerBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStcustomer["BranchID"] = getFormSQLQuoted($objConn1, "tcustomer", "BranchID", "txttcustomerBranchID");
        if (getRequest("txttcustomerCustNo") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Cust No:</strong> : Required field <hr>\n";
        endif;
$arrayoRStcustomer["CustNo"] = getFormSQLQuoted($objConn1, "tcustomer", "CustNo", "txttcustomerCustNo");
$arrayoRStcustomer["StudentID"] = getFormSQLQuoted($objConn1, "tcustomer", "StudentID", "txttcustomerStudentID");
$arrayoRStcustomer["SurName"] = getFormSQLQuoted($objConn1, "tcustomer", "SurName", "txttcustomerSurName");
$arrayoRStcustomer["FirstName"] = getFormSQLQuoted($objConn1, "tcustomer", "FirstName", "txttcustomerFirstName");
$arrayoRStcustomer["MiddleName"] = getFormSQLQuoted($objConn1, "tcustomer", "MiddleName", "txttcustomerMiddleName");
$arrayoRStcustomer["LSurname"] = getFormSQLQuoted($objConn1, "tcustomer", "LSurname", "txttcustomerLSurname");
$arrayoRStcustomer["LFirstName"] = getFormSQLQuoted($objConn1, "tcustomer", "LFirstName", "txttcustomerLFirstName");
$arrayoRStcustomer["LMiddleName"] = getFormSQLQuoted($objConn1, "tcustomer", "LMiddleName", "txttcustomerLMiddleName");
        if (getRequest("txttcustomerGender") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Gender:</strong> : Must be in list ";
                    $myStatus .= "Male;Female; <hr>\n";
        endif;
$arrayoRStcustomer["Gender"] = getFormSQLQuoted($objConn1, "tcustomer", "Gender", "txttcustomerGender");
$arrayoRStcustomer["Birthday"] = getFormSQLQuoted($objConn1, "tcustomer", "Birthday", "txttcustomerBirthday");
$arrayoRStcustomer["City"] = getFormSQLQuoted($objConn1, "tcustomer", "City", "txttcustomerCity");
$arrayoRStcustomer["Zip"] = getFormSQLQuoted($objConn1, "tcustomer", "Zip", "txttcustomerZip");
$arrayoRStcustomer["Phone"] = getFormSQLQuoted($objConn1, "tcustomer", "Phone", "txttcustomerPhone");
$arrayoRStcustomer["Mobile"] = getFormSQLQuoted($objConn1, "tcustomer", "Mobile", "txttcustomerMobile");
$arrayoRStcustomer["Email"] = getFormSQLQuoted($objConn1, "tcustomer", "Email", "txttcustomerEmail");
        if (getRequest("txttcustomerLevelID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Level ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStcustomer["LevelID"] = getFormSQLQuoted($objConn1, "tcustomer", "LevelID", "txttcustomerLevelID");
        if (getRequest("txttcustomerTierID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Tier ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStcustomer["TierID"] = getFormSQLQuoted($objConn1, "tcustomer", "TierID", "txttcustomerTierID");
        if (getRequest("txttcustomerCustType") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Cust Type:</strong> : Must be in list ";
                    $myStatus .= "Assessment;Trial Class;For Admission;ReEnrollee;Continuing; <hr>\n";
        endif;
$arrayoRStcustomer["CustType"] = getFormSQLQuoted($objConn1, "tcustomer", "CustType", "txttcustomerCustType");
        if (getRequest("txttcustomerRegType") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Reg Type:</strong> : Must be in list ";
                    $myStatus .= "Waiting;For Schedule;For Payment;For Kit Issuance;Admitted;Stopped;Graduate; <hr>\n";
        endif;
$arrayoRStcustomer["RegType"] = getFormSQLQuoted($objConn1, "tcustomer", "RegType", "txttcustomerRegType");
$arrayoRStcustomer["School"] = getFormSQLQuoted($objConn1, "tcustomer", "School", "txttcustomerSchool");
$arrayoRStcustomer["Mother"] = getFormSQLQuoted($objConn1, "tcustomer", "Mother", "txttcustomerMother");
$arrayoRStcustomer["MOccupation"] = getFormSQLQuoted($objConn1, "tcustomer", "MOccupation", "txttcustomerMOccupation");
$arrayoRStcustomer["MMobile"] = getFormSQLQuoted($objConn1, "tcustomer", "MMobile", "txttcustomerMMobile");
$arrayoRStcustomer["MEmail"] = getFormSQLQuoted($objConn1, "tcustomer", "MEmail", "txttcustomerMEmail");
$arrayoRStcustomer["Father"] = getFormSQLQuoted($objConn1, "tcustomer", "Father", "txttcustomerFather");
$arrayoRStcustomer["FOccupation"] = getFormSQLQuoted($objConn1, "tcustomer", "FOccupation", "txttcustomerFOccupation");
$arrayoRStcustomer["FMobile"] = getFormSQLQuoted($objConn1, "tcustomer", "FMobile", "txttcustomerFMobile");
$arrayoRStcustomer["FEmail"] = getFormSQLQuoted($objConn1, "tcustomer", "FEmail", "txttcustomerFEmail");
$arrayoRStcustomer["Status"] = getFormSQLQuoted($objConn1, "tcustomer", "Status", "txttcustomerStatus");
        if (getRequest("txttcustomerReferralID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Referral ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStcustomer["ReferralID"] = getFormSQLQuoted($objConn1, "tcustomer", "ReferralID", "txttcustomerReferralID");
$arrayoRStcustomer["StoppedDate"] = getFormSQLQuoted($objConn1, "tcustomer", "StoppedDate", "txttcustomerStoppedDate");
$tsql = $objConn1->GetUpdateSQL($oRStcustomer, $arrayoRStcustomer, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tcustomer" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStcustomer as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tcustomer" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStcustomer->Close();
unset($oRStcustomer);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseStudent#WHR")<>""):
        $myStatus .= "<a href='BrowseStudentlist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseStudentlist.php'>Return to list</a>.";
        endif;
    endif;
endif;
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

if($flgMissing == true) {
  $_SESSION["UpdatetStudent_EditFailed"] = 1;
  $_SESSION["SavedEdittcustomerCountryID"] = $_POST["txttcustomerCountryID"];
  $_SESSION["SavedEdittcustomerBranchID"] = $_POST["txttcustomerBranchID"];
  $_SESSION["SavedEdittcustomerCustNo"] = $_POST["txttcustomerCustNo"];
  $_SESSION["SavedEdittcustomerStudentID"] = $_POST["txttcustomerStudentID"];
  $_SESSION["SavedEdittcustomerSurName"] = $_POST["txttcustomerSurName"];
  $_SESSION["SavedEdittcustomerFirstName"] = $_POST["txttcustomerFirstName"];
  $_SESSION["SavedEdittcustomerMiddleName"] = $_POST["txttcustomerMiddleName"];
  $_SESSION["SavedEdittcustomerLSurname"] = $_POST["txttcustomerLSurname"];
  $_SESSION["SavedEdittcustomerLFirstName"] = $_POST["txttcustomerLFirstName"];
  $_SESSION["SavedEdittcustomerLMiddleName"] = $_POST["txttcustomerLMiddleName"];
  $_SESSION["SavedEdittcustomerGender"] = $_POST["txttcustomerGender"];
  $_SESSION["SavedEdittcustomerBirthday"] = $_POST["txttcustomerBirthday"];
  $_SESSION["SavedEdittcustomerCity"] = $_POST["txttcustomerCity"];
  $_SESSION["SavedEdittcustomerZip"] = $_POST["txttcustomerZip"];
  $_SESSION["SavedEdittcustomerPhone"] = $_POST["txttcustomerPhone"];
  $_SESSION["SavedEdittcustomerMobile"] = $_POST["txttcustomerMobile"];
  $_SESSION["SavedEdittcustomerEmail"] = $_POST["txttcustomerEmail"];
  $_SESSION["SavedEdittcustomerLevelID"] = $_POST["txttcustomerLevelID"];
  $_SESSION["SavedEdittcustomerTierID"] = $_POST["txttcustomerTierID"];
  $_SESSION["SavedEdittcustomerCustType"] = $_POST["txttcustomerCustType"];
  $_SESSION["SavedEdittcustomerRegType"] = $_POST["txttcustomerRegType"];
  $_SESSION["SavedEdittcustomerSchool"] = $_POST["txttcustomerSchool"];
  $_SESSION["SavedEdittcustomerMother"] = $_POST["txttcustomerMother"];
  $_SESSION["SavedEdittcustomerMOccupation"] = $_POST["txttcustomerMOccupation"];
  $_SESSION["SavedEdittcustomerMMobile"] = $_POST["txttcustomerMMobile"];
  $_SESSION["SavedEdittcustomerMEmail"] = $_POST["txttcustomerMEmail"];
  $_SESSION["SavedEdittcustomerFather"] = $_POST["txttcustomerFather"];
  $_SESSION["SavedEdittcustomerFOccupation"] = $_POST["txttcustomerFOccupation"];
  $_SESSION["SavedEdittcustomerFMobile"] = $_POST["txttcustomerFMobile"];
  $_SESSION["SavedEdittcustomerFEmail"] = $_POST["txttcustomerFEmail"];
  $_SESSION["SavedEdittcustomerStatus"] = $_POST["txttcustomerStatus"];
  $_SESSION["SavedEdittcustomerReferralID"] = $_POST["txttcustomerReferralID"];
  $_SESSION["SavedEdittcustomerStoppedDate"] = $_POST["txttcustomerStoppedDate"];
}
else {
  $_SESSION["UpdatetStudent_EditFailed"] = 0;
}

$myStatus = array('statusme' => $myStatus);
echo json_encode($myStatus);
//MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
