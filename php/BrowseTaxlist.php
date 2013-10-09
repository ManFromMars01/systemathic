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
$BrowseTaxRowData = "";
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
$ttaxtabAutomaticDetailLink = "";
$ttaxtabAutomaticDetailLinkSTYLE = "";
$ttaxtabCountryIDLABEL = "";
$ttaxtabCountryID = "";
$ttaxtabCountryIDSTYLE = "";
$ttaxtabBranchIDLABEL = "";
$ttaxtabBranchID = "";
$ttaxtabBranchIDSTYLE = "";
$ttaxtabTaxIDLABEL = "";
$ttaxtabTaxID = "";
$ttaxtabTaxIDSTYLE = "";
$ttaxtabDescriptionLABEL = "";
$ttaxtabDescription = "";
$ttaxtabDescriptionSTYLE = "";
$ttaxtabRateLABEL = "";
$ttaxtabRate = "";
$ttaxtabRateSTYLE = "";
$ttaxtabDeptLABEL = "";
$ttaxtabDept = "";
$ttaxtabDeptSTYLE = "";
$ttaxtabAccountLABEL = "";
$ttaxtabAccount = "";
$ttaxtabAccountSTYLE = "";
$ttaxtabCurrTaxAmtLABEL = "";
$ttaxtabCurrTaxAmt = "";
$ttaxtabCurrTaxAmtSTYLE = "";
$ttaxtabMTDTaxAmtLABEL = "";
$ttaxtabMTDTaxAmt = "";
$ttaxtabMTDTaxAmtSTYLE = "";
$oRSttaxtab = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTax#WHR"] = "";
    $_SESSION["BrowseTax#COL"] = "";
    $_SESSION["BrowseTax#SRT"] = "";
    $_SESSION["BrowseTax#PreviousColumn"] = "";
    $_SESSION["BrowseTax#PreviousSort"] = "";
    $_SESSION["BrowseTax#mySort"] = "";
    $_SESSION["BrowseTax#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTax#WHR"] = "";
        $_SESSION["BrowseTax#COL"] = "";
        $_SESSION["BrowseTax#SRT"] = "";
        $_SESSION["BrowseTax#PreviousColumn"] = "";
        $_SESSION["BrowseTax#PreviousSort"] = "";
        $_SESSION["BrowseTax#mySort"] = "";
        $_SESSION["BrowseTax#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTax#COL"] = "";
            $_SESSION["BrowseTax#SRT"] = "";
            $_SESSION["BrowseTax#PreviousColumn"] = "";
            $_SESSION["BrowseTax#PreviousSort"] = "";
            $_SESSION["BrowseTax#mySort"] = "";
            $_SESSION["BrowseTax#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTax#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTax#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTax#PreviousSort"] = "";
else:
    $_SESSION["BrowseTax#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTax#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTax#COL") == ""):
        $_SESSION["BrowseTax#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CountryID DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CountryID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CountryID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "CountryID";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.BranchID DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.BranchID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.BranchID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "BranchID";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "TaxID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.TaxID DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.TaxID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.TaxID ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "TaxID";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Description DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Description ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Description ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "Description";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "Rate"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Rate DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Rate ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Rate ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "Rate";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "Dept"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Dept DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Dept ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Dept ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "Dept";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "Account"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Account DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Account ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.Account ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "Account";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "CurrTaxAmt"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CurrTaxAmt DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CurrTaxAmt ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CurrTaxAmt ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "CurrTaxAmt";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

if (getRequest("COL") == "MTDTaxAmt"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.MTDTaxAmt DESC";
        $_SESSION["BrowseTax#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.MTDTaxAmt ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTax#PreviousColumn")):
        $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.MTDTaxAmt ASC";
        $_SESSION["BrowseTax#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTax#COL"] = "MTDTaxAmt";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

$myQuery    = "SELECT ttaxtab.CountryID, ttaxtab.BranchID, ttaxtab.TaxID, ttaxtab.Description, ttaxtab.Rate, ttaxtab.Dept, ttaxtab.Account, ttaxtab.CurrTaxAmt, ttaxtab.MTDTaxAmt FROM ttaxtab";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTax#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTax#WHR") != ""):
    $myWhere    = getSession("BrowseTax#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTax#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTax#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTax#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTax#myOrder") == ""):
    $_SESSION["BrowseTax#myOrder"] = "ORDER BY ttaxtab.CountryID ASC";
    $_SESSION["BrowseTax#mySort"] = "ASC";
    $_SESSION["BrowseTax#COL"] = "CountryID";
    $_SESSION["BrowseTax#SRT"] = getSession("BrowseTax#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTax#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTax#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(ttaxtab.CountryID) AS MyCount  FROM ttaxtab WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(ttaxtab.CountryID) AS MyCount  FROM ttaxtab";
endif;
$oRSttaxtab = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSttaxtab->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSttaxtab->Close();
$oRSttaxtab = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTax#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSttaxtab):
    if($oRSttaxtab->EOF != TRUE):
        if($oRSttaxtab->RecordCount() > 0):
            $oRSttaxtab->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTax" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTaxListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSttaxtab->Close();
unset($oRSttaxtab);

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
    $tmpMsg = "<a href='BrowseTax" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatettaxtab" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTaxListTemplate($Template)
=============================================================================
*/
function MergeBrowseTaxListTemplate($Template) {
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
        $Template = "./html/BrowseTaxlist.htm";
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
            if ( getSession("BrowseTax#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTax#COL") == "CountryID" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTax#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTax#COL") == "BranchID" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TaxID";
            if ( getSession("BrowseTax#PreviousColumn") == "TaxID"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "TaxID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Tax ID</a>";
        $TaxIDLABEL = $myLink;
        if ( getGet("COL") == "TaxID" || getSession("BrowseTax#COL") == "TaxID" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $TaxIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TaxIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTax#PreviousColumn") == "Description"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTax#COL") == "Description" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Rate";
            if ( getSession("BrowseTax#PreviousColumn") == "Rate"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "Rate"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Rate</a>";
        $RateLABEL = $myLink;
        if ( getGet("COL") == "Rate" || getSession("BrowseTax#COL") == "Rate" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $RateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Dept";
            if ( getSession("BrowseTax#PreviousColumn") == "Dept"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "Dept"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Dept</a>";
        $DeptLABEL = $myLink;
        if ( getGet("COL") == "Dept" || getSession("BrowseTax#COL") == "Dept" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $DeptLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DeptLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Account";
            if ( getSession("BrowseTax#PreviousColumn") == "Account"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "Account"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Account</a>";
        $AccountLABEL = $myLink;
        if ( getGet("COL") == "Account" || getSession("BrowseTax#COL") == "Account" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $AccountLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $AccountLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CurrTaxAmt";
            if ( getSession("BrowseTax#PreviousColumn") == "CurrTaxAmt"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "CurrTaxAmt"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Curr Tax Amt</a>";
        $CurrTaxAmtLABEL = $myLink;
        if ( getGet("COL") == "CurrTaxAmt" || getSession("BrowseTax#COL") == "CurrTaxAmt" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $CurrTaxAmtLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CurrTaxAmtLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MTDTaxAmt";
            if ( getSession("BrowseTax#PreviousColumn") == "MTDTaxAmt"):
                if (getSession("BrowseTax#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTax#COL") == "MTDTaxAmt"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">MTDT ax Amt</a>";
        $MTDTaxAmtLABEL = $myLink;
        if ( getGet("COL") == "MTDTaxAmt" || getSession("BrowseTax#COL") == "MTDTaxAmt" ):
            if (getSession("BrowseTax#SRT") == "ASC"):
                $MTDTaxAmtLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MTDTaxAmtLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@TaxIDLABEL@", $TaxIDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@RateLABEL@", $RateLABEL);
$HeaderText = Replace($HeaderText,"@DeptLABEL@", $DeptLABEL);
$HeaderText = Replace($HeaderText,"@AccountLABEL@", $AccountLABEL);
$HeaderText = Replace($HeaderText,"@CurrTaxAmtLABEL@", $CurrTaxAmtLABEL);
$HeaderText = Replace($HeaderText,"@MTDTaxAmtLABEL@", $MTDTaxAmtLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSttaxtab;
    global $RecordsPageSize;
    global $ttaxtabAccount;
    global $ttaxtabAccountLABEL;
    global $ttaxtabAccountSTYLE;
    global $ttaxtabAutomaticDetailLink;
    global $ttaxtabAutomaticDetailLinkSTYLE;
    global $ttaxtabBranchID;
    global $ttaxtabBranchIDLABEL;
    global $ttaxtabBranchIDSTYLE;
    global $ttaxtabCountryID;
    global $ttaxtabCountryIDLABEL;
    global $ttaxtabCountryIDSTYLE;
    global $ttaxtabCurrTaxAmt;
    global $ttaxtabCurrTaxAmtLABEL;
    global $ttaxtabCurrTaxAmtSTYLE;
    global $ttaxtabDept;
    global $ttaxtabDeptLABEL;
    global $ttaxtabDeptSTYLE;
    global $ttaxtabDescription;
    global $ttaxtabDescriptionLABEL;
    global $ttaxtabDescriptionSTYLE;
    global $ttaxtabMTDTaxAmt;
    global $ttaxtabMTDTaxAmtLABEL;
    global $ttaxtabMTDTaxAmtSTYLE;
    global $ttaxtabRate;
    global $ttaxtabRateLABEL;
    global $ttaxtabRateSTYLE;
    global $ttaxtabTaxID;
    global $ttaxtabTaxIDLABEL;
    global $ttaxtabTaxIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRSttaxtab) :
        while ((!$oRSttaxtab->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $ttaxtabAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatettaxtabedit.php?ID1=";
                    $ttaxtabAutomaticDetailLink = $myLink;
                      $ttaxtabAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSttaxtab->fields["CountryID"]))) . "'" ;
                    $ttaxtabAutomaticDetailLink .=  "&ID2=" . "'";
                    $ttaxtabAutomaticDetailLink .= htmlEncode(trim(getValue($oRSttaxtab->fields["BranchID"]))) . "'";
                    $ttaxtabAutomaticDetailLink .=  "&ID3=" . "'";
                    $ttaxtabAutomaticDetailLink .= htmlEncode(trim(getValue($oRSttaxtab->fields["TaxID"]))) . "'";
            $tmpIMG_ttaxtabAutomaticDetailLink = "";
            $tmpIMG_ttaxtabAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $ttaxtabAutomaticDetailLink .= "\">" . $tmpIMG_ttaxtabAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["CountryID"])):
        $ttaxtabCountryID = "";
    else:
        $ttaxtabCountryID = htmlEncode(getValue($oRSttaxtab->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["BranchID"])):
        $ttaxtabBranchID = "";
    else:
        $ttaxtabBranchID = htmlEncode(getValue($oRSttaxtab->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabTaxIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["TaxID"])):
        $ttaxtabTaxID = "";
    else:
        $ttaxtabTaxID = htmlEncode(getValue($oRSttaxtab->fields["TaxID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["Description"])):
        $ttaxtabDescription = "";
    else:
        $ttaxtabDescription = htmlEncode(getValue($oRSttaxtab->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabRateSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["Rate"])):
        $ttaxtabRate = "";
    else:
        $ttaxtabRate = htmlEncode(getValue($oRSttaxtab->fields["Rate"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabDeptSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["Dept"])):
        $ttaxtabDept = "";
    else:
        $ttaxtabDept = htmlEncode(getValue($oRSttaxtab->fields["Dept"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabAccountSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["Account"])):
        $ttaxtabAccount = "";
    else:
        $ttaxtabAccount = htmlEncode(getValue($oRSttaxtab->fields["Account"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabCurrTaxAmtSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["CurrTaxAmt"])):
        $ttaxtabCurrTaxAmt = "";
    else:
        $ttaxtabCurrTaxAmt = htmlEncode(getValue($oRSttaxtab->fields["CurrTaxAmt"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabMTDTaxAmtSTYLE = "TableRow" . $Style;
    if (is_null($oRSttaxtab->fields["MTDTaxAmt"])):
        $ttaxtabMTDTaxAmt = "";
    else:
        $ttaxtabMTDTaxAmt = htmlEncode(getValue($oRSttaxtab->fields["MTDTaxAmt"]));
endif;
$Seq++;
$oRSttaxtab->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAutomaticDetailLink@", $ttaxtabAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAutomaticDetailLinkSTYLE@", $ttaxtabAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCountryID@", $ttaxtabCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCountryIDSTYLE@",$ttaxtabCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabBranchID@", $ttaxtabBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabBranchIDSTYLE@",$ttaxtabBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabTaxID@", $ttaxtabTaxID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabTaxIDSTYLE@",$ttaxtabTaxIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDescription@", $ttaxtabDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDescriptionSTYLE@",$ttaxtabDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabRate@", $ttaxtabRate);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabRateSTYLE@",$ttaxtabRateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDept@", $ttaxtabDept);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDeptSTYLE@",$ttaxtabDeptSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAccount@", $ttaxtabAccount);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAccountSTYLE@",$ttaxtabAccountSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCurrTaxAmt@", $ttaxtabCurrTaxAmt);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCurrTaxAmtSTYLE@",$ttaxtabCurrTaxAmtSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabMTDTaxAmt@", $ttaxtabMTDTaxAmt);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabMTDTaxAmtSTYLE@",$ttaxtabMTDTaxAmtSTYLE);           
        endwhile; // of oRSttaxtab DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttaxtabAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAutomaticDetailLinkSTYLE@", $ttaxtabAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCountryID@", "&nbsp;");
$ttaxtabCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCountryIDSTYLE@", $ttaxtabCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabBranchID@", "&nbsp;");
$ttaxtabBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabBranchIDSTYLE@", $ttaxtabBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabTaxID@", "&nbsp;");
$ttaxtabTaxIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabTaxIDSTYLE@", $ttaxtabTaxIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDescription@", "&nbsp;");
$ttaxtabDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDescriptionSTYLE@", $ttaxtabDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabRate@", "&nbsp;");
$ttaxtabRateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabRateSTYLE@", $ttaxtabRateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDept@", "&nbsp;");
$ttaxtabDeptSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabDeptSTYLE@", $ttaxtabDeptSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAccount@", "&nbsp;");
$ttaxtabAccountSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabAccountSTYLE@", $ttaxtabAccountSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCurrTaxAmt@", "&nbsp;");
$ttaxtabCurrTaxAmtSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabCurrTaxAmtSTYLE@", $ttaxtabCurrTaxAmtSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabMTDTaxAmt@", "&nbsp;");
$ttaxtabMTDTaxAmtSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttaxtabMTDTaxAmtSTYLE@", $ttaxtabMTDTaxAmtSTYLE);
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
global $oRSttaxtab;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatettaxtabsearch.php";
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
        $ref .= "<a href=Updatettaxtab" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatettaxtab" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
