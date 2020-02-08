<?php

class basket extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getBasketTypes()
	{
		$this -> db -> select('*');
        $this -> db -> from('baskets');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function addBasket($data)
	{
		$this->db->insert('baskets',$data);
		return $this->db->insert_id();

	}
	function getBasketName($id)
	{
		$this->db->select('basket_size,basket_price');
		$this->db->where('basketID',$id);
		$this->db->from('baskets');
		$query = $this->db->get();
		return $query->row_array();
	}
	function deleteBasket($id)
	{
		$this->db->where('basketID', $id);
  		 $this->db->delete('baskets'); 
	}
		
   
}
	?>