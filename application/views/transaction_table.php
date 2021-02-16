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
 
   </style>
	
  
</head>

<body class="cover-background">
  <div style="position: relative;">
<!-- nav bar -->
<?php $this->load->view('navigation'); ?>
<div class="container">
    <h1 class="text-warning text-center">Welcome Admin</h1>
  <div class="row">
  <!-- A vertical navbar -->
  <div class=" col-sm-4 col-md-3 col-lg-3 col-md-auto ">
<nav class="navbar bg-dark">

<!-- Links -->
<ul class="navbar-nav w-100">
  <li class="nav-item text-justify">
    <a class="nav-link" href="admin_dashboard">User Transaction Table</a>
  </li>
  <li class="nav-item text-justify">
    <a class="nav-link" href="transaction_table">Transaction Table</a>
  </li>
  <li class="nav-item text-justify">
    <a class="nav-link" href="#">Link 3</a>
  </li>
</ul>

</nav></div>
  <div class="col-sm-auto col-lg-auto col-md-auto">
  <div class="table-responsive">
  <table class="table table-dark" id="table">
  <tr>
                <th>S.N</th>
                <th>UserId</th>
                <th>TransactionId</th>
                <th>TransactionAmount</th>
                <th>MobileNumber/Upi Id</th>
                <th>Status</th>
            </tr>
            
            <tr>
                <td>FN1</td>
                <td>LN1</td>
                <td>10</td>
                <td>FN1</td>
                <td>LN1</td>
                <td>paid
      </td>
     
      
            </tr>
            
            <tr>
                <td>FN2</td>
                <td>LN2</td>
                <td>20</td>
                <td>FN1</td>
                <td>LN1</td>
                <td>10</td>
            </tr>
            
            <tr>
                <td>FN3</td>
                <td>LN3</td>
                <td>30</td>
                <td>FN3</td>
                <td>LN3</td>
                <td>30</td>
            </tr>
            
            <tr>
                <td>FN4</td>
                <td>LN4</td>
                <td>40</td>
                <td>FN4</td>
                <td>LN4</td>
                <td>40</td>
            </tr>
            
            <tr>
                <td>FN5</td>
                <td>LN5</td>
                <td>50</td>
                <td>FN5</td>
                <td>LN5</td>
                <td>50</td>
            </tr>
 
</table>

  </div>
  
  </div>

  </div>
</div>
</div>
<!-- /.container -->

</body>
</html>