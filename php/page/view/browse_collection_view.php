<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('SetUp / Collection List') ?>
            <?php successif('Delete Successfully');?>
            <?php add_link('Add Collection',base_url('page/controller/add_collection.php'))?>
            <div class="row-fluid sortable" style="width:70%">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Collection List </h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>Collection</th>
                                    <th>Code</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                              <?php foreach($collections as $collection): ?>  
                              <tr>
                                    <td><?php echo $collection['Description'] ?></td>
                                    <td><?php echo $collection['Code'] ?></td>
                                    <td>
                                      <?php update_link('Update',base_url('page/controller/update_collection.php?ID='.$collection['ID'])) ?>
                                      <?php delete_link('Delete',base_url('page/controller/delete.php?table=tcollection&return=collection&id='.$collection['ID'])) ?>
                                    </td>
                              </tr>
                              <?php endforeach; ?>     
                        </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
           