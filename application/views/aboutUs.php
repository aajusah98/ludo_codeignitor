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
        <div class="mx-auto mb-2 terms" style="padding: 43px; text-align: justify;">
            
            <h4 class="text-uppercase font-weight-bold text-center">About Us !</h4>
            <!-- <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto"> -->
            <p class="lh-1">http://ludobattles.com/ is a Professional Service Platform. Here we will provide you only interesting content, which you will like very much.</p>
              <p>We're dedicated to providing you the best of Service, with a focus on dependability and Daily Earning Source.</p>
              
              <p>We're working to turn our passion for Service into a booming online website. We hope you enjoy our Service as much as we enjoy offering them to you</p>
              
              <p>Keep Playing Keep Earning. Please give your support and love.
              </p>
            <h3 class="text-center">Thanks For Visiting Our Site</h3>
            <div class="h3 text-center">
            <a href="<?php echo base_url();?>welcome/contactUs"  >Contact Us!</a>
            <a ></a>
            </div>
        </div>
      </div>
    </div>
  </section>
  <style type="text/css">
    
    .terms h6,h4,h3,p,ul>li,ol{color: white;}
  
  .terms ul{
    margin-left: 4%;
  }

  </style>













  <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>

</html>