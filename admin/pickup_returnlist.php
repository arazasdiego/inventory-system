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

  $table = $conn->query("SELECT ro.Qty, ro.DateAdded, ro.Status, ro.ID, ro.ProductID, 
    p.ProdName, p.ProdImage,
    dr.ReasonName,
    ui.Fullname
  FROM returned_orders AS ro 
  INNER JOIN product AS p ON ro.ProductID=p.ProductID
  INNER JOIN damaged_reason AS dr ON ro.ReasonID=dr.ReasonID
  INNER JOIN user_info AS ui ON ro.Received=ui.UserID
  AND OrdersID='$ordersid'
  ORDER BY p.ProdName");

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
    <li class="active">Return Orders</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>RETURN ORDERS</b>
 
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
        <td><b>Customer : </b>' .$row['CustomerName']. '</td>
      </tr>

      <tr>
        <td><b>Order Status: </b>' .$row['OrderStatus']. '</td>
      </tr>


      </table>
    </div>

  </div>
  ';


   echo '
    <table class="table" style="font-size: 16px;">
    <thead>
    <tr class="success">
      <th>Image</th>
      <th>Product</th>
      <th>Qty</th>
      <th>Reason</th>
      <th>Received</th>
      <th>Date</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
      echo '<tr>';
      
      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
      
      echo '</td>';
      
      echo '<td>' .$obj['ProdName']. '</td>';

      echo '<td>' .$obj['Qty']. '</td>';

      echo '<td>' .$obj['ReasonName']. '</td>';

      echo '<td>' .$obj['Fullname']. '</td>';

      echo '<td>' .$obj['DateAdded']. '</td>';

      echo '<td>' .$obj['Status']. '</td>';

      echo '<td>';

      if($obj['Status'] == 'Pending') {

        echo '<a href="pickup_return-inventory.php?id=' .$obj['ID']. '">
        <img src="icons/inventory.png" style="width: 25px; height: 25px;" title="RETURN TO INVENTORY" /></a> |';

      echo '<a href="pickup_return-damage.php?id=' .$obj['ID']. '">
        <img src="icons/damage.png" style="width: 25px; height: 25px;" title="REPORT AS DAMAGE" /></a>';
      }

      echo '</td>';
      
      echo '</tr>';
    
    
    }
    echo '
    </tbody>
    </table>
    ';  

  }

  else {
    echo 'No return order records.';
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
  return confirm("Are you sure you want to cancel this return order?"); 
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
                      
						
