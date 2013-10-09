<?php
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

$HTML_Template = getRequest("HTMLT");

$ID1 = "";
$UpdatetcountryFormAction = "Updatetcountry" . "edit.php";
$tcountryID = "";
$tcountryDescription = "";
$tcountryPhone = "";
$tcountryEmail = "";
$tcountryContact = "";
$tcountryMaster = "";
function  MergeUpdatetcountryTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetcountry" . "view.htm";
    endif;
    
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

    $TemplateText = Replace($TemplateText,"@UpdatetcountryFormAction@",$UpdatetcountryFormAction);    
    $TemplateText = Replace($TemplateText,"@tcountryID@",$tcountryID);    
    $TemplateText = Replace($TemplateText,"@tcountryDescription@",$tcountryDescription);    
    $TemplateText = Replace($TemplateText,"@tcountryPhone@",$tcountryPhone);    
    $TemplateText = Replace($TemplateText,"@tcountryEmail@",$tcountryEmail);    
    $TemplateText = Replace($TemplateText,"@tcountryContact@",$tcountryContact);    
    $TemplateText = Replace($TemplateText,"@tcountryMaster@",$tcountryMaster);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    print($TemplateText);
}
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
    MergeViewTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeViewTemplate($Template,$ClarionData) {
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != FALSE):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != FALSE):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;
    print($TemplateText);
    exit();
}
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$NoRecords = FALSE;
$myQuoteID1 = getQuote($objConn1,"tcountry","ID");
$strSQLBase  = "SELECT tcountry.ID, tcountry.Description, tcountry.Phone, tcountry.Email, tcountry.Contact, tcountry.Master  FROM  tcountry  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= " tcountry.ID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID1 . $ID1 . $myQuoteID1 . " ORDER BY tcountry.ID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID1 . $ID1 . $myQuoteID1 . " ORDER BY tcountry.ID ASC";
else:
    $strSQL .= " = " . $myQuoteID1 . $ID1 . $myQuoteID1;
endif;

$oRStcountry = $objConn1->SelectLimit($strSQL,1);
if (($oRStcountry->EOF == TRUE) || ($oRStcountry->CurrentRow() == -1)):
    $oRStcountry->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStcountry->MoveFirst() == FALSE):
    $oRStcountry->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStcountry->Fields("ID");
if (is_null($oRStcountry->Fields("ID"))):
    $tcountryID  = "";
else:
    if (is_numeric($oRStcountry->Fields("ID"))):
        $tcountryID  = getValue($oRStcountry->Fields("ID"));
    else:
        $tcountryID  = htmlentities(getValue($oRStcountry->Fields("ID")));
    endif;
endif;
if (is_null($oRStcountry->Fields("Description"))):
    $tcountryDescription  = "";
else:
    if (is_numeric($oRStcountry->Fields("Description"))):
        $tcountryDescription  = getValue($oRStcountry->Fields("Description"));
    else:
        $tcountryDescription  = htmlentities(getValue($oRStcountry->Fields("Description")));
    endif;
endif;
if (is_null($oRStcountry->Fields("Phone"))):
    $tcountryPhone  = "";
else:
    if (is_numeric($oRStcountry->Fields("Phone"))):
        $tcountryPhone  = getValue($oRStcountry->Fields("Phone"));
    else:
        $tcountryPhone  = htmlentities(getValue($oRStcountry->Fields("Phone")));
    endif;
endif;
if (is_null($oRStcountry->Fields("Email"))):
    $tcountryEmail  = "";
else:
    if (is_numeric($oRStcountry->Fields("Email"))):
        $tcountryEmail  = getValue($oRStcountry->Fields("Email"));
    else:
        $tcountryEmail  = htmlentities(getValue($oRStcountry->Fields("Email")));
    endif;
endif;
if (is_null($oRStcountry->Fields("Contact"))):
    $tcountryContact  = "";
else:
    if (is_numeric($oRStcountry->Fields("Contact"))):
        $tcountryContact  = getValue($oRStcountry->Fields("Contact"));
    else:
        $tcountryContact  = htmlentities(getValue($oRStcountry->Fields("Contact")));
    endif;
endif;
if (is_null($oRStcountry->Fields("Master"))):
    $tcountryMaster  = "";
else:
    if (is_numeric($oRStcountry->Fields("Master"))):
        $tcountryMaster  = getValue($oRStcountry->Fields("Master"));
    else:
        $tcountryMaster  = htmlentities(getValue($oRStcountry->Fields("Master")));
    endif;
endif;
$EditLevel = 1;

$myLevel = getSession("UserLevel") == "" ? 0 : getSession("UserLevel");          

if(!isset($EditLevel)):
    $EditLevel = 0;
endif;
if ($myLevel >= $EditLevel):
    $EditOptions = "<input type='IMAGE' src='" . $IconEdit . "' alt='Edit' height=20 width=20 title='Edit this record' id='submit1' name='submit1' >";
else:
    $EditOptions = "";
endif;

$dbNavBarPrev = "";
$dbNavBarNext = "";
$dbNavBarPrev = "<a href=Updatetcountry" . "view.php?";
$dbNavBarNext = "<a href=Updatetcountry" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStcountry->Fields("ID");
$dbNavBarNext  .= "ID1=" . $oRStcountry->Fields("ID");
if ($NoRecords == TRUE):
    if ($myDirection = "p"):
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPriorDisabled . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
    else:
        $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
        $dbNavBarNext  .= "&NAV=next><img src=" . $IconNextDisabled . " alt='Next record' border=0 height=20 width=20></a>";    
    endif;
else:
    $dbNavBarPrev  .= "&NAV=previous><img src=" . $IconPrior . " alt='Previous record' border=0 height=20 width=20></a>";
    $dbNavBarNext  .= "&NAV=next><img src=" . $IconNext . " alt='Next record' border=0 height=20 width=20></a>";
endif;
$dbNavBar = $dbNavBarPrev . $dbNavBarNext;
$oRStcountry->Close();
MergeUpdatetcountryTemplate($HTML_Template);
unset($oRStcountry);
    $objConn1->Close();
    unset($objConn1);
?>
