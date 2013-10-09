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
            if (getForm("txttitemsCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"titems","CountryID","txttitemsCountryID");
            if (getForm("txttitemsBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"titems","BranchID","txttitemsBranchID");
            if (getForm("txttitemsItemNo") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Item No:</STRONG> : Required field <HR>\n";
            endif;
    $rst["ItemNo"] = getFormSQLQuoted($objConn1,"titems","ItemNo","txttitemsItemNo");
    $rst["Description"] = getFormSQLQuoted($objConn1,"titems","Description","txttitemsDescription");
    $rst["IsBook"] = getFormSQLQuoted($objConn1,"titems","IsBook","txttitemsIsBook");
    $rst["IsMultiCat"] = getFormSQLQuoted($objConn1,"titems","IsMultiCat","txttitemsIsMultiCat");
    $rst["IsAbacus"] = getFormSQLQuoted($objConn1,"titems","IsAbacus","txttitemsIsAbacus");
    $rst["IsMental"] = getFormSQLQuoted($objConn1,"titems","IsMental","txttitemsIsMental");
    $rst["IsSupp"] = getFormSQLQuoted($objConn1,"titems","IsSupp","txttitemsIsSupp");
    $rst["AbaDesc"] = getFormSQLQuoted($objConn1,"titems","AbaDesc","txttitemsAbaDesc");
    $rst["MenDesc"] = getFormSQLQuoted($objConn1,"titems","MenDesc","txttitemsMenDesc");
    $rst["SuppDesc"] = getFormSQLQuoted($objConn1,"titems","SuppDesc","txttitemsSuppDesc");
    $rst["AbaNxtBook1"] = getFormSQLQuoted($objConn1,"titems","AbaNxtBook1","txttitemsAbaNxtBook1");
    $rst["AbaNxtBook2"] = getFormSQLQuoted($objConn1,"titems","AbaNxtBook2","txttitemsAbaNxtBook2");
    $rst["AbaNxtBook3"] = getFormSQLQuoted($objConn1,"titems","AbaNxtBook3","txttitemsAbaNxtBook3");
    $rst["AbaPrvBook1"] = getFormSQLQuoted($objConn1,"titems","AbaPrvBook1","txttitemsAbaPrvBook1");
    $rst["AbaPrvBook2"] = getFormSQLQuoted($objConn1,"titems","AbaPrvBook2","txttitemsAbaPrvBook2");
    $rst["AbaPrvBook3"] = getFormSQLQuoted($objConn1,"titems","AbaPrvBook3","txttitemsAbaPrvBook3");
    $rst["AbaPreBook1"] = getFormSQLQuoted($objConn1,"titems","AbaPreBook1","txttitemsAbaPreBook1");
    $rst["AbaPreBook2"] = getFormSQLQuoted($objConn1,"titems","AbaPreBook2","txttitemsAbaPreBook2");
    $rst["AbaPreBook3"] = getFormSQLQuoted($objConn1,"titems","AbaPreBook3","txttitemsAbaPreBook3");
    $rst["AbaRptCnt1"] = getFormSQLQuoted($objConn1,"titems","AbaRptCnt1","txttitemsAbaRptCnt1");
    $rst["AbaRptCnt2"] = getFormSQLQuoted($objConn1,"titems","AbaRptCnt2","txttitemsAbaRptCnt2");
    $rst["AbaRptCnt3"] = getFormSQLQuoted($objConn1,"titems","AbaRptCnt3","txttitemsAbaRptCnt3");
    $rst["AbaDigitStart"] = getFormSQLQuoted($objConn1,"titems","AbaDigitStart","txttitemsAbaDigitStart");
    $rst["AbaDigitEnd"] = getFormSQLQuoted($objConn1,"titems","AbaDigitEnd","txttitemsAbaDigitEnd");
    $rst["AbaNumStart"] = getFormSQLQuoted($objConn1,"titems","AbaNumStart","txttitemsAbaNumStart");
    $rst["AbaNumEnd"] = getFormSQLQuoted($objConn1,"titems","AbaNumEnd","txttitemsAbaNumEnd");
    $rst["AbaBookGrade"] = getFormSQLQuoted($objConn1,"titems","AbaBookGrade","txttitemsAbaBookGrade");
    $rst["MenNxtBook1"] = getFormSQLQuoted($objConn1,"titems","MenNxtBook1","txttitemsMenNxtBook1");
    $rst["MenNxtBook2"] = getFormSQLQuoted($objConn1,"titems","MenNxtBook2","txttitemsMenNxtBook2");
    $rst["MenNxtBook3"] = getFormSQLQuoted($objConn1,"titems","MenNxtBook3","txttitemsMenNxtBook3");
    $rst["MenPrvBook1"] = getFormSQLQuoted($objConn1,"titems","MenPrvBook1","txttitemsMenPrvBook1");
    $rst["MenPrvBook2"] = getFormSQLQuoted($objConn1,"titems","MenPrvBook2","txttitemsMenPrvBook2");
    $rst["MenPrvBook3"] = getFormSQLQuoted($objConn1,"titems","MenPrvBook3","txttitemsMenPrvBook3");
    $rst["MenPreBook1"] = getFormSQLQuoted($objConn1,"titems","MenPreBook1","txttitemsMenPreBook1");
    $rst["MenPreBook2"] = getFormSQLQuoted($objConn1,"titems","MenPreBook2","txttitemsMenPreBook2");
    $rst["MenPreBook3"] = getFormSQLQuoted($objConn1,"titems","MenPreBook3","txttitemsMenPreBook3");
    $rst["MenRptCnt1"] = getFormSQLQuoted($objConn1,"titems","MenRptCnt1","txttitemsMenRptCnt1");
    $rst["MenRptCnt2"] = getFormSQLQuoted($objConn1,"titems","MenRptCnt2","txttitemsMenRptCnt2");
    $rst["MenRptCnt3"] = getFormSQLQuoted($objConn1,"titems","MenRptCnt3","txttitemsMenRptCnt3");
    $rst["MenDigitStart"] = getFormSQLQuoted($objConn1,"titems","MenDigitStart","txttitemsMenDigitStart");
    $rst["MenDigitEnd"] = getFormSQLQuoted($objConn1,"titems","MenDigitEnd","txttitemsMenDigitEnd");
    $rst["MenNumStart"] = getFormSQLQuoted($objConn1,"titems","MenNumStart","txttitemsMenNumStart");
    $rst["MenNumEnd"] = getFormSQLQuoted($objConn1,"titems","MenNumEnd","txttitemsMenNumEnd");
    $rst["MenBookGrade"] = getFormSQLQuoted($objConn1,"titems","MenBookGrade","txttitemsMenBookGrade");
    $rst["SuppNxtBook1"] = getFormSQLQuoted($objConn1,"titems","SuppNxtBook1","txttitemsSuppNxtBook1");
    $rst["SuppNxtBook2"] = getFormSQLQuoted($objConn1,"titems","SuppNxtBook2","txttitemsSuppNxtBook2");
    $rst["SuppNxtBook3"] = getFormSQLQuoted($objConn1,"titems","SuppNxtBook3","txttitemsSuppNxtBook3");
    $rst["SuppPrvBook1"] = getFormSQLQuoted($objConn1,"titems","SuppPrvBook1","txttitemsSuppPrvBook1");
    $rst["SuppPrvBook2"] = getFormSQLQuoted($objConn1,"titems","SuppPrvBook2","txttitemsSuppPrvBook2");
    $rst["SuppPrvBook3"] = getFormSQLQuoted($objConn1,"titems","SuppPrvBook3","txttitemsSuppPrvBook3");
    $rst["SuppPreBook1"] = getFormSQLQuoted($objConn1,"titems","SuppPreBook1","txttitemsSuppPreBook1");
    $rst["SuppPreBook2"] = getFormSQLQuoted($objConn1,"titems","SuppPreBook2","txttitemsSuppPreBook2");
    $rst["SuppPreBook3"] = getFormSQLQuoted($objConn1,"titems","SuppPreBook3","txttitemsSuppPreBook3");
    $rst["SuppRptCnt1"] = getFormSQLQuoted($objConn1,"titems","SuppRptCnt1","txttitemsSuppRptCnt1");
    $rst["SuppRptCnt2"] = getFormSQLQuoted($objConn1,"titems","SuppRptCnt2","txttitemsSuppRptCnt2");
    $rst["SuppRptCnt3"] = getFormSQLQuoted($objConn1,"titems","SuppRptCnt3","txttitemsSuppRptCnt3");
    $rst["SuppDigitStart"] = getFormSQLQuoted($objConn1,"titems","SuppDigitStart","txttitemsSuppDigitStart");
    $rst["SuppDigitEnd"] = getFormSQLQuoted($objConn1,"titems","SuppDigitEnd","txttitemsSuppDigitEnd");
    $rst["SuppNumStart"] = getFormSQLQuoted($objConn1,"titems","SuppNumStart","txttitemsSuppNumStart");
    $rst["SuppNumEnd"] = getFormSQLQuoted($objConn1,"titems","SuppNumEnd","txttitemsSuppNumEnd");
    $rst["SuppBookGrade"] = getFormSQLQuoted($objConn1,"titems","SuppBookGrade","txttitemsSuppBookGrade");
            if (getForm("txttitemsCatID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Cat ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CatID"] = getFormSQLQuoted($objConn1,"titems","CatID","txttitemsCatID");
            if (getForm("txttitemsSubCatID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Sub Cat ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["SubCatID"] = getFormSQLQuoted($objConn1,"titems","SubCatID","txttitemsSubCatID");
            if (getForm("txttitemsDeptID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Dept ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["DeptID"] = getFormSQLQuoted($objConn1,"titems","DeptID","txttitemsDeptID");
            if (getForm("txttitemsManufacturerID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Manufacturer ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["ManufacturerID"] = getFormSQLQuoted($objConn1,"titems","ManufacturerID","txttitemsManufacturerID");
            if (getForm("txttitemsLocationID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Location ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["LocationID"] = getFormSQLQuoted($objConn1,"titems","LocationID","txttitemsLocationID");
    $rst["IssuUntCost"] = getFormSQLQuoted($objConn1,"titems","IssuUntCost","txttitemsIssuUntCost");
            if (getForm("txttitemsIssuUntMea") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Issu Unt Mea:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["IssuUntMea"] = getFormSQLQuoted($objConn1,"titems","IssuUntMea","txttitemsIssuUntMea");
    $rst["PurUntCost"] = getFormSQLQuoted($objConn1,"titems","PurUntCost","txttitemsPurUntCost");
    $rst["ReOrderPT"] = getFormSQLQuoted($objConn1,"titems","ReOrderPT","txttitemsReOrderPT");
    $rst["ReOrderQty"] = getFormSQLQuoted($objConn1,"titems","ReOrderQty","txttitemsReOrderQty");
            if (getForm("txttitemsLastPurVdrID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Last Pur Vdr ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["LastPurVdrID"] = getFormSQLQuoted($objConn1,"titems","LastPurVdrID","txttitemsLastPurVdrID");
    $rst["ReOrderReq"] = getFormSQLQuoted($objConn1,"titems","ReOrderReq","txttitemsReOrderReq");
    $rst["LstOrderCost"] = getFormSQLQuoted($objConn1,"titems","LstOrderCost","txttitemsLstOrderCost");
    $rst["StdCost"] = getFormSQLQuoted($objConn1,"titems","StdCost","txttitemsStdCost");
    $rst["QtyOnHand"] = getFormSQLQuoted($objConn1,"titems","QtyOnHand","txttitemsQtyOnHand");
    $rst["QtyOnOrder"] = getFormSQLQuoted($objConn1,"titems","QtyOnOrder","txttitemsQtyOnOrder");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into titems (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRStitems = $objConn1->Execute($sql);

  if (!isset($oRStitems) || $oRStitems == false || $oRStitems == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
  endif;
  if(getSession("BrowseAttendanceStatus#WHR")<>""):
      $myStatus .= "<a href='BrowseAttendanceStatuslist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
  else:
      if($_SESSION["ChildReturnTo"] <> ""):
        $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
      else:
        $myStatus .= "<a href='BrowseAttendanceStatuslist.php'>Return to list</a>.";
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
  $_SESSION["Updatetitems_InsertFailed"] = 1;
  $_SESSION["SavedtitemsCountryID"] = $_POST["txttitemsCountryID"];
  $_SESSION["SavedtitemsBranchID"] = $_POST["txttitemsBranchID"];
  $_SESSION["SavedtitemsItemNo"] = $_POST["txttitemsItemNo"];
  $_SESSION["SavedtitemsDescription"] = $_POST["txttitemsDescription"];
  $_SESSION["SavedtitemsIsBook"] = $_POST["txttitemsIsBook"];
  $_SESSION["SavedtitemsIsMultiCat"] = $_POST["txttitemsIsMultiCat"];
  $_SESSION["SavedtitemsIsAbacus"] = $_POST["txttitemsIsAbacus"];
  $_SESSION["SavedtitemsIsMental"] = $_POST["txttitemsIsMental"];
  $_SESSION["SavedtitemsIsSupp"] = $_POST["txttitemsIsSupp"];
  $_SESSION["SavedtitemsAbaDesc"] = $_POST["txttitemsAbaDesc"];
  $_SESSION["SavedtitemsMenDesc"] = $_POST["txttitemsMenDesc"];
  $_SESSION["SavedtitemsSuppDesc"] = $_POST["txttitemsSuppDesc"];
  $_SESSION["SavedtitemsAbaNxtBook1"] = $_POST["txttitemsAbaNxtBook1"];
  $_SESSION["SavedtitemsAbaNxtBook2"] = $_POST["txttitemsAbaNxtBook2"];
  $_SESSION["SavedtitemsAbaNxtBook3"] = $_POST["txttitemsAbaNxtBook3"];
  $_SESSION["SavedtitemsAbaPrvBook1"] = $_POST["txttitemsAbaPrvBook1"];
  $_SESSION["SavedtitemsAbaPrvBook2"] = $_POST["txttitemsAbaPrvBook2"];
  $_SESSION["SavedtitemsAbaPrvBook3"] = $_POST["txttitemsAbaPrvBook3"];
  $_SESSION["SavedtitemsAbaPreBook1"] = $_POST["txttitemsAbaPreBook1"];
  $_SESSION["SavedtitemsAbaPreBook2"] = $_POST["txttitemsAbaPreBook2"];
  $_SESSION["SavedtitemsAbaPreBook3"] = $_POST["txttitemsAbaPreBook3"];
  $_SESSION["SavedtitemsAbaRptCnt1"] = $_POST["txttitemsAbaRptCnt1"];
  $_SESSION["SavedtitemsAbaRptCnt2"] = $_POST["txttitemsAbaRptCnt2"];
  $_SESSION["SavedtitemsAbaRptCnt3"] = $_POST["txttitemsAbaRptCnt3"];
  $_SESSION["SavedtitemsAbaDigitStart"] = $_POST["txttitemsAbaDigitStart"];
  $_SESSION["SavedtitemsAbaDigitEnd"] = $_POST["txttitemsAbaDigitEnd"];
  $_SESSION["SavedtitemsAbaNumStart"] = $_POST["txttitemsAbaNumStart"];
  $_SESSION["SavedtitemsAbaNumEnd"] = $_POST["txttitemsAbaNumEnd"];
  $_SESSION["SavedtitemsAbaBookGrade"] = $_POST["txttitemsAbaBookGrade"];
  $_SESSION["SavedtitemsMenNxtBook1"] = $_POST["txttitemsMenNxtBook1"];
  $_SESSION["SavedtitemsMenNxtBook2"] = $_POST["txttitemsMenNxtBook2"];
  $_SESSION["SavedtitemsMenNxtBook3"] = $_POST["txttitemsMenNxtBook3"];
  $_SESSION["SavedtitemsMenPrvBook1"] = $_POST["txttitemsMenPrvBook1"];
  $_SESSION["SavedtitemsMenPrvBook2"] = $_POST["txttitemsMenPrvBook2"];
  $_SESSION["SavedtitemsMenPrvBook3"] = $_POST["txttitemsMenPrvBook3"];
  $_SESSION["SavedtitemsMenPreBook1"] = $_POST["txttitemsMenPreBook1"];
  $_SESSION["SavedtitemsMenPreBook2"] = $_POST["txttitemsMenPreBook2"];
  $_SESSION["SavedtitemsMenPreBook3"] = $_POST["txttitemsMenPreBook3"];
  $_SESSION["SavedtitemsMenRptCnt1"] = $_POST["txttitemsMenRptCnt1"];
  $_SESSION["SavedtitemsMenRptCnt2"] = $_POST["txttitemsMenRptCnt2"];
  $_SESSION["SavedtitemsMenRptCnt3"] = $_POST["txttitemsMenRptCnt3"];
  $_SESSION["SavedtitemsMenDigitStart"] = $_POST["txttitemsMenDigitStart"];
  $_SESSION["SavedtitemsMenDigitEnd"] = $_POST["txttitemsMenDigitEnd"];
  $_SESSION["SavedtitemsMenNumStart"] = $_POST["txttitemsMenNumStart"];
  $_SESSION["SavedtitemsMenNumEnd"] = $_POST["txttitemsMenNumEnd"];
  $_SESSION["SavedtitemsMenBookGrade"] = $_POST["txttitemsMenBookGrade"];
  $_SESSION["SavedtitemsSuppNxtBook1"] = $_POST["txttitemsSuppNxtBook1"];
  $_SESSION["SavedtitemsSuppNxtBook2"] = $_POST["txttitemsSuppNxtBook2"];
  $_SESSION["SavedtitemsSuppNxtBook3"] = $_POST["txttitemsSuppNxtBook3"];
  $_SESSION["SavedtitemsSuppPrvBook1"] = $_POST["txttitemsSuppPrvBook1"];
  $_SESSION["SavedtitemsSuppPrvBook2"] = $_POST["txttitemsSuppPrvBook2"];
  $_SESSION["SavedtitemsSuppPrvBook3"] = $_POST["txttitemsSuppPrvBook3"];
  $_SESSION["SavedtitemsSuppPreBook1"] = $_POST["txttitemsSuppPreBook1"];
  $_SESSION["SavedtitemsSuppPreBook2"] = $_POST["txttitemsSuppPreBook2"];
  $_SESSION["SavedtitemsSuppPreBook3"] = $_POST["txttitemsSuppPreBook3"];
  $_SESSION["SavedtitemsSuppRptCnt1"] = $_POST["txttitemsSuppRptCnt1"];
  $_SESSION["SavedtitemsSuppRptCnt2"] = $_POST["txttitemsSuppRptCnt2"];
  $_SESSION["SavedtitemsSuppRptCnt3"] = $_POST["txttitemsSuppRptCnt3"];
  $_SESSION["SavedtitemsSuppDigitStart"] = $_POST["txttitemsSuppDigitStart"];
  $_SESSION["SavedtitemsSuppDigitEnd"] = $_POST["txttitemsSuppDigitEnd"];
  $_SESSION["SavedtitemsSuppNumStart"] = $_POST["txttitemsSuppNumStart"];
  $_SESSION["SavedtitemsSuppNumEnd"] = $_POST["txttitemsSuppNumEnd"];
  $_SESSION["SavedtitemsSuppBookGrade"] = $_POST["txttitemsSuppBookGrade"];
  $_SESSION["SavedtitemsCatID"] = $_POST["txttitemsCatID"];
  $_SESSION["SavedtitemsSubCatID"] = $_POST["txttitemsSubCatID"];
  $_SESSION["SavedtitemsDeptID"] = $_POST["txttitemsDeptID"];
  $_SESSION["SavedtitemsManufacturerID"] = $_POST["txttitemsManufacturerID"];
  $_SESSION["SavedtitemsLocationID"] = $_POST["txttitemsLocationID"];
  $_SESSION["SavedtitemsIssuUntCost"] = $_POST["txttitemsIssuUntCost"];
  $_SESSION["SavedtitemsIssuUntMea"] = $_POST["txttitemsIssuUntMea"];
  $_SESSION["SavedtitemsPurUntCost"] = $_POST["txttitemsPurUntCost"];
  $_SESSION["SavedtitemsReOrderPT"] = $_POST["txttitemsReOrderPT"];
  $_SESSION["SavedtitemsReOrderQty"] = $_POST["txttitemsReOrderQty"];
  $_SESSION["SavedtitemsLastPurVdrID"] = $_POST["txttitemsLastPurVdrID"];
  $_SESSION["SavedtitemsReOrderReq"] = $_POST["txttitemsReOrderReq"];
  $_SESSION["SavedtitemsLstOrderCost"] = $_POST["txttitemsLstOrderCost"];
  $_SESSION["SavedtitemsStdCost"] = $_POST["txttitemsStdCost"];
  $_SESSION["SavedtitemsQtyOnHand"] = $_POST["txttitemsQtyOnHand"];
  $_SESSION["SavedtitemsQtyOnOrder"] = $_POST["txttitemsQtyOnOrder"];
}
else {
  $_SESSION["Updatetitems_InsertFailed"] = 0;
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
unset($oRStitems) ;
$objConn1->Close();
unset($objConn1);
?> 
