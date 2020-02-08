<?php

class addonCategory extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getAddons_cate()
	{
		$this -> db -> select('*');
        $this -> db -> from('addon_category');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function addAddonCategory($data)
	{
		$this->db->insert('addon_category',$data);
		return $this->db->insert_id();

	}
	function deleteaddonCategory($id)
	{
		$this->db->where('addon_catID', $id);
  		 $this->db->delete('addon_category'); 
	}
		
   
}
	?>