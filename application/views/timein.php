<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Ready to Serb!</title>


	<script type="text/javascript">
		var activate_clock = true;
		var employees = <?php echo json_encode($employees); ?>;
		var active_employee_id = '<?php echo $employee_id; ?>';
		var override_date = '<?php echo $attendance_date; ?>';

	</script>

	<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
	<link rel="stylesheet" href="../resources/css/jquery-ui.min.css">

	<?php include_once("page_resources.php"); ?>

	<script src="../resources/js/bootstrap.bundle.min.js"></script>
	 <script src="../resources/js/underscore-min.js"></script>
	 <script src="../resources/js/bootstrap3-typeahead.min.js"></script>
	<script src="../resources/js/moment.js"></script>

	<!-- <script src="../resources/js/timein.js<?php echo "?version=" .  date("dmYHis"); ?>" ></script> -->
	<script src="../resources/js/timein.js"></script>
	<script src="../resources/js/timer.js<?php echo "?version=" .  date("dmYHis"); ?>"></script>



</head>
<body>


	


			<div id="main-container" class="row">
					<div id="timer" class="col-md-5">


							<div class="user">
								<p>Logged-in as: <strong>Administrator</strong></p>
							</div>

							<div class="form-group manual-input">
								<div class="container">
									<div class="row">

										<div class="col-md-3 col-sm-4 col-xs-12" >
											<select id="drpCategory" class="form-control no-padding minimalist-input row  font-size-small">
											<option value="id">Employee ID</option>
											<option value="c_id">Computer ID</option>
											<option value="iqama">Iqama ID</option>
											<option value="name">Full Name</option>
											</select>
										</div>
																			
										<div class="col-md-9 col-sm-8 col-xs-12">
											<input id="txtSearch" name="txtSearch" class="form-control minimalist-input row no-padding typeahead" placeholder="Employee ID..." type="text">
										</div>

									</div>
								</div>
							</div>

							<br>


						<i id="manual-InOut" class="fa fa-cog fa-4x position-absolute invisible" title="Manual Input"> </i>

						<div class="form-group">

							<center>
								<h3 class="current-day"><?php echo date("l") ?></h3>
							</center>

							<center>
								<h3 class="current-date"><?php echo date("M d, Y") ?></h3>

							</center>

							<div class="col-sm-12">
							  	<div class="row">
								  	 <input  type="text" class="custom-date datePicker form-control minimalist-input medium-text y-margin-0 text-center d-none" />
							  	</div>
						  	</div>

							<center>
							<h3 class="current-time jumbo-text y-margin-0 blink_me">
								<?php //echo date("H:i A") ?>
							</h3>
						
							<div class="custom-time-container input-group bootstrap-timepicker timepicker d-none">
					            <input type="text" class="custom-time form-control minimalist-input jumbo-text y-margin-0 text-center line-height-95">
					        </div>

							</center>





						</div>



							<div class="container">
								<div class="buttons  row invisible">

									<div class="col-md-4 time-in">

										<button title="Time in ( ctrl + 1 )" class="flat-button">
											<h2>IN</h2>
										</button>

									</div>

									<div class="col-md-4 time-out blured">

										
										<button disabled="disabled" title="Time out ( ctrl + 2 )" class="flat-button">
											<h2>OUT</h2>
										</button>
									</div>
									<div class="col-md-4 absent">

										
										<button title="Mark as Absent ( ctrl + 3 )" class="flat-button">
											<h2>ABSENT</h2>
										</button>
									</div>


								</div>
							</div>


							<div class="col-md-12 text-center button-links">
								
								<a href="./add_employee">
									<i title="Add Employee" class="fa fa-user-plus fa-4x padding-small"></i>
								</a>

								<i title="Manage Employees" class="fa fa fa-users fa-4x padding-small"></i>

								<a href="../reports/getEmployees">
									<i title="Generate Reports" class="fa fa-file-excel-o fa-4x padding-small"></i>
								</a>
							</div>



							</br>


					</div>





					<div id="profile-container" class="col-md-7 logo-background">


						<div class=" container invisible">
							<div class="row">

								<div class="col-md-3">
								     <img class="img employee_photo" src="./resources/uploads/avatar.jpg">
								</div>

								<div class="col-md-9">
									<h1 class="employee_name">JUAN DELA CRUZ</h1>
									<h3 class="employee_position">IT Specialist Supervisor</h3>
									<h4 class="employee_location">Rumah Site</h4>
								</div>

							</div>
						</div>



						<br>


						<div class="container work-hours invisible">
							<div class="row attendance-container">

								<div class="col-md-7 time-breakdown"></div>


								<div class="col-md-5">
										</br>
									     <h1 class="total-workhours big-text line-height-80">&nbsp<h1>
									     <center><h5 class="over-time-text"></h5></center>
								</div>

							</div>			
						</div>			





						<div class="container invisible">
							<div class="row  buttons">

								 <div class="col-md-12">


								<div class="container">
									<div class="row">
										<div class="col-sm-3">	
										    <img class="img img-responsive text-center absent-watermark" src="../resources/uploads/absent.png">
										</div>
									</div>
								</div>



									<textarea disabled="disabled" class="full-width blured" placeholder="Notes here..."></textarea>
								</div>


								<div class="col-md-6 insert">
									<button class="flat-button blured"  disabled="disabled"><h3>+ INSERT</h3></button>
								</div>

								<div class="col-md-6 clear">
									<button class="flat-button blured" disabled="disabled" ><h3>- CLEAR</h3></button>
								</div>

								<!-- <div class="col-md-4 absent" style="">	
									<button class="flat-button blured"  disabled="disabled"><h3>ABSENT</h3></button>
								</div> -->
							</div>
						</div>





					</div>




					<div id="attendance_table" class="col-md-12 no-padding overflow-y-hidden">
					    <div class="table-responsive ">

					        <table class="table table-striped header-fixed ">
								<thead>
								<tr>
								  <th>No.</th>
								  <th>Emp. ID</th>
								  <th>Name</th>
								  <th>Category/Position</th>
								  <th>Duration</th>
								</tr>
								</thead>


								<tbody>
									<?php 

								if( isset( $attendance )  ){
									if( $attendance	){
									 foreach( $attendance as $key => $value) {		


									        $hours = intval($value->minutes/60);
									        $minutes =  $value->minutes - ($hours * 60);

											if( $hours > 1){
												$hours = $hours . " Hours ";
											}else if( $hours == 1){
												$hours = $hours . " Hour ";
											}else{
												$hours = "";
											}									        



											if( $minutes > 1){
												$minutes = $minutes . " minutes ";
											}else if( $minutes == 1){
												$minutes = $minutes . " minute ";
											}else{
												$minutes = "";
											}									        





										?>


										<tr>
											<td><?php echo $key ?></td>
											<td><?php echo $value->attendance_breakdown_employee_id ?></td>
											<td><?php echo $value->employee_full_name ?></td>
											<td><?php echo $value->position_name ?></td>
											<td><?php echo $hours . $minutes  ?></td>
										</tr>
										



							        <?php    }}	

								}



							        ?>
								</tbody>

								
								
							</table>

					    </div>
					</div>








			</div>	





<?php

include_once("modals.php");

?>



</body>
</html>