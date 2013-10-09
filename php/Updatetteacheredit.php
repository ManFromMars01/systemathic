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
$DeleteButton = "";
$UpdatetteacherFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetteacher" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetteacherFormAction;
    global $tteacherCountryID;
    global $tteacherBranchID;
    global $tteacherID;
    global $tteacherPassword;
    global $tteacherName;
    global $tteacherLocalName;
    global $tteacherDateStart;
    global $tteacherPhoneNo;
    global $tteacherMobileNo;
    global $tteacherEmail;
    global $tteacherStatus;
    global $tteacherRoleID;
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
    $TemplateText = Replace($TemplateText,"@UpdatetteacherFormAction@",$UpdatetteacherFormAction);    

     $TemplateText = Replace($TemplateText, "@tteacherCountryID@", $tteacherCountryID);
     $TemplateText = Replace($TemplateText, "@tteacherBranchID@", $tteacherBranchID);
     $TemplateText = Replace($TemplateText, "@tteacherID@", $tteacherID);
     $TemplateText = Replace($TemplateText, "@tteacherPassword@", $tteacherPassword);
     $TemplateText = Replace($TemplateText, "@tteacherName@", $tteacherName);
     $TemplateText = Replace($TemplateText, "@tteacherLocalName@", $tteacherLocalName);
     $TemplateText = Replace($TemplateText, "@tteacherDateStart@", $tteacherDateStart);
     $TemplateText = Replace($TemplateText, "@tteacherPhoneNo@", $tteacherPhoneNo);
     $TemplateText = Replace($TemplateText, "@tteacherMobileNo@", $tteacherMobileNo);
     $TemplateText = Replace($TemplateText, "@tteacherEmail@", $tteacherEmail);
     $TemplateText = Replace($TemplateText, "@tteacherStatus@", $tteacherStatus);
     $TemplateText = Replace($TemplateText, "@tteacherRoleID@", $tteacherRoleID);
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
$oRStteacher = "";
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
    $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetteacher" . "edit.htm";
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

$sql = "SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Password, tteacher.Name, tteacher.LocalName, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo, tteacher.Email, tteacher.Status, tteacher.RoleID  FROM  tteacher WHERE  tteacher.CountryID = '" . $ID1 . "'" . " AND tteacher.BranchID = '" . $ID2 . "'" . " AND tteacher.ID = '" . $ID3 . "'";
$oRStteacher = $objConn1->SelectLimit($sql,1);
if ($oRStteacher->MoveFirst() == false):
    $oRStteacher->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetteacherFormAction = "Updatetteachereditx.php";
$oRStteacherCountryID = $oRStteacher->fields["CountryID"];
$oRStteacherBranchID = $oRStteacher->fields["BranchID"];
$oRStteacherID = $oRStteacher->fields["ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tteacherCountryID = "";
if (is_null($oRStteacher->fields["CountryID"])):
$tteacherCountryID = "";
else:
$tteacherCountryID = trim(getValue($oRStteacher->fields["CountryID"]));
endif;
$tteacherBranchID = "";
if (is_null($oRStteacher->fields["BranchID"])):
$tteacherBranchID = "";
else:
$tteacherBranchID = trim(getValue($oRStteacher->fields["BranchID"]));
endif;
$tteacherID = "";
if (is_null($oRStteacher->fields["ID"])):
$tteacherID = "";
else:
$tteacherID = trim(getValue($oRStteacher->fields["ID"]));
endif;
$tteacherPassword = "";
if (is_null($oRStteacher->fields["Password"])):
$tteacherPassword = "";
else:
$tteacherPassword = trim(getValue($oRStteacher->fields["Password"]));
endif;
$tteacherName = "";
if (is_null($oRStteacher->fields["Name"])):
$tteacherName = "";
else:
$tteacherName = trim(getValue($oRStteacher->fields["Name"]));
endif;
$tteacherLocalName = "";
if (is_null($oRStteacher->fields["LocalName"])):
$tteacherLocalName = "";
else:
$tteacherLocalName = trim(getValue($oRStteacher->fields["LocalName"]));
endif;
$tteacherDateStart = "";
if (is_null($oRStteacher->fields["DateStart"])):
$tteacherDateStart = "";
else:
$tteacherDateStart = getValue($oRStteacher->fields["DateStart"]);
endif;
$tteacherPhoneNo = "";
if (is_null($oRStteacher->fields["PhoneNo"])):
$tteacherPhoneNo = "";
else:
$tteacherPhoneNo = trim(getValue($oRStteacher->fields["PhoneNo"]));
endif;
$tteacherMobileNo = "";
if (is_null($oRStteacher->fields["MobileNo"])):
$tteacherMobileNo = "";
else:
$tteacherMobileNo = trim(getValue($oRStteacher->fields["MobileNo"]));
endif;
$tteacherEmail = "";
if (is_null($oRStteacher->fields["Email"])):
$tteacherEmail = "";
else:
$tteacherEmail = trim(getValue($oRStteacher->fields["Email"]));
endif;
$tteacherStatus = "";
if (is_null($oRStteacher->fields["Status"])):
$tteacherStatus = "";
else:
$tteacherStatus = getValue($oRStteacher->fields["Status"]);
endif;
$tteacherRoleID = "";
if (is_null($oRStteacher->fields["RoleID"])):
$tteacherRoleID = "";
else:
$tteacherRoleID = getValue($oRStteacher->fields["RoleID"]);
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetteacherdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetteacher_EditFailed"] == 1) {
  $tteacherCountryID = $_SESSION["SavedEdittteacherCountryID"];
  $tteacherBranchID = $_SESSION["SavedEdittteacherBranchID"];
  $tteacherID = $_SESSION["SavedEdittteacherID"];
  $tteacherPassword = $_SESSION["SavedEdittteacherPassword"];
  $tteacherName = $_SESSION["SavedEdittteacherName"];
  $tteacherLocalName = $_SESSION["SavedEdittteacherLocalName"];
  $tteacherDateStart = $_SESSION["SavedEdittteacherDateStart"];
  $tteacherPhoneNo = $_SESSION["SavedEdittteacherPhoneNo"];
  $tteacherMobileNo = $_SESSION["SavedEdittteacherMobileNo"];
  $tteacherEmail = $_SESSION["SavedEdittteacherEmail"];
  $tteacherStatus = $_SESSION["SavedEdittteacherStatus"];
  $tteacherRoleID = $_SESSION["SavedEdittteacherRoleID"];
}
else {
  $_SESSION["Updatetteacher_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStteacher);
$objConn1->Close();
unset($objConn1);
?>
