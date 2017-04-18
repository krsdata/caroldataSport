<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
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
        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[15]');
            if($this->form_validation->run() == TRUE) { 
                $where = array('email' => $email,'password' => $password);
                $user_detials = $this->User_model->get_row('ai_users', $where, 'id,username,password,email,last_login,status','','');				
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
                                                'email' => $user_detials->email,
                                                //'fullname' => $user_detials->fullname,
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
			//$this->load->view('admin_login', $config); 
			
	}
	
	
	public function registration()
	{
		$data = array();
		
		//print_r($_POST);
	   if($_POST)
	   {
            $this->form_validation->set_rules('name','Name','required');
   	        $this->form_validation->set_rules('userName','UserName','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');
			$this->form_validation->set_rules('mobile','Mobile','required');
			//$this->form_validation->set_rules('usageType','usageType','required');
			
			if( $this->form_validation->run() == FALSE )
			{
				$this->load->view('header');
				$this->load->view( 'signup' );
				$this->load->view('footer');
				
			}
			else
			{
				$emailexists = $this->User_model->isExists('ai_users',array('email'=>$this->input->post('email')));
				if(!$emailexists)
				{
				
					$dataArr['firstname'] = $this->input->post('name');
					$dataArr['username'] = $this->input->post('userName');
					$dataArr['mobile'] = $this->input->post('mobile');
					$dataArr['email'] = $this->input->post('email');
					$dataArr['password'] = $this->input->post('password');
					$dataArr['status'] = 2;
					
					$res = $this->User_model->insert_row( 'ai_users' , $dataArr );
						if( $res > 0 )
						{
							$senderEmail="admintest@mailinator.com";
							$reciverEmail = $this->input->post('email');
							$senderName = "Admin";
							$ccEmails = "";
							$bccEmails = "";
							$subject = "Email verification from sports swap";
							$message = " <a href='".base_url()."user/emailverification/".$res."' traget='new' >Click here</a> to be verified :- ";
							$this->sendemail($senderEmail,$reciverEmail,$senderName,$ccEmails,$bccEmails,$subject,$message);
									
							$this->session->set_flashdata( 'msg' , ' Registered successfully! please check your email for verification!' );
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
					if($resp>=0)
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
			if($resp)
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
}
