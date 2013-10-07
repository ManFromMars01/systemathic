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
// #include_once(dbcnfile);
include_once('utils.php');
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
$sql = "SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Name, tteacher.LocalName, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo, tteacher.Email, tteacher.Status, tteacher.RoleID  FROM  tteacher WHERE  tteacher.CountryID = '" . $ID1 . "'" . " AND tteacher.BranchID = '" . $ID2 . "'" . " AND tteacher.ID = " . $ID3;
$oRStteacher = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStteacher = array();
if (!$oRStteacher):
    $oRStteacher->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttteacherCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStteacher["CountryID"] = getFormSQLQuoted($objConn1, "tteacher", "CountryID", "txttteacherCountryID");
        if (getRequest("txttteacherBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStteacher["BranchID"] = getFormSQLQuoted($objConn1, "tteacher", "BranchID", "txttteacherBranchID");
        if (getRequest("txttteacherID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>ID:</strong> : Required field <hr>\n";
        endif;
$arrayoRStteacher["ID"] = getFormSQLQuoted($objConn1, "tteacher", "ID", "txttteacherID");
$arrayoRStteacher["Name"] = getFormSQLQuoted($objConn1, "tteacher", "Name", "txttteacherName");
$arrayoRStteacher["LocalName"] = getFormSQLQuoted($objConn1, "tteacher", "LocalName", "txttteacherLocalName");
$arrayoRStteacher["DateStart"] = getFormSQLQuoted($objConn1, "tteacher", "DateStart", "txttteacherDateStart");
$arrayoRStteacher["PhoneNo"] = getFormSQLQuoted($objConn1, "tteacher", "PhoneNo", "txttteacherPhoneNo");
$arrayoRStteacher["MobileNo"] = getFormSQLQuoted($objConn1, "tteacher", "MobileNo", "txttteacherMobileNo");
$arrayoRStteacher["Email"] = getFormSQLQuoted($objConn1, "tteacher", "Email", "txttteacherEmail");
$arrayoRStteacher["Status"] = getFormSQLQuoted($objConn1, "tteacher", "Status", "txttteacherStatus");
$arrayoRStteacher["RoleID"] = getFormSQLQuoted($objConn1, "tteacher", "RoleID", "txttteacherRoleID");
$tsql = $objConn1->GetUpdateSQL($oRStteacher, $arrayoRStteacher, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tteacher" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStteacher as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tteacher" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStteacher->Close();
unset($oRStteacher);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseCategory#WHR")<>""):
        $myStatus .= "<a href='BrowseCategorylist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseCategorylist.php'>Return to list</a>.";
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
  $_SESSION["Updatetteacher_EditFailed"] = 1;
  $_SESSION["SavedEdittteacherCountryID"] = $_POST["txttteacherCountryID"];
  $_SESSION["SavedEdittteacherBranchID"] = $_POST["txttteacherBranchID"];
  $_SESSION["SavedEdittteacherID"] = $_POST["txttteacherID"];
  $_SESSION["SavedEdittteacherName"] = $_POST["txttteacherName"];
  $_SESSION["SavedEdittteacherLocalName"] = $_POST["txttteacherLocalName"];
  $_SESSION["SavedEdittteacherDateStart"] = $_POST["txttteacherDateStart"];
  $_SESSION["SavedEdittteacherPhoneNo"] = $_POST["txttteacherPhoneNo"];
  $_SESSION["SavedEdittteacherMobileNo"] = $_POST["txttteacherMobileNo"];
  $_SESSION["SavedEdittteacherEmail"] = $_POST["txttteacherEmail"];
  $_SESSION["SavedEdittteacherStatus"] = $_POST["txttteacherStatus"];
  $_SESSION["SavedEdittteacherRoleID"] = $_POST["txttteacherRoleID"];
}
else {
  $_SESSION["Updatetteacher_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
