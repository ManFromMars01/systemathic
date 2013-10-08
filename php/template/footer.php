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
	<!-- external javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->

	<!-- jQuery -->
	<script src="template/js/jquery-1.7.2.min.js"></script>
	<!-- jQuery UI -->
	<script src="template/js/jquery-ui-1.8.21.custom.min.js"></script>
	<!-- transition / effect library -->
	<script src="template/js/bootstrap-transition.js"></script>
	<!-- alert enhancer library -->
	<script src="template/js/bootstrap-alert.js"></script>
	<!-- modal / dialog library -->
	<script src="template/js/bootstrap-modal.js"></script>
	<!-- custom dropdown library -->
	<script src="template/js/bootstrap-dropdown.js"></script>
	<!-- scrolspy library -->
	<script src="template/js/bootstrap-scrollspy.js"></script>
	<!-- library for creating tabs -->
	<script src="template/js/bootstrap-tab.js"></script>
	<!-- library for advanced tooltip -->
	<script src="template/js/bootstrap-tooltip.js"></script>
	<!-- popover effect library -->
	<script src="template/js/bootstrap-popover.js"></script>
	<!-- button enhancer library -->
	<script src="template/js/bootstrap-button.js"></script>
	<!-- accordion library (optional, not used in demo) -->
	<script src="template/js/bootstrap-collapse.js"></script>
	<!-- carousel slideshow library (optional, not used in demo) -->
	<script src="template/js/bootstrap-carousel.js"></script>
	<!-- autocomplete library -->
	<script src="template/js/bootstrap-typeahead.js"></script>
	<!-- tour library -->
	<script src="template/js/bootstrap-tour.js"></script>
	<!-- library for cookie management -->
	<script src="template/js/jquery.cookie.js"></script>
	<!-- calander plugin -->
	<script src='template/js/fullcalendar.min.js'></script>
	<!-- data table plugin -->
	<script src='template/js/jquery.dataTables.min.js'></script>

	<!-- chart libraries start -->
	<script src="template/js/excanvas.js"></script>
	<script src="template/js/jquery.flot.min.js"></script>
	<script src="template/js/jquery.flot.pie.min.js"></script>
	<script src="template/js/jquery.flot.stack.js"></script>
	<script src="template/js/jquery.flot.resize.min.js"></script>
	<!-- chart libraries end -->

	<!-- select or dropdown enhancer -->
	<script src="template/js/jquery.chosen.min.js"></script>
	<!-- checkbox, radio, and file input styler -->
	<script src="template/js/jquery.uniform.min.js"></script>
	<!-- plugin for gallery image view -->
	<script src="template/js/jquery.colorbox.min.js"></script>
	<!-- rich text editor library -->
	<script src="template/js/jquery.cleditor.min.js"></script>
	<!-- notification plugin -->
	<script src="template/js/jquery.noty.js"></script>
	<!-- file manager library -->
	<script src="template/js/jquery.elfinder.min.js"></script>
	<!-- star rating plugin -->
	<script src="template/js/jquery.raty.min.js"></script>
	<!-- for iOS style toggle switch -->
	<script src="template/js/jquery.iphone.toggle.js"></script>
	<!-- autogrowing textarea plugin -->
	<script src="template/js/jquery.autogrow-textarea.js"></script>
	<!-- multiple file upload plugin -->
	<script src="template/js/jquery.uploadify-3.1.min.js"></script>
	<!-- history.js for cross-browser state change on ajax -->
	<script src="template/js/jquery.history.js"></script>
	<!-- application script for Charisma demo -->
	<script src="template/js/charisma.js"></script>	
	<script src="template/js/jquery.validate.js"></script>
	<script>
		//Update Student
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








		$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
	</script>

</body>
</html>