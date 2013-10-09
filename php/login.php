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

        $ClarionData .= "<!DOCTYPE html>
<html lang='en'>
<head>
  <!--
    Charisma v1.0.0

    Copyright 2012 Muhammad Usman
    Licensed under the Apache License v2.0
    http://www.apache.org/licenses/LICENSE-2.0

    http://usman.it
    http://twitter.com/halalit_usman
  -->
  <meta charset='utf-8'>
  <title>Free HTML5 Bootstrap Admin Template</title>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <meta name='description' content='Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.'>
  <meta name='author' content='Muhammad Usman'>

  <!-- The styles -->
  <link id='bs-css' href='template/css/bootstrap-cerulean.css' rel='stylesheet'>
  <style type='text/css'>
    body {
    padding-bottom: 40px;
    }
    .sidebar-nav {
    padding: 9px 0;
    }
  </style>
  <link href='template/css/bootstrap-responsive.css' rel='stylesheet'>
  <link href='template/css/charisma-app.css' rel='stylesheet'>
  <link href='template/css/jquery-ui-1.8.21.custom.css' rel='stylesheet'>
  <link href='template/css/fullcalendar.css' rel='stylesheet'>
  <link href='template/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
  <link href='template/css/chosen.css' rel='stylesheet'>
  <link href='template/css/uniform.default.css' rel='stylesheet'>
  <link href='template/css/colorbox.css' rel='stylesheet'>
  <link href='template/css/jquery.cleditor.css' rel='stylesheet'>
  <link href='template/css/jquery.noty.css' rel='stylesheet'>
  <link href='template/css/noty_theme_default.css' rel='stylesheet'>
  <link href='template/css/elfinder.min.css' rel='stylesheet'>
  <link href='template/css/elfinder.theme.css' rel='stylesheet'>
  <link href='template/css/jquery.iphone.toggle.css' rel='stylesheet'>
  <link href='template/css/opa-icons.css' rel='stylesheet'>
  <link href='template/css/uploadify.css' rel='stylesheet'>

  <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src='http://html5shim.googlecode.com/svn/trunk/html5.js'></script>
  <![endif]-->

  <!-- The fav icon -->
  <link rel='shortcut icon' href='template/img/favicon.ico'>
    
</head>

<body>
    <div class='container-fluid'>
    <div class='row-fluid'>
    
      <div class='row-fluid'>
        <div class='span12 center login-header'>
          <h2>Welcome to Systemathic</h2>
        </div><!--/span-->
      </div><!--/row-->
      
      <div class='row-fluid'>
        <div class='well span5 center login-box'>
          <div class='alert alert-info'>
            Please login with your Username and Password.
          </div>
          <form action='/Final/php/index.php?' method='POST' id='form1' name='form1'>
            <fieldset>
              <input type='hidden' name='frmLogin' value='true'>

              <div class='input-prepend' title='Username' data-rel='tooltip'>
                <span class='add-on'><i class='icon-user'></i></span><input autofocus class='input-large span10' name='frmUserID' id='username' type='text' value='admin' />
              </div>
              <div class='clearfix'></div>

              <div class='input-prepend' title='Password' data-rel='tooltip'>
                <span class='add-on'><i class='icon-lock'></i></span><input class='input-large span10' name='frmUserPass' id='password' type='password' value='admin123456' />
              </div>
              <div class='clearfix'></div>

              
              <div class='clearfix'></div>

              <p class='center span5'>
              <button type='submit' class='btn btn-primary' name='submit' value='submit'>Login</button>
              </p>
            </fieldset>
          </form>
        </div><!--/span-->
      </div><!--/row-->
        </div><!--/fluid-row-->
    
  </div><!--/.fluid-container-->






  <!-- external javascript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->

  <!-- jQuery -->
  <script src='template/js/jquery-1.7.2.min.js'></script>
  <!-- jQuery UI -->
  <script src='template/js/jquery-ui-1.8.21.custom.min.js'></script>
  <!-- transition / effect library -->
  <script src='template/js/bootstrap-transition.js'></script>
  <!-- alert enhancer library -->
  <script src='template/js/bootstrap-alert.js'></script>
  <!-- modal / dialog library -->
  <script src='template/js/bootstrap-modal.js'></script>
  <!-- custom dropdown library -->
  <script src='template/js/bootstrap-dropdown.js'></script>
  <!-- scrolspy library -->
  <script src='template/js/bootstrap-scrollspy.js'></script>
  <!-- library for creating tabs -->
  <script src='template/js/bootstrap-tab.js'></script>
  <!-- library for advanced tooltip -->
  <script src='template/js/bootstrap-tooltip.js'></script>
  <!-- popover effect library -->
  <script src='template/js/bootstrap-popover.js'></script>
  <!-- button enhancer library -->
  <script src='template/js/bootstrap-button.js'></script>
  <!-- accordion library (optional, not used in demo) -->
  <script src='template/js/bootstrap-collapse.js'></script>
  <!-- carousel slideshow library (optional, not used in demo) -->
  <script src='template/js/bootstrap-carousel.js'></script>
  <!-- autocomplete library -->
  <script src='template/js/bootstrap-typeahead.js'></script>
  <!-- tour library -->
  <script src='template/js/bootstrap-tour.js'></script>
  <!-- library for cookie management -->
  <script src='template/js/jquery.cookie.js'></script>
  <!-- calander plugin -->
  <script src='template/js/fullcalendar.min.js'></script>
  <!-- data table plugin -->
  <script src='template/js/jquery.dataTables.min.js'></script>

  <!-- chart libraries start -->
  <script src='template/js/excanvas.js'></script>
  <script src='template/js/jquery.flot.min.js'></script>
  <script src='template/js/jquery.flot.pie.min.js'></script>
  <script src='template/js/jquery.flot.stack.js'></script>
  <script src='template/js/jquery.flot.resize.min.js'></script>
  <!-- chart libraries end -->

  <!-- select or dropdown enhancer -->
  <script src='template/js/jquery.chosen.min.js'></script>
  <!-- checkbox, radio, and file input styler -->
  <script src='template/js/jquery.uniform.min.js'></script>
  <!-- plugin for gallery image view -->
  <script src='template/js/jquery.colorbox.min.js'></script>
  <!-- rich text editor library -->
  <script src='template/js/jquery.cleditor.min.js'></script>
  <!-- notification plugin -->
  <script src='template/js/jquery.noty.js'></script>
  <!-- file manager library -->
  <script src='template/js/jquery.elfinder.min.js'></script>
  <!-- star rating plugin -->
  <script src='template/js/jquery.raty.min.js'></script>
  <!-- for iOS style toggle switch -->
  <script src='template/js/jquery.iphone.toggle.js'></script>
  <!-- autogrowing textarea plugin -->
  <script src='template/js/jquery.autogrow-textarea.js'></script>
  <!-- multiple file upload plugin -->
  <script src='template/js/jquery.uploadify-3.1.min.js'></script>
  <!-- history.js for cross-browser state change on ajax -->
  <script src='template/js/jquery.history.js'></script>
  <!-- application script for Charisma demo -->
  <script src='template/js/charisma.js'></script>
  
    
</body>
</html>



";
     
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
