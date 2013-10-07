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

$ID1 = "";
$ID2 = "";
$ID3 = "";
$UpdatetteacherFormAction = "Updatetteacher" . "edit.php";
$tteacherCountryID = "";
$tteacherBranchID = "";
$tteacherID = "";
$tteacherName = "";
$tteacherLocalName = "";
$tteacherDateStart = "";
$tteacherPhoneNo = "";
$tteacherMobileNo = "";
$tteacherEmail = "";
$tteacherStatus = "";
$tteacherRoleID = "";
function  MergeUpdatetteacherTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetteacher" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetteacherFormAction;
    global $tteacherCountryID;
    global $tteacherBranchID;
    global $tteacherID;
    global $tteacherName;
    global $tteacherLocalName;
    global $tteacherDateStart;
    global $tteacherPhoneNo;
    global $tteacherMobileNo;
    global $tteacherEmail;
    global $tteacherStatus;
    global $tteacherRoleID;
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

    $TemplateText = Replace($TemplateText,"@UpdatetteacherFormAction@",$UpdatetteacherFormAction);    
    $TemplateText = Replace($TemplateText,"@tteacherCountryID@",$tteacherCountryID);    
    $TemplateText = Replace($TemplateText,"@tteacherBranchID@",$tteacherBranchID);    
    $TemplateText = Replace($TemplateText,"@tteacherID@",$tteacherID);    
    $TemplateText = Replace($TemplateText,"@tteacherName@",$tteacherName);    
    $TemplateText = Replace($TemplateText,"@tteacherLocalName@",$tteacherLocalName);    
    $TemplateText = Replace($TemplateText,"@tteacherDateStart@",$tteacherDateStart);    
    $TemplateText = Replace($TemplateText,"@tteacherPhoneNo@",$tteacherPhoneNo);    
    $TemplateText = Replace($TemplateText,"@tteacherMobileNo@",$tteacherMobileNo);    
    $TemplateText = Replace($TemplateText,"@tteacherEmail@",$tteacherEmail);    
    $TemplateText = Replace($TemplateText,"@tteacherStatus@",$tteacherStatus);    
    $TemplateText = Replace($TemplateText,"@tteacherRoleID@",$tteacherRoleID);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
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
    $ClarionData .= "<a href=BrowseCategory" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tteacher","CountryID");
$myQuoteID2 = getQuote($objConn1,"tteacher","BranchID");
$myQuoteID3 = getQuote($objConn1,"tteacher","ID");
$strSQLBase  = "SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Name, tteacher.LocalName, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo, tteacher.Email, tteacher.Status, tteacher.RoleID  FROM  tteacher  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tteacher.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tteacher.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tteacher.ID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tteacher.ID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tteacher.ID ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStteacher = $objConn1->SelectLimit($strSQL,1);
if (($oRStteacher->EOF == TRUE) || ($oRStteacher->CurrentRow() == -1)):
    $oRStteacher->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStteacher->MoveFirst() == FALSE):
    $oRStteacher->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStteacher->Fields("CountryID");
$ID2 = $oRStteacher->Fields("BranchID");
$ID3 = $oRStteacher->Fields("ID");
if (is_null($oRStteacher->Fields("CountryID"))):
    $tteacherCountryID  = "";
else:
    if (is_numeric($oRStteacher->Fields("CountryID"))):
        $tteacherCountryID  = getValue($oRStteacher->Fields("CountryID"));
    else:
        $tteacherCountryID  = htmlentities(getValue($oRStteacher->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStteacher->Fields("BranchID"))):
    $tteacherBranchID  = "";
else:
    if (is_numeric($oRStteacher->Fields("BranchID"))):
        $tteacherBranchID  = getValue($oRStteacher->Fields("BranchID"));
    else:
        $tteacherBranchID  = htmlentities(getValue($oRStteacher->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStteacher->Fields("ID"))):
    $tteacherID  = "";
else:
    if (is_numeric($oRStteacher->Fields("ID"))):
        $tteacherID  = getValue($oRStteacher->Fields("ID"));
    else:
        $tteacherID  = htmlentities(getValue($oRStteacher->Fields("ID")));
    endif;
endif;
if (is_null($oRStteacher->Fields("Name"))):
    $tteacherName  = "";
else:
    if (is_numeric($oRStteacher->Fields("Name"))):
        $tteacherName  = getValue($oRStteacher->Fields("Name"));
    else:
        $tteacherName  = htmlentities(getValue($oRStteacher->Fields("Name")));
    endif;
endif;
if (is_null($oRStteacher->Fields("LocalName"))):
    $tteacherLocalName  = "";
else:
    if (is_numeric($oRStteacher->Fields("LocalName"))):
        $tteacherLocalName  = getValue($oRStteacher->Fields("LocalName"));
    else:
        $tteacherLocalName  = htmlentities(getValue($oRStteacher->Fields("LocalName")));
    endif;
endif;
if (is_null($oRStteacher->Fields("DateStart"))):
    $tteacherDateStart  = "";
else:
    if (is_numeric($oRStteacher->Fields("DateStart"))):
        $tteacherDateStart  = getValue($oRStteacher->Fields("DateStart"));
    else:
        $tteacherDateStart  = htmlentities(getValue($oRStteacher->Fields("DateStart")));
    endif;
endif;
if (is_null($oRStteacher->Fields("PhoneNo"))):
    $tteacherPhoneNo  = "";
else:
    if (is_numeric($oRStteacher->Fields("PhoneNo"))):
        $tteacherPhoneNo  = getValue($oRStteacher->Fields("PhoneNo"));
    else:
        $tteacherPhoneNo  = htmlentities(getValue($oRStteacher->Fields("PhoneNo")));
    endif;
endif;
if (is_null($oRStteacher->Fields("MobileNo"))):
    $tteacherMobileNo  = "";
else:
    if (is_numeric($oRStteacher->Fields("MobileNo"))):
        $tteacherMobileNo  = getValue($oRStteacher->Fields("MobileNo"));
    else:
        $tteacherMobileNo  = htmlentities(getValue($oRStteacher->Fields("MobileNo")));
    endif;
endif;
if (is_null($oRStteacher->Fields("Email"))):
    $tteacherEmail  = "";
else:
    if (is_numeric($oRStteacher->Fields("Email"))):
        $tteacherEmail  = getValue($oRStteacher->Fields("Email"));
    else:
        $tteacherEmail  = htmlentities(getValue($oRStteacher->Fields("Email")));
    endif;
endif;
if (is_null($oRStteacher->Fields("Status"))):
    $tteacherStatus  = "";
else:
    if (is_numeric($oRStteacher->Fields("Status"))):
        $tteacherStatus  = getValue($oRStteacher->Fields("Status"));
    else:
        $tteacherStatus  = htmlentities(getValue($oRStteacher->Fields("Status")));
    endif;
endif;
if (is_null($oRStteacher->Fields("RoleID"))):
    $tteacherRoleID  = "";
else:
    if (is_numeric($oRStteacher->Fields("RoleID"))):
        $tteacherRoleID  = getValue($oRStteacher->Fields("RoleID"));
    else:
        $tteacherRoleID  = htmlentities(getValue($oRStteacher->Fields("RoleID")));
    endif;
endif;

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
$dbNavBarPrev = "<a href=Updatetteacher" . "view.php?";
$dbNavBarNext = "<a href=Updatetteacher" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStteacher->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStteacher->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStteacher->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStteacher->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStteacher->Fields("ID");
$dbNavBarNext  .= "&ID3=" . $oRStteacher->Fields("ID");
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
$oRStteacher->Close();
MergeUpdatetteacherTemplate($HTML_Template);
unset($oRStteacher);
    $objConn1->Close();
    unset($objConn1);
?>
