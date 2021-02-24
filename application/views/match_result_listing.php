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
            <th>win_status</th>
            <th>Loss_Status</th>
            <th>Result_updated_by</th>
            <th>match_id</th>
            <th>Screenshot</th>
            <th>cancle_status</th>
            <th>cancle_reason</th>
            <th>result_status</th>
            </thead>
             </tr>
  </thead>
    <tbody>
          <?php $count=1; foreach ($match_result as $key) {?>
          <!-- <?php
                $new_status = $key['status'] == 1 ? 0 : 1;
                $caption = $key['status'] == 1 ? "Activate" : "Deactivate";
                $caption_color = $key['status'] == 1 ? "green" : "red";
                                      ?> -->
          <tr>
            <td><?php echo $count;   ?></td>
            <td><?php echo $key['win_status'];  ?></td>
            <td><?php echo $key['Loss_Status'];  ?></td>
            <td><?php echo getUserName($key['Result_updated_by']);  ?></td>
            <td><?php echo $key['match_id'];  ?></td>
           <!--  <td><a href="<?php echo base_url() . '/welcome/update_status/players/' . $key['uid'] . '/' . $new_status . '/all_Users_List'; ?>"><span style="color:<?php echo $caption_color; ?>"><?php echo $caption; ?></span></a></td> -->

            <td><img src="<?php echo base_url();  ?>uploads/<?php echo $key['screenshot_link'];  ?>" alt="Not Updated" width="100" height="100"></td>
            <td><?php echo $key['cancle_status'];  ?></td>
            <td><?php echo $key['cancle_reason'];  ?></td>
            <td><?php if($key['result_status']==0){
              echo "Result Not Updated";
            }  else{
              echo "Result Updated";
          } ?></td>

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
