<?php not_login();?>
<?php 
	$role_id = array(6);
	$role_id2 = array(6,3,1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Systemathic School Management Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Kenneth Lito">
	<meta name="author" content="marga">

	
	<link  href="<?php echo base_url()?>template/css/bootstrap-cerulean.css" rel="stylesheet">
	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?php echo base_url()?>template/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?php echo base_url()?>template/css/charisma-app.css" rel="stylesheet">
	<link href="<?php echo base_url()?>template/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?php echo base_url()?>template/css/fullcalendar.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?php echo base_url()?>template/css/chosen.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/uniform.default.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/colorbox.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/jquery.noty.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/elfinder.min.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/opa-icons.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/uploadify.css' rel='stylesheet'>





	<link href='<?php echo base_url()?>template/css/jquery.timepicker.css' rel='stylesheet'>
	<link href='<?php echo base_url()?>template/css/colorpicker.css' rel='stylesheet'>
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?php echo base_url()?>template/img/smlogo101.png">
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<!--<script src="<?php echo base_url();?>template/js/jquery-1.7.2.min.js"></script>-->

	<!-- jQuery UI -->
	<script src="<?php echo base_url();?>template/js/jquery-ui-1.8.21.custom.min.js"></script>

	<!-- transition / effect library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="<?php echo base_url();?>template/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="<?php echo base_url();?>template/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="<?php echo base_url();?>template/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="<?php echo base_url();?>template/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="<?php echo base_url();?>template/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="<?php echo base_url();?>template/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='<?php echo base_url();?>template/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='<?php echo base_url();?>template/js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="<?php echo base_url();?>template/js/excanvas.js"></script>
	<script src="<?php echo base_url();?>template/js/jquery.flot.min.js"></script>
	<script src="<?php echo base_url();?>template/js/jquery.flot.pie.min.js"></script>
	<script src="<?php echo base_url();?>template/js/jquery.flot.stack.js"></script>
	<script src="<?php echo base_url();?>template/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="<?php echo base_url();?>template/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="<?php echo base_url();?>template/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="<?php echo base_url();?>template/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="<?php echo base_url();?>template/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="<?php echo base_url();?>template/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="<?php echo base_url();?>template/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="<?php echo base_url();?>template/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="<?php echo base_url();?>template/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="<?php echo base_url();?>template/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="<?php echo base_url();?>template/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="<?php echo base_url();?>template/js/jquery.history.js"></script>
	<script src="<?php echo base_url();?>template/js/jquery.timepicker.js"></script>
	<!-- application script for Charisma demo -->
	<script src="<?php echo base_url();?>template/js/charisma.js"></script>	
	<script src="<?php echo base_url();?>template/js/jquery.validate.min.js"></script>
	<script>
	$( document ).ready(function() {	
		$('.teacher_id').each(function(){
		       teacherid = $(this).val();
		       $.ajax({
			        url: '<?php echo base_url();?>template/variables4.php',
			        type: 'post',
			        data: {teacher_id : teacherid},
			        dataType: 'json',
			        success: function (j) {
			           console.log(j);
			           $('.teachernames').html(j.teacher); 
			        }     
				});	
		});


		$('.bookcat').each(function(){
		       bookcategory = $(this).is(':checked');
		       if(bookcategory == true){
		       		myval = $(this).val();
		       		$('#group-' + myval).show();
		       }
		      
		});

	

	});
	
	</script>
	
	
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"> <img alt="Systemathic Logo" src="<?php echo base_url()?>template/img/systemathic.png" style="width:200px; height:35px;"/> <span></span></a>
				
		
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<?php $tteacherphoto = $model->select_where('tteacher', array('ID' => $_SESSION['UserID'] )); ?>
						<?php if($tteacherphoto->fields['photo'] == ""): ?>
							<img class="img_preview" style="width:15px" src="<?php echo base_url('page/ajax/upload_photo/cma-logo.jpg'); ?>">
						<?php else: ?>
							<img class="img_preview" style="width:15px" src="<?php echo base_url('page/ajax/'.$tteacherphoto->fields['photo']); ?>">
						<?php endif; ?>


						<span class="hidden-phone"> <?php echo $_SESSION['myname']?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('page/controller/dashboard.php') ?>">Dashboard</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url('page/controller/my_profile.php') ?>">Update Profile</a></li>
						<li class="divider"></li>
						<li><a href="<?php echo base_url();?>logout.php">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<div class="row-fluid">
				
			<!-- left menu starts -->

			<div class="span2 main-menu-span">	
				<div class="well nav-collapse sidebar-nav navdivcolor">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet ">Main</li>
						<li><a class="ajax-link" href="<?php echo base_url('page/controller/admission.php');?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/id_card.png"></img><span class="hidden-tablet">Admission</span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url('page/controller/');?>scheduling.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/calendar.png"></img><span class="hidden-tablet"> Scheduling</span></a></li>
						<li><a class="ajax-link" href="<?php echo base_url('page/controller/');?>contact.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/phone.png"></img><span class="hidden-tablet"> Contact</span></a></li>

						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url('page/controller/');?>franchising.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/world.png"></img><span class="hidden-tablet"> Franchising</span></a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url();?>reports.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/page_full.png"></img><span class="hidden-tablet"> Reports</span></a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url();?>utility.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/tools.png"></img></i><span class="hidden-tablet"> Utility</span></a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url();?>accounting.php"><img class="icon" src="<?php echo base_url()?>template/img/redicons/calculator.png"></img><span class="hidden-tablet"> CMA Accounting</span></a></li>
						
						
						<li <?php $default->hide_if(array(6,5));?>class="nav-header hidden-tablet">General</li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_country.php');?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> Country List</span></a></li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_level.php');?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/department.jpg"></img><span class="hidden-tablet"> Level List</span></a></li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_item_all.php') ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/booklist.jpg"></img><span class="hidden-tablet"> Item List</span></a></li>
						
						<li <?php $default->hide_if(array(6,5));?>class="nav-header hidden-tablet">SetUp</li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_size.php');?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet">Size</span></a></li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_color.php');?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/department.jpg"></img><span class="hidden-tablet">Color</span></a></li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_design.php') ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/booklist.jpg"></img><span class="hidden-tablet">Design</span></a></li>
						<li <?php $default->hide_if(array(6,5));?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_collection.php') ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/booklist.jpg"></img><span class="hidden-tablet">Collection</span></a></li>


					


						<li <?php $default->hide_if($role_id);?>class="nav-header hidden-tablet" > Franchisee</li>

						<li <?php $default->hide_if($role_id2);?>><a href="<?php echo base_url('page/controller/browse_branches.php?countryid='.$_SESSION['UserValue1']); ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img> <?php echo $_SESSION['UserValue1'];?> - Branches</a></li>
						<li <?php $default->hide_if($role_id);?>><a href="<?php echo base_url('page/controller/browse_branches.php?countryid=wearegreat0101'); ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img>Branches</a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url('page/controller/order.php')?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> Order</span></a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url('page/controller/my_orders.php')?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> My Orders</span></a></li>
					
						<li <?php $default->hide_if($role_id);?>class="nav-header hidden-tablet" > Inventory</li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_item.php'); ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> Items</span></a></li>
						<li <?php $default->hide_if($role_id);?>><a class="ajax-link" href="<?php echo base_url('page/controller/browse_item.php'); ?>"><img class="icon" src="<?php echo base_url()?>template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> Books</span></a></li>



					</ul>
					
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
