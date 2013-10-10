<?PHP
session_set_cookie_params(500);
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
$UpdatetdroleFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdrole" . "edit.htm";
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
    global $UpdatetdroleFormAction;
    global $tdroleCountryID;
    global $tdroleBranchID;
    global $tdroleRoleID;
    global $tdrolePageName;
    global $tdroleInsertPrev;
    global $tdroleEditPrev;
    global $tdroleDeletePrev;
    global $tdroleViewPrev;
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
    $TemplateText = Replace($TemplateText,"@UpdatetdroleFormAction@",$UpdatetdroleFormAction);    

     $TemplateText = Replace($TemplateText, "@tdroleCountryID@", $tdroleCountryID);
     $TemplateText = Replace($TemplateText, "@tdroleBranchID@", $tdroleBranchID);
     $TemplateText = Replace($TemplateText, "@tdroleRoleID@", $tdroleRoleID);
     $TemplateText = Replace($TemplateText, "@tdrolePageName@", $tdrolePageName);
     $TemplateText = Replace($TemplateText, "@tdroleInsertPrev@", $tdroleInsertPrev);
        if($tdroleInsertPrev == "Y"):
            $SELECTEDtdroleInsertPrevY = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevY@", $SELECTEDtdroleInsertPrevY);
        if($tdroleInsertPrev == "N"):
            $SELECTEDtdroleInsertPrevN = "CHECKED";
        else:
            $SELECTEDtdroleInsertPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleInsertPrevN@", $SELECTEDtdroleInsertPrevN);
     $TemplateText = Replace($TemplateText, "@tdroleEditPrev@", $tdroleEditPrev);
        if($tdroleEditPrev == "Y"):
            $SELECTEDtdroleEditPrevY = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevY@", $SELECTEDtdroleEditPrevY);
        if($tdroleEditPrev == "N"):
            $SELECTEDtdroleEditPrevN = "CHECKED";
        else:
            $SELECTEDtdroleEditPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleEditPrevN@", $SELECTEDtdroleEditPrevN);
     $TemplateText = Replace($TemplateText, "@tdroleDeletePrev@", $tdroleDeletePrev);
        if($tdroleDeletePrev == "Y"):
            $SELECTEDtdroleDeletePrevY = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevY@", $SELECTEDtdroleDeletePrevY);
        if($tdroleDeletePrev == "N"):
            $SELECTEDtdroleDeletePrevN = "CHECKED";
        else:
            $SELECTEDtdroleDeletePrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleDeletePrevN@", $SELECTEDtdroleDeletePrevN);
     $TemplateText = Replace($TemplateText, "@tdroleViewPrev@", $tdroleViewPrev);
        if($tdroleViewPrev == "Y"):
            $SELECTEDtdroleViewPrevY = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevY = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevY@", $SELECTEDtdroleViewPrevY);
        if($tdroleViewPrev == "N"):
            $SELECTEDtdroleViewPrevN = "CHECKED";
        else:
            $SELECTEDtdroleViewPrevN = "";
        endif;
        $TemplateText = Replace($TemplateText, "@SELECTEDtdroleViewPrevN@", $SELECTEDtdroleViewPrevN);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@Header@", $Header);
     $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
     $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
     $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
     $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRStdrole = "";
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
    $ClarionData .= "<a href=BrowseTDRole" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updatetdrole" . "edit.htm";
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

$sql = "SELECT tdrole.CountryID, tdrole.BranchID, tdrole.RoleID, tdrole.PageName, tdrole.InsertPrev, tdrole.EditPrev, tdrole.DeletePrev, tdrole.ViewPrev  FROM  tdrole WHERE  tdrole.CountryID = '" . $ID1 . "'" . " AND tdrole.BranchID = '" . $ID2 . "'" . " AND tdrole.RoleID = '" . $ID3 . "'" . " AND tdrole.PageName = '" . $ID4 . "'";
$oRStdrole = $objConn1->SelectLimit($sql,1);
if ($oRStdrole->MoveFirst() == false):
    $oRStdrole->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdatetdroleFormAction = "Updatetdroleeditx.php";
$oRStdroleCountryID = $oRStdrole->fields["CountryID"];
$oRStdroleBranchID = $oRStdrole->fields["BranchID"];
$oRStdroleRoleID = $oRStdrole->fields["RoleID"];
$oRStdrolePageName = $oRStdrole->fields["PageName"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$tdroleCountryID = "";
if (is_null($oRStdrole->fields["CountryID"])):
$tdroleCountryID = "";
else:
$tdroleCountryID = trim(getValue($oRStdrole->fields["CountryID"]));
endif;
$tdroleBranchID = "";
if (is_null($oRStdrole->fields["BranchID"])):
$tdroleBranchID = "";
else:
$tdroleBranchID = trim(getValue($oRStdrole->fields["BranchID"]));
endif;
$tdroleRoleID = "";
if (is_null($oRStdrole->fields["RoleID"])):
$tdroleRoleID = "";
else:
$tdroleRoleID = trim(getValue($oRStdrole->fields["RoleID"]));
endif;
$tdrolePageName = "";
if (is_null($oRStdrole->fields["PageName"])):
$tdrolePageName = "";
else:
$tdrolePageName = trim(getValue($oRStdrole->fields["PageName"]));
endif;
$tdroleInsertPrev = "";
if (is_null($oRStdrole->fields["InsertPrev"])):
else:
$tdroleInsertPrev = trim(getValue($oRStdrole->fields["InsertPrev"]));
endif;
$tdroleEditPrev = "";
if (is_null($oRStdrole->fields["EditPrev"])):
else:
$tdroleEditPrev = trim(getValue($oRStdrole->fields["EditPrev"]));
endif;
$tdroleDeletePrev = "";
if (is_null($oRStdrole->fields["DeletePrev"])):
else:
$tdroleDeletePrev = trim(getValue($oRStdrole->fields["DeletePrev"]));
endif;
$tdroleViewPrev = "";
if (is_null($oRStdrole->fields["ViewPrev"])):
else:
$tdroleViewPrev = trim(getValue($oRStdrole->fields["ViewPrev"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updatetdroledel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updatetdrole_EditFailed"] == 1) {
  $tdroleCountryID = $_SESSION["SavedEdittdroleCountryID"];
  $tdroleBranchID = $_SESSION["SavedEdittdroleBranchID"];
  $tdroleRoleID = $_SESSION["SavedEdittdroleRoleID"];
  $tdrolePageName = $_SESSION["SavedEdittdrolePageName"];
  $tdroleInsertPrev = $_SESSION["SavedEdittdroleInsertPrev"];
  $tdroleEditPrev = $_SESSION["SavedEdittdroleEditPrev"];
  $tdroleDeletePrev = $_SESSION["SavedEdittdroleDeletePrev"];
  $tdroleViewPrev = $_SESSION["SavedEdittdroleViewPrev"];
}
else {
  $_SESSION["Updatetdrole_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRStdrole);
$objConn1->Close();
unset($objConn1);
?>
