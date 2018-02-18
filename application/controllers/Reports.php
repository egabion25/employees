<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('EmployeesController.php');

class reports extends employeesController {

	public function __construct(){
		parent::__construct();
		$this->load->model('employees_model', 'employees');
		$this->load->model('attendance_model', 'attendance');
	}

	public function index(){
		$this->getEmployees();
	}

	public function getEmployees(){
		$data["employees"] = $this->employees->getEmployeeListing();
		$this->load->view('list_employees',$data);
	}


	public function dailyTimesheet(){

		$fields = array();
		$fields["date"] = "2018-02-17";
		$fields["location_id"] = "4";

		$totalAttendance_array = $this->attendance->getTotalAttendance($fields,true);

		$IDs = array();
		foreach ($totalAttendance_array as $totalAttendance) {
			$IDs[] = $totalAttendance->attendance_id;
		}

		$fields["total_attendance_id"] = $IDs;
		
		$AttendanceBreak = $this->attendance->getAttendanceBreak($fields);



		$attendanceReport = array();

		foreach ($totalAttendance_array as $key => $totalAttendance) {
		 	
			$attendanceReport[] = 	array( 
										"attendance_employee_id" => $totalAttendance->attendance_employee_id
										,"employee_full_name" => $totalAttendance->employee_full_name
										,"position_name" => $totalAttendance->position_name
										,"is_absent" => $totalAttendance->attendance_absent
										,"breakdown" => $AttendanceBreak
										,"entry_count" => count($AttendanceBreak)
										,"notes" => $totalAttendance->attendance_notes
									);	



		 } 




		
		// echo "<pre>";
		// print_r($attendanceReport);
		// echo "</pre>";
		// die();


// 




		$data["attendance"] = $attendanceReport;
		
		$this->load->view('reports_dashboard',$data);
	
	}


}
	