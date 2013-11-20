<?php 
session_set_cookie_params(500);
session_start();
$PageLevel = 0;
$PageLevel = 1;
include_once('systemathicappdata.php');
include_once('ConnInfo.php');

$objConn1 = &ADONewConnection($Driver1);
$objConn1->debug = $DebugMode;
$objConn1->PConnect($Server1,$User1,$Password1,$db1);
include_once('utils.php');
include('login.php');
include('template/myclass.php');
?>
<?php include('template/header.php') ?>
<div id="content" class="span10">
			<!-- content starts -->
			

			<!-- <div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Franchising</a>
					</li>
				</ul>
			</div> -->
			


			<?php include('template/stat.php') ?>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Franchising Process</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
						


					<div class="box-content">
						 
						<div id="myTabContent" class="tab-content">	
							<div class="tab-pane" id="master">
								<p>Lorem Ipsum </p>

								<table width="auto" height="auto" align="center" style="margin-bottom:10px;" >
								<tr>
									
									<td colspan="2" align="center">  <a href="<?php echo base_url('page/controller/country_franchisor.php');?>"><img src="template/img/franchise/master.png"></a></td>
									
									<td  width="12%" rowspan="7" valign="top"> <img src="template/img/franchise/arrow1.png"> </td>
									
									<td colspan="2" align="center">  <a href="<?php echo base_url('page/controller/country_franchisor.php');?>"><img src="template/img/franchise/country.png"></a> </td>
									
									<td  width="12%" rowspan="7" valign="top"> <img src="template/img/franchise/arrow1.png"> </td>
									
									<td colspan="2" align="center">  <img src="template/img/franchise/franchisee.png"> </td>
								</tr>

								<tr>
								<td colspan="2 " align="center" ><img src="template/img/franchise/arrow2.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center" ><img src="template/img/franchise/arrow2.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center"><img src="template/img/franchise/arrow2.png" alt="" width="auto" height="auto"></td>
								</tr>

								<tr>
									<td><a href="<?php echo base_url('page/controller/franchising_book_record.php');?>"><img src="template/img/franchise/book.png"></a></td>
									<td><a href="<?php echo base_url('page/controller/franchising_student_record.php')?>"><img src="template/img/franchise/student.png"></td>
								
									<td><a href="<?php echo base_url('page/controller/franchising_book_record.php');?>"><img src="template/img/franchise/book.png"></a></td>
									<td><img src="template/img/franchise/student.png"></td>
									
									<td>  <img src="template/img/franchise/book.png"></td>
									<td>  <img src="template/img/franchise/student.png"></td>
								</tr>
								
								<tr>
								<td colspan="2 " align="center" ><img src="template/img/franchise/arrow3.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center" ><img src="template/img/franchise/arrow3.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center"><img src="template/img/franchise/arrow3.png" alt="" width="auto" height="auto"></td>
								</tr>

								<tr>
									<td colspan="2" align="center">   <img src="template/img/franchise/royalty.png"> </td>
								
									<td colspan="2" align="center">  <img src="template/img/franchise/royalty.png"></td>
									
									<td colspan="2" align="center">  <img src="template/img/franchise/royalty.png"> </td>
								</tr>
								
								<tr>
								<td colspan="2 " align="center" ><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center" ><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
								<td colspan="2 " align="center"><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
								</tr>

								<tr>
									<td colspan="2" align="center">   <img src="template/img/franchise/billing.png"> </td>
									
									<td colspan="2" align="center">  <img src="template/img/franchise/billing.png"></td>
								
									<td colspan="2" align="center">  <img src="template/img/franchise/billing.png"> </td>
								</tr>



								</table>
									
						<div class="clearfix"></div>
					</div>
				</div>
			</div>




			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Franchising</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
						

						<ul class="nav nav-tabs" id="myTab">
							<li ><a href="#master">Master Franchisor</a></li>
							<li><a href="#country">Country Franchisor</a></li>
							<li><a href="#franchisee">Franchisee</a></li>
						
							
						</ul>


					<div class="box-content">
						 
						<div id="myTabContent" class="tab-content">	
							<div class="tab-pane" id="master">
								<p>
									<ul>
										<li>Book Record </li>
										<li>Student Record </li>
										<li>Compute Royalty </li>
										<li>Billing Payment </li>
									</ul>
								</p> 
							</div>
							<div class="tab-pane" id="country">
								<p>
									<ul>
										<li>Book Record </li>
										<li>Student Record </li>
										<li>Compute Royalty </li>
										<li>Billing Payment </li>
									</ul>
								</p> 
							</div>
							<div class="tab-pane" id="franchisee">
								<p>
									<ul>
										<li>Book Record </li>
										<li>Student Record </li>
										<li>Compute Royalty </li>
										<li>Billing Payment </li>
									</ul>
								</p> 
							</div>

					

						</div>
						
						<p class="center">
							<a href="http://usman.it/free-responsive-admin-template" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Generate Report</a> 
							<!-- <a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Adjustments</a> -->
						</p>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>

		  
       
					<!-- content ends -->
			</div><!--/#content.span10-->
<?php include('template/footer.php'); ?>			