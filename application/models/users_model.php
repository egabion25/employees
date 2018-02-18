<?php

class users_model extends CI_Model {

	//table names
	var $credentials = 'credentials c';
	var $inquiries = 'inquiries i';
	var $messages = 'messages m';
	var $reviews = 'reviews r';
	var $tasks = 'tasks t';
	var $users = 'users';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default',true);

	}	





	function getUser( $user_id = false){

		$this->db->select('user_id
							,user_firstname
							,user_middlename
							,user_lastname
							,user_gender
							,user_birthdate
							,user_photo'
						);

		$this->db->where('user_status', "active");


		if( $user_id ){
			$this->db->where('user_id', "active");
		}

		$query = $this->db->get($this->users);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}

	}






	function addUser( $fields = array() ){
	
		$fields = array(
			'user_firstname'	=> $fields["firstName"],
			'user_middlename'	=> $fields["middleName"],
			'user_lastname'		=> $fields["lastName"],
			'user_gender'		=> $fields["gender"],
			'user_birthdate'	=> $fields["birthdate"],
			'user_status'		=> $fields["status"],
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->users );
		return $this->db->insert_id();
	}





	
	function getTasksByCategory($category_id){

		$this->db->select('task_id
							,task_creator_id
							,task_category_id
							,task_date_created
							,task_date_expiry
							,task_last_date_modified
							,task_location
							,task_status
							,task_photo
							,task_description'
						);

		$this->db->where('task_category_id', $category_id);
		$query = $this->db->get($this->tasks);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
		
	}

	function insertTask( $fields = array() ){
	
		$fields = array(
			'task_creator_id'			=> $user_id,
			'task_category_id'			=> $category_id,
			'task_date_created'			=> date('Y-m-d H:i:s'),
			'task_date_expiry'			=> date('Y-m-d H:i:s') + $this->config->item["task_expiry"],
			'task_last_date_modified'	=> date('Y-m-d H:i:s'),
			'task_location'				=> "Test location",
			'task_status'				=> "available",
			'task_photo'				=> "Test Photo",
			'task_description'			=> "This is a sample test description.",
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( $this->tasks );
		$task_id = $this->db->insert_id();
	
	}

















	
		// $this->db->where_in('ticket_status', array('done', 'paid', 'paid_online'));

	
}
	



