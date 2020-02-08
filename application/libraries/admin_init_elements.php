<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class admin_init_elements
{
	var $CI;
	
	function __construct()
	{
		date_default_timezone_set('UTC');
		$this->CI=& get_instance();
	}
	
	function init_head()
	{
		$this->CI->data['head']=$this->CI->load->view('vendor/elements/head','',true);
	}
	
	function init_header()
	{
		$this->CI->data['header']=$this->CI->load->view('vendor/elements/header','',true);
	}
	
	function init_side_menu()
	{
		$this->CI->data['sideMenu']=$this->CI->load->view('vendor/elements/side-menu','',true);
	}
	
	function init_footer()
	{
		$this->CI->data['footer']=$this->CI->load->view('vendor/elements/footer','',true);
	}
	
	function init_right_menu()
	{
		$this->CI->data['rightMenu']=$this->CI->load->view('vendor/elements/right-menu','',true);
	}
	
	function check_login()
	{
		$admin=$this->CI->session->userdata('admin');
		//$lock=$this->CI->session->userdata('lock');
		
		if(!isset($admin['isloggedin']) && $admin['isloggedon']!=1)
		{
			redirect('/vendor/administrator/login');
		}//else if($lock['islock']==1 && $admin['isloggedin']==1)
		//{
			//redirect('/index.php/admin/lock/'.$lock['controller'].'/'.$lock['method']);
		//}
	}
	
	function check_previlage()
	{
		$admin=$this->CI->session->userdata('admin');
		$controller=$this->CI->uri->segment(2);
		if($admin['adminDetails']['type']!="SA")
		{
			if($admin['previlage'][$controller]!=1)
			{
				$this->CI->session->set_flashdata("error_message",'You are not authorized for this section.Please try other section.');
				redirect('index.php/vendor/home');
			}
		}
	}
	
	
	
	function init_elements()
	{
		$this->check_login();
		//$this->check_previlage();
		$this->init_head();
		$this->init_header();
		$this->init_side_menu();
		$this->init_footer();
		$this->init_right_menu();
	}

}
?>
