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
<body >
   <!-- nav bar -->
<?php $this->load->view('navigation'); ?>

 
  
 <div class="container " >
   
   <div class="row">

    <form id="ContactUs100"  action="" method="post">&nbsp;
        <table style="width: 564px; max-width: 550px; border: 0px; height: 412px;" cellspacing="0" cellpadding="8">
        <tbody>
        <tr>
        <td><label for="Name">Name*:</label></td>
        <td><input style="width: 100%; max-width: 250px;" maxlength="60" name="Name" type="text" /></td>
        </tr>
        <tr>
        <td><label for="PhoneNumber">Phone number:</label></td>
        <td><input style="width: 100%; max-width: 250px;" maxlength="43" name="PhoneNumber" type="text" /></td>
        </tr>
        <tr>
        <td><label for="FromEmailAddress">Email address*:</label></td>
        <td><input style="width: 100%; max-width: 250px;" maxlength="90" name="FromEmailAddress" type="text" /></td>
        </tr>
        <tr>
        <td><label for="Comments">Comments*:</label></td>
        <td><textarea style="width: 100%; max-width: 350px;" cols="40" name="Comments" rows="7"></textarea></td>
        </tr>
        <tr>
        <td>* - required fields</td>
        <td><input name="skip_Submit" type="submit" value="Submit" /></td>
        </tr>
        </tbody>
        </table>
        </form>


   </div>


 </div>









  <!-- footer -->
 <?php $this->load->view('footer'); ?>

</body>

</html>