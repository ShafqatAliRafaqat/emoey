<?php

class friendlistmodel extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function updateFriend($userid,$friendid)
	{
		if($this->friendExist($userid,$friendid) == false)
		{
			$data = array('user'=>$userid,'friend'=>$friendid);
			 $this->db->insert('friendlist', $data);
			return $this->db->insert_id();
		}

	}
	function friendExist($userid,$friendid)
	{
		$this->db->select('*');
		$this->db->where('user',$userid);
		$this->db->where('friend',$friendid);
		$query = $this->db->get('friendlist');
		return ($query->num_rows() == 1) ? true : false;
	}

	function fetchUserFriends($userid)
	{
		$this->db->select("friendlist.*, users.firstname,users.lastname");
		$this->db->join('users', 'users.userID = friendlist.friend');
		$this->db->where('user',$userid);
		
		$query = $this->db->get('friendlist');
		return $query->result_array(); 
	}
}
	?>