<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','admin_model','addonBrands','addonCategory','basketstore','dreambasketsadmin_model'));
    }

	public function index()
	{
		if(!$this->session->userdata('admin_logged_in'))
		{
			$this->load->view('/admin-views/Head');
			$this->load->view('/admin-views/Admin-login');
	    }
	     else
	     {
		     redirect('/admin/adminPanel','refresh');
	     }
	}

	public function dreamBasketAdmin()
	{
		if(!$this->session->userdata('dreambasketadmin_logged_in'))
		{
			$this->load->view('/admin-views/Head');
			$this->load->view('/admin-views/Dream-login');
	    }
	     else
	     {
		     redirect('/admin/dreamPanel','refresh');
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
	public function dreamBasketlogin()
	{
		
     if(!$this->session->userdata('dreambasketadmin_logged_in'))
		{
			if(isset($_POST['Username']) && isset($_POST['Password']))
			{
				$result = $this->dreambasketsadmin_model->login($_POST['Username'],$_POST['Password']);
				if($result>0)
				{
					 $sess_array = array(
	                    'id' => $result
	                );
	                $this->session->set_userdata('dreambasketadmin_logged_in', $sess_array);
					redirect('/admin/dreamPanel','refresh');
				}
				else{
					redirect('/admin/dreamBasketAdmin','refresh');
				}
			}
			else
			{
				redirect('/admin/dreamBasketAdmin','refresh');
			}
		}
		else{
			redirect('/admin/dreamPanel','refresh');
		}
	}
	public function adminPanel()
	{
		if($this->session->userdata('admin_logged_in'))
		{
			$this->load->view('/admin-views/Adminheader');
			$this->load->view('/admin-views/Mainview');
			$this->load->view('Footer');
		}
	}
	public function dreamPanel()
	{
		if($this->session->userdata('dreambasketadmin_logged_in'))
		{
			$this->load->view('/admin-views/Dreamheader');
			$this->load->view('/admin-views/DreamView');
			$this->load->view('/admin-views/Dreamfooter');
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
	public function getAddons()
	{
		if($this->session->userdata('admin_logged_in'))
		{

		$result = $this->addons->getAllAddons();
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
          $eventnamelower = strtolower($event_name);
		  $evenurl = $this->clean($eventnamelower);

         $data_['name'] = $event_name;
         $data_['eventurl'] = $evenurl;

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
            		$card_category = trim($selectedEvents[$i]);
            	}else{
            		$card_category =$card_category.",".trim($selectedEvents[$i]);
            	}
            }

		$hotdealname = $this->input->post('basketstorename');

		$hotdealtags = $this->input->post('basketstoretags');

		$hotdealnamelower = strtolower($hotdealname);
		$hotdealurl = $this->clean($hotdealnamelower);
		$hotdealurl = $hotdealurl.'_'.$this->genratePrimaryKey(2);

         $data_['name'] = $hotdealname;
         $data_['description'] = $this->input->post('basketstore_desc');
         $data_['price'] = $this->input->post('basketstore_price');
         $data_['dealcategory'] = $card_category;
         $data_['items'] = $items;
         $data_['hotdealurl'] = $hotdealurl;
         $data_['tags'] = $hotdealtags;
         $storeb_image = "";
          $filesCount = count($_FILES['store_images']['name']);
	        for($i = 0; $i < $filesCount; $i++){
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

         $data_['image'] = $storeb_image; 
               
         $result = $this->basketstore->addBasket($data_);
         if($result>0)
         {
         	redirect('/admin/adminPanel','refresh');
         }
	}

	function clean($string) {
   			$string = str_replace(' ', '_', $string); // Replaces all spaces with hyphens.
   			return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}


	private static function genratePrimaryKey($serverid)
	{
		$primarykey=$serverid.time();
		if($primarykey>9223372036854775807) //max of 64 bit int
		{
			genratePrimaryKey($serverid);
		}
	return $primarykey;
	}
	
	function logout()
    {
    	if($this->session->userdata('admin_logged_in'))
    	{
    		$this->session->unset_userdata('admin_logged_in');
    	} 
    	else if($this->session->userdata('dreambasketadmin_logged_in'))
    	{
    		$this->session->unset_userdata('admin_logged_in');
    	}
        session_destroy();
        redirect('/welcome', 'refresh');
    }

}

