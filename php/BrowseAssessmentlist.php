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
$BrowseAssessmentRowData = "";
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
$tassessmentAutomaticDetailLink = "";
$tassessmentAutomaticDetailLinkSTYLE = "";
$tassessmentCountryIDLABEL = "";
$tassessmentCountryID = "";
$tassessmentCountryIDSTYLE = "";
$tassessmentBranchIDLABEL = "";
$tassessmentBranchID = "";
$tassessmentBranchIDSTYLE = "";
$tassessmentIDLABEL = "";
$tassessmentID = "";
$tassessmentIDSTYLE = "";
$tassessmentDescriptionLABEL = "";
$tassessmentDescription = "";
$tassessmentDescriptionSTYLE = "";
$oRStassessment = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseAssessment#WHR"] = "";
    $_SESSION["BrowseAssessment#COL"] = "";
    $_SESSION["BrowseAssessment#SRT"] = "";
    $_SESSION["BrowseAssessment#PreviousColumn"] = "";
    $_SESSION["BrowseAssessment#PreviousSort"] = "";
    $_SESSION["BrowseAssessment#mySort"] = "";
    $_SESSION["BrowseAssessment#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseAssessment#WHR"] = "";
        $_SESSION["BrowseAssessment#COL"] = "";
        $_SESSION["BrowseAssessment#SRT"] = "";
        $_SESSION["BrowseAssessment#PreviousColumn"] = "";
        $_SESSION["BrowseAssessment#PreviousSort"] = "";
        $_SESSION["BrowseAssessment#mySort"] = "";
        $_SESSION["BrowseAssessment#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseAssessment#COL"] = "";
            $_SESSION["BrowseAssessment#SRT"] = "";
            $_SESSION["BrowseAssessment#PreviousColumn"] = "";
            $_SESSION["BrowseAssessment#PreviousSort"] = "";
            $_SESSION["BrowseAssessment#mySort"] = "";
            $_SESSION["BrowseAssessment#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseAssessment#PreviousColumn"] = "";
else:
    $_SESSION["BrowseAssessment#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseAssessment#PreviousSort"] = "";
else:
    $_SESSION["BrowseAssessment#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseAssessment#COL") == ""):
    if (getRequest("COL") . getSession("BrowseAssessment#COL") == ""):
        $_SESSION["BrowseAssessment#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.CountryID DESC";
        $_SESSION["BrowseAssessment#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.CountryID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAssessment#PreviousColumn")):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.CountryID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAssessment#COL"] = "CountryID";
    $_SESSION["BrowseAssessment#SRT"] = getSession("BrowseAssessment#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.BranchID DESC";
        $_SESSION["BrowseAssessment#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.BranchID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAssessment#PreviousColumn")):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.BranchID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAssessment#COL"] = "BranchID";
    $_SESSION["BrowseAssessment#SRT"] = getSession("BrowseAssessment#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.ID DESC";
        $_SESSION["BrowseAssessment#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.ID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAssessment#PreviousColumn")):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.ID ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAssessment#COL"] = "ID";
    $_SESSION["BrowseAssessment#SRT"] = getSession("BrowseAssessment#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.Description DESC";
        $_SESSION["BrowseAssessment#mySort"] = "DESC";
    else:
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.Description ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseAssessment#PreviousColumn")):
        $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.Description ASC";
        $_SESSION["BrowseAssessment#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseAssessment#COL"] = "Description";
    $_SESSION["BrowseAssessment#SRT"] = getSession("BrowseAssessment#mySort");
endif;

$myQuery    = "SELECT tassessment.CountryID, tassessment.BranchID, tassessment.ID, tassessment.Description FROM tassessment";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseAssessment#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseAssessment#WHR") != ""):
    $myWhere    = getSession("BrowseAssessment#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseAssessment#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseAssessment#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseAssessment#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseAssessment#myOrder") == ""):
    $_SESSION["BrowseAssessment#myOrder"] = "ORDER BY tassessment.CountryID ASC";
    $_SESSION["BrowseAssessment#mySort"] = "ASC";
    $_SESSION["BrowseAssessment#COL"] = "CountryID";
    $_SESSION["BrowseAssessment#SRT"] = getSession("BrowseAssessment#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseAssessment#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseAssessment#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tassessment.CountryID) AS MyCount  FROM tassessment WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tassessment.CountryID) AS MyCount  FROM tassessment";
endif;
$oRStassessment = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStassessment->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStassessment->Close();
$oRStassessment = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseAssessment#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStassessment):
    if($oRStassessment->EOF != TRUE):
        if($oRStassessment->RecordCount() > 0):
            $oRStassessment->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseAssessment" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseAssessmentListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStassessment->Close();
unset($oRStassessment);

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
    $tmpMsg = "<a href='BrowseAssessment" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetassessment" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseAssessmentListTemplate($Template)
=============================================================================
*/
function MergeBrowseAssessmentListTemplate($Template) {
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
        $Template = "./html/BrowseAssessmentlist.htm";
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
            if ( getSession("BrowseAssessment#PreviousColumn") == "CountryID"):
                if (getSession("BrowseAssessment#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAssessment#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseAssessment#COL") == "CountryID" ):
            if (getSession("BrowseAssessment#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseAssessment#PreviousColumn") == "BranchID"):
                if (getSession("BrowseAssessment#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAssessment#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseAssessment#COL") == "BranchID" ):
            if (getSession("BrowseAssessment#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseAssessment#PreviousColumn") == "ID"):
                if (getSession("BrowseAssessment#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAssessment#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseAssessment#COL") == "ID" ):
            if (getSession("BrowseAssessment#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseAssessment#PreviousColumn") == "Description"):
                if (getSession("BrowseAssessment#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseAssessment#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseAssessment#COL") == "Description" ):
            if (getSession("BrowseAssessment#SRT") == "ASC"):
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
    global $oRStassessment;
    global $RecordsPageSize;
    global $tassessmentAutomaticDetailLink;
    global $tassessmentAutomaticDetailLinkSTYLE;
    global $tassessmentBranchID;
    global $tassessmentBranchIDLABEL;
    global $tassessmentBranchIDSTYLE;
    global $tassessmentCountryID;
    global $tassessmentCountryIDLABEL;
    global $tassessmentCountryIDSTYLE;
    global $tassessmentDescription;
    global $tassessmentDescriptionLABEL;
    global $tassessmentDescriptionSTYLE;
    global $tassessmentID;
    global $tassessmentIDLABEL;
    global $tassessmentIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStassessment) :
        while ((!$oRStassessment->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tassessmentAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetassessmentedit.php?ID1=";
                    $tassessmentAutomaticDetailLink = $myLink;
                      $tassessmentAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStassessment->fields["CountryID"]))) . "'" ;
                    $tassessmentAutomaticDetailLink .=  "&ID2=" . "'";
                    $tassessmentAutomaticDetailLink .= htmlEncode(trim(getValue($oRStassessment->fields["BranchID"]))) . "'";
                    $tassessmentAutomaticDetailLink .=  "&ID3=";
                    $tassessmentAutomaticDetailLink .= htmlEncode(trim(getValue($oRStassessment->fields["ID"])));
            $tmpIMG_tassessmentAutomaticDetailLink = "";
            $tmpIMG_tassessmentAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tassessmentAutomaticDetailLink .= "\">" . $tmpIMG_tassessmentAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tassessmentCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStassessment->fields["CountryID"])):
        $tassessmentCountryID = "";
    else:
        $tassessmentCountryID = htmlEncode(getValue($oRStassessment->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tassessmentBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStassessment->fields["BranchID"])):
        $tassessmentBranchID = "";
    else:
        $tassessmentBranchID = htmlEncode(getValue($oRStassessment->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tassessmentIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStassessment->fields["ID"])):
        $tassessmentID = "";
    else:
        $tassessmentID = htmlEncode(getValue($oRStassessment->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tassessmentDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStassessment->fields["Description"])):
        $tassessmentDescription = "";
    else:
        $tassessmentDescription = htmlEncode(getValue($oRStassessment->fields["Description"]));
endif;
$Seq++;
$oRStassessment->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentAutomaticDetailLink@", $tassessmentAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentAutomaticDetailLinkSTYLE@", $tassessmentAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentCountryID@", $tassessmentCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentCountryIDSTYLE@",$tassessmentCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentBranchID@", $tassessmentBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentBranchIDSTYLE@",$tassessmentBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentID@", $tassessmentID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentIDSTYLE@",$tassessmentIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentDescription@", $tassessmentDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentDescriptionSTYLE@",$tassessmentDescriptionSTYLE);           
        endwhile; // of oRStassessment DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tassessmentAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentAutomaticDetailLinkSTYLE@", $tassessmentAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentCountryID@", "&nbsp;");
$tassessmentCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentCountryIDSTYLE@", $tassessmentCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentBranchID@", "&nbsp;");
$tassessmentBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentBranchIDSTYLE@", $tassessmentBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentID@", "&nbsp;");
$tassessmentIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentIDSTYLE@", $tassessmentIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentDescription@", "&nbsp;");
$tassessmentDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tassessmentDescriptionSTYLE@", $tassessmentDescriptionSTYLE);
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
global $oRStassessment;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetassessmentsearch.php";
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
        $ref .= "<a href=Updatetassessment" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetassessment" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
