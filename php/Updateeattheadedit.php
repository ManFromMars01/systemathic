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
$HTML_Template = getRequest("HTMLT");
$DeleteButton = "";
$UpdateeattheadFormAction = "";
//============================================================================='
// MergeTemplate 
//============================================================================='
function MergeTemplate($Template) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeatthead" . "edit.htm";
    endif;
    global $DeleteButton;   
    global $Header;   
    global $Footer;   
    global $MainContent;   
    global $Menu;   
    global $ID1;
    global $ID2;
    global $ID3;
    global $ID4;
    global $UpdateeattheadFormAction;
    global $eattheadCountryID;
    global $eattheadBranchID;
    global $eattheadAdmitDate;
    global $eattheadCustNo;
    global $eattheadLevelID;
    global $eattheadTierID;
    global $eattheadModCount;
    global $eattheadStartDate;
    global $eattheadEndDate;
    global $eattheadStatus;
    global $eattheadClassStatus;
    global $eattheadDay1;
    global $eattheadDay2;
    global $eattheadDay3;
    global $eattheadDay4;
    global $eattheadDay5;
    global $eattheadDay6;
    global $eattheadDay7;
    global $eattheadHrFr1;
    global $eattheadHrFr2;
    global $eattheadHrFr3;
    global $eattheadHrFr4;
    global $eattheadHrFr5;
    global $eattheadHrFr6;
    global $eattheadHrFr7;
    global $eattheadHrTo1;
    global $eattheadHrTo2;
    global $eattheadHrTo3;
    global $eattheadHrTo4;
    global $eattheadHrTo5;
    global $eattheadHrTo6;
    global $eattheadHrTo7;
    global $eattheadRm1;
    global $eattheadRm2;
    global $eattheadRm3;
    global $eattheadRm4;
    global $eattheadRm5;
    global $eattheadRm6;
    global $eattheadRm7;
    global $eattheadTeaID1;
    global $eattheadTeaID2;
    global $eattheadTeaID3;
    global $eattheadTeaID4;
    global $eattheadTeaID5;
    global $eattheadTeaID6;
    global $eattheadTeaID7;
    global $eattheadDayNo1;
    global $eattheadDayNo2;
    global $eattheadDayNo3;
    global $eattheadDayNo4;
    global $eattheadDayNo5;
    global $eattheadDayNo6;
    global $eattheadDayNo7;
    global $eattheadSessionPrDay1;
    global $eattheadSessionPrDay2;
    global $eattheadSessionPrDay3;
    global $eattheadSessionPrDay4;
    global $eattheadSessionPrDay5;
    global $eattheadSessionPrDay6;
    global $eattheadSessionPrDay7;
    global $EditOptions;    
    global $dbNavBar;    
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);

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
    
    $TemplateText = Replace($TemplateText,"@DeleteButton@",$DeleteButton);
    $TemplateText = Replace($TemplateText,"@UpdateeattheadFormAction@",$UpdateeattheadFormAction);    

     $TemplateText = Replace($TemplateText, "@eattheadCountryID@", $eattheadCountryID);
     $TemplateText = Replace($TemplateText, "@eattheadBranchID@", $eattheadBranchID);
     $TemplateText = Replace($TemplateText, "@eattheadAdmitDate@", $eattheadAdmitDate);
     $TemplateText = Replace($TemplateText, "@eattheadCustNo@", $eattheadCustNo);
     $TemplateText = Replace($TemplateText, "@eattheadLevelID@", $eattheadLevelID);
     $TemplateText = Replace($TemplateText, "@eattheadTierID@", $eattheadTierID);
     $TemplateText = Replace($TemplateText, "@eattheadModCount@", $eattheadModCount);
     $TemplateText = Replace($TemplateText, "@eattheadStartDate@", $eattheadStartDate);
     $TemplateText = Replace($TemplateText, "@eattheadEndDate@", $eattheadEndDate);
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
     $TemplateText = Replace($TemplateText, "@eattheadHrFr1@", $eattheadHrFr1);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr2@", $eattheadHrFr2);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr3@", $eattheadHrFr3);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr4@", $eattheadHrFr4);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr5@", $eattheadHrFr5);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr6@", $eattheadHrFr6);
     $TemplateText = Replace($TemplateText, "@eattheadHrFr7@", $eattheadHrFr7);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo1@", $eattheadHrTo1);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo2@", $eattheadHrTo2);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo3@", $eattheadHrTo3);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo4@", $eattheadHrTo4);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo5@", $eattheadHrTo5);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo6@", $eattheadHrTo6);
     $TemplateText = Replace($TemplateText, "@eattheadHrTo7@", $eattheadHrTo7);
     $TemplateText = Replace($TemplateText, "@eattheadRm1@", $eattheadRm1);
     $TemplateText = Replace($TemplateText, "@eattheadRm2@", $eattheadRm2);
     $TemplateText = Replace($TemplateText, "@eattheadRm3@", $eattheadRm3);
     $TemplateText = Replace($TemplateText, "@eattheadRm4@", $eattheadRm4);
     $TemplateText = Replace($TemplateText, "@eattheadRm5@", $eattheadRm5);
     $TemplateText = Replace($TemplateText, "@eattheadRm6@", $eattheadRm6);
     $TemplateText = Replace($TemplateText, "@eattheadRm7@", $eattheadRm7);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID1@", $eattheadTeaID1);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID2@", $eattheadTeaID2);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID3@", $eattheadTeaID3);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID4@", $eattheadTeaID4);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID5@", $eattheadTeaID5);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID6@", $eattheadTeaID6);
     $TemplateText = Replace($TemplateText, "@eattheadTeaID7@", $eattheadTeaID7);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo1@", $eattheadDayNo1);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo2@", $eattheadDayNo2);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo3@", $eattheadDayNo3);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo4@", $eattheadDayNo4);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo5@", $eattheadDayNo5);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo6@", $eattheadDayNo6);
     $TemplateText = Replace($TemplateText, "@eattheadDayNo7@", $eattheadDayNo7);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay1@", $eattheadSessionPrDay1);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay2@", $eattheadSessionPrDay2);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay3@", $eattheadSessionPrDay3);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay4@", $eattheadSessionPrDay4);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay5@", $eattheadSessionPrDay5);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay6@", $eattheadSessionPrDay6);
     $TemplateText = Replace($TemplateText, "@eattheadSessionPrDay7@", $eattheadSessionPrDay7);
     $TemplateText = Replace($TemplateText, "@ID1@", trim($ID1,"'"));
     $TemplateText = Replace($TemplateText, "@ID2@", trim($ID2,"'"));
     $TemplateText = Replace($TemplateText, "@ID3@", trim($ID3,"'"));
     $TemplateText = Replace($TemplateText, "@ID4@", trim($ID4,"'"));
     $TemplateText = Replace($TemplateText, "@Header@", $Header);
     $TemplateText = Replace($TemplateText, "@Footer@", $Footer);
     $TemplateText = Replace($TemplateText, "@MainContent@", $MainContent);
     $TemplateText = Replace($TemplateText, "@Menu@", $Menu);
    print($TemplateText);
} // END Function
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$oRSeatthead = "";
$ClarionData = "";
if (getRequest("ID1") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID2") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID3") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
if (getRequest("ID4") == ""):
    displayBadRecord();
endif;
$ID1 = trim(htmlDecode(getRequest("ID1")),"'");
$ID2 = trim(htmlDecode(getRequest("ID2")),"'");
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");
$ID4 = trim(htmlDecode(getRequest("ID4")),"'");
function displayBadRecord() {
    $ClarionData = "";
    $ClarionData .= "<div class='bg'>\n";
    $ClarionData .= "<table class='Data' border=0 cellspacing=0 cellpadding=0>\n";
    $ClarionData .= "<tr><td width='80%' class='Header'>Status</td>\n"; 
    $ClarionData .= "<td align='right' class='Header'>&nbsp;<a href='JAVASCRIPT:history.back();'><img alt='Back' src='/images/back.gif' border=0></a></td>\n";
    $ClarionData .= "</tr>\n";
    $ClarionData .= "<tr><td class='Input' colspan='2'>The requested record could not be found<br>\n";
    $ClarionData .= "<a href=BrowseAssessment" . "list.php>Return to list</a>\n";
    $ClarionData .= "</td></tr>\n";
    $ClarionData .= "</table>\n";
    $ClarionData .= "</div>\n";
    MergeEditTemplate("./html/blank.htm",$ClarionData);
    exit();
}

function MergeEditTemplate($Template,$ClarionData) {
    if(!isset($Template) || ($Template =="")):
        $Template = "./html/Updateeatthead" . "edit.htm";
    endif;
    $FileObject = fopen($Template, "r");
    $TemplateText = "";
    $TemplateText = fread($FileObject, filesize($Template));
    fclose ($FileObject);
    if (strpos($TemplateText,"@Clarion/PHP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/PHP@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@Clarion/WEB@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/WEB@",$ClarionData);    
        print($TemplateText);
        exit();
    elseif (strpos($TemplateText,"@ClarionData@") != false):
        $TemplateText = Replace($TemplateText,"@ClarionData@",$ClarionData);   
        print($TemplateText);
        exit();        
    elseif (strpos($TemplateText,"@Clarion/ASP@") != false):
        $TemplateText = Replace($TemplateText,"@Clarion/ASP@",$ClarionData);    
        print($TemplateText);
        exit();
    endif;  
}

$sql = "SELECT eatthead.CountryID, eatthead.BranchID, eatthead.AdmitDate, eatthead.CustNo, eatthead.LevelID, eatthead.TierID, eatthead.ModCount, eatthead.StartDate, eatthead.EndDate, eatthead.Status, eatthead.ClassStatus, eatthead.Day1, eatthead.Day2, eatthead.Day3, eatthead.Day4, eatthead.Day5, eatthead.Day6, eatthead.Day7, eatthead.HrFr1, eatthead.HrFr2, eatthead.HrFr3, eatthead.HrFr4, eatthead.HrFr5, eatthead.HrFr6, eatthead.HrFr7, eatthead.HrTo1, eatthead.HrTo2, eatthead.HrTo3, eatthead.HrTo4, eatthead.HrTo5, eatthead.HrTo6, eatthead.HrTo7, eatthead.Rm1, eatthead.Rm2, eatthead.Rm3, eatthead.Rm4, eatthead.Rm5, eatthead.Rm6, eatthead.Rm7, eatthead.TeaID1, eatthead.TeaID2, eatthead.TeaID3, eatthead.TeaID4, eatthead.TeaID5, eatthead.TeaID6, eatthead.TeaID7, eatthead.DayNo1, eatthead.DayNo2, eatthead.DayNo3, eatthead.DayNo4, eatthead.DayNo5, eatthead.DayNo6, eatthead.DayNo7, eatthead.SessionPrDay1, eatthead.SessionPrDay2, eatthead.SessionPrDay3, eatthead.SessionPrDay4, eatthead.SessionPrDay5, eatthead.SessionPrDay6, eatthead.SessionPrDay7  FROM  eatthead WHERE  eatthead.CountryID = '" . $ID1 . "'" . " AND eatthead.BranchID = '" . $ID2 . "'" . " AND eatthead.CustNo = " . $ID3 . " AND eatthead.TierID = " . $ID4;
$oRSeatthead = $objConn1->SelectLimit($sql,1);
if ($oRSeatthead->MoveFirst() == false):
    $oRSeatthead->Close();
    $NoRecords = TRUE;
    displayBadRecord();
endif;
$UpdateeattheadFormAction = "Updateeattheadeditx.php";
$oRSeattheadCountryID = $oRSeatthead->fields["CountryID"];
$oRSeattheadBranchID = $oRSeatthead->fields["BranchID"];
$oRSeattheadCustNo = $oRSeatthead->fields["CustNo"];
$oRSeattheadTierID = $oRSeatthead->fields["TierID"];
$ID1  =  htmlDecode(getRequest("ID1"));
$ID2  =  htmlDecode(getRequest("ID2"));
$ID3  =  htmlDecode(getRequest("ID3"));
$ID4  =  htmlDecode(getRequest("ID4"));

$eattheadCountryID = "";
if (is_null($oRSeatthead->fields["CountryID"])):
$eattheadCountryID = "";
else:
$eattheadCountryID = trim(getValue($oRSeatthead->fields["CountryID"]));
endif;
$eattheadBranchID = "";
if (is_null($oRSeatthead->fields["BranchID"])):
$eattheadBranchID = "";
else:
$eattheadBranchID = trim(getValue($oRSeatthead->fields["BranchID"]));
endif;
$eattheadAdmitDate = "";
if (is_null($oRSeatthead->fields["AdmitDate"])):
$eattheadAdmitDate = "";
else:
$eattheadAdmitDate = getValue($oRSeatthead->fields["AdmitDate"]);
endif;
$eattheadCustNo = "";
if (is_null($oRSeatthead->fields["CustNo"])):
$eattheadCustNo = "";
else:
$eattheadCustNo = getValue($oRSeatthead->fields["CustNo"]);
endif;
$eattheadLevelID = "";
if (is_null($oRSeatthead->fields["LevelID"])):
$eattheadLevelID = "";
else:
$eattheadLevelID = getValue($oRSeatthead->fields["LevelID"]);
endif;
$eattheadTierID = "";
if (is_null($oRSeatthead->fields["TierID"])):
$eattheadTierID = "";
else:
$eattheadTierID = getValue($oRSeatthead->fields["TierID"]);
endif;
$eattheadModCount = "";
if (is_null($oRSeatthead->fields["ModCount"])):
$eattheadModCount = "";
else:
$eattheadModCount = getValue($oRSeatthead->fields["ModCount"]);
endif;
$eattheadStartDate = "";
if (is_null($oRSeatthead->fields["StartDate"])):
$eattheadStartDate = "";
else:
$eattheadStartDate = getValue($oRSeatthead->fields["StartDate"]);
endif;
$eattheadEndDate = "";
if (is_null($oRSeatthead->fields["EndDate"])):
$eattheadEndDate = "";
else:
$eattheadEndDate = getValue($oRSeatthead->fields["EndDate"]);
endif;
$eattheadStatus = "";
if (is_null($oRSeatthead->fields["Status"])):
$eattheadStatus = "";
else:
$eattheadStatus = trim(getValue($oRSeatthead->fields["Status"]));
endif;
$eattheadClassStatus = "";
if (is_null($oRSeatthead->fields["ClassStatus"])):
$eattheadClassStatus = "";
else:
$eattheadClassStatus = trim(getValue($oRSeatthead->fields["ClassStatus"]));
endif;
$eattheadDay1 = "";
if (is_null($oRSeatthead->fields["Day1"])):
$eattheadDay1 = "";
else:
$eattheadDay1 = trim(getValue($oRSeatthead->fields["Day1"]));
endif;
$eattheadDay2 = "";
if (is_null($oRSeatthead->fields["Day2"])):
$eattheadDay2 = "";
else:
$eattheadDay2 = trim(getValue($oRSeatthead->fields["Day2"]));
endif;
$eattheadDay3 = "";
if (is_null($oRSeatthead->fields["Day3"])):
$eattheadDay3 = "";
else:
$eattheadDay3 = trim(getValue($oRSeatthead->fields["Day3"]));
endif;
$eattheadDay4 = "";
if (is_null($oRSeatthead->fields["Day4"])):
$eattheadDay4 = "";
else:
$eattheadDay4 = trim(getValue($oRSeatthead->fields["Day4"]));
endif;
$eattheadDay5 = "";
if (is_null($oRSeatthead->fields["Day5"])):
$eattheadDay5 = "";
else:
$eattheadDay5 = trim(getValue($oRSeatthead->fields["Day5"]));
endif;
$eattheadDay6 = "";
if (is_null($oRSeatthead->fields["Day6"])):
$eattheadDay6 = "";
else:
$eattheadDay6 = trim(getValue($oRSeatthead->fields["Day6"]));
endif;
$eattheadDay7 = "";
if (is_null($oRSeatthead->fields["Day7"])):
$eattheadDay7 = "";
else:
$eattheadDay7 = trim(getValue($oRSeatthead->fields["Day7"]));
endif;
$eattheadHrFr1 = "";
if (is_null($oRSeatthead->fields["HrFr1"])):
$eattheadHrFr1 = "";
else:
$eattheadHrFr1 = getValue($oRSeatthead->fields["HrFr1"]);
endif;
$eattheadHrFr2 = "";
if (is_null($oRSeatthead->fields["HrFr2"])):
$eattheadHrFr2 = "";
else:
$eattheadHrFr2 = getValue($oRSeatthead->fields["HrFr2"]);
endif;
$eattheadHrFr3 = "";
if (is_null($oRSeatthead->fields["HrFr3"])):
$eattheadHrFr3 = "";
else:
$eattheadHrFr3 = getValue($oRSeatthead->fields["HrFr3"]);
endif;
$eattheadHrFr4 = "";
if (is_null($oRSeatthead->fields["HrFr4"])):
$eattheadHrFr4 = "";
else:
$eattheadHrFr4 = getValue($oRSeatthead->fields["HrFr4"]);
endif;
$eattheadHrFr5 = "";
if (is_null($oRSeatthead->fields["HrFr5"])):
$eattheadHrFr5 = "";
else:
$eattheadHrFr5 = getValue($oRSeatthead->fields["HrFr5"]);
endif;
$eattheadHrFr6 = "";
if (is_null($oRSeatthead->fields["HrFr6"])):
$eattheadHrFr6 = "";
else:
$eattheadHrFr6 = getValue($oRSeatthead->fields["HrFr6"]);
endif;
$eattheadHrFr7 = "";
if (is_null($oRSeatthead->fields["HrFr7"])):
$eattheadHrFr7 = "";
else:
$eattheadHrFr7 = getValue($oRSeatthead->fields["HrFr7"]);
endif;
$eattheadHrTo1 = "";
if (is_null($oRSeatthead->fields["HrTo1"])):
$eattheadHrTo1 = "";
else:
$eattheadHrTo1 = getValue($oRSeatthead->fields["HrTo1"]);
endif;
$eattheadHrTo2 = "";
if (is_null($oRSeatthead->fields["HrTo2"])):
$eattheadHrTo2 = "";
else:
$eattheadHrTo2 = getValue($oRSeatthead->fields["HrTo2"]);
endif;
$eattheadHrTo3 = "";
if (is_null($oRSeatthead->fields["HrTo3"])):
$eattheadHrTo3 = "";
else:
$eattheadHrTo3 = getValue($oRSeatthead->fields["HrTo3"]);
endif;
$eattheadHrTo4 = "";
if (is_null($oRSeatthead->fields["HrTo4"])):
$eattheadHrTo4 = "";
else:
$eattheadHrTo4 = getValue($oRSeatthead->fields["HrTo4"]);
endif;
$eattheadHrTo5 = "";
if (is_null($oRSeatthead->fields["HrTo5"])):
$eattheadHrTo5 = "";
else:
$eattheadHrTo5 = getValue($oRSeatthead->fields["HrTo5"]);
endif;
$eattheadHrTo6 = "";
if (is_null($oRSeatthead->fields["HrTo6"])):
$eattheadHrTo6 = "";
else:
$eattheadHrTo6 = getValue($oRSeatthead->fields["HrTo6"]);
endif;
$eattheadHrTo7 = "";
if (is_null($oRSeatthead->fields["HrTo7"])):
$eattheadHrTo7 = "";
else:
$eattheadHrTo7 = getValue($oRSeatthead->fields["HrTo7"]);
endif;
$eattheadRm1 = "";
if (is_null($oRSeatthead->fields["Rm1"])):
$eattheadRm1 = "";
else:
$eattheadRm1 = getValue($oRSeatthead->fields["Rm1"]);
endif;
$eattheadRm2 = "";
if (is_null($oRSeatthead->fields["Rm2"])):
$eattheadRm2 = "";
else:
$eattheadRm2 = getValue($oRSeatthead->fields["Rm2"]);
endif;
$eattheadRm3 = "";
if (is_null($oRSeatthead->fields["Rm3"])):
$eattheadRm3 = "";
else:
$eattheadRm3 = getValue($oRSeatthead->fields["Rm3"]);
endif;
$eattheadRm4 = "";
if (is_null($oRSeatthead->fields["Rm4"])):
$eattheadRm4 = "";
else:
$eattheadRm4 = getValue($oRSeatthead->fields["Rm4"]);
endif;
$eattheadRm5 = "";
if (is_null($oRSeatthead->fields["Rm5"])):
$eattheadRm5 = "";
else:
$eattheadRm5 = getValue($oRSeatthead->fields["Rm5"]);
endif;
$eattheadRm6 = "";
if (is_null($oRSeatthead->fields["Rm6"])):
$eattheadRm6 = "";
else:
$eattheadRm6 = getValue($oRSeatthead->fields["Rm6"]);
endif;
$eattheadRm7 = "";
if (is_null($oRSeatthead->fields["Rm7"])):
$eattheadRm7 = "";
else:
$eattheadRm7 = getValue($oRSeatthead->fields["Rm7"]);
endif;
$eattheadTeaID1 = "";
if (is_null($oRSeatthead->fields["TeaID1"])):
$eattheadTeaID1 = "";
else:
$eattheadTeaID1 = getValue($oRSeatthead->fields["TeaID1"]);
endif;
$eattheadTeaID2 = "";
if (is_null($oRSeatthead->fields["TeaID2"])):
$eattheadTeaID2 = "";
else:
$eattheadTeaID2 = getValue($oRSeatthead->fields["TeaID2"]);
endif;
$eattheadTeaID3 = "";
if (is_null($oRSeatthead->fields["TeaID3"])):
$eattheadTeaID3 = "";
else:
$eattheadTeaID3 = getValue($oRSeatthead->fields["TeaID3"]);
endif;
$eattheadTeaID4 = "";
if (is_null($oRSeatthead->fields["TeaID4"])):
$eattheadTeaID4 = "";
else:
$eattheadTeaID4 = getValue($oRSeatthead->fields["TeaID4"]);
endif;
$eattheadTeaID5 = "";
if (is_null($oRSeatthead->fields["TeaID5"])):
$eattheadTeaID5 = "";
else:
$eattheadTeaID5 = getValue($oRSeatthead->fields["TeaID5"]);
endif;
$eattheadTeaID6 = "";
if (is_null($oRSeatthead->fields["TeaID6"])):
$eattheadTeaID6 = "";
else:
$eattheadTeaID6 = getValue($oRSeatthead->fields["TeaID6"]);
endif;
$eattheadTeaID7 = "";
if (is_null($oRSeatthead->fields["TeaID7"])):
$eattheadTeaID7 = "";
else:
$eattheadTeaID7 = getValue($oRSeatthead->fields["TeaID7"]);
endif;
$eattheadDayNo1 = "";
if (is_null($oRSeatthead->fields["DayNo1"])):
$eattheadDayNo1 = "";
else:
            if (isset($oRSeatthead->fields["DayNo1"]) && $oRSeatthead->fields["DayNo1"] > 0):
                $eattheadDayNo1 = "CHECKED";
            else:
                $eattheadDayNo1 = "";
            endif;
endif;
$eattheadDayNo2 = "";
if (is_null($oRSeatthead->fields["DayNo2"])):
$eattheadDayNo2 = "";
else:
            if (isset($oRSeatthead->fields["DayNo2"]) && $oRSeatthead->fields["DayNo2"] > 0):
                $eattheadDayNo2 = "CHECKED";
            else:
                $eattheadDayNo2 = "";
            endif;
endif;
$eattheadDayNo3 = "";
if (is_null($oRSeatthead->fields["DayNo3"])):
$eattheadDayNo3 = "";
else:
            if (isset($oRSeatthead->fields["DayNo3"]) && $oRSeatthead->fields["DayNo3"] > 0):
                $eattheadDayNo3 = "CHECKED";
            else:
                $eattheadDayNo3 = "";
            endif;
endif;
$eattheadDayNo4 = "";
if (is_null($oRSeatthead->fields["DayNo4"])):
$eattheadDayNo4 = "";
else:
            if (isset($oRSeatthead->fields["DayNo4"]) && $oRSeatthead->fields["DayNo4"] > 0):
                $eattheadDayNo4 = "CHECKED";
            else:
                $eattheadDayNo4 = "";
            endif;
endif;
$eattheadDayNo5 = "";
if (is_null($oRSeatthead->fields["DayNo5"])):
$eattheadDayNo5 = "";
else:
            if (isset($oRSeatthead->fields["DayNo5"]) && $oRSeatthead->fields["DayNo5"] > 0):
                $eattheadDayNo5 = "CHECKED";
            else:
                $eattheadDayNo5 = "";
            endif;
endif;
$eattheadDayNo6 = "";
if (is_null($oRSeatthead->fields["DayNo6"])):
$eattheadDayNo6 = "";
else:
            if (isset($oRSeatthead->fields["DayNo6"]) && $oRSeatthead->fields["DayNo6"] > 0):
                $eattheadDayNo6 = "CHECKED";
            else:
                $eattheadDayNo6 = "";
            endif;
endif;
$eattheadDayNo7 = "";
if (is_null($oRSeatthead->fields["DayNo7"])):
$eattheadDayNo7 = "";
else:
            if (isset($oRSeatthead->fields["DayNo7"]) && $oRSeatthead->fields["DayNo7"] > 0):
                $eattheadDayNo7 = "CHECKED";
            else:
                $eattheadDayNo7 = "";
            endif;
endif;
$eattheadSessionPrDay1 = "";
if (is_null($oRSeatthead->fields["SessionPrDay1"])):
$eattheadSessionPrDay1 = "";
else:
$eattheadSessionPrDay1 = getValue($oRSeatthead->fields["SessionPrDay1"]);
endif;
$eattheadSessionPrDay2 = "";
if (is_null($oRSeatthead->fields["SessionPrDay2"])):
$eattheadSessionPrDay2 = "";
else:
$eattheadSessionPrDay2 = getValue($oRSeatthead->fields["SessionPrDay2"]);
endif;
$eattheadSessionPrDay3 = "";
if (is_null($oRSeatthead->fields["SessionPrDay3"])):
$eattheadSessionPrDay3 = "";
else:
$eattheadSessionPrDay3 = getValue($oRSeatthead->fields["SessionPrDay3"]);
endif;
$eattheadSessionPrDay4 = "";
if (is_null($oRSeatthead->fields["SessionPrDay4"])):
$eattheadSessionPrDay4 = "";
else:
$eattheadSessionPrDay4 = getValue($oRSeatthead->fields["SessionPrDay4"]);
endif;
$eattheadSessionPrDay5 = "";
if (is_null($oRSeatthead->fields["SessionPrDay5"])):
$eattheadSessionPrDay5 = "";
else:
$eattheadSessionPrDay5 = getValue($oRSeatthead->fields["SessionPrDay5"]);
endif;
$eattheadSessionPrDay6 = "";
if (is_null($oRSeatthead->fields["SessionPrDay6"])):
$eattheadSessionPrDay6 = "";
else:
$eattheadSessionPrDay6 = getValue($oRSeatthead->fields["SessionPrDay6"]);
endif;
$eattheadSessionPrDay7 = "";
if (is_null($oRSeatthead->fields["SessionPrDay7"])):
$eattheadSessionPrDay7 = "";
else:
$eattheadSessionPrDay7 = getValue($oRSeatthead->fields["SessionPrDay7"]);
endif;
$DeleteButton = "<form method='post' action='Updateeattheaddel.php' id='form1' name='form1'>";
$DeleteButton .= "<input type='hidden' id='ID1' name='ID1' value=@ID1@>\n";
$DeleteButton .= "<input type='hidden' id='ID2' name='ID2' value=@ID2@>\n";
$DeleteButton .= "<input type='hidden' id='ID3' name='ID3' value=@ID3@>\n";
$DeleteButton .= "<input type='hidden' id='ID4' name='ID4' value=@ID4@>\n";
$DeleteButton .= "<input type='submit' value='Delete' title='Delete this record' id='submit1' name='submit1'>\n";
$DeleteButton .= "</form>\n";

if ($_SESSION["Updateeatthead_EditFailed"] == 1) {
  $eattheadCountryID = $_SESSION["SavedEditeattheadCountryID"];
  $eattheadBranchID = $_SESSION["SavedEditeattheadBranchID"];
  $eattheadAdmitDate = $_SESSION["SavedEditeattheadAdmitDate"];
  $eattheadCustNo = $_SESSION["SavedEditeattheadCustNo"];
  $eattheadLevelID = $_SESSION["SavedEditeattheadLevelID"];
  $eattheadTierID = $_SESSION["SavedEditeattheadTierID"];
  $eattheadModCount = $_SESSION["SavedEditeattheadModCount"];
  $eattheadStartDate = $_SESSION["SavedEditeattheadStartDate"];
  $eattheadEndDate = $_SESSION["SavedEditeattheadEndDate"];
  $eattheadStatus = $_SESSION["SavedEditeattheadStatus"];
  $eattheadClassStatus = $_SESSION["SavedEditeattheadClassStatus"];
  $eattheadDay1 = $_SESSION["SavedEditeattheadDay1"];
  $eattheadDay2 = $_SESSION["SavedEditeattheadDay2"];
  $eattheadDay3 = $_SESSION["SavedEditeattheadDay3"];
  $eattheadDay4 = $_SESSION["SavedEditeattheadDay4"];
  $eattheadDay5 = $_SESSION["SavedEditeattheadDay5"];
  $eattheadDay6 = $_SESSION["SavedEditeattheadDay6"];
  $eattheadDay7 = $_SESSION["SavedEditeattheadDay7"];
  $eattheadHrFr1 = $_SESSION["SavedEditeattheadHrFr1"];
  $eattheadHrFr2 = $_SESSION["SavedEditeattheadHrFr2"];
  $eattheadHrFr3 = $_SESSION["SavedEditeattheadHrFr3"];
  $eattheadHrFr4 = $_SESSION["SavedEditeattheadHrFr4"];
  $eattheadHrFr5 = $_SESSION["SavedEditeattheadHrFr5"];
  $eattheadHrFr6 = $_SESSION["SavedEditeattheadHrFr6"];
  $eattheadHrFr7 = $_SESSION["SavedEditeattheadHrFr7"];
  $eattheadHrTo1 = $_SESSION["SavedEditeattheadHrTo1"];
  $eattheadHrTo2 = $_SESSION["SavedEditeattheadHrTo2"];
  $eattheadHrTo3 = $_SESSION["SavedEditeattheadHrTo3"];
  $eattheadHrTo4 = $_SESSION["SavedEditeattheadHrTo4"];
  $eattheadHrTo5 = $_SESSION["SavedEditeattheadHrTo5"];
  $eattheadHrTo6 = $_SESSION["SavedEditeattheadHrTo6"];
  $eattheadHrTo7 = $_SESSION["SavedEditeattheadHrTo7"];
  $eattheadRm1 = $_SESSION["SavedEditeattheadRm1"];
  $eattheadRm2 = $_SESSION["SavedEditeattheadRm2"];
  $eattheadRm3 = $_SESSION["SavedEditeattheadRm3"];
  $eattheadRm4 = $_SESSION["SavedEditeattheadRm4"];
  $eattheadRm5 = $_SESSION["SavedEditeattheadRm5"];
  $eattheadRm6 = $_SESSION["SavedEditeattheadRm6"];
  $eattheadRm7 = $_SESSION["SavedEditeattheadRm7"];
  $eattheadTeaID1 = $_SESSION["SavedEditeattheadTeaID1"];
  $eattheadTeaID2 = $_SESSION["SavedEditeattheadTeaID2"];
  $eattheadTeaID3 = $_SESSION["SavedEditeattheadTeaID3"];
  $eattheadTeaID4 = $_SESSION["SavedEditeattheadTeaID4"];
  $eattheadTeaID5 = $_SESSION["SavedEditeattheadTeaID5"];
  $eattheadTeaID6 = $_SESSION["SavedEditeattheadTeaID6"];
  $eattheadTeaID7 = $_SESSION["SavedEditeattheadTeaID7"];
  $eattheadDayNo1 = ($_SESSION["SavedEditeattheadDayNo1"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo2 = ($_SESSION["SavedEditeattheadDayNo2"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo3 = ($_SESSION["SavedEditeattheadDayNo3"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo4 = ($_SESSION["SavedEditeattheadDayNo4"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo5 = ($_SESSION["SavedEditeattheadDayNo5"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo6 = ($_SESSION["SavedEditeattheadDayNo6"] == "ON") ? "CHECKED" : "";
  $eattheadDayNo7 = ($_SESSION["SavedEditeattheadDayNo7"] == "ON") ? "CHECKED" : "";
  $eattheadSessionPrDay1 = $_SESSION["SavedEditeattheadSessionPrDay1"];
  $eattheadSessionPrDay2 = $_SESSION["SavedEditeattheadSessionPrDay2"];
  $eattheadSessionPrDay3 = $_SESSION["SavedEditeattheadSessionPrDay3"];
  $eattheadSessionPrDay4 = $_SESSION["SavedEditeattheadSessionPrDay4"];
  $eattheadSessionPrDay5 = $_SESSION["SavedEditeattheadSessionPrDay5"];
  $eattheadSessionPrDay6 = $_SESSION["SavedEditeattheadSessionPrDay6"];
  $eattheadSessionPrDay7 = $_SESSION["SavedEditeattheadSessionPrDay7"];
}
else {
  $_SESSION["Updateeatthead_EditFailed"] = 0;
}

MergeTemplate($HTML_Template);
unset($oRSeatthead);
$objConn1->Close();
unset($objConn1);
?>
