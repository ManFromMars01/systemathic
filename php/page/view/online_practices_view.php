<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Online Practice') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Online Practice </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <a class="btn btn-success" href="<?php echo base_url('page/controller/add_online_student.php');?>">Add Student </a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Student ID</th>
                                    <th>Student Name</th>
                                    <th>Level</th>
                                    <th>Date</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($onlinelist as $onlinelists): 
                               $yourcustomer = $model->select_where('tcustomer',  array('CustNo'=>$onlinelists['CustNo']));
                            ?>
                            <tr id="<?php echo  $onlinelists['CustNo']; ?>">
                                <td><?php echo $yourcustomer->fields['StudentID']; ?></td>
                                <td><?php echo  $yourcustomer->fields['SurName']; ?>, <?php echo  $yourcustomer->fields['FirstName']; ?> <?php echo $yourcustomer->fields['MiddleName']; ?></td>
                                <td><?php echo  $model->yourlevel($yourcustomer->fields['LevelID'],0); ?></td>
                                <td><?php echo  $onlinelists['Date']; ?></td>
                                <td><a class="btn btn-danger remove" alt='<?php echo $onlinelists['CustNo'];?>'>Remove</a></td>
                            </tr>
                            <?php endforeach ?>
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
            <div class="modal hide fade" id="myModal100">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3></h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                    <p>Are You Sure You want to remove this Student </p>
                    <div class="control-group">
                        <label class="control-label"></label>
                        <div class="controls">
                            <input type="button" id="y" name="saveme" alt="" value="Yes">
                            <input type="button" data-dismiss="modal" value="No">
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
    $('.remove').click(function(){
        custno = $(this).attr('alt');
        $("#myModal100").modal('show');
        $("#y").attr('alt',custno );
    });

    $('#y').click(function(){
        custno = $(this).attr('alt');
        $.ajax({
            url:'<?php echo base_url();?>page/ajax/online.php',
            type:'post',
            data:{custno:custno},
            dataType:'json',
            success:function(j){
                console.log(j);
                $('#myModal100').modal('hide');
                $('#'+custno).remove();
                noty({"text":" Successfully Remove","layout":"bottomLeft","type":"error"});

            }

        });        
    });

</script>            