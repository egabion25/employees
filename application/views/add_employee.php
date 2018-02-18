<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ready to Serb!</title>


	<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="../resources/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="../resources/css/jquery-ui.min.css"> 


	<?php include_once("page_resources.php"); ?>

	<script src="../resources/js/bootstrap.bundle.min.js"></script> 


	<style type="text/css">


	</style>
</head>
<body>

<!-- 	<div class="container">
		<div class="row">

			<div class="col-md-4 vertical-center">
				<h3>Add Employee</h3>
			</div>

			<div class="col-md-3"></div>

			<div class="col-md-3">
				<img class="img img-responsive text-right" style="width: 100%;" src="../resources/uploads/logo.png">
			</div>


	
		</div>
	</div> -->

		


		<form id="add_employee" class="form-horizontal">
			
		<fieldset>

		<div class="container">
			<div class="row">



		<div class="container">
			<div class="row">


				<div class="col-sm-6 vertical-center">
					<h4>Add Employee</h4>
				</div>

				<div class="col-sm-6">
					<div class="container">
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-4">
								<img class="img img-responsive text-right " style="width: 100%;" src="../resources/uploads/logo.png">
							</div>
							<div class="col-sm-4"></div>
						</div>
					</div>
				</div>

			</div>
		</div>

				<div class="col-sm-6">
					<div class="form-group">
					  <div class="col-md-12">
					  	<div class="container">
							<div class="row">
					  			<input id="txtEmployee_id" name="txtEmployee_id" type="text" tabindex="1" placeholder="Employee ID" class=" form-control input-md" required="">
					  		</div>
					  	</div>
					  </div>
				  	</div>	

					<div class="form-group">
					  <div class="col-md-12">
					  	<div class="container">
							<div class="row">
					  			<input id="txtFullName" name="txtFullName" type="text" tabindex="2" placeholder="Full Name" class=" form-control input-md" required="">
					  		</div>
					  	</div>
					  </div>
				  	</div>	

				   	<div class="form-group">
						  <div class="col-md-12">
						  	<div class="container">
								<div class="row">
						  			<input id="txtIqama" name="txtIqama" type="text" tabindex="3" placeholder="Iqama No." class=" form-control input-md" required="">
						  		</div>
						  	</div>
						  </div>
				  	</div>

					
					<div class="form-group">
					  	<div class="container">
						  	<div class="col-sm-12">
							  	<div class="row">
								  	 <input  type="text" tabindex="4" class="form-control datePicker" placeholder="Enter Birth date"  name="birthdate" required="" />
							  	</div>
						  	</div>
				  		</div>
				  	</div>


				  	<div class="form-group">
					  <div class="col-md-12">
					  	<div class="container">
							<div class="row">
					  			<input id="txtMobile" name="txtMobile" type="text" tabindex="5" placeholder="Mobile number" class=" form-control input-md" required="">
					  		</div>
					  	</div>
					  </div>
				  	</div>	

				  	<div class="form-group">
				  		<div class="container">
						   <div class="row">
							  <div class="col-md-12">
							    <label class="col-md-3 control-label" for="">Profile Photo</label>
							    <input type="file" id="upload_profile_photo" name="upload_profile_photo" class="input-file">
							  </div>
							</div>
						</div>

						<div class="container">
							<div class="row">
								<div class="col-md-8 text-center">
									<img id="upload_preview"	class="img employee_photo full-width margin-3p" src="../resources/uploads/avatar.jpg">
								</div>
<!-- 
							<div id="b64"></div> -->
							
							</div>
						</div>


					</div>


				   <div class="form-group">
					   <div class="container">
						   <div class="row">
								  <div class="col-md-6"> 

								  	 <label class="col-md-4 control-label" for="radios">Gender</label>

								    <label class="radio-inline" for="radios-0">
								      <input type="radio" name="gender" value="1" tabindex="6" checked="checked">
								      Male
								    </label> 

								    <label class="radio-inline" for="radios-1">
								      <input type="radio" name="gender" value="0" tabindex="7">
								      Female
								    </label>

								  </div>
							</div>
						</div>
					</div>





				</div>


				<div class="col-sm-6">
				





					<div class="form-group">
					  	<div class="container">
						  	<div class="col-sm-12">
							  	<div class="row">
								  	 <input  type="text"  tabindex="8" class="form-control datePicker" placeholder="Starting date"  name="txtStarting_date" required="" />
							  	</div>
						  	</div>
				  		</div>
				  	</div>


				   	<div class="form-group">
						  <div class="col-md-12">
						  	<div class="container">
								<div class="row">
						  			<input id="txtComputer_id" name="txtComputer_id" type="text" tabindex="9" placeholder="Computer No." class=" form-control input-md" required="">
						  		</div>
						  	</div>
						  </div>
				  	</div>


					<div class="form-group">
					  <div class="col-md-12">
							<div class="container">
								<div class="row">
									<div class="input-group">


										<input id="status_name" name="status_name" type="text" placeholder="Enter new status" class="form-control input-md d-none">
									    
									    <select id="drpdownStatus" name="drpdownStatus" tabindex="10" class="form-control">
									      <option selected="" disabled="">-Select Status-</option>

									      <?php  foreach ($statuses as $status) { ?>
									      	<option value="<?php echo $status->status_id ?>"><?php echo $status->status_name;	?></option>
										  <?php    } ?>

									    </select>
									    <span class="input-group-btn">
											<input type="button" class="button btn btn-default" name="btnAddStatus" id="btnAddStatus" value="Add">
									    </span>
									
									</div>
								</div>
							</div>
	 					</div>
					</div>


					<div class="form-group">
					  <div class="col-md-12">
							<div class="container">
								<div class="row">
									<div class="input-group">


										<input id="location_name" name="location_name" type="text" placeholder="Enter new location" class="form-control input-md d-none">
									    
									    <select id="drpdownLocation" name="drpdownLocation" tabindex="11" class="form-control">
									      
									    	
									      <option selected="" disabled="">-Select Location-</option>
									      <?php  foreach ($locations as $location) { ?>
									      	<option value="<?php echo $location->location_id ?>"><?php echo $location->location_name;	?></option>
										  <?php    } ?>



									    </select>
									    <span class="input-group-btn">
											<input type="button" class="button btn btn-default" name="btnAddLocation" id="btnAddLocation" value="Add">
									    </span>
									
									</div>
								</div>
							</div>
	 					</div>
					</div>


					<div class="form-group">
					  <div class="col-md-12">
							<div class="container">
								<div class="row">
									<div class="input-group">

									<input id="position_name" name="position_name" type="text" placeholder="" class="form-control input-md d-none">

									    <select id="drpdownPosition" name="drpdownPosition" tabindex="12" class="form-control">
									      <option selected="" disabled="">-Select Position-</option>
									    
									      <?php  foreach ($positions as $position) { ?>
									      	<option value="<?php echo $position->position_id ?>"><?php echo $position->position_name;	?></option>
										  <?php    } ?>
									    </select>
									    <span class="input-group-btn">
											<input type="button" class="button btn btn-default" name="btnAddPosition" id="btnAddPosition" value="Add">
									    </span>
									</div>
								</div>
							</div>
	 					</div>
					</div>




					<div class="form-group">
					  <div class="col-md-12">
							<div class="container">
								<div class="row">
									<div class="input-group">

									<input id="nationality_name" name="nationality_name" type="text" placeholder="" class="form-control input-md d-none">

									    <select id="drpdownNationality" name="drpdownNationality" tabindex="13" class="form-control">
									      <option selected="" disabled="">-Select Nationality-</option>

									      <?php  foreach ($nationalities as $nationality) { ?>
									      	<option value="<?php echo $nationality->nationality_id ?>"><?php echo $nationality->nationality_name;	?></option>
										  <?php    } ?>

									    </select>
									    <span class="input-group-btn">
											<input type="button" class="button btn btn-default" name="btnAddNationality" id="btnAddNationality" value="Add">
									    </span>
									</div>
								</div>
							</div>
	 					</div>
					</div>





				</div>


			</div>

					<div class="form-group">
					  <div class="col-md-12">
					    <button id="btnAddUser" type="submit" name="btnAddUser" tabindex="12" class="btn btn-primary">Add</button>
					    <button type="button" tabindex="13" class="clear-all btn btn-default">Clear All</button>
					  </div>
					</div>
			


		</div>



			
			</fieldset>



		</form>


<?php

include_once("modals.php");

?>


<script>
$(document).ready(function() {


    $('.datePicker').datepicker({
            format: 'yyyy-mm-dd'
            // format: 'M dd, yyyy',
            ,autoclose:true
    });

});



</script>


</body>
</html>