<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Funds extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->load->model('User_model');
		$this->load->model('Common_model');
		$this->rootpath = $_SERVER['DOCUMENT_ROOT'];
		$this->load->library('form_validation');
		//$this->rootpath = 'C:/xampp/htdocs/sampleadmin/';
	}
	
	public function index()
	{
		$userid=$this->session->userdata('id');
		$data['transaction_history'] = $this->Common_model->get_rows('ai_payment_transaction_log', array('user_id' => $userid), 'amount,user_id,created_date,gateway_transaction_id,payment_status');
		
		$data['profile'] = $this->Common_model->getsingle('ai_users', array('id' => $userid), 'profile_img');
		
		$this->load->view('header');
		$this->load->view('funds',$data);
		$this->load->view('footer');
	}
	
	public function deposit_funds(){
			$userid=$this->session->userdata('id');
			$this->load->helper('url');
					try { //echo APPPATH.'libraries/stripe/lib/stripe.php';
						require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
						Stripe::setApiKey("sk_test_Got3gYoDGTRUgWE9EOauubss"); //Replace with your Secret Key
						$amt = $_POST['amt123'];
						$stripeToken = $_POST['stripeToken'];
						$stripeEmail = $_POST['stripeEmail'];
						
						$charge = Stripe_Charge::create(array(
							"amount" => 1500,
							"currency" => "usd",
							"card" => $_POST['stripeToken'],
							"description" => "Transaction"
						)); 
					
                       	$add_date = date('Y-m-d H:i:s');
                       	$rest = Stripe_Charge::retrieve($charge->id);
						$order_id = $charge->id;
						$last4=$rest['source']['last4'];
						$cardNumber = '************'.$last4;
						
						$transactionId = $rest['balance_transaction'];
						
						
						$amt1 = $amt * 100;
						
						$deposit_data = array(
							'amount' => $amt1,
							'user_id' => $userid,
							'email' => $stripeEmail,
							'currency' => $charge->currency,
							'fname' => $rest->source['name'],
							'city' => $rest['source']['address_city'],
							'state' => $rest['source']['address_state'],
							'country' => $rest['source']['address_country'],
							'zipcode' => $rest['source']['address_zip'],
							'card_type' => $rest['source']['brand'],
							'gateway_transaction_id' => $transactionId,
							'card_last_four_digit' => $cardNumber,
							'payment_status' => 1,
							'status' => 1,
							'created_date' => $add_date,
							);
							
						$cid=$this->Common_model->insert_row('ai_payment_transaction_log', $deposit_data);
						$this->db->last_query();
						
						//balance get by loged in user 
						$where1 = array('user_id' => $userid);
						$balance = $this->Common_model->getsingle('ai_wallet', $where1, 'balance');
						if($balance != 'no record found'){
							$Avi_balance = $balance->balance;
						}
						//Update users table after wallet table
						$Totel_Bal = $Avi_balance + $amt1;
						$Totel_Bal_Cent = $Totel_Bal;
						$id = array('user_id'=>$userid);
						$this->Common_model->updateFields('ai_wallet',array('balance'=>$Totel_Bal_Cent),$id);
						
						//redirect(base_url().'funds');
						$this->session->set_flashdata( 'msg' , 'pass|Your payment successfully deposit in your wallet account.!' );
						redirect('funds#Deposit-Funds');
		}
		catch(Stripe_CardError $e) {
		}
		catch (Stripe_InvalidRequestError $e) {
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
		}
	}

}

