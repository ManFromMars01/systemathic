<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('SetUp / Size List') ?>
            <?php successif('Delete Successfully');?>
            <?php add_link('Add Size',base_url('page/controller/add_size.php'))?>
            <div class="row-fluid sortable" style="width:70%">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Size List </h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Code</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                              <?php foreach($sizes as $size): ?>  
                              <tr>
                                    <td><?php echo category_desc($size['CatID']) ?></td>
                                    <td><?php echo $size['Description'] ?></td>
                                    <td><?php echo $size['Code'] ?></td>
                                    <td>
                                      <?php update_link('Update',base_url('page/controller/update_size.php?ID='.$size['ID'])) ?>
                                      <?php delete_link('Delete',base_url('page/controller/delete.php?table=tsize&return=size&id='.$size['ID'])) ?>
                                    </td>
                              </tr>
                              <?php endforeach; ?>  
                          
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
           