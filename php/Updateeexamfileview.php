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
$UpdateeexamfileFormAction = "Updateeexamfile" . "edit.php";
$eexamfileCountryID = "";
$eexamfileBranchID = "";
$eexamfileDate = "";
$eexamfileTimeFrom = "";
$eexamfileTimeTo = "";
$eexamfileVenue = "";
$eexamfileOpenDate = "";
$eexamfileCloseDate = "";
$eexamfileSubmitDate = "";
$eexamfileMenFee = "";
$eexamfileAbaFee = "";
$eexamfileAurFee = "";
$eexamfileTotal = "";
$eexamfileRemarks = "";
function  MergeUpdateeexamfileTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeexamfile" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdateeexamfileFormAction;
    global $eexamfileCountryID;
    global $eexamfileBranchID;
    global $eexamfileDate;
    global $eexamfileTimeFrom;
    global $eexamfileTimeTo;
    global $eexamfileVenue;
    global $eexamfileOpenDate;
    global $eexamfileCloseDate;
    global $eexamfileSubmitDate;
    global $eexamfileMenFee;
    global $eexamfileAbaFee;
    global $eexamfileAurFee;
    global $eexamfileTotal;
    global $eexamfileRemarks;
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

    $TemplateText = Replace($TemplateText,"@UpdateeexamfileFormAction@",$UpdateeexamfileFormAction);    
    $TemplateText = Replace($TemplateText,"@eexamfileCountryID@",$eexamfileCountryID);    
    $TemplateText = Replace($TemplateText,"@eexamfileBranchID@",$eexamfileBranchID);    
    $TemplateText = Replace($TemplateText,"@eexamfileDate@",$eexamfileDate);    
    $TemplateText = Replace($TemplateText,"@eexamfileTimeFrom@",$eexamfileTimeFrom);    
    $TemplateText = Replace($TemplateText,"@eexamfileTimeTo@",$eexamfileTimeTo);    
    $TemplateText = Replace($TemplateText,"@eexamfileVenue@",$eexamfileVenue);    
    $TemplateText = Replace($TemplateText,"@eexamfileOpenDate@",$eexamfileOpenDate);    
    $TemplateText = Replace($TemplateText,"@eexamfileCloseDate@",$eexamfileCloseDate);    
    $TemplateText = Replace($TemplateText,"@eexamfileSubmitDate@",$eexamfileSubmitDate);    
    $TemplateText = Replace($TemplateText,"@eexamfileMenFee@",$eexamfileMenFee);    
    $TemplateText = Replace($TemplateText,"@eexamfileAbaFee@",$eexamfileAbaFee);    
    $TemplateText = Replace($TemplateText,"@eexamfileAurFee@",$eexamfileAurFee);    
    $TemplateText = Replace($TemplateText,"@eexamfileTotal@",$eexamfileTotal);    
    $TemplateText = Replace($TemplateText,"@eexamfileRemarks@",$eexamfileRemarks);    
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
$myQuoteID1 = getQuote($objConn1,"eexamfile","CountryID");
$myQuoteID2 = getQuote($objConn1,"eexamfile","BranchID");
$myQuoteID3 = getQuote($objConn1,"eexamfile","Date");
$strSQLBase  = "SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.Venue, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee, eexamfile.AbaFee, eexamfile.AurFee, eexamfile.Total, eexamfile.Remarks  FROM  eexamfile  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "eexamfile.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND eexamfile.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND eexamfile.Date ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY eexamfile.Date DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY eexamfile.Date ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRSeexamfile = $objConn1->SelectLimit($strSQL,1);
if (($oRSeexamfile->EOF == TRUE) || ($oRSeexamfile->CurrentRow() == -1)):
    $oRSeexamfile->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRSeexamfile->MoveFirst() == FALSE):
    $oRSeexamfile->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRSeexamfile->Fields("CountryID");
$ID2 = $oRSeexamfile->Fields("BranchID");
$ID3 = $oRSeexamfile->Fields("Date");
if (is_null($oRSeexamfile->Fields("CountryID"))):
    $eexamfileCountryID  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("CountryID"))):
        $eexamfileCountryID  = getValue($oRSeexamfile->Fields("CountryID"));
    else:
        $eexamfileCountryID  = htmlentities(getValue($oRSeexamfile->Fields("CountryID")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("BranchID"))):
    $eexamfileBranchID  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("BranchID"))):
        $eexamfileBranchID  = getValue($oRSeexamfile->Fields("BranchID"));
    else:
        $eexamfileBranchID  = htmlentities(getValue($oRSeexamfile->Fields("BranchID")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("Date"))):
    $eexamfileDate  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("Date"))):
        $eexamfileDate  = getValue($oRSeexamfile->Fields("Date"));
    else:
        $eexamfileDate  = htmlentities(getValue($oRSeexamfile->Fields("Date")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("TimeFrom"))):
    $eexamfileTimeFrom  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("TimeFrom"))):
        $eexamfileTimeFrom  = getValue($oRSeexamfile->Fields("TimeFrom"));
    else:
        $eexamfileTimeFrom  = htmlentities(getValue($oRSeexamfile->Fields("TimeFrom")));
    endif;
                $eexamfileTimeFrom = formatDateTime('g:i P',$eexamfileTimeFrom);
endif;
if (is_null($oRSeexamfile->Fields("TimeTo"))):
    $eexamfileTimeTo  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("TimeTo"))):
        $eexamfileTimeTo  = getValue($oRSeexamfile->Fields("TimeTo"));
    else:
        $eexamfileTimeTo  = htmlentities(getValue($oRSeexamfile->Fields("TimeTo")));
    endif;
                $eexamfileTimeTo = formatDateTime('g:i P',$eexamfileTimeTo);
endif;
if (is_null($oRSeexamfile->Fields("Venue"))):
    $eexamfileVenue  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("Venue"))):
        $eexamfileVenue  = getValue($oRSeexamfile->Fields("Venue"));
    else:
        $eexamfileVenue  = htmlentities(getValue($oRSeexamfile->Fields("Venue")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("OpenDate"))):
    $eexamfileOpenDate  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("OpenDate"))):
        $eexamfileOpenDate  = getValue($oRSeexamfile->Fields("OpenDate"));
    else:
        $eexamfileOpenDate  = htmlentities(getValue($oRSeexamfile->Fields("OpenDate")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("CloseDate"))):
    $eexamfileCloseDate  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("CloseDate"))):
        $eexamfileCloseDate  = getValue($oRSeexamfile->Fields("CloseDate"));
    else:
        $eexamfileCloseDate  = htmlentities(getValue($oRSeexamfile->Fields("CloseDate")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("SubmitDate"))):
    $eexamfileSubmitDate  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("SubmitDate"))):
        $eexamfileSubmitDate  = getValue($oRSeexamfile->Fields("SubmitDate"));
    else:
        $eexamfileSubmitDate  = htmlentities(getValue($oRSeexamfile->Fields("SubmitDate")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("MenFee"))):
    $eexamfileMenFee  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("MenFee"))):
        $eexamfileMenFee  = getValue($oRSeexamfile->Fields("MenFee"));
    else:
        $eexamfileMenFee  = htmlentities(getValue($oRSeexamfile->Fields("MenFee")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("AbaFee"))):
    $eexamfileAbaFee  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("AbaFee"))):
        $eexamfileAbaFee  = getValue($oRSeexamfile->Fields("AbaFee"));
    else:
        $eexamfileAbaFee  = htmlentities(getValue($oRSeexamfile->Fields("AbaFee")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("AurFee"))):
    $eexamfileAurFee  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("AurFee"))):
        $eexamfileAurFee  = getValue($oRSeexamfile->Fields("AurFee"));
    else:
        $eexamfileAurFee  = htmlentities(getValue($oRSeexamfile->Fields("AurFee")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("Total"))):
    $eexamfileTotal  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("Total"))):
        $eexamfileTotal  = getValue($oRSeexamfile->Fields("Total"));
    else:
        $eexamfileTotal  = htmlentities(getValue($oRSeexamfile->Fields("Total")));
    endif;
endif;
if (is_null($oRSeexamfile->Fields("Remarks"))):
    $eexamfileRemarks  = "";
else:
    if (is_numeric($oRSeexamfile->Fields("Remarks"))):
        $eexamfileRemarks  = getValue($oRSeexamfile->Fields("Remarks"));
    else:
        $eexamfileRemarks  = htmlentities(getValue($oRSeexamfile->Fields("Remarks")));
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
$dbNavBarPrev = "<a href=Updateeexamfile" . "view.php?";
$dbNavBarNext = "<a href=Updateeexamfile" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRSeexamfile->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRSeexamfile->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRSeexamfile->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRSeexamfile->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRSeexamfile->Fields("Date");
$dbNavBarNext  .= "&ID3=" . $oRSeexamfile->Fields("Date");
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
$oRSeexamfile->Close();
MergeUpdateeexamfileTemplate($HTML_Template);
unset($oRSeexamfile);
    $objConn1->Close();
    unset($objConn1);
?>
