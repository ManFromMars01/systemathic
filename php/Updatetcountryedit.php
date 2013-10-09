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
$UpdatetcountryFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetcountry" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $UpdatetcountryFormAction;
    global $tcountryID;
    global $tcountryDescription;
    global $tcountryPhone;
    global $tcountryEmail;
    global $tcountryContact;
    global $tcountryMaster;
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
    $TemplateText = Replace($TemplateText,"@UpdatetcountryFormAction@",$UpdatetcountryFormAction);    

     $TemplateText = Replace($TemplateText, "@tcountryID@", $tcountryID);
     $TemplateText = Replace($TemplateText, "@tcountryDescription@", $tcountryDescription);
     $TemplateText = Replace($TemplateText, "@tcountryPhone@", $tcountryPhone);
     $TemplateText = Replace($TemplateText, "@tcountryEmail@", $tcountryEmail);
     $TemplateText = Replace($TemplateText, "@tcountryContact@", $tcountryContact);
     $TemplateText = Replace($TemplateText, "@tcountryMaster@", $tcountryMaster);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
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
$oRStcountry = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
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
        $Template = "./html/Updatetcountry" . "edit.htm";
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

$sql = "SELECT tcountry.ID, tcountry.Description, tcountry.Phone, tcountry.Email, tcountry.Contact, tcountry.Master  FROM  tcountry WHERE  tcountry.ID = '" . $ID1 . "'";
$oRStcountry = $objConn1->SelectLimit($sql,1);
if ($oRStcountry->MoveFirst() == false):
    $oRStcountry->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetcountryFormAction = "Updatetcountryeditx.php";
$oRStcountryID = $oRStcountry->fields["ID"];
$ID1  =  htmlDecode(getRequest("ID1"));

$tcountryID = "";
if (is_null($oRStcountry->fields["ID"])):
$tcountryID = "";
else:
$tcountryID = trim(getValue($oRStcountry->fields["ID"]));
endif;
$tcountryDescription = "";
if (is_null($oRStcountry->fields["Description"])):
$tcountryDescription = "";
else:
$tcountryDescription = trim(getValue($oRStcountry->fields["Description"]));
endif;
$tcountryPhone = "";
if (is_null($oRStcountry->fields["Phone"])):
$tcountryPhone = "";
else:
$tcountryPhone = trim(getValue($oRStcountry->fields["Phone"]));
endif;
$tcountryEmail = "";
if (is_null($oRStcountry->fields["Email"])):
$tcountryEmail = "";
else:
$tcountryEmail = trim(getValue($oRStcountry->fields["Email"]));
endif;
$tcountryContact = "";
if (is_null($oRStcountry->fields["Contact"])):
$tcountryContact = "";
else:
$tcountryContact = trim(getValue($oRStcountry->fields["Contact"]));
endif;
$tcountryMaster = "";
if (is_null($oRStcountry->fields["Master"])):
$tcountryMaster = "";
else:
$tcountryMaster = trim(getValue($oRStcountry->fields["Master"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetcountrydel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetcountry_EditFailed"] == 1) {
  $tcountryID = $_SESSION["SavedEdittcountryID"];
  $tcountryDescription = $_SESSION["SavedEdittcountryDescription"];
  $tcountryPhone = $_SESSION["SavedEdittcountryPhone"];
  $tcountryEmail = $_SESSION["SavedEdittcountryEmail"];
  $tcountryContact = $_SESSION["SavedEdittcountryContact"];
  $tcountryMaster = $_SESSION["SavedEdittcountryMaster"];
}
else {
  $_SESSION["Updatetcountry_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStcountry);
$objConn1->Close();
unset($objConn1);
?>
