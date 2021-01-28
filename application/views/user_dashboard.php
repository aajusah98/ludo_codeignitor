<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LudoBattles</title>
	 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
	

<!-- dasboard custm style sheet -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/customCss/dashboardCustom.css">

</head>

<body class="cover-background">

<!-- nav bar -->
<?php $this->load->view('navigation'); ?>

	  <!-- Start Content -->
    <div class="padding-large margin-top">
      
      <div class="container-fluid">
        <div>
          <div class="card mb-3  bg-dark">
            <div class="card-header text-success font-weight-bold">
             	<h4>Welcome <span><?php echo $users['user_name'];  ?></span></h4>
              </div>

               <?php  if (!empty($this->session->userdata('money_add'))) {?>
                  <div class="alert alert-success text-center">
                    <strong>Success!</strong> <?php   echo $this->session->userdata('money_add'); ?>
                  </div>
                <?php }?>
            
                <?php  if (!empty($this->session->userdata('money_add_fail'))) {?>
                  <div class="alert alert-danger text-center">
                      <?php   echo $this->session->userdata('money_add_fail'); ?>
                  </div>
                <?php }?>
            


            <div class="card-body  flex-small">
              
              <div class="card text-center bg-secondary content-width  mb-2"  >
                <div class="card-body">
                  <a href="#">
                    <h3 class="card-text text-white"> <i class="fa fa-play" aria-hidden="true"></i></h3>
                    <h6 class="text-warning font-weight-bold">Lets Play Ludo</h6></a>
                </div>
             </div>
  
             <div class="card text-center bg-secondary content-width mb-2"  >
              <div class="card-body">
                <a href="#">
                  <h3 class="card-text text-white"> <i class="fa fa-play" aria-hidden="true"></i></h3>
                  <h6 class="text-warning font-weight-bold">Lets Play Snake</h6></a>
              </div>
           </div>
           <div class="card text-center bg-secondary content-width mb-2"  >
            <div class="card-body">
              <a href="#">
                <h3 class="card-text text-white">Rs.<span><?php echo $users['money_wallet'];  ?></span></h3>
               <a href="<?php echo base_url();?>welcome/paytmCheckOutPage"><h6 class="text-warning"><i class="fa fa-plus" >  </i><span class="font-weight-bold"> Add Balance</span></h6></a> 
              </a>
            </div>
         </div>

             <div class="card text-center bg-secondary content-width mb-2"  >
              <div class="card-body">
                  <h3 class="card-text text-white">Rs. 0</h3>
                  <h6 class="text-warning font-weight-bold"><i class="fa fa-reply" aria-hidden="true"></i>
                    Cash Withdrawl</h6>
              </div>
           </div>
            </div>
          </div>
        </div>
        
        <div class="flex">
        <div class="card bg-dark profile-width ">
          <div class="card-header text-success mb-1 font-weight-bold flex-small">
          <p> <i class="fa fa-user-circle" aria-hidden="true"></i> Profile Details </p>  <i class="fas fa-edit text-white select-pointer " data-toggle="modal" data-target="#exampleModal"></i>
            </div>
            <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content bg-dark">
        <div class="modal-header">
          <h5 class="modal-title text-white" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url(); ?>welcome/edit_user" method="post" >
            <div class="form-group text-white">
              <label for="userName">Name</label>
              <input type="name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" class="form-control bg-secondary text-warning" name="uname" aria-describedby="emailHelp" value="<?php echo $users['user_name'];  ?>"/>
             
            </div>
            <div class="form-group text-white">
              <label for="emailId">Email</label>
              <input type="email" class="form-control bg-secondary text-warning" name="email"   value="<?php echo $users['email'];  ?>"/>
            </div>

            <div class="form-group text-white">
              <label for="phoneId">Phone</label>
              <input type="tel"  pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  class="form-control bg-secondary text-warning" name="whatsapp" value="<?php echo $users['whatsapp_num'];  ?>"/>
            </div>
            <button type="submit" name="edit_data" class="btn btn-success">Save changes</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>

  <!-- End modal -->

            <div class="card-header text-warning mb-1 bg-secondary">
              <i class="fa fa-address-card" aria-hidden="true"></i>
              Name: <span><?php echo $users['user_name'];  ?></span>
              </div>
             <div class="card-header text-warning mb-1  bg-secondary">
              <i class="fa fa-phone-square " aria-hidden="true"></i>
              Phone:  <span><?php echo $users['whatsapp_num'];  ?></span>
                </div>
            <div class="card-header text-warning mb-1 bg-secondary">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              Email:  <span><?php echo $users['email'];  ?></span>
                  </div>
             <div class="card-header  mb-1 bg-secondary">
                    <a href="#" class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i>
                      Match Details</a>
                    </div>
            
            <div class="card-header  mb-1 bg-secondary">
                      <a href="#" class="text-warning"><i class="fa fa-credit-card" aria-hidden="true"></i>
                        Transactions</a>
                      </div>
           <a href="<?php echo base_url(); ?>welcome/logout" type="button" class="card-header text-white mb-1 bg-secondary">
            <i class="fa fa-arrow-right" aria-hidden="true"></i>
             Logout
                </a>
                      
          
        </div>

        <div class="card bg-dark game-detail-width margin-top margin-top-large">
          <div class="card-header text-success font-weight-bold"><i class="fa fa-gamepad" aria-hidden="true"></i> 
            Game Details
            </div>
          <div class="card-body  flex" >
            
            <div class="card text-center bg-secondary  mb-2 game-detail-content-width">
              <div class="card-body bg-white" >
                  <h3 class="card-text text-success"> 0</h3>
                  <p  class="text-dark">Total Matches Played</p>
              </div>
           </div>

           <div class="card text-center bg-secondary  mb-2 game-detail-content-width">
            <div class="card-body bg-success">
                <h3 class="card-text text-white"> 0</h3>
                <p class="text-warning">Total Win</p>
            </div>
         </div>
         <div class="card text-center bg-secondary mb-2  game-detail-content-width">
          <div class="card-body bg-secondary">
              <h3 class="card-text text-white"> 0</h3>
              <p class="text-warning">Total Loss</p>
          </div>
       </div>

           <div class="card text-center bg-secondary mb-2  game-detail-content-width">
            <div class="card-body bg-primary">
                <h3 class="card-text text-white">0</h3>
                <p class="text-warning">Pending Matches</p>
            </div>
         </div>
         <div class="card text-center bg-secondary  mb-2 game-detail-content-width">
          <div class="card-body bg-warning">
              <h3 class="card-text text-dark">0</h3>
              <p class="text-success">Playing Matches</p>
          </div>
       </div>
       <div class="card text-center bg-secondary mb-2 game-detail-content-width">
        <div class="card-body bg-info">
            <h3 class="card-text text-white">0</h3>
            <p class="text-warning">Cancel Matches</p>
        </div>
     </div>
          </div>
        </div>
          </div>
      </div>
    </div>
            <!-- End Content -->

    </div>
  </div>

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>
</html>