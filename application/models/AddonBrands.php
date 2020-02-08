<?php

class addonBrands extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getAddons_brands()
	{
		$this -> db -> select('*');
        $this -> db -> from('addon_brands');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function addAddonsBrand($data)
	{
		$this->db->insert('addon_brands',$data);
		return $this->db->insert_id();

	}
	function deleteaddonbrand($id)
	{
		$this->db->where('addon_brandID', $id);
  		 $this->db->delete('addon_brands'); 
	}

	function getAddonsBrand($id)
	{
		$this -> db -> select('*');
		$this->db->where('addon_brandID',$id);
        $this -> db -> from('addon_brands');
        $query =  $this -> db-> get();
        return $query->row_array();
	}

	function updateAddonBrand($data,$id)
	{
		 $this->db->where('addon_brandID', $id);
    	$this->db->update('addon_brands', $data);
    	return $this->db->affected_rows();
	}
		
   
}
	?>