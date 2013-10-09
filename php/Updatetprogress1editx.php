<?PHP
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
session_start();
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
// #include_once(dbcnfile);
include_once('utils.php');
include('login.php');
$HTML_Template = getRequest("HTMLT");
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
function MergeEditTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/blank.htm";
    endif;
    global $ClarionData;
    global $objConn1;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
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
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
    endif;


    print($TemplateText);
    $objConn1->Close();
    exit();
}

$pFound = "";
$pFound .= trim(getRequest("ID1"));
$pFound .= trim(getRequest("ID2"));
$pFound .= trim(getRequest("ID3"));
if($pFound == ""):
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "<tr><td colspan='2' class='Input'>The requested record could not be found<br>\n";
$ClarionData .= "</td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";
MergeEditTemplate($HTML_Template);
endif;
$ID1 = trim(getRequest("ID1"), "'");
$ID2 = trim(getRequest("ID2"), "'");
$ID3 = trim(getRequest("ID3"), "'");
$sql = "SELECT tprogress1.CountryID, tprogress1.BranchID, tprogress1.Level1ID, tprogress1.Description  FROM  tprogress1 WHERE  tprogress1.CountryID = '" . $ID1 . "'" . " AND tprogress1.BranchID = '" . $ID2 . "'" . " AND tprogress1.Level1ID = '" . $ID3 . "'";
$oRStprogress1 = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStprogress1 = array();
if (!$oRStprogress1):
    $oRStprogress1->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttprogress1CountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStprogress1["CountryID"] = getFormSQLQuoted($objConn1, "tprogress1", "CountryID", "txttprogress1CountryID");
        if (getRequest("txttprogress1BranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStprogress1["BranchID"] = getFormSQLQuoted($objConn1, "tprogress1", "BranchID", "txttprogress1BranchID");
        if (getRequest("txttprogress1Level1ID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Level 1 ID:</strong> : Required field <hr>\n";
        endif;
$arrayoRStprogress1["Level1ID"] = getFormSQLQuoted($objConn1, "tprogress1", "Level1ID", "txttprogress1Level1ID");
$arrayoRStprogress1["Level1ID"] = strtoupper($arrayoRStprogress1["Level1ID"]);
        if (getRequest("txttprogress1Description") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Description:</strong> : Required field <hr>\n";
        endif;
$arrayoRStprogress1["Description"] = getFormSQLQuoted($objConn1, "tprogress1", "Description", "txttprogress1Description");
$tsql = $objConn1->GetUpdateSQL($oRStprogress1, $arrayoRStprogress1, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tprogress1" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStprogress1 as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tprogress1" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStprogress1->Close();
unset($oRStprogress1);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseTProgress1#WHR")<>""):
        $myStatus .= "<a href='BrowseTProgress1list.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseTProgress1list.php'>Return to list</a>.";
        endif;
    endif;
endif;
$ClarionData = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";

if($flgMissing == true) {
  $_SESSION["Updatetprogress1_EditFailed"] = 1;
  $_SESSION["SavedEdittprogress1CountryID"] = $_POST["txttprogress1CountryID"];
  $_SESSION["SavedEdittprogress1BranchID"] = $_POST["txttprogress1BranchID"];
  $_SESSION["SavedEdittprogress1Level1ID"] = $_POST["txttprogress1Level1ID"];
  $_SESSION["SavedEdittprogress1Description"] = $_POST["txttprogress1Description"];
}
else {
  $_SESSION["Updatetprogress1_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
