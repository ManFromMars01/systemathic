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
$BrowseUnitMeasRowData = "";
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
$tunitmeasAutomaticDetailLink = "";
$tunitmeasAutomaticDetailLinkSTYLE = "";
$tunitmeasCountryIDLABEL = "";
$tunitmeasCountryID = "";
$tunitmeasCountryIDSTYLE = "";
$tunitmeasBranchIDLABEL = "";
$tunitmeasBranchID = "";
$tunitmeasBranchIDSTYLE = "";
$tunitmeasIDLABEL = "";
$tunitmeasID = "";
$tunitmeasIDSTYLE = "";
$tunitmeasDescriptionLABEL = "";
$tunitmeasDescription = "";
$tunitmeasDescriptionSTYLE = "";
$oRStunitmeas = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseUnitMeas#WHR"] = "";
    $_SESSION["BrowseUnitMeas#COL"] = "";
    $_SESSION["BrowseUnitMeas#SRT"] = "";
    $_SESSION["BrowseUnitMeas#PreviousColumn"] = "";
    $_SESSION["BrowseUnitMeas#PreviousSort"] = "";
    $_SESSION["BrowseUnitMeas#mySort"] = "";
    $_SESSION["BrowseUnitMeas#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseUnitMeas#WHR"] = "";
        $_SESSION["BrowseUnitMeas#COL"] = "";
        $_SESSION["BrowseUnitMeas#SRT"] = "";
        $_SESSION["BrowseUnitMeas#PreviousColumn"] = "";
        $_SESSION["BrowseUnitMeas#PreviousSort"] = "";
        $_SESSION["BrowseUnitMeas#mySort"] = "";
        $_SESSION["BrowseUnitMeas#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseUnitMeas#COL"] = "";
            $_SESSION["BrowseUnitMeas#SRT"] = "";
            $_SESSION["BrowseUnitMeas#PreviousColumn"] = "";
            $_SESSION["BrowseUnitMeas#PreviousSort"] = "";
            $_SESSION["BrowseUnitMeas#mySort"] = "";
            $_SESSION["BrowseUnitMeas#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseUnitMeas#PreviousColumn"] = "";
else:
    $_SESSION["BrowseUnitMeas#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseUnitMeas#PreviousSort"] = "";
else:
    $_SESSION["BrowseUnitMeas#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseUnitMeas#COL") == ""):
    if (getRequest("COL") . getSession("BrowseUnitMeas#COL") == ""):
        $_SESSION["BrowseUnitMeas#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.CountryID DESC";
        $_SESSION["BrowseUnitMeas#mySort"] = "DESC";
    else:
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.CountryID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseUnitMeas#PreviousColumn")):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.CountryID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseUnitMeas#COL"] = "CountryID";
    $_SESSION["BrowseUnitMeas#SRT"] = getSession("BrowseUnitMeas#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.BranchID DESC";
        $_SESSION["BrowseUnitMeas#mySort"] = "DESC";
    else:
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.BranchID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseUnitMeas#PreviousColumn")):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.BranchID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseUnitMeas#COL"] = "BranchID";
    $_SESSION["BrowseUnitMeas#SRT"] = getSession("BrowseUnitMeas#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.ID DESC";
        $_SESSION["BrowseUnitMeas#mySort"] = "DESC";
    else:
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.ID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseUnitMeas#PreviousColumn")):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.ID ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseUnitMeas#COL"] = "ID";
    $_SESSION["BrowseUnitMeas#SRT"] = getSession("BrowseUnitMeas#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.Description DESC";
        $_SESSION["BrowseUnitMeas#mySort"] = "DESC";
    else:
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.Description ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseUnitMeas#PreviousColumn")):
        $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.Description ASC";
        $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseUnitMeas#COL"] = "Description";
    $_SESSION["BrowseUnitMeas#SRT"] = getSession("BrowseUnitMeas#mySort");
endif;

$myQuery    = "SELECT tunitmeas.CountryID, tunitmeas.BranchID, tunitmeas.ID, tunitmeas.Description FROM tunitmeas";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseUnitMeas#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseUnitMeas#WHR") != ""):
    $myWhere    = getSession("BrowseUnitMeas#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseUnitMeas#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseUnitMeas#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseUnitMeas#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseUnitMeas#myOrder") == ""):
    $_SESSION["BrowseUnitMeas#myOrder"] = "ORDER BY tunitmeas.CountryID ASC";
    $_SESSION["BrowseUnitMeas#mySort"] = "ASC";
    $_SESSION["BrowseUnitMeas#COL"] = "CountryID";
    $_SESSION["BrowseUnitMeas#SRT"] = getSession("BrowseUnitMeas#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseUnitMeas#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseUnitMeas#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tunitmeas.CountryID) AS MyCount  FROM tunitmeas WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tunitmeas.CountryID) AS MyCount  FROM tunitmeas";
endif;
$oRStunitmeas = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStunitmeas->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStunitmeas->Close();
$oRStunitmeas = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseUnitMeas#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStunitmeas):
    if($oRStunitmeas->EOF != TRUE):
        if($oRStunitmeas->RecordCount() > 0):
            $oRStunitmeas->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseUnitMeas" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseUnitMeasListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStunitmeas->Close();
unset($oRStunitmeas);

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
    $tmpMsg = "<a href='BrowseUnitMeas" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetunitmeas" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseUnitMeasListTemplate($Template)
=============================================================================
*/
function MergeBrowseUnitMeasListTemplate($Template) {
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
        $Template = "./html/BrowseUnitMeaslist.htm";
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
            if ( getSession("BrowseUnitMeas#PreviousColumn") == "CountryID"):
                if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseUnitMeas#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseUnitMeas#COL") == "CountryID" ):
            if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseUnitMeas#PreviousColumn") == "BranchID"):
                if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseUnitMeas#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseUnitMeas#COL") == "BranchID" ):
            if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseUnitMeas#PreviousColumn") == "ID"):
                if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseUnitMeas#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseUnitMeas#COL") == "ID" ):
            if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseUnitMeas#PreviousColumn") == "Description"):
                if (getSession("BrowseUnitMeas#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseUnitMeas#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseUnitMeas#COL") == "Description" ):
            if (getSession("BrowseUnitMeas#SRT") == "ASC"):
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
    global $oRStunitmeas;
    global $RecordsPageSize;
    global $tunitmeasAutomaticDetailLink;
    global $tunitmeasAutomaticDetailLinkSTYLE;
    global $tunitmeasBranchID;
    global $tunitmeasBranchIDLABEL;
    global $tunitmeasBranchIDSTYLE;
    global $tunitmeasCountryID;
    global $tunitmeasCountryIDLABEL;
    global $tunitmeasCountryIDSTYLE;
    global $tunitmeasDescription;
    global $tunitmeasDescriptionLABEL;
    global $tunitmeasDescriptionSTYLE;
    global $tunitmeasID;
    global $tunitmeasIDLABEL;
    global $tunitmeasIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStunitmeas) :
        while ((!$oRStunitmeas->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tunitmeasAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetunitmeasedit.php?ID1=";
                    $tunitmeasAutomaticDetailLink = $myLink;
                      $tunitmeasAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStunitmeas->fields["CountryID"]))) . "'" ;
                    $tunitmeasAutomaticDetailLink .=  "&ID2=" . "'";
                    $tunitmeasAutomaticDetailLink .= htmlEncode(trim(getValue($oRStunitmeas->fields["BranchID"]))) . "'";
                    $tunitmeasAutomaticDetailLink .=  "&ID3=" . "'";
                    $tunitmeasAutomaticDetailLink .= htmlEncode(trim(getValue($oRStunitmeas->fields["ID"]))) . "'";
            $tmpIMG_tunitmeasAutomaticDetailLink = "";
            $tmpIMG_tunitmeasAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tunitmeasAutomaticDetailLink .= "\">" . $tmpIMG_tunitmeasAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tunitmeasCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStunitmeas->fields["CountryID"])):
        $tunitmeasCountryID = "";
    else:
        $tunitmeasCountryID = htmlEncode(getValue($oRStunitmeas->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tunitmeasBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStunitmeas->fields["BranchID"])):
        $tunitmeasBranchID = "";
    else:
        $tunitmeasBranchID = htmlEncode(getValue($oRStunitmeas->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tunitmeasIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStunitmeas->fields["ID"])):
        $tunitmeasID = "";
    else:
        $myQuoteID = "\"";
        $tunitmeasID = '<a href=\'JAVASCRIPT:updateData(';
        $tunitmeasID .= $myQuoteID . htmlEncode(getValue($oRStunitmeas->fields["ID"])) . $myQuoteID;
        $tunitmeasID .= ');\'>';
        $tunitmeasID .= htmlEncode(getValue($oRStunitmeas->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tunitmeasDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStunitmeas->fields["Description"])):
        $tunitmeasDescription = "";
    else:
        $tunitmeasDescription = htmlEncode(getValue($oRStunitmeas->fields["Description"]));
endif;
$Seq++;
$oRStunitmeas->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasAutomaticDetailLink@", $tunitmeasAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasAutomaticDetailLinkSTYLE@", $tunitmeasAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasCountryID@", $tunitmeasCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasCountryIDSTYLE@",$tunitmeasCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasBranchID@", $tunitmeasBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasBranchIDSTYLE@",$tunitmeasBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasID@", $tunitmeasID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasIDSTYLE@",$tunitmeasIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasDescription@", $tunitmeasDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasDescriptionSTYLE@",$tunitmeasDescriptionSTYLE);           
        endwhile; // of oRStunitmeas DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tunitmeasAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasAutomaticDetailLinkSTYLE@", $tunitmeasAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasCountryID@", "&nbsp;");
$tunitmeasCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasCountryIDSTYLE@", $tunitmeasCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasBranchID@", "&nbsp;");
$tunitmeasBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasBranchIDSTYLE@", $tunitmeasBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasID@", "&nbsp;");
$tunitmeasIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasIDSTYLE@", $tunitmeasIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasDescription@", "&nbsp;");
$tunitmeasDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tunitmeasDescriptionSTYLE@", $tunitmeasDescriptionSTYLE);
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
global $oRStunitmeas;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetunitmeassearch.php";
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
        $ref .= "<a href=Updatetunitmeas" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetunitmeas" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
