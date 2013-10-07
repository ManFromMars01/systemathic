<?php
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

$HTML_Template = getRequest("HTMLT");

$ID1 = "";
$ID2 = "";
$ID3 = "";
$UpdateeexamregFormAction = "Updateeexamreg" . "edit.php";
$eexamregCountryID = "";
$eexamregBranchID = "";
$eexamregDate = "";
$eexamregCustNo = "";
$eexamregCateg = "";
$eexamregCateg2 = "";
$eexamregCateg3 = "";
$eexamregGrade = "";
$eexamregGrade2 = "";
$eexamregDigit = "";
$eexamregNumber = "";
$eexamregMenFee = "";
$eexamregAbaFee = "";
$eexamregAurFee = "";
$eexamregTeacID = "";
$eexamregTeacID2 = "";
$eexamregTeacID3 = "";
$eexamregRmID = "";
$eexamregRmID2 = "";
$eexamregRmID3 = "";
$eexamregExamCode = "";
$eexamregExamCode2 = "";
$eexamregExamCode3 = "";
$eexamregRemarks = "";
function  MergeUpdateeexamregTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeexamreg" . "view.htm";
    endif;
    
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

    $TemplateText = Replace($TemplateText,"@UpdateeexamregFormAction@",$UpdateeexamregFormAction);    
    $TemplateText = Replace($TemplateText,"@eexamregCountryID@",$eexamregCountryID);    
    $TemplateText = Replace($TemplateText,"@eexamregBranchID@",$eexamregBranchID);    
    $TemplateText = Replace($TemplateText,"@eexamregDate@",$eexamregDate);    
    $TemplateText = Replace($TemplateText,"@eexamregCustNo@",$eexamregCustNo);    
    $TemplateText = Replace($TemplateText,"@eexamregCateg@",$eexamregCateg);    
    $TemplateText = Replace($TemplateText,"@eexamregCateg2@",$eexamregCateg2);    
    $TemplateText = Replace($TemplateText,"@eexamregCateg3@",$eexamregCateg3);    
    $TemplateText = Replace($TemplateText,"@eexamregGrade@",$eexamregGrade);    
    $TemplateText = Replace($TemplateText,"@eexamregGrade2@",$eexamregGrade2);    
    $TemplateText = Replace($TemplateText,"@eexamregDigit@",$eexamregDigit);    
    $TemplateText = Replace($TemplateText,"@eexamregNumber@",$eexamregNumber);    
    $TemplateText = Replace($TemplateText,"@eexamregMenFee@",$eexamregMenFee);    
    $TemplateText = Replace($TemplateText,"@eexamregAbaFee@",$eexamregAbaFee);    
    $TemplateText = Replace($TemplateText,"@eexamregAurFee@",$eexamregAurFee);    
    $TemplateText = Replace($TemplateText,"@eexamregTeacID@",$eexamregTeacID);    
    $TemplateText = Replace($TemplateText,"@eexamregTeacID2@",$eexamregTeacID2);    
    $TemplateText = Replace($TemplateText,"@eexamregTeacID3@",$eexamregTeacID3);    
    $TemplateText = Replace($TemplateText,"@eexamregRmID@",$eexamregRmID);    
    $TemplateText = Replace($TemplateText,"@eexamregRmID2@",$eexamregRmID2);    
    $TemplateText = Replace($TemplateText,"@eexamregRmID3@",$eexamregRmID3);    
    $TemplateText = Replace($TemplateText,"@eexamregExamCode@",$eexamregExamCode);    
    $TemplateText = Replace($TemplateText,"@eexamregExamCode2@",$eexamregExamCode2);    
    $TemplateText = Replace($TemplateText,"@eexamregExamCode3@",$eexamregExamCode3);    
    $TemplateText = Replace($TemplateText,"@eexamregRemarks@",$eexamregRemarks);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    print($TemplateText);
}
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
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
    MergeViewTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeViewTemplate($Template,$ClarionData) {
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != FALSE):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;
    print($TemplateText);
    exit();
}
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$NoRecords = FALSE;
$myQuoteID1 = getQuote($objConn1,"eexamreg","CountryID");
$myQuoteID2 = getQuote($objConn1,"eexamreg","BranchID");
$myQuoteID3 = getQuote($objConn1,"eexamreg","CustNo");
$strSQLBase  = "SELECT eexamreg.CountryID, eexamreg.BranchID, eexamreg.Date, eexamreg.CustNo, eexamreg.Categ, eexamreg.Categ2, eexamreg.Categ3, eexamreg.Grade, eexamreg.Grade2, eexamreg.Digit, eexamreg.Number, eexamreg.MenFee, eexamreg.AbaFee, eexamreg.AurFee, eexamreg.TeacID, eexamreg.TeacID2, eexamreg.TeacID3, eexamreg.RmID, eexamreg.RmID2, eexamreg.RmID3, eexamreg.ExamCode, eexamreg.ExamCode2, eexamreg.ExamCode3, eexamreg.Remarks  FROM  eexamreg  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "eexamreg.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND eexamreg.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND eexamreg.CustNo ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY eexamreg.CustNo DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY eexamreg.CustNo ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRSeexamreg = $objConn1->SelectLimit($strSQL,1);
if (($oRSeexamreg->EOF == TRUE) || ($oRSeexamreg->CurrentRow() == -1)):
    $oRSeexamreg->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRSeexamreg->MoveFirst() == FALSE):
    $oRSeexamreg->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRSeexamreg->Fields("CountryID");
$ID2 = $oRSeexamreg->Fields("BranchID");
$ID3 = $oRSeexamreg->Fields("CustNo");
if (is_null($oRSeexamreg->Fields("CountryID"))):
    $eexamregCountryID  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("CountryID"))):
        $eexamregCountryID  = getValue($oRSeexamreg->Fields("CountryID"));
    else:
        $eexamregCountryID  = htmlentities(getValue($oRSeexamreg->Fields("CountryID")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("BranchID"))):
    $eexamregBranchID  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("BranchID"))):
        $eexamregBranchID  = getValue($oRSeexamreg->Fields("BranchID"));
    else:
        $eexamregBranchID  = htmlentities(getValue($oRSeexamreg->Fields("BranchID")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Date"))):
    $eexamregDate  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Date"))):
        $eexamregDate  = getValue($oRSeexamreg->Fields("Date"));
    else:
        $eexamregDate  = htmlentities(getValue($oRSeexamreg->Fields("Date")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("CustNo"))):
    $eexamregCustNo  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("CustNo"))):
        $eexamregCustNo  = getValue($oRSeexamreg->Fields("CustNo"));
    else:
        $eexamregCustNo  = htmlentities(getValue($oRSeexamreg->Fields("CustNo")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Categ"))):
    $eexamregCateg  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Categ"))):
        $eexamregCateg  = getValue($oRSeexamreg->Fields("Categ"));
    else:
        $eexamregCateg  = htmlentities(getValue($oRSeexamreg->Fields("Categ")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Categ2"))):
    $eexamregCateg2  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Categ2"))):
        $eexamregCateg2  = getValue($oRSeexamreg->Fields("Categ2"));
    else:
        $eexamregCateg2  = htmlentities(getValue($oRSeexamreg->Fields("Categ2")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Categ3"))):
    $eexamregCateg3  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Categ3"))):
        $eexamregCateg3  = getValue($oRSeexamreg->Fields("Categ3"));
    else:
        $eexamregCateg3  = htmlentities(getValue($oRSeexamreg->Fields("Categ3")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Grade"))):
    $eexamregGrade  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Grade"))):
        $eexamregGrade  = getValue($oRSeexamreg->Fields("Grade"));
    else:
        $eexamregGrade  = htmlentities(getValue($oRSeexamreg->Fields("Grade")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Grade2"))):
    $eexamregGrade2  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Grade2"))):
        $eexamregGrade2  = getValue($oRSeexamreg->Fields("Grade2"));
    else:
        $eexamregGrade2  = htmlentities(getValue($oRSeexamreg->Fields("Grade2")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Digit"))):
    $eexamregDigit  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Digit"))):
        $eexamregDigit  = getValue($oRSeexamreg->Fields("Digit"));
    else:
        $eexamregDigit  = htmlentities(getValue($oRSeexamreg->Fields("Digit")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Number"))):
    $eexamregNumber  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Number"))):
        $eexamregNumber  = getValue($oRSeexamreg->Fields("Number"));
    else:
        $eexamregNumber  = htmlentities(getValue($oRSeexamreg->Fields("Number")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("MenFee"))):
    $eexamregMenFee  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("MenFee"))):
        $eexamregMenFee  = getValue($oRSeexamreg->Fields("MenFee"));
    else:
        $eexamregMenFee  = htmlentities(getValue($oRSeexamreg->Fields("MenFee")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("AbaFee"))):
    $eexamregAbaFee  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("AbaFee"))):
        $eexamregAbaFee  = getValue($oRSeexamreg->Fields("AbaFee"));
    else:
        $eexamregAbaFee  = htmlentities(getValue($oRSeexamreg->Fields("AbaFee")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("AurFee"))):
    $eexamregAurFee  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("AurFee"))):
        $eexamregAurFee  = getValue($oRSeexamreg->Fields("AurFee"));
    else:
        $eexamregAurFee  = htmlentities(getValue($oRSeexamreg->Fields("AurFee")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("TeacID"))):
    $eexamregTeacID  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("TeacID"))):
        $eexamregTeacID  = getValue($oRSeexamreg->Fields("TeacID"));
    else:
        $eexamregTeacID  = htmlentities(getValue($oRSeexamreg->Fields("TeacID")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("TeacID2"))):
    $eexamregTeacID2  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("TeacID2"))):
        $eexamregTeacID2  = getValue($oRSeexamreg->Fields("TeacID2"));
    else:
        $eexamregTeacID2  = htmlentities(getValue($oRSeexamreg->Fields("TeacID2")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("TeacID3"))):
    $eexamregTeacID3  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("TeacID3"))):
        $eexamregTeacID3  = getValue($oRSeexamreg->Fields("TeacID3"));
    else:
        $eexamregTeacID3  = htmlentities(getValue($oRSeexamreg->Fields("TeacID3")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("RmID"))):
    $eexamregRmID  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("RmID"))):
        $eexamregRmID  = getValue($oRSeexamreg->Fields("RmID"));
    else:
        $eexamregRmID  = htmlentities(getValue($oRSeexamreg->Fields("RmID")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("RmID2"))):
    $eexamregRmID2  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("RmID2"))):
        $eexamregRmID2  = getValue($oRSeexamreg->Fields("RmID2"));
    else:
        $eexamregRmID2  = htmlentities(getValue($oRSeexamreg->Fields("RmID2")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("RmID3"))):
    $eexamregRmID3  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("RmID3"))):
        $eexamregRmID3  = getValue($oRSeexamreg->Fields("RmID3"));
    else:
        $eexamregRmID3  = htmlentities(getValue($oRSeexamreg->Fields("RmID3")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("ExamCode"))):
    $eexamregExamCode  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("ExamCode"))):
        $eexamregExamCode  = getValue($oRSeexamreg->Fields("ExamCode"));
    else:
        $eexamregExamCode  = htmlentities(getValue($oRSeexamreg->Fields("ExamCode")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("ExamCode2"))):
    $eexamregExamCode2  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("ExamCode2"))):
        $eexamregExamCode2  = getValue($oRSeexamreg->Fields("ExamCode2"));
    else:
        $eexamregExamCode2  = htmlentities(getValue($oRSeexamreg->Fields("ExamCode2")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("ExamCode3"))):
    $eexamregExamCode3  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("ExamCode3"))):
        $eexamregExamCode3  = getValue($oRSeexamreg->Fields("ExamCode3"));
    else:
        $eexamregExamCode3  = htmlentities(getValue($oRSeexamreg->Fields("ExamCode3")));
    endif;
endif;
if (is_null($oRSeexamreg->Fields("Remarks"))):
    $eexamregRemarks  = "";
else:
    if (is_numeric($oRSeexamreg->Fields("Remarks"))):
        $eexamregRemarks  = getValue($oRSeexamreg->Fields("Remarks"));
    else:
        $eexamregRemarks  = htmlentities(getValue($oRSeexamreg->Fields("Remarks")));
    endif;
endif;

$myLevel = getSession("UserLevel") == "" ? 0 : getSession("UserLevel");          

if(!isset($EditLevel)):
    $EditLevel = 0;
endif;
if ($myLevel >= $EditLevel):
    $EditOptions = "<input type='IMAGE' src='" . $IconEdit . "' alt='Edit' height=20 width=20 title='Edit this record' id='submit1' name='submit1' >";
else:
    $EditOptions = "";
endif;

$dbNavBarPrev = "";
$dbNavBarNext = "";
$dbNavBarPrev = "<a href=Updateeexamreg" . "view.php?";
$dbNavBarNext = "<a href=Updateeexamreg" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRSeexamreg->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRSeexamreg->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRSeexamreg->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRSeexamreg->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRSeexamreg->Fields("CustNo");
$dbNavBarNext  .= "&ID3=" . $oRSeexamreg->Fields("CustNo");
if ($NoRecords == TRUE):
    if ($myDirection = "p"):
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPriorDisabled . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
    else:
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNextDisabled . " alt='Next record' border=0 height=20 width=20></a>";    
    endif;
else:
    $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
    $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
endif;
$dbNavBar = $dbNavBarPrev . $dbNavBarNext;
$oRSeexamreg->Close();
MergeUpdateeexamregTemplate($HTML_Template);
unset($oRSeexamreg);
    $objConn1->Close();
    unset($objConn1);
?>
