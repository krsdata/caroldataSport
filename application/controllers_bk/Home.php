<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
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
		
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function signup()
	{
		
		$this->load->view('header');
		$this->load->view('signup');
		$this->load->view('footer');
	}
	public function forgotpassword()
	{
		
		$this->load->view('header');
		$this->load->view('forgotpassword');
		$this->load->view('footer');
	}
}
