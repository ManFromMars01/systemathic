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
            if (getForm("txttvendorCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"tvendor","CountryID","txttvendorCountryID");
            if (getForm("txttvendorBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"tvendor","BranchID","txttvendorBranchID");
            if (getForm("txttvendorID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>ID:</STRONG> : Required field <HR>\n";
            endif;
    $rst["ID"] = getFormSQLQuoted($objConn1,"tvendor","ID","txttvendorID");
            if (getForm("txttvendorName") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Name:</STRONG> : Required field <HR>\n";
            endif;
    $rst["Name"] = getFormSQLQuoted($objConn1,"tvendor","Name","txttvendorName");
    $rst["Address1"] = getFormSQLQuoted($objConn1,"tvendor","Address1","txttvendorAddress1");
    $rst["Address2"] = getFormSQLQuoted($objConn1,"tvendor","Address2","txttvendorAddress2");
    $rst["City"] = getFormSQLQuoted($objConn1,"tvendor","City","txttvendorCity");
    $rst["Zip"] = getFormSQLQuoted($objConn1,"tvendor","Zip","txttvendorZip");
    $rst["Fax"] = getFormSQLQuoted($objConn1,"tvendor","Fax","txttvendorFax");
    $rst["Phone"] = getFormSQLQuoted($objConn1,"tvendor","Phone","txttvendorPhone");
    $rst["RmtAdd1"] = getFormSQLQuoted($objConn1,"tvendor","RmtAdd1","txttvendorRmtAdd1");
    $rst["RmtAdd2"] = getFormSQLQuoted($objConn1,"tvendor","RmtAdd2","txttvendorRmtAdd2");
    $rst["RmtZip"] = getFormSQLQuoted($objConn1,"tvendor","RmtZip","txttvendorRmtZip");
    $rst["RmtCity"] = getFormSQLQuoted($objConn1,"tvendor","RmtCity","txttvendorRmtCity");
    $rst["Contact"] = getFormSQLQuoted($objConn1,"tvendor","Contact","txttvendorContact");
    $rst["DiscountPct"] = getFormSQLQuoted($objConn1,"tvendor","DiscountPct","txttvendorDiscountPct");
    $rst["DiscountDays"] = getFormSQLQuoted($objConn1,"tvendor","DiscountDays","txttvendorDiscountDays");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into tvendor (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStvendor = $objConn1->Execute($sql);

  if (!isset($oRStvendor) || $oRStvendor == false || $oRStvendor == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
  endif;
  if(getSession("BrowseAttendanceStatus#WHR")<>""):
      $myStatus .= "<a href='BrowseAttendanceStatuslist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
  else:
      if($_SESSION["ChildReturnTo"] <> ""):
        $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
      else:
        $myStatus .= "<a href='BrowseAttendanceStatuslist.php'>Return to list</a>.";
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
  $_SESSION["Updatetvendor_InsertFailed"] = 1;
  $_SESSION["SavedtvendorCountryID"] = $_POST["txttvendorCountryID"];
  $_SESSION["SavedtvendorBranchID"] = $_POST["txttvendorBranchID"];
  $_SESSION["SavedtvendorID"] = $_POST["txttvendorID"];
  $_SESSION["SavedtvendorName"] = $_POST["txttvendorName"];
  $_SESSION["SavedtvendorAddress1"] = $_POST["txttvendorAddress1"];
  $_SESSION["SavedtvendorAddress2"] = $_POST["txttvendorAddress2"];
  $_SESSION["SavedtvendorCity"] = $_POST["txttvendorCity"];
  $_SESSION["SavedtvendorZip"] = $_POST["txttvendorZip"];
  $_SESSION["SavedtvendorFax"] = $_POST["txttvendorFax"];
  $_SESSION["SavedtvendorPhone"] = $_POST["txttvendorPhone"];
  $_SESSION["SavedtvendorRmtAdd1"] = $_POST["txttvendorRmtAdd1"];
  $_SESSION["SavedtvendorRmtAdd2"] = $_POST["txttvendorRmtAdd2"];
  $_SESSION["SavedtvendorRmtZip"] = $_POST["txttvendorRmtZip"];
  $_SESSION["SavedtvendorRmtCity"] = $_POST["txttvendorRmtCity"];
  $_SESSION["SavedtvendorContact"] = $_POST["txttvendorContact"];
  $_SESSION["SavedtvendorDiscountPct"] = $_POST["txttvendorDiscountPct"];
  $_SESSION["SavedtvendorDiscountDays"] = $_POST["txttvendorDiscountDays"];
}
else {
  $_SESSION["Updatetvendor_InsertFailed"] = 0;
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
unset($oRStvendor) ;
$objConn1->Close();
unset($objConn1);
?> 
