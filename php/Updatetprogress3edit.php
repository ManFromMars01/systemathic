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
$Updatetprogress3FormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress3" . "edit.htm";
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@Updatetprogress3FormAction@",$Updatetprogress3FormAction);    

     $TemplateText = Replace($TemplateText, "@tprogress3CountryID@", $tprogress3CountryID);
     $TemplateText = Replace($TemplateText, "@tprogress3BranchID@", $tprogress3BranchID);
     $TemplateText = Replace($TemplateText, "@tprogress3Level1ID@", $tprogress3Level1ID);
     $TemplateText = Replace($TemplateText, "@tprogress3Level2ID@", $tprogress3Level2ID);
     $TemplateText = Replace($TemplateText, "@tprogress3Level3ID@", $tprogress3Level3ID);
     $TemplateText = Replace($TemplateText, "@tprogress3Description@", $tprogress3Description);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@ID5@", trim($ID5,"'"));
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
$oRStprogress3 = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
$ID5 = trim(htmlDecode(getRequest("ID5")),"'");
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
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetprogress3" . "edit.htm";
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

$sql = "SELECT tprogress3.CountryID, tprogress3.BranchID, tprogress3.Level1ID, tprogress3.Level2ID, tprogress3.Level3ID, tprogress3.Description  FROM  tprogress3 WHERE  tprogress3.CountryID = '" . $ID1 . "'" . " AND tprogress3.BranchID = '" . $ID2 . "'" . " AND tprogress3.Level1ID = '" . $ID3 . "'" . " AND tprogress3.Level2ID = '" . $ID4 . "'" . " AND tprogress3.Level3ID = '" . $ID5 . "'";
$oRStprogress3 = $objConn1->SelectLimit($sql,1);
if ($oRStprogress3->MoveFirst() == false):
    $oRStprogress3->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$Updatetprogress3FormAction = "Updatetprogress3editx.php";
$oRStprogress3CountryID = $oRStprogress3->fields["CountryID"];
$oRStprogress3BranchID = $oRStprogress3->fields["BranchID"];
$oRStprogress3Level1ID = $oRStprogress3->fields["Level1ID"];
$oRStprogress3Level2ID = $oRStprogress3->fields["Level2ID"];
$oRStprogress3Level3ID = $oRStprogress3->fields["Level3ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));
$ID5  =  htmlDecode(getRequest("ID5"));

$tprogress3CountryID = "";
if (is_null($oRStprogress3->fields["CountryID"])):
$tprogress3CountryID = "";
else:
$tprogress3CountryID = trim(getValue($oRStprogress3->fields["CountryID"]));
endif;
$tprogress3BranchID = "";
if (is_null($oRStprogress3->fields["BranchID"])):
$tprogress3BranchID = "";
else:
$tprogress3BranchID = trim(getValue($oRStprogress3->fields["BranchID"]));
endif;
$tprogress3Level1ID = "";
if (is_null($oRStprogress3->fields["Level1ID"])):
$tprogress3Level1ID = "";
else:
$tprogress3Level1ID = trim(getValue($oRStprogress3->fields["Level1ID"]));
endif;
$tprogress3Level2ID = "";
if (is_null($oRStprogress3->fields["Level2ID"])):
$tprogress3Level2ID = "";
else:
$tprogress3Level2ID = trim(getValue($oRStprogress3->fields["Level2ID"]));
endif;
$tprogress3Level3ID = "";
if (is_null($oRStprogress3->fields["Level3ID"])):
$tprogress3Level3ID = "";
else:
$tprogress3Level3ID = trim(getValue($oRStprogress3->fields["Level3ID"]));
endif;
$tprogress3Description = "";
if (is_null($oRStprogress3->fields["Description"])):
$tprogress3Description = "";
else:
$tprogress3Description = trim(getValue($oRStprogress3->fields["Description"]));
endif;
$DeleteButton = "<form method='post' action='Updatetprogress3del.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='hidden' id='ID5' name='ID5' value=@ID5@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatetprogress3_EditFailed"] == 1) {
  $tprogress3CountryID = $_SESSION["SavedEdittprogress3CountryID"];
  $tprogress3BranchID = $_SESSION["SavedEdittprogress3BranchID"];
  $tprogress3Level1ID = $_SESSION["SavedEdittprogress3Level1ID"];
  $tprogress3Level2ID = $_SESSION["SavedEdittprogress3Level2ID"];
  $tprogress3Level3ID = $_SESSION["SavedEdittprogress3Level3ID"];
  $tprogress3Description = $_SESSION["SavedEdittprogress3Description"];
}
else {
  $_SESSION["Updatetprogress3_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStprogress3);
$objConn1->Close();
unset($objConn1);
?>
