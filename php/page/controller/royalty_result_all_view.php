<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Franchising / Royalty Result') ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Royalty Result <?php echo $breadcrumbs ?> </h2>
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
                                    <th>Royalty ID</th>
                                    <th>Description</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>For Royalty Amount</th>
                                    <th>Total Royalty Amount</th>
                                    <th>Percent to Master</th>
                                    <th>Percent to HQ</th>
                                    <th>Amt. to Master</th>
                                    <th>Amt. to HQ</th> 
                                    
                              </tr>
                          </thead>
                           
                          <tbody>
                            <?php foreach($onlinelist as $onlinelists): 
                               $yourcustomer = $model->select_where('tcustomer',  array('CustNo'=>$onlinelists['CustNo']));
                            ?>
                            <tr id="<?php echo  $onlinelists['CustNo']; ?>">
                                <td><?php echo $yourcustomer->fields['StudentID']; ?></td>
                                <td><?php echo  $yourcustomer->fields['SurName']; ?>, <?php echo  $yourcustomer->fields['FirstName']; ?> <?php echo $yourcustomer->fields['MiddleName']; ?></td>
                                <td><?php echo  $model->yourlevel($yourcustomer->fields['LevelID'],0); ?></td>
                                <td><?php echo  $onlinelists['Date']; ?></td>
                                <td><a class="btn btn-danger remove" alt='<?php echo $onlinelists['CustNo'];?>'>Remove</a></td>
                            </tr>
                            <?php endforeach ?>
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
                <!-- content ends -->
            </div><!--/#content.span10-->
               