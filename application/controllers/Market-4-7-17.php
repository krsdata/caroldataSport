<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Market extends CI_Controller {
	
	function __construct()
	{
        parent::__construct();
        $this->load->model('Share_Model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		$this->load->library('wallet');
		
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
	}	
	
	public function index()
	{
		echo "<h1>Access Denied</h1>";
	}
	
	public function test()
	{
		$t = (object)array('sss'=>(object)array('asd'=>'876'),'ddd'=>'213231','fff'=>'235665');
		echo $t->sss->asd;
		
	}
	
	// this is the controller method for a dealing to a perticular question in market. //
	public function deal()
	{
		$id = $this->uri->segment(3);
		
		if(!empty($id))
		{
			/* $data['title'] = '';
			$data['errors'] = '';
			$data['baseUrl'] = base_url(); */	
			
			$featured_q = $this->Share_Model->get_row('ai_question',array('id'=>$id),'id,question,description_rules,image');
			$option_dt  = $this->sports->get_options_details($id);
			
			$data['question'] =  $featured_q;	
			$data['options'] = $option_dt;
			
			$where = array('status' => 1,'question_id'=>$id);
        	$data['comment'] = $this->User_model->get_rows('ai_comment', $where, '*');
			//$data['deviation'] = $this->Share_Model->getLatestRateOfOption($option_id);
			
			$this->load->view('header');
			$this->load->view('question/question_detail',$data);
			$this->load->view('footer');
		}	
		else
		{
			
		}
		
	}	
	
	public function submit_deal()
	{
		print_r($_POST); die;	
		$type = $this->input->post('type');
		$deal_type = $this->input->post('deal_type');
		$option_id = $this->input->post('option_id');
		$share_count = $this->input->post('Quantity');
		$rate = $this->input->post('PricePerShare');
		$question_id = $this->input->post('question_id');
		
		$deal_session['type'] = $type;
		$deal_session['deal_type'] = $deal_type;		
		$deal_session['option_id'] = $option_id;
		$deal_session['share_count'] = $share_count;
		$deal_session['rate'] = $rate;
		$deal_session['question_id'] = $question_id;
		
		$this->session->set_userdata('deal_session', $deal_session);
		//print_r($_POST); die;
		//$this->sports->do_matched_deals($option_id,$type,$deal_type,$share_count,$rate);
		//$data['deviation'] = $this->Share_Model->getLatestRateOfOption($option_id);
		
		//redirect('market/preview/'.$question_id);
		echo "preview";
	}
	
	public function preview()
	{
		$deal_session = $this->session->userdata('deal_session');
		$type = $deal_session['type'];
		$deal_type = $deal_session['deal_type'];
		$option_id = $deal_session['option_id'];
		$share_count = $deal_session['share_count'];
		$rate = $deal_session['rate'];
		$question_id = $deal_session['question_id'];
		
		/* $deal_session['type'] = $type;
		$deal_session['deal_type'] = $deal_type;		
		$deal_session['option_id'] = $option_id;
		$deal_session['share_count'] = $share_count;
		$deal_session['rate'] = $rate;
		$deal_session['question_id'] = $question_id;
		
		$this->session->set_userdata('deal_session', $deal_session); */
		
		$user_id = $this->session->userdata( 'id' );
		$current_bal = $this->wallet->get_balance_in_leastcount($user_id);
		//$rate = $this->input->post('PricePerShare');
		//$share_count = $this->input->post('Quantity');
		$req_bal  = $rate*$share_count;
		$message  = "";
		if($req_bal > $current_bal)
		{
			$new_share_count = floor($current_bal/$rate);
			$share_count  = $new_share_count;
			$message = "You do not have sufficient funds available to make this offer in full. Your offer has been reduced accordingly.";
		}
		$data['current_bal'] = $current_bal;
		$data['message'] = $message;
		$data['share_count'] = $share_count;
		$data['type'] = $type;
		$data['deal_type'] = $deal_type;
		$data['option_id'] = $option_id;
		$data['rate'] = $rate;
		$data['question_id'] = $question_id;
		$data['req_bal'] = $rate*$share_count;
		$data['currentRisk'] = $this->Share_Model->getCurrentRisk($option_id,$user_id);
		$data['projectedRisk'] = $data['currentRisk'] + $data['req_bal'];
		print_r($deal_session);
		//$this->load->view('question/previewPopup',$data);
		
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
