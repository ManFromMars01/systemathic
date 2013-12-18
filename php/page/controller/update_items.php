<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable
include('../controller/item_variables_edit.php');
$cur_items = $model->select_where('titems',array('Sku' => $_GET['sku']));
$inventory = $model->select_where('thitems',array('Sku' => $_GET['sku'], 'BranchID' => 'TW001'));

$inventory_login =  $model->select_where('thitems',array('Sku' => $_GET['sku'], 'BranchID' => $_SESSION['UserValue2']));



$color  = $model->select_table('tcolor');
$design = $model->select_table('tdesign');
$collection = $model->select_table('tcollection');
?>
<?php include($default->template('header_view'));?>
<?php

if($cur_items->fields['IsBook'] == "Yes" && $_SESSION['UserValue2'] =="TW001"):  
    $size   = $model->select_table('tsize');    
    include($default->main_view('update_items_view'));
else:
    $design = $model->select_not_equal('tdesign',array('ColCode' => '02'));
    $size = $model->select_not_equal('tsize',array('CatID' => '02'));
    $color  = $model->select_not_equal('tcolor',array('ColCode' => '02'));
    include($default->main_view('update_items_view2'));
endif; 
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



$('#upd_item_books').click(function(){
   if($("#form32").valid()){
        $.ajax({
        
        <?php if($cur_items->fields['IsBook'] == "Yes" && $_SESSION['UserValue2'] =="TW001" ):  ?>
        url: '<?php echo base_url('page/ajax/edit_items.php');?>',
        <?php else:?>
        url: '<?php echo base_url('page/ajax/edit_items2.php');?>',
        <?php endif;?>
        type: 'post',
        data: $('#form32').serialize(),
        dataType: 'json',
        success: function (z) {
            console.log(z);
            $('.modal-body').html(z.mystatus2);
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