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
$BrowseTierRowData = "";
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
$ttierAutomaticDetailLink = "";
$ttierAutomaticDetailLinkSTYLE = "";
$ttierCountryIDLABEL = "";
$ttierCountryID = "";
$ttierCountryIDSTYLE = "";
$ttierBranchIDLABEL = "";
$ttierBranchID = "";
$ttierBranchIDSTYLE = "";
$ttierIDLABEL = "";
$ttierID = "";
$ttierIDSTYLE = "";
$ttierDescriptionLABEL = "";
$ttierDescription = "";
$ttierDescriptionSTYLE = "";
$oRSttier = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTier#WHR"] = "";
    $_SESSION["BrowseTier#COL"] = "";
    $_SESSION["BrowseTier#SRT"] = "";
    $_SESSION["BrowseTier#PreviousColumn"] = "";
    $_SESSION["BrowseTier#PreviousSort"] = "";
    $_SESSION["BrowseTier#mySort"] = "";
    $_SESSION["BrowseTier#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTier#WHR"] = "";
        $_SESSION["BrowseTier#COL"] = "";
        $_SESSION["BrowseTier#SRT"] = "";
        $_SESSION["BrowseTier#PreviousColumn"] = "";
        $_SESSION["BrowseTier#PreviousSort"] = "";
        $_SESSION["BrowseTier#mySort"] = "";
        $_SESSION["BrowseTier#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTier#COL"] = "";
            $_SESSION["BrowseTier#SRT"] = "";
            $_SESSION["BrowseTier#PreviousColumn"] = "";
            $_SESSION["BrowseTier#PreviousSort"] = "";
            $_SESSION["BrowseTier#mySort"] = "";
            $_SESSION["BrowseTier#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTier#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTier#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTier#PreviousSort"] = "";
else:
    $_SESSION["BrowseTier#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTier#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTier#COL") == ""):
        $_SESSION["BrowseTier#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.CountryID DESC";
        $_SESSION["BrowseTier#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.CountryID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTier#PreviousColumn")):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.CountryID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTier#COL"] = "CountryID";
    $_SESSION["BrowseTier#SRT"] = getSession("BrowseTier#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.BranchID DESC";
        $_SESSION["BrowseTier#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.BranchID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTier#PreviousColumn")):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.BranchID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTier#COL"] = "BranchID";
    $_SESSION["BrowseTier#SRT"] = getSession("BrowseTier#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.ID DESC";
        $_SESSION["BrowseTier#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.ID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTier#PreviousColumn")):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.ID ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTier#COL"] = "ID";
    $_SESSION["BrowseTier#SRT"] = getSession("BrowseTier#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.Description DESC";
        $_SESSION["BrowseTier#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.Description ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTier#PreviousColumn")):
        $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.Description ASC";
        $_SESSION["BrowseTier#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTier#COL"] = "Description";
    $_SESSION["BrowseTier#SRT"] = getSession("BrowseTier#mySort");
endif;

$myQuery    = "SELECT ttier.CountryID, ttier.BranchID, ttier.ID, ttier.Description FROM ttier";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTier#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTier#WHR") != ""):
    $myWhere    = getSession("BrowseTier#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTier#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTier#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTier#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTier#myOrder") == ""):
    $_SESSION["BrowseTier#myOrder"] = "ORDER BY ttier.CountryID ASC";
    $_SESSION["BrowseTier#mySort"] = "ASC";
    $_SESSION["BrowseTier#COL"] = "CountryID";
    $_SESSION["BrowseTier#SRT"] = getSession("BrowseTier#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTier#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTier#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(ttier.CountryID) AS MyCount  FROM ttier WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(ttier.CountryID) AS MyCount  FROM ttier";
endif;
$oRSttier = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSttier->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSttier->Close();
$oRSttier = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTier#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSttier):
    if($oRSttier->EOF != TRUE):
        if($oRSttier->RecordCount() > 0):
            $oRSttier->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTier" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTierListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSttier->Close();
unset($oRSttier);

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
    $tmpMsg = "<a href='BrowseTier" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatettier" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTierListTemplate($Template)
=============================================================================
*/
function MergeBrowseTierListTemplate($Template) {
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
        $Template = "./html/BrowseTierlist.htm";
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
            if ( getSession("BrowseTier#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTier#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTier#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTier#COL") == "CountryID" ):
            if (getSession("BrowseTier#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTier#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTier#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTier#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTier#COL") == "BranchID" ):
            if (getSession("BrowseTier#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseTier#PreviousColumn") == "ID"):
                if (getSession("BrowseTier#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTier#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseTier#COL") == "ID" ):
            if (getSession("BrowseTier#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTier#PreviousColumn") == "Description"):
                if (getSession("BrowseTier#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTier#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTier#COL") == "Description" ):
            if (getSession("BrowseTier#SRT") == "ASC"):
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
    global $oRSttier;
    global $RecordsPageSize;
    global $ttierAutomaticDetailLink;
    global $ttierAutomaticDetailLinkSTYLE;
    global $ttierBranchID;
    global $ttierBranchIDLABEL;
    global $ttierBranchIDSTYLE;
    global $ttierCountryID;
    global $ttierCountryIDLABEL;
    global $ttierCountryIDSTYLE;
    global $ttierDescription;
    global $ttierDescriptionLABEL;
    global $ttierDescriptionSTYLE;
    global $ttierID;
    global $ttierIDLABEL;
    global $ttierIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRSttier) :
        while ((!$oRSttier->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $ttierAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatettieredit.php?ID1=";
                    $ttierAutomaticDetailLink = $myLink;
                      $ttierAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSttier->fields["CountryID"]))) . "'" ;
                    $ttierAutomaticDetailLink .=  "&ID2=" . "'";
                    $ttierAutomaticDetailLink .= htmlEncode(trim(getValue($oRSttier->fields["BranchID"]))) . "'";
                    $ttierAutomaticDetailLink .=  "&ID3=";
                    $ttierAutomaticDetailLink .= htmlEncode(trim(getValue($oRSttier->fields["ID"])));
            $tmpIMG_ttierAutomaticDetailLink = "";
            $tmpIMG_ttierAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $ttierAutomaticDetailLink .= "\">" . $tmpIMG_ttierAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttierCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttier->fields["CountryID"])):
        $ttierCountryID = "";
    else:
        $ttierCountryID = htmlEncode(getValue($oRSttier->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttierBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttier->fields["BranchID"])):
        $ttierBranchID = "";
    else:
        $ttierBranchID = htmlEncode(getValue($oRSttier->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttierIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSttier->fields["ID"])):
        $ttierID = "";
    else:
        $myQuoteID = "";
        $ttierID = '<a href=\'JAVASCRIPT:updateData(';
        $ttierID .= $myQuoteID . htmlEncode(getValue($oRSttier->fields["ID"])) . $myQuoteID;
        $ttierID .= ');\'>';
        $ttierID .= htmlEncode(getValue($oRSttier->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttierDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRSttier->fields["Description"])):
        $ttierDescription = "";
    else:
        $ttierDescription = htmlEncode(getValue($oRSttier->fields["Description"]));
endif;
$Seq++;
$oRSttier->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@ttierAutomaticDetailLink@", $ttierAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierAutomaticDetailLinkSTYLE@", $ttierAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierCountryID@", $ttierCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttierCountryIDSTYLE@",$ttierCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttierBranchID@", $ttierBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttierBranchIDSTYLE@",$ttierBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttierID@", $ttierID);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttierIDSTYLE@",$ttierIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@ttierDescription@", $ttierDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@ttierDescriptionSTYLE@",$ttierDescriptionSTYLE);           
        endwhile; // of oRSttier DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$ttierAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttierAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@ttierAutomaticDetailLinkSTYLE@", $ttierAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierCountryID@", "&nbsp;");
$ttierCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttierCountryIDSTYLE@", $ttierCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierBranchID@", "&nbsp;");
$ttierBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttierBranchIDSTYLE@", $ttierBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierID@", "&nbsp;");
$ttierIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttierIDSTYLE@", $ttierIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@ttierDescription@", "&nbsp;");
$ttierDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@ttierDescriptionSTYLE@", $ttierDescriptionSTYLE);
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
global $oRSttier;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatettiersearch.php";
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
        $ref .= "<a href=Updatettier" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatettier" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
