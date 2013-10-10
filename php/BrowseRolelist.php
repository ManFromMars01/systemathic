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

$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM trole  WHERE trole.CountryID ='".$_SESSION['UserValue1']."' ORDER BY trole.CountryID ASC";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;


$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseRoleRowData = "";
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
$troleAutomaticDetailLink = "";
$troleAutomaticDetailLinkSTYLE = "";
$troleAddRoleDetails = "";
$troleAddRoleDetailsSTYLE = "";
$troleCountryIDLABEL = "";
$troleCountryID = "";
$troleCountryIDSTYLE = "";
$troleBranchIDLABEL = "";
$troleBranchID = "";
$troleBranchIDSTYLE = "";
$troleRoleIDLABEL = "";
$troleRoleID = "";
$troleRoleIDSTYLE = "";
$troleDescriptionLABEL = "";
$troleDescription = "";
$troleDescriptionSTYLE = "";
$troleSecurityLevelLABEL = "";
$troleSecurityLevel = "";
$troleSecurityLevelSTYLE = "";
$oRStrole = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseRole#WHR"] = "";
    $_SESSION["BrowseRole#COL"] = "";
    $_SESSION["BrowseRole#SRT"] = "";
    $_SESSION["BrowseRole#PreviousColumn"] = "";
    $_SESSION["BrowseRole#PreviousSort"] = "";
    $_SESSION["BrowseRole#mySort"] = "";
    $_SESSION["BrowseRole#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseRole#WHR"] = "";
        $_SESSION["BrowseRole#COL"] = "";
        $_SESSION["BrowseRole#SRT"] = "";
        $_SESSION["BrowseRole#PreviousColumn"] = "";
        $_SESSION["BrowseRole#PreviousSort"] = "";
        $_SESSION["BrowseRole#mySort"] = "";
        $_SESSION["BrowseRole#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseRole#COL"] = "";
            $_SESSION["BrowseRole#SRT"] = "";
            $_SESSION["BrowseRole#PreviousColumn"] = "";
            $_SESSION["BrowseRole#PreviousSort"] = "";
            $_SESSION["BrowseRole#mySort"] = "";
            $_SESSION["BrowseRole#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseRole#PreviousColumn"] = "";
else:
    $_SESSION["BrowseRole#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseRole#PreviousSort"] = "";
else:
    $_SESSION["BrowseRole#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseRole#COL") == ""):
    if (getRequest("COL") . getSession("BrowseRole#COL") == ""):
        $_SESSION["BrowseRole#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.CountryID DESC";
        $_SESSION["BrowseRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.CountryID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRole#PreviousColumn")):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.CountryID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRole#COL"] = "CountryID";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.BranchID DESC";
        $_SESSION["BrowseRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.BranchID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRole#PreviousColumn")):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.BranchID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRole#COL"] = "BranchID";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

if (getRequest("COL") == "RoleID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.RoleID DESC";
        $_SESSION["BrowseRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.RoleID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRole#PreviousColumn")):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.RoleID ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRole#COL"] = "RoleID";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.Description DESC";
        $_SESSION["BrowseRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.Description ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRole#PreviousColumn")):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.Description ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRole#COL"] = "Description";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

if (getRequest("COL") == "SecurityLevel"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.SecurityLevel DESC";
        $_SESSION["BrowseRole#mySort"] = "DESC";
    else:
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.SecurityLevel ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseRole#PreviousColumn")):
        $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.SecurityLevel ASC";
        $_SESSION["BrowseRole#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseRole#COL"] = "SecurityLevel";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

$myQuery    = "SELECT trole.CountryID, trole.BranchID, trole.RoleID, trole.Description, trole.SecurityLevel FROM trole";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseRole#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseRole#WHR") != ""):
    $myWhere    = getSession("BrowseRole#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRole#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseRole#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseRole#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseRole#myOrder") == ""):
    $_SESSION["BrowseRole#myOrder"] = "ORDER BY trole.CountryID ASC";
    $_SESSION["BrowseRole#mySort"] = "ASC";
    $_SESSION["BrowseRole#COL"] = "CountryID";
    $_SESSION["BrowseRole#SRT"] = getSession("BrowseRole#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseRole#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseRole#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(trole.CountryID) AS MyCount  FROM trole WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(trole.CountryID) AS MyCount  FROM trole";
endif;
$oRStrole = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStrole->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStrole->Close();
$oRStrole = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseRole#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStrole):
    if($oRStrole->EOF != TRUE):
        if($oRStrole->RecordCount() > 0):
            $oRStrole->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseRole" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseRoleListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStrole->Close();
unset($oRStrole);

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
    $tmpMsg = "<a href='BrowseRole" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetrole" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseRoleListTemplate($Template)
=============================================================================
*/
function MergeBrowseRoleListTemplate($Template) {
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
        $Template = "./html/BrowseRolelist.htm";
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
            if ( getSession("BrowseRole#PreviousColumn") == "CountryID"):
                if (getSession("BrowseRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRole#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseRole#COL") == "CountryID" ):
            if (getSession("BrowseRole#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseRole#PreviousColumn") == "BranchID"):
                if (getSession("BrowseRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRole#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseRole#COL") == "BranchID" ):
            if (getSession("BrowseRole#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=RoleID";
            if ( getSession("BrowseRole#PreviousColumn") == "RoleID"):
                if (getSession("BrowseRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRole#COL") == "RoleID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Role ID</a>";
        $RoleIDLABEL = $myLink;
        if ( getGet("COL") == "RoleID" || getSession("BrowseRole#COL") == "RoleID" ):
            if (getSession("BrowseRole#SRT") == "ASC"):
                $RoleIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $RoleIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseRole#PreviousColumn") == "Description"):
                if (getSession("BrowseRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRole#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseRole#COL") == "Description" ):
            if (getSession("BrowseRole#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SecurityLevel";
            if ( getSession("BrowseRole#PreviousColumn") == "SecurityLevel"):
                if (getSession("BrowseRole#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseRole#COL") == "SecurityLevel"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Security Level</a>";
        $SecurityLevelLABEL = $myLink;
        if ( getGet("COL") == "SecurityLevel" || getSession("BrowseRole#COL") == "SecurityLevel" ):
            if (getSession("BrowseRole#SRT") == "ASC"):
                $SecurityLevelLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SecurityLevelLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@RoleIDLABEL@", $RoleIDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@SecurityLevelLABEL@", $SecurityLevelLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStrole;
    global $RecordsPageSize;
    global $troleAddRoleDetails;
    global $troleAddRoleDetailsSTYLE;
    global $troleAutomaticDetailLink;
    global $troleAutomaticDetailLinkSTYLE;
    global $troleBranchID;
    global $troleBranchIDLABEL;
    global $troleBranchIDSTYLE;
    global $troleCountryID;
    global $troleCountryIDLABEL;
    global $troleCountryIDSTYLE;
    global $troleDescription;
    global $troleDescriptionLABEL;
    global $troleDescriptionSTYLE;
    global $troleRoleID;
    global $troleRoleIDLABEL;
    global $troleRoleIDSTYLE;
    global $troleSecurityLevel;
    global $troleSecurityLevelLABEL;
    global $troleSecurityLevelSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStrole) :
        while ((!$oRStrole->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $troleAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetroleedit.php?ID1=";
                    $troleAutomaticDetailLink = $myLink;
                      $troleAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStrole->fields["CountryID"]))) . "'" ;
                    $troleAutomaticDetailLink .=  "&ID2=" . "'";
                    $troleAutomaticDetailLink .= htmlEncode(trim(getValue($oRStrole->fields["BranchID"]))) . "'";
                    $troleAutomaticDetailLink .=  "&ID3=" . "'";
                    $troleAutomaticDetailLink .= htmlEncode(trim(getValue($oRStrole->fields["RoleID"]))) . "'";
            $tmpIMG_troleAutomaticDetailLink = "";
            $tmpIMG_troleAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $troleAutomaticDetailLink .= "\">" . $tmpIMG_troleAutomaticDetailLink . "</a>";
    $troleAddRoleDetailsSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"BrowseTDRolelist.php?ID1=";
                    $troleAddRoleDetails = $myLink;
                      $troleAddRoleDetails .= "'" . htmlEncode(trim(getValue($oRStrole->fields["CountryID"]))) . "'" ;
                    $troleAddRoleDetails .=  "&ID2=" . "'";
                    $troleAddRoleDetails .= htmlEncode(trim(getValue($oRStrole->fields["BranchID"]))) . "'";
                    $troleAddRoleDetails .=  "&ID3=" . "'";
                    $troleAddRoleDetails .= htmlEncode(trim(getValue($oRStrole->fields["RoleID"]))) . "'";
            $tmpIMG_troleAddRoleDetails = "";
            $tmpIMG_troleAddRoleDetails = "<i class='icon-edit icon-white'></i> Add Role Details";
                $troleAddRoleDetails .= "\">" . $tmpIMG_troleAddRoleDetails . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStrole->fields["CountryID"])):
        $troleCountryID = "";
    else:
        $troleCountryID = htmlEncode(getValue($oRStrole->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStrole->fields["BranchID"])):
        $troleBranchID = "";
    else:
        $troleBranchID = htmlEncode(getValue($oRStrole->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleRoleIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStrole->fields["RoleID"])):
        $troleRoleID = "";
    else:
        $troleRoleID = htmlEncode(getValue($oRStrole->fields["RoleID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStrole->fields["Description"])):
        $troleDescription = "";
    else:
        $troleDescription = htmlEncode(getValue($oRStrole->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleSecurityLevelSTYLE = "TableRow" . $Style;
    if (is_null($oRStrole->fields["SecurityLevel"])):
        $troleSecurityLevel = "";
    else:
        $troleSecurityLevel = htmlEncode(getValue($oRStrole->fields["SecurityLevel"]));
endif;
$Seq++;
$oRStrole->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@troleAutomaticDetailLink@", $troleAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@troleAutomaticDetailLinkSTYLE@", $troleAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleAddRoleDetails@", $troleAddRoleDetails);
$DataRowFilledText = Replace($DataRowFilledText,"@troleAddRoleDetailsSTYLE@", $troleAddRoleDetailsSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleCountryID@", $troleCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troleCountryIDSTYLE@",$troleCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troleBranchID@", $troleBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troleBranchIDSTYLE@",$troleBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troleRoleID@", $troleRoleID);       
$DataRowFilledText = Replace($DataRowFilledText,"@troleRoleIDSTYLE@",$troleRoleIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troleDescription@", $troleDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@troleDescriptionSTYLE@",$troleDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@troleSecurityLevel@", $troleSecurityLevel);       
$DataRowFilledText = Replace($DataRowFilledText,"@troleSecurityLevelSTYLE@",$troleSecurityLevelSTYLE);           
        endwhile; // of oRStrole DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$troleAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@troleAutomaticDetailLinkSTYLE@", $troleAutomaticDetailLinkSTYLE);
$troleAddRoleDetailsSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleAddRoleDetails@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@troleAddRoleDetailsSTYLE@", $troleAddRoleDetailsSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleCountryID@", "&nbsp;");
$troleCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleCountryIDSTYLE@", $troleCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleBranchID@", "&nbsp;");
$troleBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleBranchIDSTYLE@", $troleBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleRoleID@", "&nbsp;");
$troleRoleIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleRoleIDSTYLE@", $troleRoleIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleDescription@", "&nbsp;");
$troleDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleDescriptionSTYLE@", $troleDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@troleSecurityLevel@", "&nbsp;");
$troleSecurityLevelSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@troleSecurityLevelSTYLE@", $troleSecurityLevelSTYLE);
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
global $oRStrole;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetrolesearch.php";
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
        $ref .= "<a href=Updatetrole" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetrole" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
