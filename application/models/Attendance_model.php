<?php

class attendance_model extends CI_Model {

	var $users = 'users u';
	var $locations = 'locations';
	var $status = 'status';
	var $nationalities = 'nationalities';

	var $employees = 'employees e';
	var $positions = 'positions p';
	var $attendance = 'attendance a';
	var $attendance_breakdown = 'attendance_breakdown ab';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database('default',true);
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

	


	function addAttendance( $attendance_array, $employee_id, $creator_id, $notes = false, $is_absent = false ){


			$first_timein = $attendance_array[0]->timein;
			$last_timeout = $attendance_array[0]->timeout;
			foreach ($attendance_array as $key => $entry) {
				if(	$last_timeout < $entry->timeout	){
					$last_timeout = $entry->timeout;
				}
			}
		
			// echo "<pre>";
			// print_r( $first_timein );
			// echo "</pre>";
			// die();

			$total_attendance_id = $this->addTotalAttendance($employee_id,	$first_timein,	$last_timeout, $notes, $is_absent  );

			if(	! $is_absent ){

				$insert_IDs = array();
				$query_string = "";

				foreach ($attendance_array as $entry) {

		        		$timein = $entry->timein;
		        		$timeout = $entry->timeout;
		        		$minutes = $entry->minutes;

						$query_string = "INSERT INTO attendance_breakdown (attendance_breakdown_employee_id, total_attendance_id, attendance_breakdown_creator_id , attendance_breakdown_time_in ,attendance_breakdown_time_out ,attendance_breakdown_duration) VALUES ( '$employee_id', $total_attendance_id,  $creator_id ,'$timein' ,'$timeout' ,$minutes ); ";
						
						$this->db->query( $query_string );
						$insert_IDs[] = $this->db->insert_id();
				}
			}else{
				return "absent";
			}

			if(	count($insert_IDs) ){
				return count($insert_IDs);
			}else{
				return false;
			}


	}




	function addTotalAttendance($employee_id, $timein, $timeout, $notes=false, $is_absent = false){

		$fields = array(
			'attendance_employee_id'	=> $employee_id,
			'attendance_timein' 		=> $timein,
			'attendance_timeout'		=> $timeout,
			'attendance_notes' 			=> $notes,
			'attendance_absent' 		=> $is_absent,
		);
		
		// insert to db
		$this->db->set($fields);
		$this->db->insert( "attendance" );
		return $this->db->insert_id();
	}



	
	function getAttendance(){

		$this->db->select('ab.attendance_breakdown_employee_id
							,e.employee_full_name
							,p.position_name
							,sum(ab.attendance_breakdown_duration) as minutes'
						);

		$this->db->join($this->employees, $this->employees.'.employee_id = ab.attendance_breakdown_employee_id' );
		$this->db->join($this->positions, $this->positions.'.position_id = e.employee_position_id' );

		$this->db->limit(100);
		$this->db->group_by("ab.attendance_breakdown_employee_id");
		$this->db->order_by("ab.total_attendance_id ASC");

		$query = $this->db->get('attendance_breakdown ab');

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}


	function getAttendanceByDate(  $fields = array() ){
		
		if( isset($fields["employee_id"]	) ){
			$this->db->where('attendance_employee_id', $fields["employee_id"] );
		}

		if( $fields["date"] ){
			$this->db->Like('attendance_timeout', $fields["date"] ,"after" );
		}

		$this->db->select('a.attendance_id, 
							a.attendance_notes
							,a.attendance_absent'
						);

		$this->db->order_by("a.attendance_id DESC");
		$query = $this->db->get('attendance a');

		if($query->num_rows() > 0){

			$result = $query->row();
			$attendance["breakdown"] = $this->getAttendanceBreakdownByID( $result->attendance_id );
			$attendance["notes"] = $result->attendance_notes;
			$attendance["absent"] = $result->attendance_absent;
			return $attendance;
		}else{
			return false;
		}
	}
		
		

			



	function getAttendanceBreakdownByID(  $attendance_id ){


		$this->db->select('ab.attendance_breakdown_duration
							,ab.total_attendance_id
							,ab.attendance_breakdown_employee_id
							,ab.attendance_breakdown_creator_id
							,ab.attendance_breakdown_time_in
							,ab.attendance_breakdown_time_out
							,ab.attendance_breakdown_duration'
						);

		$this->db->where('total_attendance_id', $attendance_id );

		$this->db->order_by("ab.attendance_breakdown_id ASC");
		$query = $this->db->get('attendance_breakdown ab');

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}




















	function getTotalAttendance(  $fields = array(), $employee_details = false ){
		
		if( isset($fields["location_id"] ) ){
			$this->db->where('e.employee_location_id', $fields["location_id"] );
		}

		if( $fields["date"] ){
			$this->db->like('a.attendance_timein', $fields["date"] ,"after" );
		}



		$this->db->select('a.attendance_id 
							,a.attendance_employee_id
							,a.attendance_timein
							,a.attendance_timeout
							,a.attendance_notes
							,a.attendance_absent'
						);

		// $this->db->where('e.employee_status_id', "1" );

		$this->db->join($this->employees, $this->employees.'.employee_id = a.attendance_employee_id' );

		
		if(	$employee_details	){
			$this->db->select('e.employee_full_name
								,p.position_name');
			$this->db->join($this->positions, $this->positions.'.position_id = e.employee_position_id' );
		}






		$this->db->order_by("a.attendance_id ASC");
		$query = $this->db->get('attendance a');


		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
		










	function getAttendanceBreak(  $fields = array() ){

		if( isset(	$fields["total_attendance_id"]	) ){
			$this->db->where_in('ab.total_attendance_id', $fields["total_attendance_id"] );
		}

		$this->db->select('ab.attendance_breakdown_duration
							,ab.total_attendance_id
							,ab.attendance_breakdown_employee_id
							,ab.attendance_breakdown_creator_id
							,ab.attendance_breakdown_time_in
							,ab.attendance_breakdown_time_out
							,ab.attendance_breakdown_duration'
						);


		$this->db->order_by("ab.attendance_breakdown_id ASC");
		$query = $this->db->get('attendance_breakdown ab');

		if($query->num_rows() > 0){
		return $query->result();
		}else{
		return false;
		}
	}












}
	



