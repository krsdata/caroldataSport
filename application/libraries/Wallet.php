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
		$sign = substr( $cents , 0 , 1 );
		$amount = substr( $cents , 1 );
		if( $sign == '-' )
		{
			$amt = $amount/100;
			return '-$'.round($amt, 2);
		}
		else
		{
			$amt = $cents/100;
			return '$'.round($amt, 2);
		}
	}
	
	public function get_balance_in_leastcount( $user_id )
	{
		$result = $this->CI->Share_Model->get_row('ai_wallet',array('user_id'=>$user_id,'status'=>1),'balance');
		//print_r($result); die;                                                     
		return $result->balance;
	}
 
	public function add_balence( $user_id , $amount )
	{  
		$result = $this->CI->Share_Model->get_row('ai_wallet',array('user_id'=>$user_id,'status'=>1),'balance');
		$res_amount = $result->balance + $amount ;
		$this->CI->Share_Model->update_row('ai_wallet',array('user_id'=>$user_id,'status'=>1),array('balance'=>$res_amount));
	}
	
	public function reduce_balence( $user_id , $amount )
	{
		$result = $this->CI->Share_Model->get_row('ai_wallet',array('user_id'=>$user_id,'status'=>1),'balance');
		$res_amount = $result->balance - $amount ;
		$this->CI->Share_Model->update_row('ai_wallet',array('user_id'=>$user_id,'status'=>1),array('balance'=>$res_amount));
	}
	
	public function deactivate_wallet($user_id)
	{
		$this->CI->Share_Model->update_row( 'ai_wallet' , array('user_id'=>$user_id) , array('status'=>0) );
	}
	
}