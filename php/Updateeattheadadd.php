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
session_set_cookie_params(500);
session_start();
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
include_once('utils.php');
include('login.php');
$HTML_Template = getRequest("HTMLT");
/*
============================================================================='
 MergeTemplate 
============================================================================='
*/
function MergeAddTemplate($Template) {
    global $UpdateeattheadFormAction;

    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $userdata1;   

    if(!isset($Template) || ($Template =="")):
        $Template =  "./html/Updateeattheadadd.htm";
    endif;

    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

    $TemplateText= Replace($TemplateText,"@UpdateeattheadFormAction@",$UpdateeattheadFormAction);    
    $TemplateText = Replace($TemplateText,"<!--@HTML_AFTER_OPEN@-->",loadInclude(""));          
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

    global $eattheadCountryID;
    $TemplateText = Replace($TemplateText,"@eattheadCountryID@",$eattheadCountryID);            
    global $eattheadBranchID;
    $TemplateText = Replace($TemplateText,"@eattheadBranchID@",$eattheadBranchID);            
    global $eattheadAdmitDate;
    $TemplateText = Replace($TemplateText,"@eattheadAdmitDate@",$eattheadAdmitDate);            
    global $eattheadCustNo;
    $TemplateText = Replace($TemplateText,"@eattheadCustNo@",$eattheadCustNo);            
    global $eattheadLevelID;
    $TemplateText = Replace($TemplateText,"@eattheadLevelID@",$eattheadLevelID);            
    global $eattheadTierID;
    $TemplateText = Replace($TemplateText,"@eattheadTierID@",$eattheadTierID);            
    global $eattheadModCount;
    $TemplateText = Replace($TemplateText,"@eattheadModCount@",$eattheadModCount);            
    global $eattheadStartDate;
    $TemplateText = Replace($TemplateText,"@eattheadStartDate@",$eattheadStartDate);            
    global $eattheadEndDate;
    $TemplateText = Replace($TemplateText,"@eattheadEndDate@",$eattheadEndDate);            
    global $eattheadStatus;
    if($eattheadStatus == "Temporary"):
        $SELECTEDF5_20_1 = "SELECTED";
    else:
        $SELECTEDF5_20_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_1@", $SELECTEDF5_20_1);
    if($eattheadStatus == "Wait_List"):
        $SELECTEDF5_20_2 = "SELECTED";
    else:
        $SELECTEDF5_20_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_2@", $SELECTEDF5_20_2);
    if($eattheadStatus == "Final"):
        $SELECTEDF5_20_3 = "SELECTED";
    else:
        $SELECTEDF5_20_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_20_3@", $SELECTEDF5_20_3);
    global $eattheadClassStatus;
    if($eattheadClassStatus == "Closed"):
        $SELECTEDF5_21_1 = "SELECTED";
    else:
        $SELECTEDF5_21_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_21_1@", $SELECTEDF5_21_1);
    if($eattheadClassStatus == "Open"):
        $SELECTEDF5_21_2 = "SELECTED";
    else:
        $SELECTEDF5_21_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_21_2@", $SELECTEDF5_21_2);
    global $eattheadDay1;
    if($eattheadDay1 == "Monday"):
        $SELECTEDF5_22_1 = "SELECTED";
    else:
        $SELECTEDF5_22_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_1@", $SELECTEDF5_22_1);
    if($eattheadDay1 == "Tuesday"):
        $SELECTEDF5_22_2 = "SELECTED";
    else:
        $SELECTEDF5_22_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_2@", $SELECTEDF5_22_2);
    if($eattheadDay1 == "Wednesday"):
        $SELECTEDF5_22_3 = "SELECTED";
    else:
        $SELECTEDF5_22_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_3@", $SELECTEDF5_22_3);
    if($eattheadDay1 == "Thursday"):
        $SELECTEDF5_22_4 = "SELECTED";
    else:
        $SELECTEDF5_22_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_4@", $SELECTEDF5_22_4);
    if($eattheadDay1 == "Friday"):
        $SELECTEDF5_22_5 = "SELECTED";
    else:
        $SELECTEDF5_22_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_5@", $SELECTEDF5_22_5);
    if($eattheadDay1 == "Saturday"):
        $SELECTEDF5_22_6 = "SELECTED";
    else:
        $SELECTEDF5_22_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_6@", $SELECTEDF5_22_6);
    if($eattheadDay1 == "Sunday"):
        $SELECTEDF5_22_7 = "SELECTED";
    else:
        $SELECTEDF5_22_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_22_7@", $SELECTEDF5_22_7);
    global $eattheadDay2;
    if($eattheadDay2 == "Monday"):
        $SELECTEDF5_23_1 = "SELECTED";
    else:
        $SELECTEDF5_23_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_1@", $SELECTEDF5_23_1);
    if($eattheadDay2 == "Tuesday"):
        $SELECTEDF5_23_2 = "SELECTED";
    else:
        $SELECTEDF5_23_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_2@", $SELECTEDF5_23_2);
    if($eattheadDay2 == "Wednesday"):
        $SELECTEDF5_23_3 = "SELECTED";
    else:
        $SELECTEDF5_23_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_3@", $SELECTEDF5_23_3);
    if($eattheadDay2 == "Thursday"):
        $SELECTEDF5_23_4 = "SELECTED";
    else:
        $SELECTEDF5_23_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_4@", $SELECTEDF5_23_4);
    if($eattheadDay2 == "Friday"):
        $SELECTEDF5_23_5 = "SELECTED";
    else:
        $SELECTEDF5_23_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_5@", $SELECTEDF5_23_5);
    if($eattheadDay2 == "Saturday"):
        $SELECTEDF5_23_6 = "SELECTED";
    else:
        $SELECTEDF5_23_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_6@", $SELECTEDF5_23_6);
    if($eattheadDay2 == "Sunday"):
        $SELECTEDF5_23_7 = "SELECTED";
    else:
        $SELECTEDF5_23_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_23_7@", $SELECTEDF5_23_7);
    global $eattheadDay3;
    if($eattheadDay3 == "Monday"):
        $SELECTEDF5_24_1 = "SELECTED";
    else:
        $SELECTEDF5_24_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_1@", $SELECTEDF5_24_1);
    if($eattheadDay3 == "Tuesday"):
        $SELECTEDF5_24_2 = "SELECTED";
    else:
        $SELECTEDF5_24_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_2@", $SELECTEDF5_24_2);
    if($eattheadDay3 == "Wednesday"):
        $SELECTEDF5_24_3 = "SELECTED";
    else:
        $SELECTEDF5_24_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_3@", $SELECTEDF5_24_3);
    if($eattheadDay3 == "Thursday"):
        $SELECTEDF5_24_4 = "SELECTED";
    else:
        $SELECTEDF5_24_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_4@", $SELECTEDF5_24_4);
    if($eattheadDay3 == "Friday"):
        $SELECTEDF5_24_5 = "SELECTED";
    else:
        $SELECTEDF5_24_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_5@", $SELECTEDF5_24_5);
    if($eattheadDay3 == "Saturday"):
        $SELECTEDF5_24_6 = "SELECTED";
    else:
        $SELECTEDF5_24_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_6@", $SELECTEDF5_24_6);
    if($eattheadDay3 == "Sunday"):
        $SELECTEDF5_24_7 = "SELECTED";
    else:
        $SELECTEDF5_24_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_24_7@", $SELECTEDF5_24_7);
    global $eattheadDay4;
    if($eattheadDay4 == "Monday"):
        $SELECTEDF5_25_1 = "SELECTED";
    else:
        $SELECTEDF5_25_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_1@", $SELECTEDF5_25_1);
    if($eattheadDay4 == "Tuesday"):
        $SELECTEDF5_25_2 = "SELECTED";
    else:
        $SELECTEDF5_25_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_2@", $SELECTEDF5_25_2);
    if($eattheadDay4 == "Wednesday"):
        $SELECTEDF5_25_3 = "SELECTED";
    else:
        $SELECTEDF5_25_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_3@", $SELECTEDF5_25_3);
    if($eattheadDay4 == "Thursday"):
        $SELECTEDF5_25_4 = "SELECTED";
    else:
        $SELECTEDF5_25_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_4@", $SELECTEDF5_25_4);
    if($eattheadDay4 == "Friday"):
        $SELECTEDF5_25_5 = "SELECTED";
    else:
        $SELECTEDF5_25_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_5@", $SELECTEDF5_25_5);
    if($eattheadDay4 == "Saturday"):
        $SELECTEDF5_25_6 = "SELECTED";
    else:
        $SELECTEDF5_25_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_6@", $SELECTEDF5_25_6);
    if($eattheadDay4 == "Sunday"):
        $SELECTEDF5_25_7 = "SELECTED";
    else:
        $SELECTEDF5_25_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_25_7@", $SELECTEDF5_25_7);
    global $eattheadDay5;
    if($eattheadDay5 == "Monday"):
        $SELECTEDF5_26_1 = "SELECTED";
    else:
        $SELECTEDF5_26_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_1@", $SELECTEDF5_26_1);
    if($eattheadDay5 == "Tuesday"):
        $SELECTEDF5_26_2 = "SELECTED";
    else:
        $SELECTEDF5_26_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_2@", $SELECTEDF5_26_2);
    if($eattheadDay5 == "Wednesday"):
        $SELECTEDF5_26_3 = "SELECTED";
    else:
        $SELECTEDF5_26_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_3@", $SELECTEDF5_26_3);
    if($eattheadDay5 == "Thursday"):
        $SELECTEDF5_26_4 = "SELECTED";
    else:
        $SELECTEDF5_26_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_4@", $SELECTEDF5_26_4);
    if($eattheadDay5 == "Friday"):
        $SELECTEDF5_26_5 = "SELECTED";
    else:
        $SELECTEDF5_26_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_5@", $SELECTEDF5_26_5);
    if($eattheadDay5 == "Saturday"):
        $SELECTEDF5_26_6 = "SELECTED";
    else:
        $SELECTEDF5_26_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_6@", $SELECTEDF5_26_6);
    if($eattheadDay5 == "Sunday"):
        $SELECTEDF5_26_7 = "SELECTED";
    else:
        $SELECTEDF5_26_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_26_7@", $SELECTEDF5_26_7);
    global $eattheadDay6;
    if($eattheadDay6 == "Monday"):
        $SELECTEDF5_27_1 = "SELECTED";
    else:
        $SELECTEDF5_27_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_1@", $SELECTEDF5_27_1);
    if($eattheadDay6 == "Tuesday"):
        $SELECTEDF5_27_2 = "SELECTED";
    else:
        $SELECTEDF5_27_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_2@", $SELECTEDF5_27_2);
    if($eattheadDay6 == "Wednesday"):
        $SELECTEDF5_27_3 = "SELECTED";
    else:
        $SELECTEDF5_27_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_3@", $SELECTEDF5_27_3);
    if($eattheadDay6 == "Thursday"):
        $SELECTEDF5_27_4 = "SELECTED";
    else:
        $SELECTEDF5_27_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_4@", $SELECTEDF5_27_4);
    if($eattheadDay6 == "Friday"):
        $SELECTEDF5_27_5 = "SELECTED";
    else:
        $SELECTEDF5_27_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_5@", $SELECTEDF5_27_5);
    if($eattheadDay6 == "Saturday"):
        $SELECTEDF5_27_6 = "SELECTED";
    else:
        $SELECTEDF5_27_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_6@", $SELECTEDF5_27_6);
    if($eattheadDay6 == "Sunday"):
        $SELECTEDF5_27_7 = "SELECTED";
    else:
        $SELECTEDF5_27_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_27_7@", $SELECTEDF5_27_7);
    global $eattheadDay7;
    if($eattheadDay7 == "Monday"):
        $SELECTEDF5_28_1 = "SELECTED";
    else:
        $SELECTEDF5_28_1 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_1@", $SELECTEDF5_28_1);
    if($eattheadDay7 == "Tuesday"):
        $SELECTEDF5_28_2 = "SELECTED";
    else:
        $SELECTEDF5_28_2 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_2@", $SELECTEDF5_28_2);
    if($eattheadDay7 == "Wednesday"):
        $SELECTEDF5_28_3 = "SELECTED";
    else:
        $SELECTEDF5_28_3 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_3@", $SELECTEDF5_28_3);
    if($eattheadDay7 == "Thursday"):
        $SELECTEDF5_28_4 = "SELECTED";
    else:
        $SELECTEDF5_28_4 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_4@", $SELECTEDF5_28_4);
    if($eattheadDay7 == "Friday"):
        $SELECTEDF5_28_5 = "SELECTED";
    else:
        $SELECTEDF5_28_5 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_5@", $SELECTEDF5_28_5);
    if($eattheadDay7 == "Saturday"):
        $SELECTEDF5_28_6 = "SELECTED";
    else:
        $SELECTEDF5_28_6 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_6@", $SELECTEDF5_28_6);
    if($eattheadDay7 == "Sunday"):
        $SELECTEDF5_28_7 = "SELECTED";
    else:
        $SELECTEDF5_28_7 = "";
    endif;
    $TemplateText = Replace($TemplateText, "@SELECTEDF5_28_7@", $SELECTEDF5_28_7);
    global $eattheadHrFr1;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr1@",$eattheadHrFr1);            
    global $eattheadHrFr2;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr2@",$eattheadHrFr2);            
    global $eattheadHrFr3;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr3@",$eattheadHrFr3);            
    global $eattheadHrFr4;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr4@",$eattheadHrFr4);            
    global $eattheadHrFr5;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr5@",$eattheadHrFr5);            
    global $eattheadHrFr6;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr6@",$eattheadHrFr6);            
    global $eattheadHrFr7;
    $TemplateText = Replace($TemplateText,"@eattheadHrFr7@",$eattheadHrFr7);            
    global $eattheadHrTo1;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo1@",$eattheadHrTo1);            
    global $eattheadHrTo2;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo2@",$eattheadHrTo2);            
    global $eattheadHrTo3;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo3@",$eattheadHrTo3);            
    global $eattheadHrTo4;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo4@",$eattheadHrTo4);            
    global $eattheadHrTo5;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo5@",$eattheadHrTo5);            
    global $eattheadHrTo6;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo6@",$eattheadHrTo6);            
    global $eattheadHrTo7;
    $TemplateText = Replace($TemplateText,"@eattheadHrTo7@",$eattheadHrTo7);            
    global $eattheadRm1;
    $TemplateText = Replace($TemplateText,"@eattheadRm1@",$eattheadRm1);            
    global $eattheadRm2;
    $TemplateText = Replace($TemplateText,"@eattheadRm2@",$eattheadRm2);            
    global $eattheadRm3;
    $TemplateText = Replace($TemplateText,"@eattheadRm3@",$eattheadRm3);            
    global $eattheadRm4;
    $TemplateText = Replace($TemplateText,"@eattheadRm4@",$eattheadRm4);            
    global $eattheadRm5;
    $TemplateText = Replace($TemplateText,"@eattheadRm5@",$eattheadRm5);            
    global $eattheadRm6;
    $TemplateText = Replace($TemplateText,"@eattheadRm6@",$eattheadRm6);            
    global $eattheadRm7;
    $TemplateText = Replace($TemplateText,"@eattheadRm7@",$eattheadRm7);            
    global $eattheadTeaID1;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID1@",$eattheadTeaID1);            
    global $eattheadTeaID2;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID2@",$eattheadTeaID2);            
    global $eattheadTeaID3;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID3@",$eattheadTeaID3);            
    global $eattheadTeaID4;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID4@",$eattheadTeaID4);            
    global $eattheadTeaID5;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID5@",$eattheadTeaID5);            
    global $eattheadTeaID6;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID6@",$eattheadTeaID6);            
    global $eattheadTeaID7;
    $TemplateText = Replace($TemplateText,"@eattheadTeaID7@",$eattheadTeaID7);            
    global $eattheadDayNo1;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo1@",$eattheadDayNo1);            
    global $eattheadDayNo2;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo2@",$eattheadDayNo2);            
    global $eattheadDayNo3;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo3@",$eattheadDayNo3);            
    global $eattheadDayNo4;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo4@",$eattheadDayNo4);            
    global $eattheadDayNo5;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo5@",$eattheadDayNo5);            
    global $eattheadDayNo6;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo6@",$eattheadDayNo6);            
    global $eattheadDayNo7;
    $TemplateText = Replace($TemplateText,"@eattheadDayNo7@",$eattheadDayNo7);            
    global $eattheadSessionPrDay1;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay1@",$eattheadSessionPrDay1);            
    global $eattheadSessionPrDay2;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay2@",$eattheadSessionPrDay2);            
    global $eattheadSessionPrDay3;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay3@",$eattheadSessionPrDay3);            
    global $eattheadSessionPrDay4;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay4@",$eattheadSessionPrDay4);            
    global $eattheadSessionPrDay5;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay5@",$eattheadSessionPrDay5);            
    global $eattheadSessionPrDay6;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay6@",$eattheadSessionPrDay6);            
    global $eattheadSessionPrDay7;
    $TemplateText = Replace($TemplateText,"@eattheadSessionPrDay7@",$eattheadSessionPrDay7);            
    $TemplateText = Replace($TemplateText, "@Header@", $Header);
    $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
    $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
    $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    $TemplateText = Replace($TemplateText, "@userdata1@", $userdata1);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);

$UpdateeattheadFormAction = "Updateeattheadaddx.php";
$eattheadCountryID  = getRequest("txteattheadCountryID");
$eattheadBranchID  = getRequest("txteattheadBranchID");
$eattheadAdmitDate  = getRequest("txteattheadAdmitDate");
$eattheadCustNo  = getRequest("txteattheadCustNo");
$eattheadLevelID  = getRequest("txteattheadLevelID");
$eattheadTierID  = getRequest("txteattheadTierID");
$eattheadModCount  = getRequest("txteattheadModCount");
$eattheadStartDate  = getRequest("txteattheadStartDate");
$eattheadEndDate  = getRequest("txteattheadEndDate");
$eattheadHrFr1  = getRequest("txteattheadHrFr1");
$eattheadHrFr2  = getRequest("txteattheadHrFr2");
$eattheadHrFr3  = getRequest("txteattheadHrFr3");
$eattheadHrFr4  = getRequest("txteattheadHrFr4");
$eattheadHrFr5  = getRequest("txteattheadHrFr5");
$eattheadHrFr6  = getRequest("txteattheadHrFr6");
$eattheadHrFr7  = getRequest("txteattheadHrFr7");
$eattheadHrTo1  = getRequest("txteattheadHrTo1");
$eattheadHrTo2  = getRequest("txteattheadHrTo2");
$eattheadHrTo3  = getRequest("txteattheadHrTo3");
$eattheadHrTo4  = getRequest("txteattheadHrTo4");
$eattheadHrTo5  = getRequest("txteattheadHrTo5");
$eattheadHrTo6  = getRequest("txteattheadHrTo6");
$eattheadHrTo7  = getRequest("txteattheadHrTo7");
$eattheadRm1  = getRequest("txteattheadRm1");
$eattheadRm2  = getRequest("txteattheadRm2");
$eattheadRm3  = getRequest("txteattheadRm3");
$eattheadRm4  = getRequest("txteattheadRm4");
$eattheadRm5  = getRequest("txteattheadRm5");
$eattheadRm6  = getRequest("txteattheadRm6");
$eattheadRm7  = getRequest("txteattheadRm7");
$eattheadTeaID1  = getRequest("txteattheadTeaID1");
$eattheadTeaID2  = getRequest("txteattheadTeaID2");
$eattheadTeaID3  = getRequest("txteattheadTeaID3");
$eattheadTeaID4  = getRequest("txteattheadTeaID4");
$eattheadTeaID5  = getRequest("txteattheadTeaID5");
$eattheadTeaID6  = getRequest("txteattheadTeaID6");
$eattheadTeaID7  = getRequest("txteattheadTeaID7");
$eattheadDayNo1  = getRequest("txteattheadDayNo1");
$eattheadDayNo2  = getRequest("txteattheadDayNo2");
$eattheadDayNo3  = getRequest("txteattheadDayNo3");
$eattheadDayNo4  = getRequest("txteattheadDayNo4");
$eattheadDayNo5  = getRequest("txteattheadDayNo5");
$eattheadDayNo6  = getRequest("txteattheadDayNo6");
$eattheadDayNo7  = getRequest("txteattheadDayNo7");
$eattheadSessionPrDay1  = getRequest("txteattheadSessionPrDay1");
$eattheadSessionPrDay2  = getRequest("txteattheadSessionPrDay2");
$eattheadSessionPrDay3  = getRequest("txteattheadSessionPrDay3");
$eattheadSessionPrDay4  = getRequest("txteattheadSessionPrDay4");
$eattheadSessionPrDay5  = getRequest("txteattheadSessionPrDay5");
$eattheadSessionPrDay6  = getRequest("txteattheadSessionPrDay6");
$eattheadSessionPrDay7  = getRequest("txteattheadSessionPrDay7");

if ($_SESSION["Updateeatthead_InsertFailed"] == 1) {
   $eattheadCountryID = $_SESSION["SavedeattheadCountryID"];
   $eattheadBranchID = $_SESSION["SavedeattheadBranchID"];
   $eattheadAdmitDate = $_SESSION["SavedeattheadAdmitDate"];
   $eattheadCustNo = $_SESSION["SavedeattheadCustNo"];
   $eattheadLevelID = $_SESSION["SavedeattheadLevelID"];
   $eattheadTierID = $_SESSION["SavedeattheadTierID"];
   $eattheadModCount = $_SESSION["SavedeattheadModCount"];
   $eattheadStartDate = $_SESSION["SavedeattheadStartDate"];
   $eattheadEndDate = $_SESSION["SavedeattheadEndDate"];
   $eattheadStatus = $_SESSION["SavedeattheadStatus"];
   $eattheadClassStatus = $_SESSION["SavedeattheadClassStatus"];
   $eattheadDay1 = $_SESSION["SavedeattheadDay1"];
   $eattheadDay2 = $_SESSION["SavedeattheadDay2"];
   $eattheadDay3 = $_SESSION["SavedeattheadDay3"];
   $eattheadDay4 = $_SESSION["SavedeattheadDay4"];
   $eattheadDay5 = $_SESSION["SavedeattheadDay5"];
   $eattheadDay6 = $_SESSION["SavedeattheadDay6"];
   $eattheadDay7 = $_SESSION["SavedeattheadDay7"];
   $eattheadHrFr1 = $_SESSION["SavedeattheadHrFr1"];
   $eattheadHrFr2 = $_SESSION["SavedeattheadHrFr2"];
   $eattheadHrFr3 = $_SESSION["SavedeattheadHrFr3"];
   $eattheadHrFr4 = $_SESSION["SavedeattheadHrFr4"];
   $eattheadHrFr5 = $_SESSION["SavedeattheadHrFr5"];
   $eattheadHrFr6 = $_SESSION["SavedeattheadHrFr6"];
   $eattheadHrFr7 = $_SESSION["SavedeattheadHrFr7"];
   $eattheadHrTo1 = $_SESSION["SavedeattheadHrTo1"];
   $eattheadHrTo2 = $_SESSION["SavedeattheadHrTo2"];
   $eattheadHrTo3 = $_SESSION["SavedeattheadHrTo3"];
   $eattheadHrTo4 = $_SESSION["SavedeattheadHrTo4"];
   $eattheadHrTo5 = $_SESSION["SavedeattheadHrTo5"];
   $eattheadHrTo6 = $_SESSION["SavedeattheadHrTo6"];
   $eattheadHrTo7 = $_SESSION["SavedeattheadHrTo7"];
   $eattheadRm1 = $_SESSION["SavedeattheadRm1"];
   $eattheadRm2 = $_SESSION["SavedeattheadRm2"];
   $eattheadRm3 = $_SESSION["SavedeattheadRm3"];
   $eattheadRm4 = $_SESSION["SavedeattheadRm4"];
   $eattheadRm5 = $_SESSION["SavedeattheadRm5"];
   $eattheadRm6 = $_SESSION["SavedeattheadRm6"];
   $eattheadRm7 = $_SESSION["SavedeattheadRm7"];
   $eattheadTeaID1 = $_SESSION["SavedeattheadTeaID1"];
   $eattheadTeaID2 = $_SESSION["SavedeattheadTeaID2"];
   $eattheadTeaID3 = $_SESSION["SavedeattheadTeaID3"];
   $eattheadTeaID4 = $_SESSION["SavedeattheadTeaID4"];
   $eattheadTeaID5 = $_SESSION["SavedeattheadTeaID5"];
   $eattheadTeaID6 = $_SESSION["SavedeattheadTeaID6"];
   $eattheadTeaID7 = $_SESSION["SavedeattheadTeaID7"];
   $eattheadDayNo1 = ($_SESSION["SavedeattheadDayNo1"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo2 = ($_SESSION["SavedeattheadDayNo2"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo3 = ($_SESSION["SavedeattheadDayNo3"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo4 = ($_SESSION["SavedeattheadDayNo4"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo5 = ($_SESSION["SavedeattheadDayNo5"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo6 = ($_SESSION["SavedeattheadDayNo6"] == "ON") ? "CHECKED" : "";
   $eattheadDayNo7 = ($_SESSION["SavedeattheadDayNo7"] == "ON") ? "CHECKED" : "";
   $eattheadSessionPrDay1 = $_SESSION["SavedeattheadSessionPrDay1"];
   $eattheadSessionPrDay2 = $_SESSION["SavedeattheadSessionPrDay2"];
   $eattheadSessionPrDay3 = $_SESSION["SavedeattheadSessionPrDay3"];
   $eattheadSessionPrDay4 = $_SESSION["SavedeattheadSessionPrDay4"];
   $eattheadSessionPrDay5 = $_SESSION["SavedeattheadSessionPrDay5"];
   $eattheadSessionPrDay6 = $_SESSION["SavedeattheadSessionPrDay6"];
   $eattheadSessionPrDay7 = $_SESSION["SavedeattheadSessionPrDay7"];
}

MergeAddTemplate($HTML_Template);
unset($oRSeatthead);
$objConn1->Close();
unset($objConn1);
?>
