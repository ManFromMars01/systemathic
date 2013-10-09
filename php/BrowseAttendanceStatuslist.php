<?PHP
session_set_cookie_params(500);
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
$BrowseAttendanceStatusRowData = "";
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
$tastatusAutomaticDetailLink = "";
$tastatusAutomaticDetailLinkSTYLE = "";
$tastatusCountryIDLABEL = "";
$tastatusCountryID = "";
$tastatusCountryIDSTYLE = "";
$tastatusBranchIDLABEL = "";
$tastatusBranchID = "";
$tastatusBranchIDSTYLE = "";
$tastatusIDLABEL = "";
$tastatusID = "";
$tastatusIDSTYLE = "";
$tastatusDescriptionLABEL = "";
$tastatusDescription = "";
$tastatusDescriptionSTYLE = "";
$oRStastatus = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
    $_SESSION["BrowseAttendanceStatus#COL"] = "";
    $_SESSION["BrowseAttendanceStatus#SRT"] = "";
    $_SESSION["BrowseAttendanceStatus#PreviousColumn"] = "";
    $_SESSION["BrowseAttendanceStatus#PreviousSort"] = "";
    $_SESSION["BrowseAttendanceStatus#mySort"] = "";
    $_SESSION["BrowseAttendanceStatus#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseAttendanceStatus#WHR"] = "";
        $_SESSION["BrowseAttendanceStatus#COL"] = "";
        $_SESSION["BrowseAttendanceStatus#SRT"] = "";
        $_SESSION["BrowseAttendanceStatus#PreviousColumn"] = "";
        $_SESSION["BrowseAttendanceStatus#PreviousSort"] = "";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "";
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseAttendanceStatus#COL"] = "";
            $_SESSION["BrowseAttendanceStatus#SRT"] = "";
            $_SESSION["BrowseAttendanceStatus#PreviousColumn"] = "";
            $_SESSION["BrowseAttendanceStatus#PreviousSort"] = "";
            $_SESSION["BrowseAttendanceStatus#mySort"] = "";
            $_SESSION["BrowseAttendanceStatus#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseAttendanceStatus#PreviousColumn"] = "";
else:
    $_SESSION["BrowseAttendanceStatus#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseAttendanceStatus#PreviousSort"] = "";
else:
    $_SESSION["BrowseAttendanceStatus#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseAttendanceStatus#COL") == ""):
    if (getRequest("COL") . getSession("BrowseAttendanceStatus#COL") == ""):
        $_SESSION["BrowseAttendanceStatus#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.CountryID DESC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.CountryID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAttendanceStatus#PreviousColumn")):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.CountryID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAttendanceStatus#COL"] = "CountryID";
    $_SESSION["BrowseAttendanceStatus#SRT"] = getSession("BrowseAttendanceStatus#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.BranchID DESC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.BranchID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAttendanceStatus#PreviousColumn")):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.BranchID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAttendanceStatus#COL"] = "BranchID";
    $_SESSION["BrowseAttendanceStatus#SRT"] = getSession("BrowseAttendanceStatus#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.ID DESC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.ID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAttendanceStatus#PreviousColumn")):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.ID ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAttendanceStatus#COL"] = "ID";
    $_SESSION["BrowseAttendanceStatus#SRT"] = getSession("BrowseAttendanceStatus#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.Description DESC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.Description ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAttendanceStatus#PreviousColumn")):
        $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.Description ASC";
        $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAttendanceStatus#COL"] = "Description";
    $_SESSION["BrowseAttendanceStatus#SRT"] = getSession("BrowseAttendanceStatus#mySort");
endif;

$myQuery    = "SELECT tastatus.CountryID, tastatus.BranchID, tastatus.ID, tastatus.Description FROM tastatus";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseAttendanceStatus#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseAttendanceStatus#WHR") != ""):
    $myWhere    = getSession("BrowseAttendanceStatus#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tastatus", "tastatus.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tastatus.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseAttendanceStatus#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseAttendanceStatus#myOrder") == ""):
    $_SESSION["BrowseAttendanceStatus#myOrder"] = "ORDER BY tastatus.CountryID ASC";
    $_SESSION["BrowseAttendanceStatus#mySort"] = "ASC";
    $_SESSION["BrowseAttendanceStatus#COL"] = "CountryID";
    $_SESSION["BrowseAttendanceStatus#SRT"] = getSession("BrowseAttendanceStatus#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseAttendanceStatus#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseAttendanceStatus#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tastatus.CountryID) AS MyCount  FROM tastatus WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tastatus.CountryID) AS MyCount  FROM tastatus";
endif;
$oRStastatus = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStastatus->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStastatus->Close();
$oRStastatus = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseAttendanceStatus#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStastatus):
    if($oRStastatus->EOF != TRUE):
        if($oRStastatus->RecordCount() > 0):
            $oRStastatus->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseAttendanceStatus" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseAttendanceStatusListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStastatus->Close();
unset($oRStastatus);

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
    $tmpMsg = "<a href='BrowseAttendanceStatus" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetastatus" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseAttendanceStatusListTemplate($Template)
=============================================================================
*/
function MergeBrowseAttendanceStatusListTemplate($Template) {
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
        $Template = "./html/BrowseAttendanceStatuslist.htm";
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
            if ( getSession("BrowseAttendanceStatus#PreviousColumn") == "CountryID"):
                if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAttendanceStatus#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseAttendanceStatus#COL") == "CountryID" ):
            if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseAttendanceStatus#PreviousColumn") == "BranchID"):
                if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAttendanceStatus#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseAttendanceStatus#COL") == "BranchID" ):
            if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseAttendanceStatus#PreviousColumn") == "ID"):
                if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAttendanceStatus#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseAttendanceStatus#COL") == "ID" ):
            if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseAttendanceStatus#PreviousColumn") == "Description"):
                if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAttendanceStatus#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseAttendanceStatus#COL") == "Description" ):
            if (getSession("BrowseAttendanceStatus#SRT") == "ASC"):
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
    global $oRStastatus;
    global $RecordsPageSize;
    global $tastatusAutomaticDetailLink;
    global $tastatusAutomaticDetailLinkSTYLE;
    global $tastatusBranchID;
    global $tastatusBranchIDLABEL;
    global $tastatusBranchIDSTYLE;
    global $tastatusCountryID;
    global $tastatusCountryIDLABEL;
    global $tastatusCountryIDSTYLE;
    global $tastatusDescription;
    global $tastatusDescriptionLABEL;
    global $tastatusDescriptionSTYLE;
    global $tastatusID;
    global $tastatusIDLABEL;
    global $tastatusIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStastatus) :
        while ((!$oRStastatus->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tastatusAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetastatusedit.php?ID1=";
                    $tastatusAutomaticDetailLink = $myLink;
                      $tastatusAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStastatus->fields["CountryID"]))) . "'" ;
                    $tastatusAutomaticDetailLink .=  "&ID2=" . "'";
                    $tastatusAutomaticDetailLink .= htmlEncode(trim(getValue($oRStastatus->fields["BranchID"]))) . "'";
                    $tastatusAutomaticDetailLink .=  "&ID3=";
                    $tastatusAutomaticDetailLink .= htmlEncode(trim(getValue($oRStastatus->fields["ID"])));
            $tmpIMG_tastatusAutomaticDetailLink = "";
            $tmpIMG_tastatusAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tastatusAutomaticDetailLink .= "\">" . $tmpIMG_tastatusAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tastatusCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStastatus->fields["CountryID"])):
        $tastatusCountryID = "";
    else:
        $tastatusCountryID = htmlEncode(getValue($oRStastatus->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tastatusBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStastatus->fields["BranchID"])):
        $tastatusBranchID = "";
    else:
        $tastatusBranchID = htmlEncode(getValue($oRStastatus->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tastatusIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStastatus->fields["ID"])):
        $tastatusID = "";
    else:
        $tastatusID = htmlEncode(getValue($oRStastatus->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tastatusDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStastatus->fields["Description"])):
        $tastatusDescription = "";
    else:
        $tastatusDescription = htmlEncode(getValue($oRStastatus->fields["Description"]));
endif;
$Seq++;
$oRStastatus->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tastatusAutomaticDetailLink@", $tastatusAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusAutomaticDetailLinkSTYLE@", $tastatusAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusCountryID@", $tastatusCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusCountryIDSTYLE@",$tastatusCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusBranchID@", $tastatusBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusBranchIDSTYLE@",$tastatusBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusID@", $tastatusID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusIDSTYLE@",$tastatusIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusDescription@", $tastatusDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusDescriptionSTYLE@",$tastatusDescriptionSTYLE);           
        endwhile; // of oRStastatus DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tastatusAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusAutomaticDetailLinkSTYLE@", $tastatusAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusCountryID@", "&nbsp;");
$tastatusCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusCountryIDSTYLE@", $tastatusCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusBranchID@", "&nbsp;");
$tastatusBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusBranchIDSTYLE@", $tastatusBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusID@", "&nbsp;");
$tastatusIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusIDSTYLE@", $tastatusIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusDescription@", "&nbsp;");
$tastatusDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tastatusDescriptionSTYLE@", $tastatusDescriptionSTYLE);
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
global $oRStastatus;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetastatussearch.php";
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
        $ref .= "<a href=Updatetastatus" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetastatus" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
