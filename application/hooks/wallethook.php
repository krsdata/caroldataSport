<?php defined('BASEPATH') OR exit('No direct script access allowed');
Class Wallethook 
{
private $CI;

   function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->model('User_Model');
   }

    public function UpdateResults(){
		$userid=$this->CI->session->userdata('id');
		$wallet_details = $this->CI->User_model->get_row('ai_wallet',array('user_id'=> $userid),'*');
		if(!empty($wallet_details))
        {
			$wdata = array(
							'balance' => $wallet_details->balance,
							'invested' => $wallet_details->invested,
                            'gain_loss' => $wallet_details->gain_loss
                          );
           $this->CI->session->set_userdata($wdata);
		}
      }
}
?>