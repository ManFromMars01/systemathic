<div id="content" class="span10">
            <!-- content starts -->
            <?php breadcrumb('Setup / Color List') ?>
            <?php successif('Delete Successfully');?>
            <?php add_link('Add Color',base_url('page/controller/add_color.php'))?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Color List </h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Code</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                              <?php foreach($color as $colors): ?>  
                              <tr>
                                    <td><?php echo $colors['ID'] ?></td>
                                    <td><?php echo $colors['Description'] ?></td>
                                    <td><?php echo $colors['Code'] ?></td>
                                    <td>
                                      <?php update_link("Update",base_url('page/controller/update_color.php?ID='.$colors['ID'])) ?>
                                      <?php delete_link('Delete',base_url('page/controller/delete.php?table=tcolor&return=color&id='.$colors['ID'])) ?>
                                    </td>
                              </tr>
                              <?php endforeach; ?>  
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
           