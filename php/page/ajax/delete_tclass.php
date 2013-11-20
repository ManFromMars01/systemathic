<?php 
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $model variable


if(isset($_GET['schedcode'])):
	$model->delete_where('tclasssched', array('SchedCode' => $_GET['schedcode']));
	echo "<script>
		window.location = '".base_url("BrowseSchedListlist.php?ID1='PH'&ID2='PH001'&ID3=".$_GET['id3'])."';
	</script>";
endif;


?>