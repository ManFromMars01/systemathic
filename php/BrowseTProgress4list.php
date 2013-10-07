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
$BrowseTProgress4RowData = "";
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
$tprogress4AutomaticDetailLink = "";
$tprogress4AutomaticDetailLinkSTYLE = "";
$tprogress4CountryIDLABEL = "";
$tprogress4CountryID = "";
$tprogress4CountryIDSTYLE = "";
$tprogress4BranchIDLABEL = "";
$tprogress4BranchID = "";
$tprogress4BranchIDSTYLE = "";
$tprogress4Level1IDLABEL = "";
$tprogress4Level1ID = "";
$tprogress4Level1IDSTYLE = "";
$tprogress4Level2IDLABEL = "";
$tprogress4Level2ID = "";
$tprogress4Level2IDSTYLE = "";
$tprogress4Level3IDLABEL = "";
$tprogress4Level3ID = "";
$tprogress4Level3IDSTYLE = "";
$tprogress4RatingLABEL = "";
$tprogress4Rating = "";
$tprogress4RatingSTYLE = "";
$tprogress4DescriptionLABEL = "";
$tprogress4Description = "";
$tprogress4DescriptionSTYLE = "";
$oRStprogress4 = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTProgress4#WHR"] = "";
    $_SESSION["BrowseTProgress4#COL"] = "";
    $_SESSION["BrowseTProgress4#SRT"] = "";
    $_SESSION["BrowseTProgress4#PreviousColumn"] = "";
    $_SESSION["BrowseTProgress4#PreviousSort"] = "";
    $_SESSION["BrowseTProgress4#mySort"] = "";
    $_SESSION["BrowseTProgress4#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTProgress4#WHR"] = "";
        $_SESSION["BrowseTProgress4#COL"] = "";
        $_SESSION["BrowseTProgress4#SRT"] = "";
        $_SESSION["BrowseTProgress4#PreviousColumn"] = "";
        $_SESSION["BrowseTProgress4#PreviousSort"] = "";
        $_SESSION["BrowseTProgress4#mySort"] = "";
        $_SESSION["BrowseTProgress4#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTProgress4#COL"] = "";
            $_SESSION["BrowseTProgress4#SRT"] = "";
            $_SESSION["BrowseTProgress4#PreviousColumn"] = "";
            $_SESSION["BrowseTProgress4#PreviousSort"] = "";
            $_SESSION["BrowseTProgress4#mySort"] = "";
            $_SESSION["BrowseTProgress4#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTProgress4#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTProgress4#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTProgress4#PreviousSort"] = "";
else:
    $_SESSION["BrowseTProgress4#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTProgress4#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTProgress4#COL") == ""):
        $_SESSION["BrowseTProgress4#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.CountryID DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.CountryID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.CountryID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "CountryID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.BranchID DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.BranchID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.BranchID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "BranchID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "Level1ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level1ID DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level1ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level1ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "Level1ID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "Level2ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level2ID DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level2ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level2ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "Level2ID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "Level3ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level3ID DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level3ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Level3ID ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "Level3ID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "Rating"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Rating DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Rating ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Rating ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "Rating";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Description DESC";
        $_SESSION["BrowseTProgress4#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Description ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress4#PreviousColumn")):
        $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.Description ASC";
        $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress4#COL"] = "Description";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

$myQuery    = "SELECT tprogress4.CountryID, tprogress4.BranchID, tprogress4.Level1ID, tprogress4.Level2ID, tprogress4.Level3ID, tprogress4.Rating, tprogress4.Description FROM tprogress4";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTProgress4#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTProgress4#WHR") != ""):
    $myWhere    = getSession("BrowseTProgress4#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tprogress4.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress4.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress4.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress4.Level2ID = " . trim(getRequest( "ID4") ). "  AND  tprogress4.Level3ID = " . trim(getRequest( "ID5") ). "";
else:
    $myWhere .= " AND tprogress4.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress4.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress4.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress4.Level2ID = " . trim(getRequest( "ID4") ). "  AND  tprogress4.Level3ID = " . trim(getRequest( "ID5") ). "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tprogress4.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress4.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress4.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress4.Level2ID = " . trim(getRequest( "ID4") ). "  AND  tprogress4.Level3ID = " . trim(getRequest( "ID5") ). "";
    $_SESSION["BrowseTProgress4#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTProgress4#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTProgress4#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTProgress4#myOrder") == ""):
    $_SESSION["BrowseTProgress4#myOrder"] = "ORDER BY tprogress4.CountryID ASC";
    $_SESSION["BrowseTProgress4#mySort"] = "ASC";
    $_SESSION["BrowseTProgress4#COL"] = "CountryID";
    $_SESSION["BrowseTProgress4#SRT"] = getSession("BrowseTProgress4#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTProgress4#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTProgress4#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tprogress4.CountryID) AS MyCount  FROM tprogress4 WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tprogress4.CountryID) AS MyCount  FROM tprogress4";
endif;
$oRStprogress4 = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStprogress4->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStprogress4->Close();
$oRStprogress4 = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTProgress4#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStprogress4):
    if($oRStprogress4->EOF != TRUE):
        if($oRStprogress4->RecordCount() > 0):
            $oRStprogress4->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTProgress4" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTProgress4ListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStprogress4->Close();
unset($oRStprogress4);

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
    $tmpMsg = "<a href='BrowseTProgress4" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetprogress4" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTProgress4ListTemplate($Template)
=============================================================================
*/
function MergeBrowseTProgress4ListTemplate($Template) {
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
        $Template = "./html/BrowseTProgress4list.htm";
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
            if ( getSession("BrowseTProgress4#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTProgress4#COL") == "CountryID" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTProgress4#COL") == "BranchID" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level1ID";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "Level1ID"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "Level1ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 1 ID</a>";
        $Level1IDLABEL = $myLink;
        if ( getGet("COL") == "Level1ID" || getSession("BrowseTProgress4#COL") == "Level1ID" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $Level1IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level1IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level2ID";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "Level2ID"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "Level2ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 2 ID</a>";
        $Level2IDLABEL = $myLink;
        if ( getGet("COL") == "Level2ID" || getSession("BrowseTProgress4#COL") == "Level2ID" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $Level2IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level2IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level3ID";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "Level3ID"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "Level3ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 3 ID</a>";
        $Level3IDLABEL = $myLink;
        if ( getGet("COL") == "Level3ID" || getSession("BrowseTProgress4#COL") == "Level3ID" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $Level3IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level3IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Rating";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "Rating"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "Rating"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Rating</a>";
        $RatingLABEL = $myLink;
        if ( getGet("COL") == "Rating" || getSession("BrowseTProgress4#COL") == "Rating" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $RatingLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RatingLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTProgress4#PreviousColumn") == "Description"):
                if (getSession("BrowseTProgress4#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress4#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTProgress4#COL") == "Description" ):
            if (getSession("BrowseTProgress4#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@Level1IDLABEL@", $Level1IDLABEL);
$HeaderText = Replace($HeaderText,"@Level2IDLABEL@", $Level2IDLABEL);
$HeaderText = Replace($HeaderText,"@Level3IDLABEL@", $Level3IDLABEL);
$HeaderText = Replace($HeaderText,"@RatingLABEL@", $RatingLABEL);
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
    global $oRStprogress4;
    global $RecordsPageSize;
    global $tprogress4AutomaticDetailLink;
    global $tprogress4AutomaticDetailLinkSTYLE;
    global $tprogress4BranchID;
    global $tprogress4BranchIDLABEL;
    global $tprogress4BranchIDSTYLE;
    global $tprogress4CountryID;
    global $tprogress4CountryIDLABEL;
    global $tprogress4CountryIDSTYLE;
    global $tprogress4Description;
    global $tprogress4DescriptionLABEL;
    global $tprogress4DescriptionSTYLE;
    global $tprogress4Level1ID;
    global $tprogress4Level1IDLABEL;
    global $tprogress4Level1IDSTYLE;
    global $tprogress4Level2ID;
    global $tprogress4Level2IDLABEL;
    global $tprogress4Level2IDSTYLE;
    global $tprogress4Level3ID;
    global $tprogress4Level3IDLABEL;
    global $tprogress4Level3IDSTYLE;
    global $tprogress4Rating;
    global $tprogress4RatingLABEL;
    global $tprogress4RatingSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStprogress4) :
        while ((!$oRStprogress4->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tprogress4AutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetprogress4edit.php?ID1=";
                    $tprogress4AutomaticDetailLink = $myLink;
                      $tprogress4AutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStprogress4->fields["CountryID"]))) . "'" ;
                    $tprogress4AutomaticDetailLink .=  "&ID2=" . "'";
                    $tprogress4AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress4->fields["BranchID"]))) . "'";
                    $tprogress4AutomaticDetailLink .=  "&ID3=" . "'";
                    $tprogress4AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress4->fields["Level1ID"]))) . "'";
                    $tprogress4AutomaticDetailLink .=  "&ID4=" . "'";
                    $tprogress4AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress4->fields["Level2ID"]))) . "'";
                    $tprogress4AutomaticDetailLink .=  "&ID5=" . "'";
                    $tprogress4AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress4->fields["Level3ID"]))) . "'";
                    $tprogress4AutomaticDetailLink .=  "&ID6=";
                    $tprogress4AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress4->fields["Rating"])));
            $tmpIMG_tprogress4AutomaticDetailLink = "";
            $tmpIMG_tprogress4AutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tprogress4AutomaticDetailLink .= "\">" . $tmpIMG_tprogress4AutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4CountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["CountryID"])):
        $tprogress4CountryID = "";
    else:
        $tprogress4CountryID = htmlEncode(getValue($oRStprogress4->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4BranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["BranchID"])):
        $tprogress4BranchID = "";
    else:
        $tprogress4BranchID = htmlEncode(getValue($oRStprogress4->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4Level1IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["Level1ID"])):
        $tprogress4Level1ID = "";
    else:
        $tprogress4Level1ID = htmlEncode(getValue($oRStprogress4->fields["Level1ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4Level2IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["Level2ID"])):
        $tprogress4Level2ID = "";
    else:
        $tprogress4Level2ID = htmlEncode(getValue($oRStprogress4->fields["Level2ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4Level3IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["Level3ID"])):
        $tprogress4Level3ID = "";
    else:
        $tprogress4Level3ID = htmlEncode(getValue($oRStprogress4->fields["Level3ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4RatingSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["Rating"])):
        $tprogress4Rating = "";
    else:
        $tprogress4Rating = htmlEncode(getValue($oRStprogress4->fields["Rating"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4DescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress4->fields["Description"])):
        $tprogress4Description = "";
    else:
        $tprogress4Description = htmlEncode(getValue($oRStprogress4->fields["Description"]));
endif;
$Seq++;
$oRStprogress4->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4AutomaticDetailLink@", $tprogress4AutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4AutomaticDetailLinkSTYLE@", $tprogress4AutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4CountryID@", $tprogress4CountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4CountryIDSTYLE@",$tprogress4CountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4BranchID@", $tprogress4BranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4BranchIDSTYLE@",$tprogress4BranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level1ID@", $tprogress4Level1ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level1IDSTYLE@",$tprogress4Level1IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level2ID@", $tprogress4Level2ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level2IDSTYLE@",$tprogress4Level2IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level3ID@", $tprogress4Level3ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level3IDSTYLE@",$tprogress4Level3IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Rating@", $tprogress4Rating);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4RatingSTYLE@",$tprogress4RatingSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Description@", $tprogress4Description);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4DescriptionSTYLE@",$tprogress4DescriptionSTYLE);           
        endwhile; // of oRStprogress4 DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress4AutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4AutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4AutomaticDetailLinkSTYLE@", $tprogress4AutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4CountryID@", "&nbsp;");
$tprogress4CountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4CountryIDSTYLE@", $tprogress4CountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4BranchID@", "&nbsp;");
$tprogress4BranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4BranchIDSTYLE@", $tprogress4BranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level1ID@", "&nbsp;");
$tprogress4Level1IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level1IDSTYLE@", $tprogress4Level1IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level2ID@", "&nbsp;");
$tprogress4Level2IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level2IDSTYLE@", $tprogress4Level2IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level3ID@", "&nbsp;");
$tprogress4Level3IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Level3IDSTYLE@", $tprogress4Level3IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Rating@", "&nbsp;");
$tprogress4RatingSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4RatingSTYLE@", $tprogress4RatingSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4Description@", "&nbsp;");
$tprogress4DescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress4DescriptionSTYLE@", $tprogress4DescriptionSTYLE);
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
global $oRStprogress4;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetprogress4search.php";
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
        $ref .= "<a href=Updatetprogress4" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetprogress4" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
