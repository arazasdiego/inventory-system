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
$supplierid = $_GET['supplierid'];

$_SESSION['supplierid'] = $supplierid;

 $table = $conn->query("SELECT sp.SupplierID, sp.ProductID, sp.ID,

      p.ProdName, p.ProdImage, p.CostPrice, p.Stock, p.CategoryID,
      c.CategoryName

      FROM supplier_product AS sp
      INNER JOIN product AS p ON sp.ProductID=p.ProductID
      INNER JOIN category AS c ON p.CategoryID=c.CategoryID
      AND sp.SupplierID='$supplierid'
      ORDER BY p.ProdName");

 $sql = $conn->query("SELECT * FROM supplier WHERE SupplierID='$supplierid'");
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
  <ol class="breadcrumb">
    <li><a href="supplier.php">View Supplier</a></li>
    <li class="active">Supplier's Products</li>
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
      
      <table>
      <tr>
        <td><b>Supplier: </b>' .$row['SupplierName']. '</td>
      </tr>

      <tr>
        <td><b>Email: </b>' .$row['Email']. '</td>
      </tr>

      <tr>
        <td><b>Contact: </b>' .$row['Contact']. '</td>
      </tr>

      </table>
    </div>

  </div>
  <hr>
  ';


  if($table->num_rows > 0) {

   echo '
   <b>SUPPLY PRODUCTS</b>
   <form method="post" action="supplier_product-update.php">
    <table class="table" style="font-size: 18px;">
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Stock</th>
      <th><center>Cost Price</th>
      <th><center>Unset</th>
    </tr>
    </thead>

    <tbody>
    ';

    while($obj = $table->fetch_assoc()) {
    
      echo '<tr>';

      echo '<td>
      <img src="../prodimage/' .$obj['ProdImage']. '" alt="Product Image" style="width: 50px; height: 50px;" />';
      
       
      echo '</td>';
      
      echo '<td align="center">' .$obj['ProdName']. '</td>';

      echo '<td align="center">' .$obj['CategoryName']. '</td>';

     
      echo '<td align="center">' .$obj['Stock']. '</td>';

      echo '<td align="center">' .formatMoney($obj['CostPrice'], true). '</td>';

       echo '<td align="center"><input type="checkbox" name="remove_product[]" value="'.$obj['ID'].'" /></td>';
      
      echo '</tr>';
    
    
    }
    echo '
    </tbody>
    </table>
     <hr>
    <center>
    <button type="submit" name="submit">Unset product on supplier</button>
    </form>
    ';  

  }

  else {
    echo 'No supply products yet.';
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
                      
						
