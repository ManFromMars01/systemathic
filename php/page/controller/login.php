<?php
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
$username = $_POST['username'];
$password = $_POST['password'];



if(isset($_POST['submit'])){
	$count = $model->count_where('tteacher', array('Username' => $username , 'Password' => $password ));
	$tteacher = $model->select_where('tteacher', array('Username' => $username , 'Password' => $password ));

	if($count == 1 ){
		if( $tteacher->fields['BranchID'] == $tteacher->fields['CountryID']."001"   ){
			$_SESSION['Role'] = "Main";
			$_SESSION['OrderHQ'] = "TW001";
		} else{
			$_SESSION['Role'] = "Franchisee";
			$_SESSION['OrderHQ'] = $tteacher->fields['CountryID'].'001';		
		}

		$_SESSION['UserValue1'] = $tteacher->fields['CountryID']; 
		$_SESSION['UserValue2'] = $tteacher->fields['BranchID'];
		$_SESSION['myname'] = $tteacher->fields['LocalName'];
		$_SESSION['roleid'] = $tteacher->fields['RoleID'];
		$_SESSION['security'] = $tteacher->fields['SecurityLevel'];
		$_SESSION["pwd"] = $password;
        $_SESSION["AuthStatus"] = "Authorized";
        $_SESSION["UserID"] = $tteacher->fields['ID'];

		header("Location: ".base_url('page/controller/dashboard.php'));
		exit();

	}elseif($count == 0){
		header("Location: ".base_url('login2.html'));
		exit();
	}

}


?>

