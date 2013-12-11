<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$success = "";
if(isset($_POST['save'])){

	$insert = array(
		'Address1' => $_POST['address1'], 
		'Address2' => $_POST['address2'],
		'Phone'	   => $_POST['phone'],
		'Email'    => $_POST['email'],
		'Contact'  => $_POST['contact'],
		'Master'   => 'No',
		'DiscountType' => $_POST['disc_type'],
		'ItemDiscRateA' => $_POST['groupa'],
		'ItemDiscRateB' => $_POST['groupb'],
		'ItemDiscRateC' => $_POST['groupc']
	);
			
	$model->update_tbl('tcountry',$insert, array('ID' => $_POST['countryid']));
	$success = success();
}



$country = $model->select_where('tcountry', array('ID'=>$_GET['countryid']));






include($default->template('header_view'));
include($default->main_view('edit_country_view'));
?>

<script>
	$('#countryid').change(function(){
		countryid = $(this).val();
		$('#countryids').val(countryid); 
	});
</script>


<?php include($default->template('footer_view'));?>