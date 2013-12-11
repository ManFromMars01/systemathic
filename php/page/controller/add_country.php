<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$country = $model->select_table('country');
$tcustomer= $model->select_table('tcustomer');


$success = "";

if(isset($_POST['save'])){
	$country = $model->select_where('country',array('id' => $_POST['countryid']));	

	$insert = array(
		'ID' => $_POST['countryid'],
		'Description' => $country->fields['name'],
		'Address1' => $_POST['address1'], 
		'Address2' => $_POST['address2'],
		'Phone'	   => $_POST['phone'],
		'Email'    => $_POST['email'],
		'Contact'  => $_POST['contact'],
		'Master'   => 'No',
		'DiscountType' => $_POST['disc_type'],
		'ItemDiscRateA' => $_POST['groupa'],
		'ItemDiscRateB' => $_POST['groupb'],
		'ItemDiscRateC' => $_POST['groupc'],
		

	);

	$insert2 = array(
		'CountryID' => $_POST['countryid'],
		'BranchID'  => $_POST['branch_code'],
		'Description' => $_POST['branch_name'],
		'Phone'       => $_POST['phone2'],
		'Email'       => $_POST['email2'],
		'Address1'    => $_POST['address1_new'],
		'Address2'    => $_POST['address2_new'],
		'TrainingFee'   => $_POST['training_fee'],
		'FranchiseFee'  => $_POST['franchise_fee'],
		'FranchiseCost' => $_POST['franchise_cost'],
		'Skype'         => $_POST['skype'],
		'Commission'     => $_POST['commision'],
		'Activated'      => '1'
	);
			

	$success = success();

	$model->insert_tbl('tcountry',$insert);
	$model->insert_tbl('tbranch',$insert2);


}


include($default->template('header_view'));
include($default->main_view('add_country_view'));
?>

<script>
	$('#countryid').change(function(){
		countryid = $(this).val();
		$('#countryids').val(countryid); 
		$('#branch_code').val(countryid + '001');
	});

	$('#student_id').change(function(){
		sid = $(this).val();

		$.ajax({
			url:"<?php echo base_url('page/ajax/student_ajax.php');?>",
			type:"post",
			data:{ stud_id:sid },
			dataType:'json',
			success:function(j){
				console.log(j);
				$('#name_local').val(j.name_local);
				$('#dob').val(j.dob);
				$('#gender').val(j.gender);
				$('#phone').val(j.phone);
				$('#email').val(j.email);
				$('#address1').val(j.address1);	
			}
		});	


	});

</script>


<?php include($default->template('footer_view'));?>