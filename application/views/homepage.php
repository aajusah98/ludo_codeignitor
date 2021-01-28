<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
            <p class="text-weight-bold title-font-size">Win ₹20000 daily.</p>
            </div>
          <div class="card-body">
            <div class="text-center">
                <p class="text-white">You can win more than ₹20000 daily by just playing Ludo.</p>
                <p class="text-white">Please <a href="" style="color: cyan;">login</a> to play now.</p>
                <p class="text-warning p-font-size " >For any help, watch this video</p>
                <iframe width="80%" height="315" src="https://www.youtube.com/embed/nuEpNchGQ2Y" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <p class="text-weight-bold text-white" >For Any Other Query</p>
                <p class="text-weight-bold  text-white" >Please contact support at whatsapp (+919067246201)</p>
                <p class="text-weight-bold  " ><a class="text-white" href="#about" >Click here to contact <span class="text-success">Admin</span></a></p>
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