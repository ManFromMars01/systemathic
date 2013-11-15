<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$success = "";
if(isset($_POST['submit_event'])){

	$inserto =array(
		'CountryID' => $_SESSION['UserValue1'],
		'BranchID' => $_SESSION['UserValue2'], 
		'Event'    => $_POST['event_name'],	
		'Venue'    => $_POST['venue'],
		'Date'     => $_POST['event_date'],
		'TimeFrom' => $_POST['tfrom'],
		'TimeTo'   => $_POST['tto'],
		'OpenDate' => $_POST['open_date'],
		'SubmitDate' => $_POST['submit_date'],
		'CloseDate' => $_POST['close_date'],
		'MenFee'    => $_POST['menfee'],
		'AbaFee'   => $_POST['abafee'],
		'AurFee'   =>  $_POST['auralfee'],
		'Total'    => $_POST['menfee'] + $_POST['abafee'] + $_POST['auralfee'] 
	);



	$test= $model->insert_tbl('eexamfile', $inserto);
	$success = "<div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>×</button>
                <strong>Well done!</strong> You've successfully Add An Event. Add More or <a href='".base_url('page/controller/events_manager.php')."'>Back to Event list</a>
            </div>";

}


include($default->template('header_view'));
include($default->main_view('add_event_view'));
include($default->template('footer_view'));
?>