<?php
Class Model{

	function __construct(){

	}

	public function select_table($table){
	   	include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
       	$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		$selectable = "SELECT * FROM ".$table;
 		$selectable = $objConn1->Execute($selectable);
 		return $selectable;
	}


	public function select_where($table, $where){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  = "SELECT * FROM ".$table;
		$where2 = "";
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
		$objConn1->Close();
 		return $selectable;

	}

	public function delete_where($table, $where){
		$selectable ="";
		$where2 = "";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  .= "DELETE FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$objConn1->Execute($selectable);

	}

	public function count_where($table, $where){
		$selectable ="";
		$where2 = "";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1); 
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  .= "SELECT COUNT(*) AS MyCount FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
 		return $selectable->fields['MyCount'];

	}

	public function sum_where($table, $column, $where){
		$selectable ="";
		$where2 = "";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1); 
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  .= "SELECT SUM(". $column.") AS MyCount FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
 		return $selectable->fields['MyCount'];

	}

	public function insert_tbl($table,$toinsert){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);	
		$insertcolumn = "";
		$insertvalue= ""; 	
		foreach($toinsert as $key => $value) {
  			$insertcolumn .= $key."," ;
  			$insertvalue  .= "'".$value."',";
		}
		$sql = "INSERT INTO ". $table." (".trim($insertcolumn, ',').") VALUES (".trim($insertvalue, ',').")";
		$objConn1->Execute($sql);
		//return $sql;
	} 




	public function update_tbl($table,$toupdate,$where){
		$myupdate ="";
		$where2 = "";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		foreach($toupdate as $key => $value) {
  			$myupdate .= $key."= '".$value."',";
		}
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}
		$sql = "UPDATE ".$table." SET ".trim($myupdate,",")." WHERE ".trim($where2, "AND ");
		$objConn1->Execute($sql);

	}


/*** Just for Systemayhic****/
	public function customer_det($customer_number){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tcustomer WHERE CustNo ='".$customer_number."'";
		$customer =  $objConn1->Execute($sql);
		return $customer; 
	}

	public function customer_id($customer_number){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tcustomer WHERE StudentID ='".$customer_number."'";
		$customer =  $objConn1->Execute($sql);
		return $customer; 
	}

	public function yourlevel($levelid){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tlevel WHERE ID ='".$levelid."'";
		$leveldesc = $objConn1->Execute($sql);
		$desc  = $leveldesc->fields['Description'];
		return $desc;
	}

	public function yourroom($roomid){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM troom WHERE ID ='".$roomid."'";
		$roomdesc = $objConn1->Execute($sql);
		$desc  = $roomdesc->fields['Description'];
		return $desc;
	}

	public function att_stat($id){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tastatus WHERE ID ='".$id."'";
		$adesc = $objConn1->Execute($sql);
		$desc  = $adesc->fields['Description'];
		echo $desc;
	}

	public function teacher(){
		$option ="";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tteacher WHERE CountryID = '".$_SESSION['UserValue1']."'";
		$teacher = $objConn1->Execute($sql);
		foreach($teacher as $teachers):
			$option .= "<option value='".$teachers['ID']."'>".$teachers['Name']."</option>";		
		endforeach;	
		echo $option;
	}

	public function rooms(){
		$option ="";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM troom WHERE CountryID = '".$_SESSION['UserValue1']."'";
		$room = $objConn1->Execute($sql);
		foreach($room as $rooms):
			$option .= "<option value='".$rooms['ID']."'>".$rooms['Description']."</option>";		
		endforeach;	
		echo $option;
	}


	public function parent(){
		$option ="";
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tcustomer WHERE CountryID = '".$_SESSION['UserValue1']."'";
		$parent = $objConn1->Execute($sql);
		
		foreach($parent as $parents):
			$option .= "<option value='".$parents['Father']."'>".$parents['Father']."</option>";
			$option .= "<option value='".$parents['Mother']."'>".$parents['Mother']."</option>";			
		endforeach;	

		echo $option;
	}


	public function branch($branchid){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tbranch WHERE BranchID ='".$branchid."'";
		$roomdesc = $objConn1->Execute($sql);
		$desc  = $roomdesc->fields['Description'];
		echo $desc;	

	}

	public function royaltydesc($id){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		//$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM troyalty WHERE ID ='".$id."'";
		$roomdesc = $objConn1->Execute($sql);
		$desc  = $roomdesc->fields['Description'];
		echo $desc;	

	}

	public function country($countryid){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		////$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tcountry WHERE ID ='".$countryid."'";
		$roomdesc = $objConn1->Execute($sql);
		$desc  = $roomdesc->fields['Description'];
		echo  $desc;	

	}

	public function currencys($countryid){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		////$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tcurrency WHERE CountryID ='".$countryid."'";
		$roomdescs = $objConn1->Execute($sql);
		$desc  = $roomdescs->fields['Symbol'];
		return  $desc;	
	}

	public function paytype($pay){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		////$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tpaytype WHERE PayType ='".$pay."'";
		$roomdescs = $objConn1->Execute($sql);
		$desc  = $roomdescs->fields['Description'];
		return  $desc;	
	}

	public function items($itemno){
		include('../../ConnInfo.php');
		include('../../systemathicappdata.php');
 		$objConn1 = ADONewConnection($Driver1);
		////$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM titems WHERE ItemNo ='".$itemno."'";
		$roomdescs = $objConn1->Execute($sql);
		return  $roomdescs;	
	}



	

}




$model = new Model;

?>