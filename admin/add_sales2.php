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
  

    AND p.ProdStatus='Active' AND p.Stock > 0

    ORDER BY p.ProdName");

  $sql2 = $conn->query("SELECT * FROM sales_cart
    WHERE UserID='$_SESSION[userid]'");

	$sql3 = $conn->query("SELECT SUM(Qty) AS TotalQty, SUM(TotalPrice) AS TotalAmount FROM sales_cart 
    WHERE UserID='$_SESSION[userid]'");
  $row3 = $sql3->fetch_assoc();


  $discount = $conn->query("SELECT * FROM discount WHERE DiscountID='$_SESSION[discountid]'");
  $discrow = $discount->fetch_assoc();

  ?>

<div class="inner-block">

<div class="blank">

  <ol class="breadcrumb">
    <li><a href="add_sales.php">Add Walkin Order</a></li>
    <li class="active">Shop List</li>
  </ol>

<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">
<?php
 

  echo 
  '
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
        <td><b>Discount: </b>' .$discrow['DiscountName']. '-(' .$discrow['DiscountValue']. '%)</td>
      </tr>
      ';

        if($sql2->num_rows > 0) {
     echo 
      '
       <tr>
        <td><b><a href="salescart.php" >' .$row3['TotalQty']. ' items (' .formatMoney($row3['TotalAmount'], true). ')</a></b></td>
      </tr>
      ';
  }

    echo '
    </table>
    </div>   

  </div>
 
  
    ';


  if($table->num_rows > 0) {
    echo '
    <b>PRODUCT LIST</b>
    <form method="post" action="cart_update.php">
    <table class="table" style="font-size: 16px; width: 90%;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th>Product</th>
      
      <th>Stock</th>
      <th>Retail Price</th>
      <th>Add</th>
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

      $check = $conn->query("SELECT * FROM sales_cart
        WHERE ProductID='$obj[ProductID]' AND UserID='$_SESSION[userid]'");

      echo '<tr>';

      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
       
      echo '</td>';
     
     echo '<td>' .$obj['ProdName']. '</td>';

     
      
      echo '<td>' .$obj['Stock']. '</td>';

      echo '<td>' .formatMoney($obj['RetailPrice'], true). '</td>';

      echo '<td>';

      if($check->num_rows > 0) {
        echo '<span class="label label-success">Added</span>';
      }

      else {
       echo '
      <input type="checkbox" name="add_product[]" value="'.$obj['ProductID'].'" />
      ';
      }
     

           


      echo '</td>';
     
     
      echo '</tr>';

      
    }

    echo '
    </tbody>
    </table>
    <hr>
    <center>
    <button type="submit" name="submit">Add product to cart</button>
    </form>

    ';  

  }

  else {
    echo 'No data available.';
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
                      
						
