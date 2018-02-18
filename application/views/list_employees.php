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
			
			<script src="../resources/js/jquery.dataTables.min.js<?php echo "?version=".date("dmYHis"); ?>"></script>
			<link rel="stylesheet" href="../resources/css/jquery.dataTables.min.css" />
			<link rel="stylesheet" href="../resources/css/datatables_custom.css" />
			<link rel="stylesheet" href="../resources/css/responsive.dataTables.min.css"> 

	</head>

	<body>

	<?php include_once("navbar.php"); ?>


	<div id="page-container" class="container">
		<div class="row">
			<table width="100%" class="stripe display responsive nowrap">
				<thead>

					<tr>
						<td>Employee ID</td>
						<td>Name</td>
						<td>Category</td>
						<td>Company</td>
						<td>Location</td>
					</tr>
				</thead>
				<tfoot>

					<tr>
						<th>Employee ID</th>
						<th>Name</th>
						<th>Category</th>
						<th>Company</th>
						<th>Location</th>
					</tr>
				</tfoot>
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
$(document).ready(function() {


    // $('table').DataTable();

      // Setup - add a text input to each footer cell
    $('table tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('table').DataTable({
    responsive: true
});
 
    // Apply the search
    table.columns().every( function () {
        var that = this;
 
        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

});



</script>
</html>