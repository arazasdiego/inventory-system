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
  $sql2 = $conn->query("SELECT SUM(TotalPrice) AS SubAmount, SUM(Qty) AS TotalQty  FROM sales_cart WHERE UserID='$_SESSION[userid]'");
  $row2 = $sql2->fetch_assoc();

  $table = $conn->query("SELECT sc.Qty, sc.Price, sc.TotalPrice, sc.ID, sc.ProductID, 

    p.ProdName, p.ProdImage, p.Stock
    
    FROM sales_cart AS sc 
    INNER JOIN product AS p ON sc.ProductID=p.ProductID
    AND UserID='$_SESSION[userid]'
    ORDER BY p.ProdName");

 
    
  $discount = $conn->query("SELECT * FROM discount WHERE DiscountID='$_SESSION[discountid]'");
  $disrow = $discount->fetch_assoc();

  $grandamount = $row2['SubAmount'];

  $discountedamount = ($disrow['DiscountValue'] / 100) * $grandamount;

  $amountpayable = $grandamount - $discountedamount;
  ?>
 

<div class="inner-block">

<div class="blank">
<ol class="breadcrumb">
    <li><a href="add_sales.php">Add Walkin Order</a></li>
    <li><a href="add_sales2.php">Shop List</a></li>
    <li class="active">View Cart</li>
  </ol>
<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">

<?php
  if($table->num_rows > 0) {
    echo 
    '
  <form method="post" action="salescart-exec.php">

  <input type="hidden" name="subamount" value="' .$row2['SubAmount']. '" />

  <input type="hidden" name="grandamount" value="' .$grandamount. '" />

  <input type="hidden" name="discountedamount" value="' .$discountedamount. '" />
  
  <input type="hidden" name="amountpayable" value="' .$amountpayable. '" />

  <div class="row mb40">
    <div class="col-md-6">
      <b>CUSTOMER INFORMATION</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$_SESSION['customername']. '</td>
      </tr>

      <tr>
        <td><b>Address: </b>' .$_SESSION['completeaddress']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$_SESSION['mobile']. '</td>
      </tr>
    
    </table>
    </div>

   
    <div class="col-md-6">
      <b>ORDER DETAIL</b>
      <table>
      <tr>
        <td><b>Discount: </b>' .$disrow['DiscountName']. ' - ' .$disrow['DiscountValue']. '%</td>
      </tr>
     
    </table>
    </div>   
</div>

  <div class="row mb40">
    <div class="col-md-2">
     <b>Amount: </b> 
    </div>

     <div class="col-md-2">
     <input type="text" name="amountpaid" class="form-control" data-parsley-type="number" required />
    </div>


    <div class="col-md-2">
     <button type="submit" name="submit">Submit</button>
    </div>
  
  </div>

  </form>

 
  ';
    echo '
    <b>ORDER CART</b>
    <form method="post" action="cart_update2.php">
    <table class="table" style="font-size: 16px; width: 100%;">
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Stock</th>
      <th><center>Price</th>
      <th><center>Qty</th>
      <th><center>Total</th>
      <th><center>Action</th>
      
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

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

      echo '<td align="center" width="10%"><input type="text" size="2" maxlength="3" class="form-control" name="qty[' .$obj['ID']. ']" value="'  .$obj['Qty']. '" data-parsley-type="number" required /></td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';


      echo '<td align="center"><input type="checkbox" name="remove_product[]" value="'.$obj['ID'].'" /></td>';

     

      echo '</tr>';

    }
    echo '</table>';


    echo '

    <center>
    <table style="font-size: 16px; width: 50%;">
      <tr>
     
      <td>Subtotal: </td>
      <td align="right">' .formatMoney($row2['SubAmount'], true). '</td>
      </tr>
      ';
     
      echo 
        '
        <tr>
          <th>Grandtotal: </th>
          <td align="right">' .formatMoney($grandamount, true). '</td>
        </tr>
        ';
   
        echo '</table>';

      echo 
      '
      <hr>
       <table style="font-size: 16px; width: 50%;">
     

      <td>Discounted Amount: </td>
      <td align="right">' .formatMoney($discountedamount, true). '</td>
      </tr>

      <th>Amount Payable: </th>
      <td align="right">' .formatMoney($amountpayable, true). '</td>
      </tr>

      ';
    echo '
    </table>

      <hr>
     <button type="submit" name="submit">Update Qty / Remove Product</button>
    </center>

    </form>
    ';  

   
  }

  else {
    echo 'No product on cart.';
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
  return confirm("Are you sure you want to remove this product?"); 
}
</script>






</body>
</html>

<?php
ob_end_flush();
?>
                      
            
