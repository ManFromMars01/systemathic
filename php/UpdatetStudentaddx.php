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
$PageLevel = 0;
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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$myAction = "";
$strSQL = "";
$myStatus = "";
$flgMissing = 0;
$myError = "";

$HTML_Template = getRequest("HTMLT");


$dbColumns = "";
$dbValues = "";
            if (getForm("txttcustomerCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"tcustomer","CountryID","txttcustomerCountryID");
            if (getForm("txttcustomerBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"tcustomer","BranchID","txttcustomerBranchID");
            
    $rst["CustNo"] = getFormSQLQuoted($objConn1,"tcustomer","CustNo","txttcustomerCustNo");
    $rst["StudentID"] = getFormSQLQuoted($objConn1,"tcustomer","StudentID","txttcustomerStudentID");
    $rst["SurName"] = getFormSQLQuoted($objConn1,"tcustomer","SurName","txttcustomerSurName");
    $rst["FirstName"] = getFormSQLQuoted($objConn1,"tcustomer","FirstName","txttcustomerFirstName");
    $rst["MiddleName"] = getFormSQLQuoted($objConn1,"tcustomer","MiddleName","txttcustomerMiddleName");
    $rst["LSurname"] = getFormSQLQuoted($objConn1,"tcustomer","LSurname","txttcustomerLSurname");
    $rst["LFirstName"] = getFormSQLQuoted($objConn1,"tcustomer","LFirstName","txttcustomerLFirstName");
    $rst["LMiddleName"] = getFormSQLQuoted($objConn1,"tcustomer","LMiddleName","txttcustomerLMiddleName");
            if (getForm("txttcustomerGender") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Gender:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Male;Female; <HR>\n";
            endif;
    $rst["Gender"] = getFormSQLQuoted($objConn1,"tcustomer","Gender","txttcustomerGender");
    $rst["Birthday"] = getFormSQLQuoted($objConn1,"tcustomer","Birthday","txttcustomerBirthday");
    $rst["City"] = getFormSQLQuoted($objConn1,"tcustomer","City","txttcustomerCity");
    $rst["Zip"] = getFormSQLQuoted($objConn1,"tcustomer","Zip","txttcustomerZip");
    $rst["Phone"] = getFormSQLQuoted($objConn1,"tcustomer","Phone","txttcustomerPhone");
    $rst["Mobile"] = getFormSQLQuoted($objConn1,"tcustomer","Mobile","txttcustomerMobile");
    $rst["Email"] = getFormSQLQuoted($objConn1,"tcustomer","Email","txttcustomerEmail");
            if (getForm("txttcustomerLevelID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Level ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["LevelID"] = getFormSQLQuoted($objConn1,"tcustomer","LevelID","txttcustomerLevelID");
            if (getForm("txttcustomerTierID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Tier ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TierID"] = getFormSQLQuoted($objConn1,"tcustomer","TierID","txttcustomerTierID");
            if (getForm("txttcustomerCustType") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Cust Type:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Assessment;Trial Class;For Admission;ReEnrollee;Continuing; <HR>\n";
            endif;
    $rst["CustType"] = getFormSQLQuoted($objConn1,"tcustomer","CustType","txttcustomerCustType");
            if (getForm("txttcustomerRegType") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Reg Type:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Waiting;For Schedule;For Payment;For Kit Issuance;Admitted;Stopped;Graduate; <HR>\n";
            endif;
    $rst["RegType"] = getFormSQLQuoted($objConn1,"tcustomer","RegType","txttcustomerRegType");
    $rst["School"] = getFormSQLQuoted($objConn1,"tcustomer","School","txttcustomerSchool");
    $rst["Mother"] = getFormSQLQuoted($objConn1,"tcustomer","Mother","txttcustomerMother");
    $rst["MOccupation"] = getFormSQLQuoted($objConn1,"tcustomer","MOccupation","txttcustomerMOccupation");
    $rst["MMobile"] = getFormSQLQuoted($objConn1,"tcustomer","MMobile","txttcustomerMMobile");
    $rst["MEmail"] = getFormSQLQuoted($objConn1,"tcustomer","MEmail","txttcustomerMEmail");
    $rst["Father"] = getFormSQLQuoted($objConn1,"tcustomer","Father","txttcustomerFather");
    $rst["FOccupation"] = getFormSQLQuoted($objConn1,"tcustomer","FOccupation","txttcustomerFOccupation");
    $rst["FMobile"] = getFormSQLQuoted($objConn1,"tcustomer","FMobile","txttcustomerFMobile");
    $rst["FEmail"] = getFormSQLQuoted($objConn1,"tcustomer","FEmail","txttcustomerFEmail");
    $rst["Status"] = getFormSQLQuoted($objConn1,"tcustomer","Status","txttcustomerStatus");
    $rst["ReferralID"] = getFormSQLQuoted($objConn1,"tcustomer","ReferralID","txttcustomerReferralID");
    $rst["StoppedDate"] = getFormSQLQuoted($objConn1,"tcustomer","StoppedDate","txttcustomerStoppedDate");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into tcustomer (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStcustomer = $objConn1->Execute($sql);

  if (!isset($oRStcustomer) || $oRStcustomer == false || $oRStcustomer == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
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


function MergeAddTemplate($Template) {
    if (!isset($Template) || ($Template == "")) {
        $Template = "./html/blank.htm";
    }       
    global $ClarionData;
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
}

if($flgMissing == true) {
  $_SESSION["UpdatetStudent_InsertFailed"] = 1;
  $_SESSION["SavedtcustomerCountryID"] = $_POST["txttcustomerCountryID"];
  $_SESSION["SavedtcustomerBranchID"] = $_POST["txttcustomerBranchID"];
  $_SESSION["SavedtcustomerCustNo"] = $_POST["txttcustomerCustNo"];
  $_SESSION["SavedtcustomerStudentID"] = $_POST["txttcustomerStudentID"];
  $_SESSION["SavedtcustomerSurName"] = $_POST["txttcustomerSurName"];
  $_SESSION["SavedtcustomerFirstName"] = $_POST["txttcustomerFirstName"];
  $_SESSION["SavedtcustomerMiddleName"] = $_POST["txttcustomerMiddleName"];
  $_SESSION["SavedtcustomerLSurname"] = $_POST["txttcustomerLSurname"];
  $_SESSION["SavedtcustomerLFirstName"] = $_POST["txttcustomerLFirstName"];
  $_SESSION["SavedtcustomerLMiddleName"] = $_POST["txttcustomerLMiddleName"];
  $_SESSION["SavedtcustomerGender"] = $_POST["txttcustomerGender"];
  $_SESSION["SavedtcustomerBirthday"] = $_POST["txttcustomerBirthday"];
  $_SESSION["SavedtcustomerCity"] = $_POST["txttcustomerCity"];
  $_SESSION["SavedtcustomerZip"] = $_POST["txttcustomerZip"];
  $_SESSION["SavedtcustomerPhone"] = $_POST["txttcustomerPhone"];
  $_SESSION["SavedtcustomerMobile"] = $_POST["txttcustomerMobile"];
  $_SESSION["SavedtcustomerEmail"] = $_POST["txttcustomerEmail"];
  $_SESSION["SavedtcustomerLevelID"] = $_POST["txttcustomerLevelID"];
  $_SESSION["SavedtcustomerTierID"] = $_POST["txttcustomerTierID"];
  $_SESSION["SavedtcustomerCustType"] = $_POST["txttcustomerCustType"];
  $_SESSION["SavedtcustomerRegType"] = $_POST["txttcustomerRegType"];
  $_SESSION["SavedtcustomerSchool"] = $_POST["txttcustomerSchool"];
  $_SESSION["SavedtcustomerMother"] = $_POST["txttcustomerMother"];
  $_SESSION["SavedtcustomerMOccupation"] = $_POST["txttcustomerMOccupation"];
  $_SESSION["SavedtcustomerMMobile"] = $_POST["txttcustomerMMobile"];
  $_SESSION["SavedtcustomerMEmail"] = $_POST["txttcustomerMEmail"];
  $_SESSION["SavedtcustomerFather"] = $_POST["txttcustomerFather"];
  $_SESSION["SavedtcustomerFOccupation"] = $_POST["txttcustomerFOccupation"];
  $_SESSION["SavedtcustomerFMobile"] = $_POST["txttcustomerFMobile"];
  $_SESSION["SavedtcustomerFEmail"] = $_POST["txttcustomerFEmail"];
  $_SESSION["SavedtcustomerStatus"] = $_POST["txttcustomerStatus"];
  $_SESSION["SavedtcustomerReferralID"] = $_POST["txttcustomerReferralID"];
  $_SESSION["SavedtcustomerStoppedDate"] = $_POST["txttcustomerStoppedDate"];
}
else {
  $_SESSION["UpdatetStudent_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

$myStatus = array('statusme' => $myStatus);
echo json_encode($myStatus);
//MergeAddTemplate($HTML_Template);
unset($oRStcustomer) ;
$objConn1->Close();
unset($objConn1);
?> 
