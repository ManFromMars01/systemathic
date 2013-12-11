<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Country List') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Country List </h2>
                    </div>
                    
                    <div class="box-content">
                        <a class="btn btn-success" href="<?php echo base_url('page/controller/add_country.php');?>">Add Country </a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Country ID</th>
                                    <th>Country Name</th>
                                    <th>Contact Person</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($country as $countries): ?>
                            <tr>
                                <td><?php echo $countries['ID']; ?></td>
                                <td><?php echo $countries['Description']; ?></td>
                                <td><?php echo $countries['Contact']; ?></td>
                                <td><?php echo $countries['Address1']; ?></td>
                                <td><?php echo $countries['Phone']; ?></td>
                                <td><a href="mailto:<?php echo $countries['Email']; ?>"><?php echo $countries['Email']; ?></a></td>
                                <td>
                                    <a class="btn btn-info" href="<?php echo base_url('page/controller/edit_country.php?countryid='.$countries['ID']) ?>">View/Edit</a>
                                    <a class="btn btn-info" href="<?php echo base_url('page/controller/browse_branches.php?countryid='.$countries['ID']) ?>">View Branches</a>
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

</script>            