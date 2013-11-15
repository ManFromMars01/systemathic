<?php 

include('myclass.php');

 $itemno = $_POST['itemno']; 
 $description = $_POST['description'];
 $type        = $_POST['itemtype'];
 $cat         = $_POST['bookcategory'];

 $count = count($itemno) - 1;

 for($x = 0 ; $x <= $count; $x++ ){

 	if($type[$x] == "Yes"){
 		$typest = "1";
 	} else{
 		$typest = "0";
 	}

 	$toinsert = array(
		'CountryID' => $_POST['CountryID'], 
		'BranchID'  => $_POST['BranchID'],
		'CustNo'    => $_POST['CustNo'],
		'LevelID'   => $_POST['LevelID'],
		'ItemNo'    => $itemno[$x],
		'Description' => $description[$x],
		'ItemType'  => $typest,
		'Qty'         => '1',
		'DateIssue'   => date('Y-m-d'),
		'IsKit'       => '1',
		'BookCount'   => '1',
		'BookCategory' => $cat[$x],
		'Status'       => 'Current'  
		);	
 	$model->insert_tbl('ebooks',$toinsert,1);
}


$setup = $model->select_where2('tsetup',array('BranchID' => $_POST['BranchID']));
$studentcount  = $setup->fields['StudentCnt'] + 1;
// tsetup updateitng
$where1   =  array('BranchID' => $_POST['BranchID']);
$toupdate1 = array('StudentCnt' => $studentcount);
$model->update_tbl('tsetup',$toupdate1,$where1,1);




$invID = str_pad($studentcount, 4, '0', STR_PAD_LEFT);
$studentID =  $_POST['BranchID'] . $invID;













$where   =  array('CustNo' => $_POST['CustNo'], 'BranchID' => $_POST['BranchID']);

$tcustomers = $model->select_where2('tcustomer',$where);

if($tcustomers->fields['StudentID'] == ""):
$toupdate = array('Regtype' => 'Admitted', 'StudentID' => $studentID);
else:
$toupdate = array('Regtype' => 'Admitted');
endif;


$return = $model->update_tbl('tcustomer',$toupdate,$where,1);







$myStatus = array('status' => 'Transaction Complete.');
echo json_encode($myStatus);

?>