<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Branches List - '.$_GET['countryid']) ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Branches List - <?php $model->country($_GET['countryid']) ?> </h2>
                    </div>
                    
                    <div class="box-content">
                        <a class="btn btn-success" href="<?php echo base_url('page/controller/add_branch.php?countryid='.$_GET['countryid']);?>">Add Branch </a>
                        <a class="btn btn-info" href="<?php echo base_url('page/controller/add_hq_branch.php?countryid='.$_GET['countryid']);?>">Manage HQ</a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Country ID</th>
                                    <th>Branch Name</th>
                                    <th>Contact Person</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($branch as $branches): ?>
                            <tr>
                                <td><?php echo $branches['BranchID']; ?></td>
                                <td><?php echo $branches['Description']; ?></td>
                                <td><?php echo $branches['Contact']; ?></td>
                                <td><?php echo $branches['Address1']; ?></td>
                                <td><?php echo $branches['Phone']; ?></td>
                                <td><?php echo $branches['Email']; ?></td>
                                <td>
                                    <div class="stat<?php echo $branches['BranchID'];?>"><?php branch_status($branches['Activated']);?></div>
                                </td>
                                <td>
                                    <a class="btn btn-info"  href="<?php echo base_url('page/controller/edit_branch.php?id='.$branches['BranchID']) ?>">View/Edit</a>
                                    <?php button_requirements($branches['Activated'],$branches['BranchID']);?>
                                    <?php button_activation($branches['Activated'],$branches['BranchID']); ?>
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

    $('.activatethis').click(function(){
        var branch = $(this).attr('alt');
        if (confirm('Are You Sure to activate this branch?')){
            $.ajax({
                url:'<?php echo base_url('page/ajax/activate_branch.php')?>',
                type:'post',
                data:{branch:branch,activate:'1'},
                dataType:'json',
                success:function(j){
                   console.log(j); 
                   <?php notyme_suc('Branch Activated!!'); ?>
                   $('.stat'+branch).html('<span class="label label-success">Activated</span>');
                   $('#'+branch).removeClass("btn-success activatethis").addClass("btn-danger dactivatethis").html('Deactivate');
                },
                error:function(xhr,status,error){
                    alert(xhr.responseText);
                }
            });
        }
    });



    

    $('.dactivatethis').click(function(){
       var branch = $(this).attr('alt');
       if(confirm('Are You Sure You Want To Deactivate This Branch?')){
        $.ajax({
            url:'<?php echo base_url('page/ajax/activate_branch.php')?>',
            type:'post',
            data:{branch:branch,activate:'2'},
            dataType:'json',
            success:function(j){
                console.log(j);
                <?php notyme_danger('Branch Deactivated!!'); ?>
                $('.stat'+branch).html('<span class="label label-important">Deactivated</span>');

            },
        });

       } 
    });


</script>            