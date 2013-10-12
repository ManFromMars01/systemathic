 <?php
  include('ConnInfo.php');

    $objConn1 = &ADONewConnection($Driver1);
    $objConn1->debug = $DebugMode;
    $objConn1->PConnect($Server1,$User1,$Password1,$db1);
    
    /**Begin LEvel**/
    $selectlevel = "SELECT *  FROM tlevel  WHERE tlevel.CountryID ='".$_SESSION['UserValue1']."' AND tlevel.BranchID='".$_SESSION['UserValue2']."' ORDER BY tlevel.CountryID ASC";
    $selectlevel = $objConn1->Execute($selectlevel);
    foreach ($selectlevel as $levellist):
         if ($tcustomerLevelID == $levellist['ID'] ):
            $selected = "SELECTED";
         else:
            $selected = "";
        endif;       
        $level  .= '<option value="'.$levellist['ID'].'"'.$selected.'>'.$levellist['Description'].'</option>';
    endforeach;
    /**End LEvel**/


    /**Begin Tier**/
    $selecttier = "SELECT *  FROM ttier  WHERE ttier.CountryID ='".$_SESSION['UserValue1']."' AND ttier.BranchID='".$_SESSION['UserValue2']."' ORDER BY ttier.CountryID ASC";
    $selecttier = $objConn1->Execute($selecttier);
    foreach ($selecttier as $tierlist):
        if ($tcustomerTierID == $tierlist['ID'] ):
                $selected = "SELECTED";
             else:
                $selected = "";
        endif;         

        $tier  .= '<option value="'.$tierlist['ID'].'" '.$selected.'>'.$tierlist['Description'].'</option>';
    endforeach;
    /**End Tier**/

    /**Begin Referral**/
    $selectref = "SELECT *  FROM treferral  WHERE treferral.CountryID ='".$_SESSION['UserValue1']."' AND treferral.BranchID='".$_SESSION['UserValue2']."' ORDER BY treferral.CountryID ASC";
    $selectref = $objConn1->Execute($selectref);
    foreach ($selectref  as $reflist):
        if ($tcustomerReferralID == $reflist['ID'] ):
                $selected = "SELECTED";
             else:
                $selected = "";
        endif;         

        $referral  .= '<option value="'.$reflist['ID'].'" '.$selected.'>'.$reflist['Description'].'</option>';
    endforeach;
    /**End Referral**/

    $TemplateText = Replace($TemplateText, "@level@", $level); 
    $TemplateText = Replace($TemplateText, "@tier@", $tier); 
    $TemplateText = Replace($TemplateText, "@referral@", $referral); 

 ?>   