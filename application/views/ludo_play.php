<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
 <!--  <meta http-equiv="refresh" content="10"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url();?>assets/customCss/dashboardCustom.css">

<meta http-equiv="refresh" content="5" /> 

 <!--  cdn link -->
 <!-- <script src="http://localhost/ludo/assets/js/jquery-3.5.1.js"></script> -->
   <?php $this->load->view('cdn_links'); ?>
      <title>Lets Play Ludo</title>
</head>
<body class="cover-background">
  <div>
 
 <!-- nav bar -->
<?php $this->load->view('navigation'); ?>


      <!-- Start Content -->
    <div class="padding-large margin-top">
      
      <div class="container-fluid">
        <div>
            <div class="balance-width">  

                 <p class="text-success">Total Online Users : <span  id="online_users_box"class="text-white"> 
 </span> User
   </p>
                 <p class="text-success">Availiable Balance : <span class="text-white" id="availiableBalance"><?php echo $users['money_wallet'];  ?></span></p>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-append" id="decrease" >
                    <label class="input-group-text" for="inputGroupSelect02"><i class="fa fa-minus" aria-hidden="true"></i>
                    </label>
                  </div>
                  <input type="text" class="form-control text-success" placeholder="" aria-label="" aria-describedby="basic-addon1" id="numberInput" value="50">
        
                <div class="input-group-append mr-2" id="increase" >
                  <label class="input-group-text" for="inputGroupSelect02"><i class="fa fa-plus" aria-hidden="true"></i>
                  </label>
                </div>
                
                <div class="input-group-append" id="setMatch" onclick="addMatch('<?php echo $users['uid']?>')" >
                    <label class="input-group-text" for="inputGroupSelect02">Set Match</label>
                  </div>
              </div>
             
              <div class="hide-errorMsg"  id="errorMsg">
              <div class = "errorMsg">
              <div class="card mb-3 errorMsg-width">
                <div class="card-body">
                  <div class="text-danger errorMsg-text" id="errorMsg-text-content">Cannot Set Amount Less Than Rs.50</div>
                  
                </div>
              </div>
            </div>
            </div>

            <div id="set_match_container">
              

            </div>
            <div id="content">
              <div class="card mb-3">
               <!--  <div class="card-body" style="display:flex;align-items:center;justify-content: space-around;">
                  <div style="letter-spacing: 1.5px;"><?php echo $users['user_name'];  ?> Set Challange of Rs.50</div>
                  <div class="bg-secondary p-2 rounded-right text-white" style="width: 8rem; text-align:center" id="isCurrentUser">
                                Play
                  </div>
                </div>
              </div>
              <div class="card mb-3">
                <div class="card-body" style="display:flex;align-items:center;justify-content: space-around;">
                  <div style="letter-spacing: 1.5px;">Ajay Vs Prashant for Rs.50</div>
                  <div class="bg-secondary p-2 rounded-right text-white" style="width: 8rem; text-align:center">
                                Playing
                  </div>
                </div>
              </div> -->
        </div>
      </div>
    </div>
</div>
            <!-- End Content -->

    </div>
    <script src="<?php echo base_url();?>assets/dataTable/jquery_3_5_1.js"></script>
   <script>
      
        const playingGame = {isPlaying:false};
        // Reading wallet Balance
        let availiableBalance = document.getElementById('availiableBalance');
        let increase = document.getElementById('increase');
        let decrease = document.getElementById('decrease');
        // Taking input from user
        let inputVal =  document.getElementById('numberInput');
        let errorMsg =  document.getElementById('errorMsg');
        let setMatch =  document.getElementById('setMatch');
        let content =  document.getElementById('content');
        let set_match_container=document.getElementById('set_match_container');
        let errorMsg_text_content = document.getElementById('errorMsg-text-content');
        let isCurrentUser = document.getElementById('isCurrentUser');
        let clickCancelled = this.document.getElementById('clickCancelled');
        let clickfiveSec=false;

        function increaseValue() {
         let value = parseInt(inputVal.value);
        value = isNaN(value) ? 0 : value;
        value+=50;
        inputVal.value = value;
  }


  
function decreaseValue() {
  let value = parseInt(inputVal.value);
  value = isNaN(value) ? 0 : value;
  if(value <= 50) {
    errorMsg.classList.remove("hide-errorMsg");

setTimeout(function(){errorMsg.classList.add("hide-errorMsg")},3000)
      value = 50;
  }else if(value>50){
    value-=50;
  }
  inputVal.value = value;
}





//this function is used to set the dyanamic data of matces which has been active and deactive

function setmatchDynamicData() {
    
    set_match_container.insertAdjacentHTML(
    'afterbegin',`
                      <?php  if(!empty($setMatches)){foreach ($setMatches as $key) {
                        if ($key['Match_Status']==1 || $key['match_accept_status']==1){?>
                  <div class="card mb-3" id="remove-cancelled-<?php echo $key['M_id'];?>">
                  <div class="card-body card-body-style" id="second" >
                  

                   <?php if ($key['match_requested']==1) { ?>

                     <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $key['M_id'];?>"><?php print_r(getUserName($key['Match_SetBy']));?> Vs <?php print_r(getUserName($key['play_requested_By']));?> of Rs.<span id="rs-<?php echo $key['M_id'];?>"><?php echo $key['Bet_Amount'] ?></span></div>

                        <div class="bg-success p-2 rounded-right text-white play-style">
                                    <button class="bg-success"  id="acceptbtn-<?php echo $key['M_id'];?>" onclick="AcceptMatch(this.id,<?php echo $key['M_id'];?>,<?php echo $key['match_requested'];  ?>)" style="width:100%; border:none" >Accept
                                    </button>
                               </div>
                       <div class="bg-danger p-2 rounded-right text-white play-style">
                                    <button class="bg-danger"  id="clickCancelled-<?php echo $key['M_id'];?>" onclick="RejectMatch(this.id,<?php echo $key['M_id'];?>)" style="width:100%; border:none" >Reject
                                    </button>
                               </div>

                   <?php } else if ($key['match_accept_status']==1){ ?>
                    
                      <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $key['M_id'];?>"><?php print_r(getUserName($key['Match_SetBy']));?> Vs <?php print_r(getUserName($key['play_requested_By']));?> of Rs.<span id="rs-<?php echo $key['M_id'];?>"><?php echo $key['Bet_Amount'] ?></span></div>

                       <div class="bg-danger p-2 rounded-right text-white play-style">
                                    <a href="<?php echo base_url();?>welcome/matchDetails/<?php echo $key['M_id'];?>" type="button" class="bg-danger" style="width:100%; border:none" >MatchDetails
                                    </a>
                               </div>


                      <?php } else{?>

                         <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $key['M_id'];?>"><?php print_r(getUserName($key['Match_SetBy']));?> Set Challange of Rs.<span id="rs-<?php echo $key['M_id'];?>"><?php echo $key['Bet_Amount'] ?></span></div>
                  <?php 
                    if ($users['uid']==$key['Match_SetBy']){?>
                            <div class="bg-danger p-2 rounded-right text-white play-style">
                                    <button class="bg-danger"  id="clickCancelled-<?php echo $key['M_id'];?>" onclick="removeCancelled(this.id,<?php echo $key['Match_SetBy'];?>)" style="width:100%; border:none" >Cancle
                                    </button>
                               </div>
                             
                      <?php } ?>  

                   <?php } ?>

                
                      
                </div>
              </div>
               <?php }}}?>  
              `);
}




function getmatchDynamicData() {
    
  

    content.insertAdjacentHTML(
    'afterbegin',`
                      <?php if(!empty($allMatches)){foreach ($allMatches as $mats) {if ($mats['Match_Status']==1 && $users['uid']!=$mats['Match_SetBy'] && (

                        ($mats['match_requested']==1 && $mats['play_requested_By']==$users['uid']) || ($mats['match_requested']==2 && $mats['play_requested_By']==$users['uid']) || ($mats['match_requested']==0 && $mats['play_requested_By']==0) 

                    )  ){?>
                  <div class="card mb-3" id="remove-cancelled-<?php echo $mats['M_id'];?>">
                  <div class="card-body card-body-style" id="second" >
                  
                  
                  <?php if ($mats['match_requested']==1 && $mats['play_requested_By']==$users['uid'] ) { ?>         
                     <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $mats['M_id'];?>"> You vs <?php print_r(getUserName($mats['Match_SetBy']));?> For Rs.<span id="rs-<?php echo $mats['M_id'];?>"><?php echo $mats['Bet_Amount'];?></span></div>


                             <div class="bg-danger p-2 rounded-right text-white play-style">
                                    <button class="bg-danger" id="cancelbtn-<?php echo $mats['M_id'];?>" onclick="cancleMatchRequest(<?php echo $mats['M_id'];?>,<?php echo $users['uid'];  ?>,<?php echo $mats['Bet_Amount'];?>,this.id)" style="width:100%; border:none" >Cancle
                                    </button>
                               </div>
                            
                 <?php } else if($mats['match_requested']==2 && $mats['play_requested_By']==$users['uid']) {  ?>
                     
                      <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $mats['M_id'];?>"> You vs <?php print_r(getUserName($mats['Match_SetBy']));?> For Rs.<span id="rs-<?php echo $mats['M_id'];?>"><?php echo $mats['Bet_Amount'];?></span></div>


                             <div class="bg-danger p-2 rounded-right text-white play-style">
                                     <a href="<?php echo base_url();?>welcome/matchDetails/<?php echo $mats['M_id'];?>" type="button" class="bg-danger" style="width:100%; border:none" >MatchDetails
                                    </a>
                               </div>

                       
                 <?php } else{?>

                   <div style="letter-spacing: 1.5px;" id="sibling-<?php echo $mats['M_id'];?>"><?php print_r(getUserName($mats['Match_SetBy']));?> Set Challange of Rs.<span id="rs-<?php echo $mats['M_id'];?>"><?php echo $mats['Bet_Amount'] ?></span></div>
                                                           
                
                            <div class="bg-secondary p-2 rounded-right text-white play-style">
                                    <button class="bg-secondary" id="playbtn-<?php echo $mats['M_id'];?>" onclick="sendMatchRequest(<?php echo $mats['Match_SetBy'];?>,<?php echo $users['uid'];  ?>,<?php echo $mats['Bet_Amount'];?>,<?php echo $mats['M_id'];?>,this.id)" style="width:100%; border:none" >play
                                    </button>
                               </div>

                 <?php }  ?>
                

                </div>
              </div>
               <?php }}}?>  
              `);
}


setmatchDynamicData();
getmatchDynamicData();


function disableEditing () {
  
// shows error when input value is less than max 50
    if(inputVal.value < 50) {
        
     errorMsg.classList.remove("hide-errorMsg");

     setTimeout(function(){errorMsg.classList.add("hide-errorMsg")},3000);

    inputVal.value = 50;
}else{
  
    const walletBalance = parseInt(availiableBalance.textContent);
    const insertedBalance = parseInt(inputVal.value);
  //  compare the walletBalance and the amount inserted by user
  if(walletBalance >= insertedBalance){
         // Setting up cancel button
    content.insertAdjacentHTML(
    'afterbegin',`
                  <div class="card mb-3" id="remove-cancelled-${window.match_id}">
                  <div class="card-body card-body-style" id="second" >
                  <div style="letter-spacing: 1.5px;" id="sibling-${window.match_id}"><?php echo $users['user_name'];?> Set Challange of Rs.<span id="rs-${window.match_id}">${inputVal.value}</span></div>
                  <div class="bg-secondary p-2 rounded-right text-white play-style">
                  				<?php 
                  				$matchSetUser=$this->session->userdata('matchSetUser');
                  					if ($users['uid']==$matchSetUser){?>
                  					<div id="clickCancelled-${window.match_id}" onclick="removeCancelled(this.id)" >cancel</div>
                  					<?php }else{?>
                  						<div id="play">play</div>
                               <?php }?>  
                  </div>
                </div>
              </div> 
              `);
              availiableBalance.textContent = String(walletBalance - insertedBalance);
              inputVal.value = 50;
            
  }else{
    // If not sufficient balance throw error
      errorMsg_text_content.textContent ="You donot have sufficient balance. Please Recharge Your Wallet";

      errorMsg.classList.remove("hide-errorMsg");

      setTimeout(function(){errorMsg.classList.add("hide-errorMsg")},3000);
  }




  
   
}
}


  function addMatch($user_id){


      let betAmount = $("#numberInput").val();

      if (parseInt(availiableBalance.textContent)>0) {
        var user_id=$user_id;
          $.ajax({
            url: "<?php echo base_url().'welcome/addMatch' ?>",
            method: "POST",
            data: { user_id:user_id, betAmount:betAmount },
            async: false,
            success:function(data) {
              window.match_id=data.match_id;
              } 
        });
     }

   }


// this fumction add the matches request for playing request with help of ajax

    function sendMatchRequest(Match_SetBy,reqst_SentBy,Bet_Amount,M_id,btnid) {
    
        clickfiveSec=true;

        if (clickfiveSec){
      document.getElementById(btnid).disabled = true;
    }
      setTimeout(function(){
        document.getElementById(btnid).disabled = false;
        clickfiveSec = false;
      },5000);

        
        if (parseInt(availiableBalance.textContent)>=Bet_Amount) {

         $.ajax({
            url: "<?php echo base_url().'welcome/sendMatchRequest' ?>",
            method: "POST",
            data: { Match_SetBy:Match_SetBy, reqst_SentBy:reqst_SentBy,Bet_Amount:Bet_Amount,M_id:M_id },
            async: false,
            success:function(data) {
              
              } 
        });
      }
      else{
        // If not sufficient balance throw error
      errorMsg_text_content.textContent ="You donot have sufficient balance. Please Recharge Your Wallet";

      errorMsg.classList.remove("hide-errorMsg");

      setTimeout(function(){errorMsg.classList.add("hide-errorMsg")},3000);
      
      }


    }


  function AcceptMatch(btnId,M_id) {
      
       clickfiveSec=true;

        if (clickfiveSec){
      document.getElementById(btnId).disabled = true;
    }
      setTimeout(function(){
        document.getElementById(btnId).disabled = false;
        clickfiveSec = false;
      },5000);

         $.ajax({
            url: "<?php echo base_url().'welcome/AcceptMatch' ?>",
            method: "POST",
            data: { M_id:M_id },
            async: false,
            success:function(data) {
              
              } 
        });


    }

  function RejectMatch(btnId,M_id) {
        clickfiveSec=true;

        if (clickfiveSec){
      document.getElementById(btnId).disabled = true;
    }
      setTimeout(function(){
        document.getElementById(btnId).disabled = false;
        clickfiveSec = false;
      },5000);

         $.ajax({
            url: "<?php echo base_url().'welcome/RejectMatch' ?>",
            method: "POST",
            data: { M_id:M_id },
            async: false,
            success:function(data) {
              
              } 
        });
      
      }    

function cancleMatchRequest(M_id,reqst_SentBy,Bet_Amount,canbtn) {

 clickfiveSec=true;

        if (clickfiveSec){
      document.getElementById(canbtn).disabled = true;
    }
      setTimeout(function(){
        document.getElementById(canbtn).disabled = false;
        clickfiveSec = false;
      },5000);

     $.ajax({
            url: "<?php echo base_url().'welcome/cancleMatchRequest' ?>",
            method: "POST",
            data: { M_id:M_id, reqst_SentBy:reqst_SentBy,Bet_Amount:Bet_Amount},
            async: false,
            success:function(data) {
              
              } 
        });

}


function removeCancelled(id,mid){
  // on clicking cancel button , it removes the content
  clickfiveSec=true;

        if (clickfiveSec){
      document.getElementById(id).disabled = true;
    }
      setTimeout(function(){
        document.getElementById(id).disabled = false;
        clickfiveSec = false;
      },5000);
    let parent = document.getElementById(id).parentNode;
    parent.parentNode.parentNode.remove();

  // after cancelling resetting the total walletBalance
    const cancelledBalance = parseInt( parent.parentNode.children[0].childNodes[1].textContent);
    const currentTotalBalance = parseInt(availiableBalance.textContent);
    availiableBalance.textContent = cancelledBalance + currentTotalBalance;
    // cancleMatch(cancelledBalance,parent);
    


        $.ajax({
            url: "<?php echo base_url().'welcome/cancleMatch' ?>",
            method: "POST",
            data: { cancleMoney:cancelledBalance, match_id:id,Match_Set_By:mid },
            async: false,
            success:function(data) {
              // console.log(data);
            }
        });
   
}



increase.addEventListener('click',increaseValue);
decrease.addEventListener('click',decreaseValue);
setMatch.addEventListener('click',disableEditing);





 </script>


<script>
$(document).ready(function(){
<?php
if($_SESSION["isUserLogin"])
{
?>
function update_user_activity()
{
 var action = 'update_time';
 $.ajax({
  url:"<?php echo base_url().'welcome/update_user_activity' ?>",
  method:"POST",
  data:{action:action},
  success:function(data)
  {

  }
 });
}
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
setInterval(function(){ 
 update_user_activity();
}, 3000);

fetch_user_login_data();
setInterval(function(){
 fetch_user_login_data();
}, 3000);


<?php } ?>
});
</script>



  <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>

</html>