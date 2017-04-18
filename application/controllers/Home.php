<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
		
		$facebook_config = $this->config->item('facebook_config');
        $this->load->library('facebook', array('appId' => $facebook_config['api'], 'secret' => $facebook_config['api_secret']));
        parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
        $this->user = $this->facebook->getUser();
	}
	
	public function index()
	{
		
		$this->load->view('header');
		
		/*$where = array('id' => 1);
        $data['homeData'] = $this->User_model->get_row('ai_homepage_content', $where, '*');*/
		$where = array('id' => 1);
        $data['homeData'] = $this->User_model->get_row('ai_homepage_content', $where, '*');
		
		
		$where = array('status' => 1);
        $data['logo'] = $this->User_model->get_rows('ai_logo', $where, '*');
		
		$this->load->view('home',$data);
		$this->load->view('footer',$data);
	}
	public function login()
	{
		$data['login_url'] = $this->facebook->getLoginUrl(array(
            'redirect_uri' => base_url('user/social_user_data/'),
            'scope' => array("email")));
			
			
			include_once APPPATH . "libraries/google-api-php-client-master/src/Google/autoload.php"; 
            include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Client.php";
            include_once APPPATH . "libraries/google-api-php-client-master/src/Google/Service/Oauth2.php";
            
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
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");
		
		// Send Client Request
		$objOAuthService = new Google_Service_Oauth2($client);
		
		// Add Access Token to Session
		if (isset($_GET['code'])) {
		$client->authenticate($_GET['code']);
		$_SESSION['access_token'] = $client->getAccessToken();
		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}
		
		// Set Access Token to make Request
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		$client->setAccessToken($_SESSION['access_token']);
		}
		
		// Get User Data from Google and store them in $data
		
		$authUrl = $client->createAuthUrl();
		$data['authUrl'] = $authUrl;	
			
			
		$this->load->view('header');
		$this->load->view('login',$data);
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
