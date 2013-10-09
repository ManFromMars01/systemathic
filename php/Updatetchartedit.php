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
$UpdatetchartFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetchart" . "edit.htm";
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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdatetchartFormAction@",$UpdatetchartFormAction);    

     $TemplateText = Replace($TemplateText, "@tchartCountryID@", $tchartCountryID);
     $TemplateText = Replace($TemplateText, "@tchartBranchID@", $tchartBranchID);
     $TemplateText = Replace($TemplateText, "@tchartAccountNo@", $tchartAccountNo);
     $TemplateText = Replace($TemplateText, "@tchartDeptNo@", $tchartDeptNo);
     $TemplateText = Replace($TemplateText, "@tchartDescription@", $tchartDescription);
    if($tchartType == "Asset"):
        $SELECTEDF51_6_1 = "SELECTED";
    else:
        $SELECTEDF51_6_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_1@", $SELECTEDF51_6_1);
    if($tchartType == "Liability"):
        $SELECTEDF51_6_2 = "SELECTED";
    else:
        $SELECTEDF51_6_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_2@", $SELECTEDF51_6_2);
    if($tchartType == "Capital"):
        $SELECTEDF51_6_3 = "SELECTED";
    else:
        $SELECTEDF51_6_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_3@", $SELECTEDF51_6_3);
    if($tchartType == "Revenue"):
        $SELECTEDF51_6_4 = "SELECTED";
    else:
        $SELECTEDF51_6_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_4@", $SELECTEDF51_6_4);
    if($tchartType == "Expense"):
        $SELECTEDF51_6_5 = "SELECTED";
    else:
        $SELECTEDF51_6_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_6_5@", $SELECTEDF51_6_5);
     $TemplateText = Replace($TemplateText, "@tchartSubType@", $tchartSubType);
    if($tchartStatus == "Active"):
        $SELECTEDF51_8_1 = "SELECTED";
    else:
        $SELECTEDF51_8_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_8_1@", $SELECTEDF51_8_1);
    if($tchartStatus == "InActive"):
        $SELECTEDF51_8_2 = "SELECTED";
    else:
        $SELECTEDF51_8_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF51_8_2@", $SELECTEDF51_8_2);
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
$oRStchart = "";
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
    $ClarionData .= "<a href=BrowseChart" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetchart" . "edit.htm";
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

$sql = "SELECT tchart.CountryID, tchart.BranchID, tchart.AccountNo, tchart.DeptNo, tchart.Description, tchart.Type, tchart.SubType, tchart.Status  FROM  tchart WHERE  tchart.CountryID = '" . $ID1 . "'" . " AND tchart.BranchID = '" . $ID2 . "'" . " AND tchart.AccountNo = " . $ID3 . " AND tchart.DeptNo = " . $ID4;
$oRStchart = $objConn1->SelectLimit($sql,1);
if ($oRStchart->MoveFirst() == false):
    $oRStchart->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetchartFormAction = "Updatetcharteditx.php";
$oRStchartCountryID = $oRStchart->fields["CountryID"];
$oRStchartBranchID = $oRStchart->fields["BranchID"];
$oRStchartAccountNo = $oRStchart->fields["AccountNo"];
$oRStchartDeptNo = $oRStchart->fields["DeptNo"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$tchartCountryID = "";
if (is_null($oRStchart->fields["CountryID"])):
$tchartCountryID = "";
else:
$tchartCountryID = trim(getValue($oRStchart->fields["CountryID"]));
endif;
$tchartBranchID = "";
if (is_null($oRStchart->fields["BranchID"])):
$tchartBranchID = "";
else:
$tchartBranchID = trim(getValue($oRStchart->fields["BranchID"]));
endif;
$tchartAccountNo = "";
if (is_null($oRStchart->fields["AccountNo"])):
$tchartAccountNo = "";
else:
$tchartAccountNo = getValue($oRStchart->fields["AccountNo"]);
endif;
$tchartDeptNo = "";
if (is_null($oRStchart->fields["DeptNo"])):
$tchartDeptNo = "";
else:
$tchartDeptNo = getValue($oRStchart->fields["DeptNo"]);
endif;
$tchartDescription = "";
if (is_null($oRStchart->fields["Description"])):
$tchartDescription = "";
else:
$tchartDescription = trim(getValue($oRStchart->fields["Description"]));
endif;
$tchartType = "";
if (is_null($oRStchart->fields["Type"])):
$tchartType = "";
else:
$tchartType = trim(getValue($oRStchart->fields["Type"]));
endif;
$tchartSubType = "";
if (is_null($oRStchart->fields["SubType"])):
$tchartSubType = "";
else:
$tchartSubType = getValue($oRStchart->fields["SubType"]);
endif;
$tchartStatus = "";
if (is_null($oRStchart->fields["Status"])):
$tchartStatus = "";
else:
$tchartStatus = trim(getValue($oRStchart->fields["Status"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetchartdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetchart_EditFailed"] == 1) {
  $tchartCountryID = $_SESSION["SavedEdittchartCountryID"];
  $tchartBranchID = $_SESSION["SavedEdittchartBranchID"];
  $tchartAccountNo = $_SESSION["SavedEdittchartAccountNo"];
  $tchartDeptNo = $_SESSION["SavedEdittchartDeptNo"];
  $tchartDescription = $_SESSION["SavedEdittchartDescription"];
  $tchartType = $_SESSION["SavedEdittchartType"];
  $tchartSubType = $_SESSION["SavedEdittchartSubType"];
  $tchartStatus = $_SESSION["SavedEdittchartStatus"];
}
else {
  $_SESSION["Updatetchart_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStchart);
$objConn1->Close();
unset($objConn1);
?>
