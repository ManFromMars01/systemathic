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
$BrowseCurrencyRowData = "";
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
$tcurrencyAutomaticDetailLink = "";
$tcurrencyAutomaticDetailLinkSTYLE = "";
$tcurrencyCountryIDLABEL = "";
$tcurrencyCountryID = "";
$tcurrencyCountryIDSTYLE = "";
$tcurrencyBranchIDLABEL = "";
$tcurrencyBranchID = "";
$tcurrencyBranchIDSTYLE = "";
$tcurrencyIDLABEL = "";
$tcurrencyID = "";
$tcurrencyIDSTYLE = "";
$tcurrencyDescriptionLABEL = "";
$tcurrencyDescription = "";
$tcurrencyDescriptionSTYLE = "";
$tcurrencyRateLABEL = "";
$tcurrencyRate = "";
$tcurrencyRateSTYLE = "";
$tcurrencySymbolLABEL = "";
$tcurrencySymbol = "";
$tcurrencySymbolSTYLE = "";
$oRStcurrency = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseCurrency#WHR"] = "";
    $_SESSION["BrowseCurrency#COL"] = "";
    $_SESSION["BrowseCurrency#SRT"] = "";
    $_SESSION["BrowseCurrency#PreviousColumn"] = "";
    $_SESSION["BrowseCurrency#PreviousSort"] = "";
    $_SESSION["BrowseCurrency#mySort"] = "";
    $_SESSION["BrowseCurrency#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseCurrency#WHR"] = "";
        $_SESSION["BrowseCurrency#COL"] = "";
        $_SESSION["BrowseCurrency#SRT"] = "";
        $_SESSION["BrowseCurrency#PreviousColumn"] = "";
        $_SESSION["BrowseCurrency#PreviousSort"] = "";
        $_SESSION["BrowseCurrency#mySort"] = "";
        $_SESSION["BrowseCurrency#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseCurrency#COL"] = "";
            $_SESSION["BrowseCurrency#SRT"] = "";
            $_SESSION["BrowseCurrency#PreviousColumn"] = "";
            $_SESSION["BrowseCurrency#PreviousSort"] = "";
            $_SESSION["BrowseCurrency#mySort"] = "";
            $_SESSION["BrowseCurrency#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseCurrency#PreviousColumn"] = "";
else:
    $_SESSION["BrowseCurrency#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseCurrency#PreviousSort"] = "";
else:
    $_SESSION["BrowseCurrency#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseCurrency#COL") == ""):
    if (getRequest("COL") . getSession("BrowseCurrency#COL") == ""):
        $_SESSION["BrowseCurrency#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.CountryID DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.CountryID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.CountryID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "CountryID";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.BranchID DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.BranchID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.BranchID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "BranchID";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.ID DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.ID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.ID ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "ID";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Description DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Description ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Description ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "Description";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

if (getRequest("COL") == "Rate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Rate DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Rate ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Rate ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "Rate";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

if (getRequest("COL") == "Symbol"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Symbol DESC";
        $_SESSION["BrowseCurrency#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Symbol ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCurrency#PreviousColumn")):
        $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.Symbol ASC";
        $_SESSION["BrowseCurrency#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCurrency#COL"] = "Symbol";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

$myQuery    = "SELECT tcurrency.CountryID, tcurrency.BranchID, tcurrency.ID, tcurrency.Description, tcurrency.Rate, tcurrency.Symbol FROM tcurrency";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseCurrency#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseCurrency#WHR") != ""):
    $myWhere    = getSession("BrowseCurrency#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCurrency#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseCurrency#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseCurrency#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseCurrency#myOrder") == ""):
    $_SESSION["BrowseCurrency#myOrder"] = "ORDER BY tcurrency.CountryID ASC";
    $_SESSION["BrowseCurrency#mySort"] = "ASC";
    $_SESSION["BrowseCurrency#COL"] = "CountryID";
    $_SESSION["BrowseCurrency#SRT"] = getSession("BrowseCurrency#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseCurrency#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseCurrency#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tcurrency.CountryID) AS MyCount  FROM tcurrency WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tcurrency.CountryID) AS MyCount  FROM tcurrency";
endif;
$oRStcurrency = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStcurrency->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStcurrency->Close();
$oRStcurrency = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCurrency#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStcurrency):
    if($oRStcurrency->EOF != TRUE):
        if($oRStcurrency->RecordCount() > 0):
            $oRStcurrency->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseCurrency" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseCurrencyListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStcurrency->Close();
unset($oRStcurrency);

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
    $tmpMsg = "<a href='BrowseCurrency" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetcurrency" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseCurrencyListTemplate($Template)
=============================================================================
*/
function MergeBrowseCurrencyListTemplate($Template) {
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
        $Template = "./html/BrowseCurrencylist.htm";
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
            if ( getSession("BrowseCurrency#PreviousColumn") == "CountryID"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseCurrency#COL") == "CountryID" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseCurrency#PreviousColumn") == "BranchID"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseCurrency#COL") == "BranchID" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseCurrency#PreviousColumn") == "ID"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseCurrency#COL") == "ID" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseCurrency#PreviousColumn") == "Description"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseCurrency#COL") == "Description" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Rate";
            if ( getSession("BrowseCurrency#PreviousColumn") == "Rate"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "Rate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Rate</a>";
        $RateLABEL = $myLink;
        if ( getGet("COL") == "Rate" || getSession("BrowseCurrency#COL") == "Rate" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $RateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Symbol";
            if ( getSession("BrowseCurrency#PreviousColumn") == "Symbol"):
                if (getSession("BrowseCurrency#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCurrency#COL") == "Symbol"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Symbol</a>";
        $SymbolLABEL = $myLink;
        if ( getGet("COL") == "Symbol" || getSession("BrowseCurrency#COL") == "Symbol" ):
            if (getSession("BrowseCurrency#SRT") == "ASC"):
                $SymbolLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SymbolLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@RateLABEL@", $RateLABEL);
$HeaderText = Replace($HeaderText,"@SymbolLABEL@", $SymbolLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStcurrency;
    global $RecordsPageSize;
    global $tcurrencyAutomaticDetailLink;
    global $tcurrencyAutomaticDetailLinkSTYLE;
    global $tcurrencyBranchID;
    global $tcurrencyBranchIDLABEL;
    global $tcurrencyBranchIDSTYLE;
    global $tcurrencyCountryID;
    global $tcurrencyCountryIDLABEL;
    global $tcurrencyCountryIDSTYLE;
    global $tcurrencyDescription;
    global $tcurrencyDescriptionLABEL;
    global $tcurrencyDescriptionSTYLE;
    global $tcurrencyID;
    global $tcurrencyIDLABEL;
    global $tcurrencyIDSTYLE;
    global $tcurrencyRate;
    global $tcurrencyRateLABEL;
    global $tcurrencyRateSTYLE;
    global $tcurrencySymbol;
    global $tcurrencySymbolLABEL;
    global $tcurrencySymbolSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStcurrency) :
        while ((!$oRStcurrency->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tcurrencyAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetcurrencyedit.php?ID1=";
                    $tcurrencyAutomaticDetailLink = $myLink;
                      $tcurrencyAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStcurrency->fields["CountryID"]))) . "'" ;
                    $tcurrencyAutomaticDetailLink .=  "&ID2=" . "'";
                    $tcurrencyAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcurrency->fields["BranchID"]))) . "'";
                    $tcurrencyAutomaticDetailLink .=  "&ID3=" . "'";
                    $tcurrencyAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcurrency->fields["ID"]))) . "'";
            $tmpIMG_tcurrencyAutomaticDetailLink = "";
            $tmpIMG_tcurrencyAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tcurrencyAutomaticDetailLink .= "\">" . $tmpIMG_tcurrencyAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["CountryID"])):
        $tcurrencyCountryID = "";
    else:
        $tcurrencyCountryID = htmlEncode(getValue($oRStcurrency->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["BranchID"])):
        $tcurrencyBranchID = "";
    else:
        $tcurrencyBranchID = htmlEncode(getValue($oRStcurrency->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["ID"])):
        $tcurrencyID = "";
    else:
        $tcurrencyID = htmlEncode(getValue($oRStcurrency->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["Description"])):
        $tcurrencyDescription = "";
    else:
        $tcurrencyDescription = htmlEncode(getValue($oRStcurrency->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyRateSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["Rate"])):
        $tcurrencyRate = "";
    else:
        $tcurrencyRate = htmlEncode(getValue($oRStcurrency->fields["Rate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencySymbolSTYLE = "TableRow" . $Style;
    if (is_null($oRStcurrency->fields["Symbol"])):
        $tcurrencySymbol = "";
    else:
        $tcurrencySymbol = htmlEncode(getValue($oRStcurrency->fields["Symbol"]));
endif;
$Seq++;
$oRStcurrency->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyAutomaticDetailLink@", $tcurrencyAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyAutomaticDetailLinkSTYLE@", $tcurrencyAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyCountryID@", $tcurrencyCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyCountryIDSTYLE@",$tcurrencyCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyBranchID@", $tcurrencyBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyBranchIDSTYLE@",$tcurrencyBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyID@", $tcurrencyID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyIDSTYLE@",$tcurrencyIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyDescription@", $tcurrencyDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyDescriptionSTYLE@",$tcurrencyDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyRate@", $tcurrencyRate);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyRateSTYLE@",$tcurrencyRateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencySymbol@", $tcurrencySymbol);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencySymbolSTYLE@",$tcurrencySymbolSTYLE);           
        endwhile; // of oRStcurrency DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcurrencyAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyAutomaticDetailLinkSTYLE@", $tcurrencyAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyCountryID@", "&nbsp;");
$tcurrencyCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyCountryIDSTYLE@", $tcurrencyCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyBranchID@", "&nbsp;");
$tcurrencyBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyBranchIDSTYLE@", $tcurrencyBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyID@", "&nbsp;");
$tcurrencyIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyIDSTYLE@", $tcurrencyIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyDescription@", "&nbsp;");
$tcurrencyDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyDescriptionSTYLE@", $tcurrencyDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyRate@", "&nbsp;");
$tcurrencyRateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencyRateSTYLE@", $tcurrencyRateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencySymbol@", "&nbsp;");
$tcurrencySymbolSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcurrencySymbolSTYLE@", $tcurrencySymbolSTYLE);
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
global $oRStcurrency;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetcurrencysearch.php";
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
        $ref .= "<a href=Updatetcurrency" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetcurrency" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
