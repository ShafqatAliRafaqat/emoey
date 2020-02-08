<?php

class OrderModel extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	function getOrders()
	{
		$this -> db -> select('*');
        $this -> db -> from('order');
        $query =  $this -> db-> get();
        return $query->result_array();
	}
	
	function addEvent($data)
	{
		$this->db->insert('order',$data);
		return $this->db->insert_id();
		

	}
	function addOrder($data)
	{
		$this->db->insert('orders',$data);
		return $this->db->insert_id();
	}
	function deleteOrder($id)
	{
		 $this->db->where('orderID', $id);
   		$this->db->delete('orders'); 
   		return $this->db->affected_rows();
	}
	function getUserOrder($userid)
	{
		$this->db->select('orders.customerorderid,orders.date,orders.status,receiver.firstname');	
	    $this->db->join('users as receiver' , 'orders.receiverID = receiver.userID');
		$this->db->where('orders.userID',$userid);
		$this->db->order_by('date','desc');
		$this->db->limit(10, 0);
		$query = $this->db->get('orders');
		return $query->result_array();
	}

	function getDashboardOrders($limit,$offset,$status)
	{
		$this->db->select('orders.orderID,orders.finalPrice,orders.date,orders.vMessageURL,orders.paymentmethod,orders.customerorderid,orders.message,orders.delivery_date,orders.status
			,receivers.firstname as receiverName,receivers.address,receivers.phone_number as receiverNumber,receivers.city,users.firstname,users.lastname,users.email,users.phone_number,cards.card_name,baskets.basket_size,baskets.basket_price');
	    $this->db->join('users as receivers','orders.receiverID = receivers.userID');
	    $this->db->join('cards','orders.cardID = cards.cardID','left outer');
	    $this->db->join('baskets','orders.basketID = baskets.basketID','left outer');
	    $this->db->join('users','orders.userID = users.userID');
		$this->db->order_by('delivery_date','desc');
		$this->db->limit($limit, $offset);
		$this->db->where('status',$status);
		$query = $this->db->get('orders');
		return $query->result_array();
	}

	function getOrdersCount($status)
	{
		$this->db->select('orders.orderID');
		$this->db->where('status',$status);
		$query = $this->db->get('orders');
		return $query->num_rows();
	}

	function processOrder($status,$orderid)
	{
		$this->db->where('orderID', $orderid);
		$this->db->update('orders', $status); 
		return $this->db->affected_rows();
	}
	function getUserOrdersCount($userid)
	{
		$this->db->select('orderID');
		$this->db->where('userID',$userid);
		$query = $this->db->get('orders');
		return $query->num_rows();
	}
	
   
}
	?>