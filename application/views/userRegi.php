<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LUDOBATTLES</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
<!-- custom css -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loginstyle.css">
</head>
<body>

 <!-- nav bar -->
  <?php $this->load->view('navigation'); ?>

<!-- partial:index.partial.html -->
<div class="container">
  <div class="row">
      <div class="form">
        <ul class="tab-group">
        <li class="tab active"  ><a href="<?php echo base_url(); ?>register#signup" id="signup">Sign Up</a></li>
        <li class="tab"><a  href="<?php echo base_url(); ?>register#login"  id="login">Log In</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signUpForm" style="display: block;">   
          <h1>Sign Up for Free</h1>

            <?php if ($this->session->flashdata('error_msg_signup_user')) { ?>
            <div class="col-md-12 alert alert-danger" >
            <?php echo $this->session->flashdata('error_msg_signup_user');  ?>
          </div>
            <?php }?>

            <form action="welcome/signup_user" method="post">
                  <div class="form-group">
                    <input type="text"  pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$"  required class="form-control" name="uname" autocomplete="off" placeholder="Hint:Player1" />
                  </div>

                   <div class="form-group">  
                    <input type="email" required class="form-control" name="email" autocomplete="off" placeholder="Email Id" />
                  </div>
             
                  <div class="form-group">
                    <input type="tel"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}" required class="form-control" name="whatsapp" placeholder=" Whatsapp Number"   autocomplete="off"/>
                  </div>
               
                 <div class="top-row">
                     <div class="form-group">
                      <input type="password"required class="form-control" name="psw" placeholder="Your Password"  autocomplete="off"/>
                    </div>
                    
                    <div class="form-group">
                      <input type="password"required    placeholder=" Confirm Password" name="cpwd" class="form-control" autocomplete="off"/>
                    </div>
                </div>

                 <div class="form-group">
                    <input type="text" class="form-control" name="refferal" placeholder="Refferal Number (if any)" autocomplete="off"/>
                  </div>

                <button type="submit" name="user_register" class="button button-block">Sign Up</button>
                
            </form>

        </div>
        
        <div id="signInForm" style="display: none;">   
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
          
          <p class="forgot" id="forget"><a href="<?php echo base_url(); ?>register#forget">Forgot Password?</a></p>
          
          <button class="button button-block"/ type="submit" name="login">Log In</button>
          
          </form>

        </div>
        
          <?php if ($this->session->flashdata('error_msg_forget')) { ?>
           <?php echo $this->session->flashdata('error_msg_forget');  ?>
          </div>
            <?php }?>
          <form action="welcome/forgetPassword" method="POST" id="forgetForm"   class="forget_tab" style="display:none;" >
             
             <div class="row">
                  <div class="col-md-12 col-sm-12">
                      <div class="form-group forgetemail">
                      <input type="text" name="email" placeholder="Email" class="form-control" required="" autocomplete="off">
                      </div>
                  </div>

                <div class="col-md-12 col-sm-12">
                   <div class="with-enter">
                        <a href="<?php echo base_url();?>register#login" id="backtologin"><p>Back to Login</p></a>
                    </div>
                  </div>
                <div class="col-md-12 col-sm-12">
                  <button type="submit" name="forget" class="btn-main blue-btn" value="forget">Submit</button>
                  </div>
            </div>
            </form>








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
