<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('employeesController.php');
class Welcome extends employeesController {

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

	// public function index()
	// {
	// 	$this->load->view('welcome_message');
	// }


	public function index(){
		$this->timein();
	}



		public function timein(){


		$employees = $this->employees->getEmployees();
		$attendance = $this->attendance->getAttendance();


		// foreach ($employees as $key => $employee) {
			
		// 	$employees[$key]->name =  "<p> $employee->id </i>" . " " . $employee->name;

		// 	"<span>" . . "</span>"
		// }


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
		// $data["employee_names"] = $employee_names;
		// $data["employee_IDs"] = $employee_IDs;


		// echo "<pre>";
		// print_r($employee_IDs);
		// echo "</pre>";
		// die();

		$this->load->view('timein', $data);
	}



}
