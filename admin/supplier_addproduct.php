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

  $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID, 

    c.CategoryName,
    q.QtyName
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.ProductDelete=0
    ORDER BY p.ProdName");

	?>

<div class="inner-block">

<div class="blank">
<?php
  echo 
  '
   <ol class="breadcrumb">
    <li><a href="supplier.php">View Supplier</a></li>
    <li class="active">Add Product to Supplier</li>
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
</div>
';

 
  if($table->num_rows > 0) {
    echo '
    
    <form method="post" action="supplier_addproduct-update.php">
    <b>PRODUCT LIST</b>
    <table class="table" style="font-size: 16px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Cost Price</th>
      <th><center>Stock</th>
      <th><center>Set</th>
      
      
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {

       $check = $conn->query("SELECT * FROM supplier_product
        WHERE ProductID='$obj[ProductID]' AND SupplierID='$supplierid'");


      echo '<tr>';

      echo '<td>
      <a>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />
      </a>';
     

      
     
      echo '</td>';
     
      echo '<td align="center">' .$obj['ProdName']. '</td>';


      echo '<td align="center">' .$obj['CategoryName']. '</td>';

     echo '<td align="center">' .formatMoney($obj['CostPrice'], true). '</td>';
    
    echo '<td align="center">' .$obj['Stock']. '</td>';

   

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
    <button type="submit" name="submit">Set product on supplier</button>
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
                      
						
