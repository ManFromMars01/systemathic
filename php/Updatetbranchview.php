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
$ID2 = "";
$UpdatetbranchFormAction = "Updatetbranch" . "edit.php";
$tbranchCountryID = "";
$tbranchBranchID = "";
$tbranchDescription = "";
$tbranchPhone = "";
$tbranchEmail = "";
$tbranchContact = "";
$tbranchHQOperation = "";
$tbranchHQCenterOperation = "";
function  MergeUpdatetbranchTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetbranch" . "view.htm";
    endif;
    
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

    $TemplateText = Replace($TemplateText,"@UpdatetbranchFormAction@",$UpdatetbranchFormAction);    
    $TemplateText = Replace($TemplateText,"@tbranchCountryID@",$tbranchCountryID);    
    $TemplateText = Replace($TemplateText,"@tbranchBranchID@",$tbranchBranchID);    
    $TemplateText = Replace($TemplateText,"@tbranchDescription@",$tbranchDescription);    
    $TemplateText = Replace($TemplateText,"@tbranchPhone@",$tbranchPhone);    
    $TemplateText = Replace($TemplateText,"@tbranchEmail@",$tbranchEmail);    
    $TemplateText = Replace($TemplateText,"@tbranchContact@",$tbranchContact);    
    $TemplateText = Replace($TemplateText,"@tbranchHQOperation@",$tbranchHQOperation);    
    $TemplateText = Replace($TemplateText,"@tbranchHQCenterOperation@",$tbranchHQCenterOperation);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    print($TemplateText);
}
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
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
$myQuoteID1 = getQuote($objConn1,"tbranch","CountryID");
$myQuoteID2 = getQuote($objConn1,"tbranch","BranchID");
$strSQLBase  = "SELECT tbranch.CountryID, tbranch.BranchID, tbranch.Description, tbranch.Phone, tbranch.Email, tbranch.Contact, tbranch.HQOperation, tbranch.HQCenterOperation  FROM  tbranch  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tbranch.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tbranch.BranchID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID2 . $ID2 . $myQuoteID2 . " ORDER BY tbranch.BranchID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID2 . $ID2 . $myQuoteID2 . " ORDER BY tbranch.BranchID ASC";
else:
    $strSQL .= " = " . $myQuoteID2 . $ID2 . $myQuoteID2;
endif;

$oRStbranch = $objConn1->SelectLimit($strSQL,1);
if (($oRStbranch->EOF == TRUE) || ($oRStbranch->CurrentRow() == -1)):
    $oRStbranch->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStbranch->MoveFirst() == FALSE):
    $oRStbranch->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStbranch->Fields("CountryID");
$ID2 = $oRStbranch->Fields("BranchID");
if (is_null($oRStbranch->Fields("CountryID"))):
    $tbranchCountryID  = "";
else:
    if (is_numeric($oRStbranch->Fields("CountryID"))):
        $tbranchCountryID  = getValue($oRStbranch->Fields("CountryID"));
    else:
        $tbranchCountryID  = htmlentities(getValue($oRStbranch->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStbranch->Fields("BranchID"))):
    $tbranchBranchID  = "";
else:
    if (is_numeric($oRStbranch->Fields("BranchID"))):
        $tbranchBranchID  = getValue($oRStbranch->Fields("BranchID"));
    else:
        $tbranchBranchID  = htmlentities(getValue($oRStbranch->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStbranch->Fields("Description"))):
    $tbranchDescription  = "";
else:
    if (is_numeric($oRStbranch->Fields("Description"))):
        $tbranchDescription  = getValue($oRStbranch->Fields("Description"));
    else:
        $tbranchDescription  = htmlentities(getValue($oRStbranch->Fields("Description")));
    endif;
endif;
if (is_null($oRStbranch->Fields("Phone"))):
    $tbranchPhone  = "";
else:
    if (is_numeric($oRStbranch->Fields("Phone"))):
        $tbranchPhone  = getValue($oRStbranch->Fields("Phone"));
    else:
        $tbranchPhone  = htmlentities(getValue($oRStbranch->Fields("Phone")));
    endif;
endif;
if (is_null($oRStbranch->Fields("Email"))):
    $tbranchEmail  = "";
else:
    if (is_numeric($oRStbranch->Fields("Email"))):
        $tbranchEmail  = getValue($oRStbranch->Fields("Email"));
    else:
        $tbranchEmail  = htmlentities(getValue($oRStbranch->Fields("Email")));
    endif;
endif;
if (is_null($oRStbranch->Fields("Contact"))):
    $tbranchContact  = "";
else:
    if (is_numeric($oRStbranch->Fields("Contact"))):
        $tbranchContact  = getValue($oRStbranch->Fields("Contact"));
    else:
        $tbranchContact  = htmlentities(getValue($oRStbranch->Fields("Contact")));
    endif;
endif;
if (is_null($oRStbranch->Fields("HQOperation"))):
    $tbranchHQOperation  = "";
else:
    if (is_numeric($oRStbranch->Fields("HQOperation"))):
        $tbranchHQOperation  = getValue($oRStbranch->Fields("HQOperation"));
    else:
        $tbranchHQOperation  = htmlentities(getValue($oRStbranch->Fields("HQOperation")));
    endif;
endif;
if (is_null($oRStbranch->Fields("HQCenterOperation"))):
    $tbranchHQCenterOperation  = "";
else:
    if (is_numeric($oRStbranch->Fields("HQCenterOperation"))):
        $tbranchHQCenterOperation  = getValue($oRStbranch->Fields("HQCenterOperation"));
    else:
        $tbranchHQCenterOperation  = htmlentities(getValue($oRStbranch->Fields("HQCenterOperation")));
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
$dbNavBarPrev = "<a href=Updatetbranch" . "view.php?";
$dbNavBarNext = "<a href=Updatetbranch" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStbranch->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStbranch->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStbranch->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStbranch->Fields("BranchID");
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
$oRStbranch->Close();
MergeUpdatetbranchTemplate($HTML_Template);
unset($oRStbranch);
    $objConn1->Close();
    unset($objConn1);
?>
