<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$success = "";
$exam_desc = $model->select_where('eexamfile',array('EventID' => $_POST['event_num']));
$customer  = $model->customer_id($_POST['idnum']);

if(isset($_POST['submit_reg'])):
	$insert = array(
		'EventID' => $_POST['event_num'],
		'CountryID' => $_SESSION['UserValue1'],
		'BranchID' =>  $_SESSION['UserValue2'],
		'Date'     =>  $_POST['event_date'], 
		'CustNo'   =>  $customer->fields['CustNo'],
		'Categ'    =>  $_POST['mental'],
		'Categ2'   =>  $_POST['abacus'],
		'Categ3'   =>  $_POST['aural'],
		'Grade'    => $_POST['grade_men'],
		'Grade2'   => $_POST['grade_aba'],
		'Digit'    => $_POST['digit'], 
		'Number'   => $_POST['number'],
		//'MenFee'   => $_POST['teacher2'],
		//'AbaFee'   => $_POST['teacher1'],
		//'AurFee'   => $_POST['teacher3'],
		'TeacID'   => $_POST['teacher1'],
		'TeacID2'  => $_POST['teacher2'],
		'TeacID3'  => $_POST['teacher3'],
		'RmID'     => $_POST['room1'],
		'RmID2'    => $_POST['room2'],
		'RmID3'    => $_POST['room3'],
		'Remarks'  => $_POST['remarks']
		
	);
$model->insert_tbl('eexamreg',$insert);


endif;


include($default->template('header_view'));
include($default->main_view('register_student_exam_view'));
include($default->template('footer_view'));
?>