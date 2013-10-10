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
$BrowseBooksRowData = "";
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
$ebooksAutomaticDetailLink = "";
$ebooksAutomaticDetailLinkSTYLE = "";
$ebooksCountryIDLABEL = "";
$ebooksCountryID = "";
$ebooksCountryIDSTYLE = "";
$ebooksBranchIDLABEL = "";
$ebooksBranchID = "";
$ebooksBranchIDSTYLE = "";
$ebooksCustNoLABEL = "";
$ebooksCustNo = "";
$ebooksCustNoSTYLE = "";
$ebooksLevelIDLABEL = "";
$ebooksLevelID = "";
$ebooksLevelIDSTYLE = "";
$ebooksTeacherIDLABEL = "";
$ebooksTeacherID = "";
$ebooksTeacherIDSTYLE = "";
$ebooksItemTypeLABEL = "";
$ebooksItemType = "";
$ebooksItemTypeSTYLE = "";
$ebooksItemNoLABEL = "";
$ebooksItemNo = "";
$ebooksItemNoSTYLE = "";
$ebooksDescriptionLABEL = "";
$ebooksDescription = "";
$ebooksDescriptionSTYLE = "";
$ebooksQtyLABEL = "";
$ebooksQty = "";
$ebooksQtySTYLE = "";
$oRSebooks = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseBooks#WHR"] = "";
    $_SESSION["BrowseBooks#COL"] = "";
    $_SESSION["BrowseBooks#SRT"] = "";
    $_SESSION["BrowseBooks#PreviousColumn"] = "";
    $_SESSION["BrowseBooks#PreviousSort"] = "";
    $_SESSION["BrowseBooks#mySort"] = "";
    $_SESSION["BrowseBooks#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseBooks#WHR"] = "";
        $_SESSION["BrowseBooks#COL"] = "";
        $_SESSION["BrowseBooks#SRT"] = "";
        $_SESSION["BrowseBooks#PreviousColumn"] = "";
        $_SESSION["BrowseBooks#PreviousSort"] = "";
        $_SESSION["BrowseBooks#mySort"] = "";
        $_SESSION["BrowseBooks#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseBooks#COL"] = "";
            $_SESSION["BrowseBooks#SRT"] = "";
            $_SESSION["BrowseBooks#PreviousColumn"] = "";
            $_SESSION["BrowseBooks#PreviousSort"] = "";
            $_SESSION["BrowseBooks#mySort"] = "";
            $_SESSION["BrowseBooks#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseBooks#PreviousColumn"] = "";
else:
    $_SESSION["BrowseBooks#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseBooks#PreviousSort"] = "";
else:
    $_SESSION["BrowseBooks#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseBooks#COL") == ""):
    if (getRequest("COL") . getSession("BrowseBooks#COL") == ""):
        $_SESSION["BrowseBooks#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CountryID DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CountryID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CountryID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "CountryID";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.BranchID DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.BranchID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.BranchID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "BranchID";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "CustNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CustNo DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CustNo ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CustNo ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "CustNo";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "LevelID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.LevelID DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.LevelID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.LevelID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "LevelID";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "TeacherID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.TeacherID DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.TeacherID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.TeacherID ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "TeacherID";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "ItemType"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemType DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemType ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemType ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "ItemType";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "ItemNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemNo DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemNo ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.ItemNo ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "ItemNo";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Description DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Description ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Description ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "Description";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

if (getRequest("COL") == "Qty"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Qty DESC";
        $_SESSION["BrowseBooks#mySort"] = "DESC";
    else:
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Qty ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseBooks#PreviousColumn")):
        $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.Qty ASC";
        $_SESSION["BrowseBooks#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseBooks#COL"] = "Qty";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

$myQuery    = "SELECT ebooks.CountryID, ebooks.BranchID, ebooks.CustNo, ebooks.LevelID, ebooks.TeacherID, ebooks.ItemType, ebooks.ItemNo, ebooks.Description, ebooks.Qty FROM ebooks";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseBooks#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseBooks#WHR") != ""):
    $myWhere    = getSession("BrowseBooks#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseBooks#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseBooks#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseBooks#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseBooks#myOrder") == ""):
    $_SESSION["BrowseBooks#myOrder"] = "ORDER BY ebooks.CountryID ASC";
    $_SESSION["BrowseBooks#mySort"] = "ASC";
    $_SESSION["BrowseBooks#COL"] = "CountryID";
    $_SESSION["BrowseBooks#SRT"] = getSession("BrowseBooks#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseBooks#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseBooks#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(ebooks.CountryID) AS MyCount  FROM ebooks WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(ebooks.CountryID) AS MyCount  FROM ebooks";
endif;
$oRSebooks = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSebooks->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSebooks->Close();
$oRSebooks = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseBooks#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSebooks):
    if($oRSebooks->EOF != TRUE):
        if($oRSebooks->RecordCount() > 0):
            $oRSebooks->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseBooks" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseBooksListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSebooks->Close();
unset($oRSebooks);

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
    $tmpMsg = "<a href='BrowseBooks" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updateebooks" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseBooksListTemplate($Template)
=============================================================================
*/
function MergeBrowseBooksListTemplate($Template) {
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
        $Template = "./html/BrowseBookslist.htm";
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
            if ( getSession("BrowseBooks#PreviousColumn") == "CountryID"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseBooks#COL") == "CountryID" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseBooks#PreviousColumn") == "BranchID"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseBooks#COL") == "BranchID" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CustNo";
            if ( getSession("BrowseBooks#PreviousColumn") == "CustNo"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "CustNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Cust No</a>";
        $CustNoLABEL = $myLink;
        if ( getGet("COL") == "CustNo" || getSession("BrowseBooks#COL") == "CustNo" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $CustNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CustNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LevelID";
            if ( getSession("BrowseBooks#PreviousColumn") == "LevelID"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "LevelID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level ID</a>";
        $LevelIDLABEL = $myLink;
        if ( getGet("COL") == "LevelID" || getSession("BrowseBooks#COL") == "LevelID" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $LevelIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LevelIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TeacherID";
            if ( getSession("BrowseBooks#PreviousColumn") == "TeacherID"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "TeacherID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Teacher ID</a>";
        $TeacherIDLABEL = $myLink;
        if ( getGet("COL") == "TeacherID" || getSession("BrowseBooks#COL") == "TeacherID" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $TeacherIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TeacherIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ItemType";
            if ( getSession("BrowseBooks#PreviousColumn") == "ItemType"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "ItemType"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Item Type</a>";
        $ItemTypeLABEL = $myLink;
        if ( getGet("COL") == "ItemType" || getSession("BrowseBooks#COL") == "ItemType" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $ItemTypeLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ItemTypeLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ItemNo";
            if ( getSession("BrowseBooks#PreviousColumn") == "ItemNo"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "ItemNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Item No</a>";
        $ItemNoLABEL = $myLink;
        if ( getGet("COL") == "ItemNo" || getSession("BrowseBooks#COL") == "ItemNo" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $ItemNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ItemNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseBooks#PreviousColumn") == "Description"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseBooks#COL") == "Description" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Qty";
            if ( getSession("BrowseBooks#PreviousColumn") == "Qty"):
                if (getSession("BrowseBooks#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseBooks#COL") == "Qty"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Qty</a>";
        $QtyLABEL = $myLink;
        if ( getGet("COL") == "Qty" || getSession("BrowseBooks#COL") == "Qty" ):
            if (getSession("BrowseBooks#SRT") == "ASC"):
                $QtyLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $QtyLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@CustNoLABEL@", $CustNoLABEL);
$HeaderText = Replace($HeaderText,"@LevelIDLABEL@", $LevelIDLABEL);
$HeaderText = Replace($HeaderText,"@TeacherIDLABEL@", $TeacherIDLABEL);
$HeaderText = Replace($HeaderText,"@ItemTypeLABEL@", $ItemTypeLABEL);
$HeaderText = Replace($HeaderText,"@ItemNoLABEL@", $ItemNoLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@QtyLABEL@", $QtyLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSebooks;
    global $RecordsPageSize;
    global $ebooksAutomaticDetailLink;
    global $ebooksAutomaticDetailLinkSTYLE;
    global $ebooksBranchID;
    global $ebooksBranchIDLABEL;
    global $ebooksBranchIDSTYLE;
    global $ebooksCountryID;
    global $ebooksCountryIDLABEL;
    global $ebooksCountryIDSTYLE;
    global $ebooksCustNo;
    global $ebooksCustNoLABEL;
    global $ebooksCustNoSTYLE;
    global $ebooksDescription;
    global $ebooksDescriptionLABEL;
    global $ebooksDescriptionSTYLE;
    global $ebooksItemNo;
    global $ebooksItemNoLABEL;
    global $ebooksItemNoSTYLE;
    global $ebooksItemType;
    global $ebooksItemTypeLABEL;
    global $ebooksItemTypeSTYLE;
    global $ebooksLevelID;
    global $ebooksLevelIDLABEL;
    global $ebooksLevelIDSTYLE;
    global $ebooksQty;
    global $ebooksQtyLABEL;
    global $ebooksQtySTYLE;
    global $ebooksTeacherID;
    global $ebooksTeacherIDLABEL;
    global $ebooksTeacherIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRSebooks) :
        while ((!$oRSebooks->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $ebooksAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updateebooksedit.php?ID1=";
                    $ebooksAutomaticDetailLink = $myLink;
                      $ebooksAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSebooks->fields["CountryID"]))) . "'" ;
                    $ebooksAutomaticDetailLink .=  "&ID2=" . "'";
                    $ebooksAutomaticDetailLink .= htmlEncode(trim(getValue($oRSebooks->fields["BranchID"]))) . "'";
                    $ebooksAutomaticDetailLink .=  "&ID3=";
                    $ebooksAutomaticDetailLink .= htmlEncode(trim(getValue($oRSebooks->fields["CustNo"])));
            $tmpIMG_ebooksAutomaticDetailLink = "";
            $tmpIMG_ebooksAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $ebooksAutomaticDetailLink .= "\">" . $tmpIMG_ebooksAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["CountryID"])):
        $ebooksCountryID = "";
    else:
        $ebooksCountryID = htmlEncode(getValue($oRSebooks->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["BranchID"])):
        $ebooksBranchID = "";
    else:
        $ebooksBranchID = htmlEncode(getValue($oRSebooks->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksCustNoSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["CustNo"])):
        $ebooksCustNo = "";
    else:
        $ebooksCustNo = htmlEncode(getValue($oRSebooks->fields["CustNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksLevelIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["LevelID"])):
        $ebooksLevelID = "";
    else:
        $ebooksLevelID = htmlEncode(getValue($oRSebooks->fields["LevelID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksTeacherIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["TeacherID"])):
        $ebooksTeacherID = "";
    else:
        $ebooksTeacherID = htmlEncode(getValue($oRSebooks->fields["TeacherID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksItemTypeSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["ItemType"])):
        $ebooksItemType = "";
    else:
        $ebooksItemType = htmlEncode(getValue($oRSebooks->fields["ItemType"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksItemNoSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["ItemNo"])):
        $ebooksItemNo = "";
    else:
        $ebooksItemNo = htmlEncode(getValue($oRSebooks->fields["ItemNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["Description"])):
        $ebooksDescription = "";
    else:
        $ebooksDescription = htmlEncode(getValue($oRSebooks->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksQtySTYLE = "TableRow" . $Style;
    if (is_null($oRSebooks->fields["Qty"])):
        $ebooksQty = "";
    else:
        $ebooksQty = htmlEncode(getValue($oRSebooks->fields["Qty"]));
endif;
$Seq++;
$oRSebooks->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@ebooksAutomaticDetailLink@", $ebooksAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksAutomaticDetailLinkSTYLE@", $ebooksAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCountryID@", $ebooksCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCountryIDSTYLE@",$ebooksCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksBranchID@", $ebooksBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksBranchIDSTYLE@",$ebooksBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCustNo@", $ebooksCustNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCustNoSTYLE@",$ebooksCustNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksLevelID@", $ebooksLevelID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksLevelIDSTYLE@",$ebooksLevelIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksTeacherID@", $ebooksTeacherID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksTeacherIDSTYLE@",$ebooksTeacherIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemType@", $ebooksItemType);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemTypeSTYLE@",$ebooksItemTypeSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemNo@", $ebooksItemNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemNoSTYLE@",$ebooksItemNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksDescription@", $ebooksDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksDescriptionSTYLE@",$ebooksDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksQty@", $ebooksQty);       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksQtySTYLE@",$ebooksQtySTYLE);           
        endwhile; // of oRSebooks DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ebooksAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksAutomaticDetailLinkSTYLE@", $ebooksAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCountryID@", "&nbsp;");
$ebooksCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCountryIDSTYLE@", $ebooksCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksBranchID@", "&nbsp;");
$ebooksBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksBranchIDSTYLE@", $ebooksBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCustNo@", "&nbsp;");
$ebooksCustNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksCustNoSTYLE@", $ebooksCustNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksLevelID@", "&nbsp;");
$ebooksLevelIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksLevelIDSTYLE@", $ebooksLevelIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksTeacherID@", "&nbsp;");
$ebooksTeacherIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksTeacherIDSTYLE@", $ebooksTeacherIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemType@", "&nbsp;");
$ebooksItemTypeSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemTypeSTYLE@", $ebooksItemTypeSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemNo@", "&nbsp;");
$ebooksItemNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksItemNoSTYLE@", $ebooksItemNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksDescription@", "&nbsp;");
$ebooksDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksDescriptionSTYLE@", $ebooksDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksQty@", "&nbsp;");
$ebooksQtySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ebooksQtySTYLE@", $ebooksQtySTYLE);
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
global $oRSebooks;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updateebookssearch.php";
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
        $ref .= "<a href=Updateebooks" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updateebooks" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
