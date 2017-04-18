<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
	}	
	
	public function about()
	{
		$this->load->view('header');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function myshare()
	{
		$this->load->view('header');
		$this->load->view('myshare');
		$this->load->view('footer');
	}
	
	public function history()
	{
		$this->load->view('header');
		$this->load->view('history');
		$this->load->view('footer');
	}
	
	public function setting()
	{
		$this->load->view('header');
		$this->load->view('setting');
		$this->load->view('footer');
	}
	
}
