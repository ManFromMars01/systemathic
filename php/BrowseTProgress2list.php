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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseTProgress2RowData = "";
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
$tprogress2AutomaticDetailLink = "";
$tprogress2AutomaticDetailLinkSTYLE = "";
$tprogress2DefineLevel3 = "";
$tprogress2DefineLevel3STYLE = "";
$tprogress2CountryIDLABEL = "";
$tprogress2CountryID = "";
$tprogress2CountryIDSTYLE = "";
$tprogress2BranchIDLABEL = "";
$tprogress2BranchID = "";
$tprogress2BranchIDSTYLE = "";
$tprogress2Level1IDLABEL = "";
$tprogress2Level1ID = "";
$tprogress2Level1IDSTYLE = "";
$tprogress2Level2IDLABEL = "";
$tprogress2Level2ID = "";
$tprogress2Level2IDSTYLE = "";
$tprogress2DescriptionLABEL = "";
$tprogress2Description = "";
$tprogress2DescriptionSTYLE = "";
$oRStprogress2 = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTProgress2#WHR"] = "";
    $_SESSION["BrowseTProgress2#COL"] = "";
    $_SESSION["BrowseTProgress2#SRT"] = "";
    $_SESSION["BrowseTProgress2#PreviousColumn"] = "";
    $_SESSION["BrowseTProgress2#PreviousSort"] = "";
    $_SESSION["BrowseTProgress2#mySort"] = "";
    $_SESSION["BrowseTProgress2#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTProgress2#WHR"] = "";
        $_SESSION["BrowseTProgress2#COL"] = "";
        $_SESSION["BrowseTProgress2#SRT"] = "";
        $_SESSION["BrowseTProgress2#PreviousColumn"] = "";
        $_SESSION["BrowseTProgress2#PreviousSort"] = "";
        $_SESSION["BrowseTProgress2#mySort"] = "";
        $_SESSION["BrowseTProgress2#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTProgress2#COL"] = "";
            $_SESSION["BrowseTProgress2#SRT"] = "";
            $_SESSION["BrowseTProgress2#PreviousColumn"] = "";
            $_SESSION["BrowseTProgress2#PreviousSort"] = "";
            $_SESSION["BrowseTProgress2#mySort"] = "";
            $_SESSION["BrowseTProgress2#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTProgress2#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTProgress2#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTProgress2#PreviousSort"] = "";
else:
    $_SESSION["BrowseTProgress2#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTProgress2#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTProgress2#COL") == ""):
        $_SESSION["BrowseTProgress2#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.CountryID DESC";
        $_SESSION["BrowseTProgress2#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.CountryID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress2#PreviousColumn")):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.CountryID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress2#COL"] = "CountryID";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.BranchID DESC";
        $_SESSION["BrowseTProgress2#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.BranchID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress2#PreviousColumn")):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.BranchID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress2#COL"] = "BranchID";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

if (getRequest("COL") == "Level1ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level1ID DESC";
        $_SESSION["BrowseTProgress2#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level1ID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress2#PreviousColumn")):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level1ID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress2#COL"] = "Level1ID";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

if (getRequest("COL") == "Level2ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level2ID DESC";
        $_SESSION["BrowseTProgress2#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level2ID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress2#PreviousColumn")):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Level2ID ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress2#COL"] = "Level2ID";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Description DESC";
        $_SESSION["BrowseTProgress2#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Description ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress2#PreviousColumn")):
        $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.Description ASC";
        $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress2#COL"] = "Description";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

$myQuery    = "SELECT tprogress2.CountryID, tprogress2.BranchID, tprogress2.Level1ID, tprogress2.Level2ID, tprogress2.Description FROM tprogress2";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTProgress2#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTProgress2#WHR") != ""):
    $myWhere    = getSession("BrowseTProgress2#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tprogress2.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress2.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress2.Level1ID = " . trim(getRequest( "ID3") ). "";
else:
    $myWhere .= " AND tprogress2.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress2.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress2.Level1ID = " . trim(getRequest( "ID3") ). "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tprogress2.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress2.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress2.Level1ID = " . trim(getRequest( "ID3") ). "";
    $_SESSION["BrowseTProgress2#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTProgress2#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTProgress2#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTProgress2#myOrder") == ""):
    $_SESSION["BrowseTProgress2#myOrder"] = "ORDER BY tprogress2.CountryID ASC";
    $_SESSION["BrowseTProgress2#mySort"] = "ASC";
    $_SESSION["BrowseTProgress2#COL"] = "CountryID";
    $_SESSION["BrowseTProgress2#SRT"] = getSession("BrowseTProgress2#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTProgress2#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTProgress2#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tprogress2.CountryID) AS MyCount  FROM tprogress2 WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tprogress2.CountryID) AS MyCount  FROM tprogress2";
endif;
$oRStprogress2 = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStprogress2->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStprogress2->Close();
$oRStprogress2 = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTProgress2#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStprogress2):
    if($oRStprogress2->EOF != TRUE):
        if($oRStprogress2->RecordCount() > 0):
            $oRStprogress2->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTProgress2" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTProgress2ListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStprogress2->Close();
unset($oRStprogress2);

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
    $tmpMsg = "<a href='BrowseTProgress2" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetprogress2" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTProgress2ListTemplate($Template)
=============================================================================
*/
function MergeBrowseTProgress2ListTemplate($Template) {
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
        $Template = "./html/BrowseTProgress2list.htm";
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
            if ( getSession("BrowseTProgress2#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTProgress2#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress2#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTProgress2#COL") == "CountryID" ):
            if (getSession("BrowseTProgress2#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTProgress2#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTProgress2#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress2#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTProgress2#COL") == "BranchID" ):
            if (getSession("BrowseTProgress2#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level1ID";
            if ( getSession("BrowseTProgress2#PreviousColumn") == "Level1ID"):
                if (getSession("BrowseTProgress2#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress2#COL") == "Level1ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 1 ID</a>";
        $Level1IDLABEL = $myLink;
        if ( getGet("COL") == "Level1ID" || getSession("BrowseTProgress2#COL") == "Level1ID" ):
            if (getSession("BrowseTProgress2#SRT") == "ASC"):
                $Level1IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level1IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level2ID";
            if ( getSession("BrowseTProgress2#PreviousColumn") == "Level2ID"):
                if (getSession("BrowseTProgress2#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress2#COL") == "Level2ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 2 ID</a>";
        $Level2IDLABEL = $myLink;
        if ( getGet("COL") == "Level2ID" || getSession("BrowseTProgress2#COL") == "Level2ID" ):
            if (getSession("BrowseTProgress2#SRT") == "ASC"):
                $Level2IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level2IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTProgress2#PreviousColumn") == "Description"):
                if (getSession("BrowseTProgress2#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress2#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTProgress2#COL") == "Description" ):
            if (getSession("BrowseTProgress2#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@Level1IDLABEL@", $Level1IDLABEL);
$HeaderText = Replace($HeaderText,"@Level2IDLABEL@", $Level2IDLABEL);
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
    global $oRStprogress2;
    global $RecordsPageSize;
    global $tprogress2AutomaticDetailLink;
    global $tprogress2AutomaticDetailLinkSTYLE;
    global $tprogress2BranchID;
    global $tprogress2BranchIDLABEL;
    global $tprogress2BranchIDSTYLE;
    global $tprogress2CountryID;
    global $tprogress2CountryIDLABEL;
    global $tprogress2CountryIDSTYLE;
    global $tprogress2DefineLevel3;
    global $tprogress2DefineLevel3STYLE;
    global $tprogress2Description;
    global $tprogress2DescriptionLABEL;
    global $tprogress2DescriptionSTYLE;
    global $tprogress2Level1ID;
    global $tprogress2Level1IDLABEL;
    global $tprogress2Level1IDSTYLE;
    global $tprogress2Level2ID;
    global $tprogress2Level2IDLABEL;
    global $tprogress2Level2IDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStprogress2) :
        while ((!$oRStprogress2->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tprogress2AutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetprogress2edit.php?ID1=";
                    $tprogress2AutomaticDetailLink = $myLink;
                      $tprogress2AutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStprogress2->fields["CountryID"]))) . "'" ;
                    $tprogress2AutomaticDetailLink .=  "&ID2=" . "'";
                    $tprogress2AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress2->fields["BranchID"]))) . "'";
                    $tprogress2AutomaticDetailLink .=  "&ID3=" . "'";
                    $tprogress2AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress2->fields["Level1ID"]))) . "'";
                    $tprogress2AutomaticDetailLink .=  "&ID4=" . "'";
                    $tprogress2AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress2->fields["Level2ID"]))) . "'";
            $tmpIMG_tprogress2AutomaticDetailLink = "";
            $tmpIMG_tprogress2AutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tprogress2AutomaticDetailLink .= "\">" . $tmpIMG_tprogress2AutomaticDetailLink . "</a>";
    $tprogress2DefineLevel3STYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"BrowseTProgress3list.php?ID1=";
                    $tprogress2DefineLevel3 = $myLink;
                      $tprogress2DefineLevel3 .= "'" . htmlEncode(trim(getValue($oRStprogress2->fields["CountryID"]))) . "'" ;
                    $tprogress2DefineLevel3 .=  "&ID2=" . "'";
                    $tprogress2DefineLevel3 .= htmlEncode(trim(getValue($oRStprogress2->fields["BranchID"]))) . "'";
                    $tprogress2DefineLevel3 .=  "&ID3=" . "'";
                    $tprogress2DefineLevel3 .= htmlEncode(trim(getValue($oRStprogress2->fields["Level1ID"]))) . "'";
                    $tprogress2DefineLevel3 .=  "&ID4=" . "'";
                    $tprogress2DefineLevel3 .= htmlEncode(trim(getValue($oRStprogress2->fields["Level2ID"]))) . "'";
            $tmpIMG_tprogress2DefineLevel3 = "";
            $tmpIMG_tprogress2DefineLevel3 = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Define Criteria\">";
                $tprogress2DefineLevel3 .= "\">" . $tmpIMG_tprogress2DefineLevel3 . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2CountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress2->fields["CountryID"])):
        $tprogress2CountryID = "";
    else:
        $tprogress2CountryID = htmlEncode(getValue($oRStprogress2->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2BranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress2->fields["BranchID"])):
        $tprogress2BranchID = "";
    else:
        $tprogress2BranchID = htmlEncode(getValue($oRStprogress2->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2Level1IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress2->fields["Level1ID"])):
        $tprogress2Level1ID = "";
    else:
        $tprogress2Level1ID = htmlEncode(getValue($oRStprogress2->fields["Level1ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2Level2IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress2->fields["Level2ID"])):
        $tprogress2Level2ID = "";
    else:
        $myQuoteLevel2ID = "\"";
        $tprogress2Level2ID = '<a href=\'JAVASCRIPT:updateData(';
        $tprogress2Level2ID .= $myQuoteLevel2ID . htmlEncode(getValue($oRStprogress2->fields["Level2ID"])) . $myQuoteLevel2ID;
        $tprogress2Level2ID .= ');\'>';
        $tprogress2Level2ID .= htmlEncode(getValue($oRStprogress2->fields["Level2ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2DescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress2->fields["Description"])):
        $tprogress2Description = "";
    else:
        $tprogress2Description = htmlEncode(getValue($oRStprogress2->fields["Description"]));
endif;
$Seq++;
$oRStprogress2->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2AutomaticDetailLink@", $tprogress2AutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2AutomaticDetailLinkSTYLE@", $tprogress2AutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DefineLevel3@", $tprogress2DefineLevel3);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DefineLevel3STYLE@", $tprogress2DefineLevel3STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2CountryID@", $tprogress2CountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2CountryIDSTYLE@",$tprogress2CountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2BranchID@", $tprogress2BranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2BranchIDSTYLE@",$tprogress2BranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level1ID@", $tprogress2Level1ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level1IDSTYLE@",$tprogress2Level1IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level2ID@", $tprogress2Level2ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level2IDSTYLE@",$tprogress2Level2IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Description@", $tprogress2Description);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DescriptionSTYLE@",$tprogress2DescriptionSTYLE);           
        endwhile; // of oRStprogress2 DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress2AutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2AutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2AutomaticDetailLinkSTYLE@", $tprogress2AutomaticDetailLinkSTYLE);
$tprogress2DefineLevel3STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DefineLevel3@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DefineLevel3STYLE@", $tprogress2DefineLevel3STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2CountryID@", "&nbsp;");
$tprogress2CountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2CountryIDSTYLE@", $tprogress2CountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2BranchID@", "&nbsp;");
$tprogress2BranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2BranchIDSTYLE@", $tprogress2BranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level1ID@", "&nbsp;");
$tprogress2Level1IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level1IDSTYLE@", $tprogress2Level1IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level2ID@", "&nbsp;");
$tprogress2Level2IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Level2IDSTYLE@", $tprogress2Level2IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2Description@", "&nbsp;");
$tprogress2DescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress2DescriptionSTYLE@", $tprogress2DescriptionSTYLE);
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
global $oRStprogress2;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetprogress2search.php";
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
        $ref .= "<a href=Updatetprogress2" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetprogress2" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
