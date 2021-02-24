<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {
   public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->helper('url');
	$this->load->library('encdec_paytm');
	$this->load->helper('date');

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
					$refferal=$this->input->post('referral');
					

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
							$insertActivity=array(
					    		'player_id'=>$insertId,
					    		'last_activity'=>strtotime("now")+10
					    	);
					    	$this->db->insert('players_login_deatils',$insertActivity);
					    	$login_id = $this->db->insert_id();
					    	$this->session->set_userdata('login_id',$login_id);
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

					    	$insertActivity=array(
					    		'player_id'=>$result['uid'],
					    		'last_activity'=>strtotime("now")+10
					    	);
					    	$this->db->insert('players_login_deatils',$insertActivity);
					    	$login_id = $this->db->insert_id();
					    	$this->session->set_userdata('login_id',$login_id);

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
				$this->session->unset_userdata('isadminLogin');
				$this->session->sess_destroy();
				redirect('/');
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
			public function admin_logout()
			{
				$this->session->unset_userdata('isadminLogin');
				$this->session->sess_destroy();
				redirect('admin');
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
								$transaction=array('userId'=>$this->session->userdata('userinsertId'),'payment_type'=>"Added To Wallet");
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

        		$this->load->view('transaction_history',$data);
        		
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

    				// $insertMatch=array(
    				// 'Match_Set_By'=>$Match_SetBy,
    				// 'Play_request_by'=>$reqst_SentBy,
    				// 'Bet_Amt'=>$Bet_Amount,
    				// 'Match_id'=>$M_id,
    				// 'status'=>1
    				// 	);

    				$updatMatchTable=array(
    					'match_requested'=>1,
    					'play_requested_By'=>$reqst_SentBy
    					);

    				$whereCodtion=array(
								'M_id'=>$M_id
							);
			
					$this->db->where($whereCodtion);
		 			$this->db->update('match_details',$updatMatchTable);
    				sub_money_wallet($Bet_Amount,$reqst_SentBy);

    				$result=array(
							"status" => 'Match is Updated',
							"msg" => 'Playing Request has been sent'
							);
    					header('Content-Type: application/json');
						return print_r( json_encode($result) );

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


/**
        ===========================================================
        Operation   :   accept match reuest
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : update status
        ===========================================================
    **/ 



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



/**
        ===========================================================
        Operation   :   reject match reuest
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : update status
        ===========================================================
    **/ 



public function RejectMatch()
{
if (!empty($this->input->post('M_id'))) {
			 $M_id = $this->input->post('M_id');
				$this->db->select('*');
				$this->db->from('match_details');
				$this->db->where('M_id',$M_id);
				$res=$this->db->get()->row_array();
				$play_requested_By=$res['play_requested_By'];
				$betAmount=$res['Bet_Amount'];	
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
		 				add_money_wallet($betAmount, $play_requested_By);
			}

}


/**
        ===========================================================
        Operation   :   match details
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : update status
        ===========================================================
    **/ 



public function matchDetails($mid){
		$this->auth_login();
		$data=array();
		$data['match']=$this->Players_model->getMatche($mid);
		$data['match_result']=$this->Players_model->getMatcheResult($mid,$this->session->userdata('userinsertId'));
		$this->load->view('ludo_details',$data);

}

/**
        ===========================================================
        Operation   :   update user activity in every 3 sec
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : update time
        ===========================================================
    **/ 


public function update_user_activity() {

	if(isset($_POST["action"])) {
		 if($_POST["action"] == "update_time") {
		 	$updateData=array(
		 	'last_activity'  => $current_timestamp = strtotime("now")+10,
		    'login_details_id' => $this->session->userdata('login_id')
		 	);
		 	$this->db->where('login_details_id',$this->session->userdata('login_id'));
		 	$this->db->update('players_login_deatils',$updateData);
		}
	 }


}


/**
        ===========================================================
        Operation   :   fetch online users
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : number of user active
        ===========================================================
    **/ 

			public function fetch_user_login_data() {
				
				if($_POST["update"]) {
				 	if ($_POST['update']=='fetch_data') {
						$current_timestamp = strtotime("now");
				 		$this->db->select('*');
				 		$this->db->from('players_login_deatils');
				 	   	$this->db->where("last_activity > $current_timestamp", NULL, FALSE);
					    $activeUser = $this->db->get()->num_rows();
					    print_r($activeUser);
						}
					}
			}




/**
        ===========================================================
        Operation   :   fetch online users
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : number of user active
        ===========================================================
    **/ 

			public function fetch_all_user() {
				
				if($_POST["update"]) {
				 	if ($_POST['update']=='fetch_data') {
				 		$this->db->select('*');
				 		$this->db->from('players');
					    $activeUser = $this->db->get()->num_rows();
					    print_r($activeUser);
						}
					}
			}

/**
        ===========================================================
        Operation   :   fetch online users
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : number of user active
        ===========================================================
    **/ 

			public function fetch_all_matches() {
				
				if($_POST["update"]) {
				 	if ($_POST['update']=='fetch_data') {
				 		$this->db->select('*');
				 		$this->db->from('match_details');
					    $activeUser = $this->db->get()->num_rows();
					    print_r($activeUser);
						}
					}
			}

/**
        ===========================================================
        Operation   :  termand Condition
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : Display Term And Condition
        ===========================================================
    **/ 


			public function termCondition(){
						
				$this->load->view('term_condition');
				}	



/**
        ===========================================================
        Operation   :  termand Condition
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : termand Condition
        ===========================================================
    **/ 


			public function refundPolicy(){
						
				$this->load->view('Refund_and_Cancellation_Policy');
				}	


/**
        ===========================================================
        Operation   :  termand Condition
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : termand Condition
        ===========================================================
    **/ 


			public function term_condition_paytm(){
						
			$this->load->view('term_condition_paytm');
				}
/**
        ===========================================================
        Operation   :  privacy_policy
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : privacy_policy
        ===========================================================
    **/ 



				public function privacy_policy() {
					
					$this->load->view('privacy_policy');
				}



/**
        ===========================================================
        Operation   :  setRoomId
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : setRoomId for game
        ===========================================================
    **/ 		

			public function setRoomId()
			{

				if ($this->input->post('room_id')) {
					$room_id=$this->input->post('room_id');
					$Room_Creadted_By=$this->input->post('setBy');
					$match_id=$this->input->post('match_id');
					$this->db->select('*');
					$this->db->from('room_ids');
					$this->db->where('match_id',$match_id);
					$result=$this->db->get()->result_array();

					if ($result) {
						$updatetRoomId=array(
			 				'room_ID'=>$room_id,
			 				'Room_created_By'=>$Room_Creadted_By,
			 				'match_id'=>$match_id,
			 				'roomId_update_flag'=>1
						);
						$this->db->where('match_id',$match_id);
						$update=$this->db->update('room_ids',$updatetRoomId);

						if ($update) {
							$result=array(
										"status"=>'update',
										"msg" => 'Room Id Is Updated Wait Till Opponent'
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));
						}
					}
					else{
						$insertRoomId=array(
			 				'room_ID'=>$room_id,
			 				'Room_created_By'=>$Room_Creadted_By,
			 				'match_id'=>$match_id
						);

						$insert=$this->db->insert('room_ids',$insertRoomId);

						if ($insert) {

							$updatePlayingMatch=array(
								'play_status'=>1
							);
							$this->db->where('M_id',$match_id);
							$this->db->update('match_details',$updatePlayingMatch);
							
							$result=array(
										"status"=>'insert',
										"msg" => 'Room Id Is Created Wait Till Opponent'
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));
							
							$updatePlayingMatch=array(
								'play_status'=>1
							);
							$this->db->where('M_id',$match_id);
							$this->db->update('match_details',$updatePlayingMatch);	

						}


					}
						
					
				}
			}

/**
        ===========================================================
        Operation   :  CancelSetMatch
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : cancle set Match
        ===========================================================
    **/ 
			public function CancelSetMatch()
			{
				if ($this->input->post('cancel_reason')) {
						$cancel_reason=$this->input->post('cancel_reason');
						$Result_updated_by=$this->input->post('Result_updated_by');
						$match_id=$this->input->post('match_id');
						
						$insertRoomId=array(
			 				'Result_updated_by'=>$Result_updated_by,
			 				'match_id'=>$match_id,
			 				'cancle_status'=>'Cancle',
			 				'cancle_reason'=>$cancel_reason,
			 				'result_status'=>1

						);

						$insert=$this->db->insert('match_result',$insertRoomId);
						if ($insert) {
							$result=array(
										"result_status"=>1,
										"msg" => 'Result Is Updated'
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));
						}

					}

			}



/**
        ===========================================================
        Operation   :  lossMatchUpdate
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : loss match status
        ===========================================================
    **/ 
			public function lossMatchUpdate()
			{
				if ($this->input->post('Result_updated_by')) {

						$Result_updated_by=$this->input->post('Result_updated_by');
						$match_id=$this->input->post('match_id');
						
						$insertRoomId=array(
			 				'Loss_Status'=>'I Loss',
			 				'Result_updated_by'=>$Result_updated_by,
			 				'match_id'=>$match_id,
			 				'result_status'=>1

						);

						$insert=$this->db->insert('match_result',$insertRoomId);
						if ($insert) {
							$result=array(
										"result_status"=>1,
										"msg" => 'Result Is Updated'
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));
						}

					}
				}


/**
        ===========================================================
        Operation   :  winMatchUpdate
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : winMatchUpdate
        ===========================================================
    **/

		   function winMatchUpdate()  
		      {  

		      	if ($this->input->post('match_id')) {
		      	
		           if(isset($_FILES["image_file"]["name"]))   {  
		                $config['upload_path'] = './uploads/';  
		                $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
		                 $new_name = time() . "screenShot"; 
		                 $config['file_name'] = $new_name;
		                $this->load->library('upload', $config); 
		                $this->upload->initialize($config); 

		                if($this->upload->do_upload('image_file'))  {  
		          			$uploadData = $this->upload->data();
		         			 $myfile = $uploadData['file_name'];
		         			 $data['file_name'] = $myfile;
		       			 } else {
		          			$myfile = '';
		        					}
		             	}  
				      else {
				        $myfile = '';
				      	}
				              
		           	$match_id=$this->input->post('match_id');
		           	$Result_updated_by=$this->input->post('Result_updated_by');

		           	$insertRoomId=array(
		 				'win_status'=>'I Win',
		 				'Result_updated_by'=>$Result_updated_by,
		 				'match_id'=>$match_id,
		 				'screenshot_link'=>$myfile,
		 				'result_status'=>1
					);

					$insert=$this->db->insert('match_result',$insertRoomId);
					if ($insert) {
						$result=array(
									"result_status"=>1,
									"msg" => 'Result Is Updated'
									);
		    					header('Content-Type: application/json');
								return print_r(json_encode($result));
					}

		           	
		           }  
		      }

/**
        ===========================================================
        Operation   :  checkResultUpdate
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : checkResultUpdate
        ===========================================================
    **/

			public function checkResultUpdate() {

				if ($this->input->post('Match_SetBy')) {
					$Match_SetBy=$this->input->post('Match_SetBy');
					$play_requested_By=$this->input->post('play_requested_By');
					$match_id=$this->input->post('match_id');
					$loginUserId=$this->input->post('loginUserId');
					
					$seterResult=getMatcheResultAccUser($match_id,$Match_SetBy); 
					$playerResult=getMatcheResultAccUser($match_id,$play_requested_By);
					$match=$this->Players_model->getMatche($match_id);

				if (!empty($seterResult)&&!empty($playerResult)) {

								$updatedValue=array(
							'result_of_match'=>1,
							'play_status'=>2
							);		
							$this->db->where('M_id',$match_id);
							$this->db->update('match_details',$updatedValue);

							if ($seterResult['cancle_status']!=NULL&&$playerResult['cancle_status']!=NULL) {
									
									if ($loginUserId==$Match_SetBy) {
										add_money_wallet($match['Bet_Amount'],$Match_SetBy);

										$updateFlag=array(
											'paymet_check_flag'=>1
										);

										$whereCodtion=array(
											'match_id'=>$match_id,
											'Result_updated_by'=>$Match_SetBy
										);

										$this->db->where($whereCodtion);
										$this->db->update('match_result',$updateFlag);

										$result=array(
										"result_status"=>'cancle_match',
										"msg" => 'Match Has Been Cancled'.'Your Wallet Is Credited By Rs'.' '. $match['Bet_Amount']
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));
									}
									if ($loginUserId==$play_requested_By) {

										add_money_wallet($match['Bet_Amount'],$play_requested_By);
										$updateFlag=array(
											'paymet_check_flag'=>1
										);

										$whereCodtion=array(
											'match_id'=>$match_id,
											'Result_updated_by'=>$play_requested_By
										);

										$this->db->where($whereCodtion);
										$this->db->update('match_result',$updateFlag);

											$result=array(
										"result_status"=>'cancle_match',
										"msg" => 'Match Has Been Cancled'.'Your Wallet Is Credited By Rs'.' '. $match['Bet_Amount']
										);
			    					header('Content-Type: application/json');
									return print_r(json_encode($result));

									}
									
								}



		if ($seterResult['win_status']!=NULL&&$playerResult['win_status']!=NULL) {
					$updateFlag=array(
							'fault_result_flag'=>1
										);

				$whereCodtion=array(
					'match_id'=>$match_id,
					'Result_updated_by'=>$play_requested_By
				);

				$this->db->where($whereCodtion);
				$this->db->update('match_result',$updateFlag);


				$whereCodtion2MatchSeter=array(
					'match_id'=>$match_id,
					'Result_updated_by'=>$Match_SetBy
				);

				$this->db->where($whereCodtion2MatchSeter);
				$this->db->update('match_result',$updateFlag);	


			$result=array(
				"result_status"=>'win_win',
				"msg" => 'The Result is updated Win By Both Party Which Is Conflict Result Both Party Money Has been On Hold And Penality Will be Rs 50 Contact Admin For Solve Conflict'
				);
			header('Content-Type: application/json');
			return print_r(json_encode($result));
			
			}



			if ($seterResult['Loss_Status']!=NULL&&$playerResult['Loss_Status']!=NULL) {

					$updateFlag=array(
						'fault_result_flag'=>1
					);

					$whereCodtion=array(
						'match_id'=>$match_id,
						'Result_updated_by'=>$play_requested_By
					);

					$this->db->where($whereCodtion);
					$this->db->update('match_result',$updateFlag);


					$whereCodtion2MatchSeter=array(
						'match_id'=>$match_id,
						'Result_updated_by'=>$Match_SetBy
					);

					$this->db->where($whereCodtion2MatchSeter);
					$this->db->update('match_result',$updateFlag);	


				$result=array(
					"result_status"=>'loss_loss',
					"msg" => 'The Result is updated Loss By Both Party Which Is Conflict Result Both Party Money Has been On Hold And Penality Will be Rs 50 Contact Admin For Solve Conflict'
					);
				header('Content-Type: application/json');
				return print_r(json_encode($result));
				
			}



		if (($seterResult['win_status']!=NULL&&$playerResult['cancle_status']!=NULL) || ($seterResult['cancle_status']!=NULL&&$playerResult['win_status']!=NULL)) {

				$updateFlag=array(
						'fault_result_flag'=>1
					);

					$whereCodtion=array(
						'match_id'=>$match_id,
						'Result_updated_by'=>$play_requested_By
					);

					$this->db->where($whereCodtion);
					$this->db->update('match_result',$updateFlag);


					$whereCodtion2MatchSeter=array(
						'match_id'=>$match_id,
						'Result_updated_by'=>$Match_SetBy
					);

					$this->db->where($whereCodtion2MatchSeter);
					$this->db->update('match_result',$updateFlag);	


				$result=array(
					"result_status"=>'win_cancle',
					"msg" => 'The Result is updated Win And Cancle Which Is Conflict Result Both Party Money Has been On Hold And Penality Will be Rs 50 Contact Admin For Solve Conflict'
					);
				header('Content-Type: application/json');
				return print_r(json_encode($result));

			}

		if (($seterResult['Loss_Status']!=NULL&&$playerResult['cancle_status']!=NULL) || ($seterResult['cancle_status']!=NULL&&$playerResult['Loss_Status']!=NULL)) {
		
				$updateFlag=array(
							'fault_result_flag'=>1
						);

						$whereCodtion=array(
							'match_id'=>$match_id,
							'Result_updated_by'=>$play_requested_By
						);

						$this->db->where($whereCodtion);
						$this->db->update('match_result',$updateFlag);


						$whereCodtion2MatchSeter=array(
							'match_id'=>$match_id,
							'Result_updated_by'=>$Match_SetBy
						);

						$this->db->where($whereCodtion2MatchSeter);
						$this->db->update('match_result',$updateFlag);	


					$result=array(
						"result_status"=>'loss_cancle',
						"msg" => 'The Result is updated Loss And Cancle Which Is Conflict Result Both Party Money Has been On Hold And Penality Will be Rs 50 Contact Admin For Solve Conflict'
						);
					header('Content-Type: application/json');
					return print_r(json_encode($result));

				}

		if (($seterResult['Loss_Status']!=NULL&&$playerResult['win_status']!=NULL) || ($seterResult['win_status']!=NULL&&$playerResult['Loss_Status']!=NULL)) {

			if ($play_requested_By==$loginUserId) {
			
				if ($playerResult['Loss_Status']=='I Loss') {

					$updateFlag=array(
							'paymet_check_flag'=>1
						);

						$whereCodtion=array(
							'match_id'=>$match_id,
							'Result_updated_by'=>$play_requested_By
						);

						$this->db->where($whereCodtion);
						$this->db->update('match_result',$updateFlag);
					
					$result=array(
						"result_status"=>'loss_match',
						"msg" => 'Sorry But You Loss the Match!! Better Luck Next Time'.'You Loss bet of Rs'.' '.$match['Bet_Amount'],
						'Play_request_by'=>$play_requested_By
						);
					header('Content-Type: application/json');
					return print_r(json_encode($result));
				}

				if ($playerResult['win_status']=='I Win') {


				$winAmount=comission($match['Bet_Amount']);
				add_money_wallet($winAmount,$play_requested_By);
				
				//get referal user
				$this->db->select('refferal');
				$this->db->from('players');
				$this->db->where('uid',$play_requested_By);
				$refferId=$this->db->get()->row_array();
				if (!empty($refferId['refferal'])) {
					$referralAmount=refferalComission($match['Bet_Amount']);
				add_money_wallet($referralAmount,deCryptData($refferId['refferal']));

				$rfferdData=array(

					'referrer_owner'=>deCryptData($refferId['refferal']),
					'Bet_Amount'=>$match['Bet_Amount'],
					'Referral_Earning'=>$referralAmount,
					'referred_user'=>$play_requested_By
				);

				$this->db->insert('refferal_earning',$rfferdData);

$result=array(
				"result_status"=>'win_match',
				"msg" => 'Hurray  You Won the Match !!'.'You Won of Rs'.' '.$winAmount.'  '.' Do You Know Your Rferred Partner Earned Rs ' .$referralAmount . ' '. ' You Can Also Earn By refered' ,
				'Play_request_by'=>$play_requested_By
				);
	    					header('Content-Type: application/json');
							return print_r(json_encode($result));

							$updateFlag=array('paymet_check_flag'=>1);

							$whereCodtion=array(
								'match_id'=>$match_id,
								'Result_updated_by'=>$play_requested_By
							);

								$this->db->where($whereCodtion);
								$this->db->update('match_result',$updateFlag);


				}
				else{

					$result=array(
								"result_status"=>'win_match',
								"msg" => 'Hurray  You Won the Match !!'.'You Won of Rs'.' '.$winAmount,
								'Play_request_by'=>$play_requested_By
								);
	    					header('Content-Type: application/json');
							return print_r(json_encode($result));

							$updateFlag=array('paymet_check_flag'=>1);

							$whereCodtion=array(
								'match_id'=>$match_id,
								'Result_updated_by'=>$play_requested_By
							);

								$this->db->where($whereCodtion);
								$this->db->update('match_result',$updateFlag);				}
			
				

							
							
						}



					}

					if ($Match_SetBy==$loginUserId) {
					

						if ($seterResult['Loss_Status']=='I Loss') {

							$updateFlag=array(
									'paymet_check_flag'=>1
								);

								$whereCodtion=array(
									'match_id'=>$match_id,
									'Result_updated_by'=>$Match_SetBy
								);

								$this->db->where($whereCodtion);
								$this->db->update('match_result',$updateFlag);
							
							$result=array(
								"result_status"=>'loss_match',
								"msg" => 'Sorry But You Loss the Match!! Better Luck Next Time'.'You Loss bet of Rs'.' '.$match['Bet_Amount'],
									'Match_SetBy'=>$Match_SetBy
								);
	    					header('Content-Type: application/json');
							return print_r(json_encode($result));
						}


			if ($seterResult['win_status']=='I Win') {

			$winAmount=comission($match['Bet_Amount']);
			add_money_wallet($winAmount,$Match_SetBy);


				$this->db->select('refferal');
				$this->db->from('players');
				$this->db->where('uid',$Match_SetBy);
				$refferId=$this->db->get()->row_array();
			if (!empty($refferId['refferal'])) {
					$referralAmount=refferalComission($match['Bet_Amount']);
				add_money_wallet($referralAmount,deCryptData($refferId['refferal']));

				$rfferdData=array(

					'referrer_owner'=>deCryptData($refferId['refferal']),
					'Bet_Amount'=>$match['Bet_Amount'],
					'Referral_Earning'=>$referralAmount,
					'referred_user'=>$Match_SetBy
				);

				$this->db->insert('refferal_earning',$rfferdData);


	$result=array(
				"result_status"=>'win_match',
				"msg" => 'Hurray  You Won the Match !!'.'You Won of Rs'.' '.$winAmount.'  '.' Do You Know Your Rferred Partner Earned Rs ' .$referralAmount . ' '. ' You Can Also Earn By refered' ,
				'Play_request_by'=>$Match_SetBy
				);
	    					header('Content-Type: application/json');
							return print_r(json_encode($result));

								$updateFlag=array(
									'paymet_check_flag'=>1
								);

								$whereCodtion=array(
									'match_id'=>$match_id,
									'Result_updated_by'=>$Match_SetBy
								);

								$this->db->where($whereCodtion);
								$this->db->update('match_result',$updateFlag);


				}
				else{

					$result=array(
								"result_status"=>'win_match',
								"msg" => 'Hurray  You Won the Match !!'.'You Won of Rs'.' '.$winAmount,
								'Play_request_by'=>$Match_SetBy
								);
	    					header('Content-Type: application/json');
							return print_r(json_encode($result)); 	}


								$updateFlag=array(
									'paymet_check_flag'=>1
								);

								$whereCodtion=array(
									'match_id'=>$match_id,
									'Result_updated_by'=>$Match_SetBy
								);

								$this->db->where($whereCodtion);
								$this->db->update('match_result',$updateFlag);


						


							
						
						}


					}

						


					}
		
	// update that result of match is recived and removed OutCome Button
			
		

	}

					else{
						$result=array(
									"result_status"=>'result_not',
									"msg" => 'Wait Until Opponent Updated The Result !! Check Again After Few Minute'
									);
		    					header('Content-Type: application/json');
								return print_r(json_encode($result));
					}


					
				}

			
				
			}


/**
        ===========================================================
        Operation   :  withdrawalReques
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : withdrawalReques
        ===========================================================
    **/ 

			public function withdrawalReques(){
				if (isset($_POST['withdrawl-submit'])) {
				
					$ORDER_ID=$this->input->post('ORDER_ID');
					$USR_ID=$this->input->post('USR_ID');
					$withdrawalAmount=$this->input->post('withdrawlAmount');
					$Upi_id=$this->input->post('Upi_id');

					$insertData=array(
						'ORDER_ID'=>$ORDER_ID,
						'USR_ID'=>$USR_ID,
						'withdrawalAmount'=>$withdrawalAmount,
						'Upi_id'=>$Upi_id
					);
					$insert=$this->db->insert('withdrawal_request',$insertData);
					
					if ($insert) {
							sub_money_wallet($withdrawalAmount,$USR_ID);
							echo "<script>";
							echo "alert('wait');";
							echo "</script>";
							redirect('welcome/withdrawalTransaction');
					}	

				}

				
			}


/**
        ===========================================================
        Operation   :  withdrawalTransaction
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : withdrawalTransaction
        ===========================================================
    **/ 

        public function withdrawalTransaction() {
        	$this->auth_login();
        	$data=array();
        	$data['withdrawal']=$this->Players_model->get_withdrawal_tranHistory($this->session->userdata('userinsertId'));

         	$this->load->view('withdrawal_transaction_history',$data);
        }


/**
        ===========================================================
        Operation   :  Admin Login
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : Admin Login
        ===========================================================
    **/ 

			public function admin_login(){	
				
					$this->load->view('admin_login');

					}	

/**
        ===========================================================
        Operation   :  Admin Login check
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : Admin Login check
        ===========================================================
    **/ 

		public function admin_login_chk(){
					if(isset($_POST['admin_login']))
					{
					$Username=$this->input->post('Username');
					$password=$this->input->post('password');

							$whereCodtion=array(
								'user_name'=>$Username,
								'password'=>$password
							);

							print_r($whereCodtion);
							
							// get user data
							$this->db->select('*');
							$this->db->from('admin_user');
							$this->db->where($whereCodtion);
							$que=$this->db->get();
							$row = $que->num_rows();

							
						if($row)
							{

							$result = $que->row_array();
							if ( $result['status'] == 0 ) {
								$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="position: relative; top: -7px; color:red">Your account is Inactive.</span>');
								redirect('admin');
								return 1;
							}
							
			           	$this->session->set_userdata('isadminLogin',TRUE);
					    $this->session->set_userdata('admin_name',$result['user_name']);		


			             redirect('welcome/admin_dashboard/'); 
						}
						else
						{
						$data['error']="<span style='color:red'>Wrong User Password</span>";
						//$this->load->view('Website/login',@$data);
						$this->session->set_flashdata('error_msg_signin', '<span id="signinMsg" style="position: relative; top: -7px; color:red">Wrong User Password</span>');
						}	
						
					}
					redirect('admin');
				}



			public function auth_login_admin(){
						    if($this->session->userdata('isadminLogin')){
						        //retunt "true";
						         }
						             else{
						                 redirect('admin');
						                
						             }
						 }
		public function withdrawalRequestAdmin_table() {
			$this->auth_login_admin();
			$data['withdrawalRequest']=$this->Players_model->get_all_withdrawal_request();
			$this->load->view('withdrawalRequest_table',$data);
		}


/**
        ===========================================================
        Operation   :  all_Users_List
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : all_Users_List
        ===========================================================
    **/ 
		public function all_Users_List() {
					$this->auth_login_admin();
					$data['all_users']=$this->Players_model->get_all_users();
					$this->load->view('all_Users_List',$data);
				}

/**
        ===========================================================
        Operation   :  all_Users_List
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : all_Users_List
        ===========================================================
    **/ 		
			public function match_Result_List() {
				$this->auth_login_admin();
					$data['match_result']=$this->Players_model->get_all_match_result();
					$this->load->view('match_result_listing',$data);
			}

/**
        ===========================================================
        Operation   :  all_Users_List
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : all_Users_List
        ===========================================================
    **/ 		
			public function matches_List() {
				$this->auth_login_admin();
					$data['matches']=$this->Players_model->all_match_details();
					$this->load->view('matches_listing',$data);
			}

			

			public function admin_dashboard(){	
						$this->load->view('admin_dashboard');
						}

/**
        ===========================================================
        Operation   :  update_status
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : Admin Login check
        ===========================================================
    **/ 

 public function update_status()
  {
    // echo $this->uri->segment(3);
    // echo $this->uri->segment(4);
    // echo $this->uri->segment(5);
    $this->Players_model->update_status($this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5));

    redirect('welcome/' . $this->uri->segment(6) . '/' . $this->uri->segment(7));
  }
					


/**
        ===========================================================
        Operation   :  referal Earning Listing
                    -----------------------------------------------
        Input       :   
                    -----------------------------------------------
        Return      : Referal Rarning Lising
        ===========================================================
    **/ 


public function referalEarning() {
	
	$this->auth_login();
			$data['referralEarning']=$this->Players_model->allreferralEarning($this->session->userdata('userinsertId'));
			$this->load->view('referalEarning',$data);
}


}