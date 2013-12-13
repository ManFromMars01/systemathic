<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";

$table = $_GET['table'];
$id    = $_GET['id'];
$return = $_GET['return'];
if(isset($_GET['table'])){
	$model->delete_where($table,array('ID' => $id));
	header('Location:'.base_url('page/controller/browse_'.$return.'.php?status=success'));
	//$success = success('Delete Complete!! <a href="'.base_url('page/controller/browse_size.php').'">Back To Size List</a>');
}
