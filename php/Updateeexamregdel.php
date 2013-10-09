<?php
ob_start();
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
$ClarionData = "";
$myStatus = "";
$myError = "";
$HTML_Template = getRequest("HTMLT");
//============================================================================='
// MergeTemplate 
//'============================================================================='
function MergeDelTemplate($Template) {
    if (!isset($Template) || ($Template == "")) {
        $Template = "./html/blank.htm";
    }       
    global $ClarionData;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
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

    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;      
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print($TemplateText);
}

if ( getRequest("ID1") == "") {
    displayBadRecord("No id");
}
if ( getRequest("ID2") == "") {
    displayBadRecord("No id");
}
if ( getRequest("ID3") == "") {
    displayBadRecord("No id");
}

function displayBadRecord($msg) {
    global $ClarionData;
    global $HTML_Template;
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td colspan='2' class='Input'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
    $ClarionData .= "<br>" . $msg . "<br></td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeDelTemplate($HTML_Template);
    exit;
}

include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$myFormAction = getForm("FormAction") == "" ? "0" : getForm("FormAction");

if ($myFormAction == "3") {
    $ID1 = htmlDecode(getRequest("ID1"));
    $ID2 = htmlDecode(getRequest("ID2"));
    $ID3 = htmlDecode(getRequest("ID3"));
    $mySQL = "DELETE FROM eexamreg WHERE  eexamreg.CountryID = '" . $ID1 . "'" . " AND eexamreg.BranchID = '" . $ID2 . "'" . " AND eexamreg.CustNo = " . $ID3;
    $objConn1->Execute($mySQL);
} // if myFormAction = 3

if (!$myFormAction == "3"):
    $ID1 = htmlDecode(getRequest("ID1"));
    $ID2 = htmlDecode(getRequest("ID2"));
    $ID3 = htmlDecode(getRequest("ID3"));
    $ClarionData = "<div class='bg'>\n";
    $ClarionData .= "<table class='Data'>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n";
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td colspan=2 class='Input'>\n";
    $ClarionData .= "<form action='' method='post' id=form1 name=form1>\n";
    $ClarionData .= "<input type='hidden' id='ID1' name='ID1' value='" . $ID1 . "'>\n";
    $ClarionData .= "<input type='hidden' id='ID2' name='ID2' value='" . $ID2 . "'>\n";
    $ClarionData .= "<input type='hidden' id='ID3' name='ID3' value='" . $ID3 . "'>\n";
    $ClarionData .= "<input type='hidden' id='FormAction' name='FormAction' value=\"3\">\n";
    $ClarionData .= "<br>The requested record will be deleted, please confirm.<br><br>\n";
    $ClarionData .= "<input type='submit' value='Delete' id='submit1' name='submit1' title='Delete this record'>\n";
    $ClarionData .= "</form>\n";
    $ClarionData .= "</td></tr></table></div>\n";
    MergeDelTemplate($HTML_Template);
    exit;
else:
    if ($objConn1->Affected_Rows() == 0):
        $myStatus = "Your delete failed <br><br>";
    else:
        $myStatus = "Your delete succeeded <br><br>";
    endif;
    $ClarionData  = "<div class='bg'>\n";
    $ClarionData .= "<table class='Data'>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n";
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td colspan=2 class='Input'>\n";
    $ClarionData .= "<br>" . $myStatus . "<br><br>\n";
    if(getSession("BrowseAssessment#WHR") != ""):
        $ClarionData .= "<a href=BrowseAssessment" . "list.php?SUBSET=TRUE>Return to list</a>\n";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $ClarionData .= "<a href=" . htmlEncode($_SESSION["ChildReturnTo"]) . ">Return to list</a>\n";
        else:
          $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
        endif;
    endif;
    $ClarionData .= "</td></tr></table></div>\n";
    MergeDelTemplate($HTML_Template);
endif;
$objConn1->Close();
unset($objConn1);
ob_flush();
?> 
