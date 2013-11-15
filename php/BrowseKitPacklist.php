<?PHP
session_set_cookie_params(500);
session_start();
unset($_SESSION['BrowseKitPack#WHR']);
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
global $idme;
$idme = $_GET['ID3'];
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


$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tkitpack  WHERE tkitpack.BranchID ='".$_SESSION['UserValue2']."' AND tkitpack.LevelID='".$_GET['ID3']."'";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;

$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseKitPackRowData = "";
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
$tkitpackAutomaticDetailLink = "";
$tkitpackAutomaticDetailLinkSTYLE = "";
$tkitpackCountryIDLABEL = "";
$tkitpackCountryID = "";
$tkitpackCountryIDSTYLE = "";
$tkitpackBranchIDLABEL = "";
$tkitpackBranchID = "";
$tkitpackBranchIDSTYLE = "";
$tkitpackLevelIDLABEL = "";
$tkitpackLevelID = "";
$tkitpackLevelIDSTYLE = "";
$tkitpackItemNoLABEL = "";
$tkitpackItemNo = "";
$tkitpackItemNoSTYLE = "";
$tkitpackDescriptionLABEL = "";
$tkitpackDescription = "";
$tkitpackDescriptionSTYLE = "";
$tkitpackQtyLABEL = "";
$tkitpackQty = "";
$tkitpackQtySTYLE = "";
$oRStkitpack = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseKitPack#WHR"] = "";
    $_SESSION["BrowseKitPack#COL"] = "";
    $_SESSION["BrowseKitPack#SRT"] = "";
    $_SESSION["BrowseKitPack#PreviousColumn"] = "";
    $_SESSION["BrowseKitPack#PreviousSort"] = "";
    $_SESSION["BrowseKitPack#mySort"] = "";
    $_SESSION["BrowseKitPack#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseKitPack#WHR"] = "";
        $_SESSION["BrowseKitPack#COL"] = "";
        $_SESSION["BrowseKitPack#SRT"] = "";
        $_SESSION["BrowseKitPack#PreviousColumn"] = "";
        $_SESSION["BrowseKitPack#PreviousSort"] = "";
        $_SESSION["BrowseKitPack#mySort"] = "";
        $_SESSION["BrowseKitPack#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseKitPack#COL"] = "";
            $_SESSION["BrowseKitPack#SRT"] = "";
            $_SESSION["BrowseKitPack#PreviousColumn"] = "";
            $_SESSION["BrowseKitPack#PreviousSort"] = "";
            $_SESSION["BrowseKitPack#mySort"] = "";
            $_SESSION["BrowseKitPack#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseKitPack#PreviousColumn"] = "";
else:
    $_SESSION["BrowseKitPack#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseKitPack#PreviousSort"] = "";
else:
    $_SESSION["BrowseKitPack#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseKitPack#COL") == ""):
    if (getRequest("COL") . getSession("BrowseKitPack#COL") == ""):
        $_SESSION["BrowseKitPack#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.CountryID DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.CountryID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.CountryID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "CountryID";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.BranchID DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.BranchID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.BranchID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "BranchID";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

if (getRequest("COL") == "LevelID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.LevelID DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.LevelID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.LevelID ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "LevelID";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

if (getRequest("COL") == "ItemNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.ItemNo DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.ItemNo ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.ItemNo ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "ItemNo";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Description DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Description ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Description ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "Description";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

if (getRequest("COL") == "Qty"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Qty DESC";
        $_SESSION["BrowseKitPack#mySort"] = "DESC";
    else:
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Qty ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseKitPack#PreviousColumn")):
        $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.Qty ASC";
        $_SESSION["BrowseKitPack#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseKitPack#COL"] = "Qty";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

$myQuery    = "SELECT tkitpack.CountryID, tkitpack.BranchID, tkitpack.LevelID, tkitpack.ItemNo, tkitpack.Description, tkitpack.Qty, tkitpack.BookCount, tkitpack.StartBookNo, tkitpack.Itemtype FROM tkitpack";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseKitPack#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseKitPack#WHR") != ""):
    $myWhere    = getSession("BrowseKitPack#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseKitPack#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseKitPack#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseKitPack#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseKitPack#myOrder") == ""):
    $_SESSION["BrowseKitPack#myOrder"] = "ORDER BY tkitpack.CountryID ASC";
    $_SESSION["BrowseKitPack#mySort"] = "ASC";
    $_SESSION["BrowseKitPack#COL"] = "CountryID";
    $_SESSION["BrowseKitPack#SRT"] = getSession("BrowseKitPack#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseKitPack#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseKitPack#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tkitpack.CountryID) AS MyCount  FROM tkitpack WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tkitpack.CountryID) AS MyCount  FROM tkitpack";
endif;
$oRStkitpack = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStkitpack->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStkitpack->Close();
$oRStkitpack = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseKitPack#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStkitpack):
    if($oRStkitpack->EOF != TRUE):
        if($oRStkitpack->RecordCount() > 0):
            $oRStkitpack->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseKitPack" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseKitPackListTemplate($HTML_Template);
        else:
            MergeBrowseKitPackListTemplate($HTML_Template);
        endif;
    else:
        MergeBrowseKitPackListTemplate($HTML_Template);
    endif;
else:
    MergeBrowseKitPackListTemplate($HTML_Template);
endif;

$oRStkitpack->Close();
unset($oRStkitpack);

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
    $tmpMsg = "<a href='BrowseKitPack" . "list.php?Level=".$_GET['ID3'].">No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetkitpack" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseKitPackListTemplate($Template)
=============================================================================
*/
function MergeBrowseKitPackListTemplate($Template) {
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
    global $idl; 

    $idl = $_GET['ID3']; 
    if($Template == ""):
        $Template = "./html/BrowseKitPacklist.htm";
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
    $idl = $_GET['ID3'];

    $add = "<a class='btn btn-info' href='Updatetkitpackadd.php?Level=".$_GET['ID3']."'>Add Item</a>";


    $TemplateText = Replace($TemplateText,"@add@", $add);

    include('Conninfo.php');
    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
     
    $sql = "SELECT *  FROM  tlevel WHERE  tlevel.ID = '" . $_GET['ID3'] . "'" ;
    $mylevel = $objConn1->Execute($sql);
    $ourlevel =$mylevel->fields["Description"];
    $TemplateText = Replace($TemplateText, "@ourlevel@", $ourlevel);
     
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
            if ( getSession("BrowseKitPack#PreviousColumn") == "CountryID"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseKitPack#COL") == "CountryID" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseKitPack#PreviousColumn") == "BranchID"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseKitPack#COL") == "BranchID" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LevelID";
            if ( getSession("BrowseKitPack#PreviousColumn") == "LevelID"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "LevelID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level ID</a>";
        $LevelIDLABEL = $myLink;
        if ( getGet("COL") == "LevelID" || getSession("BrowseKitPack#COL") == "LevelID" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $LevelIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LevelIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ItemNo";
            if ( getSession("BrowseKitPack#PreviousColumn") == "ItemNo"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "ItemNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Item No</a>";
        $ItemNoLABEL = $myLink;
        if ( getGet("COL") == "ItemNo" || getSession("BrowseKitPack#COL") == "ItemNo" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $ItemNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ItemNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseKitPack#PreviousColumn") == "Description"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseKitPack#COL") == "Description" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Qty";
            if ( getSession("BrowseKitPack#PreviousColumn") == "Qty"):
                if (getSession("BrowseKitPack#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseKitPack#COL") == "Qty"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Qty</a>";
        $QtyLABEL = $myLink;
        if ( getGet("COL") == "Qty" || getSession("BrowseKitPack#COL") == "Qty" ):
            if (getSession("BrowseKitPack#SRT") == "ASC"):
                $QtyLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $QtyLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@LevelIDLABEL@", $LevelIDLABEL);
$HeaderText = Replace($HeaderText,"@ItemNoLABEL@", $ItemNoLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@QtyLABEL@", $QtyLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStkitpack;
    global $RecordsPageSize;
    global $tkitpackAutomaticDetailLink;
    global $tkitpackAutomaticDetailLinkSTYLE;
    global $tkitpackBranchID;
    global $tkitpackBranchIDLABEL;
    global $tkitpackBranchIDSTYLE;
    global $tkitpackCountryID;
    global $tkitpackCountryIDLABEL;
    global $tkitpackCountryIDSTYLE;
    global $tkitpackDescription;
    global $tkitpackDescriptionLABEL;
    global $tkitpackDescriptionSTYLE;
    global $tkitpackItemNo;
    global $tkitpackItemNoLABEL;
    global $tkitpackItemNoSTYLE;
    global $tkitpackLevelID;
    global $tkitpackLevelIDLABEL;
    global $tkitpackLevelIDSTYLE;
    global $tkitpackQty;
    global $tkitpackQtyLABEL;
    global $tkitpackQtySTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStkitpack) :
        while ((!$oRStkitpack->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tkitpackAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetkitpackedit.php?ID1=";
                    $tkitpackAutomaticDetailLink = $myLink;
                      $tkitpackAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStkitpack->fields["CountryID"]))) . "'" ;
                    $tkitpackAutomaticDetailLink .=  "&ID2=" . "'";
                    $tkitpackAutomaticDetailLink .= htmlEncode(trim(getValue($oRStkitpack->fields["BranchID"]))) . "'";
                    $tkitpackAutomaticDetailLink .=  "&ID3=";
                    $tkitpackAutomaticDetailLink .= htmlEncode(trim(getValue($oRStkitpack->fields["LevelID"])));
                    $tkitpackAutomaticDetailLink .=  "&ID4=" . "'";
                    $tkitpackAutomaticDetailLink .= htmlEncode(trim(getValue($oRStkitpack->fields["ItemNo"]))) . "'";

            $tmpIMG_tkitpackAutomaticDetailLink = "";
            $tmpIMG_tkitpackAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tkitpackAutomaticDetailLink .= "\">" . $tmpIMG_tkitpackAutomaticDetailLink . "</a>";

                $itemnolink = htmlEncode(trim(getValue($oRStkitpack->fields["ItemNo"])));
                $scriptdel  = "return confirm('Are you sure you want to remove this?');";
                $deletekit = '<a  onclick="'.$scriptdel.'" class="btn btn-danger" href="template/delete.php?Page=kit&Level='.$_GET['ID3'].'&Itemno='.$itemnolink.'"><i class="icon-trash icon-white"></i>Delete</a>';



    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["CountryID"])):
        $tkitpackCountryID = "";
    else:
        $tkitpackCountryID = htmlEncode(getValue($oRStkitpack->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["BranchID"])):
        $tkitpackBranchID = "";
    else:
        $tkitpackBranchID = htmlEncode(getValue($oRStkitpack->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackLevelIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["LevelID"])):
        $tkitpackLevelID = "";
    else:
        $tkitpackLevelID = htmlEncode(getValue($oRStkitpack->fields["LevelID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackItemNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["ItemNo"])):
        $tkitpackItemNo = "";
    else:
        $tkitpackItemNo = htmlEncode(getValue($oRStkitpack->fields["ItemNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["Description"])):
        $tkitpackDescription = "";
    else:
        $tkitpackDescription = htmlEncode(getValue($oRStkitpack->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackQtySTYLE = "TableRow" . $Style;
    if (is_null($oRStkitpack->fields["Qty"])):
        $tkitpackQty = "";
    else:
        $tkitpackQty = htmlEncode(getValue($oRStkitpack->fields["Qty"]));
endif;
$Seq++;
$oRStkitpack->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackAutomaticDetailLink@", $tkitpackAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@deletekit@", $deletekit);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackAutomaticDetailLinkSTYLE@", $tkitpackAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackCountryID@", $tkitpackCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackCountryIDSTYLE@",$tkitpackCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackBranchID@", $tkitpackBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackBranchIDSTYLE@",$tkitpackBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackLevelID@", $tkitpackLevelID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackLevelIDSTYLE@",$tkitpackLevelIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackItemNo@", $tkitpackItemNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackItemNoSTYLE@",$tkitpackItemNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackDescription@", $tkitpackDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackDescriptionSTYLE@",$tkitpackDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackQty@", $tkitpackQty);       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackQtySTYLE@",$tkitpackQtySTYLE);           
        endwhile; // of oRStkitpack DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tkitpackAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackAutomaticDetailLinkSTYLE@", $tkitpackAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackCountryID@", "&nbsp;");
$tkitpackCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackCountryIDSTYLE@", $tkitpackCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackBranchID@", "&nbsp;");
$tkitpackBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackBranchIDSTYLE@", $tkitpackBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackLevelID@", "&nbsp;");
$tkitpackLevelIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackLevelIDSTYLE@", $tkitpackLevelIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackItemNo@", "&nbsp;");
$tkitpackItemNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackItemNoSTYLE@", $tkitpackItemNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackDescription@", "&nbsp;");
$tkitpackDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackDescriptionSTYLE@", $tkitpackDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackQty@", "&nbsp;");
$tkitpackQtySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tkitpackQtySTYLE@", $tkitpackQtySTYLE);
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
global $oRStkitpack;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetkitpacksearch.php";
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
        $ref .= "<a href=Updatetkitpack" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetkitpack" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
