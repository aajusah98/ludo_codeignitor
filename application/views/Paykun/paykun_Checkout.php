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

          <h1>Add Money To Wallet</h1>

            <form action="paykunSubmitRequest" method="post">
                  <div class="form-group">
               
                  	<input type="text" id="full_name" name="full_name" hidden>
                  </div>

                  <div class="form-group">
                 
                  	<input type="text" id="product_name" 
						name="product_name" value="ludobattles_add_money" hidden 
						 >
                  </div>

					<div class="form-group">
						
						<input id="email"  name="email" hidden >
					</div>
               
               
                 <div class="form-group">
             		<label>Enter Amount*</label>
             		<input title="amount" type="text" name="amount" value="50" required>
                  </div>

                      <div class="form-group">  
                   	<input  type="text" maxlength="10" name="contact"  hidden>
                  </div>


                  <div class="form-group">  
                   	<input type="text" name="country" value="india" hidden>
                  </div>

                  <div class="form-group">  
                   	<input type="text" name="state" hidden>
                  </div>

                 <div class="form-group">
                  <input type="text" name="city" hidden>
                   </div>

                  <div class="form-group">  
                   <input type="text" name="postalcode" maxlength="6" hidden>
                  </div>

                  <div class="form-group">
                  	<input type="text" name="address" hidden>
                  </div>

                <button type="submit" name="load_amt" class="button button-block">Load</button>
            </form>

        </div>
        



        
      </div><!-- tab-content -->
      
    </div> <!-- /form -->
  </div>
</div>


<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="<?php echo base_url();?>assets/js/loginscript.js"></script>

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>
</html>