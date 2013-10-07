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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseLevelRowData = "";
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
$tlevelAutomaticDetailLink = "";
$tlevelAutomaticDetailLinkSTYLE = "";
$tlevelDefineSchedules = "";
$tlevelDefineSchedulesSTYLE = "";
$tlevelCountryIDLABEL = "";
$tlevelCountryID = "";
$tlevelCountryIDSTYLE = "";
$tlevelBranchIDLABEL = "";
$tlevelBranchID = "";
$tlevelBranchIDSTYLE = "";
$tlevelIDLABEL = "";
$tlevelID = "";
$tlevelIDSTYLE = "";
$tlevelDescriptionLABEL = "";
$tlevelDescription = "";
$tlevelDescriptionSTYLE = "";
$oRStlevel = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseLevel#WHR"] = "";
    $_SESSION["BrowseLevel#COL"] = "";
    $_SESSION["BrowseLevel#SRT"] = "";
    $_SESSION["BrowseLevel#PreviousColumn"] = "";
    $_SESSION["BrowseLevel#PreviousSort"] = "";
    $_SESSION["BrowseLevel#mySort"] = "";
    $_SESSION["BrowseLevel#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseLevel#WHR"] = "";
        $_SESSION["BrowseLevel#COL"] = "";
        $_SESSION["BrowseLevel#SRT"] = "";
        $_SESSION["BrowseLevel#PreviousColumn"] = "";
        $_SESSION["BrowseLevel#PreviousSort"] = "";
        $_SESSION["BrowseLevel#mySort"] = "";
        $_SESSION["BrowseLevel#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseLevel#COL"] = "";
            $_SESSION["BrowseLevel#SRT"] = "";
            $_SESSION["BrowseLevel#PreviousColumn"] = "";
            $_SESSION["BrowseLevel#PreviousSort"] = "";
            $_SESSION["BrowseLevel#mySort"] = "";
            $_SESSION["BrowseLevel#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseLevel#PreviousColumn"] = "";
else:
    $_SESSION["BrowseLevel#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseLevel#PreviousSort"] = "";
else:
    $_SESSION["BrowseLevel#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseLevel#COL") == ""):
    if (getRequest("COL") . getSession("BrowseLevel#COL") == ""):
        $_SESSION["BrowseLevel#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.CountryID DESC";
        $_SESSION["BrowseLevel#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.CountryID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLevel#PreviousColumn")):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.CountryID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLevel#COL"] = "CountryID";
    $_SESSION["BrowseLevel#SRT"] = getSession("BrowseLevel#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.BranchID DESC";
        $_SESSION["BrowseLevel#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.BranchID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLevel#PreviousColumn")):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.BranchID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLevel#COL"] = "BranchID";
    $_SESSION["BrowseLevel#SRT"] = getSession("BrowseLevel#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.ID DESC";
        $_SESSION["BrowseLevel#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.ID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLevel#PreviousColumn")):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.ID ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLevel#COL"] = "ID";
    $_SESSION["BrowseLevel#SRT"] = getSession("BrowseLevel#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.Description DESC";
        $_SESSION["BrowseLevel#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.Description ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLevel#PreviousColumn")):
        $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.Description ASC";
        $_SESSION["BrowseLevel#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLevel#COL"] = "Description";
    $_SESSION["BrowseLevel#SRT"] = getSession("BrowseLevel#mySort");
endif;

$myQuery    = "SELECT tlevel.CountryID, tlevel.BranchID, tlevel.ID, tlevel.Description FROM tlevel";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseLevel#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseLevel#WHR") != ""):
    $myWhere    = getSession("BrowseLevel#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseLevel#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseLevel#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseLevel#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseLevel#myOrder") == ""):
    $_SESSION["BrowseLevel#myOrder"] = "ORDER BY tlevel.CountryID ASC";
    $_SESSION["BrowseLevel#mySort"] = "ASC";
    $_SESSION["BrowseLevel#COL"] = "CountryID";
    $_SESSION["BrowseLevel#SRT"] = getSession("BrowseLevel#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseLevel#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseLevel#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tlevel.CountryID) AS MyCount  FROM tlevel WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tlevel.CountryID) AS MyCount  FROM tlevel";
endif;
$oRStlevel = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStlevel->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStlevel->Close();
$oRStlevel = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseLevel#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStlevel):
    if($oRStlevel->EOF != TRUE):
        if($oRStlevel->RecordCount() > 0):
            $oRStlevel->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseLevel" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseLevelListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStlevel->Close();
unset($oRStlevel);

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
    $tmpMsg = "<a href='BrowseLevel" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetlevel" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseLevelListTemplate($Template)
=============================================================================
*/
function MergeBrowseLevelListTemplate($Template) {
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
        $Template = "./html/BrowseLevellist.htm";
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
            if ( getSession("BrowseLevel#PreviousColumn") == "CountryID"):
                if (getSession("BrowseLevel#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLevel#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseLevel#COL") == "CountryID" ):
            if (getSession("BrowseLevel#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseLevel#PreviousColumn") == "BranchID"):
                if (getSession("BrowseLevel#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLevel#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseLevel#COL") == "BranchID" ):
            if (getSession("BrowseLevel#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseLevel#PreviousColumn") == "ID"):
                if (getSession("BrowseLevel#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLevel#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseLevel#COL") == "ID" ):
            if (getSession("BrowseLevel#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseLevel#PreviousColumn") == "Description"):
                if (getSession("BrowseLevel#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLevel#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseLevel#COL") == "Description" ):
            if (getSession("BrowseLevel#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
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
    global $oRStlevel;
    global $RecordsPageSize;
    global $tlevelAutomaticDetailLink;
    global $tlevelAutomaticDetailLinkSTYLE;
    global $tlevelBranchID;
    global $tlevelBranchIDLABEL;
    global $tlevelBranchIDSTYLE;
    global $tlevelCountryID;
    global $tlevelCountryIDLABEL;
    global $tlevelCountryIDSTYLE;
    global $tlevelDefineSchedules;
    global $tlevelDefineSchedulesSTYLE;
    global $tlevelDescription;
    global $tlevelDescriptionLABEL;
    global $tlevelDescriptionSTYLE;
    global $tlevelID;
    global $tlevelIDLABEL;
    global $tlevelIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStlevel) :
        while ((!$oRStlevel->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tlevelAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetleveledit.php?ID1=";
                    $tlevelAutomaticDetailLink = $myLink;
                      $tlevelAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStlevel->fields["CountryID"]))) . "'" ;
                    $tlevelAutomaticDetailLink .=  "&ID2=" . "'";
                    $tlevelAutomaticDetailLink .= htmlEncode(trim(getValue($oRStlevel->fields["BranchID"]))) . "'";
                    $tlevelAutomaticDetailLink .=  "&ID3=";
                    $tlevelAutomaticDetailLink .= htmlEncode(trim(getValue($oRStlevel->fields["ID"])));
            $tmpIMG_tlevelAutomaticDetailLink = "";
            $tmpIMG_tlevelAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tlevelAutomaticDetailLink .= "\">" . $tmpIMG_tlevelAutomaticDetailLink . "</a>";
    $tlevelDefineSchedulesSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"BrowseSchedListlist.php?ID1=";
                    $tlevelDefineSchedules = $myLink;
                      $tlevelDefineSchedules .= "'" . htmlEncode(trim(getValue($oRStlevel->fields["CountryID"]))) . "'" ;
                    $tlevelDefineSchedules .=  "&ID2=" . "'";
                    $tlevelDefineSchedules .= htmlEncode(trim(getValue($oRStlevel->fields["BranchID"]))) . "'";
                    $tlevelDefineSchedules .=  "&ID3=";
                    $tlevelDefineSchedules .= htmlEncode(trim(getValue($oRStlevel->fields["ID"])));
            $tmpIMG_tlevelDefineSchedules = "";
            $tmpIMG_tlevelDefineSchedules = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Define Schedules\">";
                $tlevelDefineSchedules .= "\">" . $tmpIMG_tlevelDefineSchedules . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlevelCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlevel->fields["CountryID"])):
        $tlevelCountryID = "";
    else:
        $tlevelCountryID = htmlEncode(getValue($oRStlevel->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlevelBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlevel->fields["BranchID"])):
        $tlevelBranchID = "";
    else:
        $tlevelBranchID = htmlEncode(getValue($oRStlevel->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlevelIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlevel->fields["ID"])):
        $tlevelID = "";
    else:
        $myQuoteID = "";
        $tlevelID = '<a href=\'JAVASCRIPT:updateData(';
        $tlevelID .= $myQuoteID . htmlEncode(getValue($oRStlevel->fields["ID"])) . $myQuoteID;
        $tlevelID .= ');\'>';
        $tlevelID .= htmlEncode(getValue($oRStlevel->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlevelDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStlevel->fields["Description"])):
        $tlevelDescription = "";
    else:
        $tlevelDescription = htmlEncode(getValue($oRStlevel->fields["Description"]));
endif;
$Seq++;
$oRStlevel->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tlevelAutomaticDetailLink@", $tlevelAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelAutomaticDetailLinkSTYLE@", $tlevelAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDefineSchedules@", $tlevelDefineSchedules);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDefineSchedulesSTYLE@", $tlevelDefineSchedulesSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelCountryID@", $tlevelCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelCountryIDSTYLE@",$tlevelCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelBranchID@", $tlevelBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelBranchIDSTYLE@",$tlevelBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelID@", $tlevelID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelIDSTYLE@",$tlevelIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDescription@", $tlevelDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDescriptionSTYLE@",$tlevelDescriptionSTYLE);           
        endwhile; // of oRStlevel DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlevelAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelAutomaticDetailLinkSTYLE@", $tlevelAutomaticDetailLinkSTYLE);
$tlevelDefineSchedulesSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDefineSchedules@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDefineSchedulesSTYLE@", $tlevelDefineSchedulesSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelCountryID@", "&nbsp;");
$tlevelCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelCountryIDSTYLE@", $tlevelCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelBranchID@", "&nbsp;");
$tlevelBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelBranchIDSTYLE@", $tlevelBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelID@", "&nbsp;");
$tlevelIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelIDSTYLE@", $tlevelIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDescription@", "&nbsp;");
$tlevelDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlevelDescriptionSTYLE@", $tlevelDescriptionSTYLE);
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
global $oRStlevel;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetlevelsearch.php";
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
        $ref .= "<a href=Updatetlevel" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetlevel" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
