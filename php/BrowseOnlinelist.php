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
$BrowseOnlineRowData = "";
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
$eonlineAutomaticDetailLink = "";
$eonlineAutomaticDetailLinkSTYLE = "";
$eonlineCountryIDLABEL = "";
$eonlineCountryID = "";
$eonlineCountryIDSTYLE = "";
$eonlineBranchIDLABEL = "";
$eonlineBranchID = "";
$eonlineBranchIDSTYLE = "";
$tcustomerSurNameLABEL = "";
$tcustomerSurName = "";
$tcustomerSurNameSTYLE = "";
$tcustomerFirstNameLABEL = "";
$tcustomerFirstName = "";
$tcustomerFirstNameSTYLE = "";
$tcustomerMiddleNameLABEL = "";
$tcustomerMiddleName = "";
$tcustomerMiddleNameSTYLE = "";
$eonlineDateLABEL = "";
$eonlineDate = "";
$eonlineDateSTYLE = "";
$eonlinePasswordLABEL = "";
$eonlinePassword = "";
$eonlinePasswordSTYLE = "";
$oRSeonline = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseOnline#WHR"] = "";
    $_SESSION["BrowseOnline#COL"] = "";
    $_SESSION["BrowseOnline#SRT"] = "";
    $_SESSION["BrowseOnline#PreviousColumn"] = "";
    $_SESSION["BrowseOnline#PreviousSort"] = "";
    $_SESSION["BrowseOnline#mySort"] = "";
    $_SESSION["BrowseOnline#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseOnline#WHR"] = "";
        $_SESSION["BrowseOnline#COL"] = "";
        $_SESSION["BrowseOnline#SRT"] = "";
        $_SESSION["BrowseOnline#PreviousColumn"] = "";
        $_SESSION["BrowseOnline#PreviousSort"] = "";
        $_SESSION["BrowseOnline#mySort"] = "";
        $_SESSION["BrowseOnline#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseOnline#COL"] = "";
            $_SESSION["BrowseOnline#SRT"] = "";
            $_SESSION["BrowseOnline#PreviousColumn"] = "";
            $_SESSION["BrowseOnline#PreviousSort"] = "";
            $_SESSION["BrowseOnline#mySort"] = "";
            $_SESSION["BrowseOnline#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseOnline#PreviousColumn"] = "";
else:
    $_SESSION["BrowseOnline#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseOnline#PreviousSort"] = "";
else:
    $_SESSION["BrowseOnline#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseOnline#COL") == ""):
    if (getRequest("COL") . getSession("BrowseOnline#COL") == ""):
        $_SESSION["BrowseOnline#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.CountryID DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.CountryID ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.CountryID ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "CountryID";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.BranchID DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.BranchID ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.BranchID ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "BranchID";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "SurName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.SurName DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.SurName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "SurName";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "FirstName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.FirstName DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.FirstName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "FirstName";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "MiddleName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.MiddleName DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY tcustomer.MiddleName ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "MiddleName";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "Date"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Date DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Date ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Date ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "Date";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

if (getRequest("COL") == "Password"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Password DESC";
        $_SESSION["BrowseOnline#mySort"] = "DESC";
    else:
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Password ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseOnline#PreviousColumn")):
        $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.Password ASC";
        $_SESSION["BrowseOnline#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseOnline#COL"] = "Password";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

$myQuery    = "SELECT eonline.CountryID, eonline.BranchID, eonline.CustNo, tcustomer.SurName, tcustomer.FirstName, tcustomer.MiddleName, eonline.Date, eonline.Password FROM eonline  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eonline.CountryID AND  tcustomer.BranchID = eonline.BranchID AND  tcustomer.CustNo = eonline.CustNo";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseOnline#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseOnline#WHR") != ""):
    $myWhere    = getSession("BrowseOnline#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseOnline#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseOnline#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseOnline#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"eonline", "eonline.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "eonline.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseOnline#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseOnline#myOrder") == ""):
    $_SESSION["BrowseOnline#myOrder"] = "ORDER BY eonline.CountryID ASC";
    $_SESSION["BrowseOnline#mySort"] = "ASC";
    $_SESSION["BrowseOnline#COL"] = "CountryID";
    $_SESSION["BrowseOnline#SRT"] = getSession("BrowseOnline#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseOnline#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseOnline#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(eonline.CountryID) AS MyCount  FROM eonline  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eonline.CountryID AND  tcustomer.BranchID = eonline.BranchID AND  tcustomer.CustNo = eonline.CustNo WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(eonline.CountryID) AS MyCount  FROM eonline  LEFT OUTER JOIN  tcustomer ON tcustomer.CountryID = eonline.CountryID AND  tcustomer.BranchID = eonline.BranchID AND  tcustomer.CustNo = eonline.CustNo";
endif;
$oRSeonline = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRSeonline->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRSeonline->Close();
$oRSeonline = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseOnline#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRSeonline):
    if($oRSeonline->EOF != TRUE):
        if($oRSeonline->RecordCount() > 0):
            $oRSeonline->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseOnline" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseOnlineListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRSeonline->Close();
unset($oRSeonline);

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
    $tmpMsg = "<a href='BrowseOnline" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updateeonline" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseOnlineListTemplate($Template)
=============================================================================
*/
function MergeBrowseOnlineListTemplate($Template) {
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
        $Template = "./html/BrowseOnlinelist.htm";
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
            if ( getSession("BrowseOnline#PreviousColumn") == "CountryID"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseOnline#COL") == "CountryID" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseOnline#PreviousColumn") == "BranchID"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseOnline#COL") == "BranchID" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=SurName";
            if ( getSession("BrowseOnline#PreviousColumn") == "SurName"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "SurName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Sur Name</a>";
        $SurNameLABEL = $myLink;
        if ( getGet("COL") == "SurName" || getSession("BrowseOnline#COL") == "SurName" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $SurNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $SurNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=FirstName";
            if ( getSession("BrowseOnline#PreviousColumn") == "FirstName"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "FirstName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">First Name</a>";
        $FirstNameLABEL = $myLink;
        if ( getGet("COL") == "FirstName" || getSession("BrowseOnline#COL") == "FirstName" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $FirstNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $FirstNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MiddleName";
            if ( getSession("BrowseOnline#PreviousColumn") == "MiddleName"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "MiddleName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Middle Name</a>";
        $MiddleNameLABEL = $myLink;
        if ( getGet("COL") == "MiddleName" || getSession("BrowseOnline#COL") == "MiddleName" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $MiddleNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MiddleNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Date";
            if ( getSession("BrowseOnline#PreviousColumn") == "Date"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "Date"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Date</a>";
        $DateLABEL = $myLink;
        if ( getGet("COL") == "Date" || getSession("BrowseOnline#COL") == "Date" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $DateLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DateLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Password";
            if ( getSession("BrowseOnline#PreviousColumn") == "Password"):
                if (getSession("BrowseOnline#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseOnline#COL") == "Password"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Password</a>";
        $PasswordLABEL = $myLink;
        if ( getGet("COL") == "Password" || getSession("BrowseOnline#COL") == "Password" ):
            if (getSession("BrowseOnline#SRT") == "ASC"):
                $PasswordLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PasswordLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@SurNameLABEL@", $SurNameLABEL);
$HeaderText = Replace($HeaderText,"@FirstNameLABEL@", $FirstNameLABEL);
$HeaderText = Replace($HeaderText,"@MiddleNameLABEL@", $MiddleNameLABEL);
$HeaderText = Replace($HeaderText,"@DateLABEL@", $DateLABEL);
$HeaderText = Replace($HeaderText,"@PasswordLABEL@", $PasswordLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRSeonline;
    global $RecordsPageSize;
    global $eonlineAutomaticDetailLink;
    global $eonlineAutomaticDetailLinkSTYLE;
    global $eonlineBranchID;
    global $eonlineBranchIDLABEL;
    global $eonlineBranchIDSTYLE;
    global $eonlineCountryID;
    global $eonlineCountryIDLABEL;
    global $eonlineCountryIDSTYLE;
    global $eonlineDate;
    global $eonlineDateLABEL;
    global $eonlineDateSTYLE;
    global $eonlinePassword;
    global $eonlinePasswordLABEL;
    global $eonlinePasswordSTYLE;
    global $tcustomerFirstName;
    global $tcustomerFirstNameLABEL;
    global $tcustomerFirstNameSTYLE;
    global $tcustomerMiddleName;
    global $tcustomerMiddleNameLABEL;
    global $tcustomerMiddleNameSTYLE;
    global $tcustomerSurName;
    global $tcustomerSurNameLABEL;
    global $tcustomerSurNameSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRSeonline) :
        while ((!$oRSeonline->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $eonlineAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updateeonlineedit.php?ID1=";
                    $eonlineAutomaticDetailLink = $myLink;
                      $eonlineAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRSeonline->fields["CountryID"]))) . "'" ;
                    $eonlineAutomaticDetailLink .=  "&ID2=" . "'";
                    $eonlineAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeonline->fields["BranchID"]))) . "'";
                    $eonlineAutomaticDetailLink .=  "&ID3=";
                    $eonlineAutomaticDetailLink .= htmlEncode(trim(getValue($oRSeonline->fields["CustNo"])));
            $tmpIMG_eonlineAutomaticDetailLink = "";
            $tmpIMG_eonlineAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $eonlineAutomaticDetailLink .= "\">" . $tmpIMG_eonlineAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eonlineCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["CountryID"])):
        $eonlineCountryID = "";
    else:
        $eonlineCountryID = htmlEncode(getValue($oRSeonline->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eonlineBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["BranchID"])):
        $eonlineBranchID = "";
    else:
        $eonlineBranchID = htmlEncode(getValue($oRSeonline->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerSurNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["SurName"])):
        $tcustomerSurName = "";
    else:
        $tcustomerSurName = htmlEncode(getValue($oRSeonline->fields["SurName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["FirstName"])):
        $tcustomerFirstName = "";
    else:
        $tcustomerFirstName = htmlEncode(getValue($oRSeonline->fields["FirstName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["MiddleName"])):
        $tcustomerMiddleName = "";
    else:
        $tcustomerMiddleName = htmlEncode(getValue($oRSeonline->fields["MiddleName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eonlineDateSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["Date"])):
        $eonlineDate = "";
    else:
        $eonlineDate = htmlEncode(getValue($oRSeonline->fields["Date"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eonlinePasswordSTYLE = "TableRow" . $Style;
    if (is_null($oRSeonline->fields["Password"])):
        $eonlinePassword = "";
    else:
        $eonlinePassword = htmlEncode(getValue($oRSeonline->fields["Password"]));
endif;
$Seq++;
$oRSeonline->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@eonlineAutomaticDetailLink@", $eonlineAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineAutomaticDetailLinkSTYLE@", $eonlineAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineCountryID@", $eonlineCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineCountryIDSTYLE@",$eonlineCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineBranchID@", $eonlineBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineBranchIDSTYLE@",$eonlineBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", $tcustomerSurName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@",$tcustomerSurNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", $tcustomerFirstName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@",$tcustomerFirstNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", $tcustomerMiddleName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@",$tcustomerMiddleNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineDate@", $eonlineDate);       
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineDateSTYLE@",$eonlineDateSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@eonlinePassword@", $eonlinePassword);       
$DataRowFilledText = Replace($DataRowFilledText,"@eonlinePasswordSTYLE@",$eonlinePasswordSTYLE);           
        endwhile; // of oRSeonline DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$eonlineAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineAutomaticDetailLinkSTYLE@", $eonlineAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineCountryID@", "&nbsp;");
$eonlineCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineCountryIDSTYLE@", $eonlineCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineBranchID@", "&nbsp;");
$eonlineBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineBranchIDSTYLE@", $eonlineBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurName@", "&nbsp;");
$tcustomerSurNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerSurNameSTYLE@", $tcustomerSurNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstName@", "&nbsp;");
$tcustomerFirstNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerFirstNameSTYLE@", $tcustomerFirstNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleName@", "&nbsp;");
$tcustomerMiddleNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcustomerMiddleNameSTYLE@", $tcustomerMiddleNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineDate@", "&nbsp;");
$eonlineDateSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eonlineDateSTYLE@", $eonlineDateSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@eonlinePassword@", "&nbsp;");
$eonlinePasswordSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@eonlinePasswordSTYLE@", $eonlinePasswordSTYLE);
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
global $oRSeonline;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updateeonlinesearch.php";
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
        $ref .= "<a href=Updateeonline" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updateeonline" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
