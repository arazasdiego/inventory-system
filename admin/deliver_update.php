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
  $id = $_GET['id'];
  
  $table = $conn->query("SELECT o.ID, o.OrderedQty, o.Price, o.DeliveredQty, o.DeliveryStatus, o.PaymentStatus, o.ProductID, o.TotalPrice, o.OrdersID, o.ReturnedQty, 
    p.ProdName, p.ProdImage, p.Stock
    FROM orders AS o
    INNER JOIN product AS p ON o.ProductID=p.ProductID
    AND ID='$id'");

  $obj = $table->fetch_assoc();

  $sql = $conn->query("SELECT * FROM orders_total WHERE OrdersID='$obj[OrdersID]'");
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
    <li><a href="deliverorder.php?ordersid=' .$obj['OrdersID']. '">' .$obj['OrdersID']. '</a></li>
    <li class="active">Update Order</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

 <b>UPDATE ORDER</b>
 
       
 
</div>  

<div class="bs-example">

 <form method="post" action="deliver_update-exec.php">
 <?php
 echo 
  ' 
  <div class="row mb40">
    <div class="col-md-6">
      <b>ITEM</b>
      <table>
      <tr>
        <td><b>Product: </b>' .$obj['ProdName']. '</td>
      </tr>

      <tr>
        <td><b>Price: </b>' .formatMoney($obj['Price'], true). '</td>
      </tr>

      <tr>
        <td><b>DeliverQty: </b>' .$obj['DeliveredQty']. '</td>
      </tr>

      <tr>
        <td><b>Total: </b>' .formatMoney($obj['TotalPrice'], true). '</td>
      </tr>

      </table>
    </div>

  </div>
  ';
 ?>

  <div class="row mb40">
    <div class="col-md-2">
    <h5>Ordered Qty : </h5>
    </div>

    <div class="col-md-2">
    <input type="text" class="form-control" name="qty" data-parsley-type="number" value="<?php echo $obj['OrderedQty']; ?>" required />
    </div>

  </div>



    <input type="hidden" name="id" value="<?php echo $obj['ID']; ?>">

    <input type="hidden" name="ordersid" value="<?php echo $obj['OrdersID']; ?>">

  <div class="row mb40">
  <div class="col-md-4">
  <button type="submit" name="submit">Update Qty</button>
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
                      
						
