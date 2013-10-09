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
$ID3 = "";
$UpdatetvendorFormAction = "Updatetvendor" . "edit.php";
$tvendorCountryID = "";
$tvendorBranchID = "";
$tvendorID = "";
$tvendorName = "";
$tvendorAddress1 = "";
$tvendorAddress2 = "";
$tvendorCity = "";
$tvendorZip = "";
$tvendorFax = "";
$tvendorPhone = "";
$tvendorRmtAdd1 = "";
$tvendorRmtAdd2 = "";
$tvendorRmtZip = "";
$tvendorRmtCity = "";
$tvendorContact = "";
$tvendorDiscountPct = "";
$tvendorDiscountDays = "";
function  MergeUpdatetvendorTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetvendor" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetvendorFormAction;
    global $tvendorCountryID;
    global $tvendorBranchID;
    global $tvendorID;
    global $tvendorName;
    global $tvendorAddress1;
    global $tvendorAddress2;
    global $tvendorCity;
    global $tvendorZip;
    global $tvendorFax;
    global $tvendorPhone;
    global $tvendorRmtAdd1;
    global $tvendorRmtAdd2;
    global $tvendorRmtZip;
    global $tvendorRmtCity;
    global $tvendorContact;
    global $tvendorDiscountPct;
    global $tvendorDiscountDays;
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

    $TemplateText = Replace($TemplateText,"@UpdatetvendorFormAction@",$UpdatetvendorFormAction);    
    $TemplateText = Replace($TemplateText,"@tvendorCountryID@",$tvendorCountryID);    
    $TemplateText = Replace($TemplateText,"@tvendorBranchID@",$tvendorBranchID);    
    $TemplateText = Replace($TemplateText,"@tvendorID@",$tvendorID);    
    $TemplateText = Replace($TemplateText,"@tvendorName@",$tvendorName);    
    $TemplateText = Replace($TemplateText,"@tvendorAddress1@",$tvendorAddress1);    
    $TemplateText = Replace($TemplateText,"@tvendorAddress2@",$tvendorAddress2);    
    $TemplateText = Replace($TemplateText,"@tvendorCity@",$tvendorCity);    
    $TemplateText = Replace($TemplateText,"@tvendorZip@",$tvendorZip);    
    $TemplateText = Replace($TemplateText,"@tvendorFax@",$tvendorFax);    
    $TemplateText = Replace($TemplateText,"@tvendorPhone@",$tvendorPhone);    
    $TemplateText = Replace($TemplateText,"@tvendorRmtAdd1@",$tvendorRmtAdd1);    
    $TemplateText = Replace($TemplateText,"@tvendorRmtAdd2@",$tvendorRmtAdd2);    
    $TemplateText = Replace($TemplateText,"@tvendorRmtZip@",$tvendorRmtZip);    
    $TemplateText = Replace($TemplateText,"@tvendorRmtCity@",$tvendorRmtCity);    
    $TemplateText = Replace($TemplateText,"@tvendorContact@",$tvendorContact);    
    $TemplateText = Replace($TemplateText,"@tvendorDiscountPct@",$tvendorDiscountPct);    
    $TemplateText = Replace($TemplateText,"@tvendorDiscountDays@",$tvendorDiscountDays);    
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
    $ClarionData .= "<a href=BrowseAttendanceStatus" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tvendor","CountryID");
$myQuoteID2 = getQuote($objConn1,"tvendor","BranchID");
$myQuoteID3 = getQuote($objConn1,"tvendor","ID");
$strSQLBase  = "SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax, tvendor.Phone, tvendor.RmtAdd1, tvendor.RmtAdd2, tvendor.RmtZip, tvendor.RmtCity, tvendor.Contact, tvendor.DiscountPct, tvendor.DiscountDays  FROM  tvendor  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tvendor.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tvendor.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tvendor.ID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tvendor.ID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tvendor.ID ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStvendor = $objConn1->SelectLimit($strSQL,1);
if (($oRStvendor->EOF == TRUE) || ($oRStvendor->CurrentRow() == -1)):
    $oRStvendor->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStvendor->MoveFirst() == FALSE):
    $oRStvendor->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStvendor->Fields("CountryID");
$ID2 = $oRStvendor->Fields("BranchID");
$ID3 = $oRStvendor->Fields("ID");
if (is_null($oRStvendor->Fields("CountryID"))):
    $tvendorCountryID  = "";
else:
    if (is_numeric($oRStvendor->Fields("CountryID"))):
        $tvendorCountryID  = getValue($oRStvendor->Fields("CountryID"));
    else:
        $tvendorCountryID  = htmlentities(getValue($oRStvendor->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStvendor->Fields("BranchID"))):
    $tvendorBranchID  = "";
else:
    if (is_numeric($oRStvendor->Fields("BranchID"))):
        $tvendorBranchID  = getValue($oRStvendor->Fields("BranchID"));
    else:
        $tvendorBranchID  = htmlentities(getValue($oRStvendor->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStvendor->Fields("ID"))):
    $tvendorID  = "";
else:
    if (is_numeric($oRStvendor->Fields("ID"))):
        $tvendorID  = getValue($oRStvendor->Fields("ID"));
    else:
        $tvendorID  = htmlentities(getValue($oRStvendor->Fields("ID")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Name"))):
    $tvendorName  = "";
else:
    if (is_numeric($oRStvendor->Fields("Name"))):
        $tvendorName  = getValue($oRStvendor->Fields("Name"));
    else:
        $tvendorName  = htmlentities(getValue($oRStvendor->Fields("Name")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Address1"))):
    $tvendorAddress1  = "";
else:
    if (is_numeric($oRStvendor->Fields("Address1"))):
        $tvendorAddress1  = getValue($oRStvendor->Fields("Address1"));
    else:
        $tvendorAddress1  = htmlentities(getValue($oRStvendor->Fields("Address1")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Address2"))):
    $tvendorAddress2  = "";
else:
    if (is_numeric($oRStvendor->Fields("Address2"))):
        $tvendorAddress2  = getValue($oRStvendor->Fields("Address2"));
    else:
        $tvendorAddress2  = htmlentities(getValue($oRStvendor->Fields("Address2")));
    endif;
endif;
if (is_null($oRStvendor->Fields("City"))):
    $tvendorCity  = "";
else:
    if (is_numeric($oRStvendor->Fields("City"))):
        $tvendorCity  = getValue($oRStvendor->Fields("City"));
    else:
        $tvendorCity  = htmlentities(getValue($oRStvendor->Fields("City")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Zip"))):
    $tvendorZip  = "";
else:
    if (is_numeric($oRStvendor->Fields("Zip"))):
        $tvendorZip  = getValue($oRStvendor->Fields("Zip"));
    else:
        $tvendorZip  = htmlentities(getValue($oRStvendor->Fields("Zip")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Fax"))):
    $tvendorFax  = "";
else:
    if (is_numeric($oRStvendor->Fields("Fax"))):
        $tvendorFax  = getValue($oRStvendor->Fields("Fax"));
    else:
        $tvendorFax  = htmlentities(getValue($oRStvendor->Fields("Fax")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Phone"))):
    $tvendorPhone  = "";
else:
    if (is_numeric($oRStvendor->Fields("Phone"))):
        $tvendorPhone  = getValue($oRStvendor->Fields("Phone"));
    else:
        $tvendorPhone  = htmlentities(getValue($oRStvendor->Fields("Phone")));
    endif;
endif;
if (is_null($oRStvendor->Fields("RmtAdd1"))):
    $tvendorRmtAdd1  = "";
else:
    if (is_numeric($oRStvendor->Fields("RmtAdd1"))):
        $tvendorRmtAdd1  = getValue($oRStvendor->Fields("RmtAdd1"));
    else:
        $tvendorRmtAdd1  = htmlentities(getValue($oRStvendor->Fields("RmtAdd1")));
    endif;
endif;
if (is_null($oRStvendor->Fields("RmtAdd2"))):
    $tvendorRmtAdd2  = "";
else:
    if (is_numeric($oRStvendor->Fields("RmtAdd2"))):
        $tvendorRmtAdd2  = getValue($oRStvendor->Fields("RmtAdd2"));
    else:
        $tvendorRmtAdd2  = htmlentities(getValue($oRStvendor->Fields("RmtAdd2")));
    endif;
endif;
if (is_null($oRStvendor->Fields("RmtZip"))):
    $tvendorRmtZip  = "";
else:
    if (is_numeric($oRStvendor->Fields("RmtZip"))):
        $tvendorRmtZip  = getValue($oRStvendor->Fields("RmtZip"));
    else:
        $tvendorRmtZip  = htmlentities(getValue($oRStvendor->Fields("RmtZip")));
    endif;
endif;
if (is_null($oRStvendor->Fields("RmtCity"))):
    $tvendorRmtCity  = "";
else:
    if (is_numeric($oRStvendor->Fields("RmtCity"))):
        $tvendorRmtCity  = getValue($oRStvendor->Fields("RmtCity"));
    else:
        $tvendorRmtCity  = htmlentities(getValue($oRStvendor->Fields("RmtCity")));
    endif;
endif;
if (is_null($oRStvendor->Fields("Contact"))):
    $tvendorContact  = "";
else:
    if (is_numeric($oRStvendor->Fields("Contact"))):
        $tvendorContact  = getValue($oRStvendor->Fields("Contact"));
    else:
        $tvendorContact  = htmlentities(getValue($oRStvendor->Fields("Contact")));
    endif;
endif;
if (is_null($oRStvendor->Fields("DiscountPct"))):
    $tvendorDiscountPct  = "";
else:
    if (is_numeric($oRStvendor->Fields("DiscountPct"))):
        $tvendorDiscountPct  = getValue($oRStvendor->Fields("DiscountPct"));
    else:
        $tvendorDiscountPct  = htmlentities(getValue($oRStvendor->Fields("DiscountPct")));
    endif;
endif;
if (is_null($oRStvendor->Fields("DiscountDays"))):
    $tvendorDiscountDays  = "";
else:
    if (is_numeric($oRStvendor->Fields("DiscountDays"))):
        $tvendorDiscountDays  = getValue($oRStvendor->Fields("DiscountDays"));
    else:
        $tvendorDiscountDays  = htmlentities(getValue($oRStvendor->Fields("DiscountDays")));
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
$dbNavBarPrev = "<a href=Updatetvendor" . "view.php?";
$dbNavBarNext = "<a href=Updatetvendor" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStvendor->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStvendor->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStvendor->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStvendor->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStvendor->Fields("ID");
$dbNavBarNext  .= "&ID3=" . $oRStvendor->Fields("ID");
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
$oRStvendor->Close();
MergeUpdatetvendorTemplate($HTML_Template);
unset($oRStvendor);
    $objConn1->Close();
    unset($objConn1);
?>
