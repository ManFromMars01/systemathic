<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here

$success = "";
$branchid = $_GET['id'];
$tcustomer = $model->select_where('tcustomer',array('CountryID' => $_SESSION['UserValue1']));

if(isset($_POST['save'])){	
	
	$update = array(
		'Description' => $_POST['branch_name'],		
		'Address1' => $_POST['address1'], 
		'Address2' => $_POST['address2'],
		'Phone'	   => $_POST['phone'],
		'Email'    => $_POST['email'],
		'Contact'  => $_POST['contact'],
		'HQOperation'   => $_POST['hq'],
		'DiscountType' => $_POST['disc_type'],
		'ItemDiscRateA' => $_POST['groupa'],
		'ItemDiscRateB' => $_POST['groupb'],
		'ItemDiscRateC' => $_POST['groupc'],
		'Skype'         => $_POST['skype'],
		'TrainingFee'   => $_POST['training_fee'],
		'FranchiseFee'  => $_POST['franchise_fee'],
		'FranchiseCost' => $_POST['franchise_cost'],
		'Commision'     => $_POST['commision']
	);
			
	$success = success();
	$model->update_tbl('tbranch',$update,array('BranchID' => $branchid));


}


include($default->template('header_view'));
include($default->main_view('edit_branch_view'));
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