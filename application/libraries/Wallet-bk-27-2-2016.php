<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Wallet {
	
	private $CI;

	function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->model('Share_Model');
	   $this->CI->load->library('session');
	}


	public function showBucks($cents)
	{
		$amt = $cents/100;
		return '$'.round($amt, 2);
	}
	
	public function get_balance_in_leastcount($user_id)
	{
		$result = $this->CI->Share_Model->get_row('ai_wallet',array('user_id'=>$user_id,'status'=>0),'balance');
		return $result->balance;
	}
 
	public function update_balence($user_id,$data)
	{
		$result = $this->CI->Share_Model->get_row('ai_wallet',array('user_id'=>$user_id,'status'=>0),'balance');
		
		
	}
}