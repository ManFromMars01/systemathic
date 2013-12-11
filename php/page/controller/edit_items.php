<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable




/**Begin Department**/
$seldepartment =  $model->select_where('tdepartment',array('BranchID' => $_SESSION['UserValue2']));
$option1 .=  "<option value=''>Please Select A Department</option>";
foreach ($seldepartment as $seldepartments):
        $option1 .= "<option value='".$seldepartments['ID']."'>".$seldepartments['Description']." </option>";
endforeach;
/**End Department**/

/**Begin Manufacturer**/
$selmanufacturer =  $model->select_table('tmanufacturer');
$option2 .=  "<option value=''>Please Select A Manufacturer</option>";
foreach ($selmanufacturer as $selmanufacturers):
        $option2 .= "<option value='".$selmanufacturers['ID']."'>".$selmanufacturers['Description']." </option>";
endforeach;
/**End Manufacturer**/

/**Begin Location**/
$sellocation =  $model->select_table('tlocation',array('BranchID' => $_SESSION['UserValue2']));
$option3 .=  "<option value=''>Please Select A Location</option>";
foreach ($sellocation as $sellocations):
        $option3 .= "<option value='".$sellocations['ID']."'>".$sellocations['Description']." </option>";
endforeach;
/**End Location**/

/**Abacus Books**/
$selbooks = $model->select_where('titems', array('IsBook' => 'Yes', 'IsAbacus' =>'Yes')); 
foreach ($selbooks as $selbook):
        $option4 .= "<option value='".$selbook['ItemNo']."a'>".$selbook['ItemNo']." (".$selbook['AbaDesc'].") </option>";
endforeach;
/**End abacus**/

/**Mental Books**/
$selbooks2 = $model->select_where('titems', array('IsBook' => 'Yes', 'IsMental' =>'Yes')); 
foreach ($selbooks2 as $selbook2):
        $option5 .= "<option value='".$selbook2['ItemNo']."m'>".$selbook2['ItemNo']." (".$selbook2['MenDesc'].") </option>";
endforeach;
/**End Mental**/


/**Supplementary Books**/
$selbooks3 = $model->select_where('titems', array('IsBook' => 'Yes', 'IsSupp' =>'Yes')); 
foreach ($selbooks3 as $selbook3):
        $option6 .= "<option value='".$selbook3['ItemNo']."s'>".$selbook3['ItemNo']." (".$selbook3['SuppDesc'].") </option>";
endforeach;
/**End**/



 


/**Begin Category**/
$selcategory = $model->select_table('tcategory');
$option7 .=  "<option value=''>Please Select A Category</option>";
foreach ($selcategory as $selcategorys):
        $option7 .= "<option value='".$selcategorys['ID']."'>".$selcategorys['Description']." </option>";
endforeach;
/**End Category**/

/**Begin Vendor**/
$selvendor = $model->select_where('tvendor',array('BranchID' => $_SESSION['USerValue2']));
$option8 .=  "<option value=''>Please Select A Vendor</option>";
foreach ($selvendor as $selvendor):
        $option8 .= "<option value='".$selvendor['ID']."'>".$selvendor['Name']." </option>";
endforeach;
/**End Vendor**/

/**Unit of Measure **/
$selumea = $model->select_where('tunitmeas',array('BranchID' => $_SESSION['USerValue2']));
$option9 .=  "<option value=''>Please Select Unit of Measure</option>";
foreach ($selumea as $selumeas):
        $option9 .= "<option value='".$selumeas['ID']."'>".$selumeas['Description']." </option>";
endforeach;
/**Unit of Mesure**/


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
$('#add_item_books').click(function(){
    $.ajax({
        url: '<?php echo base_url();?>template/add_items.php',
        type: 'post',
        data: $('#form31').serialize(),
        dataType: 'json',
        success: function (j) {
            alert('test');
           console.log(j);

           $('.modal-body').html(j.mystatus);
           $("#myModal").modal('show');
           
        }     
    });
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
</script>
<?php include($default->template('footer_view')); ?>