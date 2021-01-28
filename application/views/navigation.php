
        <!-- Start Navbar -->
          <nav class="navbar navbar-expand-md navbar-dark bg-dark padding-large ">
                  <div class="container-fluid">
                    <a class="navbar-brand text-success" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo v1.svg" alt="LudoBattles" width="120">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
                      <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        
                      </ul>

                      
                      
                    </div>
                     <?php if ($this->session->userdata('isUserLogin')) { ?>
                     <span class="ml-5 log-out-hide">
                      
                      <a href="<?php echo base_url(); ?>welcome/userprofile/<?php echo $this->session->userdata('userinsertId'); ?>"> 
                        <p class="navbar-text  text-success my-2" >
                        <i class="fa fa-user" aria-hidden="true"></i> <span style="margin-right:20px; "> <?php echo $this->session->userdata('username');  ?>  </span>
                      </p>
                    </a>

                      <a href="<?php echo base_url(); ?>welcome/logout"> 
                        <p class="navbar-text  text-success my-2" >
                          Logout  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      </p>
                    </a>
                    </span>
                  <?php } else{?>
                       <span class="ml-5 log-out-hide">
                      <a href="<?php echo base_url(); ?>register#signup"> <p class="navbar-text  text-success my-2" >
                          Login/Register  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      </p></a>
                     </span>
                  <?php } ?>
                  </div>
                </nav>
      <!-- End Navbar -->