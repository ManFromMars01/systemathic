<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->update_tbl('tcollection',array('Code' => $_POST['code'], 'Description' => $_POST['description']), array('ID' => $_POST['id']));
	$success = success('Update Complete!! <a href="'.base_url('page/controller/browse_collection.php').'">Back To Collection List</a>');
}

// /$category = $model->select_table('tcategory');
$collections = $model->select_where('tcollection', array('ID' => $_GET['ID'] ));
include($default->template('header_view'));
include($default->main_view('update_collection_view'));?>
<?php include($default->template('footer_view'));?>