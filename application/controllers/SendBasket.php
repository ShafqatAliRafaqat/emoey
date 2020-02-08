<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendBasket extends CI_Controller {

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

	function __construct()
    {
    	parent::__construct();
    	$this->load->model(array('basket','events','addons','cards','addonCategory','addonBrands'));
    }

	public function index()
	{
		$data['data'] =  $this->session->userdata('user_logged_in');
		$this->load->view('Header',$data);
		$this->load->view('Booking');
		$this->load->view('Footer');
		
	}


	public function loadbasketdata()
	{

		$data_basket = $this->basket->getBasketTypes();
		$todaydate = date('Y-m-d');
		$data_events = $this->events->getAllEvents($todaydate);
		$data_addons = $this->addons->getAddons();

		$resultarr = array();
		$resultarr[0] = $data_basket;
		$resultarr[1] = $data_events;
		$resultarr[2] = $data_addons;
		

		echo json_encode($resultarr);
	}
	public function getAllData()
	{

		$data_basket = $this->basket->getBasketTypes();
		$data_events = $this->events->getEvents();
		$data_addons = $this->addons->getAddons();
		$data_cards  = $this->cards->getAllCards();
		$data_addoncategory  = $this->addonCategory->getAddons_cate();
		$data_addonbrands = $this->addonBrands->getAddons_brands();

		$resultarr = array();
		$resultarr[0] =$data_basket;
		$resultarr[1]=$data_events;
		$resultarr[2] = $data_addons;
		$resultarr[3] = $data_cards;
		$resultarr[4] = $data_addoncategory;
		$resultarr[5] = $data_addonbrands;

		echo json_encode($resultarr);
	}

	public function checkout()
	{
		$data['data'] =  $this->session->userdata('user_logged_in');
		$this->load->view('Header',$data);
		$this->load->view('Checkout');
		$this->load->view('Footer');
	}
}

