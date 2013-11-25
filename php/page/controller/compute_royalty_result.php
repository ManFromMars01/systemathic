
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";

$country = $_POST['country'];
$branch  = $_POST['branch'];
$month   = $_POST['month'];
$year    = $_POST['year'];
$currency = $_POST['currencyfrom'];



$branchif  = $model->select_where('tbranch', array('CountryID' => $country, 'BranchID' => $branch));

if($branchif->fields['HQOperation'] == 'No' && $branchif->fields['HQCenterOperation'] == 'No'){
	$transaction = $model->select_where('eatthead', array('CountryID' => $country, 'BranchID' => $branch));
	$totaltuition = 0;

	foreach($transaction as $transact):
		 $mydate = $transact['InvoiceDate'];
		 $monthinv  = date('m',strtotime($mydate));
		 $yearinv   = date('Y',strtotime($mydate));
		 if($monthinv == $month && $year == $yearinv){
		 	$totaltuition = $totaltuition +  $transact['Tuition']; 
		 }
	endforeach;  


	 $royalty = $model->select_where('troyalty',array('Source' => 'Tuition Fee')); 	

	 foreach($royalty as $royal ): 
	 	 $royalid  = $royal['ID']; 					
		 $royalthq = $totaltuition * ( $royal['Percent']  / 100);
		 $royaltymaster = $royalthq * ( $royal['PctToMaster']  / 100);

		 $froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 $fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);

		 $tos = $model->select_where('tcurrency', array('CountryID' => $country));
		 $tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 
		 $result = currencyExchange('1',$fromcurr,$tocurr);


		 $toinsert = array(
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royalid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' => $totaltuition,
		 	'PercentToHQ'   =>  $royal['Percent'],
		 	'PercentToMstr' => $royal['PctToMaster'],
		 	'CtrRoyaltyToHQ' =>  $royalthq,
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster + $royalthq,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster) / $result,

		 );


		 $model->insert_tbl('eroyalty',$toinsert);	
 	endforeach;

} elseif($branchif->fields['HQCenterOperation'] == 'Yes'){


	$transaction = $model->select_where('eatthead', array('CountryID' => $country, 'BranchID' => $branch));
	$totaltuition = 0;

	foreach($transaction as $transact):
		 $mydate = $transact['InvoiceDate'];
		 $monthinv  = date('m',strtotime($mydate));
		 $yearinv   = date('Y',strtotime($mydate));
		 if($monthinv == $month && $year == $yearinv){
		 	$totaltuition = $totaltuition +  $transact['Tuition']; 
		 }
	endforeach;  


	 $royalty = $model->select_where('troyalty',array('Source' => 'Tuition Fee')); 	

	 foreach($royalty as $royal ): 
	 	 $royalid  = $royal['ID']; 					
		 //$royalthq = $totaltuition * ( $royal['Percent']  / 100);
		 $royaltymaster = $totaltuition * ( $royal['PctToMaster']  / 100);

		 $froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 $fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);

		 $tos = $model->select_where('tcurrency', array('CountryID' => $country));
		 $tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 
		 $result = currencyExchange('1',$fromcurr,$tocurr);


		 $toinsert = array(
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royalid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' => $totaltuition,
		 	'PercentToHQ'   =>  '',
		 	'PercentToMstr' => $royal['PctToMaster'],
		 	'CtrRoyaltyToHQ' =>  '',
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster) / $result,

		 );


		 $model->insert_tbl('eroyalty',$toinsert);	
 	endforeach;



}


elseif($branchif->fields['HQOperation'] == 'Yes'){

	$transaction = $model->select_where('eatthead', array('CountryID' => $country));
	$totaltuition = 0;
	$totaltuition2 = 0;
	foreach($transaction as $transact):
		if($transact['BranchID'] != $branch){
			$mydate = $transact['InvoiceDate'];
			$monthinv  = date('m',strtotime($mydate));
			$yearinv   = date('Y',strtotime($mydate));
			if($monthinv == $month && $year == $yearinv){
			 	$totaltuition = $totaltuition +  $transact['Tuition']; 
			}
		} elseif($transact['BranchID'] == $branch){
			$mydate2 = $transact['InvoiceDate'];
			$monthinv2  = date('m',strtotime($mydate2));
			$yearinv2  = date('Y',strtotime($mydate2));
			if($monthinv2 == $month && $year == $yearinv2){
			 	$totaltuition2 = $totaltuition2 +  $transact['Tuition']; 
			}

		}

		 
	endforeach;  


	 $royalty = $model->select_where('troyalty',array('Source' => 'Tuition Fee')); 	

	 foreach($royalty as $royal ): 
	 	 $royalid  = $royal['ID']; 					
		 $royalthq = $totaltuition * ( $royal['Percent']  / 100);
		 $royaltymaster = $royalthq * ( $royal['PctToMaster']  / 100);
		 $hqtomaster  =  $totaltuition2 *  ( $royal['Percent']  / 100);


		 $froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 $fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);

		 $tos = $model->select_where('tcurrency', array('CountryID' => $country));
		 $tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 
		 $result = currencyExchange('1',$fromcurr,$tocurr);


		 $toinsert = array(
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royalid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' =>$totaltuition2,
		 	'ForRoyaltyAmtAllUF' =>  $totaltuition,
		 	'PercentToHQ'   =>  '',
		 	'PercentToMstr' => $royal['PctToMaster'],
		 	'RoyaltyAmtOfHQCtr' =>  $hqtomaster,
		 	'CtrRoyaltyToHQ' =>  '',
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster + $hqtomaster ,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster + $hqtomaster) / $result,

		 );

		 $model->insert_tbl('eroyalty',$toinsert);	
 	endforeach;



}    







//$country = $model->select_table('tcountry');





include($default->template('header_view'));
include($default->main_view('compute_royalty_result_view'));
include($default->template('footer_view'));
?>