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

  $sql2 = $conn->query("SELECT SUM(TotalPrice) AS TotalAmount FROM po_cart WHERE SupplierID='$supplierid'");
  $row2 = $sql2->fetch_assoc();


	$table = $conn->query("SELECT pc.Qty, pc.Price, pc.TotalPrice, pc.ID, pc.SupplierID,
    p.ProdName, p.ProdImage, p.ProductID, p.CategoryID, 
    c.CategoryName
    
    FROM po_cart AS pc 
    INNER JOIN product AS p ON pc.ProductID=p.ProductID
    INNER JOIN category AS c ON p.CategoryID=c.CategoryID
    AND pc.SupplierID='$supplierid' AND UserID='$_SESSION[userid]'
    ORDER BY p.ProdName");

   
	?>

<div class="inner-block">

<div class="blank">
<?php
  echo 
  '
  <ol class="breadcrumb">
    <li><a href="add_po.php">Add Purchase Order</a></li>
    <li><a href="po_order.php?supplierid=' .$supplierid. '">Order(' .$row['SupplierName']. ')</a></li>
    <li class="active">PO Cart</li>
  </ol>
  ';

?>
<div class="grid_3 grid_4">
<div class="page-header">

</div>  

<div class="bs-example">
<?php
  if($table->num_rows > 0) {
    echo '




<div class="row mb40">
    <div class="col-md-6">
      <b>SUPPLIER DETAILS</b>
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



  <center>
       <h4>SET DELIVERY DATE FOR PURCHASE</h4>
      <form method="post" action="po_saveorder.php">
      <input type="hidden" name="supplierid" value="' .$supplierid. '">
      <input type="hidden" name="totalamount" value="' .$row2['TotalAmount']. '">
      <table style="font-size: 16px; width: 60%;">
      <tr>
        <th>Delivery Date: </th>
        <td><input type="date" name="delivery_date" class="form-control" required /></td> 

       
         <td><button type="submit" name="submit">Submit</button></td>
    
      </tr>
      </table>
      </form>
      </center>
';


  


    echo '
    <hr>
    <form method="post" action="po_viewcart-update.php">
    <b>PURCHASE CART</b>
    <table class="table" style="font-size: 16px;"> 
    <thead>
    <tr class="success">
      <th>Image</th>
      <th><center>Product</th>
      <th><center>Category</th>
      <th><center>Cost Price</th>
      <th><center>Qty</th>
      <th><center>Total</th>
      <th><center>Remove</th>
      
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

      echo '<td align="center">' .formatMoney($obj['Price'], true). '</td>';

       

         echo '<td width="10%" align="center"><input type="text" size="2" maxlength="3" class="form-control" name="qty[' .$obj['ID']. ']" value="'  .$obj['Qty']. '" data-parsley-type="number" required /></td>';

      echo '<td align="center">' .formatMoney($obj['TotalPrice'], true). '</td>';

     echo '<td align="center"><input type="checkbox" name="remove_product[]" value="'.$obj['ID'].'" /></td>';

      echo '</tr>';
     }

   

    echo '
    </tbody>
    </table>
    <center>
    <table style="font-size: 16px; width: 50%;">
     <tr>
     
      <td>Total Amount</td>
      <th>' .formatMoney($row2['TotalAmount'], true). '</th>
      
      </tr>
    </table>


    <hr>
    <center>
<button type="submit" name="submit">Update Qty / Remove Product</button>
     <hr>
    
    </form>


    ';  

   
  }

  else {
    echo 'Add a product to continue.';
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
                      
						
