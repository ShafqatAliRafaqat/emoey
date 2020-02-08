<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class editdeleteproducts extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','admin_model','addonBrands','addonCategory','Basketstore'));
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
			$this->load->view('/admin-views/EditDelete');
	}
	}

public function getAllData()
	{

		$data_basket = $this->basket->getBasketTypes();
		$data_events = $this->events->getEvents();
		$data_addons = $this->addons->getAllAddons();
		$data_cards  = $this->cards->getAllCards();
		$data_addoncategory  = $this->addonCategory->getAddons_cate();
		$data_addonbrands = $this->addonBrands->getAddons_brands();
		$data_basketstore = $this->Basketstore->getBaskets();

		$resultarr = array();
		$resultarr[0] =$data_basket;
		$resultarr[1]=$data_events;
		$resultarr[2] = $data_addons;
		$resultarr[3] = $data_cards;
		$resultarr[4] = $data_addoncategory;
		$resultarr[5] = $data_addonbrands;
		$resultarr[6] = $data_basketstore;

		echo json_encode($resultarr);
	}

	public function deleteaddon()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$id = $this->input->post('addonid');
			$this->addons->deleteAddon($id);
			echo json_encode("success");
		}

		
	}
	public function deleteevents()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id =  $this->input->post('eventid');
		$this->events->deleteEvent($id);
		echo json_encode("success");
	}
	}
	public function deletebasket()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id = $this->input->post('basketid');
		$this->basket->deleteBasket($id);
		echo json_encode("success");
	}
	}

	public function deletecard()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id = $this->input->post('cardid');
		$this->cards->deleteCard($id);
		echo json_encode("success");
		}
	}
	public function deleteAddonCategory()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id = $this->input->post('addoncateid');
		$this->addonCategory->deleteaddonCategory($id);
		echo json_encode("success");
		}
	}

	public function deleteAddonBrand()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id = $this->input->post('addonbrandid');
		$this->addonBrands->deleteaddonbrand($id);
		echo json_encode("success");
		}
	}

	public function deleteBasketStore()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$id = $this->input->post('baskets_store_id');
		$this->Basketstore->deletebasketstore($id);
		echo json_encode("success");
		}
	}

	public function editViewAddon()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$addonid =  $_GET['id'];

			$data = $this->addons->getAddon($addonid);
			if($data['isrecommended'] == 0)
			{
				$data['recommendedstatus'] = "";
			}
			else{
				$data['recommendedstatus'] = "checked";
			}

			$this->load->view('/admin-views/Adminheader');
			$this->load->view('/admin-views/EditAddonView',$data);
		}
	}
	public function editViewHotdeals()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$hotdealid =  $_GET['id'];

			$data = $this->Basketstore->getBasketById($hotdealid);

			$dealspicture = $data['image'];
			$dealspicarray = explode(",", $dealspicture);
			$data['dealimages'] = $dealspicarray;

			$this->load->view('/admin-views/Adminheader');
			$this->load->view('/admin-views/EditHotdealView',$data);
		}
	}
	public function editViewAddonBrands()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$addonbrandid =  $_GET['id'];

			$data = $this->addonBrands->getAddonsBrand($addonbrandid);

			$this->load->view('/admin-views/Adminheader');
			$this->load->view('/admin-views/EditAddonBrandView',$data);
		}
	}

	public function editViewEvent()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$eventID =  $_GET['id'];
			$data = $this->events->getEventById($eventID);

			if($data['is_enabled'] == 0)
			{
				$data['enablestatus'] = "";
			}
			else{
				$data['enablestatus'] = "checked";
			}
			$this->load->view('/admin-views/Adminheader');
			$this->load->view('/admin-views/EditEventView',$data);
		}
	}

	public function editAddonBrand()
	{
		if($this->session->userdata('admin_logged_in'))
		{
		$discount = $this->input->post('discount');
		$title = $this->input->post('addon_brand_title');
		$addonBrandID = $this->input->post('addon_brandID');

		$data = array('addon_brand_title' => $title,'discount' => $discount);

		$this->addonBrands->updateAddonBrand($data,$addonBrandID);
		redirect('/Admin_p/EditDeleteProducts','refresh');
	 }
	}

	public function editAddon()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$addon_name = $this->input->post('addon_name');

			$isrecommended = $this->input->post('isrecommended');


				$addon_image=""; 
				       

				   		$config['upload_path']          = './assets/img/addons_images/';
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                $config['max_size']             = 2048;
		                $config['max_width']            = 1024;
		                $config['max_height']           = 1024;
		                $config['remove_spaces']		 = 	TRUE;

		                $this->load->library('upload', $config);

		                if ( ! $this->upload->do_upload('addon_image'))
		                {
		                       // $error = array('error' => $this->upload->display_errors());

		                       // echo $this->upload->display_errors();
		                       // return;
		                }
		                else
		                {
		                        $data = array('upload_data' => $this->upload->data());
		                        $addon_image = $this->upload->data('file_name');

		                }
		          $price = $this->input->post('addon_price');
		          $desc = $this->input->post('addon_desc');
		          $addoncateID = $this->input->post('addon_cate');
		          $addonbrandID = $this->input->post('addon_brand');
		          $data_ = array();

		          if($price)
		          {
		          	$data_['addon_price'] = $price;
		          }

		          if($addon_name)
		          {
		          	$data_['addon_name'] = $addon_name;
		          }

		          if($addon_image)
		          {
		          	$data_['addon_image'] = $addon_image;
		          }

		          if($desc)
		          {
		          	$data_['description'] = $desc;
		          }

		          if($addoncateID)
		          {
		          	$data_['addon_catID'] = $addoncateID;
		          }
		         
		         
		         
		         if($addonbrandID)
		         {
		         	 $data_['addon_brandID'] = $addonbrandID;
		         }

		         $data_['isrecommended'] = $isrecommended;

		         $addonID = $this->input->post('addonID');
		         if(!$addonID)
		         {
		         	return;
		         }
		        
		         $result = $this->addons->updateAddons($data_,$addonID);
		         
		         redirect('/Admin_p/EditDeleteProducts','refresh');
		     }
		      
	}
	public function editEvent()
	{   
		if($this->session->userdata('admin_logged_in'))
		{
			$eventID = $this->input->post('eventID');

			$event_name = $this->input->post('event_name');
			
			$is_enabled = $this->input->post('is_enabled');
		       

		   		$config['upload_path']          = './assets/img/events_images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['remove_spaces']		 = 	TRUE;

                $this->load->library('upload', $config);

                $event_image = "";

                if ( ! $this->upload->do_upload('event_image'))
                {
                       //  $error = array('error' => $this->upload->display_errors());

                       // echo $this->upload->display_errors();
                       // return;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $event_image = $this->upload->data('file_name');

                }
          $date_from = $this->input->post('date_from');
          $date_to = $this->input->post('date_to');
          $eventnamelower = strtolower($event_name);
		  $evenurl = str_replace(' ', '_', $eventnamelower);
		  if($event_name)
		  {
		  	 $data_['name'] = $event_name;
		  }

		  if($event_image)
		  {
		  	$data_['image'] = $event_image;
		  }

		  if($date_from)
		  {
		  	$data_['date_from'] = $date_from;
		  }

		  if($date_to)
		  {
		  	$data_['date_to'] = $date_to;
		  }

		  $data_['is_enabled'] = $is_enabled;
         
         
         $result = $this->events->updateEvent($eventID,$data_);
         if($result>0)
         {
         	redirect('/Admin_p/EditDeleteProducts','refresh');
         }
         else{
         	echo 'Nothing Updated';
         }
		
	    }
	}

	public function editHotDeal()
	{
		if($this->session->userdata('admin_logged_in'))
		{

		$basket_store_id = $this->input->post('baskets_store_id');
		$addonsselected = $this->input->post('addonchecklist');


		$items = '';
		for($i=0;$i<count($addonsselected);$i++)
		{
			if((count($addonsselected) -1) != $i)
			{
				$items = $items.$addonsselected[$i] . ',';
			}
			else{
				$items = $items.$addonsselected[$i];
			}
		}

		$selectedEvents = $this->input->post('category_select');
		$card_category = '';

			for($i=0;$i<count($selectedEvents);$i++)
            {
            	if($i==0)
            	{
            		$card_category = $selectedEvents[$i];
            	}else{
            		$card_category =$card_category.",".$selectedEvents[$i];
            	}
            }

		$hotdealname = $this->input->post('basketstorename');

		

		if($hotdealname)
		{
			$data_['name'] = $hotdealname;
		}

		if($this->input->post('basketstore_desc'))
		{
			$data_['description'] = $this->input->post('basketstore_desc');
		}

		if($this->input->post('basketstore_price'))
         {
         	$data_['price'] = $this->input->post('basketstore_price');
         }

         if($card_category)
         {
         	$data_['dealcategory'] = $card_category;
         }

         if($items)
         {
         	 $data_['items'] = $items;
         }

         $hotdealtags = $this->input->post('basketstoretags');

         $data_['tags'] = $hotdealtags;

            $storeb_image = "";
            $filesCount = count($_FILES['store_images']['name']);
            if(!empty($_FILES['store_images']['name'][0]))
            {
            	   for($i = 0; $i < $filesCount; $i++) {
			            $_FILES['store_image']['name'] = $_FILES['store_images']['name'][$i];
			            $_FILES['store_image']['type'] = $_FILES['store_images']['type'][$i];
			            $_FILES['store_image']['tmp_name'] = $_FILES['store_images']['tmp_name'][$i];
			            $_FILES['store_image']['error'] = $_FILES['store_images']['error'][$i];
			            $_FILES['store_image']['size'] = $_FILES['store_images']['size'][$i];

				   		$config['upload_path']          = './assets/img/basket_store/';
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                $config['max_size']             = 2048;
		                $config['max_width']            = 1024;
		                $config['max_height']           = 1024;
		                $config['remove_spaces']		 = 	TRUE;

		                $this->load->library('upload', $config);

		                if ( ! $this->upload->do_upload('store_image'))
		                {
		                        $error = array('error' => $this->upload->display_errors());

		                       echo $this->upload->display_errors();
		                       return;
		                }
		                else
		                {
		                        $data[] = array('upload_data' => $this->upload->data());                       
		                        $storeb_image = $i == 0 ? $this->upload->data('file_name') : $storeb_image.",".$this->upload->data('file_name');
		                        
		                }

                 }
            
            }
            
             if($storeb_image){
            	$data_['image'] = $storeb_image;
            }
            



               
         $result = $this->Basketstore->updateHotDeal($basket_store_id,$data_);
         if($result>0)
         {
         	redirect('/Admin_p/EditDeleteProducts','refresh');
         }
            
     }

	}

}

