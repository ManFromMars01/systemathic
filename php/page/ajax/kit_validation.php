<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable

$levelkit = $model->count_where('tkitpack',array('LevelID' => $_POST['levelid'], 'ItemNo' => $_POST['itemno'], 'BranchID' => $_SESSION['UserValue2'] ));
$levlcount = $model->count_where('tkitpack',array('LevelID' => $_POST['levelid'], 'BranchID' => $_SESSION['UserValue2']));
if($levelkit >= 1){
	$status = array('status' => '0','itemno' => $_POST['itemno'], 'countme'=> $levlcount );
	echo json_encode($status);
}else{
	$status = array('status' => '1',);
	echo json_encode($status);
}

?>