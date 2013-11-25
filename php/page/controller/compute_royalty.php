
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";

$country = $model->select_table('tcountry');
$branches_country = $model->select_where('tbranch',array('CountryID' => $_SESSION['UserValue1']));





include($default->template('header_view'));
include($default->main_view('compute_royalty_view'));
include($default->template('footer_view'));
?>