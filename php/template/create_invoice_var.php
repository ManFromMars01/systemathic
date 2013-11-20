<?php 
$items = $model->select_table('titems');
$ttaxtab = $model->select_table('ttaxtab');
$custno = $_GET['CustNo']; 
$tdiscount = $model->select_table('tdiscount');
$customer = $model->select_where('tcustomer',array('CustNo' => $_GET['CustNo']));


foreach($tdiscount as $discounts):
	$optionsdis .="<option value='".$discounts['Code']."'>".$discounts['Description']."</option>"; 
endforeach;	


foreach ($ttaxtab as $ttaxtabs){
	$options .= "<option value='".$ttaxtabs['TaxID']."'>".$ttaxtabs['TaxID']."</option>"; 
}

foreach($items as $item):
	$itemcode .= $item['ItemNo'].",";
endforeach;	

$autocomplete = "[".$itemcode."]"; 
?>