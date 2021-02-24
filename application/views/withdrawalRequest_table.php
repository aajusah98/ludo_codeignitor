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

  <div class="table-responsive text-white mr-5" style="margin-top: 40px">
    <h1 class="text-white text-center">PayOut</h1>
       <table class="table table-striped table-bordered text-white" id="trans_table" style="width: 100%;">
  <thead>
   <tr>
      <th>Order Id</th>
      <th>User Name</th>
      <th>withdrawalAmount</th>
      <th>Upi_id</th>
      <th>request_date</th>
      <th>Status</th>
    </tr>
  </thead>
    <?php  
          foreach ($withdrawalRequest as $key) {?>

          <?php
                $new_status = $key['status'] == 1 ? 0 : 1;
                $caption = $key['status'] == 1 ? "Paid" : "Pay";
                $caption_color = $key['status'] == 1 ? "green" : "red";
                                      ?>
            <tr>
              <td><?php echo $key['ORDER_ID'];  ?></td>
              <td><?php print_r(getUserName( $key['USR_ID']));?></td>
              <td><?php echo $key['withdrawalAmount'];  ?></td>
              <td><?php echo $key['Upi_id'];  ?></td>
              <td><?php echo $key['request_date']; ?></td>
              <td><a href="<?php echo base_url() . '/welcome/update_status/withdrawal_request/' . $key['withdrawal_id'] . '/' . $new_status . '/withdrawalRequestAdmin_table'; ?>"><span style="color:<?php echo $caption_color; ?>"><?php echo $caption; ?></span></a></td>
            </tr>
            <?php } ?>
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
