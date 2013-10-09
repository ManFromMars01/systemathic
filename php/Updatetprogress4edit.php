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
$DeleteButton = "";
$Updatetprogress4FormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress4" . "edit.htm";
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@Updatetprogress4FormAction@",$Updatetprogress4FormAction);    

     $TemplateText = Replace($TemplateText, "@tprogress4CountryID@", $tprogress4CountryID);
     $TemplateText = Replace($TemplateText, "@tprogress4BranchID@", $tprogress4BranchID);
     $TemplateText = Replace($TemplateText, "@tprogress4Level1ID@", $tprogress4Level1ID);
     $TemplateText = Replace($TemplateText, "@tprogress4Level2ID@", $tprogress4Level2ID);
     $TemplateText = Replace($TemplateText, "@tprogress4Level3ID@", $tprogress4Level3ID);
     $TemplateText = Replace($TemplateText, "@tprogress4Rating@", $tprogress4Rating);
     $TemplateText = Replace($TemplateText, "@tprogress4Description@", $tprogress4Description);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@ID5@", trim($ID5,"'"));
     $TemplateText = Replace($TemplateText, "@ID6@", trim($ID6,"'"));
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
$oRStprogress4 = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
$ID6 = trim(htmlDecode(getRequest("ID6")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
$ID6 = trim(htmlDecode(getRequest("ID6")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
$ID6 = trim(htmlDecode(getRequest("ID6")),"'");
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
$ID6 = trim(htmlDecode(getRequest("ID6")),"'");
if (getRequest("ID5") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
$ID6 = trim(htmlDecode(getRequest("ID6")),"'");
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
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress4" . "edit.htm";
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

$sql = "SELECT tprogress4.CountryID, tprogress4.BranchID, tprogress4.Level1ID, tprogress4.Level2ID, tprogress4.Level3ID, tprogress4.Rating, tprogress4.Description  FROM  tprogress4 WHERE  tprogress4.CountryID = '" . $ID1 . "'" . " AND tprogress4.BranchID = '" . $ID2 . "'" . " AND tprogress4.Level1ID = '" . $ID3 . "'" . " AND tprogress4.Level2ID = '" . $ID4 . "'" . " AND tprogress4.Level3ID = '" . $ID5 . "'" . " AND tprogress4.Rating = " . $ID6;
$oRStprogress4 = $objConn1->SelectLimit($sql,1);
if ($oRStprogress4->MoveFirst() == false):
    $oRStprogress4->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$Updatetprogress4FormAction = "Updatetprogress4editx.php";
$oRStprogress4CountryID = $oRStprogress4->fields["CountryID"];
$oRStprogress4BranchID = $oRStprogress4->fields["BranchID"];
$oRStprogress4Level1ID = $oRStprogress4->fields["Level1ID"];
$oRStprogress4Level2ID = $oRStprogress4->fields["Level2ID"];
$oRStprogress4Level3ID = $oRStprogress4->fields["Level3ID"];
$oRStprogress4Rating = $oRStprogress4->fields["Rating"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));
$ID5  =  htmlDecode(getRequest("ID5"));
$ID6  =  htmlDecode(getRequest("ID6"));

$tprogress4CountryID = "";
if (is_null($oRStprogress4->fields["CountryID"])):
$tprogress4CountryID = "";
else:
$tprogress4CountryID = trim(getValue($oRStprogress4->fields["CountryID"]));
endif;
$tprogress4BranchID = "";
if (is_null($oRStprogress4->fields["BranchID"])):
$tprogress4BranchID = "";
else:
$tprogress4BranchID = trim(getValue($oRStprogress4->fields["BranchID"]));
endif;
$tprogress4Level1ID = "";
if (is_null($oRStprogress4->fields["Level1ID"])):
$tprogress4Level1ID = "";
else:
$tprogress4Level1ID = trim(getValue($oRStprogress4->fields["Level1ID"]));
endif;
$tprogress4Level2ID = "";
if (is_null($oRStprogress4->fields["Level2ID"])):
$tprogress4Level2ID = "";
else:
$tprogress4Level2ID = trim(getValue($oRStprogress4->fields["Level2ID"]));
endif;
$tprogress4Level3ID = "";
if (is_null($oRStprogress4->fields["Level3ID"])):
$tprogress4Level3ID = "";
else:
$tprogress4Level3ID = trim(getValue($oRStprogress4->fields["Level3ID"]));
endif;
$tprogress4Rating = "";
if (is_null($oRStprogress4->fields["Rating"])):
$tprogress4Rating = "";
else:
$tprogress4Rating = getValue($oRStprogress4->fields["Rating"]);
endif;
$tprogress4Description = "";
if (is_null($oRStprogress4->fields["Description"])):
$tprogress4Description = "";
else:
$tprogress4Description = trim(getValue($oRStprogress4->fields["Description"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetprogress4del.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='hidden' id='ID5' name='ID5' value=@ID5@>\n";
$DeleteButton .= "<input type='hidden' id='ID6' name='ID6' value=@ID6@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetprogress4_EditFailed"] == 1) {
  $tprogress4CountryID = $_SESSION["SavedEdittprogress4CountryID"];
  $tprogress4BranchID = $_SESSION["SavedEdittprogress4BranchID"];
  $tprogress4Level1ID = $_SESSION["SavedEdittprogress4Level1ID"];
  $tprogress4Level2ID = $_SESSION["SavedEdittprogress4Level2ID"];
  $tprogress4Level3ID = $_SESSION["SavedEdittprogress4Level3ID"];
  $tprogress4Rating = $_SESSION["SavedEdittprogress4Rating"];
  $tprogress4Description = $_SESSION["SavedEdittprogress4Description"];
}
else {
  $_SESSION["Updatetprogress4_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStprogress4);
$objConn1->Close();
unset($objConn1);
?>
