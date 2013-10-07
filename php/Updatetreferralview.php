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
$UpdatetreferralFormAction = "Updatetreferral" . "edit.php";
$treferralCountryID = "";
$treferralBranchID = "";
$treferralID = "";
$treferralDescription = "";
function  MergeUpdatetreferralTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetreferral" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetreferralFormAction;
    global $treferralCountryID;
    global $treferralBranchID;
    global $treferralID;
    global $treferralDescription;
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

    $TemplateText = Replace($TemplateText,"@UpdatetreferralFormAction@",$UpdatetreferralFormAction);    
    $TemplateText = Replace($TemplateText,"@treferralCountryID@",$treferralCountryID);    
    $TemplateText = Replace($TemplateText,"@treferralBranchID@",$treferralBranchID);    
    $TemplateText = Replace($TemplateText,"@treferralID@",$treferralID);    
    $TemplateText = Replace($TemplateText,"@treferralDescription@",$treferralDescription);    
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
    $ClarionData .= "<a href=BrowseAttendanceStatus" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"treferral","CountryID");
$myQuoteID2 = getQuote($objConn1,"treferral","BranchID");
$myQuoteID3 = getQuote($objConn1,"treferral","ID");
$strSQLBase  = "SELECT treferral.CountryID, treferral.BranchID, treferral.ID, treferral.Description  FROM  treferral  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "treferral.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND treferral.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND treferral.ID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY treferral.ID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY treferral.ID ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStreferral = $objConn1->SelectLimit($strSQL,1);
if (($oRStreferral->EOF == TRUE) || ($oRStreferral->CurrentRow() == -1)):
    $oRStreferral->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStreferral->MoveFirst() == FALSE):
    $oRStreferral->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStreferral->Fields("CountryID");
$ID2 = $oRStreferral->Fields("BranchID");
$ID3 = $oRStreferral->Fields("ID");
if (is_null($oRStreferral->Fields("CountryID"))):
    $treferralCountryID  = "";
else:
    if (is_numeric($oRStreferral->Fields("CountryID"))):
        $treferralCountryID  = getValue($oRStreferral->Fields("CountryID"));
    else:
        $treferralCountryID  = htmlentities(getValue($oRStreferral->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStreferral->Fields("BranchID"))):
    $treferralBranchID  = "";
else:
    if (is_numeric($oRStreferral->Fields("BranchID"))):
        $treferralBranchID  = getValue($oRStreferral->Fields("BranchID"));
    else:
        $treferralBranchID  = htmlentities(getValue($oRStreferral->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStreferral->Fields("ID"))):
    $treferralID  = "";
else:
    if (is_numeric($oRStreferral->Fields("ID"))):
        $treferralID  = getValue($oRStreferral->Fields("ID"));
    else:
        $treferralID  = htmlentities(getValue($oRStreferral->Fields("ID")));
    endif;
endif;
if (is_null($oRStreferral->Fields("Description"))):
    $treferralDescription  = "";
else:
    if (is_numeric($oRStreferral->Fields("Description"))):
        $treferralDescription  = getValue($oRStreferral->Fields("Description"));
    else:
        $treferralDescription  = htmlentities(getValue($oRStreferral->Fields("Description")));
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
$dbNavBarPrev = "<a href=Updatetreferral" . "view.php?";
$dbNavBarNext = "<a href=Updatetreferral" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStreferral->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStreferral->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStreferral->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStreferral->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStreferral->Fields("ID");
$dbNavBarNext  .= "&ID3=" . $oRStreferral->Fields("ID");
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
$oRStreferral->Close();
MergeUpdatetreferralTemplate($HTML_Template);
unset($oRStreferral);
    $objConn1->Close();
    unset($objConn1);
?>
