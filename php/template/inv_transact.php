<?php 
	include('myclass.php'); 

	$itemcode = $_POST['itemno_inv'];
	$itemno_qty = $_POST['itemno_qty'];
	$item_price = $_POST['item_price'];
	$custno     = $_POST['custno'];
	$name      = $_POST['fname'];
	$paydate   = $_POST['paydate'];
	$taxid     = $_POST['taxtid']; 
	$taxable   = $_POST['item_taxable'];
	
	$item_discount = $_POST['item_discount'];
	
	$bankname  = $_POST['bankname'];
	$branchname = $_POST['branchname'];
	$remitamt   = $_POST['remit'];
	$checkno    = $_POST['CheckNo'];
	$checkdate  = $_POST['CheckDate'];
	$discount_id = $_POST['discount_id'];

	$yourcustomer = $model->select_where2('tcustomer',array('CustNo' => $custno));
	$taxrate = $model->select_where2('ttaxtab',array('TaxID' => $taxid));
	$count_item =  count($itemcode);
	$count_item = $count_item - 1;	
	for($x = 0; $x <=$count_item; $x++ ){
		 $discountprice[$x] = ($itemno_qty[$x] * $item_price[$x]) * $item_discount[$x];
		 $totalprice[$x]  = $itemno_qty[$x] * $item_price[$x];

		 if($taxable[$x] == "Yes"){
		 	$totaltaxble[$x] = $totalprice[$x] - $discountprice[$x] ; 
		 }
	}
	
	$discount_sum = array_sum($discountprice);
	$totaltaxbles = array_sum($totaltaxble); 
	$compute_itemtaxable =  $totaltaxbles * ($taxrate->fields['Rate'] / 100);  
	$plus = $totaltaxbles;  
	$totalcost = array_sum($totalprice);	
	$tsetup = $model->select_table2('tsetup');
	$orderno = $tsetup->fields['InvoiceNo'] + 1;



	$toinsert   = array(
		'CustNo' => $custno, 
		'Name'   => $name,
		'PayDate' => $paydate,
		'ItemTotal' =>  $totalcost,
		'ItemCost'  =>  $totalcost,
		'OrderTotal' => $totalcost + $compute_itemtaxable - $discount_sum ,
		'OrderBal' => $totalcost + $compute_itemtaxable - $discount_sum ,
		'OrderNo'  => $orderno,
		'CountryID'  => 'PH',
		'BranchID'   => 'PH001',
		'Date'       => date('Y-m-d'),
		'SalesTaxID' => $taxid,
		'SalesTaxRT'  => $taxrate->fields['Rate'],
		'SalesTaxAmt' => $compute_itemtaxable,
		'TaxableAmt' => $plus,
		'BankName'   => $bankname,
		'Branch'     => $branchname,
		'CheckNo'    => $checkno,
		'CheckDate'  => $checkdate,
		'RemitAmt'   => $remitamt,
		'DiscAmount'    => $discount_sum,

		); 
	$model->insert_tbl('eorderhdr', $toinsert,1);



	for($x = 0; $x <=$count_item; $x++ ){
	   $discountprices[$x] = ($itemno_qty[$x] * $item_price[$x]) * $item_discount[$x];
	   $insertinto = array(
	   	"CountryID" => "PH",
	   	"BranchID"  =>"PH001",
	   	"Date"      => date('Y-m-d'),
	   	"OrderNo"   => $orderno, 
	   	"CustNo"     => $custno,
	   	"Qnty"      => $itemno_qty[$x],
	   	"ItemNo"    => $itemcode[$x],
	   	"Price"     => $item_price[$x],
	   	"Amount"    => $itemno_qty[$x] * $item_price[$x],
	   	"SalesTax"   => $taxable[$x],
	   	"DiscountAmt" => $discountprices[$x],
	   	"DiscountRate" => $item_discount[$x] * 100,
	   	"DiscountID"  => $discount_id[$x],
	   	"TierCode"    => $yourcustomer->fields['TierID'] 

	   	);
		$model->insert_tbl('eorderdtl',$insertinto,1); 			
	   $totalprices[$x]  = $itemno_qty[$x] * $item_price[$x]; 
	}

	$model->update_tbl('tsetup',array('InvoiceNo' => $orderno), array('BranchID' =>$yourcustomer->fields['BranchID']), 1);

	$modfee  = $model->select_where2('eorderdtl', array('OrderNo' => $orderno, 'ItemNo' =>"MODFEE"));
	$bookfee  = $model->select_where2('eorderdtl', array('OrderNo' => $orderno, 'ItemNo' =>"BOOKFEE"));
	$regfee  = $model->select_where2('eorderdtl', array('OrderNo' => $orderno, 'ItemNo' =>"REGFEE"));
	$totalfees = $regfee->fields['Amount'] + $bookfee->fields['Amount']  + $modfee->fields['Amount'];
	$model->update_tbl('eatthead',array('InvoiceNo' => $orderno, 'Tuition' => $modfee->fields['Amount'] , 'BookFee' => $bookfee->fields['Amount'], 'OtherFee' => $regfee->fields['Amount'], 'Total' => $totalfees, 'Status' => "1"), array('CustNo' => $custno, 'TierID' => $yourcustomer->fields['TierID'] ), 1);

	if($yourcustomer->fields['Status'] !=  'Old'){
		$model->update_tbl('tcustomer',array('CustType' => 'For Admission',   'RegType' => 'For Kit Issuance'), array('CustNo' =>$custno), 1);
	} else {
		$model->update_tbl('tcustomer',array('CustType' => 'For Admission',    'RegType' => 'Admitted'), array('CustNo' =>$custno), 1);
	}

	$inv_details = array('total' => $totalcost, 'success' => 'Transaction Complete.. <a href="print_invoice/index.php?orderno='.$orderno.'">View/Print Generated Invoice</a>');
	echo json_encode($inv_details); 	


?>