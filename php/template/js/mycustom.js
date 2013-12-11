$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();


		//Update ScheduleClass

		$('#save_edit_class_schedule').click(function(){
			alert('test');
			$.ajax({
	            url: 'Updatetclassschededitx.php',
	            type: 'post',
	            data: $('#form2').serialize(),
	            dataType: 'json',
	            success: function (j) {
	               console.log(j);
	               //$('#success').html('Successfully Updated');
	               $('.modal-body').html(j.success);
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


		

		

		


		