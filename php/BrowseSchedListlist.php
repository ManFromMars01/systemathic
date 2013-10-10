<?PHP
session_set_cookie_params(500);
session_start();
unset($_SESSION['BrowseSchedList#WHR']);
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
$BrowseSchedListRowData = "";
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
$tclassschedAutomaticDetailLink = "";
$tclassschedAutomaticDetailLinkSTYLE = "";
$tclassschedCountryIDLABEL = "";
$tclassschedCountryID = "";
$tclassschedCountryIDSTYLE = "";
$tclassschedBranchIDLABEL = "";
$tclassschedBranchID = "";
$tclassschedBranchIDSTYLE = "";
$tclassschedDayLABEL = "";
$tclassschedDay = "";
$tclassschedDaySTYLE = "";
$tclassschedTimeFromLABEL = "";
$tclassschedTimeFrom = "";
$tclassschedTimeFromSTYLE = "";
$tclassschedTimeToLABEL = "";
$tclassschedTimeTo = "";
$tclassschedTimeToSTYLE = "";
$tclassschedLevelIDLABEL = "";
$tclassschedLevelID = "";
$tclassschedLevelIDSTYLE = "";
$tclassschedTeacherCntLABEL = "";
$tclassschedTeacherCnt = "";
$tclassschedTeacherCntSTYLE = "";
$tclassschedTeacherID1LABEL = "";
$tclassschedTeacherID1 = "";
$tclassschedTeacherID1STYLE = "";
$tclassschedTeacherID2LABEL = "";
$tclassschedTeacherID2 = "";
$tclassschedTeacherID2STYLE = "";
$oRStclasssched = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseSchedList#WHR"] = "";
    $_SESSION["BrowseSchedList#COL"] = "";
    $_SESSION["BrowseSchedList#SRT"] = "";
    $_SESSION["BrowseSchedList#PreviousColumn"] = "";
    $_SESSION["BrowseSchedList#PreviousSort"] = "";
    $_SESSION["BrowseSchedList#mySort"] = "";
    $_SESSION["BrowseSchedList#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseSchedList#WHR"] = "";
        $_SESSION["BrowseSchedList#COL"] = "";
        $_SESSION["BrowseSchedList#SRT"] = "";
        $_SESSION["BrowseSchedList#PreviousColumn"] = "";
        $_SESSION["BrowseSchedList#PreviousSort"] = "";
        $_SESSION["BrowseSchedList#mySort"] = "";
        $_SESSION["BrowseSchedList#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseSchedList#COL"] = "";
            $_SESSION["BrowseSchedList#SRT"] = "";
            $_SESSION["BrowseSchedList#PreviousColumn"] = "";
            $_SESSION["BrowseSchedList#PreviousSort"] = "";
            $_SESSION["BrowseSchedList#mySort"] = "";
            $_SESSION["BrowseSchedList#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseSchedList#PreviousColumn"] = "";
else:
    $_SESSION["BrowseSchedList#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseSchedList#PreviousSort"] = "";
else:
    $_SESSION["BrowseSchedList#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseSchedList#COL") == ""):
    if (getRequest("COL") . getSession("BrowseSchedList#COL") == ""):
        $_SESSION["BrowseSchedList#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.CountryID DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.CountryID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.CountryID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "CountryID";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.BranchID DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.BranchID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.BranchID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "BranchID";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "Day"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.Day DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.Day ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.Day ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "Day";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "TimeFrom"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeFrom DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeFrom ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeFrom ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "TimeFrom";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "TimeTo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeTo DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeTo ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TimeTo ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "TimeTo";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "LevelID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.LevelID DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.LevelID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.LevelID ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "LevelID";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "TeacherCnt"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherCnt DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherCnt ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherCnt ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "TeacherCnt";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "TeacherID1"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID1 DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID1 ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID1 ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "TeacherID1";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

if (getRequest("COL") == "TeacherID2"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID2 DESC";
        $_SESSION["BrowseSchedList#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID2 ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSchedList#PreviousColumn")):
        $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.TeacherID2 ASC";
        $_SESSION["BrowseSchedList#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSchedList#COL"] = "TeacherID2";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

$myQuery    = "SELECT tclasssched.CountryID, tclasssched.BranchID, tclasssched.Day, tclasssched.TimeFrom, tclasssched.TimeTo, tclasssched.LevelID, tclasssched.TeacherCnt, tclasssched.TeacherID1, tclasssched.TeacherID2 FROM tclasssched";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseSchedList#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseSchedList#WHR") != ""):
    $myWhere    = getSession("BrowseSchedList#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tclasssched.CountryID = " . trim(getRequest( "ID1") ). "  AND tclasssched.BranchID = " . trim(getRequest( "ID2") ). "  AND  tclasssched.LevelID = " . trim(getRequest( "ID3") ). "";
else:
    $myWhere .= " AND tclasssched.CountryID = " . trim(getRequest( "ID1") ). "  AND tclasssched.BranchID = " . trim(getRequest( "ID2") ). "  AND  tclasssched.LevelID = " . trim(getRequest( "ID3") ). "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tclasssched.CountryID = " . trim(getRequest( "ID1") ). "  AND tclasssched.BranchID = " . trim(getRequest( "ID2") ). "  AND  tclasssched.LevelID = " . trim(getRequest( "ID3") ). "";
    $_SESSION["BrowseSchedList#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseSchedList#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseSchedList#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tclasssched", "tclasssched.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tclasssched.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseSchedList#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseSchedList#myOrder") == ""):
    $_SESSION["BrowseSchedList#myOrder"] = "ORDER BY tclasssched.CountryID ASC";
    $_SESSION["BrowseSchedList#mySort"] = "ASC";
    $_SESSION["BrowseSchedList#COL"] = "CountryID";
    $_SESSION["BrowseSchedList#SRT"] = getSession("BrowseSchedList#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseSchedList#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseSchedList#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tclasssched.CountryID) AS MyCount  FROM tclasssched WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tclasssched.CountryID) AS MyCount  FROM tclasssched";
endif;
$oRStclasssched = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStclasssched->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStclasssched->Close();
$oRStclasssched = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSchedList#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStclasssched):
    if($oRStclasssched->EOF != TRUE):
        if($oRStclasssched->RecordCount() > 0):
            $oRStclasssched->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseSchedList" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseSchedListListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStclasssched->Close();
unset($oRStclasssched);

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
    $tmpMsg = "<a href='BrowseSchedList" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetclasssched" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseSchedListListTemplate($Template)
=============================================================================
*/
function MergeBrowseSchedListListTemplate($Template) {
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
        $Template = "./html/BrowseSchedListlist.htm";
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
            if ( getSession("BrowseSchedList#PreviousColumn") == "CountryID"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseSchedList#COL") == "CountryID" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseSchedList#PreviousColumn") == "BranchID"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseSchedList#COL") == "BranchID" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Day";
            if ( getSession("BrowseSchedList#PreviousColumn") == "Day"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "Day"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Day</a>";
        $DayLABEL = $myLink;
        if ( getGet("COL") == "Day" || getSession("BrowseSchedList#COL") == "Day" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $DayLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DayLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TimeFrom";
            if ( getSession("BrowseSchedList#PreviousColumn") == "TimeFrom"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "TimeFrom"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Time From</a>";
        $TimeFromLABEL = $myLink;
        if ( getGet("COL") == "TimeFrom" || getSession("BrowseSchedList#COL") == "TimeFrom" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $TimeFromLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TimeFromLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TimeTo";
            if ( getSession("BrowseSchedList#PreviousColumn") == "TimeTo"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "TimeTo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Time To</a>";
        $TimeToLABEL = $myLink;
        if ( getGet("COL") == "TimeTo" || getSession("BrowseSchedList#COL") == "TimeTo" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $TimeToLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TimeToLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LevelID";
            if ( getSession("BrowseSchedList#PreviousColumn") == "LevelID"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "LevelID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level ID</a>";
        $LevelIDLABEL = $myLink;
        if ( getGet("COL") == "LevelID" || getSession("BrowseSchedList#COL") == "LevelID" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $LevelIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LevelIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TeacherCnt";
            if ( getSession("BrowseSchedList#PreviousColumn") == "TeacherCnt"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "TeacherCnt"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Teacher Cnt</a>";
        $TeacherCntLABEL = $myLink;
        if ( getGet("COL") == "TeacherCnt" || getSession("BrowseSchedList#COL") == "TeacherCnt" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $TeacherCntLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TeacherCntLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TeacherID1";
            if ( getSession("BrowseSchedList#PreviousColumn") == "TeacherID1"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "TeacherID1"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Teacher ID 1</a>";
        $TeacherID1LABEL = $myLink;
        if ( getGet("COL") == "TeacherID1" || getSession("BrowseSchedList#COL") == "TeacherID1" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $TeacherID1LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TeacherID1LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TeacherID2";
            if ( getSession("BrowseSchedList#PreviousColumn") == "TeacherID2"):
                if (getSession("BrowseSchedList#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSchedList#COL") == "TeacherID2"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Teacher ID 2</a>";
        $TeacherID2LABEL = $myLink;
        if ( getGet("COL") == "TeacherID2" || getSession("BrowseSchedList#COL") == "TeacherID2" ):
            if (getSession("BrowseSchedList#SRT") == "ASC"):
                $TeacherID2LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TeacherID2LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@DayLABEL@", $DayLABEL);
$HeaderText = Replace($HeaderText,"@TimeFromLABEL@", $TimeFromLABEL);
$HeaderText = Replace($HeaderText,"@TimeToLABEL@", $TimeToLABEL);
$HeaderText = Replace($HeaderText,"@LevelIDLABEL@", $LevelIDLABEL);
$HeaderText = Replace($HeaderText,"@TeacherCntLABEL@", $TeacherCntLABEL);
$HeaderText = Replace($HeaderText,"@TeacherID1LABEL@", $TeacherID1LABEL);
$HeaderText = Replace($HeaderText,"@TeacherID2LABEL@", $TeacherID2LABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStclasssched;
    global $RecordsPageSize;
    global $tclassschedAutomaticDetailLink;
    global $tclassschedAutomaticDetailLinkSTYLE;
    global $tclassschedBranchID;
    global $tclassschedBranchIDLABEL;
    global $tclassschedBranchIDSTYLE;
    global $tclassschedCountryID;
    global $tclassschedCountryIDLABEL;
    global $tclassschedCountryIDSTYLE;
    global $tclassschedDay;
    global $tclassschedDayLABEL;
    global $tclassschedDaySTYLE;
    global $tclassschedLevelID;
    global $tclassschedLevelIDLABEL;
    global $tclassschedLevelIDSTYLE;
    global $tclassschedTeacherCnt;
    global $tclassschedTeacherCntLABEL;
    global $tclassschedTeacherCntSTYLE;
    global $tclassschedTeacherID1;
    global $tclassschedTeacherID1LABEL;
    global $tclassschedTeacherID1STYLE;
    global $tclassschedTeacherID2;
    global $tclassschedTeacherID2LABEL;
    global $tclassschedTeacherID2STYLE;
    global $tclassschedTimeFrom;
    global $tclassschedTimeFromLABEL;
    global $tclassschedTimeFromSTYLE;
    global $tclassschedTimeTo;
    global $tclassschedTimeToLABEL;
    global $tclassschedTimeToSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStclasssched) :
        while ((!$oRStclasssched->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tclassschedAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetclassschededit.php?ID1=";
                    $tclassschedAutomaticDetailLink = $myLink;
                      $tclassschedAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStclasssched->fields["CountryID"]))) . "'" ;
                    $tclassschedAutomaticDetailLink .=  "&ID2=" . "'";
                    $tclassschedAutomaticDetailLink .= htmlEncode(trim(getValue($oRStclasssched->fields["BranchID"]))) . "'";
                    $tclassschedAutomaticDetailLink .=  "&ID3=" . "'";
                    $tclassschedAutomaticDetailLink .= htmlEncode(trim(getValue($oRStclasssched->fields["Day"]))) . "'";
                    $tclassschedAutomaticDetailLink .=  "&ID4=";
                    $tclassschedAutomaticDetailLink .= htmlEncode(trim(getValue($oRStclasssched->fields["TimeFrom"])));
            $tmpIMG_tclassschedAutomaticDetailLink = "";
            $tmpIMG_tclassschedAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tclassschedAutomaticDetailLink .= "\">" . $tmpIMG_tclassschedAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["CountryID"])):
        $tclassschedCountryID = "";
    else:
        $tclassschedCountryID = htmlEncode(getValue($oRStclasssched->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["BranchID"])):
        $tclassschedBranchID = "";
    else:
        $tclassschedBranchID = htmlEncode(getValue($oRStclasssched->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedDaySTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["Day"])):
        $tclassschedDay = "";
    else:
        $tclassschedDay = htmlEncode(getValue($oRStclasssched->fields["Day"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedTimeFromSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["TimeFrom"])):
        $tclassschedTimeFrom = "";
    else:
                $tclassschedTimeFrom = formatDateTime('H:i',getValue($oRStclasssched->fields["TimeFrom"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedTimeToSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["TimeTo"])):
        $tclassschedTimeTo = "";
    else:
                $tclassschedTimeTo = formatDateTime('H:i',getValue($oRStclasssched->fields["TimeTo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedLevelIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["LevelID"])):
        $tclassschedLevelID = "";
    else:
        $tclassschedLevelID = htmlEncode(getValue($oRStclasssched->fields["LevelID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedTeacherCntSTYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["TeacherCnt"])):
        $tclassschedTeacherCnt = "";
    else:
        $tclassschedTeacherCnt = htmlEncode(getValue($oRStclasssched->fields["TeacherCnt"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedTeacherID1STYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["TeacherID1"])):
        $tclassschedTeacherID1 = "";
    else:
        $tclassschedTeacherID1 = htmlEncode(getValue($oRStclasssched->fields["TeacherID1"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedTeacherID2STYLE = "TableRow" . $Style;
    if (is_null($oRStclasssched->fields["TeacherID2"])):
        $tclassschedTeacherID2 = "";
    else:
        $tclassschedTeacherID2 = htmlEncode(getValue($oRStclasssched->fields["TeacherID2"]));
endif;
$Seq++;
$oRStclasssched->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedAutomaticDetailLink@", $tclassschedAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedAutomaticDetailLinkSTYLE@", $tclassschedAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedCountryID@", $tclassschedCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedCountryIDSTYLE@",$tclassschedCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedBranchID@", $tclassschedBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedBranchIDSTYLE@",$tclassschedBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedDay@", $tclassschedDay);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedDaySTYLE@",$tclassschedDaySTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeFrom@", $tclassschedTimeFrom);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeFromSTYLE@",$tclassschedTimeFromSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeTo@", $tclassschedTimeTo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeToSTYLE@",$tclassschedTimeToSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedLevelID@", $tclassschedLevelID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedLevelIDSTYLE@",$tclassschedLevelIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherCnt@", $tclassschedTeacherCnt);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherCntSTYLE@",$tclassschedTeacherCntSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID1@", $tclassschedTeacherID1);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID1STYLE@",$tclassschedTeacherID1STYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID2@", $tclassschedTeacherID2);       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID2STYLE@",$tclassschedTeacherID2STYLE);           
        endwhile; // of oRStclasssched DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tclassschedAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedAutomaticDetailLinkSTYLE@", $tclassschedAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedCountryID@", "&nbsp;");
$tclassschedCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedCountryIDSTYLE@", $tclassschedCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedBranchID@", "&nbsp;");
$tclassschedBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedBranchIDSTYLE@", $tclassschedBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedDay@", "&nbsp;");
$tclassschedDaySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedDaySTYLE@", $tclassschedDaySTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeFrom@", "&nbsp;");
$tclassschedTimeFromSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeFromSTYLE@", $tclassschedTimeFromSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeTo@", "&nbsp;");
$tclassschedTimeToSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTimeToSTYLE@", $tclassschedTimeToSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedLevelID@", "&nbsp;");
$tclassschedLevelIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedLevelIDSTYLE@", $tclassschedLevelIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherCnt@", "&nbsp;");
$tclassschedTeacherCntSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherCntSTYLE@", $tclassschedTeacherCntSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID1@", "&nbsp;");
$tclassschedTeacherID1STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID1STYLE@", $tclassschedTeacherID1STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID2@", "&nbsp;");
$tclassschedTeacherID2STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tclassschedTeacherID2STYLE@", $tclassschedTeacherID2STYLE);
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
global $oRStclasssched;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetclassschedsearch.php";
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
        $ref .= "<a href=Updatetclasssched" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetclasssched" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
