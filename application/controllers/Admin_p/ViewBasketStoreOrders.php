<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class viewBasketStoreOrders extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	  var $image_path;
	function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('basket','events','addons','cards','admin_model','addonBrands','addonCategory'));
    }

	public function index()
	{

		
		if(!$this->session->userdata('admin_logged_in'))
		{
			$this->load->view('/admin-views/Adminheader');
			$this->load->view('Admin-login');
			$this->load->view('Footer');
		}
		else
		{
				$this->load->view('/admin-views/Adminheader');
				$this->load->view('/admin-views/ViewBasketStoreOrder_v');
		}
		
	}

	public function viewCBasketStoreOrders()
	{
		if(!$this->session->userdata('dreambasketadmin_logged_in'))
		{
			$this->load->view('/admin-views/Head');
			$this->load->view('/admin-views/Dream-login');
		}
		else
		{
			$this->load->view('/admin-views/Dreamheader');
			$this->load->view('/admin-views/ViewBasketStoreOrder_v');
		}
	}

	

}

