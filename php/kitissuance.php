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
                                <label class="control-label"  for="focusedInput">Kit Items Check List:</label>
                                <div class="controls">
                                    
                                <?php foreach($levelkit as $levelkits): ?>
                                        <p><input type="hidden" class="itemnosss"><span style="opacity:0.33" id="itemno<?php echo str_replace(" ", "", $levelkits['ItemNo']);?>"><?php echo $levelkits['ItemNo'];?>  - <?php echo $levelkits['Description'];?></span>
                                            <input class="itemnom" name="itemno[]"  alt="<?php echo $levelkits['Description'];?>" type="hidden"  value="<?php echo $levelkits['ItemNo'];?>">
                                            <input name="description[]" type="hidden" value="<?php echo $levelkits['Description'];?>" >
                                        </p>
                                       


                                        <?php $titems = $model->select_where('titems', array('ItemNo' => $levelkits['ItemNo'])); ?>

                                        <input name="itemtype[]" type="hidden" value="<?php echo $titems->fields['IsBook'];?>" >
                                        <input name="bookcategory[]" type="hidden" value="<?php echo $levelkits['Category'];?>" >       

                                <?php endforeach;  ?> 
                                        
                                </div>
                            </div>
                            
                            


                            <div class="form-actions"  style="display:none;">
                              <!--<button type="submit" value="Submit" class="btn btn-primary">Save changes</button>-->
                              <button type="button"  class="btn btn-primary"  id="issuance_book">Save changes</button>
                            </div>
                          </fieldset>
                        </form> 
                        <input type="hidden" class="itemnos">
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->
                    <!-- content ends -->
            </div><!--/#content.span10-->
            

<script>
$('#kititemno').focus();
x = 0;
y = new Array();
$('#kititemno').change(function(){
    itemno = $('#kititemno').val();
    $.ajax({
        url:'page/ajax/kit_validation.php',
        type:'post',
        data:{itemno:itemno, levelid:<?php echo $customer->fields['LevelID'];?>},
        dataType:'json',
        success:function(j){
            //alert(j.status);
            if(j.status == 0){
                nospace = itemno.replace(/\s/g, ''); 
               //alert(itemno..replace(/\s/g, '') );
                $('#itemno'+nospace).fadeTo("slow", 1);
                $('.itemno'+nospace).val("1");
                if($.inArray( nospace, y )){
                    x = x + 1 ;         
                    y[x - 1] = nospace;
                    //alert(y.length);                   
                }

                $('#kititemno').val('');
                
            }

            if(j.countme == y.length){
                alert('All Items Are Validated.. Click Submit to Complete Transaction');
                $('.form-actions').fadeIn();
                $('#issuance_book').focus();
            } 

            if(j.status == 1){
                alert('Not Part of the Kit');
                $('#kititemno').val('');

            }
            
        }
    });


});




</script>

<?php include('template/footer.php'); ?>