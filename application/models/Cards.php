<?php

class cards extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getCards($eventID)
	{
        $query = "SELECT * FROM cards where FIND_IN_SET('$eventID',eventID) > 0";
		$query = $this->db->query($query);
		return $query->result_array();	
	}
	function addCards($data)
	{
		$this->db->insert('cards',$data);
		return $this->db->insert_id();

	}
	function getCardName($id)
	{
		$this->db->select('card_name');
		$this->db->where('cardID',$id);
		$this->db->from('cards');
		$query = $this->db->get();
		return $query->row_array();
	}
	function getAllCards()
	{
		$this -> db -> select('*');
        $this -> db -> from('cards');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	function deletecard($id)
	{
		$this->db->where('cardID', $id);
  		 $this->db->delete('cards'); 
	}
}
	?>