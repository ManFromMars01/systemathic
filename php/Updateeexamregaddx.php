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
$PageLevel = 0;
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
            if (getForm("txteexamregCountryID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Country ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CountryID"] = getFormSQLQuoted($objConn1,"eexamreg","CountryID","txteexamregCountryID");
            if (getForm("txteexamregBranchID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Branch ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["BranchID"] = getFormSQLQuoted($objConn1,"eexamreg","BranchID","txteexamregBranchID");
            if (getForm("txteexamregDate") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                        $myStatus .= " <STRONG>Date:</STRONG> : Required field <HR>\n";
            endif;
    $rst["Date"] = getFormSQLQuoted($objConn1,"eexamreg","Date","txteexamregDate");
            if (getForm("txteexamregCustNo") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Cust No:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["CustNo"] = getFormSQLQuoted($objConn1,"eexamreg","CustNo","txteexamregCustNo");
    $rst["Categ"] = getFormSQLQuoted($objConn1,"eexamreg","Categ","txteexamregCateg");
    $rst["Categ2"] = getFormSQLQuoted($objConn1,"eexamreg","Categ2","txteexamregCateg2");
    $rst["Categ3"] = getFormSQLQuoted($objConn1,"eexamreg","Categ3","txteexamregCateg3");
    $rst["Grade"] = getFormSQLQuoted($objConn1,"eexamreg","Grade","txteexamregGrade");
    $rst["Grade2"] = getFormSQLQuoted($objConn1,"eexamreg","Grade2","txteexamregGrade2");
    $rst["Digit"] = getFormSQLQuoted($objConn1,"eexamreg","Digit","txteexamregDigit");
    $rst["Number"] = getFormSQLQuoted($objConn1,"eexamreg","Number","txteexamregNumber");
    $rst["MenFee"] = getFormSQLQuoted($objConn1,"eexamreg","MenFee","txteexamregMenFee");
    $rst["AbaFee"] = getFormSQLQuoted($objConn1,"eexamreg","AbaFee","txteexamregAbaFee");
    $rst["AurFee"] = getFormSQLQuoted($objConn1,"eexamreg","AurFee","txteexamregAurFee");
            if (getForm("txteexamregTeacID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teac ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacID"] = getFormSQLQuoted($objConn1,"eexamreg","TeacID","txteexamregTeacID");
            if (getForm("txteexamregTeacID2") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teac ID 2:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacID2"] = getFormSQLQuoted($objConn1,"eexamreg","TeacID2","txteexamregTeacID2");
            if (getForm("txteexamregTeacID3") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Teac ID 3:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["TeacID3"] = getFormSQLQuoted($objConn1,"eexamreg","TeacID3","txteexamregTeacID3");
            if (getForm("txteexamregRmID") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Rm ID:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["RmID"] = getFormSQLQuoted($objConn1,"eexamreg","RmID","txteexamregRmID");
            if (getForm("txteexamregRmID2") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Rm ID 2:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["RmID2"] = getFormSQLQuoted($objConn1,"eexamreg","RmID2","txteexamregRmID2");
            if (getForm("txteexamregRmID3") == ""):
                if($myStatus == ""):
                    $myStatus = "<STRONG>Your insert failed </STRONG><BR><HR>";
                endif;
                $flgMissing = 1;
                    $myStatus .= " <STRONG>Rm ID 3:</STRONG> : Must be in file";
                    $myStatus .= "<HR>\n";
            endif;
    $rst["RmID3"] = getFormSQLQuoted($objConn1,"eexamreg","RmID3","txteexamregRmID3");
    $rst["ExamCode"] = getFormSQLQuoted($objConn1,"eexamreg","ExamCode","txteexamregExamCode");
    $rst["ExamCode2"] = getFormSQLQuoted($objConn1,"eexamreg","ExamCode2","txteexamregExamCode2");
    $rst["ExamCode3"] = getFormSQLQuoted($objConn1,"eexamreg","ExamCode3","txteexamregExamCode3");
    $rst["Remarks"] = getFormSQLQuoted($objConn1,"eexamreg","Remarks","txteexamregRemarks");


foreach ($rst as $fld => $value) {
    $dbColumns .= $fld . ",";
    $dbValues  .= $value . ",";
}

$dbColumns = rtrim($dbColumns,",");
$dbValues  = rtrim($dbValues,",");
$sql = "insert into eexamreg (" . $dbColumns . ") values (" . $dbValues . ")";


if($flgMissing == false):
  $oRSeexamreg = $objConn1->Execute($sql);

  if (!isset($oRSeexamreg) || $oRSeexamreg == false || $oRSeexamreg == ""):
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
  $_SESSION["Updateeexamreg_InsertFailed"] = 1;
  $_SESSION["SavedeexamregCountryID"] = $_POST["txteexamregCountryID"];
  $_SESSION["SavedeexamregBranchID"] = $_POST["txteexamregBranchID"];
  $_SESSION["SavedeexamregDate"] = $_POST["txteexamregDate"];
  $_SESSION["SavedeexamregCustNo"] = $_POST["txteexamregCustNo"];
  $_SESSION["SavedeexamregCateg"] = $_POST["txteexamregCateg"];
  $_SESSION["SavedeexamregCateg2"] = $_POST["txteexamregCateg2"];
  $_SESSION["SavedeexamregCateg3"] = $_POST["txteexamregCateg3"];
  $_SESSION["SavedeexamregGrade"] = $_POST["txteexamregGrade"];
  $_SESSION["SavedeexamregGrade2"] = $_POST["txteexamregGrade2"];
  $_SESSION["SavedeexamregDigit"] = $_POST["txteexamregDigit"];
  $_SESSION["SavedeexamregNumber"] = $_POST["txteexamregNumber"];
  $_SESSION["SavedeexamregMenFee"] = $_POST["txteexamregMenFee"];
  $_SESSION["SavedeexamregAbaFee"] = $_POST["txteexamregAbaFee"];
  $_SESSION["SavedeexamregAurFee"] = $_POST["txteexamregAurFee"];
  $_SESSION["SavedeexamregTeacID"] = $_POST["txteexamregTeacID"];
  $_SESSION["SavedeexamregTeacID2"] = $_POST["txteexamregTeacID2"];
  $_SESSION["SavedeexamregTeacID3"] = $_POST["txteexamregTeacID3"];
  $_SESSION["SavedeexamregRmID"] = $_POST["txteexamregRmID"];
  $_SESSION["SavedeexamregRmID2"] = $_POST["txteexamregRmID2"];
  $_SESSION["SavedeexamregRmID3"] = $_POST["txteexamregRmID3"];
  $_SESSION["SavedeexamregExamCode"] = $_POST["txteexamregExamCode"];
  $_SESSION["SavedeexamregExamCode2"] = $_POST["txteexamregExamCode2"];
  $_SESSION["SavedeexamregExamCode3"] = $_POST["txteexamregExamCode3"];
  $_SESSION["SavedeexamregRemarks"] = $_POST["txteexamregRemarks"];
}
else {
  $_SESSION["Updateeexamreg_InsertFailed"] = 0;
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
unset($oRSeexamreg) ;
$objConn1->Close();
unset($objConn1);
?> 
