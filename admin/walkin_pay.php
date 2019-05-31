<?php
ob_start();
require('../connection.php');
require('session.php');
require('../format_money.php');
?>

<!DOCTYPE HTML>
<html>
  <?php
  require('head.php');
  ?>
<body>
  <?php
  $ordersid = $_GET['ordersid'];
  $table = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$ordersid'");
  $obj = $table->fetch_assoc();

  $balance = $obj['AmountPayable'] - $obj['AmountPaid'];
  ?>	
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
	<?php
	require('header.php');
	?>			
	<!--header end here-->

<!--inner block start here-->
	

<div class="inner-block">

<div class="blank">
 <?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="sales.php">Walkin Orders</a></li>
    <li><a href="sales2.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Submit Payment</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>SUBMIT PAYMENT</b>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="walkin_pay-exec.php">
  <div class="row mb40">
    <div class="col-md-2">
    <h5>ID: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo $ordersid; ?></h5>
    </div>

     <div class="col-md-2">
    <h5>Amount Payable: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo formatMoney($obj['AmountPayable'], true); ?></h5>
    </div>
  </div>

  <div class="row mb40">
   <div class="col-md-2">
    <h5>Balance: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo formatMoney($balance, true); ?></h5>
    </div>

    <div class="col-md-2">
    <h5>Amount Paid: </h5>
    </div>

    <div class="col-md-4">
    <h5><?php echo formatMoney($obj['AmountPaid'], true); ?></h5>
    </div>

  </div>  


   <div class="row mb40">


    <div class="col-md-2">
    <h5>Payment Method : </h5>
    </div>

    <div class="col-md-4">
    <select name="payment_type" class="form-control" required>
    <option value="" selected="selected"> - Select Payment- </option>
    <option name="Cash">Cash</option> 
    <option name="Bank Deposit">Bank Deposit</option> 

    </select>
    </div>

  </div>  

   <div class="row mb40">

    <div class="col-md-2">
    <h5>Amount : </h5>
    </div>

    <div class="col-md-4">
    <input type="text" class="form-control" name="amount" data-parsley-type="number" required />
    </div>

  </div>


  <input type="hidden" name="ordersid" value="<?php echo $ordersid; ?>">

  <input type="hidden" name="balance" value="<?php echo $balance; ?>">

  <div class="row mb40">
  <div class="col-md-2">
  <button type="submit" name="submit">Submit</button>
  </div>
  </div>


  </form>

</div>


</div>
</div>

</div>
<!--inner block end here-->

<!--footer-->
<?php 
require('footer.php');
?>	
<!--footer-->

</div>
</div>


<!--slider menu-->
	<?php
	require('navigation.php');
	?>
</div>
<!--slider bar menu end here-->



<!--scrolling js-->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!--//scrolling js-->
<script src="js/bootstrap.js"> </script>
<!-- mother grid end here-->

<!--Parsley script-->
<script src="../parsleyjs/dist/parsley.min.js"></script>
<script>
$(document).ready(function(){
    $('form').parsley();
});
</script>

<script>
function confirmRemove() {
  return confirm("Are you sure you want to remove this category?"); 
}
</script>

<!-- DATA TABLE SCRIPTS -->
<script src="../plugins/dataTables/jquery.dataTables.js"></script>
<script src="../plugins/dataTables/dataTables.bootstrap.js"></script>

<script>
  $(document).ready(function () {
  $('#dataTables-example').dataTable();
  });
</script>


</body>
</html>

<?php
ob_end_flush();
?>
                      
						
