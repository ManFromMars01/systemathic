<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
if($_GET['countryid'] == "wearegreat0101"){
$branch =   $model->select_table('tbranch');
$master = "youaregreat";
}else{	
$branch =   $model->select_where('tbranch', array('CountryID' => $_SESSION['UserValue1']));
$master = "";
}
function branch_status($branch_status){
	 if($branch_status == 1 ){
	 	echo '<span class="label label-success">Activated</span>'; 
	 }elseif($branch_status == 2){
	 	echo '<span class="label label-important">Deactivated</span>'; 
	 } else{
	 	echo '<span class="label label-info">On-Process</span>'; 
	 } 
}

function button_requirements($branch_status,$branchid){
	echo "<a href='".base_url('page/controller/requirements.php?id='.$branchid)."' class='btn btn-info'>Requirements</a>";
}

function button_activation($branch_status,$branchid){
	if($branch_status != 1){
		echo "<a id='".$branchid."' alt='".$branchid."' href='#' class='btn btn-success activatethis'> Activate</a>";	
	} elseif($branch_status == 1){
		echo "<a id='".$branchid."' alt='".$branchid."' href='#' class='btn btn-danger dactivatethis'> DeActivate</a>";
	} 


}


include($default->template('header_view'));
include($default->main_view('browse_branches_view'));
include($default->template('footer_view'));
?>