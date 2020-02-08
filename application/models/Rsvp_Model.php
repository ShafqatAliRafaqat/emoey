<?php

class Rsvp_Model extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	
	function addrsvp($data)
	{
		$this->db->insert('rsvp',$data);
		return $this->db->insert_id();
	}
   
}
	?>