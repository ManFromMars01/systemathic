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
$HTML_Template = getRequest("HTMLT");
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdatetitemsFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updatetitemsadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdatetitemsFormAction@",$UpdatetitemsFormAction);    
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

    global $titemsCountryID;
    $TemplateText = Replace($TemplateText,"@titemsCountryID@",$titemsCountryID);            
    global $titemsBranchID;
    $TemplateText = Replace($TemplateText,"@titemsBranchID@",$titemsBranchID);            
    global $titemsItemNo;
    $TemplateText = Replace($TemplateText,"@titemsItemNo@",$titemsItemNo);            
    global $titemsDescription;
    $TemplateText = Replace($TemplateText,"@titemsDescription@",$titemsDescription);            
    global $titemsIsBook;
    $TemplateText = Replace($TemplateText,"@titemsIsBook@",$titemsIsBook);            
    global $titemsIsMultiCat;
    $TemplateText = Replace($TemplateText,"@titemsIsMultiCat@",$titemsIsMultiCat);            
    global $titemsIsAbacus;
    $TemplateText = Replace($TemplateText,"@titemsIsAbacus@",$titemsIsAbacus);            
    global $titemsIsMental;
    $TemplateText = Replace($TemplateText,"@titemsIsMental@",$titemsIsMental);            
    global $titemsIsSupp;
    $TemplateText = Replace($TemplateText,"@titemsIsSupp@",$titemsIsSupp);            
    global $titemsAbaDesc;
    $TemplateText = Replace($TemplateText,"@titemsAbaDesc@",$titemsAbaDesc);            
    global $titemsMenDesc;
    $TemplateText = Replace($TemplateText,"@titemsMenDesc@",$titemsMenDesc);            
    global $titemsSuppDesc;
    $TemplateText = Replace($TemplateText,"@titemsSuppDesc@",$titemsSuppDesc);            
    global $titemsAbaNxtBook1;
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook1@",$titemsAbaNxtBook1);            
    global $titemsAbaNxtBook2;
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook2@",$titemsAbaNxtBook2);            
    global $titemsAbaNxtBook3;
    $TemplateText = Replace($TemplateText,"@titemsAbaNxtBook3@",$titemsAbaNxtBook3);            
    global $titemsAbaPrvBook1;
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook1@",$titemsAbaPrvBook1);            
    global $titemsAbaPrvBook2;
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook2@",$titemsAbaPrvBook2);            
    global $titemsAbaPrvBook3;
    $TemplateText = Replace($TemplateText,"@titemsAbaPrvBook3@",$titemsAbaPrvBook3);            
    global $titemsAbaPreBook1;
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook1@",$titemsAbaPreBook1);            
    global $titemsAbaPreBook2;
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook2@",$titemsAbaPreBook2);            
    global $titemsAbaPreBook3;
    $TemplateText = Replace($TemplateText,"@titemsAbaPreBook3@",$titemsAbaPreBook3);            
    global $titemsAbaRptCnt1;
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt1@",$titemsAbaRptCnt1);            
    global $titemsAbaRptCnt2;
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt2@",$titemsAbaRptCnt2);            
    global $titemsAbaRptCnt3;
    $TemplateText = Replace($TemplateText,"@titemsAbaRptCnt3@",$titemsAbaRptCnt3);            
    global $titemsAbaDigitStart;
    $TemplateText = Replace($TemplateText,"@titemsAbaDigitStart@",$titemsAbaDigitStart);            
    global $titemsAbaDigitEnd;
    $TemplateText = Replace($TemplateText,"@titemsAbaDigitEnd@",$titemsAbaDigitEnd);            
    global $titemsAbaNumStart;
    $TemplateText = Replace($TemplateText,"@titemsAbaNumStart@",$titemsAbaNumStart);            
    global $titemsAbaNumEnd;
    $TemplateText = Replace($TemplateText,"@titemsAbaNumEnd@",$titemsAbaNumEnd);            
    global $titemsAbaBookGrade;
    $TemplateText = Replace($TemplateText,"@titemsAbaBookGrade@",$titemsAbaBookGrade);            
    global $titemsMenNxtBook1;
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook1@",$titemsMenNxtBook1);            
    global $titemsMenNxtBook2;
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook2@",$titemsMenNxtBook2);            
    global $titemsMenNxtBook3;
    $TemplateText = Replace($TemplateText,"@titemsMenNxtBook3@",$titemsMenNxtBook3);            
    global $titemsMenPrvBook1;
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook1@",$titemsMenPrvBook1);            
    global $titemsMenPrvBook2;
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook2@",$titemsMenPrvBook2);            
    global $titemsMenPrvBook3;
    $TemplateText = Replace($TemplateText,"@titemsMenPrvBook3@",$titemsMenPrvBook3);            
    global $titemsMenPreBook1;
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook1@",$titemsMenPreBook1);            
    global $titemsMenPreBook2;
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook2@",$titemsMenPreBook2);            
    global $titemsMenPreBook3;
    $TemplateText = Replace($TemplateText,"@titemsMenPreBook3@",$titemsMenPreBook3);            
    global $titemsMenRptCnt1;
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt1@",$titemsMenRptCnt1);            
    global $titemsMenRptCnt2;
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt2@",$titemsMenRptCnt2);            
    global $titemsMenRptCnt3;
    $TemplateText = Replace($TemplateText,"@titemsMenRptCnt3@",$titemsMenRptCnt3);            
    global $titemsMenDigitStart;
    $TemplateText = Replace($TemplateText,"@titemsMenDigitStart@",$titemsMenDigitStart);            
    global $titemsMenDigitEnd;
    $TemplateText = Replace($TemplateText,"@titemsMenDigitEnd@",$titemsMenDigitEnd);            
    global $titemsMenNumStart;
    $TemplateText = Replace($TemplateText,"@titemsMenNumStart@",$titemsMenNumStart);            
    global $titemsMenNumEnd;
    $TemplateText = Replace($TemplateText,"@titemsMenNumEnd@",$titemsMenNumEnd);            
    global $titemsMenBookGrade;
    $TemplateText = Replace($TemplateText,"@titemsMenBookGrade@",$titemsMenBookGrade);            
    global $titemsSuppNxtBook1;
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook1@",$titemsSuppNxtBook1);            
    global $titemsSuppNxtBook2;
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook2@",$titemsSuppNxtBook2);            
    global $titemsSuppNxtBook3;
    $TemplateText = Replace($TemplateText,"@titemsSuppNxtBook3@",$titemsSuppNxtBook3);            
    global $titemsSuppPrvBook1;
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook1@",$titemsSuppPrvBook1);            
    global $titemsSuppPrvBook2;
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook2@",$titemsSuppPrvBook2);            
    global $titemsSuppPrvBook3;
    $TemplateText = Replace($TemplateText,"@titemsSuppPrvBook3@",$titemsSuppPrvBook3);            
    global $titemsSuppPreBook1;
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook1@",$titemsSuppPreBook1);            
    global $titemsSuppPreBook2;
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook2@",$titemsSuppPreBook2);            
    global $titemsSuppPreBook3;
    $TemplateText = Replace($TemplateText,"@titemsSuppPreBook3@",$titemsSuppPreBook3);            
    global $titemsSuppRptCnt1;
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt1@",$titemsSuppRptCnt1);            
    global $titemsSuppRptCnt2;
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt2@",$titemsSuppRptCnt2);            
    global $titemsSuppRptCnt3;
    $TemplateText = Replace($TemplateText,"@titemsSuppRptCnt3@",$titemsSuppRptCnt3);            
    global $titemsSuppDigitStart;
    $TemplateText = Replace($TemplateText,"@titemsSuppDigitStart@",$titemsSuppDigitStart);            
    global $titemsSuppDigitEnd;
    $TemplateText = Replace($TemplateText,"@titemsSuppDigitEnd@",$titemsSuppDigitEnd);            
    global $titemsSuppNumStart;
    $TemplateText = Replace($TemplateText,"@titemsSuppNumStart@",$titemsSuppNumStart);            
    global $titemsSuppNumEnd;
    $TemplateText = Replace($TemplateText,"@titemsSuppNumEnd@",$titemsSuppNumEnd);            
    global $titemsSuppBookGrade;
    $TemplateText = Replace($TemplateText,"@titemsSuppBookGrade@",$titemsSuppBookGrade);            
    global $titemsCatID;
    $TemplateText = Replace($TemplateText,"@titemsCatID@",$titemsCatID);            
    global $titemsSubCatID;
    $TemplateText = Replace($TemplateText,"@titemsSubCatID@",$titemsSubCatID);            
    global $titemsDeptID;
    $TemplateText = Replace($TemplateText,"@titemsDeptID@",$titemsDeptID);            
    global $titemsManufacturerID;
    $TemplateText = Replace($TemplateText,"@titemsManufacturerID@",$titemsManufacturerID);            
    global $titemsLocationID;
    $TemplateText = Replace($TemplateText,"@titemsLocationID@",$titemsLocationID);            
    global $titemsIssuUntCost;
    $TemplateText = Replace($TemplateText,"@titemsIssuUntCost@",$titemsIssuUntCost);            
    global $titemsIssuUntMea;
    $TemplateText = Replace($TemplateText,"@titemsIssuUntMea@",$titemsIssuUntMea);            
    global $titemsPurUntCost;
    $TemplateText = Replace($TemplateText,"@titemsPurUntCost@",$titemsPurUntCost);            
    global $titemsReOrderPT;
    $TemplateText = Replace($TemplateText,"@titemsReOrderPT@",$titemsReOrderPT);            
    global $titemsReOrderQty;
    $TemplateText = Replace($TemplateText,"@titemsReOrderQty@",$titemsReOrderQty);            
    global $titemsLastPurVdrID;
    $TemplateText = Replace($TemplateText,"@titemsLastPurVdrID@",$titemsLastPurVdrID);            
    global $titemsReOrderReq;
    $TemplateText = Replace($TemplateText,"@titemsReOrderReq@",$titemsReOrderReq);            
    global $titemsLstOrderCost;
    $TemplateText = Replace($TemplateText,"@titemsLstOrderCost@",$titemsLstOrderCost);            
    global $titemsStdCost;
    $TemplateText = Replace($TemplateText,"@titemsStdCost@",$titemsStdCost);            
    global $titemsQtyOnHand;
    $TemplateText = Replace($TemplateText,"@titemsQtyOnHand@",$titemsQtyOnHand);            
    global $titemsQtyOnOrder;
    $TemplateText = Replace($TemplateText,"@titemsQtyOnOrder@",$titemsQtyOnOrder);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);

    $CountryID = $_SESSION["UserValue1"];
    $BranchID =  $_SESSION["UserValue2"];
    $TemplateText = Replace($TemplateText, "@CountryID@", $CountryID);
    $TemplateText = Replace($TemplateText, "@BranchID@", $BranchID);
    include('template/item_variables.php');

    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdatetitemsFormAction = "Updatetitemsaddx.php";
$titemsCountryID  = getRequest("txttitemsCountryID");
$titemsBranchID  = getRequest("txttitemsBranchID");
$titemsItemNo  = getRequest("txttitemsItemNo");
$titemsDescription  = getRequest("txttitemsDescription");
$titemsIsBook  = getRequest("txttitemsIsBook");
$titemsIsMultiCat  = getRequest("txttitemsIsMultiCat");
$titemsIsAbacus  = getRequest("txttitemsIsAbacus");
$titemsIsMental  = getRequest("txttitemsIsMental");
$titemsIsSupp  = getRequest("txttitemsIsSupp");
$titemsAbaDesc  = getRequest("txttitemsAbaDesc");
$titemsMenDesc  = getRequest("txttitemsMenDesc");
$titemsSuppDesc  = getRequest("txttitemsSuppDesc");
$titemsAbaNxtBook1  = getRequest("txttitemsAbaNxtBook1");
$titemsAbaNxtBook2  = getRequest("txttitemsAbaNxtBook2");
$titemsAbaNxtBook3  = getRequest("txttitemsAbaNxtBook3");
$titemsAbaPrvBook1  = getRequest("txttitemsAbaPrvBook1");
$titemsAbaPrvBook2  = getRequest("txttitemsAbaPrvBook2");
$titemsAbaPrvBook3  = getRequest("txttitemsAbaPrvBook3");
$titemsAbaPreBook1  = getRequest("txttitemsAbaPreBook1");
$titemsAbaPreBook2  = getRequest("txttitemsAbaPreBook2");
$titemsAbaPreBook3  = getRequest("txttitemsAbaPreBook3");
$titemsAbaRptCnt1  = getRequest("txttitemsAbaRptCnt1");
$titemsAbaRptCnt2  = getRequest("txttitemsAbaRptCnt2");
$titemsAbaRptCnt3  = getRequest("txttitemsAbaRptCnt3");
$titemsAbaDigitStart  = getRequest("txttitemsAbaDigitStart");
$titemsAbaDigitEnd  = getRequest("txttitemsAbaDigitEnd");
$titemsAbaNumStart  = getRequest("txttitemsAbaNumStart");
$titemsAbaNumEnd  = getRequest("txttitemsAbaNumEnd");
$titemsAbaBookGrade  = getRequest("txttitemsAbaBookGrade");
$titemsMenNxtBook1  = getRequest("txttitemsMenNxtBook1");
$titemsMenNxtBook2  = getRequest("txttitemsMenNxtBook2");
$titemsMenNxtBook3  = getRequest("txttitemsMenNxtBook3");
$titemsMenPrvBook1  = getRequest("txttitemsMenPrvBook1");
$titemsMenPrvBook2  = getRequest("txttitemsMenPrvBook2");
$titemsMenPrvBook3  = getRequest("txttitemsMenPrvBook3");
$titemsMenPreBook1  = getRequest("txttitemsMenPreBook1");
$titemsMenPreBook2  = getRequest("txttitemsMenPreBook2");
$titemsMenPreBook3  = getRequest("txttitemsMenPreBook3");
$titemsMenRptCnt1  = getRequest("txttitemsMenRptCnt1");
$titemsMenRptCnt2  = getRequest("txttitemsMenRptCnt2");
$titemsMenRptCnt3  = getRequest("txttitemsMenRptCnt3");
$titemsMenDigitStart  = getRequest("txttitemsMenDigitStart");
$titemsMenDigitEnd  = getRequest("txttitemsMenDigitEnd");
$titemsMenNumStart  = getRequest("txttitemsMenNumStart");
$titemsMenNumEnd  = getRequest("txttitemsMenNumEnd");
$titemsMenBookGrade  = getRequest("txttitemsMenBookGrade");
$titemsSuppNxtBook1  = getRequest("txttitemsSuppNxtBook1");
$titemsSuppNxtBook2  = getRequest("txttitemsSuppNxtBook2");
$titemsSuppNxtBook3  = getRequest("txttitemsSuppNxtBook3");
$titemsSuppPrvBook1  = getRequest("txttitemsSuppPrvBook1");
$titemsSuppPrvBook2  = getRequest("txttitemsSuppPrvBook2");
$titemsSuppPrvBook3  = getRequest("txttitemsSuppPrvBook3");
$titemsSuppPreBook1  = getRequest("txttitemsSuppPreBook1");
$titemsSuppPreBook2  = getRequest("txttitemsSuppPreBook2");
$titemsSuppPreBook3  = getRequest("txttitemsSuppPreBook3");
$titemsSuppRptCnt1  = getRequest("txttitemsSuppRptCnt1");
$titemsSuppRptCnt2  = getRequest("txttitemsSuppRptCnt2");
$titemsSuppRptCnt3  = getRequest("txttitemsSuppRptCnt3");
$titemsSuppDigitStart  = getRequest("txttitemsSuppDigitStart");
$titemsSuppDigitEnd  = getRequest("txttitemsSuppDigitEnd");
$titemsSuppNumStart  = getRequest("txttitemsSuppNumStart");
$titemsSuppNumEnd  = getRequest("txttitemsSuppNumEnd");
$titemsSuppBookGrade  = getRequest("txttitemsSuppBookGrade");
$titemsCatID  = getRequest("txttitemsCatID");
$titemsSubCatID  = getRequest("txttitemsSubCatID");
$titemsDeptID  = getRequest("txttitemsDeptID");
$titemsManufacturerID  = getRequest("txttitemsManufacturerID");
$titemsLocationID  = getRequest("txttitemsLocationID");
$titemsIssuUntCost  = getRequest("txttitemsIssuUntCost");
$titemsIssuUntMea  = getRequest("txttitemsIssuUntMea");
$titemsPurUntCost  = getRequest("txttitemsPurUntCost");
$titemsReOrderPT  = getRequest("txttitemsReOrderPT");
$titemsReOrderQty  = getRequest("txttitemsReOrderQty");
$titemsLastPurVdrID  = getRequest("txttitemsLastPurVdrID");
$titemsReOrderReq  = getRequest("txttitemsReOrderReq");
$titemsLstOrderCost  = getRequest("txttitemsLstOrderCost");
$titemsStdCost  = getRequest("txttitemsStdCost");
$titemsQtyOnHand  = getRequest("txttitemsQtyOnHand");
$titemsQtyOnOrder  = getRequest("txttitemsQtyOnOrder");

if ($_SESSION["Updatetitems_InsertFailed"] == 1) {
   $titemsCountryID = $_SESSION["SavedtitemsCountryID"];
   $titemsBranchID = $_SESSION["SavedtitemsBranchID"];
   $titemsItemNo = $_SESSION["SavedtitemsItemNo"];
   $titemsDescription = $_SESSION["SavedtitemsDescription"];
   $titemsIsBook = $_SESSION["SavedtitemsIsBook"];
   $titemsIsMultiCat = $_SESSION["SavedtitemsIsMultiCat"];
   $titemsIsAbacus = $_SESSION["SavedtitemsIsAbacus"];
   $titemsIsMental = $_SESSION["SavedtitemsIsMental"];
   $titemsIsSupp = $_SESSION["SavedtitemsIsSupp"];
   $titemsAbaDesc = $_SESSION["SavedtitemsAbaDesc"];
   $titemsMenDesc = $_SESSION["SavedtitemsMenDesc"];
   $titemsSuppDesc = $_SESSION["SavedtitemsSuppDesc"];
   $titemsAbaNxtBook1 = $_SESSION["SavedtitemsAbaNxtBook1"];
   $titemsAbaNxtBook2 = $_SESSION["SavedtitemsAbaNxtBook2"];
   $titemsAbaNxtBook3 = $_SESSION["SavedtitemsAbaNxtBook3"];
   $titemsAbaPrvBook1 = $_SESSION["SavedtitemsAbaPrvBook1"];
   $titemsAbaPrvBook2 = $_SESSION["SavedtitemsAbaPrvBook2"];
   $titemsAbaPrvBook3 = $_SESSION["SavedtitemsAbaPrvBook3"];
   $titemsAbaPreBook1 = $_SESSION["SavedtitemsAbaPreBook1"];
   $titemsAbaPreBook2 = $_SESSION["SavedtitemsAbaPreBook2"];
   $titemsAbaPreBook3 = $_SESSION["SavedtitemsAbaPreBook3"];
   $titemsAbaRptCnt1 = $_SESSION["SavedtitemsAbaRptCnt1"];
   $titemsAbaRptCnt2 = $_SESSION["SavedtitemsAbaRptCnt2"];
   $titemsAbaRptCnt3 = $_SESSION["SavedtitemsAbaRptCnt3"];
   $titemsAbaDigitStart = $_SESSION["SavedtitemsAbaDigitStart"];
   $titemsAbaDigitEnd = $_SESSION["SavedtitemsAbaDigitEnd"];
   $titemsAbaNumStart = $_SESSION["SavedtitemsAbaNumStart"];
   $titemsAbaNumEnd = $_SESSION["SavedtitemsAbaNumEnd"];
   $titemsAbaBookGrade = $_SESSION["SavedtitemsAbaBookGrade"];
   $titemsMenNxtBook1 = $_SESSION["SavedtitemsMenNxtBook1"];
   $titemsMenNxtBook2 = $_SESSION["SavedtitemsMenNxtBook2"];
   $titemsMenNxtBook3 = $_SESSION["SavedtitemsMenNxtBook3"];
   $titemsMenPrvBook1 = $_SESSION["SavedtitemsMenPrvBook1"];
   $titemsMenPrvBook2 = $_SESSION["SavedtitemsMenPrvBook2"];
   $titemsMenPrvBook3 = $_SESSION["SavedtitemsMenPrvBook3"];
   $titemsMenPreBook1 = $_SESSION["SavedtitemsMenPreBook1"];
   $titemsMenPreBook2 = $_SESSION["SavedtitemsMenPreBook2"];
   $titemsMenPreBook3 = $_SESSION["SavedtitemsMenPreBook3"];
   $titemsMenRptCnt1 = $_SESSION["SavedtitemsMenRptCnt1"];
   $titemsMenRptCnt2 = $_SESSION["SavedtitemsMenRptCnt2"];
   $titemsMenRptCnt3 = $_SESSION["SavedtitemsMenRptCnt3"];
   $titemsMenDigitStart = $_SESSION["SavedtitemsMenDigitStart"];
   $titemsMenDigitEnd = $_SESSION["SavedtitemsMenDigitEnd"];
   $titemsMenNumStart = $_SESSION["SavedtitemsMenNumStart"];
   $titemsMenNumEnd = $_SESSION["SavedtitemsMenNumEnd"];
   $titemsMenBookGrade = $_SESSION["SavedtitemsMenBookGrade"];
   $titemsSuppNxtBook1 = $_SESSION["SavedtitemsSuppNxtBook1"];
   $titemsSuppNxtBook2 = $_SESSION["SavedtitemsSuppNxtBook2"];
   $titemsSuppNxtBook3 = $_SESSION["SavedtitemsSuppNxtBook3"];
   $titemsSuppPrvBook1 = $_SESSION["SavedtitemsSuppPrvBook1"];
   $titemsSuppPrvBook2 = $_SESSION["SavedtitemsSuppPrvBook2"];
   $titemsSuppPrvBook3 = $_SESSION["SavedtitemsSuppPrvBook3"];
   $titemsSuppPreBook1 = $_SESSION["SavedtitemsSuppPreBook1"];
   $titemsSuppPreBook2 = $_SESSION["SavedtitemsSuppPreBook2"];
   $titemsSuppPreBook3 = $_SESSION["SavedtitemsSuppPreBook3"];
   $titemsSuppRptCnt1 = $_SESSION["SavedtitemsSuppRptCnt1"];
   $titemsSuppRptCnt2 = $_SESSION["SavedtitemsSuppRptCnt2"];
   $titemsSuppRptCnt3 = $_SESSION["SavedtitemsSuppRptCnt3"];
   $titemsSuppDigitStart = $_SESSION["SavedtitemsSuppDigitStart"];
   $titemsSuppDigitEnd = $_SESSION["SavedtitemsSuppDigitEnd"];
   $titemsSuppNumStart = $_SESSION["SavedtitemsSuppNumStart"];
   $titemsSuppNumEnd = $_SESSION["SavedtitemsSuppNumEnd"];
   $titemsSuppBookGrade = $_SESSION["SavedtitemsSuppBookGrade"];
   $titemsCatID = $_SESSION["SavedtitemsCatID"];
   $titemsSubCatID = $_SESSION["SavedtitemsSubCatID"];
   $titemsDeptID = $_SESSION["SavedtitemsDeptID"];
   $titemsManufacturerID = $_SESSION["SavedtitemsManufacturerID"];
   $titemsLocationID = $_SESSION["SavedtitemsLocationID"];
   $titemsIssuUntCost = $_SESSION["SavedtitemsIssuUntCost"];
   $titemsIssuUntMea = $_SESSION["SavedtitemsIssuUntMea"];
   $titemsPurUntCost = $_SESSION["SavedtitemsPurUntCost"];
   $titemsReOrderPT = $_SESSION["SavedtitemsReOrderPT"];
   $titemsReOrderQty = $_SESSION["SavedtitemsReOrderQty"];
   $titemsLastPurVdrID = $_SESSION["SavedtitemsLastPurVdrID"];
   $titemsReOrderReq = $_SESSION["SavedtitemsReOrderReq"];
   $titemsLstOrderCost = $_SESSION["SavedtitemsLstOrderCost"];
   $titemsStdCost = $_SESSION["SavedtitemsStdCost"];
   $titemsQtyOnHand = $_SESSION["SavedtitemsQtyOnHand"];
   $titemsQtyOnOrder = $_SESSION["SavedtitemsQtyOnOrder"];
}

MergeAddTemplate($HTML_Template);
unset($oRStitems);
$objConn1->Close();
unset($objConn1);
?>
