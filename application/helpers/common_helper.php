<?php
############################### For Pagination ################################################
	function user_pagination($per_page,$site_url,$total_rows,$uri_segment,$page_segment)
	{
		$db =& get_instance();
		$db->load->library('pagination');
				
		$config['use_page_numbers'] = true; 
		$config['base_url'] = $site_url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = $uri_segment;
		$config['display_pages'] = true;
		$config['num_links'] = 5;
		$config['prev_tag_open']='<li>';
		$config['prev_link'] = '<<';
		$config['prev_tag_close']='</li>';
		$config['next_tag_open']='<li>';
		$config['next_link'] = '>>';
		$config['next_tag_close']='</li>';
		//$config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
		$config['num_tag_open']='<li>';
		$config['num_tag_close']='</li>';
		$config['cur_tag_open']='<li class="active"><span>';
		$config['cur_tag_close']="</span></li>";
		//$config['full_tag_close'] = '</ul>';
				
		$db->pagination->initialize($config);
		 
		if($page_segment != '')
		{
			$offset = $page_segment;
		}
		else
		{
			$offset = 1;
		}
		
		$start = ($per_page * ($offset-1));
		return $start;
	}
#################################################################################################
	function get_offset($page=0,$limit=0)
	{
		if($page<=0)
		{
			return 0;
		}
		$offset=$limit * ($page-1);
		
		return $offset;
	}
########################### For getting language drop down ######################################
	function get_lang_dropdown()
	{
		$ci =& get_instance();
		$result=array();
		$ci->db->from($ci->db->dbprefix('languages'));
		$query=$ci->db->get();
		foreach($query->result() as $row)
		{
			$result[$row->id]=$row->language_name;
		}
		
		return $result;
	}	
################################################################################################

########################### For getting Country drop down ######################################
	function get_country_dropdown()
	{
		$ci =& get_instance();
		$result=array();
		$ci->db->select('countryid,countryname');
		$ci->db->where('isactive',1);
		$ci->db->from($ci->db->dbprefix(COUNTRY));
		$ci->db->order_by('countryname','ASC');
		$query=$ci->db->get();
		$result[0] = "----- Select Country -----";
		if($query->num_rows > 0)
		{
			foreach($query->result() as $row)
			{
				$result[$row->countryid]=ucwords($row->countryname);
			}
		}
		return $result;
	}	
################################################################################################

	function set_image_default($imgPath='')
	{
		if($imgPath=='')
		{
			return base_url().'uploads/images/noImageAvailable.jpg';
		}else
		{
			if(file_exists($imgPath))
			{
				return base_url().$imgPath;
			}else
			{
				return base_url().'uploads/images/noImageAvailable.jpg';
			}
		}
	}

########################### For getting state drop down ######################################
	function get_state_dropdown($countryid=0)
	{
		$ci =& get_instance();
		$result=array();
		if($countryid<=0)
		{
			$result[0]='----- Select Country First -----';
		}else
		{
			
			$ci->db->select('stateid,statename');
			$ci->db->where('countryid',$countryid);
			$ci->db->where('isactive',1);
			$ci->db->from($ci->db->dbprefix(STATE));
			$ci->db->order_by('statename','ASC');
			$query=$ci->db->get();
			$result[0] = "----- Select State -----";
			if($query->num_rows > 0)
			{
				foreach($query->result() as $row)
				{
					$result[$row->stateid]=ucwords($row->statename);
				}
			}
		}	
		
		return $result;
	}	
################################################################################################

########################### For getting City drop down ######################################
	function get_city_dropdown($stateid=0)
	{
		$ci =& get_instance();
		$result=array();
		if($stateid<=0)
		{
			$result[0]='----- Select State First -----';
		}else
		{
			
			$ci->db->select('cityid,cityname');
			$ci->db->where('stateid',$stateid);
			$ci->db->where('isactive',1);
			$ci->db->from($ci->db->dbprefix(CITY));
			$ci->db->order_by('cityname','ASC');
			$query=$ci->db->get();
			$result[0] = "----- Select City -----";
			if($query->num_rows > 0)
			{
				foreach($query->result() as $row)
				{
					$result[$row->cityid]=ucwords($row->cityname);
				}
			}
		}	
		
		return $result;
	}	
################################################################################################

########################### For getting age drop down ######################################
	function get_age_dropdown()
	{
		$result=array();
		
		for($i=16;$i<=60;$i++)
		{
			$result[$i] = $i;
		}
		
		return $result;
	}	
################################################################################################

########################### For getting state name ######################################
	function get_state_name($state_id)
	{
		$ci =& get_instance();
		$result=array();
		$ci->db->from($ci->db->dbprefix('states'));
		$ci->db->select('state_name');
		$ci->db->where('id',$state_id);
		$query=$ci->db->get();
		
		$result = $query->row_array();
		return $result['state_name'];
	}	
################################################################################################

#######################################For Image Is Empty#######################################
	function empty_image($image,$path)
	{
		if($image!="")
		{
			$show_image=$path.$image;
		}else
		{
			$show_image= base_url()."assets/images/noImageAvailable.jpg";
		}
		
		return $show_image;
	}
#################################################################################################

#######################################For Content Is Empty#######################################
	function empty_content($content)
	{
		if($content != "")
		{
			$show_content = $content;
		} 
		else
		{
			$show_content = "Content Not Available";
		}
		
		return $show_content;
	}
#################################################################################################

###################################### Date Formate #############################################
	function change_date_format($original_date='')
	{
		$db =& get_instance();
		if($original_date=='' || $original_date=='0000-00-00 00:00:00')
		{
			return 'N/A';
		}
		$date = new DateTime($original_date);
		return $date->format('F j, Y');
	}
	
##################################################################################################
###################################### Date Time Formate #########################################
	function change_date_time_format($original_date)
	{
		$db =& get_instance();
		$date = new DateTime($original_date);
		return $date->format('F j, Y, g:i a');
	}
	
##################################################################################################
	function split_date_format($original_date)
	{
		if($original_date=='' || $original_date=='0000-00-00 00:00:00')
		{
			return $original_date;
		}
		$split=explode('-',$original_date);
		$new_date=$split[2].'-'.$split[0].'-'.$split[1];
		return $new_date;
	}
##################################################################################################
	function re_split_date_format($original_date)
	{
		$split=explode('-',$original_date);
		$new_date=$split[1].'-'.$split[2].'-'.$split[0];
		return $new_date;
	}	

	function convert_time($original_time)
	{
		$time=strtotime($original_time);
		$convert_time=date("H:i",$time);
		return $convert_time;
	}
###################################### Get Years From Two Date Difference #########################################	

	function years_difference($endDate, $beginDate)
    {
        $date_parts1=explode("-", $beginDate);
   		$date_parts2=explode("-", $endDate);
		$years=$date_parts2[0] - $date_parts1[0];
   		return $years;
	}
	
##################################################################################################
##################################  String Replace      ##########################################
	function strip_html_tags( $text )
	{
		$db =& get_instance();
		$text = preg_replace(
			array(
				// Remove invisible content
				'@<head[^>]*?>.*?</head>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
	
				// Add line breaks before & after blocks
				'@<((br)|(hr))@iu',
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );

		// Remove all remaining tags and comments and return.
		return strip_tags( $text );
	}

##################################################################################################
###########################Sub string Methode  ###################################################
	function sub_str($str_content,$num_of_words_to_show,$symbol_to_more='.',$num_of_symbols=3) 
	{
		$db =& get_instance();
		$subword_output ='';
		$str_arr_num=0;
		$smbl_to_mr = '';
		$str_arr = explode(' ',$str_content);
		for($str_arr_num=0;$str_arr_num < $num_of_words_to_show;$str_arr_num++)
		{
			$subword_output = $subword_output.$str_arr[$str_arr_num].' ';
		}
		for($smbl_num=0;$smbl_num < $num_of_symbols;$smbl_num++)
		{
			$smbl_to_mr = $smbl_to_mr.$symbol_to_more;
		}
		$subword_output = $subword_output.$smbl_to_mr;
		
		return $subword_output; 
	}
#################################################################################################
########################### Facebook App Configuration ##########################################

	function fb_app_config()
	{
		$ci =& get_instance();
		$fbconfig = array(
					/*'appId' => '477662102340367',
					'secret' => 'a35d19c9895141a116c440d232df2dff',*///karmahelp.com
					//developersinaction.com
					'appId' => '612373375512151',
					'secret' => '3f8eb833513324ea827d2893e99bef4f',
					'trustForwarded'=>true,
					//'allowSignedRequest' => false // optional but should be set to false for non-canvas apps
				);
			
		//$ci->load->library('fbapi/facebook', $fbconfig);
		parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
		
		$fbconfig = array('appId' => '612373375512151', 'secret' => '3f8eb833513324ea827d2893e99bef4f');
	
		$ci->load->library('Facebook', $fbconfig);
	}
	
#################################################################################################

##################################Change Language###############################################
	function set_language($language_id=0)
	{
		$ci=& get_instance();
		if($language_id!=0){$ci->db->where('id',$language_id);}else{$ci->db->where('id',1);}
		
			$ci->db->select('id,language_name,languages_flag');
			
			$query=$ci->db->get($ci->db->dbprefix('languages')); 
			$result=$query->row_array();
			
			$data=array(
				'language_id'=>$result['id'],
				'language_name'=>$result['language_name']
			);
			$ci->session->set_userdata($data);
			return true;
	}

#################################################################################################

##################################Week Dropdown################################################
	function get_week_dropdown()
	{
		$result=array();
		
		$result["monday"]="Monday";
		$result["tuesday"]="Tuesday";
		$result["wednesday"]="Wednesday";
		$result["thrusday"]="Thrusday";
		$result["friday"]="Friday";
		$result["saturday"]="Saturday";
		
		return $result;
	
	}
###############################################################################################

##################################Time 24hrs Dropdown##########################################
	function get_time_dropdown()
	{
		$result=array();
		
		for($i=1;$i<=24;$i++)
		{
			$result[strtotime("$i:00")]=date("h.i A", strtotime("$i:00"));
		}
		
		return $result;
	
	}
########################################################################################

##################################DayTime Meal Dropdown##########################################
	function daytime_meal_dropdown()
	{
		$result=array();
		$result['breakfast']="Breakfast";
		$result['lunch']="Lunch";
		$result['dinner']="Dinner";
		
		return $result;
	}

########################################################################################

        
         ################# SEO URL ###############################
        /*

         * Function for creating SLUG
         * created by SR 
         *          */
    function create_unique_slug($string,$table,$field,$key=NULL,$value=NULL)
	{
		$t =& get_instance();
		$slug = url_title($string);
		$slug = strtolower($slug);
		$i = 0;
		$params = array ();
		$params[$field] = $slug;
	 
		if($key)$params["$key !="] = $value;
	 
		while ($t->db->where($params)->get($table)->num_rows())
		{  
			if (!preg_match ('/-{1}[0-9]+$/', $slug ))
				$slug .= '-' . ++$i;
			else
				$slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
			 
			$params [$field] = $slug;
		}  
		return $slug;  
	}
############################### Mail Sending Function #######################################


	function send_template_mail($tokens=NULL,$email_content,$subject,$to,$from)
	{
		$ci =& get_instance();
		$ci->load->database();
		
		if($tokens!=NULL)
		{				
			$pattern = array();
			$pattern = '[%s]';
			//$tokens = array('BASE_URL'=>base_url(),'NAME'=>$users_name,'EMAIL_ID'=>$users_email_id,'PASSWORD'=>$users_password);
			$map = array();	
						
			foreach($tokens as $var => $value)
			{
				$map[sprintf($pattern, $var)] = $value;
			}
			$body = strtr($email_content, $map);
		}else
		{
			$body = $email_content;
		}
		//echo $body; die();						
		$ci->load->library('email');
		$config['charset'] = 'utf-8';
		$config['wordwrap'] = TRUE;
		$config['mailtype'] = 'html';
		$ci->email->initialize($config);
		$ci->email->clear();
		$ci->email->to($to);
		$ci->email->from($from);
		$ci->email->subject($subject);
		$ci->email->message($body);
		$send=$ci->email->send();
		
		if($send==true)
		{
			return true;
		}else
		{
			return false;
		}		
	}	

############################Generate random string#################################################################	

	function rand_string( $length ) 
	{

    	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
   	 	return substr(str_shuffle($chars),0,$length);
	}
	
############### Calculate Distance between two coordinates in KiloMeter,Miles,Nautical #############################
	function distance($lat1, $lon1, $lat2, $lon2, $unit) 
	{
		if($lat1=='' || $lat2=='' || $lon1=='' || $lon2=='')
		{
			return '0';
		}
		$theta = $lon1 - $lon2;
		$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
		$dist = acos($dist);
		$dist = rad2deg($dist);
		$miles = $dist * 60 * 1.1515;
		$unit = strtoupper($unit);
		if ($unit == "K") 
		{
			return ceil($miles * 1.609344);
		} else if ($unit == "N") 
		{
			return ceil($miles * 0.8684);
		} else 
		{
			return ceil($miles);
		}
	}
?>