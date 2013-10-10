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
$BrowseTeacherRowData = "";
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
$tteacherAutomaticDetailLink = "";
$tteacherAutomaticDetailLinkSTYLE = "";
$tteacherCountryIDLABEL = "";
$tteacherCountryID = "";
$tteacherCountryIDSTYLE = "";
$tteacherBranchIDLABEL = "";
$tteacherBranchID = "";
$tteacherBranchIDSTYLE = "";
$tteacherIDLABEL = "";
$tteacherID = "";
$tteacherIDSTYLE = "";
$tteacherPasswordLABEL = "";
$tteacherPassword = "";
$tteacherPasswordSTYLE = "";
$tteacherNameLABEL = "";
$tteacherName = "";
$tteacherNameSTYLE = "";
$tteacherLocalNameLABEL = "";
$tteacherLocalName = "";
$tteacherLocalNameSTYLE = "";
$tteacherDateStartLABEL = "";
$tteacherDateStart = "";
$tteacherDateStartSTYLE = "";
$tteacherPhoneNoLABEL = "";
$tteacherPhoneNo = "";
$tteacherPhoneNoSTYLE = "";
$tteacherMobileNoLABEL = "";
$tteacherMobileNo = "";
$tteacherMobileNoSTYLE = "";
$oRStteacher = "";
$mySQL = "";
$myWhere = "";
$myQuery = "";
$myPage = "";
$valSQL = "";
// --reset the where session variables if we find a reset string
if (getRequest("RESETLIST") != ""):
    $myWhere = "";
    $_SESSION["BrowseTeacher#WHR"] = "";
    $_SESSION["BrowseTeacher#COL"] = "";
    $_SESSION["BrowseTeacher#SRT"] = "";
    $_SESSION["BrowseTeacher#PreviousColumn"] = "";
    $_SESSION["BrowseTeacher#PreviousSort"] = "";
    $_SESSION["BrowseTeacher#mySort"] = "";
    $_SESSION["BrowseTeacher#myOrder"] = "";    
endif;
if (getServer("QUERY_STRING") == ""):
    if (strpos(strtolower(getServer("HTTP_REFERER")),"search.php") === false):
        $myWhere = "";
        $_SESSION["BrowseTeacher#WHR"] = "";
        $_SESSION["BrowseTeacher#COL"] = "";
        $_SESSION["BrowseTeacher#SRT"] = "";
        $_SESSION["BrowseTeacher#PreviousColumn"] = "";
        $_SESSION["BrowseTeacher#PreviousSort"] = "";
        $_SESSION["BrowseTeacher#mySort"] = "";
        $_SESSION["BrowseTeacher#myOrder"] = "";    
    endif;
endif;

// -- reset the col and srt session variables
if (getRequest("PageIndex") != ""):
    IF ((getGet("COL") . getGet("SRT") . getForm("SEARCH")) == ""):
        if (strpos($PHP_SELF, $_SERVER["HTTP_REFERER"]) != false):    
            $_SESSION["BrowseTeacher#COL"] = "";
            $_SESSION["BrowseTeacher#SRT"] = "";
            $_SESSION["BrowseTeacher#PreviousColumn"] = "";
            $_SESSION["BrowseTeacher#PreviousSort"] = "";
            $_SESSION["BrowseTeacher#mySort"] = "";
            $_SESSION["BrowseTeacher#myOrder"] = "";    
        endif;
    endif;
endif;
// --set the url for the column links
$myPage = getServer("PHP_SELF");
if (getRequest("COL") == ""):
    $_SESSION["BrowseTeacher#PreviousColumn"] = "";
else:
    $_SESSION["BrowseTeacher#PreviousColumn"] = getRequest("COL");
endif;

if (getRequest("SRT") == ""):
    $_SESSION["BrowseTeacher#PreviousSort"] = "";
else:
    $_SESSION["BrowseTeacher#PreviousSort"] = getRequest("SRT");
endif;

if (getSession("BrowseTeacher#COL") == ""):
    if (getRequest("COL") . getSession("BrowseTeacher#COL") == ""):
        $_SESSION["BrowseTeacher#COL"] = "CountryID";
    endif;
endif;

if (getRequest("COL") == "CountryID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.CountryID DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.CountryID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.CountryID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "CountryID";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "BranchID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.BranchID DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.BranchID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.BranchID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "BranchID";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "ID"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.ID DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.ID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.ID ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "ID";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "Password"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Password DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Password ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Password ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "Password";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "Name"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Name DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Name ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.Name ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "Name";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "LocalName"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.LocalName DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.LocalName ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.LocalName ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "LocalName";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "DateStart"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.DateStart DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.DateStart ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.DateStart ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "DateStart";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "PhoneNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.PhoneNo DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.PhoneNo ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.PhoneNo ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "PhoneNo";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

if (getRequest("COL") == "MobileNo"):
    if (getRequest("SRT") == "DESC"):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.MobileNo DESC";
        $_SESSION["BrowseTeacher#mySort"] = "DESC";
    else:
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.MobileNo ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    if (getRequest("COL") != getSession("BrowseTeacher#PreviousColumn")):
        $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.MobileNo ASC";
        $_SESSION["BrowseTeacher#mySort"] = "ASC";
    endif;
    $_SESSION["BrowseTeacher#COL"] = "MobileNo";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

$myQuery    = "SELECT tteacher.CountryID, tteacher.BranchID, tteacher.ID, tteacher.Password, tteacher.Name, tteacher.LocalName, tteacher.DateStart, tteacher.PhoneNo, tteacher.MobileNo FROM tteacher";
if ( getRequest("WHR") != ""):
    $myWhere    =  getRequest("WHR");
    $_SESSION["BrowseTeacher#WHR"] =  getRequest("WHR");
elseif (getSession("BrowseTeacher#WHR") != ""):
    $myWhere    = getSession("BrowseTeacher#WHR");
endif;
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTeacher#WHR"] = "";
endif;
if ($myWhere == ""):
    if (getRequest("LOCATE") == "TRUE"):
      switch(getRequest("FIELD")) {
      default:
        $myWhere = getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
      }
      $_SESSION["BrowseTeacher#WHR"] = $myWhere;
    endif;
else:
    if(getRequest("LOCATE") == "TRUE"):
        $myWhere .= " AND ";
        switch(getRequest("FIELD")) {
        default:
          $myWhere .= getRequest("FIELD") . " LIKE " . CHR(39) . $objConn1->addq(getRequest("SearchValue")) . "%" . CHR(39);
        }
        $_SESSION["BrowseTeacher#WHR"] = $myWhere;
    endif;
endif;

$mySQL = $myQuery;
// -- test for any value in the myWhere, if valid concatenate the clause
if ($myWhere != ""):
    $mySQL .= " WHERE " . $myWhere;
endif;

// --test for any value in myOrder, if empty set default
if (getSession("BrowseTeacher#myOrder") == ""):
    $_SESSION["BrowseTeacher#myOrder"] = "ORDER BY tteacher.CountryID ASC";
    $_SESSION["BrowseTeacher#mySort"] = "ASC";
    $_SESSION["BrowseTeacher#COL"] = "CountryID";
    $_SESSION["BrowseTeacher#SRT"] = getSession("BrowseTeacher#mySort");
endif;

//--test for any value in myOrder, if valid concenate into the SQL statement
if (getSession("BrowseTeacher#myOrder") !=""):
    $mySQL .= " " . getSession("BrowseTeacher#myOrder");
endif;
$RecordsPageSize = $RecordsPerPage;
getGet("PageIndex") == "" ? $PageIndex = 1 : $PageIndex = getGet("PageIndex");
if($myWhere != ""):
  $myRecordCount = "SELECT COUNT(tteacher.CountryID) AS MyCount  FROM tteacher WHERE " . $myWhere;
else:
  $myRecordCount = "SELECT COUNT(tteacher.CountryID) AS MyCount  FROM tteacher";
endif;
$oRStteacher = $objConn1->Execute($myRecordCount);
$TotalRecords = $oRStteacher->fields["MyCount"];
$MaxPages     = round(($TotalRecords / $RecordsPageSize));
if($TotalRecords > ($MaxPages*$RecordsPageSize)):
    $MaxPages++;
endif;
$oRStteacher->Close();
$oRStteacher = $objConn1->PageExecute($mySQL, $RecordsPerPage, $PageIndex);
if (getGet("RESETLIST") == "TRUE"):
    $myWhere = "";
    $_SESSION["BrowseTeacher#WHR"] = "";
endif;

$SearchField = "";
$SearchMessage = "";
if ($oRStteacher):
    if($oRStteacher->EOF != TRUE):
        if($oRStteacher->RecordCount() > 0):
            $oRStteacher->Move(0);         
            if(getRequest("LOCATE") == "TRUE"):
                $SearchMessage =  "<A href=BrowseTeacher" . "list.php?RESETLIST=TRUE>All data</A>";
            endif;
            MergeBrowseTeacherListTemplate($HTML_Template);
        else:
            NoRecordsFound();
        endif;
    else:
        NoRecordsFound();
    endif;
else:
    NoRecordsFound();
endif;

$oRStteacher->Close();
unset($oRStteacher);

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
    $tmpMsg = "<a href='BrowseTeacher" . "list.php?RESETLIST=TRUE'>No records were found</a>";
    $tmpMsg .= "<br><a href=Updatetteacher" . "add.php>Insert record</a>";
    $TemplateText = Replace($TemplateText,"@ClarionData@",$tmpMsg);
    print ($TemplateText);
    exit;
}

/*
=============================================================================
  MergeBrowseTeacherListTemplate($Template)
=============================================================================
*/
function MergeBrowseTeacherListTemplate($Template) {
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
        $Template = "./html/BrowseTeacherlist.htm";
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
            if ( getSession("BrowseTeacher#PreviousColumn") == "CountryID"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "CountryID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Country ID</a>";
        $CountryIDLABEL = $myLink;
        if ( getGet("COL") == "CountryID" || getSession("BrowseTeacher#COL") == "CountryID" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $CountryIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $CountryIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=BranchID";
            if ( getSession("BrowseTeacher#PreviousColumn") == "BranchID"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "BranchID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Branch ID</a>";
        $BranchIDLABEL = $myLink;
        if ( getGet("COL") == "BranchID" || getSession("BrowseTeacher#COL") == "BranchID" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $BranchIDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $BranchIDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=ID";
            if ( getSession("BrowseTeacher#PreviousColumn") == "ID"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "ID"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">ID</a>";
        $IDLABEL = $myLink;
        if ( getGet("COL") == "ID" || getSession("BrowseTeacher#COL") == "ID" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $IDLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $IDLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Password";
            if ( getSession("BrowseTeacher#PreviousColumn") == "Password"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "Password"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Password</a>";
        $PasswordLABEL = $myLink;
        if ( getGet("COL") == "Password" || getSession("BrowseTeacher#COL") == "Password" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $PasswordLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PasswordLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=Name";
            if ( getSession("BrowseTeacher#PreviousColumn") == "Name"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "Name"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Name</a>";
        $NameLABEL = $myLink;
        if ( getGet("COL") == "Name" || getSession("BrowseTeacher#COL") == "Name" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $NameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $NameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=LocalName";
            if ( getSession("BrowseTeacher#PreviousColumn") == "LocalName"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "LocalName"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Local Name</a>";
        $LocalNameLABEL = $myLink;
        if ( getGet("COL") == "LocalName" || getSession("BrowseTeacher#COL") == "LocalName" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $LocalNameLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $LocalNameLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=DateStart";
            if ( getSession("BrowseTeacher#PreviousColumn") == "DateStart"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "DateStart"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Date Start</a>";
        $DateStartLABEL = $myLink;
        if ( getGet("COL") == "DateStart" || getSession("BrowseTeacher#COL") == "DateStart" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $DateStartLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $DateStartLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=PhoneNo";
            if ( getSession("BrowseTeacher#PreviousColumn") == "PhoneNo"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "PhoneNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Phone No</a>";
        $PhoneNoLABEL = $myLink;
        if ( getGet("COL") == "PhoneNo" || getSession("BrowseTeacher#COL") == "PhoneNo" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $PhoneNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $PhoneNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
        $myLink = "<a href=\"" . $myPage . "?";
            $myLink .= "COL=MobileNo";
            if ( getSession("BrowseTeacher#PreviousColumn") == "MobileNo"):
                if (getSession("BrowseTeacher#SRT") == "ASC"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            else:
                if (getSession("BrowseTeacher#COL") == "MobileNo"):
                    $myLink .= "&SRT=DESC";
                else:
                    $myLink .= "&SRT=ASC";
                endif;
            endif;
            $myLink .= getIDs();
            $myLink .= "\">Mobile No</a>";
        $MobileNoLABEL = $myLink;
        if ( getGet("COL") == "MobileNo" || getSession("BrowseTeacher#COL") == "MobileNo" ):
            if (getSession("BrowseTeacher#SRT") == "ASC"):
                $MobileNoLABEL .= "<img alt=\"ASC\" SRC=" . $IconAsc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            else:            
                $MobileNoLABEL .= "<img alt=\"DESC\" SRC=" . $IconDesc . " border=" . $IconBorder . " height=" . $IconHeight . " width=" . $IconWidth . ">";
            endif;
        endif;
$HeaderText = Replace($HeaderText,"@CountryIDLABEL@", $CountryIDLABEL);
$HeaderText = Replace($HeaderText,"@BranchIDLABEL@", $BranchIDLABEL);
$HeaderText = Replace($HeaderText,"@IDLABEL@", $IDLABEL);
$HeaderText = Replace($HeaderText,"@PasswordLABEL@", $PasswordLABEL);
$HeaderText = Replace($HeaderText,"@NameLABEL@", $NameLABEL);
$HeaderText = Replace($HeaderText,"@LocalNameLABEL@", $LocalNameLABEL);
$HeaderText = Replace($HeaderText,"@DateStartLABEL@", $DateStartLABEL);
$HeaderText = Replace($HeaderText,"@PhoneNoLABEL@", $PhoneNoLABEL);
$HeaderText = Replace($HeaderText,"@MobileNoLABEL@", $MobileNoLABEL);
}

/*
=============================================================================
 buildDataRows  Function
=============================================================================
*/
function buildDataRows() {
    global $DataRowEmptyText;
    global $DataRowFilledText;
    global $oRStteacher;
    global $RecordsPageSize;
    global $tteacherAutomaticDetailLink;
    global $tteacherAutomaticDetailLinkSTYLE;
    global $tteacherBranchID;
    global $tteacherBranchIDLABEL;
    global $tteacherBranchIDSTYLE;
    global $tteacherCountryID;
    global $tteacherCountryIDLABEL;
    global $tteacherCountryIDSTYLE;
    global $tteacherDateStart;
    global $tteacherDateStartLABEL;
    global $tteacherDateStartSTYLE;
    global $tteacherID;
    global $tteacherIDLABEL;
    global $tteacherIDSTYLE;
    global $tteacherLocalName;
    global $tteacherLocalNameLABEL;
    global $tteacherLocalNameSTYLE;
    global $tteacherMobileNo;
    global $tteacherMobileNoLABEL;
    global $tteacherMobileNoSTYLE;
    global $tteacherName;
    global $tteacherNameLABEL;
    global $tteacherNameSTYLE;
    global $tteacherPassword;
    global $tteacherPasswordLABEL;
    global $tteacherPasswordSTYLE;
    global $tteacherPhoneNo;
    global $tteacherPhoneNoLABEL;
    global $tteacherPhoneNoSTYLE;
    global $Header;
    global $Footer;
    global $MainContent;
    global $Menu;
    global $userdata1;
$Seq = 0;

    if ($oRStteacher) :
        while ((!$oRStteacher->EOF) && ($Seq < $RecordsPageSize)):
            $DataRowFilledText .= $DataRowEmptyText;

            $DataRowFilledText = Replace($DataRowFilledText, "@Header@", $Header);
            $DataRowFilledText = Replace($DataRowFilledText, "@Footer@", $Footer);
            $DataRowFilledText = Replace($DataRowFilledText, "@MainContent@", $MainContent);
            $DataRowFilledText = Replace($DataRowFilledText, "@Menu@", $Menu);
            $DataRowFilledText = Replace($DataRowFilledText, "@userdata1@", $userdata1);
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
    $tteacherAutomaticDetailLinkSTYLE = "TableRow" . $Style;
    $myLink = "";
            $myLink = "<a href=\"Updatetteacheredit.php?ID1=";
                    $tteacherAutomaticDetailLink = $myLink;
                      $tteacherAutomaticDetailLink .= "'" . htmlEncode(trim(getValue($oRStteacher->fields["CountryID"]))) . "'" ;
                    $tteacherAutomaticDetailLink .=  "&ID2=" . "'";
                    $tteacherAutomaticDetailLink .= htmlEncode(trim(getValue($oRStteacher->fields["BranchID"]))) . "'";
                    $tteacherAutomaticDetailLink .=  "&ID3=" . "'";
                    $tteacherAutomaticDetailLink .= htmlEncode(trim(getValue($oRStteacher->fields["ID"]))) . "'";
            $tmpIMG_tteacherAutomaticDetailLink = "";
            $tmpIMG_tteacherAutomaticDetailLink = "<img src=\"/images/editpencil.gif\" border=\"0\" alt=\"Edit Record\">";
                $tteacherAutomaticDetailLink .= "\">" . $tmpIMG_tteacherAutomaticDetailLink . "</a>";
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherCountryIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["CountryID"])):
        $tteacherCountryID = "";
    else:
        $tteacherCountryID = htmlEncode(getValue($oRStteacher->fields["CountryID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherBranchIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["BranchID"])):
        $tteacherBranchID = "";
    else:
        $tteacherBranchID = htmlEncode(getValue($oRStteacher->fields["BranchID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherIDSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["ID"])):
        $tteacherID = "";
    else:
        $tteacherID = htmlEncode(getValue($oRStteacher->fields["ID"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherPasswordSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["Password"])):
        $tteacherPassword = "";
    else:
        $tteacherPassword = htmlEncode(getValue($oRStteacher->fields["Password"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["Name"])):
        $tteacherName = "";
    else:
        $tteacherName = htmlEncode(getValue($oRStteacher->fields["Name"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherLocalNameSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["LocalName"])):
        $tteacherLocalName = "";
    else:
        $tteacherLocalName = htmlEncode(getValue($oRStteacher->fields["LocalName"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherDateStartSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["DateStart"])):
        $tteacherDateStart = "";
    else:
        $tteacherDateStart = htmlEncode(getValue($oRStteacher->fields["DateStart"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherPhoneNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["PhoneNo"])):
        $tteacherPhoneNo = "";
    else:
        $tteacherPhoneNo = htmlEncode(getValue($oRStteacher->fields["PhoneNo"]));
endif;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherMobileNoSTYLE = "TableRow" . $Style;
    if (is_null($oRStteacher->fields["MobileNo"])):
        $tteacherMobileNo = "";
    else:
        $tteacherMobileNo = htmlEncode(getValue($oRStteacher->fields["MobileNo"]));
endif;
$Seq++;
$oRStteacher->MoveNext();

$DataRowFilledText = Replace($DataRowFilledText,"@tteacherAutomaticDetailLink@", $tteacherAutomaticDetailLink);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherAutomaticDetailLinkSTYLE@", $tteacherAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherCountryID@", $tteacherCountryID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherCountryIDSTYLE@",$tteacherCountryIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherBranchID@", $tteacherBranchID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherBranchIDSTYLE@",$tteacherBranchIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherID@", $tteacherID);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherIDSTYLE@",$tteacherIDSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPassword@", $tteacherPassword);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPasswordSTYLE@",$tteacherPasswordSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherName@", $tteacherName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherNameSTYLE@",$tteacherNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherLocalName@", $tteacherLocalName);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherLocalNameSTYLE@",$tteacherLocalNameSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherDateStart@", $tteacherDateStart);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherDateStartSTYLE@",$tteacherDateStartSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPhoneNo@", $tteacherPhoneNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPhoneNoSTYLE@",$tteacherPhoneNoSTYLE);           
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherMobileNo@", $tteacherMobileNo);       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherMobileNoSTYLE@",$tteacherMobileNoSTYLE);           
        endwhile; // of oRStteacher DO WHILE
    endif; // rs is valid

// now to add the filler rows

if ($Seq < $RecordsPageSize):
$Seq = ($RecordsPageSize - $Seq);
do { 
    $DataRowFilledText .= $DataRowEmptyText;
    $Style = ($Seq%2 != 0) ? "MyDataRow" : "AlternateRow";
$tteacherAutomaticDetailLinkSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherAutomaticDetailLink@", "&nbsp;");       
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherAutomaticDetailLinkSTYLE@", $tteacherAutomaticDetailLinkSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherCountryID@", "&nbsp;");
$tteacherCountryIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherCountryIDSTYLE@", $tteacherCountryIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherBranchID@", "&nbsp;");
$tteacherBranchIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherBranchIDSTYLE@", $tteacherBranchIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherID@", "&nbsp;");
$tteacherIDSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherIDSTYLE@", $tteacherIDSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPassword@", "&nbsp;");
$tteacherPasswordSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPasswordSTYLE@", $tteacherPasswordSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherName@", "&nbsp;");
$tteacherNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherNameSTYLE@", $tteacherNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherLocalName@", "&nbsp;");
$tteacherLocalNameSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherLocalNameSTYLE@", $tteacherLocalNameSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherDateStart@", "&nbsp;");
$tteacherDateStartSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherDateStartSTYLE@", $tteacherDateStartSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPhoneNo@", "&nbsp;");
$tteacherPhoneNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherPhoneNoSTYLE@", $tteacherPhoneNoSTYLE);
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherMobileNo@", "&nbsp;");
$tteacherMobileNoSTYLE = "TableRow" . $Style;
$DataRowFilledText = Replace($DataRowFilledText,"@tteacherMobileNoSTYLE@", $tteacherMobileNoSTYLE);
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
global $oRStteacher;
$iStart = ((($PageIndex - 1 ) * $RecordsPageSize ));
$iEnd = ($PageIndex) * ($RecordsPageSize);

if($iEnd < $TotalRecords):
    $iEnd = $iEnd;
else:
    $iEnd = $TotalRecords;
endif;
$ref = "";
if ($ShowDBNav == "TRUE"):
$SearchPage = "Updatetteachersearch.php";
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
        $ref .= "<a href=Updatetteacher" . "search.php><img src=\"" . $IconQuery . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Search\"></a>";
$TableFooter .= $ref;
    endif;
    if ($ShowAdd == TRUE):
    // okay now the Add button
        $ref = "";
        $ref .= "<a href=Updatetteacher" . "add.php><img src=\"" . $IconAdd . "\" border=\"" . $IconBorder . "\" height=\"" . $IconHeight . "\" width=\"" . $IconWidth . "\" alt=\"Insert record\"></a>";
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
