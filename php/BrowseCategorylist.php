<?PHP
session_start();
include('template/myclass.php');
not_login();

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
$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tcategory  WHERE tcategory.CountryID ='".$_SESSION['UserValue1']."' AND tcategory.BranchID = '".$_SESSION['UserValue2']."' ORDER BY tcategory.CountryID ASC";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;


$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowseCategoryRowData = "";
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
$tcategoryAutomaticDetailLink = "";
$tcategoryAutomaticDetailLinkSTYLE = "";
$tcategoryAddSubCategory = "";
$tcategoryAddSubCategorySTYLE = "";
$tcategoryCountryIDLABEL = "";
$tcategoryCountryID = "";
$tcategoryCountryIDSTYLE = "";
$tcategoryBranchIDLABEL = "";
$tcategoryBranchID = "";
$tcategoryBranchIDSTYLE = "";
$tcategoryIDLABEL = "";
$tcategoryID = "";
$tcategoryIDSTYLE = "";
$tcategoryDescriptionLABEL = "";
$tcategoryDescription = "";
$tcategoryDescriptionSTYLE = "";
$oRStcategory = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseCategory#WHR"] = "";
    $_SESSION["BrowseCategory#COL"] = "";
    $_SESSION["BrowseCategory#SRT"] = "";
    $_SESSION["BrowseCategory#PreviousColumn"] = "";
    $_SESSION["BrowseCategory#PreviousSort"] = "";
    $_SESSION["BrowseCategory#mySort"] = "";
    $_SESSION["BrowseCategory#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseCategory#WHR"] = "";
        $_SESSION["BrowseCategory#COL"] = "";
        $_SESSION["BrowseCategory#SRT"] = "";
        $_SESSION["BrowseCategory#PreviousColumn"] = "";
        $_SESSION["BrowseCategory#PreviousSort"] = "";
        $_SESSION["BrowseCategory#mySort"] = "";
        $_SESSION["BrowseCategory#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseCategory#COL"] = "";
            $_SESSION["BrowseCategory#SRT"] = "";
            $_SESSION["BrowseCategory#PreviousColumn"] = "";
            $_SESSION["BrowseCategory#PreviousSort"] = "";
            $_SESSION["BrowseCategory#mySort"] = "";
            $_SESSION["BrowseCategory#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseCategory#PreviousColumn"] = "";
else:
    $_SESSION["BrowseCategory#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseCategory#PreviousSort"] = "";
else:
    $_SESSION["BrowseCategory#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseCategory#COL") == ""):
    if (getRequest("COL") . getSession("BrowseCategory#COL") == ""):
        $_SESSION["BrowseCategory#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.CountryID DESC";
        $_SESSION["BrowseCategory#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.CountryID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCategory#PreviousColumn")):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.CountryID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCategory#COL"] = "CountryID";
    $_SESSION["BrowseCategory#SRT"] = getSession("BrowseCategory#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.BranchID DESC";
        $_SESSION["BrowseCategory#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.BranchID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCategory#PreviousColumn")):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.BranchID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCategory#COL"] = "BranchID";
    $_SESSION["BrowseCategory#SRT"] = getSession("BrowseCategory#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.ID DESC";
        $_SESSION["BrowseCategory#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.ID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCategory#PreviousColumn")):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.ID ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCategory#COL"] = "ID";
    $_SESSION["BrowseCategory#SRT"] = getSession("BrowseCategory#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.Description DESC";
        $_SESSION["BrowseCategory#mySort"] = "DESC";
    else:
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.Description ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseCategory#PreviousColumn")):
        $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.Description ASC";
        $_SESSION["BrowseCategory#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseCategory#COL"] = "Description";
    $_SESSION["BrowseCategory#SRT"] = getSession("BrowseCategory#mySort");
endif;

$myQuery    = "SELECT tcategory.CountryID, tcategory.BranchID, tcategory.ID, tcategory.Description FROM tcategory";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseCategory#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseCategory#WHR") != ""):
    $myWhere    = getSession("BrowseCategory#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCategory#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseCategory#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseCategory#WHR"] = $myWhere;
    endif;
endif;

// --add the additional "myRecords" ownership clause
$strMyQuote = getQuote($objConn1,"tcategory", "tcategory.CountryID");
if ($myWhere != ""):
    $myWhere .= " AND ";
endif;
$myWhere .= "tcategory.CountryID = " . $strMyQuote . getSession("UserValue1") . $strMyQuote;
$_SESSION["BrowseCategory#WHR"] = $myWhere;
$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseCategory#myOrder") == ""):
    $_SESSION["BrowseCategory#myOrder"] = "ORDER BY tcategory.CountryID ASC";
    $_SESSION["BrowseCategory#mySort"] = "ASC";
    $_SESSION["BrowseCategory#COL"] = "CountryID";
    $_SESSION["BrowseCategory#SRT"] = getSession("BrowseCategory#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseCategory#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseCategory#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tcategory.CountryID) AS MyCount  FROM tcategory WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tcategory.CountryID) AS MyCount  FROM tcategory";
endif;
$oRStcategory = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStcategory->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStcategory->Close();
$oRStcategory = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseCategory#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStcategory):
    if($oRStcategory->EOF != TRUE):
        if($oRStcategory->RecordCount() > 0):
            $oRStcategory->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseCategory" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseCategoryListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStcategory->Close();
unset($oRStcategory);

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
    $tmpMsg = "<a href='BrowseCategory" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetcategory" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseCategoryListTemplate($Template)
=============================================================================
*/
function MergeBrowseCategoryListTemplate($Template) {
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
        $Template = "./html/BrowseCategorylist.htm";
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
            if ( getSession("BrowseCategory#PreviousColumn") == "CountryID"):
                if (getSession("BrowseCategory#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCategory#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseCategory#COL") == "CountryID" ):
            if (getSession("BrowseCategory#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseCategory#PreviousColumn") == "BranchID"):
                if (getSession("BrowseCategory#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCategory#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseCategory#COL") == "BranchID" ):
            if (getSession("BrowseCategory#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseCategory#PreviousColumn") == "ID"):
                if (getSession("BrowseCategory#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCategory#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseCategory#COL") == "ID" ):
            if (getSession("BrowseCategory#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("BrowseCategory#PreviousColumn") == "Description"):
                if (getSession("BrowseCategory#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseCategory#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("BrowseCategory#COL") == "Description" ):
            if (getSession("BrowseCategory#SRT") == "ASC"):
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
    global $oRStcategory;
    global $RecordsPageSize;
    global $tcategoryAddSubCategory;
    global $tcategoryAddSubCategorySTYLE;
    global $tcategoryAutomaticDetailLink;
    global $tcategoryAutomaticDetailLinkSTYLE;
    global $tcategoryBranchID;
    global $tcategoryBranchIDLABEL;
    global $tcategoryBranchIDSTYLE;
    global $tcategoryCountryID;
    global $tcategoryCountryIDLABEL;
    global $tcategoryCountryIDSTYLE;
    global $tcategoryDescription;
    global $tcategoryDescriptionLABEL;
    global $tcategoryDescriptionSTYLE;
    global $tcategoryID;
    global $tcategoryIDLABEL;
    global $tcategoryIDSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStcategory) :
        while ((!$oRStcategory->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tcategoryAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetcategoryedit.php?ID1=";
                    $tcategoryAutomaticDetailLink = $myLink;
                      $tcategoryAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStcategory->fields["CountryID"]))) . "'" ;
                    $tcategoryAutomaticDetailLink .=  "&ID2=" . "'";
                    $tcategoryAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcategory->fields["BranchID"]))) . "'";
                    $tcategoryAutomaticDetailLink .=  "&ID3=" . "'";
                    $tcategoryAutomaticDetailLink .= htmlEncode(trim(getValue($oRStcategory->fields["ID"]))) . "'";
            $tmpIMG_tcategoryAutomaticDetailLink = "";
            $tmpIMG_tcategoryAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tcategoryAutomaticDetailLink .= "\">" . $tmpIMG_tcategoryAutomaticDetailLink . "</a>";
    $tcategoryAddSubCategorySTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"BrowseSubCateglist.php?ID1=";
                    $tcategoryAddSubCategory = $myLink;
                      $tcategoryAddSubCategory .= "'" . htmlEncode(trim(getValue($oRStcategory->fields["CountryID"]))) . "'" ;
                    $tcategoryAddSubCategory .=  "&ID2=" . "'";
                    $tcategoryAddSubCategory .= htmlEncode(trim(getValue($oRStcategory->fields["BranchID"]))) . "'";
                    $tcategoryAddSubCategory .=  "&ID3=" . "'";
                    $tcategoryAddSubCategory .= htmlEncode(trim(getValue($oRStcategory->fields["ID"]))) . "'";
            $tmpIMG_tcategoryAddSubCategory = "";
            $tmpIMG_tcategoryAddSubCategory = "<i class='icon-edit icon-white'></i> Manage SubCategory";
                $tcategoryAddSubCategory .= "\">" . $tmpIMG_tcategoryAddSubCategory . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcategoryCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcategory->fields["CountryID"])):
        $tcategoryCountryID = "";
    else:
        $tcategoryCountryID = htmlEncode(getValue($oRStcategory->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcategoryBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcategory->fields["BranchID"])):
        $tcategoryBranchID = "";
    else:
        $tcategoryBranchID = htmlEncode(getValue($oRStcategory->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcategoryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcategory->fields["ID"])):
        $tcategoryID = "";
    else:
        $myQuoteID = "\"";
        $tcategoryID = '<a href=\'JAVASCRIPT:updateData(';
        $tcategoryID .= $myQuoteID . htmlEncode(getValue($oRStcategory->fields["ID"])) . $myQuoteID;
        $tcategoryID .= ');\'>';
        $tcategoryID .= htmlEncode(getValue($oRStcategory->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcategoryDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStcategory->fields["Description"])):
        $tcategoryDescription = "";
    else:
        $tcategoryDescription = htmlEncode(getValue($oRStcategory->fields["Description"]));
endif;
$Seq++;
$oRStcategory->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAutomaticDetailLink@", $tcategoryAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAutomaticDetailLinkSTYLE@", $tcategoryAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAddSubCategory@", $tcategoryAddSubCategory);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAddSubCategorySTYLE@", $tcategoryAddSubCategorySTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryCountryID@", $tcategoryCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryCountryIDSTYLE@",$tcategoryCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryBranchID@", $tcategoryBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryBranchIDSTYLE@",$tcategoryBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryID@", $tcategoryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryIDSTYLE@",$tcategoryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryDescription@", $tcategoryDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryDescriptionSTYLE@",$tcategoryDescriptionSTYLE);           
        endwhile; // of oRStcategory DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcategoryAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAutomaticDetailLinkSTYLE@", $tcategoryAutomaticDetailLinkSTYLE);
$tcategoryAddSubCategorySTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAddSubCategory@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryAddSubCategorySTYLE@", $tcategoryAddSubCategorySTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryCountryID@", "&nbsp;");
$tcategoryCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryCountryIDSTYLE@", $tcategoryCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryBranchID@", "&nbsp;");
$tcategoryBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryBranchIDSTYLE@", $tcategoryBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryID@", "&nbsp;");
$tcategoryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryIDSTYLE@", $tcategoryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryDescription@", "&nbsp;");
$tcategoryDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcategoryDescriptionSTYLE@", $tcategoryDescriptionSTYLE);
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
global $oRStcategory;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetcategorysearch.php";
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
        $ref .= "<a href=Updatetcategory" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetcategory" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
