<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable
	if(isset($_POST['event_id'])){
		$where = array('EventID' => $_POST['event_id']);
		$update =array(
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



		$test= $model->update_tbl('eexamfile', $update, $where);
		$success = "<div class='alert alert-success'>
	                <button type='button' class='close' data-dismiss='alert'>×</button>
	                <strong>Well done!</strong> You've successfully Edit An Event. Add More or <a href='".base_url('page/controller/events_manager.php')."'>Back to Event list</a>
	            </div>";

	     $status = array('success' => $success );        
 		 echo json_encode($status);

	}
?>
