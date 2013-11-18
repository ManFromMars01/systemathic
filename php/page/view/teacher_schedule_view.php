
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Assessment / Assessment Form') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>List of Teachers Schedule </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <!-- <a class="btn btn-success" href="UpdatetStudentadd.php">Add</a> -->
                        <br>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                  <th>Teacher Id</th>  
                                  <th>Teacher Name</th>
                                  <th>Actions</th>

                              </tr>
                          </thead>   
                          <tbody>
                           
                            <?php foreach($teachers as $teacher):?>    
                            <tr>
                                <td><?php echo $teacher['ID']?></td>
                                <td><?php echo $teacher['Name']?></td>
                            
                                <td>

                                  <a class="btn btn-info" href="teacher_schedule_detail.php?ID1='<?php echo $teacher['CountryID'] ?>'&amp;ID2='<?php echo $teacher['BranchID'] ?>'&amp;ID3=<?php echo $teacher['ID'] ?>"><i class="icon-edit icon-white"></i> View</a>
                                
                                </td>
                          
                            </tr>
                        <?php endforeach; ?>
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
     