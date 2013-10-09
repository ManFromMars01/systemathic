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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseSubCategRowData = "";
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
$tsubcategAutomaticDetailLink = "";
$tsubcategAutomaticDetailLinkSTYLE = "";
$tsubcategCountryIDLABEL = "";
$tsubcategCountryID = "";
$tsubcategCountryIDSTYLE = "";
$tsubcategBranchIDLABEL = "";
$tsubcategBranchID = "";
$tsubcategBranchIDSTYLE = "";
$tsubcategCatIDLABEL = "";
$tsubcategCatID = "";
$tsubcategCatIDSTYLE = "";
$tsubcategSubCatIDLABEL = "";
$tsubcategSubCatID = "";
$tsubcategSubCatIDSTYLE = "";
$tsubcategDescriptionLABEL = "";
$tsubcategDescription = "";
$tsubcategDescriptionSTYLE = "";
$oRStsubcateg = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseSubCateg#WHR"] = "";
    $_SESSION["BrowseSubCateg#COL"] = "";
    $_SESSION["BrowseSubCateg#SRT"] = "";
    $_SESSION["BrowseSubCateg#PreviousColumn"] = "";
    $_SESSION["BrowseSubCateg#PreviousSort"] = "";
    $_SESSION["BrowseSubCateg#mySort"] = "";
    $_SESSION["BrowseSubCateg#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseSubCateg#WHR"] = "";
        $_SESSION["BrowseSubCateg#COL"] = "";
        $_SESSION["BrowseSubCateg#SRT"] = "";
        $_SESSION["BrowseSubCateg#PreviousColumn"] = "";
        $_SESSION["BrowseSubCateg#PreviousSort"] = "";
        $_SESSION["BrowseSubCateg#mySort"] = "";
        $_SESSION["BrowseSubCateg#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseSubCateg#COL"] = "";
            $_SESSION["BrowseSubCateg#SRT"] = "";
            $_SESSION["BrowseSubCateg#PreviousColumn"] = "";
            $_SESSION["BrowseSubCateg#PreviousSort"] = "";
            $_SESSION["BrowseSubCateg#mySort"] = "";
            $_SESSION["BrowseSubCateg#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseSubCateg#PreviousColumn"] = "";
else:
    $_SESSION["BrowseSubCateg#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseSubCateg#PreviousSort"] = "";
else:
    $_SESSION["BrowseSubCateg#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseSubCateg#COL") == ""):
    if (getRequest("COL") . getSession("BrowseSubCateg#COL") == ""):
        $_SESSION["BrowseSubCateg#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CountryID DESC";
        $_SESSION["BrowseSubCateg#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CountryID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSubCateg#PreviousColumn")):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CountryID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSubCateg#COL"] = "CountryID";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.BranchID DESC";
        $_SESSION["BrowseSubCateg#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.BranchID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSubCateg#PreviousColumn")):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.BranchID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSubCateg#COL"] = "BranchID";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

if (getRequest("COL") == "CatID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CatID DESC";
        $_SESSION["BrowseSubCateg#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CatID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSubCateg#PreviousColumn")):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CatID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSubCateg#COL"] = "CatID";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

if (getRequest("COL") == "SubCatID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.SubCatID DESC";
        $_SESSION["BrowseSubCateg#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.SubCatID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSubCateg#PreviousColumn")):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.SubCatID ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSubCateg#COL"] = "SubCatID";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.Description DESC";
        $_SESSION["BrowseSubCateg#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.Description ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSubCateg#PreviousColumn")):
        $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.Description ASC";
        $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSubCateg#COL"] = "Description";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

$myQuery    = "SELECT tsubcateg.CountryID, tsubcateg.BranchID, tsubcateg.CatID, tsubcateg.SubCatID, tsubcateg.Description FROM tsubcateg";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseSubCateg#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseSubCateg#WHR") != ""):
    $myWhere    = getSession("BrowseSubCateg#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tsubcateg.CountryID = " . trim(getRequest( "ID1") ). "  AND tsubcateg.BranchID = " . trim(getRequest( "ID2") ). "  AND  tsubcateg.CatID = " . trim(getRequest( "ID3") ). "";
else:
    $myWhere .= " AND tsubcateg.CountryID = " . trim(getRequest( "ID1") ). "  AND tsubcateg.BranchID = " . trim(getRequest( "ID2") ). "  AND  tsubcateg.CatID = " . trim(getRequest( "ID3") ). "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tsubcateg.CountryID = " . trim(getRequest( "ID1") ). "  AND tsubcateg.BranchID = " . trim(getRequest( "ID2") ). "  AND  tsubcateg.CatID = " . trim(getRequest( "ID3") ). "";
    $_SESSION["BrowseSubCateg#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseSubCateg#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseSubCateg#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tsubcateg", "tsubcateg.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tsubcateg.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseSubCateg#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseSubCateg#myOrder") == ""):
    $_SESSION["BrowseSubCateg#myOrder"] = "ORDER BY tsubcateg.CountryID ASC";
    $_SESSION["BrowseSubCateg#mySort"] = "ASC";
    $_SESSION["BrowseSubCateg#COL"] = "CountryID";
    $_SESSION["BrowseSubCateg#SRT"] = getSession("BrowseSubCateg#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseSubCateg#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseSubCateg#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tsubcateg.CountryID) AS MyCount  FROM tsubcateg WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tsubcateg.CountryID) AS MyCount  FROM tsubcateg";
endif;
$oRStsubcateg = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStsubcateg->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStsubcateg->Close();
$oRStsubcateg = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSubCateg#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStsubcateg):
    if($oRStsubcateg->EOF != TRUE):
        if($oRStsubcateg->RecordCount() > 0):
            $oRStsubcateg->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseSubCateg" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseSubCategListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStsubcateg->Close();
unset($oRStsubcateg);

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
    $tmpMsg = "<a href='BrowseSubCateg" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetsubcateg" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseSubCategListTemplate($Template)
=============================================================================
*/
function MergeBrowseSubCategListTemplate($Template) {
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
        $Template = "./html/BrowseSubCateglist.htm";
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
            if ( getSession("BrowseSubCateg#PreviousColumn") == "CountryID"):
                if (getSession("BrowseSubCateg#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSubCateg#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseSubCateg#COL") == "CountryID" ):
            if (getSession("BrowseSubCateg#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseSubCateg#PreviousColumn") == "BranchID"):
                if (getSession("BrowseSubCateg#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSubCateg#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseSubCateg#COL") == "BranchID" ):
            if (getSession("BrowseSubCateg#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=CatID";
            if ( getSession("BrowseSubCateg#PreviousColumn") == "CatID"):
                if (getSession("BrowseSubCateg#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSubCateg#COL") == "CatID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Cat ID</a>";
        $CatIDLABEL = $myLink;
        if ( getGet("COL") == "CatID" || getSession("BrowseSubCateg#COL") == "CatID" ):
            if (getSession("BrowseSubCateg#SRT") == "ASC"):
                $CatIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CatIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SubCatID";
            if ( getSession("BrowseSubCateg#PreviousColumn") == "SubCatID"):
                if (getSession("BrowseSubCateg#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSubCateg#COL") == "SubCatID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sub Cat ID</a>";
        $SubCatIDLABEL = $myLink;
        if ( getGet("COL") == "SubCatID" || getSession("BrowseSubCateg#COL") == "SubCatID" ):
            if (getSession("BrowseSubCateg#SRT") == "ASC"):
                $SubCatIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SubCatIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseSubCateg#PreviousColumn") == "Description"):
                if (getSession("BrowseSubCateg#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSubCateg#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseSubCateg#COL") == "Description" ):
            if (getSession("BrowseSubCateg#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@CatIDLABEL@", $CatIDLABEL);
$HeaderText = Replace($HeaderText,"@SubCatIDLABEL@", $SubCatIDLABEL);
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
    global $oRStsubcateg;
    global $RecordsPageSize;
    global $tsubcategAutomaticDetailLink;
    global $tsubcategAutomaticDetailLinkSTYLE;
    global $tsubcategBranchID;
    global $tsubcategBranchIDLABEL;
    global $tsubcategBranchIDSTYLE;
    global $tsubcategCatID;
    global $tsubcategCatIDLABEL;
    global $tsubcategCatIDSTYLE;
    global $tsubcategCountryID;
    global $tsubcategCountryIDLABEL;
    global $tsubcategCountryIDSTYLE;
    global $tsubcategDescription;
    global $tsubcategDescriptionLABEL;
    global $tsubcategDescriptionSTYLE;
    global $tsubcategSubCatID;
    global $tsubcategSubCatIDLABEL;
    global $tsubcategSubCatIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStsubcateg) :
        while ((!$oRStsubcateg->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tsubcategAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetsubcategedit.php?ID1=";
                    $tsubcategAutomaticDetailLink = $myLink;
                      $tsubcategAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStsubcateg->fields["CountryID"]))) . "'" ;
                    $tsubcategAutomaticDetailLink .=  "&ID2=" . "'";
                    $tsubcategAutomaticDetailLink .= htmlEncode(trim(getValue($oRStsubcateg->fields["BranchID"]))) . "'";
                    $tsubcategAutomaticDetailLink .=  "&ID3=" . "'";
                    $tsubcategAutomaticDetailLink .= htmlEncode(trim(getValue($oRStsubcateg->fields["CatID"]))) . "'";
            $tmpIMG_tsubcategAutomaticDetailLink = "";
            $tmpIMG_tsubcategAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tsubcategAutomaticDetailLink .= "\">" . $tmpIMG_tsubcategAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStsubcateg->fields["CountryID"])):
        $tsubcategCountryID = "";
    else:
        $tsubcategCountryID = htmlEncode(getValue($oRStsubcateg->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStsubcateg->fields["BranchID"])):
        $tsubcategBranchID = "";
    else:
        $tsubcategBranchID = htmlEncode(getValue($oRStsubcateg->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategCatIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStsubcateg->fields["CatID"])):
        $tsubcategCatID = "";
    else:
        $tsubcategCatID = htmlEncode(getValue($oRStsubcateg->fields["CatID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategSubCatIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStsubcateg->fields["SubCatID"])):
        $tsubcategSubCatID = "";
    else:
        $myQuoteSubCatID = "\"";
        $tsubcategSubCatID = '<a href=\'JAVASCRIPT:updateData(';
        $tsubcategSubCatID .= $myQuoteSubCatID . htmlEncode(getValue($oRStsubcateg->fields["SubCatID"])) . $myQuoteSubCatID;
        $tsubcategSubCatID .= ');\'>';
        $tsubcategSubCatID .= htmlEncode(getValue($oRStsubcateg->fields["SubCatID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStsubcateg->fields["Description"])):
        $tsubcategDescription = "";
    else:
        $tsubcategDescription = htmlEncode(getValue($oRStsubcateg->fields["Description"]));
endif;
$Seq++;
$oRStsubcateg->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategAutomaticDetailLink@", $tsubcategAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategAutomaticDetailLinkSTYLE@", $tsubcategAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCountryID@", $tsubcategCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCountryIDSTYLE@",$tsubcategCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategBranchID@", $tsubcategBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategBranchIDSTYLE@",$tsubcategBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCatID@", $tsubcategCatID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCatIDSTYLE@",$tsubcategCatIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategSubCatID@", $tsubcategSubCatID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategSubCatIDSTYLE@",$tsubcategSubCatIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategDescription@", $tsubcategDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategDescriptionSTYLE@",$tsubcategDescriptionSTYLE);           
        endwhile; // of oRStsubcateg DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tsubcategAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategAutomaticDetailLinkSTYLE@", $tsubcategAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCountryID@", "&nbsp;");
$tsubcategCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCountryIDSTYLE@", $tsubcategCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategBranchID@", "&nbsp;");
$tsubcategBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategBranchIDSTYLE@", $tsubcategBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCatID@", "&nbsp;");
$tsubcategCatIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategCatIDSTYLE@", $tsubcategCatIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategSubCatID@", "&nbsp;");
$tsubcategSubCatIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategSubCatIDSTYLE@", $tsubcategSubCatIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategDescription@", "&nbsp;");
$tsubcategDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tsubcategDescriptionSTYLE@", $tsubcategDescriptionSTYLE);
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
global $oRStsubcateg;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetsubcategsearch.php";
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
        $ref .= "<a href=Updatetsubcateg" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetsubcateg" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
