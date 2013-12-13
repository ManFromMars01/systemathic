<?php //echo var_dump($_SESSION['cart']); ?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Your Order') ?>
            
            <div class="row-fluid sortable" style="width:70%; float:left;">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Order </h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable">
                          <thead>
                              <tr>
                                    <th>Vendor Name: <?php vendor_name($po_head->fields['VendorNo']);?></th>
                                    <th>Date Ordered:<?php echo $po_head->fields['DateOrder']   ?> </th>
                              </tr>
                          </thead>     
                        </table>  
                        <form id="cart"> 
                        <table class="table table-striped table-bordered bootstrap-datatable">
                          <thead>
                              <tr>
                                    <th>Item Code</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Item Group</th>
                              </tr>
                          </thead>     
                          <tbody class="orders">
                              <?php 
                              $qty = 0;
                              foreach($order_items as $items): ?>
                              <?php  $titems = $model->items($items['ItemNo']); ?>
                              <tr>
                                <td><?php echo $items['ItemNo']; ?></td>
                                <td><?php echo $titems->fields['Description'];?></td>
                                <td><?php echo $items['QtyOrdered']; ?></td>
                                <td><?php echo $po_head->fields['Currency']." ".$items['CostOrdered'];?></td>
                                <td><?php echo $items['DiscountRate']?>%</td>
                                <?php   $qty = $qty + $items['QtyOrdered']; ?>
                              </tr>
                              <?php endforeach; ?> 
                          </tbody>
                      </table>  
                      </form >          
                    </div>
                </div><!--/span-->
            </div><!--/row-->


            <div class="row-fluid sortable" style="width:25%; float:right;"> 
            <div style="float:none; clear:both; display:block;"></div>       
                <div class="box span12" style="width:90%">     
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable">
                            <tr>
                                <td>Items Ordered</td><td colspan="3"><?php echo $qty;?></td>
                            </tr>
                            <tr>
                                <td>Sub Total</td><td colspan="3"><?php echo $po_head->fields['Currency']." ".$po_head->fields['SubTotal'] ?></td>
                            </tr> 
      
                            <tr>
                                <td>Discount Amount</td><td colspan="3"><?php echo $po_head->fields['Currency']." ".$po_head->fields['DiscountAmt'] ?></td>
                            </tr> 
                            <tr>
                                <td  style=" background:#7dc5ff; color:white;"><strong>Total Amt</strong></td>
                                <td colspan="3" style=" background:#7dc5ff; color:white;"><strong><?php echo $po_head->fields['Currency']." ".$po_head->fields['TotAmount'] ?><strong></td>
                            </tr>
                            <?php if($_SESSION['OrderHQ'] == "TW001"){ ?>
                            <tr>
                                <td  style=" background:#7dc5ff; color:white;"><strong>Total Amt in <?php echo $mycurrency; ?></strong></td>
                                <td colspan="3" style=" background:#7dc5ff; color:white;"><strong><?php echo $mycurrency." ".$po_head->fields['TotAmount'] * $po_head->fields['CurrencyRate'];?><strong></td>
                            </tr>
                            <?php } ?>
                        </table>

                    </div>    
                </div>               
            </div><!--/row-->
            <div class="clearfix"></div>
                <!-- content ends -->
            </div><!--/#content.span10-->
            


