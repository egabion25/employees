<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('EmployeesController.php');

class main extends employeesController {


	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct(){
		parent::__construct();
		parent::__construct();
		$this->load->model('employees_model', 'employees');
		$this->load->model('attendance_model', 'attendance');

	}



	public function index(){
		$this->timein();
	}



	public function add_employee(){
		$data["statuses"] = $this->employees->getStatus();
		$data["locations"] = $this->employees->getLocation();
		$data["positions"] = $this->employees->getPosition();
		$data["nationalities"] = $this->employees->getNationalities();

		// echo "<pre>";
		// print_r($statuses);
		// echo "</pre>";
		// die();

		$this->load->view('add_employee',$data);
	}


	public function timein(){

		$employees = $this->employees->getEmployees();
		$attendance = $this->attendance->getAttendance();

		$employee_IDs = array();
		foreach ($employees as $key => $employee) {
			$employee_IDs[] = $employee->id;
		}

		$employee_names = array();
		foreach ($employees as $key => $employee) {
			$employee_names[] = $employee->name;
		}

		$data["employees"] = $employees;
		$data["attendance"] = $attendance;

		$data["employee_id"] = $this->input->get("id");
		$data["attendance_date"] = $this->input->get("date");



		$this->load->view('timein', $data);
	}





	public function getEmployees(){

		$data["employees"] = $this->employees->getEmployeeListing();

		// $data["statuses"] = $this->employees->getStatus();
		// $data["locations"] = $this->employees->getLocation();
		// $data["positions"] = $this->employees->getPosition();
		// $data["nationalities"] = $this->employees->getNationalities();


		// echo json_encode($data["employees"]);
		// die();

		// echo "<pre>";
		// print_r($data["employees"]);
		// echo "</pre>";
		// die();

		$this->load->view('list_employees',$data);
	}









}
	