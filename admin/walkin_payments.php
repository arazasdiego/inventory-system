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

  $table = $conn->query("SELECT p.Amount, p.PaymentType, p.DatePaid, p.ReceivedBy,
  ui.Fullname
  FROM payment AS p 
  INNER JOIN user_info AS ui ON p.ReceivedBy=ui.UserID
  AND OrdersID='$ordersid'");

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
    <li><a href="sales.php">Walkin Order List</a></li>
    <li><a href="sales2.php?ordersid=' .$ordersid. '">' .$ordersid. '</a></li>
    <li class="active">Payment List</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>PAYMENT LIST</b>
 
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


   echo '
    <table class="table" style="font-size: 18px;">
    <thead>
    <tr class="success">
      <th>Type</th>
      <th>Amount</th>
      <th>Date</th>
      <th>Received</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
      echo '<td>' .$obj['PaymentType']. '</td>';
      
      echo '<td>' .formatMoney($obj['Amount'], true). '</td>';

      echo '<td>' .$obj['DatePaid']. '</td>';

      echo '<td>' .$obj['Fullname']. '</td>';

      
      echo '</tr>';
    
    
    }
    echo '
    </tbody>
    </table>
    ';  

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
                      
						
