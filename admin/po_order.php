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
	$supplierid = $_GET['supplierid'];
  $_SESSION['supplierid'] = $supplierid; 

	$sql = $conn->query("SELECT SupplierName, Email, Contact FROM supplier WHERE SupplierID='$supplierid'");
	$row = $sql->fetch_assoc();

	$table = $conn->query("SELECT sp.ProductID, sp.SupplierID, sp.ID,
    p.ProdName, p.ProdImage, p.CostPrice, p.Stock, p.CategoryID,
    c.CategoryName
    FROM supplier_product AS sp
    INNER JOIN product AS p ON sp.ProductID=p.ProductID
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    AND sp.SupplierID='$supplierid'
    ORDER BY p.Prodname");

    $sql2 = $conn->query("SELECT * FROM po_cart WHERE UserID='$_SESSION[userid]' AND SupplierID='$supplierid'");

    $sql3 = $conn->query("SELECT SUM(Qty) AS TotalQty, SUM(TotalPrice) AS TotalAmount FROM po_cart WHERE UserID='$_SESSION[userid]' AND SupplierID='$supplierid'");
  $row3 = $sql3->fetch_assoc();

	?>

<div class="inner-block">

<div class="blank">
<?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="add_po.php">Add Purchase Order</a></li>
    <li class="active">Order(' .$row['SupplierName']. ')</li>
  </ol> 
  ';
 
 ?> 
<div class="grid_3 grid_4">
<div class="page-header">


</div>  

<div class="bs-example">
<?php

echo 
'
  <div class="row mb40">
    <div class="col-md-6">
      <b>SUPPLIER</b>
      <table>
      <tr>
        <td><b>Name: </b>' .$row['SupplierName']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact #: </b>' .$row['Contact']. '</td>
      </tr>
    
    </table>
    </div>

    <div class="col-md-6">
      <b>ACTION</b>
      <table>
      <tr>
        <td><b><a href="po_viewcart.php?supplierid=' .$supplierid. '">' .$row3['TotalQty']. ' items (' .formatMoney($row3['TotalAmount'], true). ')</a></b></td>
      </tr>
      </table>
    </div>
</div>
';

 
  if($table->num_rows > 0) {
    echo '
    
    <form method="post" action="po_order-update.php">
    <b>SUPPLIER PRODUCTS</b>
    <table class="table" style="font-size: 16px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Stock</th>
      <th><center>Cost Price</th>
      <th><center>Add</th>
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

       $check = $conn->query("SELECT * FROM po_cart
        WHERE ProductID='$obj[ProductID]' AND UserID='$_SESSION[userid]' AND SupplierID='$supplierid'");


      echo '<tr>';

      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
     

      
     
      echo '</td>';
     
      echo '<td align="center">' .$obj['ProdName']. '</td>';
      echo '<td align="center">' .$obj['CategoryName']. '</td>';

      

      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center"><input type="text" size="2" maxlength="6" class="form-control" name="costprice[' .$obj['ProductID']. ']" value="'  .$obj['CostPrice']. '" data-parsley-type="number" required /></td>';

    echo '<td align="center">';

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
    <button type="submit" name="submit">Update cost price / Add product to cart</button>
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
                      
						
