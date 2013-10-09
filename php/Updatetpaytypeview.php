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
$UpdatetpaytypeFormAction = "Updatetpaytype" . "edit.php";
$tpaytypeCountryID = "";
$tpaytypeBranchID = "";
$tpaytypePayType = "";
$tpaytypeDescription = "";
$tpaytypeAmount = "";
$tpaytypeCommAmt = "";
$tpaytypeSalesTax = "";
$tpaytypeAccount = "";
$tpaytypeMTDQty = "";
$tpaytypeMTDAmt = "";
$tpaytypeYTDQty = "";
$tpaytypeYTDAmt = "";
$tpaytypeType = "";
function  MergeUpdatetpaytypeTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetpaytype" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetpaytypeFormAction;
    global $tpaytypeCountryID;
    global $tpaytypeBranchID;
    global $tpaytypePayType;
    global $tpaytypeDescription;
    global $tpaytypeAmount;
    global $tpaytypeCommAmt;
    global $tpaytypeSalesTax;
    global $tpaytypeAccount;
    global $tpaytypeMTDQty;
    global $tpaytypeMTDAmt;
    global $tpaytypeYTDQty;
    global $tpaytypeYTDAmt;
    global $tpaytypeType;
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

    $TemplateText = Replace($TemplateText,"@UpdatetpaytypeFormAction@",$UpdatetpaytypeFormAction);    
    $TemplateText = Replace($TemplateText,"@tpaytypeCountryID@",$tpaytypeCountryID);    
    $TemplateText = Replace($TemplateText,"@tpaytypeBranchID@",$tpaytypeBranchID);    
    $TemplateText = Replace($TemplateText,"@tpaytypePayType@",$tpaytypePayType);    
    $TemplateText = Replace($TemplateText,"@tpaytypeDescription@",$tpaytypeDescription);    
    $TemplateText = Replace($TemplateText,"@tpaytypeAmount@",$tpaytypeAmount);    
    $TemplateText = Replace($TemplateText,"@tpaytypeCommAmt@",$tpaytypeCommAmt);    
    $TemplateText = Replace($TemplateText,"@tpaytypeSalesTax@",$tpaytypeSalesTax);    
    $TemplateText = Replace($TemplateText,"@tpaytypeAccount@",$tpaytypeAccount);    
    $TemplateText = Replace($TemplateText,"@tpaytypeMTDQty@",$tpaytypeMTDQty);    
    $TemplateText = Replace($TemplateText,"@tpaytypeMTDAmt@",$tpaytypeMTDAmt);    
    $TemplateText = Replace($TemplateText,"@tpaytypeYTDQty@",$tpaytypeYTDQty);    
    $TemplateText = Replace($TemplateText,"@tpaytypeYTDAmt@",$tpaytypeYTDAmt);    
    $TemplateText = Replace($TemplateText,"@tpaytypeType@",$tpaytypeType);    
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
$myQuoteID1 = getQuote($objConn1,"tpaytype","CountryID");
$myQuoteID2 = getQuote($objConn1,"tpaytype","BranchID");
$myQuoteID3 = getQuote($objConn1,"tpaytype","PayType");
$strSQLBase  = "SELECT tpaytype.CountryID, tpaytype.BranchID, tpaytype.PayType, tpaytype.Description, tpaytype.Amount, tpaytype.CommAmt, tpaytype.SalesTax, tpaytype.Account, tpaytype.MTDQty, tpaytype.MTDAmt, tpaytype.YTDQty, tpaytype.YTDAmt, tpaytype.Type  FROM  tpaytype  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tpaytype.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tpaytype.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tpaytype.PayType ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tpaytype.PayType DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tpaytype.PayType ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStpaytype = $objConn1->SelectLimit($strSQL,1);
if (($oRStpaytype->EOF == TRUE) || ($oRStpaytype->CurrentRow() == -1)):
    $oRStpaytype->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStpaytype->MoveFirst() == FALSE):
    $oRStpaytype->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStpaytype->Fields("CountryID");
$ID2 = $oRStpaytype->Fields("BranchID");
$ID3 = $oRStpaytype->Fields("PayType");
if (is_null($oRStpaytype->Fields("CountryID"))):
    $tpaytypeCountryID  = "";
else:
    if (is_numeric($oRStpaytype->Fields("CountryID"))):
        $tpaytypeCountryID  = getValue($oRStpaytype->Fields("CountryID"));
    else:
        $tpaytypeCountryID  = htmlentities(getValue($oRStpaytype->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("BranchID"))):
    $tpaytypeBranchID  = "";
else:
    if (is_numeric($oRStpaytype->Fields("BranchID"))):
        $tpaytypeBranchID  = getValue($oRStpaytype->Fields("BranchID"));
    else:
        $tpaytypeBranchID  = htmlentities(getValue($oRStpaytype->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("PayType"))):
    $tpaytypePayType  = "";
else:
    if (is_numeric($oRStpaytype->Fields("PayType"))):
        $tpaytypePayType  = getValue($oRStpaytype->Fields("PayType"));
    else:
        $tpaytypePayType  = htmlentities(getValue($oRStpaytype->Fields("PayType")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("Description"))):
    $tpaytypeDescription  = "";
else:
    if (is_numeric($oRStpaytype->Fields("Description"))):
        $tpaytypeDescription  = getValue($oRStpaytype->Fields("Description"));
    else:
        $tpaytypeDescription  = htmlentities(getValue($oRStpaytype->Fields("Description")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("Amount"))):
    $tpaytypeAmount  = "";
else:
    if (is_numeric($oRStpaytype->Fields("Amount"))):
        $tpaytypeAmount  = getValue($oRStpaytype->Fields("Amount"));
    else:
        $tpaytypeAmount  = htmlentities(getValue($oRStpaytype->Fields("Amount")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("CommAmt"))):
    $tpaytypeCommAmt  = "";
else:
    if (is_numeric($oRStpaytype->Fields("CommAmt"))):
        $tpaytypeCommAmt  = getValue($oRStpaytype->Fields("CommAmt"));
    else:
        $tpaytypeCommAmt  = htmlentities(getValue($oRStpaytype->Fields("CommAmt")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("SalesTax"))):
    $tpaytypeSalesTax  = "";
else:
    if (is_numeric($oRStpaytype->Fields("SalesTax"))):
        $tpaytypeSalesTax  = getValue($oRStpaytype->Fields("SalesTax"));
    else:
        $tpaytypeSalesTax  = htmlentities(getValue($oRStpaytype->Fields("SalesTax")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("Account"))):
    $tpaytypeAccount  = "";
else:
    if (is_numeric($oRStpaytype->Fields("Account"))):
        $tpaytypeAccount  = getValue($oRStpaytype->Fields("Account"));
    else:
        $tpaytypeAccount  = htmlentities(getValue($oRStpaytype->Fields("Account")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("MTDQty"))):
    $tpaytypeMTDQty  = "";
else:
    if (is_numeric($oRStpaytype->Fields("MTDQty"))):
        $tpaytypeMTDQty  = getValue($oRStpaytype->Fields("MTDQty"));
    else:
        $tpaytypeMTDQty  = htmlentities(getValue($oRStpaytype->Fields("MTDQty")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("MTDAmt"))):
    $tpaytypeMTDAmt  = "";
else:
    if (is_numeric($oRStpaytype->Fields("MTDAmt"))):
        $tpaytypeMTDAmt  = getValue($oRStpaytype->Fields("MTDAmt"));
    else:
        $tpaytypeMTDAmt  = htmlentities(getValue($oRStpaytype->Fields("MTDAmt")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("YTDQty"))):
    $tpaytypeYTDQty  = "";
else:
    if (is_numeric($oRStpaytype->Fields("YTDQty"))):
        $tpaytypeYTDQty  = getValue($oRStpaytype->Fields("YTDQty"));
    else:
        $tpaytypeYTDQty  = htmlentities(getValue($oRStpaytype->Fields("YTDQty")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("YTDAmt"))):
    $tpaytypeYTDAmt  = "";
else:
    if (is_numeric($oRStpaytype->Fields("YTDAmt"))):
        $tpaytypeYTDAmt  = getValue($oRStpaytype->Fields("YTDAmt"));
    else:
        $tpaytypeYTDAmt  = htmlentities(getValue($oRStpaytype->Fields("YTDAmt")));
    endif;
endif;
if (is_null($oRStpaytype->Fields("Type"))):
    $tpaytypeType    =    "";
else:
    $tpaytypeType  = htmlentities($oRStpaytype->Fields("Type"));
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
$dbNavBarPrev = "<a href=Updatetpaytype" . "view.php?";
$dbNavBarNext = "<a href=Updatetpaytype" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStpaytype->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStpaytype->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStpaytype->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStpaytype->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStpaytype->Fields("PayType");
$dbNavBarNext  .= "&ID3=" . $oRStpaytype->Fields("PayType");
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
$oRStpaytype->Close();
MergeUpdatetpaytypeTemplate($HTML_Template);
unset($oRStpaytype);
    $objConn1->Close();
    unset($objConn1);
?>
