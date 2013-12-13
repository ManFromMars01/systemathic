<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->insert_tbl('tcollection',array('Code' => $_POST['code'], 'Description' => $_POST['description']));
	$success = success('Insert Complete!! <a href="'.base_url('page/controller/browse_collection.php').'">Back To Collection List</a>');
}

// /$category = $model->select_table('tcategory');
//$collections = $model->select_where('tcollection', array('ID' => $_GET['ID'] ));
include($default->template('header_view'));
include($default->main_view('add_collection_view'));?>
<?php include($default->template('footer_view'));?>