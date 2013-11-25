<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$country = $_GET['countryid'];
$year  = '2013';
$month = '11';


$branchhq = $model->select_where('tbranch', array('HQOperation' => 'Yes', 'CountryID' => $country ));
$branches = $model->select_where('tbranch', array('HQOperation' => 'No', 'HQCenterOperation' => 'No', 'CountryID' => $country ));





include($default->template('header_view'));
include($default->main_view('franchisee_royalty_view'));
include($default->template('footer_view'));
?>