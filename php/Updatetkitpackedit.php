<?PHP
session_start();
include('template/myclass.php');
not_login();
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
$HTML_Template = getRequest("HTMLT");
$DeleteButton = "";
$UpdatetkitpackFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetkitpack" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;
    global $UpdatetkitpackFormAction;
    global $tkitpackCountryID;
    global $tkitpackBranchID;
    global $tkitpackLevelID;
    global $tkitpackItemNo;
    global $tkitpackDescription;
    global $tkitpackQty;
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
    $TemplateText = Replace($TemplateText,"@UpdatetkitpackFormAction@",$UpdatetkitpackFormAction);    

     $TemplateText = Replace($TemplateText, "@tkitpackCountryID@", $tkitpackCountryID);
     $TemplateText = Replace($TemplateText, "@tkitpackBranchID@", $tkitpackBranchID);
     $TemplateText = Replace($TemplateText, "@tkitpackLevelID@", $tkitpackLevelID);
     $TemplateText = Replace($TemplateText, "@tkitpackItemNo@", $tkitpackItemNo);
     $TemplateText = Replace($TemplateText, "@tkitpackDescription@", $tkitpackDescription);
     $TemplateText = Replace($TemplateText, "@tkitpackQty@", $tkitpackQty);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@Header@", $Header);
     $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
     $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
     $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
     $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);

     include('Conninfo.php');
     $objConn1 = &ADONewConnection($Driver1);
     $objConn1->debug = $DebugMode;
     $objConn1->PConnect($Server1,$User1,$Password1,$db1);
     
     $sql = "SELECT *  FROM  tlevel WHERE  tlevel.ID = '" . $ID3 . "'" ;
     $mylevel = $objConn1->Execute($sql);
     $ourlevel =$mylevel->fields["Description"];
     $TemplateText = Replace($TemplateText, "@ourlevel@", $ourlevel);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStkitpack = "";
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
    $ClarionData .= "<a href=BrowseKitPack" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetkitpack" . "edit.htm";
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

$sql = "SELECT tkitpack.CountryID, tkitpack.BranchID, tkitpack.LevelID, tkitpack.ItemNo, tkitpack.Description, tkitpack.Qty  FROM  tkitpack WHERE  tkitpack.CountryID = '" . $ID1 . "'" . " AND tkitpack.BranchID = '" . $ID2 . "'" . " AND tkitpack.LevelID = " . $ID3 . " AND tkitpack.ItemNo = '" . $ID4 . "'";

$oRStkitpack = $objConn1->SelectLimit($sql,1);
if ($oRStkitpack->MoveFirst() == false):
    $oRStkitpack->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetkitpackFormAction = "Updatetkitpackeditx.php";
$oRStkitpackCountryID = $oRStkitpack->fields["CountryID"];
$oRStkitpackBranchID = $oRStkitpack->fields["BranchID"];
$oRStkitpackLevelID = $oRStkitpack->fields["LevelID"];
$oRStkitpackItemNo = $oRStkitpack->fields["ItemNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$tkitpackCountryID = "";
if (is_null($oRStkitpack->fields["CountryID"])):
$tkitpackCountryID = "";
else:
$tkitpackCountryID = trim(getValue($oRStkitpack->fields["CountryID"]));
endif;
$tkitpackBranchID = "";
if (is_null($oRStkitpack->fields["BranchID"])):
$tkitpackBranchID = "";
else:
$tkitpackBranchID = trim(getValue($oRStkitpack->fields["BranchID"]));
endif;
$tkitpackLevelID = "";
if (is_null($oRStkitpack->fields["LevelID"])):
$tkitpackLevelID = "";
else:
$tkitpackLevelID = getValue($oRStkitpack->fields["LevelID"]);
endif;
$tkitpackItemNo = "";
if (is_null($oRStkitpack->fields["ItemNo"])):
$tkitpackItemNo = "";
else:
$tkitpackItemNo = trim(getValue($oRStkitpack->fields["ItemNo"]));
endif;
$tkitpackDescription = "";
if (is_null($oRStkitpack->fields["Description"])):
$tkitpackDescription = "";
else:
$tkitpackDescription = trim(getValue($oRStkitpack->fields["Description"]));
endif;
$tkitpackQty = "";
if (is_null($oRStkitpack->fields["Qty"])):
$tkitpackQty = "";
else:
$tkitpackQty = getValue($oRStkitpack->fields["Qty"]);
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetkitpackdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetkitpack_EditFailed"] == 1) {
  $tkitpackCountryID = $_SESSION["SavedEdittkitpackCountryID"];
  $tkitpackBranchID = $_SESSION["SavedEdittkitpackBranchID"];
  $tkitpackLevelID = $_SESSION["SavedEdittkitpackLevelID"];
  $tkitpackItemNo = $_SESSION["SavedEdittkitpackItemNo"];
  $tkitpackDescription = $_SESSION["SavedEdittkitpackDescription"];
  $tkitpackQty = $_SESSION["SavedEdittkitpackQty"];
}
else {
  $_SESSION["Updatetkitpack_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStkitpack);
$objConn1->Close();
unset($objConn1);
?>
