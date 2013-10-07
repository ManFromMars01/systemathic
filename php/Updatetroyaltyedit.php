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
$UpdatetroyaltyFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetroyalty" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetroyaltyFormAction;
    global $troyaltyCountryID;
    global $troyaltyBranchID;
    global $troyaltyID;
    global $troyaltyDescription;
    global $troyaltyPercent;
    global $troyaltyPctToMaster;
    global $troyaltySource;
    global $troyaltyRecipient;
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
    $TemplateText = Replace($TemplateText,"@UpdatetroyaltyFormAction@",$UpdatetroyaltyFormAction);    

     $TemplateText = Replace($TemplateText, "@troyaltyCountryID@", $troyaltyCountryID);
     $TemplateText = Replace($TemplateText, "@troyaltyBranchID@", $troyaltyBranchID);
     $TemplateText = Replace($TemplateText, "@troyaltyID@", $troyaltyID);
     $TemplateText = Replace($TemplateText, "@troyaltyDescription@", $troyaltyDescription);
     $TemplateText = Replace($TemplateText, "@troyaltyPercent@", $troyaltyPercent);
     $TemplateText = Replace($TemplateText, "@troyaltyPctToMaster@", $troyaltyPctToMaster);
    if($troyaltySource == "Tuition_Fee"):
        $SELECTEDF48_7_1 = "SELECTED";
    else:
        $SELECTEDF48_7_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_1@", $SELECTEDF48_7_1);
    if($troyaltySource == "Examination"):
        $SELECTEDF48_7_2 = "SELECTED";
    else:
        $SELECTEDF48_7_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_2@", $SELECTEDF48_7_2);
    if($troyaltySource == "Competition"):
        $SELECTEDF48_7_3 = "SELECTED";
    else:
        $SELECTEDF48_7_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF48_7_3@", $SELECTEDF48_7_3);
     $TemplateText = Replace($TemplateText, "@troyaltyRecipient@", $troyaltyRecipient);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
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
$oRStroyalty = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
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
    $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetroyalty" . "edit.htm";
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

$sql = "SELECT troyalty.CountryID, troyalty.BranchID, troyalty.ID, troyalty.Description, troyalty.Percent, troyalty.PctToMaster, troyalty.Source, troyalty.Recipient  FROM  troyalty WHERE  troyalty.CountryID = '" . $ID1 . "'" . " AND troyalty.BranchID = '" . $ID2 . "'" . " AND troyalty.ID = '" . $ID3 . "'";
$oRStroyalty = $objConn1->SelectLimit($sql,1);
if ($oRStroyalty->MoveFirst() == false):
    $oRStroyalty->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetroyaltyFormAction = "Updatetroyaltyeditx.php";
$oRStroyaltyCountryID = $oRStroyalty->fields["CountryID"];
$oRStroyaltyBranchID = $oRStroyalty->fields["BranchID"];
$oRStroyaltyID = $oRStroyalty->fields["ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$troyaltyCountryID = "";
if (is_null($oRStroyalty->fields["CountryID"])):
$troyaltyCountryID = "";
else:
$troyaltyCountryID = trim(getValue($oRStroyalty->fields["CountryID"]));
endif;
$troyaltyBranchID = "";
if (is_null($oRStroyalty->fields["BranchID"])):
$troyaltyBranchID = "";
else:
$troyaltyBranchID = trim(getValue($oRStroyalty->fields["BranchID"]));
endif;
$troyaltyID = "";
if (is_null($oRStroyalty->fields["ID"])):
$troyaltyID = "";
else:
$troyaltyID = trim(getValue($oRStroyalty->fields["ID"]));
endif;
$troyaltyDescription = "";
if (is_null($oRStroyalty->fields["Description"])):
$troyaltyDescription = "";
else:
$troyaltyDescription = trim(getValue($oRStroyalty->fields["Description"]));
endif;
$troyaltyPercent = "";
if (is_null($oRStroyalty->fields["Percent"])):
$troyaltyPercent = "";
else:
$troyaltyPercent = getValue($oRStroyalty->fields["Percent"]);
endif;
$troyaltyPctToMaster = "";
if (is_null($oRStroyalty->fields["PctToMaster"])):
$troyaltyPctToMaster = "";
else:
$troyaltyPctToMaster = getValue($oRStroyalty->fields["PctToMaster"]);
endif;
$troyaltySource = "";
if (is_null($oRStroyalty->fields["Source"])):
$troyaltySource = "";
else:
$troyaltySource = trim(getValue($oRStroyalty->fields["Source"]));
endif;
$troyaltyRecipient = "";
if (is_null($oRStroyalty->fields["Recipient"])):
$troyaltyRecipient = "";
else:
$troyaltyRecipient = trim(getValue($oRStroyalty->fields["Recipient"]));
endif;
$DeleteButton = "<form method='post' action='Updatetroyaltydel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updatetroyalty_EditFailed"] == 1) {
  $troyaltyCountryID = $_SESSION["SavedEdittroyaltyCountryID"];
  $troyaltyBranchID = $_SESSION["SavedEdittroyaltyBranchID"];
  $troyaltyID = $_SESSION["SavedEdittroyaltyID"];
  $troyaltyDescription = $_SESSION["SavedEdittroyaltyDescription"];
  $troyaltyPercent = $_SESSION["SavedEdittroyaltyPercent"];
  $troyaltyPctToMaster = $_SESSION["SavedEdittroyaltyPctToMaster"];
  $troyaltySource = $_SESSION["SavedEdittroyaltySource"];
  $troyaltyRecipient = $_SESSION["SavedEdittroyaltyRecipient"];
}
else {
  $_SESSION["Updatetroyalty_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStroyalty);
$objConn1->Close();
unset($objConn1);
?>
