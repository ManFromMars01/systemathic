<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$teacherfile = $model->select_where('tteacher',array('LocalName' => $_SESSION['myname']));
$hey = $teacherfile->fields['LocalName'];
$teacher_no = $teacherfile->fields['ID'];
$teacherclass = $model->select_where('tclasssched',array('TeacherID1' => $teacher_no));

$roleid = array(6);
$cfranchisor = array(5); 

$reminder = $model->select_where('ereminder',array('TeacherID' => $_SESSION['UserID']));
$reminder_count = $model->count_where('ereminder',array('TeacherID' => $_SESSION['UserID']));

include($default->template('header_view'));
include($default->main_view('dashboard_view'));
include($default->template('footer_view'));
?>