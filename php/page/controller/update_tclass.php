
<?php 
session_start();
$myName = $_SESSION["myname"];
include('../class/model.php'); // dont use $model variable 
include('../class/systemathic.php'); // dont use $default variable

//variable and functions here
$success = "";

if(isset($_GET['save_class_shed'])){
	$update = array(
		'CountryID' => $_GET['country_id'],
		'BranchID'  => $_GET['branch_id'],
		'LevelID'   => $_GET['level_id'], 
		'TeacherCnt' => $_GET['teacher_count'],
		'TeacherID1' => $_GET['teacher1'],
		'TeacherID2' => $_GET['teacher2'],
		'TeacherID3' => $_GET['teacher3'],
		'Day'        => $_GET['day_sched'],
		'TimeFrom'   => $_GET['timefrom'],
		'TimeTo'   => $_GET['timeto'],
	);

	$model->update_tbl('tclasssched', $update, array('SchedCode' => $_GET['schedcode'] ));
	$success = success('Successfully Saved!!');

}


$sched = $model->select_where('tclasssched',array('SchedCode' => $_GET['schedcode']));

$tteacher = $model->select_where('tteacher',array('BranchID' => $_SESSION['UserValue2']));
$tlevel = $model->select_where('tlevel',array('BranchID' => $_SESSION['UserValue2']));
$time   = $model->select_where('ttime',array('BranchID' => $_SESSION['UserValue2']));
$room   = $model->select_where('troom',array('BranchID' => $_SESSION['UserValue2']));

$class = "";
$class2= "";	

if($sched->fields['TeacherCnt'] == "2" ){
	$class = 'style="display:block !important;"';
}

if($sched->fields['TeacherCnt'] == "3" ){
	$class2 = 'style="display:block !important;"';
}


include($default->template('header_view'));
include($default->main_view('update_tclass_view'));

?>
</div><!--/fluid-row-->
				
			<hr>

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

		<div class="modal hide fade" id="myModal2">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Return Books</h3>
			</div>
			<div class="modal-body2" style="">
				<form class="form-horizontal" method="get" action="return_books.php">
				<br /><br />	
				<div class="control-group" style="margin: 0 auto;" >
                    <label class="control-label">Input Student ID:</label>
                    <div class="controls">
                      <input  name="student_no" id="inputstudid" type="text" value="">
                      <button type="submit"  class="btn btn-primary"  id="savemec">Submit</button>
                    </div>
                    <br />
                </div>
                </form>		
			</div>
			<div class="modal-footer2">
				<p id="fullname" style="text-align:center; font-weight:bold;"></p>
			</br>
			</div>
		</div>



		<footer>
			<p class="pull-left">&copy; <a href="#" target="_blank">CMA Mental Arithmetic</a> 2012</p>
			<p class="pull-right">Powered by: <a href="#">CMA</a></p>
		</footer>
		
	</div>
</div><!--/.fluid-container-->


<script>

/************Return Books***************/
$('#returnbooklink').click(function(){
	
	$("#myModal2").modal('show');
	$('#myModal2').on('shown', function() {
        $("#inputstudid").focus();
    })


});

$('#inputstudid').keyup(function(){
   myval = $(this).val(); 
   $.ajax({
		url: 'template/myvariables.php',
        type: 'post',
        data: {studid : myval},
        dataType: 'json',
        success: function (j) {
           console.log(j);
           //$('#success').html('Successfully Updated');
           $('#fullname').html(j.fullname);
           //$("#myModal").modal('show');
           
        } 					   	
   
   });					
});
$('#inputstudid').change(function(){
   myval = $(this).val(); 
   $.ajax({
		url: 'template/myvariables.php',
        type: 'post',
        data: {studid : myval},
        dataType: 'json',
        success: function (j) {
           console.log(j);
           //$('#success').html('Successfully Updated');
           $('#fullname').html(j.fullname);
           //$("#myModal").modal('show');        
        } 					   	
   
   });					
});


$("#txttclassschedTeacherCnt").keyup(function(){
	$(".teacherhand").hide();
	var no_teacher  = $(this).val();
	noteacher  = Number(no_teacher) + 1;   
	    //alert(nodays);
	for(var i=1 ; i < noteacher ; i++){

		$('.teacher'+i).show();		
	}
});


$('#save_class_shed').click(function(){
	$.ajax({
        url: 'Updatetclassschedaddx.php',
        type: 'post',
        data: $('#form30').serialize(),
        dataType: 'json',
        success: function (j) {
           console.log(j);
           //$('#success').html('Successfully Updated');
           $('.modal-body').html(j.statusme);
           $("#myModal").modal('show');
           
        }     
	});
});

$('#avetime').change(function(){
	timeid = $(this).val();
	//alert(timeid);

	$.ajax({
        url: '<?php echo base_url();?>template/variables4.php',
        type: 'post',
        data: {timecode : timeid},
        dataType: 'json',
        success: function (j) {
           console.log(j);
           $('#txttclassschedTimeFrom').val(j.from);
           $('#txttclassschedTimeTo').val(j.to);
           
        }     
	});	
});

$("#showme").click(function(){
	enableme = $(this).attr('alt');
	alert(enableme);
	if(enableme == "enable"){
		$('.group2').show();
		$(this).attr('alt','disable')
	} else{
		$('.group2').hide();
		$(this).attr('alt','enable')
	}
});


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
        url: 'template/add_items.php',
        type: 'post',
        data: $('#form31').serialize(),
        dataType: 'json',
        success: function (j) {
           console.log(j);
           $('.modal-body').html(j.mystatus);
           $("#myModal").modal('show');
           
        }     
	});
});

$('#upd_item_books').click(function(){
	//alert('test');
	$.ajax({
        url: 'template/edit_items.php',
        type: 'post',
        data: $('#form32').serialize(),
        dataType: 'json',
        success: function (j) {
          	
           console.log(j);
           $('.modal-body').html(j.mystatus2);
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



/****************For Kitpack*************************/


$('#keyitemno').keyup(function(){
	itemno = $(this).val();
	$.ajax({
		url:"template/kit_variable.php",
		type:"post",
		data:{itemno: itemno},
		dataType:'json',
		success:function(x){
			console.log(x);
			 desc = x.test ;
			$('#txttkitpackDescription').val(x.test);
		}


	});

});


$('#add_kitpack').click(function(){
	$.ajax({
		url:"Updatetkitpackeditx.php",
		type:"post",
		data:$('#form33').serialize(),
		dataType:'json',
		success:function(x){
		   console.log(x);
           $('.modal-body').html(x.status);
           $("#myModal").modal('show');	
		}

	});
});

$('#add_kitpack2').click(function(){
	//alert('test');
	$.ajax({
		url:"Updatetkitpackaddx.php",
		type:"post",
		data:$('#form70').serialize(),
		dataType:'json',
		success:function(z){
		   console.log(z);
           $('.modal-body').html(z.status);
           $("#myModal").modal('show');	
		}

	});
});

/***********kitissuance**************/

$('#issuance_book').click(function(){
	
	$.ajax({
		url:"template/issuance_var.php",
		type:"post",
		data:$('#form71').serialize(),
		dataType:'json',
		success:function(z){
		   console.log(z);
           $('.modal-body').html(z.status);
           $("#myModal").modal('show');	
		}

	});
});





</script>
</body>
</html>