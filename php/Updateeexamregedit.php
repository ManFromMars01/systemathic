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
$UpdateeexamregFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeexamreg" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdateeexamregFormAction;
    global $eexamregCountryID;
    global $eexamregBranchID;
    global $eexamregDate;
    global $eexamregCustNo;
    global $eexamregCateg;
    global $eexamregCateg2;
    global $eexamregCateg3;
    global $eexamregGrade;
    global $eexamregGrade2;
    global $eexamregDigit;
    global $eexamregNumber;
    global $eexamregMenFee;
    global $eexamregAbaFee;
    global $eexamregAurFee;
    global $eexamregTeacID;
    global $eexamregTeacID2;
    global $eexamregTeacID3;
    global $eexamregRmID;
    global $eexamregRmID2;
    global $eexamregRmID3;
    global $eexamregExamCode;
    global $eexamregExamCode2;
    global $eexamregExamCode3;
    global $eexamregRemarks;
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
    $TemplateText = Replace($TemplateText,"@UpdateeexamregFormAction@",$UpdateeexamregFormAction);    

     $TemplateText = Replace($TemplateText, "@eexamregCountryID@", $eexamregCountryID);
     $TemplateText = Replace($TemplateText, "@eexamregBranchID@", $eexamregBranchID);
     $TemplateText = Replace($TemplateText, "@eexamregDate@", $eexamregDate);
     $TemplateText = Replace($TemplateText, "@eexamregCustNo@", $eexamregCustNo);
     $TemplateText = Replace($TemplateText, "@eexamregCateg@", $eexamregCateg);
     $TemplateText = Replace($TemplateText, "@eexamregCateg2@", $eexamregCateg2);
     $TemplateText = Replace($TemplateText, "@eexamregCateg3@", $eexamregCateg3);
     $TemplateText = Replace($TemplateText, "@eexamregGrade@", $eexamregGrade);
     $TemplateText = Replace($TemplateText, "@eexamregGrade2@", $eexamregGrade2);
     $TemplateText = Replace($TemplateText, "@eexamregDigit@", $eexamregDigit);
     $TemplateText = Replace($TemplateText, "@eexamregNumber@", $eexamregNumber);
     $TemplateText = Replace($TemplateText, "@eexamregMenFee@", $eexamregMenFee);
     $TemplateText = Replace($TemplateText, "@eexamregAbaFee@", $eexamregAbaFee);
     $TemplateText = Replace($TemplateText, "@eexamregAurFee@", $eexamregAurFee);
     $TemplateText = Replace($TemplateText, "@eexamregTeacID@", $eexamregTeacID);
     $TemplateText = Replace($TemplateText, "@eexamregTeacID2@", $eexamregTeacID2);
     $TemplateText = Replace($TemplateText, "@eexamregTeacID3@", $eexamregTeacID3);
     $TemplateText = Replace($TemplateText, "@eexamregRmID@", $eexamregRmID);
     $TemplateText = Replace($TemplateText, "@eexamregRmID2@", $eexamregRmID2);
     $TemplateText = Replace($TemplateText, "@eexamregRmID3@", $eexamregRmID3);
     $TemplateText = Replace($TemplateText, "@eexamregExamCode@", $eexamregExamCode);
     $TemplateText = Replace($TemplateText, "@eexamregExamCode2@", $eexamregExamCode2);
     $TemplateText = Replace($TemplateText, "@eexamregExamCode3@", $eexamregExamCode3);
     $TemplateText = Replace($TemplateText, "@eexamregRemarks@", $eexamregRemarks);
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
$oRSeexamreg = "";
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
        $Template = "./html/Updateeexamreg" . "edit.htm";
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

$sql = "SELECT eexamreg.CountryID, eexamreg.BranchID, eexamreg.Date, eexamreg.CustNo, eexamreg.Categ, eexamreg.Categ2, eexamreg.Categ3, eexamreg.Grade, eexamreg.Grade2, eexamreg.Digit, eexamreg.Number, eexamreg.MenFee, eexamreg.AbaFee, eexamreg.AurFee, eexamreg.TeacID, eexamreg.TeacID2, eexamreg.TeacID3, eexamreg.RmID, eexamreg.RmID2, eexamreg.RmID3, eexamreg.ExamCode, eexamreg.ExamCode2, eexamreg.ExamCode3, eexamreg.Remarks  FROM  eexamreg WHERE  eexamreg.CountryID = '" . $ID1 . "'" . " AND eexamreg.BranchID = '" . $ID2 . "'" . " AND eexamreg.CustNo = " . $ID3;
$oRSeexamreg = $objConn1->SelectLimit($sql,1);
if ($oRSeexamreg->MoveFirst() == false):
    $oRSeexamreg->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdateeexamregFormAction = "Updateeexamregeditx.php";
$oRSeexamregCountryID = $oRSeexamreg->fields["CountryID"];
$oRSeexamregBranchID = $oRSeexamreg->fields["BranchID"];
$oRSeexamregCustNo = $oRSeexamreg->fields["CustNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$eexamregCountryID = "";
if (is_null($oRSeexamreg->fields["CountryID"])):
$eexamregCountryID = "";
else:
$eexamregCountryID = trim(getValue($oRSeexamreg->fields["CountryID"]));
endif;
$eexamregBranchID = "";
if (is_null($oRSeexamreg->fields["BranchID"])):
$eexamregBranchID = "";
else:
$eexamregBranchID = trim(getValue($oRSeexamreg->fields["BranchID"]));
endif;
$eexamregDate = "";
if (is_null($oRSeexamreg->fields["Date"])):
$eexamregDate = "";
else:
$eexamregDate = getValue($oRSeexamreg->fields["Date"]);
endif;
$eexamregCustNo = "";
if (is_null($oRSeexamreg->fields["CustNo"])):
$eexamregCustNo = "";
else:
$eexamregCustNo = getValue($oRSeexamreg->fields["CustNo"]);
endif;
$eexamregCateg = "";
if (is_null($oRSeexamreg->fields["Categ"])):
$eexamregCateg = "";
else:
$eexamregCateg = trim(getValue($oRSeexamreg->fields["Categ"]));
endif;
$eexamregCateg2 = "";
if (is_null($oRSeexamreg->fields["Categ2"])):
$eexamregCateg2 = "";
else:
$eexamregCateg2 = trim(getValue($oRSeexamreg->fields["Categ2"]));
endif;
$eexamregCateg3 = "";
if (is_null($oRSeexamreg->fields["Categ3"])):
$eexamregCateg3 = "";
else:
$eexamregCateg3 = trim(getValue($oRSeexamreg->fields["Categ3"]));
endif;
$eexamregGrade = "";
if (is_null($oRSeexamreg->fields["Grade"])):
$eexamregGrade = "";
else:
$eexamregGrade = getValue($oRSeexamreg->fields["Grade"]);
endif;
$eexamregGrade2 = "";
if (is_null($oRSeexamreg->fields["Grade2"])):
$eexamregGrade2 = "";
else:
$eexamregGrade2 = getValue($oRSeexamreg->fields["Grade2"]);
endif;
$eexamregDigit = "";
if (is_null($oRSeexamreg->fields["Digit"])):
$eexamregDigit = "";
else:
$eexamregDigit = getValue($oRSeexamreg->fields["Digit"]);
endif;
$eexamregNumber = "";
if (is_null($oRSeexamreg->fields["Number"])):
$eexamregNumber = "";
else:
$eexamregNumber = getValue($oRSeexamreg->fields["Number"]);
endif;
$eexamregMenFee = "";
if (is_null($oRSeexamreg->fields["MenFee"])):
$eexamregMenFee = "";
else:
$eexamregMenFee = getValue($oRSeexamreg->fields["MenFee"]);
endif;
$eexamregAbaFee = "";
if (is_null($oRSeexamreg->fields["AbaFee"])):
$eexamregAbaFee = "";
else:
$eexamregAbaFee = getValue($oRSeexamreg->fields["AbaFee"]);
endif;
$eexamregAurFee = "";
if (is_null($oRSeexamreg->fields["AurFee"])):
$eexamregAurFee = "";
else:
$eexamregAurFee = getValue($oRSeexamreg->fields["AurFee"]);
endif;
$eexamregTeacID = "";
if (is_null($oRSeexamreg->fields["TeacID"])):
$eexamregTeacID = "";
else:
$eexamregTeacID = getValue($oRSeexamreg->fields["TeacID"]);
endif;
$eexamregTeacID2 = "";
if (is_null($oRSeexamreg->fields["TeacID2"])):
$eexamregTeacID2 = "";
else:
$eexamregTeacID2 = getValue($oRSeexamreg->fields["TeacID2"]);
endif;
$eexamregTeacID3 = "";
if (is_null($oRSeexamreg->fields["TeacID3"])):
$eexamregTeacID3 = "";
else:
$eexamregTeacID3 = getValue($oRSeexamreg->fields["TeacID3"]);
endif;
$eexamregRmID = "";
if (is_null($oRSeexamreg->fields["RmID"])):
$eexamregRmID = "";
else:
$eexamregRmID = getValue($oRSeexamreg->fields["RmID"]);
endif;
$eexamregRmID2 = "";
if (is_null($oRSeexamreg->fields["RmID2"])):
$eexamregRmID2 = "";
else:
$eexamregRmID2 = getValue($oRSeexamreg->fields["RmID2"]);
endif;
$eexamregRmID3 = "";
if (is_null($oRSeexamreg->fields["RmID3"])):
$eexamregRmID3 = "";
else:
$eexamregRmID3 = getValue($oRSeexamreg->fields["RmID3"]);
endif;
$eexamregExamCode = "";
if (is_null($oRSeexamreg->fields["ExamCode"])):
$eexamregExamCode = "";
else:
$eexamregExamCode = trim(getValue($oRSeexamreg->fields["ExamCode"]));
endif;
$eexamregExamCode2 = "";
if (is_null($oRSeexamreg->fields["ExamCode2"])):
$eexamregExamCode2 = "";
else:
$eexamregExamCode2 = trim(getValue($oRSeexamreg->fields["ExamCode2"]));
endif;
$eexamregExamCode3 = "";
if (is_null($oRSeexamreg->fields["ExamCode3"])):
$eexamregExamCode3 = "";
else:
$eexamregExamCode3 = trim(getValue($oRSeexamreg->fields["ExamCode3"]));
endif;
$eexamregRemarks = "";
if (is_null($oRSeexamreg->fields["Remarks"])):
$eexamregRemarks = "";
else:
$eexamregRemarks = trim(getValue($oRSeexamreg->fields["Remarks"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updateeexamregdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updateeexamreg_EditFailed"] == 1) {
  $eexamregCountryID = $_SESSION["SavedEditeexamregCountryID"];
  $eexamregBranchID = $_SESSION["SavedEditeexamregBranchID"];
  $eexamregDate = $_SESSION["SavedEditeexamregDate"];
  $eexamregCustNo = $_SESSION["SavedEditeexamregCustNo"];
  $eexamregCateg = $_SESSION["SavedEditeexamregCateg"];
  $eexamregCateg2 = $_SESSION["SavedEditeexamregCateg2"];
  $eexamregCateg3 = $_SESSION["SavedEditeexamregCateg3"];
  $eexamregGrade = $_SESSION["SavedEditeexamregGrade"];
  $eexamregGrade2 = $_SESSION["SavedEditeexamregGrade2"];
  $eexamregDigit = $_SESSION["SavedEditeexamregDigit"];
  $eexamregNumber = $_SESSION["SavedEditeexamregNumber"];
  $eexamregMenFee = $_SESSION["SavedEditeexamregMenFee"];
  $eexamregAbaFee = $_SESSION["SavedEditeexamregAbaFee"];
  $eexamregAurFee = $_SESSION["SavedEditeexamregAurFee"];
  $eexamregTeacID = $_SESSION["SavedEditeexamregTeacID"];
  $eexamregTeacID2 = $_SESSION["SavedEditeexamregTeacID2"];
  $eexamregTeacID3 = $_SESSION["SavedEditeexamregTeacID3"];
  $eexamregRmID = $_SESSION["SavedEditeexamregRmID"];
  $eexamregRmID2 = $_SESSION["SavedEditeexamregRmID2"];
  $eexamregRmID3 = $_SESSION["SavedEditeexamregRmID3"];
  $eexamregExamCode = $_SESSION["SavedEditeexamregExamCode"];
  $eexamregExamCode2 = $_SESSION["SavedEditeexamregExamCode2"];
  $eexamregExamCode3 = $_SESSION["SavedEditeexamregExamCode3"];
  $eexamregRemarks = $_SESSION["SavedEditeexamregRemarks"];
}
else {
  $_SESSION["Updateeexamreg_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRSeexamreg);
$objConn1->Close();
unset($objConn1);
?>
