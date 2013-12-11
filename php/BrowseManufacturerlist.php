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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tmanufacturer  WHERE tmanufacturer.CountryID ='".$_SESSION['UserValue1']."' AND tmanufacturer.BranchID = '".$_SESSION['UserValue2']."' ORDER BY tmanufacturer.CountryID ASC";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;

$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseManufacturerRowData = "";
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
$tmanufacturerAutomaticDetailLink = "";
$tmanufacturerAutomaticDetailLinkSTYLE = "";
$tmanufacturerCountryIDLABEL = "";
$tmanufacturerCountryID = "";
$tmanufacturerCountryIDSTYLE = "";
$tmanufacturerBranchIDLABEL = "";
$tmanufacturerBranchID = "";
$tmanufacturerBranchIDSTYLE = "";
$tmanufacturerIDLABEL = "";
$tmanufacturerID = "";
$tmanufacturerIDSTYLE = "";
$tmanufacturerDescriptionLABEL = "";
$tmanufacturerDescription = "";
$tmanufacturerDescriptionSTYLE = "";
$oRStmanufacturer = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseManufacturer#WHR"] = "";
    $_SESSION["BrowseManufacturer#COL"] = "";
    $_SESSION["BrowseManufacturer#SRT"] = "";
    $_SESSION["BrowseManufacturer#PreviousColumn"] = "";
    $_SESSION["BrowseManufacturer#PreviousSort"] = "";
    $_SESSION["BrowseManufacturer#mySort"] = "";
    $_SESSION["BrowseManufacturer#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseManufacturer#WHR"] = "";
        $_SESSION["BrowseManufacturer#COL"] = "";
        $_SESSION["BrowseManufacturer#SRT"] = "";
        $_SESSION["BrowseManufacturer#PreviousColumn"] = "";
        $_SESSION["BrowseManufacturer#PreviousSort"] = "";
        $_SESSION["BrowseManufacturer#mySort"] = "";
        $_SESSION["BrowseManufacturer#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseManufacturer#COL"] = "";
            $_SESSION["BrowseManufacturer#SRT"] = "";
            $_SESSION["BrowseManufacturer#PreviousColumn"] = "";
            $_SESSION["BrowseManufacturer#PreviousSort"] = "";
            $_SESSION["BrowseManufacturer#mySort"] = "";
            $_SESSION["BrowseManufacturer#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseManufacturer#PreviousColumn"] = "";
else:
    $_SESSION["BrowseManufacturer#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseManufacturer#PreviousSort"] = "";
else:
    $_SESSION["BrowseManufacturer#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseManufacturer#COL") == ""):
    if (getRequest("COL") . getSession("BrowseManufacturer#COL") == ""):
        $_SESSION["BrowseManufacturer#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.CountryID DESC";
        $_SESSION["BrowseManufacturer#mySort"] = "DESC";
    else:
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.CountryID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseManufacturer#PreviousColumn")):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.CountryID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseManufacturer#COL"] = "CountryID";
    $_SESSION["BrowseManufacturer#SRT"] = getSession("BrowseManufacturer#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.BranchID DESC";
        $_SESSION["BrowseManufacturer#mySort"] = "DESC";
    else:
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.BranchID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseManufacturer#PreviousColumn")):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.BranchID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseManufacturer#COL"] = "BranchID";
    $_SESSION["BrowseManufacturer#SRT"] = getSession("BrowseManufacturer#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.ID DESC";
        $_SESSION["BrowseManufacturer#mySort"] = "DESC";
    else:
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.ID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseManufacturer#PreviousColumn")):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.ID ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseManufacturer#COL"] = "ID";
    $_SESSION["BrowseManufacturer#SRT"] = getSession("BrowseManufacturer#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.Description DESC";
        $_SESSION["BrowseManufacturer#mySort"] = "DESC";
    else:
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.Description ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseManufacturer#PreviousColumn")):
        $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.Description ASC";
        $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseManufacturer#COL"] = "Description";
    $_SESSION["BrowseManufacturer#SRT"] = getSession("BrowseManufacturer#mySort");
endif;

$myQuery    = "SELECT tmanufacturer.CountryID, tmanufacturer.BranchID, tmanufacturer.ID, tmanufacturer.Description FROM tmanufacturer";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseManufacturer#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseManufacturer#WHR") != ""):
    $myWhere    = getSession("BrowseManufacturer#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseManufacturer#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseManufacturer#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseManufacturer#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tmanufacturer", "tmanufacturer.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tmanufacturer.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseManufacturer#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseManufacturer#myOrder") == ""):
    $_SESSION["BrowseManufacturer#myOrder"] = "ORDER BY tmanufacturer.CountryID ASC";
    $_SESSION["BrowseManufacturer#mySort"] = "ASC";
    $_SESSION["BrowseManufacturer#COL"] = "CountryID";
    $_SESSION["BrowseManufacturer#SRT"] = getSession("BrowseManufacturer#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseManufacturer#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseManufacturer#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tmanufacturer.CountryID) AS MyCount  FROM tmanufacturer WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tmanufacturer.CountryID) AS MyCount  FROM tmanufacturer";
endif;
$oRStmanufacturer = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStmanufacturer->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStmanufacturer->Close();
$oRStmanufacturer = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseManufacturer#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStmanufacturer):
    if($oRStmanufacturer->EOF != TRUE):
        if($oRStmanufacturer->RecordCount() > 0):
            $oRStmanufacturer->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseManufacturer" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseManufacturerListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStmanufacturer->Close();
unset($oRStmanufacturer);

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
    $tmpMsg = "<a href='BrowseManufacturer" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetmanufacturer" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseManufacturerListTemplate($Template)
=============================================================================
*/
function MergeBrowseManufacturerListTemplate($Template) {
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
        $Template = "./html/BrowseManufacturerlist.htm";
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
            if ( getSession("BrowseManufacturer#PreviousColumn") == "CountryID"):
                if (getSession("BrowseManufacturer#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseManufacturer#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseManufacturer#COL") == "CountryID" ):
            if (getSession("BrowseManufacturer#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseManufacturer#PreviousColumn") == "BranchID"):
                if (getSession("BrowseManufacturer#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseManufacturer#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseManufacturer#COL") == "BranchID" ):
            if (getSession("BrowseManufacturer#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseManufacturer#PreviousColumn") == "ID"):
                if (getSession("BrowseManufacturer#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseManufacturer#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseManufacturer#COL") == "ID" ):
            if (getSession("BrowseManufacturer#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseManufacturer#PreviousColumn") == "Description"):
                if (getSession("BrowseManufacturer#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseManufacturer#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseManufacturer#COL") == "Description" ):
            if (getSession("BrowseManufacturer#SRT") == "ASC"):
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
    global $oRStmanufacturer;
    global $RecordsPageSize;
    global $tmanufacturerAutomaticDetailLink;
    global $tmanufacturerAutomaticDetailLinkSTYLE;
    global $tmanufacturerBranchID;
    global $tmanufacturerBranchIDLABEL;
    global $tmanufacturerBranchIDSTYLE;
    global $tmanufacturerCountryID;
    global $tmanufacturerCountryIDLABEL;
    global $tmanufacturerCountryIDSTYLE;
    global $tmanufacturerDescription;
    global $tmanufacturerDescriptionLABEL;
    global $tmanufacturerDescriptionSTYLE;
    global $tmanufacturerID;
    global $tmanufacturerIDLABEL;
    global $tmanufacturerIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStmanufacturer) :
        while ((!$oRStmanufacturer->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tmanufacturerAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetmanufactureredit.php?ID1=";
                    $tmanufacturerAutomaticDetailLink = $myLink;
                      $tmanufacturerAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStmanufacturer->fields["CountryID"]))) . "'" ;
                    $tmanufacturerAutomaticDetailLink .=  "&ID2=" . "'";
                    $tmanufacturerAutomaticDetailLink .= htmlEncode(trim(getValue($oRStmanufacturer->fields["BranchID"]))) . "'";
                    $tmanufacturerAutomaticDetailLink .=  "&ID3=";
                    $tmanufacturerAutomaticDetailLink .= htmlEncode(trim(getValue($oRStmanufacturer->fields["ID"])));
            $tmpIMG_tmanufacturerAutomaticDetailLink = "";
            $tmpIMG_tmanufacturerAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tmanufacturerAutomaticDetailLink .= "\">" . $tmpIMG_tmanufacturerAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tmanufacturerCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStmanufacturer->fields["CountryID"])):
        $tmanufacturerCountryID = "";
    else:
        $tmanufacturerCountryID = htmlEncode(getValue($oRStmanufacturer->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tmanufacturerBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStmanufacturer->fields["BranchID"])):
        $tmanufacturerBranchID = "";
    else:
        $tmanufacturerBranchID = htmlEncode(getValue($oRStmanufacturer->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tmanufacturerIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStmanufacturer->fields["ID"])):
        $tmanufacturerID = "";
    else:
        $myQuoteID = "";
        $tmanufacturerID = '<a href=\'JAVASCRIPT:updateData(';
        $tmanufacturerID .= $myQuoteID . htmlEncode(getValue($oRStmanufacturer->fields["ID"])) . $myQuoteID;
        $tmanufacturerID .= ');\'>';
        $tmanufacturerID .= htmlEncode(getValue($oRStmanufacturer->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tmanufacturerDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStmanufacturer->fields["Description"])):
        $tmanufacturerDescription = "";
    else:
        $tmanufacturerDescription = htmlEncode(getValue($oRStmanufacturer->fields["Description"]));
endif;
$Seq++;
$oRStmanufacturer->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerAutomaticDetailLink@", $tmanufacturerAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerAutomaticDetailLinkSTYLE@", $tmanufacturerAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerCountryID@", $tmanufacturerCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerCountryIDSTYLE@",$tmanufacturerCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerBranchID@", $tmanufacturerBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerBranchIDSTYLE@",$tmanufacturerBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerID@", $tmanufacturerID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerIDSTYLE@",$tmanufacturerIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerDescription@", $tmanufacturerDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerDescriptionSTYLE@",$tmanufacturerDescriptionSTYLE);           
        endwhile; // of oRStmanufacturer DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tmanufacturerAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerAutomaticDetailLinkSTYLE@", $tmanufacturerAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerCountryID@", "&nbsp;");
$tmanufacturerCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerCountryIDSTYLE@", $tmanufacturerCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerBranchID@", "&nbsp;");
$tmanufacturerBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerBranchIDSTYLE@", $tmanufacturerBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerID@", "&nbsp;");
$tmanufacturerIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerIDSTYLE@", $tmanufacturerIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerDescription@", "&nbsp;");
$tmanufacturerDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tmanufacturerDescriptionSTYLE@", $tmanufacturerDescriptionSTYLE);
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
global $oRStmanufacturer;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetmanufacturersearch.php";
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
        $ref .= "<a href=Updatetmanufacturer" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetmanufacturer" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
