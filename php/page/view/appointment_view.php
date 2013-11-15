<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="#">/ Appointment</a>') ?>
            <?php echo $success; ?>
            <a href="<?php echo base_url('page/controller/add_appointment.php') ?>" class="btn btn-info">Add Appointment</a> 
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Appointment</h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Teacher</th>
                                    <th>Time - Duration</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                           
                          <tbody>
                                <?php foreach ($appointment as $appointments): ?>
                                <?php $teacher = $model->select_where('tteacher',array('ID' => $appointments['TeacherID'] )); ?>
                                <tr>
                                    <td><?php echo $appointments['Date'];?></td>
                                    <td><?php echo $teacher->fields['Name'];?></td>
                                    <td><?php echo $appointments['StartTime'];?> - Duration(<?php echo $appointments['Duration'];?>)</td>
                                    <td><?php echo $appointments['Description'];?></td>
                                    <td><a onclick="return confirm('Are you Sure to remove this Appointment ?');" href="<?php echo base_url('page/controller/appointment.php?app_id='.$appointments['AppointmentID'])?>" class="btn btn-danger">Remove</a></td>
                                </tr>
                               <?php endforeach;?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->