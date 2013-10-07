<?PHP
include_once('systemathicappdata.php');
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
include_once('utils.php');
$myQuote = "";
$objRSImage = "";
$strSQL = "";
$image = "";
$myType = "";


$myQuote = getQuote($objConn1, getGet("tbl"), getGet("idCol"));

$strSQL = "select " . getGet("col") . " from " . getGet("tbl") . " where ";
$strSQL .= getGet("idCol") . " = " . $myQuote . getGet("id") . $myQuote;

$objRSImage = $objConn1->Execute($strSQL);

if  ($objRSImage):
$image = $objRSImage->fields[getGet("col")];
$objRSImage->Close();
    switch (getGet("type")):
        case "jpg":
            header("Content-type:  image/jpeg");
            $myType = "jpg";
            break;
        case "gif":
            header("Content-type:  image/gif");
            $myType = "gif";
            break;
        case "png":
            header("Content-type:  image/png");
            $myType = "png";
            break;
        default:
            if(ord($image[0]) == 255 && ord($image[1]) == 216 &&
               ord($image[2]) == 255 && ord($image[3]) == 224):
                header("Content-type:  image/jpeg");            
                $myType = "jpg";
            endif;
            if(strcmp(strtoupper(substr($image,0,3)),"GIF") == 0):
                header("Content-type:  image/gif");
                $myType = "gif";
            endif;
            if(ord($image[0]) == 137 && ord($image[1]) == 80 &&
               ord($image[2]) == 78  && ord($image[3]) == 71 &&
               ord($image[4]) == 13  && ord($image[5]) == 10 &&
               ord($image[6]) == 26  && ord($image[7]) == 10):
                header("Content-type:  image/png");            
                $myType = "png";
            endif;          
    endswitch;
    header("Content-Disposition: attachment; filename=\"" . getGet("col") . ".$myType" . "\"\n"); 
    header("Content-Transfer-Encoding: binary\n"); 
    header("Content-length: " . strlen($image) . "\n"); 
    print($image);
    unset($image);
endif;
unset($objRSImage);
    $objConn1->Close();
    unset($objConn1);
?>
