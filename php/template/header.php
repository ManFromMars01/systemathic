
<?php
session_start();
$myRole = getSession("Company");
$myName = getSession("UserName");
var_dump($myName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<title>Systemathic School Management Application</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Kenneth Lito">
	<meta name="author" content="marga">

	<!-- The styles -->
	<link  href="template/css/bootstrap-cerulean.css" rel="stylesheet">
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

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="template/img/favicon.ico">
		
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
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet">Main</li>
						<li><a class="ajax-link" href="index.php"><img class="icon" src="template/img/redicons/id_card.png"></img><span class="hidden-tablet">Admission</span></a></li>
						<li><a class="ajax-link" href="schedule.php"><img class="icon" src="template/img/redicons/calendar.png"></img><span class="hidden-tablet"> Scheduling</span></a></li>
						<li><a class="ajax-link" href="contact.php"><img class="icon" src="template/img/redicons/phone.png"></img><span class="hidden-tablet"> Contact</span></a></li>

						<li><a class="ajax-link" href="franchising.php"><img class="icon" src="template/img/redicons/world.png"></img><span class="hidden-tablet"> Franchising</span></a></li>
						<li><a class="ajax-link" href="reports.php"><img class="icon" src="template/img/redicons/page_full.png"></img><span class="hidden-tablet"> Reports</span></a></li>
						<li><a class="ajax-link" href="utility.php"><img class="icon" src="template/img/redicons/tools.png"></img></i><span class="hidden-tablet"> Utility</span></a></li>
						<li><a class="ajax-link" href="accounting.php"><img class="icon" src="template/img/redicons/calculator.png"></img><span class="hidden-tablet"> CMA Accounting</span></a></li>
						
						<?php if($myRole != '50'): ?>
						<li class="nav-header hidden-tablet">Admin Section</li>
						<li><a class="ajax-link" href="Browsetcountrylist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Country List</span></a></li>
						<li><a class="ajax-link" href="BrowseDeptlist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Department List</span></a></li>
						<li><a class="ajax-link" href="BrowseCategorylist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Category List</span></a></li>
						<li><a class="ajax-link" href="BrowseUnitMeaslist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Unit List</span></a></li>
						<li><a class="ajax-link" href="BrowseManufacturerlist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Manufacturer</span></a></li>
						<li><a class="ajax-link" href="BrowseLocationlist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Location</span></a></li>
						<li><a class="ajax-link" href="BrowseItemslist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Book Item List</span></a></li>
						<li><a class="ajax-link" href="BrowseAssessmentlist.php"><img class="icon" src="template/img/redicons/database.png"></img><span class="hidden-tablet"> Assessment List</span></a></li>
						<?php endif; ?>

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
