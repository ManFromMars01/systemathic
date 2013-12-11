<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_POST['paymentid'])):
	if($_POST['valid'] == 'valid'){
		$model->update_tbl('eroyaltypayment',array('PaymentStatus' => '1'), array('PaymentID' => $_POST['paymentid']));

		$payment =$model->select_where('eroyaltypayment',array('PaymentID' => $_POST['paymentid'], 'PaymentStatus' => '1'));
		$total = $model->select_where('ehroyalty', array('BillingID' => $payment->fields['BillingID']));

		$remit =$model->sum_where('eroyaltypayment',array('PaymentID' => $_POST['paymentid'], 'PaymentStatus' => '1'));
		$total = $total->fields['TotalAmount'];

		$balance =  $total - $remit;

		if($balance > 0 ){
			$model->update_tbl('ehroyalty',array('Status' => '2', 'RemitAmt' => $remit, 'Balance' => $balance ), array('PaymentID' => $_POST['paymentid']));

		
		}elseif($balance <= 0){
			$model->update_tbl('ehroyalty',array('Status' => '1', 'RemitAmt' => $remit, 'Balance' => $balance ), array('PaymentID' => $_POST['paymentid']));

		}


		$success = array('status'=> 'Success');
		echo json_encode($success);
	}
	if($_POST['valid'] == 'invalid'){
		$model->update_tbl('eroyaltypayment',array('PaymentStatus' => '2'), array('PaymentID' => $_POST['paymentid']));
		$success = array('status'=> 'Success');
		echo json_encode($success);
	}
endif;


?>