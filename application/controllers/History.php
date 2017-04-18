<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Share_Model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		$this->load->library('wallet');
	}	
	
	
	public function history()
	{
		$userId = $this->session->userdata('id');
		$data['history'] = $this->Share_Model->get_rows('ai_shares_log',array('owner_id'=>$userId),'*');
		
		$data['profile'] = $this->Common_model->getsingle('ai_users', array('id' => $userId), 'profile_img');
		
		$this->load->view('header');
		$this->load->view('history',$data);
		$this->load->view('footer');
	}
	
}
