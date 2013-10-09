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
$ID4 = "";
$UpdatetchartFormAction = "Updatetchart" . "edit.php";
$tchartCountryID = "";
$tchartBranchID = "";
$tchartAccountNo = "";
$tchartDeptNo = "";
$tchartDescription = "";
$tchartType = "";
$tchartSubType = "";
$tchartStatus = "";
function  MergeUpdatetchartTemplate($Template){
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetchart" . "view.htm";
    endif;
    
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;

    global $UpdatetchartFormAction;
    global $tchartCountryID;
    global $tchartBranchID;
    global $tchartAccountNo;
    global $tchartDeptNo;
    global $tchartDescription;
    global $tchartType;
    global $tchartSubType;
    global $tchartStatus;
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

    $TemplateText = Replace($TemplateText,"@UpdatetchartFormAction@",$UpdatetchartFormAction);    
    $TemplateText = Replace($TemplateText,"@tchartCountryID@",$tchartCountryID);    
    $TemplateText = Replace($TemplateText,"@tchartBranchID@",$tchartBranchID);    
    $TemplateText = Replace($TemplateText,"@tchartAccountNo@",$tchartAccountNo);    
    $TemplateText = Replace($TemplateText,"@tchartDeptNo@",$tchartDeptNo);    
    $TemplateText = Replace($TemplateText,"@tchartDescription@",$tchartDescription);    
    $TemplateText = Replace($TemplateText,"@tchartType@",$tchartType);    
    $TemplateText = Replace($TemplateText,"@tchartSubType@",$tchartSubType);    
    $TemplateText = Replace($TemplateText,"@tchartStatus@",$tchartStatus);    
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
    $ClarionData .= "<a href=BrowseChart" . "list.php>Return to list</a>\n";
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
$myQuoteID1 = getQuote($objConn1,"tchart","CountryID");
$myQuoteID2 = getQuote($objConn1,"tchart","BranchID");
$myQuoteID3 = getQuote($objConn1,"tchart","AccountNo");
$myQuoteID4 = getQuote($objConn1,"tchart","DeptNo");
$strSQLBase  = "SELECT tchart.CountryID, tchart.BranchID, tchart.AccountNo, tchart.DeptNo, tchart.Description, tchart.Type, tchart.SubType, tchart.Status  FROM  tchart  ";
$strSQL = $strSQLBase . " WHERE ";

$strSQL .= "tchart.CountryID=" . $myQuoteID1 . $ID1 . $myQuoteID1;
$strSQL .= " AND tchart.BranchID=" . $myQuoteID2 . $ID2 . $myQuoteID2;
$strSQL .= " AND tchart.AccountNo=" . $myQuoteID3 . $ID3 . $myQuoteID3;
$strSQL .= " AND tchart.DeptNo ";
if (strtolower(getGet("NAV")) == "previous"):
    $myDirection = "p";
    $strSQL .= " < " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tchart.DeptNo DESC";
elseif (strtolower(getGet("NAV")) == "next"):
    $myDirection = "n";
    $strSQL .= " > " . $myQuoteID4 . $ID4 . $myQuoteID4 . " ORDER BY tchart.DeptNo ASC";
else:
    $strSQL .= " = " . $myQuoteID4 . $ID4 . $myQuoteID4;
endif;

$oRStchart = $objConn1->SelectLimit($strSQL,1);
if (($oRStchart->EOF == TRUE) || ($oRStchart->CurrentRow() == -1)):
    $oRStchart->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
if ($oRStchart->MoveFirst() == FALSE):
    $oRStchart->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$myValue = "";
$ID1 = $oRStchart->Fields("CountryID");
$ID2 = $oRStchart->Fields("BranchID");
$ID3 = $oRStchart->Fields("AccountNo");
$ID4 = $oRStchart->Fields("DeptNo");
if (is_null($oRStchart->Fields("CountryID"))):
    $tchartCountryID  = "";
else:
    if (is_numeric($oRStchart->Fields("CountryID"))):
        $tchartCountryID  = getValue($oRStchart->Fields("CountryID"));
    else:
        $tchartCountryID  = htmlentities(getValue($oRStchart->Fields("CountryID")));
    endif;
endif;
if (is_null($oRStchart->Fields("BranchID"))):
    $tchartBranchID  = "";
else:
    if (is_numeric($oRStchart->Fields("BranchID"))):
        $tchartBranchID  = getValue($oRStchart->Fields("BranchID"));
    else:
        $tchartBranchID  = htmlentities(getValue($oRStchart->Fields("BranchID")));
    endif;
endif;
if (is_null($oRStchart->Fields("AccountNo"))):
    $tchartAccountNo  = "";
else:
    if (is_numeric($oRStchart->Fields("AccountNo"))):
        $tchartAccountNo  = getValue($oRStchart->Fields("AccountNo"));
    else:
        $tchartAccountNo  = htmlentities(getValue($oRStchart->Fields("AccountNo")));
    endif;
            $tchartAccountNo = formatNumber($tchartAccountNo,0,0,0,',','.');     
endif;
if (is_null($oRStchart->Fields("DeptNo"))):
    $tchartDeptNo  = "";
else:
    if (is_numeric($oRStchart->Fields("DeptNo"))):
        $tchartDeptNo  = getValue($oRStchart->Fields("DeptNo"));
    else:
        $tchartDeptNo  = htmlentities(getValue($oRStchart->Fields("DeptNo")));
    endif;
endif;
if (is_null($oRStchart->Fields("Description"))):
    $tchartDescription  = "";
else:
    if (is_numeric($oRStchart->Fields("Description"))):
        $tchartDescription  = getValue($oRStchart->Fields("Description"));
    else:
        $tchartDescription  = htmlentities(getValue($oRStchart->Fields("Description")));
    endif;
endif;
if (is_null($oRStchart->Fields("Type"))):
    $tchartType    =    "";
else:
    $tchartType  = htmlentities($oRStchart->Fields("Type"));
endif;
if (is_null($oRStchart->Fields("SubType"))):
    $tchartSubType  = "";
else:
    if (is_numeric($oRStchart->Fields("SubType"))):
        $tchartSubType  = getValue($oRStchart->Fields("SubType"));
    else:
        $tchartSubType  = htmlentities(getValue($oRStchart->Fields("SubType")));
    endif;
endif;
if (is_null($oRStchart->Fields("Status"))):
    $tchartStatus    =    "";
else:
    $tchartStatus  = htmlentities($oRStchart->Fields("Status"));
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
$dbNavBarPrev = "<a href=Updatetchart" . "view.php?";
$dbNavBarNext = "<a href=Updatetchart" . "view.php?";
$dbNavBarPrev  .= "ID1=" . $oRStchart->Fields("CountryID");
$dbNavBarNext  .= "ID1=" . $oRStchart->Fields("CountryID");
$dbNavBarPrev  .= "&ID2=" . $oRStchart->Fields("BranchID");
$dbNavBarNext  .= "&ID2=" . $oRStchart->Fields("BranchID");
$dbNavBarPrev  .= "&ID3=" . $oRStchart->Fields("AccountNo");
$dbNavBarNext  .= "&ID3=" . $oRStchart->Fields("AccountNo");
$dbNavBarPrev  .= "&ID4=" . $oRStchart->Fields("DeptNo");
$dbNavBarNext  .= "&ID4=" . $oRStchart->Fields("DeptNo");
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
$oRStchart->Close();
MergeUpdatetchartTemplate($HTML_Template);
unset($oRStchart);
    $objConn1->Close();
    unset($objConn1);
?>
