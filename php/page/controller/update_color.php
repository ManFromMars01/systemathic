<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->update_tbl('tcolor',array('Code' => $_POST['code'], 'Description' => $_POST['description']), array('ID' => $_POST['id']));
	$success = success('Update Complete!! <a href="'.base_url('page/controller/browse_color.php').'">Back To Color List</a>');
}

$color = $model->select_where('tcolor', array('ID' => $_GET['ID'] ));
include($default->template('header_view'));
include($default->main_view('update_color_view'));?>
<?php include($default->template('footer_view'));?>