<?php
session_set_cookie_params(500);
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
$ID4 = "";
$UpdatetdroleFormAction = "Updatetdrole" . "edit.php";
$tdroleCountryID = "";
$tdroleBranchID = "";
$tdroleRoleID = "";
$tdrolePageName = "";
$tdroleInsertPrev = "";
$tdroleEditPrev = "";
$tdroleDeletePrev = "";
$tdroleViewPrev = "";
function  MergeUpdatetdroleTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdrole" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;

    global $UpdatetdroleFormAction;
    global $tdroleCountryID;
    global $tdroleBranchID;
    global $tdroleRoleID;
    global $tdrolePageName;
    global $tdroleInsertPrev;
    global $tdroleEditPrev;
    global $tdroleDeletePrev;
    global $tdroleViewPrev;
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

    $TemplateText = Replace($TemplateText,"@UpdatetdroleFormAction@",$UpdatetdroleFormAction);    
    $TemplateText = Replace($TemplateText,"@tdroleCountryID@",$tdroleCountryID);    
    $TemplateText = Replace($TemplateText,"@tdroleBranchID@",$tdroleBranchID);    
    $TemplateText = Replace($TemplateText,"@tdroleRoleID@",$tdroleRoleID);    
    $TemplateText = Replace($TemplateText,"@tdrolePageName@",$tdrolePageName);    
    $TemplateText = Replace($TemplateText,"@tdroleInsertPrev@",$tdroleInsertPrev);    
    $TemplateText = Replace($TemplateText,"@tdroleEditPrev@",$tdroleEditPrev);    
    $TemplateText = Replace($TemplateText,"@tdroleDeletePrev@",$tdroleDeletePrev);    
    $TemplateText = Replace($TemplateText,"@tdroleViewPrev@",$tdroleViewPrev);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@ID4@",$ID4);    
    $TemplateText = Replace($TemplateText,"@Header@", $Header);    
    $TemplateText = Replace($TemplateText,"@Footer@", $Footer);    
    $TemplateText = Replace($TemplateText,"@MainContent@", $MainContent);    
    $TemplateText = Replace($TemplateText,"@Menu@", $Menu);    
    $TemplateText = Replace($TemplateText,"@userdata1@", $userdata1);    
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
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
     $ID1 = trim(htmlDecode(getRequest("ID1")),"'");
     $ID2 = trim(htmlDecode(getRequest("ID2")),"'");
     $ID3 = trim(htmlDecode(getRequest("ID3")),"'");
     $ID4 = trim(htmlDecode(getRequest("ID4")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseTDRole" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tdrole","CountryID");
$myQuoteID2 = getQuote($objConn1,"tdrole","BranchID");
$myQuoteID3 = getQuote($objConn1,"tdrole","RoleID");
$myQuoteID4 = getQuote($objConn1,"tdrole","PageName");
$strSQLBase  = "SELECT tdrole.CountryID, tdrole.BranchID, tdrole.RoleID, tdrole.PageName, tdrole.InsertPrev, tdrole.EditPrev, tdrole.DeletePrev, tdrole.ViewPrev  FROM  tdrole  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tdrole.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tdrole.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tdrole.RoleID=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND tdrole.PageName ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tdrole.PageName DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tdrole.PageName ASC";
else:
    $strSQL .= " = " . $myQuoteID4 . $ID4 . $myQuoteID4;
endif;

$oRStdrole = $objConn1->SelectLimit($strSQL,1);
if (($oRStdrole->EOF == TRUE) || ($oRStdrole->CurrentRow() == -1)):
    $oRStdrole->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStdrole->MoveFirst() == FALSE):
    $oRStdrole->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStdrole->Fields("CountryID");
$ID2 = $oRStdrole->Fields("BranchID");
$ID3 = $oRStdrole->Fields("RoleID");
$ID4 = $oRStdrole->Fields("PageName");
if (is_null($oRStdrole->Fields("CountryID"))):
    $tdroleCountryID  = "";
else:
    if (is_numeric($oRStdrole->Fields("CountryID"))):
        $tdroleCountryID  = getValue($oRStdrole->Fields("CountryID"));
    else:
        $tdroleCountryID  = htmlentities(getValue($oRStdrole->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStdrole->Fields("BranchID"))):
    $tdroleBranchID  = "";
else:
    if (is_numeric($oRStdrole->Fields("BranchID"))):
        $tdroleBranchID  = getValue($oRStdrole->Fields("BranchID"));
    else:
        $tdroleBranchID  = htmlentities(getValue($oRStdrole->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStdrole->Fields("RoleID"))):
    $tdroleRoleID  = "";
else:
    if (is_numeric($oRStdrole->Fields("RoleID"))):
        $tdroleRoleID  = getValue($oRStdrole->Fields("RoleID"));
    else:
        $tdroleRoleID  = htmlentities(getValue($oRStdrole->Fields("RoleID")));
    endif;
endif;
if (is_null($oRStdrole->Fields("PageName"))):
    $tdrolePageName  = "";
else:
    if (is_numeric($oRStdrole->Fields("PageName"))):
        $tdrolePageName  = getValue($oRStdrole->Fields("PageName"));
    else:
        $tdrolePageName  = htmlentities(getValue($oRStdrole->Fields("PageName")));
    endif;
endif;
if (is_null($oRStdrole->Fields("InsertPrev"))):
    $tdroleInsertPrev  = "";
else:
    if ("Y" == $oRStdrole->Fields("InsertPrev")):
        $tdroleInsertPrev  = htmlentities("Y");
    endif;
    if ("N" == $oRStdrole->Fields("InsertPrev")):
        $tdroleInsertPrev  = htmlentities("N");
    endif;
endif;
if (is_null($oRStdrole->Fields("EditPrev"))):
    $tdroleEditPrev  = "";
else:
    if ("Y" == $oRStdrole->Fields("EditPrev")):
        $tdroleEditPrev  = htmlentities("Y");
    endif;
    if ("N" == $oRStdrole->Fields("EditPrev")):
        $tdroleEditPrev  = htmlentities("N");
    endif;
endif;
if (is_null($oRStdrole->Fields("DeletePrev"))):
    $tdroleDeletePrev  = "";
else:
    if ("Y" == $oRStdrole->Fields("DeletePrev")):
        $tdroleDeletePrev  = htmlentities("Y");
    endif;
    if ("N" == $oRStdrole->Fields("DeletePrev")):
        $tdroleDeletePrev  = htmlentities("N");
    endif;
endif;
if (is_null($oRStdrole->Fields("ViewPrev"))):
    $tdroleViewPrev  = "";
else:
    if ("Y" == $oRStdrole->Fields("ViewPrev")):
        $tdroleViewPrev  = htmlentities("Y");
    endif;
    if ("N" == $oRStdrole->Fields("ViewPrev")):
        $tdroleViewPrev  = htmlentities("N");
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
$dbNavBarPrev = "<a href=Updatetdrole" . "view.php?";
$dbNavBarNext = "<a href=Updatetdrole" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStdrole->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStdrole->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStdrole->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStdrole->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStdrole->Fields("RoleID");
$dbNavBarNext  .= "&ID3=" . $oRStdrole->Fields("RoleID");
$dbNavBarPrev  .= "&ID4=" . $oRStdrole->Fields("PageName");
$dbNavBarNext  .= "&ID4=" . $oRStdrole->Fields("PageName");
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
$oRStdrole->Close();
MergeUpdatetdroleTemplate($HTML_Template);
unset($oRStdrole);
    $objConn1->Close();
    unset($objConn1);
?>
