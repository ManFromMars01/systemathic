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
$UpdatetsubcategFormAction = "Updatetsubcateg" . "edit.php";
$tsubcategCountryID = "";
$tsubcategBranchID = "";
$tsubcategCatID = "";
$tsubcategSubCatID = "";
$tsubcategDescription = "";
function  MergeUpdatetsubcategTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetsubcateg" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;

    global $UpdatetsubcategFormAction;
    global $tsubcategCountryID;
    global $tsubcategBranchID;
    global $tsubcategCatID;
    global $tsubcategSubCatID;
    global $tsubcategDescription;
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

    $TemplateText = Replace($TemplateText,"@UpdatetsubcategFormAction@",$UpdatetsubcategFormAction);    
    $TemplateText = Replace($TemplateText,"@tsubcategCountryID@",$tsubcategCountryID);    
    $TemplateText = Replace($TemplateText,"@tsubcategBranchID@",$tsubcategBranchID);    
    $TemplateText = Replace($TemplateText,"@tsubcategCatID@",$tsubcategCatID);    
    $TemplateText = Replace($TemplateText,"@tsubcategSubCatID@",$tsubcategSubCatID);    
    $TemplateText = Replace($TemplateText,"@tsubcategDescription@",$tsubcategDescription);    
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
$myQuoteID1 = getQuote($objConn1,"tsubcateg","CountryID");
$myQuoteID2 = getQuote($objConn1,"tsubcateg","BranchID");
$myQuoteID3 = getQuote($objConn1,"tsubcateg","CatID");
$strSQLBase  = "SELECT tsubcateg.CountryID, tsubcateg.BranchID, tsubcateg.CatID, tsubcateg.SubCatID, tsubcateg.Description  FROM  tsubcateg  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tsubcateg.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tsubcateg.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tsubcateg.CatID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tsubcateg.CatID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID3 . $ID3 . $myQuoteID3 . " ORDER BY tsubcateg.CatID ASC";
else:
    $strSQL .= " = " . $myQuoteID3 . $ID3 . $myQuoteID3;
endif;

$oRStsubcateg = $objConn1->SelectLimit($strSQL,1);
if (($oRStsubcateg->EOF == TRUE) || ($oRStsubcateg->CurrentRow() == -1)):
    $oRStsubcateg->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStsubcateg->MoveFirst() == FALSE):
    $oRStsubcateg->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStsubcateg->Fields("CountryID");
$ID2 = $oRStsubcateg->Fields("BranchID");
$ID3 = $oRStsubcateg->Fields("CatID");
if (is_null($oRStsubcateg->Fields("CountryID"))):
    $tsubcategCountryID  = "";
else:
    if (is_numeric($oRStsubcateg->Fields("CountryID"))):
        $tsubcategCountryID  = getValue($oRStsubcateg->Fields("CountryID"));
    else:
        $tsubcategCountryID  = htmlentities(getValue($oRStsubcateg->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStsubcateg->Fields("BranchID"))):
    $tsubcategBranchID  = "";
else:
    if (is_numeric($oRStsubcateg->Fields("BranchID"))):
        $tsubcategBranchID  = getValue($oRStsubcateg->Fields("BranchID"));
    else:
        $tsubcategBranchID  = htmlentities(getValue($oRStsubcateg->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStsubcateg->Fields("CatID"))):
    $tsubcategCatID  = "";
else:
    if (is_numeric($oRStsubcateg->Fields("CatID"))):
        $tsubcategCatID  = getValue($oRStsubcateg->Fields("CatID"));
    else:
        $tsubcategCatID  = htmlentities(getValue($oRStsubcateg->Fields("CatID")));
    endif;
endif;
if (is_null($oRStsubcateg->Fields("SubCatID"))):
    $tsubcategSubCatID  = "";
else:
    if (is_numeric($oRStsubcateg->Fields("SubCatID"))):
        $tsubcategSubCatID  = getValue($oRStsubcateg->Fields("SubCatID"));
    else:
        $tsubcategSubCatID  = htmlentities(getValue($oRStsubcateg->Fields("SubCatID")));
    endif;
endif;
if (is_null($oRStsubcateg->Fields("Description"))):
    $tsubcategDescription  = "";
else:
    if (is_numeric($oRStsubcateg->Fields("Description"))):
        $tsubcategDescription  = getValue($oRStsubcateg->Fields("Description"));
    else:
        $tsubcategDescription  = htmlentities(getValue($oRStsubcateg->Fields("Description")));
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
$dbNavBarPrev = "<a href=Updatetsubcateg" . "view.php?";
$dbNavBarNext = "<a href=Updatetsubcateg" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStsubcateg->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStsubcateg->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStsubcateg->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStsubcateg->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStsubcateg->Fields("CatID");
$dbNavBarNext  .= "&ID3=" . $oRStsubcateg->Fields("CatID");
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
$oRStsubcateg->Close();
MergeUpdatetsubcategTemplate($HTML_Template);
unset($oRStsubcateg);
    $objConn1->Close();
    unset($objConn1);
?>
