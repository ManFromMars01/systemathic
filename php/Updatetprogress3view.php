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
$Updatetprogress3FormAction = "Updatetprogress3" . "edit.php";
$tprogress3CountryID = "";
$tprogress3BranchID = "";
$tprogress3Level1ID = "";
$tprogress3Level2ID = "";
$tprogress3Level3ID = "";
$tprogress3Description = "";
function  MergeUpdatetprogress3Template($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress3" . "view.htm";
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

    global $Updatetprogress3FormAction;
    global $tprogress3CountryID;
    global $tprogress3BranchID;
    global $tprogress3Level1ID;
    global $tprogress3Level2ID;
    global $tprogress3Level3ID;
    global $tprogress3Description;
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

    $TemplateText = Replace($TemplateText,"@Updatetprogress3FormAction@",$Updatetprogress3FormAction);    
    $TemplateText = Replace($TemplateText,"@tprogress3CountryID@",$tprogress3CountryID);    
    $TemplateText = Replace($TemplateText,"@tprogress3BranchID@",$tprogress3BranchID);    
    $TemplateText = Replace($TemplateText,"@tprogress3Level1ID@",$tprogress3Level1ID);    
    $TemplateText = Replace($TemplateText,"@tprogress3Level2ID@",$tprogress3Level2ID);    
    $TemplateText = Replace($TemplateText,"@tprogress3Level3ID@",$tprogress3Level3ID);    
    $TemplateText = Replace($TemplateText,"@tprogress3Description@",$tprogress3Description);    
    $TemplateText = Replace($TemplateText,"@EditOptions@",$EditOptions);    
    $TemplateText = Replace($TemplateText,"@dbNavBar@",$dbNavBar);        
    $TemplateText = Replace($TemplateText,"@ID1@",$ID1);    
    $TemplateText = Replace($TemplateText,"@ID2@",$ID2);    
    $TemplateText = Replace($TemplateText,"@ID3@",$ID3);    
    $TemplateText = Replace($TemplateText,"@ID4@",$ID4);    
    $TemplateText = Replace($TemplateText,"@ID5@",$ID5);    
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
     $ID1 = trim(htmlDecode(getRequest("ID1")),"'");
     $ID2 = trim(htmlDecode(getRequest("ID2")),"'");
     $ID3 = trim(htmlDecode(getRequest("ID3")),"'");
     $ID4 = trim(htmlDecode(getRequest("ID4")),"'");
     $ID5 = trim(htmlDecode(getRequest("ID5")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseTProgress3" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tprogress3","CountryID");
$myQuoteID2 = getQuote($objConn1,"tprogress3","BranchID");
$myQuoteID3 = getQuote($objConn1,"tprogress3","Level1ID");
$myQuoteID4 = getQuote($objConn1,"tprogress3","Level2ID");
$myQuoteID5 = getQuote($objConn1,"tprogress3","Level3ID");
$strSQLBase  = "SELECT tprogress3.CountryID, tprogress3.BranchID, tprogress3.Level1ID, tprogress3.Level2ID, tprogress3.Level3ID, tprogress3.Description  FROM  tprogress3  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tprogress3.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tprogress3.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tprogress3.Level1ID=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND tprogress3.Level2ID=" . $myQuoteID4 . $ID4 . $myQuoteID4;
$strSQL .= " AND tprogress3.Level3ID ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID5 . $ID5 . $myQuoteID5 . " ORDER BY tprogress3.Level3ID DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID5 . $ID5 . $myQuoteID5 . " ORDER BY tprogress3.Level3ID ASC";
else:
    $strSQL .= " = " . $myQuoteID5 . $ID5 . $myQuoteID5;
endif;

$oRStprogress3 = $objConn1->SelectLimit($strSQL,1);
if (($oRStprogress3->EOF == TRUE) || ($oRStprogress3->CurrentRow() == -1)):
    $oRStprogress3->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStprogress3->MoveFirst() == FALSE):
    $oRStprogress3->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStprogress3->Fields("CountryID");
$ID2 = $oRStprogress3->Fields("BranchID");
$ID3 = $oRStprogress3->Fields("Level1ID");
$ID4 = $oRStprogress3->Fields("Level2ID");
$ID5 = $oRStprogress3->Fields("Level3ID");
if (is_null($oRStprogress3->Fields("CountryID"))):
    $tprogress3CountryID  = "";
else:
    if (is_numeric($oRStprogress3->Fields("CountryID"))):
        $tprogress3CountryID  = getValue($oRStprogress3->Fields("CountryID"));
    else:
        $tprogress3CountryID  = htmlentities(getValue($oRStprogress3->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStprogress3->Fields("BranchID"))):
    $tprogress3BranchID  = "";
else:
    if (is_numeric($oRStprogress3->Fields("BranchID"))):
        $tprogress3BranchID  = getValue($oRStprogress3->Fields("BranchID"));
    else:
        $tprogress3BranchID  = htmlentities(getValue($oRStprogress3->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStprogress3->Fields("Level1ID"))):
    $tprogress3Level1ID  = "";
else:
    if (is_numeric($oRStprogress3->Fields("Level1ID"))):
        $tprogress3Level1ID  = getValue($oRStprogress3->Fields("Level1ID"));
    else:
        $tprogress3Level1ID  = htmlentities(getValue($oRStprogress3->Fields("Level1ID")));
    endif;
endif;
if (is_null($oRStprogress3->Fields("Level2ID"))):
    $tprogress3Level2ID  = "";
else:
    if (is_numeric($oRStprogress3->Fields("Level2ID"))):
        $tprogress3Level2ID  = getValue($oRStprogress3->Fields("Level2ID"));
    else:
        $tprogress3Level2ID  = htmlentities(getValue($oRStprogress3->Fields("Level2ID")));
    endif;
endif;
if (is_null($oRStprogress3->Fields("Level3ID"))):
    $tprogress3Level3ID  = "";
else:
    if (is_numeric($oRStprogress3->Fields("Level3ID"))):
        $tprogress3Level3ID  = getValue($oRStprogress3->Fields("Level3ID"));
    else:
        $tprogress3Level3ID  = htmlentities(getValue($oRStprogress3->Fields("Level3ID")));
    endif;
    $tprogress3Level3ID  = strtoupper($tprogress3Level3ID);
endif;
if (is_null($oRStprogress3->Fields("Description"))):
    $tprogress3Description  = "";
else:
    if (is_numeric($oRStprogress3->Fields("Description"))):
        $tprogress3Description  = getValue($oRStprogress3->Fields("Description"));
    else:
        $tprogress3Description  = htmlentities(getValue($oRStprogress3->Fields("Description")));
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
$dbNavBarPrev = "<a href=Updatetprogress3" . "view.php?";
$dbNavBarNext = "<a href=Updatetprogress3" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStprogress3->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStprogress3->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStprogress3->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStprogress3->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStprogress3->Fields("Level1ID");
$dbNavBarNext  .= "&ID3=" . $oRStprogress3->Fields("Level1ID");
$dbNavBarPrev  .= "&ID4=" . $oRStprogress3->Fields("Level2ID");
$dbNavBarNext  .= "&ID4=" . $oRStprogress3->Fields("Level2ID");
$dbNavBarPrev  .= "&ID5=" . $oRStprogress3->Fields("Level3ID");
$dbNavBarNext  .= "&ID5=" . $oRStprogress3->Fields("Level3ID");
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
$oRStprogress3->Close();
MergeUpdatetprogress3Template($HTML_Template);
unset($oRStprogress3);
    $objConn1->Close();
    unset($objConn1);
?>
