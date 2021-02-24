
        <!-- Start Navbar -->
          <nav class="navbar navbar-dark bg-dark navbar-expand-sm  padding-large">
                    <a class="navbar-brand text-success" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo v1.svg" alt="LudoBattles" width="120">
                    </a>
                 <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-2" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
                    <div class="collapse navbar-collapse" id="navbar-list-2">
                      <ul class="navbar-nav active">
                        <li class="nav-item active">
                          <a class="nav-link nav-link-hover" aria-current="page" href="<?php echo base_url(); ?>welcome/admin_dashboard/">Home</a>
                        </li>
                        
                      </ul>

                     <?php if ($this->session->userdata('isadminLogin')) { ?>
                     <span class="log-out-width">
                      
                   <!--    <a href="<?php echo base_url(); ?>welcome/userprofile/<?php echo $this->session->userdata('userinsertId'); ?>" class="log-out-right"> 
                        <p class="navbar-text  text-success my-2 nav-link-hover" >
                        <i class="fa fa-user" aria-hidden="true"></i> <span style="margin-right:10px; "> Profile </span>
                      </p>
                    </a> -->

                      <a href="<?php echo base_url(); ?>welcome/admin_logout" class="log-out-right"> 
                        <p class="navbar-text  text-success my-2 nav-link-hover" style="float: right;" >
                          Logout  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      </p>
                    </a>
                    </span>
                  <?php } else{?>
                     <!--   <span class="log-out-width">
                      <a href="<?php echo base_url(); ?>register#signup" class="log-out-right"> <p class="navbar-text  text-success my-2 nav-link-hover" >
                          Login/Register  <i class="fa fa-arrow-right" aria-hidden="true"></i>
                      </p></a>
                     </span> -->
                  <?php } ?>
                  </div>
                </nav>
      <!-- End Navbar -->



  