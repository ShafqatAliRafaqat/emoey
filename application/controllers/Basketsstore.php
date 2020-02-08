<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Basketsstore extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','basketstore'));
    	$this->load->helper("security");
    }

	public function index()
	{
			
	}

	public function loadhotdealcategory()
	{
		if($this->uri->segment(2))
		{
			$todaydate = date('Y-m-d');
			$categoryurl = $this->security->xss_clean($this->uri->segment(2));
			$data['data'] =  $this->session->userdata('user_logged_in');
			$eventdata = $this->events->getEventbyurl($categoryurl,$todaydate);
			if($eventdata!=0)
			{
				$eventID = $eventdata['eventID'];
				$hotdeals = $this->basketstore->getBasketsbyCategory($eventID);
				$result = array();
				
					$result['deals'] = $hotdeals !=0 ? $hotdeals : [];
					$result['categories'] = $this->events->getAllEvents($todaydate);

					if($hotdeals !=0) {

							for($i=0;$i< count($hotdeals);$i++) {
								$dealpicture = $hotdeals[$i]['image'];
								$dealspicarray = explode(",", $dealpicture);
								$result['deals'][$i]['primaryimage'] = $dealspicarray[0];
							}
					}

					$this->load->view('Header',$data);
					$this->load->view('Basketstore',$result);
					$this->load->view('Footer');
				
			}
			else{
				redirect('hotdeals');
			}
		}
	}

	public function loadbasket()
	{
		if($this->uri->segment(2))
		{
			$hotdeal = $this->security->xss_clean($this->uri->segment(2));
			$data['data'] =  $this->session->userdata('user_logged_in');
			$dealdata = $this->basketstore->getBasketByUrl($hotdeal);
			if($dealdata!=0)
			{
				$dealitems = $dealdata['items'];
				$itemsarray = explode(",", $dealitems);

				$itempictures = [];

				$dealpictures = $dealdata['image'];

				$dealspicarray = explode(",", $dealpictures);

				for($i = 0;$i<count($dealspicarray);$i++)
				{
					array_push($itempictures,base_url().'assets/img/basket_store/'.$dealspicarray[$i]);
				}

				for($i = 0;$i<count($itemsarray);$i++)
				{
					$addon = $this->addons->getAddon($itemsarray[$i]);
					$addon != 0 ? array_push($itempictures,base_url().'assets/img/addons_images/'.$addon['addon_image']):null;
				}

				$deal['deal'] = $dealdata;
				$deal['dealpictures'] = $itempictures;
				$this->load->view('Header',$data);
				$this->load->view('Dealdetail',$deal);
				$this->load->view('Footer');
			}
			else{
				redirect('hotdeals');
			}
		}

	}

	public function getBaskets()
	{
		$categories = $this->events->getEvents();
		$baskets = array();
		for($i=0;$i<count($categories);$i++)
		{
			$result = $this->basketstore->getBasketsbyCategory($categories[$i]['eventID']);
			if($result)
			{
				$baskets[$categories[$i]['eventID']] = $result;
			}
		}

		$data_['categories'] = $categories;
		$data_['baskets'] = $baskets;

		echo json_encode($data_);
	}

	public function loadbasketstore()
	{
		$data['data'] =  $this->session->userdata('user_logged_in');
		$todaydate = date('Y-m-d');
		$categories['categories'] = $this->events->getAllEvents($todaydate);
		$this->load->view('Header',$data);
		$this->load->view('Maincategoriespage',$categories);
		$this->load->view('Footer');
	}
}

