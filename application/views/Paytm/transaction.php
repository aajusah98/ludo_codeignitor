<?php
	header("Pragma: no-cache");
	header("Cache-Control: no-cache");
	header("Expires: 0");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Payment</title>
 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
<!-- custom css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loginstyle.css">
</head>
<body>
	
	<!-- nav bar -->
	<?php $this->load->view('navigation'); ?>


	<div class="container">
  <div class="row">
      <div class="form">
        <ul class="tab-group">
        <li class="text-center">Add Money</li>
        <li class="tab" style="display: none;"><a href="#login">Withdraw Money</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Add Money To Wallet</h1>

           <!--  <?php if ($this->session->flashdata('error_msg_signup_user')) { ?>
            <div class="col-md-12 alert alert-danger" >
            <?php echo $this->session->flashdata('error_msg_signup_user');  ?>
          </div>
            <?php }?> -->
            <form action="paytmRedirect" method="post">
                  <div class="form-group">
                  	<!-- <label>ORDER_ID::*</label> -->
                  	<input type="text" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . uniqid();?>" hidden readonly>
                  </div>

					<div class="form-group">
						<!-- <label>INDUSTRY_TYPE_ID ::*</label> -->
						<input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail" readonly hidden>
					</div>
                   <div class="form-group">  
                   <!-- 	<label>CUSTID ::*</label> -->
                   	<input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="<?php  echo $this->session->userdata('userinsertId'); ?>" readonly hidden>
                  </div>
             
                  <div class="form-group">
                  <!-- 	<label>Channel ::*</label> -->
                  	<input id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB" readonly hidden>
                  </div>
               
               
                 <div class="form-group">
             		<label>Total Amount*</label>
             		<input title="TXN_AMOUNT" tabindex="10" type="text" name="TXN_AMOUNT"
						value="1">
                  </div>

                <button type="submit" name="load_amt" class="button button-block">Load</button>
            </form>

        </div>
        
        <div id="login" style="display: none;">   
          <h1>Welcome Back!</h1>
           <?php if ($this->session->flashdata('error_msg_signin')) { ?>
            <div class="col-md-12 alert alert-danger" >
            <?php echo $this->session->flashdata('error_msg_signin');  ?>
          </div>
            <?php }?>
          <form action="welcome/login_chk" method="post">
            
              <div class="form-group">
              <input type="tel"    pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  required class="form-control" name="whatsapp" placeholder=" Whatsapp Number" autocomplete="off"/>
            </div>
            
             <div class="form-group">
              <input type="password"required   placeholder="Password" name="psw" class="form-control"autocomplete="off"/>
            </div><br>
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block"/ type="submit" name="login">Log In</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
    </div> <!-- /form -->
  </div>
</div>

<!-- 	<form method="post" action="pgRedirect.php">




		<table border="1">
			<tbody>
				<tr>
					<th>S.No</th>
					<th>Label</th>
					<th>Value</th>
				</tr>
				<tr>
					<td>1</td>
					<td><label>ORDER_ID::*</label></td>
					<td><input id="ORDER_ID" tabindex="1" maxlength="20" size="20"
						name="ORDER_ID" autocomplete="off"
						value="<?php echo  "ORDS" . rand(10000,99999999)?>">
					</td>
				</tr>
				<tr>
					<td>2</td>
					<td><label>CUSTID ::*</label></td>
					<td><input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" autocomplete="off" value="CUST001"></td>
				</tr>
				<tr>
					<td>3</td>
					<td><label>INDUSTRY_TYPE_ID ::*</label></td>
					<td><input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" autocomplete="off" value="Retail"></td>
				</tr>
				<tr>
					<td>4</td>
					<td><label>Channel ::*</label></td>
					<td><input id="CHANNEL_ID" tabindex="4" maxlength="12"
						size="12" name="CHANNEL_ID" autocomplete="off" value="WEB">
					</td>
				</tr>
				<tr>
					<td>5</td>
					<td><label>txnAmount*</label></td>
					<td><input title="TXN_AMOUNT" tabindex="10"
						type="text" name="TXN_AMOUNT"
						value="1">
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><input value="CheckOut" type="submit"	onclick=""></td>
				</tr>
			</tbody>
		</table>
		* - Mandatory Fields
	</form> -->

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="<?php echo base_url();?>assets/js/loginscript.js"></script>

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>
</html>