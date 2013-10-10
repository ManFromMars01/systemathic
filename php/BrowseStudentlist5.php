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
$PageLevel = 0;
$PageLevel = 50;
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
$HTML_Template = getRequest("HTMLT");

//Count me
$myWhere2 .= "tcustomer.CountryID ='".$_SESSION["UserValue1"]."' AND tcustomer.CustType = 'Continuing' ";
$myRecordCount2 = "SELECT COUNT(tcustomer.CountryID) AS MyCount  FROM tcustomer WHERE " .$myWhere2 ;
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
//endcountme

// display of the number of records can be overridden by uncommenting the next line
$RecordsPerPage = $TotalRecords1;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseStudentRowData = "";
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
$tcustomerAutomaticDetailLink = "";
$tcustomerAutomaticDetailLinkSTYLE = "";
$tcustomerCountryIDLABEL = "";
$tcustomerCountryID = "";
$tcustomerCountryIDSTYLE = "";
$tcustomerBranchIDLABEL = "";
$tcustomerBranchID = "";
$tcustomerBranchIDSTYLE = "";
$tcustomerCustNoLABEL = "";
$tcustomerCustNo = "";
$tcustomerCustNoSTYLE = "";
$tcustomerStudentIDLABEL = "";
$tcustomerStudentID = "";
$tcustomerStudentIDSTYLE = "";
$tcustomerSurNameLABEL = "";
$tcustomerSurName = "";
$tcustomerSurNameSTYLE = "";
$tcustomerFirstNameLABEL = "";
$tcustomerFirstName = "";
$tcustomerFirstNameSTYLE = "";
$tcustomerMiddleNameLABEL = "";
$tcustomerMiddleName = "";
$tcustomerMiddleNameSTYLE = "";
$tcustomerLSurnameLABEL = "";
$tcustomerLSurname = "";
$tcustomerLSurnameSTYLE = "";
$tcustomerLFirstNameLABEL = "";
$tcustomerLFirstName = "";
$tcustomerLFirstNameSTYLE = "";
$oRStcustomer = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseStudent#WHR"] = "";
    $_SESSION["BrowseStudent#COL"] = "";
    $_SESSION["BrowseStudent#SRT"] = "";
    $_SESSION["BrowseStudent#PreviousColumn"] = "";
    $_SESSION["BrowseStudent#PreviousSort"] = "";
    $_SESSION["BrowseStudent#mySort"] = "";
    $_SESSION["BrowseStudent#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseStudent#WHR"] = "";
        $_SESSION["BrowseStudent#COL"] = "";
        $_SESSION["BrowseStudent#SRT"] = "";
        $_SESSION["BrowseStudent#PreviousColumn"] = "";
        $_SESSION["BrowseStudent#PreviousSort"] = "";
        $_SESSION["BrowseStudent#mySort"] = "";
        $_SESSION["BrowseStudent#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseStudent#COL"] = "";
            $_SESSION["BrowseStudent#SRT"] = "";
            $_SESSION["BrowseStudent#PreviousColumn"] = "";
            $_SESSION["BrowseStudent#PreviousSort"] = "";
            $_SESSION["BrowseStudent#mySort"] = "";
            $_SESSION["BrowseStudent#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseStudent#PreviousColumn"] = "";
else:
    $_SESSION["BrowseStudent#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseStudent#PreviousSort"] = "";
else:
    $_SESSION["BrowseStudent#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseStudent#COL") == ""):
    if (getRequest("COL") . getSession("BrowseStudent#COL") == ""):
        $_SESSION["BrowseStudent#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CountryID DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CountryID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CountryID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "CountryID";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.BranchID DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.BranchID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.BranchID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "BranchID";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "CustNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CustNo DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CustNo ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CustNo ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "CustNo";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "StudentID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.StudentID DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.StudentID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.StudentID ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "StudentID";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "SurName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.SurName DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "SurName";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "FirstName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.FirstName DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "FirstName";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "MiddleName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.MiddleName DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "MiddleName";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "LSurname"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LSurname DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LSurname ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LSurname ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "LSurname";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

if (getRequest("COL") == "LFirstName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LFirstName DESC";
        $_SESSION["BrowseStudent#mySort"] = "DESC";
    else:
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LFirstName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseStudent#PreviousColumn")):
        $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.LFirstName ASC";
        $_SESSION["BrowseStudent#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseStudent#COL"] = "LFirstName";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

$myQuery    = "SELECT tcustomer.CountryID, tcustomer.BranchID, tcustomer.CustNo, tcustomer.StudentID, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, tcustomer.LSurname, tcustomer.LFirstName FROM tcustomer";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseStudent#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseStudent#WHR") != ""):
    $myWhere    = getSession("BrowseStudent#WHR");
endif;

if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseStudent#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseStudent#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseStudent#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tcustomer", "tcustomer.CountryID");
var_dump($strMyQuote);
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tcustomer.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote."AND tcustomer.CustType = 'Continuing' ";


$_SESSION["BrowseStudent#WHR"] = $myWhere;
$mySQL = $myQuery;




// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseStudent#myOrder") == ""):
    $_SESSION["BrowseStudent#myOrder"] = "ORDER BY tcustomer.CountryID ASC";
    $_SESSION["BrowseStudent#mySort"] = "ASC";
    $_SESSION["BrowseStudent#COL"] = "CountryID";
    $_SESSION["BrowseStudent#SRT"] = getSession("BrowseStudent#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseStudent#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseStudent#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tcustomer.CountryID) AS MyCount  FROM tcustomer WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tcustomer.CountryID) AS MyCount  FROM tcustomer";
endif;
$oRStcustomer = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStcustomer->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStcustomer->Close();
$oRStcustomer = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);

if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseStudent#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStcustomer):
    if($oRStcustomer->EOF != TRUE):
        if($oRStcustomer->RecordCount() > 0):
            $oRStcustomer->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseStudent" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseStudentListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStcustomer->Close();
unset($oRStcustomer);

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
    $tmpMsg = "<a href='BrowseStudent" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=UpdatetStudent" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseStudentListTemplate($Template)
=============================================================================
*/
function MergeBrowseStudentListTemplate($Template) {
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
    global $userdata1;
    if($Template == ""):
        $Template = "./html/BrowseStudentlist.htm";
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
    $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
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
            if ( getSession("BrowseStudent#PreviousColumn") == "CountryID"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseStudent#COL") == "CountryID" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseStudent#PreviousColumn") == "BranchID"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseStudent#COL") == "BranchID" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CustNo";
            if ( getSession("BrowseStudent#PreviousColumn") == "CustNo"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "CustNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Cust No</a>";
        $CustNoLABEL = $myLink;
        if ( getGet("COL") == "CustNo" || getSession("BrowseStudent#COL") == "CustNo" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $CustNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CustNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=StudentID";
            if ( getSession("BrowseStudent#PreviousColumn") == "StudentID"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "StudentID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Student ID</a>";
        $StudentIDLABEL = $myLink;
        if ( getGet("COL") == "StudentID" || getSession("BrowseStudent#COL") == "StudentID" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $StudentIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $StudentIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SurName";
            if ( getSession("BrowseStudent#PreviousColumn") == "SurName"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "SurName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sur Name</a>";
        $SurNameLABEL = $myLink;
        if ( getGet("COL") == "SurName" || getSession("BrowseStudent#COL") == "SurName" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $SurNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SurNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=FirstName";
            if ( getSession("BrowseStudent#PreviousColumn") == "FirstName"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "FirstName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">First Name</a>";
        $FirstNameLABEL = $myLink;
        if ( getGet("COL") == "FirstName" || getSession("BrowseStudent#COL") == "FirstName" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $FirstNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $FirstNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MiddleName";
            if ( getSession("BrowseStudent#PreviousColumn") == "MiddleName"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "MiddleName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Middle Name</a>";
        $MiddleNameLABEL = $myLink;
        if ( getGet("COL") == "MiddleName" || getSession("BrowseStudent#COL") == "MiddleName" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $MiddleNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MiddleNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LSurname";
            if ( getSession("BrowseStudent#PreviousColumn") == "LSurname"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "LSurname"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">LS urname</a>";
        $LSurnameLABEL = $myLink;
        if ( getGet("COL") == "LSurname" || getSession("BrowseStudent#COL") == "LSurname" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $LSurnameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LSurnameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LFirstName";
            if ( getSession("BrowseStudent#PreviousColumn") == "LFirstName"):
                if (getSession("BrowseStudent#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseStudent#COL") == "LFirstName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">LF irst Name</a>";
        $LFirstNameLABEL = $myLink;
        if ( getGet("COL") == "LFirstName" || getSession("BrowseStudent#COL") == "LFirstName" ):
            if (getSession("BrowseStudent#SRT") == "ASC"):
                $LFirstNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LFirstNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@CustNoLABEL@", $CustNoLABEL);
$HeaderText = Replace($HeaderText,"@StudentIDLABEL@", $StudentIDLABEL);
$HeaderText = Replace($HeaderText,"@SurNameLABEL@", $SurNameLABEL);
$HeaderText = Replace($HeaderText,"@FirstNameLABEL@", $FirstNameLABEL);
$HeaderText = Replace($HeaderText,"@MiddleNameLABEL@", $MiddleNameLABEL);
$HeaderText = Replace($HeaderText,"@LSurnameLABEL@", $LSurnameLABEL);
$HeaderText = Replace($HeaderText,"@LFirstNameLABEL@", $LFirstNameLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStcustomer;
    global $RecordsPageSize;
    global $tcustomerAutomaticDetailLink;
    global $tcustomerAutomaticDetailLinkSTYLE;
    global $tcustomerBranchID;
    global $tcustomerBranchIDLABEL;
    global $tcustomerBranchIDSTYLE;
    global $tcustomerCountryID;
    global $tcustomerCountryIDLABEL;
    global $tcustomerCountryIDSTYLE;
    global $tcustomerCustNo;
    global $tcustomerCustNoLABEL;
    global $tcustomerCustNoSTYLE;
    global $tcustomerFirstName;
    global $tcustomerFirstNameLABEL;
    global $tcustomerFirstNameSTYLE;
    global $tcustomerLFirstName;
    global $tcustomerLFirstNameLABEL;
    global $tcustomerLFirstNameSTYLE;
    global $tcustomerLSurname;
    global $tcustomerLSurnameLABEL;
    global $tcustomerLSurnameSTYLE;
    global $tcustomerMiddleName;
    global $tcustomerMiddleNameLABEL;
    global $tcustomerMiddleNameSTYLE;
    global $tcustomerStudentID;
    global $tcustomerStudentIDLABEL;
    global $tcustomerStudentIDSTYLE;
    global $tcustomerSurName;
    global $tcustomerSurNameLABEL;
    global $tcustomerSurNameSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStcustomer) :
        while ((!$oRStcustomer->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tcustomerAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"UpdatetStudentedit.php?ID1=";
                    $tcustomerAutomaticDetailLink = $myLink;
                      $tcustomerAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStcustomer->fields["CountryID"]))) . "'" ;
                    $tcustomerAutomaticDetailLink .=  "&ID2=" . "'";
                    $tcustomerAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcustomer->fields["BranchID"]))) . "'";
                    $tcustomerAutomaticDetailLink .=  "&ID3=";
                    $tcustomerAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcustomer->fields["CustNo"])));
            $tmpIMG_tcustomerAutomaticDetailLink = "";
            $tmpIMG_tcustomerAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tcustomerAutomaticDetailLink .= "\">" . $tmpIMG_tcustomerAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["CountryID"])):
        $tcustomerCountryID = "";
    else:
        $tcustomerCountryID = htmlEncode(getValue($oRStcustomer->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["BranchID"])):
        $tcustomerBranchID = "";
    else:
        $tcustomerBranchID = htmlEncode(getValue($oRStcustomer->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerCustNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["CustNo"])):
        $tcustomerCustNo = "";
    else:
        $myQuoteCustNo = "";
        $tcustomerCustNo = '<a href=\'JAVASCRIPT:updateData(';
        $tcustomerCustNo .= $myQuoteCustNo . htmlEncode(getValue($oRStcustomer->fields["CustNo"])) . $myQuoteCustNo;
        $tcustomerCustNo .= ');\'>';
        $tcustomerCustNo .= htmlEncode(getValue($oRStcustomer->fields["CustNo"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerStudentIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["StudentID"])):
        $tcustomerStudentID = "";
    else:
        $tcustomerStudentID = htmlEncode(getValue($oRStcustomer->fields["StudentID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerSurNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["SurName"])):
        $tcustomerSurName = "";
    else:
        $tcustomerSurName = htmlEncode(getValue($oRStcustomer->fields["SurName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["FirstName"])):
        $tcustomerFirstName = "";
    else:
        $tcustomerFirstName = htmlEncode(getValue($oRStcustomer->fields["FirstName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["MiddleName"])):
        $tcustomerMiddleName = "";
    else:
        $tcustomerMiddleName = htmlEncode(getValue($oRStcustomer->fields["MiddleName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerLSurnameSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["LSurname"])):
        $tcustomerLSurname = "";
    else:
        $tcustomerLSurname = htmlEncode(getValue($oRStcustomer->fields["LSurname"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerLFirstNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStcustomer->fields["LFirstName"])):
        $tcustomerLFirstName = "";
    else:
        $tcustomerLFirstName = htmlEncode(getValue($oRStcustomer->fields["LFirstName"]));
endif;
$Seq++;
$oRStcustomer->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerAutomaticDetailLink@", $tcustomerAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerAutomaticDetailLinkSTYLE@", $tcustomerAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCountryID@", $tcustomerCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCountryIDSTYLE@",$tcustomerCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerBranchID@", $tcustomerBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerBranchIDSTYLE@",$tcustomerBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCustNo@", $tcustomerCustNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCustNoSTYLE@",$tcustomerCustNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerStudentID@", $tcustomerStudentID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerStudentIDSTYLE@",$tcustomerStudentIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", $tcustomerSurName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@",$tcustomerSurNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", $tcustomerFirstName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@",$tcustomerFirstNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", $tcustomerMiddleName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@",$tcustomerMiddleNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLSurname@", $tcustomerLSurname);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLSurnameSTYLE@",$tcustomerLSurnameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLFirstName@", $tcustomerLFirstName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLFirstNameSTYLE@",$tcustomerLFirstNameSTYLE);           
        endwhile; // of oRStcustomer DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerAutomaticDetailLinkSTYLE@", $tcustomerAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCountryID@", "&nbsp;");
$tcustomerCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCountryIDSTYLE@", $tcustomerCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerBranchID@", "&nbsp;");
$tcustomerBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerBranchIDSTYLE@", $tcustomerBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCustNo@", "&nbsp;");
$tcustomerCustNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerCustNoSTYLE@", $tcustomerCustNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerStudentID@", "&nbsp;");
$tcustomerStudentIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerStudentIDSTYLE@", $tcustomerStudentIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", "&nbsp;");
$tcustomerSurNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@", $tcustomerSurNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", "&nbsp;");
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@", $tcustomerFirstNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", "&nbsp;");
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@", $tcustomerMiddleNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLSurname@", "&nbsp;");
$tcustomerLSurnameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLSurnameSTYLE@", $tcustomerLSurnameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLFirstName@", "&nbsp;");
$tcustomerLFirstNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerLFirstNameSTYLE@", $tcustomerLFirstNameSTYLE);
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
global $oRStcustomer;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "UpdatetStudentsearch.php";
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
        $ref .= "<a href=UpdatetStudent" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=UpdatetStudent" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
