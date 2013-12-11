<div id="content" class="span10">
            <!-- content starts -->
            <?php breadcrumb('Item List') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Inventory -  Item List </h2>
                    </div>
                    <div class="box-content">
                         <a class="btn btn-success" href="<?php echo controller('add_item_inventory'); ?>">Add CMA Item in Inventory</a>
                        <a class="btn btn-success" href="<?php echo controller('add_items'); ?>">Add Your Own Item In Inventory</a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Stock</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($titems as $titem): ?>
                            <?php $desc = $model->select_where('titems',array('ItemNo' => $titem['ItemNo'])); ?>
                            <tr>
                                <td><?php echo $titem['ItemNo']; ?></td>
                                <td><?php echo $desc->fields['Description'];?></td>
                                <td><?php echo $titem['QtyOnHand'];?></td>
                                <td>
                                    <button class="btn btn-info">Order</button> 
                                    <button class="btn btn-info">View</button>
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

           