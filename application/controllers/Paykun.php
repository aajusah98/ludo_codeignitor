<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Paykun extends CI_Controller {
   public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->library('encdec_paytm');
	$this->load->helper('date');

	}


public function sucessPaymet(){
	

require 'src/Payment.php';
require 'src/Crypto.php';
require 'src/Validator.php';


// $obj = new \Paykun\Checkout\Payment('<merchantId>', '<accessToken>', '<encryptionKey>', true, true);
$obj = new \Paykun\Checkout\Payment(PAYKUN_MERCHANT_MID, ﻿Access_Token , API_Secret, false, true);
$response = $obj->getTransactionInfo($_REQUEST['payment-id']);


if(is_array($response) && !empty($response)) {

    if($response['status'] && $response['data']['transaction']['status'] == "Success") {

    	$transaction=array(
    		'userId'=>$this->session->userdata('userinsertId'),'payment_type'=>"Added To Wallet",
    			'payment_type'=>"Added To Wallet",
    			'ORDERID'=>$response['data']['transaction']['payment_id'],
    			'MID'=>$response['data']['transaction']['merchant_id'],
    			'TXNID'=>$response['data']['transaction']['order']['order_id'],
    			'TXNAMOUNT'=>$response['data']['transaction']['order']['gross_amount'],
    			'PAYMENTMODE'=>$response['data']['transaction']['payment_mode'],
    			'CURRENCY'=>'INR',
    			'TXNDATE'=>$response['data']['transaction']['date'],
    			'STATUS'=>$response['data']['transaction']['status'],
    			'RESPCODE'=>'NA',
    			'RESPMSG'=>'NA',
    			'GATEWAYNAME'=>$response['data']['transaction']['payment_mode'],
    			'BANKTXNID'=>'NA',
    			'BANKNAME'=>'NA',
    			'CHECKSUMHASH'=>'NA'

    	);	

    	$insert=$this->db->insert('user_transaction_history',$transaction);
		if($insert){
		$this->session->set_flashdata('money_add','<span style="position: relative; ">Hurray You had Added Rs'. $response['data']['transaction']['order']['gross_amount'] .'</span>');
		add_money_wallet($response['data']['transaction']['order']['gross_amount'],$this->session->userdata('userinsertId'));
		redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));
		}
								
    } else {
    	$this->session->set_flashdata('money_add_fail','<span style="position: relative; ">Sorry Payment Not complete'. $response['data']['transaction']['order']['gross_amount'] .'</span>');
     		redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));
    }
}

}


public function failedPayment() {


require 'src/Payment.php';
require 'src/Crypto.php';
require 'src/Validator.php';


$obj = new \Paykun\Checkout\Payment(PAYKUN_MERCHANT_MID, ﻿Access_Token , API_Secret, false, true);
$response = $obj->getTransactionInfo($_REQUEST['payment-id']);

echo "<pre>";
var_dump($response);

if(is_array($response) && !empty($response)) {
    if($response['status'] && $response['data']['transaction']['status'] == "Failed") {
        $this->session->set_flashdata('money_add_fail','<span style="position: relative; ">Sorry Payment Not complete'. $response['data']['transaction']['order']['gross_amount'] .'</span>');
     		redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));
    }
}



}


}