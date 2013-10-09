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
$sql = "SELECT tpaytype.CountryID, tpaytype.BranchID, tpaytype.PayType, tpaytype.Description, tpaytype.Amount, tpaytype.CommAmt, tpaytype.SalesTax, tpaytype.Account, tpaytype.MTDQty, tpaytype.MTDAmt, tpaytype.YTDQty, tpaytype.YTDAmt, tpaytype.Type  FROM  tpaytype WHERE  tpaytype.CountryID = '" . $ID1 . "'" . " AND tpaytype.BranchID = '" . $ID2 . "'" . " AND tpaytype.PayType = '" . $ID3 . "'";
$oRStpaytype = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStpaytype = array();
if (!$oRStpaytype):
    $oRStpaytype->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttpaytypeCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStpaytype["CountryID"] = getFormSQLQuoted($objConn1, "tpaytype", "CountryID", "txttpaytypeCountryID");
        if (getRequest("txttpaytypeBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStpaytype["BranchID"] = getFormSQLQuoted($objConn1, "tpaytype", "BranchID", "txttpaytypeBranchID");
        if (getRequest("txttpaytypePayType") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Pay Type:</strong> : Required field <hr>\n";
        endif;
$arrayoRStpaytype["PayType"] = getFormSQLQuoted($objConn1, "tpaytype", "PayType", "txttpaytypePayType");
        if (getRequest("txttpaytypeDescription") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Description:</strong> : Required field <hr>\n";
        endif;
$arrayoRStpaytype["Description"] = getFormSQLQuoted($objConn1, "tpaytype", "Description", "txttpaytypeDescription");
$arrayoRStpaytype["Amount"] = getFormSQLQuoted($objConn1, "tpaytype", "Amount", "txttpaytypeAmount");
$arrayoRStpaytype["CommAmt"] = getFormSQLQuoted($objConn1, "tpaytype", "CommAmt", "txttpaytypeCommAmt");
$arrayoRStpaytype["SalesTax"] = getFormSQLQuoted($objConn1, "tpaytype", "SalesTax", "txttpaytypeSalesTax");
$arrayoRStpaytype["Account"] = getFormSQLQuoted($objConn1, "tpaytype", "Account", "txttpaytypeAccount");
$arrayoRStpaytype["MTDQty"] = getFormSQLQuoted($objConn1, "tpaytype", "MTDQty", "txttpaytypeMTDQty");
$arrayoRStpaytype["MTDAmt"] = getFormSQLQuoted($objConn1, "tpaytype", "MTDAmt", "txttpaytypeMTDAmt");
$arrayoRStpaytype["YTDQty"] = getFormSQLQuoted($objConn1, "tpaytype", "YTDQty", "txttpaytypeYTDQty");
$arrayoRStpaytype["YTDAmt"] = getFormSQLQuoted($objConn1, "tpaytype", "YTDAmt", "txttpaytypeYTDAmt");
        if (getRequest("txttpaytypeType") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Type:</strong> : Must be in list ";
                    $myStatus .= "Cash;Cheque;Credit Card;Debit Card;Other; <hr>\n";
        endif;
$arrayoRStpaytype["Type"] = getFormSQLQuoted($objConn1, "tpaytype", "Type", "txttpaytypeType");
$tsql = $objConn1->GetUpdateSQL($oRStpaytype, $arrayoRStpaytype, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tpaytype" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStpaytype as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tpaytype" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStpaytype->Close();
unset($oRStpaytype);
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
  $_SESSION["Updatetpaytype_EditFailed"] = 1;
  $_SESSION["SavedEdittpaytypeCountryID"] = $_POST["txttpaytypeCountryID"];
  $_SESSION["SavedEdittpaytypeBranchID"] = $_POST["txttpaytypeBranchID"];
  $_SESSION["SavedEdittpaytypePayType"] = $_POST["txttpaytypePayType"];
  $_SESSION["SavedEdittpaytypeDescription"] = $_POST["txttpaytypeDescription"];
  $_SESSION["SavedEdittpaytypeAmount"] = $_POST["txttpaytypeAmount"];
  $_SESSION["SavedEdittpaytypeCommAmt"] = $_POST["txttpaytypeCommAmt"];
  $_SESSION["SavedEdittpaytypeSalesTax"] = $_POST["txttpaytypeSalesTax"];
  $_SESSION["SavedEdittpaytypeAccount"] = $_POST["txttpaytypeAccount"];
  $_SESSION["SavedEdittpaytypeMTDQty"] = $_POST["txttpaytypeMTDQty"];
  $_SESSION["SavedEdittpaytypeMTDAmt"] = $_POST["txttpaytypeMTDAmt"];
  $_SESSION["SavedEdittpaytypeYTDQty"] = $_POST["txttpaytypeYTDQty"];
  $_SESSION["SavedEdittpaytypeYTDAmt"] = $_POST["txttpaytypeYTDAmt"];
  $_SESSION["SavedEdittpaytypeType"] = $_POST["txttpaytypeType"];
}
else {
  $_SESSION["Updatetpaytype_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
