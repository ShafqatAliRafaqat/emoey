<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cardController extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards'));
    }

	public function index()
	{
		
		
	}


	public function getCard()
	{
		$event_id = $_POST['eventid'];
		
		$data_cards = $this->cards->getCards($event_id);
		echo json_encode($data_cards);
	}
}

