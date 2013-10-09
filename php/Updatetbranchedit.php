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
$UpdatetbranchFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetbranch" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $UpdatetbranchFormAction;
    global $tbranchCountryID;
    global $tbranchBranchID;
    global $tbranchDescription;
    global $tbranchPhone;
    global $tbranchEmail;
    global $tbranchContact;
    global $tbranchHQOperation;
    global $tbranchHQCenterOperation;
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
    $TemplateText = Replace($TemplateText,"@UpdatetbranchFormAction@",$UpdatetbranchFormAction);    

     $TemplateText = Replace($TemplateText, "@tbranchCountryID@", $tbranchCountryID);
     $TemplateText = Replace($TemplateText, "@tbranchBranchID@", $tbranchBranchID);
     $TemplateText = Replace($TemplateText, "@tbranchDescription@", $tbranchDescription);
     $TemplateText = Replace($TemplateText, "@tbranchPhone@", $tbranchPhone);
     $TemplateText = Replace($TemplateText, "@tbranchEmail@", $tbranchEmail);
     $TemplateText = Replace($TemplateText, "@tbranchContact@", $tbranchContact);
     $TemplateText = Replace($TemplateText, "@tbranchHQOperation@", $tbranchHQOperation);
     $TemplateText = Replace($TemplateText, "@tbranchHQCenterOperation@", $tbranchHQCenterOperation);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
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
$oRStbranch = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=Browsetbranch" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetbranch" . "edit.htm";
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

$sql = "SELECT tbranch.CountryID, tbranch.BranchID, tbranch.Description, tbranch.Phone, tbranch.Email, tbranch.Contact, tbranch.HQOperation, tbranch.HQCenterOperation  FROM  tbranch WHERE  tbranch.CountryID = '" . $ID1 . "'" . " AND tbranch.BranchID = '" . $ID2 . "'";
$oRStbranch = $objConn1->SelectLimit($sql,1);
if ($oRStbranch->MoveFirst() == false):
    $oRStbranch->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetbranchFormAction = "Updatetbrancheditx.php";
$oRStbranchCountryID = $oRStbranch->fields["CountryID"];
$oRStbranchBranchID = $oRStbranch->fields["BranchID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));

$tbranchCountryID = "";
if (is_null($oRStbranch->fields["CountryID"])):
$tbranchCountryID = "";
else:
$tbranchCountryID = trim(getValue($oRStbranch->fields["CountryID"]));
endif;
$tbranchBranchID = "";
if (is_null($oRStbranch->fields["BranchID"])):
$tbranchBranchID = "";
else:
$tbranchBranchID = trim(getValue($oRStbranch->fields["BranchID"]));
endif;
$tbranchDescription = "";
if (is_null($oRStbranch->fields["Description"])):
$tbranchDescription = "";
else:
$tbranchDescription = trim(getValue($oRStbranch->fields["Description"]));
endif;
$tbranchPhone = "";
if (is_null($oRStbranch->fields["Phone"])):
$tbranchPhone = "";
else:
$tbranchPhone = trim(getValue($oRStbranch->fields["Phone"]));
endif;
$tbranchEmail = "";
if (is_null($oRStbranch->fields["Email"])):
$tbranchEmail = "";
else:
$tbranchEmail = trim(getValue($oRStbranch->fields["Email"]));
endif;
$tbranchContact = "";
if (is_null($oRStbranch->fields["Contact"])):
$tbranchContact = "";
else:
$tbranchContact = trim(getValue($oRStbranch->fields["Contact"]));
endif;
$tbranchHQOperation = "";
if (is_null($oRStbranch->fields["HQOperation"])):
$tbranchHQOperation = "";
else:
$tbranchHQOperation = trim(getValue($oRStbranch->fields["HQOperation"]));
endif;
$tbranchHQCenterOperation = "";
if (is_null($oRStbranch->fields["HQCenterOperation"])):
$tbranchHQCenterOperation = "";
else:
$tbranchHQCenterOperation = trim(getValue($oRStbranch->fields["HQCenterOperation"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetbranchdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetbranch_EditFailed"] == 1) {
  $tbranchCountryID = $_SESSION["SavedEdittbranchCountryID"];
  $tbranchBranchID = $_SESSION["SavedEdittbranchBranchID"];
  $tbranchDescription = $_SESSION["SavedEdittbranchDescription"];
  $tbranchPhone = $_SESSION["SavedEdittbranchPhone"];
  $tbranchEmail = $_SESSION["SavedEdittbranchEmail"];
  $tbranchContact = $_SESSION["SavedEdittbranchContact"];
  $tbranchHQOperation = $_SESSION["SavedEdittbranchHQOperation"];
  $tbranchHQCenterOperation = $_SESSION["SavedEdittbranchHQCenterOperation"];
}
else {
  $_SESSION["Updatetbranch_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStbranch);
$objConn1->Close();
unset($objConn1);
?>
