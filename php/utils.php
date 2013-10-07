<?PHP


/*
=============================================================================
 loadInclude($IncludeFile)
    Load and return include file contents
=============================================================================
*/
function loadInclude($IncludeFile) {
 if (!isset($IncludeFile) || $IncludeFile == ""):
  return("");
 endif;
 $FileObject = "";
 $FileText = "";
 $FileObject = fopen($IncludeFile, "r");
 if($FileObject):
    $FileText = fread($FileObject, filesize($IncludeFile));
    fclose ($FileObject);
 endif;
 return($FileText);
}

/*
=============================================================================
    Replace($Text, $TargetSymbol, $NewValue)
    mimic the VBScript Replace() function
=============================================================================
*/
function Replace($Text, $TargetSymbol, $NewValue) {
 return str_replace($TargetSymbol,$NewValue,$Text);    
} 

/*
=============================================================================
    getRequest($getVariable)
    return a variable from Env,GET,POST,Cookies,SERVER
=============================================================================
*/
function getRequest($getVariable) {
 return isset($_REQUEST[$getVariable]) ? stripslashes(urldecode($_REQUEST[$getVariable])) : "";    
}

/*
=============================================================================
    getEnviron($getVariable)
    return a variable from GET
=============================================================================
*/
function getEnviron($getVariable) {
 return isset($_ENV[$getVariable]) ? $_ENV[$getVariable] : "";    
}

/*
=============================================================================
    getCookie($getVariable)
    return a variable from a cookie
=============================================================================
*/
function getCookie($getVariable) {
 return isset($_COOKIE[$getVariable]) ? $_COOKIE[$getVariable] : "";    
}

/*
=============================================================================
    getGet($getVariable)
    return a variable from GET
=============================================================================
*/
function getGet($getVariable) {
 return isset($_GET[$getVariable]) ? stripslashes(urldecode($_GET[$getVariable])) : "";    
}

/*
=============================================================================
    getPost($getVariable)
    return a variable from POST
=============================================================================
*/
function getPost($getVariable) {
 return isset($_POST[$getVariable]) ? $_POST[$getVariable] : "";    
}

/*
=============================================================================
    getForm($getVariable)
    return a variable from POST
=============================================================================
*/
function getForm($getVariable) {
 return isset($_POST[$getVariable]) ? $_POST[$getVariable] : "";    
}

/*
=============================================================================
 getServer($getVariable)
    return a variable from SERVER
=============================================================================
*/
function getServer($getVariable) {
 return isset($_SERVER[$getVariable]) ? $_SERVER[$getVariable] : "";    
}

/*
=============================================================================
 getSession($getVariable)
    return a variable from SERVER
=============================================================================
*/
function getSession($getVariable) {
 return isset($_SESSION[$getVariable]) ? $_SESSION[$getVariable] : "";    
}

/*
=============================================================================
getValue($ReturnValue) 
=============================================================================
*/
function getValue($ReturnValue) {
    if(!$ReturnValue || is_null($ReturnValue)):
        return("");
    else:
        return($ReturnValue);
    endif;
}

/*
=============================================================================
formatPercent($Value,$RoundDigits,$GroupSep,$DecimalSep,$PercentChar)
=============================================================================
*/
function formatPercent($Value, $RoundDigits=2,$GroupSep='',$DecimalSep='.',$PercentChar='after') {
    if ($GroupSep == 'None'):
        $GroupSep = '';
    endif;
    $Value = getValue($Value);
    if(!$Value==""):
        $Value = number_format($Value * 100,$RoundDigits,$DecimalSep,$GroupSep);
        if($PercentChar=='after'):
            $Value .= '%';
        elseif($PercentChar=='before'):
            $Value = '%'. $Value;
        endif;
    endif;
    return $Value;  
} 

/*
=============================================================================
formatCurrency($Value, $RoundDigits,$MoneyChar,$GroupSep,$DecimalSep)
=============================================================================
*/
function formatCurrency($Value, $RoundDigits=2, $MoneyChar='$',$GroupSep =',',$DecimalSep ='.') {
    if(!trim($MoneyChar)==''):
        return $MoneyChar . number_format(round($Value, $RoundDigits),$RoundDigits,$DecimalSep,$GroupSep);
    else:
        return number_format(round($Value, $RoundDigits),$RoundDigits,$DecimalSep,$GroupSep);
    endif;
}

/*
=============================================================================
formatNumber($Value,$Digits,$Decimals,$LeadingZeros,$GroupSep,$DecimalSep)
=============================================================================
*/
function formatNumber($Value,$Digits,$Decimals=0,$LeadingZeros=0,$GroupSep='',$DecimalSep='.') {
    if($Decimals > 0):
        if($LeadingZeros == 1):
            return sprintf("%0{$Digits}{$DecimalSep}{$Decimals}0s",number_format($Value, $Decimals,$DecimalSep,$GroupSep));
        else:
            return sprintf("%{$Digits}{$DecimalSep}{$Decimals}0s",number_format($Value, $Decimals, $DecimalSep,$GroupSep));
        endif;
    else:
        if($LeadingZeros == 1):
            return sprintf("%0{$Digits}s",number_format($Value, 0,'',$GroupSep) ) ;        
        else:
            return sprintf("%{$Digits}s",number_format($Value, 0, '',$GroupSep)) ;     
        endif;
    endif;
} 

/*
=============================================================================
function formatDateTime($fmt,$val)
=============================================================================
*/
function formatDateTime($fmt, $val='') {
    if(!$fmt || $val == ''|| is_null($val)):
        return '';
    else:
        if(strtotime($val) > -1):
            return date($fmt,strtotime($val));
        else:
            return $val;
        endif;
    endif;
}

/*
=============================================================================
    htmlDecode ($string)
=============================================================================
*/
function htmlDecode ($string) {
global $HTMLEncode;
    if($HTMLEncode == TRUE):
        $trans_tbl = get_html_translation_table (HTML_ENTITIES);
        $trans_tbl = array_flip ($trans_tbl);
        return strtr ($string, $trans_tbl);
    else:
        return $string;
    endif;      
}

/*
=============================================================================
    htmlEncode ($string)
=============================================================================
*/
function htmlEncode ($string) {
global $HTMLEncode;
    if($HTMLEncode == TRUE):
        return htmlentities($string, ENT_QUOTES);
    else:
        return $string;
    endif;
}

/*
=============================================================================
    set_Cookie(string varname (required),string varval,int expire,
        string path, string domain, bool secure);
=============================================================================
 ----------- NOT COMPLETELY TESTED YET !

*/
function set_Cookie() {
 $vars=array('varname','varval','expire','path','domain','secure');
 for ($i=0;$i<func_num_args();$i++) {
    ${$vars[$i]}=func_get_arg($i);
 }
 if (!$varname) { return false; }
 $COOKIE = "Set-Cookie: $varname=$varval";
 if (isset($expire) && ($expire > 0)) {
    $COOKIE .= "; EXPIRES=". 
    gmdate("D, d M Y H:i:s",$expire) . 
    " GMT";}
 if (isset($domain)) { $COOKIE .= "; DOMAIN=$domain"; }
 if (isset($path))   { $COOKIE .= "; PATH=$path"; }
 if (isset($secure) && $secure>0) { $COOKIE .= "; SECURE"; }
 header($COOKIE,false);
 return true;
}

/*
=============================================================================
function getQuote(&$Connection,$Table, $Column)
    Return a QUOTE character based on column type
=============================================================================



*/
function getQuote(&$Connection, $Table, $Column) {
 global $DateQuote;
 $myType = "";
 $myQuote = "";
 $myType = getColType($Connection, $Table, $Column);
 if ($myType == 'C' || $myType == 'X'):
  $myQuote = "'";
 endif;
 if ($myType == 'D' || $myType == 'T'):
  $myQuote = $DateQuote;
 endif;

 return ($myQuote);

}

/*
=============================================================================
 getColType(&$Connection, $Table, $Column)
 Return a Columns Type 
=============================================================================
C: Character fields that should be shown in a <input type="text"> tag. 
X: Clob (character large objects), or large text fields that should be shown in a <textarea> 
D: Date field 
T: Timestamp field 
L: Logical field (boolean or bit-field) 
N: Numeric field. Includes decimal, numeric, floating point, and real. 
I: Integer field. 
R: Counter or Autoincrement field. Must be numeric. 
B: Blob, or binary large objects. 



*/
function getColType(&$Connection, $Table, $Column) {
 $myType = "";
 $myField = "";
 $strSQL = "";
 $strSQL = 'SELECT ' . $Column . ' FROM ' . $Table . ' WHERE 0 = 1';
 $objRS = $Connection->Execute($strSQL);
 $fld = $objRS->FetchField(0);
 $myType  = $objRS->MetaType($fld->type);
 $objRS->Close();
 unset($objRS);

 return ($myType);
}

/*
=============================================================================
 getFormSQLQuoted(&$Connection, $Table, $Column, $getVariable)
    a column sql quoted as needed
=============================================================================



*/
function getFormSQLQuoted(&$Connection, $Table, $Column, $getVariable) {
 $maxlen = 0;
 $myField = "";
 $strSQL = "";
 $strSQL = 'SELECT ' . $Column . ' FROM ' . $Table . ' WHERE 0 = 1';
 $objRS = $Connection->Execute($strSQL);
 $fld = $objRS->FetchField(0);
 $maxlen = $fld->max_length;  
 $myType = getColType($Connection, $Table, $Column);
 $myValue = getPost($getVariable);
 
 switch (strtoupper($myType)) {
    case 'C':
    case 'X':
        $myValue = substr($myValue,0,$maxlen);
        // return $Connection->Quote($myValue);
        return $Connection->qstr($myValue, get_magic_quotes_gpc());
    case 'D':       
        return $Connection->DBDate($myValue);   
    case 'T':           
        return $Connection->DBTimeStamp($myValue);
    case 'N':
    case 'I':
    case 'R':
        return $myValue == "" ? 0 : $myValue;
    case 'L':
        return $myValue == "" ? 0 : 1;
    default:
        // default to some character type
        $myValue = substr($myValue,0,$maxlen);
        return $Connection->Quote($myValue);
    } 
  $objRS->Close();
  unset($objRS);
}

/*
=============================================================================
 getSize(&$Connection, $Table, $Column)
    return a columns size
=============================================================================



*/
function getSize(&$Connection, $Table, $Column) {
 $myField = "";
 $strSQL = "";
 $strSQL = 'SELECT ' . $Column . ' FROM ' . $Table . ' WHERE 0 = 1';
 $objRS = $Connection->Execute($strSQL);
 $fld = $objRS->FetchField(0);
 $objRS->Close();
 unset($objRS);
 return $fld->max_length;
}

/*
=============================================================================
getSelectOptions(&$Connection, $strQuery, $DisplayField, $ValueField, $CurrentValue)
=============================================================================



*/
function getSelectOptions(&$Connection, $strQuery, $DisplayField, $ValueField, $CurrentValue) {
    $myOptions = "";
    $objRS = $Connection->Execute($strQuery);
    if ($objRS->MoveFirst() == false):
        $objRS->Close();
        $myOptions = "No records were found";
    endif;
    if ($objRS) :
        $objRS->MoveFirst();
        while (!$objRS->EOF): 
            $myOptions .= "<option value='" . $objRS->fields("$ValueField") . "' ";
            if($CurrentValue):
                if ($objRS->fields("$ValueField") == $CurrentValue):
                    $myOptions .= " SELECTED ";
                endif;
            endif;            
            $myOptions .= ">" . $objRS->fields("$DisplayField") . "</option>\n";
            $objRS->MoveNext();
         endwhile;
    else:
        $myOptions = "No records were found";
    endif;
    unset($objRS);
    return($myOptions);
}

/*
=============================================================================
dbLookUp(&$Connection, $Table, $KeyCol, $KeyVal, $RetCol)
=============================================================================



*/
function dbLookUp(&$Connection, $Table, $KeyCol, $KeyVal, $RetCol) {
    $myResult = "";
    $strQuery = "";
    $strMyQuote = "";
    $strMyQuote = getQuote($Connection, $Table, $KeyCol);
    $strQuery = "select " . $RetCol . " from " . $Table . " where " . $KeyCol . "=" . $strMyQuote . $KeyVal . $strMyQuote;

    $myResult = $Connection->Execute($strQuery);

    if(!$myResult || is_null($myResult) ):
        return("");
    else:
        $myResult->MoveFirst();
        return($myResult->fields($RetCol));
    endif;
    unset($myResult);
}

/*
=================================================================
getIDs()
=================================================================
*/

function  getIDs() {
   $myKeys = "";
   $i = 1;
   while (getRequest("ID".strval($i)) != ""):
     $myKeys .= "&ID".strval($i) . "=" . getRequest("ID".strval($i));
     $i++;
   endwhile;
   return($myKeys);
}


/*
=================================================================
process_Upload($FileID, $FileType, $FileMaxSize, $FileTargetDirecotry, $ExcludeEXEPHP)
=================================================================
*/

function process_Upload($FileID, $FileType, $FileMaxSize, $FileTargetDirectory, $ExcludeEXEPHP) {
    $myFileName = $_FILES[$FileID]["name"];
    $myFileSize = $_FILES[$FileID]["size"];
    $myError = $_FILES[$FileID]["error"];
    $myFileType = $_FILES[$FileID]["type"];
    $RetValue = 0;

    $registered_types = array(
                    "application/x-gzip-compressed"     => ".tar.gz, .tgz",
                    "application/x-zip-compressed"         => ".zip",
                    "application/x-tar"                    => ".tar",
                    "text/plain"                        => ".html, .php, .txt, .inc (etc)",
                    "image/bmp"                         => ".bmp, .ico",
                    "image/gif"                         => ".gif",
                    "image/pjpeg"                        => ".jpg, .jpeg",
                    "image/jpeg"                        => ".jpg, .jpeg",
                    "application/x-shockwave-flash"     => ".swf",
                    "application/msword"                => ".doc",
                    "application/vnd.ms-excel"            => ".xls",
                    "application/octet-stream"            => ".exe, .fla (etc)"
                    ); # these are only a few examples, you can find many more!

    if ($myFileName <> "") {
       if ($myError == 0) {

        switch($FileType) {
        case "All":
          if ($ExcludeEXEPHP == 1) {
            if ( strtoupper(substr($myFileName, -4)) <> ".EXE" and strtoupper(substr($myFileName, -4)) <> ".PHP" ) {
              move_uploaded_file($_FILES[$FileID]["tmp_name"], $FileTargetDirectory . $myFileName);
            }
            else {
              $RetValue = 10;
            }
          }
          else {
            move_uploaded_file($_FILES[$FileID]["tmp_name"], $FileTargetDirectory . $myFileName);
          }
          break;
        case "Images":
          $allowed_types = array("image/bmp","image/gif","image/pjpeg","image/jpeg");
          if (in_array($myFileType, $allowed_types)) {
            move_uploaded_file($_FILES[$FileID]["tmp_name"], $FileTargetDirectory . $myFileName);
          }
          else {
            $RetValue = 10;
          }
          break;
        case "ZIP":
          $allowed_types = array("application/x-gzip-compressed" ,"application/x-zip-compressed" ,"application/x-tar");
          if (in_array($myFileType, $allowed_types)) {
            move_uploaded_file($_FILES[$FileID]["tmp_name"], $FileTargetDirectory . $myFileName);
          }
          else {
            $RetValue = 10;
          }
          break;
        }
      }
      else {
        $RetValue = $myError;
      }
    }
    return($RetValue);

}


?>
