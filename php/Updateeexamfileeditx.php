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
$sql = "SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee, eexamfile.AbaFee, eexamfile.AurFee, eexamfile.Total, eexamfile.Remarks  FROM  eexamfile WHERE  eexamfile.CountryID = '" . $ID1 . "'" . " AND eexamfile.BranchID = '" . $ID2 . "'" . " AND eexamfile.Date = '" . $ID3. "'";
$oRSeexamfile = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRSeexamfile = array();
if (!$oRSeexamfile):
    $oRSeexamfile->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txteexamfileCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamfile["CountryID"] = getFormSQLQuoted($objConn1, "eexamfile", "CountryID", "txteexamfileCountryID");
        if (getRequest("txteexamfileBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamfile["BranchID"] = getFormSQLQuoted($objConn1, "eexamfile", "BranchID", "txteexamfileBranchID");
        if (getRequest("txteexamfileDate") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Date:</strong> : Required field <hr>\n";
        endif;
$arrayoRSeexamfile["Date"] = getFormSQLQuoted($objConn1, "eexamfile", "Date", "txteexamfileDate");
$arrayoRSeexamfile["TimeFrom"] = getFormSQLQuoted($objConn1, "eexamfile", "TimeFrom", "txteexamfileTimeFrom");
$arrayoRSeexamfile["TimeTo"] = getFormSQLQuoted($objConn1, "eexamfile", "TimeTo", "txteexamfileTimeTo");
$arrayoRSeexamfile["OpenDate"] = getFormSQLQuoted($objConn1, "eexamfile", "OpenDate", "txteexamfileOpenDate");
$arrayoRSeexamfile["CloseDate"] = getFormSQLQuoted($objConn1, "eexamfile", "CloseDate", "txteexamfileCloseDate");
$arrayoRSeexamfile["SubmitDate"] = getFormSQLQuoted($objConn1, "eexamfile", "SubmitDate", "txteexamfileSubmitDate");
$arrayoRSeexamfile["MenFee"] = getFormSQLQuoted($objConn1, "eexamfile", "MenFee", "txteexamfileMenFee");
$arrayoRSeexamfile["AbaFee"] = getFormSQLQuoted($objConn1, "eexamfile", "AbaFee", "txteexamfileAbaFee");
$arrayoRSeexamfile["AurFee"] = getFormSQLQuoted($objConn1, "eexamfile", "AurFee", "txteexamfileAurFee");
$arrayoRSeexamfile["Total"] = getFormSQLQuoted($objConn1, "eexamfile", "Total", "txteexamfileTotal");
$arrayoRSeexamfile["Remarks"] = getFormSQLQuoted($objConn1, "eexamfile", "Remarks", "txteexamfileRemarks");
$tsql = $objConn1->GetUpdateSQL($oRSeexamfile, $arrayoRSeexamfile, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "eexamfile" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRSeexamfile as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "eexamfile" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRSeexamfile->Close();
unset($oRSeexamfile);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
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
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

if($flgMissing == true) {
  $_SESSION["Updateeexamfile_EditFailed"] = 1;
  $_SESSION["SavedEditeexamfileCountryID"] = $_POST["txteexamfileCountryID"];
  $_SESSION["SavedEditeexamfileBranchID"] = $_POST["txteexamfileBranchID"];
  $_SESSION["SavedEditeexamfileDate"] = $_POST["txteexamfileDate"];
  $_SESSION["SavedEditeexamfileTimeFrom"] = $_POST["txteexamfileTimeFrom"];
  $_SESSION["SavedEditeexamfileTimeTo"] = $_POST["txteexamfileTimeTo"];
  $_SESSION["SavedEditeexamfileOpenDate"] = $_POST["txteexamfileOpenDate"];
  $_SESSION["SavedEditeexamfileCloseDate"] = $_POST["txteexamfileCloseDate"];
  $_SESSION["SavedEditeexamfileSubmitDate"] = $_POST["txteexamfileSubmitDate"];
  $_SESSION["SavedEditeexamfileMenFee"] = $_POST["txteexamfileMenFee"];
  $_SESSION["SavedEditeexamfileAbaFee"] = $_POST["txteexamfileAbaFee"];
  $_SESSION["SavedEditeexamfileAurFee"] = $_POST["txteexamfileAurFee"];
  $_SESSION["SavedEditeexamfileTotal"] = $_POST["txteexamfileTotal"];
  $_SESSION["SavedEditeexamfileRemarks"] = $_POST["txteexamfileRemarks"];
}
else {
  $_SESSION["Updateeexamfile_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
