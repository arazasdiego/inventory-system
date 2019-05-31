<?php
ob_start();
require('../connection.php');
require('../format_money.php');
require('session.php');

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
 $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage,

    c.CategoryName, c.CategoryID,
    q.QtyName, q.QtyID
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.Threshold >= p.Stock
    ORDER BY p.ProdName");

  //Processing
  $online = $conn->query("SELECT * FROM orders_total WHERE OrderType='Online' AND OrderStatus!='Completed' AND OrdersDelete=0");
  $online_count = $online->num_rows;

  $pickuporder = $conn->query("SELECT * FROM orders_total WHERE TransactionType='Pickup' AND OrderStatus!='Completed' AND OrdersDelete=0");
  $pickupcount = $pickuporder->num_rows;

  $deliveryorder = $conn->query("SELECT * FROM orders_total WHERE TransactionType='Delivery' AND OrderStatus!='Completed' AND OrdersDelete=0");
  $deliverycount = $deliveryorder->num_rows;


  $product = $conn->query("SELECT * FROM product");
  $product_count = $product->num_rows;

  $po = $conn->query("SELECT * FROM po_total");
  $po_count = $po->num_rows;
  ?>

<div class="inner-block">

<div class="blank">
<h2>Dashboard</h2>

<div class="grid_3 grid_4">
<div class="page-header">
<b>PRODUCT THRESHOLD ALERT</b>
</div>  

<div class="bs-example">
   <?php 
  if($table->num_rows > 0) {
    echo '
    <table class="table" style="font-size: 18px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Stock</th>
      <th><center>Threshold</th>
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
     
      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['CategoryName']. '</td>';

    

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .$obj['Threshold']. '</td>';

      echo '</tr>';

     
    }
    echo 
    '
    </tbody>
    </table>
    ';

  }

  else {
    echo 'No product on critical level.';
  }
  ?>
</div>


</div>

<br />
<br />

  <?php
  if($urow['Orders'] == 1) {
    echo 
    '
    <div class="typo-badges">
       <div class="appearance">
        <b>ORDER NOTIFICATIONS</b>
  <br />
       
        <div class="col-md-6">

          <p>Online Orders (Still for process).</p>



          <div class="list-group list-group-alternate"> 
            <a href="online_sales.php" class="list-group-item"><span class="badge blue">' .$online_count. '</span> Online Orders(All) </a> 

            <a href="online_sales.php" class="list-group-item"><span class="badge badge-primary">' .$pickupcount. '</span> Order for Pickup</a> 

            <a href="online_sales.php" class="list-group-item"><span class="blue badge">' .$deliverycount. '</span> Order for Delivery </a>


          </div>
          </div>
         <div class="clearfix"> </div>
      </div>
    <!--bagets-->
         </div>
    ';
  }
  ?>

  




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
  return confirm("Are you sure you want to remove this product?"); 
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
                      
            
