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
$BrowseVendorRowData = "";
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
$tvendorAutomaticDetailLink = "";
$tvendorAutomaticDetailLinkSTYLE = "";
$tvendorCountryIDLABEL = "";
$tvendorCountryID = "";
$tvendorCountryIDSTYLE = "";
$tvendorBranchIDLABEL = "";
$tvendorBranchID = "";
$tvendorBranchIDSTYLE = "";
$tvendorIDLABEL = "";
$tvendorID = "";
$tvendorIDSTYLE = "";
$tvendorNameLABEL = "";
$tvendorName = "";
$tvendorNameSTYLE = "";
$tvendorAddress1LABEL = "";
$tvendorAddress1 = "";
$tvendorAddress1STYLE = "";
$tvendorAddress2LABEL = "";
$tvendorAddress2 = "";
$tvendorAddress2STYLE = "";
$tvendorCityLABEL = "";
$tvendorCity = "";
$tvendorCitySTYLE = "";
$tvendorZipLABEL = "";
$tvendorZip = "";
$tvendorZipSTYLE = "";
$tvendorFaxLABEL = "";
$tvendorFax = "";
$tvendorFaxSTYLE = "";
$oRStvendor = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseVendor#WHR"] = "";
    $_SESSION["BrowseVendor#COL"] = "";
    $_SESSION["BrowseVendor#SRT"] = "";
    $_SESSION["BrowseVendor#PreviousColumn"] = "";
    $_SESSION["BrowseVendor#PreviousSort"] = "";
    $_SESSION["BrowseVendor#mySort"] = "";
    $_SESSION["BrowseVendor#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseVendor#WHR"] = "";
        $_SESSION["BrowseVendor#COL"] = "";
        $_SESSION["BrowseVendor#SRT"] = "";
        $_SESSION["BrowseVendor#PreviousColumn"] = "";
        $_SESSION["BrowseVendor#PreviousSort"] = "";
        $_SESSION["BrowseVendor#mySort"] = "";
        $_SESSION["BrowseVendor#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseVendor#COL"] = "";
            $_SESSION["BrowseVendor#SRT"] = "";
            $_SESSION["BrowseVendor#PreviousColumn"] = "";
            $_SESSION["BrowseVendor#PreviousSort"] = "";
            $_SESSION["BrowseVendor#mySort"] = "";
            $_SESSION["BrowseVendor#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseVendor#PreviousColumn"] = "";
else:
    $_SESSION["BrowseVendor#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseVendor#PreviousSort"] = "";
else:
    $_SESSION["BrowseVendor#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseVendor#COL") == ""):
    if (getRequest("COL") . getSession("BrowseVendor#COL") == ""):
        $_SESSION["BrowseVendor#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.CountryID DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.CountryID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.CountryID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "CountryID";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.BranchID DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.BranchID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.BranchID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "BranchID";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.ID DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.ID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.ID ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "ID";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "Name"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Name DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Name ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Name ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "Name";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "Address1"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address1 DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address1 ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address1 ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "Address1";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "Address2"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address2 DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address2 ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Address2 ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "Address2";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "City"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.City DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.City ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.City ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "City";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "Zip"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Zip DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Zip ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Zip ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "Zip";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

if (getRequest("COL") == "Fax"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Fax DESC";
        $_SESSION["BrowseVendor#mySort"] = "DESC";
    else:
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Fax ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseVendor#PreviousColumn")):
        $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.Fax ASC";
        $_SESSION["BrowseVendor#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseVendor#COL"] = "Fax";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

$myQuery    = "SELECT tvendor.CountryID, tvendor.BranchID, tvendor.ID, tvendor.Name, tvendor.Address1, tvendor.Address2, tvendor.City, tvendor.Zip, tvendor.Fax FROM tvendor";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseVendor#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseVendor#WHR") != ""):
    $myWhere    = getSession("BrowseVendor#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseVendor#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseVendor#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseVendor#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseVendor#myOrder") == ""):
    $_SESSION["BrowseVendor#myOrder"] = "ORDER BY tvendor.CountryID ASC";
    $_SESSION["BrowseVendor#mySort"] = "ASC";
    $_SESSION["BrowseVendor#COL"] = "CountryID";
    $_SESSION["BrowseVendor#SRT"] = getSession("BrowseVendor#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseVendor#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseVendor#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tvendor.CountryID) AS MyCount  FROM tvendor WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tvendor.CountryID) AS MyCount  FROM tvendor";
endif;
$oRStvendor = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStvendor->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStvendor->Close();
$oRStvendor = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseVendor#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStvendor):
    if($oRStvendor->EOF != TRUE):
        if($oRStvendor->RecordCount() > 0):
            $oRStvendor->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseVendor" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseVendorListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStvendor->Close();
unset($oRStvendor);

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
    $tmpMsg = "<a href='BrowseVendor" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetvendor" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseVendorListTemplate($Template)
=============================================================================
*/
function MergeBrowseVendorListTemplate($Template) {
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
        $Template = "./html/BrowseVendorlist.htm";
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
            if ( getSession("BrowseVendor#PreviousColumn") == "CountryID"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseVendor#COL") == "CountryID" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseVendor#PreviousColumn") == "BranchID"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseVendor#COL") == "BranchID" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseVendor#PreviousColumn") == "ID"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseVendor#COL") == "ID" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Name";
            if ( getSession("BrowseVendor#PreviousColumn") == "Name"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "Name"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Name</a>";
        $NameLABEL = $myLink;
        if ( getGet("COL") == "Name" || getSession("BrowseVendor#COL") == "Name" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $NameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $NameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Address1";
            if ( getSession("BrowseVendor#PreviousColumn") == "Address1"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "Address1"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Address 1</a>";
        $Address1LABEL = $myLink;
        if ( getGet("COL") == "Address1" || getSession("BrowseVendor#COL") == "Address1" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $Address1LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Address1LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Address2";
            if ( getSession("BrowseVendor#PreviousColumn") == "Address2"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "Address2"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Address 2</a>";
        $Address2LABEL = $myLink;
        if ( getGet("COL") == "Address2" || getSession("BrowseVendor#COL") == "Address2" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $Address2LABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Address2LABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=City";
            if ( getSession("BrowseVendor#PreviousColumn") == "City"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "City"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">City</a>";
        $CityLABEL = $myLink;
        if ( getGet("COL") == "City" || getSession("BrowseVendor#COL") == "City" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $CityLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CityLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Zip";
            if ( getSession("BrowseVendor#PreviousColumn") == "Zip"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "Zip"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Zip</a>";
        $ZipLABEL = $myLink;
        if ( getGet("COL") == "Zip" || getSession("BrowseVendor#COL") == "Zip" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $ZipLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ZipLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Fax";
            if ( getSession("BrowseVendor#PreviousColumn") == "Fax"):
                if (getSession("BrowseVendor#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseVendor#COL") == "Fax"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Fax</a>";
        $FaxLABEL = $myLink;
        if ( getGet("COL") == "Fax" || getSession("BrowseVendor#COL") == "Fax" ):
            if (getSession("BrowseVendor#SRT") == "ASC"):
                $FaxLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $FaxLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@NameLABEL@", $NameLABEL);
$HeaderText = Replace($HeaderText,"@Address1LABEL@", $Address1LABEL);
$HeaderText = Replace($HeaderText,"@Address2LABEL@", $Address2LABEL);
$HeaderText = Replace($HeaderText,"@CityLABEL@", $CityLABEL);
$HeaderText = Replace($HeaderText,"@ZipLABEL@", $ZipLABEL);
$HeaderText = Replace($HeaderText,"@FaxLABEL@", $FaxLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStvendor;
    global $RecordsPageSize;
    global $tvendorAddress1;
    global $tvendorAddress1LABEL;
    global $tvendorAddress1STYLE;
    global $tvendorAddress2;
    global $tvendorAddress2LABEL;
    global $tvendorAddress2STYLE;
    global $tvendorAutomaticDetailLink;
    global $tvendorAutomaticDetailLinkSTYLE;
    global $tvendorBranchID;
    global $tvendorBranchIDLABEL;
    global $tvendorBranchIDSTYLE;
    global $tvendorCity;
    global $tvendorCityLABEL;
    global $tvendorCitySTYLE;
    global $tvendorCountryID;
    global $tvendorCountryIDLABEL;
    global $tvendorCountryIDSTYLE;
    global $tvendorFax;
    global $tvendorFaxLABEL;
    global $tvendorFaxSTYLE;
    global $tvendorID;
    global $tvendorIDLABEL;
    global $tvendorIDSTYLE;
    global $tvendorName;
    global $tvendorNameLABEL;
    global $tvendorNameSTYLE;
    global $tvendorZip;
    global $tvendorZipLABEL;
    global $tvendorZipSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStvendor) :
        while ((!$oRStvendor->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tvendorAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetvendoredit.php?ID1=";
                    $tvendorAutomaticDetailLink = $myLink;
                      $tvendorAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStvendor->fields["CountryID"]))) . "'" ;
                    $tvendorAutomaticDetailLink .=  "&ID2=" . "'";
                    $tvendorAutomaticDetailLink .= htmlEncode(trim(getValue($oRStvendor->fields["BranchID"]))) . "'";
                    $tvendorAutomaticDetailLink .=  "&ID3=";
                    $tvendorAutomaticDetailLink .= htmlEncode(trim(getValue($oRStvendor->fields["ID"])));
            $tmpIMG_tvendorAutomaticDetailLink = "";
            $tmpIMG_tvendorAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tvendorAutomaticDetailLink .= "\">" . $tmpIMG_tvendorAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["CountryID"])):
        $tvendorCountryID = "";
    else:
        $tvendorCountryID = htmlEncode(getValue($oRStvendor->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["BranchID"])):
        $tvendorBranchID = "";
    else:
        $tvendorBranchID = htmlEncode(getValue($oRStvendor->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["ID"])):
        $tvendorID = "";
    else:
        $myQuoteID = "";
        $tvendorID = '<a href=\'JAVASCRIPT:updateData(';
        $tvendorID .= $myQuoteID . htmlEncode(getValue($oRStvendor->fields["ID"])) . $myQuoteID;
        $tvendorID .= ');\'>';
        $tvendorID .= htmlEncode(getValue($oRStvendor->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["Name"])):
        $tvendorName = "";
    else:
        $tvendorName = htmlEncode(getValue($oRStvendor->fields["Name"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorAddress1STYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["Address1"])):
        $tvendorAddress1 = "";
    else:
        $tvendorAddress1 = htmlEncode(getValue($oRStvendor->fields["Address1"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorAddress2STYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["Address2"])):
        $tvendorAddress2 = "";
    else:
        $tvendorAddress2 = htmlEncode(getValue($oRStvendor->fields["Address2"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorCitySTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["City"])):
        $tvendorCity = "";
    else:
        $tvendorCity = htmlEncode(getValue($oRStvendor->fields["City"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorZipSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["Zip"])):
        $tvendorZip = "";
    else:
        $tvendorZip = htmlEncode(getValue($oRStvendor->fields["Zip"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorFaxSTYLE = "TableRow" . $Style;
    if (is_null($oRStvendor->fields["Fax"])):
        $tvendorFax = "";
    else:
        $tvendorFax = htmlEncode(getValue($oRStvendor->fields["Fax"]));
endif;
$Seq++;
$oRStvendor->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAutomaticDetailLink@", $tvendorAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAutomaticDetailLinkSTYLE@", $tvendorAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCountryID@", $tvendorCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCountryIDSTYLE@",$tvendorCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorBranchID@", $tvendorBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorBranchIDSTYLE@",$tvendorBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorID@", $tvendorID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorIDSTYLE@",$tvendorIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorName@", $tvendorName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorNameSTYLE@",$tvendorNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress1@", $tvendorAddress1);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress1STYLE@",$tvendorAddress1STYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress2@", $tvendorAddress2);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress2STYLE@",$tvendorAddress2STYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCity@", $tvendorCity);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCitySTYLE@",$tvendorCitySTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorZip@", $tvendorZip);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorZipSTYLE@",$tvendorZipSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorFax@", $tvendorFax);       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorFaxSTYLE@",$tvendorFaxSTYLE);           
        endwhile; // of oRStvendor DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tvendorAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAutomaticDetailLinkSTYLE@", $tvendorAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCountryID@", "&nbsp;");
$tvendorCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCountryIDSTYLE@", $tvendorCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorBranchID@", "&nbsp;");
$tvendorBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorBranchIDSTYLE@", $tvendorBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorID@", "&nbsp;");
$tvendorIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorIDSTYLE@", $tvendorIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorName@", "&nbsp;");
$tvendorNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorNameSTYLE@", $tvendorNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress1@", "&nbsp;");
$tvendorAddress1STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress1STYLE@", $tvendorAddress1STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress2@", "&nbsp;");
$tvendorAddress2STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorAddress2STYLE@", $tvendorAddress2STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCity@", "&nbsp;");
$tvendorCitySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorCitySTYLE@", $tvendorCitySTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorZip@", "&nbsp;");
$tvendorZipSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorZipSTYLE@", $tvendorZipSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorFax@", "&nbsp;");
$tvendorFaxSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tvendorFaxSTYLE@", $tvendorFaxSTYLE);
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
global $oRStvendor;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetvendorsearch.php";
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
        $ref .= "<a href=Updatetvendor" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetvendor" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
