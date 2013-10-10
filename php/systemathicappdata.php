<?PHP
// for the application level debugging and HTML comments
include_once('utils.php');
$myTestPage = "systemathic" . "test.php";
if (strtoupper(getRequest("debug")) == "TRUE" && strstr(getServer("PHP_SELF"), $myTestPage)):
    $DebugMode = TRUE;
    error_reporting(E_ALL);
else:
    $DebugMode = FALSE;
    error_reporting(0);
endif;
include_once("adodb-errorhandler.inc.php");
include_once("adodb.inc.php");



$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

$DateQuote = "'";
$HTMLEncode = TRUE;
//for the application level Query by Form button in the
//db navigation bar on HTML tables
$ShowQuery = TRUE;

$ShowAdd = TRUE;

//for the application level display of the
//db navigation bar on HTML tables
$ShowDBNav = TRUE;

//the number of data records to display per html table
$RecordsPerPage = 10;

//icon settings

$IconBorder=0;
$IconWidth=20;
$IconHeight=20;

$IconPath = "/images/" ;

$IconBack = $IconPath . "back.gif";
$IconHelp = $IconPath . "help.gif";

$IconAsc  = $IconPath . "asc.gif";
$IconDesc = $IconPath . "desc.gif";

$IconEllipsis = $IconPath . "ellipsis.gif";
$IconReturn = $IconPath . "return.gif";
$IconEdit = $IconPath . "editpencil.gif";

$IconFirst = $IconPath . "first.gif";
$IconFirstDisabled = $IconPath . "firstd.gif";
$IconPrior = $IconPath . "prior.gif";
$IconPriorDisabled = $IconPath . "priord.gif";
$IconAdd = $IconPath . "add.gif";
$IconAddDisabled = $IconPath . "addd.gif";
$IconQuery = $IconPath . "qbf.gif";
$IconQueryDisabled = $IconPath . "qbfd.gif";
$IconNext = $IconPath . "next.gif";
$IconNextDisabled = $IconPath . "nextd.gif";
$IconLast = $IconPath . "last.gif";
$IconLastDisabled = $IconPath . "lastd.gif";

//declare the user data variables SESSION (GLOBAL) SCOPE
$Header = file_get_contents('template/header.php', true);
$Footer = file_get_contents('template/footer.php', true);
$MainContent = $_SESSION['UserValue1'];
$Menu = file_get_contents('template/stat.php', true);
$Xmenu = "xmenu"; 

?>
