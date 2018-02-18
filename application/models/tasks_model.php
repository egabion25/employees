<?php

class tasks_model extends CI_Model {

	//table names
	var $credentials = 'credentials';
	var $inquiries = 'inquiries';
	var $messages = 'messages';
	var $reviews = 'reviews';
	var $tasks = 'tasks';
	var $task_categories = 'task_categories';
	var $users = 'users';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default',true);

	}	





	function getTaskCategory( $task_category_id = false){

			$this->db->select('task_category_id
							,task_category_name
							,task_category_description
							,task_category_photo'
						);

		$this->db->where('task_category_status', "1");


		if( $task_category_id ){
			$this->db->where('task_category_id', $task_category_id );
		}

		$query = $this->db->get($this->task_categories);

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}


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
	



