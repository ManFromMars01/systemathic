<?PHP
session_start();
include('template/myclass.php');
not_login();

$PageLevel = 1;
include_once('systemathicappdata.php');

include_once('utils.php');
$HTML_Template = getRequest("HTMLT");
$DeleteButton = "";
$UpdatetdepartmentFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdepartment" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetdepartmentFormAction;
    global $tdepartmentCountryID;
    global $tdepartmentBranchID;
    global $tdepartmentID;
    global $tdepartmentDescription;
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
    $TemplateText = Replace($TemplateText,"@UpdatetdepartmentFormAction@",$UpdatetdepartmentFormAction);    

     $TemplateText = Replace($TemplateText, "@tdepartmentCountryID@", $tdepartmentCountryID);
     $TemplateText = Replace($TemplateText, "@tdepartmentBranchID@", $tdepartmentBranchID);
     $TemplateText = Replace($TemplateText, "@tdepartmentID@", $tdepartmentID);
     $TemplateText = Replace($TemplateText, "@tdepartmentDescription@", $tdepartmentDescription);
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
$oRStdepartment = "";
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
    $ClarionData .= "<a href=BrowseDept" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdepartment" . "edit.htm";
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

$sql = "SELECT tdepartment.CountryID, tdepartment.BranchID, tdepartment.ID, tdepartment.Description  FROM  tdepartment WHERE  tdepartment.CountryID = '" . $ID1 . "'" . " AND tdepartment.BranchID = '" . $ID2 . "'" . " AND tdepartment.ID = " . $ID3;
$oRStdepartment = $objConn1->SelectLimit($sql,1);
if ($oRStdepartment->MoveFirst() == false):
    $oRStdepartment->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetdepartmentFormAction = "Updatetdepartmenteditx.php";
$oRStdepartmentCountryID = $oRStdepartment->fields["CountryID"];
$oRStdepartmentBranchID = $oRStdepartment->fields["BranchID"];
$oRStdepartmentID = $oRStdepartment->fields["ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tdepartmentCountryID = "";
if (is_null($oRStdepartment->fields["CountryID"])):
$tdepartmentCountryID = "";
else:
$tdepartmentCountryID = trim(getValue($oRStdepartment->fields["CountryID"]));
endif;
$tdepartmentBranchID = "";
if (is_null($oRStdepartment->fields["BranchID"])):
$tdepartmentBranchID = "";
else:
$tdepartmentBranchID = trim(getValue($oRStdepartment->fields["BranchID"]));
endif;
$tdepartmentID = "";
if (is_null($oRStdepartment->fields["ID"])):
$tdepartmentID = "";
else:
$tdepartmentID = getValue($oRStdepartment->fields["ID"]);
endif;
$tdepartmentDescription = "";
if (is_null($oRStdepartment->fields["Description"])):
$tdepartmentDescription = "";
else:
$tdepartmentDescription = trim(getValue($oRStdepartment->fields["Description"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetdepartmentdel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetdepartment_EditFailed"] == 1) {
  $tdepartmentCountryID = $_SESSION["SavedEdittdepartmentCountryID"];
  $tdepartmentBranchID = $_SESSION["SavedEdittdepartmentBranchID"];
  $tdepartmentID = $_SESSION["SavedEdittdepartmentID"];
  $tdepartmentDescription = $_SESSION["SavedEdittdepartmentDescription"];
}
else {
  $_SESSION["Updatetdepartment_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStdepartment);
$objConn1->Close();
unset($objConn1);
?>
