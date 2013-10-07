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
$BrowseRoyaltyRowData = "";
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
$troyaltyAutomaticDetailLink = "";
$troyaltyAutomaticDetailLinkSTYLE = "";
$troyaltyCountryIDLABEL = "";
$troyaltyCountryID = "";
$troyaltyCountryIDSTYLE = "";
$troyaltyBranchIDLABEL = "";
$troyaltyBranchID = "";
$troyaltyBranchIDSTYLE = "";
$troyaltyIDLABEL = "";
$troyaltyID = "";
$troyaltyIDSTYLE = "";
$troyaltyDescriptionLABEL = "";
$troyaltyDescription = "";
$troyaltyDescriptionSTYLE = "";
$troyaltyPercentLABEL = "";
$troyaltyPercent = "";
$troyaltyPercentSTYLE = "";
$troyaltyPctToMasterLABEL = "";
$troyaltyPctToMaster = "";
$troyaltyPctToMasterSTYLE = "";
$troyaltySourceLABEL = "";
$troyaltySource = "";
$troyaltySourceSTYLE = "";
$troyaltyRecipientLABEL = "";
$troyaltyRecipient = "";
$troyaltyRecipientSTYLE = "";
$oRStroyalty = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseRoyalty#WHR"] = "";
    $_SESSION["BrowseRoyalty#COL"] = "";
    $_SESSION["BrowseRoyalty#SRT"] = "";
    $_SESSION["BrowseRoyalty#PreviousColumn"] = "";
    $_SESSION["BrowseRoyalty#PreviousSort"] = "";
    $_SESSION["BrowseRoyalty#mySort"] = "";
    $_SESSION["BrowseRoyalty#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseRoyalty#WHR"] = "";
        $_SESSION["BrowseRoyalty#COL"] = "";
        $_SESSION["BrowseRoyalty#SRT"] = "";
        $_SESSION["BrowseRoyalty#PreviousColumn"] = "";
        $_SESSION["BrowseRoyalty#PreviousSort"] = "";
        $_SESSION["BrowseRoyalty#mySort"] = "";
        $_SESSION["BrowseRoyalty#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseRoyalty#COL"] = "";
            $_SESSION["BrowseRoyalty#SRT"] = "";
            $_SESSION["BrowseRoyalty#PreviousColumn"] = "";
            $_SESSION["BrowseRoyalty#PreviousSort"] = "";
            $_SESSION["BrowseRoyalty#mySort"] = "";
            $_SESSION["BrowseRoyalty#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseRoyalty#PreviousColumn"] = "";
else:
    $_SESSION["BrowseRoyalty#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseRoyalty#PreviousSort"] = "";
else:
    $_SESSION["BrowseRoyalty#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseRoyalty#COL") == ""):
    if (getRequest("COL") . getSession("BrowseRoyalty#COL") == ""):
        $_SESSION["BrowseRoyalty#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.CountryID DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.CountryID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.CountryID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "CountryID";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.BranchID DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.BranchID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.BranchID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "BranchID";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.ID DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.ID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.ID ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "ID";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Description DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Description ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Description ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "Description";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "Percent"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Percent DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Percent ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Percent ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "Percent";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "PctToMaster"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.PctToMaster DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.PctToMaster ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.PctToMaster ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "PctToMaster";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "Source"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Source DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Source ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Source ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "Source";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

if (getRequest("COL") == "Recipient"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Recipient DESC";
        $_SESSION["BrowseRoyalty#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Recipient ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoyalty#PreviousColumn")):
        $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.Recipient ASC";
        $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoyalty#COL"] = "Recipient";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

$myQuery    = "SELECT troyalty.CountryID, troyalty.BranchID, troyalty.ID, troyalty.Description, troyalty.Percent, troyalty.PctToMaster, troyalty.Source, troyalty.Recipient FROM troyalty";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseRoyalty#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseRoyalty#WHR") != ""):
    $myWhere    = getSession("BrowseRoyalty#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRoyalty#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseRoyalty#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseRoyalty#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseRoyalty#myOrder") == ""):
    $_SESSION["BrowseRoyalty#myOrder"] = "ORDER BY troyalty.CountryID ASC";
    $_SESSION["BrowseRoyalty#mySort"] = "ASC";
    $_SESSION["BrowseRoyalty#COL"] = "CountryID";
    $_SESSION["BrowseRoyalty#SRT"] = getSession("BrowseRoyalty#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseRoyalty#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseRoyalty#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(troyalty.CountryID) AS MyCount  FROM troyalty WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(troyalty.CountryID) AS MyCount  FROM troyalty";
endif;
$oRStroyalty = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStroyalty->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStroyalty->Close();
$oRStroyalty = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRoyalty#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStroyalty):
    if($oRStroyalty->EOF != TRUE):
        if($oRStroyalty->RecordCount() > 0):
            $oRStroyalty->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseRoyalty" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseRoyaltyListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStroyalty->Close();
unset($oRStroyalty);

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
    $tmpMsg = "<a href='BrowseRoyalty" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetroyalty" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseRoyaltyListTemplate($Template)
=============================================================================
*/
function MergeBrowseRoyaltyListTemplate($Template) {
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
        $Template = "./html/BrowseRoyaltylist.htm";
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
            if ( getSession("BrowseRoyalty#PreviousColumn") == "CountryID"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseRoyalty#COL") == "CountryID" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "BranchID"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseRoyalty#COL") == "BranchID" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "ID"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseRoyalty#COL") == "ID" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "Description"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseRoyalty#COL") == "Description" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Percent";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "Percent"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "Percent"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Percent</a>";
        $PercentLABEL = $myLink;
        if ( getGet("COL") == "Percent" || getSession("BrowseRoyalty#COL") == "Percent" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $PercentLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PercentLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=PctToMaster";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "PctToMaster"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "PctToMaster"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Pct To Master</a>";
        $PctToMasterLABEL = $myLink;
        if ( getGet("COL") == "PctToMaster" || getSession("BrowseRoyalty#COL") == "PctToMaster" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $PctToMasterLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PctToMasterLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Source";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "Source"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "Source"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Source</a>";
        $SourceLABEL = $myLink;
        if ( getGet("COL") == "Source" || getSession("BrowseRoyalty#COL") == "Source" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $SourceLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SourceLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Recipient";
            if ( getSession("BrowseRoyalty#PreviousColumn") == "Recipient"):
                if (getSession("BrowseRoyalty#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoyalty#COL") == "Recipient"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Recipient</a>";
        $RecipientLABEL = $myLink;
        if ( getGet("COL") == "Recipient" || getSession("BrowseRoyalty#COL") == "Recipient" ):
            if (getSession("BrowseRoyalty#SRT") == "ASC"):
                $RecipientLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RecipientLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@PercentLABEL@", $PercentLABEL);
$HeaderText = Replace($HeaderText,"@PctToMasterLABEL@", $PctToMasterLABEL);
$HeaderText = Replace($HeaderText,"@SourceLABEL@", $SourceLABEL);
$HeaderText = Replace($HeaderText,"@RecipientLABEL@", $RecipientLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStroyalty;
    global $RecordsPageSize;
    global $troyaltyAutomaticDetailLink;
    global $troyaltyAutomaticDetailLinkSTYLE;
    global $troyaltyBranchID;
    global $troyaltyBranchIDLABEL;
    global $troyaltyBranchIDSTYLE;
    global $troyaltyCountryID;
    global $troyaltyCountryIDLABEL;
    global $troyaltyCountryIDSTYLE;
    global $troyaltyDescription;
    global $troyaltyDescriptionLABEL;
    global $troyaltyDescriptionSTYLE;
    global $troyaltyID;
    global $troyaltyIDLABEL;
    global $troyaltyIDSTYLE;
    global $troyaltyPctToMaster;
    global $troyaltyPctToMasterLABEL;
    global $troyaltyPctToMasterSTYLE;
    global $troyaltyPercent;
    global $troyaltyPercentLABEL;
    global $troyaltyPercentSTYLE;
    global $troyaltyRecipient;
    global $troyaltyRecipientLABEL;
    global $troyaltyRecipientSTYLE;
    global $troyaltySource;
    global $troyaltySourceLABEL;
    global $troyaltySourceSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStroyalty) :
        while ((!$oRStroyalty->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $troyaltyAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetroyaltyedit.php?ID1=";
                    $troyaltyAutomaticDetailLink = $myLink;
                      $troyaltyAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStroyalty->fields["CountryID"]))) . "'" ;
                    $troyaltyAutomaticDetailLink .=  "&ID2=" . "'";
                    $troyaltyAutomaticDetailLink .= htmlEncode(trim(getValue($oRStroyalty->fields["BranchID"]))) . "'";
                    $troyaltyAutomaticDetailLink .=  "&ID3=" . "'";
                    $troyaltyAutomaticDetailLink .= htmlEncode(trim(getValue($oRStroyalty->fields["ID"]))) . "'";
            $tmpIMG_troyaltyAutomaticDetailLink = "";
            $tmpIMG_troyaltyAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $troyaltyAutomaticDetailLink .= "\">" . $tmpIMG_troyaltyAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["CountryID"])):
        $troyaltyCountryID = "";
    else:
        $troyaltyCountryID = htmlEncode(getValue($oRStroyalty->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["BranchID"])):
        $troyaltyBranchID = "";
    else:
        $troyaltyBranchID = htmlEncode(getValue($oRStroyalty->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["ID"])):
        $troyaltyID = "";
    else:
        $troyaltyID = htmlEncode(getValue($oRStroyalty->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["Description"])):
        $troyaltyDescription = "";
    else:
        $troyaltyDescription = htmlEncode(getValue($oRStroyalty->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyPercentSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["Percent"])):
        $troyaltyPercent = "";
    else:
        $troyaltyPercent = htmlEncode(getValue($oRStroyalty->fields["Percent"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyPctToMasterSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["PctToMaster"])):
        $troyaltyPctToMaster = "";
    else:
        $troyaltyPctToMaster = htmlEncode(getValue($oRStroyalty->fields["PctToMaster"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltySourceSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["Source"])):
        $troyaltySource = "";
    else:
        $troyaltySource = htmlEncode(getValue($oRStroyalty->fields["Source"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyRecipientSTYLE = "TableRow" . $Style;
    if (is_null($oRStroyalty->fields["Recipient"])):
        $troyaltyRecipient = "";
    else:
        $troyaltyRecipient = htmlEncode(getValue($oRStroyalty->fields["Recipient"]));
endif;
$Seq++;
$oRStroyalty->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyAutomaticDetailLink@", $troyaltyAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyAutomaticDetailLinkSTYLE@", $troyaltyAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyCountryID@", $troyaltyCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyCountryIDSTYLE@",$troyaltyCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyBranchID@", $troyaltyBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyBranchIDSTYLE@",$troyaltyBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyID@", $troyaltyID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyIDSTYLE@",$troyaltyIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyDescription@", $troyaltyDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyDescriptionSTYLE@",$troyaltyDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPercent@", $troyaltyPercent);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPercentSTYLE@",$troyaltyPercentSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPctToMaster@", $troyaltyPctToMaster);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPctToMasterSTYLE@",$troyaltyPctToMasterSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltySource@", $troyaltySource);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltySourceSTYLE@",$troyaltySourceSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyRecipient@", $troyaltyRecipient);       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyRecipientSTYLE@",$troyaltyRecipientSTYLE);           
        endwhile; // of oRStroyalty DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troyaltyAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyAutomaticDetailLinkSTYLE@", $troyaltyAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyCountryID@", "&nbsp;");
$troyaltyCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyCountryIDSTYLE@", $troyaltyCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyBranchID@", "&nbsp;");
$troyaltyBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyBranchIDSTYLE@", $troyaltyBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyID@", "&nbsp;");
$troyaltyIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyIDSTYLE@", $troyaltyIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyDescription@", "&nbsp;");
$troyaltyDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyDescriptionSTYLE@", $troyaltyDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPercent@", "&nbsp;");
$troyaltyPercentSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPercentSTYLE@", $troyaltyPercentSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPctToMaster@", "&nbsp;");
$troyaltyPctToMasterSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyPctToMasterSTYLE@", $troyaltyPctToMasterSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltySource@", "&nbsp;");
$troyaltySourceSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltySourceSTYLE@", $troyaltySourceSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyRecipient@", "&nbsp;");
$troyaltyRecipientSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troyaltyRecipientSTYLE@", $troyaltyRecipientSTYLE);
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
global $oRStroyalty;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetroyaltysearch.php";
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
        $ref .= "<a href=Updatetroyalty" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetroyalty" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
