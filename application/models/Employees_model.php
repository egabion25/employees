<?php

class Employees_model extends CI_Model {

	//table names
	// var $credentials = 'credentials c';
	// var $inquiries = 'inquiries i';
	// var $messages = 'messages m';
	// var $reviews = 'reviews r';
	// var $tasks = 'tasks t';
	// var $users = 'users u';
	var $users = 'users u';
	var $employees = 'employees';
	var $locations = 'locations';
	var $positions = 'positions';
	var $status = 'status';
	var $nationalities = 'nationalities';
	var $companies = 'companies';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default',true);
	}	





	function getEmployeeListing(){

		
		$this->db->select('employee_id
							,employee_full_name
							,employee_position_id
							,position_name
							,employee_company_id
							,company_name
							,employee_location_id
							,location_name'
						);


		if( isset($fields["employee_id"]	) ){
			$this->db->where('employee_id', $fields["employee_id"] );
		}


		$this->db->join(	$this->positions, $this->positions.'.position_id = ' . $this->employees.'.employee_position_id' );

		$this->db->join(	$this->locations, $this->locations.'.location_id = ' . $this->employees.'.employee_location_id' );

		$this->db->join(	$this->companies, $this->companies.'.company_id = ' . $this->employees.'.employee_company_id' );



		$query = $this->db->get($this->employees);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}


	function getEmployees( $fields = false){

		$this->db->select('employee_id as id
							,employee_full_name as name
							,employee_computer_id as c_id
							,employee_iqama_id as iqama'
						);

		// if( $status_name ){
		// 	$this->db->where('status_name', $status_name );
		// }

		$query = $this->db->get($this->employees);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}




	function getEmployeeFull( $fields = false){

		$this->db->select('employee_id
							,employee_creator_id
							,employee_iqama_id
							,employee_computer_id
							,employee_full_name
							,employee_gender
							,employee_firstname
							,employee_middlename
							,employee_lastname
							,employee_mobile_no
							,employee_status_id
							,employee_company_id
							,employee_bithdate
							,employee_starting_date
							,employee_position_id
							,position_name
							,employee_location_id
							,location_name
							,CONCAT( "../uploads/temp/" ,employee_photo) as employee_photo 
							,employee_date_added
							,employee_date_modified
							,employee_nationality'
						);


		if( isset($fields["employee_id"]	) ){
			$this->db->where('employee_id', $fields["employee_id"] );
		}


		$this->db->join(	$this->positions, $this->positions.'.position_id = ' . $this->employees.'.employee_position_id' );
		$this->db->join(	$this->locations, $this->locations.'.location_id = ' . $this->employees.'.employee_location_id' );



		$query = $this->db->get($this->employees);

		if($query->num_rows() > 0){
		return $query->row();
		}else{
		return false;
		}
	}





	function getStatus( $status_name = false ){

		$this->db->select('status_id
							,status_name
							,status_description'
						);

		if( $status_name ){
			$this->db->where('status_name', $status_name );
		}

		$query = $this->db->get($this->status);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}






	function addStatus( $fields = array() ){

		$fields = array(
			'status_name'			=> $fields["status_name"],
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->status );
		return $this->db->insert_id();
	}

	function getLocation(){

		$this->db->select('location_id
							,location_company_id
							,location_name	
							,location_description'	
						);

		$query = $this->db->get($this->locations);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}

	function addLocation( $fields = array() ){

		$fields = array(
			'location_company_id'	=> $fields["company_id"],
			'location_name'			=> $fields["location_name"],
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->locations );
		return $this->db->insert_id();
	}



	function getNationalities(){

		$this->db->select('nationality_id
							,nationality_name'
						);

		$query = $this->db->get($this->nationalities);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}

	function addNationalities( $fields = array() ){

		$fields = array(
			'nationality_name'			=> $fields["nationality_name"],
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->nationalities );
		return $this->db->insert_id();
	}




	function getPosition(){

		$this->db->select('position_id
							,position_name'
						);

		$query = $this->db->get($this->positions);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}


	function addPosition( $fields = array() ){

		$fields = array(
			'position_name'			=> $fields["position_name"],
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->positions );
		return $this->db->insert_id();
	}

	function addEmployee( $fields = array() ){


		$fields = array(
			'employee_id'				=> $fields["employee_id"],
			'employee_creator_id'		=> $fields["creator_id"],
			'employee_company_id'		=> $fields["company_id"],
			
			'employee_full_name'		=> $fields["employee_full_name"],

			'employee_gender'			=> $fields["employee_gender"],
			'employee_iqama_id'			=> $fields["employee_iqama_id"],
			'employee_nationality'		=> $fields["employee_nationality"],
			'employee_mobile_no'		=> $fields["employee_mobile_no"],
			
			'employee_status_id'		=> $fields["employee_status_id"],
			'employee_bithdate'			=> $fields["birthdate"],

			'employee_starting_date'	=> $fields["employee_starting_date"],
			'employee_computer_id'		=> $fields["employee_computer_id"],

			'employee_photo'			=> $fields["employee_photo"],

			
			'employee_position_id'		=> $fields["employee_position_id"],
			'employee_location_id'		=> $fields["employee_location_id"],
			'employee_date_added'		=> date("Y-m-d H:i:s"),
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->employees );


		// echo "<pre>";
		// print_r(	$this->db->insert( $this->employees )	);
		// echo "</pre>";
		// die();


		return $this->db->insert_id();
	}




}
	



