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
$BrowseDiscountRowData = "";
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
$tdiscountAutomaticDetailLink = "";
$tdiscountAutomaticDetailLinkSTYLE = "";
$tdiscountCountryIDLABEL = "";
$tdiscountCountryID = "";
$tdiscountCountryIDSTYLE = "";
$tdiscountBranchIDLABEL = "";
$tdiscountBranchID = "";
$tdiscountBranchIDSTYLE = "";
$tdiscountCodeLABEL = "";
$tdiscountCode = "";
$tdiscountCodeSTYLE = "";
$tdiscountDescriptionLABEL = "";
$tdiscountDescription = "";
$tdiscountDescriptionSTYLE = "";
$tdiscountDiscountLABEL = "";
$tdiscountDiscount = "";
$tdiscountDiscountSTYLE = "";
$oRStdiscount = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseDiscount#WHR"] = "";
    $_SESSION["BrowseDiscount#COL"] = "";
    $_SESSION["BrowseDiscount#SRT"] = "";
    $_SESSION["BrowseDiscount#PreviousColumn"] = "";
    $_SESSION["BrowseDiscount#PreviousSort"] = "";
    $_SESSION["BrowseDiscount#mySort"] = "";
    $_SESSION["BrowseDiscount#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseDiscount#WHR"] = "";
        $_SESSION["BrowseDiscount#COL"] = "";
        $_SESSION["BrowseDiscount#SRT"] = "";
        $_SESSION["BrowseDiscount#PreviousColumn"] = "";
        $_SESSION["BrowseDiscount#PreviousSort"] = "";
        $_SESSION["BrowseDiscount#mySort"] = "";
        $_SESSION["BrowseDiscount#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseDiscount#COL"] = "";
            $_SESSION["BrowseDiscount#SRT"] = "";
            $_SESSION["BrowseDiscount#PreviousColumn"] = "";
            $_SESSION["BrowseDiscount#PreviousSort"] = "";
            $_SESSION["BrowseDiscount#mySort"] = "";
            $_SESSION["BrowseDiscount#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseDiscount#PreviousColumn"] = "";
else:
    $_SESSION["BrowseDiscount#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseDiscount#PreviousSort"] = "";
else:
    $_SESSION["BrowseDiscount#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseDiscount#COL") == ""):
    if (getRequest("COL") . getSession("BrowseDiscount#COL") == ""):
        $_SESSION["BrowseDiscount#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.CountryID DESC";
        $_SESSION["BrowseDiscount#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.CountryID ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDiscount#PreviousColumn")):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.CountryID ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDiscount#COL"] = "CountryID";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.BranchID DESC";
        $_SESSION["BrowseDiscount#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.BranchID ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDiscount#PreviousColumn")):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.BranchID ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDiscount#COL"] = "BranchID";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

if (getRequest("COL") == "Code"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Code DESC";
        $_SESSION["BrowseDiscount#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Code ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDiscount#PreviousColumn")):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Code ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDiscount#COL"] = "Code";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Description DESC";
        $_SESSION["BrowseDiscount#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Description ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDiscount#PreviousColumn")):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Description ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDiscount#COL"] = "Description";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

if (getRequest("COL") == "Discount"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Discount DESC";
        $_SESSION["BrowseDiscount#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Discount ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDiscount#PreviousColumn")):
        $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.Discount ASC";
        $_SESSION["BrowseDiscount#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDiscount#COL"] = "Discount";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

$myQuery    = "SELECT tdiscount.CountryID, tdiscount.BranchID, tdiscount.Code, tdiscount.Description, tdiscount.Discount FROM tdiscount";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseDiscount#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseDiscount#WHR") != ""):
    $myWhere    = getSession("BrowseDiscount#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseDiscount#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseDiscount#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseDiscount#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tdiscount", "tdiscount.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tdiscount.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseDiscount#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseDiscount#myOrder") == ""):
    $_SESSION["BrowseDiscount#myOrder"] = "ORDER BY tdiscount.CountryID ASC";
    $_SESSION["BrowseDiscount#mySort"] = "ASC";
    $_SESSION["BrowseDiscount#COL"] = "CountryID";
    $_SESSION["BrowseDiscount#SRT"] = getSession("BrowseDiscount#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseDiscount#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseDiscount#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tdiscount.CountryID) AS MyCount  FROM tdiscount WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tdiscount.CountryID) AS MyCount  FROM tdiscount";
endif;
$oRStdiscount = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStdiscount->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStdiscount->Close();
$oRStdiscount = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseDiscount#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStdiscount):
    if($oRStdiscount->EOF != TRUE):
        if($oRStdiscount->RecordCount() > 0):
            $oRStdiscount->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseDiscount" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseDiscountListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStdiscount->Close();
unset($oRStdiscount);

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
    $tmpMsg = "<a href='BrowseDiscount" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetdiscount" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseDiscountListTemplate($Template)
=============================================================================
*/
function MergeBrowseDiscountListTemplate($Template) {
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
        $Template = "./html/BrowseDiscountlist.htm";
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
            if ( getSession("BrowseDiscount#PreviousColumn") == "CountryID"):
                if (getSession("BrowseDiscount#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDiscount#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseDiscount#COL") == "CountryID" ):
            if (getSession("BrowseDiscount#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseDiscount#PreviousColumn") == "BranchID"):
                if (getSession("BrowseDiscount#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDiscount#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseDiscount#COL") == "BranchID" ):
            if (getSession("BrowseDiscount#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Code";
            if ( getSession("BrowseDiscount#PreviousColumn") == "Code"):
                if (getSession("BrowseDiscount#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDiscount#COL") == "Code"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Code</a>";
        $CodeLABEL = $myLink;
        if ( getGet("COL") == "Code" || getSession("BrowseDiscount#COL") == "Code" ):
            if (getSession("BrowseDiscount#SRT") == "ASC"):
                $CodeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CodeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseDiscount#PreviousColumn") == "Description"):
                if (getSession("BrowseDiscount#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDiscount#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseDiscount#COL") == "Description" ):
            if (getSession("BrowseDiscount#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Discount";
            if ( getSession("BrowseDiscount#PreviousColumn") == "Discount"):
                if (getSession("BrowseDiscount#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDiscount#COL") == "Discount"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Discount</a>";
        $DiscountLABEL = $myLink;
        if ( getGet("COL") == "Discount" || getSession("BrowseDiscount#COL") == "Discount" ):
            if (getSession("BrowseDiscount#SRT") == "ASC"):
                $DiscountLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DiscountLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@CodeLABEL@", $CodeLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@DiscountLABEL@", $DiscountLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStdiscount;
    global $RecordsPageSize;
    global $tdiscountAutomaticDetailLink;
    global $tdiscountAutomaticDetailLinkSTYLE;
    global $tdiscountBranchID;
    global $tdiscountBranchIDLABEL;
    global $tdiscountBranchIDSTYLE;
    global $tdiscountCode;
    global $tdiscountCodeLABEL;
    global $tdiscountCodeSTYLE;
    global $tdiscountCountryID;
    global $tdiscountCountryIDLABEL;
    global $tdiscountCountryIDSTYLE;
    global $tdiscountDescription;
    global $tdiscountDescriptionLABEL;
    global $tdiscountDescriptionSTYLE;
    global $tdiscountDiscount;
    global $tdiscountDiscountLABEL;
    global $tdiscountDiscountSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStdiscount) :
        while ((!$oRStdiscount->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tdiscountAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetdiscountedit.php?ID1=";
                    $tdiscountAutomaticDetailLink = $myLink;
                      $tdiscountAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStdiscount->fields["CountryID"]))) . "'" ;
                    $tdiscountAutomaticDetailLink .=  "&ID2=" . "'";
                    $tdiscountAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdiscount->fields["BranchID"]))) . "'";
                    $tdiscountAutomaticDetailLink .=  "&ID3=" . "'";
                    $tdiscountAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdiscount->fields["Code"]))) . "'";
            $tmpIMG_tdiscountAutomaticDetailLink = "";
            $tmpIMG_tdiscountAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tdiscountAutomaticDetailLink .= "\">" . $tmpIMG_tdiscountAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdiscount->fields["CountryID"])):
        $tdiscountCountryID = "";
    else:
        $tdiscountCountryID = htmlEncode(getValue($oRStdiscount->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdiscount->fields["BranchID"])):
        $tdiscountBranchID = "";
    else:
        $tdiscountBranchID = htmlEncode(getValue($oRStdiscount->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountCodeSTYLE = "TableRow" . $Style;
    if (is_null($oRStdiscount->fields["Code"])):
        $tdiscountCode = "";
    else:
        $tdiscountCode = htmlEncode(getValue($oRStdiscount->fields["Code"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStdiscount->fields["Description"])):
        $tdiscountDescription = "";
    else:
        $tdiscountDescription = htmlEncode(getValue($oRStdiscount->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountDiscountSTYLE = "TableRow" . $Style;
    if (is_null($oRStdiscount->fields["Discount"])):
        $tdiscountDiscount = "";
    else:
        $tdiscountDiscount = htmlEncode(getValue($oRStdiscount->fields["Discount"]));
endif;
$Seq++;
$oRStdiscount->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountAutomaticDetailLink@", $tdiscountAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountAutomaticDetailLinkSTYLE@", $tdiscountAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCountryID@", $tdiscountCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCountryIDSTYLE@",$tdiscountCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountBranchID@", $tdiscountBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountBranchIDSTYLE@",$tdiscountBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCode@", $tdiscountCode);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCodeSTYLE@",$tdiscountCodeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDescription@", $tdiscountDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDescriptionSTYLE@",$tdiscountDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDiscount@", $tdiscountDiscount);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDiscountSTYLE@",$tdiscountDiscountSTYLE);           
        endwhile; // of oRStdiscount DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdiscountAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountAutomaticDetailLinkSTYLE@", $tdiscountAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCountryID@", "&nbsp;");
$tdiscountCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCountryIDSTYLE@", $tdiscountCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountBranchID@", "&nbsp;");
$tdiscountBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountBranchIDSTYLE@", $tdiscountBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCode@", "&nbsp;");
$tdiscountCodeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountCodeSTYLE@", $tdiscountCodeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDescription@", "&nbsp;");
$tdiscountDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDescriptionSTYLE@", $tdiscountDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDiscount@", "&nbsp;");
$tdiscountDiscountSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdiscountDiscountSTYLE@", $tdiscountDiscountSTYLE);
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
global $oRStdiscount;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetdiscountsearch.php";
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
        $ref .= "<a href=Updatetdiscount" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetdiscount" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
