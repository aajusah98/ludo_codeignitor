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
  <hr>
  <div class="row">
    <div class="col-md-3 mb-3">
        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">User Transaction Table</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Transaction table</a>
  </li>

</ul>
    </div>
    <!-- /.col-md-4 -->
        <div class="col-md-9">
      <div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
  <div>
   <div>
   <div class="table-responsive">
   <table class="table table-dark" id="table">
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

</form>
      </div>
      
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
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h2>Profile</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, eveniet earum. Sed accusantium eligendi molestiae quo hic velit nobis et, tempora placeat ratione rem blanditiis voluptates vel ipsam? Facilis, earum!</p>
  </div>
 
</div>
    </div>
    <!-- /.col-md-8 -->
  </div>
  
  
  
</div>
<!-- /.container -->
  <script>
  // let pay_amount = document.getElementById("pay-amount");
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
  </script>
</body>
</html>