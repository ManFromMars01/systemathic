 <?php
include('ConnInfo.php');
//include('template/myclass.php')
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
$ID3 = trim(htmlDecode(getRequest("ID3")),"'");


/**Begin selected_item**/
$sel_item = "SELECT *  FROM titems  WHERE  titems.ItemNo='".$ID3."'";
$sel_item = $objConn1->Execute($sel_item);
foreach ($sel_item as $sel_items):
         $abacus = $sel_items['IsAbacus'];
         $mental = $sel_items['IsMental'];
         $supp = $sel_items['IsSupp'];
         $catid = $sel_items['CatID'];
         $depid = $sel_items['DeptID'];
         $locid = $sel_items['LocationID'];
         $meaid = $sel_items['IssuUntMea'];
         $venid = $sel_items['LastPurVdrID'];
         
         $abanx1 = $sel_items['AbaNxtBook1'];
         $abanx2 = $sel_items['AbaNxtBook2'];
         $abanx3 = $sel_items['AbaNxtBook3'];
         $abapr1 = $sel_items['AbaPrvBook1'];
         $abapr2 = $sel_items['AbaPrvBook2'];
         $abapr3 = $sel_items['AbaPrvBook3'];
         $abapre1 = $sel_items['AbaPreBook1']; 
         $abapre2 = $sel_items['AbaPreBook2'];
         $abapre3 = $sel_items['AbaPreBook3'];

         $menx1 = $sel_items['MenNxtBook1'];
         $menx2 = $sel_items['MenNxtBook2'];
         $menx3 = $sel_items['MenNxtBook3'];
         $mepr1 = $sel_items['MenPrvBook1'];
         $mepr2 = $sel_items['MenPrvBook2'];
         $mepr3 = $sel_items['MenPrvBook3'];
         $menpre1 = $sel_items['MenPreBook1']; 
         $menpre2 = $sel_items['MenPreBook2'];
         $menpre3 = $sel_items['MenPreBook3'];


         $spnx1 = $sel_items['SuppNxtBook1'];
         $spnx2 = $sel_items['SuppNxtBook2'];
         $spnx3 = $sel_items['SuppNxtBook3'];
         $sppr1 = $sel_items['SuppPrvBook1'];
         $sppr2 = $sel_items['SuppPrvBook2'];
         $sppr3 = $sel_items['SuppPrvBook3'];
         $supppre1 = $sel_items['SuppPreBook1']; 
         $supppre2 = $sel_items['SuppPreBook2'];
         $supppre3 = $sel_items['SuppPreBook3'];


        $abacnt1 = $sel_items['AbaRptCnt1'];
        $abacnt2 = $sel_items['AbaRptCnt2'];
        $abacnt3 = $sel_items['AbaRptCnt3'];

        $mencnt1 = $sel_items['MenRptCnt1'];
        $mencnt2 = $sel_items['MenRptCnt2'];
        $mencnt3 = $sel_items['MenRptCnt3'];

        $suppcnt1 = $sel_items['SuppRptCnt1'];
        $suppcnt2 = $sel_items['SuppRptCnt2'];
        $suppcnt3 = $sel_items['SuppRptCnt3'];

        $manid    = $sel_items['ManufacturerID'] ;

        $abanxtcat1    = $sel_items['AbaNext1Cat'] ;
        $abanxtcat2    = $sel_items['AbaNext2Cat'] ;
        $abanxtcat3    = $sel_items['AbaNext3Cat'] ;
        $abaprvcat1    = $sel_items['AbaPrev1Cat'] ;
        $abaprvcat2    = $sel_items['AbaPrev2Cat'] ;
        $abaprvcat3    = $sel_items['AbaPrev3Cat'] ;
        $abaprecat1    = $sel_items['PreAbaNext1Cat'] ;
        $abaprecat2    = $sel_items['PreAbaNext2Cat'] ;
        $abaprecat3    = $sel_items['PreAbaNext3Cat'] ;


        $mennxtcat1    = $sel_items['MenNext1Cat'] ;
        $mennxtcat2    = $sel_items['MenNext2Cat'] ;
        $mennxtcat3    = $sel_items['MenNext3Cat'] ;
        $menprvcat1    = $sel_items['MenPrev1Cat'] ;
        $menprvcat2    = $sel_items['MenPrev2Cat'] ;
        $menprvcat3    = $sel_items['MenPrev3Cat'] ;
        $menprecat1    = $sel_items['PreMenNext1Cat'] ;
        $menprecat2    = $sel_items['PreMenNext2Cat'] ;
        $menprecat3    = $sel_items['PreMenNext3Cat'] ;

        $suppnxtcat1    = $sel_items['SuppNext1Cat'] ;
        $suppnxtcat2    = $sel_items['SuppNext2Cat'] ;
        $suppnxtcat3    = $sel_items['SuppNext3Cat'] ;
        $suppprvcat1    = $sel_items['SuppPrev1Cat'] ;
        $suppprvcat2    = $sel_items['SuppPrev2Cat'] ;
        $suppprvcat3    = $sel_items['SuppPrev3Cat'] ;

        $suppprecat1    = $sel_items['PreSuppNext1Cat'] ;
        $suppprecat2    = $sel_items['PreSuppNext2Cat'] ;
        $suppprecat3    = $sel_items['PreSuppNext3Cat'] ;



endforeach;
/**End selected_item**/

if($abacus == "Yes"){
        $isabacus ='<input type="checkbox" name="" id="isabacus" class="bookcat" value="abacus" checked>';
} else{
         $isabacus ='<input type="checkbox" name="" id="isabacus" class="bookcat" value="abacus" >';
}

if($mental == "Yes"){
        $ismental ='<input type="checkbox" name="" id="ismental" class="bookcat" value="mental" checked>';
} else{
         $ismental ='<input type="checkbox" name="" id="ismental" class="bookcat" value="mental" >';
}


if($supp == "Yes"){
        $issupp ='<input type="checkbox" name="" id="issupply" class="bookcat" value="supplementary" checked>';
} else{
         $issupp ='<input type="checkbox" name="" id="issupply" class="bookcat" value="supplementary" >';
}




/**Begin Department**/
$seldepartment = "SELECT *  FROM tdepartment  WHERE  tdepartment.BranchID='".$_SESSION['UserValue2']."'";
$option1 .=  "<option value=''>Please Select A Department</option>";
$seldepartment = $objConn1->Execute($seldepartment);
foreach ($seldepartment as $seldepartments):
        if($seldepartments['ID'] == $depid){
                $selected = "selected";
        } else {
                $selected = "";
        }
        $option1 .= "<option ".$selected ." value='".$seldepartments['ID']."'>".$seldepartments['Description']." </option>";
endforeach;
/**End Department**/

/**Begin Manufacturer**/
$selmanufacturer = "SELECT *  FROM tmanufacturer";
$option2 .=  "<option value=''>Please Select A Manufacturer</option>";
$selmanufacturer = $objConn1->Execute($selmanufacturer);
foreach ($selmanufacturer as $selmanufacturers):
        if($selmanufacturers['ID'] == $manid){
                $selected = "selected";
        } else {
                $selected = "";
        }
        $option2 .= "<option ". $selected . " value='".$selmanufacturers['ID']."'>".$selmanufacturers['Description']." </option>";
endforeach;
/**End Manufacturer**/

/**Begin Location**/
$sellocation = "SELECT *  FROM tlocation WHERE tlocation.branchID='".$_SESSION['UserValue2']."'";
$option3 .=  "<option value=''>Please Select A Location</option>";
$sellocation = $objConn1->Execute($sellocation);
foreach ($sellocation as $sellocations):
        if($sellocations['ID'] == $locid){
                $selected = "selected";
        } else {
                $selected = "";
        }
        $option3 .= "<option ".$selected." value='".$sellocations['ID']."'>".$sellocations['Description']." </option>";
endforeach;
/**End Location**/




/**Begin Category**/
$selcategory = "SELECT *  FROM tcategory  WHERE  tcategory.BranchID='".$_SESSION['UserValue2']."'";
$option7 .=  "<option value=''>Please Select A Category</option>";
$selcategory = $objConn1->Execute($selcategory);
foreach ($selcategory as $selcategorys):
        if($catid == $selcategorys['ID']){
          $selected = "selected";                     
        } else{
          $selected = "";      
        }

        $option7 .= "<option " .$selected. " value='".$selcategorys['ID']."'>".$selcategorys['Description']." </option>";
endforeach;
/**End Category**/

/**Begin Vendor**/
$selvendor = "SELECT *  FROM tvendor  WHERE  tvendor.BranchID='".$_SESSION['UserValue2']."'";
$option8 .=  "<option value=''>Please Select A Vendor</option>";
$selvendor = $objConn1->Execute($selvendor);
foreach ($selvendor as $selvendor):
        if($selvendor['ID'] == $venid){
                $selected = "selected";
        } else {
                $selected = "";
        }
        $option8 .= "<option ".$selected." value='".$selvendor['ID']."'>".$selvendor['Name']." </option>";
endforeach;
/**End Vendor**/

/**Unit of Measure **/
$selumea = "SELECT *  FROM tunitmeas  WHERE  tunitmeas.BranchID='".$_SESSION['UserValue2']."'";
$option9 .=  "<option value=''>Please Select Unit of Measure</option>";
$selumea = $objConn1->Execute($selumea);
foreach ($selumea as $selumeas):
        if($selumeas['ID'] == $meaid){
                $selected = "selected";
        } else {
                $selected = "";
        }
        $option9 .= "<option " . $selected ." value='".$selumeas['ID']."'>".$selumeas['Description']." </option>";
endforeach;
/**Unit of Mesure**/




/**Abacus Books**/
$selbooks = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes'";
$selbooks = $objConn1->Execute($selbooks);
foreach ($selbooks as $selbook):
        $selected = "selected";
        $repeat   = "";

        if($abanx1  == $selbook['ItemNo'] ){
            if($abanxtcat1 == "a"){
                $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
             } elseif($abanxtcat1 =="m"){
                    $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
             } elseif($abanxtcat1 =="s"){
                     $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($abanx2  == $selbook['ItemNo'] ){
                
                if($abanxtcat2 =="a"){
                    $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abanxtcat2 =="m"){
                    $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abanxtcat2 =="s"){
                     $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($abanx3  == $selbook['ItemNo'] ){
               
                if($abanxtcat3 =="a"){
                    $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abanxtcat3 =="m"){
                    $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abanxtcat3 =="s"){
                     $selectedaba .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }

        }

        if($abapr1  == $selbook['ItemNo'] ){
            if($abaprvcat1 == "a"){
                $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$abaprvcat1.$selbook['AbaDesc'].") ".$repeat."</option>";    
             } elseif($abaprvcat1 =="m"){
                    $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
             } elseif($abaprvcat1 =="s"){
                     $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($abapr2  == $selbook['ItemNo'] ){
                
                if($abaprvcat2 =="a"){
                    $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abaprvcat2 =="m"){
                    $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abaprvcat2 =="s"){
                     $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($abapr3  == $selbook['ItemNo'] ){
               
                if($abaprvcat3 =="a"){
                    $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abaprvcat3 =="m"){
                    $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abaprvcat3 =="s"){
                     $selectedabap .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }

        }

        if($abapre1  == $selbook['ItemNo'] ){
            if($abaprecat1 == "a"){
                $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$abaprvcat1.$selbook['AbaDesc'].") ".$repeat."</option>";    
             } elseif($abaprecat1 =="m"){
                    $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
             } elseif($abaprecat1 =="s"){
                     $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($abapre2  == $selbook['ItemNo'] ){
                
                if($abaprecat2 =="a"){
                    $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abaprecat2 =="m"){
                    $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abaprecat2 =="s"){
                     $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($abapre3  == $selbook['ItemNo'] ){
               
                if($abaprecat3 =="a"){
                    $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") ".$repeat."</option>";    
                } elseif($abaprecat3 =="m"){
                    $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."m'>".$selbook['ItemNo']." (".$selbook['MenDesc'].") ".$repeat."</option>";
                } elseif($abaprecat3 =="s"){
                     $selectedabapre .=  "<option ".$selected." value='".$selbook['ItemNo']."s'>".$selbook['ItemNo']." (".$selbook['SuppDesc'].") ".$repeat."</option>";    
                }

        }


        


endforeach;
/**End abacus**/

/**Mental Books**/
$selbooks2 = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes' ";
$selbooks2 = $objConn1->Execute($selbooks2);
foreach ($selbooks2 as $selbook2):
        $selected = "selected";
        $repeat   = "";
        if($menx1  == $selbook2['ItemNo'] ){
            if($mennxtcat1 == "a"){
                $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
             } elseif($mennxtcat1 =="m"){
                    $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
             } elseif($mennxtcat1 =="s"){
                     $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($menx2  == $selbook2['ItemNo'] ){
                
                if($mennxtcat2 =="a"){
                    $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($mennxtcat2 =="m"){
                    $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($mennxtcat2 =="s"){
                     $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($menx3  == $selbook2['ItemNo'] ){
             
                if($mennxtcat3 =="a"){
                    $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($mennxtcat3 =="m"){
                    $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($mennxtcat3 =="s"){
                     $selectedmen .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }

        }

        if($mepr1  == $selbook2['ItemNo'] ){
            if($menprvcat1 == "a"){
                $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
             } elseif($menprvcat1 =="m"){
                    $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
             } elseif($menprvcat1 =="s"){
                     $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
            }   
            
                
                
        }
        if($mepr2  == $selbook2['ItemNo'] ){
                
                if($menprvcat2 =="a"){
                    $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($menprvcat2 =="m"){
                    $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($menprvcat2 =="s"){
                     $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($mepr3  == $selbook2['ItemNo'] ){
             
                if($menprvcat3 =="a"){
                    $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($menprvcat3 =="m"){
                    $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($menprvcat3 =="s"){
                     $selectedmenp .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }

        }

        if($menpre1  == $selbook2['ItemNo'] ){
            if($menprecat1 == "a"){
                $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
             } elseif($menprecat1 =="m"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
             } elseif($menprecat1 =="s"){
                     $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
            }   
            
                
                
        }
        if($menpre2  == $selbook2['ItemNo'] ){
                
                if($menprecat2 =="a"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($menprecat2 =="m"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($menprecat2 =="s"){
                     $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($menpre3  == $selbook2['ItemNo'] ){
             
                if($menprecat3 =="a"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."a'>".$selbook2['ItemNo']." (".$selbook2['AbaDesc'].") ".$repeat."</option>";    
                } elseif($menprecat3 =="m"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") ".$repeat."</option>";
                } elseif($menprecat3 =="s"){
                    $selectedmenpre .=  "<option ".$selected." value='".$selbook2['ItemNo']."s'>".$selbook2['ItemNo']." (".$selbook2['SuppDesc'].") ".$repeat."</option>";    
                }

        }
        
endforeach;
/**End Mental**/


/**Supplementary Books**/
$selbooks3 = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes' ";
$selbooks3 = $objConn1->Execute($selbooks3);
foreach ($selbooks3 as $selbook3):
        $selected = "selected";
        $repeat   = "";

        if($spnx1  == $selbook3['ItemNo'] ){
            if($suppnxtcat1 =="a"){
                $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
             } elseif($suppnxtcat1 =="m"){
                    $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
             } elseif($suppnxtcat1 =="s"){
                     $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($spnx2  == $selbook3['ItemNo'] ){
                
                if($suppnxtcat2 =="a"){
                    $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppnxtcat2 =="m"){
                    $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppnxtcat2 =="s"){
                     $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($spnx3  == $selbook3['ItemNo'] ){
             
                if($suppnxtcat3 =="a"){
                    $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppnxtcat3 =="m"){
                    $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppnxtcat3 =="s"){
                     $selectedsp .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }

        }


        if($sppr1  == $selbook3['ItemNo'] ){
            if($suppprvcat1 == "a"){
                $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
             } elseif($suppprvcat1 =="m"){
                    $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
             } elseif($suppprvcat1 =="s"){
                     $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($sppr2  == $selbook3['ItemNo'] ){
                
                if($suppprvcat2 =="a"){
                    $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppprvcat2 =="m"){
                    $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppprvcat2 =="s"){
                     $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($sppr3  == $selbook3['ItemNo'] ){
             
                if($suppprvcat3 =="a"){
                    $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppprvcat3 =="m"){
                    $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppprvcat3 =="s"){
                     $selectedsppr .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }

        }

        if($supppre1  == $selbook3['ItemNo'] ){
            if($suppprecat1 == "a"){
                $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
             } elseif($suppprecat1 =="m"){
                    $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
             } elseif($suppprecat1 =="s"){
                     $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
            }    
            
                
                
        }

        if($supppre2  == $selbook3['ItemNo'] ){
                
                if($suppprecat2 =="a"){
                    $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppprecat2 =="m"){
                    $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppprecat2 =="s"){
                     $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }


        }

        if($supppre3  == $selbook3['ItemNo'] ){
             
                if($suppprecat3 =="a"){
                    $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."a'>".$selbook3['ItemNo']." (".$selbook3['AbaDesc'].") ".$repeat."</option>";    
                } elseif($suppprecat3 =="m"){
                    $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."m'>".$selbook3['ItemNo']." (".$selbook3['MenDesc'].") ".$repeat."</option>";
                } elseif($suppprecat3 =="s"){
                     $selectedsppre .=  "<option ".$selected." value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") ".$repeat."</option>";    
                }

        }
        
endforeach;
/**End**/




/**Abacus Books**/
$selbooks = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes' AND titems.IsAbacus='Yes'";
$selbooks = $objConn1->Execute($selbooks);
foreach ($selbooks as $selbook):
        $option4 .= "<option value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") </option>";
endforeach;
/**End abacus**/

/**Mental Books**/
$selbooks2 = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes' AND titems.IsMental='Yes'";
$selbooks2 = $objConn1->Execute($selbooks2);
foreach ($selbooks2 as $selbook2):
        $option5 .= "<option value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") </option>";
endforeach;
/**End Mental**/


/**Supplementary Books**/
$selbooks3 = "SELECT *  FROM titems WHERE titems.branchID='".$_SESSION['UserValue2']."' AND titems.IsBook='Yes' AND titems.IsSupp='Yes'";
$selbooks3 = $objConn1->Execute($selbooks3);
foreach ($selbooks3 as $selbook3):
        $option6 .= "<option value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") </option>";
endforeach;
/**End**/





if($abacnt1  <= 0 ){
   $noneaba1 = "displaynone";     
}
if($abacnt2 <= 0 ){
   $noneaba2 = "displaynone";     
}
if($abacnt3 <= 0 ){
   $noneaba3 = "displaynone";     
}

if($mencnt1 <= 0 ){
   $nonemen1 = "displaynone";     
}
if($mencnt2 <= 0 ){
   $nonemen2 = "displaynone";     
}
if($mencnt3 <= 0 ){
   $nonemen3 = "displaynone";     
}


if($suppcnt1 <= 0 ){
   $nonesup1 = "displaynone";     
}
if($suppcnt2 <= 0 ){
   $nonesup2 = "displaynone";     
}
if($suppcnt3 <= 0 ){
   $nonesup3 = "displaynone";     
}




$optionaban  = $selectedaba.$option4.$option5.$option6;   
$optionabap  = $selectedabap.$option4.$option5.$option6;  
$optionabapre = $selectedabapre.$option4.$option5.$option6;  

$optionmenn  = $selectedmen.$option4.$option5.$option6;   
$optionmenp  = $selectedmenp.$option4.$option5.$option6;
$optionmenpre = $selectedmenpre.$option4.$option5.$option6;  


$optionsupn  = $selectedsp.$option4.$option5.$option6;   
$optionsupp  = $selectedsppr.$option4.$option5.$option6;
$optionsuppre = $selectedsppre.$option4.$option5.$option6;  





$TemplateText = Replace($TemplateText, "@department@", $option1);
$TemplateText = Replace($TemplateText, "@manufacturer@", $option2);
$TemplateText = Replace($TemplateText, "@location@", $option3);

$TemplateText = Replace($TemplateText, "@abacus@", $optionaban);
$TemplateText = Replace($TemplateText, "@abacus2@", $optionabap);
$TemplateText = Replace($TemplateText, "@abacus3@", $optionabapre);

$TemplateText = Replace($TemplateText, "@mental@", $optionmenn);
$TemplateText = Replace($TemplateText, "@mental2@", $optionmenp );
$TemplateText = Replace($TemplateText, "@mental3@", $optionmenpre);

$TemplateText = Replace($TemplateText, "@supplementary@", $optionsupn);
$TemplateText = Replace($TemplateText, "@supplementary2@", $optionsupp);
$TemplateText = Replace($TemplateText, "@supplementary3@", $optionsuppre);

$TemplateText = Replace($TemplateText, "@category@", $option7);
$TemplateText = Replace($TemplateText, "@vendor@", $option8);
$TemplateText = Replace($TemplateText, "@unitofmeas@", $option9);
$TemplateText = Replace($TemplateText, "@isabacus@", $isabacus);
$TemplateText = Replace($TemplateText, "@ismental@", $ismental);
$TemplateText = Replace($TemplateText, "@issupp@", $issupp);

$TemplateText = Replace($TemplateText, "@noneaba1@", $noneaba1);
$TemplateText = Replace($TemplateText, "@noneaba2@", $noneaba2);
$TemplateText = Replace($TemplateText, "@noneaba3@", $noneaba3);

$TemplateText = Replace($TemplateText, "@nonemen1@", $nonemen1);
$TemplateText = Replace($TemplateText, "@nonemen2@", $nonemen2);
$TemplateText = Replace($TemplateText, "@nonemen3@", $nonemen3);

$TemplateText = Replace($TemplateText, "@nonesup1@", $nonesup1);
$TemplateText = Replace($TemplateText, "@nonesup2@", $nonesup2);
$TemplateText = Replace($TemplateText, "@nonesup3@", $nonesup3);


$TemplateText = Replace($TemplateText, "@abanxtcat1@", $abanxtcat1);
$TemplateText = Replace($TemplateText, "@abanxtcat2@", $abanxtcat2);
$TemplateText = Replace($TemplateText, "@abanxtcat3@", $abanxtcat3);
$TemplateText = Replace($TemplateText, "@abaprvcat1@", $abaprvcat1);
$TemplateText = Replace($TemplateText, "@abaprvcat2@", $abaprvcat2);
$TemplateText = Replace($TemplateText, "@abaprvcat3@", $abaprvcat3);

$TemplateText = Replace($TemplateText, "@abaprecat1@", $abaprecat1);
$TemplateText = Replace($TemplateText, "@abaprecat2@", $abaprecat2);
$TemplateText = Replace($TemplateText, "@abaprecat3@", $abaprecat3);

$TemplateText = Replace($TemplateText, "@mennxtcat1@", $mennxtcat1);
$TemplateText = Replace($TemplateText, "@mennxtcat2@", $mennxtcat2);
$TemplateText = Replace($TemplateText, "@mennxtcat3@", $mennxtcat3);
$TemplateText = Replace($TemplateText, "@menprvcat1@", $menprvcat1);
$TemplateText = Replace($TemplateText, "@menprvcat2@", $menprvcat2);
$TemplateText = Replace($TemplateText, "@menprvcat3@", $menprvcat3);

$TemplateText = Replace($TemplateText, "@menprecat1@", $menprecat1);
$TemplateText = Replace($TemplateText, "@menprecat2@", $menprecat2);
$TemplateText = Replace($TemplateText, "@menprecat3@", $menprecat3);

$TemplateText = Replace($TemplateText, "@suppnxtcat1@", $suppnxtcat1);
$TemplateText = Replace($TemplateText, "@suppnxtcat2@", $suppnxtcat2);
$TemplateText = Replace($TemplateText, "@suppnxtcat3@", $suppnxtcat3);
$TemplateText = Replace($TemplateText, "@suppprvcat1@", $suppprvcat1);
$TemplateText = Replace($TemplateText, "@suppprvcat2@", $suppprvcat2);
$TemplateText = Replace($TemplateText, "@suppprvcat3@", $suppprvcat3);
$TemplateText = Replace($TemplateText, "@suppprecat1@", $suppprecat1);
$TemplateText = Replace($TemplateText, "@suppprecat2@", $suppprecat2);
$TemplateText = Replace($TemplateText, "@suppprecat3@", $suppprecat3);





if(isset($_POST['preva'])){
	$bookcodes = $_POST['preva'];
	$bookcodes = array('status' => $bookcodes);
	echo json_encode($bookcodes);

}


?>
