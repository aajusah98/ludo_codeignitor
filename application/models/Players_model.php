<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Players_model extends CI_Model{
    




public function user_profile($id="")
{
	    $this->db->select('*');
        $this->db->from('players');
        $this->db->where('uid', $id );
        return $this->db->get()->row_array();
}

public function add_money_wallet($money,$id)
{

	$this->db->select('money_wallet');
	$this->db->from('players');
	$this->db->where('uid', $id);
	$user_wallet_monet=$this->db->get()->row_array();
	$current_money=$user_wallet_monet['money_wallet']+$money;

	$updateValue=array(
		'money_wallet'=>$current_money
	);
	$this->db->where('uid', $id);
	$this->db->update('players',$updateValue);
}



		public function get_tranHistory($id)
		{
		
		$this->db->select('ORDERID,TXNID,TXNAMOUNT,PAYMENTMODE,TXNDATE,STATUS,payment_type');
		$this->db->from('user_transaction_history');
		$this->db->where('userId', $id);
		return $this->db->get()->result_array();


		}


public function set_match_details($uid)
{
	 $this->db->select('*');
     $this->db->from('match_details');
     $this->db->where('Match_SetBy', $uid );
     return $this->db->get()->result_array();
}

	
public function all_match_details()
{
	 $this->db->select('*');
     $this->db->from('match_details');
     return $this->db->get()->result_array();
}



    }



