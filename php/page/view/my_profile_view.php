<div id="content" class="span10">
			
			<?php breadcrumb('Your Profile');?>


			<div class="row-fluid sortable">
				<div class="box span6">
					<?php echo box_header("Your Profile") ?>
					<div class="box-content">
						<form id="change_info" method="post" >
						<table <?php tablestyle(); ?>>
							<tr>
								<td>Primary Image</td>
								<td>

									<?php if($tteacher->fields['photo'] == ""): ?>
										<img class="img_preview" src="<?php echo base_url('page/ajax/upload_photo/cma-logo.jpg');?>">
									<?php else: ?>
											<img class="img_preview" src="<?php echo base_url('page/ajax/'.$tteacher->fields['photo']);?>?old">
									<?php endif; ?>


									<input id="fileupload" type="file" name="image" > 
								
									
									<div style="margin-top:10px;" id="progress" class="progress progress-success progress-striped">
									    <div class="bar"></div>
									</div>
									<!-- The list of files uploaded -->
								
								</td>
							</tr>
							
							<tr>
								<td>Local Name</td>
								<td><input type="text" class="input-xlarge" name="name" value="<?php echo $tteacher->fields['LocalName']; ?>" required/></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><input type="text" class="input-xlarge" name="address" value="<?php echo $tteacher->fields['Address1']; ?>" required/></td>
							</tr>
							<tr>
								<td>Address2</td>
								<td><input type="text" class="input-xlarge" name="address2" value="<?php echo $tteacher->fields['Address2']; ?>" /></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><input type="text" name="phone" value="<?php echo $tteacher->fields['PhoneNo']; ?>" /></td>
							</tr>	
							<tr>
								<td>Mobile</td>
								<td><input type="text" name="mobile" value="<?php echo $tteacher->fields['MobileNo']; ?>" /></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input type="email" name="email" value="<?php echo $tteacher->fields['Email']; ?>"  required /></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td>
									<select name="gender">
										<option <?php selected($tteacher->fields['Gender'], 'Male')?> value="Male">Male</option>
										<option <?php selected($tteacher->fields['Gender'], 'Female')?> value="Female">Female</option>	
									</select>

								</td>
							</tr>
							<tr>
								<td>Civil Status</td>
								<td>
									<select name="civil">
										<option <?php selected($tteacher->fields['CivilStatus'], 'Single')?> value="Single">Single</option>
										<option <?php selected($tteacher->fields['CivilStatus'], 'Married')?> value="Married">Married</option>
										<option <?php selected($tteacher->fields['CivilStatus'], 'Seperated')?> value="Seperated">Seperated</option>
										<option <?php selected($tteacher->fields['CivilStatus'], 'Divorced')?> value="Divorced">Divorced</option>
										<option <?php selected($tteacher->fields['CivilStatus'], 'Widow/er')?> value="Widow/er">Widow/er</option>	
									</select>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center;"><button class="btn btn-info" type="button" id="save_info">SAVE INFO</button></td>
								
							</tr>
								
						</table>
						</form>	
					
					</div>


				</div>	
				<div class="box span6">
					<?php echo box_header("Change Username") ?>
					<div class="box-content">
						<table <?php tablestyle(); ?>>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username" /></td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center;"><button class="btn btn-info">Change Username</button></td>
							</tr>		
						</table>
					
					</div>
				</div>	
				<div class="box span6">
					<?php echo box_header("Change Password") ?>
					<div class="box-content">
						<table <?php tablestyle(); ?>>
							<tr>
								<td>Current Password</td>
								<td><input type="text" name="username" /></td>
							</tr>
							<tr>
								<td>New Password</td>
								<td><input type="text" name="username" /></td>
							</tr>
							<tr>
								<td>Confirm Password</td>
								<td><input type="text" name="username" /></td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:center;"><button class="btn btn-info">Change Username</button></td>
							</tr>		
						</table>
					
					</div>
				</div>	

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
					<div class="box-content boxcontentcolor" style="display:none;">
					
						 
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
					<div class="box-content boxcontentcolor" style="display:none;">
					
						 
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
					<div class="box-content boxcontentcolor" style="display:none;">
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

			<script src="<?php echo base_url('page/ajax/widget.js') ?>"></script>
			<script src="<?php echo base_url('page/ajax/jquery-iframe.js') ?>"></script>
			<script src="<?php echo base_url('page/ajax/jquery.fileupload.js') ?>"></script>
			<script>
			    // When the server is ready...
			    $(function () {
			        'use strict';
			        
			        // Define the url to send the image data to
			        var url = "<?php echo base_url('page/ajax/upload.php');?>";
			        
			        // Call the fileupload widget and set some parameters
			        $('#fileupload').fileupload({
			            url: url,
			            dataType: 'json',
			            done: function (e, data) {
			            	console.log(data.result);
			            	var image_uploaded = data.result.image_name;
			            	var status         = data.result.status;

			            	if(status == "Image successfully uploaded!"  ){
			            		//alert(image_uploaded);
			            		$('#progress').fadeOut(1600);
			            		$('#progress .bar').css('width','0%');
			            		$('.img_preview').attr('src','');
			            		$('.img_preview').fadeOut();
			            		$('.img_preview').attr('src','<?php echo base_url('page/ajax/') ?>'+ image_uploaded);
			            		$('.img_preview').fadeIn();
			            		
			            		

			            		noty({text: 'You Successfully Change Your Profile Photo', type: 'success'});
			            	} else{
			            		$('#progress').fadeOut(1600);
			            		//$('#progress .bar').css('width','0%');
			            		noty({text: status, type: 'danger'});
			            	}
			                // Add each uploaded file name to the #files list
			               
			            },
			            progressall: function (e, data) {
			                // Update the progress bar while files are being uploaded
			                var progress = parseInt(data.loaded / data.total * 100, 10);
			                $('#progress').fadeIn();
			                $('#progress .bar').css(
			                    'width',
			                    progress + '%'
			                );
			            }
			        });
			    });
			    
		  </script>