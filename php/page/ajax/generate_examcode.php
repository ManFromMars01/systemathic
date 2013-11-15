<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['event_id'])):
	$events	= $model->select_where('eexamreg',array('EventID' => $_POST['event_id']));	
	$x = 0;
	$y = 0;
	$z = 0;
	

	foreach($events as $event):
		$examcode_mental = "";
		$examcode_abacus = "";
		$examcode_aural = "";

		if($event['Categ'] == "1"):
			$x  = $x + 1;
			$grade = str_pad($event['Grade'], 2, '0', STR_PAD_LEFT);
			$middle = "0";		
			$seatnumber = str_pad($x, 3, '0', STR_PAD_LEFT); 
			$examcode_mental =  $grade.$middle.$seatnumber;
		endif;

		if($event['Categ2'] == "1"):
			$y  = $y + 1;
			$grade = str_pad($event['Grade2'], 2, '0', STR_PAD_LEFT);
			$middle = "9";		
			$seatnumber = str_pad($y, 3, '0', STR_PAD_LEFT); 
			$examcode_abacus =  $grade.$middle.$seatnumber;
		endif;

		if($event['Categ3'] == "1"):
			$z = $z + 1;
			$digit  = str_pad($event['Digit'], 2, '0', STR_PAD_LEFT); 
			$number = str_pad($event['Number'], 2, '0', STR_PAD_LEFT);
			$seatnumber = str_pad($z, 2, '0', STR_PAD_LEFT); 
			$examcode_aural =  $digit.$number.$seatnumber;
		endif;

		$model->update_tbl('eexamreg',array('ExamCode' => $examcode_mental, 'ExamCode2' => $examcode_abacus, 'ExamCode3' => $examcode_aural),array('EventID' => $_POST['event_id'],'CustNo' => $event['CustNo'] ));

	endforeach;	
	$status = array('status'=>'Generate Complete'); 
	echo json_encode($status);
endif;


?>