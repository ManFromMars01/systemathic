<?php
session_start();
include('page/class/systemathic.php');
$myName = $_SESSION["myname"];


?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Systemathic School Management Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Kenneth Lito">
	<meta name="author" content="marga">

	
	<link  href="template/css/bootstrap-cerulean.css" rel="stylesheet">
	<!-- The styles -->
	
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="template/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="template/css/charisma-app.css" rel="stylesheet">
	<link href="template/css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='template/css/fullcalendar.css' rel='stylesheet'>
	<link href='template/css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='template/css/chosen.css' rel='stylesheet'>
	<link href='template/css/uniform.default.css' rel='stylesheet'>
	<link href='template/css/colorbox.css' rel='stylesheet'>
	<link href='template/css/jquery.cleditor.css' rel='stylesheet'>
	<link href='template/css/jquery.noty.css' rel='stylesheet'>
	<link href='template/css/noty_theme_default.css' rel='stylesheet'>
	<link href='template/css/elfinder.min.css' rel='stylesheet'>
	<link href='template/css/elfinder.theme.css' rel='stylesheet'>
	<link href='template/css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='template/css/opa-icons.css' rel='stylesheet'>
	<link href='template/css/uploadify.css' rel='stylesheet'>





	<link href='template/css/jquery.timepicker.css' rel='stylesheet'>
	<link href='template/css/colorpicker.css' rel='stylesheet'>
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="template/img/smlogo101.png">
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="template/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="template/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="template/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="template/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="template/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="template/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="template/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="template/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="template/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="template/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="template/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="template/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="template/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="template/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="template/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="template/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='template/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='template/js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="template/js/excanvas.js"></script>
	<script src="template/js/jquery.flot.min.js"></script>
	<script src="template/js/jquery.flot.pie.min.js"></script>
	<script src="template/js/jquery.flot.stack.js"></script>
	<script src="template/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="template/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="template/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="template/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="template/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="template/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="template/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="template/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="template/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="template/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="template/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="template/js/jquery.history.js"></script>
	<script src="template/js/jquery.timepicker.js"></script>
	<!-- application script for Charisma demo -->
	<script src="template/js/charisma.js"></script>	
	<script src="template/js/jquery.validate.min.js"></script>
	
	
	
	<script>
		//Update Student
	$( document ).ready(function() {	
		$('.teacher_id').each(function(){
		       teacherid = $(this).val();
		       $.ajax({
			        url: 'template/variables4.php',
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

		

		$('#previousa').change(function(){
			$('.abook').hide();
			$('.apbookcode').val('');
			//$('.abacusrpt').val('');

			var preva = $(this).val();
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {preva : preva},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           
			           for(x=1; x<=j.booknum; x++){		
			           	$('.abook' + x).show();
			           	$('.abookcode' + x ).html(j.bookcodes[x - 1]); 
			           	$('.apbookcode' + x ).val(j.bookcodes[x - 1]);
			           	
			           	//alert(j.bookcodes[x - 1]);
					       
			           }
			             booknumme = j.booknum + 1;
			             //alert(booknumme);
			             if(booknumme == "2"){
			             	$('#abacusrpt2').val('');
			             	$('#abacusrpt3').val('');
			             }
			             if(booknumme == "3"){
			             	$('#abacusrpt3').val('');
			             }

			            
			        }     
			});	

		});


		$('#previousm').change(function(){
			$('.mbook').hide();
			$('.mpbookcode').val('');
			var prevm = $(this).val();
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {prevm : prevm},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){
			           	$('.mbook' + x).show();
			           	$('.mbookcode' + x ).html(j.bookcodes[x - 1]); 
			           	$('.mpbookcode' + x ).val(j.bookcodes[x - 1]); 
			      
			           }

			           booknumme = j.booknum + 1;
			             //alert(booknumme);
			             if(booknumme == "2"){
			             	$('#mentalrpt2').val('');
			             	$('#mentalrpt3').val('');
			             }
			             if(booknumme == "3"){
			             	$('#mentalrpt3').val('');
			             }

			            
			        }     
			});	

		});


		$('#previouss').change(function(){
			$('.sbook').hide();
			$('.spbookcode').val('');
			var prevs = $(this).val();
			 
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {prevs : prevs},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){
			           	$('.sbook' + x).show();
			           	$('.sbookcode' + x ).html(j.bookcodes[x - 1]); 
			           	$('.spbookcode' + x ).val(j.bookcodes[x - 1]); 

			           }

			           	booknumme = j.booknum + 1;
			             //alert(booknumme);
			             if(booknumme == "2"){
			             	$('#supprpt2').val('');
			             	$('#supprpt3').val('');
			             }
			             if(booknumme == "3"){
			             	$('#supprpt3').val('');
			             }


			            
			        }     
			});	

		});


		$('#nexta').change(function(){
			var nexta = $(this).val();
			$('.anbookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {nexta : nexta},
			        dataType: 'json',
			        success: function (j) {
			          // alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.anbookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

		});
		$('#nextm').change(function(){
			var nextm = $(this).val();
			$('.mnbookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {nextm : nextm},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.mnbookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

		});
		$('#nexts').change(function(){
			var nexts = $(this).val();
			$('.snbookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {nexts: nexts},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.snbookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

		});

		$('#prea').change(function(){
			var prea = $(this).val();
			$('.preabookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {prea: prea},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.preabookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

		});

		$('#prem').change(function(){
			var prem = $(this).val();
			$('.prembookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {prem: prem},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.prembookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

		});

		$('#pres').change(function(){
			var pres = $(this).val();
			$('.presbookcode').val('');
			 $.ajax({
			        url: 'template/item_variables2.php',
			        type: 'post',
			        data: {pres: pres},
			        dataType: 'json',
			        success: function (j) {
			           //alert(j.booknum);
			           console.log(j);

			           for(x=1; x<=j.booknum; x++){ 
			           	$('.presbookcode' + x ).val(j.bookcodes[x - 1]); 
			           }

			            
			        }     
			});	

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
				<a class="brand" href="index.php"> <img alt="Systemathic Logo" src="template/img/systemathic.png" style="width:200px; height:35px;"/> <span></span></a>
				
		
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> <?php echo $myName ?></span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="logout.php">Logout</a></li>
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
			<?php $roleids = array(6); ?>	
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav navdivcolor">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet ">Main</li>
						<li><a class="ajax-link" href="index.php"><img class="icon" src="template/img/redicons/id_card.png"></img><span class="hidden-tablet">Admission</span></a></li>
						<li><a class="ajax-link" href="schedule.php"><img class="icon" src="template/img/redicons/calendar.png"></img><span class="hidden-tablet"> Scheduling</span></a></li>
						<li><a class="ajax-link" href="contact.php"><img class="icon" src="template/img/redicons/phone.png"></img><span class="hidden-tablet"> Contact</span></a></li>

						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="franchising.php"><img class="icon" src="template/img/redicons/world.png"></img><span class="hidden-tablet"> Franchising</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="reports.php"><img class="icon" src="template/img/redicons/page_full.png"></img><span class="hidden-tablet"> Reports</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="utility.php"><img class="icon" src="template/img/redicons/tools.png"></img></i><span class="hidden-tablet"> Utility</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="accounting.php"><img class="icon" src="template/img/redicons/calculator.png"></img><span class="hidden-tablet"> CMA Accounting</span></a></li>
						
						<li <?php $default->hide_if($roleids); ?> class="nav-header hidden-tablet">Admin Section</li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="page/controller/browse_country.php"><img class="icon" src="template/img/redicons/countrylist.jpg"></img><span class="hidden-tablet"> Country List</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="BrowseLevellist.php"><img class="icon" src="template/img/redicons/department.jpg"></img><span class="hidden-tablet"> Level List</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="BrowseManufacturerlist.php"><img class="icon" src="template/img/redicons/manufacturer.jpg"></img><span class="hidden-tablet"> Manufacturer</span></a></li>
						<li <?php $default->hide_if($roleids); ?>><a class="ajax-link" href="BrowseItemslist.php"><img class="icon" src="template/img/redicons/booklist.jpg"></img><span class="hidden-tablet">Item List</span></a></li>
						

						<li class="nav-header hidden-tablet">Design Section</li>
						<li><a class="ajax-link" href="form.html"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Forms</span></a></li>
						<li><a class="ajax-link" href="table.html"><img class="icon" src="template/img/redicons/package.png"></img></i><span class="hidden-tablet"> Tables</span></a></li>
						<li><a href="login.html"><img class="icon" src="template/img/redicons/lock.png"></img></i><span class="hidden-tablet"> Login Page</span></a></li>
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
