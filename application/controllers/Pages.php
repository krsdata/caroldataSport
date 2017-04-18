<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
	}	
	
	public function about()
	{
		$this->load->view('header');
		$where = array('id' => 1);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('about',$data);
		$this->load->view('footer');
	}
	public function FAQ()
	{
		$this->load->view('header');
		$where = array('id' => 2);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('faq',$data);
		$this->load->view('footer');
	}
	
	public function Terms_Conditions()
	{
		$this->load->view('header');
		$where = array('id' => 3);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('terms-conditions',$data);
		$this->load->view('footer');
	}
	
	public function Security()
	{
		$this->load->view('header');
		$where = array('id' => 4);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('security',$data);
		$this->load->view('footer');
	}
	
	public function Privacy_Policy()
	{
		$this->load->view('header');
		$where = array('id' => 5);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('privacy-policy',$data);
		$this->load->view('footer');
	}
	
	public function how_it_works()
	{
		$this->load->view('header');
		$where = array('id' => 6);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('how-it-works',$data);
		$this->load->view('footer');
	}
	
	public function sports_swaps()
	{
		$this->load->view('header');
		$where = array('id' => 7);
        $data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('sports-swaps',$data);
		$this->load->view('footer');
	}
	
	public function analysis()
	{
		$this->load->view('header');
		//$where = array('id' => 5);
        //$data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('analysis');
		$this->load->view('footer');
	}
	
	public function nba_game()
	{
		$this->load->view('header');
		//$where = array('id' => 5);
        //$data['about_data'] = $this->User_model->get_row('ai_pages', $where, '*','','');
		$this->load->view('nba');
		$this->load->view('footer');
	}
	
	public function nfl_game()
	{
		$this->load->view('header');
		$this->load->view('nfl');
		$this->load->view('footer');
	}
	
	public function mlb_game()
	{
		$this->load->view('header');
		$this->load->view('mlb');
		$this->load->view('footer');
	}
	
	
	public function setting()
	{	
		$id = $this->session->userdata('id');
		$mobile = $this->input->post('mobile', true);
		$username = $this->input->post('username', true);
		$fname = $this->input->post('fname', true);
		$profile_img = $this->input->post('profile_img', true);
		
		$this->form_validation->set_rules('mobile','Mobile','required');
   	    $this->form_validation->set_rules('username','UserName','required');
		$this->form_validation->set_rules('fname','First Name','required');
		
		if( $this->form_validation->run() == true )
		{
				if($_FILES['profileimage']['name'] != '')
				{ 
						$config['upload_path'] = DOCUMENTPATH;
						$config['allowed_types'] = "gif|jpg|png|jpeg|JPEG";
						$config['max_width'] = '1024';
						$config['max_height'] = '768';
					   
						$this->load->library( 'upload' , $config );
						$this->upload->initialize( $config );
						
							if($this->upload->do_upload('profileimage'))
							{ 
								$flag = 0;
								$filedata = $this->upload->data();
								$profileimage = $filedata['file_name']; 
							}
							else
							{
								$flag = 1;
								/* echo $this->upload->display_errors(); die; */
							}
					}else{
					if($profile_img != ''){
					$profileimage = $profile_img;
					}else{
					$profileimage ='';
					}
				}
					
				$upd = array(
				'mobile'=>$mobile,
				'username'=>$username,
				'firstname'=>$fname,
				'profile_img'=>$profileimage,
				);
				$res=$this->Common_model->updateFields('ai_users',$upd,array('id'=>$id));
				if($res){
				$this->session->set_flashdata( 'msg' , 'pass|Profile update successfully.!' );
				redirect('setting');
				}
		}
		
		$data['profile'] = $this->Common_model->getsingle('ai_users', array('id' => $id), 'id,mobile,username,firstname,profile_img');
			
		$this->load->view('header');
		$this->load->view('setting',$data);
		$this->load->view('footer');
	}
	
	function change_password() {
		
		$id = $this->session->userdata('id');
		$old_pass = $this->input->post('old_pass', TRUE);
		$new_pass = $this->input->post('new_pass', TRUE);
		$new_cpass = $this->input->post('new_cpass', TRUE);
		
		$this->form_validation->set_rules('old_pass', 'old password', 'trim|required|callback__chk_old_pass');
        $this->form_validation->set_rules('new_pass', 'new password', 'trim|required');
        $this->form_validation->set_rules('new_cpass', 'confirm password', 'trim|required|matches[new_pass]');
		if ($this->form_validation->run() == TRUE) {
			$upd_array = array(
                'password' => $new_pass,
            );
            $res = $this->Common_model->updateFields('ai_users',$upd_array,array('id'=> $id));
			if($res){
				$this->session->set_flashdata( 'msg' , 'pass|Password change successfully.!' );
				redirect('setting');
			}
			
		}
		
		$data['profile'] = $this->Common_model->getsingle('ai_users', array('id' => $id), 'id,mobile,username,firstname');
		$this->load->view('header');
		$this->load->view('setting',$data);
		$this->load->view('footer');
	}
	
	 /** 
    * Supporting functions for change password(Check old password).
    * @param  string $str in where
    * @return void
    */
    function _chk_old_pass($str) {
        $id = $this->session->userdata('id');
        $get_user_where = array('id' => $id);
        $get_user_select = array('password'); //,'password_history'
        $get_user = $this->Common_model->getsingle('ai_users', $get_user_where, $get_user_select);

        if ($get_user != 'no record found') {
            $old_pass_db = $get_user->password;
			$npass = $str;
            $old_pass_us = $npass;

            if ($old_pass_db != $old_pass_us) {
                $this->form_validation->set_message('_chk_old_pass', 'The %s is incorrect.');
                return FALSE;
            } else {
                return TRUE;
            }
        } else {
            $this->form_validation->set_message('_chk_old_pass', 'The %s is incorrect.');
            return FALSE;
        }
    }
	
	function comment_method(){
		/* $comment = $_POST['comment1'];
		$question_id = $_POST['question_id1'];
		$userid = $this->session->userdata('id');
		$date_added = date('Y-m-d H:i:s');
		if($comment != ''){
			$dataArr['user_id'] = $userid;
			$dataArr['question_id'] = $question_id;
			$dataArr['comment'] = $comment;			
			$dataArr['status'] = 1;
			$dataArr['added_date'] = date('Y-m-d H:i:s');
			
			$res = $this->User_model->insert_row('ai_comment' , $dataArr );
			if($res){
				$table = "";
				$where = array('status' => 1,'question_id' => $question_id);
        		$data['comment'] = $this->User_model->get_rows('ai_comment', $where, '*');
				foreach($data['comment'] as $cdata){
				$data['userdata'] = $this->Common_model->getsingle('ai_users', array('id' => $cdata->user_id), 'id,mobile,username,firstname,lastname,profile_img');
					if($data['userdata']->profile_img != ''){
					$pimg = base_url().'profile_img/'.$data['userdata']->profile_img;
					}else{
					$pimg = base_url().'profile_img/noImg.jpg';
					}
					$username = $data['userdata']->username;
					$fullname = $data['userdata']->firstname.' '.$data['userdata']->lastname;
					
					$table .= '<article class="row">
									<div class="col-md-2 col-sm-2 hidden-xs">
									  <figure class="thumbnail">
										<img class="img-responsive" src='.$pimg.' />
										<figcaption class="text-center">'.$username.'</figcaption>
									  </figure>
									</div>
									<div class="col-md-10 col-sm-10">
									  <div class="panel panel-default arrow left">
										<div class="panel-body">
										  <header class="text-left">
											<div class="comment-user"><i class="fa fa-user"></i> '. $fullname.' </div>
											<time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> Dec 16, 2014</time>
										  </header>
										  <div class="comment-post">
											<p>
											  '.$cdata->comment.'
											</p>
										  </div>
										</div>
									  </div>
									</div>
								  </article>';
								  
				}
				
				echo $table;
			}
		} */
	}
	
}
