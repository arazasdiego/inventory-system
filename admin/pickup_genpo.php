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
  $_SESSION['ordersid'] = $ordersid;

   $table = $conn->query("SELECT ap.PendingQty, ap.DateAdded, ap.ID, ap.SupplierID, 
    ap.Price, ap.Total, ap.ProductID,

    p.ProdName, p.ProdImage
   
    FROM auto_po AS ap
    INNER JOIN product AS p ON ap.ProductID=p.ProductID
    
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
    <li class="active">Generated Purchase</li>
  </ol>
  ';
   
  ?>
<div class="grid_3 grid_4">
<div class="page-header">

  <b>GENERATED PURCHASE</b>
 
  </div>  


<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo 
  ' 
  <div class="row mb40">

   <div class="col-md-6">
      <b>ORDER DETAILS</b>
      <table>
      <tr>
      <td><b>Name: </b>' .$row['CustomerName']. '</td>
      </tr>

     
      <tr>
      <td><b>Date Ordered: </b>' .$row['DateOrdered']. '</td>
      </tr>

    
      </table>
    </div>

 

  </div>
  ';


   echo '
      <center>
       <b>SET DELIVERY DATE FOR PURCHASE</b>
      <form method="post" action="pickup_genpo-exec.php">
      <table style="font-size: 16px; width: 50%;">
      <tr>
        <th>Delivery Date: </th>
        <td><input type="date" name="deliverydate" class="form-control " required /></td>

        <input type="hidden" name="ordersid" value="' .$ordersid. '" />
         <td><button type="submit" name="submit">Submit</button></td>
    
      </tr>
      </table>
      </form>
      </center>

      <hr>
    <b>REQUESTED PRODUCTS</b>
    <form method="post" action="pickup_genpo-update.php">
    <table class="table" style="font-size: 18px;">
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Cost Price</th>
      <th><center>Requested</th>
      <th><center>Total</th>
      <th><center>Supplier</th>
      
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

    

      echo '<td align="center" width="20%"><input type="text" maxlength="5" class="form-control" name="price[' .$obj['ID']. ']" value="'  .$obj['Price']. '" data-parsley-type="number" required /></td>';

       echo '<td align="center" width="10%"><input type="text" maxlength="3" class="form-control" name="qty[' .$obj['ID']. ']" value="'  .$obj['PendingQty']. '" data-parsley-type="number" required /></td>';

      echo '<td align="center">' .formatMoney($obj['Total'], true). '</td>';




      echo '<td>';
       if($obj['SupplierID'] == 'None') {
        echo 
        '
        <select name="supplierid[' .$obj['ID']. ']" class="form-control" required>
        <option value="" selected="selected">- NONE - </option>
        ';
        $sql11 = $conn->query("SELECT sp.ProductID, sp.SupplierID, sp.ID, 
          s.SupplierName
          FROM supplier_product AS sp
          INNER JOIN supplier AS s ON sp.SupplierID=s.SupplierID
          AND sp.ProductID='$obj[ProductID]'
          ORDER BY s.SupplierName");
        while($row11 = $sql11->fetch_assoc()) {
          echo '<option value="' .$row11['SupplierID']. '">' .$row11['SupplierName']. '</option>';
        }
        echo '
        </select>
        ';
      }


      else {
           echo 
        '
        <select name="supplierid[' .$obj['ID']. ']" class="form-control" required>
       
        ';
        $sql11 = $conn->query("SELECT sp.ProductID, sp.SupplierID, sp.ID, 
          s.SupplierName
          FROM supplier_product AS sp
          INNER JOIN supplier AS s ON sp.SupplierID=s.SupplierID
          AND sp.ProductID='$obj[ProductID]'
          ORDER BY s.SupplierName");
        while($row11 = $sql11->fetch_assoc()) {

          if($row11['SupplierID'] == $obj['SupplierID']) {
        echo '<option value="' .$row11['SupplierID']. '" selected="selected">' .$row11['SupplierName']. '</option>';
      }
      else {
       echo '<option value="' .$row11['SupplierID']. '">' .$row11['SupplierName']. '</option>';
      }
      
      }
        echo '
        </select>
        ';
      }
    
      echo '</td>';







      echo '</tr>';
    
    
    }
    echo '
    </tbody>
    </table>
  <center>

  <button type="submit" name="submit">Update qty / Update cost price / Update supplier</button>
    </form>
    ';  

  }

  else {
    echo 'No records of generated po.';
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
                      
						
