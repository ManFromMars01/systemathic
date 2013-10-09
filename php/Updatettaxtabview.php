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

$HTML_Template = getRequest("HTMLT");

$ID1 = "";
$ID2 = "";
$ID3 = "";
$UpdatettaxtabFormAction = "Updatettaxtab" . "edit.php";
$ttaxtabCountryID = "";
$ttaxtabBranchID = "";
$ttaxtabTaxID = "";
$ttaxtabDescription = "";
$ttaxtabRate = "";
$ttaxtabDept = "";
$ttaxtabAccount = "";
$ttaxtabCurrTaxAmt = "";
$ttaxtabMTDTaxAmt = "";
$ttaxtabYTDTaxAmt = "";
$ttaxtabStatus = "";
function  MergeUpdatettaxtabTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatettaxtab" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatettaxtabFormAction;
    global $ttaxtabCountryID;
    global $ttaxtabBranchID;
    global $ttaxtabTaxID;
    global $ttaxtabDescription;
    global $ttaxtabRate;
    global $ttaxtabDept;
    global $ttaxtabAccount;
    global $ttaxtabCurrTaxAmt;
    global $ttaxtabMTDTaxAmt;
    global $ttaxtabYTDTaxAmt;
    global $ttaxtabStatus;
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

    $TemplateText = Replace($TemplateText,"@UpdatettaxtabFormAction@",$UpdatettaxtabFormAction);    
    $TemplateText = Replace($TemplateText,"@ttaxtabCountryID@",$ttaxtabCountryID);    
    $TemplateText = Replace($TemplateText,"@ttaxtabBranchID@",$ttaxtabBranchID);    
    $TemplateText = Replace($TemplateText,"@ttaxtabTaxID@",$ttaxtabTaxID);    
    $TemplateText = Replace($TemplateText,"@ttaxtabDescription@",$ttaxtabDescription);    
    $TemplateText = Replace($TemplateText,"@ttaxtabRate@",$ttaxtabRate);    
    $TemplateText = Replace($TemplateText,"@ttaxtabDept@",$ttaxtabDept);    
    $TemplateText = Replace($TemplateText,"@ttaxtabAccount@",$ttaxtabAccount);    
    $TemplateText = Replace($TemplateText,"@ttaxtabCurrTaxAmt@",$ttaxtabCurrTaxAmt);    
    $TemplateText = Replace($TemplateText,"@ttaxtabMTDTaxAmt@",$ttaxtabMTDTaxAmt);    
    $TemplateText = Replace($TemplateText,"@ttaxtabYTDTaxAmt@",$ttaxtabYTDTaxAmt);    
    $TemplateText = Replace($TemplateText,"@ttaxtabStatus@",$ttaxtabStatus);    
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
$myQuoteID1 = getQuote($objConn1,"ttaxtab","CountryID");
$myQuoteID2 = getQuote($objConn1,"ttaxtab","BranchID");
$myQuoteID3 = getQuote($objConn1,"ttaxtab","TaxID");
$strSQLBase  = "SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt, ttaxtab.YTDTaxAmt, ttaxtab.Status  FROM  ttaxtab  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "ttaxtab.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND ttaxtab.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND ttaxtab.TaxID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY ttaxtab.TaxID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY ttaxtab.TaxID ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRSttaxtab = $objConn1->SelectLimit($strSQL,1);
if (($oRSttaxtab->EOF == TRUE) || ($oRSttaxtab->CurrentRow() == -1)):
    $oRSttaxtab->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRSttaxtab->MoveFirst() == FALSE):
    $oRSttaxtab->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRSttaxtab->Fields("CountryID");
$ID2 = $oRSttaxtab->Fields("BranchID");
$ID3 = $oRSttaxtab->Fields("TaxID");
if (is_null($oRSttaxtab->Fields("CountryID"))):
    $ttaxtabCountryID  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("CountryID"))):
        $ttaxtabCountryID  = getValue($oRSttaxtab->Fields("CountryID"));
    else:
        $ttaxtabCountryID  = htmlentities(getValue($oRSttaxtab->Fields("CountryID")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("BranchID"))):
    $ttaxtabBranchID  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("BranchID"))):
        $ttaxtabBranchID  = getValue($oRSttaxtab->Fields("BranchID"));
    else:
        $ttaxtabBranchID  = htmlentities(getValue($oRSttaxtab->Fields("BranchID")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("TaxID"))):
    $ttaxtabTaxID  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("TaxID"))):
        $ttaxtabTaxID  = getValue($oRSttaxtab->Fields("TaxID"));
    else:
        $ttaxtabTaxID  = htmlentities(getValue($oRSttaxtab->Fields("TaxID")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("Description"))):
    $ttaxtabDescription  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("Description"))):
        $ttaxtabDescription  = getValue($oRSttaxtab->Fields("Description"));
    else:
        $ttaxtabDescription  = htmlentities(getValue($oRSttaxtab->Fields("Description")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("Rate"))):
    $ttaxtabRate  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("Rate"))):
        $ttaxtabRate  = getValue($oRSttaxtab->Fields("Rate"));
    else:
        $ttaxtabRate  = htmlentities(getValue($oRSttaxtab->Fields("Rate")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("Dept"))):
    $ttaxtabDept  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("Dept"))):
        $ttaxtabDept  = getValue($oRSttaxtab->Fields("Dept"));
    else:
        $ttaxtabDept  = htmlentities(getValue($oRSttaxtab->Fields("Dept")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("Account"))):
    $ttaxtabAccount  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("Account"))):
        $ttaxtabAccount  = getValue($oRSttaxtab->Fields("Account"));
    else:
        $ttaxtabAccount  = htmlentities(getValue($oRSttaxtab->Fields("Account")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("CurrTaxAmt"))):
    $ttaxtabCurrTaxAmt  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("CurrTaxAmt"))):
        $ttaxtabCurrTaxAmt  = getValue($oRSttaxtab->Fields("CurrTaxAmt"));
    else:
        $ttaxtabCurrTaxAmt  = htmlentities(getValue($oRSttaxtab->Fields("CurrTaxAmt")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("MTDTaxAmt"))):
    $ttaxtabMTDTaxAmt  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("MTDTaxAmt"))):
        $ttaxtabMTDTaxAmt  = getValue($oRSttaxtab->Fields("MTDTaxAmt"));
    else:
        $ttaxtabMTDTaxAmt  = htmlentities(getValue($oRSttaxtab->Fields("MTDTaxAmt")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("YTDTaxAmt"))):
    $ttaxtabYTDTaxAmt  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("YTDTaxAmt"))):
        $ttaxtabYTDTaxAmt  = getValue($oRSttaxtab->Fields("YTDTaxAmt"));
    else:
        $ttaxtabYTDTaxAmt  = htmlentities(getValue($oRSttaxtab->Fields("YTDTaxAmt")));
    endif;
endif;
if (is_null($oRSttaxtab->Fields("Status"))):
    $ttaxtabStatus  = "";
else:
    if (is_numeric($oRSttaxtab->Fields("Status"))):
        $ttaxtabStatus  = getValue($oRSttaxtab->Fields("Status"));
    else:
        $ttaxtabStatus  = htmlentities(getValue($oRSttaxtab->Fields("Status")));
    endif;
endif;
$EditLevel = 1;

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
$dbNavBarPrev = "<a href=Updatettaxtab" . "view.php?";
$dbNavBarNext = "<a href=Updatettaxtab" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRSttaxtab->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRSttaxtab->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRSttaxtab->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRSttaxtab->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRSttaxtab->Fields("TaxID");
$dbNavBarNext  .= "&ID3=" . $oRSttaxtab->Fields("TaxID");
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
$oRSttaxtab->Close();
MergeUpdatettaxtabTemplate($HTML_Template);
unset($oRSttaxtab);
    $objConn1->Close();
    unset($objConn1);
?>
