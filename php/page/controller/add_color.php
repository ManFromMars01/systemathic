<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$success ="";
if(isset($_POST['save'])){
	$model->insert_tbl('tcolor',array('Code' => $_POST['code'], 'Description' => $_POST['description']));
	$success = success('Insert Complete!! Add More? or  <a href="'.base_url('page/controller/browse_color.php').'">Back To Color List</a>');
}

// /$category = $model->select_table('tcategory');
// /$color = $model->select_where('tcolor', array('ID' => $_GET['ID'] ));
include($default->template('header_view'));
include($default->main_view('add_color_view'));?>
<?php include($default->template('footer_view'));?>