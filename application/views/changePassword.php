<!DOCTYPE html>
<html>


 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
<!-- custom css -->

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loginstyle.css">

<body>
    
  <!-- nav bar -->
  <?php $this->load->view('navigation'); ?>-->

    <!-- Signup -->
  <section class="sign-wrpss" >
        <div class="container">
            <div class="sign-mon">
                <h1>Change Password</h1>
               <!--  <p>Internmart is an exclusive platform for highschool students to discover careers and get hired as an intern. Its a first step towards searching for internship opportunities and connect with potential employers </p> -->

                <div class="sign-frms">
                   <!--  <h4>Create your free account!</h4> -->

                   <!--  <div class="login-with">
                        <button class="btn-main"><i class="fa fa-facebook"></i> Sign up with Facebook</button>
                        <button class="btn-main googbtn"><img src="images/google.svg" alt=""> Sign up with Google</button>
                    </div> -->

                   <!--  <span>or sign up with your email address</span> -->
                    <?php echo @$error; ?>
                    <form action="" method="POST">
                        
                        <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control" value="<?php echo $email;?>"  required>
                        </div>
                        <div class="form-group">
                            <input type="Password" name="password" placeholder="Create Password" class="form-control" required>
                        </div>
                         <div class="form-group">
                            <input type="Password" name="cpassword" placeholder="Confirm Password" class="form-control" required>
                        </div>

                  <!--   <p class="privacy-li">By registering you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a>.</p> -->

                   <!--  <a href="#" class="btn-main">Sign Up</a> -->
                    <input type="submit" name="register" class="btn-main" value="Submit"/>
                    </form>
                    <p class="emp-lik">Login?  <a href="<?php echo base_url();?>student/login">Click Here</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- End Signup -->



 <!-- footer -->
 <?php $this->load->view('footer'); ?>
    <!-- Back To Top -->
   