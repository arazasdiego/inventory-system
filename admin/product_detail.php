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
  $productid = $_GET['productid'];

  $table = $conn->query("SELECT p.ProdName, p.Stock, p.CostPrice, p.MarkUp, p.RetailPrice, p.Threshold, p.ProdDetail, p.ProdImage, p.ProdStatus, p.DateAdded, p.ProductID, p.ProdImage, p.CategoryID, p.QtyID,
    
    c.CategoryName,
    q.QtyName
    FROM product AS p 
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    INNER JOIN quantity_type AS q ON p.QtyID=q.QtyID
    AND p.ProductDelete=0
    AND p.ProductID='$productid'");

  $obj = $table->fetch_assoc();


  $table2 = $conn->query("SELECT sp.SupplierID, sp.ProductID, sp.ID, 

      s.SupplierName, s.Email, s.Contact, s.SupplierStatus

      FROM supplier_product AS sp
      INNER JOIN supplier AS s ON sp.SupplierID=s.SupplierID
      AND sp.ProductID='$productid'
      ORDER BY s.SupplierName");
  ?>

<div class="inner-block">

<div class="blank">
 <ol class="breadcrumb">
        <li><a href="product.php">View Product</a></li>
        <li class="active">Product Information</li>
      </ol>

<div class="grid_3 grid_4">
<div class="page-header">


</div>  

<div class="bs-example">
<b>PRODUCT INFORMATION</b>
<hr>
<?php
  if($table->num_rows > 0) {
     if ($obj['ProdStatus'] == 'Active') {
        $prodstatus = '<span class="label label-success">Active</span>';
      }
      else {
        $prodstatus = '<span class="label label-danger">Inactive</span>';
      }
    echo '
   
    <table style="font-size: 17px; width: 100%;">
     <tr>
      <th>Name: </th>   
      <td>' .$obj['ProdName']. '</td>

   
    </tr>

    <tr>
      <th>Category: </th>   
      <td>' .$obj['CategoryName']. '</td>

      <th>Quantity Type: </th>   
      <td>' .$obj['QtyName']. '</td>
    </tr>

    <tr>
      <th>Current Stock: </th>   
      <td>' .$obj['Stock']. '</td>

      <th>Threshold Level: </th>   
      <td>' .$obj['Threshold']. '</td>
    </tr>

    <tr>
      <th>Mark Up (%): </th>   
      <td>' .$obj['MarkUp']. '</td>
      
      <th>Status: </th>   
      <td>' .$prodstatus. '</td>
    </tr>

    <tr>
      <th>Cost Price: </th>   
      <td>' .formatMoney($obj['CostPrice'], true). '</td>

       <th>Retail Price: </th>   
      <td>' .formatMoney($obj['RetailPrice'], true). '</td>
    </tr>

    <tr>
      
      <th>Description: </th>   
      <td>' .$obj['ProdDetail']. '</td>
    </tr>

    <tr>
      <th>Date Added: </th>   
      <td>' .$obj['DateAdded']. '</td>
    </tr>

    </table>
    ';  

  }

  else {
    echo 'No product details available.';
  }

  echo 
  '
  <hr>
  <b>SUPPLIER</b>
  <br />
  ';

if($table2->num_rows > 0){
  echo '
  <table class="table" style="font-size: 16px;"> 
    <thead>
    <tr class="success">
      <th>Supplier</th>
      <th><center>Email</th>
      <th><center>Contact</th>
      <th><center>Status</th>
    </tr>
    </thead>

    <tbody>
  ';
  while($obj2 = $table2->fetch_assoc()) {

    echo '<tr>';

      echo '<td>' .$obj2['SupplierName']. '</td>';

      echo '<td align="center">' .$obj2['Email']. '</td>';

      echo '<td align="center">' .$obj2['Contact']. '</td>';

      echo '<td align="center">';
        if($obj2['SupplierStatus'] == 'Active') {
          echo '<span class="label label-success">Active</span>';
        }

        else {
           echo '<span class="label label-danger">Inactive</span>';
        }

      echo '</td>';

      echo '<tr>';

  }
  echo 
  '
  </tbody>
  </table>
  '; 
}

else {
  echo 'No supplier on this product.';
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
                      
						
