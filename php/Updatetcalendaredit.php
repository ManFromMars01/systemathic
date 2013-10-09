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
$UpdatetcalendarFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetcalendar" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetcalendarFormAction;
    global $tcalendarCountryID;
    global $tcalendarBranchID;
    global $tcalendarDate;
    global $tcalendarDescription;
    global $tcalendarType;
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
    $TemplateText = Replace($TemplateText,"@UpdatetcalendarFormAction@",$UpdatetcalendarFormAction);    

     $TemplateText = Replace($TemplateText, "@tcalendarCountryID@", $tcalendarCountryID);
     $TemplateText = Replace($TemplateText, "@tcalendarBranchID@", $tcalendarBranchID);
     $TemplateText = Replace($TemplateText, "@tcalendarDate@", $tcalendarDate);
     $TemplateText = Replace($TemplateText, "@tcalendarDescription@", $tcalendarDescription);
    if($tcalendarType == "Regular_Holiday"):
        $SELECTEDF21_5_1 = "SELECTED";
    else:
        $SELECTEDF21_5_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_1@", $SELECTEDF21_5_1);
    if($tcalendarType == "Regular_Holiday_on_Rest_Day"):
        $SELECTEDF21_5_2 = "SELECTED";
    else:
        $SELECTEDF21_5_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_2@", $SELECTEDF21_5_2);
    if($tcalendarType == "Special_Holiday"):
        $SELECTEDF21_5_3 = "SELECTED";
    else:
        $SELECTEDF21_5_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_3@", $SELECTEDF21_5_3);
    if($tcalendarType == "Special_Holiday_on_Rest_Day"):
        $SELECTEDF21_5_4 = "SELECTED";
    else:
        $SELECTEDF21_5_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF21_5_4@", $SELECTEDF21_5_4);
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
$oRStcalendar = "";
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
    $ClarionData .= "<a href=BrowseSchoolCalendar" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetcalendar" . "edit.htm";
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

$sql = "SELECT tcalendar.CountryID, tcalendar.BranchID, tcalendar.Date, tcalendar.Description, tcalendar.Type  FROM  tcalendar WHERE  tcalendar.CountryID = '" . $ID1 . "'" . " AND tcalendar.BranchID = '" . $ID2 . "'" . " AND tcalendar.Date = '" . $ID3. "'";
$oRStcalendar = $objConn1->SelectLimit($sql,1);
if ($oRStcalendar->MoveFirst() == false):
    $oRStcalendar->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetcalendarFormAction = "Updatetcalendareditx.php";
$oRStcalendarCountryID = $oRStcalendar->fields["CountryID"];
$oRStcalendarBranchID = $oRStcalendar->fields["BranchID"];
$oRStcalendarDate = $oRStcalendar->fields["Date"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tcalendarCountryID = "";
if (is_null($oRStcalendar->fields["CountryID"])):
$tcalendarCountryID = "";
else:
$tcalendarCountryID = trim(getValue($oRStcalendar->fields["CountryID"]));
endif;
$tcalendarBranchID = "";
if (is_null($oRStcalendar->fields["BranchID"])):
$tcalendarBranchID = "";
else:
$tcalendarBranchID = trim(getValue($oRStcalendar->fields["BranchID"]));
endif;
$tcalendarDate = "";
if (is_null($oRStcalendar->fields["Date"])):
$tcalendarDate = "";
else:
$tcalendarDate = getValue($oRStcalendar->fields["Date"]);
endif;
$tcalendarDescription = "";
if (is_null($oRStcalendar->fields["Description"])):
$tcalendarDescription = "";
else:
$tcalendarDescription = trim(getValue($oRStcalendar->fields["Description"]));
endif;
$tcalendarType = "";
if (is_null($oRStcalendar->fields["Type"])):
$tcalendarType = "";
else:
$tcalendarType = trim(getValue($oRStcalendar->fields["Type"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetcalendardel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetcalendar_EditFailed"] == 1) {
  $tcalendarCountryID = $_SESSION["SavedEdittcalendarCountryID"];
  $tcalendarBranchID = $_SESSION["SavedEdittcalendarBranchID"];
  $tcalendarDate = $_SESSION["SavedEdittcalendarDate"];
  $tcalendarDescription = $_SESSION["SavedEdittcalendarDescription"];
  $tcalendarType = $_SESSION["SavedEdittcalendarType"];
}
else {
  $_SESSION["Updatetcalendar_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStcalendar);
$objConn1->Close();
unset($objConn1);
?>
