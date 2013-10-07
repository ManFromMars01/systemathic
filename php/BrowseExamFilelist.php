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
$BrowseExamFileRowData = "";
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
$eexamfileAutomaticDetailLink = "";
$eexamfileAutomaticDetailLinkSTYLE = "";
$eexamfileCountryIDLABEL = "";
$eexamfileCountryID = "";
$eexamfileCountryIDSTYLE = "";
$eexamfileBranchIDLABEL = "";
$eexamfileBranchID = "";
$eexamfileBranchIDSTYLE = "";
$eexamfileDateLABEL = "";
$eexamfileDate = "";
$eexamfileDateSTYLE = "";
$eexamfileTimeFromLABEL = "";
$eexamfileTimeFrom = "";
$eexamfileTimeFromSTYLE = "";
$eexamfileTimeToLABEL = "";
$eexamfileTimeTo = "";
$eexamfileTimeToSTYLE = "";
$eexamfileOpenDateLABEL = "";
$eexamfileOpenDate = "";
$eexamfileOpenDateSTYLE = "";
$eexamfileCloseDateLABEL = "";
$eexamfileCloseDate = "";
$eexamfileCloseDateSTYLE = "";
$eexamfileSubmitDateLABEL = "";
$eexamfileSubmitDate = "";
$eexamfileSubmitDateSTYLE = "";
$eexamfileMenFeeLABEL = "";
$eexamfileMenFee = "";
$eexamfileMenFeeSTYLE = "";
$oRSeexamfile = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseExamFile#WHR"] = "";
    $_SESSION["BrowseExamFile#COL"] = "";
    $_SESSION["BrowseExamFile#SRT"] = "";
    $_SESSION["BrowseExamFile#PreviousColumn"] = "";
    $_SESSION["BrowseExamFile#PreviousSort"] = "";
    $_SESSION["BrowseExamFile#mySort"] = "";
    $_SESSION["BrowseExamFile#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseExamFile#WHR"] = "";
        $_SESSION["BrowseExamFile#COL"] = "";
        $_SESSION["BrowseExamFile#SRT"] = "";
        $_SESSION["BrowseExamFile#PreviousColumn"] = "";
        $_SESSION["BrowseExamFile#PreviousSort"] = "";
        $_SESSION["BrowseExamFile#mySort"] = "";
        $_SESSION["BrowseExamFile#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseExamFile#COL"] = "";
            $_SESSION["BrowseExamFile#SRT"] = "";
            $_SESSION["BrowseExamFile#PreviousColumn"] = "";
            $_SESSION["BrowseExamFile#PreviousSort"] = "";
            $_SESSION["BrowseExamFile#mySort"] = "";
            $_SESSION["BrowseExamFile#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseExamFile#PreviousColumn"] = "";
else:
    $_SESSION["BrowseExamFile#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseExamFile#PreviousSort"] = "";
else:
    $_SESSION["BrowseExamFile#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseExamFile#COL") == ""):
    if (getRequest("COL") . getSession("BrowseExamFile#COL") == ""):
        $_SESSION["BrowseExamFile#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CountryID DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CountryID ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CountryID ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "CountryID";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.BranchID DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.BranchID ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.BranchID ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "BranchID";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "Date"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.Date DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.Date ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.Date ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "Date";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "TimeFrom"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeFrom DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeFrom ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeFrom ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "TimeFrom";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "TimeTo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeTo DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeTo ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.TimeTo ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "TimeTo";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "OpenDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.OpenDate DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.OpenDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.OpenDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "OpenDate";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "CloseDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CloseDate DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CloseDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CloseDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "CloseDate";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "SubmitDate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.SubmitDate DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.SubmitDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.SubmitDate ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "SubmitDate";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

if (getRequest("COL") == "MenFee"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.MenFee DESC";
        $_SESSION["BrowseExamFile#mySort"] = "DESC";
    else:
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.MenFee ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseExamFile#PreviousColumn")):
        $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.MenFee ASC";
        $_SESSION["BrowseExamFile#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseExamFile#COL"] = "MenFee";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

$myQuery    = "SELECT eexamfile.CountryID, eexamfile.BranchID, eexamfile.Date, eexamfile.TimeFrom, eexamfile.TimeTo, eexamfile.OpenDate, eexamfile.CloseDate, eexamfile.SubmitDate, eexamfile.MenFee FROM eexamfile";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseExamFile#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseExamFile#WHR") != ""):
    $myWhere    = getSession("BrowseExamFile#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseExamFile#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseExamFile#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseExamFile#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseExamFile#myOrder") == ""):
    $_SESSION["BrowseExamFile#myOrder"] = "ORDER BY eexamfile.CountryID ASC";
    $_SESSION["BrowseExamFile#mySort"] = "ASC";
    $_SESSION["BrowseExamFile#COL"] = "CountryID";
    $_SESSION["BrowseExamFile#SRT"] = getSession("BrowseExamFile#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseExamFile#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseExamFile#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(eexamfile.CountryID) AS MyCount  FROM eexamfile WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(eexamfile.CountryID) AS MyCount  FROM eexamfile";
endif;
$oRSeexamfile = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSeexamfile->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSeexamfile->Close();
$oRSeexamfile = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseExamFile#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSeexamfile):
    if($oRSeexamfile->EOF != TRUE):
        if($oRSeexamfile->RecordCount() > 0):
            $oRSeexamfile->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseExamFile" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseExamFileListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSeexamfile->Close();
unset($oRSeexamfile);

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
    $tmpMsg = "<a href='BrowseExamFile" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updateeexamfile" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseExamFileListTemplate($Template)
=============================================================================
*/
function MergeBrowseExamFileListTemplate($Template) {
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
        $Template = "./html/BrowseExamFilelist.htm";
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
            if ( getSession("BrowseExamFile#PreviousColumn") == "CountryID"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseExamFile#COL") == "CountryID" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseExamFile#PreviousColumn") == "BranchID"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseExamFile#COL") == "BranchID" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Date";
            if ( getSession("BrowseExamFile#PreviousColumn") == "Date"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "Date"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Date</a>";
        $DateLABEL = $myLink;
        if ( getGet("COL") == "Date" || getSession("BrowseExamFile#COL") == "Date" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $DateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TimeFrom";
            if ( getSession("BrowseExamFile#PreviousColumn") == "TimeFrom"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "TimeFrom"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Time From</a>";
        $TimeFromLABEL = $myLink;
        if ( getGet("COL") == "TimeFrom" || getSession("BrowseExamFile#COL") == "TimeFrom" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $TimeFromLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TimeFromLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TimeTo";
            if ( getSession("BrowseExamFile#PreviousColumn") == "TimeTo"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "TimeTo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Time To</a>";
        $TimeToLABEL = $myLink;
        if ( getGet("COL") == "TimeTo" || getSession("BrowseExamFile#COL") == "TimeTo" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $TimeToLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TimeToLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=OpenDate";
            if ( getSession("BrowseExamFile#PreviousColumn") == "OpenDate"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "OpenDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Open Date</a>";
        $OpenDateLABEL = $myLink;
        if ( getGet("COL") == "OpenDate" || getSession("BrowseExamFile#COL") == "OpenDate" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $OpenDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $OpenDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CloseDate";
            if ( getSession("BrowseExamFile#PreviousColumn") == "CloseDate"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "CloseDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Close Date</a>";
        $CloseDateLABEL = $myLink;
        if ( getGet("COL") == "CloseDate" || getSession("BrowseExamFile#COL") == "CloseDate" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $CloseDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CloseDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SubmitDate";
            if ( getSession("BrowseExamFile#PreviousColumn") == "SubmitDate"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "SubmitDate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Submit Date</a>";
        $SubmitDateLABEL = $myLink;
        if ( getGet("COL") == "SubmitDate" || getSession("BrowseExamFile#COL") == "SubmitDate" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $SubmitDateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SubmitDateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MenFee";
            if ( getSession("BrowseExamFile#PreviousColumn") == "MenFee"):
                if (getSession("BrowseExamFile#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseExamFile#COL") == "MenFee"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Men Fee</a>";
        $MenFeeLABEL = $myLink;
        if ( getGet("COL") == "MenFee" || getSession("BrowseExamFile#COL") == "MenFee" ):
            if (getSession("BrowseExamFile#SRT") == "ASC"):
                $MenFeeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MenFeeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@DateLABEL@", $DateLABEL);
$HeaderText = Replace($HeaderText,"@TimeFromLABEL@", $TimeFromLABEL);
$HeaderText = Replace($HeaderText,"@TimeToLABEL@", $TimeToLABEL);
$HeaderText = Replace($HeaderText,"@OpenDateLABEL@", $OpenDateLABEL);
$HeaderText = Replace($HeaderText,"@CloseDateLABEL@", $CloseDateLABEL);
$HeaderText = Replace($HeaderText,"@SubmitDateLABEL@", $SubmitDateLABEL);
$HeaderText = Replace($HeaderText,"@MenFeeLABEL@", $MenFeeLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSeexamfile;
    global $RecordsPageSize;
    global $eexamfileAutomaticDetailLink;
    global $eexamfileAutomaticDetailLinkSTYLE;
    global $eexamfileBranchID;
    global $eexamfileBranchIDLABEL;
    global $eexamfileBranchIDSTYLE;
    global $eexamfileCloseDate;
    global $eexamfileCloseDateLABEL;
    global $eexamfileCloseDateSTYLE;
    global $eexamfileCountryID;
    global $eexamfileCountryIDLABEL;
    global $eexamfileCountryIDSTYLE;
    global $eexamfileDate;
    global $eexamfileDateLABEL;
    global $eexamfileDateSTYLE;
    global $eexamfileMenFee;
    global $eexamfileMenFeeLABEL;
    global $eexamfileMenFeeSTYLE;
    global $eexamfileOpenDate;
    global $eexamfileOpenDateLABEL;
    global $eexamfileOpenDateSTYLE;
    global $eexamfileSubmitDate;
    global $eexamfileSubmitDateLABEL;
    global $eexamfileSubmitDateSTYLE;
    global $eexamfileTimeFrom;
    global $eexamfileTimeFromLABEL;
    global $eexamfileTimeFromSTYLE;
    global $eexamfileTimeTo;
    global $eexamfileTimeToLABEL;
    global $eexamfileTimeToSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRSeexamfile) :
        while ((!$oRSeexamfile->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $eexamfileAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updateeexamfileedit.php?ID1=";
                    $eexamfileAutomaticDetailLink = $myLink;
                      $eexamfileAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSeexamfile->fields["CountryID"]))) . "'" ;
                    $eexamfileAutomaticDetailLink .=  "&ID2=" . "'";
                    $eexamfileAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeexamfile->fields["BranchID"]))) . "'";
                    $eexamfileAutomaticDetailLink .=  "&ID3=";
                    $eexamfileAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeexamfile->fields["Date"])));
            $tmpIMG_eexamfileAutomaticDetailLink = "";
            $tmpIMG_eexamfileAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $eexamfileAutomaticDetailLink .= "\">" . $tmpIMG_eexamfileAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["CountryID"])):
        $eexamfileCountryID = "";
    else:
        $eexamfileCountryID = htmlEncode(getValue($oRSeexamfile->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["BranchID"])):
        $eexamfileBranchID = "";
    else:
        $eexamfileBranchID = htmlEncode(getValue($oRSeexamfile->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["Date"])):
        $eexamfileDate = "";
    else:
        $eexamfileDate = htmlEncode(getValue($oRSeexamfile->fields["Date"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileTimeFromSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["TimeFrom"])):
        $eexamfileTimeFrom = "";
    else:
        $eexamfileTimeFrom = htmlEncode(getValue($oRSeexamfile->fields["TimeFrom"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileTimeToSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["TimeTo"])):
        $eexamfileTimeTo = "";
    else:
        $eexamfileTimeTo = htmlEncode(getValue($oRSeexamfile->fields["TimeTo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileOpenDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["OpenDate"])):
        $eexamfileOpenDate = "";
    else:
        $eexamfileOpenDate = htmlEncode(getValue($oRSeexamfile->fields["OpenDate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileCloseDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["CloseDate"])):
        $eexamfileCloseDate = "";
    else:
        $eexamfileCloseDate = htmlEncode(getValue($oRSeexamfile->fields["CloseDate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileSubmitDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["SubmitDate"])):
        $eexamfileSubmitDate = "";
    else:
        $eexamfileSubmitDate = htmlEncode(getValue($oRSeexamfile->fields["SubmitDate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileMenFeeSTYLE = "TableRow" . $Style;
    if (is_null($oRSeexamfile->fields["MenFee"])):
        $eexamfileMenFee = "";
    else:
        $eexamfileMenFee = htmlEncode(getValue($oRSeexamfile->fields["MenFee"]));
endif;
$Seq++;
$oRSeexamfile->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileAutomaticDetailLink@", $eexamfileAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileAutomaticDetailLinkSTYLE@", $eexamfileAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCountryID@", $eexamfileCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCountryIDSTYLE@",$eexamfileCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileBranchID@", $eexamfileBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileBranchIDSTYLE@",$eexamfileBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileDate@", $eexamfileDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileDateSTYLE@",$eexamfileDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeFrom@", $eexamfileTimeFrom);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeFromSTYLE@",$eexamfileTimeFromSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeTo@", $eexamfileTimeTo);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeToSTYLE@",$eexamfileTimeToSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileOpenDate@", $eexamfileOpenDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileOpenDateSTYLE@",$eexamfileOpenDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCloseDate@", $eexamfileCloseDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCloseDateSTYLE@",$eexamfileCloseDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileSubmitDate@", $eexamfileSubmitDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileSubmitDateSTYLE@",$eexamfileSubmitDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileMenFee@", $eexamfileMenFee);       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileMenFeeSTYLE@",$eexamfileMenFeeSTYLE);           
        endwhile; // of oRSeexamfile DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eexamfileAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileAutomaticDetailLinkSTYLE@", $eexamfileAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCountryID@", "&nbsp;");
$eexamfileCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCountryIDSTYLE@", $eexamfileCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileBranchID@", "&nbsp;");
$eexamfileBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileBranchIDSTYLE@", $eexamfileBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileDate@", "&nbsp;");
$eexamfileDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileDateSTYLE@", $eexamfileDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeFrom@", "&nbsp;");
$eexamfileTimeFromSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeFromSTYLE@", $eexamfileTimeFromSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeTo@", "&nbsp;");
$eexamfileTimeToSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileTimeToSTYLE@", $eexamfileTimeToSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileOpenDate@", "&nbsp;");
$eexamfileOpenDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileOpenDateSTYLE@", $eexamfileOpenDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCloseDate@", "&nbsp;");
$eexamfileCloseDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileCloseDateSTYLE@", $eexamfileCloseDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileSubmitDate@", "&nbsp;");
$eexamfileSubmitDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileSubmitDateSTYLE@", $eexamfileSubmitDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileMenFee@", "&nbsp;");
$eexamfileMenFeeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eexamfileMenFeeSTYLE@", $eexamfileMenFeeSTYLE);
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
global $oRSeexamfile;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updateeexamfilesearch.php";
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
        $ref .= "<a href=Updateeexamfile" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updateeexamfile" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
