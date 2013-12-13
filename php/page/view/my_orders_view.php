<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('My Orders'); ?>
            <?php echo $success; ?>
            
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i>My Orders</h2>
                    </div>
                    
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable ">
                          <thead>
                              <tr>
                                    <th>PO No.</th>
                                    <th>Vendor</th>
                                    <th>Date Order</th>
                                    <th>Date Received</th>
                                    <th>Total Amount</th>
                                    <?php if($_SESSION['OrderHQ'] == "TW001"){ ?>
                                    <th>Exchange Rate</th>
                                    <th>Total Amount (<?php echo $mycurrency?>)</th>
                                    <?php } ?>
                                    <th>Status</th>
                                    <th>Action</th>
                              </tr>
                          </thead>
                           
                          <tbody>
                              <?php foreach($orders as $order): ?>
                              <tr>
                                    <td><?php echo $order['PONumber'];?></td>
                                    <td><?php vendor_name($order['VendorNo']);?></td>
                                    <td><?php echo $order['DateOrder'];?></td>
                                    <td><?php echo $order['DateCompleted'];?> <?php order_status($order['Status']) ?></td>

                                    <td><?php echo $order['Currency']." ".$order['TotAmount'];?></td>
                                    <?php if($_SESSION['OrderHQ'] == "TW001"){ ?>
                                    <td> TWD 1.00 = <?php echo $mycurrency;?> <?php echo $order['CurrencyRate'];?></td>
                                    <td> <?php echo $mycurrency;?> <?php echo  $owncur = $order['CurrencyRate'] * $order['TotAmount']; ?> </td>
                                    <?php } ?>
                                    <td><?php order_status($order['Status']) ?></td>
                                    <td>
                                        <a href="<?php echo base_url('page/controller/order_items.php?branchid='.$order['BranchID'].'&ponumber='.$order['PONumber']) ?>" class="btn btn-info">View Items</a>
                                        <a href="<?php echo base_url('page/controller/my_orders.php?branchid='.$order['BranchID'].'&ponumber='.$order['PONumber']) ?>" class="btn btn-info">Received Order</a>
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
                  