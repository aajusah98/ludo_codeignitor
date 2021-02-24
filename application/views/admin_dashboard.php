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

.admin-dashboard{
  display:flex;
  justify-content:space-between;  
}

.box{
  height:250px;
  width:200px;
  background:#3773D3;
}
   </style>


</head>

<body class="cover-background">

<!-- nav bar -->
<?php $this->load->view('admin_nav'); ?>
<div style="display: flex; ">
<?php $this->load->view('admin_left_panel'); ?>

<div class="admin-dashboard ml-4">
  
    <div class="card box mr-2 mt-5" style="width: 18rem;">
  <div class="card-body">
    <h2 class="card-title text-white text-center mt-4">Total Users</h2>
    <h1 class="card-subtitle mt-5 text-white text-center" id="total_users"></h1>
  </div>
</div>

  <div class="card box mr-2 mt-5" style="width: 18rem;">
  <div class="card-body">
    <h2 class="card-title text-white text-center mt-4">Online Users</h2>
    <h1 class="card-subtitle mt-5 text-white text-center" id="online_users_box"></h1>
  </div>
</div>  

 <div class="card box mr-2 mt-5" style="width: 18rem;">
  <div class="card-body">
    <h2 class="card-title text-white text-center mt-4">Total Matches</h2>
    <h1 class="card-subtitle mt-5 text-white text-center" id="total_matches"></h1>
  </div>
</div>  

</div>

</div>

 
</div>
</div>

<script type="text/javascript">

<?php
if($_SESSION["isadminLogin"])
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

function fetch_all_user()
{
 var update = "fetch_data";
 $.ajax({
  url:"<?php echo base_url().'welcome/fetch_all_user' ?>",
  method:"POST",
  data:{update:update},
  success:function(data)
  {
   $('#total_users').html(data);
  }
 });
}

function fetch_all_matches()
{
 var update = "fetch_data";
 $.ajax({
  url:"<?php echo base_url().'welcome/fetch_all_matches' ?>",
  method:"POST",
  data:{update:update},
  success:function(data)
  {
   $('#total_matches').html(data);
  }
 });
}



fetch_all_matches();
setInterval(function(){
 fetch_all_matches();
}, 3000);


fetch_user_login_data();
setInterval(function(){
 fetch_user_login_data();
}, 3000);

fetch_all_user();
setInterval(function(){
 fetch_all_user();
}, 3000);


<?php } ?>

</script>


</body>
</html>