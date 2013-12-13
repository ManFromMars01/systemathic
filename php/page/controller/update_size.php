<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->update_tbl('tsize',array('Code' => $_POST['code'], 'Description' => $_POST['description'], 'CatID' => $_POST['category']), array('ID' => $_POST['id']));
	$success = success('Update Complete!! <a href="'.base_url('page/controller/browse_size.php').'">Back To Size List</a>');
}


$category = $model->select_table('tcategory');
$size = $model->select_where('tsize', array('ID' => $_GET['ID'] ));
include($default->template('header_view'));
include($default->main_view('update_size_view'));?>
<?php include($default->template('footer_view'));?>