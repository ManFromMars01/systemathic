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

		<footer>
			<p class="pull-left">&copy; <a href="#" target="_blank">CMA Mental Arithmetic</a> 2012</p>
			<p class="pull-right">Powered by: <a href="#">CMA</a></p>
		</footer>
		
	</div>
</div><!--/.fluid-container-->
<script src="template/js/mycustom.js"></script>
<script>


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
	alert(timeid);

	$.ajax({
        url: 'template/variables4.php',
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















</script>
</body>
</html>