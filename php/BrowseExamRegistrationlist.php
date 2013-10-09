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
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
include_once('utils.php');
include('login.php');
if($_SERVER["QUERY_STRING"] <> ""):
  $_SESSION["ChildReturnTo"] = $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"];
else:
  $_SESSION["ChildReturnTo"] = $_SERVER["PHP_SELF"];
endif;
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseExamRegistrationRowData = "";
$ndxStart = "";
$ndxEnd = "";
$strLEN = "";
$Seq = "";
$MaxPages = "";
$TotalRecords = "";
$iStart = "";
$iEnd = "";
$TableFooter = "";
$ref = "";
$counter = "";
$PageIndex = "";
$RecordsPageSize = "";
$SearchMessage = "";
$SearchField = "";
$eexamregAutomaticDetailLink = "";
$eexamregAutomaticDetailLinkSTYLE = "";
$eexamregCountryIDLABEL = "";
$eexamregCountryID = "";
$eexamregCountryIDSTYLE = "";
$eexamregBranchIDLABEL = "";
$eexamregBranchID = "";
$eexamregBranchIDSTYLE = "";
$eexamregDateLABEL = "";
$eexamregDate = "";
$eexamregDateSTYLE = "";
$tcustomerSurNameLABEL = "";
$tcustomerSurName = "";
$tcustomerSurNameSTYLE = "";
$tcustomerFirstNameLABEL = "";
$tcustomerFirstName = "";
$tcustomerFirstNameSTYLE = "";
$tcustomerMiddleNameLABEL = "";
$tcustomerMiddleName = "";
$tcustomerMiddleNameSTYLE = "";
$eexamregCategLABEL = "";
$eexamregCateg = "";
$eexamregCategSTYLE = "";
$eexamregCateg2LABEL = "";
$eexamregCateg2 = "";
$eexamregCateg2STYLE = "";
$eexamregCateg3LABEL = "";
$eexamregCateg3 = "";
$eexamregCateg3STYLE = "";
$eexamregGradeLABEL = "";
$eexamregGrade = "";
$eexamregGradeSTYLE = "";
$eexamregGrade2LABEL = "";
$eexamregGrade2 = "";
$eexamregGrade2STYLE = "";
$oRSeexamreg = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseExamRegistration#WHR"] = "";
    $_SESSION["BrowseExamRegistration#COL"] = "";
    $_SESSION["BrowseExamRegistration#SRT"] = "";
    $_SESSION["BrowseExamRegistration#PreviousColumn"] = "";
    $_SESSION["BrowseExamRegistration#PreviousSort"] = "";
    $_SESSION["BrowseExamRegistration#mySort"] = "";
    $_SESSION["BrowseExamRegistration#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseExamRegistration#WHR"] = "";
        $_SESSION["BrowseExamRegistration#COL"] = "";
        $_SESSION["BrowseExamRegistration#SRT"] = "";
        $_SESSION["BrowseExamRegistration#PreviousColumn"] = "";
        $_SESSION["BrowseExamRegistration#PreviousSort"] = "";
        $_SESSION["BrowseExamRegistration#mySort"] = "";
        $_SESSION["BrowseExamRegistration#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseExamRegistration#COL"] = "";
            $_SESSION["BrowseExamRegistration#SRT"] = "";
            $_SESSION["BrowseExamRegistration#PreviousColumn"] = "";
            $_SESSION["BrowseExamRegistration#PreviousSort"] = "";
            $_SESSION["BrowseExamRegistration#mySort"] = "";
            $_SESSION["BrowseExamRegistration#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseExamRegistration#PreviousColumn"] = "";
else:
    $_SESSION["BrowseExamRegistration#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseExamRegistration#PreviousSort"] = "";
else:
    $_SESSION["BrowseExamRegistration#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseExamRegistration#COL") == ""):
    if (getRequest("COL") . getSession("BrowseExamRegistration#COL") == ""):
        $_SESSION["BrowseExamRegistration#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.CountryID DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.CountryID ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.CountryID ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "CountryID";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.BranchID DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.BranchID ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.BranchID ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "BranchID";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Date"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Date DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Date ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Date ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Date";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "SurName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.SurName DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "SurName";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "FirstName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.FirstName DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "FirstName";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "MiddleName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.MiddleName DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "MiddleName";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Categ"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Categ";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Categ2"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ2 DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ2 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ2 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Categ2";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Categ3"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ3 DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ3 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Categ3 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Categ3";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Grade"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Grade";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

if (getRequest("COL") == "Grade2"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade2 DESC";
        $_SESSION["BrowseExamRegistration#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade2 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamRegistration#PreviousColumn")):
        $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.Grade2 ASC";
        $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamRegistration#COL"] = "Grade2";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

$myQuery    = "SELECT eexamreg.CountryID, eexamreg.BranchID, eexamreg.CustNo, eexamreg.Date, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, eexamreg.Categ, eexamreg.Categ2, eexamreg.Categ3, eexamreg.Grade, eexamreg.Grade2 FROM eexamreg  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eexamreg.CountryID AND  tcustomer.BranchID = eexamreg.BranchID AND  tcustomer.CustNo = eexamreg.CustNo";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseExamRegistration#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseExamRegistration#WHR") != ""):
    $myWhere    = getSession("BrowseExamRegistration#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseExamRegistration#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseExamRegistration#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseExamRegistration#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseExamRegistration#myOrder") == ""):
    $_SESSION["BrowseExamRegistration#myOrder"] = "ORDER BY eexamreg.CountryID ASC";
    $_SESSION["BrowseExamRegistration#mySort"] = "ASC";
    $_SESSION["BrowseExamRegistration#COL"] = "CountryID";
    $_SESSION["BrowseExamRegistration#SRT"] = getSession("BrowseExamRegistration#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseExamRegistration#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseExamRegistration#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(eexamreg.CountryID) AS MyCount  FROM eexamreg  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eexamreg.CountryID AND  tcustomer.BranchID = eexamreg.BranchID AND  tcustomer.CustNo = eexamreg.CustNo WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(eexamreg.CountryID) AS MyCount  FROM eexamreg  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eexamreg.CountryID AND  tcustomer.BranchID = eexamreg.BranchID AND  tcustomer.CustNo = eexamreg.CustNo";
endif;
$oRSeexamreg = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSeexamreg->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSeexamreg->Close();
$oRSeexamreg = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseExamRegistration#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSeexamreg):
    if($oRSeexamreg->EOF != TRUE):
        if($oRSeexamreg->RecordCount() > 0):
            $oRSeexamreg->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseExamRegistration" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseExamRegistrationListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSeexamreg->Close();
unset($oRSeexamreg);

/*
=============================================================================
  NoRecordsFound
=============================================================================
*/
function NoRecordsFound() {
    $Template = "./html/blank.htm";
    global $ClarionData;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    $tmpMsg = "";
    $tmpMsg = "<a href='BrowseExamRegistration" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updateeexamreg" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseExamRegistrationListTemplate($Template)
=============================================================================
*/
function MergeBrowseExamRegistrationListTemplate($Template) {
    global $ClarionData;
    global $SearchField;
    global $SearchMessage;
    global $HeaderText;
    global $TemplateText;
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $FooterText;
    global $TableFooter;    
    global $RemainderText;
    global $ndxStart;
    global $ndxEnd;
    global $strLEN; 
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    if($Template == ""):
        $Template = "./html/BrowseExamRegistrationlist.htm";
    endif;      
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

    // start iterating the symbols and assigning the values
    $tmpText = preg_split("/<!--BEGIN ROWDATA-->/", $TemplateText);
    $HeaderText = $tmpText[0]; // assign the left side
    buildColumnLabels();

    $remainder = $tmpText[1]; // assign the right side
    $tmpText = preg_split("/<!--END ROWDATA-->/", $remainder);    
    $DataRowFilledText = "";
    $DataRowEmptyText = $tmpText[0];
    buildDataRows();

    $remainder = $tmpText[1];
    $tmpText = preg_split("/<!--BEGIN FOOTER-->/", $remainder);         
    $remainder = $tmpText[1];
    $tmpText = preg_split("/<!--END FOOTER-->/", $remainder);            
    $FooterText = $tmpText[0];
    $RemainderText = $tmpText[1];
    buildFooter();
    if(! empty($HeaderText)):
        $TemplateText = $HeaderText;
    endif;
    if(! empty($DataRowFilledText)):
        $TemplateText .= $DataRowFilledText;
    endif;
    if(! empty($FooterText)):
        $TemplateText .= $FooterText;
    endif;
    if(! empty($RemainderText)):
        $TemplateText .= $RemainderText;
    endif;
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    $TemplateText = Replace($TemplateText, "@SearchMessage@", $SearchMessage);
    $TemplateText = Replace($TemplateText, "@SearchField@", $SearchField);
    $TemplateText = Replace($TemplateText,"@TableFooter@", $TableFooter);
    print ($TemplateText);
}

// =================
function buildColumnLabels() {
    global $HeaderText;
    global $myPage;
    global $IconBorder;
    global $IconWidth;
    global $IconHeight;
    global $IconPath;
    global $IconBack;
    global $IconHelp;
    global $IconAsc;
    global $IconDesc;
    $myLink = "";
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CountryID";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "CountryID"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseExamRegistration#COL") == "CountryID" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "BranchID"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseExamRegistration#COL") == "BranchID" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Date";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Date"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Date"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Date</a>";
        $DateLABEL = $myLink;
        if ( getGet("COL") == "Date" || getSession("BrowseExamRegistration#COL") == "Date" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $DateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SurName";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "SurName"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "SurName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sur Name</a>";
        $SurNameLABEL = $myLink;
        if ( getGet("COL") == "SurName" || getSession("BrowseExamRegistration#COL") == "SurName" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $SurNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SurNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=FirstName";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "FirstName"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "FirstName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">First Name</a>";
        $FirstNameLABEL = $myLink;
        if ( getGet("COL") == "FirstName" || getSession("BrowseExamRegistration#COL") == "FirstName" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $FirstNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $FirstNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MiddleName";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "MiddleName"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "MiddleName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Middle Name</a>";
        $MiddleNameLABEL = $myLink;
        if ( getGet("COL") == "MiddleName" || getSession("BrowseExamRegistration#COL") == "MiddleName" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $MiddleNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MiddleNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Categ";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Categ"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Categ"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Categ</a>";
        $CategLABEL = $myLink;
        if ( getGet("COL") == "Categ" || getSession("BrowseExamRegistration#COL") == "Categ" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $CategLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CategLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Categ2";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Categ2"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Categ2"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Categ 2</a>";
        $Categ2LABEL = $myLink;
        if ( getGet("COL") == "Categ2" || getSession("BrowseExamRegistration#COL") == "Categ2" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $Categ2LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Categ2LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Categ3";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Categ3"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Categ3"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Categ 3</a>";
        $Categ3LABEL = $myLink;
        if ( getGet("COL") == "Categ3" || getSession("BrowseExamRegistration#COL") == "Categ3" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $Categ3LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Categ3LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Grade";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Grade"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Grade"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Grade</a>";
        $GradeLABEL = $myLink;
        if ( getGet("COL") == "Grade" || getSession("BrowseExamRegistration#COL") == "Grade" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $GradeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $GradeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Grade2";
            if ( getSession("BrowseExamRegistration#PreviousColumn") == "Grade2"):
                if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamRegistration#COL") == "Grade2"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Grade 2</a>";
        $Grade2LABEL = $myLink;
        if ( getGet("COL") == "Grade2" || getSession("BrowseExamRegistration#COL") == "Grade2" ):
            if (getSession("BrowseExamRegistration#SRT") == "ASC"):
                $Grade2LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Grade2LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@DateLABEL@", $DateLABEL);
$HeaderText = Replace($HeaderText,"@SurNameLABEL@", $SurNameLABEL);
$HeaderText = Replace($HeaderText,"@FirstNameLABEL@", $FirstNameLABEL);
$HeaderText = Replace($HeaderText,"@MiddleNameLABEL@", $MiddleNameLABEL);
$HeaderText = Replace($HeaderText,"@CategLABEL@", $CategLABEL);
$HeaderText = Replace($HeaderText,"@Categ2LABEL@", $Categ2LABEL);
$HeaderText = Replace($HeaderText,"@Categ3LABEL@", $Categ3LABEL);
$HeaderText = Replace($HeaderText,"@GradeLABEL@", $GradeLABEL);
$HeaderText = Replace($HeaderText,"@Grade2LABEL@", $Grade2LABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSeexamreg;
    global $RecordsPageSize;
    global $eexamregAutomaticDetailLink;
    global $eexamregAutomaticDetailLinkSTYLE;
    global $eexamregBranchID;
    global $eexamregBranchIDLABEL;
    global $eexamregBranchIDSTYLE;
    global $eexamregCateg;
    global $eexamregCateg2;
    global $eexamregCateg2LABEL;
    global $eexamregCateg2STYLE;
    global $eexamregCateg3;
    global $eexamregCateg3LABEL;
    global $eexamregCateg3STYLE;
    global $eexamregCategLABEL;
    global $eexamregCategSTYLE;
    global $eexamregCountryID;
    global $eexamregCountryIDLABEL;
    global $eexamregCountryIDSTYLE;
    global $eexamregDate;
    global $eexamregDateLABEL;
    global $eexamregDateSTYLE;
    global $eexamregGrade;
    global $eexamregGrade2;
    global $eexamregGrade2LABEL;
    global $eexamregGrade2STYLE;
    global $eexamregGradeLABEL;
    global $eexamregGradeSTYLE;
    global $tcustomerFirstName;
    global $tcustomerFirstNameLABEL;
    global $tcustomerFirstNameSTYLE;
    global $tcustomerMiddleName;
    global $tcustomerMiddleNameLABEL;
    global $tcustomerMiddleNameSTYLE;
    global $tcustomerSurName;
    global $tcustomerSurNameLABEL;
    global $tcustomerSurNameSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRSeexamreg) :
        while ((!$oRSeexamreg->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $eexamregAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updateeexamregedit.php?ID1=";
                    $eexamregAutomaticDetailLink = $myLink;
                      $eexamregAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSeexamreg->fields["CountryID"]))) . "'" ;
                    $eexamregAutomaticDetailLink .=  "&ID2=" . "'";
                    $eexamregAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeexamreg->fields["BranchID"]))) . "'";
                    $eexamregAutomaticDetailLink .=  "&ID3=";
                    $eexamregAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeexamreg->fields["CustNo"])));
            $tmpIMG_eexamregAutomaticDetailLink = "";
            $tmpIMG_eexamregAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $eexamregAutomaticDetailLink .= "\">" . $tmpIMG_eexamregAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["CountryID"])):
        $eexamregCountryID = "";
    else:
        $eexamregCountryID = htmlEncode(getValue($oRSeexamreg->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["BranchID"])):
        $eexamregBranchID = "";
    else:
        $eexamregBranchID = htmlEncode(getValue($oRSeexamreg->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Date"])):
        $eexamregDate = "";
    else:
        $eexamregDate = htmlEncode(getValue($oRSeexamreg->fields["Date"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerSurNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["SurName"])):
        $tcustomerSurName = "";
    else:
        $tcustomerSurName = htmlEncode(getValue($oRSeexamreg->fields["SurName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["FirstName"])):
        $tcustomerFirstName = "";
    else:
        $tcustomerFirstName = htmlEncode(getValue($oRSeexamreg->fields["FirstName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["MiddleName"])):
        $tcustomerMiddleName = "";
    else:
        $tcustomerMiddleName = htmlEncode(getValue($oRSeexamreg->fields["MiddleName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregCategSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Categ"])):
        $eexamregCateg = "";
    else:
        $eexamregCateg = htmlEncode(getValue($oRSeexamreg->fields["Categ"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregCateg2STYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Categ2"])):
        $eexamregCateg2 = "";
    else:
        $eexamregCateg2 = htmlEncode(getValue($oRSeexamreg->fields["Categ2"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregCateg3STYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Categ3"])):
        $eexamregCateg3 = "";
    else:
        $eexamregCateg3 = htmlEncode(getValue($oRSeexamreg->fields["Categ3"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregGradeSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Grade"])):
        $eexamregGrade = "";
    else:
        $eexamregGrade = htmlEncode(getValue($oRSeexamreg->fields["Grade"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregGrade2STYLE = "TableRow" . $Style;
    if (is_null($oRSeexamreg->fields["Grade2"])):
        $eexamregGrade2 = "";
    else:
        $eexamregGrade2 = htmlEncode(getValue($oRSeexamreg->fields["Grade2"]));
endif;
$Seq++;
$oRSeexamreg->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@eexamregAutomaticDetailLink@", $eexamregAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregAutomaticDetailLinkSTYLE@", $eexamregAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCountryID@", $eexamregCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCountryIDSTYLE@",$eexamregCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregBranchID@", $eexamregBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregBranchIDSTYLE@",$eexamregBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregDate@", $eexamregDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregDateSTYLE@",$eexamregDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", $tcustomerSurName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@",$tcustomerSurNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", $tcustomerFirstName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@",$tcustomerFirstNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", $tcustomerMiddleName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@",$tcustomerMiddleNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg@", $eexamregCateg);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCategSTYLE@",$eexamregCategSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg2@", $eexamregCateg2);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg2STYLE@",$eexamregCateg2STYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg3@", $eexamregCateg3);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg3STYLE@",$eexamregCateg3STYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade@", $eexamregGrade);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGradeSTYLE@",$eexamregGradeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade2@", $eexamregGrade2);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade2STYLE@",$eexamregGrade2STYLE);           
        endwhile; // of oRSeexamreg DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamregAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregAutomaticDetailLinkSTYLE@", $eexamregAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCountryID@", "&nbsp;");
$eexamregCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCountryIDSTYLE@", $eexamregCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregBranchID@", "&nbsp;");
$eexamregBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregBranchIDSTYLE@", $eexamregBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregDate@", "&nbsp;");
$eexamregDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregDateSTYLE@", $eexamregDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", "&nbsp;");
$tcustomerSurNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@", $tcustomerSurNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", "&nbsp;");
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@", $tcustomerFirstNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", "&nbsp;");
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@", $tcustomerMiddleNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg@", "&nbsp;");
$eexamregCategSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCategSTYLE@", $eexamregCategSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg2@", "&nbsp;");
$eexamregCateg2STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg2STYLE@", $eexamregCateg2STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg3@", "&nbsp;");
$eexamregCateg3STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregCateg3STYLE@", $eexamregCateg3STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade@", "&nbsp;");
$eexamregGradeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGradeSTYLE@", $eexamregGradeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade2@", "&nbsp;");
$eexamregGrade2STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamregGrade2STYLE@", $eexamregGrade2STYLE);
--$Seq;
} while ($Seq > 0);
endif;

} // end function

//=============================================================================
function buildFooter() {
//=============================================================================
global $myPage;
global $FooterText;
global $TableFooter;
global $ShowDBNav;
global $ShowAdd;
global $ShowQuery;
global $TotalRecords;
global $iStart;
global $iEnd;
global $MaxPages;
global $PageIndex;
global $RecordsPageSize;
global $IconBorder;
global $IconWidth;
global $IconHeight;
global $IconPath;
global $IconBack;
global $IconHelp;
global $IconAsc;
global $IconDesc;
global $IconEllipsis;
global $IconReturn;
global $IconEdit;
global $IconFirst;
global $IconFirstDisabled;
global $IconPrior;
global $IconPriorDisabled;
global $IconAdd;
global $IconAddDisabled;
global $IconQuery;
global $IconQueryDisabled;
global $IconNext;
global $IconNextDisabled;
global $IconLast;
global $IconLastDisabled;
global $oRSeexamreg;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updateeexamregsearch.php";
$TableFooter .= ($iStart+1) . " - " . $iEnd . " of " . $TotalRecords ."<BR>";
// okay this is the First Page
    $ref = "";
    $counter = $PageIndex;
    if ($counter > 1):
        if (getRequest("ID1") != ""):
            $ref .= "<a href=" . $myPage . "?PageIndex=1&ID1=" . htmlDecode(getGet("ID1")) ."><img src=\"" . $IconFirst . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"First page\"></a>";
        else:
            $ref .= "<a href=" . $myPage . "?PageIndex=1><img src=\"" . $IconFirst . "\" border=\"" . $IconBorder ."\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"First page\"></a>";
        endif;
    else:
            $ref = "<img src=\"" . $IconFirstDisabled . "\" alt=\"First page\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\">";
    endif;
    
$TableFooter .= $ref;
// okay this is the Prior Page
    $ref = "";
    $counter = $PageIndex;
    if ($counter > 1):
        if (getRequest("ID1") != ""):
            $ref .= "<a href=\"" . $myPage . "?PageIndex=" . ($counter - 1) . "&ID1=" . htmlDecode(getGet("ID1")) . "\"><img src=\"" . $IconPrior . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Prior page\"></a>";
        else:
            $ref .= "<a href=\"" . $myPage . "?PageIndex=" . ($counter - 1) . "\"><img src=\"" . $IconPrior . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Prior page\"></a>";
        endif;
    else:
        $ref = "<img src=\"" . $IconPriorDisabled . "\" alt=\"Prior page\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\">";
    endif;
$TableFooter .= $ref;
// test to see if query is enabled 
    if ($ShowQuery == TRUE):
    // okay now the Query button
        $ref = "";
        $ref .= "<a href=Updateeexamreg" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updateeexamreg" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
$TableFooter .= $ref;
    endif;
//okay now the Next Page
    $ref = "";
    $counter = $PageIndex;
    if ($counter < $MaxPages):
        if (getRequest("ID1") != ""):
            $ref .= "<a href=" . $myPage . "?PageIndex=" . ($counter + 1) . "&ID1=" . htmlDecode(getGet("ID1")) . "><img src=\"" . $IconNext . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Next page\"></a>";
        else:
            $ref .= "<a href=" . $myPage . "?PageIndex=" . ($counter + 1) . "><img src=\"" . $IconNext . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Next page\"></a>";
        endif;
    else:
            $ref = "<img src=\"" . $IconNextDisabled . "\" alt=\"Next page\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\">";
    endif;
$TableFooter .= $ref;
// okay now the Last Page
    $ref = "";
    $counter = $PageIndex;
    if ($counter < $MaxPages):
        if (htmlDecode(getGet("ID1")) != ""):
            $ref .= "<a href=" . $myPage . "?PageIndex=" . $MaxPages . "&ID1=" . htmlDecode(getGet("ID1")) ."><img src=\"" . $IconLast . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Last page\"></a>";
        else:
            $ref .= "<a href=" . $myPage . "?PageIndex=" . $MaxPages . "><img src=\"" . $IconLast . "\" border=\"" . $IconBorder ."\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Last page\"></a>";
        endif;
    else:
        $ref = "<img src=\"" . $IconLastDisabled . "\" alt=\"Last page\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\">";
    endif;

$TableFooter .= $ref;
$FooterText = Replace($FooterText,"@TableFooter@", $TableFooter);
endif;
}
    $objConn1->Close();
    unset($objConn1);

?>
