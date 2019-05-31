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

  $table = $conn->query("SELECT * FROM payment_slip WHERE OrdersID='$ordersid'");
  $obj = $table->fetch_assoc();

  $sql = $conn->query("SELECT ot.SubAmount, ot.DeliveryCharge, ot.GrandAmount, ot.AmountChange, ot.PaymentType, ot.AmountPaid, ot.DateOrdered, ot.DateFinished, ot.OrderStatus, ot.PaymentStatus, ot.WalkinStatus, ot.TransactionType, ot.PreparedBy, ot.DiscountID, ot.DiscountedAmount, ot.AmountPayable, 
    bd.CustomerName, bd.CompleteAddress, bd.Email, bd.Mobile
    FROM orders_total AS ot
    INNER JOIN billing_detail AS bd ON ot.OrdersID=bd.OrdersID
    AND ot.OrdersID='$ordersid'");

    $row = $sql->fetch_assoc();


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
    <li><a href="online_sales.php">Online Orders</a></li>
    <li><a href="pickuporder.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Deposit Slip</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>DEPOSIT SLIP</b>
 
  </div>  


<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo 
  ' 
  <div class="row mb40">
    <div class="col-md-6">
      
      <table>
      <tr>
        <td><b>Payment Status: </b>' .$row['PaymentStatus']. '</td>
      </tr>

      <tr>
        <td><b>Amount Payable: </b>' .formatMoney($row['AmountPayable'], true). '</td>
      </tr>

      <tr>
        <td><b>Amount Paid: </b>' .formatMoney($row['AmountPaid'], true). '</td>
      </tr>

      </table>
    </div>

  </div>
  ';


  echo '<img src="../deposit slip/' .$obj['DepositSlip']. '" alt="Deposit Slip Image" style="width: 700px; height: 400px;" />';




  }

  else {
    echo 'No payment records available.';
  }

?>

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
                      
						
