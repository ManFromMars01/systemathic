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
$HTML_Template = getRequest("HTMLT");
// display of the number of records can be overridden by uncommenting the next line
// $RecordsPerPage = ##;
$HeaderText = "";
$TemplateText = "";
$DataRowEmptyText = "";
$DataRowFilledText = "";
$FooterText = "";
$RemainderText = "";
$BrowsetcountryRowData = "";
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
$tcountryAutomaticDetailLink = "";
$tcountryAutomaticDetailLinkSTYLE = "";
$tcountryIDLABEL = "";
$tcountryID = "";
$tcountryIDSTYLE = "";
$tcountryDescriptionLABEL = "";
$tcountryDescription = "";
$tcountryDescriptionSTYLE = "";
$tcountryPhoneLABEL = "";
$tcountryPhone = "";
$tcountryPhoneSTYLE = "";
$tcountryEmailLABEL = "";
$tcountryEmail = "";
$tcountryEmailSTYLE = "";
$tcountryContactLABEL = "";
$tcountryContact = "";
$tcountryContactSTYLE = "";
$tcountryMasterLABEL = "";
$tcountryMaster = "";
$tcountryMasterSTYLE = "";
$oRStcountry = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["Browsetcountry#WHR"] = "";
    $_SESSION["Browsetcountry#COL"] = "";
    $_SESSION["Browsetcountry#SRT"] = "";
    $_SESSION["Browsetcountry#PreviousColumn"] = "";
    $_SESSION["Browsetcountry#PreviousSort"] = "";
    $_SESSION["Browsetcountry#mySort"] = "";
    $_SESSION["Browsetcountry#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["Browsetcountry#WHR"] = "";
        $_SESSION["Browsetcountry#COL"] = "";
        $_SESSION["Browsetcountry#SRT"] = "";
        $_SESSION["Browsetcountry#PreviousColumn"] = "";
        $_SESSION["Browsetcountry#PreviousSort"] = "";
        $_SESSION["Browsetcountry#mySort"] = "";
        $_SESSION["Browsetcountry#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["Browsetcountry#COL"] = "";
            $_SESSION["Browsetcountry#SRT"] = "";
            $_SESSION["Browsetcountry#PreviousColumn"] = "";
            $_SESSION["Browsetcountry#PreviousSort"] = "";
            $_SESSION["Browsetcountry#mySort"] = "";
            $_SESSION["Browsetcountry#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["Browsetcountry#PreviousColumn"] = "";
else:
    $_SESSION["Browsetcountry#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["Browsetcountry#PreviousSort"] = "";
else:
    $_SESSION["Browsetcountry#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("Browsetcountry#COL") == ""):
    if (getRequest("COL") . getSession("Browsetcountry#COL") == ""):
        $_SESSION["Browsetcountry#COL"] = "ID";
    endif;
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.ID DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.ID ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.ID ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "ID";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

if (getRequest("COL") == "Description"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Description DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Description ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Description ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "Description";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

if (getRequest("COL") == "Phone"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Phone DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Phone ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Phone ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "Phone";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

if (getRequest("COL") == "Email"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Email DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Email ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Email ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "Email";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

if (getRequest("COL") == "Contact"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Contact DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Contact ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Contact ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "Contact";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

if (getRequest("COL") == "Master"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Master DESC";
        $_SESSION["Browsetcountry#mySort"] = "DESC";
    else:
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Master ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("Browsetcountry#PreviousColumn")):
        $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.Master ASC";
        $_SESSION["Browsetcountry#mySort"] = "ASC";
    endif;
    $_SESSION["Browsetcountry#COL"] = "Master";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

$myQuery    = "SELECT tcountry.ID, tcountry.Description, tcountry.Phone, tcountry.Email, tcountry.Contact, tcountry.Master FROM tcountry";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["Browsetcountry#WHR"] =  getRequest("WHR");
elseif (getSession("Browsetcountry#WHR") != ""):
    $myWhere    = getSession("Browsetcountry#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["Browsetcountry#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["Browsetcountry#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["Browsetcountry#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("Browsetcountry#myOrder") == ""):
    $_SESSION["Browsetcountry#myOrder"] = "ORDER BY tcountry.ID ASC";
    $_SESSION["Browsetcountry#mySort"] = "ASC";
    $_SESSION["Browsetcountry#COL"] = "ID";
    $_SESSION["Browsetcountry#SRT"] = getSession("Browsetcountry#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("Browsetcountry#myOrder") !=""):
    $mySQL .= " " . getSession("Browsetcountry#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tcountry.ID) AS MyCount  FROM tcountry WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tcountry.ID) AS MyCount  FROM tcountry";
endif;
$oRStcountry = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStcountry->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStcountry->Close();
$oRStcountry = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["Browsetcountry#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStcountry):
    if($oRStcountry->EOF != TRUE):
        if($oRStcountry->RecordCount() > 0):
            $oRStcountry->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=Browsetcountry" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowsetcountryListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStcountry->Close();
unset($oRStcountry);

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
    $tmpMsg = "<a href='Browsetcountry" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetcountry" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowsetcountryListTemplate($Template)
=============================================================================
*/
function MergeBrowsetcountryListTemplate($Template) {
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
        $Template = "./html/Browsetcountrylist.htm";
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
            $myLink .= "COL=ID";
            if ( getSession("Browsetcountry#PreviousColumn") == "ID"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("Browsetcountry#COL") == "ID" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Description";
            if ( getSession("Browsetcountry#PreviousColumn") == "Description"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "Description"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Description</a>";
        $DescriptionLABEL = $myLink;
        if ( getGet("COL") == "Description" || getSession("Browsetcountry#COL") == "Description" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $DescriptionLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DescriptionLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Phone";
            if ( getSession("Browsetcountry#PreviousColumn") == "Phone"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "Phone"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Phone</a>";
        $PhoneLABEL = $myLink;
        if ( getGet("COL") == "Phone" || getSession("Browsetcountry#COL") == "Phone" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $PhoneLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PhoneLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Email";
            if ( getSession("Browsetcountry#PreviousColumn") == "Email"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "Email"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Email</a>";
        $EmailLABEL = $myLink;
        if ( getGet("COL") == "Email" || getSession("Browsetcountry#COL") == "Email" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $EmailLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $EmailLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Contact";
            if ( getSession("Browsetcountry#PreviousColumn") == "Contact"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "Contact"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Contact</a>";
        $ContactLABEL = $myLink;
        if ( getGet("COL") == "Contact" || getSession("Browsetcountry#COL") == "Contact" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $ContactLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $ContactLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Master";
            if ( getSession("Browsetcountry#PreviousColumn") == "Master"):
                if (getSession("Browsetcountry#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("Browsetcountry#COL") == "Master"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Master</a>";
        $MasterLABEL = $myLink;
        if ( getGet("COL") == "Master" || getSession("Browsetcountry#COL") == "Master" ):
            if (getSession("Browsetcountry#SRT") == "ASC"):
                $MasterLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MasterLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@DescriptionLABEL@", $DescriptionLABEL);
$HeaderText = Replace($HeaderText,"@PhoneLABEL@", $PhoneLABEL);
$HeaderText = Replace($HeaderText,"@EmailLABEL@", $EmailLABEL);
$HeaderText = Replace($HeaderText,"@ContactLABEL@", $ContactLABEL);
$HeaderText = Replace($HeaderText,"@MasterLABEL@", $MasterLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStcountry;
    global $RecordsPageSize;
    global $tcountryAutomaticDetailLink;
    global $tcountryAutomaticDetailLinkSTYLE;
    global $tcountryContact;
    global $tcountryContactLABEL;
    global $tcountryContactSTYLE;
    global $tcountryDescription;
    global $tcountryDescriptionLABEL;
    global $tcountryDescriptionSTYLE;
    global $tcountryEmail;
    global $tcountryEmailLABEL;
    global $tcountryEmailSTYLE;
    global $tcountryID;
    global $tcountryIDLABEL;
    global $tcountryIDSTYLE;
    global $tcountryMaster;
    global $tcountryMasterLABEL;
    global $tcountryMasterSTYLE;
    global $tcountryPhone;
    global $tcountryPhoneLABEL;
    global $tcountryPhoneSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
$Seq = 0;

    if ($oRStcountry) :
        while ((!$oRStcountry->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tcountryAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a class='btn btn-info' href=\"Updatetcountryedit.php?ID1=";
                    $tcountryAutomaticDetailLink = $myLink;
                      $tcountryAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStcountry->fields["ID"]))) . "'" ;
            $tmpIMG_tcountryAutomaticDetailLink = "";
            $tmpIMG_tcountryAutomaticDetailLink = "<i class='icon-edit icon-white'></i> Edit";
                $tcountryAutomaticDetailLink .= "\">" . $tmpIMG_tcountryAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["ID"])):
        $tcountryID = "";
    else:
        $myQuoteID = "\"";
        $tcountryID = '<a href=\'JAVASCRIPT:updateData(';
        $tcountryID .= $myQuoteID . htmlEncode(getValue($oRStcountry->fields["ID"])) . $myQuoteID;
        $tcountryID .= ');\'>';
        $tcountryID .= htmlEncode(getValue($oRStcountry->fields["ID"])) . "</a>";

endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryDescriptionSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["Description"])):
        $tcountryDescription = "";
    else:
        $tcountryDescription = htmlEncode(getValue($oRStcountry->fields["Description"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryPhoneSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["Phone"])):
        $tcountryPhone = "";
    else:
        $tcountryPhone = htmlEncode(getValue($oRStcountry->fields["Phone"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryEmailSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["Email"])):
        $tcountryEmail = "";
    else:
        $tcountryEmail = htmlEncode(getValue($oRStcountry->fields["Email"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryContactSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["Contact"])):
        $tcountryContact = "";
    else:
        $tcountryContact = htmlEncode(getValue($oRStcountry->fields["Contact"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryMasterSTYLE = "TableRow" . $Style;
    if (is_null($oRStcountry->fields["Master"])):
        $tcountryMaster = "";
    else:
        $tcountryMaster = htmlEncode(getValue($oRStcountry->fields["Master"]));
endif;
$Seq++;
$oRStcountry->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tcountryAutomaticDetailLink@", $tcountryAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryAutomaticDetailLinkSTYLE@", $tcountryAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryID@", $tcountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryIDSTYLE@",$tcountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryDescription@", $tcountryDescription);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryDescriptionSTYLE@",$tcountryDescriptionSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryPhone@", $tcountryPhone);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryPhoneSTYLE@",$tcountryPhoneSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryEmail@", $tcountryEmail);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryEmailSTYLE@",$tcountryEmailSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryContact@", $tcountryContact);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryContactSTYLE@",$tcountryContactSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryMaster@", $tcountryMaster);       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryMasterSTYLE@",$tcountryMasterSTYLE);           
        endwhile; // of oRStcountry DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tcountryAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryAutomaticDetailLinkSTYLE@", $tcountryAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryID@", "&nbsp;");
$tcountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryIDSTYLE@", $tcountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryDescription@", "&nbsp;");
$tcountryDescriptionSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryDescriptionSTYLE@", $tcountryDescriptionSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryPhone@", "&nbsp;");
$tcountryPhoneSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryPhoneSTYLE@", $tcountryPhoneSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryEmail@", "&nbsp;");
$tcountryEmailSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryEmailSTYLE@", $tcountryEmailSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryContact@", "&nbsp;");
$tcountryContactSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryContactSTYLE@", $tcountryContactSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryMaster@", "&nbsp;");
$tcountryMasterSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tcountryMasterSTYLE@", $tcountryMasterSTYLE);
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
global $oRStcountry;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetcountrysearch.php";
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
        $ref .= "<a href=Updatetcountry" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetcountry" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
