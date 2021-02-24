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
            
            <h4 class="text-uppercase font-weight-bold">Refund and Cancellation Policy</h4>
            <!-- <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto"> -->
            <p class="lh-1">Our focus is complete customer satisfaction. In the event, if you are displeased with the services provided, we will refund back the money, provided the reasons are genuine and proved after investigation. Please read the fine prints of each deal before buying it, it provides all the details about the services or the product you purchase.</p>
              
              <p>In case of dissatisfaction from our services, clients have the liberty to cancel their projects and request a refund from us. Our Policy for the cancellation and refund will be as follows:</p>
              
             
            
        <!-- </div> -->
        <!-- <div class="text-left mx-auto mb-4 approval"> -->
          <h4 class="text-uppercase font-weight-bold"> Cancellation Policy</h4>
          <ul>
            <li>For Cancellations please contact the us via contact us link. </li>
            <li>Requests received later than ____business days prior to the end of the current service period will be treated as cancellation of services for the next service period.</li>
          </ul>
          
          <h4 class="text-uppercase font-weight-bold">Refund Policy</h4>
          <ul class="list-unstyled" >
            <li>We will try our best to create the suitable design concepts for our clients.</li>
            <li>In case any client is not completely satisfied with our products we can provide a refund. </li>
            <li>If paid by credit card, refunds will be issued to the original credit card provided at the time of purchase and in case of payment gateway name payments refund will be made to the same account.
              </li>
          </ul>          
        </div>
      </div>
    </div>
  </section>
  <style type="text/css">
    
    .terms h6,h4,p,ul>li,ol{color: white;}
  
  .terms ul{
    margin-left: 4%;
  }

  </style>













  <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>

</html>