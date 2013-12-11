<div id="content" class="span10">

            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Add  Item </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action="@UpdatetStudentFormAction@"  id="form31" name="form31" method="post" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="MODE" value="1">
                           
                           <?php if($_SESSION['UserValue1'] == "ADM" ): ?>
                           <div class="control-group">
                                <label class="control-label"  for="focusedInput">Country ID:</label>
                                <div class="controls">
                                  <input  class="" name="txttitemsCountryID" id="" type="text" value="" required>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Branch ID:</label>
                                <div class="controls">
                                  <input  class="" name="txttitemsBranchID" id="" type="text" value="" required>
                                </div>
                            </div>
                               

                           <?php else: ?>

                            <input class="" name="txttitemsCountryID" type="hidden" value="<?php echo $_SESSION['UserValue1'] ?>" readonly>
                           <input class="" name="txttitemsBranchID" type="hidden" value="<?php echo $_SESSION['UserValue2'] ?>" readonly>
                           <?php endif; ?>
                           

                

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Item No:</label>
                                <div class="controls">
                                  <input  class="" name="txttitemsItemNo" id="" type="text" value="" required>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Type:</label>
                                <div class="controls">
                                  <select class="itemtype" id="itemtype" name="itemtype">
                                    <option value="">Please Select A Type</option>
                                    <option value='Books'>Books</option>
                                    <option value='Other'>Other</option>
                                  </select>
                                  <input type="hidden" id="txttitemsIsBook" name="txttitemsIsBook" value="" >
                                </div>
                            </div>

                            <div class="control-group txttitemsDescription">
                                <label class="control-label"  for="focusedInput">Description:</label>
                                <div class="controls">
                                  <textarea name="txttitemsDescription" required></textarea>
                                </div>
                            </div>

                            <div class="control-group displaynone bookcategory hidebookcategory">
                                <label class="control-label" for="focusedInput">Book Category: </label>
                                <div class="controls">
                                   <input type="checkbox" name="" id="isabacus" class="bookcat" value="abacus"> Abacus
                                   <input type="checkbox" name="" id="ismental" class="bookcat" value="mental"> Mental
                                   <input type="checkbox" name="" id="issupply" class="bookcat" value="supplementary"> Supplementary
                                   
                                   <input type="hidden" class ="myabacus ischeck"  name="txttitemsIsAbacus" value="">
                                   <input type="hidden" class ="mymental ischeck" name="txttitemsIsMental" value="">
                                   <input type="hidden" class ="mysupplementary ischeck"name="txttitemsIsSupp" value="">
                                </div>
                            </div>

                            <div id="group-abacus" class="displaynone hidebookcategory">
                                <h4>Abacus</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsAbaDesc" id="txttitemsAbaDesc" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</label>
                                    <div class="controls">
                                      <input class="abacusrpt" name="txttitemsAbaRptCnt1" id="abacusrpt1" type="text" value="">
                                    </div>
                                </div>
                               

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nexta">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="anbookcode1 anbookcode" name="txttitemsAbaNxtBook1">
                                        <input type="hidden" class="anbookcode2 anbookcode" name="txttitemsAbaNxtBook2">
                                        <input type="hidden" class="anbookcode3 anbookcode" name="txttitemsAbaNxtBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previousa">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="apbookcode1 apbookcode" name="txttitemsAbaPrvBook1">
                                        <input type="hidden" class="apbookcode2 apbookcode" name="txttitemsAbaPrvBook2">
                                        <input type="hidden" class="apbookcode3 apbookcode" name="txttitemsAbaPrvBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="prea">
                                            <?php echo $optionall; ?>
                                        </select>
                                             
                                        <input type="hidden" class="preabookcode1 preabookcode" name="txttitemsAbaPreBook1" value="">
                                        <input type="hidden" class="preabookcode2 preabookcode" name="txttitemsAbaPreBook2" value="">
                                        <input type="hidden" class="preabookcode3 preaookcode" name="txttitemsAbaPreBook3" value="">
                                    </div>
                                </div>

                                
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaDigitStart" id="" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaDigitEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaNumStart" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaNumEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaBookGrade" id="" type="text" value="">
                                    </div>
                                </div>
                            
                            </div>


                            <div id="group-mental" class="displaynone hidebookcategory">
                                <h4>Mental</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsMenDesc" id="txttitemsMenDesc" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group mbook1 mbook displaynone">
                                    <label class="control-label"  for="focusedInput">Repeat Count:<p class="mbookcode1"></p></label>
                                    <div class="controls">
                                      <input class="mentalrpt" name="txttitemsMenRptCnt1" id="mentalrpt1" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nextm">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="mnbookcode1 mnbookcode" name="txttitemsMenNxtBook1">
                                        <input type="hidden" class="mnbookcode2 mnbookcode" name="txttitemsMenNxtBook2">
                                        <input type="hidden" class="mnbookcode3 mnbookcode" name="txttitemsMenNxtBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previousm">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="mpbookcode1 mpbookcode" name="txttitemsMenPrvBook1">
                                        <input type="hidden" class="mpbookcode2 mpbookcode" name="txttitemsMenPrvBook2">
                                        <input type="hidden" class="mpbookcode3 mpbookcode" name="txttitemsMenPrvBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="prem">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="prembookcode1 prembookcode" name="txttitemsMenPreBook1" value="">
                                        <input type="hidden" class="prembookcode2 prembookcode" name="txttitemsMenPreBook2" value="">
                                        <input type="hidden" class="prembookcode3 prembookcode" name="txttitemsMenPreBook3" value="">
                                    </div>
                                </div>
                                
                               

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenDigitStart" id="" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenDigitEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenNumStart" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenNumEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenBookGrade" id="" type="text" value="">
                                    </div>
                                </div>

                            </div>


                            <div id="group-supplementary" class="displaynone hidebookcategory">
                                <h4>Supplementary</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsSuppDesc" id="txttitemsSuppDesc"  type="text" value="">
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</label>
                                    <div class="controls">
                                      <input class="supprpt" name="txttitemsSuppRptCnt1" id="supprpt1" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nexts">
                                            <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="snbookcode1 snbookcode" name="txttitemsSuppNxtBook1">
                                        <input type="hidden" class="snbookcode2 snbookcode" name="txttitemsSuppNxtBook2">
                                        <input type="hidden" class="snbookcode3 snbookcode" name="txttitemsSuppNxtBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previouss">
                                             <?php echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="spbookcode1 spbookcode" name="txttitemsSuppPrvBook1">
                                        <input type="hidden" class="spbookcode2 spbookcode" name="txttitemsSuppPrvBook2">
                                        <input type="hidden" class="spbookcode3 spbookcode" name="txttitemsSuppPrvBook3">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="pres">
                                             <?php  echo $optionall; ?>
                                        </select>
                                        <input type="hidden" class="presbookcode1 presbookcode" name="txttitemsSuppPreBook1" value="">
                                        <input type="hidden" class="presbookcode2 presbookcode" name="txttitemsSuppPreBook2" value="">
                                        <input type="hidden" class="presbookcode3 presbookcode" name="txttitemsSuppPreBook3" value="">
                                    </div>
                                </div>
                               
                                

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppDigitStart" id="" type="text" value="">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppDigitEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppNumStart" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppNumEnd" id="" type="text" value="">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppBookGrade" id="" type="text" value="">
                                    </div>
                                </div>

                            </div>


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Category:</label>
                                <div class="controls">
                                  <select name="txttitemsCatID" id="txttitemsCatID" >
                                    <?php echo $option7; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Color:</label>
                                <div class="controls">
                                  <select name="txttitemscolors">
                                    <?php foreach($color as $colors): ?>
                                        <option value="<?php echo $colors['ID'] ?>"><?php echo $colors['Description'];?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Size:</label>
                                <div class="controls">
                                  <select name="txttitemssize">
                                    <?php foreach($size as $sizes): ?>
                                        <option value="<?php echo $sizes['ID'] ?>"><?php echo $sizes['Description'];?></option>
                                    <?php endforeach; ?>    
                                  </select>
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Department:</label>
                                <div class="controls">
                                  <select name="txttitemsDeptID">
                                    <?php echo $option1; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Manufacturer:</label>
                                <div class="controls">
                                  <select class="" name="txttitemsManufacturerID">
                                    <?php echo $option2; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Vendor:</label>
                                <div class="controls">
                                  <select class="" name="txttitemsLastPurVdrID">
                                    <?php echo $option8; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Location:</label>
                                <div class="controls">
                                  <select class="" name="txttitemsLocationID">
                                    <?php echo $option3; ?>
                                  </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Unit Cost:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsIssuUntCost" id="" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Selling Price:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsStdCost" id="" type="text" value="">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Stock:</label>
                                <div class="controls">
                                  <input class="" name="txttitemsQtyOnHand" id="" type="text" value="">
                                </div>
                            </div>



                    </div>
                            

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="add_item_books">Add</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->

            <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3></h3>
            </div>
            <div class="modal-body">
                <p>Successfully Updated</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <!--<a href="BrowseStudentlist.php" class="btn btn-primary">Back To Student List</a>-->
            </div>
        </div>