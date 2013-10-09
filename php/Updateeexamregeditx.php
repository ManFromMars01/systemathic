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
$sql = "SELECT eexamreg.CountryID, eexamreg.BranchID, eexamreg.Date, eexamreg.CustNo, eexamreg.Categ, eexamreg.Categ2, eexamreg.Categ3, eexamreg.Grade, eexamreg.Grade2, eexamreg.Digit, eexamreg.Number, eexamreg.MenFee, eexamreg.AbaFee, eexamreg.AurFee, eexamreg.TeacID, eexamreg.TeacID2, eexamreg.TeacID3, eexamreg.RmID, eexamreg.RmID2, eexamreg.RmID3, eexamreg.ExamCode, eexamreg.ExamCode2, eexamreg.ExamCode3, eexamreg.Remarks  FROM  eexamreg WHERE  eexamreg.CountryID = '" . $ID1 . "'" . " AND eexamreg.BranchID = '" . $ID2 . "'" . " AND eexamreg.CustNo = " . $ID3;
$oRSeexamreg = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRSeexamreg = array();
if (!$oRSeexamreg):
    $oRSeexamreg->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txteexamregCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["CountryID"] = getFormSQLQuoted($objConn1, "eexamreg", "CountryID", "txteexamregCountryID");
        if (getRequest("txteexamregBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["BranchID"] = getFormSQLQuoted($objConn1, "eexamreg", "BranchID", "txteexamregBranchID");
        if (getRequest("txteexamregDate") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Date:</strong> : Required field <hr>\n";
        endif;
$arrayoRSeexamreg["Date"] = getFormSQLQuoted($objConn1, "eexamreg", "Date", "txteexamregDate");
        if (getRequest("txteexamregCustNo") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Cust No:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["CustNo"] = getFormSQLQuoted($objConn1, "eexamreg", "CustNo", "txteexamregCustNo");
$arrayoRSeexamreg["Categ"] = getFormSQLQuoted($objConn1, "eexamreg", "Categ", "txteexamregCateg");
$arrayoRSeexamreg["Categ2"] = getFormSQLQuoted($objConn1, "eexamreg", "Categ2", "txteexamregCateg2");
$arrayoRSeexamreg["Categ3"] = getFormSQLQuoted($objConn1, "eexamreg", "Categ3", "txteexamregCateg3");
$arrayoRSeexamreg["Grade"] = getFormSQLQuoted($objConn1, "eexamreg", "Grade", "txteexamregGrade");
$arrayoRSeexamreg["Grade2"] = getFormSQLQuoted($objConn1, "eexamreg", "Grade2", "txteexamregGrade2");
$arrayoRSeexamreg["Digit"] = getFormSQLQuoted($objConn1, "eexamreg", "Digit", "txteexamregDigit");
$arrayoRSeexamreg["Number"] = getFormSQLQuoted($objConn1, "eexamreg", "Number", "txteexamregNumber");
$arrayoRSeexamreg["MenFee"] = getFormSQLQuoted($objConn1, "eexamreg", "MenFee", "txteexamregMenFee");
$arrayoRSeexamreg["AbaFee"] = getFormSQLQuoted($objConn1, "eexamreg", "AbaFee", "txteexamregAbaFee");
$arrayoRSeexamreg["AurFee"] = getFormSQLQuoted($objConn1, "eexamreg", "AurFee", "txteexamregAurFee");
        if (getRequest("txteexamregTeacID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Teac ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["TeacID"] = getFormSQLQuoted($objConn1, "eexamreg", "TeacID", "txteexamregTeacID");
        if (getRequest("txteexamregTeacID2") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Teac ID 2:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["TeacID2"] = getFormSQLQuoted($objConn1, "eexamreg", "TeacID2", "txteexamregTeacID2");
        if (getRequest("txteexamregTeacID3") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Teac ID 3:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["TeacID3"] = getFormSQLQuoted($objConn1, "eexamreg", "TeacID3", "txteexamregTeacID3");
        if (getRequest("txteexamregRmID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Rm ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["RmID"] = getFormSQLQuoted($objConn1, "eexamreg", "RmID", "txteexamregRmID");
        if (getRequest("txteexamregRmID2") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Rm ID 2:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["RmID2"] = getFormSQLQuoted($objConn1, "eexamreg", "RmID2", "txteexamregRmID2");
        if (getRequest("txteexamregRmID3") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Rm ID 3:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRSeexamreg["RmID3"] = getFormSQLQuoted($objConn1, "eexamreg", "RmID3", "txteexamregRmID3");
$arrayoRSeexamreg["ExamCode"] = getFormSQLQuoted($objConn1, "eexamreg", "ExamCode", "txteexamregExamCode");
$arrayoRSeexamreg["ExamCode2"] = getFormSQLQuoted($objConn1, "eexamreg", "ExamCode2", "txteexamregExamCode2");
$arrayoRSeexamreg["ExamCode3"] = getFormSQLQuoted($objConn1, "eexamreg", "ExamCode3", "txteexamregExamCode3");
$arrayoRSeexamreg["Remarks"] = getFormSQLQuoted($objConn1, "eexamreg", "Remarks", "txteexamregRemarks");
$tsql = $objConn1->GetUpdateSQL($oRSeexamreg, $arrayoRSeexamreg, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "eexamreg" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRSeexamreg as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "eexamreg" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRSeexamreg->Close();
unset($oRSeexamreg);
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
  $_SESSION["Updateeexamreg_EditFailed"] = 1;
  $_SESSION["SavedEditeexamregCountryID"] = $_POST["txteexamregCountryID"];
  $_SESSION["SavedEditeexamregBranchID"] = $_POST["txteexamregBranchID"];
  $_SESSION["SavedEditeexamregDate"] = $_POST["txteexamregDate"];
  $_SESSION["SavedEditeexamregCustNo"] = $_POST["txteexamregCustNo"];
  $_SESSION["SavedEditeexamregCateg"] = $_POST["txteexamregCateg"];
  $_SESSION["SavedEditeexamregCateg2"] = $_POST["txteexamregCateg2"];
  $_SESSION["SavedEditeexamregCateg3"] = $_POST["txteexamregCateg3"];
  $_SESSION["SavedEditeexamregGrade"] = $_POST["txteexamregGrade"];
  $_SESSION["SavedEditeexamregGrade2"] = $_POST["txteexamregGrade2"];
  $_SESSION["SavedEditeexamregDigit"] = $_POST["txteexamregDigit"];
  $_SESSION["SavedEditeexamregNumber"] = $_POST["txteexamregNumber"];
  $_SESSION["SavedEditeexamregMenFee"] = $_POST["txteexamregMenFee"];
  $_SESSION["SavedEditeexamregAbaFee"] = $_POST["txteexamregAbaFee"];
  $_SESSION["SavedEditeexamregAurFee"] = $_POST["txteexamregAurFee"];
  $_SESSION["SavedEditeexamregTeacID"] = $_POST["txteexamregTeacID"];
  $_SESSION["SavedEditeexamregTeacID2"] = $_POST["txteexamregTeacID2"];
  $_SESSION["SavedEditeexamregTeacID3"] = $_POST["txteexamregTeacID3"];
  $_SESSION["SavedEditeexamregRmID"] = $_POST["txteexamregRmID"];
  $_SESSION["SavedEditeexamregRmID2"] = $_POST["txteexamregRmID2"];
  $_SESSION["SavedEditeexamregRmID3"] = $_POST["txteexamregRmID3"];
  $_SESSION["SavedEditeexamregExamCode"] = $_POST["txteexamregExamCode"];
  $_SESSION["SavedEditeexamregExamCode2"] = $_POST["txteexamregExamCode2"];
  $_SESSION["SavedEditeexamregExamCode3"] = $_POST["txteexamregExamCode3"];
  $_SESSION["SavedEditeexamregRemarks"] = $_POST["txteexamregRemarks"];
}
else {
  $_SESSION["Updateeexamreg_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
