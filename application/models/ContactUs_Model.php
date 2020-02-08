<?php

class ContactUs_Model extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	
	function addcontactus($data)
	{
		$this->db->insert('contact_us',$data);
		return $this->db->insert_id();
	}
   
}
	?>