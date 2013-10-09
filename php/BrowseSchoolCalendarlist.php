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
$BrowseSchoolCalendarRowData = "";
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
$tcalendarAutomaticDetailLink = "";
$tcalendarAutomaticDetailLinkSTYLE = "";
$tcalendarCountryIDLABEL = "";
$tcalendarCountryID = "";
$tcalendarCountryIDSTYLE = "";
$tcalendarBranchIDLABEL = "";
$tcalendarBranchID = "";
$tcalendarBranchIDSTYLE = "";
$tcalendarDateLABEL = "";
$tcalendarDate = "";
$tcalendarDateSTYLE = "";
$tcalendarDescriptionLABEL = "";
$tcalendarDescription = "";
$tcalendarDescriptionSTYLE = "";
$tcalendarTypeLABEL = "";
$tcalendarType = "";
$tcalendarTypeSTYLE = "";
$oRStcalendar = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseSchoolCalendar#WHR"] = "";
    $_SESSION["BrowseSchoolCalendar#COL"] = "";
    $_SESSION["BrowseSchoolCalendar#SRT"] = "";
    $_SESSION["BrowseSchoolCalendar#PreviousColumn"] = "";
    $_SESSION["BrowseSchoolCalendar#PreviousSort"] = "";
    $_SESSION["BrowseSchoolCalendar#mySort"] = "";
    $_SESSION["BrowseSchoolCalendar#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseSchoolCalendar#WHR"] = "";
        $_SESSION["BrowseSchoolCalendar#COL"] = "";
        $_SESSION["BrowseSchoolCalendar#SRT"] = "";
        $_SESSION["BrowseSchoolCalendar#PreviousColumn"] = "";
        $_SESSION["BrowseSchoolCalendar#PreviousSort"] = "";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "";
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseSchoolCalendar#COL"] = "";
            $_SESSION["BrowseSchoolCalendar#SRT"] = "";
            $_SESSION["BrowseSchoolCalendar#PreviousColumn"] = "";
            $_SESSION["BrowseSchoolCalendar#PreviousSort"] = "";
            $_SESSION["BrowseSchoolCalendar#mySort"] = "";
            $_SESSION["BrowseSchoolCalendar#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseSchoolCalendar#PreviousColumn"] = "";
else:
    $_SESSION["BrowseSchoolCalendar#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseSchoolCalendar#PreviousSort"] = "";
else:
    $_SESSION["BrowseSchoolCalendar#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseSchoolCalendar#COL") == ""):
    if (getRequest("COL") . getSession("BrowseSchoolCalendar#COL") == ""):
        $_SESSION["BrowseSchoolCalendar#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.CountryID DESC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.CountryID ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchoolCalendar#PreviousColumn")):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.CountryID ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchoolCalendar#COL"] = "CountryID";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.BranchID DESC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.BranchID ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchoolCalendar#PreviousColumn")):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.BranchID ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchoolCalendar#COL"] = "BranchID";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

if (getRequest("COL") == "Date"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Date DESC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Date ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchoolCalendar#PreviousColumn")):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Date ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchoolCalendar#COL"] = "Date";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Description DESC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Description ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchoolCalendar#PreviousColumn")):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Description ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchoolCalendar#COL"] = "Description";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

if (getRequest("COL") == "Type"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Type DESC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Type ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchoolCalendar#PreviousColumn")):
        $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.Type ASC";
        $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchoolCalendar#COL"] = "Type";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

$myQuery    = "SELECT tcalendar.CountryID, tcalendar.BranchID, tcalendar.Date, tcalendar.Description, tcalendar.Type FROM tcalendar";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseSchoolCalendar#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseSchoolCalendar#WHR") != ""):
    $myWhere    = getSession("BrowseSchoolCalendar#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSchoolCalendar#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseSchoolCalendar#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseSchoolCalendar#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tcalendar", "tcalendar.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tcalendar.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseSchoolCalendar#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseSchoolCalendar#myOrder") == ""):
    $_SESSION["BrowseSchoolCalendar#myOrder"] = "ORDER BY tcalendar.CountryID ASC";
    $_SESSION["BrowseSchoolCalendar#mySort"] = "ASC";
    $_SESSION["BrowseSchoolCalendar#COL"] = "CountryID";
    $_SESSION["BrowseSchoolCalendar#SRT"] = getSession("BrowseSchoolCalendar#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseSchoolCalendar#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseSchoolCalendar#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tcalendar.CountryID) AS MyCount  FROM tcalendar WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tcalendar.CountryID) AS MyCount  FROM tcalendar";
endif;
$oRStcalendar = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStcalendar->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStcalendar->Close();
$oRStcalendar = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSchoolCalendar#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStcalendar):
    if($oRStcalendar->EOF != TRUE):
        if($oRStcalendar->RecordCount() > 0):
            $oRStcalendar->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseSchoolCalendar" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseSchoolCalendarListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStcalendar->Close();
unset($oRStcalendar);

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
    $tmpMsg = "<a href='BrowseSchoolCalendar" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetcalendar" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseSchoolCalendarListTemplate($Template)
=============================================================================
*/
function MergeBrowseSchoolCalendarListTemplate($Template) {
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
        $Template = "./html/BrowseSchoolCalendarlist.htm";
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
            if ( getSession("BrowseSchoolCalendar#PreviousColumn") == "CountryID"):
                if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchoolCalendar#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseSchoolCalendar#COL") == "CountryID" ):
            if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseSchoolCalendar#PreviousColumn") == "BranchID"):
                if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchoolCalendar#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseSchoolCalendar#COL") == "BranchID" ):
            if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Date";
            if ( getSession("BrowseSchoolCalendar#PreviousColumn") == "Date"):
                if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchoolCalendar#COL") == "Date"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Date</a>";
        $DateLABEL = $myLink;
        if ( getGet("COL") == "Date" || getSession("BrowseSchoolCalendar#COL") == "Date" ):
            if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                $DateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseSchoolCalendar#PreviousColumn") == "Description"):
                if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchoolCalendar#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseSchoolCalendar#COL") == "Description" ):
            if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Type";
            if ( getSession("BrowseSchoolCalendar#PreviousColumn") == "Type"):
                if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchoolCalendar#COL") == "Type"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Type</a>";
        $TypeLABEL = $myLink;
        if ( getGet("COL") == "Type" || getSession("BrowseSchoolCalendar#COL") == "Type" ):
            if (getSession("BrowseSchoolCalendar#SRT") == "ASC"):
                $TypeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TypeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@DateLABEL@", $DateLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@TypeLABEL@", $TypeLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStcalendar;
    global $RecordsPageSize;
    global $tcalendarAutomaticDetailLink;
    global $tcalendarAutomaticDetailLinkSTYLE;
    global $tcalendarBranchID;
    global $tcalendarBranchIDLABEL;
    global $tcalendarBranchIDSTYLE;
    global $tcalendarCountryID;
    global $tcalendarCountryIDLABEL;
    global $tcalendarCountryIDSTYLE;
    global $tcalendarDate;
    global $tcalendarDateLABEL;
    global $tcalendarDateSTYLE;
    global $tcalendarDescription;
    global $tcalendarDescriptionLABEL;
    global $tcalendarDescriptionSTYLE;
    global $tcalendarType;
    global $tcalendarTypeLABEL;
    global $tcalendarTypeSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStcalendar) :
        while ((!$oRStcalendar->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tcalendarAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetcalendaredit.php?ID1=";
                    $tcalendarAutomaticDetailLink = $myLink;
                      $tcalendarAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStcalendar->fields["CountryID"]))) . "'" ;
                    $tcalendarAutomaticDetailLink .=  "&ID2=" . "'";
                    $tcalendarAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcalendar->fields["BranchID"]))) . "'";
                    $tcalendarAutomaticDetailLink .=  "&ID3=";
                    $tcalendarAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcalendar->fields["Date"])));
            $tmpIMG_tcalendarAutomaticDetailLink = "";
            $tmpIMG_tcalendarAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tcalendarAutomaticDetailLink .= "\">" . $tmpIMG_tcalendarAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcalendar->fields["CountryID"])):
        $tcalendarCountryID = "";
    else:
        $tcalendarCountryID = htmlEncode(getValue($oRStcalendar->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcalendar->fields["BranchID"])):
        $tcalendarBranchID = "";
    else:
        $tcalendarBranchID = htmlEncode(getValue($oRStcalendar->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarDateSTYLE = "TableRow" . $Style;
    if (is_null($oRStcalendar->fields["Date"])):
        $tcalendarDate = "";
    else:
        $tcalendarDate = htmlEncode(getValue($oRStcalendar->fields["Date"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStcalendar->fields["Description"])):
        $tcalendarDescription = "";
    else:
        $tcalendarDescription = htmlEncode(getValue($oRStcalendar->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarTypeSTYLE = "TableRow" . $Style;
    if (is_null($oRStcalendar->fields["Type"])):
        $tcalendarType = "";
    else:
        $tcalendarType = htmlEncode(getValue($oRStcalendar->fields["Type"]));
endif;
$Seq++;
$oRStcalendar->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarAutomaticDetailLink@", $tcalendarAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarAutomaticDetailLinkSTYLE@", $tcalendarAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarCountryID@", $tcalendarCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarCountryIDSTYLE@",$tcalendarCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarBranchID@", $tcalendarBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarBranchIDSTYLE@",$tcalendarBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDate@", $tcalendarDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDateSTYLE@",$tcalendarDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDescription@", $tcalendarDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDescriptionSTYLE@",$tcalendarDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarType@", $tcalendarType);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarTypeSTYLE@",$tcalendarTypeSTYLE);           
        endwhile; // of oRStcalendar DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcalendarAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarAutomaticDetailLinkSTYLE@", $tcalendarAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarCountryID@", "&nbsp;");
$tcalendarCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarCountryIDSTYLE@", $tcalendarCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarBranchID@", "&nbsp;");
$tcalendarBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarBranchIDSTYLE@", $tcalendarBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDate@", "&nbsp;");
$tcalendarDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDateSTYLE@", $tcalendarDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDescription@", "&nbsp;");
$tcalendarDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarDescriptionSTYLE@", $tcalendarDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarType@", "&nbsp;");
$tcalendarTypeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcalendarTypeSTYLE@", $tcalendarTypeSTYLE);
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
global $oRStcalendar;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetcalendarsearch.php";
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
        $ref .= "<a href=Updatetcalendar" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetcalendar" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
