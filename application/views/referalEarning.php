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


<style type="text/css">
  

table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
  @media
    only screen 
    and (max-width: 760px), (min-device-width: 768px) 
    and (max-device-width: 1024px)  {

    /* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr {
      display: block;
    }

    /* Hide table headers (but not display: none;, for accessibility) */
    thead tr {
      position: absolute;
      top: -9999px;
      left: -9999px;
    }

    tr {
      margin: 0 0 1rem 0;
    }
      
    tr:nth-child(odd) {
      background: #ccc;
    }
    
    td {
      /* Behave  like a "row" */
      border: none;
      border-bottom: 1px solid #eee;
      position: relative;
      padding-left: 50%;
    }

    td:before {
      /* Now like a table header */
      position: absolute;
      /* Top/left values mimic padding */
      top: 0;
      left: 6px;
      width: 45%;
      padding-right: 10px;
      white-space: nowrap;
    }

    /*
    Label the data
    You could also use a data-* attribute and content for this. That way "bloats" the HTML, this way means you need to keep HTML and CSS in sync. Lea Verou has a clever way to handle with text-shadow.
    */
    td:nth-of-type(1):before { content: "SN"; }
    td:nth-of-type(2):before { content: "Bet_Amount"; }
    td:nth-of-type(3):before { content: "Referral_Earning"; }
    td:nth-of-type(4):before { content: "Referred To"; }

  }
</style>


<body class="cover-background">



 <!-- nav bar -->
<?php $this->load->view('navigation'); ?>


<div class="container">

  <div class="table-responsive text-white" style="margin-top: 40px">
    <h1 class="text-white text-center">Referral Earning</h1>
       <table class="table table-striped table-bordered text-white" id="trans_table" style="width: 100%;">
  <thead>
    <tr>
            <th>SN</th>
            <th>Bet_Amount</th>
            <th>Referral_Earning</th>
            <th>Referred To</th>
            </thead>
             </tr>
  </thead>
    <tbody>
          <?php $count=1; foreach ($referralEarning as $key) {?>
          <tr>
            <td><?php echo $count;   ?></td>
            <td><?php echo $key['Bet_Amount'];  ?></td>
            <td><?php echo $key['Referral_Earning'];  ?></td>
            <td><?php echo getUserName($key['referred_user']);  ?></td>
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
