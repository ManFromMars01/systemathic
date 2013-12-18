<?php 
session_start();
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

$design = $model->select_not_equal('tdesign',array('ColCode' => '02'));
$color = $model->select_not_equal('tcolor',array('ColCode' => '02'));
$size = $model->select_not_equal('tsize',array('CatID' => '02'));

/**Begin Vendor**/
$selvendor = $model->select_table('tvendor');
$option8 =  "<option value=''>Please Select A Vendor</option>";
foreach ($selvendor as $selvendor): $option8 .= "<option value='".$selvendor['Code']."'>".$selvendor['Name']." </option>"; endforeach;
/**End Vendor**/
/**Begin Department**/
$seldepartment =  $model->select_where('tdepartment',array('CountryID' => $_SESSION['UserValue2']));
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


/**Begin Category**/
$selcategory = $model->select_table('tcollection');
$option7 =  "<option value=''>Please Select A Category</option>";
foreach ($selcategory as $selcategorys): if($selcategorys['Code'] != '02'){ $option7 .= "<option value='".$selcategorys['Code']."'>".$selcategorys['Description']." </option>"; } endforeach;
/**End Category**/

/**Unit of Measure **/
$selumea = $model->select_where('tunitmeas',array('BranchID' => $_SESSION['UserValue2']));
$option9 =  "<option value=''>Please Select Unit of Measure</option>";
foreach ($selumea as $selumeas): $option9 .= "<option value='".$selumeas['ID']."'>".$selumeas['Description']." </option>"; endforeach;
/**Unit of Mesure**/
include($default->template('header_view'));
include($default->main_view('add_items2_view'));
?>
<script>
/*Add Items*/
$("#form31").validate({ rules: { itemtype: { required: true }, txttitemsCatID: { required: true }}});
$('#add_item_books').click(function(){
   if($("#form31").valid()){
        $.ajax({
        url: '<?php echo base_url('page/ajax/add_items3.php');?>',
        type: 'post',
        data: $('#form31').serialize(),
        dataType: 'json',
        success: function (z) {
            console.log(z);
            $('.modal-body').html(z.mystatus);
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

</script>
<?php include($default->template('footer_view')); ?>