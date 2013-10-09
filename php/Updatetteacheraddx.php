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
            if (getForm("txttteacherCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"tteacher","CountryID","txttteacherCountryID");
            if (getForm("txttteacherBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"tteacher","BranchID","txttteacherBranchID");
            if (getForm("txttteacherID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>ID:</STRONG> : Required field <HR>\n";
            endif;
    $rst["ID"] = getFormSQLQuoted($objConn1,"tteacher","ID","txttteacherID");
    $rst["Password"] = getFormSQLQuoted($objConn1,"tteacher","Password","txttteacherPassword");
    $rst["Name"] = getFormSQLQuoted($objConn1,"tteacher","Name","txttteacherName");
    $rst["LocalName"] = getFormSQLQuoted($objConn1,"tteacher","LocalName","txttteacherLocalName");
    $rst["DateStart"] = getFormSQLQuoted($objConn1,"tteacher","DateStart","txttteacherDateStart");
    $rst["PhoneNo"] = getFormSQLQuoted($objConn1,"tteacher","PhoneNo","txttteacherPhoneNo");
    $rst["MobileNo"] = getFormSQLQuoted($objConn1,"tteacher","MobileNo","txttteacherMobileNo");
    $rst["Email"] = getFormSQLQuoted($objConn1,"tteacher","Email","txttteacherEmail");
    $rst["Status"] = getFormSQLQuoted($objConn1,"tteacher","Status","txttteacherStatus");
    $rst["RoleID"] = getFormSQLQuoted($objConn1,"tteacher","RoleID","txttteacherRoleID");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into tteacher (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStteacher = $objConn1->Execute($sql);

  if (!isset($oRStteacher) || $oRStteacher == false || $oRStteacher == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
  endif;
  if(getSession("BrowseAssessment#WHR")<>""):
      $myStatus .= "<a href='BrowseAssessmentlist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
  else:
      if($_SESSION["ChildReturnTo"] <> ""):
        $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
      else:
        $myStatus .= "<a href='BrowseAssessmentlist.php'>Return to list</a>.";
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
  $_SESSION["Updatetteacher_InsertFailed"] = 1;
  $_SESSION["SavedtteacherCountryID"] = $_POST["txttteacherCountryID"];
  $_SESSION["SavedtteacherBranchID"] = $_POST["txttteacherBranchID"];
  $_SESSION["SavedtteacherID"] = $_POST["txttteacherID"];
  $_SESSION["SavedtteacherPassword"] = $_POST["txttteacherPassword"];
  $_SESSION["SavedtteacherName"] = $_POST["txttteacherName"];
  $_SESSION["SavedtteacherLocalName"] = $_POST["txttteacherLocalName"];
  $_SESSION["SavedtteacherDateStart"] = $_POST["txttteacherDateStart"];
  $_SESSION["SavedtteacherPhoneNo"] = $_POST["txttteacherPhoneNo"];
  $_SESSION["SavedtteacherMobileNo"] = $_POST["txttteacherMobileNo"];
  $_SESSION["SavedtteacherEmail"] = $_POST["txttteacherEmail"];
  $_SESSION["SavedtteacherStatus"] = $_POST["txttteacherStatus"];
  $_SESSION["SavedtteacherRoleID"] = $_POST["txttteacherRoleID"];
}
else {
  $_SESSION["Updatetteacher_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";


MergeAddTemplate($HTML_Template);
unset($oRStteacher) ;
$objConn1->Close();
unset($objConn1);
?> 
