<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Schedulig / Teacher Schedule') ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Teacher Schedule</h2>
                        <div class="box-icon"></div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                                <tr>
                                    <th>Branch Name</th>
                                    <th>Teacher Name</th>
                                    <th>Action</th>
                                </tr>
                          </thead> 
                                <?php foreach($tteacher as $teacher): ?>
                                <tr>
                                    <td><?php echo $teacher['BranchID'];?></td>
                                    <td><?php echo $teacher['Name'];?></td>
                                    <td><a class="btn btn-success" href="#">View Schedule</a></td>
                                </tr>
                                <?php endforeach; ?>    
                          <tbody>
                                
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->

            







            
