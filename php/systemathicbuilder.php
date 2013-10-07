<?PHP
session_start();
include_once('utils.php');
$varPath = dirname($_SERVER['PHP_SELF']);
if ($varPath == "\\") {
  $varPath = "";
}
if (getRequest("RETURN")):
  $pgVarGoTo = $_SERVER['HTTP_HOST']. $varPath;
  if (substr($pgVarGoTo, -1) == '/'):
          $pgVarGoTo = $pgVarGoTo . getRequest("RETURN") . $_SESSION["RETURN_PARAMETERS"];
  else:
          $pgVarGoTo = $pgVarGoTo ."/". getRequest("RETURN") . $_SESSION["RETURN_PARAMETERS"];
  endif;
  header("Location: http://".$pgVarGoTo);
endif;          
global $ClarionData;
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
$TemplateText = Replace($TemplateText, "@Header@", $_SESSION("Header"));
$TemplateText = Replace($TemplateText, "@Footer@", $_SESSION("Footer"));
$TemplateText = Replace($TemplateText, "@MainContent@", $_SESSION("MainContent"));
$TemplateText = Replace($TemplateText, "@Menu@", $_SESSION("Menu"));
print($TemplateText);
//
?>
