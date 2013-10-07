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
$BrowseRoomRowData = "";
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
$troomAutomaticDetailLink = "";
$troomAutomaticDetailLinkSTYLE = "";
$troomCountryIDLABEL = "";
$troomCountryID = "";
$troomCountryIDSTYLE = "";
$troomBranchIDLABEL = "";
$troomBranchID = "";
$troomBranchIDSTYLE = "";
$troomIDLABEL = "";
$troomID = "";
$troomIDSTYLE = "";
$troomDescriptionLABEL = "";
$troomDescription = "";
$troomDescriptionSTYLE = "";
$troomTotalSeatLABEL = "";
$troomTotalSeat = "";
$troomTotalSeatSTYLE = "";
$oRStroom = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseRoom#WHR"] = "";
    $_SESSION["BrowseRoom#COL"] = "";
    $_SESSION["BrowseRoom#SRT"] = "";
    $_SESSION["BrowseRoom#PreviousColumn"] = "";
    $_SESSION["BrowseRoom#PreviousSort"] = "";
    $_SESSION["BrowseRoom#mySort"] = "";
    $_SESSION["BrowseRoom#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseRoom#WHR"] = "";
        $_SESSION["BrowseRoom#COL"] = "";
        $_SESSION["BrowseRoom#SRT"] = "";
        $_SESSION["BrowseRoom#PreviousColumn"] = "";
        $_SESSION["BrowseRoom#PreviousSort"] = "";
        $_SESSION["BrowseRoom#mySort"] = "";
        $_SESSION["BrowseRoom#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseRoom#COL"] = "";
            $_SESSION["BrowseRoom#SRT"] = "";
            $_SESSION["BrowseRoom#PreviousColumn"] = "";
            $_SESSION["BrowseRoom#PreviousSort"] = "";
            $_SESSION["BrowseRoom#mySort"] = "";
            $_SESSION["BrowseRoom#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseRoom#PreviousColumn"] = "";
else:
    $_SESSION["BrowseRoom#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseRoom#PreviousSort"] = "";
else:
    $_SESSION["BrowseRoom#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseRoom#COL") == ""):
    if (getRequest("COL") . getSession("BrowseRoom#COL") == ""):
        $_SESSION["BrowseRoom#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.CountryID DESC";
        $_SESSION["BrowseRoom#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.CountryID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoom#PreviousColumn")):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.CountryID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoom#COL"] = "CountryID";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.BranchID DESC";
        $_SESSION["BrowseRoom#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.BranchID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoom#PreviousColumn")):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.BranchID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoom#COL"] = "BranchID";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.ID DESC";
        $_SESSION["BrowseRoom#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.ID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoom#PreviousColumn")):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.ID ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoom#COL"] = "ID";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.Description DESC";
        $_SESSION["BrowseRoom#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.Description ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoom#PreviousColumn")):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.Description ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoom#COL"] = "Description";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

if (getRequest("COL") == "TotalSeat"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.TotalSeat DESC";
        $_SESSION["BrowseRoom#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.TotalSeat ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRoom#PreviousColumn")):
        $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.TotalSeat ASC";
        $_SESSION["BrowseRoom#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRoom#COL"] = "TotalSeat";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

$myQuery    = "SELECT troom.CountryID, troom.BranchID, troom.ID, troom.Description, troom.TotalSeat FROM troom";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseRoom#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseRoom#WHR") != ""):
    $myWhere    = getSession("BrowseRoom#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRoom#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseRoom#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseRoom#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseRoom#myOrder") == ""):
    $_SESSION["BrowseRoom#myOrder"] = "ORDER BY troom.CountryID ASC";
    $_SESSION["BrowseRoom#mySort"] = "ASC";
    $_SESSION["BrowseRoom#COL"] = "CountryID";
    $_SESSION["BrowseRoom#SRT"] = getSession("BrowseRoom#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseRoom#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseRoom#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(troom.CountryID) AS MyCount  FROM troom WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(troom.CountryID) AS MyCount  FROM troom";
endif;
$oRStroom = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStroom->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStroom->Close();
$oRStroom = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRoom#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStroom):
    if($oRStroom->EOF != TRUE):
        if($oRStroom->RecordCount() > 0):
            $oRStroom->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseRoom" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseRoomListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStroom->Close();
unset($oRStroom);

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
    $tmpMsg = "<a href='BrowseRoom" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetroom" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseRoomListTemplate($Template)
=============================================================================
*/
function MergeBrowseRoomListTemplate($Template) {
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
        $Template = "./html/BrowseRoomlist.htm";
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
            if ( getSession("BrowseRoom#PreviousColumn") == "CountryID"):
                if (getSession("BrowseRoom#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoom#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseRoom#COL") == "CountryID" ):
            if (getSession("BrowseRoom#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseRoom#PreviousColumn") == "BranchID"):
                if (getSession("BrowseRoom#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoom#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseRoom#COL") == "BranchID" ):
            if (getSession("BrowseRoom#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseRoom#PreviousColumn") == "ID"):
                if (getSession("BrowseRoom#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoom#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseRoom#COL") == "ID" ):
            if (getSession("BrowseRoom#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseRoom#PreviousColumn") == "Description"):
                if (getSession("BrowseRoom#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoom#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseRoom#COL") == "Description" ):
            if (getSession("BrowseRoom#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=TotalSeat";
            if ( getSession("BrowseRoom#PreviousColumn") == "TotalSeat"):
                if (getSession("BrowseRoom#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRoom#COL") == "TotalSeat"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Total Seat</a>";
        $TotalSeatLABEL = $myLink;
        if ( getGet("COL") == "TotalSeat" || getSession("BrowseRoom#COL") == "TotalSeat" ):
            if (getSession("BrowseRoom#SRT") == "ASC"):
                $TotalSeatLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $TotalSeatLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@TotalSeatLABEL@", $TotalSeatLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStroom;
    global $RecordsPageSize;
    global $troomAutomaticDetailLink;
    global $troomAutomaticDetailLinkSTYLE;
    global $troomBranchID;
    global $troomBranchIDLABEL;
    global $troomBranchIDSTYLE;
    global $troomCountryID;
    global $troomCountryIDLABEL;
    global $troomCountryIDSTYLE;
    global $troomDescription;
    global $troomDescriptionLABEL;
    global $troomDescriptionSTYLE;
    global $troomID;
    global $troomIDLABEL;
    global $troomIDSTYLE;
    global $troomTotalSeat;
    global $troomTotalSeatLABEL;
    global $troomTotalSeatSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStroom) :
        while ((!$oRStroom->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $troomAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetroomedit.php?ID1=";
                    $troomAutomaticDetailLink = $myLink;
                      $troomAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStroom->fields["CountryID"]))) . "'" ;
                    $troomAutomaticDetailLink .=  "&ID2=" . "'";
                    $troomAutomaticDetailLink .= htmlEncode(trim(getValue($oRStroom->fields["BranchID"]))) . "'";
                    $troomAutomaticDetailLink .=  "&ID3=";
                    $troomAutomaticDetailLink .= htmlEncode(trim(getValue($oRStroom->fields["ID"])));
            $tmpIMG_troomAutomaticDetailLink = "";
            $tmpIMG_troomAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $troomAutomaticDetailLink .= "\">" . $tmpIMG_troomAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroom->fields["CountryID"])):
        $troomCountryID = "";
    else:
        $troomCountryID = htmlEncode(getValue($oRStroom->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroom->fields["BranchID"])):
        $troomBranchID = "";
    else:
        $troomBranchID = htmlEncode(getValue($oRStroom->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStroom->fields["ID"])):
        $troomID = "";
    else:
        $myQuoteID = "";
        $troomID = '<a href=\'JAVASCRIPT:updateData(';
        $troomID .= $myQuoteID . htmlEncode(getValue($oRStroom->fields["ID"])) . $myQuoteID;
        $troomID .= ');\'>';
        $troomID .= htmlEncode(getValue($oRStroom->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStroom->fields["Description"])):
        $troomDescription = "";
    else:
        $troomDescription = htmlEncode(getValue($oRStroom->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomTotalSeatSTYLE = "TableRow" . $Style;
    if (is_null($oRStroom->fields["TotalSeat"])):
        $troomTotalSeat = "";
    else:
        $troomTotalSeat = htmlEncode(getValue($oRStroom->fields["TotalSeat"]));
endif;
$Seq++;
$oRStroom->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@troomAutomaticDetailLink@", $troomAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@troomAutomaticDetailLinkSTYLE@", $troomAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomCountryID@", $troomCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troomCountryIDSTYLE@",$troomCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troomBranchID@", $troomBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troomBranchIDSTYLE@",$troomBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troomID@", $troomID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troomIDSTYLE@",$troomIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troomDescription@", $troomDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@troomDescriptionSTYLE@",$troomDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troomTotalSeat@", $troomTotalSeat);       
$DataRowFilledText = Replace($DataRowFilledText,"@troomTotalSeatSTYLE@",$troomTotalSeatSTYLE);           
        endwhile; // of oRStroom DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troomAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@troomAutomaticDetailLinkSTYLE@", $troomAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomCountryID@", "&nbsp;");
$troomCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomCountryIDSTYLE@", $troomCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomBranchID@", "&nbsp;");
$troomBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomBranchIDSTYLE@", $troomBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomID@", "&nbsp;");
$troomIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomIDSTYLE@", $troomIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomDescription@", "&nbsp;");
$troomDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomDescriptionSTYLE@", $troomDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troomTotalSeat@", "&nbsp;");
$troomTotalSeatSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troomTotalSeatSTYLE@", $troomTotalSeatSTYLE);
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
global $oRStroom;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetroomsearch.php";
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
        $ref .= "<a href=Updatetroom" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetroom" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
