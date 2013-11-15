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


	$taxrate = $model->select_where2('ttaxtab',array('TaxID' => $taxid));
	$count_item =  count($itemcode);
	$count_item = $count_item - 1;	
	for($x = 0; $x <=$count_item; $x++ ){
		 $totalprice[$x]  = $itemno_qty[$x] * $item_price[$x]; 
		 if($taxable[$x] == "Yes"){
		 	$totaltaxble[$x] = $item_price[$x]; 
		 }  	
	}

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
		'OrderTotal' => $totalcost + $compute_itemtaxable ,
		'OrderBal' => $totalcost + $compute_itemtaxable ,
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

		); 
	$model->insert_tbl('eorderhdr', $toinsert,1);



	for($x = 0; $x <=$count_item; $x++ ){

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
	   	);
		$model->insert_tbl('eorderdtl',$insertinto,1); 			
	   $totalprices[$x]  = $itemno_qty[$x] * $item_price[$x]; 
	}

	$model->update_tbl('tsetup',array('InvoiceNo' => $orderno), array('BranchID' =>'PH001'), 1);

	$inv_details = array('total' => $totalcost);
	echo json_encode($inv_details); 	


?>