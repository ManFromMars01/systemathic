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
include('template/myclass.php');
include('login.php');

?>


<?php include('template/header.php') ?>
<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Admission</a>
					</li>
				</ul>
			</div>
			


			<?php include('template/stat.php') ?>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Admission Process</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>

									<table width="auto" height="auto" id="table1"  style="background-image:url('template/img/admission-slice/backg.png'); background-size:100%; background-repeat:no-repeat;" >

									<tr>
										<td><a href="BrowseStudentlist3.php?CustType=Assessment"><img class="table101" src="template/img/admission-slice/assessment.png"></a></td>
									    <td rowspan="7" width="10%"> </td>
									    <td ><a href="BrowseStudentlist3.php?CustType=For Admission&RegType=Waiting"><img  class="table101" src="template/img/admission-slice/admission.png"></a></td>
									    <td rowspan="7" width="10%"> </td>
									    <td ></td>
									    <td ><a href="BrowseStudentlistreg.php?RegType=Admitted"><img  class="table101" src="template/img/admission-slice/studentfile.png"></a></td>
									    <td > </td>
									</tr>

									<tr>
										<td><img src="template/img/admission-slice/downarrow1.png" width="auto" height="auto"></td>
									    <td><img src="template/img/admission-slice/downarrow1.png" width="auto" height="auto"></td>
									    <td colspan="3" align="center"><img src="template/img/admission-slice/threearrow1.png"></td>
									 
									</tr>

									<tr>
										<td><a href="BrowseStudentlist3.php?CustType=Trial Class"><img  class="table101" src="template/img/admission-slice/trialclass.png"></a></td>
									    <td><a href="BrowseStudentlistreg.php?RegType=For Schedule"><img  class="table101" src="template/img/admission-slice/createsched.png"></a></td>
									    <td><a id="returnbooklink" href="#"><img  class="table101" src="template/img/admission-slice/books.png"></a></td>
									    <td> <a href="page/controller/attendance_class.php"><img  class="table101" src="template/img/admission-slice/attendance.png"></td>
									    <td> <img  class="table101" src="template/img/admission-slice/progress.png"></td>
									    
									</tr>


									<tr>
										<td>&nbsp;</td>
									    <td><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
									    <td><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
									    <td><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
									    <td><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
									    
									</tr>

									<tr>
										<td><a href="BrowseStudentlist3.php?CustType=ReEnrollee"><img  class="table101" src="template/img/admission-slice/reenrollee.png"></a></td>
									    <td><a href="BrowseStudentlistreg.php?RegType=For Payment"><img  class="table101" src="template/img/admission-slice/invoicing.png"></a></td>
									    <td><img  class="table101" src="template/img/admission-slice/examination.png"></td>
									    <td> <a href="page/controller/online_practices.php"> <img class="table101" src="template/img/admission-slice/onlinepractice.png"></td>
									    <td> <img class="table101" src="template/img/admission-slice/generatereports.png"></td>
									    
									</tr>

									<tr>
										<td>&nbsp;</td>
									    <td><img src="template/img/admission-slice/downarrow1.png" alt="" width="auto" height="auto"></td>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									    
									</tr>


									<tr>
										<td><a href="BrowseStudentlist3.php?CustType=Continuing"><img  class="table101" src="template/img/admission-slice/continuing.png"></a></td>
									    <td><a href="BrowseStudentlistreg.php?RegType=For Kit Issuance"><img  class="table101" src="template/img/admission-slice/kitissuance.png"></a></td>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									    
									</tr>


									</table>
						

						<div class="clearfix"></div>
					</div>
				</div>
			</div>
					
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well boxheadercolor">
						<h2><i class="icon-th"></i> Assessment</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
					
						 
						<div id="myTabContent" class="tab-content">	
							<div class="tab-pane active" id="info">
								
								<p> <img src="template/img/thumbs/assessment.jpg"  class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,</p> 

								<a href="BrowseStudentlist3.php?CustType=Assessment" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Assess </a>

							</div>
							
						</div>
					</div>
				</div><!--/span-->
						
				<div class="box span4">
					<div class="box-header well boxheadercolor" >
						<h2><i class="icon-user"></i> Trial Class</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
						<div class="box-content boxcontentcolor
						">
							<div id="myTabContent" class="tab-content">	
								<div class="tab-pane active" id="info">
									
									<p><img src="template/img/thumbs/trialclass.jpg" class="thumbsize">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,</p> 
										<a href="BrowseStudentlist3.php?CustType=Trial Class" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Try Now</a>
								</div>

							</div>
						</div>
				</div><!--/span-->
						
				<div class="box span4">
					<div class="box-header well boxheadercolor" >
						<h2><i class="icon-list-alt"></i> Re-Enrollee</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="box-content boxcontentcolor">
						<div id="myTabContent" class="tab-content">	
							<div class="tab-pane active" id="info">
								
								<p><img src="template/img/thumbs/reenrollee.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,</p> 
									<a href="BrowseStudentlist3.php?CustType=ReEnrollee" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Enroll</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>

			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well boxheadercolor" >
						<h2><i class="icon-user"></i> Continuing Student</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
						<div class="box-content boxcontentcolor">
							<div id="myTabContent" class="tab-content">	
								<div class="tab-pane active" id="info">
									
									<p><img src="template/img/thumbs/continuing.jpg" class="thumbsize">
										Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
										<a href="BrowseStudentlist3.php?CustType=Continuing" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Search Now</a>
								</div>

							</div>
						</div>
				</div><!--/span-->
					
				<div class="box span4">
					<div class="box-header well boxheadercolor" data-original-title>
						<h2 ><i class="icon-list"></i> Admission</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a href="#admission">Admission</a></li>
							<li><a href="#create">Create Schedule</a></li>
							<li><a href="#invoicing">Invoicing/Payment</a></li>
							<li><a href="#kit">Kit Issuance</a></li>
						</ul>
						 
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="admission">
								
								<p><img src="template/img/thumbs/admission.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<a href="BrowseStudentlist3.php?CustType=For%20Admission&RegType=Waiting" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Insert </a>
							</div>
							<div class="tab-pane" id="create">
								
								<p><img src="template/img/thumbs/schedule.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<a href="BrowseStudentlistreg.php?RegType=For%20Schedule" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Create </a>
								
							</div>
							<div class="tab-pane" id="invoicing">
								
								<p><img src="template/img/thumbs/payment.jpg" class="thumbsize">
									aaLorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Inquire </button>
								
							</div>

							<div class="tab-pane" id="kit">
								<p><img src="template/img/thumbs/kitissuance.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<a href="BrowseStudentlistreg.php?RegType=For%20Kit%20Issuance" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Check </a>
								
							</div>
						</div>
					</div>
				</div><!--/span-->
					
				<div class="box span4">
					<div class="box-header well boxheadercolor" data-original-title>
						<h2><i class="icon-list"></i> Student File</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
						<ul class="nav nav-tabs" id="myTab">
							<li class="active"><a href="#books">Books</a></li>
							<li><a href="#attendance">Attendance</a></li>
							<li><a href="#progress">Progress</a></li>
							<li><a href="#examinations">Examinations</a></li>
							<li><a href="#onlinepractice">Online Practice</a></li>
							<li><a href="#reports">Generate Reports</a></li>
						</ul>
						 
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane active" id="books">
								
								<p><img src="template/img/thumbs/books.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
									<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Search </button>
							</div>
							<div class="tab-pane" id="attendance">
								
								<p><img src="template/img/thumbs/attendance.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<a href="page/controller/attendance_class.php" class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>View </a>
							</div>
							<div class="tab-pane" id="progress">
								
								<p><img src="template/img/thumbs/progress.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Check </button>
							</div>

							<div class="tab-pane" id="examinations">
								
								<p><img src="template/img/thumbs/examination.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Inquire </button>
							</div>

							<div class="tab-pane" id="onlinepractice">
								
								<p><img src="template/img/thumbs/onlinepractice.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, </p> 
								<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Log in </button>
							</div>

							<div class="tab-pane" id="reports">
								
								<p><img src="template/img/thumbs/generate.jpg" class="thumbsize">
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,</p> 
								<button class="btn btn-large btn-primary" style="float:right;"><i class="icon-chevron-left icon-white"></i>Generate </button>
							</div>
						</div>	

					</div>
				</div>
			</div>
				  

		  
       
					<!-- content ends -->
			</div><!--/#content.span10-->\
		
<?php include('template/footer.php') ?>