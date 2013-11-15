<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if($_GET['moveto'] == 'schedule'):
	$model->update_tbl('tcustomer', array('CustType' => 'For Admission', 'RegType' => 'For Schedule'), array('CustNo' => $_GET['custno']));	
	echo "<script>
		window.location = '".base_url('Updateeattheadadd.php?ID='.$_GET['custno'])."';
	</script>";
endif;

if($_GET['moveto'] == 'admission'):
	$model->update_tbl('tcustomer', array('CustType' => 'For Admission', 'RegType' => 'Waiting'), array('CustNo' => $_GET['custno']));	
	echo "<script>
		window.location = '".base_url('BrowseStudentlist3.php?CustType=Assessment&&Success=1')."';
	</script>";
endif;


?>