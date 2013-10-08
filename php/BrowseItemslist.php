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
$BrowseItemsRowData = "";
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
$titemsAutomaticDetailLink = "";
$titemsAutomaticDetailLinkSTYLE = "";
$titemsCountryIDLABEL = "";
$titemsCountryID = "";
$titemsCountryIDSTYLE = "";
$titemsBranchIDLABEL = "";
$titemsBranchID = "";
$titemsBranchIDSTYLE = "";
$titemsItemNoLABEL = "";
$titemsItemNo = "";
$titemsItemNoSTYLE = "";
$titemsDescriptionLABEL = "";
$titemsDescription = "";
$titemsDescriptionSTYLE = "";
$oRStitems = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseItems#WHR"] = "";
    $_SESSION["BrowseItems#COL"] = "";
    $_SESSION["BrowseItems#SRT"] = "";
    $_SESSION["BrowseItems#PreviousColumn"] = "";
    $_SESSION["BrowseItems#PreviousSort"] = "";
    $_SESSION["BrowseItems#mySort"] = "";
    $_SESSION["BrowseItems#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseItems#WHR"] = "";
        $_SESSION["BrowseItems#COL"] = "";
        $_SESSION["BrowseItems#SRT"] = "";
        $_SESSION["BrowseItems#PreviousColumn"] = "";
        $_SESSION["BrowseItems#PreviousSort"] = "";
        $_SESSION["BrowseItems#mySort"] = "";
        $_SESSION["BrowseItems#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseItems#COL"] = "";
            $_SESSION["BrowseItems#SRT"] = "";
            $_SESSION["BrowseItems#PreviousColumn"] = "";
            $_SESSION["BrowseItems#PreviousSort"] = "";
            $_SESSION["BrowseItems#mySort"] = "";
            $_SESSION["BrowseItems#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseItems#PreviousColumn"] = "";
else:
    $_SESSION["BrowseItems#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseItems#PreviousSort"] = "";
else:
    $_SESSION["BrowseItems#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseItems#COL") == ""):
    if (getRequest("COL") . getSession("BrowseItems#COL") == ""):
        $_SESSION["BrowseItems#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.CountryID DESC";
        $_SESSION["BrowseItems#mySort"] = "DESC";
    else:
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.CountryID ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseItems#PreviousColumn")):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.CountryID ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseItems#COL"] = "CountryID";
    $_SESSION["BrowseItems#SRT"] = getSession("BrowseItems#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.BranchID DESC";
        $_SESSION["BrowseItems#mySort"] = "DESC";
    else:
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.BranchID ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseItems#PreviousColumn")):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.BranchID ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseItems#COL"] = "BranchID";
    $_SESSION["BrowseItems#SRT"] = getSession("BrowseItems#mySort");
endif;

if (getRequest("COL") == "ItemNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.ItemNo DESC";
        $_SESSION["BrowseItems#mySort"] = "DESC";
    else:
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.ItemNo ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseItems#PreviousColumn")):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.ItemNo ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseItems#COL"] = "ItemNo";
    $_SESSION["BrowseItems#SRT"] = getSession("BrowseItems#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.Description DESC";
        $_SESSION["BrowseItems#mySort"] = "DESC";
    else:
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.Description ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseItems#PreviousColumn")):
        $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.Description ASC";
        $_SESSION["BrowseItems#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseItems#COL"] = "Description";
    $_SESSION["BrowseItems#SRT"] = getSession("BrowseItems#mySort");
endif;

$myQuery    = "SELECT titems.CountryID, titems.BranchID, titems.ItemNo, titems.Description, titems.IsBook, titems.IsMultiCat, titems.IsAbacus, titems.IsMental, titems.IsSupp FROM titems";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseItems#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseItems#WHR") != ""):
    $myWhere    = getSession("BrowseItems#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseItems#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseItems#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseItems#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseItems#myOrder") == ""):
    $_SESSION["BrowseItems#myOrder"] = "ORDER BY titems.CountryID ASC";
    $_SESSION["BrowseItems#mySort"] = "ASC";
    $_SESSION["BrowseItems#COL"] = "CountryID";
    $_SESSION["BrowseItems#SRT"] = getSession("BrowseItems#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseItems#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseItems#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(titems.CountryID) AS MyCount  FROM titems WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(titems.CountryID) AS MyCount  FROM titems";
endif;
$oRStitems = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStitems->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStitems->Close();
$oRStitems = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseItems#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStitems):
    if($oRStitems->EOF != TRUE):
        if($oRStitems->RecordCount() > 0):
            $oRStitems->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseItems" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseItemsListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStitems->Close();
unset($oRStitems);

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
    $tmpMsg = "<a href='BrowseItems" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetitems" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseItemsListTemplate($Template)
=============================================================================
*/
function MergeBrowseItemsListTemplate($Template) {
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
        $Template = "./html/BrowseItemslist.htm";
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
            if ( getSession("BrowseItems#PreviousColumn") == "CountryID"):
                if (getSession("BrowseItems#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseItems#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseItems#COL") == "CountryID" ):
            if (getSession("BrowseItems#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseItems#PreviousColumn") == "BranchID"):
                if (getSession("BrowseItems#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseItems#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseItems#COL") == "BranchID" ):
            if (getSession("BrowseItems#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ItemNo";
            if ( getSession("BrowseItems#PreviousColumn") == "ItemNo"):
                if (getSession("BrowseItems#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseItems#COL") == "ItemNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Item No</a>";
        $ItemNoLABEL = $myLink;
        if ( getGet("COL") == "ItemNo" || getSession("BrowseItems#COL") == "ItemNo" ):
            if (getSession("BrowseItems#SRT") == "ASC"):
                $ItemNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ItemNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseItems#PreviousColumn") == "Description"):
                if (getSession("BrowseItems#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseItems#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseItems#COL") == "Description" ):
            if (getSession("BrowseItems#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@ItemNoLABEL@", $ItemNoLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStitems;
    global $RecordsPageSize;
    global $titemsAutomaticDetailLink;
    global $titemsAutomaticDetailLinkSTYLE;
    global $titemsBranchID;
    global $titemsBranchIDLABEL;
    global $titemsBranchIDSTYLE;
    global $titemsCountryID;
    global $titemsCountryIDLABEL;
    global $titemsCountryIDSTYLE;
    global $titemsDescription;
    global $titemsDescriptionLABEL;
    global $titemsDescriptionSTYLE;
    global $titemsItemNo;
    global $titemsItemNoLABEL;
    global $titemsItemNoSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStitems) :
        while ((!$oRStitems->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $titemsAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetitemsedit.php?ID1=";
                    $titemsAutomaticDetailLink = $myLink;
                      $titemsAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStitems->fields["CountryID"]))) . "'" ;
                    $titemsAutomaticDetailLink .=  "&ID2=" . "'";
                    $titemsAutomaticDetailLink .= htmlEncode(trim(getValue($oRStitems->fields["BranchID"]))) . "'";
                    $titemsAutomaticDetailLink .=  "&ID3=" . "'";
                    $titemsAutomaticDetailLink .= htmlEncode(trim(getValue($oRStitems->fields["ItemNo"]))) . "'";
            $tmpIMG_titemsAutomaticDetailLink = "";
            $tmpIMG_titemsAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $titemsAutomaticDetailLink .= "\">" . $tmpIMG_titemsAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$titemsCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStitems->fields["CountryID"])):
        $titemsCountryID = "";
    else:
        $titemsCountryID = htmlEncode(getValue($oRStitems->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$titemsBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStitems->fields["BranchID"])):
        $titemsBranchID = "";
    else:
        $titemsBranchID = htmlEncode(getValue($oRStitems->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$titemsItemNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStitems->fields["ItemNo"])):
        $titemsItemNo = "";
    else:
        $titemsItemNo = htmlEncode(getValue($oRStitems->fields["ItemNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$titemsDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStitems->fields["Description"])):
        $titemsDescription = "";
    else:
        $titemsDescription = htmlEncode(getValue($oRStitems->fields["Description"]));
endif;
$Seq++;
$oRStitems->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@titemsAutomaticDetailLink@", $titemsAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsAutomaticDetailLinkSTYLE@", $titemsAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsCountryID@", $titemsCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@titemsCountryIDSTYLE@",$titemsCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@titemsBranchID@", $titemsBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@titemsBranchIDSTYLE@",$titemsBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@titemsItemNo@", $titemsItemNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@titemsItemNoSTYLE@",$titemsItemNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@titemsDescription@", $titemsDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@titemsDescriptionSTYLE@",$titemsDescriptionSTYLE);           
        endwhile; // of oRStitems DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$titemsAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@titemsAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@titemsAutomaticDetailLinkSTYLE@", $titemsAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsCountryID@", "&nbsp;");
$titemsCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@titemsCountryIDSTYLE@", $titemsCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsBranchID@", "&nbsp;");
$titemsBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@titemsBranchIDSTYLE@", $titemsBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsItemNo@", "&nbsp;");
$titemsItemNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@titemsItemNoSTYLE@", $titemsItemNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@titemsDescription@", "&nbsp;");
$titemsDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@titemsDescriptionSTYLE@", $titemsDescriptionSTYLE);
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
global $oRStitems;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetitemssearch.php";
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
        $ref .= "<a href=Updatetitems" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetitems" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
