<!DOCTYPE html>
<html>
<head>
	<title>Ajax CRUD Operations</title>
	<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	<script type="text/javascript" src="jquery.min.js"></script>
	<script type="text/javascript" src="bootstrap.js"></script>
</head>
<body>
	<div class="container">
		<h1 class="text-primary text-center">AJAX CRUD OPERATION</h1>
		<div>
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="float: right;">Open Modal</button>
		</div>
		<h2 class="text-danger">All Records</h2>
		<div id="records_contant">
		</div>

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Ajax CRUD Operation</h4>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<div class="form-group">
		        		<label>Firstname:</label>
		        		<input type="text"  id="firstname" class="form-control" placeholder="Firstname">
		        	</div>
		        	<div class="form-group">
		        		<label>Lastname:</label>
		        		<input type="text"  id="lastname" class="form-control" placeholder="Lastname">
		        	</div>
		        	<div class="form-group">
		        		<label>Email Id:</label>
		        		<input type="email" id="email" class="form-control" placeholder="Email Id">
		        	</div>
		        	<div class="form-group">
		        		<label>Mobile:</label>
		        		<input type="text"  id="mobile" class="form-control" placeholder="Mobile Number">
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addRecord()">Save</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div><!--modal-->

		<!-- Update Record Modal -->
		<div id="update_record_model" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Ajax CRUD Operation</h4>
		      </div>
		      <div class="modal-body">
		        <form>
		        	<div class="form-group">
		        		<label>Update_Firstname:</label>
		        		<input type="text"  id="update_firstname" class="form-control" placeholder="Firstname">
		        	</div>
		        	<div class="form-group">
		        		<label>Update_Lastname:</label>
		        		<input type="text"  id="update_lastname" class="form-control" placeholder="Lastname">
		        	</div>
		        	<div class="form-group">
		        		<label>Update_Email Id:</label>
		        		<input type="email" id="update_email" class="form-control" placeholder="Email Id">
		        	</div>
		        	<div class="form-group">
		        		<label>Update_Mobile:</label>
		        		<input type="text"  id="update_mobile" class="form-control" placeholder="Mobile Number">
		        	</div>
		        </form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-success" data-dismiss="modal" onclick="updateuserdetail()">Update</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		        <input type="hidden" name="" id="hidden_user_id">
		      </div>
		    </div>
		  </div>
		</div><!-- update record modal-->

	</div>
	<script type="text/javascript">

		$(document).ready(function(){
			readRecords();
		});

		function readRecords(){
			var readrecord = "readrecord";
			$.ajax({
				url:'backend.php',
				type:'POST',
				data:{readrecord : readrecord},
				success:function(data,status){
					$('#records_contant').html(data);
				}
			});
		}

		function addRecord(){
			var firstname = $('#firstname').val();
			var lastname = $('#lastname').val();
			var email = $('#email').val();
			var mobile = $('#mobile').val();
			$.ajax({
				url:'backend.php',
				type:'POST',
				data:{firstname : firstname,lastname : lastname,email:email,mobile:mobile},
				success:function(data,status){
					readRecords();
				}
			});
		}

		////// delete records call
		function DeleteUser(deleteid){
			var conf = confirm('Are you sure');
			if(conf == true){
				$.ajax({
					url:'backend.php',
					type:'POST',
					data:{deleteid : deleteid},
					success:function(data,status){
						readRecords();
					}

				});
			}
		}

		function GetUserDetails(id){
			$('#hidden_user_id').val(id);
			$.post('backend.php',
					{id : id},
					function(data,status){
						var user = JSON.parse(data);
						$('#update_firstname').val(user.firstname);
						$('#update_lastname').val(user.lastname);
						$('#update_email').val(user.email);
						$('#update_mobile').val(user.mobile);
					}
				);
			$('#update_record_model').modal('show');
		}
		function updateuserdetail(){
			var firstnameupd = $('#update_firstname').val();
			var lastnameupd = $('#update_lastname').val();
			var emailupd = $('#update_email').val();
			var mobileupd = $('#update_mobile').val();
			var hidden_user_idupd = $('#hidden_user_id').val();
			$.post('backend.php',{
				hidden_user_idupd : hidden_user_idupd,
				firstnameupd : firstnameupd,
				lastnameupd : lastnameupd,
				emailupd : emailupd,
				mobileupd : mobileupd},
				function(data,status){
				$('#update_record_model').modal("hide");
				readRecords();
			});
		}
	</script>
</body>
</html>