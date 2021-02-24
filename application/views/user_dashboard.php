<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LudoBattles</title>
	 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
	
  <style>
     .not-show-anything{
       display: none;
     }
   </style>

</head>

<body class="cover-background">
  <div style="position: relative;">
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
                  <a href="<?php echo base_url();  ?>welcome/letsPlayLudo">
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
                 <h3 class="card-text text-white">Rs.<span id="wallet"><?php echo $users['money_wallet'];  ?></span></h3>
               <a href="<?php echo base_url();?>welcome/paytmCheckOutPage"><h6 class="text-warning"><i class="fa fa-plus" >  </i><span class="font-weight-bold"> Add Balance</span></h6></a> 
              </a>
            </div>
         </div>

             <div class="card text-center bg-secondary content-width mb-2" style="cursor: pointer !important;"  >
              <div class="card-body">
                    <h6 class="text-warning font-weight-bold">
                   <button class="bg-secondary text-warning" id="cash-withdrawl" data-toggle="modal" data-target="#exampleModal"> <i class="fa fa-reply" aria-hidden="true"></i> Cash Withdrawl</button></h6>
              </div>

           <!--Withdrawl Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Cash Withdrawl Details</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body" >
                  <div id="modal-content" class="text-danger">

                  </div>

                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary not-show-anything" id="withdrawl-submit">Submit</button>
                </div> -->
              </div>
            </div>
          </div>
          <!-- Endmodal -->



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
                    <a href="<?php echo base_url(); ?>welcome/withdrawalTransaction" class="text-warning"><i class="fa fa-info-circle" aria-hidden="true"></i>
                      Withdrawal Transactions</a>
                    </div>
            
            <div class="card-header  mb-1 bg-secondary">
                      <a href="<?php echo base_url(); ?>welcome/transactionHistory" class="text-warning"><i class="fa fa-credit-card" aria-hidden="true"></i>
                        Transactions</a>
                      </div>
        <div class="card-header text-warning mb-1 bg-secondary">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              Your Referal Code:  <span><?php echo enCryptData($users['uid']);  ?></span>
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
            
            <div class="card text-center bg-secondary  mb-2 game-detail-content-width mr-3">
              <div class="card-body bg-white" >
                  <h3 class="card-text text-success">  <?php  echo totalMatchPlayed($users['uid']); ?> </h3>
                  <p  class="text-dark">Total Matches Played</p>
              </div>
           </div>

           <div class="card text-center bg-secondary  mb-2 game-detail-content-width mr-3">
            <div class="card-body bg-success">
                <h3 class="card-text text-white"> <?php  echo totalWin($users['uid']); ?> </h3>
                <p class="text-warning">Total Win</p>
            </div>
         </div>
         <div class="card text-center bg-secondary mb-2  game-detail-content-width mr-3">
          <div class="card-body bg-secondary">
              <h3 class="card-text text-white"> <?php  echo totalLoss($users['uid']); ?></h3>
              <p class="text-warning">Total Loss</p>
          </div>
       </div>


           <div class="card text-center bg-secondary mb-2  game-detail-content-width mr-3">
            <div class="card-body bg-primary">
                <h3 class="card-text text-white" id="online_users_box"> </h3>
                <p class="text-warning">Online Users</p>
            </div>
         </div>
         <div class="card text-center bg-secondary  mb-2 game-detail-content-width mr-3">
          <div class="card-body bg-warning">
              <h3 class="card-text text-dark"><?php echo enCryptData($users['uid']);  ?></h3>
              <p class="text-success">Your Referal Code</p>
          </div>
       </div>
       <div class="card text-center bg-secondary mb-2 game-detail-content-width mr-3">
        <div class="card-body bg-info">
            <h3 class="card-text text-white"><?php  echo cancleMatch($users['uid']); ?></h3>
            <p class="text-warning">Cancel Matches</p>
        </div>
     </div>

  <div class="card text-center bg-secondary mb-2 game-detail-content-width mr-3">
    <a href="<?php echo base_url(); ?>welcome/referalEarning">
          <div class="card-body">
              <h3 class="card-text text-white">Click Me</h3>
              <p class="text-warning">Referal Earning</p>
          </div>

          </a>
       </div>

          </div>
        </div>
          </div>
      </div>
    </div>
            <!-- End Content -->

  

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
   </div>
<script>
     let wallet_balance = document.getElementById("wallet").textContent;
     let cash_withdrawl = document.getElementById("cash-withdrawl");
     let modal_content = document.getElementById("modal-content");
     let withdrawl_submit = document.getElementById("withdrawl-submit");

     if(parseInt(wallet_balance)<50){
       modal_content.innerHTML = "<p>Not Sufficient Balance</p>";

      //  cash_withdrawl.disabled = true;
     }else{
      modal_content.classList.remove("text-danger");
      // withdrawl_submit.classList.remove("not-show-anything");
      modal_content.innerHTML = `<form action="<?php echo base_url(); ?>welcome/withdrawalReques" method="post">
  <div class="form-group row">
    <label for="number" class="col-sm-3 col-form-label">Mobile :</label>
    <div class="col-sm-7">
       <input type="tel"    pattern="[0-9]{3}[0-9]{3}[0-9]{4}"  required class="form-control" name="Upi_id" placeholder="Enter Mobile number/Upi Id"required/>
    </div>
  </div>
  <div class="form-group row">
    <label for="number" class="col-sm-3 col-form-label">Amount :</label>
    <div class="col-sm-7">
      <input type="number" class="form-control" name="withdrawlAmount" onKeyPress="enteredAmountKeyPress(this.id)" onKeyUp="enteredAmountKeyPress(this.id)" id="amount" placeholder="Enter Amount" required/>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
  </div>
    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="USR_ID" autocomplete="off" value="<?php  echo $this->session->userdata('userinsertId'); ?>" readonly hidden>
  <input type="text" id="ORDER_ID" tabindex="1" maxlength="20" size="20"
            name="ORDER_ID" autocomplete="off"
            value="<?php echo  "ORDS" . uniqid();?>" hidden readonly>
  <button type="submit" class="btn btn-primary " id="withdrawl-submit" name="withdrawl-submit" onClick="clearData(this.id)">Submit</button>

  </form>`;
     
     }

    

    function clearData() {
      document.getElementById('amount').value='';

    }

     function enteredAmountKeyPress(id)
    {
        let enteredAmount = document.getElementById(id).value;
       if(parseInt(wallet_balance)<parseInt(enteredAmount)){
        //  alert("Please Enter Appropriate Balance");
         modal_content.innerHTML = "<p>Not Sufficient Balance</p>";
         setTimeout(function(){  location.reload();}, 2000);
         
       }

    }

   </script>


   <script type="text/javascript">
     
     <?php
if($_SESSION["isUserLogin"])
{
?>
function fetch_user_login_data()
{
 var update = "fetch_data";
 $.ajax({
  url:"<?php echo base_url().'welcome/fetch_user_login_data' ?>",
  method:"POST",
  data:{update:update},
  success:function(data)
  {
   $('#online_users_box').html(data);
  }
 });
}


fetch_user_login_data();
setInterval(function(){
 fetch_user_login_data();
}, 3000);



<?php } ?>


   </script>

</body>
</html>