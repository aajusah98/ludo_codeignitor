<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
 <!--  <meta http-equiv="refresh" content="10"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="<?php echo base_url();?>assets/customCss/dashboardCustom.css">

 <!--  cdn link -->
 <!-- <script src="http://localhost/ludo/assets/js/jquery-3.5.1.js"></script> -->
  <?php $this->load->view('cdn_links'); ?>
	<title>Ludo Details</title>

  <style>
           
 .justify { text-align: justify; }
      
  input[type=radio] {
      width: 17px;
      height: 17px;
    }
    
    .not-show-anything {
      display: none;
    }

  .display_button{
    display: block;
  }

</style>
</head>


<body class="cover-background">


<div >
     <!-- nav bar -->
<?php $this->load->view('navigation'); ?>
      <!-- Start Content -->
    <div class="padding-large margin-top">
      <div class="container-fluid">
        <div class="row text-center" id="redirectButton" style="display: none;">
          <div class="col-md-12">
              <h1 class="text-success"> Try Another Bet Keep Playing And Keep Earning </h1>
              <a href="<?php echo  base_url();?>welcome/letsPlayLudo"  class="btn btn-primary"> Lets Play Another Match </a>

          </div>

        </div>

        <div class="home-hero" id="hero_section">
        <div class="card bg-dark game-detail-width-home margin-top margin-top-large">
          <div class="card-header text-success font-weight-bold text-center">
            <p class="text-weight-bold title-font-size"><?php print_r(getUserName($match['Match_SetBy']));?>  vs <?php print_r(getUserName($match['play_requested_By']));?> for <?php echo $match['Bet_Amount']; ?>
            </p>
            </div>
          <div class="card-body">
            <div class="" id="room-id">
               <div class="card-header text-info text-center">
                  <p class="title-font-size">If you can not connect to the room ID please click on Get Room ID button.
                    <br>If you Post the Wrong Result ₹50 Penalty will be charged. 
                    <br>
                  The balance will be on hold if you update the wrong result.</p>
                </div>
              <?php if ($this->session->userdata('userinsertId')==$match['Match_SetBy']) { ?>

              <!--   <div class="card-header text-info text-center">
                  <p class="title-font-size">Opponent Whats App Number
                   <br><?php print_r(getUserNumber($match['play_requested_By']));?></p>
                </div> -->

               

                <?php } else {  ?>
                  <!-- <div class="card-header text-info text-center">
                  <p class="title-font-size">Opponent Whats App Number
                   <br><?php print_r(getUserNumber($match['Match_SetBy']));?></p>
                </div> -->

                <?php  } ?>
              <form id="room_form">
                <input type="text" class="form-control" placeholder="Enter Room Id" id="myInput" <?php if ($this->session->userdata('userinsertId')==$match['play_requested_By']){echo "disabled";} ?> aria-label="Enter Room Id" aria-describedby="basic-addon2"  

                value="<?php $roomId=getRoomId($match['M_id']);  
                  if($roomId){
                    echo $roomId[0]['room_ID'];
                  }
                 ?>"
                 >
                
                <?php if ($this->session->userdata('userinsertId')==$match['Match_SetBy']) { ?>
                <div class="text-center">
                  <button class="btn btn-outline-secondary text-white" type="button" id="room-id-submit" onclick="onRoomIdSubmit(<?php echo $match['Match_SetBy'];?>,<?php echo $match['M_id'];?>)">Set Room Id</button>
                  <button class="btn btn-outline-secondary text-white" type="button"  onclick="onRoomIdEdit()">Edit Room Id</button>
                  </div>
                <?php  }else{ ?>
                  <div class="text-center">
                   <button class="btn btn-outline-secondary text-white" type="button" onclick="GetRoomId()">Get Room Id</button>
                   </div>
                <?php } ?>
                 </form> 
                
              </div>
              <div>
                 <p class="justify text-warning text-weight-bold text-center mt-2 title-font-size"  id="information">You can not cancel match untill Room ID Set</p>

                  
                  <div id="match-cancel-reason" class="not-show-anything">
                     <p class="text-center text-success title-font-size">Your Result Is Updated Please Wait Until Opponent Update Result </p>
                      <h5 class="text-center text-warning">You have selected 
                        <span class="text-center text-info text-weight-bold">
                        <?php  if (!empty($match_result)) {

                      if ($match_result['win_status']!=NUll || $match_result['Loss_Status']!=NUll || $match_result['cancel_status']!=NUll) {
                        if ($match_result['win_status']!=NUll) {
                          echo $match_result['win_status'] ;
                        }
                        else if ($match_result['Loss_Status']!=NUll) {
                          echo $match_result['Loss_Status']; 
                        }
                        else if ($match_result['cancel_status']!=NUll) {
                          echo "<br>";
                          echo $match_result['cancel_status'];
                             echo "<br>";
                             echo "<br>";
                          echo '<p class="text-center text-warning">Match Cancellation Reason</p>';
                          echo $match_result['cancel_reason'];

                        }
                      }

                    } ?>

                    </h5>                  
                      
                      
                      <p class="text-center text-white">Please Click Check <span class="text-weight-bold text-danger title-font-size"> Below Result Button </span>  To Get Final Result And Money</p>

                       <div class="text-center">
                          <a  class="btn btn-primary" onclick="checkResult(<?php echo $match['Match_SetBy'];?>,<?php echo $match['play_requested_By'];?>,<?php echo $match['M_id'];?>,<?php echo $this->session->userdata('userinsertId'); ?>)" id="cancel-submit">Result</a>
                          
                        </div>

                  </div> 
                  <div id="game-states" class="not-show-anything">
                  <div class="mb-3"  style="display:flex;justify-content: space-between;">
                        <div class="form-check text-success">
                            <input class="form-check-input " type="radio" name="match-detail" id="won-match" value="option1" >
                            <label class="form-check-label " for="won">
                             I Won
                            </label>
                          </div>
                          <div class="form-check text-white">
                            <input class="form-check-input " type="radio" name="match-detail" id="loss-match" value="option2">
                            <label class="form-check-label " for="loss">
                              I Loss
                            </label>
                          </div>
                          <div class="form-check text-danger">
                            <input class="form-check-input " type="radio" name="match-detail" id="cancel-match" value="option3">
                            <label class="form-check-label " for="cancelMatch">
                              Cancel Match
                            </label>
                          </div>
                      </div>
                      </div>
                     
                      <div class="not-show-anything" id="winner-form">
                        
  <!--            <div class="container">
    <form method="post" action="" enctype="multipart/form-data" id="myform">
        <div class='preview'>
            <img src="" id="img" width="100" height="100">
        </div>
        <div >
            <input type="file" id="file" name="file" />
            <input type="button" class="button" value="Upload" id="but_upload">
        </div>
    </form>
</div

 -->

                 
           <form method="post" id="upload_form" align="center" enctype="multipart/form-data">  
            <label for="exampleFormControlFile1">Upload Screenshot</label>
                <input type="file" name="image_file" id="image_file" /> 
                <input type="text" name="match_id" value="<?php echo $match['M_id'];?>" readonly hidden />
                <input type="text" name="Result_updated_by" value="<?php echo $this->session->userdata('userinsertId'); ?>" readonly hidden />
                <br />  
                <br />  
                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
           </form>  
           <br />  
           <br />  
           <div id="uploaded_image">  
           </div>

 <!-- 
                        <form method="post" action="" enctype="multipart/form-data" id="myform">
                          <div class="form-group text-success" id="won-screen">
                            <label for="exampleFormControlFile1">Upload Screenshot</label>
                            <input type="file" id="file" class="form-control-file"  required>
                          </div>
                          <div>
                             <button class="btn btn-primary mr-2" id="win-submit" onClick="onClickWinSubmit(this.id,<?php echo $match['M_id'];?>,<?php echo $this->session->userdata('userinsertId'); ?>)">Submit</button>
                              <button type="submit" class="btn btn-danger">close</button>
                            </div>
                        </form> -->
                    </div>
                    <div class="not-show-anything" id="loser-form">
                        
                      <form>

                        <div>
                            <a  class="btn btn-primary mr-2" id="loss-submit" onClick="onClickLossSubmit(this.id,<?php echo $match['M_id'];?>,<?php echo $this->session->userdata('userinsertId'); ?>)">Submit</a>
                          </div>
                      </form>
                  </div>
                  <div class="not-show-anything" id="cancel-form">
                        
                    <form>
                      <div class="form-group text-success" id="cancel-screen">
                        <label for="exampleFormControlFile1">Match Cancellation Reason</label>
                        <input type="text" class="form-control-file" placeholder="Enter Match Reason" id="cancel-reason">
                      </div>
                      <div>
                          <a  class="btn btn-primary mr-2" id="cancel-submit" onClick="onClickCancelSubmit(this.id,<?php echo $match['M_id'];?>,<?php echo $this->session->userdata('userinsertId'); ?>)">Submit</a>
                          <button type="submit" class="btn btn-danger">close</button>
                        </div>
                    </form>
                </div>
              <!--   <div class="mt-2 not-show-anything" id="default-match-cancel">
                  <form>
                    <div class="form-group text-success" >
                      <label for="exampleFormControlFile1">Match Cancellation Reason</label>
                      <input type="text" class="form-control-file" placeholder="Enter Match Reason">
                    </div>
                    <div>
                        <a  class="btn btn-primary mr-2" id="default-cancel-submit" onClick="onClickCancelSubmit(this.id)">Submit</a>
                        <button type="submit" class="btn btn-danger">close</button>
                      </div>
                  </form>
                   
          </div> -->
          <!-- <div>
            <?php $roomId=getRoomId($match['M_id']);  
                  if(empty($roomId)){?>
            <form>
                  <a  class="btn btn-danger" onClick="onClickDefaultCancel(this.id)" id="default-cancel-button">cancel</a>
            </form>

          <?php }?>
          </div> -->
        </div>
          </div>
      </div>
            <!-- End Content -->

    </div>
    </div>
    </div>
   </div>

  
<script>

    const loss_match = document.querySelector('#loss-match');
    const won_match = document.querySelector('#won-match');
    const cancel_match = document.querySelector('#cancel-match');
    const information = document.querySelector('#information');
    const room_id = document.querySelector('#room-id');
    const won_screen = document.querySelector('#won-screen');
    const match_cancel_reason = document.querySelector('#match-cancel-reason');
    const winner_form = document.querySelector('#winner-form');
    const loser_form = document.querySelector('#loser-form');
    const cancel_form = document.querySelector('#cancel-form');
    const cancel_submit_button = document.querySelector('#cancel-submit');
    const game_States = document.querySelector('#game-states');
    const room_id_submit = document.querySelector('#room-id-submit');
    let room_id_input =  document.getElementById("myInput");
    let default_cancel_button = document.querySelector('#default-cancel-button');
    let default_match_cancel = document.querySelector('#default-match-cancel');
    let hero_section = document.querySelector('#hero_section');
    let  redirectButton=document.querySelector('#redirectButton');
 
    function onClickWon(){
        winner_form.classList.remove("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.add("not-show-anything");
    }

    function onClickLoss(){
        winner_form.classList.add("not-show-anything");
        loser_form.classList.remove("not-show-anything");
        cancel_form.classList.add("not-show-anything");

       

    }

    function onClickCancel(){
      winner_form.classList.add("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.remove("not-show-anything");


    }




    function onRoomIdSubmit(setBy,m_Id){
      let inputVal = room_id_input.value;
           
     if(inputVal){
     room_id_input.disabled =true;
      game_States.classList.remove("not-show-anything");

      $.ajax({
      url:"<?php echo base_url().'welcome/setRoomId' ?>",
      method:"POST",
      data:{room_id:inputVal,setBy:setBy,match_id:m_Id},
      success:function(data)
      {
        if (data.status=='update') {
          alert('Room Id Updated  Wait Until Opponent Join the Game');

        }
        
        if (data.status=='insert') {
          alert('Room Id Set Wait Until Opponent Join the Game');
        }  
      }
       });
      }

    }

        function onRoomIdEdit() {
          room_id_input.disabled =false;
        }



  function onClickCancelSubmit(id,m_id,Result_updated_by){

      let cancel_reason =  document.getElementById("cancel-reason").value;

      $.ajax({
      url:"<?php echo base_url().'welcome/CancelSetMatch' ?>",
      method:"POST",
      data:{cancel_reason:cancel_reason,Result_updated_by:Result_updated_by,match_id:m_id},
      success:function(data)
      {
        if (data.result_status==1) {
          alert(data.msg);
         
      match_cancel_reason.classList.remove("not-show-anything");
      room_id.classList.add("not-show-anything");
      information.classList.add("not-show-anything");
      winner_form.classList.add("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.add("not-show-anything");
        game_States.classList.add("not-show-anything");

         window.location.reload(); 
        }


         
      }

       });     
    
    }


// this code use to display result section dynamic
<?php if (!empty($match_result)) { if ($match_result['result_status']==1) {?>

      match_cancel_reason.classList.remove("not-show-anything");
      room_id.classList.add("not-show-anything");
      information.classList.add("not-show-anything");
      winner_form.classList.add("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.add("not-show-anything");
        game_States.classList.add("not-show-anything");

<?php } }?>    




// condtion to show iwon button and iloss button when user set roomid

 <?php $roomId=getRoomId($match['M_id']);  
                  if($roomId){  if (empty($match_result)) { ?>
                   
          room_id_input.disabled =true;
           game_States.classList.remove("not-show-anything");  
          
  <?php } }?>   



function onClickLossSubmit(id,m_id,Result_updated_by) {

  $.ajax({
      url:"<?php echo base_url().'welcome/lossMatchUpdate' ?>",
      method:"POST",
      data:{Result_updated_by:Result_updated_by,match_id:m_id},
      success:function(data)
      {
        if (data.result_status==1) {
          alert(data.msg);
      match_cancel_reason.classList.remove("not-show-anything");
      room_id.classList.add("not-show-anything");
      information.classList.add("not-show-anything");
      winner_form.classList.add("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.add("not-show-anything");
        game_States.classList.add("not-show-anything");
        window.location.reload(); 
        }


         
      }

       });     
    
}

// function onClickWinSubmit(id,m_id,Result_updated_by) {
  
//    // let screenshot_name =  document.getElementById("win-submit").value;

//    var fd = new FormData();
//         var files = $('#file')[0].files[0];
//         fd.append('file',files);

//         $.ajax({
//             url: '<?php echo base_url().'welcome/winMatchUpdate' ?>',
//             type: 'POST',
//             data: fd,
//             contentType: false,
//             processData: false,
//             success: function(data){
                  
//                   alert(data);

//             },
//         });

//   }


  $(document).ready(function(){  
      $('#upload_form').on('submit', function(e){  
           e.preventDefault();  
           if($('#image_file').val() == '')  
           {  
                alert("Please Select the File");  
           }  
           else  
           {  
                $.ajax({  
                     url:'<?php echo base_url().'welcome/winMatchUpdate' ?>',   
                     method:"POST",  
                     data:new FormData(this),  
                     contentType: false,  
                     cache: false,  
                     processData:false,  
                     success:function(data)  
                     {  
                         if (data.result_status==1) {
                             alert(data.msg);
                          match_cancel_reason.classList.remove("not-show-anything");
                          room_id.classList.add("not-show-anything");
                          information.classList.add("not-show-anything");
                          winner_form.classList.add("not-show-anything");
                            loser_form.classList.add("not-show-anything");
                            cancel_form.classList.add("not-show-anything");
                            game_States.classList.add("not-show-anything");
                             window.location.reload(); 

                            }
                     }  
                });  
           }  
      });  
 });



  



    // function onClickDefaultCancel(){
    //   default_match_cancel.classList.remove("not-show-anything");
    //   default_cancel_button.classList.add("not-show-anything");
    // }

    loss_match.addEventListener('click',onClickLoss);
    won_match.addEventListener('click',onClickWon);
    cancel_match.addEventListener('click',onClickCancel);
    // room_id_submit.addEventListener('click',onRoomIdSubmit(event));
  

</script>


<script >
  
 function GetRoomId() {
      let c=1;
      if (c<2) {
          window.location.reload(); 
           c++;
      } 

        <?php $roomId=getRoomId($match['M_id']); if (!empty($roomId)){  
                  if($roomId[0]['roomId_update_flag']==0){ ?> 
                alert('Room id is not Changed');   
         window.location.reload();   
         <?php } else if ($roomId[0]['roomId_update_flag']==1) {?>
              alert('Room id is updated');
          
           

        <?php } } else{ ?>

   
          alert('Room id is not set');
       
       <?php } ?>

      }

</script>


<script type="text/javascript">
  
function checkResult(Match_SetBy,play_requested_By,match_id,Uid) {

    $.ajax({
      url:"<?php echo base_url().'welcome/checkResultUpdate' ?>",
      method:"POST",
      data:{Match_SetBy:Match_SetBy,play_requested_By:play_requested_By,match_id:match_id,loginUserId:Uid},
      success:function(data)
      {
        if (data.result_status=='result_not') {
          alert(data.msg);
          window.location.reload();
    
        }
        if (data.result_status=='cancel_match') {
           alert(data.msg);
           window.location.reload();
        }

         if (data.result_status=='loss_loss') {
           alert(data.msg);
           window.location.reload();
        }

        if (data.result_status=='win_win') {
           alert(data.msg);
           window.location.reload();

          }

        if (data.result_status=='loss_cancel') {
          alert(data.msg);
          window.location.reload();
        }

        if (data.result_status=='win_cancel') {
          alert(data.msg);
          window.location.reload();
        }
        if (data.result_status=='loss_match') {
          if (data.Play_request_by==Uid) {
            alert(data.msg);
            window.location.reload();
          }
        }
        if (data.result_status=='loss_match') {
          if (data.Match_SetBy==Uid) {
            alert(data.msg);
            window.location.reload();
          }  

        }

        if (data.result_status=='win_match') {
          if (data.Play_request_by==Uid) {
            alert(data.msg);
            window.location.reload();
          }  

        }
         if (data.result_status=='win_match') {
          if (data.Match_SetBy==Uid) {
            alert(data.msg);
            window.location.reload();
          }  

        }


         
     
    }

       });

}
</script>


<?php if ($match['result_of_match']==1) { ?>
<script>
  hero_section.classList.add("not-show-anything");
  redirectButton.style.display='block';
 </script>

<?php }?>

</body>
</html>