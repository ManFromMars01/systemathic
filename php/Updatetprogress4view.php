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
$ID4 = "";
$ID5 = "";
$ID6 = "";
$Updatetprogress4FormAction = "Updatetprogress4" . "edit.php";
$tprogress4CountryID = "";
$tprogress4BranchID = "";
$tprogress4Level1ID = "";
$tprogress4Level2ID = "";
$tprogress4Level3ID = "";
$tprogress4Rating = "";
$tprogress4Description = "";
function  MergeUpdatetprogress4Template($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress4" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;
    global $ID5;
    global $ID6;

    global $Updatetprogress4FormAction;
    global $tprogress4CountryID;
    global $tprogress4BranchID;
    global $tprogress4Level1ID;
    global $tprogress4Level2ID;
    global $tprogress4Level3ID;
    global $tprogress4Rating;
    global $tprogress4Description;
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

    $TemplateText = Replace($TemplateText,"@Updatetprogress4FormAction@",$Updatetprogress4FormAction);    
    $TemplateText = Replace($TemplateText,"@tprogress4CountryID@",$tprogress4CountryID);    
    $TemplateText = Replace($TemplateText,"@tprogress4BranchID@",$tprogress4BranchID);    
    $TemplateText = Replace($TemplateText,"@tprogress4Level1ID@",$tprogress4Level1ID);    
    $TemplateText = Replace($TemplateText,"@tprogress4Level2ID@",$tprogress4Level2ID);    
    $TemplateText = Replace($TemplateText,"@tprogress4Level3ID@",$tprogress4Level3ID);    
    $TemplateText = Replace($TemplateText,"@tprogress4Rating@",$tprogress4Rating);    
    $TemplateText = Replace($TemplateText,"@tprogress4Description@",$tprogress4Description);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@ID4@",$ID4);    
    $TemplateText = Replace($TemplateText,"@ID5@",$ID5);    
    $TemplateText = Replace($TemplateText,"@ID6@",$ID6);    
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
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
if (getRequest("ID5") == ""):
    displayBadRecord();
endif;
if (getRequest("ID6") == ""):
    displayBadRecord();
endif;
     $ID1 = trim(htmlDecode(getRequest("ID1")),"'");
     $ID2 = trim(htmlDecode(getRequest("ID2")),"'");
     $ID3 = trim(htmlDecode(getRequest("ID3")),"'");
     $ID4 = trim(htmlDecode(getRequest("ID4")),"'");
     $ID5 = trim(htmlDecode(getRequest("ID5")),"'");
     $ID6 = trim(htmlDecode(getRequest("ID6")),"'");
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
$myQuoteID1 = getQuote($objConn1,"tprogress4","CountryID");
$myQuoteID2 = getQuote($objConn1,"tprogress4","BranchID");
$myQuoteID3 = getQuote($objConn1,"tprogress4","Level1ID");
$myQuoteID4 = getQuote($objConn1,"tprogress4","Level2ID");
$myQuoteID5 = getQuote($objConn1,"tprogress4","Level3ID");
$myQuoteID6 = getQuote($objConn1,"tprogress4","Rating");
$strSQLBase  = "SELECT tprogress4.CountryID, tprogress4.BranchID, tprogress4.Level1ID, tprogress4.Level2ID, tprogress4.Level3ID, tprogress4.Rating, tprogress4.Description  FROM  tprogress4  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tprogress4.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tprogress4.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tprogress4.Level1ID=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND tprogress4.Level2ID=" . $myQuoteID4 . $ID4 . $myQuoteID4;
$strSQL .= " AND tprogress4.Level3ID=" . $myQuoteID5 . $ID5 . $myQuoteID5;
$strSQL .= " AND tprogress4.Rating ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID6 . $ID6 . $myQuoteID6 . " ORDER BY tprogress4.Rating DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID6 . $ID6 . $myQuoteID6 . " ORDER BY tprogress4.Rating ASC";
else:
    $strSQL .= " = " . $myQuoteID6 . $ID6 . $myQuoteID6;
endif;

$oRStprogress4 = $objConn1->SelectLimit($strSQL,1);
if (($oRStprogress4->EOF == TRUE) || ($oRStprogress4->CurrentRow() == -1)):
    $oRStprogress4->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStprogress4->MoveFirst() == FALSE):
    $oRStprogress4->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStprogress4->Fields("CountryID");
$ID2 = $oRStprogress4->Fields("BranchID");
$ID3 = $oRStprogress4->Fields("Level1ID");
$ID4 = $oRStprogress4->Fields("Level2ID");
$ID5 = $oRStprogress4->Fields("Level3ID");
$ID6 = $oRStprogress4->Fields("Rating");
if (is_null($oRStprogress4->Fields("CountryID"))):
    $tprogress4CountryID  = "";
else:
    if (is_numeric($oRStprogress4->Fields("CountryID"))):
        $tprogress4CountryID  = getValue($oRStprogress4->Fields("CountryID"));
    else:
        $tprogress4CountryID  = htmlentities(getValue($oRStprogress4->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("BranchID"))):
    $tprogress4BranchID  = "";
else:
    if (is_numeric($oRStprogress4->Fields("BranchID"))):
        $tprogress4BranchID  = getValue($oRStprogress4->Fields("BranchID"));
    else:
        $tprogress4BranchID  = htmlentities(getValue($oRStprogress4->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("Level1ID"))):
    $tprogress4Level1ID  = "";
else:
    if (is_numeric($oRStprogress4->Fields("Level1ID"))):
        $tprogress4Level1ID  = getValue($oRStprogress4->Fields("Level1ID"));
    else:
        $tprogress4Level1ID  = htmlentities(getValue($oRStprogress4->Fields("Level1ID")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("Level2ID"))):
    $tprogress4Level2ID  = "";
else:
    if (is_numeric($oRStprogress4->Fields("Level2ID"))):
        $tprogress4Level2ID  = getValue($oRStprogress4->Fields("Level2ID"));
    else:
        $tprogress4Level2ID  = htmlentities(getValue($oRStprogress4->Fields("Level2ID")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("Level3ID"))):
    $tprogress4Level3ID  = "";
else:
    if (is_numeric($oRStprogress4->Fields("Level3ID"))):
        $tprogress4Level3ID  = getValue($oRStprogress4->Fields("Level3ID"));
    else:
        $tprogress4Level3ID  = htmlentities(getValue($oRStprogress4->Fields("Level3ID")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("Rating"))):
    $tprogress4Rating  = "";
else:
    if (is_numeric($oRStprogress4->Fields("Rating"))):
        $tprogress4Rating  = getValue($oRStprogress4->Fields("Rating"));
    else:
        $tprogress4Rating  = htmlentities(getValue($oRStprogress4->Fields("Rating")));
    endif;
endif;
if (is_null($oRStprogress4->Fields("Description"))):
    $tprogress4Description  = "";
else:
    if (is_numeric($oRStprogress4->Fields("Description"))):
        $tprogress4Description  = getValue($oRStprogress4->Fields("Description"));
    else:
        $tprogress4Description  = htmlentities(getValue($oRStprogress4->Fields("Description")));
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
$dbNavBarPrev = "<a href=Updatetprogress4" . "view.php?";
$dbNavBarNext = "<a href=Updatetprogress4" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStprogress4->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStprogress4->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStprogress4->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStprogress4->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStprogress4->Fields("Level1ID");
$dbNavBarNext  .= "&ID3=" . $oRStprogress4->Fields("Level1ID");
$dbNavBarPrev  .= "&ID4=" . $oRStprogress4->Fields("Level2ID");
$dbNavBarNext  .= "&ID4=" . $oRStprogress4->Fields("Level2ID");
$dbNavBarPrev  .= "&ID5=" . $oRStprogress4->Fields("Level3ID");
$dbNavBarNext  .= "&ID5=" . $oRStprogress4->Fields("Level3ID");
$dbNavBarPrev  .= "&ID6=" . $oRStprogress4->Fields("Rating");
$dbNavBarNext  .= "&ID6=" . $oRStprogress4->Fields("Rating");
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
$oRStprogress4->Close();
MergeUpdatetprogress4Template($HTML_Template);
unset($oRStprogress4);
    $objConn1->Close();
    unset($objConn1);
?>
