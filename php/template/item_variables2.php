 <?php

if(isset($_POST['preva'])){
	$bookcodes = $_POST['preva'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);

}

if(isset($_POST['nexta'])){
	$bookcodes = $_POST['nexta'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}

if(isset($_POST['prevm'])){
	$bookcodes = $_POST['prevm'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}

if(isset($_POST['nextm'])){
	$bookcodes = $_POST['nextm'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}



if(isset($_POST['prevs'])){
	$bookcodes = $_POST['prevs'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}

if(isset($_POST['nexts'])){
	$bookcodes = $_POST['nexts'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}


if(isset($_POST['prea'])){
	$bookcodes = $_POST['prea'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}

if(isset($_POST['prem'])){
	$bookcodes = $_POST['prem'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}
if(isset($_POST['pres'])){
	$bookcodes = $_POST['pres'];
	$booknum   = count($bookcodes);
	$result = array('booknum' => $booknum, 'bookcodes' => $bookcodes );
	echo json_encode($result);
}



?>
