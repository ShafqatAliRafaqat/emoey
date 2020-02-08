<?php

class OrderAddons extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	
	function addOrderAddons($data)
	{
		 
		return $this->db->insert_batch('orderaddons', $data);
	}

	function getAddonsforOrder($orderid)
	{
		$this->db->select('addonid,quantity');
		$this->db->where('orderid',$orderid);
		$query = $this->db->get('orderaddons');
		return $query->result_array();
	}
   
}
	?>