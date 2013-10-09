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
$BrowseSeminarRowData = "";
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
$tseminarAutomaticDetailLink = "";
$tseminarAutomaticDetailLinkSTYLE = "";
$tseminarCountryIDLABEL = "";
$tseminarCountryID = "";
$tseminarCountryIDSTYLE = "";
$tseminarBranchIDLABEL = "";
$tseminarBranchID = "";
$tseminarBranchIDSTYLE = "";
$tseminarIDLABEL = "";
$tseminarID = "";
$tseminarIDSTYLE = "";
$tseminarDescriptionLABEL = "";
$tseminarDescription = "";
$tseminarDescriptionSTYLE = "";
$oRStseminar = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseSeminar#WHR"] = "";
    $_SESSION["BrowseSeminar#COL"] = "";
    $_SESSION["BrowseSeminar#SRT"] = "";
    $_SESSION["BrowseSeminar#PreviousColumn"] = "";
    $_SESSION["BrowseSeminar#PreviousSort"] = "";
    $_SESSION["BrowseSeminar#mySort"] = "";
    $_SESSION["BrowseSeminar#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseSeminar#WHR"] = "";
        $_SESSION["BrowseSeminar#COL"] = "";
        $_SESSION["BrowseSeminar#SRT"] = "";
        $_SESSION["BrowseSeminar#PreviousColumn"] = "";
        $_SESSION["BrowseSeminar#PreviousSort"] = "";
        $_SESSION["BrowseSeminar#mySort"] = "";
        $_SESSION["BrowseSeminar#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseSeminar#COL"] = "";
            $_SESSION["BrowseSeminar#SRT"] = "";
            $_SESSION["BrowseSeminar#PreviousColumn"] = "";
            $_SESSION["BrowseSeminar#PreviousSort"] = "";
            $_SESSION["BrowseSeminar#mySort"] = "";
            $_SESSION["BrowseSeminar#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseSeminar#PreviousColumn"] = "";
else:
    $_SESSION["BrowseSeminar#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseSeminar#PreviousSort"] = "";
else:
    $_SESSION["BrowseSeminar#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseSeminar#COL") == ""):
    if (getRequest("COL") . getSession("BrowseSeminar#COL") == ""):
        $_SESSION["BrowseSeminar#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.CountryID DESC";
        $_SESSION["BrowseSeminar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.CountryID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSeminar#PreviousColumn")):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.CountryID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSeminar#COL"] = "CountryID";
    $_SESSION["BrowseSeminar#SRT"] = getSession("BrowseSeminar#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.BranchID DESC";
        $_SESSION["BrowseSeminar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.BranchID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSeminar#PreviousColumn")):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.BranchID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSeminar#COL"] = "BranchID";
    $_SESSION["BrowseSeminar#SRT"] = getSession("BrowseSeminar#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.ID DESC";
        $_SESSION["BrowseSeminar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.ID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSeminar#PreviousColumn")):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.ID ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSeminar#COL"] = "ID";
    $_SESSION["BrowseSeminar#SRT"] = getSession("BrowseSeminar#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.Description DESC";
        $_SESSION["BrowseSeminar#mySort"] = "DESC";
    else:
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.Description ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseSeminar#PreviousColumn")):
        $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.Description ASC";
        $_SESSION["BrowseSeminar#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseSeminar#COL"] = "Description";
    $_SESSION["BrowseSeminar#SRT"] = getSession("BrowseSeminar#mySort");
endif;

$myQuery    = "SELECT tseminar.CountryID, tseminar.BranchID, tseminar.ID, tseminar.Description FROM tseminar";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseSeminar#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseSeminar#WHR") != ""):
    $myWhere    = getSession("BrowseSeminar#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSeminar#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseSeminar#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseSeminar#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseSeminar#myOrder") == ""):
    $_SESSION["BrowseSeminar#myOrder"] = "ORDER BY tseminar.CountryID ASC";
    $_SESSION["BrowseSeminar#mySort"] = "ASC";
    $_SESSION["BrowseSeminar#COL"] = "CountryID";
    $_SESSION["BrowseSeminar#SRT"] = getSession("BrowseSeminar#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseSeminar#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseSeminar#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tseminar.CountryID) AS MyCount  FROM tseminar WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tseminar.CountryID) AS MyCount  FROM tseminar";
endif;
$oRStseminar = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStseminar->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStseminar->Close();
$oRStseminar = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseSeminar#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStseminar):
    if($oRStseminar->EOF != TRUE):
        if($oRStseminar->RecordCount() > 0):
            $oRStseminar->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseSeminar" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseSeminarListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStseminar->Close();
unset($oRStseminar);

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
    $tmpMsg = "<a href='BrowseSeminar" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetseminar" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseSeminarListTemplate($Template)
=============================================================================
*/
function MergeBrowseSeminarListTemplate($Template) {
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
        $Template = "./html/BrowseSeminarlist.htm";
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
            if ( getSession("BrowseSeminar#PreviousColumn") == "CountryID"):
                if (getSession("BrowseSeminar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSeminar#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseSeminar#COL") == "CountryID" ):
            if (getSession("BrowseSeminar#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseSeminar#PreviousColumn") == "BranchID"):
                if (getSession("BrowseSeminar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSeminar#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseSeminar#COL") == "BranchID" ):
            if (getSession("BrowseSeminar#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseSeminar#PreviousColumn") == "ID"):
                if (getSession("BrowseSeminar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSeminar#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseSeminar#COL") == "ID" ):
            if (getSession("BrowseSeminar#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseSeminar#PreviousColumn") == "Description"):
                if (getSession("BrowseSeminar#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseSeminar#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseSeminar#COL") == "Description" ):
            if (getSession("BrowseSeminar#SRT") == "ASC"):
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
    global $oRStseminar;
    global $RecordsPageSize;
    global $tseminarAutomaticDetailLink;
    global $tseminarAutomaticDetailLinkSTYLE;
    global $tseminarBranchID;
    global $tseminarBranchIDLABEL;
    global $tseminarBranchIDSTYLE;
    global $tseminarCountryID;
    global $tseminarCountryIDLABEL;
    global $tseminarCountryIDSTYLE;
    global $tseminarDescription;
    global $tseminarDescriptionLABEL;
    global $tseminarDescriptionSTYLE;
    global $tseminarID;
    global $tseminarIDLABEL;
    global $tseminarIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStseminar) :
        while ((!$oRStseminar->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tseminarAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetseminaredit.php?ID1=";
                    $tseminarAutomaticDetailLink = $myLink;
                      $tseminarAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStseminar->fields["CountryID"]))) . "'" ;
                    $tseminarAutomaticDetailLink .=  "&ID2=" . "'";
                    $tseminarAutomaticDetailLink .= htmlEncode(trim(getValue($oRStseminar->fields["BranchID"]))) . "'";
                    $tseminarAutomaticDetailLink .=  "&ID3=";
                    $tseminarAutomaticDetailLink .= htmlEncode(trim(getValue($oRStseminar->fields["ID"])));
            $tmpIMG_tseminarAutomaticDetailLink = "";
            $tmpIMG_tseminarAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tseminarAutomaticDetailLink .= "\">" . $tmpIMG_tseminarAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tseminarCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStseminar->fields["CountryID"])):
        $tseminarCountryID = "";
    else:
        $tseminarCountryID = htmlEncode(getValue($oRStseminar->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tseminarBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStseminar->fields["BranchID"])):
        $tseminarBranchID = "";
    else:
        $tseminarBranchID = htmlEncode(getValue($oRStseminar->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tseminarIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStseminar->fields["ID"])):
        $tseminarID = "";
    else:
        $tseminarID = htmlEncode(getValue($oRStseminar->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tseminarDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStseminar->fields["Description"])):
        $tseminarDescription = "";
    else:
        $tseminarDescription = htmlEncode(getValue($oRStseminar->fields["Description"]));
endif;
$Seq++;
$oRStseminar->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tseminarAutomaticDetailLink@", $tseminarAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarAutomaticDetailLinkSTYLE@", $tseminarAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarCountryID@", $tseminarCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarCountryIDSTYLE@",$tseminarCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarBranchID@", $tseminarBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarBranchIDSTYLE@",$tseminarBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarID@", $tseminarID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarIDSTYLE@",$tseminarIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarDescription@", $tseminarDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarDescriptionSTYLE@",$tseminarDescriptionSTYLE);           
        endwhile; // of oRStseminar DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tseminarAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarAutomaticDetailLinkSTYLE@", $tseminarAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarCountryID@", "&nbsp;");
$tseminarCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarCountryIDSTYLE@", $tseminarCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarBranchID@", "&nbsp;");
$tseminarBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarBranchIDSTYLE@", $tseminarBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarID@", "&nbsp;");
$tseminarIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarIDSTYLE@", $tseminarIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarDescription@", "&nbsp;");
$tseminarDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tseminarDescriptionSTYLE@", $tseminarDescriptionSTYLE);
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
global $oRStseminar;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetseminarsearch.php";
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
        $ref .= "<a href=Updatetseminar" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetseminar" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
