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
$BrowseReferralRowData = "";
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
$treferralAutomaticDetailLink = "";
$treferralAutomaticDetailLinkSTYLE = "";
$treferralCountryIDLABEL = "";
$treferralCountryID = "";
$treferralCountryIDSTYLE = "";
$treferralBranchIDLABEL = "";
$treferralBranchID = "";
$treferralBranchIDSTYLE = "";
$treferralIDLABEL = "";
$treferralID = "";
$treferralIDSTYLE = "";
$treferralDescriptionLABEL = "";
$treferralDescription = "";
$treferralDescriptionSTYLE = "";
$oRStreferral = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseReferral#WHR"] = "";
    $_SESSION["BrowseReferral#COL"] = "";
    $_SESSION["BrowseReferral#SRT"] = "";
    $_SESSION["BrowseReferral#PreviousColumn"] = "";
    $_SESSION["BrowseReferral#PreviousSort"] = "";
    $_SESSION["BrowseReferral#mySort"] = "";
    $_SESSION["BrowseReferral#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseReferral#WHR"] = "";
        $_SESSION["BrowseReferral#COL"] = "";
        $_SESSION["BrowseReferral#SRT"] = "";
        $_SESSION["BrowseReferral#PreviousColumn"] = "";
        $_SESSION["BrowseReferral#PreviousSort"] = "";
        $_SESSION["BrowseReferral#mySort"] = "";
        $_SESSION["BrowseReferral#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseReferral#COL"] = "";
            $_SESSION["BrowseReferral#SRT"] = "";
            $_SESSION["BrowseReferral#PreviousColumn"] = "";
            $_SESSION["BrowseReferral#PreviousSort"] = "";
            $_SESSION["BrowseReferral#mySort"] = "";
            $_SESSION["BrowseReferral#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseReferral#PreviousColumn"] = "";
else:
    $_SESSION["BrowseReferral#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseReferral#PreviousSort"] = "";
else:
    $_SESSION["BrowseReferral#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseReferral#COL") == ""):
    if (getRequest("COL") . getSession("BrowseReferral#COL") == ""):
        $_SESSION["BrowseReferral#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.CountryID DESC";
        $_SESSION["BrowseReferral#mySort"] = "DESC";
    else:
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.CountryID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseReferral#PreviousColumn")):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.CountryID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseReferral#COL"] = "CountryID";
    $_SESSION["BrowseReferral#SRT"] = getSession("BrowseReferral#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.BranchID DESC";
        $_SESSION["BrowseReferral#mySort"] = "DESC";
    else:
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.BranchID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseReferral#PreviousColumn")):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.BranchID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseReferral#COL"] = "BranchID";
    $_SESSION["BrowseReferral#SRT"] = getSession("BrowseReferral#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.ID DESC";
        $_SESSION["BrowseReferral#mySort"] = "DESC";
    else:
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.ID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseReferral#PreviousColumn")):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.ID ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseReferral#COL"] = "ID";
    $_SESSION["BrowseReferral#SRT"] = getSession("BrowseReferral#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.Description DESC";
        $_SESSION["BrowseReferral#mySort"] = "DESC";
    else:
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.Description ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseReferral#PreviousColumn")):
        $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.Description ASC";
        $_SESSION["BrowseReferral#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseReferral#COL"] = "Description";
    $_SESSION["BrowseReferral#SRT"] = getSession("BrowseReferral#mySort");
endif;

$myQuery    = "SELECT treferral.CountryID, treferral.BranchID, treferral.ID, treferral.Description FROM treferral";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseReferral#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseReferral#WHR") != ""):
    $myWhere    = getSession("BrowseReferral#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseReferral#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseReferral#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseReferral#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseReferral#myOrder") == ""):
    $_SESSION["BrowseReferral#myOrder"] = "ORDER BY treferral.CountryID ASC";
    $_SESSION["BrowseReferral#mySort"] = "ASC";
    $_SESSION["BrowseReferral#COL"] = "CountryID";
    $_SESSION["BrowseReferral#SRT"] = getSession("BrowseReferral#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseReferral#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseReferral#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(treferral.CountryID) AS MyCount  FROM treferral WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(treferral.CountryID) AS MyCount  FROM treferral";
endif;
$oRStreferral = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStreferral->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStreferral->Close();
$oRStreferral = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseReferral#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStreferral):
    if($oRStreferral->EOF != TRUE):
        if($oRStreferral->RecordCount() > 0):
            $oRStreferral->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseReferral" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseReferralListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStreferral->Close();
unset($oRStreferral);

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
    $tmpMsg = "<a href='BrowseReferral" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetreferral" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseReferralListTemplate($Template)
=============================================================================
*/
function MergeBrowseReferralListTemplate($Template) {
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
        $Template = "./html/BrowseReferrallist.htm";
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
            if ( getSession("BrowseReferral#PreviousColumn") == "CountryID"):
                if (getSession("BrowseReferral#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseReferral#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseReferral#COL") == "CountryID" ):
            if (getSession("BrowseReferral#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseReferral#PreviousColumn") == "BranchID"):
                if (getSession("BrowseReferral#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseReferral#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseReferral#COL") == "BranchID" ):
            if (getSession("BrowseReferral#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseReferral#PreviousColumn") == "ID"):
                if (getSession("BrowseReferral#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseReferral#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseReferral#COL") == "ID" ):
            if (getSession("BrowseReferral#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseReferral#PreviousColumn") == "Description"):
                if (getSession("BrowseReferral#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseReferral#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseReferral#COL") == "Description" ):
            if (getSession("BrowseReferral#SRT") == "ASC"):
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
    global $oRStreferral;
    global $RecordsPageSize;
    global $treferralAutomaticDetailLink;
    global $treferralAutomaticDetailLinkSTYLE;
    global $treferralBranchID;
    global $treferralBranchIDLABEL;
    global $treferralBranchIDSTYLE;
    global $treferralCountryID;
    global $treferralCountryIDLABEL;
    global $treferralCountryIDSTYLE;
    global $treferralDescription;
    global $treferralDescriptionLABEL;
    global $treferralDescriptionSTYLE;
    global $treferralID;
    global $treferralIDLABEL;
    global $treferralIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStreferral) :
        while ((!$oRStreferral->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $treferralAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetreferraledit.php?ID1=";
                    $treferralAutomaticDetailLink = $myLink;
                      $treferralAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStreferral->fields["CountryID"]))) . "'" ;
                    $treferralAutomaticDetailLink .=  "&ID2=" . "'";
                    $treferralAutomaticDetailLink .= htmlEncode(trim(getValue($oRStreferral->fields["BranchID"]))) . "'";
                    $treferralAutomaticDetailLink .=  "&ID3=";
                    $treferralAutomaticDetailLink .= htmlEncode(trim(getValue($oRStreferral->fields["ID"])));
            $tmpIMG_treferralAutomaticDetailLink = "";
            $tmpIMG_treferralAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $treferralAutomaticDetailLink .= "\">" . $tmpIMG_treferralAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$treferralCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStreferral->fields["CountryID"])):
        $treferralCountryID = "";
    else:
        $treferralCountryID = htmlEncode(getValue($oRStreferral->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$treferralBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStreferral->fields["BranchID"])):
        $treferralBranchID = "";
    else:
        $treferralBranchID = htmlEncode(getValue($oRStreferral->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$treferralIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStreferral->fields["ID"])):
        $treferralID = "";
    else:
        $myQuoteID = "";
        $treferralID = '<a href=\'JAVASCRIPT:updateData(';
        $treferralID .= $myQuoteID . htmlEncode(getValue($oRStreferral->fields["ID"])) . $myQuoteID;
        $treferralID .= ');\'>';
        $treferralID .= htmlEncode(getValue($oRStreferral->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$treferralDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStreferral->fields["Description"])):
        $treferralDescription = "";
    else:
        $treferralDescription = htmlEncode(getValue($oRStreferral->fields["Description"]));
endif;
$Seq++;
$oRStreferral->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@treferralAutomaticDetailLink@", $treferralAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralAutomaticDetailLinkSTYLE@", $treferralAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralCountryID@", $treferralCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@treferralCountryIDSTYLE@",$treferralCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@treferralBranchID@", $treferralBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@treferralBranchIDSTYLE@",$treferralBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@treferralID@", $treferralID);       
$DataRowFilledText = Replace($DataRowFilledText,"@treferralIDSTYLE@",$treferralIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@treferralDescription@", $treferralDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@treferralDescriptionSTYLE@",$treferralDescriptionSTYLE);           
        endwhile; // of oRStreferral DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$treferralAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@treferralAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@treferralAutomaticDetailLinkSTYLE@", $treferralAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralCountryID@", "&nbsp;");
$treferralCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@treferralCountryIDSTYLE@", $treferralCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralBranchID@", "&nbsp;");
$treferralBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@treferralBranchIDSTYLE@", $treferralBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralID@", "&nbsp;");
$treferralIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@treferralIDSTYLE@", $treferralIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@treferralDescription@", "&nbsp;");
$treferralDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@treferralDescriptionSTYLE@", $treferralDescriptionSTYLE);
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
global $oRStreferral;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetreferralsearch.php";
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
        $ref .= "<a href=Updatetreferral" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetreferral" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
