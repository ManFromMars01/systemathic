<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Examinee List'); ?>
            <?php echo $success; ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Events </h2>
                        <div class="box-icon"></div>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                          <tbody>  
                                <?php foreach($examinee as $examinees): ?>
                                <?php $customer = $model->customer_det($examinees['CustNo']); ?>
                                <tr>
                                    <td><?php echo $customer->fields['StudentID'];?></td>
                                    <td><?php echo $customer->fields['SurName'];?>, <?php echo $customer->fields['FirstName'];?> <?php echo $customer->fields['MiddleName'];?></td>
                                    <td><?php echo $model->yourlevel($customer->fields['LevelID']); ?></td>
                                    <td><a onclick="return confirm('Are You Sure you want to remove this student?');" href="<?php echo base_url('page/controller/examinee_list.php?event_id='.$_GET['event_id'].'&cust_no='.$examinees['CustNo'])?>" class="btn btn-danger" id="remove">Remove</a></td>
                                    
                                </tr>
                                <?php endforeach; ?>           
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->




  





            
