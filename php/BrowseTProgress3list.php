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
$BrowseTProgress3RowData = "";
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
$tprogress3AutomaticDetailLink = "";
$tprogress3AutomaticDetailLinkSTYLE = "";
$tprogress3DefineRatings = "";
$tprogress3DefineRatingsSTYLE = "";
$tprogress3CountryIDLABEL = "";
$tprogress3CountryID = "";
$tprogress3CountryIDSTYLE = "";
$tprogress3BranchIDLABEL = "";
$tprogress3BranchID = "";
$tprogress3BranchIDSTYLE = "";
$tprogress3Level1IDLABEL = "";
$tprogress3Level1ID = "";
$tprogress3Level1IDSTYLE = "";
$tprogress3Level2IDLABEL = "";
$tprogress3Level2ID = "";
$tprogress3Level2IDSTYLE = "";
$tprogress3Level3IDLABEL = "";
$tprogress3Level3ID = "";
$tprogress3Level3IDSTYLE = "";
$tprogress3DescriptionLABEL = "";
$tprogress3Description = "";
$tprogress3DescriptionSTYLE = "";
$oRStprogress3 = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTProgress3#WHR"] = "";
    $_SESSION["BrowseTProgress3#COL"] = "";
    $_SESSION["BrowseTProgress3#SRT"] = "";
    $_SESSION["BrowseTProgress3#PreviousColumn"] = "";
    $_SESSION["BrowseTProgress3#PreviousSort"] = "";
    $_SESSION["BrowseTProgress3#mySort"] = "";
    $_SESSION["BrowseTProgress3#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTProgress3#WHR"] = "";
        $_SESSION["BrowseTProgress3#COL"] = "";
        $_SESSION["BrowseTProgress3#SRT"] = "";
        $_SESSION["BrowseTProgress3#PreviousColumn"] = "";
        $_SESSION["BrowseTProgress3#PreviousSort"] = "";
        $_SESSION["BrowseTProgress3#mySort"] = "";
        $_SESSION["BrowseTProgress3#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTProgress3#COL"] = "";
            $_SESSION["BrowseTProgress3#SRT"] = "";
            $_SESSION["BrowseTProgress3#PreviousColumn"] = "";
            $_SESSION["BrowseTProgress3#PreviousSort"] = "";
            $_SESSION["BrowseTProgress3#mySort"] = "";
            $_SESSION["BrowseTProgress3#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTProgress3#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTProgress3#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTProgress3#PreviousSort"] = "";
else:
    $_SESSION["BrowseTProgress3#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTProgress3#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTProgress3#COL") == ""):
        $_SESSION["BrowseTProgress3#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.CountryID DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.CountryID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.CountryID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "CountryID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.BranchID DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.BranchID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.BranchID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "BranchID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

if (getRequest("COL") == "Level1ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level1ID DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level1ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level1ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "Level1ID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

if (getRequest("COL") == "Level2ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level2ID DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level2ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level2ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "Level2ID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

if (getRequest("COL") == "Level3ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level3ID DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level3ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Level3ID ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "Level3ID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Description DESC";
        $_SESSION["BrowseTProgress3#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Description ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress3#PreviousColumn")):
        $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.Description ASC";
        $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress3#COL"] = "Description";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

$myQuery    = "SELECT tprogress3.CountryID, tprogress3.BranchID, tprogress3.Level1ID, tprogress3.Level2ID, tprogress3.Level3ID, tprogress3.Description FROM tprogress3";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTProgress3#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTProgress3#WHR") != ""):
    $myWhere    = getSession("BrowseTProgress3#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tprogress3.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress3.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress3.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress3.Level2ID = " . trim(getRequest( "ID4") ). "";
else:
    $myWhere .= " AND tprogress3.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress3.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress3.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress3.Level2ID = " . trim(getRequest( "ID4") ). "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tprogress3.CountryID = " . trim(getRequest( "ID1") ). "  AND tprogress3.BranchID = " . trim(getRequest( "ID2") ). "  AND  tprogress3.Level1ID = " . trim(getRequest( "ID3") )."   AND  tprogress3.Level2ID = " . trim(getRequest( "ID4") ). "";
    $_SESSION["BrowseTProgress3#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTProgress3#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTProgress3#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tprogress3", "tprogress3.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tprogress3.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseTProgress3#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTProgress3#myOrder") == ""):
    $_SESSION["BrowseTProgress3#myOrder"] = "ORDER BY tprogress3.CountryID ASC";
    $_SESSION["BrowseTProgress3#mySort"] = "ASC";
    $_SESSION["BrowseTProgress3#COL"] = "CountryID";
    $_SESSION["BrowseTProgress3#SRT"] = getSession("BrowseTProgress3#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTProgress3#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTProgress3#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tprogress3.CountryID) AS MyCount  FROM tprogress3 WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tprogress3.CountryID) AS MyCount  FROM tprogress3";
endif;
$oRStprogress3 = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStprogress3->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStprogress3->Close();
$oRStprogress3 = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTProgress3#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStprogress3):
    if($oRStprogress3->EOF != TRUE):
        if($oRStprogress3->RecordCount() > 0):
            $oRStprogress3->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTProgress3" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTProgress3ListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStprogress3->Close();
unset($oRStprogress3);

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
    $tmpMsg = "<a href='BrowseTProgress3" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetprogress3" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTProgress3ListTemplate($Template)
=============================================================================
*/
function MergeBrowseTProgress3ListTemplate($Template) {
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
        $Template = "./html/BrowseTProgress3list.htm";
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
            if ( getSession("BrowseTProgress3#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTProgress3#COL") == "CountryID" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTProgress3#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTProgress3#COL") == "BranchID" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level1ID";
            if ( getSession("BrowseTProgress3#PreviousColumn") == "Level1ID"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "Level1ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 1 ID</a>";
        $Level1IDLABEL = $myLink;
        if ( getGet("COL") == "Level1ID" || getSession("BrowseTProgress3#COL") == "Level1ID" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
                $Level1IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level1IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level2ID";
            if ( getSession("BrowseTProgress3#PreviousColumn") == "Level2ID"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "Level2ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 2 ID</a>";
        $Level2IDLABEL = $myLink;
        if ( getGet("COL") == "Level2ID" || getSession("BrowseTProgress3#COL") == "Level2ID" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
                $Level2IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level2IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level3ID";
            if ( getSession("BrowseTProgress3#PreviousColumn") == "Level3ID"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "Level3ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 3 ID</a>";
        $Level3IDLABEL = $myLink;
        if ( getGet("COL") == "Level3ID" || getSession("BrowseTProgress3#COL") == "Level3ID" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
                $Level3IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level3IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTProgress3#PreviousColumn") == "Description"):
                if (getSession("BrowseTProgress3#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress3#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTProgress3#COL") == "Description" ):
            if (getSession("BrowseTProgress3#SRT") == "ASC"):
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
    global $oRStprogress3;
    global $RecordsPageSize;
    global $tprogress3AutomaticDetailLink;
    global $tprogress3AutomaticDetailLinkSTYLE;
    global $tprogress3BranchID;
    global $tprogress3BranchIDLABEL;
    global $tprogress3BranchIDSTYLE;
    global $tprogress3CountryID;
    global $tprogress3CountryIDLABEL;
    global $tprogress3CountryIDSTYLE;
    global $tprogress3DefineRatings;
    global $tprogress3DefineRatingsSTYLE;
    global $tprogress3Description;
    global $tprogress3DescriptionLABEL;
    global $tprogress3DescriptionSTYLE;
    global $tprogress3Level1ID;
    global $tprogress3Level1IDLABEL;
    global $tprogress3Level1IDSTYLE;
    global $tprogress3Level2ID;
    global $tprogress3Level2IDLABEL;
    global $tprogress3Level2IDSTYLE;
    global $tprogress3Level3ID;
    global $tprogress3Level3IDLABEL;
    global $tprogress3Level3IDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStprogress3) :
        while ((!$oRStprogress3->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tprogress3AutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetprogress3edit.php?ID1=";
                    $tprogress3AutomaticDetailLink = $myLink;
                      $tprogress3AutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStprogress3->fields["CountryID"]))) . "'" ;
                    $tprogress3AutomaticDetailLink .=  "&ID2=" . "'";
                    $tprogress3AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress3->fields["BranchID"]))) . "'";
                    $tprogress3AutomaticDetailLink .=  "&ID3=" . "'";
                    $tprogress3AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress3->fields["Level1ID"]))) . "'";
                    $tprogress3AutomaticDetailLink .=  "&ID4=" . "'";
                    $tprogress3AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress3->fields["Level2ID"]))) . "'";
                    $tprogress3AutomaticDetailLink .=  "&ID5=" . "'";
                    $tprogress3AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress3->fields["Level3ID"]))) . "'";
            $tmpIMG_tprogress3AutomaticDetailLink = "";
            $tmpIMG_tprogress3AutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tprogress3AutomaticDetailLink .= "\">" . $tmpIMG_tprogress3AutomaticDetailLink . "</a>";
    $tprogress3DefineRatingsSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"BrowseTProgress4list.php?ID1=";
                    $tprogress3DefineRatings = $myLink;
                      $tprogress3DefineRatings .= "'" . htmlEncode(trim(getValue($oRStprogress3->fields["CountryID"]))) . "'" ;
                    $tprogress3DefineRatings .=  "&ID2=" . "'";
                    $tprogress3DefineRatings .= htmlEncode(trim(getValue($oRStprogress3->fields["BranchID"]))) . "'";
                    $tprogress3DefineRatings .=  "&ID3=" . "'";
                    $tprogress3DefineRatings .= htmlEncode(trim(getValue($oRStprogress3->fields["Level1ID"]))) . "'";
                    $tprogress3DefineRatings .=  "&ID4=" . "'";
                    $tprogress3DefineRatings .= htmlEncode(trim(getValue($oRStprogress3->fields["Level2ID"]))) . "'";
                    $tprogress3DefineRatings .=  "&ID5=" . "'";
                    $tprogress3DefineRatings .= htmlEncode(trim(getValue($oRStprogress3->fields["Level3ID"]))) . "'";
            $tmpIMG_tprogress3DefineRatings = "";
            $tmpIMG_tprogress3DefineRatings = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Define Progress Ratings\">";
                $tprogress3DefineRatings .= "\">" . $tmpIMG_tprogress3DefineRatings . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3CountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["CountryID"])):
        $tprogress3CountryID = "";
    else:
        $tprogress3CountryID = htmlEncode(getValue($oRStprogress3->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3BranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["BranchID"])):
        $tprogress3BranchID = "";
    else:
        $tprogress3BranchID = htmlEncode(getValue($oRStprogress3->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3Level1IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["Level1ID"])):
        $tprogress3Level1ID = "";
    else:
        $tprogress3Level1ID = htmlEncode(getValue($oRStprogress3->fields["Level1ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3Level2IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["Level2ID"])):
        $tprogress3Level2ID = "";
    else:
        $tprogress3Level2ID = htmlEncode(getValue($oRStprogress3->fields["Level2ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3Level3IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["Level3ID"])):
        $tprogress3Level3ID = "";
    else:
        $myQuoteLevel3ID = "\"";
        $tprogress3Level3ID = '<a href=\'JAVASCRIPT:updateData(';
        $tprogress3Level3ID .= $myQuoteLevel3ID . htmlEncode(getValue($oRStprogress3->fields["Level3ID"])) . $myQuoteLevel3ID;
        $tprogress3Level3ID .= ');\'>';
        $tprogress3Level3ID .= htmlEncode(getValue($oRStprogress3->fields["Level3ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3DescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress3->fields["Description"])):
        $tprogress3Description = "";
    else:
        $tprogress3Description = htmlEncode(getValue($oRStprogress3->fields["Description"]));
endif;
$Seq++;
$oRStprogress3->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3AutomaticDetailLink@", $tprogress3AutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3AutomaticDetailLinkSTYLE@", $tprogress3AutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DefineRatings@", $tprogress3DefineRatings);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DefineRatingsSTYLE@", $tprogress3DefineRatingsSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3CountryID@", $tprogress3CountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3CountryIDSTYLE@",$tprogress3CountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3BranchID@", $tprogress3BranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3BranchIDSTYLE@",$tprogress3BranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level1ID@", $tprogress3Level1ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level1IDSTYLE@",$tprogress3Level1IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level2ID@", $tprogress3Level2ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level2IDSTYLE@",$tprogress3Level2IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level3ID@", $tprogress3Level3ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level3IDSTYLE@",$tprogress3Level3IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Description@", $tprogress3Description);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DescriptionSTYLE@",$tprogress3DescriptionSTYLE);           
        endwhile; // of oRStprogress3 DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress3AutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3AutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3AutomaticDetailLinkSTYLE@", $tprogress3AutomaticDetailLinkSTYLE);
$tprogress3DefineRatingsSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DefineRatings@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DefineRatingsSTYLE@", $tprogress3DefineRatingsSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3CountryID@", "&nbsp;");
$tprogress3CountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3CountryIDSTYLE@", $tprogress3CountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3BranchID@", "&nbsp;");
$tprogress3BranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3BranchIDSTYLE@", $tprogress3BranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level1ID@", "&nbsp;");
$tprogress3Level1IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level1IDSTYLE@", $tprogress3Level1IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level2ID@", "&nbsp;");
$tprogress3Level2IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level2IDSTYLE@", $tprogress3Level2IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level3ID@", "&nbsp;");
$tprogress3Level3IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Level3IDSTYLE@", $tprogress3Level3IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3Description@", "&nbsp;");
$tprogress3DescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress3DescriptionSTYLE@", $tprogress3DescriptionSTYLE);
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
global $oRStprogress3;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetprogress3search.php";
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
        $ref .= "<a href=Updatetprogress3" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetprogress3" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
