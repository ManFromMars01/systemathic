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
$BrowseLocationRowData = "";
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
$tlocationAutomaticDetailLink = "";
$tlocationAutomaticDetailLinkSTYLE = "";
$tlocationCountryIDLABEL = "";
$tlocationCountryID = "";
$tlocationCountryIDSTYLE = "";
$tlocationBranchIDLABEL = "";
$tlocationBranchID = "";
$tlocationBranchIDSTYLE = "";
$tlocationIDLABEL = "";
$tlocationID = "";
$tlocationIDSTYLE = "";
$tlocationDescriptionLABEL = "";
$tlocationDescription = "";
$tlocationDescriptionSTYLE = "";
$oRStlocation = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseLocation#WHR"] = "";
    $_SESSION["BrowseLocation#COL"] = "";
    $_SESSION["BrowseLocation#SRT"] = "";
    $_SESSION["BrowseLocation#PreviousColumn"] = "";
    $_SESSION["BrowseLocation#PreviousSort"] = "";
    $_SESSION["BrowseLocation#mySort"] = "";
    $_SESSION["BrowseLocation#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseLocation#WHR"] = "";
        $_SESSION["BrowseLocation#COL"] = "";
        $_SESSION["BrowseLocation#SRT"] = "";
        $_SESSION["BrowseLocation#PreviousColumn"] = "";
        $_SESSION["BrowseLocation#PreviousSort"] = "";
        $_SESSION["BrowseLocation#mySort"] = "";
        $_SESSION["BrowseLocation#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseLocation#COL"] = "";
            $_SESSION["BrowseLocation#SRT"] = "";
            $_SESSION["BrowseLocation#PreviousColumn"] = "";
            $_SESSION["BrowseLocation#PreviousSort"] = "";
            $_SESSION["BrowseLocation#mySort"] = "";
            $_SESSION["BrowseLocation#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseLocation#PreviousColumn"] = "";
else:
    $_SESSION["BrowseLocation#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseLocation#PreviousSort"] = "";
else:
    $_SESSION["BrowseLocation#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseLocation#COL") == ""):
    if (getRequest("COL") . getSession("BrowseLocation#COL") == ""):
        $_SESSION["BrowseLocation#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.CountryID DESC";
        $_SESSION["BrowseLocation#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.CountryID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLocation#PreviousColumn")):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.CountryID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLocation#COL"] = "CountryID";
    $_SESSION["BrowseLocation#SRT"] = getSession("BrowseLocation#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.BranchID DESC";
        $_SESSION["BrowseLocation#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.BranchID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLocation#PreviousColumn")):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.BranchID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLocation#COL"] = "BranchID";
    $_SESSION["BrowseLocation#SRT"] = getSession("BrowseLocation#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.ID DESC";
        $_SESSION["BrowseLocation#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.ID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLocation#PreviousColumn")):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.ID ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLocation#COL"] = "ID";
    $_SESSION["BrowseLocation#SRT"] = getSession("BrowseLocation#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.Description DESC";
        $_SESSION["BrowseLocation#mySort"] = "DESC";
    else:
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.Description ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseLocation#PreviousColumn")):
        $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.Description ASC";
        $_SESSION["BrowseLocation#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseLocation#COL"] = "Description";
    $_SESSION["BrowseLocation#SRT"] = getSession("BrowseLocation#mySort");
endif;

$myQuery    = "SELECT tlocation.CountryID, tlocation.BranchID, tlocation.ID, tlocation.Description FROM tlocation";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseLocation#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseLocation#WHR") != ""):
    $myWhere    = getSession("BrowseLocation#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseLocation#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseLocation#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseLocation#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseLocation#myOrder") == ""):
    $_SESSION["BrowseLocation#myOrder"] = "ORDER BY tlocation.CountryID ASC";
    $_SESSION["BrowseLocation#mySort"] = "ASC";
    $_SESSION["BrowseLocation#COL"] = "CountryID";
    $_SESSION["BrowseLocation#SRT"] = getSession("BrowseLocation#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseLocation#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseLocation#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tlocation.CountryID) AS MyCount  FROM tlocation WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tlocation.CountryID) AS MyCount  FROM tlocation";
endif;
$oRStlocation = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStlocation->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStlocation->Close();
$oRStlocation = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseLocation#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStlocation):
    if($oRStlocation->EOF != TRUE):
        if($oRStlocation->RecordCount() > 0):
            $oRStlocation->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseLocation" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseLocationListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStlocation->Close();
unset($oRStlocation);

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
    $tmpMsg = "<a href='BrowseLocation" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetlocation" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseLocationListTemplate($Template)
=============================================================================
*/
function MergeBrowseLocationListTemplate($Template) {
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
        $Template = "./html/BrowseLocationlist.htm";
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
            if ( getSession("BrowseLocation#PreviousColumn") == "CountryID"):
                if (getSession("BrowseLocation#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLocation#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseLocation#COL") == "CountryID" ):
            if (getSession("BrowseLocation#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseLocation#PreviousColumn") == "BranchID"):
                if (getSession("BrowseLocation#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLocation#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseLocation#COL") == "BranchID" ):
            if (getSession("BrowseLocation#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseLocation#PreviousColumn") == "ID"):
                if (getSession("BrowseLocation#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLocation#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseLocation#COL") == "ID" ):
            if (getSession("BrowseLocation#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseLocation#PreviousColumn") == "Description"):
                if (getSession("BrowseLocation#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseLocation#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseLocation#COL") == "Description" ):
            if (getSession("BrowseLocation#SRT") == "ASC"):
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
    global $oRStlocation;
    global $RecordsPageSize;
    global $tlocationAutomaticDetailLink;
    global $tlocationAutomaticDetailLinkSTYLE;
    global $tlocationBranchID;
    global $tlocationBranchIDLABEL;
    global $tlocationBranchIDSTYLE;
    global $tlocationCountryID;
    global $tlocationCountryIDLABEL;
    global $tlocationCountryIDSTYLE;
    global $tlocationDescription;
    global $tlocationDescriptionLABEL;
    global $tlocationDescriptionSTYLE;
    global $tlocationID;
    global $tlocationIDLABEL;
    global $tlocationIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStlocation) :
        while ((!$oRStlocation->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tlocationAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetlocationedit.php?ID1=";
                    $tlocationAutomaticDetailLink = $myLink;
                      $tlocationAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStlocation->fields["CountryID"]))) . "'" ;
                    $tlocationAutomaticDetailLink .=  "&ID2=" . "'";
                    $tlocationAutomaticDetailLink .= htmlEncode(trim(getValue($oRStlocation->fields["BranchID"]))) . "'";
                    $tlocationAutomaticDetailLink .=  "&ID3=";
                    $tlocationAutomaticDetailLink .= htmlEncode(trim(getValue($oRStlocation->fields["ID"])));
            $tmpIMG_tlocationAutomaticDetailLink = "";
            $tmpIMG_tlocationAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tlocationAutomaticDetailLink .= "\">" . $tmpIMG_tlocationAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlocationCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlocation->fields["CountryID"])):
        $tlocationCountryID = "";
    else:
        $tlocationCountryID = htmlEncode(getValue($oRStlocation->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlocationBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlocation->fields["BranchID"])):
        $tlocationBranchID = "";
    else:
        $tlocationBranchID = htmlEncode(getValue($oRStlocation->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlocationIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStlocation->fields["ID"])):
        $tlocationID = "";
    else:
        $myQuoteID = "";
        $tlocationID = '<a href=\'JAVASCRIPT:updateData(';
        $tlocationID .= $myQuoteID . htmlEncode(getValue($oRStlocation->fields["ID"])) . $myQuoteID;
        $tlocationID .= ');\'>';
        $tlocationID .= htmlEncode(getValue($oRStlocation->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlocationDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStlocation->fields["Description"])):
        $tlocationDescription = "";
    else:
        $tlocationDescription = htmlEncode(getValue($oRStlocation->fields["Description"]));
endif;
$Seq++;
$oRStlocation->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tlocationAutomaticDetailLink@", $tlocationAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationAutomaticDetailLinkSTYLE@", $tlocationAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationCountryID@", $tlocationCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationCountryIDSTYLE@",$tlocationCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationBranchID@", $tlocationBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationBranchIDSTYLE@",$tlocationBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationID@", $tlocationID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationIDSTYLE@",$tlocationIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationDescription@", $tlocationDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationDescriptionSTYLE@",$tlocationDescriptionSTYLE);           
        endwhile; // of oRStlocation DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tlocationAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationAutomaticDetailLinkSTYLE@", $tlocationAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationCountryID@", "&nbsp;");
$tlocationCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationCountryIDSTYLE@", $tlocationCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationBranchID@", "&nbsp;");
$tlocationBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationBranchIDSTYLE@", $tlocationBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationID@", "&nbsp;");
$tlocationIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationIDSTYLE@", $tlocationIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationDescription@", "&nbsp;");
$tlocationDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tlocationDescriptionSTYLE@", $tlocationDescriptionSTYLE);
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
global $oRStlocation;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetlocationsearch.php";
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
        $ref .= "<a href=Updatetlocation" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetlocation" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
