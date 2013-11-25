
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



$branchif  = $model->select_where('tbranch', array('CountryID' => $country, 'BranchID' => $branch));
$allroyalty  =$model->select_table('troyalty');

//FORUNIT CENTER
if($branchif->fields['HQOperation'] == 'No' && $branchif->fields['HQCenterOperation'] == 'No'){

	foreach($allroyalty as $all): //start royalty
		$transaction  = $model->select_where('eorderdtl', array('CountryID' => $country, 'BranchID' =>$branch, 'ItemNo' => $all['Source'] ));
		//$transaction = $model->select_where('eatthead', array('CountryID' => $country));

		foreach($transaction as $transact):
			$mydate = $transact['Date'];
			$monthinv  = date('m',strtotime($mydate));
			$yearinv   = date('Y',strtotime($mydate));
			
			if($monthinv == $month && $year == $yearinv){
			 	$totalroyal  = $totalroyal +  $transact['Amount'];  // for royalty
			}

		


			$royalty = $model->select_where('troyalty',array('ID' => $all['ID'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltyhq  = $totalroyal * ($royalty->fields['Percent'] / 100);
			$royaltymaster = $royaltyhq  * ( $royalty->fields['PctToMaster']  / 100);
		 

		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => $country));
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
		 	//'TotRoyaltyAmt'    =>  $royaltymaster + $royaltyhq,
		 	'TotRoyaltyAmtForeign' =>  ($royaltymaster) / $result,

		 );

		 
		 $model->insert_tbl('eroyalty',$toinsert);


		 $royaltymaster = 0;
		 $hqtomaster   = 0;
		 $totalroyal2 = 0;
		 $totalroyal  = 0;
		endforeach;  				

	endforeach; //end royalty 

	$toinsert2 = array(
	 	'BillingDate' => date('Y-m-d'),
	 	'DueDate'     => "",
	 	'CountryID'   => $country,
	 	'BranchID'    => $branch,
	 	'TotalAmount' => $totalroyalty,
	 	'PayTo'       => "Master",
	 	'Status'      => "5",
	 	'AppMonth'    => $month,
	 	'Year'        => $year
	 	);


	$model->insert_tbl('ehroyalty', $toinsert2);



} 

	//for HQCENTEROPERATION
elseif($branchif->fields['HQCenterOperation'] == 'Yes'){ 




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

		


			$royalty = $model->select_where('troyalty',array('ID' => $all['ID'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltymaster  = $totalroyal * ($royalty->fields['Percent'] / 100);
			//$royaltymaster = $royaltyhq  * ( $royalty->fields['PctToMaster']  / 100);
		 

		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => $country));
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

elseif($branchif->fields['HQOperation'] == 'Yes'){

	

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


			$royalty = $model->select_where('troyalty',array('ID' => $all['ID'])); 
 
			$royaltyid  = $royalty->fields['ID'];
			$royaltyhq  = $totalroyal * ($royalty->fields['Percent'] / 100);
			$royaltymaster = $royalthq * ( $royalty->fields['PctToMaster']  / 100); // all unit *.18   * .18
		 	$hqtomaster  =  $totalroyal2 *  ( $royalty->fields['Percent']  / 100);   // hq * .18


		 	$froms = $model->select_where('tcurrency', array('Symbol' => $currency));
		 	$fromcurr =  array($froms->fields['Symbol'], $froms->fields['Description']);
		 	$tos = $model->select_where('tcurrency', array('CountryID' => $country));
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

		 $totalroyalty	 =  $totalroyalty  + $royaltymaster + $hqtomaster;  

		 $model->insert_tbl('eroyalty',$toinsert);


		 echo '<br /><br /><br />';
		 var_dump($toinsert);

		 $royaltymaster = 0;
		 $hqtomaster   = 0;
		 $totalroyal2 = 0;
		 $totalroyal  = 0;
		endforeach;  				

	endforeach; //end royalty 


	$toinsert2 = array(
	 	'BillingDate' => date('Y-m-d'),
	 	'DueDate'     => "",
	 	'CountryID'   => $country,
	 	'BranchID'    => $branch,
	 	'TotalAmount' => $totalroyalty,
	 	'PayTo'       => "Master",
	 	'Status'      => "5",
	 	'AppMonth'    => $month,
	 	'Year'        => $year
	 	);

	$model->insert_tbl('ehroyalty', $toinsert2);

}    


include($default->template('header_view'));
include($default->main_view('compute_royalty_result_view'));
include($default->template('footer_view'));
?>