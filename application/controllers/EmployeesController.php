<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class employeesController extends CI_Controller {

	var $promptCode = array (
		'0' => 'success',
		'1' => 'User adding failed',
		'2' => 'Attendance query failed',
	);
		

	public function __construct() {
		parent::__construct();
		
	}
	
	
			
	function prompt($promptCode){
		$data['result'] = $promptCode;
		$data['message'] = $this->promptCode[$promptCode];

		header('Content-Type: application/json');
		echo json_encode($data);
	}
	
	
}



