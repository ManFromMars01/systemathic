<div id="content" class="span10">
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Edit  Item </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" action=""  id="form32" name="form32" method="post" >
                          <fieldset>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Book No:</label>
                                <div class="controls">
                                  <input class="" name="sku" id="" type="hidden" value="<?php echo $cur_items->fields['Sku'];?>">  
                                  <input class="" id="" type="text" value="<?php echo $cur_items->fields['ItemNo'];?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Book Type:</label>
                                <div class="controls">
                                  <input type="text" value="<?php echo $cur_items->fields['Design'];?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Description:</label>
                                <div class="controls">
                                  <textarea name="txttitemsDescription" id="txttitemsDescription"><?php echo $cur_items->fields['Description'];?></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Grade:</label>
                                <div class="controls">
                                    <input type="text" readonly value="<?php echo $cur_items->fields['Color'];?>">
                                </div>
                            </div>

                            <div class="control-group bookcategory hidebookcategory">
                                <label class="control-label" for="focusedInput">Book Category: </label>
                                <div class="controls">
                                   <?php echo $isabacus; ?> Abacus
                                   <?php echo $ismental; ?> Mental
                                   <?php echo $issupp; ?> Supplementary
                                   
                                   <input type="hidden" class ="myabacus ischeck" name="txttitemsIsAbacus" value="<?php echo $abacus;?>">
                                   <input type="hidden" class ="mymental ischeck" name="txttitemsIsMental" value="<?php echo $mental;?>">
                                   <input type="hidden" class ="mysupplementary ischeck" name="txttitemsIsSupp" value="<?php echo $supp;?>">
                                </div>
                            </div>

                            <div id="group-abacus" class="displaynone hidebookcategory">
                                <h4>Abacus</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsAbaDesc" id="txttitemsAbaDesc" type="text" value="<?php echo $cur_items->fields['AbaDesc']?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</label>
                                    <div class="controls">
                                      <input class="abacusrpt" name="txttitemsAbaRptCnt1" id="abacusrpt1" type="text" value="<?php echo $cur_items->fields['AbaRptCnt1'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nexta">
                                            <?php echo $optionaban; ?>
                                        </select>
                                        <input type="hidden" class="anbookcode1 anbookcode" name="txttitemsAbaNxtBook1" value="<?php echo $cur_items->fields['AbaNxtBook1'];?><?php echo $abanxtcat1;?>">
                                        <input type="hidden" class="anbookcode2 anbookcode" name="txttitemsAbaNxtBook2" value="<?php echo $cur_items->fields['AbaNxtBook2'];?><?php echo $abanxtcat2;?>">
                                        <input type="hidden" class="anbookcode3 anbookcode" name="txttitemsAbaNxtBook3" value="<?php echo $cur_items->fields['AbaNxtBook3'];?><?php echo $abanxtcat3;?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previousa">
                                            <?php echo $optionabap; ?>
                                        </select>
                                        <input type="hidden" class="apbookcode1 apbookcode" name="txttitemsAbaPrvBook1"  value="<?php echo $cur_items->fields['AbaPrvBook1'];?><?php echo $abaprvcat1?>">
                                        <input type="hidden" class="apbookcode2 apbookcode" name="txttitemsAbaPrvBook2"  value="<?php echo $cur_items->fields['AbaPrvBook2'];?><?php echo $abaprvcat2?>">
                                        <input type="hidden" class="apbookcode3 apbookcode" name="txttitemsAbaPrvBook3"  value="<?php echo $cur_items->fields['AbaPrvBook3'];?><?php echo $abaprvcat3?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="prea">
                                           <?php echo $optionabapre; ?>
                                        </select>
                                             
                                        <input type="hidden" class="preabookcode1 preabookcode" name="txttitemsAbaPreBook1" value="<?php echo $cur_items->fields['AbaPreBook1'].$abaprecat1; ?>">
                                        <input type="hidden" class="preabookcode2 preabookcode" name="txttitemsAbaPreBook2" value="<?php echo $cur_items->fields['AbaPreBook2'].$abaprecat2; ?>">
                                        <input type="hidden" class="preabookcode3 preaookcode" name="txttitemsAbaPreBook3" value="<?php echo $cur_items->fields['AbaPreBook3'].$abaprecat3; ?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaDigitStart" id="" type="text" value="<?php echo $cur_items->fields['AbaDigitStart'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaDigitEnd" id="" type="text" value="<?php echo $cur_items->fields['AbaDigitEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaNumStart" id="" type="text" value="<?php echo $cur_items->fields['AbaNumStart'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaNumEnd" id="" type="text" value="<?php echo $cur_items->fields['AbaNumEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsAbaBookGrade" id="" type="text" value="<?php echo $cur_items->fields['AbaBookGrade'];?>">
                                    </div>
                                </div>
                            
                            </div>


                            <div id="group-mental" class="displaynone hidebookcategory">
                                <h4>Mental</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsMenDesc" id="txttitemsMenDesc" type="text"  value="<?php echo $cur_items->fields['MenDesc'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</label>
                                    <div class="controls">
                                      <input class="mentalrpt" name="txttitemsMenRptCnt1" id="mentalrpt1" type="text" value="<?php echo $cur_items->fields['MenRptCnt1'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Books:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nextm">
                                            <?php echo $optionmenn;?>
                                        </select>
                                        <input type="hidden" class="mnbookcode1 mnbookcode" name="txttitemsMenNxtBook1" value="<?php echo $cur_items->fields['MenNxtBook1'].$mennxtcat1;?>">
                                        <input type="hidden" class="mnbookcode2 mnbookcode" name="txttitemsMenNxtBook2" value="<?php echo $cur_items->fields['MenNxtBook2'].$mennxtcat2;?>">
                                        <input type="hidden" class="mnbookcode3 mnbookcode" name="txttitemsMenNxtBook3" value="<?php echo $cur_items->fields['MenNxtBook3'].$mennxtcat3;?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previousm">
                                            <?php echo $optionmenp;?>
                                        </select>
                                        <input type="hidden" class="mpbookcode1 mpbookcode" name="txttitemsMenPrvBook1" value="<?php echo $cur_items->fields['MenPrvBook1'].$menprvcat1;?>">
                                        <input type="hidden" class="mpbookcode2 mpbookcode" name="txttitemsMenPrvBook2" value="<?php echo $cur_items->fields['MenPrvBook2'].$menprvcat2;?>" >
                                        <input type="hidden" class="mpbookcode3 mpbookcode" name="txttitemsMenPrvBook3" value="<?php echo $cur_items->fields['MenPrvBook3'].$menprvcat3;?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="prem">
                                            <?php echo $optionmenpre;?>
                                        </select>
                                        <input type="hidden" class="prembookcode1 prembookcode" name="txttitemsMenPreBook1" value="<?php echo $cur_items->fields['MenPreBook1'].$menprecat1;?>">
                                        <input type="hidden" class="prembookcode2 prembookcode" name="txttitemsMenPreBook2" value="<?php echo $cur_items->fields['MenPreBook2'].$menprecat2;?>">
                                        <input type="hidden" class="prembookcode3 prembookcode" name="txttitemsMenPreBook3" value="<?php echo $cur_items->fields['MenPreBook3'].$menprecat3;?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenDigitStart" id="" type="text" value="<?php echo $cur_items->fields['MenDigitStart'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenDigitEnd" id="" type="text" value="<?php echo $cur_items->fields['MenDigitEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenNumStart" id="" type="text" value="<?php echo $cur_items->fields['MenNumStart'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenNumEnd" id="" type="text" value="<?php echo $cur_items->fields['MenNumEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsMenBookGrade" id="" type="text" value="<?php echo $cur_items->fields['MenBookGrade'];?>">
                                    </div>
                                </div>

                            </div>


                            <div id="group-supplementary" class="displaynone hidebookcategory">
                                <h4>Supplementary</h4>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Description:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused txtitemsdesc" name="txttitemsSuppDesc" id="txttitemsSuppDesc" type="text" value="<?php echo $cur_items->fields['SuppDesc'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</label>
                                    <div class="controls">
                                      <input class="mentalrpt" name="txttitemsSuppRptCnt1" id="mentalrpt1" type="text" value="<?php echo $cur_items->fields['SuppRptCnt1'];?>">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Next Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="nexts">
                                            <?php echo $optionsupn; ?>
                                        </select>
                                        <input type="hidden" class="snbookcode1 snbookcode" name="txttitemsSuppNxtBook1" value="<?php echo $cur_items->fields['SuppNxtBook1'].$suppnxtcat1;?>">
                                        <input type="hidden" class="snbookcode2 snbookcode" name="txttitemsSuppNxtBook2" value="<?php echo $cur_items->fields['SuppNxtBook2'].$suppnxtcat2;?>">
                                        <input type="hidden" class="snbookcode3 snbookcode" name="txttitemsSuppNxtBook3" value="<?php echo $cur_items->fields['SuppNxtBook3'].$suppnxtcat3;?>">
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Previous Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="previouss">
                                             <?php echo $optionsupp; ?>
                                        </select>
                                        <input type="hidden" class="spbookcode1 spbookcode" name="txttitemsSuppPrvBook1" value="<?php echo $cur_items->fields['SuppPrvBook1'].$suppprvcat1;?>">
                                        <input type="hidden" class="spbookcode2 spbookcode" name="txttitemsSuppPrvBook2" value="<?php echo $cur_items->fields['SuppPrvBook2'].$suppprvcat2;?>">
                                        <input type="hidden" class="spbookcode3 spbookcode" name="txttitemsSuppPrvBook3" value="<?php echo $cur_items->fields['SuppPrvBook3'].$suppprvcat3;?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Pre Req Book:</label>
                                    <div class="controls">
                                        <select multiple data-rel="chosen" id="pres">
                                             <?php echo $optionsuppre; ?>
                                        </select>
                                        <input type="hidden" class="presbookcode1 presbookcode" name="txttitemsSuppPreBook1" value="<?php echo $cur_items->fields['SuppPreBook1'].$suppprecat1;?>">
                                        <input type="hidden" class="presbookcode2 presbookcode" name="txttitemsSuppPreBook2" value="<?php echo $cur_items->fields['SuppPreBook2'].$suppprecat2;?>">
                                        <input type="hidden" class="presbookcode3 presbookcode" name="txttitemsSuppPreBook3" value="<?php echo $cur_items->fields['SuppPreBook3'].$suppprecat3;?>">
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Repeat Count:</p></label>
                                    <div class="controls">
                                      <input class="supprpt" name="txttitemsSuppRptCnt1" id="supprpt1" type="text" value="<?php echo $cur_items->fields['SuppRptCnt1'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppDigitStart" id="" type="text" value="<?php echo $cur_items->fields['SuppDigitStart'];?>">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Digit End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppDigitEnd" id="" type="text" value="<?php echo $cur_items->fields['SuppDigitEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number Start:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppNumStart" id="" type="text" value="<?php echo $cur_items->fields['SuppNumStart'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Number End:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppNumEnd" id="" type="text" value="<?php echo $cur_items->fields['SuppNumEnd'];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"  for="focusedInput">Grade:</label>
                                    <div class="controls">
                                      <input class="input-xlarge focused" name="txttitemsSuppBookGrade" id="" type="text" value="<?php echo $cur_items->fields['SuppBookGrade'];?>">
                                    </div>
                                </div>
                            </div> 

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Unit Cost:</label>
                                <div class="controls">
                                  <div class="input-prepend">
                                    <span class="add-on">TWD</span><input name="txttitemsIssuUntCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory->fields['IssuUntCost'] ?>" >
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Selling Price:</label>
                                <div class="controls">
                                  <div class="input-prepend">
                                    <span class="add-on">TWD</span><input name="txttitemsPurUntCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory->fields['PurUntCost'] ?>">
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Retail Price:</label>
                                <div class="controls">
                                  <div class="input-prepend">  
                                    <span class="add-on">TWD</span><input name="txttitemsStdCost" id="prependedInput" size="16" type="text" value="<?php echo $inventory->fields['StdCost']; ?>">
                                  </div>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Stock:</label>
                                <div class="controls">
                                  <input class="" style="width:100px;" name="txttitemsQtyOnHand" id="" type="text" value="<?php echo $inventory->fields['QtyOnHand']; ?>">
                                </div>
                            </div>        
                        </div>
                            

                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="upd_item_books">Update</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->
