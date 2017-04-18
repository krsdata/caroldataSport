<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Share_Model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
	}	
	
	public function index()
	{
		$this->load->library('sports');
		$res =  $this->sports->get_single_options_details(5);
		print_r($res);  
		
		echo $res[0]['option_id'];
		die;
		echo "<h1>Access Denied</h1>";
	}
	
	public function featured()
	{
		$data['title'] = 'Featured Market';
        $data['errors'] = '';
        $data['baseUrl'] = base_url();	
		
		$featured_q = $this->Share_Model->get_rows('ai_question',array(),'id,question,image');
		
		$data['questions'] =  $featured_q;	
		$this->load->view('header');
		$this->load->view('question/question',$data);
		$this->load->view('footer');
	}	
	
	public function propsMarket()
	{
		$prop_id = $this->uri->segment(3);
		if(!empty($prop_id))
		{
			$title = str_replace("_", " ", $prop_id );
			$data['title'] = $title;
			$data['errors'] = '';
			$data['baseUrl'] = base_url();	
			
			$featured_q = $this->Share_Model->get_rows_limit_order_by('ai_question',array('question_type'=>$prop_id),'id,question,image','added_date','desc',15);
			
			$data['questions'] =  $featured_q;	
			$this->load->view('header');
			$this->load->view('question/question',$data);
			$this->load->view('footer');	
		}
	}	
	
	public function new_arrival()
	{
		$data['title'] = 'New Arrival';
        $data['errors'] = '';
        $data['baseUrl'] = base_url();	
		
		$featured_q = $this->Share_Model->get_rows_limit_order_by('ai_question',array(),'id,question,image','added_date','desc',15);
		
		$data['questions'] =  $featured_q;	
		$this->load->view('header');
		$this->load->view('question/question',$data);
		$this->load->view('footer');
	}
	
	public function buySharePopup()
	{
		
		$option_id = $this->uri->segment(3);
		$question_id = $this->uri->segment(5);
		
		//$resp = $this->Share_Model->get_row('')
		
		$type = $this->uri->segment(4);
		$deal_type = "buy";
		$this->load->library('sports');
		$available_offers = $this->sports->get_available_offers( $option_id , $type , $deal_type );
		
		$data['offers'] = $available_offers;
		$data['option_id'] = $option_id;
		$data['type'] = $type;
		$data['q_id'] = $question_id;
		$data['optionDetail'] = $this->sports->get_single_options_details($option_id);
		//$this->load->view('header');
		if($type == 'yes'){ $this->load->view('question/buyYesPopup',$data); }else{ $this->load->view('question/buyNoPopup',$data); } 
		//$this->load->view('footer');
	}
	
	public function ownershipPopup()
	{
		$option_id = $this->uri->segment(3);
		$question_id = $this->uri->segment(4);
		
		//$resp = $this->Share_Model->get_row('')
		$user_id = $this->session->userdata( 'id' );
		//$type = $this->uri->segment(4);
		//$deal_type = "buy";
		
		$where1['option_id'] = $option_id;
		$where1['offered_by']  = $user_id;    
		$where1['deal_type'] = 'sell';
		$where1['share_id']  = '0';	
		$where1['status'] = '1';
		
		$where2['option_id']  = $option_id;     		
		$where2['offered_by'] = $user_id;
		$where2['deal_type']  = 'sell';
		$where2['share_id !=']  = '0';	
		$where2['status'] = '1';
		
		$where3['option_id'] = $option_id;
		$where3['owner_id']  = $user_id;     
		//$where3['deal_type']  = $user_id;     
		$where3['status'] = '1';
		
		$data['buy_offers'] = $this->Share_Model->get_rows('ai_offered_shares',$where1,'*');
		$data['sell_offers'] = $this->Share_Model->get_rows('ai_offered_shares',$where2,'*');
		$data['shares'] =     $this->Share_Model->get_rows('ai_confirmed_shares',$where3 ,'*');
		$data['total_shares'] = $this->Share_Model->get_sum('ai_confirmed_shares',array('owner_id'=>$user_id,'option_id'=>$option_id,'status'=>'1'),'shares' );
		$data['total_sell_offer'] = $this->Share_Model->getSumOfSellOffers( $option_id , $user_id ) ;
		$data['total_buy_offer'] = $this->Share_Model->getSumOfBuyOffers( $option_id , $user_id );
		
		$this->load->library('sports');
		$data['optionDetail'] = $this->sports->get_single_options_details($option_id);
		
		$this->load->view('question/ownership_popup',$data);	
			
	}
	
	
	public function sellSharePopup()
	{
		
		$option_id = $this->uri->segment(3);
		$type = $this->uri->segment(4);
		$question_id = $this->uri->segment(5);
		$deal_type = "sell";
		$this->load->library('sports');
		$available_offers = $this->sports->get_available_offers( $option_id , $type , $deal_type );
		
		$data['offers'] = $available_offers;
		$data['option_id'] = $option_id;
		$data['type'] = $type;
		$data['q_id'] = $question_id;
		$data['optionDetail'] = $this->sports->get_single_options_details($option_id);
		//$this->load->view('header');
		if($type == 'yes'){ $this->load->view('question/sellYesPopup',$data); }else{ $this->load->view('question/sellNoPopup',$data); } 
		
		//$this->load->view('footer');
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
