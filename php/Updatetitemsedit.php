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
$DeleteButton = "";
$UpdatetitemsFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetitems" . "edit.htm";
    endif;
    global $DeleteButton;   
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdatetitemsFormAction@",$UpdatetitemsFormAction);    

     $TemplateText = Replace($TemplateText, "@titemsCountryID@", $titemsCountryID);
     $TemplateText = Replace($TemplateText, "@titemsBranchID@", $titemsBranchID);
     $TemplateText = Replace($TemplateText, "@titemsItemNo@", $titemsItemNo);
     $TemplateText = Replace($TemplateText, "@titemsDescription@", $titemsDescription);
     $TemplateText = Replace($TemplateText, "@titemsIsBook@", $titemsIsBook);
     $TemplateText = Replace($TemplateText, "@titemsIsMultiCat@", $titemsIsMultiCat);
     $TemplateText = Replace($TemplateText, "@titemsIsAbacus@", $titemsIsAbacus);
     $TemplateText = Replace($TemplateText, "@titemsIsMental@", $titemsIsMental);
     $TemplateText = Replace($TemplateText, "@titemsIsSupp@", $titemsIsSupp);
     $TemplateText = Replace($TemplateText, "@titemsAbaDesc@", $titemsAbaDesc);
     $TemplateText = Replace($TemplateText, "@titemsMenDesc@", $titemsMenDesc);
     $TemplateText = Replace($TemplateText, "@titemsSuppDesc@", $titemsSuppDesc);
     $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook1@", $titemsAbaNxtBook1);
     $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook2@", $titemsAbaNxtBook2);
     $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook3@", $titemsAbaNxtBook3);
     $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook1@", $titemsAbaPrvBook1);
     $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook2@", $titemsAbaPrvBook2);
     $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook3@", $titemsAbaPrvBook3);
     $TemplateText = Replace($TemplateText, "@titemsAbaPreBook1@", $titemsAbaPreBook1);
     $TemplateText = Replace($TemplateText, "@titemsAbaPreBook2@", $titemsAbaPreBook2);
     $TemplateText = Replace($TemplateText, "@titemsAbaPreBook3@", $titemsAbaPreBook3);
     $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt1@", $titemsAbaRptCnt1);
     $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt2@", $titemsAbaRptCnt2);
     $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt3@", $titemsAbaRptCnt3);
     $TemplateText = Replace($TemplateText, "@titemsAbaDigitStart@", $titemsAbaDigitStart);
     $TemplateText = Replace($TemplateText, "@titemsAbaDigitEnd@", $titemsAbaDigitEnd);
     $TemplateText = Replace($TemplateText, "@titemsAbaNumStart@", $titemsAbaNumStart);
     $TemplateText = Replace($TemplateText, "@titemsAbaNumEnd@", $titemsAbaNumEnd);
     $TemplateText = Replace($TemplateText, "@titemsAbaBookGrade@", $titemsAbaBookGrade);
     $TemplateText = Replace($TemplateText, "@titemsMenNxtBook1@", $titemsMenNxtBook1);
     $TemplateText = Replace($TemplateText, "@titemsMenNxtBook2@", $titemsMenNxtBook2);
     $TemplateText = Replace($TemplateText, "@titemsMenNxtBook3@", $titemsMenNxtBook3);
     $TemplateText = Replace($TemplateText, "@titemsMenPrvBook1@", $titemsMenPrvBook1);
     $TemplateText = Replace($TemplateText, "@titemsMenPrvBook2@", $titemsMenPrvBook2);
     $TemplateText = Replace($TemplateText, "@titemsMenPrvBook3@", $titemsMenPrvBook3);
     $TemplateText = Replace($TemplateText, "@titemsMenPreBook1@", $titemsMenPreBook1);
     $TemplateText = Replace($TemplateText, "@titemsMenPreBook2@", $titemsMenPreBook2);
     $TemplateText = Replace($TemplateText, "@titemsMenPreBook3@", $titemsMenPreBook3);
     $TemplateText = Replace($TemplateText, "@titemsMenRptCnt1@", $titemsMenRptCnt1);
     $TemplateText = Replace($TemplateText, "@titemsMenRptCnt2@", $titemsMenRptCnt2);
     $TemplateText = Replace($TemplateText, "@titemsMenRptCnt3@", $titemsMenRptCnt3);
     $TemplateText = Replace($TemplateText, "@titemsMenDigitStart@", $titemsMenDigitStart);
     $TemplateText = Replace($TemplateText, "@titemsMenDigitEnd@", $titemsMenDigitEnd);
     $TemplateText = Replace($TemplateText, "@titemsMenNumStart@", $titemsMenNumStart);
     $TemplateText = Replace($TemplateText, "@titemsMenNumEnd@", $titemsMenNumEnd);
     $TemplateText = Replace($TemplateText, "@titemsMenBookGrade@", $titemsMenBookGrade);
     $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook1@", $titemsSuppNxtBook1);
     $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook2@", $titemsSuppNxtBook2);
     $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook3@", $titemsSuppNxtBook3);
     $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook1@", $titemsSuppPrvBook1);
     $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook2@", $titemsSuppPrvBook2);
     $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook3@", $titemsSuppPrvBook3);
     $TemplateText = Replace($TemplateText, "@titemsSuppPreBook1@", $titemsSuppPreBook1);
     $TemplateText = Replace($TemplateText, "@titemsSuppPreBook2@", $titemsSuppPreBook2);
     $TemplateText = Replace($TemplateText, "@titemsSuppPreBook3@", $titemsSuppPreBook3);
     $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt1@", $titemsSuppRptCnt1);
     $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt2@", $titemsSuppRptCnt2);
     $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt3@", $titemsSuppRptCnt3);
     $TemplateText = Replace($TemplateText, "@titemsSuppDigitStart@", $titemsSuppDigitStart);
     $TemplateText = Replace($TemplateText, "@titemsSuppDigitEnd@", $titemsSuppDigitEnd);
     $TemplateText = Replace($TemplateText, "@titemsSuppNumStart@", $titemsSuppNumStart);
     $TemplateText = Replace($TemplateText, "@titemsSuppNumEnd@", $titemsSuppNumEnd);
     $TemplateText = Replace($TemplateText, "@titemsSuppBookGrade@", $titemsSuppBookGrade);
     $TemplateText = Replace($TemplateText, "@titemsCatID@", $titemsCatID);
     $TemplateText = Replace($TemplateText, "@titemsSubCatID@", $titemsSubCatID);
     $TemplateText = Replace($TemplateText, "@titemsDeptID@", $titemsDeptID);
     $TemplateText = Replace($TemplateText, "@titemsManufacturerID@", $titemsManufacturerID);
     $TemplateText = Replace($TemplateText, "@titemsLocationID@", $titemsLocationID);
     $TemplateText = Replace($TemplateText, "@titemsIssuUntCost@", $titemsIssuUntCost);
     $TemplateText = Replace($TemplateText, "@titemsIssuUntMea@", $titemsIssuUntMea);
     $TemplateText = Replace($TemplateText, "@titemsPurUntCost@", $titemsPurUntCost);
     $TemplateText = Replace($TemplateText, "@titemsReOrderPT@", $titemsReOrderPT);
     $TemplateText = Replace($TemplateText, "@titemsReOrderQty@", $titemsReOrderQty);
     $TemplateText = Replace($TemplateText, "@titemsLastPurVdrID@", $titemsLastPurVdrID);
     $TemplateText = Replace($TemplateText, "@titemsReOrderReq@", $titemsReOrderReq);
     $TemplateText = Replace($TemplateText, "@titemsLstOrderCost@", $titemsLstOrderCost);
     $TemplateText = Replace($TemplateText, "@titemsStdCost@", $titemsStdCost);
     $TemplateText = Replace($TemplateText, "@titemsQtyOnHand@", $titemsQtyOnHand);
     $TemplateText = Replace($TemplateText, "@titemsQtyOnOrder@", $titemsQtyOnOrder);
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
$oRStitems = "";
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
    $ClarionData .= "<a href=BrowseAttendanceStatus" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetitems" . "edit.htm";
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

$sql = "SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp, titems.AbaDesc, titems.MenDesc, titems.SuppDesc, titems.AbaNxtBook1, titems.AbaNxtBook2, titems.AbaNxtBook3, titems.AbaPrvBook1, titems.AbaPrvBook2, titems.AbaPrvBook3, titems.AbaPreBook1, titems.AbaPreBook2, titems.AbaPreBook3, titems.AbaRptCnt1, titems.AbaRptCnt2, titems.AbaRptCnt3, titems.AbaDigitStart, titems.AbaDigitEnd, titems.AbaNumStart, titems.AbaNumEnd, titems.AbaBookGrade, titems.MenNxtBook1, titems.MenNxtBook2, titems.MenNxtBook3, titems.MenPrvBook1, titems.MenPrvBook2, titems.MenPrvBook3, titems.MenPreBook1, titems.MenPreBook2, titems.MenPreBook3, titems.MenRptCnt1, titems.MenRptCnt2, titems.MenRptCnt3, titems.MenDigitStart, titems.MenDigitEnd, titems.MenNumStart, titems.MenNumEnd, titems.MenBookGrade, titems.SuppNxtBook1, titems.SuppNxtBook2, titems.SuppNxtBook3, titems.SuppPrvBook1, titems.SuppPrvBook2, titems.SuppPrvBook3, titems.SuppPreBook1, titems.SuppPreBook2, titems.SuppPreBook3, titems.SuppRptCnt1, titems.SuppRptCnt2, titems.SuppRptCnt3, titems.SuppDigitStart, titems.SuppDigitEnd, titems.SuppNumStart, titems.SuppNumEnd, titems.SuppBookGrade, titems.CatID, titems.SubCatID, titems.DeptID, titems.ManufacturerID, titems.LocationID, titems.IssuUntCost, titems.IssuUntMea, titems.PurUntCost, titems.ReOrderPT, titems.ReOrderQty, titems.LastPurVdrID, titems.ReOrderReq, titems.LstOrderCost, titems.StdCost, titems.QtyOnHand, titems.QtyOnOrder  FROM  titems WHERE  titems.CountryID = '" . $ID1 . "'" . " AND titems.BranchID = '" . $ID2 . "'" . " AND titems.ItemNo = '" . $ID3 . "'";
$oRStitems = $objConn1->SelectLimit($sql,1);
if ($oRStitems->MoveFirst() == false):
    $oRStitems->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetitemsFormAction = "Updatetitemseditx.php";
$oRStitemsCountryID = $oRStitems->fields["CountryID"];
$oRStitemsBranchID = $oRStitems->fields["BranchID"];
$oRStitemsItemNo = $oRStitems->fields["ItemNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$titemsCountryID = "";
if (is_null($oRStitems->fields["CountryID"])):
$titemsCountryID = "";
else:
$titemsCountryID = trim(getValue($oRStitems->fields["CountryID"]));
endif;
$titemsBranchID = "";
if (is_null($oRStitems->fields["BranchID"])):
$titemsBranchID = "";
else:
$titemsBranchID = trim(getValue($oRStitems->fields["BranchID"]));
endif;
$titemsItemNo = "";
if (is_null($oRStitems->fields["ItemNo"])):
$titemsItemNo = "";
else:
$titemsItemNo = trim(getValue($oRStitems->fields["ItemNo"]));
endif;
$titemsDescription = "";
if (is_null($oRStitems->fields["Description"])):
$titemsDescription = "";
else:
$titemsDescription = trim(getValue($oRStitems->fields["Description"]));
endif;
$titemsIsBook = "";
if (is_null($oRStitems->fields["IsBook"])):
$titemsIsBook = "";
else:
$titemsIsBook = trim(getValue($oRStitems->fields["IsBook"]));
endif;
$titemsIsMultiCat = "";
if (is_null($oRStitems->fields["IsMultiCat"])):
$titemsIsMultiCat = "";
else:
$titemsIsMultiCat = trim(getValue($oRStitems->fields["IsMultiCat"]));
endif;
$titemsIsAbacus = "";
if (is_null($oRStitems->fields["IsAbacus"])):
$titemsIsAbacus = "";
else:
$titemsIsAbacus = trim(getValue($oRStitems->fields["IsAbacus"]));
endif;
$titemsIsMental = "";
if (is_null($oRStitems->fields["IsMental"])):
$titemsIsMental = "";
else:
$titemsIsMental = trim(getValue($oRStitems->fields["IsMental"]));
endif;
$titemsIsSupp = "";
if (is_null($oRStitems->fields["IsSupp"])):
$titemsIsSupp = "";
else:
$titemsIsSupp = trim(getValue($oRStitems->fields["IsSupp"]));
endif;
$titemsAbaDesc = "";
if (is_null($oRStitems->fields["AbaDesc"])):
$titemsAbaDesc = "";
else:
$titemsAbaDesc = trim(getValue($oRStitems->fields["AbaDesc"]));
endif;
$titemsMenDesc = "";
if (is_null($oRStitems->fields["MenDesc"])):
$titemsMenDesc = "";
else:
$titemsMenDesc = trim(getValue($oRStitems->fields["MenDesc"]));
endif;
$titemsSuppDesc = "";
if (is_null($oRStitems->fields["SuppDesc"])):
$titemsSuppDesc = "";
else:
$titemsSuppDesc = trim(getValue($oRStitems->fields["SuppDesc"]));
endif;
$titemsAbaNxtBook1 = "";
if (is_null($oRStitems->fields["AbaNxtBook1"])):
$titemsAbaNxtBook1 = "";
else:
$titemsAbaNxtBook1 = trim(getValue($oRStitems->fields["AbaNxtBook1"]));
endif;
$titemsAbaNxtBook2 = "";
if (is_null($oRStitems->fields["AbaNxtBook2"])):
$titemsAbaNxtBook2 = "";
else:
$titemsAbaNxtBook2 = trim(getValue($oRStitems->fields["AbaNxtBook2"]));
endif;
$titemsAbaNxtBook3 = "";
if (is_null($oRStitems->fields["AbaNxtBook3"])):
$titemsAbaNxtBook3 = "";
else:
$titemsAbaNxtBook3 = trim(getValue($oRStitems->fields["AbaNxtBook3"]));
endif;
$titemsAbaPrvBook1 = "";
if (is_null($oRStitems->fields["AbaPrvBook1"])):
$titemsAbaPrvBook1 = "";
else:
$titemsAbaPrvBook1 = trim(getValue($oRStitems->fields["AbaPrvBook1"]));
endif;
$titemsAbaPrvBook2 = "";
if (is_null($oRStitems->fields["AbaPrvBook2"])):
$titemsAbaPrvBook2 = "";
else:
$titemsAbaPrvBook2 = trim(getValue($oRStitems->fields["AbaPrvBook2"]));
endif;
$titemsAbaPrvBook3 = "";
if (is_null($oRStitems->fields["AbaPrvBook3"])):
$titemsAbaPrvBook3 = "";
else:
$titemsAbaPrvBook3 = trim(getValue($oRStitems->fields["AbaPrvBook3"]));
endif;
$titemsAbaPreBook1 = "";
if (is_null($oRStitems->fields["AbaPreBook1"])):
$titemsAbaPreBook1 = "";
else:
$titemsAbaPreBook1 = trim(getValue($oRStitems->fields["AbaPreBook1"]));
endif;
$titemsAbaPreBook2 = "";
if (is_null($oRStitems->fields["AbaPreBook2"])):
$titemsAbaPreBook2 = "";
else:
$titemsAbaPreBook2 = trim(getValue($oRStitems->fields["AbaPreBook2"]));
endif;
$titemsAbaPreBook3 = "";
if (is_null($oRStitems->fields["AbaPreBook3"])):
$titemsAbaPreBook3 = "";
else:
$titemsAbaPreBook3 = trim(getValue($oRStitems->fields["AbaPreBook3"]));
endif;
$titemsAbaRptCnt1 = "";
if (is_null($oRStitems->fields["AbaRptCnt1"])):
$titemsAbaRptCnt1 = "";
else:
$titemsAbaRptCnt1 = getValue($oRStitems->fields["AbaRptCnt1"]);
endif;
$titemsAbaRptCnt2 = "";
if (is_null($oRStitems->fields["AbaRptCnt2"])):
$titemsAbaRptCnt2 = "";
else:
$titemsAbaRptCnt2 = getValue($oRStitems->fields["AbaRptCnt2"]);
endif;
$titemsAbaRptCnt3 = "";
if (is_null($oRStitems->fields["AbaRptCnt3"])):
$titemsAbaRptCnt3 = "";
else:
$titemsAbaRptCnt3 = getValue($oRStitems->fields["AbaRptCnt3"]);
endif;
$titemsAbaDigitStart = "";
if (is_null($oRStitems->fields["AbaDigitStart"])):
$titemsAbaDigitStart = "";
else:
$titemsAbaDigitStart = getValue($oRStitems->fields["AbaDigitStart"]);
endif;
$titemsAbaDigitEnd = "";
if (is_null($oRStitems->fields["AbaDigitEnd"])):
$titemsAbaDigitEnd = "";
else:
$titemsAbaDigitEnd = getValue($oRStitems->fields["AbaDigitEnd"]);
endif;
$titemsAbaNumStart = "";
if (is_null($oRStitems->fields["AbaNumStart"])):
$titemsAbaNumStart = "";
else:
$titemsAbaNumStart = getValue($oRStitems->fields["AbaNumStart"]);
endif;
$titemsAbaNumEnd = "";
if (is_null($oRStitems->fields["AbaNumEnd"])):
$titemsAbaNumEnd = "";
else:
$titemsAbaNumEnd = getValue($oRStitems->fields["AbaNumEnd"]);
endif;
$titemsAbaBookGrade = "";
if (is_null($oRStitems->fields["AbaBookGrade"])):
$titemsAbaBookGrade = "";
else:
$titemsAbaBookGrade = getValue($oRStitems->fields["AbaBookGrade"]);
endif;
$titemsMenNxtBook1 = "";
if (is_null($oRStitems->fields["MenNxtBook1"])):
$titemsMenNxtBook1 = "";
else:
$titemsMenNxtBook1 = trim(getValue($oRStitems->fields["MenNxtBook1"]));
endif;
$titemsMenNxtBook2 = "";
if (is_null($oRStitems->fields["MenNxtBook2"])):
$titemsMenNxtBook2 = "";
else:
$titemsMenNxtBook2 = trim(getValue($oRStitems->fields["MenNxtBook2"]));
endif;
$titemsMenNxtBook3 = "";
if (is_null($oRStitems->fields["MenNxtBook3"])):
$titemsMenNxtBook3 = "";
else:
$titemsMenNxtBook3 = trim(getValue($oRStitems->fields["MenNxtBook3"]));
endif;
$titemsMenPrvBook1 = "";
if (is_null($oRStitems->fields["MenPrvBook1"])):
$titemsMenPrvBook1 = "";
else:
$titemsMenPrvBook1 = trim(getValue($oRStitems->fields["MenPrvBook1"]));
endif;
$titemsMenPrvBook2 = "";
if (is_null($oRStitems->fields["MenPrvBook2"])):
$titemsMenPrvBook2 = "";
else:
$titemsMenPrvBook2 = trim(getValue($oRStitems->fields["MenPrvBook2"]));
endif;
$titemsMenPrvBook3 = "";
if (is_null($oRStitems->fields["MenPrvBook3"])):
$titemsMenPrvBook3 = "";
else:
$titemsMenPrvBook3 = trim(getValue($oRStitems->fields["MenPrvBook3"]));
endif;
$titemsMenPreBook1 = "";
if (is_null($oRStitems->fields["MenPreBook1"])):
$titemsMenPreBook1 = "";
else:
$titemsMenPreBook1 = trim(getValue($oRStitems->fields["MenPreBook1"]));
endif;
$titemsMenPreBook2 = "";
if (is_null($oRStitems->fields["MenPreBook2"])):
$titemsMenPreBook2 = "";
else:
$titemsMenPreBook2 = trim(getValue($oRStitems->fields["MenPreBook2"]));
endif;
$titemsMenPreBook3 = "";
if (is_null($oRStitems->fields["MenPreBook3"])):
$titemsMenPreBook3 = "";
else:
$titemsMenPreBook3 = trim(getValue($oRStitems->fields["MenPreBook3"]));
endif;
$titemsMenRptCnt1 = "";
if (is_null($oRStitems->fields["MenRptCnt1"])):
$titemsMenRptCnt1 = "";
else:
$titemsMenRptCnt1 = getValue($oRStitems->fields["MenRptCnt1"]);
endif;
$titemsMenRptCnt2 = "";
if (is_null($oRStitems->fields["MenRptCnt2"])):
$titemsMenRptCnt2 = "";
else:
$titemsMenRptCnt2 = getValue($oRStitems->fields["MenRptCnt2"]);
endif;
$titemsMenRptCnt3 = "";
if (is_null($oRStitems->fields["MenRptCnt3"])):
$titemsMenRptCnt3 = "";
else:
$titemsMenRptCnt3 = getValue($oRStitems->fields["MenRptCnt3"]);
endif;
$titemsMenDigitStart = "";
if (is_null($oRStitems->fields["MenDigitStart"])):
$titemsMenDigitStart = "";
else:
$titemsMenDigitStart = getValue($oRStitems->fields["MenDigitStart"]);
endif;
$titemsMenDigitEnd = "";
if (is_null($oRStitems->fields["MenDigitEnd"])):
$titemsMenDigitEnd = "";
else:
$titemsMenDigitEnd = getValue($oRStitems->fields["MenDigitEnd"]);
endif;
$titemsMenNumStart = "";
if (is_null($oRStitems->fields["MenNumStart"])):
$titemsMenNumStart = "";
else:
$titemsMenNumStart = getValue($oRStitems->fields["MenNumStart"]);
endif;
$titemsMenNumEnd = "";
if (is_null($oRStitems->fields["MenNumEnd"])):
$titemsMenNumEnd = "";
else:
$titemsMenNumEnd = getValue($oRStitems->fields["MenNumEnd"]);
endif;
$titemsMenBookGrade = "";
if (is_null($oRStitems->fields["MenBookGrade"])):
$titemsMenBookGrade = "";
else:
$titemsMenBookGrade = getValue($oRStitems->fields["MenBookGrade"]);
endif;
$titemsSuppNxtBook1 = "";
if (is_null($oRStitems->fields["SuppNxtBook1"])):
$titemsSuppNxtBook1 = "";
else:
$titemsSuppNxtBook1 = trim(getValue($oRStitems->fields["SuppNxtBook1"]));
endif;
$titemsSuppNxtBook2 = "";
if (is_null($oRStitems->fields["SuppNxtBook2"])):
$titemsSuppNxtBook2 = "";
else:
$titemsSuppNxtBook2 = trim(getValue($oRStitems->fields["SuppNxtBook2"]));
endif;
$titemsSuppNxtBook3 = "";
if (is_null($oRStitems->fields["SuppNxtBook3"])):
$titemsSuppNxtBook3 = "";
else:
$titemsSuppNxtBook3 = trim(getValue($oRStitems->fields["SuppNxtBook3"]));
endif;
$titemsSuppPrvBook1 = "";
if (is_null($oRStitems->fields["SuppPrvBook1"])):
$titemsSuppPrvBook1 = "";
else:
$titemsSuppPrvBook1 = trim(getValue($oRStitems->fields["SuppPrvBook1"]));
endif;
$titemsSuppPrvBook2 = "";
if (is_null($oRStitems->fields["SuppPrvBook2"])):
$titemsSuppPrvBook2 = "";
else:
$titemsSuppPrvBook2 = trim(getValue($oRStitems->fields["SuppPrvBook2"]));
endif;
$titemsSuppPrvBook3 = "";
if (is_null($oRStitems->fields["SuppPrvBook3"])):
$titemsSuppPrvBook3 = "";
else:
$titemsSuppPrvBook3 = trim(getValue($oRStitems->fields["SuppPrvBook3"]));
endif;
$titemsSuppPreBook1 = "";
if (is_null($oRStitems->fields["SuppPreBook1"])):
$titemsSuppPreBook1 = "";
else:
$titemsSuppPreBook1 = trim(getValue($oRStitems->fields["SuppPreBook1"]));
endif;
$titemsSuppPreBook2 = "";
if (is_null($oRStitems->fields["SuppPreBook2"])):
$titemsSuppPreBook2 = "";
else:
$titemsSuppPreBook2 = trim(getValue($oRStitems->fields["SuppPreBook2"]));
endif;
$titemsSuppPreBook3 = "";
if (is_null($oRStitems->fields["SuppPreBook3"])):
$titemsSuppPreBook3 = "";
else:
$titemsSuppPreBook3 = trim(getValue($oRStitems->fields["SuppPreBook3"]));
endif;
$titemsSuppRptCnt1 = "";
if (is_null($oRStitems->fields["SuppRptCnt1"])):
$titemsSuppRptCnt1 = "";
else:
$titemsSuppRptCnt1 = getValue($oRStitems->fields["SuppRptCnt1"]);
endif;
$titemsSuppRptCnt2 = "";
if (is_null($oRStitems->fields["SuppRptCnt2"])):
$titemsSuppRptCnt2 = "";
else:
$titemsSuppRptCnt2 = getValue($oRStitems->fields["SuppRptCnt2"]);
endif;
$titemsSuppRptCnt3 = "";
if (is_null($oRStitems->fields["SuppRptCnt3"])):
$titemsSuppRptCnt3 = "";
else:
$titemsSuppRptCnt3 = getValue($oRStitems->fields["SuppRptCnt3"]);
endif;
$titemsSuppDigitStart = "";
if (is_null($oRStitems->fields["SuppDigitStart"])):
$titemsSuppDigitStart = "";
else:
$titemsSuppDigitStart = getValue($oRStitems->fields["SuppDigitStart"]);
endif;
$titemsSuppDigitEnd = "";
if (is_null($oRStitems->fields["SuppDigitEnd"])):
$titemsSuppDigitEnd = "";
else:
$titemsSuppDigitEnd = getValue($oRStitems->fields["SuppDigitEnd"]);
endif;
$titemsSuppNumStart = "";
if (is_null($oRStitems->fields["SuppNumStart"])):
$titemsSuppNumStart = "";
else:
$titemsSuppNumStart = getValue($oRStitems->fields["SuppNumStart"]);
endif;
$titemsSuppNumEnd = "";
if (is_null($oRStitems->fields["SuppNumEnd"])):
$titemsSuppNumEnd = "";
else:
$titemsSuppNumEnd = getValue($oRStitems->fields["SuppNumEnd"]);
endif;
$titemsSuppBookGrade = "";
if (is_null($oRStitems->fields["SuppBookGrade"])):
$titemsSuppBookGrade = "";
else:
$titemsSuppBookGrade = getValue($oRStitems->fields["SuppBookGrade"]);
endif;
$titemsCatID = "";
if (is_null($oRStitems->fields["CatID"])):
$titemsCatID = "";
else:
$titemsCatID = trim(getValue($oRStitems->fields["CatID"]));
endif;
$titemsSubCatID = "";
if (is_null($oRStitems->fields["SubCatID"])):
$titemsSubCatID = "";
else:
$titemsSubCatID = trim(getValue($oRStitems->fields["SubCatID"]));
endif;
$titemsDeptID = "";
if (is_null($oRStitems->fields["DeptID"])):
$titemsDeptID = "";
else:
$titemsDeptID = getValue($oRStitems->fields["DeptID"]);
endif;
$titemsManufacturerID = "";
if (is_null($oRStitems->fields["ManufacturerID"])):
$titemsManufacturerID = "";
else:
$titemsManufacturerID = getValue($oRStitems->fields["ManufacturerID"]);
endif;
$titemsLocationID = "";
if (is_null($oRStitems->fields["LocationID"])):
$titemsLocationID = "";
else:
$titemsLocationID = getValue($oRStitems->fields["LocationID"]);
endif;
$titemsIssuUntCost = "";
if (is_null($oRStitems->fields["IssuUntCost"])):
$titemsIssuUntCost = "";
else:
$titemsIssuUntCost = getValue($oRStitems->fields["IssuUntCost"]);
endif;
$titemsIssuUntMea = "";
if (is_null($oRStitems->fields["IssuUntMea"])):
$titemsIssuUntMea = "";
else:
$titemsIssuUntMea = trim(getValue($oRStitems->fields["IssuUntMea"]));
endif;
$titemsPurUntCost = "";
if (is_null($oRStitems->fields["PurUntCost"])):
$titemsPurUntCost = "";
else:
$titemsPurUntCost = getValue($oRStitems->fields["PurUntCost"]);
endif;
$titemsReOrderPT = "";
if (is_null($oRStitems->fields["ReOrderPT"])):
$titemsReOrderPT = "";
else:
$titemsReOrderPT = getValue($oRStitems->fields["ReOrderPT"]);
endif;
$titemsReOrderQty = "";
if (is_null($oRStitems->fields["ReOrderQty"])):
$titemsReOrderQty = "";
else:
$titemsReOrderQty = getValue($oRStitems->fields["ReOrderQty"]);
endif;
$titemsLastPurVdrID = "";
if (is_null($oRStitems->fields["LastPurVdrID"])):
$titemsLastPurVdrID = "";
else:
$titemsLastPurVdrID = getValue($oRStitems->fields["LastPurVdrID"]);
endif;
$titemsReOrderReq = "";
if (is_null($oRStitems->fields["ReOrderReq"])):
$titemsReOrderReq = "";
else:
$titemsReOrderReq = trim(getValue($oRStitems->fields["ReOrderReq"]));
endif;
$titemsLstOrderCost = "";
if (is_null($oRStitems->fields["LstOrderCost"])):
$titemsLstOrderCost = "";
else:
$titemsLstOrderCost = getValue($oRStitems->fields["LstOrderCost"]);
endif;
$titemsStdCost = "";
if (is_null($oRStitems->fields["StdCost"])):
$titemsStdCost = "";
else:
$titemsStdCost = getValue($oRStitems->fields["StdCost"]);
endif;
$titemsQtyOnHand = "";
if (is_null($oRStitems->fields["QtyOnHand"])):
$titemsQtyOnHand = "";
else:
$titemsQtyOnHand = getValue($oRStitems->fields["QtyOnHand"]);
endif;
$titemsQtyOnOrder = "";
if (is_null($oRStitems->fields["QtyOnOrder"])):
$titemsQtyOnOrder = "";
else:
$titemsQtyOnOrder = getValue($oRStitems->fields["QtyOnOrder"]);
endif;
$DeleteButton = "<form method='post' action='Updatetitemsdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatetitems_EditFailed"] == 1) {
  $titemsCountryID = $_SESSION["SavedEdittitemsCountryID"];
  $titemsBranchID = $_SESSION["SavedEdittitemsBranchID"];
  $titemsItemNo = $_SESSION["SavedEdittitemsItemNo"];
  $titemsDescription = $_SESSION["SavedEdittitemsDescription"];
  $titemsIsBook = $_SESSION["SavedEdittitemsIsBook"];
  $titemsIsMultiCat = $_SESSION["SavedEdittitemsIsMultiCat"];
  $titemsIsAbacus = $_SESSION["SavedEdittitemsIsAbacus"];
  $titemsIsMental = $_SESSION["SavedEdittitemsIsMental"];
  $titemsIsSupp = $_SESSION["SavedEdittitemsIsSupp"];
  $titemsAbaDesc = $_SESSION["SavedEdittitemsAbaDesc"];
  $titemsMenDesc = $_SESSION["SavedEdittitemsMenDesc"];
  $titemsSuppDesc = $_SESSION["SavedEdittitemsSuppDesc"];
  $titemsAbaNxtBook1 = $_SESSION["SavedEdittitemsAbaNxtBook1"];
  $titemsAbaNxtBook2 = $_SESSION["SavedEdittitemsAbaNxtBook2"];
  $titemsAbaNxtBook3 = $_SESSION["SavedEdittitemsAbaNxtBook3"];
  $titemsAbaPrvBook1 = $_SESSION["SavedEdittitemsAbaPrvBook1"];
  $titemsAbaPrvBook2 = $_SESSION["SavedEdittitemsAbaPrvBook2"];
  $titemsAbaPrvBook3 = $_SESSION["SavedEdittitemsAbaPrvBook3"];
  $titemsAbaPreBook1 = $_SESSION["SavedEdittitemsAbaPreBook1"];
  $titemsAbaPreBook2 = $_SESSION["SavedEdittitemsAbaPreBook2"];
  $titemsAbaPreBook3 = $_SESSION["SavedEdittitemsAbaPreBook3"];
  $titemsAbaRptCnt1 = $_SESSION["SavedEdittitemsAbaRptCnt1"];
  $titemsAbaRptCnt2 = $_SESSION["SavedEdittitemsAbaRptCnt2"];
  $titemsAbaRptCnt3 = $_SESSION["SavedEdittitemsAbaRptCnt3"];
  $titemsAbaDigitStart = $_SESSION["SavedEdittitemsAbaDigitStart"];
  $titemsAbaDigitEnd = $_SESSION["SavedEdittitemsAbaDigitEnd"];
  $titemsAbaNumStart = $_SESSION["SavedEdittitemsAbaNumStart"];
  $titemsAbaNumEnd = $_SESSION["SavedEdittitemsAbaNumEnd"];
  $titemsAbaBookGrade = $_SESSION["SavedEdittitemsAbaBookGrade"];
  $titemsMenNxtBook1 = $_SESSION["SavedEdittitemsMenNxtBook1"];
  $titemsMenNxtBook2 = $_SESSION["SavedEdittitemsMenNxtBook2"];
  $titemsMenNxtBook3 = $_SESSION["SavedEdittitemsMenNxtBook3"];
  $titemsMenPrvBook1 = $_SESSION["SavedEdittitemsMenPrvBook1"];
  $titemsMenPrvBook2 = $_SESSION["SavedEdittitemsMenPrvBook2"];
  $titemsMenPrvBook3 = $_SESSION["SavedEdittitemsMenPrvBook3"];
  $titemsMenPreBook1 = $_SESSION["SavedEdittitemsMenPreBook1"];
  $titemsMenPreBook2 = $_SESSION["SavedEdittitemsMenPreBook2"];
  $titemsMenPreBook3 = $_SESSION["SavedEdittitemsMenPreBook3"];
  $titemsMenRptCnt1 = $_SESSION["SavedEdittitemsMenRptCnt1"];
  $titemsMenRptCnt2 = $_SESSION["SavedEdittitemsMenRptCnt2"];
  $titemsMenRptCnt3 = $_SESSION["SavedEdittitemsMenRptCnt3"];
  $titemsMenDigitStart = $_SESSION["SavedEdittitemsMenDigitStart"];
  $titemsMenDigitEnd = $_SESSION["SavedEdittitemsMenDigitEnd"];
  $titemsMenNumStart = $_SESSION["SavedEdittitemsMenNumStart"];
  $titemsMenNumEnd = $_SESSION["SavedEdittitemsMenNumEnd"];
  $titemsMenBookGrade = $_SESSION["SavedEdittitemsMenBookGrade"];
  $titemsSuppNxtBook1 = $_SESSION["SavedEdittitemsSuppNxtBook1"];
  $titemsSuppNxtBook2 = $_SESSION["SavedEdittitemsSuppNxtBook2"];
  $titemsSuppNxtBook3 = $_SESSION["SavedEdittitemsSuppNxtBook3"];
  $titemsSuppPrvBook1 = $_SESSION["SavedEdittitemsSuppPrvBook1"];
  $titemsSuppPrvBook2 = $_SESSION["SavedEdittitemsSuppPrvBook2"];
  $titemsSuppPrvBook3 = $_SESSION["SavedEdittitemsSuppPrvBook3"];
  $titemsSuppPreBook1 = $_SESSION["SavedEdittitemsSuppPreBook1"];
  $titemsSuppPreBook2 = $_SESSION["SavedEdittitemsSuppPreBook2"];
  $titemsSuppPreBook3 = $_SESSION["SavedEdittitemsSuppPreBook3"];
  $titemsSuppRptCnt1 = $_SESSION["SavedEdittitemsSuppRptCnt1"];
  $titemsSuppRptCnt2 = $_SESSION["SavedEdittitemsSuppRptCnt2"];
  $titemsSuppRptCnt3 = $_SESSION["SavedEdittitemsSuppRptCnt3"];
  $titemsSuppDigitStart = $_SESSION["SavedEdittitemsSuppDigitStart"];
  $titemsSuppDigitEnd = $_SESSION["SavedEdittitemsSuppDigitEnd"];
  $titemsSuppNumStart = $_SESSION["SavedEdittitemsSuppNumStart"];
  $titemsSuppNumEnd = $_SESSION["SavedEdittitemsSuppNumEnd"];
  $titemsSuppBookGrade = $_SESSION["SavedEdittitemsSuppBookGrade"];
  $titemsCatID = $_SESSION["SavedEdittitemsCatID"];
  $titemsSubCatID = $_SESSION["SavedEdittitemsSubCatID"];
  $titemsDeptID = $_SESSION["SavedEdittitemsDeptID"];
  $titemsManufacturerID = $_SESSION["SavedEdittitemsManufacturerID"];
  $titemsLocationID = $_SESSION["SavedEdittitemsLocationID"];
  $titemsIssuUntCost = $_SESSION["SavedEdittitemsIssuUntCost"];
  $titemsIssuUntMea = $_SESSION["SavedEdittitemsIssuUntMea"];
  $titemsPurUntCost = $_SESSION["SavedEdittitemsPurUntCost"];
  $titemsReOrderPT = $_SESSION["SavedEdittitemsReOrderPT"];
  $titemsReOrderQty = $_SESSION["SavedEdittitemsReOrderQty"];
  $titemsLastPurVdrID = $_SESSION["SavedEdittitemsLastPurVdrID"];
  $titemsReOrderReq = $_SESSION["SavedEdittitemsReOrderReq"];
  $titemsLstOrderCost = $_SESSION["SavedEdittitemsLstOrderCost"];
  $titemsStdCost = $_SESSION["SavedEdittitemsStdCost"];
  $titemsQtyOnHand = $_SESSION["SavedEdittitemsQtyOnHand"];
  $titemsQtyOnOrder = $_SESSION["SavedEdittitemsQtyOnOrder"];
}
else {
  $_SESSION["Updatetitems_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStitems);
$objConn1->Close();
unset($objConn1);
?>
