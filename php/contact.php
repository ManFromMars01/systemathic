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
<?php include('template/header.php'); ?>
<div id="content" class="span10">
			<!-- content starts -->
			

			<div>
				<ul class="breadcrumb">
					<li>
						<a href="#">Home</a> <span class="divider">/</span>
					</li>
					<li>
						<a href="#">Contact</a>
					</li>
				</ul>
			</div>
			<?php include('template/stat.php'); ?>
			
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well">
						<h2><i class="icon-info-sign"></i> Contact</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
						

						<ul class="nav nav-tabs" id="myTab">
							<li ><a href="#register">Register Contact</a></li>
							<li><a href="#appointment">Appointment Scheduling</a></li>
							<li><a href="#parents">Parents Communication Log</a></li>
							<li><a href="#reminders">Reminders</a></li>
							<li><a href="#all">All Contacts</a></li>

							
						</ul>


					<div class="box-content">
						 
						<div id="myTabContent" class="tab-content">	
							<div class="tab-pane" id="register">
								<h3>Charisma <small>a fully featued template</small></h3>
								<p>Its a fully featured, responsive template for your admin panel. Its optimized for tablet and mobile phones. Scan the QR code below to view it in your mobile device.</p> 
								<p class="center">
									<a href="#" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Register Contact</a> 
									<!--<a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Adjustments</a> -->
								</p>
							</div>
							<div class="tab-pane" id="appointment">
								<h3>Custom <small>small text</small></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla. Donec consectetur, velit a pharetra ultricies, diam lorem lacinia risus, ac commodo orci erat eu massa. Sed sit amet nulla ipsum. Donec felis mauris, vulputate sed tempor at, aliquam a ligula. Pellentesque non pulvinar nisi.</p>
								<p class="center">
									<a href="<?php echo base_url('page/controller/appointment.php') ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Appointment</a> 
									<!--<a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Adjustments</a> -->
								</p>
							</div>
							<div class="tab-pane" id="parents">
								<h3>Messages <small>small text</small></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla. Donec consectetur, velit a pharetra ultricies, diam lorem lacinia risus, ac commodo orci erat eu massa. Sed sit amet nulla ipsum. Donec felis mauris, vulputate sed tempor at, aliquam a ligula. Pellentesque non pulvinar nisi.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor.</p>
								<p class="center">
									<a href="<?php echo base_url('page/controller/communication_log.php') ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Press Communication Log</a> 
								</p>
							</div>

							<div class="tab-pane active" id="reminders">
								<h3>Charisma <small>a fully featued template</small></h3>
								<p>Its a fully featured, responsive template for your admin panel. Its optimized for tablet and mobile phones. Scan the QR code below to view it in your mobile device.</p> 
								<p class="center">
									<a href="<?php echo base_url('page/controller/reminder.php') ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Reminders</a> 
									<!--<a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Adjustments</a> -->
								</p>
							</div>
							
							<div class="tab-pane" id="all">
								<h3>All Contacts  <small></small></h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor, quis ullamcorper ligula sodales at. Nulla tellus elit, varius non commodo eget, mattis vel eros. In sed ornare nulla. Donec consectetur, velit a pharetra ultricies, diam lorem lacinia risus, ac commodo orci erat eu massa. Sed sit amet nulla ipsum. Donec felis mauris, vulputate sed tempor at, aliquam a ligula. Pellentesque non pulvinar nisi.</p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare dolor.</p>
								<p class="center">
									<a href="<?php echo base_url('page/controller/all_contacts.php?query=parent'); ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Parent</a>
									<a href="<?php echo base_url('page/controller/all_contacts.php?query=branch'); ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Branches</a>   
									<a href="<?php echo base_url('page/controller/all_contacts.php?query=vendor'); ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Vendor</a>
									<a href="<?php echo base_url('page/controller/all_contacts.php?query=manufacturer'); ?>" class="btn btn-large btn-primary"><i class="icon-chevron-left icon-white"></i> Manufacturer</a>  
									<!--<a href="http://usman.it/free-responsive-admin-template" class="btn btn-large"><i class="icon-download-alt"></i> Adjustments</a> -->
								</p>
							</div>

						</div>
						
						
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
					<!-- content ends -->
			</div><!--/#content.span10-->
<?php include('template/footer.php'); ?>