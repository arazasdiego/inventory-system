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
<div class="page-container">

<div class="left-content">
<div class="mother-grid-inner">
    <!--header start here-->
  <?php
  require('header.php');
  ?>      
  <!--header end here-->

<!--inner block start here-->
  <?php
  $table = $conn->query("SELECT ot.OrdersID, ot.DateOrdered, ot.OrderStatus, bd.CustomerName, ot.GrandAmount, ot.TransactionType, ot.DeliveryStatus, ot.PreparedBy, ot.PaymentStatus, ot.ReturnedStatus

    FROM orders_total as ot
    INNER JOIN billing_detail AS bd ON ot.OrdersID=bd.OrdersID
    AND ot.OrderType ='Walkin' AND ot.OrdersDelete=0");
  ?>

<div class="inner-block">

<div class="blank">
<h2>Walkin Orders</h2>

<div class="grid_3 grid_4">
<div class="page-header">


</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '
    <table class="table" id="dataTables-example" style="font-size: 18px; width: 100%;">
    <thead>
    <tr class="success">
      <th>ID</th>
      <th><center>Date</th>
      <th><center>Customer</th>
      <th><center>Amount</th>
      <th><center>Status</th>
      <th><center>View</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
      echo '<td>' .$obj['OrdersID']. '</td>';
      
      echo '<td align="center">' .$obj['DateOrdered']. '</td>';

      echo '<td align="center">' .$obj['CustomerName']. '</td>';

      echo '<td align="center">' .formatMoney($obj['GrandAmount'], true). '</td>';

      echo '<td align="center">' .$obj['OrderStatus']. '/' .$obj['PaymentStatus']. '</td>';
     
      echo '<td align="center"> ';

      echo '<a href="sales2.php?ordersid=' .$obj['OrdersID']. '"><img src="icons/sales.png" style="width: 25px; height: 25px;" title="View"></a>';

      echo '</td>';

      echo '</tr>';
    
      
    }
    echo '
    </tbody>
    </table>
    ';  

  }

  else {
    echo 'No orders made yet.';
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
  return confirm("Are you sure you want to remove this supplier?"); 
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
                      
            
