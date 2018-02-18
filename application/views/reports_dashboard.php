<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Employees</title>

			 <link rel="stylesheet" href="../resources/stable_bootstrap/bootstrap.min.css"> 
			 <link rel="stylesheet" href="../resources/stable_bootstrap/bootstrap-theme.min.css">

			<?php include_once("page_resources.php"); ?>
			
			<!-- <script src="../resources/js/jquery.dataTables.min.js<?php echo "?version=".date("dmYHis"); ?>"></script>
			<link rel="stylesheet" href="../resources/css/jquery.dataTables.min.css" />
			<link rel="stylesheet" href="../resources/css/datatables_custom.css" />
			<link rel="stylesheet" href="../resources/css/responsive.dataTables.min.css">  -->

	</head>

	<body>

	<?php include_once("navbar.php"); ?>


	<div id="page-container" class="container">
		<div class="row">
			<div class="table-responsive ">
		<!-- 		<table class="table">
					
					<thead>

						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">Emp. ID</th>
							<th rowspan="2">Full Name</th>
							<th rowspan="2">Category / Position</th>
							<th rowspan="2">Present</th>
								<tr>
									<th colspan="3">Breakdown</th>
								</tr>
							<th rowspan="2">Notes</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($attendance as $key => $a) {		?>
							<tr>
								<td rowspan="2"><?php echo $key; ?></td>
								<td rowspan="2"><?php echo $a["attendance_employee_id"]; ?></td>
								<td rowspan="2"><?php echo $a["employee_full_name"]; ?></td>
								<td rowspan="2"><?php echo $a["position_name"]; ?></td>
								<td rowspan="2">
									<?php echo ($a["is_absent"]  ? '&#9744;' : '&#9745;'); ?>
								</td>

								

								<td rowspan="2"><?php echo $a["notes"]; ?></td>
							</tr>
						<?php }?>


					</tbody>
				
				</table> -->

				<table class="table">
					
					<thead>

						<tr>
							<th rowspan="2">No.</th>
							<th rowspan="2">Emp. ID</th>
							<th rowspan="2">Full Name</th>
							<th rowspan="2">Category / Position</th>
							<th rowspan="2">Present</th>		
							<th colspan="4">Breakdown</th>
							
						
							<th rowspan="2">M/H</th>
							<th rowspan="2">T-M/OT</th>
							<th rowspan="2">10Hrs + OT</th>
							<th rowspan="2">Notes</th>
						</tr>

						<tr>
							
							<th >Time of Day</th>
							<th >TimeIN</th>
							<th >Time out</th>
							<th >Duration</th>
							
						</tr>

					</thead>
					<tbody>
						
						<tr>
							<td rowspan="2">No.</td>
							<td rowspan="2">Emp. ID</td>
							<td rowspan="2">Full Name</td>
							<td rowspan="2">Category / Position</td>
							<td rowspan="2">Present</td>		
							<td colspan="4">Breakdown</td>
							
						
							<td rowspan="2">M/H</td>
							<td rowspan="2">T-M/OT</td>
							<td rowspan="2">10Hrs + OT</td>
							<td rowspan="2">Notes</td>
						</tr>

						<tr>
							
							<td >Time of Day</td>
							<td >TimeIN</td>
							<td >Time out</td>
							<td >Duration</td>
							
						</tr>

					</tbody>
				
				</table>













			</div>
		</div>
	</div>

</body>


<style type="text/css">
	tfoot input {
	        width: 100%;
	        padding: 3px;
	        box-sizing: border-box;
	    }

	    tfoot {
    display: table-header-group;
}
    
</style>

<script type="text/javascript">
// $(document).ready(function() {

//     // DataTable
//     var table = $('table').DataTable({
// 	    responsive: true
// 	});
	 


// });



</script>
</html>