<?php

class events extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getEvents()
	{
		$this -> db -> select('*');
        $this -> db -> from('events');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	
	function addEvent($data)
	{
		$this->db->insert('events',$data);
		return $this->db->insert_id();

	}
	function deleteEvent($id)
	{
		$this->db->where('eventID', $id);
  		 $this->db->delete('events'); 
	}

	function getAllEvents($validdate)
	{
		$this -> db -> select('*');
		$this-> db ->where('date_from <="'.$validdate.'"');
		$this-> db ->where('date_to >="'.$validdate.'"');
		$this-> db ->where('is_enabled',1);
        $this -> db -> from('events');
        $query =  $this -> db-> get();
        return $query->result_array();
	}

	function getEventById($id)
	{
		$this->db->select('*');
		$this->db->where('eventID',$id);
		$this->db->from('events');
		$query =  $this -> db-> get();
        return $query->num_rows() > 0 ? $query->row_array() : 0;
	}

	function getEventbyurl($url,$validdate)
	{
		$this->db->select('*');
		$this->db->where('eventurl',$url);
		$this-> db ->where('date_from <="'.$validdate.'"');
		$this-> db ->where('date_to >="'.$validdate.'"');
		$this-> db ->where('is_enabled',1);
		$this->db->from('events');
		$query =  $this -> db-> get();
		return $query->num_rows()>0 ? $query->row_array() : 0;	
	}

	function updateEvent($id,$data)
	{
		$this->db->where('eventID', $id);
    	$this->db->update('events', $data);
    	return $this->db->affected_rows();
	}
   
}
	?>