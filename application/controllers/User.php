<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		$this->load->library('email');
		date_default_timezone_set('Asia/Calcutta');
		
		$facebook_config = $this->config->item('facebook_config');
        $this->load->library('facebook', array('appId' => $facebook_config['api'], 'secret' => $facebook_config['api_secret']));
        parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
        $this->user = $this->facebook->getUser();
	}	
	
	public function index()
	{
		$this->load->view('header');
		$this->load->view('home');
		$this->load->view('footer');
	}
	
	public function login()
	{
		
            $data['title'] = 'Login';
            $data['errors'] = '';
           
            
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);
           	$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        	$this->form_validation->set_rules('password', 'Password', 'trim|required');
            if($this->form_validation->run() == TRUE) { 
                $where = array('email' => $email,'password' => $password);
                $user_detials = $this->User_model->get_row('ai_users', $where, 'id,firstname,mobile,username,password,email,last_login,status','','');				
				//print_r($user_detials);die;
                if(!empty($user_detials))
                    {
						if($user_detials->status == 1)
						{
							$db_pass = $user_detials->password;
							$user_pass = $password;
							if ($user_pass == $db_pass) 
									{
										$newdata = array(
														'id' => $user_detials->id,
														'username' => $user_detials->username,
														'firstname' => $user_detials->firstname,
                                                		'email' => $user_detials->email,
														'mobile' => $user_detials->mobile,
                                                		'last_login' => $user_detials->last_login
                                                		);
                                    	$this->session->set_userdata($newdata);
									
							$data = array('last_login' => date('Y-m-d H:i:s'));
                            $where = array('id' => $user_detials->id);
                            $this->User_model->update_row('ai_users', $where , $data);
                           
                            redirect('myshare'); // header("location:$url");
                                }
						}
						else
						{
							$senderEmail="admintest@mailinator.com";
							$reciverEmail = $email;
							$senderName = "Admin";
							$ccEmails = "";
							$bccEmails = "";
							$subject = "Email verification from sports swap";
							$message = " <a href='".base_url()."user/emailverification/".$user_detials->id."' traget='new' >Click here</a> to be verified :- ";
							$this->sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message);
							
							$this->session->set_flashdata( 'msg' , 'Email is not verified please check your email for verification.' );
							redirect('login');
						}
                         
                    }else{
						$this->session->set_flashdata( 'msg' , 'Wrong Email or Password. Try again.' );
						redirect('login');
						//$data['errors'] = 'Wrong Email or Password. Try again.';
                    }                
            }
			else
			{
				$this->session->set_flashdata( 'msg' , 'Please enter valid email. Try again.' );
						redirect('login');
			}
			//$this->load->view('admin_login', $config); 
			
	}
	
	
	public function registration()
	{
		$data = array();
		
		//print_r($_POST);
	   if($_POST)
	   {
            $this->form_validation->set_rules('name','First Name','required');
			$this->form_validation->set_rules('lastname','Last Name','required');
   	        $this->form_validation->set_rules('userName','UserName','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('mobile','Mobile','required');
			$this->form_validation->set_rules('zip_code','Zip Code','required');
			$this->form_validation->set_rules('country','Country','required');
			
			//$this->form_validation->set_rules('usageType','usageType','required');
			
			if( $this->form_validation->run() == FALSE )
			{
				$this->load->view('header');
				$this->load->view('signup');
				$this->load->view('footer');
				
			}
			else
			{
				$emailexists = $this->User_model->isExists('ai_users',array('email'=>$this->input->post('email')));
				if(!$emailexists)
				{
				
					$dataArr['firstname'] = $this->input->post('name');
					$dataArr['lastname'] = $this->input->post('lastname');
					$dataArr['username'] = $this->input->post('userName');
					$dataArr['mobile'] = $this->input->post('mobile');
					$dataArr['email'] = $this->input->post('email');
					$dataArr['password'] = $this->input->post('password');
					
					$dataArr['address'] = $this->input->post('address');
					$dataArr['zip_code'] = $this->input->post('zip_code');
					$dataArr['country'] = $this->input->post('country');
					
					$dataArr['status'] = 1;
					
					$res = $this->User_model->insert_row( 'ai_users' , $dataArr );
					
					$dataArr1['user_id'] = $res;
					$dataArr1['balance'] = '0';
					$dataArr1['invested'] = '0';
					$dataArr1['gain_loss'] = '0';
					$dataArr1['status'] = '1';
					$res1 = $this->User_model->insert_row( 'ai_wallet' , $dataArr1 );
					
						if( $res > 0 )
						{
							$senderEmail="admintest@mailinator.com";
							$reciverEmail = $this->input->post('email');
							$senderName = "Admin";
							$ccEmails = "";
							$bccEmails = "";
							
							$email_html = " <a href='".base_url()."user/emailverification/".$res."' traget='new' >Click here</a> to be verified :- ";
							//$this->sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message);
							$email = $reciverEmail;
							$subject = "Email verification from sports swap";
							$message = $email_html;
							$headers = 'MIME-Version: 1.0' . "\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
							$headers .= 'From: Sports Swaps<pankaj.caroldata@gmail.com>' . "\n";
							@mail($email, $subject, $message, $headers);
									
							$this->session->set_flashdata( 'msg' , ' Registered successfully! please login with registered email..!' );
							redirect('login');
						}
						else
						{
							$this->session->set_flashdata( 'msg' , " failed! " );
							redirect('signup');
						}
					
				}
				else
				{
					$this->session->set_flashdata( 'msg' , "Email already exists failed! " );
					redirect('signup');
				}					
			}
			
	    }
	    else
	    {
			redirect('signup');
	    }
	}
	
	public function forgotpassword()
	{
		$email = $this->input->post('email', TRUE);
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
            if($this->form_validation->run() == TRUE) { 
                $where = array('email' => $email);
                $user_detials = $this->User_model->get_row('ai_users', $where, 'id,username,password,email,last_login','','');
				$new_pass =  "123456";
				if(!empty($user_detials))
				{
					$resp = $this->User_model->update_row('ai_users',array('id'=> $user_detials->id),array('password'=>$new_pass));
					if($resp>0)
					{
						$senderEmail="admintest@mailinator.com";
						$reciverEmail = $email;
						$senderName = "Admin";
						$ccEmails = "";
						$bccEmails = "";
						$subject = "new pasword from sports swap";
						$message = " your new password is :- ".$new_pass;
						$this->sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message);
						
						$this->session->set_flashdata( 'msg' , "Check email for new password! " );
							redirect('home/login');
					}
					else					
					{ 
						$this->session->set_flashdata( 'msg' , "Password change request failed.! " );
							redirect('home/forgotpassword');
					}	
				}
				else
				{
					$this->session->set_flashdata( 'msg' , "Email does not exists! " );
						redirect('home/forgotpassword');
				}
			}				
	}
	
	public function emailverification()
	{
		$part = $this->uri->segment(3);
		$id = $part;
		$resp = $this->User_model->update_row('ai_users',array('id'=>$id),array('status'=>1));
			if($resp >= 0)
			{
				$this->session->set_flashdata( 'msg' , "Verified successfully " );
						redirect('login');
			}
			else
			{
				
						redirect('login');
			}
	}
	
	public function logout()
	{
		
		$this->session->unset_userdata('id');
		redirect('login');
	}
	
	public function sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message)
	{
		$this->load->library('email');

		$this->email->from($senderEmail, $senderName);
		$this->email->to($reciverEmail);
		$this->email->cc($ccEmails);
		$this->email->bcc($bccEmails);
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();
	}
	
	//***********  get data from facebook  ***********
	public function social_user_data(){
	
		if($this->user){					
			
			$profile = $this->facebook->api('/me?fields=id,name,link,email');
                        
//			print_r($profile);
  
            $string = '963258'; //random_string('numeric', rand(6, 10));
			$password =  $string;//random password generate for user
			$usName = explode(" ",$profile['name']);	
			$arr_social = array(
					'username' => $usName[0],
					'email' => $profile['email'],
					'firstname' => $profile['name'],
					'login_type' => 'facebook',
					'social_id'  => $profile['id'],
					'password'   => $password,
					'date_added' => date('Y-m-d h:i:s'),
                    'status' => '1',
					);	
                        //print_r($arr_social);exit;
			$check_email = array('email' => $profile['email']);
			
			if(!empty($profile['email'])){
				
				//check email is already available
				 $check_email = $this->Common_model->get_entry_by_data('ai_users',true,$check_email);	 
				 if($check_email==''){				
				 //  get all data from existing email
					 $reg_data = $this->Common_model->insert_row('ai_users',$arr_social);
					 
					 
					$dataArr1['user_id'] = $reg_data;
					$dataArr1['balance'] = '0';
					$dataArr1['invested'] = '0';
					$dataArr1['gain_loss'] = '0';
					
					$res1 = $this->User_model->insert_row( 'ai_wallet' , $dataArr1 );
					 
					if($reg_data != ''){
					$reg_data1 = $this->Common_model->getsingle('ai_users',array('id'=>$reg_data),'*','','');
					/*
					 |------------------------------------------|
						 |  Registration mail for user		|
					 |------------------------------------------|
					*/
					
                    $url = base_url();
			  		$email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to Sports Swaps</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"></td> 
                      </tr>
					  
                    <tr>
                        <td>
                        	<table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
						
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $reg_data1->firstname . '</td>
                      </tr>
					  
                      	<tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          	<p>We welcome you to the Sports Swaps.</p>
                        	<p>Please save this e-mail message for future reference. To access your ' .$url. ' account, use the following login information:</p>
                        </td>
                      </tr>

                      	<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$reg_data1->email. '</td>
          </tr>

            			<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password :</strong>' .$password. '</td>
          </tr>
             
          				<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
          </tr>
                               
            			<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    Sports Swaps Team<br />
			</td>
			
					</table>
						</td>
                    </tr>
                    
                    
                    </table>

                    </body>
                    </html>';
           	$email = $reg_data1->email;
            $subject = 'Sports Swaps';
           	$message = $email_html;
            $headers = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            $headers .= 'From: Sports Swaps<"gurjarpkj@gmail.com">' . "\n";
            @mail($email, $subject, $message, $headers);
				
			/*
			|-------------------------------
			|  Email template end for user
			|---------------------------------
			*/	
					 
			//send data to set session						
			$this->user_data_method($reg_data1);
			}
			}else{
				//if alraedy exist set session for existing email
				$this->user_data_method($check_email);
				
			}//echeck alredy registerd	
			}else{
				//if email is not found then go back to user profile page for update email
				
				$this->load->view('header');
				$this->load->view('login',$data);
				$this->load->view('footer');
					 
			}
		}
		$url = $this->session->userdata('socail_curnt_url');
		if($this->session->userdata('egift_email')){
		$this->session->set_userdata('social_login','facebook');
		redirect('setting');	
		}else{
                redirect('setting');
		}
	}//End login with facebook
	
	// ************* Logim with google code start *************************
	public function google_login(){
			
		    include_once APPPATH . "libraries/google-api-php-client-master/src/Google/autoload.php"; 
            include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
            include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";
            
            //get google api credentials to config file
            $google_config = $this->config->item('google_config');//configure in les_config file            
            $client_id = $google_config['client_id'];            
            $client_secret = $google_config['client_secret'];
            $redirect_uri = 'http://democarol.com/sportsswaps/User/google_login';
            $simple_api_key = $google_config['simple_api_key'];
		
			$client = new Google_Client();
			$client->setApplicationName("PHP Google OAuth Login Example");
			$client->setClientId($client_id);
			$client->setClientSecret($client_secret);
			$client->setRedirectUri($redirect_uri);
			$client->setDeveloperKey($simple_api_key);
			$client->addScope("https://www.googleapis.com/oauth2/v2/userinfo");
			
			// Send Client Request
			$objOAuthService = new Google_Service_Oauth2($client);
			
			
			// Set Access Token to make Request
		if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}
		
		// Set Access Token to make Request
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
		}


			if ($client->getAccessToken()) {
				
			$userData = $objOAuthService->userinfo->get();
			
			//var_dump($userData);
			//print_r($userData); exit;
		
			$data['userData'] = $userData;
			$_SESSION['access_token'] = $client->getAccessToken();
			/* start random password generate code */
			//$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
			//$special_char = "@!#$%^&*()+<>";
			//$numbers = rand(10000000, 99999999);
			//$prefix = "L";
			//$sufix = $letters[rand(0, 25)];
			//$special = $special_char[rand(0, 13)];			
			//$string = $prefix . $numbers.$sufix.$special;
			$password =  '545646';//random password generate for user	
			//Get userdata  and insert values
			
			$arr_social = array(
					'username' => $userData['givenName'],
					'firstname' => $userData['givenName'].' '.$userData['familyName'],
					'email' => $userData['email'],
					'password'   => $password,
					'login_type' => 'Google',
					'status'  => '1',
					'last_login' => date('Y-m-d h:i:s'),
					);	
					
			$check_email = array('email' => $userData['email']);
			
			if(!empty($userData['email'])){
				
				//check email is already available
				 $check_email = $this->Common_model->get_entry_by_data('ai_users',true,$check_email);
				 if($check_email==''){				
				 //  get all data from existing email
					 $reg_data = $this->Common_model->insert_row('ai_users',$arr_social);
					 
					$dataArr1['user_id'] = $reg_data;
					$dataArr1['balance'] = '0';
					$dataArr1['invested'] = '0';
					$dataArr1['gain_loss'] = '0';
					
					$res1 = $this->User_model->insert_row( 'ai_wallet' , $dataArr1 );
					 
					 
					 if($reg_data!=''){
                     //send data to set session	
					 $reg_data1 = $this->Common_model->getsingle('ai_users',array('id'=>$reg_data),'*','','');	 
					/*
			 		|------------------------------------------|
				 	|  Registration mail for user		|
			 		|------------------------------------------|
				 	*/
			$email_html="";
			$email_html = '<html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title>Welcome to Sports Swaps</title>
                    </head>

                    <body>
                    <table width="550" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #999;" align="center">
                      <tr>
                        <td valign="top" style="background-color:#474747; width:550px;"></td> 
                      </tr>
					  
                    <tr>
                        <td>
                        	<table width="537" border="0" cellspacing="0" cellpadding="0" style="background-color:#fcfcfa; margin-top:10px; float:left; border:1px solid #d5d5d5; margin-left:3px; margin-bottom:10px;">
						
                      <tr>
                        <td style="margin:0px;font-family:Arial, Helvetica, sans-serif; font-size:20px; color:#074e8c; border-bottom:1px dashed #d5d5d5; margin-bottom:5px; padding:10px 0 10px 10px;">Dear ' . $reg_data1->firstname . '</td>
                      </tr>
					  
                      	<tr>
                        <td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;"> 
                          	<p>We welcome you to the Sports Swaps.</p>
                        	<p>Please save this e-mail message for future reference. To access your ' .$url. ' account, use the following login information:</p>
                        </td>
                      </tr>

                      	<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Email :</strong>' .$reg_data1->email. '</td>
          </tr>

            			<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Password :</strong>' .$password. '</td>
          </tr>
             
          				<tr>
            <td style="font-size:12px;font-family:Arial,Helvetica,sans-serif;color:#000;padding:5px 10px 0px 10px;line-height:20px"><strong style="color:#000;width:75px;float:left">Date :</strong>'.date('Y-m-d H:i:s').'</td>
          </tr>
                               
            			<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:10px 10px 10px 10px; line-height:20px;">Best Regards<br />
                    Sports Swaps Team<br />
			</td>
			
					</table>
						</td>
                    </tr>
                    
                    
                    </table>

                    </body>
                    </html>';
           	$email = $reg_data1->email;
            $subject = 'Sports Swaps';
           	$message = $email_html;
            $headers = 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\n";
            $headers .= 'From: Sports Swaps<"gurjarpkj@gmail.com">' . "\n";
            @mail($email, $subject, $message, $headers);
				
			/*
			|-------------------------------
			|  Email template end for user
			|---------------------------------
			*/	
						 
						 					
						$this->user_data_method($reg_data);
						 
					 }
				}else{
					//if alraedy exist set session for existing email
					$this->user_data_method($check_email);
				}//echeck alredy registerd	
			}else{
				  //if email is not found then go back to user profile page for update eail
				  		$this->load->view('header');
						$this->load->view('login',$data);
						$this->load->view('footer');
			}
			$url = $this->session->userdata('socail_curnt_url');
			// ****end google session
			if($this->session->userdata('egift_email')){
			$this->session->set_userdata('social_login','google');
			redirect($url);
		}else{
			//redirect($url);
			redirect('setting');	  
		}	
		} 
			
	}//login with google end

	
	
	public function user_data_method($user_data){
			$sess_array = array( 
								'id' =>  $user_data['id'],
								'username' =>  $user_data['username'],
								'firstname' =>  $user_data['firstname'],
								'email' =>  $user_data['email'],
								'mobile' =>  $user_data['mobile'], 
								'last_login' =>  $user_data['last_login']	
								);
			$this->session->set_userdata($sess_array);
			
			//$this->session->set_userdata('les_user_data', $sess_array);
			//$this->synchronize_user_cart();	
	}//end session method
}
