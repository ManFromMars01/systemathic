<?PHP
session_start();
include('template/myclass.php');
not_logins();
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
$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tdepartment  WHERE tdepartment.CountryID ='".$_SESSION['UserValue1']."' AND tdepartment.BranchID = '".$_SESSION['UserValue2']."' ORDER BY tdepartment.CountryID ASC";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;

$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseDeptRowData = "";
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
$tdepartmentAutomaticDetailLink = "";
$tdepartmentAutomaticDetailLinkSTYLE = "";
$tdepartmentCountryIDLABEL = "";
$tdepartmentCountryID = "";
$tdepartmentCountryIDSTYLE = "";
$tdepartmentBranchIDLABEL = "";
$tdepartmentBranchID = "";
$tdepartmentBranchIDSTYLE = "";
$tdepartmentIDLABEL = "";
$tdepartmentID = "";
$tdepartmentIDSTYLE = "";
$tdepartmentDescriptionLABEL = "";
$tdepartmentDescription = "";
$tdepartmentDescriptionSTYLE = "";
$oRStdepartment = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseDept#WHR"] = "";
    $_SESSION["BrowseDept#COL"] = "";
    $_SESSION["BrowseDept#SRT"] = "";
    $_SESSION["BrowseDept#PreviousColumn"] = "";
    $_SESSION["BrowseDept#PreviousSort"] = "";
    $_SESSION["BrowseDept#mySort"] = "";
    $_SESSION["BrowseDept#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseDept#WHR"] = "";
        $_SESSION["BrowseDept#COL"] = "";
        $_SESSION["BrowseDept#SRT"] = "";
        $_SESSION["BrowseDept#PreviousColumn"] = "";
        $_SESSION["BrowseDept#PreviousSort"] = "";
        $_SESSION["BrowseDept#mySort"] = "";
        $_SESSION["BrowseDept#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseDept#COL"] = "";
            $_SESSION["BrowseDept#SRT"] = "";
            $_SESSION["BrowseDept#PreviousColumn"] = "";
            $_SESSION["BrowseDept#PreviousSort"] = "";
            $_SESSION["BrowseDept#mySort"] = "";
            $_SESSION["BrowseDept#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseDept#PreviousColumn"] = "";
else:
    $_SESSION["BrowseDept#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseDept#PreviousSort"] = "";
else:
    $_SESSION["BrowseDept#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseDept#COL") == ""):
    if (getRequest("COL") . getSession("BrowseDept#COL") == ""):
        $_SESSION["BrowseDept#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.CountryID DESC";
        $_SESSION["BrowseDept#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.CountryID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDept#PreviousColumn")):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.CountryID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDept#COL"] = "CountryID";
    $_SESSION["BrowseDept#SRT"] = getSession("BrowseDept#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.BranchID DESC";
        $_SESSION["BrowseDept#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.BranchID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDept#PreviousColumn")):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.BranchID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDept#COL"] = "BranchID";
    $_SESSION["BrowseDept#SRT"] = getSession("BrowseDept#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.ID DESC";
        $_SESSION["BrowseDept#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.ID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDept#PreviousColumn")):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.ID ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDept#COL"] = "ID";
    $_SESSION["BrowseDept#SRT"] = getSession("BrowseDept#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.Description DESC";
        $_SESSION["BrowseDept#mySort"] = "DESC";
    else:
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.Description ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseDept#PreviousColumn")):
        $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.Description ASC";
        $_SESSION["BrowseDept#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseDept#COL"] = "Description";
    $_SESSION["BrowseDept#SRT"] = getSession("BrowseDept#mySort");
endif;

$myQuery    = "SELECT tdepartment.CountryID, tdepartment.BranchID, tdepartment.ID, tdepartment.Description FROM tdepartment";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseDept#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseDept#WHR") != ""):
    $myWhere    = getSession("BrowseDept#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseDept#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseDept#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseDept#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tdepartment", "tdepartment.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tdepartment.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseDept#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseDept#myOrder") == ""):
    $_SESSION["BrowseDept#myOrder"] = "ORDER BY tdepartment.CountryID ASC";
    $_SESSION["BrowseDept#mySort"] = "ASC";
    $_SESSION["BrowseDept#COL"] = "CountryID";
    $_SESSION["BrowseDept#SRT"] = getSession("BrowseDept#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseDept#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseDept#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tdepartment.CountryID) AS MyCount  FROM tdepartment WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tdepartment.CountryID) AS MyCount  FROM tdepartment";
endif;
$oRStdepartment = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStdepartment->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStdepartment->Close();
$oRStdepartment = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseDept#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStdepartment):
    if($oRStdepartment->EOF != TRUE):
        if($oRStdepartment->RecordCount() > 0):
            $oRStdepartment->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseDept" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseDeptListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStdepartment->Close();
unset($oRStdepartment);

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
    $tmpMsg = "<a href='BrowseDept" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetdepartment" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseDeptListTemplate($Template)
=============================================================================
*/
function MergeBrowseDeptListTemplate($Template) {
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
        $Template = "./html/BrowseDeptlist.htm";
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
            if ( getSession("BrowseDept#PreviousColumn") == "CountryID"):
                if (getSession("BrowseDept#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDept#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseDept#COL") == "CountryID" ):
            if (getSession("BrowseDept#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseDept#PreviousColumn") == "BranchID"):
                if (getSession("BrowseDept#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDept#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseDept#COL") == "BranchID" ):
            if (getSession("BrowseDept#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseDept#PreviousColumn") == "ID"):
                if (getSession("BrowseDept#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDept#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseDept#COL") == "ID" ):
            if (getSession("BrowseDept#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseDept#PreviousColumn") == "Description"):
                if (getSession("BrowseDept#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseDept#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseDept#COL") == "Description" ):
            if (getSession("BrowseDept#SRT") == "ASC"):
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
    global $oRStdepartment;
    global $RecordsPageSize;
    global $tdepartmentAutomaticDetailLink;
    global $tdepartmentAutomaticDetailLinkSTYLE;
    global $tdepartmentBranchID;
    global $tdepartmentBranchIDLABEL;
    global $tdepartmentBranchIDSTYLE;
    global $tdepartmentCountryID;
    global $tdepartmentCountryIDLABEL;
    global $tdepartmentCountryIDSTYLE;
    global $tdepartmentDescription;
    global $tdepartmentDescriptionLABEL;
    global $tdepartmentDescriptionSTYLE;
    global $tdepartmentID;
    global $tdepartmentIDLABEL;
    global $tdepartmentIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStdepartment) :
        while ((!$oRStdepartment->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tdepartmentAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetdepartmentedit.php?ID1=";
                    $tdepartmentAutomaticDetailLink = $myLink;
                      $tdepartmentAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStdepartment->fields["CountryID"]))) . "'" ;
                    $tdepartmentAutomaticDetailLink .=  "&ID2=" . "'";
                    $tdepartmentAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdepartment->fields["BranchID"]))) . "'";
                    $tdepartmentAutomaticDetailLink .=  "&ID3=";
                    $tdepartmentAutomaticDetailLink .= htmlEncode(trim(getValue($oRStdepartment->fields["ID"])));
            $tmpIMG_tdepartmentAutomaticDetailLink = "";
            $tmpIMG_tdepartmentAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tdepartmentAutomaticDetailLink .= "\">" . $tmpIMG_tdepartmentAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdepartmentCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdepartment->fields["CountryID"])):
        $tdepartmentCountryID = "";
    else:
        $tdepartmentCountryID = htmlEncode(getValue($oRStdepartment->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdepartmentBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdepartment->fields["BranchID"])):
        $tdepartmentBranchID = "";
    else:
        $tdepartmentBranchID = htmlEncode(getValue($oRStdepartment->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdepartmentIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStdepartment->fields["ID"])):
        $tdepartmentID = "";
    else:
        $myQuoteID = "";
        $tdepartmentID = '<a href=\'JAVASCRIPT:updateData(';
        $tdepartmentID .= $myQuoteID . htmlEncode(getValue($oRStdepartment->fields["ID"])) . $myQuoteID;
        $tdepartmentID .= ');\'>';
        $tdepartmentID .= htmlEncode(getValue($oRStdepartment->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdepartmentDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStdepartment->fields["Description"])):
        $tdepartmentDescription = "";
    else:
        $tdepartmentDescription = htmlEncode(getValue($oRStdepartment->fields["Description"]));
endif;
$Seq++;
$oRStdepartment->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentAutomaticDetailLink@", $tdepartmentAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentAutomaticDetailLinkSTYLE@", $tdepartmentAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentCountryID@", $tdepartmentCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentCountryIDSTYLE@",$tdepartmentCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentBranchID@", $tdepartmentBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentBranchIDSTYLE@",$tdepartmentBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentID@", $tdepartmentID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentIDSTYLE@",$tdepartmentIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentDescription@", $tdepartmentDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentDescriptionSTYLE@",$tdepartmentDescriptionSTYLE);           
        endwhile; // of oRStdepartment DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tdepartmentAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentAutomaticDetailLinkSTYLE@", $tdepartmentAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentCountryID@", "&nbsp;");
$tdepartmentCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentCountryIDSTYLE@", $tdepartmentCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentBranchID@", "&nbsp;");
$tdepartmentBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentBranchIDSTYLE@", $tdepartmentBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentID@", "&nbsp;");
$tdepartmentIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentIDSTYLE@", $tdepartmentIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentDescription@", "&nbsp;");
$tdepartmentDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tdepartmentDescriptionSTYLE@", $tdepartmentDescriptionSTYLE);
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
global $oRStdepartment;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetdepartmentsearch.php";
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
        $ref .= "<a href=Updatetdepartment" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetdepartment" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
