<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LUDOBATTLES</title>
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
 <!--  cdn link -->
   <?php $this->load->view('cdn_links'); ?>
<!-- custom css -->


</head>


<body class="cover-background">



 <!-- nav bar -->
<?php $this->load->view('admin_nav'); ?>


<div style="display: flex;">
<?php $this->load->view('admin_left_panel'); ?>

  <div class="table-responsive text-white" style="margin-top: 40px">
    <h1 class="text-white text-center">All Users</h1>
       <table class="table table-striped table-bordered text-white" id="trans_table" style="width: 100%;">
  <thead>
    <tr>
            <th>SN</th>
            <th>user_name</th>
            <th>whatsapp_num</th>
            <th>email</th>
            <th>money_wallet</th>
            <th>Status</th>
            </thead>
             </tr>
  </thead>
    <tbody>
          <?php $count=1; foreach ($all_users as $key) {?>
          <?php
                $new_status = $key['status'] == 1 ? 0 : 1;
                $caption = $key['status'] == 1 ? "Activate" : "Deactivate";
                $caption_color = $key['status'] == 1 ? "green" : "red";
                                      ?>
          <tr>
            <td><?php echo $count;   ?></td>
            <td><?php echo $key['user_name'];  ?></td>
            <td><?php echo $key['whatsapp_num'];  ?></td>
            <td><?php echo $key['email'];  ?></td>
            <td><?php echo $key['money_wallet'];  ?></td>
            <td><a href="<?php echo base_url() . '/welcome/update_status/players/' . $key['uid'] . '/' . $new_status . '/all_Users_List'; ?>"><span style="color:<?php echo $caption_color; ?>"><?php echo $caption; ?></span></a></td>
          </tr>

          <?php $count=$count+1;} ?>
        </tbody>
</table>

</div>
</div>



<script src="<?php echo base_url();?>assets/dataTable/jquery-3.5.1.js"></script>
<script src="<?php echo base_url();?>assets/dataTable/jquery_dataTable_min.js"></script>
<script src="<?php echo base_url();?>assets/dataTable/dataTables_bootstrap4_min.js"></script>
<script>
    $(document).ready(function () {
        $('#trans_table').DataTable();
    });
</script>

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>
</html>
