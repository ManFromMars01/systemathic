<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 

$fieldname = $_POST['fieldname'];
$branch = $_POST['branchid'];

if(isset($fieldname)){
  $model->update_tbl('echecklist',array( 'DocPath' => $_POST['columnname']), array('BranchID' => $branch, 'ReqID' => $_POST['reqid'] ));
}

?>