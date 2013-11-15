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
$sql = "SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp, titems.AbaDesc, titems.MenDesc, titems.SuppDesc, titems.AbaNxtBook1, titems.AbaNxtBook2, titems.AbaNxtBook3, titems.AbaPrvBook1, titems.AbaPrvBook2, titems.AbaPrvBook3, titems.AbaPreBook1, titems.AbaPreBook2, titems.AbaPreBook3, titems.AbaRptCnt1, titems.AbaRptCnt2, titems.AbaRptCnt3, titems.AbaDigitStart, titems.AbaDigitEnd, titems.AbaNumStart, titems.AbaNumEnd, titems.AbaBookGrade, titems.MenNxtBook1, titems.MenNxtBook2, titems.MenNxtBook3, titems.MenPrvBook1, titems.MenPrvBook2, titems.MenPrvBook3, titems.MenPreBook1, titems.MenPreBook2, titems.MenPreBook3, titems.MenRptCnt1, titems.MenRptCnt2, titems.MenRptCnt3, titems.MenDigitStart, titems.MenDigitEnd, titems.MenNumStart, titems.MenNumEnd, titems.MenBookGrade, titems.SuppNxtBook1, titems.SuppNxtBook2, titems.SuppNxtBook3, titems.SuppPrvBook1, titems.SuppPrvBook2, titems.SuppPrvBook3, titems.SuppPreBook1, titems.SuppPreBook2, titems.SuppPreBook3, titems.SuppRptCnt1, titems.SuppRptCnt2, titems.SuppRptCnt3, titems.SuppDigitStart, titems.SuppDigitEnd, titems.SuppNumStart, titems.SuppNumEnd, titems.SuppBookGrade, titems.CatID, titems.SubCatID, titems.DeptID, titems.ManufacturerID, titems.LocationID, titems.IssuUntCost, titems.IssuUntMea, titems.PurUntCost, titems.ReOrderPT, titems.ReOrderQty, titems.LastPurVdrID, titems.ReOrderReq, titems.LstOrderCost, titems.StdCost, titems.QtyOnHand, titems.QtyOnOrder  FROM  titems WHERE  titems.CountryID = '" . $ID1 . "'" . " AND titems.BranchID = '" . $ID2 . "'" . " AND titems.ItemNo = '" . $ID3 . "'";
$oRStitems = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStitems = array();
if (!$oRStitems):
    $oRStitems->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttitemsCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["CountryID"] = getFormSQLQuoted($objConn1, "titems", "CountryID", "txttitemsCountryID");
        if (getRequest("txttitemsBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["BranchID"] = getFormSQLQuoted($objConn1, "titems", "BranchID", "txttitemsBranchID");
        if (getRequest("txttitemsItemNo") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Item No:</strong> : Required field <hr>\n";
        endif;
$arrayoRStitems["ItemNo"] = getFormSQLQuoted($objConn1, "titems", "ItemNo", "txttitemsItemNo");
$arrayoRStitems["Description"] = getFormSQLQuoted($objConn1, "titems", "Description", "txttitemsDescription");
$arrayoRStitems["IsBook"] = getFormSQLQuoted($objConn1, "titems", "IsBook", "txttitemsIsBook");
$arrayoRStitems["IsMultiCat"] = getFormSQLQuoted($objConn1, "titems", "IsMultiCat", "txttitemsIsMultiCat");
$arrayoRStitems["IsAbacus"] = getFormSQLQuoted($objConn1, "titems", "IsAbacus", "txttitemsIsAbacus");
$arrayoRStitems["IsMental"] = getFormSQLQuoted($objConn1, "titems", "IsMental", "txttitemsIsMental");
$arrayoRStitems["IsSupp"] = getFormSQLQuoted($objConn1, "titems", "IsSupp", "txttitemsIsSupp");
$arrayoRStitems["AbaDesc"] = getFormSQLQuoted($objConn1, "titems", "AbaDesc", "txttitemsAbaDesc");
$arrayoRStitems["MenDesc"] = getFormSQLQuoted($objConn1, "titems", "MenDesc", "txttitemsMenDesc");
$arrayoRStitems["SuppDesc"] = getFormSQLQuoted($objConn1, "titems", "SuppDesc", "txttitemsSuppDesc");
$arrayoRStitems["AbaNxtBook1"] = getFormSQLQuoted($objConn1, "titems", "AbaNxtBook1", "txttitemsAbaNxtBook1");
$arrayoRStitems["AbaNxtBook2"] = getFormSQLQuoted($objConn1, "titems", "AbaNxtBook2", "txttitemsAbaNxtBook2");
$arrayoRStitems["AbaNxtBook3"] = getFormSQLQuoted($objConn1, "titems", "AbaNxtBook3", "txttitemsAbaNxtBook3");
$arrayoRStitems["AbaPrvBook1"] = getFormSQLQuoted($objConn1, "titems", "AbaPrvBook1", "txttitemsAbaPrvBook1");
$arrayoRStitems["AbaPrvBook2"] = getFormSQLQuoted($objConn1, "titems", "AbaPrvBook2", "txttitemsAbaPrvBook2");
$arrayoRStitems["AbaPrvBook3"] = getFormSQLQuoted($objConn1, "titems", "AbaPrvBook3", "txttitemsAbaPrvBook3");
$arrayoRStitems["AbaPreBook1"] = getFormSQLQuoted($objConn1, "titems", "AbaPreBook1", "txttitemsAbaPreBook1");
$arrayoRStitems["AbaPreBook2"] = getFormSQLQuoted($objConn1, "titems", "AbaPreBook2", "txttitemsAbaPreBook2");
$arrayoRStitems["AbaPreBook3"] = getFormSQLQuoted($objConn1, "titems", "AbaPreBook3", "txttitemsAbaPreBook3");
$arrayoRStitems["AbaRptCnt1"] = getFormSQLQuoted($objConn1, "titems", "AbaRptCnt1", "txttitemsAbaRptCnt1");
$arrayoRStitems["AbaRptCnt2"] = getFormSQLQuoted($objConn1, "titems", "AbaRptCnt2", "txttitemsAbaRptCnt2");
$arrayoRStitems["AbaRptCnt3"] = getFormSQLQuoted($objConn1, "titems", "AbaRptCnt3", "txttitemsAbaRptCnt3");
$arrayoRStitems["AbaDigitStart"] = getFormSQLQuoted($objConn1, "titems", "AbaDigitStart", "txttitemsAbaDigitStart");
$arrayoRStitems["AbaDigitEnd"] = getFormSQLQuoted($objConn1, "titems", "AbaDigitEnd", "txttitemsAbaDigitEnd");
$arrayoRStitems["AbaNumStart"] = getFormSQLQuoted($objConn1, "titems", "AbaNumStart", "txttitemsAbaNumStart");
$arrayoRStitems["AbaNumEnd"] = getFormSQLQuoted($objConn1, "titems", "AbaNumEnd", "txttitemsAbaNumEnd");
$arrayoRStitems["AbaBookGrade"] = getFormSQLQuoted($objConn1, "titems", "AbaBookGrade", "txttitemsAbaBookGrade");
$arrayoRStitems["MenNxtBook1"] = getFormSQLQuoted($objConn1, "titems", "MenNxtBook1", "txttitemsMenNxtBook1");
$arrayoRStitems["MenNxtBook2"] = getFormSQLQuoted($objConn1, "titems", "MenNxtBook2", "txttitemsMenNxtBook2");
$arrayoRStitems["MenNxtBook3"] = getFormSQLQuoted($objConn1, "titems", "MenNxtBook3", "txttitemsMenNxtBook3");
$arrayoRStitems["MenPrvBook1"] = getFormSQLQuoted($objConn1, "titems", "MenPrvBook1", "txttitemsMenPrvBook1");
$arrayoRStitems["MenPrvBook2"] = getFormSQLQuoted($objConn1, "titems", "MenPrvBook2", "txttitemsMenPrvBook2");
$arrayoRStitems["MenPrvBook3"] = getFormSQLQuoted($objConn1, "titems", "MenPrvBook3", "txttitemsMenPrvBook3");
$arrayoRStitems["MenPreBook1"] = getFormSQLQuoted($objConn1, "titems", "MenPreBook1", "txttitemsMenPreBook1");
$arrayoRStitems["MenPreBook2"] = getFormSQLQuoted($objConn1, "titems", "MenPreBook2", "txttitemsMenPreBook2");
$arrayoRStitems["MenPreBook3"] = getFormSQLQuoted($objConn1, "titems", "MenPreBook3", "txttitemsMenPreBook3");
$arrayoRStitems["MenRptCnt1"] = getFormSQLQuoted($objConn1, "titems", "MenRptCnt1", "txttitemsMenRptCnt1");
$arrayoRStitems["MenRptCnt2"] = getFormSQLQuoted($objConn1, "titems", "MenRptCnt2", "txttitemsMenRptCnt2");
$arrayoRStitems["MenRptCnt3"] = getFormSQLQuoted($objConn1, "titems", "MenRptCnt3", "txttitemsMenRptCnt3");
$arrayoRStitems["MenDigitStart"] = getFormSQLQuoted($objConn1, "titems", "MenDigitStart", "txttitemsMenDigitStart");
$arrayoRStitems["MenDigitEnd"] = getFormSQLQuoted($objConn1, "titems", "MenDigitEnd", "txttitemsMenDigitEnd");
$arrayoRStitems["MenNumStart"] = getFormSQLQuoted($objConn1, "titems", "MenNumStart", "txttitemsMenNumStart");
$arrayoRStitems["MenNumEnd"] = getFormSQLQuoted($objConn1, "titems", "MenNumEnd", "txttitemsMenNumEnd");
$arrayoRStitems["MenBookGrade"] = getFormSQLQuoted($objConn1, "titems", "MenBookGrade", "txttitemsMenBookGrade");
$arrayoRStitems["SuppNxtBook1"] = getFormSQLQuoted($objConn1, "titems", "SuppNxtBook1", "txttitemsSuppNxtBook1");
$arrayoRStitems["SuppNxtBook2"] = getFormSQLQuoted($objConn1, "titems", "SuppNxtBook2", "txttitemsSuppNxtBook2");
$arrayoRStitems["SuppNxtBook3"] = getFormSQLQuoted($objConn1, "titems", "SuppNxtBook3", "txttitemsSuppNxtBook3");
$arrayoRStitems["SuppPrvBook1"] = getFormSQLQuoted($objConn1, "titems", "SuppPrvBook1", "txttitemsSuppPrvBook1");
$arrayoRStitems["SuppPrvBook2"] = getFormSQLQuoted($objConn1, "titems", "SuppPrvBook2", "txttitemsSuppPrvBook2");
$arrayoRStitems["SuppPrvBook3"] = getFormSQLQuoted($objConn1, "titems", "SuppPrvBook3", "txttitemsSuppPrvBook3");
$arrayoRStitems["SuppPreBook1"] = getFormSQLQuoted($objConn1, "titems", "SuppPreBook1", "txttitemsSuppPreBook1");
$arrayoRStitems["SuppPreBook2"] = getFormSQLQuoted($objConn1, "titems", "SuppPreBook2", "txttitemsSuppPreBook2");
$arrayoRStitems["SuppPreBook3"] = getFormSQLQuoted($objConn1, "titems", "SuppPreBook3", "txttitemsSuppPreBook3");
$arrayoRStitems["SuppRptCnt1"] = getFormSQLQuoted($objConn1, "titems", "SuppRptCnt1", "txttitemsSuppRptCnt1");
$arrayoRStitems["SuppRptCnt2"] = getFormSQLQuoted($objConn1, "titems", "SuppRptCnt2", "txttitemsSuppRptCnt2");
$arrayoRStitems["SuppRptCnt3"] = getFormSQLQuoted($objConn1, "titems", "SuppRptCnt3", "txttitemsSuppRptCnt3");
$arrayoRStitems["SuppDigitStart"] = getFormSQLQuoted($objConn1, "titems", "SuppDigitStart", "txttitemsSuppDigitStart");
$arrayoRStitems["SuppDigitEnd"] = getFormSQLQuoted($objConn1, "titems", "SuppDigitEnd", "txttitemsSuppDigitEnd");
$arrayoRStitems["SuppNumStart"] = getFormSQLQuoted($objConn1, "titems", "SuppNumStart", "txttitemsSuppNumStart");
$arrayoRStitems["SuppNumEnd"] = getFormSQLQuoted($objConn1, "titems", "SuppNumEnd", "txttitemsSuppNumEnd");
$arrayoRStitems["SuppBookGrade"] = getFormSQLQuoted($objConn1, "titems", "SuppBookGrade", "txttitemsSuppBookGrade");
        if (getRequest("txttitemsCatID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Cat ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["CatID"] = getFormSQLQuoted($objConn1, "titems", "CatID", "txttitemsCatID");
        if (getRequest("txttitemsSubCatID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Sub Cat ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["SubCatID"] = getFormSQLQuoted($objConn1, "titems", "SubCatID", "txttitemsSubCatID");
        if (getRequest("txttitemsDeptID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Dept ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["DeptID"] = getFormSQLQuoted($objConn1, "titems", "DeptID", "txttitemsDeptID");
        if (getRequest("txttitemsManufacturerID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Manufacturer ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["ManufacturerID"] = getFormSQLQuoted($objConn1, "titems", "ManufacturerID", "txttitemsManufacturerID");
        if (getRequest("txttitemsLocationID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Location ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["LocationID"] = getFormSQLQuoted($objConn1, "titems", "LocationID", "txttitemsLocationID");
$arrayoRStitems["IssuUntCost"] = getFormSQLQuoted($objConn1, "titems", "IssuUntCost", "txttitemsIssuUntCost");
        if (getRequest("txttitemsIssuUntMea") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Issu Unt Mea:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["IssuUntMea"] = getFormSQLQuoted($objConn1, "titems", "IssuUntMea", "txttitemsIssuUntMea");
$arrayoRStitems["PurUntCost"] = getFormSQLQuoted($objConn1, "titems", "PurUntCost", "txttitemsPurUntCost");
$arrayoRStitems["ReOrderPT"] = getFormSQLQuoted($objConn1, "titems", "ReOrderPT", "txttitemsReOrderPT");
$arrayoRStitems["ReOrderQty"] = getFormSQLQuoted($objConn1, "titems", "ReOrderQty", "txttitemsReOrderQty");
        if (getRequest("txttitemsLastPurVdrID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Last Pur Vdr ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStitems["LastPurVdrID"] = getFormSQLQuoted($objConn1, "titems", "LastPurVdrID", "txttitemsLastPurVdrID");
$arrayoRStitems["ReOrderReq"] = getFormSQLQuoted($objConn1, "titems", "ReOrderReq", "txttitemsReOrderReq");
$arrayoRStitems["LstOrderCost"] = getFormSQLQuoted($objConn1, "titems", "LstOrderCost", "txttitemsLstOrderCost");
$arrayoRStitems["StdCost"] = getFormSQLQuoted($objConn1, "titems", "StdCost", "txttitemsStdCost");
$arrayoRStitems["QtyOnHand"] = getFormSQLQuoted($objConn1, "titems", "QtyOnHand", "txttitemsQtyOnHand");
$arrayoRStitems["QtyOnOrder"] = getFormSQLQuoted($objConn1, "titems", "QtyOnOrder", "txttitemsQtyOnOrder");
$tsql = $objConn1->GetUpdateSQL($oRStitems, $arrayoRStitems, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "titems" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStitems as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "titems" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStitems->Close();
unset($oRStitems);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>".$sql;
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseItems#WHR")<>""):
        $myStatus .= "<a href='BrowseItemslist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseItemslist.php'>Return to list</a>.";
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
  $_SESSION["Updatetitems_EditFailed"] = 1;
  $_SESSION["SavedEdittitemsCountryID"] = $_POST["txttitemsCountryID"];
  $_SESSION["SavedEdittitemsBranchID"] = $_POST["txttitemsBranchID"];
  $_SESSION["SavedEdittitemsItemNo"] = $_POST["txttitemsItemNo"];
  $_SESSION["SavedEdittitemsDescription"] = $_POST["txttitemsDescription"];
  $_SESSION["SavedEdittitemsIsBook"] = $_POST["txttitemsIsBook"];
  $_SESSION["SavedEdittitemsIsMultiCat"] = $_POST["txttitemsIsMultiCat"];
  $_SESSION["SavedEdittitemsIsAbacus"] = $_POST["txttitemsIsAbacus"];
  $_SESSION["SavedEdittitemsIsMental"] = $_POST["txttitemsIsMental"];
  $_SESSION["SavedEdittitemsIsSupp"] = $_POST["txttitemsIsSupp"];
  $_SESSION["SavedEdittitemsAbaDesc"] = $_POST["txttitemsAbaDesc"];
  $_SESSION["SavedEdittitemsMenDesc"] = $_POST["txttitemsMenDesc"];
  $_SESSION["SavedEdittitemsSuppDesc"] = $_POST["txttitemsSuppDesc"];
  $_SESSION["SavedEdittitemsAbaNxtBook1"] = $_POST["txttitemsAbaNxtBook1"];
  $_SESSION["SavedEdittitemsAbaNxtBook2"] = $_POST["txttitemsAbaNxtBook2"];
  $_SESSION["SavedEdittitemsAbaNxtBook3"] = $_POST["txttitemsAbaNxtBook3"];
  $_SESSION["SavedEdittitemsAbaPrvBook1"] = $_POST["txttitemsAbaPrvBook1"];
  $_SESSION["SavedEdittitemsAbaPrvBook2"] = $_POST["txttitemsAbaPrvBook2"];
  $_SESSION["SavedEdittitemsAbaPrvBook3"] = $_POST["txttitemsAbaPrvBook3"];
  $_SESSION["SavedEdittitemsAbaPreBook1"] = $_POST["txttitemsAbaPreBook1"];
  $_SESSION["SavedEdittitemsAbaPreBook2"] = $_POST["txttitemsAbaPreBook2"];
  $_SESSION["SavedEdittitemsAbaPreBook3"] = $_POST["txttitemsAbaPreBook3"];
  $_SESSION["SavedEdittitemsAbaRptCnt1"] = $_POST["txttitemsAbaRptCnt1"];
  $_SESSION["SavedEdittitemsAbaRptCnt2"] = $_POST["txttitemsAbaRptCnt2"];
  $_SESSION["SavedEdittitemsAbaRptCnt3"] = $_POST["txttitemsAbaRptCnt3"];
  $_SESSION["SavedEdittitemsAbaDigitStart"] = $_POST["txttitemsAbaDigitStart"];
  $_SESSION["SavedEdittitemsAbaDigitEnd"] = $_POST["txttitemsAbaDigitEnd"];
  $_SESSION["SavedEdittitemsAbaNumStart"] = $_POST["txttitemsAbaNumStart"];
  $_SESSION["SavedEdittitemsAbaNumEnd"] = $_POST["txttitemsAbaNumEnd"];
  $_SESSION["SavedEdittitemsAbaBookGrade"] = $_POST["txttitemsAbaBookGrade"];
  $_SESSION["SavedEdittitemsMenNxtBook1"] = $_POST["txttitemsMenNxtBook1"];
  $_SESSION["SavedEdittitemsMenNxtBook2"] = $_POST["txttitemsMenNxtBook2"];
  $_SESSION["SavedEdittitemsMenNxtBook3"] = $_POST["txttitemsMenNxtBook3"];
  $_SESSION["SavedEdittitemsMenPrvBook1"] = $_POST["txttitemsMenPrvBook1"];
  $_SESSION["SavedEdittitemsMenPrvBook2"] = $_POST["txttitemsMenPrvBook2"];
  $_SESSION["SavedEdittitemsMenPrvBook3"] = $_POST["txttitemsMenPrvBook3"];
  $_SESSION["SavedEdittitemsMenPreBook1"] = $_POST["txttitemsMenPreBook1"];
  $_SESSION["SavedEdittitemsMenPreBook2"] = $_POST["txttitemsMenPreBook2"];
  $_SESSION["SavedEdittitemsMenPreBook3"] = $_POST["txttitemsMenPreBook3"];
  $_SESSION["SavedEdittitemsMenRptCnt1"] = $_POST["txttitemsMenRptCnt1"];
  $_SESSION["SavedEdittitemsMenRptCnt2"] = $_POST["txttitemsMenRptCnt2"];
  $_SESSION["SavedEdittitemsMenRptCnt3"] = $_POST["txttitemsMenRptCnt3"];
  $_SESSION["SavedEdittitemsMenDigitStart"] = $_POST["txttitemsMenDigitStart"];
  $_SESSION["SavedEdittitemsMenDigitEnd"] = $_POST["txttitemsMenDigitEnd"];
  $_SESSION["SavedEdittitemsMenNumStart"] = $_POST["txttitemsMenNumStart"];
  $_SESSION["SavedEdittitemsMenNumEnd"] = $_POST["txttitemsMenNumEnd"];
  $_SESSION["SavedEdittitemsMenBookGrade"] = $_POST["txttitemsMenBookGrade"];
  $_SESSION["SavedEdittitemsSuppNxtBook1"] = $_POST["txttitemsSuppNxtBook1"];
  $_SESSION["SavedEdittitemsSuppNxtBook2"] = $_POST["txttitemsSuppNxtBook2"];
  $_SESSION["SavedEdittitemsSuppNxtBook3"] = $_POST["txttitemsSuppNxtBook3"];
  $_SESSION["SavedEdittitemsSuppPrvBook1"] = $_POST["txttitemsSuppPrvBook1"];
  $_SESSION["SavedEdittitemsSuppPrvBook2"] = $_POST["txttitemsSuppPrvBook2"];
  $_SESSION["SavedEdittitemsSuppPrvBook3"] = $_POST["txttitemsSuppPrvBook3"];
  $_SESSION["SavedEdittitemsSuppPreBook1"] = $_POST["txttitemsSuppPreBook1"];
  $_SESSION["SavedEdittitemsSuppPreBook2"] = $_POST["txttitemsSuppPreBook2"];
  $_SESSION["SavedEdittitemsSuppPreBook3"] = $_POST["txttitemsSuppPreBook3"];
  $_SESSION["SavedEdittitemsSuppRptCnt1"] = $_POST["txttitemsSuppRptCnt1"];
  $_SESSION["SavedEdittitemsSuppRptCnt2"] = $_POST["txttitemsSuppRptCnt2"];
  $_SESSION["SavedEdittitemsSuppRptCnt3"] = $_POST["txttitemsSuppRptCnt3"];
  $_SESSION["SavedEdittitemsSuppDigitStart"] = $_POST["txttitemsSuppDigitStart"];
  $_SESSION["SavedEdittitemsSuppDigitEnd"] = $_POST["txttitemsSuppDigitEnd"];
  $_SESSION["SavedEdittitemsSuppNumStart"] = $_POST["txttitemsSuppNumStart"];
  $_SESSION["SavedEdittitemsSuppNumEnd"] = $_POST["txttitemsSuppNumEnd"];
  $_SESSION["SavedEdittitemsSuppBookGrade"] = $_POST["txttitemsSuppBookGrade"];
  $_SESSION["SavedEdittitemsCatID"] = $_POST["txttitemsCatID"];
  $_SESSION["SavedEdittitemsSubCatID"] = $_POST["txttitemsSubCatID"];
  $_SESSION["SavedEdittitemsDeptID"] = $_POST["txttitemsDeptID"];
  $_SESSION["SavedEdittitemsManufacturerID"] = $_POST["txttitemsManufacturerID"];
  $_SESSION["SavedEdittitemsLocationID"] = $_POST["txttitemsLocationID"];
  $_SESSION["SavedEdittitemsIssuUntCost"] = $_POST["txttitemsIssuUntCost"];
  $_SESSION["SavedEdittitemsIssuUntMea"] = $_POST["txttitemsIssuUntMea"];
  $_SESSION["SavedEdittitemsPurUntCost"] = $_POST["txttitemsPurUntCost"];
  $_SESSION["SavedEdittitemsReOrderPT"] = $_POST["txttitemsReOrderPT"];
  $_SESSION["SavedEdittitemsReOrderQty"] = $_POST["txttitemsReOrderQty"];
  $_SESSION["SavedEdittitemsLastPurVdrID"] = $_POST["txttitemsLastPurVdrID"];
  $_SESSION["SavedEdittitemsReOrderReq"] = $_POST["txttitemsReOrderReq"];
  $_SESSION["SavedEdittitemsLstOrderCost"] = $_POST["txttitemsLstOrderCost"];
  $_SESSION["SavedEdittitemsStdCost"] = $_POST["txttitemsStdCost"];
  $_SESSION["SavedEdittitemsQtyOnHand"] = $_POST["txttitemsQtyOnHand"];
  $_SESSION["SavedEdittitemsQtyOnOrder"] = $_POST["txttitemsQtyOnOrder"];
}
else {
  $_SESSION["Updatetitems_EditFailed"] = 0;
}
$myStatus = array('mystatus2' => $myStatus);
echo json_encode($myStatus);
//MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>



