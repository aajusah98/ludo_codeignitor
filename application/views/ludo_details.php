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

</style>
</head>


<body class="cover-background">


<div >
     <!-- nav bar -->
<?php $this->load->view('navigation'); ?>
      <!-- Start Content -->
    <div class="padding-large margin-top">
      
      <div class="container-fluid">
        <div class="home-hero">
        <div class="card bg-dark game-detail-width-home margin-top margin-top-large">
          <div class="card-header text-success font-weight-bold text-center">
            <p class="text-weight-bold title-font-size">Ajay vs You for Rs.50</p>
            </div>
          <div class="card-body">
            <div class="" id="room-id">
              <form action="">
                <input type="text" class="form-control" placeholder="Enter Room Id" id="myInput" aria-label="Enter Room Id" aria-describedby="basic-addon2">
                <div class="text-center">
                  <button class="btn btn-outline-secondary text-white" type="button" id="room-id-submit" onclick="onRoomIdSubmit()">Submit</button>
                  </div>
                 </form> 
              </div>
              <div>
                  <p class="justify text-white" id="information">Rs.50 Penality charged if you update wrong.And if you have won the game, Please post fair result
                  for immediate balance transfer. Otherwise both players balance will be on hold and admin will have to take action.
                  And if do not update result within 20 min of the match started. Results will be on holdand you will be charged penalty(Ask opponent to update result on whatsapp.)</p>
                  
                  <div id="match-cancel-reason" class="not-show-anything">
                      <h3 class="text-center text-white">You have updated your result!!</h3>
                      <h5 class="text-center text-warning">You have selected "<span class="text-danger">CANCEL MATCH</span>"</h5>
                      <h4 class="text-center text-white">MAtch Cancellation Reason</h4>

                      
                      <p class="text-center text-white">Outcome Of Match:</p>
                      <h5 class="text-center text-warning">Playing</h5>
                      <p class=" text-center"><button class="btn-danger">Close</button></p>
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
                        
                        <form>
                          <div class="form-group text-success" id="won-screen">
                            <label for="exampleFormControlFile1">Upload Screenshot</label>
                            <input type="file" class="form-control-file" >
                          </div>
                          <div>
                              <button type="submit" class="btn btn-primary mr-2">Submit</button>
                              <button type="submit" class="btn btn-danger">close</button>
                            </div>
                        </form>
                    </div>
                    <div class="not-show-anything" id="loser-form">
                        
                      <form>
                        <div class="form-group text-success" id="loser-screen">
                        
                          <input type="text" class="form-control-file" id="loss-screenshot" value="I Loss">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          </div>
                      </form>
                  </div>
                  <div class="not-show-anything" id="cancel-form">
                        
                    <form>
                      <div class="form-group text-success" id="cancel-screen">
                        <label for="exampleFormControlFile1">Match Cancellation Reason</label>
                        <input type="text" class="form-control-file" placeholder="Enter Match Reason" id="cancel-screenshot">
                      </div>
                      <div>
                          <a  class="btn btn-primary mr-2" id="cancel-submit" onClick="onClickCancelSubmit(this.id)">Submit</a>
                          <button type="submit" class="btn btn-danger">close</button>
                        </div>
                    </form>
                </div>
                <div class="mt-2 not-show-anything" id="default-match-cancel">
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
                   
          </div>
          <div>
            <form>
                  <a  class="btn btn-danger" onClick="onClickDefaultCancel(this.id)" id="default-cancel-button">cancel</a>
            </form>
          </div>
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

    function onClickCancelSubmit(id){
      match_cancel_reason.classList.remove("not-show-anything");
      room_id.classList.add("not-show-anything");
      information.classList.add("not-show-anything");
      winner_form.classList.add("not-show-anything");
        loser_form.classList.add("not-show-anything");
        cancel_form.classList.add("not-show-anything");
        game_States.classList.add("not-show-anything");
        document.getElementById("default-match-cancel").classList.add("not-show-anything");
     
    }


    function onRoomIdSubmit(){
      let inputVal = room_id_input.value;
     if(inputVal){
     room_id_input.disabled =true;
      game_States.classList.remove("not-show-anything");
     }
     
      
    }

    function onClickDefaultCancel(){
      default_match_cancel.classList.remove("not-show-anything");
      default_cancel_button.classList.add("not-show-anything");
    }

    loss_match.addEventListener('click',onClickLoss);
    won_match.addEventListener('click',onClickWon);
    cancel_match.addEventListener('click',onClickCancel);
    // room_id_submit.addEventListener('click',onRoomIdSubmit(event));
  

</script>



</body>
</html>