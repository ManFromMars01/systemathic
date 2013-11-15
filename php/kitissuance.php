<?php include('template/myclass.php');?>

<?php include('template/header.php'); ?>

<?php 
    //$where = array('')
    $customer = $model->select_where('tcustomer',array('CustNo' => $_GET['ID3']));
    $level    = $model->select_where('tlevel',array('ID' => $customer->fields['LevelID']));
    $levelkit = $model->select_where('tkitpack',array('LevelID' => $customer->fields['LevelID']));
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Home</a> <span class="divider">/</span>
                    </li>
                    <li>
                        <a href="#">Forms</a>
                    </li>
                </ul>
            </div>
            
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> Kit Issuance </h2>
                        <div class="box-icon">
                            <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                            <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                            <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                        </div>
                    </div>
                    <div class="box-content">
                        <form class="form-horizontal" id="form71" action="template/issuance_var.php" name="form71" method="post" >
                          <fieldset>
                           <input type="hidden" id="MODE" name="MODE" value="1">
                           <input type="hidden" name="CountryID" value="<?php echo $_SESSION['UserValue1'];?>">
                           <input type="hidden" name="BranchID" value="<?php echo $_SESSION['UserValue2'];?>">
                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Customer Number</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="CustNo"  type="text" value="<?php echo $customer->fields["CustNo"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="focusedInput">Full name:</label>
                                <div class="controls">
                                  <input class="input-xlarge focused" name="fullname"  type="text" value="<?php echo $customer->fields["LSurname"].", ".$customer->fields["FirstName"]." ".$customer->fields["MiddleName"];?>" readonly>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Level Type:</label>
                                <div class="controls">
                                  <input class="" name="leveldesc" type="text" value="<?php echo $level->fields["Description"]; ?>" readonly>
                                  <input class="" name="LevelID" type="hidden" value="<?php echo $level->fields["ID"]; ?>" readonly>
                                </div>
                            </div>


                            
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Item No:</label>
                                <div class="controls">
                                    
                                  <input type="text" value="" id="kititemno"><input type="button" value="ADD TO BAG" id="addtobag">
                                  
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Bag(<span class="itemnobag"> 0 items</span>):</label>
                                <div class="controls addtobag" style="width:30% !important">
                                  
                                </div>

                              


                            </div>
                            <div class="control-group">
                                <label class="control-label"  for="focusedInput">Kit Items Check List:</label>
                                <div class="controls">
                                    
                                <?php foreach($levelkit as $levelkits): ?>
                                        <p><?php echo $levelkits['ItemNo'];?>  - <?php echo $levelkits['Description'];?>
                                            <input class="itemnom" name="itemno[]"  alt="<?php echo $levelkits['Description'];?>" type="hidden"  value="<?php echo $levelkits['ItemNo'];?>">
                                            <input name="description[]" type="hidden" value="<?php echo $levelkits['Description'];?>" >
                                        </p>
                                       


                                        <?php $titems = $model->select_where('titems', array('ItemNo' => $levelkits['ItemNo'])); ?>

                                        <input name="itemtype[]" type="hidden" value="<?php echo $titems->fields['IsBook'];?>" >
                                        <input name="bookcategory[]" type="hidden" value="<?php echo $levelkits['Category'];?>" >       

                                <?php endforeach;  ?> 
                                        
                                </div>
                            </div>
                            
                            


                            <div class="form-actions">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="issuance_book">Save changes</button>
                              <button type="reset" class="btn">Cancel</button>
                            </div>
                          </fieldset>
                        </form> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->
            

<script>



$('#addtobag').click(function(){
    itemno = $('#kititemno').val();
    result = 0;
    added = 0;
   
   

    $('.itemnom').each(function(){
         
        itemnom = $(this).val();
        itemalt = $(this).attr('alt');

        if(itemno == itemnom) {
          
          
          

          
           $('.addtobag').append("<div class='alert alert-success'><input type='hidden' name='itemno' value='"+itemno+"'>" +itemno + " " + itemalt+"</div> " );  
             result = 1;
             added = 1;
    

        } 

    });


       

   if(result == 0){
        $('.modal-body').html('Not Part Of The  ItemList For <?php echo $level->fields["Description"]; ?>');
        $("#myModal").modal('show'); 
   }

    
    if (added == 1){
              $('.modal-body').html('ssssss');
              $("#myModal").modal('show'); 
              //$('.addtobag').hide();
                   
           }


    

});


</script>

<?php include('template/footer.php'); ?>