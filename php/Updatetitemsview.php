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
$UpdatetitemsFormAction = "Updatetitems" . "edit.php";
$titemsCountryID = "";
$titemsBranchID = "";
$titemsItemNo = "";
$titemsDescription = "";
$titemsIsBook = "";
$titemsIsMultiCat = "";
$titemsIsAbacus = "";
$titemsIsMental = "";
$titemsIsSupp = "";
$titemsAbaDesc = "";
$titemsMenDesc = "";
$titemsSuppDesc = "";
$titemsAbaNxtBook1 = "";
$titemsAbaNxtBook2 = "";
$titemsAbaNxtBook3 = "";
$titemsAbaPrvBook1 = "";
$titemsAbaPrvBook2 = "";
$titemsAbaPrvBook3 = "";
$titemsAbaPreBook1 = "";
$titemsAbaPreBook2 = "";
$titemsAbaPreBook3 = "";
$titemsAbaRptCnt1 = "";
$titemsAbaRptCnt2 = "";
$titemsAbaRptCnt3 = "";
$titemsAbaDigitStart = "";
$titemsAbaDigitEnd = "";
$titemsAbaNumStart = "";
$titemsAbaNumEnd = "";
$titemsAbaBookGrade = "";
$titemsMenNxtBook1 = "";
$titemsMenNxtBook2 = "";
$titemsMenNxtBook3 = "";
$titemsMenPrvBook1 = "";
$titemsMenPrvBook2 = "";
$titemsMenPrvBook3 = "";
$titemsMenPreBook1 = "";
$titemsMenPreBook2 = "";
$titemsMenPreBook3 = "";
$titemsMenRptCnt1 = "";
$titemsMenRptCnt2 = "";
$titemsMenRptCnt3 = "";
$titemsMenDigitStart = "";
$titemsMenDigitEnd = "";
$titemsMenNumStart = "";
$titemsMenNumEnd = "";
$titemsMenBookGrade = "";
$titemsSuppNxtBook1 = "";
$titemsSuppNxtBook2 = "";
$titemsSuppNxtBook3 = "";
$titemsSuppPrvBook1 = "";
$titemsSuppPrvBook2 = "";
$titemsSuppPrvBook3 = "";
$titemsSuppPreBook1 = "";
$titemsSuppPreBook2 = "";
$titemsSuppPreBook3 = "";
$titemsSuppRptCnt1 = "";
$titemsSuppRptCnt2 = "";
$titemsSuppRptCnt3 = "";
$titemsSuppDigitStart = "";
$titemsSuppDigitEnd = "";
$titemsSuppNumStart = "";
$titemsSuppNumEnd = "";
$titemsSuppBookGrade = "";
$titemsCatID = "";
$titemsSubCatID = "";
$titemsDeptID = "";
$titemsManufacturerID = "";
$titemsLocationID = "";
$titemsIssuUntCost = "";
$titemsIssuUntMea = "";
$titemsPurUntCost = "";
$titemsReOrderPT = "";
$titemsReOrderQty = "";
$titemsLastPurVdrID = "";
$titemsReOrderReq = "";
$titemsLstOrderCost = "";
$titemsStdCost = "";
$titemsQtyOnHand = "";
$titemsQtyOnOrder = "";
function  MergeUpdatetitemsTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetitems" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetitemsFormAction;
    global $titemsCountryID;
    global $titemsBranchID;
    global $titemsItemNo;
    global $titemsDescription;
    global $titemsIsBook;
    global $titemsIsMultiCat;
    global $titemsIsAbacus;
    global $titemsIsMental;
    global $titemsIsSupp;
    global $titemsAbaDesc;
    global $titemsMenDesc;
    global $titemsSuppDesc;
    global $titemsAbaNxtBook1;
    global $titemsAbaNxtBook2;
    global $titemsAbaNxtBook3;
    global $titemsAbaPrvBook1;
    global $titemsAbaPrvBook2;
    global $titemsAbaPrvBook3;
    global $titemsAbaPreBook1;
    global $titemsAbaPreBook2;
    global $titemsAbaPreBook3;
    global $titemsAbaRptCnt1;
    global $titemsAbaRptCnt2;
    global $titemsAbaRptCnt3;
    global $titemsAbaDigitStart;
    global $titemsAbaDigitEnd;
    global $titemsAbaNumStart;
    global $titemsAbaNumEnd;
    global $titemsAbaBookGrade;
    global $titemsMenNxtBook1;
    global $titemsMenNxtBook2;
    global $titemsMenNxtBook3;
    global $titemsMenPrvBook1;
    global $titemsMenPrvBook2;
    global $titemsMenPrvBook3;
    global $titemsMenPreBook1;
    global $titemsMenPreBook2;
    global $titemsMenPreBook3;
    global $titemsMenRptCnt1;
    global $titemsMenRptCnt2;
    global $titemsMenRptCnt3;
    global $titemsMenDigitStart;
    global $titemsMenDigitEnd;
    global $titemsMenNumStart;
    global $titemsMenNumEnd;
    global $titemsMenBookGrade;
    global $titemsSuppNxtBook1;
    global $titemsSuppNxtBook2;
    global $titemsSuppNxtBook3;
    global $titemsSuppPrvBook1;
    global $titemsSuppPrvBook2;
    global $titemsSuppPrvBook3;
    global $titemsSuppPreBook1;
    global $titemsSuppPreBook2;
    global $titemsSuppPreBook3;
    global $titemsSuppRptCnt1;
    global $titemsSuppRptCnt2;
    global $titemsSuppRptCnt3;
    global $titemsSuppDigitStart;
    global $titemsSuppDigitEnd;
    global $titemsSuppNumStart;
    global $titemsSuppNumEnd;
    global $titemsSuppBookGrade;
    global $titemsCatID;
    global $titemsSubCatID;
    global $titemsDeptID;
    global $titemsManufacturerID;
    global $titemsLocationID;
    global $titemsIssuUntCost;
    global $titemsIssuUntMea;
    global $titemsPurUntCost;
    global $titemsReOrderPT;
    global $titemsReOrderQty;
    global $titemsLastPurVdrID;
    global $titemsReOrderReq;
    global $titemsLstOrderCost;
    global $titemsStdCost;
    global $titemsQtyOnHand;
    global $titemsQtyOnOrder;
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

    $TemplateText = Replace($TemplateText,"@UpdatetitemsFormAction@",$UpdatetitemsFormAction);    
    $TemplateText = Replace($TemplateText,"@titemsCountryID@",$titemsCountryID);    
    $TemplateText = Replace($TemplateText,"@titemsBranchID@",$titemsBranchID);    
    $TemplateText = Replace($TemplateText,"@titemsItemNo@",$titemsItemNo);    
    $TemplateText = Replace($TemplateText,"@titemsDescription@",$titemsDescription);    
    $TemplateText = Replace($TemplateText,"@titemsIsBook@",$titemsIsBook);    
    $TemplateText = Replace($TemplateText,"@titemsIsMultiCat@",$titemsIsMultiCat);    
    $TemplateText = Replace($TemplateText,"@titemsIsAbacus@",$titemsIsAbacus);    
    $TemplateText = Replace($TemplateText,"@titemsIsMental@",$titemsIsMental);    
    $TemplateText = Replace($TemplateText,"@titemsIsSupp@",$titemsIsSupp);    
    $TemplateText = Replace($TemplateText,"@titemsAbaDesc@",$titemsAbaDesc);    
    $TemplateText = Replace($TemplateText,"@titemsMenDesc@",$titemsMenDesc);    
    $TemplateText = Replace($TemplateText,"@titemsSuppDesc@",$titemsSuppDesc);    
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook1@",$titemsAbaNxtBook1);    
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook2@",$titemsAbaNxtBook2);    
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook3@",$titemsAbaNxtBook3);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook1@",$titemsAbaPrvBook1);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook2@",$titemsAbaPrvBook2);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook3@",$titemsAbaPrvBook3);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook1@",$titemsAbaPreBook1);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook2@",$titemsAbaPreBook2);    
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook3@",$titemsAbaPreBook3);    
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt1@",$titemsAbaRptCnt1);    
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt2@",$titemsAbaRptCnt2);    
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt3@",$titemsAbaRptCnt3);    
    $TemplateText = Replace($TemplateText,"@titemsAbaDigitStart@",$titemsAbaDigitStart);    
    $TemplateText = Replace($TemplateText,"@titemsAbaDigitEnd@",$titemsAbaDigitEnd);    
    $TemplateText = Replace($TemplateText,"@titemsAbaNumStart@",$titemsAbaNumStart);    
    $TemplateText = Replace($TemplateText,"@titemsAbaNumEnd@",$titemsAbaNumEnd);    
    $TemplateText = Replace($TemplateText,"@titemsAbaBookGrade@",$titemsAbaBookGrade);    
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook1@",$titemsMenNxtBook1);    
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook2@",$titemsMenNxtBook2);    
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook3@",$titemsMenNxtBook3);    
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook1@",$titemsMenPrvBook1);    
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook2@",$titemsMenPrvBook2);    
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook3@",$titemsMenPrvBook3);    
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook1@",$titemsMenPreBook1);    
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook2@",$titemsMenPreBook2);    
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook3@",$titemsMenPreBook3);    
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt1@",$titemsMenRptCnt1);    
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt2@",$titemsMenRptCnt2);    
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt3@",$titemsMenRptCnt3);    
    $TemplateText = Replace($TemplateText,"@titemsMenDigitStart@",$titemsMenDigitStart);    
    $TemplateText = Replace($TemplateText,"@titemsMenDigitEnd@",$titemsMenDigitEnd);    
    $TemplateText = Replace($TemplateText,"@titemsMenNumStart@",$titemsMenNumStart);    
    $TemplateText = Replace($TemplateText,"@titemsMenNumEnd@",$titemsMenNumEnd);    
    $TemplateText = Replace($TemplateText,"@titemsMenBookGrade@",$titemsMenBookGrade);    
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook1@",$titemsSuppNxtBook1);    
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook2@",$titemsSuppNxtBook2);    
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook3@",$titemsSuppNxtBook3);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook1@",$titemsSuppPrvBook1);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook2@",$titemsSuppPrvBook2);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook3@",$titemsSuppPrvBook3);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook1@",$titemsSuppPreBook1);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook2@",$titemsSuppPreBook2);    
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook3@",$titemsSuppPreBook3);    
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt1@",$titemsSuppRptCnt1);    
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt2@",$titemsSuppRptCnt2);    
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt3@",$titemsSuppRptCnt3);    
    $TemplateText = Replace($TemplateText,"@titemsSuppDigitStart@",$titemsSuppDigitStart);    
    $TemplateText = Replace($TemplateText,"@titemsSuppDigitEnd@",$titemsSuppDigitEnd);    
    $TemplateText = Replace($TemplateText,"@titemsSuppNumStart@",$titemsSuppNumStart);    
    $TemplateText = Replace($TemplateText,"@titemsSuppNumEnd@",$titemsSuppNumEnd);    
    $TemplateText = Replace($TemplateText,"@titemsSuppBookGrade@",$titemsSuppBookGrade);    
    $TemplateText = Replace($TemplateText,"@titemsCatID@",$titemsCatID);    
    $TemplateText = Replace($TemplateText,"@titemsSubCatID@",$titemsSubCatID);    
    $TemplateText = Replace($TemplateText,"@titemsDeptID@",$titemsDeptID);    
    $TemplateText = Replace($TemplateText,"@titemsManufacturerID@",$titemsManufacturerID);    
    $TemplateText = Replace($TemplateText,"@titemsLocationID@",$titemsLocationID);    
    $TemplateText = Replace($TemplateText,"@titemsIssuUntCost@",$titemsIssuUntCost);    
    $TemplateText = Replace($TemplateText,"@titemsIssuUntMea@",$titemsIssuUntMea);    
    $TemplateText = Replace($TemplateText,"@titemsPurUntCost@",$titemsPurUntCost);    
    $TemplateText = Replace($TemplateText,"@titemsReOrderPT@",$titemsReOrderPT);    
    $TemplateText = Replace($TemplateText,"@titemsReOrderQty@",$titemsReOrderQty);    
    $TemplateText = Replace($TemplateText,"@titemsLastPurVdrID@",$titemsLastPurVdrID);    
    $TemplateText = Replace($TemplateText,"@titemsReOrderReq@",$titemsReOrderReq);    
    $TemplateText = Replace($TemplateText,"@titemsLstOrderCost@",$titemsLstOrderCost);    
    $TemplateText = Replace($TemplateText,"@titemsStdCost@",$titemsStdCost);    
    $TemplateText = Replace($TemplateText,"@titemsQtyOnHand@",$titemsQtyOnHand);    
    $TemplateText = Replace($TemplateText,"@titemsQtyOnOrder@",$titemsQtyOnOrder);    
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
$myQuoteID1 = getQuote($objConn1,"titems","CountryID");
$myQuoteID2 = getQuote($objConn1,"titems","BranchID");
$myQuoteID3 = getQuote($objConn1,"titems","ItemNo");
$strSQLBase  = "SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp, titems.AbaDesc, titems.MenDesc, titems.SuppDesc, titems.AbaNxtBook1, titems.AbaNxtBook2, titems.AbaNxtBook3, titems.AbaPrvBook1, titems.AbaPrvBook2, titems.AbaPrvBook3, titems.AbaPreBook1, titems.AbaPreBook2, titems.AbaPreBook3, titems.AbaRptCnt1, titems.AbaRptCnt2, titems.AbaRptCnt3, titems.AbaDigitStart, titems.AbaDigitEnd, titems.AbaNumStart, titems.AbaNumEnd, titems.AbaBookGrade, titems.MenNxtBook1, titems.MenNxtBook2, titems.MenNxtBook3, titems.MenPrvBook1, titems.MenPrvBook2, titems.MenPrvBook3, titems.MenPreBook1, titems.MenPreBook2, titems.MenPreBook3, titems.MenRptCnt1, titems.MenRptCnt2, titems.MenRptCnt3, titems.MenDigitStart, titems.MenDigitEnd, titems.MenNumStart, titems.MenNumEnd, titems.MenBookGrade, titems.SuppNxtBook1, titems.SuppNxtBook2, titems.SuppNxtBook3, titems.SuppPrvBook1, titems.SuppPrvBook2, titems.SuppPrvBook3, titems.SuppPreBook1, titems.SuppPreBook2, titems.SuppPreBook3, titems.SuppRptCnt1, titems.SuppRptCnt2, titems.SuppRptCnt3, titems.SuppDigitStart, titems.SuppDigitEnd, titems.SuppNumStart, titems.SuppNumEnd, titems.SuppBookGrade, titems.CatID, titems.SubCatID, titems.DeptID, titems.ManufacturerID, titems.LocationID, titems.IssuUntCost, titems.IssuUntMea, titems.PurUntCost, titems.ReOrderPT, titems.ReOrderQty, titems.LastPurVdrID, titems.ReOrderReq, titems.LstOrderCost, titems.StdCost, titems.QtyOnHand, titems.QtyOnOrder  FROM  titems  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "titems.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND titems.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND titems.ItemNo ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY titems.ItemNo DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY titems.ItemNo ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStitems = $objConn1->SelectLimit($strSQL,1);
if (($oRStitems->EOF == TRUE) || ($oRStitems->CurrentRow() == -1)):
    $oRStitems->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStitems->MoveFirst() == FALSE):
    $oRStitems->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStitems->Fields("CountryID");
$ID2 = $oRStitems->Fields("BranchID");
$ID3 = $oRStitems->Fields("ItemNo");
if (is_null($oRStitems->Fields("CountryID"))):
    $titemsCountryID  = "";
else:
    if (is_numeric($oRStitems->Fields("CountryID"))):
        $titemsCountryID  = getValue($oRStitems->Fields("CountryID"));
    else:
        $titemsCountryID  = htmlentities(getValue($oRStitems->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStitems->Fields("BranchID"))):
    $titemsBranchID  = "";
else:
    if (is_numeric($oRStitems->Fields("BranchID"))):
        $titemsBranchID  = getValue($oRStitems->Fields("BranchID"));
    else:
        $titemsBranchID  = htmlentities(getValue($oRStitems->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStitems->Fields("ItemNo"))):
    $titemsItemNo  = "";
else:
    if (is_numeric($oRStitems->Fields("ItemNo"))):
        $titemsItemNo  = getValue($oRStitems->Fields("ItemNo"));
    else:
        $titemsItemNo  = htmlentities(getValue($oRStitems->Fields("ItemNo")));
    endif;
endif;
if (is_null($oRStitems->Fields("Description"))):
    $titemsDescription  = "";
else:
    if (is_numeric($oRStitems->Fields("Description"))):
        $titemsDescription  = getValue($oRStitems->Fields("Description"));
    else:
        $titemsDescription  = htmlentities(getValue($oRStitems->Fields("Description")));
    endif;
endif;
if (is_null($oRStitems->Fields("IsBook"))):
    $titemsIsBook  = "";
else:
    if (is_numeric($oRStitems->Fields("IsBook"))):
        $titemsIsBook  = getValue($oRStitems->Fields("IsBook"));
    else:
        $titemsIsBook  = htmlentities(getValue($oRStitems->Fields("IsBook")));
    endif;
endif;
if (is_null($oRStitems->Fields("IsMultiCat"))):
    $titemsIsMultiCat  = "";
else:
    if (is_numeric($oRStitems->Fields("IsMultiCat"))):
        $titemsIsMultiCat  = getValue($oRStitems->Fields("IsMultiCat"));
    else:
        $titemsIsMultiCat  = htmlentities(getValue($oRStitems->Fields("IsMultiCat")));
    endif;
endif;
if (is_null($oRStitems->Fields("IsAbacus"))):
    $titemsIsAbacus  = "";
else:
    if (is_numeric($oRStitems->Fields("IsAbacus"))):
        $titemsIsAbacus  = getValue($oRStitems->Fields("IsAbacus"));
    else:
        $titemsIsAbacus  = htmlentities(getValue($oRStitems->Fields("IsAbacus")));
    endif;
endif;
if (is_null($oRStitems->Fields("IsMental"))):
    $titemsIsMental  = "";
else:
    if (is_numeric($oRStitems->Fields("IsMental"))):
        $titemsIsMental  = getValue($oRStitems->Fields("IsMental"));
    else:
        $titemsIsMental  = htmlentities(getValue($oRStitems->Fields("IsMental")));
    endif;
endif;
if (is_null($oRStitems->Fields("IsSupp"))):
    $titemsIsSupp  = "";
else:
    if (is_numeric($oRStitems->Fields("IsSupp"))):
        $titemsIsSupp  = getValue($oRStitems->Fields("IsSupp"));
    else:
        $titemsIsSupp  = htmlentities(getValue($oRStitems->Fields("IsSupp")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaDesc"))):
    $titemsAbaDesc  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaDesc"))):
        $titemsAbaDesc  = getValue($oRStitems->Fields("AbaDesc"));
    else:
        $titemsAbaDesc  = htmlentities(getValue($oRStitems->Fields("AbaDesc")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenDesc"))):
    $titemsMenDesc  = "";
else:
    if (is_numeric($oRStitems->Fields("MenDesc"))):
        $titemsMenDesc  = getValue($oRStitems->Fields("MenDesc"));
    else:
        $titemsMenDesc  = htmlentities(getValue($oRStitems->Fields("MenDesc")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppDesc"))):
    $titemsSuppDesc  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppDesc"))):
        $titemsSuppDesc  = getValue($oRStitems->Fields("SuppDesc"));
    else:
        $titemsSuppDesc  = htmlentities(getValue($oRStitems->Fields("SuppDesc")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaNxtBook1"))):
    $titemsAbaNxtBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaNxtBook1"))):
        $titemsAbaNxtBook1  = getValue($oRStitems->Fields("AbaNxtBook1"));
    else:
        $titemsAbaNxtBook1  = htmlentities(getValue($oRStitems->Fields("AbaNxtBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaNxtBook2"))):
    $titemsAbaNxtBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaNxtBook2"))):
        $titemsAbaNxtBook2  = getValue($oRStitems->Fields("AbaNxtBook2"));
    else:
        $titemsAbaNxtBook2  = htmlentities(getValue($oRStitems->Fields("AbaNxtBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaNxtBook3"))):
    $titemsAbaNxtBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaNxtBook3"))):
        $titemsAbaNxtBook3  = getValue($oRStitems->Fields("AbaNxtBook3"));
    else:
        $titemsAbaNxtBook3  = htmlentities(getValue($oRStitems->Fields("AbaNxtBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPrvBook1"))):
    $titemsAbaPrvBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPrvBook1"))):
        $titemsAbaPrvBook1  = getValue($oRStitems->Fields("AbaPrvBook1"));
    else:
        $titemsAbaPrvBook1  = htmlentities(getValue($oRStitems->Fields("AbaPrvBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPrvBook2"))):
    $titemsAbaPrvBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPrvBook2"))):
        $titemsAbaPrvBook2  = getValue($oRStitems->Fields("AbaPrvBook2"));
    else:
        $titemsAbaPrvBook2  = htmlentities(getValue($oRStitems->Fields("AbaPrvBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPrvBook3"))):
    $titemsAbaPrvBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPrvBook3"))):
        $titemsAbaPrvBook3  = getValue($oRStitems->Fields("AbaPrvBook3"));
    else:
        $titemsAbaPrvBook3  = htmlentities(getValue($oRStitems->Fields("AbaPrvBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPreBook1"))):
    $titemsAbaPreBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPreBook1"))):
        $titemsAbaPreBook1  = getValue($oRStitems->Fields("AbaPreBook1"));
    else:
        $titemsAbaPreBook1  = htmlentities(getValue($oRStitems->Fields("AbaPreBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPreBook2"))):
    $titemsAbaPreBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPreBook2"))):
        $titemsAbaPreBook2  = getValue($oRStitems->Fields("AbaPreBook2"));
    else:
        $titemsAbaPreBook2  = htmlentities(getValue($oRStitems->Fields("AbaPreBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaPreBook3"))):
    $titemsAbaPreBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaPreBook3"))):
        $titemsAbaPreBook3  = getValue($oRStitems->Fields("AbaPreBook3"));
    else:
        $titemsAbaPreBook3  = htmlentities(getValue($oRStitems->Fields("AbaPreBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaRptCnt1"))):
    $titemsAbaRptCnt1  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaRptCnt1"))):
        $titemsAbaRptCnt1  = getValue($oRStitems->Fields("AbaRptCnt1"));
    else:
        $titemsAbaRptCnt1  = htmlentities(getValue($oRStitems->Fields("AbaRptCnt1")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaRptCnt2"))):
    $titemsAbaRptCnt2  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaRptCnt2"))):
        $titemsAbaRptCnt2  = getValue($oRStitems->Fields("AbaRptCnt2"));
    else:
        $titemsAbaRptCnt2  = htmlentities(getValue($oRStitems->Fields("AbaRptCnt2")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaRptCnt3"))):
    $titemsAbaRptCnt3  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaRptCnt3"))):
        $titemsAbaRptCnt3  = getValue($oRStitems->Fields("AbaRptCnt3"));
    else:
        $titemsAbaRptCnt3  = htmlentities(getValue($oRStitems->Fields("AbaRptCnt3")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaDigitStart"))):
    $titemsAbaDigitStart  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaDigitStart"))):
        $titemsAbaDigitStart  = getValue($oRStitems->Fields("AbaDigitStart"));
    else:
        $titemsAbaDigitStart  = htmlentities(getValue($oRStitems->Fields("AbaDigitStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaDigitEnd"))):
    $titemsAbaDigitEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaDigitEnd"))):
        $titemsAbaDigitEnd  = getValue($oRStitems->Fields("AbaDigitEnd"));
    else:
        $titemsAbaDigitEnd  = htmlentities(getValue($oRStitems->Fields("AbaDigitEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaNumStart"))):
    $titemsAbaNumStart  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaNumStart"))):
        $titemsAbaNumStart  = getValue($oRStitems->Fields("AbaNumStart"));
    else:
        $titemsAbaNumStart  = htmlentities(getValue($oRStitems->Fields("AbaNumStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaNumEnd"))):
    $titemsAbaNumEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaNumEnd"))):
        $titemsAbaNumEnd  = getValue($oRStitems->Fields("AbaNumEnd"));
    else:
        $titemsAbaNumEnd  = htmlentities(getValue($oRStitems->Fields("AbaNumEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("AbaBookGrade"))):
    $titemsAbaBookGrade  = "";
else:
    if (is_numeric($oRStitems->Fields("AbaBookGrade"))):
        $titemsAbaBookGrade  = getValue($oRStitems->Fields("AbaBookGrade"));
    else:
        $titemsAbaBookGrade  = htmlentities(getValue($oRStitems->Fields("AbaBookGrade")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenNxtBook1"))):
    $titemsMenNxtBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("MenNxtBook1"))):
        $titemsMenNxtBook1  = getValue($oRStitems->Fields("MenNxtBook1"));
    else:
        $titemsMenNxtBook1  = htmlentities(getValue($oRStitems->Fields("MenNxtBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenNxtBook2"))):
    $titemsMenNxtBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("MenNxtBook2"))):
        $titemsMenNxtBook2  = getValue($oRStitems->Fields("MenNxtBook2"));
    else:
        $titemsMenNxtBook2  = htmlentities(getValue($oRStitems->Fields("MenNxtBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenNxtBook3"))):
    $titemsMenNxtBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("MenNxtBook3"))):
        $titemsMenNxtBook3  = getValue($oRStitems->Fields("MenNxtBook3"));
    else:
        $titemsMenNxtBook3  = htmlentities(getValue($oRStitems->Fields("MenNxtBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPrvBook1"))):
    $titemsMenPrvBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPrvBook1"))):
        $titemsMenPrvBook1  = getValue($oRStitems->Fields("MenPrvBook1"));
    else:
        $titemsMenPrvBook1  = htmlentities(getValue($oRStitems->Fields("MenPrvBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPrvBook2"))):
    $titemsMenPrvBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPrvBook2"))):
        $titemsMenPrvBook2  = getValue($oRStitems->Fields("MenPrvBook2"));
    else:
        $titemsMenPrvBook2  = htmlentities(getValue($oRStitems->Fields("MenPrvBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPrvBook3"))):
    $titemsMenPrvBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPrvBook3"))):
        $titemsMenPrvBook3  = getValue($oRStitems->Fields("MenPrvBook3"));
    else:
        $titemsMenPrvBook3  = htmlentities(getValue($oRStitems->Fields("MenPrvBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPreBook1"))):
    $titemsMenPreBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPreBook1"))):
        $titemsMenPreBook1  = getValue($oRStitems->Fields("MenPreBook1"));
    else:
        $titemsMenPreBook1  = htmlentities(getValue($oRStitems->Fields("MenPreBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPreBook2"))):
    $titemsMenPreBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPreBook2"))):
        $titemsMenPreBook2  = getValue($oRStitems->Fields("MenPreBook2"));
    else:
        $titemsMenPreBook2  = htmlentities(getValue($oRStitems->Fields("MenPreBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenPreBook3"))):
    $titemsMenPreBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("MenPreBook3"))):
        $titemsMenPreBook3  = getValue($oRStitems->Fields("MenPreBook3"));
    else:
        $titemsMenPreBook3  = htmlentities(getValue($oRStitems->Fields("MenPreBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenRptCnt1"))):
    $titemsMenRptCnt1  = "";
else:
    if (is_numeric($oRStitems->Fields("MenRptCnt1"))):
        $titemsMenRptCnt1  = getValue($oRStitems->Fields("MenRptCnt1"));
    else:
        $titemsMenRptCnt1  = htmlentities(getValue($oRStitems->Fields("MenRptCnt1")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenRptCnt2"))):
    $titemsMenRptCnt2  = "";
else:
    if (is_numeric($oRStitems->Fields("MenRptCnt2"))):
        $titemsMenRptCnt2  = getValue($oRStitems->Fields("MenRptCnt2"));
    else:
        $titemsMenRptCnt2  = htmlentities(getValue($oRStitems->Fields("MenRptCnt2")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenRptCnt3"))):
    $titemsMenRptCnt3  = "";
else:
    if (is_numeric($oRStitems->Fields("MenRptCnt3"))):
        $titemsMenRptCnt3  = getValue($oRStitems->Fields("MenRptCnt3"));
    else:
        $titemsMenRptCnt3  = htmlentities(getValue($oRStitems->Fields("MenRptCnt3")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenDigitStart"))):
    $titemsMenDigitStart  = "";
else:
    if (is_numeric($oRStitems->Fields("MenDigitStart"))):
        $titemsMenDigitStart  = getValue($oRStitems->Fields("MenDigitStart"));
    else:
        $titemsMenDigitStart  = htmlentities(getValue($oRStitems->Fields("MenDigitStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenDigitEnd"))):
    $titemsMenDigitEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("MenDigitEnd"))):
        $titemsMenDigitEnd  = getValue($oRStitems->Fields("MenDigitEnd"));
    else:
        $titemsMenDigitEnd  = htmlentities(getValue($oRStitems->Fields("MenDigitEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenNumStart"))):
    $titemsMenNumStart  = "";
else:
    if (is_numeric($oRStitems->Fields("MenNumStart"))):
        $titemsMenNumStart  = getValue($oRStitems->Fields("MenNumStart"));
    else:
        $titemsMenNumStart  = htmlentities(getValue($oRStitems->Fields("MenNumStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenNumEnd"))):
    $titemsMenNumEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("MenNumEnd"))):
        $titemsMenNumEnd  = getValue($oRStitems->Fields("MenNumEnd"));
    else:
        $titemsMenNumEnd  = htmlentities(getValue($oRStitems->Fields("MenNumEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("MenBookGrade"))):
    $titemsMenBookGrade  = "";
else:
    if (is_numeric($oRStitems->Fields("MenBookGrade"))):
        $titemsMenBookGrade  = getValue($oRStitems->Fields("MenBookGrade"));
    else:
        $titemsMenBookGrade  = htmlentities(getValue($oRStitems->Fields("MenBookGrade")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppNxtBook1"))):
    $titemsSuppNxtBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppNxtBook1"))):
        $titemsSuppNxtBook1  = getValue($oRStitems->Fields("SuppNxtBook1"));
    else:
        $titemsSuppNxtBook1  = htmlentities(getValue($oRStitems->Fields("SuppNxtBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppNxtBook2"))):
    $titemsSuppNxtBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppNxtBook2"))):
        $titemsSuppNxtBook2  = getValue($oRStitems->Fields("SuppNxtBook2"));
    else:
        $titemsSuppNxtBook2  = htmlentities(getValue($oRStitems->Fields("SuppNxtBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppNxtBook3"))):
    $titemsSuppNxtBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppNxtBook3"))):
        $titemsSuppNxtBook3  = getValue($oRStitems->Fields("SuppNxtBook3"));
    else:
        $titemsSuppNxtBook3  = htmlentities(getValue($oRStitems->Fields("SuppNxtBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPrvBook1"))):
    $titemsSuppPrvBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPrvBook1"))):
        $titemsSuppPrvBook1  = getValue($oRStitems->Fields("SuppPrvBook1"));
    else:
        $titemsSuppPrvBook1  = htmlentities(getValue($oRStitems->Fields("SuppPrvBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPrvBook2"))):
    $titemsSuppPrvBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPrvBook2"))):
        $titemsSuppPrvBook2  = getValue($oRStitems->Fields("SuppPrvBook2"));
    else:
        $titemsSuppPrvBook2  = htmlentities(getValue($oRStitems->Fields("SuppPrvBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPrvBook3"))):
    $titemsSuppPrvBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPrvBook3"))):
        $titemsSuppPrvBook3  = getValue($oRStitems->Fields("SuppPrvBook3"));
    else:
        $titemsSuppPrvBook3  = htmlentities(getValue($oRStitems->Fields("SuppPrvBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPreBook1"))):
    $titemsSuppPreBook1  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPreBook1"))):
        $titemsSuppPreBook1  = getValue($oRStitems->Fields("SuppPreBook1"));
    else:
        $titemsSuppPreBook1  = htmlentities(getValue($oRStitems->Fields("SuppPreBook1")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPreBook2"))):
    $titemsSuppPreBook2  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPreBook2"))):
        $titemsSuppPreBook2  = getValue($oRStitems->Fields("SuppPreBook2"));
    else:
        $titemsSuppPreBook2  = htmlentities(getValue($oRStitems->Fields("SuppPreBook2")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppPreBook3"))):
    $titemsSuppPreBook3  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppPreBook3"))):
        $titemsSuppPreBook3  = getValue($oRStitems->Fields("SuppPreBook3"));
    else:
        $titemsSuppPreBook3  = htmlentities(getValue($oRStitems->Fields("SuppPreBook3")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppRptCnt1"))):
    $titemsSuppRptCnt1  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppRptCnt1"))):
        $titemsSuppRptCnt1  = getValue($oRStitems->Fields("SuppRptCnt1"));
    else:
        $titemsSuppRptCnt1  = htmlentities(getValue($oRStitems->Fields("SuppRptCnt1")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppRptCnt2"))):
    $titemsSuppRptCnt2  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppRptCnt2"))):
        $titemsSuppRptCnt2  = getValue($oRStitems->Fields("SuppRptCnt2"));
    else:
        $titemsSuppRptCnt2  = htmlentities(getValue($oRStitems->Fields("SuppRptCnt2")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppRptCnt3"))):
    $titemsSuppRptCnt3  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppRptCnt3"))):
        $titemsSuppRptCnt3  = getValue($oRStitems->Fields("SuppRptCnt3"));
    else:
        $titemsSuppRptCnt3  = htmlentities(getValue($oRStitems->Fields("SuppRptCnt3")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppDigitStart"))):
    $titemsSuppDigitStart  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppDigitStart"))):
        $titemsSuppDigitStart  = getValue($oRStitems->Fields("SuppDigitStart"));
    else:
        $titemsSuppDigitStart  = htmlentities(getValue($oRStitems->Fields("SuppDigitStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppDigitEnd"))):
    $titemsSuppDigitEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppDigitEnd"))):
        $titemsSuppDigitEnd  = getValue($oRStitems->Fields("SuppDigitEnd"));
    else:
        $titemsSuppDigitEnd  = htmlentities(getValue($oRStitems->Fields("SuppDigitEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppNumStart"))):
    $titemsSuppNumStart  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppNumStart"))):
        $titemsSuppNumStart  = getValue($oRStitems->Fields("SuppNumStart"));
    else:
        $titemsSuppNumStart  = htmlentities(getValue($oRStitems->Fields("SuppNumStart")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppNumEnd"))):
    $titemsSuppNumEnd  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppNumEnd"))):
        $titemsSuppNumEnd  = getValue($oRStitems->Fields("SuppNumEnd"));
    else:
        $titemsSuppNumEnd  = htmlentities(getValue($oRStitems->Fields("SuppNumEnd")));
    endif;
endif;
if (is_null($oRStitems->Fields("SuppBookGrade"))):
    $titemsSuppBookGrade  = "";
else:
    if (is_numeric($oRStitems->Fields("SuppBookGrade"))):
        $titemsSuppBookGrade  = getValue($oRStitems->Fields("SuppBookGrade"));
    else:
        $titemsSuppBookGrade  = htmlentities(getValue($oRStitems->Fields("SuppBookGrade")));
    endif;
endif;
if (is_null($oRStitems->Fields("CatID"))):
    $titemsCatID  = "";
else:
    if (is_numeric($oRStitems->Fields("CatID"))):
        $titemsCatID  = getValue($oRStitems->Fields("CatID"));
    else:
        $titemsCatID  = htmlentities(getValue($oRStitems->Fields("CatID")));
    endif;
endif;
if (is_null($oRStitems->Fields("SubCatID"))):
    $titemsSubCatID  = "";
else:
    if (is_numeric($oRStitems->Fields("SubCatID"))):
        $titemsSubCatID  = getValue($oRStitems->Fields("SubCatID"));
    else:
        $titemsSubCatID  = htmlentities(getValue($oRStitems->Fields("SubCatID")));
    endif;
endif;
if (is_null($oRStitems->Fields("DeptID"))):
    $titemsDeptID  = "";
else:
    if (is_numeric($oRStitems->Fields("DeptID"))):
        $titemsDeptID  = getValue($oRStitems->Fields("DeptID"));
    else:
        $titemsDeptID  = htmlentities(getValue($oRStitems->Fields("DeptID")));
    endif;
endif;
if (is_null($oRStitems->Fields("ManufacturerID"))):
    $titemsManufacturerID  = "";
else:
    if (is_numeric($oRStitems->Fields("ManufacturerID"))):
        $titemsManufacturerID  = getValue($oRStitems->Fields("ManufacturerID"));
    else:
        $titemsManufacturerID  = htmlentities(getValue($oRStitems->Fields("ManufacturerID")));
    endif;
endif;
if (is_null($oRStitems->Fields("LocationID"))):
    $titemsLocationID  = "";
else:
    if (is_numeric($oRStitems->Fields("LocationID"))):
        $titemsLocationID  = getValue($oRStitems->Fields("LocationID"));
    else:
        $titemsLocationID  = htmlentities(getValue($oRStitems->Fields("LocationID")));
    endif;
endif;
if (is_null($oRStitems->Fields("IssuUntCost"))):
    $titemsIssuUntCost  = "";
else:
    if (is_numeric($oRStitems->Fields("IssuUntCost"))):
        $titemsIssuUntCost  = getValue($oRStitems->Fields("IssuUntCost"));
    else:
        $titemsIssuUntCost  = htmlentities(getValue($oRStitems->Fields("IssuUntCost")));
    endif;
endif;
if (is_null($oRStitems->Fields("IssuUntMea"))):
    $titemsIssuUntMea  = "";
else:
    if (is_numeric($oRStitems->Fields("IssuUntMea"))):
        $titemsIssuUntMea  = getValue($oRStitems->Fields("IssuUntMea"));
    else:
        $titemsIssuUntMea  = htmlentities(getValue($oRStitems->Fields("IssuUntMea")));
    endif;
endif;
if (is_null($oRStitems->Fields("PurUntCost"))):
    $titemsPurUntCost  = "";
else:
    if (is_numeric($oRStitems->Fields("PurUntCost"))):
        $titemsPurUntCost  = getValue($oRStitems->Fields("PurUntCost"));
    else:
        $titemsPurUntCost  = htmlentities(getValue($oRStitems->Fields("PurUntCost")));
    endif;
endif;
if (is_null($oRStitems->Fields("ReOrderPT"))):
    $titemsReOrderPT  = "";
else:
    if (is_numeric($oRStitems->Fields("ReOrderPT"))):
        $titemsReOrderPT  = getValue($oRStitems->Fields("ReOrderPT"));
    else:
        $titemsReOrderPT  = htmlentities(getValue($oRStitems->Fields("ReOrderPT")));
    endif;
endif;
if (is_null($oRStitems->Fields("ReOrderQty"))):
    $titemsReOrderQty  = "";
else:
    if (is_numeric($oRStitems->Fields("ReOrderQty"))):
        $titemsReOrderQty  = getValue($oRStitems->Fields("ReOrderQty"));
    else:
        $titemsReOrderQty  = htmlentities(getValue($oRStitems->Fields("ReOrderQty")));
    endif;
endif;
if (is_null($oRStitems->Fields("LastPurVdrID"))):
    $titemsLastPurVdrID  = "";
else:
    if (is_numeric($oRStitems->Fields("LastPurVdrID"))):
        $titemsLastPurVdrID  = getValue($oRStitems->Fields("LastPurVdrID"));
    else:
        $titemsLastPurVdrID  = htmlentities(getValue($oRStitems->Fields("LastPurVdrID")));
    endif;
endif;
if (is_null($oRStitems->Fields("ReOrderReq"))):
    $titemsReOrderReq  = "";
else:
    if (is_numeric($oRStitems->Fields("ReOrderReq"))):
        $titemsReOrderReq  = getValue($oRStitems->Fields("ReOrderReq"));
    else:
        $titemsReOrderReq  = htmlentities(getValue($oRStitems->Fields("ReOrderReq")));
    endif;
endif;
if (is_null($oRStitems->Fields("LstOrderCost"))):
    $titemsLstOrderCost  = "";
else:
    if (is_numeric($oRStitems->Fields("LstOrderCost"))):
        $titemsLstOrderCost  = getValue($oRStitems->Fields("LstOrderCost"));
    else:
        $titemsLstOrderCost  = htmlentities(getValue($oRStitems->Fields("LstOrderCost")));
    endif;
endif;
if (is_null($oRStitems->Fields("StdCost"))):
    $titemsStdCost  = "";
else:
    if (is_numeric($oRStitems->Fields("StdCost"))):
        $titemsStdCost  = getValue($oRStitems->Fields("StdCost"));
    else:
        $titemsStdCost  = htmlentities(getValue($oRStitems->Fields("StdCost")));
    endif;
endif;
if (is_null($oRStitems->Fields("QtyOnHand"))):
    $titemsQtyOnHand  = "";
else:
    if (is_numeric($oRStitems->Fields("QtyOnHand"))):
        $titemsQtyOnHand  = getValue($oRStitems->Fields("QtyOnHand"));
    else:
        $titemsQtyOnHand  = htmlentities(getValue($oRStitems->Fields("QtyOnHand")));
    endif;
endif;
if (is_null($oRStitems->Fields("QtyOnOrder"))):
    $titemsQtyOnOrder  = "";
else:
    if (is_numeric($oRStitems->Fields("QtyOnOrder"))):
        $titemsQtyOnOrder  = getValue($oRStitems->Fields("QtyOnOrder"));
    else:
        $titemsQtyOnOrder  = htmlentities(getValue($oRStitems->Fields("QtyOnOrder")));
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
$dbNavBarPrev = "<a href=Updatetitems" . "view.php?";
$dbNavBarNext = "<a href=Updatetitems" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStitems->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStitems->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStitems->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStitems->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStitems->Fields("ItemNo");
$dbNavBarNext  .= "&ID3=" . $oRStitems->Fields("ItemNo");
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
$oRStitems->Close();
MergeUpdatetitemsTemplate($HTML_Template);
unset($oRStitems);
    $objConn1->Close();
    unset($objConn1);
?>
