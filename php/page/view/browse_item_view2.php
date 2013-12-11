<div id="content" class="span10">
            <!-- content starts -->
            <?php breadcrumb('Item List') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Item List </h2>
                    </div>
                    
                    <div class="box-content">
                        <a class="btn btn-info" href="<?php echo base_url('Updatetitemsadd.php');?>"> Add Items</a>
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

           