<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable




/**Begin Department**/
$seldepartment =  $model->select_where('tdepartment',array('BranchID' => $_SESSION['UserValue2']));
$option1 =  "<option value=''>Please Select A Department</option>";
foreach ($seldepartment as $seldepartments):
        $option1 .= "<option value='".$seldepartments['ID']."'>".$seldepartments['Description']." </option>";
endforeach;
/**End Department**/

/**Begin Manufacturer**/
$selmanufacturer =  $model->select_table('tmanufacturer');
$option2 =  "<option value=''>Please Select A Manufacturer</option>";
foreach ($selmanufacturer as $selmanufacturers):
        $option2 .= "<option value='".$selmanufacturers['ID']."'>".$selmanufacturers['Description']." </option>";
endforeach;
/**End Manufacturer**/

/**Begin Location**/
$sellocation =  $model->select_table('tlocation',array('BranchID' => $_SESSION['UserValue2']));
$option3 =  "<option value=''>Please Select A Location</option>";
foreach ($sellocation as $sellocations):
        $option3 .= "<option value='".$sellocations['ID']."'>".$sellocations['Description']." </option>";
endforeach;
/**End Location**/

/**Abacus Books**/
$selbooks = $model->select_where('titems', array('IsBook' => 'Yes', 'IsAbacus' =>'Yes')); 
$option4 ="";
foreach ($selbooks as $selbook):
        $option4 .= "<option value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") </option>";
endforeach;
/**End abacus**/

/**Mental Books**/
$selbooks2 = $model->select_where('titems', array('IsBook' => 'Yes', 'IsMental' =>'Yes')); 
$option5 ="";
foreach ($selbooks2 as $selbook2):
        $option5 .= "<option value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") </option>";
endforeach;
/**End Mental**/


/**Supplementary Books**/
$selbooks3 = $model->select_where('titems', array('IsBook' => 'Yes', 'IsSupp' =>'Yes'));
$option6 =""; 
foreach ($selbooks3 as $selbook3):
        $option6 .= "<option value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") </option>";
endforeach;
/**End**/

$color = $model->select_table('tcolor');
$size = $model->select_table('tsize');



 


/**Begin Category**/
$selcategory = $model->select_table('tcategory');
$option7 =  "<option value=''>Please Select A Category</option>";
foreach ($selcategory as $selcategorys):
        $option7 .= "<option value='".$selcategorys['ID']."'>".$selcategorys['Description']." </option>";
endforeach;
/**End Category**/

/**Begin Vendor**/
$selvendor = $model->select_table('tvendor');
$option8 =  "<option value=''>Please Select A Vendor</option>";
foreach ($selvendor as $selvendor):
        $option8 .= "<option value='".$selvendor['ID']."'>".$selvendor['Name']." </option>";
endforeach;
/**End Vendor**/

/**Unit of Measure **/
$selumea = $model->select_where('tunitmeas',array('BranchID' => $_SESSION['UserValue2']));
$option9 =  "<option value=''>Please Select Unit of Measure</option>";
foreach ($selumea as $selumeas):
        $option9 .= "<option value='".$selumeas['ID']."'>".$selumeas['Description']." </option>";
endforeach;
/**Unit of Mesure**/
$optionall ="";

$optionall = $option4.$option5.$option6;  






include($default->template('header_view'));
include($default->main_view('add_items_view'));
?>
<script>
    /***For Books***/
$('.itemtype').change(function(){
    itemtype = $(this).val();
    if(itemtype == "Books"){
        $('#txttitemsIsBook').val('Yes');
        $('.bookcategory').show();  
        $('#txttitemsDescription').val('');
        $('.txttitemsDescription').hide();
    } else {
        $('#txttitemsIsBook').val('No');
        $('.bookcategory').hide();
        $('.hidebookcategory').hide();
        $('.txttitemsDescription').show();
    }
});


$('.txtitemsdesc').keyup(function(){
    abadesc = $('#txttitemsAbaDesc').val();
    mendesc = $('#txttitemsMenDesc').val();
    suppdesc = $('#txttitemsSuppDesc').val();
    
    if(abadesc != ""){
        abadesc =  abadesc + ',';
    }

    if(mendesc != ""){
        mendesc =  mendesc + ',';
    }

    if(suppdesc != ""){
        suppdesc =  suppdesc + ',';
    }


    fulldesc =  abadesc + mendesc + suppdesc;

    $('#txttitemsDescription').val(fulldesc.slice(0,-1));

});




/*Add Items*/
$("#form31").validate({
    rules: {
    itemtype: {
      required: true
    },
    txttitemsCatID: {
      required: true
    }
  }

});


$('#add_item_books').click(function(){
   if($("#form31").valid()){
        $.ajax({
        url: '<?php echo base_url('page/ajax/add_items.php');?>',
        type: 'post',
        data: $('#form31').serialize(),
        dataType: 'json',
        success: function (z) {
            console.log(z);
            $('.modal-body').html(z.successful);
            $("#myModal").modal('show');
           
        },   
         error: function(xhr,err){
           alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
            alert("responseText: "+xhr.responseText);
            alert('Tranasaction Failed: Dupplicate Entry of ItemCode' );

        }
    });

   }

    
});




$('#isabacus').change(function(){       
    if ($(this).attr("checked")) {
        booktype = $(this).val();
        $('#group-abacus').show();
        $('.myabacus').val('Yes');
    } else {
        $('#group-abacus').hide();
        $('.myabacus').val(''); 
    }

});

$('#issupply').change(function(){
    
    if ($(this).attr("checked")) {
        booktype = $(this).val();
        $('#group-supplementary').show();
        $('.mysupplementary').val('Yes');
    } else {
        $('#group-supplementary').hide();
        $('.mysupplementary').val('');  
    }

});

$('#ismental').change(function(){
    
    if ($(this).attr("checked")) {
        booktype = $(this).val();
        $('#group-mental').show();
        $('.mymental').val('Yes');
    } else {
        $('#group-mental').hide();
        $('.mymental').val(''); 
    }

});

$('#previousa').change(function(){
            $('.abook').hide();
            $('.apbookcode').val('');
            //$('.abacusrpt').val('');

            var preva = $(this).val();
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {preva : preva},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       
                       for(x=1; x<=j.booknum; x++){     
                        $('.abook' + x).show();
                        $('.abookcode' + x ).html(j.bookcodes[x - 1]); 
                        $('.apbookcode' + x ).val(j.bookcodes[x - 1]);
                        
                        //alert(j.bookcodes[x - 1]);
                           
                       }
                         booknumme = j.booknum + 1;
                         //alert(booknumme);
                         if(booknumme == "2"){
                            $('#abacusrpt2').val('');
                            $('#abacusrpt3').val('');
                         }
                         if(booknumme == "3"){
                            $('#abacusrpt3').val('');
                         }

                        
                    }     
            }); 

        });


        $('#previousm').change(function(){
            $('.mbook').hide();
            $('.mpbookcode').val('');
            var prevm = $(this).val();
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {prevm : prevm},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){
                        $('.mbook' + x).show();
                        $('.mbookcode' + x ).html(j.bookcodes[x - 1]); 
                        $('.mpbookcode' + x ).val(j.bookcodes[x - 1]); 
                  
                       }

                       booknumme = j.booknum + 1;
                         //alert(booknumme);
                         if(booknumme == "2"){
                            $('#mentalrpt2').val('');
                            $('#mentalrpt3').val('');
                         }
                         if(booknumme == "3"){
                            $('#mentalrpt3').val('');
                         }

                        
                    }     
            }); 

        });


        $('#previouss').change(function(){
            $('.sbook').hide();
            $('.spbookcode').val('');
            var prevs = $(this).val();
             
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {prevs : prevs},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){
                        $('.sbook' + x).show();
                        $('.sbookcode' + x ).html(j.bookcodes[x - 1]); 
                        $('.spbookcode' + x ).val(j.bookcodes[x - 1]); 

                       }

                        booknumme = j.booknum + 1;
                         //alert(booknumme);
                         if(booknumme == "2"){
                            $('#supprpt2').val('');
                            $('#supprpt3').val('');
                         }
                         if(booknumme == "3"){
                            $('#supprpt3').val('');
                         }


                        
                    }     
            }); 

        });


        $('#nexta').change(function(){
            var nexta = $(this).val();
            $('.anbookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {nexta : nexta},
                    dataType: 'json',
                    success: function (j) {
                      // alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.anbookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });
        $('#nextm').change(function(){
            var nextm = $(this).val();
            $('.mnbookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {nextm : nextm},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.mnbookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });
        $('#nexts').change(function(){
            var nexts = $(this).val();
            $('.snbookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {nexts: nexts},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.snbookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });

        $('#prea').change(function(){
            var prea = $(this).val();
            $('.preabookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {prea: prea},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.preabookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });

        $('#prem').change(function(){
            var prem = $(this).val();
            $('.prembookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {prem: prem},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.prembookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });

        $('#pres').change(function(){
            var pres = $(this).val();
            $('.presbookcode').val('');
             $.ajax({
                    url: '<?php echo base_url();?>template/item_variables2.php',
                    type: 'post',
                    data: {pres: pres},
                    dataType: 'json',
                    success: function (j) {
                       //alert(j.booknum);
                       console.log(j);

                       for(x=1; x<=j.booknum; x++){ 
                        $('.presbookcode' + x ).val(j.bookcodes[x - 1]); 
                       }

                        
                    }     
            }); 

        });

</script>
<?php include($default->template('footer_view')); ?>