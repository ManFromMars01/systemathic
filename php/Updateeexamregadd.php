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
    global $UpdateeexamregFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updateeexamregadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdateeexamregFormAction@",$UpdateeexamregFormAction);    
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

    global $eexamregCountryID;
    $TemplateText = Replace($TemplateText,"@eexamregCountryID@",$eexamregCountryID);            
    global $eexamregBranchID;
    $TemplateText = Replace($TemplateText,"@eexamregBranchID@",$eexamregBranchID);            
    global $eexamregDate;
    $TemplateText = Replace($TemplateText,"@eexamregDate@",$eexamregDate);            
    global $eexamregCustNo;
    $TemplateText = Replace($TemplateText,"@eexamregCustNo@",$eexamregCustNo);            
    global $eexamregCateg;
    $TemplateText = Replace($TemplateText,"@eexamregCateg@",$eexamregCateg);            
    global $eexamregCateg2;
    $TemplateText = Replace($TemplateText,"@eexamregCateg2@",$eexamregCateg2);            
    global $eexamregCateg3;
    $TemplateText = Replace($TemplateText,"@eexamregCateg3@",$eexamregCateg3);            
    global $eexamregGrade;
    $TemplateText = Replace($TemplateText,"@eexamregGrade@",$eexamregGrade);            
    global $eexamregGrade2;
    $TemplateText = Replace($TemplateText,"@eexamregGrade2@",$eexamregGrade2);            
    global $eexamregDigit;
    $TemplateText = Replace($TemplateText,"@eexamregDigit@",$eexamregDigit);            
    global $eexamregNumber;
    $TemplateText = Replace($TemplateText,"@eexamregNumber@",$eexamregNumber);            
    global $eexamregMenFee;
    $TemplateText = Replace($TemplateText,"@eexamregMenFee@",$eexamregMenFee);            
    global $eexamregAbaFee;
    $TemplateText = Replace($TemplateText,"@eexamregAbaFee@",$eexamregAbaFee);            
    global $eexamregAurFee;
    $TemplateText = Replace($TemplateText,"@eexamregAurFee@",$eexamregAurFee);            
    global $eexamregTeacID;
    $TemplateText = Replace($TemplateText,"@eexamregTeacID@",$eexamregTeacID);            
    global $eexamregTeacID2;
    $TemplateText = Replace($TemplateText,"@eexamregTeacID2@",$eexamregTeacID2);            
    global $eexamregTeacID3;
    $TemplateText = Replace($TemplateText,"@eexamregTeacID3@",$eexamregTeacID3);            
    global $eexamregRmID;
    $TemplateText = Replace($TemplateText,"@eexamregRmID@",$eexamregRmID);            
    global $eexamregRmID2;
    $TemplateText = Replace($TemplateText,"@eexamregRmID2@",$eexamregRmID2);            
    global $eexamregRmID3;
    $TemplateText = Replace($TemplateText,"@eexamregRmID3@",$eexamregRmID3);            
    global $eexamregExamCode;
    $TemplateText = Replace($TemplateText,"@eexamregExamCode@",$eexamregExamCode);            
    global $eexamregExamCode2;
    $TemplateText = Replace($TemplateText,"@eexamregExamCode2@",$eexamregExamCode2);            
    global $eexamregExamCode3;
    $TemplateText = Replace($TemplateText,"@eexamregExamCode3@",$eexamregExamCode3);            
    global $eexamregRemarks;
    $TemplateText = Replace($TemplateText,"@eexamregRemarks@",$eexamregRemarks);            
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

$UpdateeexamregFormAction = "Updateeexamregaddx.php";
$eexamregCountryID  = getRequest("txteexamregCountryID");
$eexamregBranchID  = getRequest("txteexamregBranchID");
$eexamregDate  = getRequest("txteexamregDate");
$eexamregCustNo  = getRequest("txteexamregCustNo");
$eexamregCateg  = getRequest("txteexamregCateg");
$eexamregCateg2  = getRequest("txteexamregCateg2");
$eexamregCateg3  = getRequest("txteexamregCateg3");
$eexamregGrade  = getRequest("txteexamregGrade");
$eexamregGrade2  = getRequest("txteexamregGrade2");
$eexamregDigit  = getRequest("txteexamregDigit");
$eexamregNumber  = getRequest("txteexamregNumber");
$eexamregMenFee  = getRequest("txteexamregMenFee");
$eexamregAbaFee  = getRequest("txteexamregAbaFee");
$eexamregAurFee  = getRequest("txteexamregAurFee");
$eexamregTeacID  = getRequest("txteexamregTeacID");
$eexamregTeacID2  = getRequest("txteexamregTeacID2");
$eexamregTeacID3  = getRequest("txteexamregTeacID3");
$eexamregRmID  = getRequest("txteexamregRmID");
$eexamregRmID2  = getRequest("txteexamregRmID2");
$eexamregRmID3  = getRequest("txteexamregRmID3");
$eexamregExamCode  = getRequest("txteexamregExamCode");
$eexamregExamCode2  = getRequest("txteexamregExamCode2");
$eexamregExamCode3  = getRequest("txteexamregExamCode3");
$eexamregRemarks  = getRequest("txteexamregRemarks");

if ($_SESSION["Updateeexamreg_InsertFailed"] == 1) {
   $eexamregCountryID = $_SESSION["SavedeexamregCountryID"];
   $eexamregBranchID = $_SESSION["SavedeexamregBranchID"];
   $eexamregDate = $_SESSION["SavedeexamregDate"];
   $eexamregCustNo = $_SESSION["SavedeexamregCustNo"];
   $eexamregCateg = $_SESSION["SavedeexamregCateg"];
   $eexamregCateg2 = $_SESSION["SavedeexamregCateg2"];
   $eexamregCateg3 = $_SESSION["SavedeexamregCateg3"];
   $eexamregGrade = $_SESSION["SavedeexamregGrade"];
   $eexamregGrade2 = $_SESSION["SavedeexamregGrade2"];
   $eexamregDigit = $_SESSION["SavedeexamregDigit"];
   $eexamregNumber = $_SESSION["SavedeexamregNumber"];
   $eexamregMenFee = $_SESSION["SavedeexamregMenFee"];
   $eexamregAbaFee = $_SESSION["SavedeexamregAbaFee"];
   $eexamregAurFee = $_SESSION["SavedeexamregAurFee"];
   $eexamregTeacID = $_SESSION["SavedeexamregTeacID"];
   $eexamregTeacID2 = $_SESSION["SavedeexamregTeacID2"];
   $eexamregTeacID3 = $_SESSION["SavedeexamregTeacID3"];
   $eexamregRmID = $_SESSION["SavedeexamregRmID"];
   $eexamregRmID2 = $_SESSION["SavedeexamregRmID2"];
   $eexamregRmID3 = $_SESSION["SavedeexamregRmID3"];
   $eexamregExamCode = $_SESSION["SavedeexamregExamCode"];
   $eexamregExamCode2 = $_SESSION["SavedeexamregExamCode2"];
   $eexamregExamCode3 = $_SESSION["SavedeexamregExamCode3"];
   $eexamregRemarks = $_SESSION["SavedeexamregRemarks"];
}

MergeAddTemplate($HTML_Template);
unset($oRSeexamreg);
$objConn1->Close();
unset($objConn1);
?>
