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
$UpdatetpaytypeFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetpaytype" . "edit.htm";
    endif;
    global $DeleteButton;   
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdatetpaytypeFormAction@",$UpdatetpaytypeFormAction);    

     $TemplateText = Replace($TemplateText, "@tpaytypeCountryID@", $tpaytypeCountryID);
     $TemplateText = Replace($TemplateText, "@tpaytypeBranchID@", $tpaytypeBranchID);
     $TemplateText = Replace($TemplateText, "@tpaytypePayType@", $tpaytypePayType);
     $TemplateText = Replace($TemplateText, "@tpaytypeDescription@", $tpaytypeDescription);
     $TemplateText = Replace($TemplateText, "@tpaytypeAmount@", $tpaytypeAmount);
     $TemplateText = Replace($TemplateText, "@tpaytypeCommAmt@", $tpaytypeCommAmt);
     $TemplateText = Replace($TemplateText, "@tpaytypeSalesTax@", $tpaytypeSalesTax);
     $TemplateText = Replace($TemplateText, "@tpaytypeAccount@", $tpaytypeAccount);
     $TemplateText = Replace($TemplateText, "@tpaytypeMTDQty@", $tpaytypeMTDQty);
     $TemplateText = Replace($TemplateText, "@tpaytypeMTDAmt@", $tpaytypeMTDAmt);
     $TemplateText = Replace($TemplateText, "@tpaytypeYTDQty@", $tpaytypeYTDQty);
     $TemplateText = Replace($TemplateText, "@tpaytypeYTDAmt@", $tpaytypeYTDAmt);
    if($tpaytypeType == "Cash"):
        $SELECTEDF50_13_1 = "SELECTED";
    else:
        $SELECTEDF50_13_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_1@", $SELECTEDF50_13_1);
    if($tpaytypeType == "Cheque"):
        $SELECTEDF50_13_2 = "SELECTED";
    else:
        $SELECTEDF50_13_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_2@", $SELECTEDF50_13_2);
    if($tpaytypeType == "Credit_Card"):
        $SELECTEDF50_13_3 = "SELECTED";
    else:
        $SELECTEDF50_13_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_3@", $SELECTEDF50_13_3);
    if($tpaytypeType == "Debit_Card"):
        $SELECTEDF50_13_4 = "SELECTED";
    else:
        $SELECTEDF50_13_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_4@", $SELECTEDF50_13_4);
    if($tpaytypeType == "Other"):
        $SELECTEDF50_13_5 = "SELECTED";
    else:
        $SELECTEDF50_13_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF50_13_5@", $SELECTEDF50_13_5);
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
$oRStpaytype = "";
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
        $Template = "./html/Updatetpaytype" . "edit.htm";
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

$sql = "SELECT tpaytype.CountryID, tpaytype.BranchID, tpaytype.PayType, tpaytype.Description, tpaytype.Amount, tpaytype.CommAmt, tpaytype.SalesTax, tpaytype.Account, tpaytype.MTDQty, tpaytype.MTDAmt, tpaytype.YTDQty, tpaytype.YTDAmt, tpaytype.Type  FROM  tpaytype WHERE  tpaytype.CountryID = '" . $ID1 . "'" . " AND tpaytype.BranchID = '" . $ID2 . "'" . " AND tpaytype.PayType = '" . $ID3 . "'";
$oRStpaytype = $objConn1->SelectLimit($sql,1);
if ($oRStpaytype->MoveFirst() == false):
    $oRStpaytype->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetpaytypeFormAction = "Updatetpaytypeeditx.php";
$oRStpaytypeCountryID = $oRStpaytype->fields["CountryID"];
$oRStpaytypeBranchID = $oRStpaytype->fields["BranchID"];
$oRStpaytypePayType = $oRStpaytype->fields["PayType"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tpaytypeCountryID = "";
if (is_null($oRStpaytype->fields["CountryID"])):
$tpaytypeCountryID = "";
else:
$tpaytypeCountryID = trim(getValue($oRStpaytype->fields["CountryID"]));
endif;
$tpaytypeBranchID = "";
if (is_null($oRStpaytype->fields["BranchID"])):
$tpaytypeBranchID = "";
else:
$tpaytypeBranchID = trim(getValue($oRStpaytype->fields["BranchID"]));
endif;
$tpaytypePayType = "";
if (is_null($oRStpaytype->fields["PayType"])):
$tpaytypePayType = "";
else:
$tpaytypePayType = trim(getValue($oRStpaytype->fields["PayType"]));
endif;
$tpaytypeDescription = "";
if (is_null($oRStpaytype->fields["Description"])):
$tpaytypeDescription = "";
else:
$tpaytypeDescription = trim(getValue($oRStpaytype->fields["Description"]));
endif;
$tpaytypeAmount = "";
if (is_null($oRStpaytype->fields["Amount"])):
$tpaytypeAmount = "";
else:
$tpaytypeAmount = getValue($oRStpaytype->fields["Amount"]);
endif;
$tpaytypeCommAmt = "";
if (is_null($oRStpaytype->fields["CommAmt"])):
$tpaytypeCommAmt = "";
else:
$tpaytypeCommAmt = getValue($oRStpaytype->fields["CommAmt"]);
endif;
$tpaytypeSalesTax = "";
if (is_null($oRStpaytype->fields["SalesTax"])):
$tpaytypeSalesTax = "";
else:
$tpaytypeSalesTax = getValue($oRStpaytype->fields["SalesTax"]);
endif;
$tpaytypeAccount = "";
if (is_null($oRStpaytype->fields["Account"])):
$tpaytypeAccount = "";
else:
$tpaytypeAccount = getValue($oRStpaytype->fields["Account"]);
endif;
$tpaytypeMTDQty = "";
if (is_null($oRStpaytype->fields["MTDQty"])):
$tpaytypeMTDQty = "";
else:
$tpaytypeMTDQty = getValue($oRStpaytype->fields["MTDQty"]);
endif;
$tpaytypeMTDAmt = "";
if (is_null($oRStpaytype->fields["MTDAmt"])):
$tpaytypeMTDAmt = "";
else:
$tpaytypeMTDAmt = getValue($oRStpaytype->fields["MTDAmt"]);
endif;
$tpaytypeYTDQty = "";
if (is_null($oRStpaytype->fields["YTDQty"])):
$tpaytypeYTDQty = "";
else:
$tpaytypeYTDQty = getValue($oRStpaytype->fields["YTDQty"]);
endif;
$tpaytypeYTDAmt = "";
if (is_null($oRStpaytype->fields["YTDAmt"])):
$tpaytypeYTDAmt = "";
else:
$tpaytypeYTDAmt = getValue($oRStpaytype->fields["YTDAmt"]);
endif;
$tpaytypeType = "";
if (is_null($oRStpaytype->fields["Type"])):
$tpaytypeType = "";
else:
$tpaytypeType = trim(getValue($oRStpaytype->fields["Type"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetpaytypedel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetpaytype_EditFailed"] == 1) {
  $tpaytypeCountryID = $_SESSION["SavedEdittpaytypeCountryID"];
  $tpaytypeBranchID = $_SESSION["SavedEdittpaytypeBranchID"];
  $tpaytypePayType = $_SESSION["SavedEdittpaytypePayType"];
  $tpaytypeDescription = $_SESSION["SavedEdittpaytypeDescription"];
  $tpaytypeAmount = $_SESSION["SavedEdittpaytypeAmount"];
  $tpaytypeCommAmt = $_SESSION["SavedEdittpaytypeCommAmt"];
  $tpaytypeSalesTax = $_SESSION["SavedEdittpaytypeSalesTax"];
  $tpaytypeAccount = $_SESSION["SavedEdittpaytypeAccount"];
  $tpaytypeMTDQty = $_SESSION["SavedEdittpaytypeMTDQty"];
  $tpaytypeMTDAmt = $_SESSION["SavedEdittpaytypeMTDAmt"];
  $tpaytypeYTDQty = $_SESSION["SavedEdittpaytypeYTDQty"];
  $tpaytypeYTDAmt = $_SESSION["SavedEdittpaytypeYTDAmt"];
  $tpaytypeType = $_SESSION["SavedEdittpaytypeType"];
}
else {
  $_SESSION["Updatetpaytype_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStpaytype);
$objConn1->Close();
unset($objConn1);
?>
