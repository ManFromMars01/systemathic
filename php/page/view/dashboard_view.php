<div id="content" class="span10">
			<div >
				<ul class="breadcrumb">
					<li>
						<h2><a href="#">DASHBOARD >> Overview & Stats</a> </h2>
					</li>
				</ul>
			</div>
			<div class="row-fluid sortable">
			

				<a href="<?php echo controller('add_student') ?>" class="span3  btn-primary"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div><strong>Add Students</strong></div>
					<div>507</div>
				</a>

				<a href="#" class="span3  btn-info"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div><strong>Return Books</strong></div>
					<div>507</div>	
				</a>

				<a <?php $default->hide_if($cfranchisor);?> href="<?php echo controller('attendance_class'); ?>" class="span3  btn-danger"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div><strong>View My Class Today</strong></div>
					<div>507</div>
					
				</a>
				
				<a href="<?php echo controller('add_communication_log'); ?>" class="span3  btn-success"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div><strong>Add Parent Communication Log</strong></div>
					<div>507</div>
					
				</a>


			</div>

			<div class="row-fluid sortable" style="margin-top:10px;">
			

				<a href="<?php echo base_url('BrowseStudentlist3.php?CustType=Assessment');?>" class="span3  btn-warning"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div>Assess Customer</div>
					<div>507</div>
					
				</a>

				<a href="<?php echo base_url('BrowseStudentlistreg.php?RegType=Admitted');?>" class="span3  btn-inverse"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div>Student List</div>
					<div>507</div>
					
				</a>

				<a <?php $default->hide_if($cfranchisor);?> href="<?php echo base_url('page/controller/teacher_schedule_detail.php?&ID3='.$_SESSION['UserID']); ?>" class="span3  alert-info"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div>View My Schedule</div>
					<div>507</div>
					
				</a>
				
				<a href="#" class="span3  alert-error"  style="text-align:center; padding:10px;">
					<span class="icon32"><img src="<?php echo base_url();?>template/img/redicons/users.png"></span>
					<div>Invoicex</div>
					<div>507</div>
				</a>

						<div class="clearfix"></div>
			</div>	
			<div class="row-fluid sortable">
				<div class="box span4">
					<div class="box-header well boxheadercolor">
						<h2><i class="icon-th"></i> Notification</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
					
						 
						<ul class="dashboard-list">
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Usman" src="http://www.gravatar.com/avatar/f0ea51fa1e4fae92608d8affee12f67b.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Usman
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-success">Approved</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Sheikh Heera" src="http://www.gravatar.com/avatar/3232415a0380253cfffe19163d04acab.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Sheikh Heera
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Abdullah" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Abdullah
									</a><br>
									<strong>Since:</strong> 25/05/2012<br>
									<strong>Status:</strong> <span class="label label-important">Banned</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Saruar Ahmed" src="http://www.gravatar.com/avatar/564e1bb274c074dc4f6823af229d9dbb.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Saruar Ahmed
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-info">Updates</span>                                  
								</li>
							</ul>
					</div>
				</div><!--/span-->

				<div class="box span4">
					<div class="box-header well boxheadercolor">
						<h2><i class="icon-th"></i> Reminders</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
					
						 
						<ul class="dashboard-list">
								
							<?php if($reminder_count !=0): ?>
							<?php foreach($reminder as $reminders): ?>	
								<li>
									<strong style="float:right;"><a href="#">X</a></strong>
									<strong>Reminder:</strong> <?php echo $reminders['Reminder']; ?><br />
									<strong>Date:</strong> <?php echo $reminders['Date']; ?><br>                               
								</li>
							<?php endforeach; ?>	
							<?php endif; ?>

							<?php if($reminder_count == 0): ?>
								<li>
									<strong>0 Reminder</strong>                
								</li>
							<?php endif; ?>
								
							</ul>
					</div>
				</div><!--/span-->

				<div class="box span4">
					<div class="box-header well boxheadercolor">
						<h2><i class="icon-th"></i> Today's Appointment</h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
						</div>
					</div>
					<div class="box-content boxcontentcolor">
					
						 
						<ul class="dashboard-list">
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Usman" src="http://www.gravatar.com/avatar/f0ea51fa1e4fae92608d8affee12f67b.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Usman
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-success">Approved</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Sheikh Heera" src="http://www.gravatar.com/avatar/3232415a0380253cfffe19163d04acab.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Sheikh Heera
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-warning">Pending</span>                                 
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Abdullah" src="http://www.gravatar.com/avatar/46056f772bde7c536e2086004e300a04.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Abdullah
									</a><br>
									<strong>Since:</strong> 25/05/2012<br>
									<strong>Status:</strong> <span class="label label-important">Banned</span>                                  
								</li>
								<li>
									<a href="#">
										<img class="dashboard-avatar" alt="Saruar Ahmed" src="http://www.gravatar.com/avatar/564e1bb274c074dc4f6823af229d9dbb.png?s=50"></a>
										<strong>Name:</strong> <a href="#">Saruar Ahmed
									</a><br>
									<strong>Since:</strong> 17/05/2012<br>
									<strong>Status:</strong> <span class="label label-info">Updates</span>                                  
								</li>
							</ul>
					</div>
				</div><!--/span-->
						
				
					
			</div>


					<!-- content ends -->
			</div><!--/#content.span10-->

