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
                    <label class="control-label" for="focusedInput">Input Student ID:</label>
                    <div class="controls">
                      <input class="input-xlarge focused" name="student_no" id="inputstudid" type="text" value="">
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
$('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' }).val();
</script>

</body>
</html>