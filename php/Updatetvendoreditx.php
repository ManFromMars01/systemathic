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
$sql = "SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax, tvendor.Phone, tvendor.RmtAdd1, tvendor.RmtAdd2, tvendor.RmtZip, tvendor.RmtCity, tvendor.Contact, tvendor.DiscountPct, tvendor.DiscountDays  FROM  tvendor WHERE  tvendor.CountryID = '" . $ID1 . "'" . " AND tvendor.BranchID = '" . $ID2 . "'" . " AND tvendor.ID = " . $ID3;
$oRStvendor = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStvendor = array();
if (!$oRStvendor):
    $oRStvendor->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttvendorCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStvendor["CountryID"] = getFormSQLQuoted($objConn1, "tvendor", "CountryID", "txttvendorCountryID");
        if (getRequest("txttvendorBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStvendor["BranchID"] = getFormSQLQuoted($objConn1, "tvendor", "BranchID", "txttvendorBranchID");
        if (getRequest("txttvendorID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>ID:</strong> : Required field <hr>\n";
        endif;
$arrayoRStvendor["ID"] = getFormSQLQuoted($objConn1, "tvendor", "ID", "txttvendorID");
        if (getRequest("txttvendorName") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Name:</strong> : Required field <hr>\n";
        endif;
$arrayoRStvendor["Name"] = getFormSQLQuoted($objConn1, "tvendor", "Name", "txttvendorName");
$arrayoRStvendor["Address1"] = getFormSQLQuoted($objConn1, "tvendor", "Address1", "txttvendorAddress1");
$arrayoRStvendor["Address2"] = getFormSQLQuoted($objConn1, "tvendor", "Address2", "txttvendorAddress2");
$arrayoRStvendor["City"] = getFormSQLQuoted($objConn1, "tvendor", "City", "txttvendorCity");
$arrayoRStvendor["Zip"] = getFormSQLQuoted($objConn1, "tvendor", "Zip", "txttvendorZip");
$arrayoRStvendor["Fax"] = getFormSQLQuoted($objConn1, "tvendor", "Fax", "txttvendorFax");
$arrayoRStvendor["Phone"] = getFormSQLQuoted($objConn1, "tvendor", "Phone", "txttvendorPhone");
$arrayoRStvendor["RmtAdd1"] = getFormSQLQuoted($objConn1, "tvendor", "RmtAdd1", "txttvendorRmtAdd1");
$arrayoRStvendor["RmtAdd2"] = getFormSQLQuoted($objConn1, "tvendor", "RmtAdd2", "txttvendorRmtAdd2");
$arrayoRStvendor["RmtZip"] = getFormSQLQuoted($objConn1, "tvendor", "RmtZip", "txttvendorRmtZip");
$arrayoRStvendor["RmtCity"] = getFormSQLQuoted($objConn1, "tvendor", "RmtCity", "txttvendorRmtCity");
$arrayoRStvendor["Contact"] = getFormSQLQuoted($objConn1, "tvendor", "Contact", "txttvendorContact");
$arrayoRStvendor["DiscountPct"] = getFormSQLQuoted($objConn1, "tvendor", "DiscountPct", "txttvendorDiscountPct");
$arrayoRStvendor["DiscountDays"] = getFormSQLQuoted($objConn1, "tvendor", "DiscountDays", "txttvendorDiscountDays");
$tsql = $objConn1->GetUpdateSQL($oRStvendor, $arrayoRStvendor, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tvendor" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStvendor as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tvendor" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStvendor->Close();
unset($oRStvendor);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
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
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

if($flgMissing == true) {
  $_SESSION["Updatetvendor_EditFailed"] = 1;
  $_SESSION["SavedEdittvendorCountryID"] = $_POST["txttvendorCountryID"];
  $_SESSION["SavedEdittvendorBranchID"] = $_POST["txttvendorBranchID"];
  $_SESSION["SavedEdittvendorID"] = $_POST["txttvendorID"];
  $_SESSION["SavedEdittvendorName"] = $_POST["txttvendorName"];
  $_SESSION["SavedEdittvendorAddress1"] = $_POST["txttvendorAddress1"];
  $_SESSION["SavedEdittvendorAddress2"] = $_POST["txttvendorAddress2"];
  $_SESSION["SavedEdittvendorCity"] = $_POST["txttvendorCity"];
  $_SESSION["SavedEdittvendorZip"] = $_POST["txttvendorZip"];
  $_SESSION["SavedEdittvendorFax"] = $_POST["txttvendorFax"];
  $_SESSION["SavedEdittvendorPhone"] = $_POST["txttvendorPhone"];
  $_SESSION["SavedEdittvendorRmtAdd1"] = $_POST["txttvendorRmtAdd1"];
  $_SESSION["SavedEdittvendorRmtAdd2"] = $_POST["txttvendorRmtAdd2"];
  $_SESSION["SavedEdittvendorRmtZip"] = $_POST["txttvendorRmtZip"];
  $_SESSION["SavedEdittvendorRmtCity"] = $_POST["txttvendorRmtCity"];
  $_SESSION["SavedEdittvendorContact"] = $_POST["txttvendorContact"];
  $_SESSION["SavedEdittvendorDiscountPct"] = $_POST["txttvendorDiscountPct"];
  $_SESSION["SavedEdittvendorDiscountDays"] = $_POST["txttvendorDiscountDays"];
}
else {
  $_SESSION["Updatetvendor_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
