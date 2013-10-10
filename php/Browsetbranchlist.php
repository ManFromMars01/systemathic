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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
//Count me
//Count me
$myRecordCount2 = "SELECT COUNT(*) AS MyCount FROM tbranch  WHERE tbranch.CountryID ='".$_SESSION['UserValue1']."' ORDER BY tbranch.CountryID ASC";
$oRStcustomers = $objConn1->Execute($myRecordCount2);
$TotalRecords1 = $oRStcustomers->fields["MyCount"];
$RecordsPerPage = $TotalRecords1;

$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowsetbranchRowData = "";
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
$tbranchAutomaticDetailLink = "";
$tbranchAutomaticDetailLinkSTYLE = "";
$tbranchCountryIDLABEL = "";
$tbranchCountryID = "";
$tbranchCountryIDSTYLE = "";
$tbranchBranchIDLABEL = "";
$tbranchBranchID = "";
$tbranchBranchIDSTYLE = "";
$tbranchDescriptionLABEL = "";
$tbranchDescription = "";
$tbranchDescriptionSTYLE = "";
$tbranchPhoneLABEL = "";
$tbranchPhone = "";
$tbranchPhoneSTYLE = "";
$tbranchEmailLABEL = "";
$tbranchEmail = "";
$tbranchEmailSTYLE = "";
$tbranchContactLABEL = "";
$tbranchContact = "";
$tbranchContactSTYLE = "";
$tbranchHQOperationLABEL = "";
$tbranchHQOperation = "";
$tbranchHQOperationSTYLE = "";
$tbranchHQCenterOperationLABEL = "";
$tbranchHQCenterOperation = "";
$tbranchHQCenterOperationSTYLE = "";
$oRStbranch = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["Browsetbranch#WHR"] = "";
    $_SESSION["Browsetbranch#COL"] = "";
    $_SESSION["Browsetbranch#SRT"] = "";
    $_SESSION["Browsetbranch#PreviousColumn"] = "";
    $_SESSION["Browsetbranch#PreviousSort"] = "";
    $_SESSION["Browsetbranch#mySort"] = "";
    $_SESSION["Browsetbranch#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["Browsetbranch#WHR"] = "";
        $_SESSION["Browsetbranch#COL"] = "";
        $_SESSION["Browsetbranch#SRT"] = "";
        $_SESSION["Browsetbranch#PreviousColumn"] = "";
        $_SESSION["Browsetbranch#PreviousSort"] = "";
        $_SESSION["Browsetbranch#mySort"] = "";
        $_SESSION["Browsetbranch#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["Browsetbranch#COL"] = "";
            $_SESSION["Browsetbranch#SRT"] = "";
            $_SESSION["Browsetbranch#PreviousColumn"] = "";
            $_SESSION["Browsetbranch#PreviousSort"] = "";
            $_SESSION["Browsetbranch#mySort"] = "";
            $_SESSION["Browsetbranch#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["Browsetbranch#PreviousColumn"] = "";
else:
    $_SESSION["Browsetbranch#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["Browsetbranch#PreviousSort"] = "";
else:
    $_SESSION["Browsetbranch#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("Browsetbranch#COL") == ""):
    if (getRequest("COL") . getSession("Browsetbranch#COL") == ""):
        $_SESSION["Browsetbranch#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.CountryID DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.CountryID ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.CountryID ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "CountryID";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.BranchID DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.BranchID ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.BranchID ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "BranchID";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Description DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Description ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Description ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "Description";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "Phone"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Phone DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Phone ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Phone ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "Phone";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "Email"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Email DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Email ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Email ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "Email";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "Contact"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Contact DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Contact ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.Contact ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "Contact";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "HQOperation"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQOperation DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQOperation ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQOperation ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "HQOperation";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

if (getRequest("COL") == "HQCenterOperation"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQCenterOperation DESC";
        $_SESSION["Browsetbranch#mySort"] = "DESC";
    else:
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQCenterOperation ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetbranch#PreviousColumn")):
        $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.HQCenterOperation ASC";
        $_SESSION["Browsetbranch#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetbranch#COL"] = "HQCenterOperation";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

$myQuery    = "SELECT tbranch.CountryID, tbranch.BranchID, tbranch.Description, tbranch.Phone, tbranch.Email, tbranch.Contact, tbranch.HQOperation, tbranch.HQCenterOperation FROM tbranch";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["Browsetbranch#WHR"] =  getRequest("WHR");
elseif (getSession("Browsetbranch#WHR") != ""):
    $myWhere    = getSession("Browsetbranch#WHR");
endif;
if ($myWhere == ""):
    $myWhere = "tbranch.CountryID = " . trim(getRequest( "ID1") ) . "";
else:
    $myWhere .= " AND tbranch.CountryID = " . trim(getRequest( "ID1") ) . "";
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "tbranch.CountryID = " . trim(getRequest( "ID1") ) . "";
    $_SESSION["Browsetbranch#WHR"] = $myWhere;
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["Browsetbranch#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["Browsetbranch#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("Browsetbranch#myOrder") == ""):
    $_SESSION["Browsetbranch#myOrder"] = "ORDER BY tbranch.CountryID ASC";
    $_SESSION["Browsetbranch#mySort"] = "ASC";
    $_SESSION["Browsetbranch#COL"] = "CountryID";
    $_SESSION["Browsetbranch#SRT"] = getSession("Browsetbranch#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("Browsetbranch#myOrder") !=""):
    $mySQL .= " " . getSession("Browsetbranch#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tbranch.CountryID) AS MyCount  FROM tbranch WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tbranch.CountryID) AS MyCount  FROM tbranch";
endif;
$oRStbranch = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStbranch->fields["MyCount"];


$MaxPages     = round(($TotalRecords / $RecordsPageSize));
$RecordsPerPage = $TotalRecords;
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStbranch->Close();
$oRStbranch = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["Browsetbranch#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStbranch):
    if($oRStbranch->EOF != TRUE):
        if($oRStbranch->RecordCount() > 0):
            $oRStbranch->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=Browsetbranch" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowsetbranchListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStbranch->Close();
unset($oRStbranch);

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
    $tmpMsg = "<a href='Browsetbranch" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetbranch" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowsetbranchListTemplate($Template)
=============================================================================
*/
function MergeBrowsetbranchListTemplate($Template) {
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
        $Template = "./html/Browsetbranchlist.htm";
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
            if ( getSession("Browsetbranch#PreviousColumn") == "CountryID"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("Browsetbranch#COL") == "CountryID" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("Browsetbranch#PreviousColumn") == "BranchID"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("Browsetbranch#COL") == "BranchID" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("Browsetbranch#PreviousColumn") == "Description"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("Browsetbranch#COL") == "Description" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Phone";
            if ( getSession("Browsetbranch#PreviousColumn") == "Phone"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "Phone"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Phone</a>";
        $PhoneLABEL = $myLink;
        if ( getGet("COL") == "Phone" || getSession("Browsetbranch#COL") == "Phone" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $PhoneLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PhoneLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Email";
            if ( getSession("Browsetbranch#PreviousColumn") == "Email"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "Email"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Email</a>";
        $EmailLABEL = $myLink;
        if ( getGet("COL") == "Email" || getSession("Browsetbranch#COL") == "Email" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $EmailLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $EmailLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Contact";
            if ( getSession("Browsetbranch#PreviousColumn") == "Contact"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "Contact"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Contact</a>";
        $ContactLABEL = $myLink;
        if ( getGet("COL") == "Contact" || getSession("Browsetbranch#COL") == "Contact" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $ContactLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ContactLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=HQOperation";
            if ( getSession("Browsetbranch#PreviousColumn") == "HQOperation"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "HQOperation"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">HQO peration</a>";
        $HQOperationLABEL = $myLink;
        if ( getGet("COL") == "HQOperation" || getSession("Browsetbranch#COL") == "HQOperation" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $HQOperationLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $HQOperationLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=HQCenterOperation";
            if ( getSession("Browsetbranch#PreviousColumn") == "HQCenterOperation"):
                if (getSession("Browsetbranch#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetbranch#COL") == "HQCenterOperation"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">HQC enter Operation</a>";
        $HQCenterOperationLABEL = $myLink;
        if ( getGet("COL") == "HQCenterOperation" || getSession("Browsetbranch#COL") == "HQCenterOperation" ):
            if (getSession("Browsetbranch#SRT") == "ASC"):
                $HQCenterOperationLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $HQCenterOperationLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@PhoneLABEL@", $PhoneLABEL);
$HeaderText = Replace($HeaderText,"@EmailLABEL@", $EmailLABEL);
$HeaderText = Replace($HeaderText,"@ContactLABEL@", $ContactLABEL);
$HeaderText = Replace($HeaderText,"@HQOperationLABEL@", $HQOperationLABEL);
$HeaderText = Replace($HeaderText,"@HQCenterOperationLABEL@", $HQCenterOperationLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStbranch;
    global $RecordsPageSize;
    global $tbranchAutomaticDetailLink;
    global $tbranchAutomaticDetailLinkSTYLE;
    global $tbranchBranchID;
    global $tbranchBranchIDLABEL;
    global $tbranchBranchIDSTYLE;
    global $tbranchContact;
    global $tbranchContactLABEL;
    global $tbranchContactSTYLE;
    global $tbranchCountryID;
    global $tbranchCountryIDLABEL;
    global $tbranchCountryIDSTYLE;
    global $tbranchDescription;
    global $tbranchDescriptionLABEL;
    global $tbranchDescriptionSTYLE;
    global $tbranchEmail;
    global $tbranchEmailLABEL;
    global $tbranchEmailSTYLE;
    global $tbranchHQCenterOperation;
    global $tbranchHQCenterOperationLABEL;
    global $tbranchHQCenterOperationSTYLE;
    global $tbranchHQOperation;
    global $tbranchHQOperationLABEL;
    global $tbranchHQOperationSTYLE;
    global $tbranchPhone;
    global $tbranchPhoneLABEL;
    global $tbranchPhoneSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStbranch) :
        while ((!$oRStbranch->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tbranchAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetbranchedit.php?ID1=";
                    $tbranchAutomaticDetailLink = $myLink;
                      $tbranchAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStbranch->fields["CountryID"]))) . "'" ;
                    $tbranchAutomaticDetailLink .=  "&ID2=" . "'";
                    $tbranchAutomaticDetailLink .= htmlEncode(trim(getValue($oRStbranch->fields["BranchID"]))) . "'";
            $tmpIMG_tbranchAutomaticDetailLink = "";
            $tmpIMG_tbranchAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tbranchAutomaticDetailLink .= "\">" . $tmpIMG_tbranchAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["CountryID"])):
        $tbranchCountryID = "";
    else:
        $tbranchCountryID = htmlEncode(getValue($oRStbranch->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["BranchID"])):
        $tbranchBranchID = "";
    else:
        $myQuoteBranchID = "\"";
        $tbranchBranchID = '<a href=\'JAVASCRIPT:updateData(';
        $tbranchBranchID .= $myQuoteBranchID . htmlEncode(getValue($oRStbranch->fields["BranchID"])) . $myQuoteBranchID;
        $tbranchBranchID .= ');\'>';
        $tbranchBranchID .= htmlEncode(getValue($oRStbranch->fields["BranchID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["Description"])):
        $tbranchDescription = "";
    else:
        $tbranchDescription = htmlEncode(getValue($oRStbranch->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchPhoneSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["Phone"])):
        $tbranchPhone = "";
    else:
        $tbranchPhone = htmlEncode(getValue($oRStbranch->fields["Phone"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchEmailSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["Email"])):
        $tbranchEmail = "";
    else:
        $tbranchEmail = htmlEncode(getValue($oRStbranch->fields["Email"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchContactSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["Contact"])):
        $tbranchContact = "";
    else:
        $tbranchContact = htmlEncode(getValue($oRStbranch->fields["Contact"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchHQOperationSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["HQOperation"])):
        $tbranchHQOperation = "";
    else:
        $tbranchHQOperation = htmlEncode(getValue($oRStbranch->fields["HQOperation"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchHQCenterOperationSTYLE = "TableRow" . $Style;
    if (is_null($oRStbranch->fields["HQCenterOperation"])):
        $tbranchHQCenterOperation = "";
    else:
        $tbranchHQCenterOperation = htmlEncode(getValue($oRStbranch->fields["HQCenterOperation"]));
endif;
$Seq++;
$oRStbranch->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tbranchAutomaticDetailLink@", $tbranchAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchAutomaticDetailLinkSTYLE@", $tbranchAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchCountryID@", $tbranchCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchCountryIDSTYLE@",$tbranchCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchBranchID@", $tbranchBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchBranchIDSTYLE@",$tbranchBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchDescription@", $tbranchDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchDescriptionSTYLE@",$tbranchDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchPhone@", $tbranchPhone);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchPhoneSTYLE@",$tbranchPhoneSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchEmail@", $tbranchEmail);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchEmailSTYLE@",$tbranchEmailSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchContact@", $tbranchContact);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchContactSTYLE@",$tbranchContactSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQOperation@", $tbranchHQOperation);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQOperationSTYLE@",$tbranchHQOperationSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQCenterOperation@", $tbranchHQCenterOperation);       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQCenterOperationSTYLE@",$tbranchHQCenterOperationSTYLE);           
        endwhile; // of oRStbranch DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tbranchAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchAutomaticDetailLinkSTYLE@", $tbranchAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchCountryID@", "&nbsp;");
$tbranchCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchCountryIDSTYLE@", $tbranchCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchBranchID@", "&nbsp;");
$tbranchBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchBranchIDSTYLE@", $tbranchBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchDescription@", "&nbsp;");
$tbranchDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchDescriptionSTYLE@", $tbranchDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchPhone@", "&nbsp;");
$tbranchPhoneSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchPhoneSTYLE@", $tbranchPhoneSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchEmail@", "&nbsp;");
$tbranchEmailSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchEmailSTYLE@", $tbranchEmailSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchContact@", "&nbsp;");
$tbranchContactSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchContactSTYLE@", $tbranchContactSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQOperation@", "&nbsp;");
$tbranchHQOperationSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQOperationSTYLE@", $tbranchHQOperationSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQCenterOperation@", "&nbsp;");
$tbranchHQCenterOperationSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tbranchHQCenterOperationSTYLE@", $tbranchHQCenterOperationSTYLE);
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
global $oRStbranch;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetbranchsearch.php";
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
        $ref .= "<a href=Updatetbranch" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetbranch" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
