         <div class="sidebar-content">
                <div>
                    <ul class="sidebar-nav">
                        <li class="sidebar-nav-title">Navigation</li>
                        <li class="sidebar-nav-item">
                            <a href="<?= route('admin.dashboard') ?>" class="sidebar-nav-link" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon nav-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span class="nav-text">Dashboard</span>
                                <span class="badge bg-blue"></span>
                            </a>
                        </li>


                        <li class="sidebar-nav-item">
                            <a  class="sidebar-nav-link" data-toggle="collapse" data-target="#sidebar-menu-user">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon nav-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="nav-text">Users</span>
                                <span class="sidebar-nav-arrow"></span>
                            </a>
                            <ul class="sidebar-subnav collapse" id="sidebar-menu-user">
                                <li class="sidebar-nav-item">
                                    <a  class="sidebar-nav-link" href="<?= route('admin.user.list') ?>">
                                        <span>List</span>
                                    </a>
                                </li>
                                <li class="sidebar-nav-item">
                                    <a  class="sidebar-nav-link" href="<?= route('admin.user.edit_form') ?>">
                                        <span>Create New</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-nav-item">
                            <a  class="sidebar-nav-link" data-toggle="collapse" data-target="#sidebar-menu-settings">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="icon nav-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="nav-text">Settings</span>
                                <span class="sidebar-nav-arrow"></span>
                            </a>
                            <ul class="sidebar-subnav collapse" id="sidebar-menu-settings">
                                <li class="sidebar-nav-item">
                                    <a  class="sidebar-nav-link" href="<?= route('admin.settings',['group'=>'site']) ?>">
                                        <span>Site Setting</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="mt-auto">
                    <a href="<?= route('admin.logout') ?>" class="btn btn-primary btn-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Logout
                    </a>
                </div>
            </div

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
<?php $this->load->view('admin_nav'); ?>
<div class="container">
    <h1 class="text-warning text-center">Welcome Admin</h1>
  <div class="row">
  <!-- A vertical navbar -->
  <div class=" col-sm-4 col-md-3 col-lg-3 col-md-auto ">
<nav class="navbar bg-dark">

<!-- Links -->
<ul class="navbar-nav w-100">
  <li class="nav-item text-justify">
    <a class="nav-link" href="<?php echo base_url(); ?>welcome/withdrawalRequestAdmin_table">pay_amount</a>
  </li>
  <li class="nav-item text-justify">
    <a class="nav-link" href="<?php echo base_url(); ?>welcome/all_Users_List">All Users</a>
  </li>
  <li class="nav-item  text-justify">
    <a class="nav-link" href="#">Link 3</a>
  </li>
</ul>

</nav></div>
  <div class="col-sm-auto col-lg-auto col-md-auto">
 <!--  <table class="table table-dark" id="table">
  <tr>
                <th>S.N</th>
                <th>UserId</th>
                <th>OrderId</th>
                <th>Payable Amount</th>
                <th>MobileNumber/Upi Id</th>
                <th>Status</th>
            </tr>

            <tr>
                <td>FN1</td>
                <td>LN1</td>
                <td>10</td>
                <td>FN1</td>
                <td>LN1</td>
                <td><button type="button" id="pay"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Pay
      </button> 
      <button type="button" id="paid"  class="btn btn-primary not-show-anything" >
      Paid
      </button>
      </td>
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Amount Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form>

    <div class="form-group">
      <label for="userId">User Id</label>
      <input type="text" id="userId" class="form-control" placeholder="Enter User Id" >
    </div>
    <div class="form-group">
      <label for="orderId">Order Id</label>
      <input type="text" id="orderId" class="form-control" placeholder="Enter Order Id" >
    </div>

    <div class="form-group">
      <label for="transactionId">Translation Id</label>
      <input type="text" id="transactionId" class="form-control" placeholder="Enter Translation Id" >
    </div>

    <div class="form-group">
      <label for="transactionAmount">Transaction Amount</label>
      <input type="text" id="transactionAmount" class="form-control" placeholder="Enter TransactionAmount">
    </div>

    <div class="form-group">
      <label for="paymentType">Payment Type</label>
      <input type="text" id="paymentType" class="form-control" placeholder="Enter Payment Type">
    </div>

    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

</form> -->
    

  </div>

  </div>
</div>
</div>
<!--   <script>
  let pay_amount = document.getElementById("pay-amount");
  var table = document.getElementById('table'),rIndex;

                for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                         rIndex = this.rowIndex;
                         console.log(rIndex)
                         document.getElementById("userId").value = this.cells[0].innerHTML;
                         document.getElementById("orderId").value = this.cells[1].innerHTML;
                         document.getElementById("transactionId").value = this.cells[2].innerHTML;
                         document.getElementById("transactionId").value = this.cells[3].innerHTML;
                         document.getElementById("transactionAmount").value = this.cells[4].innerHTML;

                    };
                }
  </script> -->
</body>
</html>