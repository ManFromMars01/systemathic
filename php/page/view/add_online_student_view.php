<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('OnlinePractices/Add Student') ?>
            
            <div class="row-fluid sortable">
                <div class="box-content">
                        <br><br >
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
                               <?php foreach ($admitted as $student): ?> 
                               <?php $countmefirst = $model->count_where('eonline', array('CustNo' => $student['CustNo'])); ?>
                               <?php if($countmefirst < 1): ?>
                               <tr>
                                  <td><?php echo $student['StudentID']; ?></td>
                                  <td>
                                    <?php echo $student['SurName']?>, <?php echo $student['FirstName']?> <?php echo $student['MiddleName']?>
                                    <input type="hidden" class="<?php echo $student['StudentID']; ?>" value="<?php echo $student['SurName']?>, <?php echo $student['FirstName']?> <?php echo $student['MiddleName']?>">
                                  </td>
                                  <td><?php echo $model->yourlevel($student['LevelID'])?></td>
                                  <td><a  href="#" class="add_online btn btn-success" alt="<?php echo $student['StudentID']; ?>">Add This Student</a></td>  
                               </tr>
                             <?php endif; ?>
                               <?php endforeach; ?>      
                          </tbody>
                      </table>            
                    </div>

            </div><!--/row-->
            
                    <!-- content ends -->
            </div><!--/#content.span10-->

            <div class="modal hide fade" id="myModal100">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Add To Online Practices</h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                    <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge focused"  id="name_student" value="">
                            <input type="hidden" name="idno" id="idno" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <input type="text"  id="pword_stud" name="pword_stud" value="">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="submit" name="saveme" value="Submit">
                        </div>
                    </div>
                </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Close</a>
                    <!--<a href="BrowseStudentlist.php" class="btn btn-primary">Back To Student List</a>-->
                </div>
            </div>

  <script>
    $('.add_online').click(function(){
        idno = $(this).attr('alt');
        fname =  $('.'+idno).val(); 
        $('#name_student').val(fname);
        $('#idno').val(idno);
        $("#myModal100").modal('show');

    });

  </script>          