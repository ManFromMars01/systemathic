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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$myAction = "";
$strSQL = "";
$myStatus = "";
$flgMissing = 0;
$myError = "";

$HTML_Template = getRequest("HTMLT");


$dbColumns = "";
$dbValues = "";
            if (getForm("txttpaytypeCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"tpaytype","CountryID","txttpaytypeCountryID");
            if (getForm("txttpaytypeBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"tpaytype","BranchID","txttpaytypeBranchID");
            if (getForm("txttpaytypePayType") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Pay Type:</STRONG> : Required field <HR>\n";
            endif;
    $rst["PayType"] = getFormSQLQuoted($objConn1,"tpaytype","PayType","txttpaytypePayType");
            if (getForm("txttpaytypeDescription") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Description:</STRONG> : Required field <HR>\n";
            endif;
    $rst["Description"] = getFormSQLQuoted($objConn1,"tpaytype","Description","txttpaytypeDescription");
    $rst["Amount"] = getFormSQLQuoted($objConn1,"tpaytype","Amount","txttpaytypeAmount");
    $rst["CommAmt"] = getFormSQLQuoted($objConn1,"tpaytype","CommAmt","txttpaytypeCommAmt");
    $rst["SalesTax"] = getFormSQLQuoted($objConn1,"tpaytype","SalesTax","txttpaytypeSalesTax");
    $rst["Account"] = getFormSQLQuoted($objConn1,"tpaytype","Account","txttpaytypeAccount");
    $rst["MTDQty"] = getFormSQLQuoted($objConn1,"tpaytype","MTDQty","txttpaytypeMTDQty");
    $rst["MTDAmt"] = getFormSQLQuoted($objConn1,"tpaytype","MTDAmt","txttpaytypeMTDAmt");
    $rst["YTDQty"] = getFormSQLQuoted($objConn1,"tpaytype","YTDQty","txttpaytypeYTDQty");
    $rst["YTDAmt"] = getFormSQLQuoted($objConn1,"tpaytype","YTDAmt","txttpaytypeYTDAmt");
            if (getForm("txttpaytypeType") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Type:</STRONG> : Must be in list <BR>";
                    $myStatus .= "Cash;Cheque;Credit Card;Debit Card;Other; <HR>\n";
            endif;
    $rst["Type"] = getFormSQLQuoted($objConn1,"tpaytype","Type","txttpaytypeType");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into tpaytype (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStpaytype = $objConn1->Execute($sql);

  if (!isset($oRStpaytype) || $oRStpaytype == false || $oRStpaytype == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
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


function MergeAddTemplate($Template) {
    if (!isset($Template) || ($Template == "")) {
        $Template = "./html/blank.htm";
    }       
    global $ClarionData;
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
}

if($flgMissing == true) {
  $_SESSION["Updatetpaytype_InsertFailed"] = 1;
  $_SESSION["SavedtpaytypeCountryID"] = $_POST["txttpaytypeCountryID"];
  $_SESSION["SavedtpaytypeBranchID"] = $_POST["txttpaytypeBranchID"];
  $_SESSION["SavedtpaytypePayType"] = $_POST["txttpaytypePayType"];
  $_SESSION["SavedtpaytypeDescription"] = $_POST["txttpaytypeDescription"];
  $_SESSION["SavedtpaytypeAmount"] = $_POST["txttpaytypeAmount"];
  $_SESSION["SavedtpaytypeCommAmt"] = $_POST["txttpaytypeCommAmt"];
  $_SESSION["SavedtpaytypeSalesTax"] = $_POST["txttpaytypeSalesTax"];
  $_SESSION["SavedtpaytypeAccount"] = $_POST["txttpaytypeAccount"];
  $_SESSION["SavedtpaytypeMTDQty"] = $_POST["txttpaytypeMTDQty"];
  $_SESSION["SavedtpaytypeMTDAmt"] = $_POST["txttpaytypeMTDAmt"];
  $_SESSION["SavedtpaytypeYTDQty"] = $_POST["txttpaytypeYTDQty"];
  $_SESSION["SavedtpaytypeYTDAmt"] = $_POST["txttpaytypeYTDAmt"];
  $_SESSION["SavedtpaytypeType"] = $_POST["txttpaytypeType"];
}
else {
  $_SESSION["Updatetpaytype_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";


MergeAddTemplate($HTML_Template);
unset($oRStpaytype) ;
$objConn1->Close();
unset($objConn1);
?> 
