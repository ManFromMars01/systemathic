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
$UpdateeexamfileFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeexamfile" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $UpdateeexamfileFormAction;
    global $eexamfileCountryID;
    global $eexamfileBranchID;
    global $eexamfileDate;
    global $eexamfileTimeFrom;
    global $eexamfileTimeTo;
    global $eexamfileVenue;
    global $eexamfileOpenDate;
    global $eexamfileCloseDate;
    global $eexamfileSubmitDate;
    global $eexamfileMenFee;
    global $eexamfileAbaFee;
    global $eexamfileAurFee;
    global $eexamfileTotal;
    global $eexamfileRemarks;
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
    $TemplateText = Replace($TemplateText,"@UpdateeexamfileFormAction@",$UpdateeexamfileFormAction);    

     $TemplateText = Replace($TemplateText, "@eexamfileCountryID@", $eexamfileCountryID);
     $TemplateText = Replace($TemplateText, "@eexamfileBranchID@", $eexamfileBranchID);
     $TemplateText = Replace($TemplateText, "@eexamfileDate@", $eexamfileDate);
     $TemplateText = Replace($TemplateText, "@eexamfileTimeFrom@", $eexamfileTimeFrom);
     $TemplateText = Replace($TemplateText, "@eexamfileTimeTo@", $eexamfileTimeTo);
     $TemplateText = Replace($TemplateText, "@eexamfileVenue@", $eexamfileVenue);
     $TemplateText = Replace($TemplateText, "@eexamfileOpenDate@", $eexamfileOpenDate);
     $TemplateText = Replace($TemplateText, "@eexamfileCloseDate@", $eexamfileCloseDate);
     $TemplateText = Replace($TemplateText, "@eexamfileSubmitDate@", $eexamfileSubmitDate);
     $TemplateText = Replace($TemplateText, "@eexamfileMenFee@", $eexamfileMenFee);
     $TemplateText = Replace($TemplateText, "@eexamfileAbaFee@", $eexamfileAbaFee);
     $TemplateText = Replace($TemplateText, "@eexamfileAurFee@", $eexamfileAurFee);
     $TemplateText = Replace($TemplateText, "@eexamfileTotal@", $eexamfileTotal);
     $TemplateText = Replace($TemplateText, "@eexamfileRemarks@", $eexamfileRemarks);
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
$oRSeexamfile = "";
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
        $Template = "./html/Updateeexamfile" . "edit.htm";
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

$sql = "SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.Venue, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee, eexamfile.AbaFee, eexamfile.AurFee, eexamfile.Total, eexamfile.Remarks  FROM  eexamfile WHERE  eexamfile.CountryID = '" . $ID1 . "'" . " AND eexamfile.BranchID = '" . $ID2 . "'" . " AND eexamfile.Date = '" . $ID3. "'";
$oRSeexamfile = $objConn1->SelectLimit($sql,1);
if ($oRSeexamfile->MoveFirst() == false):
    $oRSeexamfile->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdateeexamfileFormAction = "Updateeexamfileeditx.php";
$oRSeexamfileCountryID = $oRSeexamfile->fields["CountryID"];
$oRSeexamfileBranchID = $oRSeexamfile->fields["BranchID"];
$oRSeexamfileDate = $oRSeexamfile->fields["Date"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));

$eexamfileCountryID = "";
if (is_null($oRSeexamfile->fields["CountryID"])):
$eexamfileCountryID = "";
else:
$eexamfileCountryID = trim(getValue($oRSeexamfile->fields["CountryID"]));
endif;
$eexamfileBranchID = "";
if (is_null($oRSeexamfile->fields["BranchID"])):
$eexamfileBranchID = "";
else:
$eexamfileBranchID = trim(getValue($oRSeexamfile->fields["BranchID"]));
endif;
$eexamfileDate = "";
if (is_null($oRSeexamfile->fields["Date"])):
$eexamfileDate = "";
else:
$eexamfileDate = getValue($oRSeexamfile->fields["Date"]);
endif;
$eexamfileTimeFrom = "";
if (is_null($oRSeexamfile->fields["TimeFrom"])):
$eexamfileTimeFrom = "";
else:
$eexamfileTimeFrom = getValue($oRSeexamfile->fields["TimeFrom"]);
endif;
$eexamfileTimeTo = "";
if (is_null($oRSeexamfile->fields["TimeTo"])):
$eexamfileTimeTo = "";
else:
$eexamfileTimeTo = getValue($oRSeexamfile->fields["TimeTo"]);
endif;
$eexamfileVenue = "";
if (is_null($oRSeexamfile->fields["Venue"])):
$eexamfileVenue = "";
else:
$eexamfileVenue = trim(getValue($oRSeexamfile->fields["Venue"]));
endif;
$eexamfileOpenDate = "";
if (is_null($oRSeexamfile->fields["OpenDate"])):
$eexamfileOpenDate = "";
else:
$eexamfileOpenDate = getValue($oRSeexamfile->fields["OpenDate"]);
endif;
$eexamfileCloseDate = "";
if (is_null($oRSeexamfile->fields["CloseDate"])):
$eexamfileCloseDate = "";
else:
$eexamfileCloseDate = getValue($oRSeexamfile->fields["CloseDate"]);
endif;
$eexamfileSubmitDate = "";
if (is_null($oRSeexamfile->fields["SubmitDate"])):
$eexamfileSubmitDate = "";
else:
$eexamfileSubmitDate = getValue($oRSeexamfile->fields["SubmitDate"]);
endif;
$eexamfileMenFee = "";
if (is_null($oRSeexamfile->fields["MenFee"])):
$eexamfileMenFee = "";
else:
$eexamfileMenFee = getValue($oRSeexamfile->fields["MenFee"]);
endif;
$eexamfileAbaFee = "";
if (is_null($oRSeexamfile->fields["AbaFee"])):
$eexamfileAbaFee = "";
else:
$eexamfileAbaFee = getValue($oRSeexamfile->fields["AbaFee"]);
endif;
$eexamfileAurFee = "";
if (is_null($oRSeexamfile->fields["AurFee"])):
$eexamfileAurFee = "";
else:
$eexamfileAurFee = getValue($oRSeexamfile->fields["AurFee"]);
endif;
$eexamfileTotal = "";
if (is_null($oRSeexamfile->fields["Total"])):
$eexamfileTotal = "";
else:
$eexamfileTotal = getValue($oRSeexamfile->fields["Total"]);
endif;
$eexamfileRemarks = "";
if (is_null($oRSeexamfile->fields["Remarks"])):
$eexamfileRemarks = "";
else:
$eexamfileRemarks = trim(getValue($oRSeexamfile->fields["Remarks"]));
endif;
$DeleteLevel = 1;
if (isset($DeleteLevel) && getSession("UserLevel") >= $DeleteLevel):
$DeleteButton = "<form method='post' action='Updateeexamfiledel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";
else:
$DeleteButton = "";
endif;

if ($_SESSION["Updateeexamfile_EditFailed"] == 1) {
  $eexamfileCountryID = $_SESSION["SavedEditeexamfileCountryID"];
  $eexamfileBranchID = $_SESSION["SavedEditeexamfileBranchID"];
  $eexamfileDate = $_SESSION["SavedEditeexamfileDate"];
  $eexamfileTimeFrom = $_SESSION["SavedEditeexamfileTimeFrom"];
  $eexamfileTimeTo = $_SESSION["SavedEditeexamfileTimeTo"];
  $eexamfileVenue = $_SESSION["SavedEditeexamfileVenue"];
  $eexamfileOpenDate = $_SESSION["SavedEditeexamfileOpenDate"];
  $eexamfileCloseDate = $_SESSION["SavedEditeexamfileCloseDate"];
  $eexamfileSubmitDate = $_SESSION["SavedEditeexamfileSubmitDate"];
  $eexamfileMenFee = $_SESSION["SavedEditeexamfileMenFee"];
  $eexamfileAbaFee = $_SESSION["SavedEditeexamfileAbaFee"];
  $eexamfileAurFee = $_SESSION["SavedEditeexamfileAurFee"];
  $eexamfileTotal = $_SESSION["SavedEditeexamfileTotal"];
  $eexamfileRemarks = $_SESSION["SavedEditeexamfileRemarks"];
}
else {
  $_SESSION["Updateeexamfile_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRSeexamfile);
$objConn1->Close();
unset($objConn1);
?>
