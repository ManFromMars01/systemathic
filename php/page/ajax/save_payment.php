<?php
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); 


if(isset($_POST['amount'])):
	$insert = array('BillingID' => $_POST['bilid'], 'PayDate'=> $_POST['date_rel'] , 'PayType' => $_POST['payment_type'], 'RemitAmt'=>$_POST['amount'], 'DocReference' => $_POST['image_name'], 'PaymentStatus' => '0');
	$model->insert_tbl('eroyaltypayment',$insert); 

	$date =date('Y-m-d H:i:s', strtotime($_POST['date_rel']));
	$paytype =  $model->paytype($_POST['payment_type']);
	$amount  =  $_POST['currency']." ".number_format($_POST['amount'],2);
	$link    =  base_url('page/ajax/'.$_POST['image_name']);





	$multiline = <<<EOT
		<tr>
            <td>$date</td>
            <td>$paytype</td>
            <td>$amount</td>
            <td><a href="$link" target="__blank" class="btn-info btn viewme" alt="">View </a></td>
            <td><span class="btn btn-info">For Validation</span></td>
      	</tr>
EOT;




	$success = array('success' => "Transaction Complete",  'yourhtml' => $multiline);
	echo json_encode($success);
endif;	

//echo json_encode(array('test' => 'test'));
?>