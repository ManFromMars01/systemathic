<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['code'])):
	$class = $model->select_where('tclasssched',array('SchedCode' => $_POST['code']));
	
	$teacher = $model->select_where('tteacher',array('ID' =>  $class->fields['TeacherID1'] ));	
	$room    = $model->select_where('troom',array('ID' =>  $class->fields['RoomID'] ));
	$level    = $model->select_where('tlevel',array('ID' =>  $class->fields['LevelID'] ));
	$countme  = $model->count_where('eattdtl',array('SchedCode' => $_POST['code'],'Date' => $_POST['datetime']));
	if($countme == 0){
		$student = "No available Student";
	} else{
		$datetime  = $model->select_where('eattdtl',array('SchedCode' => $_POST['code'], 'Date' => $_POST['datetime']));
		foreach($datetime as $students):
			$customer = $model->select_where('tcustomer',array('CustNo' => $students['CustNo']));
			$student .= '<li>'.$customer->fields['SurName'].', '.$customer->fields['FirstName'].' '.$customer->fields['MiddleName'].'</li>';
		endforeach;	
	}

	$success = array('timess' => $class->fields['TimeFrom'].' - '.$class->fields['TimeTo'], 'teacher'=> $teacher->fields['Name'], 'datetime' => $_POST['datetime'], 'room' => $room->fields['Description'],'level' => $level->fields['Description'],'student'=>$student);
	echo json_encode($success);
	
endif;


?>