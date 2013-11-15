<?php 
include('template/header.php'); 
include('template/myclass.php');

$onlinelist = $model->select_where('eonline',array('BranchID' => $_SESSION['UserValue2']));


include('html/BrowseOnlinelist.php');
?>


<?php include('template/footer.php'); ?>         