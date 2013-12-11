<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['stud_id'])):
	$customer = $model->select_where('tcustomer', array('StudentID' => $_POST['stud_id']));

	$name_local = $customer->fields['LSurname'].', '.$customer->fields['LFirstName']." ".$customer->fields['LMiddleName'];
	$success = array('name_local' => $name_local, 'dob' => $customer->fields['Birthday'], 'gender' => $customer->fields['Gender'],  
		'phone' => $customer->fields['Phone'],  'email' => $customer->fields['Email'], 'address1' => $customer->fields['Address'].", ".$customer->fields['City']
		);	
	echo json_encode($success);


endif;


?>