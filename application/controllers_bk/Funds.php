<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funds extends CI_Controller {
	
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
		$this->load->view('funds');
		$this->load->view('footer');
	}
	
}
