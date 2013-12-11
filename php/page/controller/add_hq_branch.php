<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$services = $model->select_where('tservices',array('CountryID' => 'def'));

$success = "";
$countryid = $_GET['countryid'];
$count = $model->count_where('tbranch',array('CountryID' => $countryid ));
$tot = $count + 1;
$id  =  str_pad($tot, 3, '0', STR_PAD_LEFT);

if(isset($_POST['save'])){	
	$service_role = $_POST['service'];

	$insert = array(
		'CountryID' => $_POST['countryid'],
		'BranchID' =>  $countryid."001-".$_POST['branch_code'],
		'Description' => $_POST['description'],
		'Address1' => $_POST['Address'],
		'Phone'    => $_POST['phone'],
		'Email'    => $_POST['email'],
		'Skype'	   => $_POST['skype'],
		'Contact'  => $_POST['contact'],
		'Sex'      => $_POST['gender'],
		'Activated' => '1',
		'HQOperation' => 'Yes',
	);

	$model->insert_tbl('tbranch',$insert);

	foreach($service_role as $service_roles):
		$model->insert_tbl('eservices',array('CountryID' => $_POST['countryid'], 'BranchID' =>$countryid."001-".$_POST['branch_code'], 'ServiceID' => $service_roles ));	
	endforeach;	
}




include($default->template('header_view'));
include($default->main_view('add_hq_branch_view'));
?>

<script>
	$('#countryid').change(function(){
		countryid = $(this).val();
		$('#countryids').val(countryid); 
	});

</script>


<?php include($default->template('footer_view'));?>