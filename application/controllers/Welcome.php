<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once(APPPATH."libraries/lib/encdec_paytm.php");

// include 'libraries/lib/encdec_paytm.php';

class Welcome extends CI_Controller {
   public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->library('encdec_paytm');

	}

	public function index()
	{
		//$this->load->view('welcome_message');
		 $this->load->view('homepage');
	}

	public function register()
	{
		$this->load->view('userRegi');
		 
	}	


    /**
        ===========================================================
        Operation   :   Register uses
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   redirect to dashboard
        ===========================================================
    **/

	public function signup_user()
	{
		if(isset($_POST['user_register'])) {
			$uname=$this->input->post('uname');
			$whatsapp=$this->input->post('whatsapp');
			$email=$this->input->post('email');
			$psw=enCryptData($this->input->post('psw'));
			$cpwd=enCryptData($this->input->post('cpwd'));
			$refferal=$this->input->post('refferal');
			

			$isertUser=array(
				'user_name'=>$uname,
				'whatsapp_num'=>$whatsapp,
				'email'=>$email,
				'password'=>$psw,
				'refferal'=>$refferal
				);			

			if($psw==$cpwd){
				$this->db->select('*');
				$this->db->from('players');
				$this->db->where('whatsapp_num',$whatsapp);
				$que=$this->db->get();
				$row = $que->num_rows();
				// print_r($row);
				// die();
				if($row) {
					$this->session->set_flashdata('error_msg_signup_user', '<span id="signupMsg" style="position: relative; top: -7px; color:red">This Whatsapp Number already exists</span>');
					// $data['error']='<span id="signupMsg" style="position: relative; top: -7px; color:red">This Whatsapp Number already exists</span>';
				} else {
					$this->db->insert('players',$isertUser);
					$insertId = $this->db->insert_id();
					// $que1=$this->db->query("select * from company where email='".$e."' and password ='".$p."'");
					// $result = $que1->row_array();
					
					$this->session->set_flashdata('success_msg', 'Your account created successfully');
					$this->session->set_userdata('isUserLogin',TRUE);
		            $this->session->set_userdata('whatsapp',$whatsapp);
		            $this->session->set_userdata('username',$uname);
		            $this->session->set_userdata('userinsertId',$insertId);


		            
				 //    $to  =  $e;
					// $data['name'] = $company_name;
					// $data['email'] = $to;
					// $message = $this->load->view('emails/comp_welcome_email',$data,TRUE);
					
					// $headers = 'From:noreply@internmart.com' . "\r\n";
					// $subject = $company_name.', Welcome to InternMart.com';
					// $sendmail = send_mails($to, $subject, $message, $headers);

					redirect('welcome/userprofile/'.$this->session->userdata('userinsertId')); 
					// redirect('company/profile'); 
				}
						
			}else{
				$this->session->set_flashdata('error_msg_signup_user', '<span id="signupMsg" style="position: relative; top: -7px; color:red">Password & Confirm Password Not Matched</span>');
				$data['error']="<span style='color:red'>Password & Confirm Password Not Matched</span>";


			}
		}
		
		//redirect('student/signup',@$data); 
		// $this->load->view('login',@$data);
		return redirect('register#signup');
	}



  /**
        ===========================================================
        Operation   :   login auth
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   true or false
        ===========================================================
    **/


public function login_chk(){
		if(isset($_POST['login']))
		{
		$whatsapp=$this->input->post('whatsapp');
		$psw=enCryptData($this->input->post('psw'));

				$whereCodtion=array(
					'whatsapp_num'=>$whatsapp,
					'password'=>$psw
				);
				// get user data
				$this->db->select('*');
				$this->db->from('players');
				$this->db->where($whereCodtion);
				$que=$this->db->get();
				$row = $que->num_rows();

				
			if($row)
				{

				$result = $que->row_array();
				if ( $result['status'] == 0 ) {
					$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="position: relative; top: -7px; color:red">Your account is Inactive.</span>');
					redirect('register#login');
					return 1;
				}
				
           	$this->session->set_userdata('isUserLogin',TRUE);
		    $this->session->set_userdata('whatsapp',$whatsapp);
		    $this->session->set_userdata('username',$result['user_name']);
		    $this->session->set_userdata('userinsertId',$result['uid']);

             redirect('welcome/userprofile/'.$this->session->userdata('userinsertId')); 
			}
			else
			{
			$data['error']="<span style='color:red'>Wrong User Password</span>";
			//$this->load->view('Website/login',@$data);
			$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="position: relative; top: -7px; color:red">Wrong User Password</span>');
			}	
			
		}
		redirect('register#login');
	}

			public function auth_login(){
			    if($this->session->userdata('isUserLogin')){
			        //retunt "true";
			         }
			             else{
			                 redirect('register#signup');
			                
			             }
			 }




  /**
        ===========================================================
        Operation   :   login auth
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   true or false
        ===========================================================
    **/

			public function userprofile()
			{
				$this->auth_login();
				$data=array();
				$data['users'] = $this->Players_model->user_profile($this->session->userdata('userinsertId'));
				// $this->load->view('user_dashboard');
				$this->load->view('user_dashboard',@$data);

			}

/**
        ===========================================================
        Operation   :   logout
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   logout the user
        ===========================================================
    **/
	public function logout()
	{
		$this->session->unset_userdata('isUserLogin');
		$this->session->unset_userdata('userinsertId');
		$this->session->sess_destroy();
		redirect('/');
	}



/**
        ===========================================================
        Operation   :   paytm payment checkout page
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   load ui to add money
        ===========================================================
    **/

			public function paytmCheckOutPage()
			{
				$this->auth_login();
				$this->load->view('Paytm/transaction');
			}


/**
        ===========================================================
        Operation   :   paytm payment redirect page
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   load ui to add money
        ===========================================================
    **/


			public function paytmRedirect()
			{
					$this->auth_login();
					header("Pragma: no-cache");
					header("Cache-Control: no-cache");
					header("Expires: 0");
					$checkSum = "";
					$paramList = array();
					$data=array();

			if(isset($_POST['load_amt'])) {
						
					$ORDER_ID =$this->input->post('ORDER_ID');
					$CUST_ID = $this->input->post('CUST_ID');
					$INDUSTRY_TYPE_ID = $this->input->post('INDUSTRY_TYPE_ID');
					$CHANNEL_ID =$this->input->post('CHANNEL_ID');
					$TXN_AMOUNT = $this->input->post('TXN_AMOUNT');

					// Create an array having all required parameters for creating checksum.
					$paramList["MID"] = PAYTM_MERCHANT_MID;
					$paramList["ORDER_ID"] = $ORDER_ID;
					$paramList["CUST_ID"] = $CUST_ID;
					$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
					$paramList["CHANNEL_ID"] = $CHANNEL_ID;
					$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
					$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
					$paramList["CALLBACK_URL"] = base_url()."welcome/transactionStatus/".$this->session->userdata('userinsertId');;

					/*
					$paramList["CALLBACK_URL"] = "http://localhost/PaytmKit/pgResponse.php";
					$paramList["MSISDN"] = $MSISDN; //Mobile number of customer
					$paramList["EMAIL"] = $EMAIL; //Email ID of customer
					$paramList["VERIFIED_BY"] = "EMAIL"; //
					$paramList["IS_USER_VERIFIED"] = "YES"; //

					*/

					//Here checksum string will return by getChecksumFromArray() function.
					$checkSum = $this->encdec_paytm->getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

					$data['paramList']=$paramList;
					$data['checkSum']=$checkSum;
					$this->load->view('Paytm/paytmRedirect',$data);
				}

			}

/**
        ===========================================================
        Operation   :   paytm payment transcation status 
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   get transacton status 
        ===========================================================
    **/


	public function transactionStatus()
	{
		$this->auth_login();
		print_r($this->session->userdata('userinsertId'));
			$paytmChecksum = "";
			$paramList = array();
			$isValidChecksum = "FALSE";

			$paramList = $_POST;
			$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

			//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application’s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
			$isValidChecksum = $this->encdec_paytm->verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.


			if($isValidChecksum == "TRUE") {
				echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
				if ($_POST["STATUS"] == "TXN_SUCCESS") {
					// echo "<b>Transaction status is success</b>" . "<br/>";

					$this->session->set_flashdata('money_add','<span style="position: relative; top: -7px; ">Hurray You had Added Rs'. $_POST['TXNAMOUNT'] .'</span>');
					//Process your transaction here as success transaction.
					//Verify amount & order id received from Payment gateway with your application's order id and amount.
					$this->Players_model->add_money_wallet($_POST['TXNAMOUNT'],$this->session->userdata('userinsertId'));

				}
				else {
					// echo "<b>Transaction status is failure</b>" . "<br/>";

					$this->session->set_flashdata('money_add_fail','<span style="position: relative; top: -7px;">Sorry Your Payment Failed</span>');
				}

				if (isset($_POST) && count($_POST)>0 )
				{ 
					$transaction=array('userId'=>$this->session->userdata('userinsertId'));
					foreach($_POST as $paramName => $paramValue) {
						$transaction[$paramName]=$paramValue;
							echo "<br/>" . $paramName . " = " . $paramValue;
					}

						$this->db->insert('user_transaction_history',$transaction);
						redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));
						}
				

			}
			else {
				echo "<b>Checksum mismatched.</b>";
				//Process transaction as suspicious.
			}
	}



/**
        ===========================================================
        Operation   :   edit user
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :   get transacton status 
        ===========================================================
    **/


public function edit_user()
	{
		
	if(isset($_POST['edit_data'])) {
		
			$uname=$this->input->post('uname');
			$whatsapp=$this->input->post('whatsapp');
			$email=$this->input->post('email');	

			$isertUser=array(
				'user_name'=>$uname,
				'whatsapp_num'=>$whatsapp,
				'email'=>$email,
				);			

					$this->db->update('players',$isertUser);
					$this->db->where('uid',$this->session->userdata('userinsertId'));
					$this->session->set_flashdata('success_msg', 'Your account is Updated');

					redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));  
				}
		return redirect('register');
	}



		public function emailTesting()
		{
			
		// 	$to  =  $res->email;
		// 	$message = $this->load->view('emails/password_change_email', $data, TRUE);
		// 	$headers = 'From:noreply@internmart.com' . "\r\n";
		// 	$subject =  $res->name . ', your password was successfully reset';
		// 	$sendmail = send_mails($to, $subject, $message, $headers);.
		// }

			$to  =  'ajaysah531@gmail.com';
			$message = 'hello I was testing';
			$headers = 'From:admin@ludobattles.com';
			$subject =  'Test MAil';
			$sendmail = send_mails($to, $subject, $message, $headers);


			
		}


		public function forgetPassword() {

		if (isset($_POST['forget'])) {
			$this->db->select('*');
			$this->db->where('email', $this->input->post('email'));
			$query = $this->db->get('players');

			if ($query->num_rows() == 0) {
				$data['error'] = "<span style='color:red'>Email Not found in our record.</span>";
				//redirect('student/forgetPassword'); 
				$this->session->set_flashdata('error_msg_forget', '<span id="forgetMsg" style="position: relative; top: -7px; color:red">Email Not found in our record.</span>');
			} else {

				$res = $query->row();
				$data['name'] = $res->user_name;
				$data['email'] = $res->email;
				$to  =  $res->email;
				$message = $this->load->view('emails/forget_email', $data, TRUE);

				$headers = 'From:admin@ludobattles.com' . "\r\n";
				$subject = 'Reset Your ludobattles.com Password';
				$sendmail = send_mails($to, $subject, $message, $headers);
				if ($sendmail) {
					$data['error'] = "<span style='color:green'>Email Sent to you. Please check and change your password.</span>";
					$this->session->set_flashdata('error_msg_forget', '<span id="forgetMsg" style="position: relative; top: -7px; color:green">Email Sent to you. Please check and change your password.</span>');
				} else {
					$data['error'] = "<span style='color:red'>An unknown error occurred while sending the email</span>";
					//redirect('student/forgetPassword'); 
					$this->session->set_flashdata('error_msg_forget', '<span id="forgetMsg" style="position: relative; top: -7px; color:red">An unknown error occurred while sending the email</span>');
				}
			}
		}

		return redirect('register#forget');
		// $this->load->view('Website/forget_password',@$data);

	}



	public function changePassword($id)
	{

		if ($this->input->post('email')) {
			$p = enCryptData($this->input->post('password'));
			$cp = enCryptData($this->input->post('cpassword'));
			if ($p == $cp) {

					$data1 = array('password' => $p);
					$this->db->where('email', $this->input->post('email'));
					$this->db->update('players', $data1);

					$this->db->select('*');
					$this->db->where('email', $this->input->post('email'));
					$query = $this->db->get('players');
					$res = $query->row();
					$data['name'] = $res->user_name;

				$to  =  $res->email;
				$message = $this->load->view('emails/password_change_email', $data, TRUE);
				$headers = 'From:noreply@internmart.com' . "\r\n";
				$subject =  $res->user_name . ', your password was successfully reset';
				$sendmail = send_mails($to, $subject, $message, $headers);
				if ($sendmail) {

						$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="color:green; position: relative; top: -5px;">Password has been Changed. Please login.</span>');
						redirect('register#login');
					// if ($type == "company") {
					// 	$this->session->set_flashdata('error_msg_signin', '<span id="forgetMsg" style="position: relative; top: -7px; color:green">Password has been Changed. Please login.</span>');
					// 	return redirect('company/accountEmp#sigin');
					// }
				}
			} else {

				$data['error'] = "<span style='color:red'>Password & Confirm Password Not Matched</span>";
				$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="color:green; position: relative; top: -5px;">Password & Confirm Password Not Matched</span>');
						redirect('register#login');
			}
		}
		$data['email'] = base64_decode($id);
		$this->load->view('changePassword', @$data);
	}




}