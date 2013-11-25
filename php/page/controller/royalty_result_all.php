
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";


$month   = '11';
$year    = '2013';
$currency = 'USD';



$branchif  = $model->select_table('tbranch');



foreach($branchif as $branches):

$country = $branches['CountryID'];
$branch  = $branches['BranchID'];




//FORUNIT CENTER
if($branches['HQOperation'] == 'No' && $branches['HQCenterOperation'] == 'No'){
	$allroyalty  =$model->select_table('troyalty');

	foreach($allroyalty as $all): //start royalty
		$transaction  = $model->select_where('eorderdtl', array('CountryID' => $country, 'BranchID' =>$branch, 'ItemNo' => $all['Source'] ));
		//$transaction = $model->select_where('eatthead', array('CountryID' => $country));

		foreach($transaction as $transact):
			$mydate = $transact['Date'];
			$monthinv  = date('m',strtotime($mydate));
			$yearinv   = date('Y',strtotime($mydate));
			
			if($monthinv == $month && $year == $yearinv){
			 	$totalroyal  = $totalroyal +  $transact['Amount']; 
			}

		


			$royalty = $model->select_where('troyalty',array('Source' => $all['Source'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltyhq  = $totalroyal * ($royalty->fields['Percent'] / 100);
			$royaltymaster = $royaltyhq  * ( $royalty->fields['PctToMaster']  / 100);
		 

		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => 'PH'));
		 	$tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 	$result = currencyExchange('1',$fromcurr,$tocurr);

		 	$toinsert = array(
		 	'Date'      => date('Y-m-d'),	
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royaltyid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' =>$totalroyal,
		 	'PercentToHQ'   =>  '',
		 	'PercentToMstr' => $royalty->fields['PctToMaster'],
		 	'CtrRoyaltyToHQ' =>  $royaltyhq,
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster) / $result,

		 );

		 $model->insert_tbl('eroyalty',$toinsert);

		 $royaltymaster = 0;
		 $hqtomaster   = 0;
		 $totalroyal2 = 0;
		 $totalroyal  = 0;
		endforeach;  				

	endforeach; //end royalty 



} 

	//for HQCENTEROPERATION
elseif($branches['HQCenterOperation'] == 'Yes'){ 


	$allroyalty  =$model->select_table('troyalty');

	foreach($allroyalty as $all): //start royalty
		$transaction  = $model->select_where('eorderdtl', array('CountryID' => $country, 'BranchID' =>$branch, 'ItemNo' => $all['Source'] ));
		//$transaction = $model->select_where('eatthead', array('CountryID' => $country));

		foreach($transaction as $transact):
			$mydate = $transact['Date'];
			$monthinv  = date('m',strtotime($mydate));
			$yearinv   = date('Y',strtotime($mydate));
			
			if($monthinv == $month && $year == $yearinv){
			 	$totalroyal  = $totalroyal +  $transact['Amount']; 
			}

		


			$royalty = $model->select_where('troyalty',array('Source' => $all['Source'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltymaster  = $totalroyal * ($royalty->fields['Percent'] / 100);
			//$royaltymaster = $royaltyhq  * ( $royalty->fields['PctToMaster']  / 100);
		 

		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => 'PH'));
		 	$tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 	$result = currencyExchange('1',$fromcurr,$tocurr);

		 	$toinsert = array(
		 	'Date'      => date('Y-m-d'),	
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royaltyid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' =>$totalroyal,
		 	'PercentToHQ'   =>  '',
		 	'PercentToMstr' => $royalty->fields['PctToMaster'],
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster) / $result,

		 );

		 $model->insert_tbl('eroyalty',$toinsert);

		 $royaltymaster = 0;
		 $hqtomaster   = 0;
		 $totalroyal2 = 0;
		 $totalroyal  = 0;
		endforeach;  				

	endforeach; //end royalty 
}



//FOR HQ

elseif($branches['HQOperation'] == 'Yes'){

	$allroyalty  =$model->select_table('troyalty');

	foreach($allroyalty as $all): //start royalty
		$transaction  = $model->select_where('eorderdtl', array('CountryID' => $country, 'ItemNo' => $all['Source'] ));
		//$transaction = $model->select_where('eatthead', array('CountryID' => $country));

		foreach($transaction as $transact):
			if($transact['BranchID'] != $branch){

				$mydate = $transact['Date'];
				$monthinv  = date('m',strtotime($mydate));
				$yearinv   = date('Y',strtotime($mydate));
				
				if($monthinv == $month && $year == $yearinv){
				 	$totalroyal  = $totalroyal +  $transact['Amount']; 
				}

			} elseif($transact['BranchID'] == $branch){
				$mydate2 = $transact['Date'];
				$monthinv2  = date('m',strtotime($mydate2));
				$yearinv2  = date('Y',strtotime($mydate2));
				if($monthinv2 == $month && $year == $yearinv2){
				 	$totalroyal2 = $totalroyal2 +  $transact['Amount']; 
				}

			}


			$royalty = $model->select_where('troyalty',array('Source' => $all['Source'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltyhq  = $totalroyal * ($royalty->fields['Percent'] / 100);
			$royaltymaster = $royalthq * ( $royalty->fields['PctToMaster']  / 100);
		 	$hqtomaster  =  $totalroyal2 *  ( $royalty->fields['Percent']  / 100);


		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => 'PH'));
		 	$tocurr =  array($tos->fields['Symbol'], $tos->fields['Description']);
		 	$result = currencyExchange('1',$fromcurr,$tocurr);

		 	$toinsert = array(
		 	'Date'      => date('Y-m-d'),	
		 	'CountryID' => $country,
		 	'BranchID'  => $branch,
		 	'RoyaltyID' => $royaltyid, 	
		 	'Month'     => $month,
		 	'Year'      => $year,
		 	'CurrencyID' => $currency,  	
		 	'CurrencyRate' => $result,
		 	'ForRoyaltyAmt' =>$totalroyal2,
		 	'ForRoyaltyAmtAllUF' =>  $totalroyal,
		 	'PercentToHQ'   =>  '',
		 	'PercentToMstr' => $royalty->fields['PctToMaster'],
		 	'RoyaltyAmtOfHQCtr' =>  $hqtomaster,
		 	'CtrRoyaltyToHQ' =>  '',
		 	'CtrRoyaltyToMstr' =>  $royaltymaster,
		 	'TotRoyaltyAmt'    =>  $royaltymaster + $hqtomaster ,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster + $hqtomaster) / $result,

		 );

		 $model->insert_tbl('eroyalty',$toinsert);

		 $royaltymaster = 0;
		 $hqtomaster   = 0;
		 $totalroyal2 = 0;
		 $totalroyal  = 0;
		endforeach;  				

	endforeach; //end royalty 

}    


endforeach;



?>