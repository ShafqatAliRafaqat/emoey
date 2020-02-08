<?php

class Basketstore extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getBaskets()
	{
		$this -> db -> select('*');
        $this -> db -> from('baskets_store');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	
	function addBasket($data)
	{
		$this->db->insert('baskets_store',$data);
		return $this->db->insert_id();

	}
	function getBasketById($basket_id)
	{
		$this->db->select('*');
		$this->db->where('baskets_store_id',$basket_id);
		$this->db->from('baskets_store');
		$query =  $this -> db-> get();
        return $query->num_rows() > 0 ? $query->row_array() : 0;
	}
	
	function getBasketByUrl($url)
	{
		$this->db->select('*');
		$this->db->where('hotdealurl',$url);
		$this->db->from('baskets_store');
		$query =  $this -> db-> get();
		return $query->num_rows()>0 ? $query->row_array() : 0;	
	}
	

	function deletebasketstore($id)
	{
		$this->db->where('baskets_store_id', $id);
  		 $this->db->delete('baskets_store'); 
	}
	

	function getBasketsbyCategory($cate)
	{
        $query = "SELECT * FROM baskets_store where FIND_IN_SET('$cate',dealcategory) > 0";
		$query = $this->db->query($query);

		return $query->num_rows()>0 ? $query->result_array() : 0;	
	}

	function updateHotDeal($id,$data)
	{

		$this->db->where('baskets_store_id', $id);
    	$this->db->update('baskets_store', $data);
    	return $this->db->affected_rows();
	}	
		
   
}
	?>