<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DreamBasketAdminController extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','admin_model','addonBrands','addonCategory','basketstore'));
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
			redirect('/admin/adminPanel','refresh');
		}
		
		
	}
	public function login()
	{
		
		if(!$this->session->userdata('admin_logged_in'))
		{
			if(isset($_POST['Username']) && isset($_POST['Password']))
			{
				$result = $this->admin_model->login($_POST['Username'],$_POST['Password']);
				
				if($result>0)
				{
					 $sess_array = array(
	                    'id' => $result
	                );
	                $this->session->set_userdata('admin_logged_in', $sess_array);
					redirect('/admin/adminPanel','refresh');
				}else{
					$this->index();
				}
			}
			else
			{
				redirect('admin','refresh');
			}
		}else{
			redirect('/admin/adminPanel','refresh');

		}
		

	}
	public function adminPanel()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$this->load->view('/admin-views/Adminheader');
			$this->load->view('admin-views/Mainview');
			$this->load->view('Footer');
		}
	}
	public function getCategories()
	{
		if($this->session->userdata('admin_logged_in'))
		{

		$result = $this->events->getEvents();
		echo json_encode($result);
		}
	}

	public function getAddonBrands()
	{
		if($this->session->userdata('admin_logged_in'))
		{

		$result = $this->addonBrands->getAddons_brands();
		echo json_encode($result);
		}
	}
	public function getAddonCategories()
	{
		if($this->session->userdata('admin_logged_in'))
		{

		$result = $this->addonCategory->getAddons_cate();
		echo json_encode($result);
		}
	}
	public function add_Event()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$event_name = $this->input->post('event_name');
			$event_image; 
		       

		   		$config['upload_path']          = './assets/img/events_images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['remove_spaces']		 = 	TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('event_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $this->upload->display_errors();
                       return;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $event_image = $this->upload->data('file_name');

                }
          $date_from = $this->input->post('date_from');
          $date_to = $this->input->post('date_to');
         $data_['name'] = $event_name;
         $data_['image'] = $event_image;
         $data_['date_from'] = $date_from;
         $data_['date_to'] = $date_to;
         $result = $this->events->addEvent($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
		
	    }
		


	}

	function add_Basket()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$basket_name = $this->input->post('basket_name');
				$basket_image;
				$basket_image_detail; 
		   		$config['upload_path']          = './assets/img/basket_sizes/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['remove_spaces']		 = 	TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('basket_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $this->upload->display_errors();
                       return;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $basket_image = $this->upload->data('file_name');

                }
                 if (!$this->upload->do_upload('basket_image_detail'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $this->upload->display_errors();
                       return;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $basket_image_details = $this->upload->data('file_name');
                }
               
             
          $basketdesc = $this->input->post('basket_desc');
          $price = $this->input->post('basket_price');
          $data_ = array();
         $data_['basket_size'] = $basket_name;
         $data_['basket_size_img'] = $basket_image;
         $data_['basket_detail_img'] =  $basket_image_details;
         $data_['basket_detail'] = $basketdesc;
         $data_['basket_price'] = $price;

       
        $result = $this->basket->addBasket($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
		}	
	}
	function add_Card()
	{
			$selectedEvents = $this->input->post('events_select');

			for($i=0;$i<count($selectedEvents);$i++)
            {
            	if($i==0)
            	{
            		$card_category = $selectedEvents[$i];
            	}else{
            		$card_category =$card_category.",".$selectedEvents[$i];
            	}
            }
                    
		


		
				$card_name = $this->input->post('cards_name');
				$card_image; 
		       

		   		$config['upload_path']          = './assets/img/card_images/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['max_size']             = 2048;
                $config['max_width']            = 1024;
                $config['max_height']           = 1024;
                $config['remove_spaces']		 = 	TRUE;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('cards_image'))
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $this->upload->display_errors();
                       return;
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        $card_image = $this->upload->data('file_name');

                }
          $price = $this->input->post('events_price');
          $data_ = array();
          
         $data_['card_name'] = $card_name;
         $data_['card_image'] = $card_image;
         $data_['eventID'] = $card_category;
         $data_['card_price'] = $price;
         $result = $this->cards->addCards($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
	}
	function add_Addon()
	{
		$addon_name = $this->input->post('addon_name');
				$addon_image; 
				       

				   		$config['upload_path']          = './assets/img/addons_images/';
		                $config['allowed_types']        = 'gif|jpg|png|jpeg';
		                $config['max_size']             = 2048;
		                $config['max_width']            = 1024;
		                $config['max_height']           = 1024;
		                $config['remove_spaces']		 = 	TRUE;

		                $this->load->library('upload', $config);

		                if ( ! $this->upload->do_upload('addon_image'))
		                {
		                        $error = array('error' => $this->upload->display_errors());

		                       echo $this->upload->display_errors();
		                       return;
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

		         $data_['addon_name'] = $addon_name;
		         $data_['addon_image'] = $addon_image;
		         $data_['addon_price'] = $price;
		         $data_['description'] = $desc;
		         $data_['addon_catID'] = $addoncateID;
		         $data_['addon_brandID'] = $addonbrandID;
		         $result = $this->addons->addAddons($data_);
		         if($result>0)
		         {
		         	redirect('/admin/adminPanel','refresh');
		         }
	}
	function add_AddonCategory()
	{
		$addon_name = $this->input->post('addon_cate_name');
			
		$data_['addon_cat_title'] = $addon_name;
		       
     $result = $this->addonCategory->addAddonCategory($data_);
     if($result>0)
     {
     	redirect('/admin/adminPanel','refresh');
     }
	}
	function add_AddonBrand()
	{
		$addon_name = $this->input->post('addon_brand_name');
         $data_['addon_brand_title'] = $addon_name;
    
         $result = $this->addonBrands->addAddonsBrand($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
	}
	function add_BasketsStore()
	{
		$addon_name = $this->input->post('basketstorename');
         $data_['name'] = $addon_name;
         $data_['description'] = $this->input->post('basketstore_desc');
         $data_['price'] = $this->input->post('basketstore_price');

         $storeb_image; 
		       

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
                        $data = array('upload_data' => $this->upload->data());
                        $storeb_image = $this->upload->data('file_name');

                }

               $data_['image'] = $storeb_image; 
               
         $result = $this->basketstore->addBasket($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
	}
	function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        session_destroy();
        redirect('/welcome', 'refresh');
    }

}

