<?php

class BasketStoreOrderModel extends CI_Model {
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();

	}

	
	
	function addBasketOrder($data)
	{
		$this->db->insert('basket_store_order',$data);
		return $this->db->insert_id();
	}

	function getDashboardOrders($limit,$offset,$status)
	{
		$this->db->select('basket_store_order.basket_store_order_id,basket_store_order.date,basket_store_order.paymentmethod,basket_store_order.customerorderid,basket_store_order.delivery_date,basket_store_order.status
			,receivers.firstname as receiverName,receivers.address,receivers.phone_number as receiverNumber,baskets_store.name,receivers.city,users.firstname,users.lastname,users.email,users.phone_number');	
		
		$this->db->join('baskets_store' , 'basket_store_order.basket_store_id = baskets_store.baskets_store_id');
	    $this->db->join('users as receivers' , 'basket_store_order.receiverID = receivers.userID');
	    $this->db->join('users','basket_store_order.userID = users.userID');

		$this->db->order_by('delivery_date','desc');
		$this->db->limit($limit, $offset);
		$this->db->where('status',$status);
		

		$query = $this->db->get('basket_store_order');
		return $query->result_array();
	}

	function processOrder($status,$orderid)
	{
		$this->db->where('basket_store_order_id', $orderid);
		$this->db->update('basket_store_order', $status); 
		return $this->db->affected_rows();
	}

	function getOrdersCount($status)
	{
		$this->db->select('basket_store_order_id');
		$this->db->where('status',$status);
		$query = $this->db->get('basket_store_order');
		return $query->num_rows();
	}

	function getUserOrder($userid)
	{
		$this->db->select('basket_store_order.customerorderid,basket_store_order.date,basket_store_order.status,receiver.firstname');	
	    $this->db->join('users as receiver' , 'basket_store_order.receiverID = receiver.userID');
		$this->db->where('basket_store_order.userID',$userid);
		$this->db->order_by('date','desc');
		$this->db->limit(10, 0);
		
		$query = $this->db->get('basket_store_order');
		return $query->result_array();
	}
	function getUserOrdersCount($userid)
	{
		$this->db->select('basket_store_order_id');
		$this->db->where('userID',$userid);
		$query = $this->db->get('basket_store_order');
		return $query->num_rows();
	}

	function deleteOrder($id)
	{
		 $this->db->where('basket_store_order_id', $id);
   		$this->db->delete('basket_store_order'); 
   		return $this->db->affected_rows();
	}
	
		
   
}
	?>