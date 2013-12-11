<?php
function not_logins(){
  if($_SESSION['AuthStatus'] != "Authorized"){
    header("Location: http://localhost/Final/php/login.html");
  }
}

class Myclass
{
	public function __construct()  
    {  
         
		
		
    }  

 	public function select_table($table){
 		include('ConnInfo.php');
		include('systemathicappdata.php');
 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);


 		$selectable = "SELECT * FROM ".$table;
 		$selectable = $objConn1->Execute($selectable);
 		return $selectable;
 		
 	}

	public function select_where($table, $where){
		include('ConnInfo.php');
		include('systemathicappdata.php');
		$selectable = "";
		$where2     = "";
 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  .= "SELECT * FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
		$objConn1->Close();
 		return $selectable;

	}

	public function count_where($table, $where){
		include('ConnInfo.php');
		include('systemathicappdata.php');
		$selectable = "";
		$where2     = "";
 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$selectable  .= "SELECT COUNT(*) AS MyCount FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
 		return $selectable->fields['MyCount'];

	}


	public function select_table2($table){
 		include('../ConnInfo.php');
		include('../systemathicappdata.php');
 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);


 		$selectable = "SELECT * FROM ".$table;
 		$selectable = $objConn1->Execute($selectable);
 		return $selectable;
 		
 	}


 	public function select_where2($table, $where){
		include('../ConnInfo.php');
		include('../systemathicappdata.php');
 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		$selectable = "";
		$where2     = "";

		$selectable  .= "SELECT * FROM ".$table;
		
		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}

		$selectable  .= " WHERE " .trim($where2, "AND ");
		$selectable = $objConn1->Execute($selectable);
		$objConn1->Close();
 		return $selectable;

	}



	public function insert_tbl($table,$toinsert,$external){
		
		if($external != 1){
			include('ConnInfo.php');
			include('systemathicappdata.php');
 		} else {
 		  include('../ConnInfo.php');
		  include('../systemathicappdata.php');
 		}



 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		$insertcolumn = "";
		$insertvalue = "";
		foreach($toinsert as $key => $value) {
  			$insertcolumn .= $key."," ;
  			$insertvalue  .= "'".$value."',";
		}
		
		$sql = "INSERT INTO ". $table." (".trim($insertcolumn, ',').") VALUES (".trim($insertvalue, ',').")";
		$objConn1->Execute($sql);
		//return $sql;
	} 




	public function update_tbl($table,$toupdate,$where,$external){
		
		if($external != 1){
			include('ConnInfo.php');
			include('systemathicappdata.php');
 		} else {
 		  include('../ConnInfo.php');
		  include('../systemathicappdata.php');
 		}



 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		$myupdate ="";
		$where2   = "";
		foreach($toupdate as $key => $value) {
  			$myupdate .= $key."= '".$value."',";
		}

		foreach($where as $key => $value) {
  			$where2 .= $key." = '".$value."' AND "; 
		}
		
		$sql = "UPDATE ".$table." SET ".trim($myupdate,",")." WHERE ".trim($where2, "AND ");
		$objConn1->Execute($sql);

	}

	public function select_count($table,$where){
		include('ConnInfo.php');
		include('systemathicappdata.php');
		
		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$where3 = "";


		foreach($where as $key => $value) {
  			$where3 .= $key." = '".$value."' AND "; 
		}
		$sql =  "SELECT COUNT(*) AS MyCount FROM " .$table. " WHERE " .trim($where3, "AND ");
		//$sql = "SELECT COUNT(*) AS countme FROM ".$table." WHERE ".trim($where3, "AND ");
		$test = $objConn1->Execute($sql);
		$mycount  = $test->fields['MyCount'];
		return $mycount;
	}

	public function select_count2($table,$where){
		include('../ConnInfo.php');
		include('../systemathicappdata.php');
		
		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);
		$where3 = "";
		foreach($where as $key => $value) {
  			$where3 .= $key." = '".$value."' AND "; 
		}
		$sql =  "SELECT COUNT(*) AS MyCount FROM " .$table. " WHERE " .trim($where3, "AND ");
		//$sql = "SELECT COUNT(*) AS countme FROM ".$table." WHERE ".trim($where3, "AND ");
		$test = $objConn1->Execute($sql);
		$mycount  = $test->fields['MyCount'];
		return $mycount;
	}


	public function yourlevel($levelid,$external){
		if($external != 1){
			include('ConnInfo.php');
			include('systemathicappdata.php');
 		} else {
 		  include('../ConnInfo.php');
		  include('../systemathicappdata.php');
 		}

 		$objConn1 = &ADONewConnection($Driver1);
		$objConn1->debug = $DebugMode;
		$objConn1->PConnect($Server1,$User1,$Password1,$db1);

		$sql = "SELECT * FROM tlevel WHERE ID ='".$levelid."'";
		$leveldesc = $objConn1->Execute($sql);
		$desc  = $leveldesc->fields['Description'];

		return $desc;
	}
	
	public function test($test){
		return $test;

	}

}




$model = new MyClass;


?>