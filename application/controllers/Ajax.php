<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('EmployeesController.php');

class ajax extends employeesController {


	public function __construct(){
		parent::__construct();
		// $this->load->model('users_model', 'users');
		$this->load->model('employees_model', 'employees');
		$this->load->model('attendance_model', 'attendance');
	}

	public function index(){

	
	}

	public function dir(){
		echo getcwd();
	}


	public function test(){



		// $fields = array();
		// $fields["date"] = "2018-02-17";
		// $fields["location_id"] = "3";

		// $totalAttendance_array = $this->attendance->getTotalAttendance($fields,true);

		// $IDs = array();
		// foreach ($totalAttendance_array as $totalAttendance) {
		// 	$IDs[] = $totalAttendance->attendance_id;
		// }

		// $fields["total_attendance_id"] = $IDs;
		
		// $AttendanceBreak = $this->attendance->getAttendanceBreak($fields);



		// $attendanceReport = array();

		// foreach ($totalAttendance_array as $key => $totalAttendance) {
		 	
		// 	$attendanceReport[] = array( 
		// 								"attendance_employee_id" => $totalAttendance->attendance_employee_id
		// 									,"employee_full_name" => $totalAttendance->employee_full_name
		// 									,"position_name" => $totalAttendance->position_name
		// 									,"is_absent" => $totalAttendance->attendance_absent
		// 									,"notes" => $totalAttendance->attendance_notes
		// 								);	



		//  } 




		
		// echo "<pre>";
		// print_r($attendanceReport);
		// echo "</pre>";
		// die();



	}



	public function getEmployee($id, $date = false){

		$field["employee_id"] =  $id;
		$employee = $this->employees->getEmployeeFull($field);
		
		if($date){
			$field["date"] =  $date;
			$attendance_info = $this->attendance->getAttendanceByDate($field); 
			$employee->attendance = $attendance_info;
			
		}

		echo json_encode($employee);
	}


	public function getStatus(){
		$status = $this->employees->getStatus();
		echo json_encode($status);
	}



	

	public function addStatus(){


		$fields["status_name"] =  $this->input->post('status');

		$affected_row = $this->employees->addStatus(	$fields	);
		
		if($affected_row){
			$this->prompt(0);
		}else{

		}

	}



	public function getNationalities(){
		$nationalities = $this->employees->getNationalities();
		echo json_encode($nationalities);
	}


	public function addNationality(){


		$fields["nationality_name"] =  $this->input->post('nationality');

		$affected_row = $this->employees->addNationalities(	$fields	);
		
		if($affected_row){
			$this->prompt(0);
		}else{

		}

	}



	public function getLocations(){
		$location = $this->employees->getLocation();
		echo json_encode($location);
	}


	public function addLocation(){


		$fields["location_name"] =  $this->input->post('location');
		$fields["company_id"] =  "1";

		$affected_row = $this->employees->addLocation(	$fields	);
		
		if($affected_row){
			$this->prompt(0);
		}else{

		}

	}





	public function getPositions(){
		$location = $this->employees->getPosition();
		echo json_encode($location);
	}



	public function addPosition(){


		$fields["position_name"] =  $this->input->post('position');

		$affected_row = $this->employees->addPosition(	$fields	);
		
		if($affected_row){
			$this->prompt(0);
		}else{

		}

	}




	public function addEmployee(){


		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// die();


		$new_filename = false;



		$data = $this->input->post('image_data');

		list($type, $data) = explode(';', $data);
		list(, $data)      = explode(',', $data);
		$data = base64_decode($data);

		$new_filename = "employee_" . uniqid() . ".png";
		file_put_contents("uploads/temp/". $new_filename, $data);


		// if(	!$_FILES["profile_photo"]["error"] ){
		// 		$new_filename = "employee_" . uniqid() . "." . pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
		// 		$sourcePath = $_FILES['profile_photo']['tmp_name'];       // Storing source path of the file in a variable
		// 		$targetPath = "uploads/temp/". $new_filename; // Target path where file is to be stored
		// 		move_uploaded_file($sourcePath,$targetPath) ;    // Moving Uploaded file
		// }

		$fields["employee_id"] =  $this->input->post('txtEmployee_id');
		$fields["creator_id"] =  "21";
		$fields["company_id"] =  "1";

		$fields["employee_photo"] =  $new_filename;

		$fields["employee_full_name"] =  $this->input->post('txtFullName');
		$fields["employee_status_id"] =  $this->input->post('drpdownStatus');
		$fields["employee_location_id"] =  $this->input->post('drpdownLocation');
		$fields["employee_position_id"] =  $this->input->post('drpdownPosition');
		$fields["birthdate"] =  $this->input->post('birthdate');
		$fields["employee_gender"] =  $this->input->post('gender');

		$fields["employee_starting_date"] =  $this->input->post('txtStarting_date');
		$fields["employee_computer_id"] =  $this->input->post('txtComputer_id');


		$fields["employee_iqama_id"] =  $this->input->post('txtIqama');
		$fields["employee_nationality"] =  $this->input->post('drpdownNationality');
		$fields["employee_mobile_no"] =  $this->input->post('txtMobile');
		

		$user_id = $this->employees->addEmployee(	$fields	);
	

		if($user_id){
			$this->prompt(0);
		}else{

		}

	}


// declare stdClass Object in php

	public function submitAttendance( $employee_id, $creator_id ){

		$entry = json_decode($this->input->post("data"));

		$attendance = $entry->attendance;
		$notes = $entry->notes;

		$is_absent = false;
		if( isset(	$entry->absent )){
			$is_absent = true;
			$absent_obj = new stdClass();
			$absent_obj->timein = $entry->absent;
			$absent_obj->timeout = $entry->absent;
			$absent_obj->absent = true;
			$attendance = array( $absent_obj );
		}

		// echo "<pre>";
		// print_r( $attendance );
		// echo "</pre>";
		// die();

		$result = $this->attendance->addAttendance(	$attendance, $employee_id, $creator_id ,$notes, $is_absent );

		if($result){
			$this->prompt(0);
		}else{
			$this->prompt(2);
		}
	}






	public function getAttendance(){
		$attendance = $this->attendance->getAttendance();
		

		if(	$attendance){
			echo json_encode($attendance);
		}else{
			$this->prompt(2);
		}

	}




	






}
	