<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myshare extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
	}	
	
	
	public function myShare()
	{
		$id = $this->session->userdata('id');
		$data['profile'] = $this->Common_model->getsingle('ai_users', array('id' => $id), 'profile_img');
		
		$this->load->view('header');
		$this->load->view('myshare',$data);
		$this->load->view('footer');
	}
	
}
