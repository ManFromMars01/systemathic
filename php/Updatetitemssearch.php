<?PHP
ob_start();
session_start();
$PageLevel = 0;
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
if (getRequest("SEARCH") == "TRUE"):
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
$myWhere = "";
$FormDeclaration = "";


if (getRequest("txttitemsCountryID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.CountryID LIKE " . chr(39) . getRequest("txttitemsCountryID") . "%" . chr(39);
endif;

if (getRequest("txttitemsBranchID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.BranchID LIKE " . chr(39) . getRequest("txttitemsBranchID") . "%" . chr(39);
endif;

if (getRequest("txttitemsItemNo") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.ItemNo LIKE " . chr(39) . getRequest("txttitemsItemNo") . "%" . chr(39);
endif;

if (getRequest("txttitemsDescription") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.Description LIKE " . chr(39) . getRequest("txttitemsDescription") . "%" . chr(39);
endif;

if (getRequest("txttitemsIsBook") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IsBook LIKE " . chr(39) . getRequest("txttitemsIsBook") . "%" . chr(39);
endif;

if (getRequest("txttitemsIsMultiCat") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IsMultiCat LIKE " . chr(39) . getRequest("txttitemsIsMultiCat") . "%" . chr(39);
endif;

if (getRequest("txttitemsIsAbacus") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IsAbacus LIKE " . chr(39) . getRequest("txttitemsIsAbacus") . "%" . chr(39);
endif;

if (getRequest("txttitemsIsMental") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IsMental LIKE " . chr(39) . getRequest("txttitemsIsMental") . "%" . chr(39);
endif;

if (getRequest("txttitemsIsSupp") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IsSupp LIKE " . chr(39) . getRequest("txttitemsIsSupp") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaDesc") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaDesc LIKE " . chr(39) . getRequest("txttitemsAbaDesc") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenDesc") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenDesc LIKE " . chr(39) . getRequest("txttitemsMenDesc") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppDesc") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppDesc LIKE " . chr(39) . getRequest("txttitemsSuppDesc") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaNxtBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaNxtBook1 LIKE " . chr(39) . getRequest("txttitemsAbaNxtBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaNxtBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaNxtBook2 LIKE " . chr(39) . getRequest("txttitemsAbaNxtBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaNxtBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaNxtBook3 LIKE " . chr(39) . getRequest("txttitemsAbaNxtBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPrvBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPrvBook1 LIKE " . chr(39) . getRequest("txttitemsAbaPrvBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPrvBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPrvBook2 LIKE " . chr(39) . getRequest("txttitemsAbaPrvBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPrvBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPrvBook3 LIKE " . chr(39) . getRequest("txttitemsAbaPrvBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPreBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPreBook1 LIKE " . chr(39) . getRequest("txttitemsAbaPreBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPreBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPreBook2 LIKE " . chr(39) . getRequest("txttitemsAbaPreBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaPreBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaPreBook3 LIKE " . chr(39) . getRequest("txttitemsAbaPreBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsAbaRptCnt1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaRptCnt1 = " . getRequest("txttitemsAbaRptCnt1");
endif;

if (getRequest("txttitemsAbaRptCnt2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaRptCnt2 = " . getRequest("txttitemsAbaRptCnt2");
endif;

if (getRequest("txttitemsAbaRptCnt3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaRptCnt3 = " . getRequest("txttitemsAbaRptCnt3");
endif;

if (getRequest("txttitemsAbaDigitStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaDigitStart = " . getRequest("txttitemsAbaDigitStart");
endif;

if (getRequest("txttitemsAbaDigitEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaDigitEnd = " . getRequest("txttitemsAbaDigitEnd");
endif;

if (getRequest("txttitemsAbaNumStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaNumStart = " . getRequest("txttitemsAbaNumStart");
endif;

if (getRequest("txttitemsAbaNumEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaNumEnd = " . getRequest("txttitemsAbaNumEnd");
endif;

if (getRequest("txttitemsAbaBookGrade") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.AbaBookGrade = " . getRequest("txttitemsAbaBookGrade");
endif;

if (getRequest("txttitemsMenNxtBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenNxtBook1 LIKE " . chr(39) . getRequest("txttitemsMenNxtBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenNxtBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenNxtBook2 LIKE " . chr(39) . getRequest("txttitemsMenNxtBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenNxtBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenNxtBook3 LIKE " . chr(39) . getRequest("txttitemsMenNxtBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPrvBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPrvBook1 LIKE " . chr(39) . getRequest("txttitemsMenPrvBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPrvBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPrvBook2 LIKE " . chr(39) . getRequest("txttitemsMenPrvBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPrvBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPrvBook3 LIKE " . chr(39) . getRequest("txttitemsMenPrvBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPreBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPreBook1 LIKE " . chr(39) . getRequest("txttitemsMenPreBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPreBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPreBook2 LIKE " . chr(39) . getRequest("txttitemsMenPreBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenPreBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenPreBook3 LIKE " . chr(39) . getRequest("txttitemsMenPreBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsMenRptCnt1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenRptCnt1 = " . getRequest("txttitemsMenRptCnt1");
endif;

if (getRequest("txttitemsMenRptCnt2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenRptCnt2 = " . getRequest("txttitemsMenRptCnt2");
endif;

if (getRequest("txttitemsMenRptCnt3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenRptCnt3 = " . getRequest("txttitemsMenRptCnt3");
endif;

if (getRequest("txttitemsMenDigitStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenDigitStart = " . getRequest("txttitemsMenDigitStart");
endif;

if (getRequest("txttitemsMenDigitEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenDigitEnd = " . getRequest("txttitemsMenDigitEnd");
endif;

if (getRequest("txttitemsMenNumStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenNumStart = " . getRequest("txttitemsMenNumStart");
endif;

if (getRequest("txttitemsMenNumEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenNumEnd = " . getRequest("txttitemsMenNumEnd");
endif;

if (getRequest("txttitemsMenBookGrade") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.MenBookGrade = " . getRequest("txttitemsMenBookGrade");
endif;

if (getRequest("txttitemsSuppNxtBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppNxtBook1 LIKE " . chr(39) . getRequest("txttitemsSuppNxtBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppNxtBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppNxtBook2 LIKE " . chr(39) . getRequest("txttitemsSuppNxtBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppNxtBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppNxtBook3 LIKE " . chr(39) . getRequest("txttitemsSuppNxtBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPrvBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPrvBook1 LIKE " . chr(39) . getRequest("txttitemsSuppPrvBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPrvBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPrvBook2 LIKE " . chr(39) . getRequest("txttitemsSuppPrvBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPrvBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPrvBook3 LIKE " . chr(39) . getRequest("txttitemsSuppPrvBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPreBook1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPreBook1 LIKE " . chr(39) . getRequest("txttitemsSuppPreBook1") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPreBook2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPreBook2 LIKE " . chr(39) . getRequest("txttitemsSuppPreBook2") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppPreBook3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppPreBook3 LIKE " . chr(39) . getRequest("txttitemsSuppPreBook3") . "%" . chr(39);
endif;

if (getRequest("txttitemsSuppRptCnt1") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppRptCnt1 = " . getRequest("txttitemsSuppRptCnt1");
endif;

if (getRequest("txttitemsSuppRptCnt2") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppRptCnt2 = " . getRequest("txttitemsSuppRptCnt2");
endif;

if (getRequest("txttitemsSuppRptCnt3") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppRptCnt3 = " . getRequest("txttitemsSuppRptCnt3");
endif;

if (getRequest("txttitemsSuppDigitStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppDigitStart = " . getRequest("txttitemsSuppDigitStart");
endif;

if (getRequest("txttitemsSuppDigitEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppDigitEnd = " . getRequest("txttitemsSuppDigitEnd");
endif;

if (getRequest("txttitemsSuppNumStart") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppNumStart = " . getRequest("txttitemsSuppNumStart");
endif;

if (getRequest("txttitemsSuppNumEnd") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppNumEnd = " . getRequest("txttitemsSuppNumEnd");
endif;

if (getRequest("txttitemsSuppBookGrade") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SuppBookGrade = " . getRequest("txttitemsSuppBookGrade");
endif;

if (getRequest("txttitemsCatID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.CatID LIKE " . chr(39) . getRequest("txttitemsCatID") . "%" . chr(39);
endif;

if (getRequest("txttitemsSubCatID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.SubCatID LIKE " . chr(39) . getRequest("txttitemsSubCatID") . "%" . chr(39);
endif;

if (getRequest("txttitemsDeptID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.DeptID = " . getRequest("txttitemsDeptID");
endif;

if (getRequest("txttitemsManufacturerID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.ManufacturerID = " . getRequest("txttitemsManufacturerID");
endif;

if (getRequest("txttitemsLocationID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.LocationID = " . getRequest("txttitemsLocationID");
endif;

if (getRequest("txttitemsIssuUntCost") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IssuUntCost = " . getRequest("txttitemsIssuUntCost");
endif;

if (getRequest("txttitemsIssuUntMea") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.IssuUntMea LIKE " . chr(39) . getRequest("txttitemsIssuUntMea") . "%" . chr(39);
endif;

if (getRequest("txttitemsPurUntCost") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.PurUntCost = " . getRequest("txttitemsPurUntCost");
endif;

if (getRequest("txttitemsReOrderPT") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.ReOrderPT = " . getRequest("txttitemsReOrderPT");
endif;

if (getRequest("txttitemsReOrderQty") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.ReOrderQty = " . getRequest("txttitemsReOrderQty");
endif;

if (getRequest("txttitemsLastPurVdrID") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.LastPurVdrID = " . getRequest("txttitemsLastPurVdrID");
endif;

if (getRequest("txttitemsReOrderReq") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.ReOrderReq LIKE " . chr(39) . getRequest("txttitemsReOrderReq") . "%" . chr(39);
endif;

if (getRequest("txttitemsLstOrderCost") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.LstOrderCost = " . getRequest("txttitemsLstOrderCost");
endif;

if (getRequest("txttitemsStdCost") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.StdCost = " . getRequest("txttitemsStdCost");
endif;

if (getRequest("txttitemsQtyOnHand") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.QtyOnHand = " . getRequest("txttitemsQtyOnHand");
endif;

if (getRequest("txttitemsQtyOnOrder") == ""):
else:
    if ($myWhere == ""):
    else:
       $myWhere .= " AND ";
    endif;
    $myWhere .= " titems.QtyOnOrder = " . getRequest("txttitemsQtyOnOrder");
endif;
$_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
header("Location: http://".$_SERVER['HTTP_HOST']
                      . $varPath
                      ."/"."BrowseAttendanceStatuslist.php");
endif;
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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStitems = "";


$TemplateText = "";

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

/*
============================================================================
 MergeTemplate 
============================================================================
*/
function MergeSearchTemplate($Template) {
    global $TemplateText;
    global $FormDeclaration;    
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetitems" . "search.htm";
    endif;
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

    $TemplateText = Replace($TemplateText,"@FormDeclaration@",$FormDeclaration);
    global $titemsCountryID;
    $TemplateText = Replace($TemplateText, "@titemsCountryID@", $titemsCountryID);
    global $titemsBranchID;
    $TemplateText = Replace($TemplateText, "@titemsBranchID@", $titemsBranchID);
    global $titemsItemNo;
    $TemplateText = Replace($TemplateText, "@titemsItemNo@", $titemsItemNo);
    global $titemsDescription;
    $TemplateText = Replace($TemplateText, "@titemsDescription@", $titemsDescription);
    global $titemsIsBook;
    $TemplateText = Replace($TemplateText, "@titemsIsBook@", $titemsIsBook);
    global $titemsIsMultiCat;
    $TemplateText = Replace($TemplateText, "@titemsIsMultiCat@", $titemsIsMultiCat);
    global $titemsIsAbacus;
    $TemplateText = Replace($TemplateText, "@titemsIsAbacus@", $titemsIsAbacus);
    global $titemsIsMental;
    $TemplateText = Replace($TemplateText, "@titemsIsMental@", $titemsIsMental);
    global $titemsIsSupp;
    $TemplateText = Replace($TemplateText, "@titemsIsSupp@", $titemsIsSupp);
    global $titemsAbaDesc;
    $TemplateText = Replace($TemplateText, "@titemsAbaDesc@", $titemsAbaDesc);
    global $titemsMenDesc;
    $TemplateText = Replace($TemplateText, "@titemsMenDesc@", $titemsMenDesc);
    global $titemsSuppDesc;
    $TemplateText = Replace($TemplateText, "@titemsSuppDesc@", $titemsSuppDesc);
    global $titemsAbaNxtBook1;
    $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook1@", $titemsAbaNxtBook1);
    global $titemsAbaNxtBook2;
    $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook2@", $titemsAbaNxtBook2);
    global $titemsAbaNxtBook3;
    $TemplateText = Replace($TemplateText, "@titemsAbaNxtBook3@", $titemsAbaNxtBook3);
    global $titemsAbaPrvBook1;
    $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook1@", $titemsAbaPrvBook1);
    global $titemsAbaPrvBook2;
    $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook2@", $titemsAbaPrvBook2);
    global $titemsAbaPrvBook3;
    $TemplateText = Replace($TemplateText, "@titemsAbaPrvBook3@", $titemsAbaPrvBook3);
    global $titemsAbaPreBook1;
    $TemplateText = Replace($TemplateText, "@titemsAbaPreBook1@", $titemsAbaPreBook1);
    global $titemsAbaPreBook2;
    $TemplateText = Replace($TemplateText, "@titemsAbaPreBook2@", $titemsAbaPreBook2);
    global $titemsAbaPreBook3;
    $TemplateText = Replace($TemplateText, "@titemsAbaPreBook3@", $titemsAbaPreBook3);
    global $titemsAbaRptCnt1;
    $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt1@", $titemsAbaRptCnt1);
    global $titemsAbaRptCnt2;
    $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt2@", $titemsAbaRptCnt2);
    global $titemsAbaRptCnt3;
    $TemplateText = Replace($TemplateText, "@titemsAbaRptCnt3@", $titemsAbaRptCnt3);
    global $titemsAbaDigitStart;
    $TemplateText = Replace($TemplateText, "@titemsAbaDigitStart@", $titemsAbaDigitStart);
    global $titemsAbaDigitEnd;
    $TemplateText = Replace($TemplateText, "@titemsAbaDigitEnd@", $titemsAbaDigitEnd);
    global $titemsAbaNumStart;
    $TemplateText = Replace($TemplateText, "@titemsAbaNumStart@", $titemsAbaNumStart);
    global $titemsAbaNumEnd;
    $TemplateText = Replace($TemplateText, "@titemsAbaNumEnd@", $titemsAbaNumEnd);
    global $titemsAbaBookGrade;
    $TemplateText = Replace($TemplateText, "@titemsAbaBookGrade@", $titemsAbaBookGrade);
    global $titemsMenNxtBook1;
    $TemplateText = Replace($TemplateText, "@titemsMenNxtBook1@", $titemsMenNxtBook1);
    global $titemsMenNxtBook2;
    $TemplateText = Replace($TemplateText, "@titemsMenNxtBook2@", $titemsMenNxtBook2);
    global $titemsMenNxtBook3;
    $TemplateText = Replace($TemplateText, "@titemsMenNxtBook3@", $titemsMenNxtBook3);
    global $titemsMenPrvBook1;
    $TemplateText = Replace($TemplateText, "@titemsMenPrvBook1@", $titemsMenPrvBook1);
    global $titemsMenPrvBook2;
    $TemplateText = Replace($TemplateText, "@titemsMenPrvBook2@", $titemsMenPrvBook2);
    global $titemsMenPrvBook3;
    $TemplateText = Replace($TemplateText, "@titemsMenPrvBook3@", $titemsMenPrvBook3);
    global $titemsMenPreBook1;
    $TemplateText = Replace($TemplateText, "@titemsMenPreBook1@", $titemsMenPreBook1);
    global $titemsMenPreBook2;
    $TemplateText = Replace($TemplateText, "@titemsMenPreBook2@", $titemsMenPreBook2);
    global $titemsMenPreBook3;
    $TemplateText = Replace($TemplateText, "@titemsMenPreBook3@", $titemsMenPreBook3);
    global $titemsMenRptCnt1;
    $TemplateText = Replace($TemplateText, "@titemsMenRptCnt1@", $titemsMenRptCnt1);
    global $titemsMenRptCnt2;
    $TemplateText = Replace($TemplateText, "@titemsMenRptCnt2@", $titemsMenRptCnt2);
    global $titemsMenRptCnt3;
    $TemplateText = Replace($TemplateText, "@titemsMenRptCnt3@", $titemsMenRptCnt3);
    global $titemsMenDigitStart;
    $TemplateText = Replace($TemplateText, "@titemsMenDigitStart@", $titemsMenDigitStart);
    global $titemsMenDigitEnd;
    $TemplateText = Replace($TemplateText, "@titemsMenDigitEnd@", $titemsMenDigitEnd);
    global $titemsMenNumStart;
    $TemplateText = Replace($TemplateText, "@titemsMenNumStart@", $titemsMenNumStart);
    global $titemsMenNumEnd;
    $TemplateText = Replace($TemplateText, "@titemsMenNumEnd@", $titemsMenNumEnd);
    global $titemsMenBookGrade;
    $TemplateText = Replace($TemplateText, "@titemsMenBookGrade@", $titemsMenBookGrade);
    global $titemsSuppNxtBook1;
    $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook1@", $titemsSuppNxtBook1);
    global $titemsSuppNxtBook2;
    $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook2@", $titemsSuppNxtBook2);
    global $titemsSuppNxtBook3;
    $TemplateText = Replace($TemplateText, "@titemsSuppNxtBook3@", $titemsSuppNxtBook3);
    global $titemsSuppPrvBook1;
    $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook1@", $titemsSuppPrvBook1);
    global $titemsSuppPrvBook2;
    $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook2@", $titemsSuppPrvBook2);
    global $titemsSuppPrvBook3;
    $TemplateText = Replace($TemplateText, "@titemsSuppPrvBook3@", $titemsSuppPrvBook3);
    global $titemsSuppPreBook1;
    $TemplateText = Replace($TemplateText, "@titemsSuppPreBook1@", $titemsSuppPreBook1);
    global $titemsSuppPreBook2;
    $TemplateText = Replace($TemplateText, "@titemsSuppPreBook2@", $titemsSuppPreBook2);
    global $titemsSuppPreBook3;
    $TemplateText = Replace($TemplateText, "@titemsSuppPreBook3@", $titemsSuppPreBook3);
    global $titemsSuppRptCnt1;
    $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt1@", $titemsSuppRptCnt1);
    global $titemsSuppRptCnt2;
    $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt2@", $titemsSuppRptCnt2);
    global $titemsSuppRptCnt3;
    $TemplateText = Replace($TemplateText, "@titemsSuppRptCnt3@", $titemsSuppRptCnt3);
    global $titemsSuppDigitStart;
    $TemplateText = Replace($TemplateText, "@titemsSuppDigitStart@", $titemsSuppDigitStart);
    global $titemsSuppDigitEnd;
    $TemplateText = Replace($TemplateText, "@titemsSuppDigitEnd@", $titemsSuppDigitEnd);
    global $titemsSuppNumStart;
    $TemplateText = Replace($TemplateText, "@titemsSuppNumStart@", $titemsSuppNumStart);
    global $titemsSuppNumEnd;
    $TemplateText = Replace($TemplateText, "@titemsSuppNumEnd@", $titemsSuppNumEnd);
    global $titemsSuppBookGrade;
    $TemplateText = Replace($TemplateText, "@titemsSuppBookGrade@", $titemsSuppBookGrade);
    global $titemsCatID;
    $TemplateText = Replace($TemplateText, "@titemsCatID@", $titemsCatID);
    global $titemsSubCatID;
    $TemplateText = Replace($TemplateText, "@titemsSubCatID@", $titemsSubCatID);
    global $titemsDeptID;
    $TemplateText = Replace($TemplateText, "@titemsDeptID@", $titemsDeptID);
    global $titemsManufacturerID;
    $TemplateText = Replace($TemplateText, "@titemsManufacturerID@", $titemsManufacturerID);
    global $titemsLocationID;
    $TemplateText = Replace($TemplateText, "@titemsLocationID@", $titemsLocationID);
    global $titemsIssuUntCost;
    $TemplateText = Replace($TemplateText, "@titemsIssuUntCost@", $titemsIssuUntCost);
    global $titemsIssuUntMea;
    $TemplateText = Replace($TemplateText, "@titemsIssuUntMea@", $titemsIssuUntMea);
    global $titemsPurUntCost;
    $TemplateText = Replace($TemplateText, "@titemsPurUntCost@", $titemsPurUntCost);
    global $titemsReOrderPT;
    $TemplateText = Replace($TemplateText, "@titemsReOrderPT@", $titemsReOrderPT);
    global $titemsReOrderQty;
    $TemplateText = Replace($TemplateText, "@titemsReOrderQty@", $titemsReOrderQty);
    global $titemsLastPurVdrID;
    $TemplateText = Replace($TemplateText, "@titemsLastPurVdrID@", $titemsLastPurVdrID);
    global $titemsReOrderReq;
    $TemplateText = Replace($TemplateText, "@titemsReOrderReq@", $titemsReOrderReq);
    global $titemsLstOrderCost;
    $TemplateText = Replace($TemplateText, "@titemsLstOrderCost@", $titemsLstOrderCost);
    global $titemsStdCost;
    $TemplateText = Replace($TemplateText, "@titemsStdCost@", $titemsStdCost);
    global $titemsQtyOnHand;
    $TemplateText = Replace($TemplateText, "@titemsQtyOnHand@", $titemsQtyOnHand);
    global $titemsQtyOnOrder;
    $TemplateText = Replace($TemplateText, "@titemsQtyOnOrder@", $titemsQtyOnOrder);
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print $TemplateText;
}

$DisplayText = "";
if (getRequest("SEARCH") == "TRUE"):
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\"BrowseAttendanceStatuslist.php\">";
else:
$FormDeclaration = "<form name=\"form1\" id=\"form1\" method=\"POST\" action=\""; 
$FormDeclaration .=  "Updatetitems" . "search.php". "\">" . "\n<input type=\"HIDDEN\" id=\"SEARCH\" name=\"SEARCH\" value=\"TRUE\">";
endif;
MergeSearchTemplate($HTML_Template);
unset($oRStitems);
ob_flush();
?>
