<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 


$req = $model->select_table('trequirements');

foreach($req as $reqs):
	$count = $model->count_where('echecklist',array('ReqID' => $reqs['ID'] , 'BranchID' => $_GET['id']));
	if($count != 1){
		$model->insert_tbl('echecklist',array('CountryID' => substr($_GET['id'], 0, 2),'BranchID' => $_GET['id'], 'ReqID' => $reqs['ID'] ));
	}
endforeach;	




$checklist = $model->select_where('echecklist',array('CountryID' => substr($_GET['id'], 0, 2),'BranchID' => $_GET['id'], ));

function description_check($checkid){
	$model = new Model;
	$desc =$model->select_where('trequirements',array('ID' => $checkid));
	echo $desc->fields['Description'];
}

function fieldtype_check($checkid){
	$model = new Model;
	$desc =$model->select_where('trequirements',array('ID' => $checkid));
	echo $desc->fields['FieldType'];
}
function fieldtype_checker($checkid){
	$model = new Model;
	$desc =$model->select_where('trequirements',array('ID' => $checkid));
	return $desc->fields['FieldType'];
}


include($default->template('header_view'));
include($default->main_view('requirements_view'));
include($default->template('footer_view'));


?>