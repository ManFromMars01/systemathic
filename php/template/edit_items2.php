  <?php 
  include('myclass.php');
  

  $toupdate = array("CountryID" => $_POST["txttitemsCountryID"],
  "BranchID" => $_POST["txttitemsBranchID"],
  "ItemNo" => $_POST["txttitemsItemNo"],
  "Description" => $_POST["txttitemsDescription"],
  "CatID" => $_POST["txttitemsCatID"],
  //"SubCatID" => $_POST["txttitemsSubCatID"],
  "DeptID" => $_POST["txttitemsDeptID"],
  "ManufacturerID" => $_POST["txttitemsManufacturerID"],
  "CatID"          => $_POST["txttitemsCatID"],
  "Color"          => $_POST["txttitemscolors"],
  "Sizes"          => $_POST["txttitemssize"],
  "Design"         => $_POST["design"],
  "Sku"            => $_POST["txttitemsLastPurVdrID"].$_POST["txttitemsCatID"].$_POST["design"].$_POST["txttitemscolors"].$_POST["txttitemssize"] 

  );

 
  $model->update_tbl('titems',$toupdate,array('ItemNo' => $_POST["txttitemsItemNo"] ),1);
  $success = "Update Successfully";
  
  $myStatus  = array('mystatus2' => $success);
  echo json_encode($myStatus);   

  ?>