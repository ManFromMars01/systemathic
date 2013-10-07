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
$UpdateeonlineFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeonline" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdateeonlineFormAction;
    global $eonlineCountryID;
    global $eonlineBranchID;
    global $eonlineCustNo;
    global $eonlineDate;
    global $eonlinePassword;
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
    $TemplateText = Replace($TemplateText,"@UpdateeonlineFormAction@",$UpdateeonlineFormAction);    

     $TemplateText = Replace($TemplateText, "@eonlineCountryID@", $eonlineCountryID);
     $TemplateText = Replace($TemplateText, "@eonlineBranchID@", $eonlineBranchID);
     $TemplateText = Replace($TemplateText, "@eonlineCustNo@", $eonlineCustNo);
     $TemplateText = Replace($TemplateText, "@eonlineDate@", $eonlineDate);
     $TemplateText = Replace($TemplateText, "@eonlinePassword@", $eonlinePassword);
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
$oRSeonline = "";
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
        $Template = "./html/Updateeonline" . "edit.htm";
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

$sql = "SELECT eonline.CountryID, eonline.BranchID, eonline.CustNo, eonline.Date, eonline.Password  FROM  eonline WHERE  eonline.CountryID = '" . $ID1 . "'" . " AND eonline.BranchID = '" . $ID2 . "'" . " AND eonline.CustNo = " . $ID3;
$oRSeonline = $objConn1->SelectLimit($sql,1);
if ($oRSeonline->MoveFirst() == false):
    $oRSeonline->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdateeonlineFormAction = "Updateeonlineeditx.php";
$oRSeonlineCountryID = $oRSeonline->fields["CountryID"];
$oRSeonlineBranchID = $oRSeonline->fields["BranchID"];
$oRSeonlineCustNo = $oRSeonline->fields["CustNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$eonlineCountryID = "";
if (is_null($oRSeonline->fields["CountryID"])):
$eonlineCountryID = "";
else:
$eonlineCountryID = trim(getValue($oRSeonline->fields["CountryID"]));
endif;
$eonlineBranchID = "";
if (is_null($oRSeonline->fields["BranchID"])):
$eonlineBranchID = "";
else:
$eonlineBranchID = trim(getValue($oRSeonline->fields["BranchID"]));
endif;
$eonlineCustNo = "";
if (is_null($oRSeonline->fields["CustNo"])):
$eonlineCustNo = "";
else:
$eonlineCustNo = getValue($oRSeonline->fields["CustNo"]);
endif;
$eonlineDate = "";
if (is_null($oRSeonline->fields["Date"])):
$eonlineDate = "";
else:
$eonlineDate = getValue($oRSeonline->fields["Date"]);
endif;
$eonlinePassword = "";
if (is_null($oRSeonline->fields["Password"])):
$eonlinePassword = "";
else:
$eonlinePassword = trim(getValue($oRSeonline->fields["Password"]));
endif;
$DeleteButton = "<form method='post' action='Updateeonlinedel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updateeonline_EditFailed"] == 1) {
  $eonlineCountryID = $_SESSION["SavedEditeonlineCountryID"];
  $eonlineBranchID = $_SESSION["SavedEditeonlineBranchID"];
  $eonlineCustNo = $_SESSION["SavedEditeonlineCustNo"];
  $eonlineDate = $_SESSION["SavedEditeonlineDate"];
  $eonlinePassword = $_SESSION["SavedEditeonlinePassword"];
}
else {
  $_SESSION["Updateeonline_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRSeonline);
$objConn1->Close();
unset($objConn1);
?>
