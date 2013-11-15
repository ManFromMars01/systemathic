<?php
   include('template/myclass.php');  
   $itemno  = $_POST['txttkitpackItemNo'];
   $countryid = $_POST['txttkitpackCountryID'];
   $branchid = $_POST['txttkitpackBranchID'];
   $qty = $_POST['txttkitpackQty'];
   $level = $_POST['txttkitpackLevelID'];

   $itemnumber = substr_replace($itemno,"",-1);
   $itemcat    =  substr($itemno,-1,1);


   if($itemcat == 'a'){
     $category = 'a';
     $itemtype = "1"; 
     $desc = $model->select_where('titems',array('ItemNo' => $itemnumber));
     $desc = $desc->fields['AbaDesc'];
   }

   if($itemcat == 'm'){
    $category = 'm';
    $itemtype = "1";
    $desc = $model->select_where('titems',array('ItemNo' => $itemnumber));
     $desc = $desc->fields['MenDesc'];
   }

   if($itemcat == 's'){
    $category = 's';
    $itemtype = "1";
    $desc = $model->select_where('titems',array('ItemNo' => $itemnumber));
    $desc = $desc->fields['SuppDesc'];
   }

   if($itemcat == 'o'){
    $category = '';
    $itemtype = "0";
    $desc = $model->select_where('titems',array('ItemNo' => $itemnumber));
    $desc = $desc->fields['Description'];
   }

   $toinsert = array(
        'CountryID' => $countryid,
        'LevelID'   => $level,
        'BranchID' => $branchid,
        'ItemNo' => $itemnumber,
        'ItemType' => $itemtype,
        'Category' => $category,
        'BookCount' => '1',
        'Qty'       => $qty,
        'Description' => $desc
      );

   $model->insert_tbl('tkitpack',$toinsert,0);
   $statusme  = "Transaction Complete"; 
   $mystatus = array('status' => $statusme);
   echo json_encode($mystatus);

?> 
