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
$UpdatettaxtabFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatettaxtab" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatettaxtabFormAction;
    global $ttaxtabCountryID;
    global $ttaxtabBranchID;
    global $ttaxtabTaxID;
    global $ttaxtabDescription;
    global $ttaxtabRate;
    global $ttaxtabDept;
    global $ttaxtabAccount;
    global $ttaxtabCurrTaxAmt;
    global $ttaxtabMTDTaxAmt;
    global $ttaxtabYTDTaxAmt;
    global $ttaxtabStatus;
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
    $TemplateText = Replace($TemplateText,"@UpdatettaxtabFormAction@",$UpdatettaxtabFormAction);    

     $TemplateText = Replace($TemplateText, "@ttaxtabCountryID@", $ttaxtabCountryID);
     $TemplateText = Replace($TemplateText, "@ttaxtabBranchID@", $ttaxtabBranchID);
     $TemplateText = Replace($TemplateText, "@ttaxtabTaxID@", $ttaxtabTaxID);
     $TemplateText = Replace($TemplateText, "@ttaxtabDescription@", $ttaxtabDescription);
     $TemplateText = Replace($TemplateText, "@ttaxtabRate@", $ttaxtabRate);
     $TemplateText = Replace($TemplateText, "@ttaxtabDept@", $ttaxtabDept);
     $TemplateText = Replace($TemplateText, "@ttaxtabAccount@", $ttaxtabAccount);
     $TemplateText = Replace($TemplateText, "@ttaxtabCurrTaxAmt@", $ttaxtabCurrTaxAmt);
     $TemplateText = Replace($TemplateText, "@ttaxtabMTDTaxAmt@", $ttaxtabMTDTaxAmt);
     $TemplateText = Replace($TemplateText, "@ttaxtabYTDTaxAmt@", $ttaxtabYTDTaxAmt);
     $TemplateText = Replace($TemplateText, "@ttaxtabStatus@", $ttaxtabStatus);
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
$oRSttaxtab = "";
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
        $Template = "./html/Updatettaxtab" . "edit.htm";
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

$sql = "SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt, ttaxtab.YTDTaxAmt, ttaxtab.Status  FROM  ttaxtab WHERE  ttaxtab.CountryID = '" . $ID1 . "'" . " AND ttaxtab.BranchID = '" . $ID2 . "'" . " AND ttaxtab.TaxID = '" . $ID3 . "'";
$oRSttaxtab = $objConn1->SelectLimit($sql,1);
if ($oRSttaxtab->MoveFirst() == false):
    $oRSttaxtab->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatettaxtabFormAction = "Updatettaxtabeditx.php";
$oRSttaxtabCountryID = $oRSttaxtab->fields["CountryID"];
$oRSttaxtabBranchID = $oRSttaxtab->fields["BranchID"];
$oRSttaxtabTaxID = $oRSttaxtab->fields["TaxID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$ttaxtabCountryID = "";
if (is_null($oRSttaxtab->fields["CountryID"])):
$ttaxtabCountryID = "";
else:
$ttaxtabCountryID = trim(getValue($oRSttaxtab->fields["CountryID"]));
endif;
$ttaxtabBranchID = "";
if (is_null($oRSttaxtab->fields["BranchID"])):
$ttaxtabBranchID = "";
else:
$ttaxtabBranchID = trim(getValue($oRSttaxtab->fields["BranchID"]));
endif;
$ttaxtabTaxID = "";
if (is_null($oRSttaxtab->fields["TaxID"])):
$ttaxtabTaxID = "";
else:
$ttaxtabTaxID = trim(getValue($oRSttaxtab->fields["TaxID"]));
endif;
$ttaxtabDescription = "";
if (is_null($oRSttaxtab->fields["Description"])):
$ttaxtabDescription = "";
else:
$ttaxtabDescription = trim(getValue($oRSttaxtab->fields["Description"]));
endif;
$ttaxtabRate = "";
if (is_null($oRSttaxtab->fields["Rate"])):
$ttaxtabRate = "";
else:
$ttaxtabRate = getValue($oRSttaxtab->fields["Rate"]);
endif;
$ttaxtabDept = "";
if (is_null($oRSttaxtab->fields["Dept"])):
$ttaxtabDept = "";
else:
$ttaxtabDept = getValue($oRSttaxtab->fields["Dept"]);
endif;
$ttaxtabAccount = "";
if (is_null($oRSttaxtab->fields["Account"])):
$ttaxtabAccount = "";
else:
$ttaxtabAccount = getValue($oRSttaxtab->fields["Account"]);
endif;
$ttaxtabCurrTaxAmt = "";
if (is_null($oRSttaxtab->fields["CurrTaxAmt"])):
$ttaxtabCurrTaxAmt = "";
else:
$ttaxtabCurrTaxAmt = getValue($oRSttaxtab->fields["CurrTaxAmt"]);
endif;
$ttaxtabMTDTaxAmt = "";
if (is_null($oRSttaxtab->fields["MTDTaxAmt"])):
$ttaxtabMTDTaxAmt = "";
else:
$ttaxtabMTDTaxAmt = getValue($oRSttaxtab->fields["MTDTaxAmt"]);
endif;
$ttaxtabYTDTaxAmt = "";
if (is_null($oRSttaxtab->fields["YTDTaxAmt"])):
$ttaxtabYTDTaxAmt = "";
else:
$ttaxtabYTDTaxAmt = getValue($oRSttaxtab->fields["YTDTaxAmt"]);
endif;
$ttaxtabStatus = "";
if (is_null($oRSttaxtab->fields["Status"])):
$ttaxtabStatus = "";
else:
$ttaxtabStatus = trim(getValue($oRSttaxtab->fields["Status"]));
endif;
$DeleteButton = "<form method='post' action='Updatettaxtabdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatettaxtab_EditFailed"] == 1) {
  $ttaxtabCountryID = $_SESSION["SavedEditttaxtabCountryID"];
  $ttaxtabBranchID = $_SESSION["SavedEditttaxtabBranchID"];
  $ttaxtabTaxID = $_SESSION["SavedEditttaxtabTaxID"];
  $ttaxtabDescription = $_SESSION["SavedEditttaxtabDescription"];
  $ttaxtabRate = $_SESSION["SavedEditttaxtabRate"];
  $ttaxtabDept = $_SESSION["SavedEditttaxtabDept"];
  $ttaxtabAccount = $_SESSION["SavedEditttaxtabAccount"];
  $ttaxtabCurrTaxAmt = $_SESSION["SavedEditttaxtabCurrTaxAmt"];
  $ttaxtabMTDTaxAmt = $_SESSION["SavedEditttaxtabMTDTaxAmt"];
  $ttaxtabYTDTaxAmt = $_SESSION["SavedEditttaxtabYTDTaxAmt"];
  $ttaxtabStatus = $_SESSION["SavedEditttaxtabStatus"];
}
else {
  $_SESSION["Updatettaxtab_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRSttaxtab);
$objConn1->Close();
unset($objConn1);
?>
