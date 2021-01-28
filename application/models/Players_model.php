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





    }



