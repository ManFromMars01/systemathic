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
$BrowseChartRowData = "";
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
$tchartAutomaticDetailLink = "";
$tchartAutomaticDetailLinkSTYLE = "";
$tchartCountryIDLABEL = "";
$tchartCountryID = "";
$tchartCountryIDSTYLE = "";
$tchartBranchIDLABEL = "";
$tchartBranchID = "";
$tchartBranchIDSTYLE = "";
$tchartAccountNoLABEL = "";
$tchartAccountNo = "";
$tchartAccountNoSTYLE = "";
$tchartDeptNoLABEL = "";
$tchartDeptNo = "";
$tchartDeptNoSTYLE = "";
$tchartDescriptionLABEL = "";
$tchartDescription = "";
$tchartDescriptionSTYLE = "";
$tchartTypeLABEL = "";
$tchartType = "";
$tchartTypeSTYLE = "";
$tchartSubTypeLABEL = "";
$tchartSubType = "";
$tchartSubTypeSTYLE = "";
$tchartStatusLABEL = "";
$tchartStatus = "";
$tchartStatusSTYLE = "";
$tchartFutBudget1LABEL = "";
$tchartFutBudget1 = "";
$tchartFutBudget1STYLE = "";
$oRStchart = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseChart#WHR"] = "";
    $_SESSION["BrowseChart#COL"] = "";
    $_SESSION["BrowseChart#SRT"] = "";
    $_SESSION["BrowseChart#PreviousColumn"] = "";
    $_SESSION["BrowseChart#PreviousSort"] = "";
    $_SESSION["BrowseChart#mySort"] = "";
    $_SESSION["BrowseChart#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseChart#WHR"] = "";
        $_SESSION["BrowseChart#COL"] = "";
        $_SESSION["BrowseChart#SRT"] = "";
        $_SESSION["BrowseChart#PreviousColumn"] = "";
        $_SESSION["BrowseChart#PreviousSort"] = "";
        $_SESSION["BrowseChart#mySort"] = "";
        $_SESSION["BrowseChart#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseChart#COL"] = "";
            $_SESSION["BrowseChart#SRT"] = "";
            $_SESSION["BrowseChart#PreviousColumn"] = "";
            $_SESSION["BrowseChart#PreviousSort"] = "";
            $_SESSION["BrowseChart#mySort"] = "";
            $_SESSION["BrowseChart#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseChart#PreviousColumn"] = "";
else:
    $_SESSION["BrowseChart#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseChart#PreviousSort"] = "";
else:
    $_SESSION["BrowseChart#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseChart#COL") == ""):
    if (getRequest("COL") . getSession("BrowseChart#COL") == ""):
        $_SESSION["BrowseChart#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.CountryID DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.CountryID ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.CountryID ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "CountryID";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.BranchID DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.BranchID ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.BranchID ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "BranchID";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "AccountNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.AccountNo DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.AccountNo ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.AccountNo ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "AccountNo";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "DeptNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.DeptNo DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.DeptNo ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.DeptNo ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "DeptNo";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Description DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Description ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Description ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "Description";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "Type"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Type DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Type ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Type ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "Type";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "SubType"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.SubType DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.SubType ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.SubType ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "SubType";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "Status"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Status DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Status ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.Status ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "Status";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

if (getRequest("COL") == "FutBudget1"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.FutBudget1 DESC";
        $_SESSION["BrowseChart#mySort"] = "DESC";
    else:
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.FutBudget1 ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseChart#PreviousColumn")):
        $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.FutBudget1 ASC";
        $_SESSION["BrowseChart#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseChart#COL"] = "FutBudget1";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

$myQuery    = "SELECT tchart.CountryID, tchart.BranchID, tchart.AccountNo, tchart.DeptNo, tchart.Description, tchart.Type, tchart.SubType, tchart.Status, tchart.FutBudget1 FROM tchart";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseChart#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseChart#WHR") != ""):
    $myWhere    = getSession("BrowseChart#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseChart#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseChart#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseChart#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tchart", "tchart.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tchart.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseChart#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseChart#myOrder") == ""):
    $_SESSION["BrowseChart#myOrder"] = "ORDER BY tchart.CountryID ASC";
    $_SESSION["BrowseChart#mySort"] = "ASC";
    $_SESSION["BrowseChart#COL"] = "CountryID";
    $_SESSION["BrowseChart#SRT"] = getSession("BrowseChart#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseChart#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseChart#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tchart.CountryID) AS MyCount  FROM tchart WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tchart.CountryID) AS MyCount  FROM tchart";
endif;
$oRStchart = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStchart->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStchart->Close();
$oRStchart = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseChart#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStchart):
    if($oRStchart->EOF != TRUE):
        if($oRStchart->RecordCount() > 0):
            $oRStchart->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseChart" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseChartListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStchart->Close();
unset($oRStchart);

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
    $tmpMsg = "<a href='BrowseChart" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetchart" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseChartListTemplate($Template)
=============================================================================
*/
function MergeBrowseChartListTemplate($Template) {
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
        $Template = "./html/BrowseChartlist.htm";
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
            if ( getSession("BrowseChart#PreviousColumn") == "CountryID"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseChart#COL") == "CountryID" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseChart#PreviousColumn") == "BranchID"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseChart#COL") == "BranchID" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=AccountNo";
            if ( getSession("BrowseChart#PreviousColumn") == "AccountNo"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "AccountNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Account No</a>";
        $AccountNoLABEL = $myLink;
        if ( getGet("COL") == "AccountNo" || getSession("BrowseChart#COL") == "AccountNo" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $AccountNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $AccountNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=DeptNo";
            if ( getSession("BrowseChart#PreviousColumn") == "DeptNo"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "DeptNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Dept No</a>";
        $DeptNoLABEL = $myLink;
        if ( getGet("COL") == "DeptNo" || getSession("BrowseChart#COL") == "DeptNo" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $DeptNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DeptNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseChart#PreviousColumn") == "Description"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseChart#COL") == "Description" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Type";
            if ( getSession("BrowseChart#PreviousColumn") == "Type"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "Type"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Type</a>";
        $TypeLABEL = $myLink;
        if ( getGet("COL") == "Type" || getSession("BrowseChart#COL") == "Type" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $TypeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TypeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SubType";
            if ( getSession("BrowseChart#PreviousColumn") == "SubType"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "SubType"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sub Type</a>";
        $SubTypeLABEL = $myLink;
        if ( getGet("COL") == "SubType" || getSession("BrowseChart#COL") == "SubType" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $SubTypeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SubTypeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Status";
            if ( getSession("BrowseChart#PreviousColumn") == "Status"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "Status"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Status</a>";
        $StatusLABEL = $myLink;
        if ( getGet("COL") == "Status" || getSession("BrowseChart#COL") == "Status" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $StatusLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $StatusLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=FutBudget1";
            if ( getSession("BrowseChart#PreviousColumn") == "FutBudget1"):
                if (getSession("BrowseChart#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseChart#COL") == "FutBudget1"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Fut Budget 1</a>";
        $FutBudget1LABEL = $myLink;
        if ( getGet("COL") == "FutBudget1" || getSession("BrowseChart#COL") == "FutBudget1" ):
            if (getSession("BrowseChart#SRT") == "ASC"):
                $FutBudget1LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $FutBudget1LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@AccountNoLABEL@", $AccountNoLABEL);
$HeaderText = Replace($HeaderText,"@DeptNoLABEL@", $DeptNoLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@TypeLABEL@", $TypeLABEL);
$HeaderText = Replace($HeaderText,"@SubTypeLABEL@", $SubTypeLABEL);
$HeaderText = Replace($HeaderText,"@StatusLABEL@", $StatusLABEL);
$HeaderText = Replace($HeaderText,"@FutBudget1LABEL@", $FutBudget1LABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStchart;
    global $RecordsPageSize;
    global $tchartAccountNo;
    global $tchartAccountNoLABEL;
    global $tchartAccountNoSTYLE;
    global $tchartAutomaticDetailLink;
    global $tchartAutomaticDetailLinkSTYLE;
    global $tchartBranchID;
    global $tchartBranchIDLABEL;
    global $tchartBranchIDSTYLE;
    global $tchartCountryID;
    global $tchartCountryIDLABEL;
    global $tchartCountryIDSTYLE;
    global $tchartDeptNo;
    global $tchartDeptNoLABEL;
    global $tchartDeptNoSTYLE;
    global $tchartDescription;
    global $tchartDescriptionLABEL;
    global $tchartDescriptionSTYLE;
    global $tchartFutBudget1;
    global $tchartFutBudget1LABEL;
    global $tchartFutBudget1STYLE;
    global $tchartStatus;
    global $tchartStatusLABEL;
    global $tchartStatusSTYLE;
    global $tchartSubType;
    global $tchartSubTypeLABEL;
    global $tchartSubTypeSTYLE;
    global $tchartType;
    global $tchartTypeLABEL;
    global $tchartTypeSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStchart) :
        while ((!$oRStchart->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tchartAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetchartedit.php?ID1=";
                    $tchartAutomaticDetailLink = $myLink;
                      $tchartAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStchart->fields["CountryID"]))) . "'" ;
                    $tchartAutomaticDetailLink .=  "&ID2=" . "'";
                    $tchartAutomaticDetailLink .= htmlEncode(trim(getValue($oRStchart->fields["BranchID"]))) . "'";
                    $tchartAutomaticDetailLink .=  "&ID3=";
                    $tchartAutomaticDetailLink .= htmlEncode(trim(getValue($oRStchart->fields["AccountNo"])));
                    $tchartAutomaticDetailLink .=  "&ID4=";
                    $tchartAutomaticDetailLink .= htmlEncode(trim(getValue($oRStchart->fields["DeptNo"])));
            $tmpIMG_tchartAutomaticDetailLink = "";
            $tmpIMG_tchartAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tchartAutomaticDetailLink .= "\">" . $tmpIMG_tchartAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["CountryID"])):
        $tchartCountryID = "";
    else:
        $tchartCountryID = htmlEncode(getValue($oRStchart->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["BranchID"])):
        $tchartBranchID = "";
    else:
        $tchartBranchID = htmlEncode(getValue($oRStchart->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartAccountNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["AccountNo"])):
        $tchartAccountNo = "";
    else:
        $tchartAccountNo = htmlEncode(getValue($oRStchart->fields["AccountNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartDeptNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["DeptNo"])):
        $tchartDeptNo = "";
    else:
        $tchartDeptNo = htmlEncode(getValue($oRStchart->fields["DeptNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["Description"])):
        $tchartDescription = "";
    else:
        $tchartDescription = htmlEncode(getValue($oRStchart->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartTypeSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["Type"])):
        $tchartType = "";
    else:
        $tchartType = htmlEncode(getValue($oRStchart->fields["Type"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartSubTypeSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["SubType"])):
        $tchartSubType = "";
    else:
        $tchartSubType = htmlEncode(getValue($oRStchart->fields["SubType"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartStatusSTYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["Status"])):
        $tchartStatus = "";
    else:
        $tchartStatus = htmlEncode(getValue($oRStchart->fields["Status"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartFutBudget1STYLE = "TableRow" . $Style;
    if (is_null($oRStchart->fields["FutBudget1"])):
        $tchartFutBudget1 = "";
    else:
        $tchartFutBudget1 = htmlEncode(getValue($oRStchart->fields["FutBudget1"]));
endif;
$Seq++;
$oRStchart->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tchartAutomaticDetailLink@", $tchartAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAutomaticDetailLinkSTYLE@", $tchartAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartCountryID@", $tchartCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartCountryIDSTYLE@",$tchartCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartBranchID@", $tchartBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartBranchIDSTYLE@",$tchartBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAccountNo@", $tchartAccountNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAccountNoSTYLE@",$tchartAccountNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDeptNo@", $tchartDeptNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDeptNoSTYLE@",$tchartDeptNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDescription@", $tchartDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDescriptionSTYLE@",$tchartDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartType@", $tchartType);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartTypeSTYLE@",$tchartTypeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartSubType@", $tchartSubType);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartSubTypeSTYLE@",$tchartSubTypeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartStatus@", $tchartStatus);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartStatusSTYLE@",$tchartStatusSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tchartFutBudget1@", $tchartFutBudget1);       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartFutBudget1STYLE@",$tchartFutBudget1STYLE);           
        endwhile; // of oRStchart DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tchartAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAutomaticDetailLinkSTYLE@", $tchartAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartCountryID@", "&nbsp;");
$tchartCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartCountryIDSTYLE@", $tchartCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartBranchID@", "&nbsp;");
$tchartBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartBranchIDSTYLE@", $tchartBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAccountNo@", "&nbsp;");
$tchartAccountNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartAccountNoSTYLE@", $tchartAccountNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDeptNo@", "&nbsp;");
$tchartDeptNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDeptNoSTYLE@", $tchartDeptNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDescription@", "&nbsp;");
$tchartDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartDescriptionSTYLE@", $tchartDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartType@", "&nbsp;");
$tchartTypeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartTypeSTYLE@", $tchartTypeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartSubType@", "&nbsp;");
$tchartSubTypeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartSubTypeSTYLE@", $tchartSubTypeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartStatus@", "&nbsp;");
$tchartStatusSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartStatusSTYLE@", $tchartStatusSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tchartFutBudget1@", "&nbsp;");
$tchartFutBudget1STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tchartFutBudget1STYLE@", $tchartFutBudget1STYLE);
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
global $oRStchart;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetchartsearch.php";
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
        $ref .= "<a href=Updatetchart" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetchart" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
