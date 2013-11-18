
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Assessment / Assessment Form') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>List of Students Schedule </h2>
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
                                  <th>Student Id</th>  
                                  <th>Student Name</th>
                                  <th>Level</th>
                                  <th>Actions</th>

                              </tr>
                          </thead>   
                          <tbody>
                           
                            <?php foreach($students as $student):?>    
                            <tr>
                                <td><?php echo $student['StudentID'];?> </td>
                                <td><?php echo $student['SurName'] . ', ' .$student['FirstName'] . ' ' . $student['MiddleName'] ;?></td>
                                <td><?php echo $desc; ?></td>
                            
                                <td>

                                  <a class="btn btn-info" href="student_schedule_detail.php?ID1='<?php echo $student['CountryID'] ?>'&amp;ID2='<?php echo $student['BranchID'] ?>'&amp;CustNo=<?php echo $student['CustNo']?>  "><i class="icon-edit icon-white"></i> View</a>
                                
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
     