<?php
include('ConnInfo.php');
$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);


/**Begin Department**/
$seldepartment = "SELECT *  FROM tdepartment  WHERE  tdepartment.BranchID='".$_SESSION['UserValue2']."'";
$option1 .=  "<option value=''>Please Select A Department</option>";
$seldepartment = $objConn1->Execute($seldepartment);
foreach ($seldepartment as $seldepartments):
        $option1 .= "<option value='".$seldepartments['ID']."'>".$seldepartments['Description']." </option>";
endforeach;
/**End Department**/

/**Begin Manufacturer**/
$selmanufacturer = "SELECT *  FROM tmanufacturer";
$option2 .=  "<option value=''>Please Select A Manufacturer</option>";
$selmanufacturer = $objConn1->Execute($selmanufacturer);
foreach ($selmanufacturer as $selmanufacturers):
        $option2 .= "<option value='".$selmanufacturers['ID']."'>".$selmanufacturers['Description']." </option>";
endforeach;
/**End Manufacturer**/

/**Begin Location**/
$sellocation = "SELECT *  FROM tlocation WHERE tlocation.branchID='".$_SESSION['UserValue2']."'";
$option3 .=  "<option value=''>Please Select A Location</option>";
$sellocation = $objConn1->Execute($sellocation);
foreach ($sellocation as $sellocations):
        $option3 .= "<option value='".$sellocations['ID']."'>".$sellocations['Description']." </option>";
endforeach;
/**End Location**/

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



 


/**Begin Category**/
$selcategory = "SELECT *  FROM tcategory  WHERE  tcategory.BranchID='".$_SESSION['UserValue2']."'";
$option7 .=  "<option value=''>Please Select A Category</option>";
$selcategory = $objConn1->Execute($selcategory);
foreach ($selcategory as $selcategorys):
        $option7 .= "<option value='".$selcategorys['ID']."'>".$selcategorys['Description']." </option>";
endforeach;
/**End Category**/

/**Begin Vendor**/
$selvendor = "SELECT *  FROM tvendor  WHERE  tvendor.BranchID='".$_SESSION['UserValue2']."'";
$option8 .=  "<option value=''>Please Select A Vendor</option>";
$selvendor = $objConn1->Execute($selvendor);
foreach ($selvendor as $selvendor):
        $option8 .= "<option value='".$selvendor['ID']."'>".$selvendor['Name']." </option>";
endforeach;
/**End Vendor**/

/**Unit of Measure **/
$selumea = "SELECT *  FROM tunitmeas  WHERE  tunitmeas.BranchID='".$_SESSION['UserValue2']."'";
$option9 .=  "<option value=''>Please Select Unit of Measure</option>";
$selumea = $objConn1->Execute($selumea);
foreach ($selumea as $selumeas):
        $option9 .= "<option value='".$selumeas['ID']."'>".$selumeas['Description']." </option>";
endforeach;
/**Unit of Mesure**/


$optionall = $option4.$option5.$option6;  



$TemplateText = Replace($TemplateText, "@department@", $option1);
$TemplateText = Replace($TemplateText, "@manufacturer@", $option2);
$TemplateText = Replace($TemplateText, "@location@", $option3);
$TemplateText = Replace($TemplateText, "@abacus@", $optionall);
$TemplateText = Replace($TemplateText, "@mental@", $optionall);
$TemplateText = Replace($TemplateText, "@supplementary@", $optionall);
$TemplateText = Replace($TemplateText, "@category@", $option7);
$TemplateText = Replace($TemplateText, "@vendor@", $option8);
$TemplateText = Replace($TemplateText, "@unitofmeas@", $option9);

if(isset($_POST['preva'])){
	$bookcodes = $_POST['preva'];
	$bookcodes = array('status' => $bookcodes);
	echo json_encode($bookcodes);

}


?>
