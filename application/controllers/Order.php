<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

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
    	$this->load->model(array('basket','events','addons','cards','OrderModel','OrderAddons','User_model','Basketstore','BasketStoreOrderModel'));
    }

    public function uploadRecordedAudio()
    {
    	if(!is_dir("resources/recordings")){
				$res = mkdir("recordings",0777); 
			}

// pull the raw binary data from the POST array

			$extention = explode(",",$_POST['data']);

			$extention = $extention[0];
			preg_match('~/(.*?);~', $extention, $finalext);
			$audioFileExtention = $finalext[1];

			if($audioFileExtention == 'mp3' || $audioFileExtention == 'mpeg' || $audioFileExtention == 'x-m4a' || $audioFileExtention == 'wav' || $audioFileExtention == 'aac')
			{
				$data = substr($_POST['data'], strpos($_POST['data'], ",") + 1);

				// decode it
				$decodedData = base64_decode($data);

				
				// // print out the raw data, 
				// //echo ($decodedData);
				$filename = 'audio_recording_' . date( 'Y-m-d-H-i-s' ) .'.mp3';


				// write the data out to the file
				$fp = fopen('resources/recordings/'.$filename, 'wb');

				
				fwrite($fp, $decodedData);
				fclose($fp);

				$data = array( 'status' => 1,'msg' => 'Successfully Uploaded','filename' => $filename);
				echo json_encode($data);
			}
			else
			{
				$data = array( 'status' => 0,'msg' => 'Not an audio file','audioFileExtention' => $audioFileExtention);
				echo json_encode($data);
			}

			
    }

	public function index()
	{
		$data['data'] =  $this->session->userdata('user_logged_in');
		$this->load->view('Header',$data);
		$this->load->view('Booking');
		$this->load->view('Footer');
		
	}
	public function placeOrder()
	{
		$addOns = $this->input->post('addon');
		$receiverid = $this->input->post('receiverid');
		$event = $this->input->post('event');
		$category = $this->input->post('category');
		$card = $this->input->post('card');
		$message = $this->input->post('message');
		$orderdate = $this->input->post('delivery_date');
		$paymentmethod = $this->input->post('paymentmethod');
		$audiomessage  = $this->input->post('audiomessage');

		$isValid = true;
		$orderData = array();
		$useremail = "";
		if($category)
		{
		 $orderData['basketID'] = intval($category); ///// Category on Front End Category of Basket
		}else{
			$isValid = false;
		}
		if($event)
		{
			$orderData['eventID'] = intval($event);
		}else{
			$isValid = false;
		}
		if($card)
		{
			$orderData['cardID'] = intval($card);
		}else{
			$isValid = false;
		}
		
		if($orderdate)
		{
			$time = strtotime($orderdate);
			$orderData['delivery_date'] =   date('Y-m-d', $time);
		}else{
			$isValid = false;
		}

		if($paymentmethod)
		{
			$paymenttext  = "";
			if($paymentmethod === '1')
			{
				$paymenttext = "EasyPay";
			}
			else if($paymentmethod === '2'){
				$paymenttext = "Wire Transfer";
			}
			else if($paymentmethod === '3'){
				$paymenttext = "COD";
			}
			if(empty($paymenttext))
			{

				$isValid = false;
			}
			else{
				$orderData['paymentmethod'] = $paymenttext;
			}
		}
		else{
			$isValid = false;
		}
		$customername = '';
		if($this->session->userdata('user_logged_in'))
		{
			$data =  $this->session->userdata('user_logged_in');  /// fetching from current session
			$userid = $data['id'];
			$customername  = $this->User_model->getUserName($userid);
			$orderData['userID'] = $userid; 

			$result = $this->User_model->getUserEmail($userid);
			$useremail = 	$result['email'];
		}else{
			$isValid = false;
		}

		if($message)
		{
			$orderData['message'] = $message;
		}else{
			$orderData['message'] = "";
		}
		$orderData['receiverID'] = $receiverid;

		$orderData['vMessageURL'] = $audiomessage;

		$orderData['status'] = "Pending";
		if($isValid)
		{
			$basketname = $this->basket->getBasketName($category);



			$customerOrderid = $this->generateRandomString(6);
			$orderData['customerorderid'] = $customerOrderid;

			$subtotal = 0;

			for($i=0;$i<count($addOns);$i++)
			{

				
				$result = $this->addons->getAddonNameAndPrice($addOns[$i]['id']);
				$quantity = intval($addOns[$i]['quantity']);
				$addonPrice = ceil($result['addon_price'] - ($result['addon_price']*($result['discount']/100)));
				$subtotal = ($addonPrice*$quantity) + $subtotal;
			}
			$voicemessageprice = 0;
			if(!empty($audiomessage))
			{
				$voicemessageprice = 400;
			}
				$total = $subtotal + $basketname['basket_price'] + $voicemessageprice;

				$orderData['finalPrice'] = $total;

				if($total > 1500)
				{
							$orderid = 	$this->OrderModel->addOrder($orderData);

							if($orderid>0)
							{

								$addondata = array();
								$dom = new DOMDocument('1.0');
								$ul = $dom->createElement('ul');
								$dom->appendChild($ul);
								$domsecond = new DOMDocument('1.0');
								$ull = $domsecond->createElement('ul');
								$domsecond->appendChild($ull);
								for($i=0;$i<count($addOns);$i++)
								{
									$addon = array();
									
									$addon['orderid'] = $orderid;

									$addon['addonid'] = intval($addOns[$i]['id']);
									$result = $this->addons->getAddonNameAndPrice($addOns[$i]['id']);

									$addon['quantity'] = intval($addOns[$i]['quantity']);
									array_push($addondata, $addon);
									
									$li = $dom->createElement('li', $result['addon_name'].' x '.$addOns[$i]['quantity']);
									$ul->appendChild($li);

									$addonPrice = ceil($result['addon_price'] - ($result['addon_price']*($result['discount']/100)));

									$lii = $domsecond->createElement('li', $addonPrice.' x '.$addOns[$i]['quantity']);
									$ull->appendChild($lii);
								}
								$dom->appendChild($ul);
								$domsecond->appendChild($ull);

								$addons = $dom->savehtml();
								$addonsprice = $domsecond->savehtml();
								$bccrecipients = array('baskets@emoey.com',
								   'dreambaskets00@gmail.com','bushrafalvi@gmail.com','faisalalvi00@gmail.com','maverick.guy93@gmail.com');
								if(count($addondata)>0)
								{

									$result = $this->OrderAddons->addOrderAddons($addondata);
									if($result>0)
									{
										$this->load->library('email');
										$config['protocol'] = "smtp";
										$config['smtp_host'] = "ssl://mail.emoey.com";
										$config['smtp_port'] = "465";
										$config['smtp_user'] = 'order@emoey.com'; 
										$config['smtp_pass'] = "emoey293";
										$config['charset'] = "utf-8";
										$config['mailtype'] = "html";
										$config['newline'] = "\r\n";

										

								$this->email->initialize($config);
								$this->email->from('order@emoey.com', 'Emoey Order');
								$this->email->to($useremail);
								$this->email->reply_to('order@emoey.com', 'Emoey');
								$this->email->bcc($bccrecipients);
								$this->email->subject('Emoey Order');
								//$this->email->message('To reset new password of Flashagram account '.$new_pwd.'.');
								$data['orderid'] = $customerOrderid;

								$sendmessage  = file_get_contents('resources/orderEmail.php'); 
								$sendmessage = str_replace('%orderid%',$customerOrderid, $sendmessage);
								$sendmessage = str_replace('%basketname%',$basketname['basket_size'], $sendmessage);
								$sendmessage = str_replace('%addons%',$addons , $sendmessage);
								$sendmessage = str_replace('%AddOnTitle%','Addons' , $sendmessage);
								$sendmessage = str_replace('%price%',$addonsprice , $sendmessage);
								$sendmessage = str_replace('%basketprice%',$basketname['basket_price'] , $sendmessage);
								$sendmessage = str_replace('%subtotal%',$subtotal , $sendmessage);
								$sendmessage = str_replace('%voiceprice%', $voicemessageprice, $sendmessage);
								$sendmessage = str_replace('%total%',$total , $sendmessage);
								$sendmessage = str_replace('%duedate%',$orderdate , $sendmessage);

								$sendmessage = str_replace('%customername%',$customername['firstname'].' '.$customername['lastname'], $sendmessage);


							     $this->email->message($sendmessage);

								  $result =$this->email->send();

										$response = array('status' => 200,'msg'=>'Success','orderid'=>$customerOrderid);
										echo json_encode($response);
									}
									else
									{
										$result = $this->OrderModel->deleteOrder($orderid);
										$response = array('status' => 1,'msg'=>'Some problem occured, kindly retry.');
										echo json_encode($response);
									}
								}
								else
								{

										$this->load->library('email');
											$config['protocol'] = "smtp";
											$config['smtp_host'] = "ssl://mail.emoey.com";
											$config['smtp_port'] = "465";
											$config['smtp_user'] = 'order@emoey.com'; 
											$config['smtp_pass'] = "emoey293";
											$config['charset'] = "utf-8";
											$config['mailtype'] = "html";
											$config['newline'] = "\r\n";

									$this->email->initialize($config);
									$this->email->from('order@emoey.com', 'Emoey Order');
									$this->email->to($useremail);
									$this->email->reply_to('order@emoey.com', 'Emoey');
									$this->email->bcc($bccrecipients);
									$this->email->subject('Emoey Order');
									//$this->email->message('To reset new password of Flashagram account '.$new_pwd.'.');
									$sendmessage  = file_get_contents('resources/orderEmail.php'); 
									$sendmessage = str_replace('%orderid%',$customerOrderid, $sendmessage);
									$sendmessage = str_replace('%basketname%',$basketname['basket_size'] , $sendmessage);
									$sendmessage = str_replace('%addons%','No Addons' , $sendmessage);
									$sendmessage = str_replace('%AddOnTitle%','Addons' , $sendmessage);
									$sendmessage = str_replace('%price%','No Price available' , $sendmessage);
									$sendmessage = str_replace('%basketprice%',$basketname['basket_price'] , $sendmessage);
									$sendmessage = str_replace('%subtotal%',$subtotal , $sendmessage);
									$sendmessage = str_replace('%total%',$total , $sendmessage);
									$sendmessage = str_replace('%voiceprice%', $voicemessageprice, $sendmessage);
									$sendmessage = str_replace('%duedate%',$orderdate , $sendmessage);

									$sendmessage = str_replace('%customername%',$customername['firstname'].' '.$customername['lastname'] , $sendmessage);

									$this->email->message($sendmessage);

									 $result =$this->email->send();
									$response = array('status' => 200,'msg'=>'Success','orderid'=>$customerOrderid);
									echo json_encode($response);
								}
							}
							else
							{
								$response = array('status' => 1,'msg'=>'Some problem occured, kindly retry.');
								echo json_encode($response);
							}
						}
					else
					{
							$response = array('status' => 0,'msg'=>'Minimum order price is 1500.');
							echo json_encode($response);				
					}
				}
				else
				{
						$response = array('status' => 1,'msg'=>'Some problem occured, kindly retry.');
						echo json_encode($response);
				}
	}
	public function placeBasketStoreOrder()
	{
		$basketStoreid = $this->input->post('basket_store_id');

		$orderdate = $this->input->post('delivery_date');
		$receiverid = $this->input->post('receiverid');
		$paymentmethod = $this->input->post('paymentmethod');
		$message = $this->input->post('message');
		$isValid = true;
		$orderData = array();
		$useremail = "";


		
		if($basketStoreid)
		{
			$orderData['basket_store_id'] = $basketStoreid;
		}else{
			$isValid = false;
		}
		if($orderdate)
		{
			$time = strtotime($orderdate);
			$orderData['delivery_date'] =  date('Y-m-d', $time);
		}else{
			$isValid = false;
		}

		$orderData['message'] = $message;
		$customername = '';
		if($this->session->userdata('user_logged_in'))
		{
			$data =  $this->session->userdata('user_logged_in');  /// fetching from current session
			$userid = $data['id'];
			$customername  = $this->User_model->getUserName($userid);
			$orderData['userID'] = $userid; 

			$result = $this->User_model->getUserEmail($userid);
			$useremail = 	$result['email'];
		}else{
			$isValid = false;
		}

		if($paymentmethod)
		{
			$paymenttext  = "";
			if($paymentmethod === '1')
			{
				$paymenttext = "EasyPay";
			}
			else if($paymentmethod === '2'){
				$paymenttext = "Wire Transfer";
			}
			else if($paymentmethod === '3'){
				$paymenttext = "COD";
			}
			if(empty($paymenttext))
			{

				$isValid = false;
			}
			else{
				$orderData['paymentmethod'] = $paymenttext;
			}
		}
		else{
			$isValid = false;
		}


		$orderData['receiverID'] = $receiverid;

		$orderData['status'] = "Pending";
		if($isValid)
		{
			$basketstoredata = $this->Basketstore->getBasketById($basketStoreid);



			$customerOrderid = $this->generateRandomString(6);
			$orderData['customerorderid'] = $customerOrderid;
			$orderData['viewed'] = 0;

			$orderid = 	$this->BasketStoreOrderModel->addBasketOrder($orderData);
			if($orderid>0)
			{

				$total = $basketstoredata['price'];
				$bccrecipients = array('baskets@emoey.com',
								   'dreambaskets00@gmail.com','bushrafalvi@gmail.com','faisalalvi00@gmail.com','maverick.guy93@gmail.com');
					$this->load->library('email');
						$config['protocol'] = "smtp";
						$config['smtp_host'] = "ssl://mail.emoey.com";
						$config['smtp_port'] = "465";
						$config['smtp_user'] = 'order@emoey.com'; 
						$config['smtp_pass'] = "emoey293";
						$config['charset'] = "utf-8";
						$config['mailtype'] = "html";
						$config['newline'] = "\r\n";

				$this->email->initialize($config);
				$this->email->from('order@emoey.com', 'Emoey Order');
				$this->email->to($useremail);
				$this->email->reply_to('order@emoey.com', 'Emoey');
				$this->email->bcc($bccrecipients);
				$this->email->subject('Emoey Order id '.$customerOrderid);
				//$this->email->message('To reset new password of Flashagram account '.$new_pwd.'.');
				$sendmessage  = file_get_contents('resources/orderEmail.php'); 
				$sendmessage = str_replace('%orderid%',$customerOrderid, $sendmessage);
				$sendmessage = str_replace('%basketname%',$basketstoredata['name'] , $sendmessage);
				$sendmessage = str_replace('%AddOnTitle%','Description' , $sendmessage);
				$sendmessage = str_replace('%addons%',$basketstoredata['description'] , $sendmessage);
				$sendmessage = str_replace('%price%',$basketstoredata['price'] , $sendmessage);
				$sendmessage = str_replace('%basketprice%','0' , $sendmessage);
				$sendmessage = str_replace('%subtotal%',$total, $sendmessage);
				$sendmessage = str_replace('%total%',$total , $sendmessage);
				$sendmessage = str_replace('%duedate%',$orderdate , $sendmessage);
				$sendmessage = str_replace('%voiceprice%','0', $sendmessage);

				$sendmessage = str_replace('%customername%',$customername['firstname'].' '.$customername['lastname'] , $sendmessage);

				$this->email->message($sendmessage);

				$result =$this->email->send();

				$response = array('status' => 200,'msg'=>'Success','orderid'=>$customerOrderid);
				echo json_encode($response);
				

			}
			else{
				$result = $this->BasketStoreOrderModel->deleteOrder($orderid);
				$response = array('status' => 1,'msg'=>'Something went wrong kindly try again.');
				echo json_encode($response);
			}
		}
		else{
			$response = array('status' => 1,'msg'=>'Data is not valid something is missing.');
				echo json_encode($response);
		}


	}
	public  function sendemail()
	{
			$this->load->library('email');
						$config['protocol'] = "smtp";
						$config['smtp_host'] = "ssl://mail.emoey.com";
						$config['smtp_port'] = "465";
						$config['smtp_user'] = 'order@emoey.com'; 
						$config['smtp_pass'] = "emoey293";
						$config['charset'] = "iso-8859-1";
						$config['wordwrap'] = TRUE; 
						$config['mailtype'] = "html";
						$config['newline'] = "\r\n";

				$this->email->initialize($config);
				$this->email->from('order@emoey.com', 'Emoey Order');
				$this->email->to('maverick.guy93@gmail.com');
				$this->email->reply_to('order@emoey.com', 'Emoey');
				
				$this->email->subject('Emoey Order');
				//$this->email->message('To reset new password of Flashagram account '.$new_pwd.'.');
				//$sendmessage  = file_get_contents('resources/orderEmail.html'); 
				//$sendmessage = str_replace('%orderid%','123456', $sendmessage);

				$htmlinvoice = '  <tr class="heading">
							                <td>
							                    Item
							                </td>
							                
							                <td>
							                    Price
							                </td>
							            </tr>
							            
							            <tr class="item">
							                <td>
							                    Website design
							                </td>
							                
							                <td>
							                    $300.00
							                </td>
							            </tr>
							            
							            <tr class="item">
							                <td>
							                    Hosting (3 months)
							                </td>
							                
							                <td>
							                    $75.00
							                </td>
							            </tr>
							            
							            <tr class="item last">
							                <td>
							                    Domain name (1 year)
							                </td>
							                
							                <td>
							                    $10.00
							                </td>
							            </tr>
							            
							            <tr class="total">
							                <td></td>
							                
							                <td>
							                   Total: $385.00
							                </td>
							            </tr>';

				$htmlContent = '

							    <style>
							    .invoice-box{
							        max-width:800px;
							        margin:auto;
							        padding:30px;
							        border:1px solid #eee;
							        box-shadow:0 0 10px rgba(0, 0, 0, .15);
							        font-size:16px;
							        line-height:24px;
							        font-family:\'Helvetica Neue\', \'Helvetica\', Helvetica, Arial, sans-serif;
							        color:#555;
							    }
							    
							    .invoice-box table{
							        width:100%;
							        line-height:inherit;
							        text-align:left;
							    }
							    
							    .invoice-box table td{
							        padding:5px;
							        vertical-align:top;
							    }
							    
							    .invoice-box table tr td:nth-child(2){
							        text-align:right;
							    }
							    
							    .invoice-box table tr.top table td{
							        padding-bottom:20px;
							    }
							    
							    .invoice-box table tr.top table td.title{
							        font-size:45px;
							        line-height:45px;
							        color:#333;
							    }
							    
							    .invoice-box table tr.information table td{
							        padding-bottom:40px;
							    }
							    
							    .invoice-box table tr.heading td{
							        background:#eee;
							        border-bottom:1px solid #ddd;
							        font-weight:bold;
							    }
							    
							    .invoice-box table tr.details td{
							        padding-bottom:20px;
							    }
							    
							    .invoice-box table tr.item td{
							        border-bottom:1px solid #eee;
							    }
							    
							    .invoice-box table tr.item.last td{
							        border-bottom:none;
							    }
							    
							    .invoice-box table tr.total td:nth-child(2){
							        border-top:2px solid #eee;
							        font-weight:bold;
							    }
							    
							    @media only screen and (max-width: 600px) {
							        .invoice-box table tr.top table td{
							            width:100%;
							            display:block;
							            text-align:center;
							        }
							        
							        .invoice-box table tr.information table td{
							            width:100%;
							            display:block;
							            text-align:center;
							        }
							    }
							    </style>
					
							    <div class="invoice-box">
							        <table cellpadding="0" cellspacing="0">
							            <tr class="top">
							                <td colspan="2">
							                    <table>
							                        <tr>
							                            <td class="title">
							                                <img src="http://emoey.southeastasia.cloudapp.azure.com/assets/img/logo.png" style="width:100%; max-width:300px;">
							                            </td>
							                            
							                            <td>
							                                Order id #: '+'hahahah'+'<br>
							                            </td>
							                        </tr>
							                    </table>
							                </td>
							            </tr>
							            
							            <tr class="information">
							                <td colspan="2">
							                    <table>
							                        <tr>
							                            <td>
							                                Next Step Webs, Inc.<br>
							                                12345 Sunny Road<br>
							                                Sunnyville, TX 12345
							                            </td>
							                            
							                            <td>
							                                Emoey<br>
							                                Bilal Javed<br>
							                                bilal.javed@emoey.com
							                            </td>
							                        </tr>
							                    </table>
							                </td>
							            </tr>
							            
							            <tr class="heading">
							                <td>
							                    Payment Method
							                </td>
							                
							                <td>
							                    Details
							                </td>
							            </tr>
							            
							            <tr class="details">
							                <td>
							                    Bank Account Details 
							                </td>
							                
							                <td>
							                    
							                </td>
							            </tr>
							             <tr class="details">
							                <td>
							                    Easy Paisa 
							                </td>
							                
							                <td>
							                    
							                </td>
							            </tr>
							            
							             '+$htmlinvoice+'
							        </table>
							    </div> ';

							    $htmlContent = 'This is an <b>HTML</b> email';

				$this->email->message($htmlContent);

				 $result =$this->email->send();

				 if($result)
				 {
				 	return 1;
				 }
				 else{
				 	return 0;
				 }
				 return 0;
	}

	private static function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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


	 function checkDOM()
	{
		$dom = new DOMDocument('1.0');
					$ul = $dom->createElement('ul');
					$dom->appendChild($ul);
					$li = $dom->createElement('li', 'hello');
						$ul->appendChild($li);
						$dom->appendChild($ul);
						$result = $dom->savehtml();
						print_r($result) ;
	}

	public function getAllOrders()
	{
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
		{
				$orderresult = $this->OrderModel->getDashboardOrders(100,0,'Pending');
				for($i=0;$i<count($orderresult);$i++)
				{
					$orderaddons = $this->OrderAddons->getAddonsforOrder($orderresult[$i]['orderID']);
					$data = array();
					for($j=0;$j<count($orderaddons);$j++)
					{
						$addoninfo = $this->addons->getSpecificAddon($orderaddons[$j]['addonid']);
						$addondata =  array();
						$addondata['quantity'] = $orderaddons[$j]['quantity'];
						$addondata['addon_name'] = $addoninfo['addon_name'];

						$addondata['addon_price'] = ceil($addoninfo['addon_price'] - ($addoninfo['addon_price']*($addoninfo['discount']/100)));
						array_push($data,$addondata);
					}

					$orderresult[$i]['addons'] = $data;

				}
				//print_r($orderresult);
				
				echo json_encode($orderresult);
		}
		else{
			echo json_encode("What?");
		}
	}
    public function getAllOrdersProcessed()
	{
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
		{
				$orderresult = $this->OrderModel->getDashboardOrders(100,0,'Processed');
				for($i=0;$i<count($orderresult);$i++)
				{
					$orderaddons = $this->OrderAddons->getAddonsforOrder($orderresult[$i]['orderID']);
					$data = array();
					for($j=0;$j<count($orderaddons);$j++)
					{
						$addoninfo = $this->addons->getSpecificAddon($orderaddons[$j]['addonid']);
						$addondata =  array();
						$addondata['quantity'] = $orderaddons[$j]['quantity'];
						$addondata['addon_name'] = $addoninfo['addon_name'];

						$addondata['addon_price'] = ceil($addoninfo['addon_price'] - ($addoninfo['addon_price']*($addoninfo['discount']/100)));
						array_push($data,$addondata);
					}
					$orderresult[$i]['addons'] = $data;
				}
				echo json_encode($orderresult);
		}
		else{
			echo json_encode("What?");
		}
	}

public function processOrder()
{
	if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
	{
		$orderid = $this->input->post('orderid');

		$status = array('status'=>'Processed');
		$result = $this->OrderModel->processOrder($status,$orderid);
		if($result>0)
		{
			echo json_encode(200);
		}else{
			echo json_encode(400);
		}

	}
	else{
			echo json_encode("What?");
	}
}
public function processOrderBasketStore()
{
	if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
	{
		$orderid = $this->input->post('orderid');

		$status = array('status'=>'Processed');
		$result = $this->BasketStoreOrderModel->processOrder($status,$orderid);
		if($result>0)
		{
			echo json_encode(200);
		}else{
			echo json_encode(400);
		}

	}
	else{
			echo json_encode("What?");
	}
}
public function getAllBasketStoreOrders()
	{
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
		{
				$orderresult = $this->BasketStoreOrderModel->getDashboardOrders(100,0,'Pending');
				//print_r($orderresult);
				
				echo json_encode($orderresult);
		}
		else{
			echo json_encode("What?");
		}
	}

	public function getAllBasketStoreOrders_Processed()
	{
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
		{
				$orderresult = $this->BasketStoreOrderModel->getDashboardOrders(100,0,'Processed');
				//print_r($orderresult);
				
				echo json_encode($orderresult);
		}
		else{
			echo json_encode("What?");
		}
	}

	public function getOrdersCount()
	{
		if($this->session->userdata('admin_logged_in') || $this->session->userdata('dreambasketadmin_logged_in'))
		{
				$ordercount = $this->OrderModel->getOrdersCount('Pending');
				$basketstoreordercount = $this->BasketStoreOrderModel->getOrdersCount('Pending');
				$result = array('c_orders' => $ordercount,
					'b_orders'=>$basketstoreordercount);
				echo json_encode($result);
		}
		else{
			echo json_encode("What?");
		}
	}

}

