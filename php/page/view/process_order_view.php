<?php //echo var_dump($_SESSION['cart']); ?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Order') ?>
            <?php echo success("<strong>Order Transaction Complete</strong>");  ?>
            <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i></h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                          <h3>Your Order</h3> 
                                <table class="table table-striped table-bordered bootstrap-datatable">
                                  <thead>
                                      <tr>
                                            <th>Item Code</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                      </tr>
                                  </thead>
                                   
                                  <tbody class="orders">
                                      <?php 
                                      foreach($neworder as $neworders):  
                                       $desc = $model->items($neworders['ItemNo']);  
                                        
                                      ?>
                                      <tr>
                                            <td><?php echo $neworders['ItemNo'];  ?></td>
                                            <td><?php echo $desc->fields['Description']; ?></td>
                                            <td><?php echo $neworders['QtyOrdered']; ?></td>
                                            <td><?php echo $neworders['CostOrdered']; ?></td>
                                            <td>no discount</td>
                                      </tr>                               
                                   <?php endforeach; ?>
                                  </tbody>
                              </table>  

                    </div>
                </div><!--/span-->
            
            </div><!--/row-->

         
            </div><!--/#content.span10-->
            

