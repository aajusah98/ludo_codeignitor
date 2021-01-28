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