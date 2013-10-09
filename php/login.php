<?PHP
include_once('utils.php');
include_once('systemathicappdata.php');
$sqlString = "";
$objRS = "";
$strURL = "";
$strUserID = "";
$strPwd = "";
$strUserID = getCookie("userid");
$strPwd = getCookie("pwd");
$strURL = getServer("PHP_SELF") . "?" . getServer("QUERY_STRING");
$ClarionData = "";
/*
=============================================================================
 Merge Blank HTML Site Template 
=============================================================================
*/

function MergeLoginTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/blank.htm";
    endif;
    global $ClarionData;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);
    print $TemplateText;
}

if (getSession("AuthStatus") != "Authorized"):
    if (getForm("frmLogin") == "" && $strPwd == ""):
        $ClarionData .= "<form action='" . $strURL . "' method=POST id=form1 name=form1>\n";
        $ClarionData .= "<div class='bg'>\n";
        $ClarionData .= "<input type=hidden name=frmLogin value=true>\n";
        $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=1>\n";
        $ClarionData .= "   <tr> \n";
        $ClarionData .= "       <td COLSPAN=2 class='Header'>\n";
        $ClarionData .= "       <strong>User Login</strong></font>\n";
        $ClarionData .= "       </td>\n";
        $ClarionData .= "   </tr>\n";
        $ClarionData .= "   <tr> \n";
        $ClarionData .= "       <td colspan=2 align='center' class='Label'>\n";
        $ClarionData .= "       This login will expire from inactivity <br>\n";
        $ClarionData .= "       </td>\n";
        $ClarionData .= "   </tr>\n";
        $ClarionData .= "   <tr> \n";
        $ClarionData .= "       <td class='Label'>User ID </font></td>\n";
        $ClarionData .= "       <td class='Input'>\n";
        $ClarionData .= "       <input type=text name=frmUserID value='" . $strUserID . "'  >\n";
        $ClarionData .= "       </td>\n";
        $ClarionData .= "   </tr>\n";
        $ClarionData .= "   <tr> \n";
        $ClarionData .= "       <td class='Label'>Password </font></td>\n";
        $ClarionData .= "       <td class='Input'>\n";
        $ClarionData .= "       <input type=password name=frmUserPass  value='" . $strPwd . "'  >\n";
        $ClarionData .= "       </td>\n";
        $ClarionData .= "   </tr>\n";
        $ClarionData .= "   <tr> \n";
        $ClarionData .= "       <td colspan=2 align=center class='Footer'> \n";
        $ClarionData .= "       <input type=submit name=Submit value=Submit><input type=Reset name=Reset value=Reset>\n";
        $ClarionData .= "       </td>\n";
        $ClarionData .= "   </tr>\n";
        $ClarionData .= "  </table>\n";
        $ClarionData .= "</div>\n";
        $ClarionData .= "</form>\n";
        MergeLoginTemplate("./html/blank.htm");
        exit;
    elseif (getForm("frmLogin") == "true" || $strUserID != ""):
            if ($strPwd != ""):
                $sqlString = "select * from tteacher where tteacher.Name ='" . $strUserID  . "'";
            else:
                $sqlString = "select * from tteacher where tteacher.Name ='" . getForm("frmUserID") . "'";
            endif;

            include_once('ConnInfo.php');

            $objConnLogin = &ADONewConnection($Driver1);
            $objConnLogin->debug = $DebugMode;
            $objConnLogin->PConnect($Server1,$User1,$Password1,$db1);

            $objRS = $objConnLogin->Execute($sqlString);
            if (!$objRS or $objRS->RecordCount() == 0):
                $ClarionData .= "<div class='bg'>\n";
                $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
                $ClarionData .= "<tr><td width='80%' class='Header'>User Login</td>\n";
                $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>";
                $ClarionData .= "</tr>\n";
                $ClarionData .= "   <tr> ";
                $ClarionData .= "       <td colspan=2 align='center' class='Label'>The User ID you entered was not found <br>\n";
                $ClarionData .= "   Press the back button to retry.\n";                              
                $ClarionData .= "       </td>";
                $ClarionData .= "   </tr>\n";
                $ClarionData .= "  </table>\n";
                $ClarionData .= "</div>\n";
                MergeLoginTemplate("./html/blank.htm");
                exit;
            else:
                if ( (rtrim(strtolower(getForm("frmUserPass"))) == rtrim(strtolower($objRS->fields["Password"])))  || ( rtrim(strtolower($objRS->fields["Password"])) == rtrim($strPwd))):
                    if ($strPwd == ""):
                        $strPWd = $objRS->fields["Password"];
                    endif;
                    $_SESSION["pwd"] = $strPWd;
                    $_SESSION["AuthStatus"] = "Authorized";
                    $_SESSION["UserID"] = $objRS->fields["ID"];
                    $_SESSION["UserLevel"] = $objRS->fields["RoleID"];

                    if (getForm("frmUserSave") == "on"):
                      if (getSession("UserID") != ""):
                        setcookie("userid", getForm("frmUserID"),time()+60*60*24*360,"/");
                      endif;
                    endif;
                    if (getForm("frmUserSave") == "on"):
                      if (getSession("pwd") != ""):
                        setcookie("pwd", getForm("frmUserPass") ,time()+60*60*24*360, "/");
                      endif;
                    endif;

                   if (getForm("frmUserSave") <> "on"):
                     setcookie("userid", "",time() - 3600 ,"/");
                     setcookie("pwd", "",time() - 3600 ,"/");
                   endif;
                   $objRS->Close();
                else:
                    $ClarionData .= "<div class='bg'>\n";
                    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
                    $ClarionData .= "<tr><td width='80%' class='Header'>User Login</td>\n";
                    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>";
                    $ClarionData .= "</tr>\n";
                    $ClarionData .= "   <tr> ";
                    $ClarionData .= "       <td colspan=2 align='center' class='Label'>The Password you entered was not correct <br>\n";
                    $ClarionData .= "   Press the back button to retry.\n";                              
                    $ClarionData .= "       <td>";
                    $ClarionData .= "   </tr>\n";
                    $ClarionData .= "  </table>\n";
                    $ClarionData .= "</div>\n";
                    MergeLoginTemplate("./html/blank.htm");
                    exit;
                endif;
            endif;
    else:
        $strURL = getRequest("REDIRECT_URL") . "?" . getServer("REDIRECT_QUERY_STRING");
        header("Location: http://" . getRequest("SERVER_NAME") . $strURL);
        exit;
    endif;
endif;
            if ($PageLevel + 0 > getSession("UserLevel") + 0 ):
$ClarionData .= "<div class='bg'>\n";
$ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
$ClarionData .= "<tr><td width='80%' class='Header'>User Login</td>\n";
$ClarionData .= "<td align='right' class='Header'>&nbsp;<A href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>";
$ClarionData .= "</tr>\n";
$ClarionData .= "   <tr> ";
$ClarionData .= "       <td align='center' class='Label'>Your security level does not permit the requested operation <br>\n";
$ClarionData .= "   Press the back button to retry.\n";                              
$ClarionData .= "       <td>";
$ClarionData .= "   </tr>\n";
$ClarionData .= "  </table>\n";
$ClarionData .= "</div>\n";
MergeLoginTemplate("./html/blank.htm");
exit;
endif;
unset($objRS);

?>
