<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Players_model extends CI_Model{
    




public function user_profile($id) {
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

		
	public function all_match_details() {
		 $this->db->select('*');
	     $this->db->from('match_details');
	     return $this->db->get()->result_array();
	}


	public function getMatche($mid) {
		 $this->db->select('*');
	     $this->db->from('match_details');
	     $this->db->where('M_id',$mid);
	     return $this->db->get()->row_array();
	}

public function getMatcheResult($mid,$Uid)
{
	$whereCondition=array(
		'match_id'=>$mid,
		'Result_updated_by'=>$Uid
		);

		$this->db->select('*');
	     $this->db->from('match_result');
	     $this->db->where($whereCondition);
	     return $this->db->get()->row_array();
}

   

public function get_withdrawal_tranHistory($id)
		{
		
		$this->db->select('*');
		$this->db->from('withdrawal_request');
		$this->db->where('USR_ID', $id);
		return $this->db->get()->result_array();


		}


public function get_all_withdrawal_request()
		{
		
		$this->db->select('*');
		$this->db->from('withdrawal_request');
		return $this->db->get()->result_array();


		}


  public function update_status($tbl, $id, $status)
    {
        if ($tbl == 'withdrawal_request') {
            $data['status'] = $status;
            $this->db->where('withdrawal_id', $id);
            $this->db->update($tbl, $data);
        } 
        //     $data['status'] = $status;
        //     $this->db->where('id', $id);
        //     $this->db->update($tbl, $data);
    	    // }
    	
    	if ($tbl == 'players') {
            $data['status'] = $status;
            $this->db->where('uid', $id);
            $this->db->update($tbl, $data);
        }

    }

    public function get_all_users() {
    	$this->db->select('*');
		$this->db->from('players');
		return $this->db->get()->result_array();
    }


public function allreferralEarning($id){

		$this->db->select('*');
		$this->db->from('refferal_earning');
		$this->db->where('referrer_owner',$id);
		return $this->db->get()->result_array();
	}

public function get_all_match_result() {
	
		$this->db->select('*');
		$this->db->from('match_result');
		return $this->db->get()->result_array();
}


   }



