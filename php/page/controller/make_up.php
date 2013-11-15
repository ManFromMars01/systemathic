<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable


if(isset($_GET['sched_rcode'])){
	$schedcode = $_GET['sched_code'];
	$new_sched= $model->select_where('tclasssched',array('SchedCode' => $schedcode));
	$customer = $model->customer_det($_GET['cust_no']);

	$to_update = array(
		'MakeUpDate'  => $_GET['date'],
		'TimeFrom'    => $new_sched->fields['TimeFrom'],
		'TimeTo'      => $new_sched->fields['TimeTo'], 
		'TeacherID'   => $new_sched->fields['TeacherID1'],
		'RmID'        => $new_sched->fields['RoomID'],
		'SchedCode'   => $new_sched->fields['SchedCode'],
		'StatusID'    => '1',  
		);

	$model->update_tbl('eattdtl',$to_update,array('CustNo' => $_GET['cust_no'], 'Date' => $_GET['date_recent'], 'SchedCode' => $_GET['sched_rcode']));
	echo "<script>window.location = '".base_url('attendance_view.php?student_no='.$customer->fields['StudentID'].'&success=1')."'</script>";
}


//variable and functions here
$customer = $model->customer_det($_GET['cust_no']);
//$schedule = $model->select_where('tclasssched',array('BranchID' => $_SESSION['UserValue2'], 'LevelID' => $customer->fields['LevelID']));





include($default->template('header_view'));
include($default->main_view('make_up_view'));
include($default->template('footer_view'));
?>