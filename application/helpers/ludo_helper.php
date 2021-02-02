<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


function encp_val($token){
 //$token = "The quick brown fox jumps over the lazy dog.";

  $cipher_method = 'aes-128-ctr';
  $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
  $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($cipher_method));
  $crypted_token = openssl_encrypt($token, $cipher_method, $enc_key, 0, $enc_iv) . "-" . bin2hex($enc_iv);
  return $crypted_token;
}

function dcrp_val($crypted_token){
 list($crypted_token, $enc_iv) = explode("-", $crypted_token);;
  $cipher_method = 'aes-128-ctr';
  $enc_key = openssl_digest(php_uname(), 'SHA256', TRUE);
  $token = openssl_decrypt($crypted_token, $cipher_method, $enc_key, 0, hex2bin($enc_iv));
  return $token;
}



/**
 * This function used to deCryptData.
 * @param {array} view data.
 */
if(!function_exists('deCryptData'))
{
    function deCryptData($sData)
    {
        $url_id = base64_decode($sData);
        return (double)$url_id/6752415;
    }
}

/**
 * This function used to enCryptData.
 * @param {array} view data.
 */
if(!function_exists('enCryptData'))
{
    function enCryptData($sData)
    {
        $id = (double)$sData*6752415;
        return base64_encode($id);
    }
}


/**
 * This function used to send mail.
 * @param {array} view data.
 */

function send_mails($to,$subject,$message,$headers,$cc='',$bcc='',$filetoattach=''){

    $CI = get_instance();
    try{

        if (MAIL_METHOD == 'server1') {
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $sendmail = mail($to, $subject, $message, $headers);
            
            if ($sendmail) {
                return true;
            }else{
                return false;
            }
            exit();
        }else{
            if(PROTOCOL=='smtp'){

                $config = Array(
                    'protocol' =>  PROTOCOL,
                    'smtp_host' => SMTP_HOST,
                    'smtp_port' => SMTP_PORT,
                    'smtp_user' => SMTP_USER,
                    'smtp_pass' => SMTP_PASS,
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1',
                    'wordwrap'=> true,
                );
                
                $CI->load->library('email', $config);
            }else{  
                $CI->load->library('email');
            }   
            $CI->email->set_newline("\r\n");
            $CI->email->from(EMAIL_FROM, 'LudoBattles');
            $CI->email->to($to); 
            $CI->email->subject($subject);
            $CI->email->message($message);

            if( !empty($filetoattach) ) {
                $CI->email->attach($filetoattach);
            }
            $CI->email->set_mailtype("html");

            if( $CI->email->send() ) {
              
                return true;
            }else {
                return false;
                return show_error($CI->email->print_debugger());
            }
        }
    }catch( Exception $e ){}
}


/**
 * This function used to getUserName Bu passing Id.
 * @param {array} view data.
 */
if(!function_exists('getUserName'))
{
    function getUserName($user_id)
    {
        $CI =& get_instance();
        $CI->db->select('user_name');
        $CI->db->from('players');
        $CI->db->where('uid', $user_id);
        $user=$CI->db->get()->result_array();
        return $user[0]['user_name'];
    }
}



/**
 * This function used to add_money_wallet of user by taking there id.
 * @param {array} view data.
 */
if(!function_exists('add_money_wallet'))
{
    function add_money_wallet($money,$user_id)
    {
        $CI =& get_instance();
        $CI->db->select('money_wallet');
        $CI->db->from('players');
        $CI->db->where('uid', $user_id);
        $user_wallet_monet=$CI->db->get()->row_array();
        $current_money=$user_wallet_monet['money_wallet']+$money;

        $updateValue=array(
            'money_wallet'=>$current_money
        );
       $CI->db->where('uid', $user_id);
       $CI->db->update('players',$updateValue);        
    }
}



/**
 * This function used to subtract_money_wallet of user by taking there id.
 * @param {array} view data.
 */
if(!function_exists('sub_money_wallet'))
{
    function sub_money_wallet($money,$user_id)
    {
        $CI =& get_instance();
        $CI->db->select('money_wallet');
        $CI->db->from('players');
        $CI->db->where('uid', $user_id);
        $user_wallet_monet=$CI->db->get()->row_array();
        $current_money=$user_wallet_monet['money_wallet']-$money;

        $updateValue=array(
            'money_wallet'=>$current_money
        );
       $CI->db->where('uid', $user_id);
       $CI->db->update('players',$updateValue);    
       return true;    
    }


// /**
//  * This function used to get all requested matches by user
//  * @param {array} view data.
//  */
// if(!function_exists('requested_matches'))
// {
//     function requested_matches($Play_request_by )
//     {
//         $CI =& get_instance();
//         $CI->db->select('*');
//         $CI->db->from('play_matche_details');
//         $CI->db->where('Play_request_by', $Play_request_by);   
//         return $CI->db->get()->result_array();   
//     }

// }


// /**
//  * This function used to get all requested matches by user
//  * @param {array} view data.
//  */
// if(!function_exists('recived_request_Matches'))
// {
//     function recived_request_Matches($Match_Set_By)
//     {
//             $whereCondition=array(
//                 'Match_Set_By'=>$Match_Set_By,
//                 'status'=>1
//             );
//         $reqMatId=array(); 
//         $CI =& get_instance();
//         $CI->db->select('Match_id');
//         $CI->db->from('play_matche_details');
//         $CI->db->where($whereCondition);   
//        $req= $CI->db->get()->result_array();
//         foreach ($req as $match) {
//                         $reqMatId[]=$match['Match_id'];
//                       }  
//         return $reqMatId;
//     }

// }

// /**
//  * This function used to get all requested matches by user
//  * @param {array} view data.
//  */
// if(!function_exists('requested_status'))
// {
//     function requested_status($Match_id)
//     {
//             $whereCondition=array(
//                 'Match_id'=>$Match_id,
//             );
//         $reqMatId=array(); 
//         $CI =& get_instance();
//         $CI->db->select('status');
//         $CI->db->from('play_matche_details');
//         $CI->db->where($whereCondition);   
//        $req= $CI->db->get()->row_array();
//         return $req['status'];
//     }

// }

}