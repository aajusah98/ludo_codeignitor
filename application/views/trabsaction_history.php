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

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/loginstyle.css">
</head>
<body>

 <!-- nav bar -->
  <?php $this->load->view('navigation'); ?>

<!-- partial:index.partial.html -->
<div class="container">
  <div class="row">
  
  <div class="table-responsive">
      <table class="display" id="trans_table" style="width:100%">
        <thead>
          <tr>
            <th>Payment Mode</th>
            <th>Amount</th>
            <th>Date</th>
            <th>TXNID</th>
            <th>ORDERID</th>
            <th>Status</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($transaction as $key) {?>
          <tr>
            <td><?php echo $key['PAYMENTMODE'];  ?></td>
            <td><?php echo $key['TXNAMOUNT'];  ?></td>
            <td><?php echo $key['TXNDATE'];  ?></td>
            <td><?php echo $key['TXNID'];  ?></td>
            <td><?php echo $key['ORDERID'];  ?></td>
            <td><?php echo $key['STATUS'];  ?></td>
          </tr>

          <?php } ?>
        </tbody>
      </table>   
  </div>

  </div>
</div>



<script type="text/javascript">
  $(document).ready(function() {
    
    $('#trans_table').DataTable( {
      "pagingType": "full_numbers"
    });

    // $("#myInput").on("keyup", function() {
    //   var value = $(this).val().toLowerCase();
    //   $("#myTable tr").filter(function() {
    //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });

    // $("#studentname").on("keyup", function() {
    //   var value = $(this).val().toLowerCase();
    //   $("#myTable tr").filter(function() {
    //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });

    // $("#quizname").on("keyup", function() {
    //   var value = $(this).val().toLowerCase();
    //   $("#myTable tr").filter(function() {
    //     $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    //   });
    // });

  });

</script>  

  <!-- footer -->
 <?php $this->load->view('footer'); ?>
</body>
</html>
