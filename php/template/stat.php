

<?php 
	$admitted = $model->count_where('tcustomer', array('RegType' => 'Admitted'));

	$tcustomer = $model->select_where('tcustomer',array('RegType' => 'Admitted', 'BranchID' => $_SESSION['UserValue2'])); 
	$conx = 0;
	$notify = 0;
	foreach($tcustomer as $customers):

		$max = $model->max_where('eattdtl','SessionNo',array('CustNo' => $customers['CustNo']));
		$tot = $max - 2;
		$billing =  $model->select_where('eattdtl',array('CustNo' => $customers['CustNo'], 'SessionNo' => $tot )); 
		$billing_date = $billing->fields['Date']; 
		
		$duedate      =  date('Ymd',strtotime($billing_date . "+60 day")); 
		$billing_date =  date('Ymd',strtotime($billing_date)); 
		$date = date('Ymd'); 
		$date = date('Ymd',strtotime($date));


		//echo $billing_date."<br />";
		//echo $date."<br />";
		//echo "<br />";
		//echo date('Y-m-d',$billing_date);

		if( $date >= $billing_date && $date <= $duedate ){			
		//for billing continuing student
			$conx = $conx + 1;

		} elseif($date >= $duedate){
			//for ReEnrolee

		}
		
		if( $date == $billing_date){
			$notify = $notify + 1;
		}

	endforeach;
	
		
			
		
	

?>

<div class="sortable row-fluid">
				<a data-rel="tooltip" title="Enrolled Students" class="well span3 top-block" href="#">
					<span class="icon32"><img src="template/img/redicons/users.png"></span>
					<div>Enrolled Students</div>
					<div><?php echo $admitted; ?></div>
					<span class="notification">6</span>
				</a>

				<a data-rel="tooltip" title="For Billing" class="well span3 top-block" href="#">
					<span class="icon32"><img src="template/img/redicons/shopping_cart.png"></span>
					<div>For Billing</div>
					<div><?php echo $conx; ?></div>
					<span class="notification green"><?php echo $notify; ?></span>
				</a>

				<a data-rel="tooltip" title="For Examination" class="well span3 top-block" href="#">
					<span class="icon32"><img src="template/img/redicons/page_full.png"></span>
					<div>For Examination</div>
					<div>143</div>
					<span class="notification yellow">143</span>
				</a>
				
				<a data-rel="tooltip" title="Waiting List" class="well span3 top-block" href="#">
					<span class="icon32"><img src="template/img/redicons/clock.png"></span>
					<div>Waiting List</div>
					<div>25</div>
					<span class="notification red">12</span>
				</a>
</div>