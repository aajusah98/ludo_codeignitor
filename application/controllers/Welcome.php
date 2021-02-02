<?php
defined('BASEPATH') OR exit('No direct script access allowed');


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
								add_money_wallet($_POST['TXNAMOUNT'],$this->session->userdata('userinsertId'));

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

								$this->db->where('uid',$this->session->userdata('userinsertId'));
								$this->db->update('players',$isertUser);
								$this->session->set_flashdata('success_msg', 'Your account is Updated');

								redirect('welcome/userprofile/'.$this->session->userdata('userinsertId'));  
							}
					return redirect('register');
				}


	/**
        ===========================================================
        Operation   :   forgetpassword fun use to send email to user
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      :  email send
        ===========================================================
    **/


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

			}


	/**
        ===========================================================
        Operation   :   changePassword function to change psw
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : send conformation email
        ===========================================================
    **/

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

	/**
        ===========================================================
        Operation   :   changePassword function to change psw
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : send conformation email
        ===========================================================
    **/ 

        	public function transactionHistory()
        	{
        		$this->auth_login();
        		$data=array();
        		$data['transaction']=$this->Players_model->get_tranHistory($this->session->userdata('userinsertId'));

        		$this->load->view('trabsaction_history',$data);
        		
        	}


/**
        ===========================================================
        Operation   :   lets paly ludo page
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : load lets play ludo page
        ===========================================================
    **/

        	public function letsPlayLudo()
        	{
        		$this->auth_login();
        		 $data=array();
        		// $data['transaction']=$this->Players_model->get_tranHistory($this->session->userdata('userinsertId'));
        		 $data['users'] = $this->Players_model->user_profile($this->session->userdata('userinsertId'));
        		  $data['setMatches'] = $this->Players_model->set_match_details($this->session->userdata('userinsertId'));
        		   $data['allMatches'] = $this->Players_model->all_match_details();
        		$this->load->view('ludo_play',$data);
        		
        	}
/**
        ===========================================================
        Operation   :   add match detatils to database
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : return true
        ===========================================================
    **/ 

        	public function addMatch()
        	{
    			if (!empty($this->input->post('user_id'))) {
    				 $user_id = $this->input->post('user_id');
    				 $this->session->set_userdata('matchSetUser',TRUE);
			   		$betAmount = $this->input->post('betAmount');
						

			 	  	// subtract amout of money which has been set as bet
					sub_money_wallet($betAmount,$user_id);
    			


				// Match_Status meaning of interger
				//  1--->bethasbeenset
				//  0->bet chancled

    			$insertMatch=array(
    				'Match_SetBy'=>$user_id,
    				'Bet_Amount'=>$betAmount,
    				'Match_Status'=>1
    			);

    			$insert=$this->db->insert('match_details',$insertMatch);

    			if ($insert) {
    				$result=array(
							"status" => 'matchinserted',
							"msg" => 'Challange has been Set',
							"match_id"=>$this->db->insert_id()
							);
    					header('Content-Type: application/json');
						return print_r( json_encode($result) );
    			}

    		}


        		// $data['transaction']=$this->Players_model->get_tranHistory($this->session->userdata('userinsertId'));
        		
        	}


public function cancleMatch()
{
	if (!empty($this->input->post('cancleMoney'))) {
    	 $cancleMoney = $this->input->post('cancleMoney');
		 $match_id = $this->input->post('match_id');
		 $can_match_id = substr(strrchr($match_id, '-'), 1); 
		 $Match_Set_By=$this->input->post('Match_Set_By');

		 add_money_wallet($cancleMoney, $Match_Set_By);

		 	$updateMatch=array(
    				'Match_Status'=>0
    			);
				$this->db->where('M_id',$can_match_id);
		 		$this->db->update('match_details',$updateMatch);

				// print_r($this->db->update('match_details',$updateMatch));
				// die();

				// if ($update) {
    				$result=array(
							"status" => 'matchUpdate',
							"msg" => 'Match Status is Updated',
							"can_match_id"=> $can_match_id 
							);
    					header('Content-Type: application/json');
						return print_r( json_encode($result) );
    			// }
			   	}


}

/**
        ===========================================================
        Operation   :   add play match detatils to database
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : return true
        ===========================================================
    **/ 
       public function sendMatchRequest()
        	{
    			if (!empty($this->input->post('Match_SetBy'))) {
    				 $Match_SetBy = $this->input->post('Match_SetBy');
			   		 $reqst_SentBy = $this->input->post('reqst_SentBy');
			   		 $Bet_Amount = $this->input->post('Bet_Amount');
			   		 $M_id = $this->input->post('M_id');


				// Match_Status meaning of interger
				//  1--->bethasbeenset
				//  0->bet chancled

    				$insertMatch=array(
    				'Match_Set_By'=>$Match_SetBy,
    				'Play_request_by'=>$reqst_SentBy,
    				'Bet_Amt'=>$Bet_Amount,
    				'Match_id'=>$M_id,
    				'status'=>1
    					);

    				$updatMatchTable=array(
    					'match_requested'=>1,
    					'play_requested_By'=>$reqst_SentBy
    					);

    				$whereCodtion=array(
								'M_id'=>$M_id
							);
						
    						$insert=$this->db->insert('play_matche_details',$insertMatch);
    						sub_money_wallet($Bet_Amount,$reqst_SentBy);

    			if ($insert) {
    				$result=array(
							"status" => 'Match is Updated',
							"msg" => 'Playing Request has been sent'
							);
    					$this->db->where($whereCodtion);
		 				$this->db->update('match_details',$updatMatchTable);
    					header('Content-Type: application/json');
						return print_r( json_encode($result) );
    			}

    		}
        		
        	}

/**
        ===========================================================
        Operation   :   cancle match request by who is requesting
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : update status
        ===========================================================
    **/ 

public function cancleMatchRequest()
{
	if (!empty($this->input->post('M_id'))) {
			 $reqst_SentBy = $this->input->post('reqst_SentBy');
			 $Bet_Amount = $this->input->post('Bet_Amount');
			 $M_id = $this->input->post('M_id');
				
				$whereCodtion=array(
								'M_id '=>$M_id
							);


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 	
// +			match_requested--> field which store status of reuested match 		 																			  	
// +-------------------------------------------------------------------------------- 	                                                                             +
// +			        
// +				0-> no one requested at                                          +
// +				1-> somone requested match                                       +
// +				2-> requested is conformed ready to play                         +
// +                                                                                +
// +                                                                                + 
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 	
// + play_requested_By--> field which store id of user who is requestion for match		 																			  	
// +-------------------------------------------------------------------------------- 	 


				$updateStatus=array(
    						'match_requested'=>0,
    						'play_requested_By'=>0
    					);

						$this->db->where($whereCodtion);
		 				$this->db->update('match_details',$updateStatus);
					add_money_wallet($Bet_Amount, $reqst_SentBy);
			}
		}

public function AcceptMatch()
{
	


// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ 	
// match_accept_status--> field which store status of match accepted or not by owner of match 		 																			  	
// +-------------------------------------------------------------------------------- 	                                                                           			 +
// +			        
// +				0-> not accepted                        		                 +
// +				1-> accept                                      				+
// +														                         +
// +                                                                                +
// +                                                                                + 
// ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


	if (!empty($this->input->post('M_id'))) {
			 $requested_matches = $this->input->post('requested_matches');
			 $M_id = $this->input->post('M_id');
				
				$whereCodtion=array(
								'M_id '=>$M_id
							);

				$updateStatus=array(
    						'match_accept_status'=>1,
    						'match_requested'=>2
    					);

						$this->db->where($whereCodtion);
		 				$this->db->update('match_details',$updateStatus);
			}


}

public function RejectMatch()
{
if (!empty($this->input->post('M_id'))) {
			 $M_id = $this->input->post('M_id');
				
				$whereCodtion=array(
								'M_id '=>$M_id
							);

				$updateStatus=array(
    						'match_accept_status'=>0,
    						'play_requested_By'=>0,
    						'match_requested'=>0

    					);

						$this->db->where($whereCodtion);
		 				$this->db->update('match_details',$updateStatus);
			}

}


}