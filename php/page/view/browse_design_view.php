<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('SetUp / Size List') ?>
            <?php successif('Delete Successfully');?>
            <?php add_link('Add Design',base_url('page/controller/add_design.php'))?>
            <div class="row-fluid sortable" style="width:70%">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Design List </h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Design</th>
                                    <th>Code</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                              <?php foreach($designs as $design): ?>  
                              <tr>
                                    <td><?php echo $design['Description'] ?></td>
                                    <td><?php echo $design['Code'] ?></td>
                                    <td>
                                      <?php update_link('Update',base_url('page/controller/update_design.php?ID='.$design['ID'])) ?>
                                      <?php delete_link('Delete',base_url('page/controller/delete.php?table=tdesign&return=design&id='.$design['ID'])) ?>
                                    </td>
                              </tr>
                              <?php endforeach; ?>  
                          
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
           