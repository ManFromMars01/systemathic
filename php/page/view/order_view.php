<?php //echo var_dump($_SESSION['cart']); ?>
<div id="content" class="span10">
            <!-- content starts -->
            

            <?php breadcrumb('Online Practice') ?>
            
            <div class="row-fluid sortable" style="width:70%; float:left;">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Cart </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form id="cart">
                        <div>
                            <div class="control-group" style="float:left;">
                                <label class="control-label">Item Code:</label>
                                <div class="controls">
                                    <input type="text" id="itemcode" name="itemcode">
                                </div>
                            </div>
                           <div class="control-group" style="float:right;"><br />
                                <button class="btn btn-info" id="auto_generate">Auto Generate Order</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>    
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
                              if(isset($_SESSION['cart'])): 
                              foreach($_SESSION['cart'] as $key => $item):  
                              $desc  =$model->items($item['id']);  
                              ?>
                              <tr>
                                    <td><input type="text" name="item_code[]" style="width:30px;"  value="<?php echo $item['id'];?>" readonly /></td>
                                    <td><?php echo $desc->fields['Description']; ?></td>
                                    <td><input style="width:30px;" type="text" alt="<?php echo $item['id'];?>" class="qty" name="qty[]" value="<?php echo $item['quantity']?>"></td>
                                    <td><input style="width:80px;" type="text" class="price" name="price[]" value="<?php echo $item['price']; ?>" /></td>
                                    <td><input style="width:40px;" type="text" name="discount[]" value="<?php echo $item['discountg']; ?>"></td>
                              </tr>                               
                           <?php 
                            endforeach;
                            endif; 
                           ?>
                          </tbody>
                      </table>  
                      </form >          
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->

            <div class="row-fluid sortable" style="width:25%; float:right;"> 
            <div style="float:none; clear:both; display:block;"></div>       
                <div class="box span12" style="width:90%"> 
                    <div class="box-header well" data-original-title><h2><i class="icon-user"></i>Customer</h2></div>    
                    <div class="box-content">
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Customer Type:</label>
                            <div class="controls">
                                <select>
                                    <option>Franchisee</option>
                                    <!--<option>Student</option>-->
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput">Customer Name:</label>
                            <div class="controls">
                                <input type ="text" name value="">
                            </div>
                        </div>
                    </div>    
                </div><!--/span-->

                <div class="box span12" style="width:90%">     
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable">
                        <?php 
                            if(isset($_SESSION['cart'])){
                                foreach($_SESSION['cart']  as $key => $item):     
                                 $total = $total  + ($item['quantity'] * $item["price"]);
                                 $quantitys = $quantitys + $item['quantity'];
                                 if($item['discountg'] == "A" ){ $discounta =  $discounta  + ($item["price"] * $item["quantity"]);}
                                 if($item['discountg'] == "B" ){ $discountb =  $discountb  + ($item["price"] * $item["quantity"]);}   
                                 if($item['discountg'] == "C" ){ $discountc =  $discountc  + ($item["price"] * $item["quantity"]);}  


                                endforeach;

                                

                                $totalga = $discounta - ($discounta * ($groupa / 100));
                                $totalgb = $discountb  -  ($discountb * ($groupb / 100));
                                $totalgc = $discountc -  ($discountc * ($groupc / 100));
                                if($groupa == 0){ $totalga = $discounta ;}
                                if($groupb == 0){ $totalgb = $discountb ;}
                                if($groupc == 0){ $totalgc = $discountc ;}
                                
                                $supertotal =  $totalga + $totalgb + $totalgc;
                            }      
                        ?>


                            <tr>
                                <td>Items In Cart</td><td colspan="3" class="nocart"><?php echo $quantitys; ?></td>
                            </tr>
                            <tr>
                                <td>Sub Total</td><td colspan="3" class="subtotal"><?php echo number_format($total,2); ?></td>
                            </tr> 
                            <tr>
                                <th>Group Item %</th><th>Total Group Price</th><th>Discounted Price</th>  
                            </tr>
                            <tr>
                                <td>Group A <?php echo $groupa; ?>%</td><td class="forda"><?php echo number_format( $discounta,2); ?></td><td class="disca"><?php echo number_format($totalga,2); ?></td>  
                            </tr>
                            <tr>
                                <td>Group B <?php echo $groupb; ?>%</td><td class="fordb"><?php echo number_format( $discountb,2); ?></td><td class="discb"><?php echo number_format($totalgb,2); ?></td> 
                            </tr>
                            <tr>
                                <td>Group C <?php echo $groupc; ?>%</td><td class="fordc"><?php echo number_format( $discountc,2); ?></td><td class="discc"><?php echo number_format($totalgc,2); ?></td> 
                            </tr>
                            <tr>
                                <td  style=" background:#7dc5ff; color:white;"><strong>Total</strong></td><td colspan="3" style=" background:#7dc5ff; color:white;"><strong id="total"><?php echo number_format($supertotal,2); ?></strong></td>
                            </tr>
                        </table>

                    </div>    
                </div>
                <div style="width:100%; text-align:center;">
                    <form method="post"  action="<?php echo base_url('page/controller/process_order.php');?>">
                        <button type ="submit"class="btn btn-info" style="width:80%;" >Order</button>
                    </form>
                </div>    


                

            
            </div><!--/row-->
            <div class="clearfix"></div>
                <!-- content ends -->
            </div><!--/#content.span10-->
            

