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
	<h1>Add User</h1>

	<div id="body">
		


		<form id="add_user" class="form-horizontal">
			<fieldset>


			<!-- Text input-->
			<div class="form-group">


			  <div class="col-md-4">
			  	<input id="txtFirstName" name="txtFirstName" type="text" placeholder="First Name" class="autofill-firstname form-control input-md" required="">
			  </div>
			  <br>

			  <div class="col-md-4">
			  	<input id="txtMiddleName" name="txtMiddleName" type="text" placeholder="Middle Name" class="autofill-middlename form-control input-md" required="">
			  </div>
			  <br>
			 
			 
			  <div class="col-md-4">
			  	<input id="txtLastName" name="txtLastName" type="text" placeholder="Last Name" class="autofill-lastname form-control input-md" required="">
			  </div>
			  <br>

				<div class="form-group">
				  <div class="col-md-4">
				    <select id="drpdownGender" name="drpdownGender" class="autofill-bit form-control">
				      <option selected disabled >-Select Gender-</option>
				      <option value="1">Male</option>
				      <option value="0">Female</option>
				    </select>
				  </div>
				</div>

				<div class="form-group">
				  <div class="col-md-4">
				    <select id="drpdownStatus" name="drpdownStatus" class="autofill-user-status autofill-bit form-control">
				      <option selected disabled >-Select Status-</option>
				      <option value="active">Active</option>
				      <option value="inactive">Inactive</option>
				      <option value="blocked">Blocked</option>
				    </select>
				  </div>
				</div>


			  <div class="col-md-4">
			  	 <input id="datePicker" type="text" class="autofill-date form-control" placeholder="Enter Birth date"  name="date" required="" />
			  </div>
			  <br>
			</div>

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

    $('#datePicker')
        .datepicker({
            format: 'yyyy-mm-dd'
    });







});



</script>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>