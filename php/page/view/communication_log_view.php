<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('<a href="'.base_url('contact.php').'">Contact</a> <a href="#">/ Communication Log</a>') ?>
            <?php echo $success; ?>
            <a href="<?php echo base_url('page/controller/add_communication_log.php') ?>" class="btn btn-info">Add Log</a> 
  
            
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
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Parent</th>
                                    <th>Student</th>
                                    <th>Topics</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                           
                          <tbody>
                                <?php foreach ($activity as $activities): ?>
                                <?php $customers= $model->customer_det($activities['CustNo']); ?>
                                <tr>
                                    <td><?php echo $activities['Date']; ?></td>
                                    <td><?php echo $activities['Time']; ?></td>
                                    <td><?php echo $activities['ParentName'];?></td>
                                    <td><?php echo $customers->fields['SurName'];?>, <?php echo $customers->fields['FirstName'];?> <?php echo $customers->fields['MiddleName'];?> </td>
                                    <td><?php echo $activities['Topics']; ?></td>
                                    <td><a onclick="return confirm('Are you Sure to remove this activity ?');" href="<?php echo base_url('page/controller/communication_log.php?ref_id='.$activities['ReferenceID'])?>" class="btn btn-danger">Remove</a></td>
                                </tr>
                               <?php endforeach;?>
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->