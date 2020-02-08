<?php

class user_model extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function login($username,$password)
	{
		 $this->db->select('userID,firstname');
		$this->db->where('email',$username);
		$this->db->where('password',MD5($password));		
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
		       //return $query->row_array();
		    return $query->row_array();
		}
		else {
			   return 0;
		}

	}
	function loginFb($fbID)
	{
		$this->db->select('userID,firstname');
		$this->db->where('fbID',$fbID);
		$this->db->where('password',MD5($fbID));		
		$query = $this->db->get('users');

		if($query->num_rows() == 1) {
		       //return $query->row_array();
		    return $query->row_array();
		}
		else {
			   return 0;
		}
	}
	function getUserdetails($id)
	{
		$this->db->select('*');
		$this->db->where('userID',$id);
		$query = $this->db->get('users');
		
		return $query->row_array();

	}

	function getUserId($email)
	{
		 	$this->db->select('userID');
			$this->db->where('email',$email);
			$query = $this->db->get('users');
			return ($query->num_rows() == 1) ? $query->row()->userID : 0;
	}
	function getUserOrderHistory($id)
	{
		$this->db->select('*');
		$this->db->where('userID',$id);
		$query = $this->db->get('orders');
		
		return $query->row_array();
	}
	function registerUser($data)
	{
		 $this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	 function isEmailExists($email)
	   {
	   	    $this->db->select('userID');
			$this->db->where('email',$email);
			$query = $this->db->get('users');
			return ($query->num_rows() == 1) ? true : false;
	   }
	  function isFbUserExist($fbid)
	   {
	   	    $this->db->select('userID');
			$this->db->where('password',MD5($fbid));
			$query = $this->db->get('users');
			return ($query->num_rows() == 1) ? true : false;
	   }

	   function getFbUserid($fbid)
	   {
	   	    $this->db->select('userID');
			$this->db->where('fbID',$fbid);
			$query = $this->db->get('users');
			return $query->row_array();
	   }
	   function updateUserAccessToken($accessToken,$userid)
	   {
	   	$this->db->set('accessToken',$accessToken);
	   	$this->db->where('userID',$userid);
	   	$this->db->update('users');

	   }
	   function isNumberExists($number)
	   {
	   	    $this->db->select('userID');
			$this->db->where('phone_number',$number);
			$query = $this->db->get('users');
			return ($query->num_rows() == 1) ? true : false;
	   }
	   function getUserEmail($id)
	   {
	   	$this->db->select('email');
	   	$this->db->where('userID',$id);
	   	$query = $this->db->get('users');
	   	return $query->row_array();

	   }
		
	function getUserName($id)
	{
		$this->db->select('firstname,lastname');
		$this->db->where('userID',$id);
		$query = $this->db->get('users');
		return $query->row_array();
	}
	function updateUserContactinfo($userid,$data)
	{
		$this->db->where("userID",$userid);
		$this->db->update("users",$data); 
		return $this->db->affected_rows();
	}

	function getTokenTime($email,$forgot_password)
	{
		$this->db->select('forgot_password_timestamp');
		$this->db->where("email",$email);
		$this->db->where("forgot_password",$forgot_password);
		$query = $this->db->get('users');
		return ($query->num_rows() == 1) ? $query->row()->forgot_password_timestamp : 0;
	}

	function getIfUserIsFacebookUser($userID)
	{
		 $this->db->select('userID');
		 $this->db->where('userID',$userID);
		 $this->db->where('fbID IS NULL',null,false);
		 $query = $this->db->get('users');
		 return ($query->num_rows() == 1) ? true : false;
	}
   
}
	?>