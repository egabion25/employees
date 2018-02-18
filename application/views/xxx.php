<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Employees</title>
<!-- 
			<link rel="stylesheet" href="../resources/css/bootstrap.min.css">
			<script src="../resources/js/bootstrap.bundle.min.js"></script> 
			<link rel="stylesheet" href="../resources/css/bootstrap.min.css"> 
			<link rel="stylesheet" href="../resources/css/jquery-ui.min.css"> 
 -->

	 		<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

			<?php include_once("page_resources.php"); ?>


			<script src="../resources/js/jquery.dataTables.min.js<?php echo "?version=".date("dmYHis"); ?>"></script>
			<link rel="stylesheet" href="../resources/css/jquery.dataTables.min.css" />
			<link rel="stylesheet" href="../resources/css/datatables_custom.css" />
	</head>

	<body>

		<div class="pos-f-t">
		  <div class="collapse" id="navbarToggleExternalContent">
		    <div class="bg-inverse p-4">
		      <h4 class="text-white">Collapsed content</h4>
		      <span class="text-muted">Toggleable via the navbar brand.</span>
		    </div>
		  </div>
		  <nav class="navbar navbar-inverse bg-inverse">
		    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		  </nav>
		</div>


	<div class="container">
		<div class="row">






			<table width="100%">
				<thead>

					<tr>
						<td>Employee ID</td>
						<td>Name</td>
						<td>Category</td>
						<td>Company</td>
						<td>Location</td>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($employees as $employee) {		?>
						<tr>
							<td><?php echo  $employee->employee_id; ?></td>
							<td><?php echo  $employee->employee_full_name; ?></td>
							<td><?php echo  $employee->position_name; ?></td>
							<td><?php echo  $employee->company_name; ?></td>
							<td><?php echo  $employee->location_name; ?></td>
						</tr>
					<?php }?>


				</tbody>
			
			</table>

		</div>
	</div>

</body>


<script>
$(document).ready(function() {


    $('table').DataTable();

});



</script>
</html>