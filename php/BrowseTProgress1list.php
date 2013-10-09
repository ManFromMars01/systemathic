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
$BrowseTProgress1RowData = "";
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
$tprogress1AutomaticDetailLink = "";
$tprogress1AutomaticDetailLinkSTYLE = "";
$tprogress1ProgressLevel2 = "";
$tprogress1ProgressLevel2STYLE = "";
$tprogress1CountryIDLABEL = "";
$tprogress1CountryID = "";
$tprogress1CountryIDSTYLE = "";
$tprogress1BranchIDLABEL = "";
$tprogress1BranchID = "";
$tprogress1BranchIDSTYLE = "";
$tprogress1Level1IDLABEL = "";
$tprogress1Level1ID = "";
$tprogress1Level1IDSTYLE = "";
$tprogress1DescriptionLABEL = "";
$tprogress1Description = "";
$tprogress1DescriptionSTYLE = "";
$oRStprogress1 = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTProgress1#WHR"] = "";
    $_SESSION["BrowseTProgress1#COL"] = "";
    $_SESSION["BrowseTProgress1#SRT"] = "";
    $_SESSION["BrowseTProgress1#PreviousColumn"] = "";
    $_SESSION["BrowseTProgress1#PreviousSort"] = "";
    $_SESSION["BrowseTProgress1#mySort"] = "";
    $_SESSION["BrowseTProgress1#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTProgress1#WHR"] = "";
        $_SESSION["BrowseTProgress1#COL"] = "";
        $_SESSION["BrowseTProgress1#SRT"] = "";
        $_SESSION["BrowseTProgress1#PreviousColumn"] = "";
        $_SESSION["BrowseTProgress1#PreviousSort"] = "";
        $_SESSION["BrowseTProgress1#mySort"] = "";
        $_SESSION["BrowseTProgress1#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTProgress1#COL"] = "";
            $_SESSION["BrowseTProgress1#SRT"] = "";
            $_SESSION["BrowseTProgress1#PreviousColumn"] = "";
            $_SESSION["BrowseTProgress1#PreviousSort"] = "";
            $_SESSION["BrowseTProgress1#mySort"] = "";
            $_SESSION["BrowseTProgress1#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTProgress1#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTProgress1#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTProgress1#PreviousSort"] = "";
else:
    $_SESSION["BrowseTProgress1#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTProgress1#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTProgress1#COL") == ""):
        $_SESSION["BrowseTProgress1#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.CountryID DESC";
        $_SESSION["BrowseTProgress1#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.CountryID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress1#PreviousColumn")):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.CountryID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress1#COL"] = "CountryID";
    $_SESSION["BrowseTProgress1#SRT"] = getSession("BrowseTProgress1#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.BranchID DESC";
        $_SESSION["BrowseTProgress1#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.BranchID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress1#PreviousColumn")):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.BranchID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress1#COL"] = "BranchID";
    $_SESSION["BrowseTProgress1#SRT"] = getSession("BrowseTProgress1#mySort");
endif;

if (getRequest("COL") == "Level1ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Level1ID DESC";
        $_SESSION["BrowseTProgress1#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Level1ID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress1#PreviousColumn")):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Level1ID ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress1#COL"] = "Level1ID";
    $_SESSION["BrowseTProgress1#SRT"] = getSession("BrowseTProgress1#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Description DESC";
        $_SESSION["BrowseTProgress1#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Description ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTProgress1#PreviousColumn")):
        $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.Description ASC";
        $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTProgress1#COL"] = "Description";
    $_SESSION["BrowseTProgress1#SRT"] = getSession("BrowseTProgress1#mySort");
endif;

$myQuery    = "SELECT tprogress1.CountryID, tprogress1.BranchID, tprogress1.Level1ID, tprogress1.Description FROM tprogress1";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTProgress1#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTProgress1#WHR") != ""):
    $myWhere    = getSession("BrowseTProgress1#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTProgress1#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTProgress1#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTProgress1#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTProgress1#myOrder") == ""):
    $_SESSION["BrowseTProgress1#myOrder"] = "ORDER BY tprogress1.CountryID ASC";
    $_SESSION["BrowseTProgress1#mySort"] = "ASC";
    $_SESSION["BrowseTProgress1#COL"] = "CountryID";
    $_SESSION["BrowseTProgress1#SRT"] = getSession("BrowseTProgress1#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTProgress1#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTProgress1#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tprogress1.CountryID) AS MyCount  FROM tprogress1 WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tprogress1.CountryID) AS MyCount  FROM tprogress1";
endif;
$oRStprogress1 = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStprogress1->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStprogress1->Close();
$oRStprogress1 = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTProgress1#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStprogress1):
    if($oRStprogress1->EOF != TRUE):
        if($oRStprogress1->RecordCount() > 0):
            $oRStprogress1->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTProgress1" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTProgress1ListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStprogress1->Close();
unset($oRStprogress1);

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
    $tmpMsg = "<a href='BrowseTProgress1" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetprogress1" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTProgress1ListTemplate($Template)
=============================================================================
*/
function MergeBrowseTProgress1ListTemplate($Template) {
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
        $Template = "./html/BrowseTProgress1list.htm";
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
            if ( getSession("BrowseTProgress1#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTProgress1#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress1#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTProgress1#COL") == "CountryID" ):
            if (getSession("BrowseTProgress1#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTProgress1#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTProgress1#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress1#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTProgress1#COL") == "BranchID" ):
            if (getSession("BrowseTProgress1#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Level1ID";
            if ( getSession("BrowseTProgress1#PreviousColumn") == "Level1ID"):
                if (getSession("BrowseTProgress1#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress1#COL") == "Level1ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Level 1 ID</a>";
        $Level1IDLABEL = $myLink;
        if ( getGet("COL") == "Level1ID" || getSession("BrowseTProgress1#COL") == "Level1ID" ):
            if (getSession("BrowseTProgress1#SRT") == "ASC"):
                $Level1IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $Level1IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseTProgress1#PreviousColumn") == "Description"):
                if (getSession("BrowseTProgress1#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTProgress1#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseTProgress1#COL") == "Description" ):
            if (getSession("BrowseTProgress1#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@Level1IDLABEL@", $Level1IDLABEL);
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
    global $oRStprogress1;
    global $RecordsPageSize;
    global $tprogress1AutomaticDetailLink;
    global $tprogress1AutomaticDetailLinkSTYLE;
    global $tprogress1BranchID;
    global $tprogress1BranchIDLABEL;
    global $tprogress1BranchIDSTYLE;
    global $tprogress1CountryID;
    global $tprogress1CountryIDLABEL;
    global $tprogress1CountryIDSTYLE;
    global $tprogress1Description;
    global $tprogress1DescriptionLABEL;
    global $tprogress1DescriptionSTYLE;
    global $tprogress1Level1ID;
    global $tprogress1Level1IDLABEL;
    global $tprogress1Level1IDSTYLE;
    global $tprogress1ProgressLevel2;
    global $tprogress1ProgressLevel2STYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStprogress1) :
        while ((!$oRStprogress1->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tprogress1AutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetprogress1edit.php?ID1=";
                    $tprogress1AutomaticDetailLink = $myLink;
                      $tprogress1AutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStprogress1->fields["CountryID"]))) . "'" ;
                    $tprogress1AutomaticDetailLink .=  "&ID2=" . "'";
                    $tprogress1AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress1->fields["BranchID"]))) . "'";
                    $tprogress1AutomaticDetailLink .=  "&ID3=" . "'";
                    $tprogress1AutomaticDetailLink .= htmlEncode(trim(getValue($oRStprogress1->fields["Level1ID"]))) . "'";
            $tmpIMG_tprogress1AutomaticDetailLink = "";
            $tmpIMG_tprogress1AutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tprogress1AutomaticDetailLink .= "\">" . $tmpIMG_tprogress1AutomaticDetailLink . "</a>";
    $tprogress1ProgressLevel2STYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"BrowseTProgress2list.php?ID1=";
                    $tprogress1ProgressLevel2 = $myLink;
                      $tprogress1ProgressLevel2 .= "'" . htmlEncode(trim(getValue($oRStprogress1->fields["CountryID"]))) . "'" ;
                    $tprogress1ProgressLevel2 .=  "&ID2=" . "'";
                    $tprogress1ProgressLevel2 .= htmlEncode(trim(getValue($oRStprogress1->fields["BranchID"]))) . "'";
                    $tprogress1ProgressLevel2 .=  "&ID3=" . "'";
                    $tprogress1ProgressLevel2 .= htmlEncode(trim(getValue($oRStprogress1->fields["Level1ID"]))) . "'";
            $tmpIMG_tprogress1ProgressLevel2 = "";
            $tmpIMG_tprogress1ProgressLevel2 = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Define Criteria\">";
                $tprogress1ProgressLevel2 .= "\">" . $tmpIMG_tprogress1ProgressLevel2 . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress1CountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress1->fields["CountryID"])):
        $tprogress1CountryID = "";
    else:
        $tprogress1CountryID = htmlEncode(getValue($oRStprogress1->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress1BranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress1->fields["BranchID"])):
        $tprogress1BranchID = "";
    else:
        $tprogress1BranchID = htmlEncode(getValue($oRStprogress1->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress1Level1IDSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress1->fields["Level1ID"])):
        $tprogress1Level1ID = "";
    else:
        $myQuoteLevel1ID = "\"";
        $tprogress1Level1ID = '<a href=\'JAVASCRIPT:updateData(';
        $tprogress1Level1ID .= $myQuoteLevel1ID . htmlEncode(getValue($oRStprogress1->fields["Level1ID"])) . $myQuoteLevel1ID;
        $tprogress1Level1ID .= ');\'>';
        $tprogress1Level1ID .= htmlEncode(getValue($oRStprogress1->fields["Level1ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress1DescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStprogress1->fields["Description"])):
        $tprogress1Description = "";
    else:
        $tprogress1Description = htmlEncode(getValue($oRStprogress1->fields["Description"]));
endif;
$Seq++;
$oRStprogress1->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1AutomaticDetailLink@", $tprogress1AutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1AutomaticDetailLinkSTYLE@", $tprogress1AutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1ProgressLevel2@", $tprogress1ProgressLevel2);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1ProgressLevel2STYLE@", $tprogress1ProgressLevel2STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1CountryID@", $tprogress1CountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1CountryIDSTYLE@",$tprogress1CountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1BranchID@", $tprogress1BranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1BranchIDSTYLE@",$tprogress1BranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Level1ID@", $tprogress1Level1ID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Level1IDSTYLE@",$tprogress1Level1IDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Description@", $tprogress1Description);       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1DescriptionSTYLE@",$tprogress1DescriptionSTYLE);           
        endwhile; // of oRStprogress1 DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tprogress1AutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1AutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1AutomaticDetailLinkSTYLE@", $tprogress1AutomaticDetailLinkSTYLE);
$tprogress1ProgressLevel2STYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1ProgressLevel2@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1ProgressLevel2STYLE@", $tprogress1ProgressLevel2STYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1CountryID@", "&nbsp;");
$tprogress1CountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1CountryIDSTYLE@", $tprogress1CountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1BranchID@", "&nbsp;");
$tprogress1BranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1BranchIDSTYLE@", $tprogress1BranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Level1ID@", "&nbsp;");
$tprogress1Level1IDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Level1IDSTYLE@", $tprogress1Level1IDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1Description@", "&nbsp;");
$tprogress1DescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tprogress1DescriptionSTYLE@", $tprogress1DescriptionSTYLE);
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
global $oRStprogress1;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetprogress1search.php";
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
        $ref .= "<a href=Updatetprogress1" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetprogress1" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
