<?php

class addons extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getAddons()
	{
		$this -> db -> select('addons.*,addon_brands.addon_brand_title,addon_brands.discount');
		$this->db->join('addon_brands' , 'addons.addon_brandID = addon_brands.addon_brandID');
        $this -> db -> from('addons');
        $this->db->where('isrecommended',1);
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function getAllAddons()
	{
		$this -> db -> select('*');
        $this -> db -> from('addons');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function addAddons($data)
	{
		$this->db->insert('addons',$data);
		return $this->db->insert_id();
	}
	function updateAddons($data,$id)
	{
		 $this->db->where('addonID', $id);
    	$this->db->update('addons', $data);
    	return $this->db->affected_rows();
	}
	function getSelectedAddons($id)
	{
		$this -> db -> select('addons.*,addon_brands.addon_brand_title,addon_brands.discount');
		$this->db->join('addon_brands' , 'addons.addon_brandID = addon_brands.addon_brandID');
		$this->db->where('addon_catID',$id);
        $this -> db -> from('addons');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function getAddonNameAndPrice($id)
	{
		$this -> db -> select('addons.addon_name,addons.addon_price,addon_brands.addon_brand_title,addon_brands.discount');
		$this->db->join('addon_brands' , 'addons.addon_brandID = addon_brands.addon_brandID');
		$this->db->where('addonID',$id);
		$this->db->from('addons');
		$query = $this->db->get();
		return $query->row_array();
	}

	function deleteAddon($id)
	{
		$this->db->where('addonID', $id);
  		 $this->db->delete('addons'); 
	}
	function getSpecificAddon($id)
	{
		$this -> db -> select('addons.addon_name,addons.addon_price,addon_brands.addon_brand_title,addon_brands.discount');
		$this->db->join('addon_brands' , 'addons.addon_brandID = addon_brands.addon_brandID');
		$this->db->where('addonID',$id);
        $this -> db -> from('addons');
        $query =  $this -> db-> get();
        return $query->row_array();
	}
	function getAddon($id)
	{
		$this -> db -> select('*');
		$this->db->where('addonID',$id);
        $this -> db -> from('addons');
        $query =  $this -> db-> get();
        return $query->num_rows() > 0 ? $query->row_array() : 0;
	}
		
   
}
	?>