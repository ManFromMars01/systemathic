<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->insert_tbl('tsize',array('Code' => $_POST['code'], 'Description' => $_POST['description'], 'CatID' => $_POST['category']));
	$success = success('Insert Complete!! <a href="'.base_url('page/controller/browse_size.php').'">Back To Size List</a>');
}


$category = $model->select_table('tcategory');
include($default->template('header_view'));
include($default->main_view('add_size_view'));?>
<?php include($default->template('footer_view'));?>