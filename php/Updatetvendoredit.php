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
$UpdatetvendorFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetvendor" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdatetvendorFormAction;
    global $tvendorCountryID;
    global $tvendorBranchID;
    global $tvendorID;
    global $tvendorName;
    global $tvendorAddress1;
    global $tvendorAddress2;
    global $tvendorCity;
    global $tvendorZip;
    global $tvendorFax;
    global $tvendorPhone;
    global $tvendorRmtAdd1;
    global $tvendorRmtAdd2;
    global $tvendorRmtZip;
    global $tvendorRmtCity;
    global $tvendorContact;
    global $tvendorDiscountPct;
    global $tvendorDiscountDays;
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
    $TemplateText = Replace($TemplateText,"@UpdatetvendorFormAction@",$UpdatetvendorFormAction);    

     $TemplateText = Replace($TemplateText, "@tvendorCountryID@", $tvendorCountryID);
     $TemplateText = Replace($TemplateText, "@tvendorBranchID@", $tvendorBranchID);
     $TemplateText = Replace($TemplateText, "@tvendorID@", $tvendorID);
     $TemplateText = Replace($TemplateText, "@tvendorName@", $tvendorName);
     $TemplateText = Replace($TemplateText, "@tvendorAddress1@", $tvendorAddress1);
     $TemplateText = Replace($TemplateText, "@tvendorAddress2@", $tvendorAddress2);
     $TemplateText = Replace($TemplateText, "@tvendorCity@", $tvendorCity);
     $TemplateText = Replace($TemplateText, "@tvendorZip@", $tvendorZip);
     $TemplateText = Replace($TemplateText, "@tvendorFax@", $tvendorFax);
     $TemplateText = Replace($TemplateText, "@tvendorPhone@", $tvendorPhone);
     $TemplateText = Replace($TemplateText, "@tvendorRmtAdd1@", $tvendorRmtAdd1);
     $TemplateText = Replace($TemplateText, "@tvendorRmtAdd2@", $tvendorRmtAdd2);
     $TemplateText = Replace($TemplateText, "@tvendorRmtZip@", $tvendorRmtZip);
     $TemplateText = Replace($TemplateText, "@tvendorRmtCity@", $tvendorRmtCity);
     $TemplateText = Replace($TemplateText, "@tvendorContact@", $tvendorContact);
     $TemplateText = Replace($TemplateText, "@tvendorDiscountPct@", $tvendorDiscountPct);
     $TemplateText = Replace($TemplateText, "@tvendorDiscountDays@", $tvendorDiscountDays);
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
$oRStvendor = "";
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
    $ClarionData .= "<a href=BrowseAttendanceStatus" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetvendor" . "edit.htm";
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

$sql = "SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax, tvendor.Phone, tvendor.RmtAdd1, tvendor.RmtAdd2, tvendor.RmtZip, tvendor.RmtCity, tvendor.Contact, tvendor.DiscountPct, tvendor.DiscountDays  FROM  tvendor WHERE  tvendor.CountryID = '" . $ID1 . "'" . " AND tvendor.BranchID = '" . $ID2 . "'" . " AND tvendor.ID = " . $ID3;
$oRStvendor = $objConn1->SelectLimit($sql,1);
if ($oRStvendor->MoveFirst() == false):
    $oRStvendor->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetvendorFormAction = "Updatetvendoreditx.php";
$oRStvendorCountryID = $oRStvendor->fields["CountryID"];
$oRStvendorBranchID = $oRStvendor->fields["BranchID"];
$oRStvendorID = $oRStvendor->fields["ID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$tvendorCountryID = "";
if (is_null($oRStvendor->fields["CountryID"])):
$tvendorCountryID = "";
else:
$tvendorCountryID = trim(getValue($oRStvendor->fields["CountryID"]));
endif;
$tvendorBranchID = "";
if (is_null($oRStvendor->fields["BranchID"])):
$tvendorBranchID = "";
else:
$tvendorBranchID = trim(getValue($oRStvendor->fields["BranchID"]));
endif;
$tvendorID = "";
if (is_null($oRStvendor->fields["ID"])):
$tvendorID = "";
else:
$tvendorID = getValue($oRStvendor->fields["ID"]);
endif;
$tvendorName = "";
if (is_null($oRStvendor->fields["Name"])):
$tvendorName = "";
else:
$tvendorName = trim(getValue($oRStvendor->fields["Name"]));
endif;
$tvendorAddress1 = "";
if (is_null($oRStvendor->fields["Address1"])):
$tvendorAddress1 = "";
else:
$tvendorAddress1 = trim(getValue($oRStvendor->fields["Address1"]));
endif;
$tvendorAddress2 = "";
if (is_null($oRStvendor->fields["Address2"])):
$tvendorAddress2 = "";
else:
$tvendorAddress2 = trim(getValue($oRStvendor->fields["Address2"]));
endif;
$tvendorCity = "";
if (is_null($oRStvendor->fields["City"])):
$tvendorCity = "";
else:
$tvendorCity = trim(getValue($oRStvendor->fields["City"]));
endif;
$tvendorZip = "";
if (is_null($oRStvendor->fields["Zip"])):
$tvendorZip = "";
else:
$tvendorZip = trim(getValue($oRStvendor->fields["Zip"]));
endif;
$tvendorFax = "";
if (is_null($oRStvendor->fields["Fax"])):
$tvendorFax = "";
else:
$tvendorFax = trim(getValue($oRStvendor->fields["Fax"]));
endif;
$tvendorPhone = "";
if (is_null($oRStvendor->fields["Phone"])):
$tvendorPhone = "";
else:
$tvendorPhone = trim(getValue($oRStvendor->fields["Phone"]));
endif;
$tvendorRmtAdd1 = "";
if (is_null($oRStvendor->fields["RmtAdd1"])):
$tvendorRmtAdd1 = "";
else:
$tvendorRmtAdd1 = trim(getValue($oRStvendor->fields["RmtAdd1"]));
endif;
$tvendorRmtAdd2 = "";
if (is_null($oRStvendor->fields["RmtAdd2"])):
$tvendorRmtAdd2 = "";
else:
$tvendorRmtAdd2 = trim(getValue($oRStvendor->fields["RmtAdd2"]));
endif;
$tvendorRmtZip = "";
if (is_null($oRStvendor->fields["RmtZip"])):
$tvendorRmtZip = "";
else:
$tvendorRmtZip = trim(getValue($oRStvendor->fields["RmtZip"]));
endif;
$tvendorRmtCity = "";
if (is_null($oRStvendor->fields["RmtCity"])):
$tvendorRmtCity = "";
else:
$tvendorRmtCity = trim(getValue($oRStvendor->fields["RmtCity"]));
endif;
$tvendorContact = "";
if (is_null($oRStvendor->fields["Contact"])):
$tvendorContact = "";
else:
$tvendorContact = trim(getValue($oRStvendor->fields["Contact"]));
endif;
$tvendorDiscountPct = "";
if (is_null($oRStvendor->fields["DiscountPct"])):
$tvendorDiscountPct = "";
else:
$tvendorDiscountPct = getValue($oRStvendor->fields["DiscountPct"]);
endif;
$tvendorDiscountDays = "";
if (is_null($oRStvendor->fields["DiscountDays"])):
$tvendorDiscountDays = "";
else:
$tvendorDiscountDays = getValue($oRStvendor->fields["DiscountDays"]);
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetvendordel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetvendor_EditFailed"] == 1) {
  $tvendorCountryID = $_SESSION["SavedEdittvendorCountryID"];
  $tvendorBranchID = $_SESSION["SavedEdittvendorBranchID"];
  $tvendorID = $_SESSION["SavedEdittvendorID"];
  $tvendorName = $_SESSION["SavedEdittvendorName"];
  $tvendorAddress1 = $_SESSION["SavedEdittvendorAddress1"];
  $tvendorAddress2 = $_SESSION["SavedEdittvendorAddress2"];
  $tvendorCity = $_SESSION["SavedEdittvendorCity"];
  $tvendorZip = $_SESSION["SavedEdittvendorZip"];
  $tvendorFax = $_SESSION["SavedEdittvendorFax"];
  $tvendorPhone = $_SESSION["SavedEdittvendorPhone"];
  $tvendorRmtAdd1 = $_SESSION["SavedEdittvendorRmtAdd1"];
  $tvendorRmtAdd2 = $_SESSION["SavedEdittvendorRmtAdd2"];
  $tvendorRmtZip = $_SESSION["SavedEdittvendorRmtZip"];
  $tvendorRmtCity = $_SESSION["SavedEdittvendorRmtCity"];
  $tvendorContact = $_SESSION["SavedEdittvendorContact"];
  $tvendorDiscountPct = $_SESSION["SavedEdittvendorDiscountPct"];
  $tvendorDiscountDays = $_SESSION["SavedEdittvendorDiscountDays"];
}
else {
  $_SESSION["Updatetvendor_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStvendor);
$objConn1->Close();
unset($objConn1);
?>
