<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <script data-ad-client="ca-pub-4809072902219598" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <title>LUDOBATTLE</title>

 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>

  <link rel="stylesheet" href="<?php echo base_url();?>assets/customCss/dashboardCustom.css">

</head>

<body class="cover-background">
<!-- nav bar -->
<?php $this->load->view('navigation'); ?>

  <!-- Start Content -->
    <div class="padding-large margin-top">
      
      <div class="container-fluid">
        <div class="home-hero">
        <div class="card bg-dark game-detail-width-home margin-top margin-top-large">
          <div class="card-header text-success font-weight-bold text-center">
            <p class="text-weight-bold title-font-size">LUDOBATTLES.COM - PLAY MORE, WIN MORE!</p>
            </div>



          <div class="card-body">
            <div class="text-center">
               <h4><a href="<?php echo base_url();?>refund-policy/" style="color: cyan;"> REFER & EARN <span style="color: red;">Click Here</span></a></h4>
                <br>
                <p class="text-white">PLAY - WIN - EARN! खेलो - जीतो - कमाओ!</p>
                <p class="text-white">WIN MORE THAN 1,00,000 PER MONTH!</p>
                <p class="text-white">Please <a href="<?php echo base_url(); ?>register#login" style="color: cyan;"> LOGIN & PLAY NOW</a></p>
                <p class="text-warning p-font-size " >WATCH THIS VIDEO FOR SIGN UP PROCESS</p>
                <iframe width="80%" height="315" src="https://www.youtube.com/embed/nuEpNchGQ2Y" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <p class="text-weight-bold text-white" >For Any Other Query</p>
                <p class="text-weight-bold  text-white" >CONTACT US IF YOU FACE ANY ISSUE...</p>
              <a href="http://wa.me/+919660923040"><i class="fab fa-whatsapp text-white mr-4 h1"></i></a>
                <a href="https://t.me/LUDOBATTLES1"><i class="fab fa-telegram text-white mr-4 h1"></i></a>
              </div>
          </div>
        </div>
          </div>
      </div>
    </div>
            <!-- End Content -->
 
<!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>

</html>