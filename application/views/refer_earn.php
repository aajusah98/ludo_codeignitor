<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
 <!--  <meta http-equiv="refresh" content="10"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url();?>assets/customCss/dashboardCustom.css">

 <!--  cdn link -->
 <!-- <script src="http://localhost/ludo/assets/js/jquery-3.5.1.js"></script> -->
   <?php $this->load->view('cdn_links'); ?>

      <title>Term And Conditions</title>
</head>
<body class="cover-background">
   <!-- nav bar -->
<?php $this->load->view('navigation'); ?>

  <section terms>
    <div class="container-fluid">
      <div class="row">
        <div class="mx-auto mb-12 terms" style="padding: 43px; text-align: center;">
            

            <h1 class="text-uppercase font-weight-bold">You can regularly earn a 1% commission on the betting amount if you share your referral code with a new player.</h1>

            <br>
            <br>

            <h2>You will earn it if your referred player wins the game.</h2>

              <br>
            <br>

            <h3>Your referral code is displayed in your dashboard.</h3>
              <br>
            <br>

        </div>
      </div>
    </div>
  </section>
  <style type="text/css">
    
    .terms h1,h2,h3,p,ul>li,ol{color: white;}
  
  .terms ul{
    margin-left: 4%;
  }

  </style>













  <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>

</html>