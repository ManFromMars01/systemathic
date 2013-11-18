<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable



//variable and functions here
//$teachers =   $model->select_where('tteacher',array('CountryID' => 'PH'));
//$rooms =   $model->select_where('troom',array('CountryID' => 'PH'));

$students =   $model->select_where('tcustomer',array('CountryID' => 'PH' , 'RegType' => 'Admitted') );
$levelno = $students->fields['LevelID'];

$levels =   $model->select_where('tlevel',array('ID' => $levelno) );

foreach ($levels as $level):
	 $desc = $level['Description'];
endforeach;




include($default->template('header_view'));
include($default->main_view('student_schedule_view'));
include($default->template('footer_view'));
?>