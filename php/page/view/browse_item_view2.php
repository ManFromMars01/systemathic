<div id="content" class="span10">
            <!-- content starts -->
            <?php breadcrumb('Item List') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Item List </h2>
                    </div>
                    
                    <div class="box-content">
                        <a class="btn btn-info" href="<?php echo controller('add_items2');?>"> Add Items</a>

                        <a class="btn btn-info" href="<?php echo controller('add_items');?>"> Add Book</a>
                        <br><br >
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th>Sku</th>
                                <th>Vendor</th>
                                <th>Description</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($titems as $titem): ?>
                            <tr>
                                <td><?php echo $titem['Sku']; ?></td>
                                <td><?php echo $titem['Name']?></td>
                                <td><?php echo $titem['Description'];?></td>
                                <td>
                                  <?php update_link('View/Edit',base_url('page/controller/update_items.php?sku='.$titem['Sku']));?>
                                  <?php delete_link('Remove','#');?>
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

           