  <?php 
  session_start();
  include('../class/model.php'); // dont use $model variable 
  include('../class/systemathic.php'); 
  
  $cursku = $model->select_where('titems',array('Sku' =>  $_POST["sku"] ));
  $skupost = $cursku->fields['CountryID'].$cursku->fields['LastPurVdrID'].$cursku->fields['CatID'].$cursku->fields['Color'].$cursku->fields['Sizes'];
  $postsku = $cursku->fields['CountryID'].$_POST["txttitemsLastPurVdrID"].$_POST["txttitemsCatID"].$_POST["txttitemscolors"].$_POST["txttitemssize"];

  if($skupost == $postsku){
    $toupdate = array("Description" => $_POST["txttitemsDescription"]);
    $toupdate2 = array(
      ""
    );

   
    $model->update_tbl('titems',$toupdate,array('Sku' => $_POST["sku"] ));
    $success = "Update Successfully";
    
    $myStatus  = array('mystatus2' => $success);
    echo json_encode($myStatus);  

  } 


     

  ?>