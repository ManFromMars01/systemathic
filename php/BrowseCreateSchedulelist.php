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
$BrowseCreateScheduleRowData = "";
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
$eattheadAutomaticDetailLink = "";
$eattheadAutomaticDetailLinkSTYLE = "";
$eattheadCountryIDLABEL = "";
$eattheadCountryID = "";
$eattheadCountryIDSTYLE = "";
$eattheadBranchIDLABEL = "";
$eattheadBranchID = "";
$eattheadBranchIDSTYLE = "";
$eattheadAdmitDateLABEL = "";
$eattheadAdmitDate = "";
$eattheadAdmitDateSTYLE = "";
$eattheadCustNoLABEL = "";
$eattheadCustNo = "";
$eattheadCustNoSTYLE = "";
$eattheadLevelIDLABEL = "";
$eattheadLevelID = "";
$eattheadLevelIDSTYLE = "";
$eattheadTierIDLABEL = "";
$eattheadTierID = "";
$eattheadTierIDSTYLE = "";
$eattheadModCountLABEL = "";
$eattheadModCount = "";
$eattheadModCountSTYLE = "";
$eattheadStartDateLABEL = "";
$eattheadStartDate = "";
$eattheadStartDateSTYLE = "";
$eattheadEndDateLABEL = "";
$eattheadEndDate = "";
$eattheadEndDateSTYLE = "";
$oRSeatthead = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseCreateSchedule#WHR"] = "";
    $_SESSION["BrowseCreateSchedule#COL"] = "";
    $_SESSION["BrowseCreateSchedule#SRT"] = "";
    $_SESSION["BrowseCreateSchedule#PreviousColumn"] = "";
    $_SESSION["BrowseCreateSchedule#PreviousSort"] = "";
    $_SESSION["BrowseCreateSchedule#mySort"] = "";
    $_SESSION["BrowseCreateSchedule#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseCreateSchedule#WHR"] = "";
        $_SESSION["BrowseCreateSchedule#COL"] = "";
        $_SESSION["BrowseCreateSchedule#SRT"] = "";
        $_SESSION["BrowseCreateSchedule#PreviousColumn"] = "";
        $_SESSION["BrowseCreateSchedule#PreviousSort"] = "";
        $_SESSION["BrowseCreateSchedule#mySort"] = "";
        $_SESSION["BrowseCreateSchedule#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseCreateSchedule#COL"] = "";
            $_SESSION["BrowseCreateSchedule#SRT"] = "";
            $_SESSION["BrowseCreateSchedule#PreviousColumn"] = "";
            $_SESSION["BrowseCreateSchedule#PreviousSort"] = "";
            $_SESSION["BrowseCreateSchedule#mySort"] = "";
            $_SESSION["BrowseCreateSchedule#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseCreateSchedule#PreviousColumn"] = "";
else:
    $_SESSION["BrowseCreateSchedule#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseCreateSchedule#PreviousSort"] = "";
else:
    $_SESSION["BrowseCreateSchedule#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseCreateSchedule#COL") == ""):
    if (getRequest("COL") . getSession("BrowseCreateSchedule#COL") == ""):
        $_SESSION["BrowseCreateSchedule#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CountryID DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CountryID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CountryID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "CountryID";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.BranchID DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.BranchID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.BranchID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "BranchID";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "AdmitDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.AdmitDate DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.AdmitDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.AdmitDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "AdmitDate";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "CustNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CustNo DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CustNo ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CustNo ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "CustNo";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "LevelID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.LevelID DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.LevelID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.LevelID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "LevelID";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "TierID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.TierID DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.TierID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.TierID ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "TierID";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "ModCount"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.ModCount DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.ModCount ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.ModCount ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "ModCount";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "StartDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.StartDate DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.StartDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.StartDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "StartDate";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

if (getRequest("COL") == "EndDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.EndDate DESC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.EndDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCreateSchedule#PreviousColumn")):
        $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.EndDate ASC";
        $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCreateSchedule#COL"] = "EndDate";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

$myQuery    = "SELECT eatthead.CountryID, eatthead.BranchID, eatthead.CustNo, eatthead.TierID, eatthead.AdmitDate, eatthead.LevelID, eatthead.ModCount, eatthead.StartDate, eatthead.EndDate FROM eatthead";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseCreateSchedule#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseCreateSchedule#WHR") != ""):
    $myWhere    = getSession("BrowseCreateSchedule#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCreateSchedule#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseCreateSchedule#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseCreateSchedule#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"eatthead", "eatthead.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "eatthead.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseCreateSchedule#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseCreateSchedule#myOrder") == ""):
    $_SESSION["BrowseCreateSchedule#myOrder"] = "ORDER BY eatthead.CountryID ASC";
    $_SESSION["BrowseCreateSchedule#mySort"] = "ASC";
    $_SESSION["BrowseCreateSchedule#COL"] = "CountryID";
    $_SESSION["BrowseCreateSchedule#SRT"] = getSession("BrowseCreateSchedule#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseCreateSchedule#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseCreateSchedule#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(eatthead.CountryID) AS MyCount  FROM eatthead WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(eatthead.CountryID) AS MyCount  FROM eatthead";
endif;
$oRSeatthead = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSeatthead->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSeatthead->Close();
$oRSeatthead = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCreateSchedule#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSeatthead):
    if($oRSeatthead->EOF != TRUE):
        if($oRSeatthead->RecordCount() > 0):
            $oRSeatthead->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseCreateSchedule" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseCreateScheduleListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSeatthead->Close();
unset($oRSeatthead);

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
    $tmpMsg = "<a href='BrowseCreateSchedule" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updateeatthead" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseCreateScheduleListTemplate($Template)
=============================================================================
*/
function MergeBrowseCreateScheduleListTemplate($Template) {
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
        $Template = "./html/BrowseCreateSchedulelist.htm";
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
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "CountryID"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseCreateSchedule#COL") == "CountryID" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "BranchID"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseCreateSchedule#COL") == "BranchID" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=AdmitDate";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "AdmitDate"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "AdmitDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Admit Date</a>";
        $AdmitDateLABEL = $myLink;
        if ( getGet("COL") == "AdmitDate" || getSession("BrowseCreateSchedule#COL") == "AdmitDate" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $AdmitDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $AdmitDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CustNo";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "CustNo"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "CustNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Cust No</a>";
        $CustNoLABEL = $myLink;
        if ( getGet("COL") == "CustNo" || getSession("BrowseCreateSchedule#COL") == "CustNo" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $CustNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CustNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LevelID";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "LevelID"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "LevelID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level ID</a>";
        $LevelIDLABEL = $myLink;
        if ( getGet("COL") == "LevelID" || getSession("BrowseCreateSchedule#COL") == "LevelID" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $LevelIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LevelIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TierID";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "TierID"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "TierID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Tier ID</a>";
        $TierIDLABEL = $myLink;
        if ( getGet("COL") == "TierID" || getSession("BrowseCreateSchedule#COL") == "TierID" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $TierIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TierIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ModCount";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "ModCount"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "ModCount"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Mod Count</a>";
        $ModCountLABEL = $myLink;
        if ( getGet("COL") == "ModCount" || getSession("BrowseCreateSchedule#COL") == "ModCount" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $ModCountLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ModCountLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=StartDate";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "StartDate"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "StartDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Start Date</a>";
        $StartDateLABEL = $myLink;
        if ( getGet("COL") == "StartDate" || getSession("BrowseCreateSchedule#COL") == "StartDate" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $StartDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $StartDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=EndDate";
            if ( getSession("BrowseCreateSchedule#PreviousColumn") == "EndDate"):
                if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCreateSchedule#COL") == "EndDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">End Date</a>";
        $EndDateLABEL = $myLink;
        if ( getGet("COL") == "EndDate" || getSession("BrowseCreateSchedule#COL") == "EndDate" ):
            if (getSession("BrowseCreateSchedule#SRT") == "ASC"):
                $EndDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $EndDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@AdmitDateLABEL@", $AdmitDateLABEL);
$HeaderText = Replace($HeaderText,"@CustNoLABEL@", $CustNoLABEL);
$HeaderText = Replace($HeaderText,"@LevelIDLABEL@", $LevelIDLABEL);
$HeaderText = Replace($HeaderText,"@TierIDLABEL@", $TierIDLABEL);
$HeaderText = Replace($HeaderText,"@ModCountLABEL@", $ModCountLABEL);
$HeaderText = Replace($HeaderText,"@StartDateLABEL@", $StartDateLABEL);
$HeaderText = Replace($HeaderText,"@EndDateLABEL@", $EndDateLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSeatthead;
    global $RecordsPageSize;
    global $eattheadAdmitDate;
    global $eattheadAdmitDateLABEL;
    global $eattheadAdmitDateSTYLE;
    global $eattheadAutomaticDetailLink;
    global $eattheadAutomaticDetailLinkSTYLE;
    global $eattheadBranchID;
    global $eattheadBranchIDLABEL;
    global $eattheadBranchIDSTYLE;
    global $eattheadCountryID;
    global $eattheadCountryIDLABEL;
    global $eattheadCountryIDSTYLE;
    global $eattheadCustNo;
    global $eattheadCustNoLABEL;
    global $eattheadCustNoSTYLE;
    global $eattheadEndDate;
    global $eattheadEndDateLABEL;
    global $eattheadEndDateSTYLE;
    global $eattheadLevelID;
    global $eattheadLevelIDLABEL;
    global $eattheadLevelIDSTYLE;
    global $eattheadModCount;
    global $eattheadModCountLABEL;
    global $eattheadModCountSTYLE;
    global $eattheadStartDate;
    global $eattheadStartDateLABEL;
    global $eattheadStartDateSTYLE;
    global $eattheadTierID;
    global $eattheadTierIDLABEL;
    global $eattheadTierIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRSeatthead) :
        while ((!$oRSeatthead->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $eattheadAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updateeattheadedit.php?ID1=";
                    $eattheadAutomaticDetailLink = $myLink;
                      $eattheadAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSeatthead->fields["CountryID"]))) . "'" ;
                    $eattheadAutomaticDetailLink .=  "&ID2=" . "'";
                    $eattheadAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeatthead->fields["BranchID"]))) . "'";
                    $eattheadAutomaticDetailLink .=  "&ID3=";
                    $eattheadAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeatthead->fields["CustNo"])));
                    $eattheadAutomaticDetailLink .=  "&ID4=";
                    $eattheadAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeatthead->fields["TierID"])));
            $tmpIMG_eattheadAutomaticDetailLink = "";
            $tmpIMG_eattheadAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $eattheadAutomaticDetailLink .= "\">" . $tmpIMG_eattheadAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["CountryID"])):
        $eattheadCountryID = "";
    else:
        $eattheadCountryID = htmlEncode(getValue($oRSeatthead->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["BranchID"])):
        $eattheadBranchID = "";
    else:
        $eattheadBranchID = htmlEncode(getValue($oRSeatthead->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadAdmitDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["AdmitDate"])):
        $eattheadAdmitDate = "";
    else:
        $eattheadAdmitDate = htmlEncode(getValue($oRSeatthead->fields["AdmitDate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadCustNoSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["CustNo"])):
        $eattheadCustNo = "";
    else:
        $eattheadCustNo = htmlEncode(getValue($oRSeatthead->fields["CustNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadLevelIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["LevelID"])):
        $eattheadLevelID = "";
    else:
        $eattheadLevelID = htmlEncode(getValue($oRSeatthead->fields["LevelID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadTierIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["TierID"])):
        $eattheadTierID = "";
    else:
        $eattheadTierID = htmlEncode(getValue($oRSeatthead->fields["TierID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadModCountSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["ModCount"])):
        $eattheadModCount = "";
    else:
        $eattheadModCount = htmlEncode(getValue($oRSeatthead->fields["ModCount"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadStartDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["StartDate"])):
        $eattheadStartDate = "";
    else:
        $eattheadStartDate = htmlEncode(getValue($oRSeatthead->fields["StartDate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadEndDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeatthead->fields["EndDate"])):
        $eattheadEndDate = "";
    else:
        $eattheadEndDate = htmlEncode(getValue($oRSeatthead->fields["EndDate"]));
endif;
$Seq++;
$oRSeatthead->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAutomaticDetailLink@", $eattheadAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAutomaticDetailLinkSTYLE@", $eattheadAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCountryID@", $eattheadCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCountryIDSTYLE@",$eattheadCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadBranchID@", $eattheadBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadBranchIDSTYLE@",$eattheadBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAdmitDate@", $eattheadAdmitDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAdmitDateSTYLE@",$eattheadAdmitDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCustNo@", $eattheadCustNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCustNoSTYLE@",$eattheadCustNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadLevelID@", $eattheadLevelID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadLevelIDSTYLE@",$eattheadLevelIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadTierID@", $eattheadTierID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadTierIDSTYLE@",$eattheadTierIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadModCount@", $eattheadModCount);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadModCountSTYLE@",$eattheadModCountSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadStartDate@", $eattheadStartDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadStartDateSTYLE@",$eattheadStartDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadEndDate@", $eattheadEndDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadEndDateSTYLE@",$eattheadEndDateSTYLE);           
        endwhile; // of oRSeatthead DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eattheadAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAutomaticDetailLinkSTYLE@", $eattheadAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCountryID@", "&nbsp;");
$eattheadCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCountryIDSTYLE@", $eattheadCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadBranchID@", "&nbsp;");
$eattheadBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadBranchIDSTYLE@", $eattheadBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAdmitDate@", "&nbsp;");
$eattheadAdmitDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadAdmitDateSTYLE@", $eattheadAdmitDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCustNo@", "&nbsp;");
$eattheadCustNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadCustNoSTYLE@", $eattheadCustNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadLevelID@", "&nbsp;");
$eattheadLevelIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadLevelIDSTYLE@", $eattheadLevelIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadTierID@", "&nbsp;");
$eattheadTierIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadTierIDSTYLE@", $eattheadTierIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadModCount@", "&nbsp;");
$eattheadModCountSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadModCountSTYLE@", $eattheadModCountSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadStartDate@", "&nbsp;");
$eattheadStartDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadStartDateSTYLE@", $eattheadStartDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadEndDate@", "&nbsp;");
$eattheadEndDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eattheadEndDateSTYLE@", $eattheadEndDateSTYLE);
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
global $oRSeatthead;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updateeattheadsearch.php";
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
        $ref .= "<a href=Updateeatthead" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updateeatthead" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
