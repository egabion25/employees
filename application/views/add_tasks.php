<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ready to Serb!</title>

	<?php include_once("page_resources.php"); ?>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}


	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Add Task</h1>

	<div id="body">
		


		<form id="add_task" class="form-horizontal">
			<fieldset>


			<!-- Text input-->
			<div class="form-group">



				<div class="form-group">
				  <div class="col-md-4">
				    <select id="drpdownUser" name="drpdownUser" class="form-control autofill-user">
				      <option selected disabled >-Select User-</option>

						<?php foreach ($users as  $user): ?>

				      		<option value="<?php echo $user->user_id; ?>" > 
				      		<?php echo $user->user_firstname . " " . $user->user_middlename[0] .". "  .   $user->user_lastname;  ?>
				      		</option>

		  				<?php endforeach; ?>

				    </select>
				  </div>
				</div>


				<div class="form-group">
				  <div class="col-md-4">
				    <select id="drpdownCategory" name="drpdownCategory" class="form-control">
				      <option selected disabled >-Select Category-</option>


						<?php foreach ($task_categories as $category): ?>

				      		<option value="<?php echo $category->task_category_id; ?>" > 
				      		<?php echo $category->task_category_name;  ?>
				      		</option>

		  				<?php endforeach; ?>




				    </select>
				  </div>
				</div>




			<div class="form-group">
			  <div class="col-md-4">
			    <div class="input-group">
			      <span class="input-group-addon">     
			          <input id="chkDateCreated" type="checkbox" >     
			      </span>
			      <input id="txtDateCreated" class="autofill-datetime form-control datePicker" type="text" placeholder="Enter Date Created">
			    </div>
			    <p class="help-block"><i>*Check to put current date and time</i></p>
			  </div>
			</div>


			<div class="form-group">
			  <div class="col-md-4">
			    <div class="input-group">
			      <span class="input-group-addon">     
			          <input disabled type="checkbox">     
			      </span>
			      <input id="txtDateExpiry" class="autofill-datetime form-control datePicker" type="text" placeholder="Enter Date Expiry">
			    </div>
			    <p class="help-block"><i>*Check to base expiry based on current date and time</i></p>
			  </div>
			</div>



			<div class="form-group">
			  <div class="col-md-4">
			    <div class="input-group">
			      <span class="input-group-addon">     
			          <input disabled type="checkbox">     
			      </span>
			      <input  id="txtDateLastModified" class="autofill-datetime form-control datePicker" type="text" placeholder="Enter Last Date Modified">
			    </div>
			    <p class="help-block"><i>*Check to base expiry based on current date and time</i></p>
			  </div>
			</div>



			  <div class="col-md-4">
			  	<input id="txtTaskDescription" name="txtLocation" type="text" placeholder="Task location" class="autofill-task-description form-control input-md" required="">
			  </div>
			  <br>



			  <div class="col-md-4">
			  	<input id="txtTaskDescription" name="txtTaskDescription" type="text" placeholder="Task Description" class="autofill-task-description form-control input-md" required="">
			  </div>
			  <br>




			<div class="form-group">
			  <div class="col-md-4">
			    <button id="btnAddUser" type="submit" name="btnAddUser" class="btn btn-primary">Add</button>
			    <button class="clear-all btn btn-default">Clear All</button>
			    <button class="autofill-button btn btn-default">Autofill</button>
			  </div>
			</div>

			
			</fieldset>

		</form>

	</div>


<?php

include_once("modals.php");

?>


<script>
$(document).ready(function() {

    $('.datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
    });




	$("#chkDateCreated").change(function() {
	    if(this.checked) {
			var today = new Date();
			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			var dateTime = date+' '+time;

			var time = today.getHours() + ":" + (today.getMinutes()+5) + ":" + today.getSeconds();
			var dateTimeplus = date+' '+time;


			$("#txtDateCreated").val(dateTime);

			$("#txtDateExpiry").val(dateTimeplus);
						
			$("#txtDateLastModified").val(dateTime);
	    }
	});


});















</script>



	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>