<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userController extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','user_model','OrderModel','FriendListModel','BasketStoreOrderModel'));

    }

	public function index()
	{
		
		
	}
	public function isUserLoggedIn()
	{
		if($this->session->userdata('user_logged_in'))
		{
			$session = $this->session->userdata('user_logged_in');
			$user = $this->user_model->getUserdetails($session['id']);
			if(is_null($user['address']) || $user['address']==' ' || empty($user['address']))
			{
				echo 1;
			}else{
				echo 2;
			}
		}else{
			echo 0;
		}
	}

		public function login()
		{
			
		if(!$this->session->userdata('user_logged_in'))
		{
			if(isset($_POST['Username']) && isset($_POST['Password']))
			{
				$result = $this->user_model->login($_POST['Username'],$_POST['Password']);
				
				if($result['userID']>0)
				{

					 $sess_array = array(
	                    'id' => $result['userID'],
	                    'name' => $result['firstname']
	                );
	                	$this->session->set_userdata('user_logged_in', $sess_array);
					 $sess_array = array(
	                    'id' => 1,
	                    'name' => $result['firstname']

	                );
					
					echo json_encode($sess_array);
				}else{
					 $sess_array = array(
	                    'id' => 0
	                );
					
					echo json_encode($sess_array);
				}
			}
			else
			{
				 $sess_array = array(
	                    'id' => 2
	                );
					
					echo json_encode($sess_array);
			}
		}else{ 
				$this->session->unset_userdata('user_logged_in');
        		session_destroy();
					
				 $sess_array = array(
	                    'id' => 3,

	                );
					
					echo json_encode($sess_array);
		}
	}

	public function signup()
	{
		
		
			if($this->validate_register_data()==true)
			{
					$firstname = $this->input->post('firstname');

					$email  =  $this->input->post('email');

					$isemailexist = $this->user_model->isEmailExists($email);
					if($isemailexist == false)
					{
								$datacc = array(
				               'email' => $email,
				               'password' =>MD5($this->input->post('password')),
							   'firstname' => $firstname,
							   'lastname' => $this->input->post('lastname'),
							   	'address' => $this->input->post('address'),
								 'city' => $this->input->post('city'),
								 'phone_number' => $this->input->post('mobile'),
								 'isuser' => 1,
								 'is_active' => 0,
								 'reset_code' => "",
								 'delete_state' => 0
				           					   );
						$result = $this->user_model->registerUser($datacc);
						
						//set default units entry
						if($result>0)
						{
							$datacc = array(
						 	'id' => $result,
			    				'name' => $firstname
						 );
						$this->session->set_userdata('user_logged_in', $datacc);
						echo json_encode($datacc);
						}
						else{
								$datacc = array(
						 				'id' => 0,
			    						'msg' => 'Invalid Data'
						 );
									echo json_encode($datacc);
							}
					}
					else {
									
								$datacc = array(
						 				'id' => 0,
			    						'msg' => 'Email Address already exist!'
						 				);
									echo json_encode($datacc);		
					}
				
				}
				else {
						
								$datacc = array(
						 				'id' => 0,
			    						'msg' => 'Data Validation Error.'
						 		);
									echo json_encode($datacc);	

				}
	}
	public function signup_popup()
	{
		
		if($this->input->post('submit'))
		{
			if($this->validate_register_data()==true)
			{
					$firstname = $this->input->post('firstname');
					   $datacc = array(
		               'email' => $this->input->post('email'),
		               'password' =>MD5($this->input->post('password')),
					   'firstname' => $firstname,
					   'lastname' => $this->input->post('lastname'),
					   	'address' => $this->input->post('address'),
						 'city' => $this->input->post('city'),
						 'phone_number' => $this->input->post('mobile'),
						 'is_active' => 0,
						 'reset_code' => "",
						 'delete_state' => 0
		           					   );
				$result = $this->user_model->registerUser($datacc);
				
				//set default units entry
				if($result>0)
				{
					 $datacc = array(
				 	'id' => $result,
	    			'name' => $firstname
				 );
				$this->session->set_userdata('user_logged_in', $datacc);
				echo json_encode($datacc);
				}else{
					 $sess_array = array(
	                    'id' => 0,
	                    'msg' => 'Invalid data'
	                );
					echo json_encode($sess_array);
					}
				}
				else {
					 $sess_array = array(
	                    'id' => 0,
	                    'msg' => 'Fields validation error.'
	                );
					
					echo json_encode($sess_array);
				}
		}
	}
	public function account()
	{
		
		if($this->session->userdata('user_logged_in'))
		{
			$data['data'] =  $this->session->userdata('user_logged_in');
			$id = $data['data']['id'];
			$result['data']  = array();
			$result['data'][0] = $this->user_model->getUserdetails($id);
			$count = $this->OrderModel->getUserOrdersCount($id);
			$countstore = $this->BasketStoreOrderModel->getUserOrdersCount($id);

			$result['data'][1] = $countstore + $count;
			$result['data'][2] = $id;
			$result['data'][3] = $this->user_model->getIfUserIsFacebookUser($id);


			$this->load->view('Header',$data);
			$this->load->view('Profile',$result);
			$this->load->view('Footer');
		}else{


		}
		
	}

	public function updateuserprofile()
	{

	if($this->session->userdata('user_logged_in'))
	{
	
	$firstname = $this->input->post('firstname');
	$lastname = $this->input->post('lastname');
	$phoneNumber = $this->input->post('number');
	$address = $this->input->post('address');
	$city = $this->input->post('city');

	
		
	$dataa =  $this->session->userdata('user_logged_in');  /// fetching from current session
	$userid = $dataa['id'];
	$data  = array();
	
	$data['firstname'] = $firstname;
	$data['address'] = $address;
	$data['phone_number'] = $phoneNumber;
	$data['city'] = $city;
	$data['lastname'] = $lastname;
	
	$this->user_model->updateUserContactinfo($userid,$data);
	echo 1;
	
	}else{
		echo 0;
	}

	}

	private function validate_register_data()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger form-error-msg">','</div>');

		$this->form_validation->set_rules('email','Email Id','trim|strip_tags|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]');
		$this->form_validation->set_rules('mobile','Phone Number','trim|strip_tags|required');
		if($this->form_validation->run()==true)
		{
			return true;
		}else
		{
			return false;
		}
	}
	
function check_email($email) {
  if($this->user_model->isEmailExists($email))
  {
       $this->form_validation->set_message('check_email', 'Email ID already exists.');
       return false;
  }
 else 
	 return true;
}
function check_phonenumber($number)
{
	 if($this->user_model->isNumberExists($number))
  {
       $this->form_validation->set_message('check_phonenumber', 'Number already exists.');
       return false;
  }
 else 
	 return true;
}
	function fetchUserContacts()
	{
		if($this->session->userdata('user_logged_in'))
		{
		$data =  $this->session->userdata('user_logged_in');  /// fetching from current session
		$userid = $data['id'];

		$contacts = $this->FriendListModel->fetchUserFriends($userid);

		echo json_encode($contacts);
		}
	}

function contactinfo()
{
	if($this->session->userdata('user_logged_in'))
	{
		$address = $this->input->post('address_sender');
		$city = $this->input->post('city_sender');
		$mobile = $this->input->post('mobile_sender');
		$data = array('address'=>$address,'city'=>$city,'phone_number'=>$mobile);

		$session = $this->session->userdata('user_logged_in');

		$this->user_model->updateUserContactinfo($session['id'],$data);

		echo json_encode("Success");
	}
	else
	{
		echo json_encode("User is not loggedin");
	}
}
function insertReceiver()
{

	if($this->session->userdata('user_logged_in'))
	{
	
	$name = $this->input->post('name');
	$phoneNumber = $this->input->post('number');
	$address = $this->input->post('address');
	$city = $this->input->post('city');

	$email = $this->input->post('email');
		
	$dataa =  $this->session->userdata('user_logged_in');  /// fetching from current session
	$userid = $dataa['id'];
	$data  = array();
	
	$data['firstname'] = $name;
	$data['address'] = $address;
	$data['phone_number'] = $phoneNumber;
	$data['city'] = $city;
	if($email)
	{
		$data['email'] = $email;
	}
	else{
		$data['email'] = $this->genratePrimaryKey('40');
	}

	$data['is_active'] = 0;

	$data['password'] = MD5('123456');

	$data['lastname'] = ' ';




	
	$receiverid = $this->user_model->registerUser($data);
	if($receiverid>0)
	{
		$this->FriendListModel->updateFriend($userid,$receiverid);
		echo json_encode($receiverid);
	}
	else{
		echo json_encode("0");
	}

	
	}else{
		echo 0;
	}
}

private static function genratePrimaryKey($serverid)
	{
	$primarykey=$serverid.round(time().mt_rand(10, 99),5);
	$primarykey=round($primarykey/700);

		if($primarykey>9223372036854775807) //max of 64 bit int
		{
			genratePrimaryKey($serverid);
		}
	return $primarykey;
	}

function fetchorders()
{
	$data =  $this->session->userdata('user_logged_in');  /// fetching from current session
	$userid = $data['id'];
	$resultorders = $this->OrderModel->getUserOrder($userid);
	$resultbasketorders = $this->BasketStoreOrderModel->getUserOrder($userid);
	$result = array_merge($resultorders, $resultbasketorders);
	echo json_encode($result);
}

function logout()
{
	  $this->session->unset_userdata('user_logged_in');
        session_destroy();
       redirect("Welcome");
}

function connectwithfacebook()
{

	$dataa =  $this->session->userdata('user_logged_in');  /// fetching from current session
	$userid = $dataa['id'];

	if($this->session->userdata('user_logged_in'))
	{

		foreach ($_COOKIE as $k=>$v) {
    	if(strpos($k, "FBRLH_")!==FALSE) {
     	   $_SESSION[$k]=$v;
    	}
		}
		if(!session_id()) {
   			 session_start();
		}	
		$data['user'] = array();

		
		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			echo "Redirecting...";
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,email,first_name,last_name');

			if (!isset($user['error']))
			{
				
				$data['user'] = $user;

				$userpicture = $this->getrequest('http://graph.facebook.com/'.$user['id'].'/picture?redirect=false&type=large');
				
				$picturedata = json_decode($userpicture);

				$pictureurl = $picturedata->data->url;

				if(!$this->user_model->isFbUserExist($user['id']))
				{

					if($user['email'])
					{
							
							 $datacc = array(
				               'password' =>MD5($user['id']),
							   'firstname' => $user['first_name'],
							   'lastname' => $user['last_name'],
							   	'fbID' => $user['id'],
								 'is_active' => 0,
								 'reset_code' => "",
								 'delete_state' => 0,
								 'profile_pic'=>$pictureurl
				           		);

							
							$this->user_model->updateUserContactinfo($userid,$datacc);
							$userfriends = $this->facebook->request('get','/'.$user['id'].'/friends');
							
	                	 	$this->updateUserFriends($userfriends['data'],$user['id']);
						
						//set default units entry
						if($userid>0)
						{
							
							 $datacc = array(
						 	'id' => $userid,
			    			'name' => $user['first_name']
						 );
						$this->session->set_userdata('user_logged_in', $datacc);

						///$this->user_model->updateUserAccessToken($this->facebook->getUserAccessToken(),$result);
						echo  "<script type='text/javascript'>";
						echo "window.close();";
						echo "</script>";
						
						}
						else{
							echo "You already have an account with this Email <b> ".$user['email']."</b>";
						}
					}else {
						echo "Email permission required";
					}
				}
				
		}
		else{
			//$this->get_app_access_token('209946089451029','543ac39f624d79b859d35ee30f86ab20');

			//$this->fb->setDefaultAccessToken($access_token);
			echo "facebook session destroyed, Kindly Retry";
			$this->facebook->destroy_session();
			echo  "<script type='text/javascript'>";
						echo "window.close();";
						echo "</script>";

		}
	}
	else {
		echo "User authentication failed";
	}
	session_write_close();

	}
	else{
		echo "User not logged in";
	}
	}


function loginfacebook()
{
		foreach ($_COOKIE as $k=>$v) {
    	if(strpos($k, "FBRLH_")!==FALSE) {
     	   $_SESSION[$k]=$v;
    	}
		}
		if(!session_id()) {
   			 session_start();
		}	
		$data['user'] = array();
		// Check if user is logged in
		if ($this->facebook->is_authenticated())
		{
			echo "Redirecting...";
			// User logged in, get user details
			$user = $this->facebook->request('get', '/me?fields=id,email,first_name,last_name');

			if (!isset($user['error']))
			{
				
				$data['user'] = $user;
				

				$userpicture = $this->getrequest('http://graph.facebook.com/'.$user['id'].'/picture?redirect=false&type=large');
				
				$picturedata = json_decode($userpicture);

				$pictureurl = $picturedata->data->url;

				
				if($this->user_model->isFbUserExist($user['id']))
				{
					
					$result = $this->user_model->loginFb($user['id']);
				
				if($result['userID']>0)
				{
					
					 $sess_array = array(
	                    'id' => $result['userID'],
	                    'name' => $result['firstname']
	                );
	                	$this->session->set_userdata('user_logged_in', $sess_array);

	                	//$this->user_model->updateUserAccessToken($this->facebook->getUserAccessToken(),$result['userID']);

	                	 $userfriends = $this->facebook->request('get','/'.$user['id'].'/friends');

	                	

	                	 $this->updateUserFriends($userfriends['data'],$user['id']);

	                	 $datacc = array(
								 'profile_pic'=>$pictureurl,
				           		);
						$this->user_model->updateUserContactinfo($result['userID'],$datacc);

							echo  "<script type='text/javascript'>";
							echo "window.close();";
							echo "</script>";
				}
				else{
					 $sess_array = array(
	                    'id' => 0
	                );
				}
					
				}
				else
				{
					if($user['email'])
						{
							
							 $datacc = array(
				               'email' => $user['email'],
				               'password' =>MD5($user['id']),
							   'firstname' => $user['first_name'],
							   'lastname' => $user['last_name'],
							   	'address' => ' ',
							   	'fbID' => $user['id'],
								 'city' => ' ',
								 'phone_number' => $user['id'],
								 'is_active' => 0,
								 'reset_code' => "",
								 'delete_state' => 0,
								 'profile_pic'=>$pictureurl
				           		);

							
							$result = $this->user_model->registerUser($datacc);
							$userfriends = $this->facebook->request('get','/'.$user['id'].'/friends');
							
	                	 	$this->updateUserFriends($userfriends['data'],$user['id']);
						
						//set default units entry
						if($result>0)
						{
							
							 $datacc = array(
						 	'id' => $result,
			    			'name' => $user['first_name']
						 );
						$this->session->set_userdata('user_logged_in', $datacc);

						///$this->user_model->updateUserAccessToken($this->facebook->getUserAccessToken(),$result);
						echo  "<script type='text/javascript'>";
						echo "window.close();";
						echo "</script>";
						
						}else{
							echo "You already have an account with this Email <b> ".$user['email']."</b>";
						}
					}else {
						echo "Email permission required";
					}
				}
		}
		else{
			//$this->get_app_access_token('209946089451029','543ac39f624d79b859d35ee30f86ab20');

			//$this->fb->setDefaultAccessToken($access_token);
			echo "facebook session destroyed, Kindly Retry";
			$this->facebook->destroy_session();
			echo  "<script type='text/javascript'>";
						echo "window.close();";
						echo "</script>";

		}
	}
	else {
		echo "User authentication failed";
	}
	session_write_close();
	}

	function updateUserFriends($userfriends,$userid)
	{
		$userid = $this->user_model->getFbUserid($userid);

		for($i=0;$i<count($userfriends);$i++)
		{
			if($userfriends[$i]['id'])
			{
				$friendid = $this->user_model->getFbUserid($userfriends[$i]['id']);
				$this->FriendListModel->updateFriend($userid['userID'],$friendid['userID']);
			}
			
		}
	}

	function getrequest($url)
	{
		return file_get_contents($url);
	}



	function forgotPassword()
	{
			$resetEmail = $this->input->post('forgot-password-email');
			$userid = $this->user_model->getUserId($resetEmail);

			if($userid != 0)
			{
				
				$random_password = $this->getToken(20);
				$currenttimestamp = date("Y-m-d H:i:s");
				$updateData=array(
					'forgot_password_timestamp'=> $currenttimestamp,
					'forgot_password'=>$random_password,
				);

				$update = $this->user_model->updateUserContactinfo($userid,$updateData);

				if($update>0)
				{
								$this->load->library('email');
										$config['protocol'] = "smtp";
										$config['smtp_host'] = "ssl://mail.emoey.com";
										$config['smtp_port'] = "465";
										$config['smtp_user'] = 'ask@emoey.com'; 
										$config['smtp_pass'] = "emoey293";
										$config['charset'] = "utf-8";
										$config['mailtype'] = "html";
										$config['newline'] = "\r\n";

								$this->email->initialize($config);
								$this->email->from('ask@emoey.com', 'Reset password');
								$this->email->to($resetEmail);
								$this->email->reply_to('no-reply@emoey.com', 'No Reply');
								$this->email->bcc('ask@emoey.com', 'Emoey');
								$this->email->subject('New password for Emoey login');

								$sendmessage  = file_get_contents('resources/reset-email-template.html');
								$url = BASE_URL.'new_password'.'?expirable_token='.$random_password.'&email='.$resetEmail;
								$sendmessage = str_replace('%newpassword%', $url, $sendmessage); 
								$this->email->message($sendmessage);
								$result =$this->email->send();

								if($result)
								{
										$datacc = array(
						 				'id' => 1,
			    						'msg' => 'Reset password success'
						 				);
									echo json_encode($datacc);	
								}else{
									$datacc = array(
						 				'id' => 0,
			    						'msg' => 'Email not sent.'
						 				);
									echo json_encode($datacc);	
								}
				}

			}else{
				$datacc = array('id' => 0,
				'msg' => 'Invalid Email');
			echo json_encode($datacc);	
			}
	}

public function new_password() 
{
	$bool = true;
	if($this->input->get('expirable_token'))
	{
		$token =  $this->input->get('expirable_token',TRUE);
	}
	else{
		$bool = false;
	}
	
	if($this->input->get('email'))
	{
		$email =  $this->input->get('email',TRUE);
	}
	else{
		$bool = false;
	}
	if($bool)
	{
		$time  = $this->user_model->getTokenTime($email,$token);
		if($time!=0)
		{
			$date = new DateTime($time);
			$now = new DateTime();
			$diff = $now->diff($date);

			if($diff->days < 2) {

				$data['data'] = array('email'=>$email,
					'token'=>$token,
					'isvalid'=>TRUE);
				$this->load->view('/admin-views/Head');
				$this->load->view('NewPassword',$data);

			}
			else{
				$data['data'] = array('isvalid' => FALSE ,'message' => 'Unfortunately your token is expired. Kindly reset your password again.' );
				$this->load->view('/admin-views/Head');
				$this->load->view('NewPassword',$data);
			}
		}else{
				$data['data'] = array('isvalid' => FALSE ,'message' => 'Invalid Request.' );
				$this->load->view('/admin-views/Head');
				$this->load->view('NewPassword',$data);
		}
		
	}
	else{
			$data['data'] = array('isvalid' => FALSE ,'message' => 'Invalid Request.' );
			$this->load->view('/admin-views/Head');
			$this->load->view('NewPassword',$data);
	}
	
}

public function change_password()
{
	if(isset($_POST['submit']))
	{
		$bool = true;
		if($this->input->post('token'))
		{
			$token =  $this->input->post('token',TRUE);
		}
		else{
			$bool = false;
		}
		
		if($this->input->post('email'))
		{
			$email =  $this->input->post('email',TRUE);
		}
		else {
			$bool = false;
		}
		if($this->input->post('password'))
		{
			$password =  $this->input->post('password',TRUE);
		}
		else {
			$bool = false;
		}
		if($this->input->post('confirm-password'))
		{
			$confirm =  $this->input->post('confirm-password',TRUE);
		}
		else {
			$bool = false;
		}

		if($bool)
		{
			if($password == $confirm)
			{
				$time  = $this->user_model->getTokenTime($email,$token);
				if($time!=0)
				{
					$date = new DateTime($time);
					$now = new DateTime();
					$diff = $now->diff($date);

					if($diff->days < 2) {
						$updateData=array(
					'forgot_password_timestamp'=> '1999-10-10 01:02:03',
					'forgot_password'=>'',
					'password'=>MD5($password)
				);
					$userid = $this->user_model->getUserId($email);

					$update = $this->user_model->updateUserContactinfo($userid,$updateData);
					if($update>0)
					{
						$data['data'] = array('isvalid' => FALSE ,'message' => 'Password Successfully Changed.' );
						$this->load->view('/admin-views/Head');
						$this->load->view('NewPassword',$data);
					}
					else{
						$data['data'] = array('isvalid' => FALSE ,'message' => 'Password Successfully Changed.' );
						$this->load->view('/admin-views/Head');
						$this->load->view('NewPassword',$data);
					}

					}
					else{
						$data['data'] = array('isvalid' => FALSE ,'message' => 'Unfortunately your token is expired. Kindly reset your password again.' );
						$this->load->view('/admin-views/Head');
						$this->load->view('NewPassword',$data);
					}
				}
				else
				{
					$data['data'] = array('isvalid' => FALSE ,'message' => 'Invalid request.' );
					$this->load->view('/admin-views/Head');
					$this->load->view('NewPassword',$data);
				}
			}
		}
	}else{
					$data['data'] = array('isvalid' => FALSE ,'message' => 'Invalid submission' );
					$this->load->view('/admin-views/Head');
					$this->load->view('NewPassword',$data);
	}
}

 function crypto_rand_secure($min, $max)
{
    $range = $max - $min;
    if ($range < 1) return $min; // not so random...
    $log = ceil(log($range, 2));
    $bytes = (int) ($log / 8) + 1; // length in bytes
    $bits = (int) $log + 1; // length in bits
    $filter = (int) (1 << $bits) - 1; // set all lower bits to 1
    do {
        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
        $rnd = $rnd & $filter; // discard irrelevant bits
    } while ($rnd > $range);
    return $min + $rnd;
}

function getToken($length)
{
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
    $codeAlphabet.= "0123456789";
    $max = strlen($codeAlphabet); // edited

    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
    }

    return $token;
}


function get_app_access_token($app_id, $secret) {
    $url = 'https://graph.facebook.com/oauth/access_token';
    $token_params = array(
        "type" => "client_cred",
        "client_id" => $app_id,
        "client_secret" => $secret
        );
    return str_replace('access_token=', '', post_url($url, $token_params));
  }

}

