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
$BrowsePayTypeRowData = "";
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
$tpaytypeAutomaticDetailLink = "";
$tpaytypeAutomaticDetailLinkSTYLE = "";
$tpaytypeCountryIDLABEL = "";
$tpaytypeCountryID = "";
$tpaytypeCountryIDSTYLE = "";
$tpaytypeBranchIDLABEL = "";
$tpaytypeBranchID = "";
$tpaytypeBranchIDSTYLE = "";
$tpaytypePayTypeLABEL = "";
$tpaytypePayType = "";
$tpaytypePayTypeSTYLE = "";
$tpaytypeDescriptionLABEL = "";
$tpaytypeDescription = "";
$tpaytypeDescriptionSTYLE = "";
$tpaytypeAmountLABEL = "";
$tpaytypeAmount = "";
$tpaytypeAmountSTYLE = "";
$tpaytypeCommAmtLABEL = "";
$tpaytypeCommAmt = "";
$tpaytypeCommAmtSTYLE = "";
$tpaytypeSalesTaxLABEL = "";
$tpaytypeSalesTax = "";
$tpaytypeSalesTaxSTYLE = "";
$tpaytypeAccountLABEL = "";
$tpaytypeAccount = "";
$tpaytypeAccountSTYLE = "";
$tpaytypeMTDQtyLABEL = "";
$tpaytypeMTDQty = "";
$tpaytypeMTDQtySTYLE = "";
$oRStpaytype = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowsePayType#WHR"] = "";
    $_SESSION["BrowsePayType#COL"] = "";
    $_SESSION["BrowsePayType#SRT"] = "";
    $_SESSION["BrowsePayType#PreviousColumn"] = "";
    $_SESSION["BrowsePayType#PreviousSort"] = "";
    $_SESSION["BrowsePayType#mySort"] = "";
    $_SESSION["BrowsePayType#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowsePayType#WHR"] = "";
        $_SESSION["BrowsePayType#COL"] = "";
        $_SESSION["BrowsePayType#SRT"] = "";
        $_SESSION["BrowsePayType#PreviousColumn"] = "";
        $_SESSION["BrowsePayType#PreviousSort"] = "";
        $_SESSION["BrowsePayType#mySort"] = "";
        $_SESSION["BrowsePayType#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowsePayType#COL"] = "";
            $_SESSION["BrowsePayType#SRT"] = "";
            $_SESSION["BrowsePayType#PreviousColumn"] = "";
            $_SESSION["BrowsePayType#PreviousSort"] = "";
            $_SESSION["BrowsePayType#mySort"] = "";
            $_SESSION["BrowsePayType#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowsePayType#PreviousColumn"] = "";
else:
    $_SESSION["BrowsePayType#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowsePayType#PreviousSort"] = "";
else:
    $_SESSION["BrowsePayType#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowsePayType#COL") == ""):
    if (getRequest("COL") . getSession("BrowsePayType#COL") == ""):
        $_SESSION["BrowsePayType#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CountryID DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CountryID ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CountryID ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "CountryID";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.BranchID DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.BranchID ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.BranchID ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "BranchID";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "PayType"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.PayType DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.PayType ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.PayType ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "PayType";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Description DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Description ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Description ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "Description";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "Amount"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Amount DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Amount ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Amount ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "Amount";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "CommAmt"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CommAmt DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CommAmt ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CommAmt ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "CommAmt";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "SalesTax"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.SalesTax DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.SalesTax ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.SalesTax ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "SalesTax";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "Account"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Account DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Account ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.Account ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "Account";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

if (getRequest("COL") == "MTDQty"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.MTDQty DESC";
        $_SESSION["BrowsePayType#mySort"] = "DESC";
    else:
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.MTDQty ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowsePayType#PreviousColumn")):
        $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.MTDQty ASC";
        $_SESSION["BrowsePayType#mySort"] = "ASC";
    endif;
    $_SESSION["BrowsePayType#COL"] = "MTDQty";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

$myQuery    = "SELECT tpaytype.CountryID, tpaytype.BranchID, tpaytype.PayType, tpaytype.Description, tpaytype.Amount, tpaytype.CommAmt, tpaytype.SalesTax, tpaytype.Account, tpaytype.MTDQty FROM tpaytype";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowsePayType#WHR"] =  getRequest("WHR");
elseif (getSession("BrowsePayType#WHR") != ""):
    $myWhere    = getSession("BrowsePayType#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowsePayType#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowsePayType#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowsePayType#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowsePayType#myOrder") == ""):
    $_SESSION["BrowsePayType#myOrder"] = "ORDER BY tpaytype.CountryID ASC";
    $_SESSION["BrowsePayType#mySort"] = "ASC";
    $_SESSION["BrowsePayType#COL"] = "CountryID";
    $_SESSION["BrowsePayType#SRT"] = getSession("BrowsePayType#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowsePayType#myOrder") !=""):
    $mySQL .= " " . getSession("BrowsePayType#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tpaytype.CountryID) AS MyCount  FROM tpaytype WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tpaytype.CountryID) AS MyCount  FROM tpaytype";
endif;
$oRStpaytype = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStpaytype->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStpaytype->Close();
$oRStpaytype = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowsePayType#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStpaytype):
    if($oRStpaytype->EOF != TRUE):
        if($oRStpaytype->RecordCount() > 0):
            $oRStpaytype->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowsePayType" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowsePayTypeListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStpaytype->Close();
unset($oRStpaytype);

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
    $tmpMsg = "<a href='BrowsePayType" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetpaytype" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowsePayTypeListTemplate($Template)
=============================================================================
*/
function MergeBrowsePayTypeListTemplate($Template) {
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
        $Template = "./html/BrowsePayTypelist.htm";
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
            if ( getSession("BrowsePayType#PreviousColumn") == "CountryID"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowsePayType#COL") == "CountryID" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowsePayType#PreviousColumn") == "BranchID"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowsePayType#COL") == "BranchID" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=PayType";
            if ( getSession("BrowsePayType#PreviousColumn") == "PayType"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "PayType"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Pay Type</a>";
        $PayTypeLABEL = $myLink;
        if ( getGet("COL") == "PayType" || getSession("BrowsePayType#COL") == "PayType" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $PayTypeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PayTypeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowsePayType#PreviousColumn") == "Description"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowsePayType#COL") == "Description" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Amount";
            if ( getSession("BrowsePayType#PreviousColumn") == "Amount"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "Amount"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Amount</a>";
        $AmountLABEL = $myLink;
        if ( getGet("COL") == "Amount" || getSession("BrowsePayType#COL") == "Amount" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $AmountLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $AmountLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CommAmt";
            if ( getSession("BrowsePayType#PreviousColumn") == "CommAmt"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "CommAmt"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Comm Amt</a>";
        $CommAmtLABEL = $myLink;
        if ( getGet("COL") == "CommAmt" || getSession("BrowsePayType#COL") == "CommAmt" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $CommAmtLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CommAmtLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SalesTax";
            if ( getSession("BrowsePayType#PreviousColumn") == "SalesTax"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "SalesTax"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sales Tax</a>";
        $SalesTaxLABEL = $myLink;
        if ( getGet("COL") == "SalesTax" || getSession("BrowsePayType#COL") == "SalesTax" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $SalesTaxLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SalesTaxLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Account";
            if ( getSession("BrowsePayType#PreviousColumn") == "Account"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "Account"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Account</a>";
        $AccountLABEL = $myLink;
        if ( getGet("COL") == "Account" || getSession("BrowsePayType#COL") == "Account" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $AccountLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $AccountLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MTDQty";
            if ( getSession("BrowsePayType#PreviousColumn") == "MTDQty"):
                if (getSession("BrowsePayType#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowsePayType#COL") == "MTDQty"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">MTDQ ty</a>";
        $MTDQtyLABEL = $myLink;
        if ( getGet("COL") == "MTDQty" || getSession("BrowsePayType#COL") == "MTDQty" ):
            if (getSession("BrowsePayType#SRT") == "ASC"):
                $MTDQtyLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MTDQtyLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@PayTypeLABEL@", $PayTypeLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@AmountLABEL@", $AmountLABEL);
$HeaderText = Replace($HeaderText,"@CommAmtLABEL@", $CommAmtLABEL);
$HeaderText = Replace($HeaderText,"@SalesTaxLABEL@", $SalesTaxLABEL);
$HeaderText = Replace($HeaderText,"@AccountLABEL@", $AccountLABEL);
$HeaderText = Replace($HeaderText,"@MTDQtyLABEL@", $MTDQtyLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStpaytype;
    global $RecordsPageSize;
    global $tpaytypeAccount;
    global $tpaytypeAccountLABEL;
    global $tpaytypeAccountSTYLE;
    global $tpaytypeAmount;
    global $tpaytypeAmountLABEL;
    global $tpaytypeAmountSTYLE;
    global $tpaytypeAutomaticDetailLink;
    global $tpaytypeAutomaticDetailLinkSTYLE;
    global $tpaytypeBranchID;
    global $tpaytypeBranchIDLABEL;
    global $tpaytypeBranchIDSTYLE;
    global $tpaytypeCommAmt;
    global $tpaytypeCommAmtLABEL;
    global $tpaytypeCommAmtSTYLE;
    global $tpaytypeCountryID;
    global $tpaytypeCountryIDLABEL;
    global $tpaytypeCountryIDSTYLE;
    global $tpaytypeDescription;
    global $tpaytypeDescriptionLABEL;
    global $tpaytypeDescriptionSTYLE;
    global $tpaytypeMTDQty;
    global $tpaytypeMTDQtyLABEL;
    global $tpaytypeMTDQtySTYLE;
    global $tpaytypePayType;
    global $tpaytypePayTypeLABEL;
    global $tpaytypePayTypeSTYLE;
    global $tpaytypeSalesTax;
    global $tpaytypeSalesTaxLABEL;
    global $tpaytypeSalesTaxSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStpaytype) :
        while ((!$oRStpaytype->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tpaytypeAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetpaytypeedit.php?ID1=";
                    $tpaytypeAutomaticDetailLink = $myLink;
                      $tpaytypeAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStpaytype->fields["CountryID"]))) . "'" ;
                    $tpaytypeAutomaticDetailLink .=  "&ID2=" . "'";
                    $tpaytypeAutomaticDetailLink .= htmlEncode(trim(getValue($oRStpaytype->fields["BranchID"]))) . "'";
                    $tpaytypeAutomaticDetailLink .=  "&ID3=" . "'";
                    $tpaytypeAutomaticDetailLink .= htmlEncode(trim(getValue($oRStpaytype->fields["PayType"]))) . "'";
            $tmpIMG_tpaytypeAutomaticDetailLink = "";
            $tmpIMG_tpaytypeAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tpaytypeAutomaticDetailLink .= "\">" . $tmpIMG_tpaytypeAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["CountryID"])):
        $tpaytypeCountryID = "";
    else:
        $tpaytypeCountryID = htmlEncode(getValue($oRStpaytype->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["BranchID"])):
        $tpaytypeBranchID = "";
    else:
        $tpaytypeBranchID = htmlEncode(getValue($oRStpaytype->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypePayTypeSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["PayType"])):
        $tpaytypePayType = "";
    else:
        $tpaytypePayType = htmlEncode(getValue($oRStpaytype->fields["PayType"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["Description"])):
        $tpaytypeDescription = "";
    else:
        $tpaytypeDescription = htmlEncode(getValue($oRStpaytype->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeAmountSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["Amount"])):
        $tpaytypeAmount = "";
    else:
        $tpaytypeAmount = htmlEncode(getValue($oRStpaytype->fields["Amount"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeCommAmtSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["CommAmt"])):
        $tpaytypeCommAmt = "";
    else:
        $tpaytypeCommAmt = htmlEncode(getValue($oRStpaytype->fields["CommAmt"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeSalesTaxSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["SalesTax"])):
        $tpaytypeSalesTax = "";
    else:
        $tpaytypeSalesTax = htmlEncode(getValue($oRStpaytype->fields["SalesTax"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeAccountSTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["Account"])):
        $tpaytypeAccount = "";
    else:
        $tpaytypeAccount = htmlEncode(getValue($oRStpaytype->fields["Account"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeMTDQtySTYLE = "TableRow" . $Style;
    if (is_null($oRStpaytype->fields["MTDQty"])):
        $tpaytypeMTDQty = "";
    else:
        $tpaytypeMTDQty = htmlEncode(getValue($oRStpaytype->fields["MTDQty"]));
endif;
$Seq++;
$oRStpaytype->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAutomaticDetailLink@", $tpaytypeAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAutomaticDetailLinkSTYLE@", $tpaytypeAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCountryID@", $tpaytypeCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCountryIDSTYLE@",$tpaytypeCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeBranchID@", $tpaytypeBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeBranchIDSTYLE@",$tpaytypeBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypePayType@", $tpaytypePayType);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypePayTypeSTYLE@",$tpaytypePayTypeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeDescription@", $tpaytypeDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeDescriptionSTYLE@",$tpaytypeDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAmount@", $tpaytypeAmount);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAmountSTYLE@",$tpaytypeAmountSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCommAmt@", $tpaytypeCommAmt);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCommAmtSTYLE@",$tpaytypeCommAmtSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeSalesTax@", $tpaytypeSalesTax);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeSalesTaxSTYLE@",$tpaytypeSalesTaxSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAccount@", $tpaytypeAccount);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAccountSTYLE@",$tpaytypeAccountSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeMTDQty@", $tpaytypeMTDQty);       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeMTDQtySTYLE@",$tpaytypeMTDQtySTYLE);           
        endwhile; // of oRStpaytype DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tpaytypeAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAutomaticDetailLinkSTYLE@", $tpaytypeAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCountryID@", "&nbsp;");
$tpaytypeCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCountryIDSTYLE@", $tpaytypeCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeBranchID@", "&nbsp;");
$tpaytypeBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeBranchIDSTYLE@", $tpaytypeBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypePayType@", "&nbsp;");
$tpaytypePayTypeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypePayTypeSTYLE@", $tpaytypePayTypeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeDescription@", "&nbsp;");
$tpaytypeDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeDescriptionSTYLE@", $tpaytypeDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAmount@", "&nbsp;");
$tpaytypeAmountSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAmountSTYLE@", $tpaytypeAmountSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCommAmt@", "&nbsp;");
$tpaytypeCommAmtSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeCommAmtSTYLE@", $tpaytypeCommAmtSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeSalesTax@", "&nbsp;");
$tpaytypeSalesTaxSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeSalesTaxSTYLE@", $tpaytypeSalesTaxSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAccount@", "&nbsp;");
$tpaytypeAccountSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeAccountSTYLE@", $tpaytypeAccountSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeMTDQty@", "&nbsp;");
$tpaytypeMTDQtySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tpaytypeMTDQtySTYLE@", $tpaytypeMTDQtySTYLE);
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
global $oRStpaytype;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetpaytypesearch.php";
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
        $ref .= "<a href=Updatetpaytype" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetpaytype" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
