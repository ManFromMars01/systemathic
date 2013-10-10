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
$BrowseTDRoleRowData = "";
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
$tdroleAutomaticDetailLink = "";
$tdroleAutomaticDetailLinkSTYLE = "";
$tdroleCountryIDLABEL = "";
$tdroleCountryID = "";
$tdroleCountryIDSTYLE = "";
$tdroleBranchIDLABEL = "";
$tdroleBranchID = "";
$tdroleBranchIDSTYLE = "";
$tdroleRoleIDLABEL = "";
$tdroleRoleID = "";
$tdroleRoleIDSTYLE = "";
$tdrolePageNameLABEL = "";
$tdrolePageName = "";
$tdrolePageNameSTYLE = "";
$tdroleInsertPrevLABEL = "";
$tdroleInsertPrev = "";
$tdroleInsertPrevSTYLE = "";
$tdroleEditPrevLABEL = "";
$tdroleEditPrev = "";
$tdroleEditPrevSTYLE = "";
$tdroleDeletePrevLABEL = "";
$tdroleDeletePrev = "";
$tdroleDeletePrevSTYLE = "";
$tdroleViewPrevLABEL = "";
$tdroleViewPrev = "";
$tdroleViewPrevSTYLE = "";
$oRStdrole = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTDRole#WHR"] = "";
    $_SESSION["BrowseTDRole#COL"] = "";
    $_SESSION["BrowseTDRole#SRT"] = "";
    $_SESSION["BrowseTDRole#PreviousColumn"] = "";
    $_SESSION["BrowseTDRole#PreviousSort"] = "";
    $_SESSION["BrowseTDRole#mySort"] = "";
    $_SESSION["BrowseTDRole#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTDRole#WHR"] = "";
        $_SESSION["BrowseTDRole#COL"] = "";
        $_SESSION["BrowseTDRole#SRT"] = "";
        $_SESSION["BrowseTDRole#PreviousColumn"] = "";
        $_SESSION["BrowseTDRole#PreviousSort"] = "";
        $_SESSION["BrowseTDRole#mySort"] = "";
        $_SESSION["BrowseTDRole#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTDRole#COL"] = "";
            $_SESSION["BrowseTDRole#SRT"] = "";
            $_SESSION["BrowseTDRole#PreviousColumn"] = "";
            $_SESSION["BrowseTDRole#PreviousSort"] = "";
            $_SESSION["BrowseTDRole#mySort"] = "";
            $_SESSION["BrowseTDRole#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTDRole#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTDRole#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTDRole#PreviousSort"] = "";
else:
    $_SESSION["BrowseTDRole#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTDRole#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTDRole#COL") == ""):
        $_SESSION["BrowseTDRole#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.CountryID DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.CountryID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.CountryID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "CountryID";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.BranchID DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.BranchID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.BranchID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "BranchID";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "RoleID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.RoleID DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.RoleID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.RoleID ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "RoleID";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "PageName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.PageName DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.PageName ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.PageName ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "PageName";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "InsertPrev"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.InsertPrev DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.InsertPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.InsertPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "InsertPrev";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "EditPrev"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.EditPrev DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.EditPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.EditPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "EditPrev";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "DeletePrev"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.DeletePrev DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.DeletePrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.DeletePrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "DeletePrev";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

if (getRequest("COL") == "ViewPrev"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.ViewPrev DESC";
        $_SESSION["BrowseTDRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.ViewPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTDRole#PreviousColumn")):
        $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.ViewPrev ASC";
        $_SESSION["BrowseTDRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTDRole#COL"] = "ViewPrev";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

$myQuery    = "SELECT tdrole.CountryID, tdrole.BranchID, tdrole.RoleID, tdrole.PageName, tdrole.InsertPrev, tdrole.EditPrev, tdrole.DeletePrev, tdrole.ViewPrev FROM tdrole";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTDRole#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTDRole#WHR") != ""):
    $myWhere    = getSession("BrowseTDRole#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTDRole#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTDRole#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTDRole#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTDRole#myOrder") == ""):
    $_SESSION["BrowseTDRole#myOrder"] = "ORDER BY tdrole.CountryID ASC";
    $_SESSION["BrowseTDRole#mySort"] = "ASC";
    $_SESSION["BrowseTDRole#COL"] = "CountryID";
    $_SESSION["BrowseTDRole#SRT"] = getSession("BrowseTDRole#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTDRole#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTDRole#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tdrole.CountryID) AS MyCount  FROM tdrole WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tdrole.CountryID) AS MyCount  FROM tdrole";
endif;
$oRStdrole = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStdrole->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStdrole->Close();
$oRStdrole = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTDRole#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStdrole):
    if($oRStdrole->EOF != TRUE):
        if($oRStdrole->RecordCount() > 0):
            $oRStdrole->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTDRole" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTDRoleListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStdrole->Close();
unset($oRStdrole);

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
    $tmpMsg = "<a href='BrowseTDRole" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetdrole" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTDRoleListTemplate($Template)
=============================================================================
*/
function MergeBrowseTDRoleListTemplate($Template) {
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
        $Template = "./html/BrowseTDRolelist.htm";
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
            if ( getSession("BrowseTDRole#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTDRole#COL") == "CountryID" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTDRole#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTDRole#COL") == "BranchID" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=RoleID";
            if ( getSession("BrowseTDRole#PreviousColumn") == "RoleID"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "RoleID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Role ID</a>";
        $RoleIDLABEL = $myLink;
        if ( getGet("COL") == "RoleID" || getSession("BrowseTDRole#COL") == "RoleID" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $RoleIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RoleIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=PageName";
            if ( getSession("BrowseTDRole#PreviousColumn") == "PageName"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "PageName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Page Name</a>";
        $PageNameLABEL = $myLink;
        if ( getGet("COL") == "PageName" || getSession("BrowseTDRole#COL") == "PageName" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $PageNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PageNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=InsertPrev";
            if ( getSession("BrowseTDRole#PreviousColumn") == "InsertPrev"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "InsertPrev"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Insert Prev</a>";
        $InsertPrevLABEL = $myLink;
        if ( getGet("COL") == "InsertPrev" || getSession("BrowseTDRole#COL") == "InsertPrev" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $InsertPrevLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $InsertPrevLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=EditPrev";
            if ( getSession("BrowseTDRole#PreviousColumn") == "EditPrev"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "EditPrev"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Edit Prev</a>";
        $EditPrevLABEL = $myLink;
        if ( getGet("COL") == "EditPrev" || getSession("BrowseTDRole#COL") == "EditPrev" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $EditPrevLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $EditPrevLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=DeletePrev";
            if ( getSession("BrowseTDRole#PreviousColumn") == "DeletePrev"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "DeletePrev"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Delete Prev</a>";
        $DeletePrevLABEL = $myLink;
        if ( getGet("COL") == "DeletePrev" || getSession("BrowseTDRole#COL") == "DeletePrev" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $DeletePrevLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DeletePrevLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ViewPrev";
            if ( getSession("BrowseTDRole#PreviousColumn") == "ViewPrev"):
                if (getSession("BrowseTDRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTDRole#COL") == "ViewPrev"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">View Prev</a>";
        $ViewPrevLABEL = $myLink;
        if ( getGet("COL") == "ViewPrev" || getSession("BrowseTDRole#COL") == "ViewPrev" ):
            if (getSession("BrowseTDRole#SRT") == "ASC"):
                $ViewPrevLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ViewPrevLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@RoleIDLABEL@", $RoleIDLABEL);
$HeaderText = Replace($HeaderText,"@PageNameLABEL@", $PageNameLABEL);
$HeaderText = Replace($HeaderText,"@InsertPrevLABEL@", $InsertPrevLABEL);
$HeaderText = Replace($HeaderText,"@EditPrevLABEL@", $EditPrevLABEL);
$HeaderText = Replace($HeaderText,"@DeletePrevLABEL@", $DeletePrevLABEL);
$HeaderText = Replace($HeaderText,"@ViewPrevLABEL@", $ViewPrevLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStdrole;
    global $RecordsPageSize;
    global $tdroleAutomaticDetailLink;
    global $tdroleAutomaticDetailLinkSTYLE;
    global $tdroleBranchID;
    global $tdroleBranchIDLABEL;
    global $tdroleBranchIDSTYLE;
    global $tdroleCountryID;
    global $tdroleCountryIDLABEL;
    global $tdroleCountryIDSTYLE;
    global $tdroleDeletePrev;
    global $tdroleDeletePrevLABEL;
    global $tdroleDeletePrevSTYLE;
    global $tdroleEditPrev;
    global $tdroleEditPrevLABEL;
    global $tdroleEditPrevSTYLE;
    global $tdroleInsertPrev;
    global $tdroleInsertPrevLABEL;
    global $tdroleInsertPrevSTYLE;
    global $tdrolePageName;
    global $tdrolePageNameLABEL;
    global $tdrolePageNameSTYLE;
    global $tdroleRoleID;
    global $tdroleRoleIDLABEL;
    global $tdroleRoleIDSTYLE;
    global $tdroleViewPrev;
    global $tdroleViewPrevLABEL;
    global $tdroleViewPrevSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStdrole) :
        while ((!$oRStdrole->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tdroleAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetdroleedit.php?ID1=";
                    $tdroleAutomaticDetailLink = $myLink;
                      $tdroleAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStdrole->fields["CountryID"]))) . "'" ;
                    $tdroleAutomaticDetailLink .=  "&ID2=" . "'";
                    $tdroleAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdrole->fields["BranchID"]))) . "'";
                    $tdroleAutomaticDetailLink .=  "&ID3=" . "'";
                    $tdroleAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdrole->fields["RoleID"]))) . "'";
                    $tdroleAutomaticDetailLink .=  "&ID4=" . "'";
                    $tdroleAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdrole->fields["PageName"]))) . "'";
            $tmpIMG_tdroleAutomaticDetailLink = "";
            $tmpIMG_tdroleAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tdroleAutomaticDetailLink .= "\">" . $tmpIMG_tdroleAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["CountryID"])):
        $tdroleCountryID = "";
    else:
        $tdroleCountryID = htmlEncode(getValue($oRStdrole->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["BranchID"])):
        $tdroleBranchID = "";
    else:
        $tdroleBranchID = htmlEncode(getValue($oRStdrole->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleRoleIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["RoleID"])):
        $tdroleRoleID = "";
    else:
        $tdroleRoleID = htmlEncode(getValue($oRStdrole->fields["RoleID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdrolePageNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["PageName"])):
        $tdrolePageName = "";
    else:
        $tdrolePageName = htmlEncode(getValue($oRStdrole->fields["PageName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleInsertPrevSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["InsertPrev"])):
        $tdroleInsertPrev = "";
    else:
        $tdroleInsertPrev = htmlEncode(getValue($oRStdrole->fields["InsertPrev"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleEditPrevSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["EditPrev"])):
        $tdroleEditPrev = "";
    else:
        $tdroleEditPrev = htmlEncode(getValue($oRStdrole->fields["EditPrev"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleDeletePrevSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["DeletePrev"])):
        $tdroleDeletePrev = "";
    else:
        $tdroleDeletePrev = htmlEncode(getValue($oRStdrole->fields["DeletePrev"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleViewPrevSTYLE = "TableRow" . $Style;
    if (is_null($oRStdrole->fields["ViewPrev"])):
        $tdroleViewPrev = "";
    else:
        $tdroleViewPrev = htmlEncode(getValue($oRStdrole->fields["ViewPrev"]));
endif;
$Seq++;
$oRStdrole->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tdroleAutomaticDetailLink@", $tdroleAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleAutomaticDetailLinkSTYLE@", $tdroleAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleCountryID@", $tdroleCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleCountryIDSTYLE@",$tdroleCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleBranchID@", $tdroleBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleBranchIDSTYLE@",$tdroleBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleRoleID@", $tdroleRoleID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleRoleIDSTYLE@",$tdroleRoleIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdrolePageName@", $tdrolePageName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdrolePageNameSTYLE@",$tdrolePageNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleInsertPrev@", $tdroleInsertPrev);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleInsertPrevSTYLE@",$tdroleInsertPrevSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleEditPrev@", $tdroleEditPrev);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleEditPrevSTYLE@",$tdroleEditPrevSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleDeletePrev@", $tdroleDeletePrev);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleDeletePrevSTYLE@",$tdroleDeletePrevSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleViewPrev@", $tdroleViewPrev);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleViewPrevSTYLE@",$tdroleViewPrevSTYLE);           
        endwhile; // of oRStdrole DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdroleAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleAutomaticDetailLinkSTYLE@", $tdroleAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleCountryID@", "&nbsp;");
$tdroleCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleCountryIDSTYLE@", $tdroleCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleBranchID@", "&nbsp;");
$tdroleBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleBranchIDSTYLE@", $tdroleBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleRoleID@", "&nbsp;");
$tdroleRoleIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleRoleIDSTYLE@", $tdroleRoleIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdrolePageName@", "&nbsp;");
$tdrolePageNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdrolePageNameSTYLE@", $tdrolePageNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleInsertPrev@", "&nbsp;");
$tdroleInsertPrevSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleInsertPrevSTYLE@", $tdroleInsertPrevSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleEditPrev@", "&nbsp;");
$tdroleEditPrevSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleEditPrevSTYLE@", $tdroleEditPrevSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleDeletePrev@", "&nbsp;");
$tdroleDeletePrevSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleDeletePrevSTYLE@", $tdroleDeletePrevSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleViewPrev@", "&nbsp;");
$tdroleViewPrevSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdroleViewPrevSTYLE@", $tdroleViewPrevSTYLE);
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
global $oRStdrole;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetdrolesearch.php";
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
        $ref .= "<a href=Updatetdrole" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetdrole" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
