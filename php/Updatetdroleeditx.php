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
session_set_cookie_params(500);
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
$pFound .= trim(getRequest("ID4"));
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
$ID4 = trim(getRequest("ID4"), "'");
$sql = "SELECT tdrole.CountryID, tdrole.BranchID, tdrole.RoleID, tdrole.PageName, tdrole.InsertPrev, tdrole.EditPrev, tdrole.DeletePrev, tdrole.ViewPrev  FROM  tdrole WHERE  tdrole.CountryID = '" . $ID1 . "'" . " AND tdrole.BranchID = '" . $ID2 . "'" . " AND tdrole.RoleID = '" . $ID3 . "'" . " AND tdrole.PageName = '" . $ID4 . "'";
$oRStdrole = $objConn1->SelectLimit($sql,1);
$myStatus = "";
$flgMissing = false;
$arrayoRStdrole = array();
if (!$oRStdrole):
    $oRStdrole->Close();
    $NoRecords = TRUE;
    $myStatus = "The requested record could not be found";
endif;
        if (getRequest("txttdroleCountryID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Country ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStdrole["CountryID"] = getFormSQLQuoted($objConn1, "tdrole", "CountryID", "txttdroleCountryID");
        if (getRequest("txttdroleBranchID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Branch ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStdrole["BranchID"] = getFormSQLQuoted($objConn1, "tdrole", "BranchID", "txttdroleBranchID");
        if (getRequest("txttdroleRoleID") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Role ID:</strong> : Must be in file ";      
                    $myStatus .= "<hr>\n";
        endif;
$arrayoRStdrole["RoleID"] = getFormSQLQuoted($objConn1, "tdrole", "RoleID", "txttdroleRoleID");
        if (getRequest("txttdrolePageName") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                        $myStatus .= " <strong>Page Name:</strong> : Required field <hr>\n";
        endif;
$arrayoRStdrole["PageName"] = getFormSQLQuoted($objConn1, "tdrole", "PageName", "txttdrolePageName");
        if (getRequest("txttdroleInsertPrev") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Insert Prev:</strong> : Must be in list ";
                    $myStatus .= "Y;N; <hr>\n";
        endif;
$arrayoRStdrole["InsertPrev"] = getFormSQLQuoted($objConn1, "tdrole", "InsertPrev", "txttdroleInsertPrev");
        if (getRequest("txttdroleEditPrev") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Edit Prev:</strong> : Must be in list ";
                    $myStatus .= "Y;N; <hr>\n";
        endif;
$arrayoRStdrole["EditPrev"] = getFormSQLQuoted($objConn1, "tdrole", "EditPrev", "txttdroleEditPrev");
        if (getRequest("txttdroleDeletePrev") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>Delete Prev:</strong> : Must be in list ";
                    $myStatus .= "Y;N; <hr>\n";
        endif;
$arrayoRStdrole["DeletePrev"] = getFormSQLQuoted($objConn1, "tdrole", "DeletePrev", "txttdroleDeletePrev");
        if (getRequest("txttdroleViewPrev") == ""):
            $myStatus .= "<STRONG>Some data was missing</STRONG><BR><HR>";
            $flgMissing = TRUE;
                    $myStatus .= " <strong>View Prev:</strong> : Must be in list ";
                    $myStatus .= "Y;N; <hr>\n";
        endif;
$arrayoRStdrole["ViewPrev"] = getFormSQLQuoted($objConn1, "tdrole", "ViewPrev", "txttdroleViewPrev");
$tsql = $objConn1->GetUpdateSQL($oRStdrole, $arrayoRStdrole, true, get_magic_quotes_gpc());
$badsql = strpos($tsql, "UPDATE  SET");
if($badsql === false):
    $sql = $tsql;
else:
    $sql = "UPDATE " . "tdrole" . " SET " . substr($tsql,12);
endif;
$dbUpdate = "";
foreach ($arrayoRStdrole as $fld => $value) {
  $dbUpdate .= $fld . " = " . $value . ",";
}
$dbUpdate = rtrim($dbUpdate,",");
$wherePos = strpos($tsql, " WHERE");
$sql = "UPDATE " . "tdrole" . " SET " . $dbUpdate . substr($tsql, $wherePos);

if ($flgMissing == false):
  $oRSResult = $objConn1->Execute($sql);
$oRStdrole->Close();
unset($oRStdrole);
if (!isset($oRSResult) || $oRSResult == false || $oRSResult == ""):
      $myStatus = "Your update failed <br><br>";
else:
  $myStatus = "Your update succeeded <BR><BR>";
endif;
    if(getSession("BrowseTDRole#WHR")<>""):
        $myStatus .= "<a href='BrowseTDRolelist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
    else:
        if($_SESSION["ChildReturnTo"] <> ""):
          $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
        else:
          $myStatus .= "<a href='BrowseTDRolelist.php'>Return to list</a>.";
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
  $_SESSION["Updatetdrole_EditFailed"] = 1;
  $_SESSION["SavedEdittdroleCountryID"] = $_POST["txttdroleCountryID"];
  $_SESSION["SavedEdittdroleBranchID"] = $_POST["txttdroleBranchID"];
  $_SESSION["SavedEdittdroleRoleID"] = $_POST["txttdroleRoleID"];
  $_SESSION["SavedEdittdrolePageName"] = $_POST["txttdrolePageName"];
  $_SESSION["SavedEdittdroleInsertPrev"] = $_POST["txttdroleInsertPrev"];
  $_SESSION["SavedEdittdroleEditPrev"] = $_POST["txttdroleEditPrev"];
  $_SESSION["SavedEdittdroleDeletePrev"] = $_POST["txttdroleDeletePrev"];
  $_SESSION["SavedEdittdroleViewPrev"] = $_POST["txttdroleViewPrev"];
}
else {
  $_SESSION["Updatetdrole_EditFailed"] = 0;
}

MergeEditTemplate($HTML_Template);
$objConn1->Close();
?>
