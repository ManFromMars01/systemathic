<?PHP
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
session_start();
include_once('systemathicappdata.php');
include_once('utils.php');

// all global user defined data variables are declared here
echo "Hello world";
exit;


// note that in order for redirection to work no "header" information must be sent back to the client
if (getRequest("toURL") > ""):
    header("Location: http://".$_SERVER['HTTP_HOST']
                          .dirname($_SERVER['PHP_SELF'])
                          ."/". getRequest("toURL"));
endif;
?>
