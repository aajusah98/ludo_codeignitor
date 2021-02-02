<!DOCTYPE html>
<html>
<head>
  <title>Change Password</title>
   <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
<!-- custom css -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loginstyle.css">
</head>
<body>
  <!-- nav bar -->
  <?php $this->load->view('navigation'); ?>


     <!-- Signup -->
  <section class="sign-wrpss" >
        <div class="container">
                <h1>Change Password</h1>
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
                         <button type="submit" name="register" value="Submit" class="button button-block">Change Password</button>
                    </form>
                    <p class="emp-lik">Login?  <a href="<?php echo base_url();?>register#login">Click Here</a></p>
            </div>
    </section>



 <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>


</html>