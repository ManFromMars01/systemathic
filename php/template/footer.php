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
	<script>
	$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();

	$('#savemeus').click(function(){
			$.ajax({
	            url: 'UpdatetStudenteditx.php',
	            type: 'post',
	            data: $('#form1').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#savemes').click(function(){
			$('.validateme').validate();
			if($('.validateme').valid()){ //checks if it's valid
		       $.ajax({
	            url: 'UpdatetStudentaddx.php',
	            type: 'post',
	            data: $('#form5').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        		});
			   }
			   else{
			    alert("not valid");
			   }


			
		});



		//Update ScheduleClass

		$('#saveme').click(function(){
			$.ajax({
	            url: 'Updatetclassschededitx.php',
	            type: 'post',
	            data: $('#form2').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		// Adding Country
		$('#saveme').click(function(){
			$.ajax({
	            url: 'Updatetcountryaddx.php',
	            type: 'post',
	            data: $('#form3').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});
		// Adding Country
		$('#savemec').click(function(){
			$.ajax({
	            url: 'Updatetcountryeditx.php',
	            type: 'post',
	            data: $('#form4').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		//Adding Department
		$('#save_add_dept').click(function(){
			$.ajax({
	            url: 'Updatetdepartmentaddx.php',
	            type: 'post',
	            data: $('#form6').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_dept').click(function(){
			$.ajax({
	            url: 'Updatetdepartmenteditx.php',
	            type: 'post',
	            data: $('#form7').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});



		//Adding Category
		$('#save_add_cat').click(function(){
			$.ajax({
	            url: 'Updatetcategoryaddx.php',
	            type: 'post',
	            data: $('#form8').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_cat').click(function(){
			$.ajax({
	            url: 'Updatetcategoryeditx.php',
	            type: 'post',
	            data: $('#form9').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		
		//Add Unit
		$('#save_add_unit').click(function(){
			$.ajax({
	            url: 'Updatetunitmeasaddx.php',
	            type: 'post',
	            data: $('#form10').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_unit').click(function(){
			$.ajax({
	            url: 'Updatetunitmeaseditx.php',
	            type: 'post',
	            data: $('#form11').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add Manufacturer
		$('#save_add_manufacturer').click(function(){
			$.ajax({
	            url: 'Updatetmanufactureraddx.php',
	            type: 'post',
	            data: $('#form12').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_manufacturer').click(function(){
			$.ajax({
	            url: 'Updatetmanufacturereditx.php',
	            type: 'post',
	            data: $('#form13').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		//add Location
		$('#save_add_location').click(function(){
			$.ajax({
	            url: 'Updatetlocationaddx.php',
	            type: 'post',
	            data: $('#form14').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_location').click(function(){
			$.ajax({
	            url: 'Updatetlocationeditx.php',
	            type: 'post',
	            data: $('#form15').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add Branch

		$('#save_add_branch').click(function(){
			$.ajax({
	            url: 'Updatetbranchaddx.php',
	            type: 'post',
	            data: $('#form16').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_branch').click(function(){
			$.ajax({
	            url: 'Updatetbrancheditx.php',
	            type: 'post',
	            data: $('#form17').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		

		//add Assesment
		$('#save_add_assessment').click(function(){
			$.ajax({
	            url: 'Updatetassessmentaddx.php',
	            type: 'post',
	            data: $('#form18').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_assessment').click(function(){
			$.ajax({
	            url: 'Updatetassessmenteditx.php',
	            type: 'post',
	            data: $('#form19').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		//Add level
		$('#save_add_level').click(function(){
			$.ajax({
	            url: 'Updatetleveladdx.php',
	            type: 'post',
	            data: $('#form21').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		$('#save_upd_level').click(function(){
			$.ajax({
	            url: 'Updatetleveleditx.php',
	            type: 'post',
	            data: $('#form22').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});


		// createsched
		$('#createsched').click(function(){
			$.ajax({
	            url: 'Updateeattheadaddx.php',
	            type: 'post',
	            data: $('#form23').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.statusme);
	               $("#myModal").modal('show');
	               
	            }     
        	});
		});

		//Name Keyup

		$('#lname').keyup(function(){
			lastname = $(this).val();
			$('#llname').val(lastname);
		});

		$('#fname').keyup(function(){
			fname = $(this).val();
			$('#lfname').val(fname);
		});

		$('#mname').keyup(function(){
			mname = $(this).val();
			$('#lmname').val(mname);
		});

		$('#enableme').click(function(){
			if( $(this).text() == "Change Local Name"){
				$(".disableme").attr("readonly",false);
				$(this).text('Same as Above');
			} else{
				
				lname = $('#lname').val();
				mname = $('#mname').val();
				fname = $('#fname').val();

				$('#lfname').val(fname);
				$('#lmname').val(mname);
				$('#llname').val(lname);
				
				$(".disableme").attr("readonly",true);
				$(this).text('Change Local Name');
			}
		});




	</script>
</body>
</html>