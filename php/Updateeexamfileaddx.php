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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$myAction = "";
$strSQL = "";
$myStatus = "";
$flgMissing = 0;
$myError = "";

$HTML_Template = getRequest("HTMLT");


$dbColumns = "";
$dbValues = "";
            if (getForm("txteexamfileCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"eexamfile","CountryID","txteexamfileCountryID");
            if (getForm("txteexamfileBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"eexamfile","BranchID","txteexamfileBranchID");
            if (getForm("txteexamfileDate") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Date:</STRONG> : Required field <HR>\n";
            endif;
    $rst["Date"] = getFormSQLQuoted($objConn1,"eexamfile","Date","txteexamfileDate");
    $rst["TimeFrom"] = getFormSQLQuoted($objConn1,"eexamfile","TimeFrom","txteexamfileTimeFrom");
    $rst["TimeTo"] = getFormSQLQuoted($objConn1,"eexamfile","TimeTo","txteexamfileTimeTo");
    $rst["OpenDate"] = getFormSQLQuoted($objConn1,"eexamfile","OpenDate","txteexamfileOpenDate");
    $rst["CloseDate"] = getFormSQLQuoted($objConn1,"eexamfile","CloseDate","txteexamfileCloseDate");
    $rst["SubmitDate"] = getFormSQLQuoted($objConn1,"eexamfile","SubmitDate","txteexamfileSubmitDate");
    $rst["MenFee"] = getFormSQLQuoted($objConn1,"eexamfile","MenFee","txteexamfileMenFee");
    $rst["AbaFee"] = getFormSQLQuoted($objConn1,"eexamfile","AbaFee","txteexamfileAbaFee");
    $rst["AurFee"] = getFormSQLQuoted($objConn1,"eexamfile","AurFee","txteexamfileAurFee");
    $rst["Total"] = getFormSQLQuoted($objConn1,"eexamfile","Total","txteexamfileTotal");
    $rst["Remarks"] = getFormSQLQuoted($objConn1,"eexamfile","Remarks","txteexamfileRemarks");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into eexamfile (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRSeexamfile = $objConn1->Execute($sql);

  if (!isset($oRSeexamfile) || $oRSeexamfile == false || $oRSeexamfile == ""):
      $myStatus = "Your insert failed <br><br>";
  else:
    $myStatus = "Your insert succeeded <br><br>";
  endif;
  if(getSession("BrowseAssessment#WHR")<>""):
      $myStatus .= "<a href='BrowseAssessmentlist.php" . "?SUBSET=TRUE" . "'>Return to list</a>.";
  else:
      if($_SESSION["ChildReturnTo"] <> ""):
        $myStatus .= "<a href='" . htmlEncode($_SESSION["ChildReturnTo"]) . "'>Return to list</a>.";
      else:
        $myStatus .= "<a href='BrowseAssessmentlist.php'>Return to list</a>.";
      endif;
  endif;
endif;


function MergeAddTemplate($Template) {
    if (!isset($Template) || ($Template == "")) {
        $Template = "./html/blank.htm";
    }       
    global $ClarionData;
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
}

if($flgMissing == true) {
  $_SESSION["Updateeexamfile_InsertFailed"] = 1;
  $_SESSION["SavedeexamfileCountryID"] = $_POST["txteexamfileCountryID"];
  $_SESSION["SavedeexamfileBranchID"] = $_POST["txteexamfileBranchID"];
  $_SESSION["SavedeexamfileDate"] = $_POST["txteexamfileDate"];
  $_SESSION["SavedeexamfileTimeFrom"] = $_POST["txteexamfileTimeFrom"];
  $_SESSION["SavedeexamfileTimeTo"] = $_POST["txteexamfileTimeTo"];
  $_SESSION["SavedeexamfileOpenDate"] = $_POST["txteexamfileOpenDate"];
  $_SESSION["SavedeexamfileCloseDate"] = $_POST["txteexamfileCloseDate"];
  $_SESSION["SavedeexamfileSubmitDate"] = $_POST["txteexamfileSubmitDate"];
  $_SESSION["SavedeexamfileMenFee"] = $_POST["txteexamfileMenFee"];
  $_SESSION["SavedeexamfileAbaFee"] = $_POST["txteexamfileAbaFee"];
  $_SESSION["SavedeexamfileAurFee"] = $_POST["txteexamfileAurFee"];
  $_SESSION["SavedeexamfileTotal"] = $_POST["txteexamfileTotal"];
  $_SESSION["SavedeexamfileRemarks"] = $_POST["txteexamfileRemarks"];
}
else {
  $_SESSION["Updateeexamfile_InsertFailed"] = 0;
}


$ClarionData  = "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "   <tr><td width='80%' class='Header'>Status</td>\n" ;
$ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr><td class='Input' colspan='2'>" . $myStatus . "<br></td></tr>\n";
$ClarionData .= "</table>\n";
$ClarionData .= "</div>\n";


MergeAddTemplate($HTML_Template);
unset($oRSeexamfile) ;
$objConn1->Close();
unset($objConn1);
?> 
