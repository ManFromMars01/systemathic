<?PHP
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
$DeleteButton = "";
$Updatetprogress2FormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress2" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;
    global $Updatetprogress2FormAction;
    global $tprogress2CountryID;
    global $tprogress2BranchID;
    global $tprogress2Level1ID;
    global $tprogress2Level2ID;
    global $tprogress2Description;
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@Updatetprogress2FormAction@",$Updatetprogress2FormAction);    

     $TemplateText = Replace($TemplateText, "@tprogress2CountryID@", $tprogress2CountryID);
     $TemplateText = Replace($TemplateText, "@tprogress2BranchID@", $tprogress2BranchID);
     $TemplateText = Replace($TemplateText, "@tprogress2Level1ID@", $tprogress2Level1ID);
     $TemplateText = Replace($TemplateText, "@tprogress2Level2ID@", $tprogress2Level2ID);
     $TemplateText = Replace($TemplateText, "@tprogress2Description@", $tprogress2Description);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@Header@", $Header);
     $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
     $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
     $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStprogress2 = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
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
    $ClarionData .= "<a href=BrowseTProgress2" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress2" . "edit.htm";
    endif;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
        print($TemplateText);
        exit();        
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
        print($TemplateText);
        exit();
    endif;  
}

$sql = "SELECT tprogress2.CountryID, tprogress2.BranchID, tprogress2.Level1ID, tprogress2.Level2ID, tprogress2.Description  FROM  tprogress2 WHERE  tprogress2.CountryID = '" . $ID1 . "'" . " AND tprogress2.BranchID = '" . $ID2 . "'" . " AND tprogress2.Level1ID = '" . $ID3 . "'" . " AND tprogress2.Level2ID = '" . $ID4 . "'";
$oRStprogress2 = $objConn1->SelectLimit($sql,1);
if ($oRStprogress2->MoveFirst() == false):
    $oRStprogress2->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$Updatetprogress2FormAction = "Updatetprogress2editx.php";
$oRStprogress2CountryID = $oRStprogress2->fields["CountryID"];
$oRStprogress2BranchID = $oRStprogress2->fields["BranchID"];
$oRStprogress2Level1ID = $oRStprogress2->fields["Level1ID"];
$oRStprogress2Level2ID = $oRStprogress2->fields["Level2ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$tprogress2CountryID = "";
if (is_null($oRStprogress2->fields["CountryID"])):
$tprogress2CountryID = "";
else:
$tprogress2CountryID = trim(getValue($oRStprogress2->fields["CountryID"]));
endif;
$tprogress2BranchID = "";
if (is_null($oRStprogress2->fields["BranchID"])):
$tprogress2BranchID = "";
else:
$tprogress2BranchID = trim(getValue($oRStprogress2->fields["BranchID"]));
endif;
$tprogress2Level1ID = "";
if (is_null($oRStprogress2->fields["Level1ID"])):
$tprogress2Level1ID = "";
else:
$tprogress2Level1ID = trim(getValue($oRStprogress2->fields["Level1ID"]));
endif;
$tprogress2Level2ID = "";
if (is_null($oRStprogress2->fields["Level2ID"])):
$tprogress2Level2ID = "";
else:
$tprogress2Level2ID = trim(getValue($oRStprogress2->fields["Level2ID"]));
endif;
$tprogress2Description = "";
if (is_null($oRStprogress2->fields["Description"])):
$tprogress2Description = "";
else:
$tprogress2Description = trim(getValue($oRStprogress2->fields["Description"]));
endif;
$DeleteButton = "<form method='post' action='Updatetprogress2del.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatetprogress2_EditFailed"] == 1) {
  $tprogress2CountryID = $_SESSION["SavedEdittprogress2CountryID"];
  $tprogress2BranchID = $_SESSION["SavedEdittprogress2BranchID"];
  $tprogress2Level1ID = $_SESSION["SavedEdittprogress2Level1ID"];
  $tprogress2Level2ID = $_SESSION["SavedEdittprogress2Level2ID"];
  $tprogress2Description = $_SESSION["SavedEdittprogress2Description"];
}
else {
  $_SESSION["Updatetprogress2_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStprogress2);
$objConn1->Close();
unset($objConn1);
?>
