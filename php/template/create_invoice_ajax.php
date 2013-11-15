<?php
include('myclass.php'); 



if(isset($_POST['itemcode'])){
	if($_POST['qty'] == ''): $qty = '1'; else: $qty = $_POST['qty']; endif;
	$additems = $model->select_where2('titems', array('ItemNo' => $_POST['itemcode']));
	
	$taxable2 =   $_POST['taxable'];

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

	$discountdecimal = 0;

	if($_POST['discount'] !=""){
		$discountid = $_POST['discount'];
		$discount = $model->select_where2('tdiscount', array('Code' => $discountid)); 
		$discountdecimal = $discount->fields['Discount'] / 100;  
		
	}


	$discounted =  ($additems->fields['StdCost'] * $qty) * $discountdecimal;
	if($taxable2 == 'Yes'){
		
		$addtaxable =  ($additems->fields['StdCost'] * $qty) - $discounted ;
	}


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

	$discount_sum = array_sum($discountprice) +  $discounted;
	$totaltaxbles = array_sum($totaltaxble) + $addtaxable; 

	$compute_itemtaxable =  $totaltaxbles * ($taxrate->fields['Rate'] / 100);  
	$plus = $totaltaxbles;  
	$totalcost = array_sum($totalprice) +  ( $qty * $additems->fields['StdCost']);	
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
	//$model->insert_tbl('eorderhdr', $toinsert,1);



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
		//$model->insert_tbl('eorderdtl',$insertinto,1); 			
	   $totalprices[$x]  = $itemno_qty[$x] * $item_price[$x]; 
	}
	
	//$model->update_tbl('tsetup',array('InvoiceNo' => $orderno), array('BranchID' =>'PH001'), 1);

	
	$super = ($totalcost + $compute_itemtaxable) - $discount_sum ;
	$items = array('discount_id' => $discount->fields['Code'],'totaldiscount' => $discount_sum,  'discount_deci' => $discountdecimal,'discount' => $discount->fields['Discount'],  'super_tot' => $super, 'totaltaxble' => $plus, 'taxamt' => $compute_itemtaxable , 'totalcost' => $totalcost, 'taxable' => $_POST['taxable'], 'ItemNo' => $additems->fields['ItemNo'], 'Description' => $additems->fields['Description'], 'Price' => $additems->fields['StdCost'], 'Qty' => $qty );
	echo json_encode($items);

}


?>