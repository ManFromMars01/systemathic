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
$sql = "SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt, ttaxtab.YTDTaxAmt, ttaxtab.Status  FROM  ttaxtab WHERE  ttaxtab.CountryID = '" . $ID1 . "'" . " AND ttaxtab.BranchID = '" . $ID2 . "'" . " AND ttaxtab.TaxID = '" . $ID3 . "'";
$oRSttaxtab = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRSttaxtab = array();
if (!$oRSttaxtab):
    $oRSttaxtab->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txtttaxtabCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSttaxtab["CountryID"] = getFormSQLQuoted($objConn1, "ttaxtab", "CountryID", "txtttaxtabCountryID");
        if (getRequest("txtttaxtabBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSttaxtab["BranchID"] = getFormSQLQuoted($objConn1, "ttaxtab", "BranchID", "txtttaxtabBranchID");
        if (getRequest("txtttaxtabTaxID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Tax ID:</strong> : Required field <hr>\n";
        endif;
$arrayoRSttaxtab["TaxID"] = getFormSQLQuoted($objConn1, "ttaxtab", "TaxID", "txtttaxtabTaxID");
        if (getRequest("txtttaxtabDescription") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Description:</strong> : Required field <hr>\n";
        endif;
$arrayoRSttaxtab["Description"] = getFormSQLQuoted($objConn1, "ttaxtab", "Description", "txtttaxtabDescription");
        if (getRequest("txtttaxtabRate") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Rate:</strong> : Required field <hr>\n";
        endif;
$arrayoRSttaxtab["Rate"] = getFormSQLQuoted($objConn1, "ttaxtab", "Rate", "txtttaxtabRate");
$arrayoRSttaxtab["Dept"] = getFormSQLQuoted($objConn1, "ttaxtab", "Dept", "txtttaxtabDept");
$arrayoRSttaxtab["Account"] = getFormSQLQuoted($objConn1, "ttaxtab", "Account", "txtttaxtabAccount");
$arrayoRSttaxtab["CurrTaxAmt"] = getFormSQLQuoted($objConn1, "ttaxtab", "CurrTaxAmt", "txtttaxtabCurrTaxAmt");
$arrayoRSttaxtab["MTDTaxAmt"] = getFormSQLQuoted($objConn1, "ttaxtab", "MTDTaxAmt", "txtttaxtabMTDTaxAmt");
$arrayoRSttaxtab["YTDTaxAmt"] = getFormSQLQuoted($objConn1, "ttaxtab", "YTDTaxAmt", "txtttaxtabYTDTaxAmt");
$arrayoRSttaxtab["Status"] = getFormSQLQuoted($objConn1, "ttaxtab", "Status", "txtttaxtabStatus");
$tsql = $objConn1->GetUpdateSQL($oRSttaxtab, $arrayoRSttaxtab, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "ttaxtab" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRSttaxtab as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "ttaxtab" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRSttaxtab->Close();
unset($oRSttaxtab);
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
  $_SESSION["Updatettaxtab_EditFailed"] = 1;
  $_SESSION["SavedEditttaxtabCountryID"] = $_POST["txtttaxtabCountryID"];
  $_SESSION["SavedEditttaxtabBranchID"] = $_POST["txtttaxtabBranchID"];
  $_SESSION["SavedEditttaxtabTaxID"] = $_POST["txtttaxtabTaxID"];
  $_SESSION["SavedEditttaxtabDescription"] = $_POST["txtttaxtabDescription"];
  $_SESSION["SavedEditttaxtabRate"] = $_POST["txtttaxtabRate"];
  $_SESSION["SavedEditttaxtabDept"] = $_POST["txtttaxtabDept"];
  $_SESSION["SavedEditttaxtabAccount"] = $_POST["txtttaxtabAccount"];
  $_SESSION["SavedEditttaxtabCurrTaxAmt"] = $_POST["txtttaxtabCurrTaxAmt"];
  $_SESSION["SavedEditttaxtabMTDTaxAmt"] = $_POST["txtttaxtabMTDTaxAmt"];
  $_SESSION["SavedEditttaxtabYTDTaxAmt"] = $_POST["txtttaxtabYTDTaxAmt"];
  $_SESSION["SavedEditttaxtabStatus"] = $_POST["txtttaxtabStatus"];
}
else {
  $_SESSION["Updatettaxtab_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
