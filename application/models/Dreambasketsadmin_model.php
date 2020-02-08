<?php

class dreambasketsadmin_model extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function login($username,$password)
	{
		 $this->db->select('id');
		$this->db->where('username',$username);
		$this->db->where('password',MD5($password));		
		$query = $this->db->get('dreambasketsadmin');

		if($query->num_rows() == 1) {
		       //return $query->row_array();
		    return $query->row()->id;
		}
		else {
			   return 0;
		}

	}
		
   
}
	?>