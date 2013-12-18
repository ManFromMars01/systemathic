<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 

if(isset($_POST['collectionid'])){
	$design = $model->select_where('tdesign',array('ColCode' => $_POST['collectionid'] ));
	$selectbox = "<option value=''>Please Select A Design</option>";
	foreach($design as $designs):
		$selectbox .="<option value='".$designs['Code']."'>".$designs['Description']."</option>";
	endforeach; 
	$select = array('displayit' => $selectbox);
	echo json_encode($select);
}


?>