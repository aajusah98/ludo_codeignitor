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
            
            <h4 class="text-uppercase font-weight-bold text-center">Disclaimer for Ludo Battles</h4>
            <!-- <hr class="bg-success mb-4 mt-0 d-inline-block mx-auto"> -->
            <p class="lh-1">If you require any more information or have any questions about our site's disclaimer, please feel free to contact us by email at mnjha82828@gmail.com.</p>
              <p>Disclaimers for Ludo Battles</p>
              
              <p>All the information on this website - http://ludobattles.com/ - is published in good faith and for general information purpose only. Ludo Battles does not make any warranties about the completeness, reliability, and accuracy of this information. Any action you take upon the information you find on this website (Ludo Battles), is strictly at your own risk. Ludo Battles will not be liable for any losses and/or damages in connection with the use of our website.</p>
              
              <p>From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over the content and nature of these sites. These links to other websites do not imply a recommendation for all the content found on these sites. Site owners and content may change without notice and may occur before we have the opportunity to remove a link that may have gone 'bad'.
              </p>
              <p>Please be also aware that when you leave our website, other sites may have different privacy policies and terms that are beyond our control. Please be sure to check the Privacy Policies of these sites as well as their "Terms of Service" before engaging in any business or uploading any information.</p>
              <p>Consent</p>
              <p>By using our website, you hereby consent to our disclaimer and agree to its terms.</p>
              <p>Update</p>
              <p>Should we update, amend or make any changes to this document, those changes will be prominently posted here.</p>
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