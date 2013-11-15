<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="#">/ Reminder</a>') ?>
            <?php echo $success; ?>
            <a href="<?php echo base_url('page/controller/add_reminder.php') ?>" class="btn btn-info">Add Reminder</a> 
  
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Communication LOg</h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Teacher</th>
                                    <th>Date</th>
                                    <th>Reminder</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                           
                          <tbody>
                                <?php foreach ($reminder as $reminders): ?>
                                <?php $teacher = $model->select_where('tteacher',array('ID' => $reminders['TeacherID'] )); ?>
                                <tr>
                                    <td><?php echo $teacher->fields['Name'];?></td>
                                    <td><?php echo $reminders['Date'];?></td>
                                    <td><?php echo $reminders['Reminder'];?></td>
                                    <td><a onclick="return confirm('Are you Sure to remove this Reminder ?');" href="<?php echo base_url('page/controller/reminder.php?rem_id='.$reminders['ID'])?>" class="btn btn-danger">Remove</a></td>
                                </tr>
                               <?php endforeach;?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->