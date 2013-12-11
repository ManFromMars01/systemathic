<div id="content" class="span10">
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="index.php">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Level  List</a>
                    </li>
                </ul>
            </div>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Level</h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                    <th>ID</th>
                                    <th>Description</th>
                                    <th>Action</th>
                              </tr>

                          </thead>   

                          <tbody>
                            <?php foreach($level as $levels): ?>
                            <tr>
                                <td><?php echo $levels['ID'] ?></td>
                                <td><?php echo $levels['Description'] ?></td>
                                <td><a href="<?php echo base_url("BrowseSchedListlist.php?ID1='".$_SESSION['UserValue1']."'&ID2='".$_SESSION['UserValue2']."'&ID3=".$levels['ID']);?>" class="btn btn-info">View Class Schedule</a></td>
                            </tr>
                            <?php endforeach; ?>
                            
                          </tbody>
                      </table>             
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->  