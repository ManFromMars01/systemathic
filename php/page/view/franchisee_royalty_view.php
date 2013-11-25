<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Royalty Table View') ?>
            
            <h3>Country: Philippines</h3> 
            <h3>Currency: <?php echo $model->currencys($country); ?></h3>
            <div class="clearfix"></div>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Head Office</h2>
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
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Branch</th>
                                    <th>HQ Royalty</th>
                                    <th>UF Royalty</th>    
                                    <th>Total Royalty</th>
                                    <th>Action</th>     
                              </tr>
                          </thead>
                           
                            

                          <tbody>
                          <?php foreach($branchhq as $branch):  ?> 
                            <?php $countfirst = $model->count_where('eroyalty',array('BranchID' => $branch['BranchID']));

                            if($countfirst != 0): $royalty = $model->select_where('eroyalty', array('BranchID' => $branch['BranchID'] ));?>
                                                        
                            <?php 
                            $totalroyalhq = 0;
                            $tomaster = 0;
                            $tohq = 0;
                            $totalmaster = 0;

                            foreach($royalty as $royal):
                                    $year = $royal['Year'];
                                    $month = $royal['Month'];
                                    $totalroyalhq = $totalroyalhq + $royal['RoyaltyAmtOfHQCtr'];   
                                    //$totalmaster   = $totalmaster +  $royal['CtrRoyaltyToHQ'] + $royal['CtrRoyaltyToMstr'];

                            endforeach; ?>
                            <tr>
                                <td><?php echo $year;?></td>
                                <td><?php echo $month;?></td>
                                <td><?php $model->branch($branch['BranchID']);?></td>
                                <td><?php echo  $model->currencys($country)." ".number_format($totalroyalhq, 2);?></td>
                                <?php  $foreach = $model->select_where('tbranch', array('CountryID' => $branch['CountryID'], 'HQOperation' => 'No')); ?>
                                <?php  
                                  $totalroyalty = 0;  
                                  foreach($foreach as $foreachs):
                                     $royaltys = $model->select_where('eroyalty', array('BranchID' => $branch['BranchID'] ));
                                     foreach($royaltys as $royal):
                                            $totalroyalty  = $totalroyalty + $foreachs['CtrRoyaltyToMstr'];
                                    endforeach;   

                                                  $supertotal = $supertotal    + $totalroyalty ;
                                  endforeach; 
                                ?>
                                <td> <?php echo  $model->currencys($country)." ".number_format($supertotal, 2);  ?></td>
                                <td> <?php  $tomastertotal=  $supertotal + $totalroyalhq; $curtotal = number_format($tomastertotal, 2); echo $model->currencys($country)." ".$curtotal;?></td>
                                
                                <td>
                                    <button class="btn btn-info">Royalty Details</button>
                                </td>  
                            </tr>


                         <?php else: ?>   
                            <tr>
                                <td><?php echo $year;?></td>
                                <td><?php echo $month;?></td>
                                <td><?php $model->branch($branch['BranchID']);?></td>
                                <td><?php echo 'Not Set';?></td>
                                <td><?php echo 'Not Set';?></td>  
                                <td><?php echo 'Not Set';?></td>  
                                <td>
                                    <button class="btn btn-info">Royalty Details</button>
                                </td>
                            </tr>

                        <?php endif; ?>
                            
                        <?php endforeach; ?>    
              
                            
                          </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Unit Franchisee</h2>
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
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Branch</th>
                                    <th>Royalty for HQ</th>
                                    <th>Royalty for Taiwan</th>    
                                    <th>Total Royalty</th>
                                    <th>Action</th>     
                              </tr>
                          </thead>
                           
                            

                          <tbody>
                          <?php foreach($branches as $branch):  ?> 
                            <?php $countfirst = $model->count_where('eroyalty',array('BranchID' => $branch['BranchID']));

                            if($countfirst != 0): $royalty = $model->select_where('eroyalty', array('BranchID' => $branch['BranchID'] ));?>
                                                        
                            <?php 
                            $totalroyalhq = 0;
                            $tomaster = 0;
                            $tohq = 0;
                            $totalmaster = 0;

                            foreach($royalty as $royal):
                                    $year = $royal['Year'];
                                    $month = $royal['Month'];
                                    $totalroyalhq = $totalroyalhq + $royal['RoyaltyAmtOfHQCtr']; 
                                    $tohq =  $tohq + $royal['CtrRoyaltyToHQ'];
                                    $tomaster = $tomaster + $royal['CtrRoyaltyToMstr'];     
                                    $totalmaster   = $totalmaster +  $royal['CtrRoyaltyToHQ'] + $royal['CtrRoyaltyToMstr'] ;
                            endforeach; ?>
                            <tr>
                                <td><?php echo $year;?></td>
                                <td><?php echo $month;?></td>
                                <td><?php $model->branch($branch['BranchID']);?></td>
                                <td><?php $model->currencys($branch['CountryID']);?> <?php echo $tohq ;?></td>
                                <td><?php $model->currencys($branch['CountryID']);?> <?php echo $tomaster;?></td>  
                                <td><?php $model->currencys($branch['CountryID']);?> <?php echo $totalmaster;?></td>
                                <td>
                                    <button class="btn btn-info">Royalty Details</button>
                                </td>  
                            </tr>


                         <?php else: ?>   
                            <tr>
                                <td><?php echo $year;?></td>
                                <td><?php echo $month;?></td>
                                <td><?php $model->branch($branch['BranchID']);?></td>
                                <td><?php echo 'Not Set';?></td>
                                <td><?php echo 'Not Set';?></td>  
                                <td><?php echo 'Not Set';?></td>  
                                <td>
                                    <button class="btn btn-info">Royalty Details</button>
                                </td>
                            </tr>

                        <?php endif; ?>
                            
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